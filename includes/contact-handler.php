<?php
declare(strict_types=1);

/**
 * Contact-form handling: validation, abuse protection and mail delivery.
 * Kept separate from api/contact.php so it can be tested without HTTP.
 */

const CONTACT_MIN_FILL_SECONDS = 3;
const CONTACT_RATE_LIMIT = 5;
const CONTACT_GLOBAL_RATE_LIMIT = 40;
const CONTACT_RATE_WINDOW = 3600;

/** Issues (or reuses) the CSRF token and stamps the form render time. */
function contact_form_token(): string
{
    start_secure_session();
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    $_SESSION['form_ts'] = time();

    return $_SESSION['csrf'];
}

/** Collapses a value to a single trimmed line with control characters removed. */
function clean_line(mixed $value, int $maxLength): string
{
    $text = is_string($value) ? $value : '';
    $text = preg_replace('/[\x00-\x1F\x7F]+/u', ' ', $text) ?? '';
    $text = trim($text);

    return mb_substr($text, 0, $maxLength);
}

/** Cleans free text: keeps newlines/tabs, strips other control characters. */
function clean_text(mixed $value, int $maxLength): string
{
    $text = is_string($value) ? $value : '';
    $text = str_replace(["\r\n", "\r"], "\n", $text);
    $text = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]+/u', '', $text) ?? '';

    return mb_substr(trim($text), 0, $maxLength);
}

/**
 * Validates raw POST data.
 *
 * @param array<string, mixed> $input
 * @return array{clean: array<string, string>, errors: array<string, string>}
 */
function validate_contact_input(array $input): array
{
    $clean = [
        'name' => clean_line($input['name'] ?? '', 100),
        'email' => clean_line($input['email'] ?? '', 254),
        'company' => clean_line($input['company'] ?? '', 100),
        'service' => clean_line($input['service'] ?? '', 100),
        'message' => clean_text($input['message'] ?? '', 5000),
    ];
    $errors = [];

    if (mb_strlen($clean['name']) < 2) {
        $errors['name'] = 'Please enter your name.';
    }
    if (filter_var($clean['email'], FILTER_VALIDATE_EMAIL) === false) {
        $errors['email'] = 'Please enter a valid email address.';
    }
    if ($clean['service'] !== '' && !in_array($clean['service'], contact_service_options(), true)) {
        $errors['service'] = 'Please choose one of the listed options.';
    }
    if (mb_strlen($clean['message']) < 10) {
        $errors['message'] = 'Please tell us a little about your project (at least 10 characters).';
    }

    return ['clean' => $clean, 'errors' => $errors];
}

/** Rate-limit key for a client: IPv4 as-is, IPv6 collapsed to its /64 network. */
function contact_client_key(string $ip): string
{
    $packed = @inet_pton($ip);
    if ($packed !== false && strlen($packed) === 16) {
        return bin2hex(substr($packed, 0, 8));
    }

    return $ip;
}

/**
 * Records one attempt in a bucket file and reports whether it is over $limit
 * for the window. Fails closed if the bucket cannot be read or written.
 */
function contact_bucket_exceeded(string $name, int $limit): bool
{
    $file = sys_get_temp_dir() . '/dv_rl_' . hash('sha256', $name) . '.json';
    $handle = @fopen($file, 'c+');
    if ($handle === false) {
        error_log('[contact-form] rate-limit file not writable: ' . $file);

        return true;
    }

    $exceeded = true;
    if (flock($handle, LOCK_EX)) {
        $now = time();
        $hits = json_decode((string) stream_get_contents($handle), true);
        $hits = is_array($hits) ? $hits : [];
        $hits = array_values(array_filter($hits, static fn ($t): bool => is_int($t) && $t > $now - CONTACT_RATE_WINDOW));

        $exceeded = count($hits) >= $limit;
        if (!$exceeded) {
            $hits[] = $now;
        }

        ftruncate($handle, 0);
        rewind($handle);
        fwrite($handle, (string) json_encode($hits));
        fflush($handle);
        flock($handle, LOCK_UN);
    }
    fclose($handle);

    return $exceeded;
}

/** Occasionally deletes stale rate-limit files so the temp dir does not fill up. */
function contact_prune_rate_files(): void
{
    if (random_int(1, 50) !== 1) {
        return;
    }
    foreach (glob(sys_get_temp_dir() . '/dv_rl_*.json') ?: [] as $file) {
        if (is_file($file) && filemtime($file) < time() - CONTACT_RATE_WINDOW) {
            @unlink($file);
        }
    }
}

/** True when this client, or the site as a whole, has sent too many messages. */
function contact_rate_limited(string $ip): bool
{
    contact_prune_rate_files();

    return contact_bucket_exceeded('ip:' . contact_client_key($ip), CONTACT_RATE_LIMIT)
        || contact_bucket_exceeded('global', CONTACT_GLOBAL_RATE_LIMIT);
}

/** Sends the enquiry email. In local development it is logged instead. */
function send_contact_mail(array $clean): bool
{
    $subject = 'New website enquiry' . ($clean['service'] !== '' ? ' — ' . $clean['service'] : '');

    $body = implode("\n", [
        'Name:    ' . $clean['name'],
        'Email:   ' . $clean['email'],
        'Company: ' . ($clean['company'] !== '' ? $clean['company'] : '-'),
        'Interest: ' . ($clean['service'] !== '' ? $clean['service'] : '-'),
        '',
        'Message:',
        $clean['message'],
        '',
        '---',
        'Sent from the contact form on ' . site_host(),
    ]);

    if (is_dev()) {
        error_log("[contact-form] DEV MODE — email not sent.\nSubject: $subject\n$body");

        return true;
    }

    // Sent from the no-reply address to the private inbox. Reply-To is the visitor.
    $headers = [
        'From' => SITE_NAME . ' <' . MAIL_FROM . '>',
        'Reply-To' => $clean['email'],
        'Content-Type' => 'text/plain; charset=UTF-8',
        'X-Mailer' => 'PHP/' . PHP_VERSION,
    ];

    // Subject is built from allowlisted values only; encode the em dash safely.
    return mail(FORM_RECIPIENT, mb_encode_mimeheader($subject, 'UTF-8'), $body, $headers);
}

/**
 * Handles a POST from the contact form.
 *
 * @param array<string, mixed> $post
 * @param array<string, mixed> $server
 * @return array{status: int, ok: bool, errors?: array<string, string>, message?: string, csrf?: string}
 */
function handle_contact_submission(array $post, array $server): array
{
    if (($server['REQUEST_METHOD'] ?? '') !== 'POST') {
        return ['status' => 405, 'ok' => false, 'message' => 'Method not allowed.'];
    }

    // Same-origin check: browsers send Origin on cross-site POSTs.
    $origin = (string) ($server['HTTP_ORIGIN'] ?? '');
    if ($origin !== '' && parse_url($origin, PHP_URL_HOST) !== parse_url('//' . site_host(), PHP_URL_HOST)) {
        return ['status' => 403, 'ok' => false, 'message' => 'Request not allowed.'];
    }

    start_secure_session();
    $token = is_string($post['csrf'] ?? null) ? $post['csrf'] : '';
    $expected = (string) ($_SESSION['csrf'] ?? '');
    if ($expected === '' || !hash_equals($expected, $token)) {
        return ['status' => 403, 'ok' => false, 'message' => 'Your session expired. Please refresh the page and try again.'];
    }

    // Honeypot and "filled in too fast" checks both look like a bot; pretend success.
    $filledIn = time() - (int) ($_SESSION['form_ts'] ?? 0);
    if ((!is_string($post['website'] ?? '') || trim($post['website'] ?? '') !== '') || $filledIn < CONTACT_MIN_FILL_SECONDS) {
        return ['status' => 200, 'ok' => true];
    }

    $result = validate_contact_input($post);
    if ($result['errors'] !== []) {
        return ['status' => 422, 'ok' => false, 'errors' => $result['errors']];
    }

    if (contact_rate_limited((string) ($server['REMOTE_ADDR'] ?? 'unknown'))) {
        return ['status' => 429, 'ok' => false, 'message' => 'Too many messages from your connection. Please try again later or email us directly.'];
    }

    if (!send_contact_mail($result['clean'])) {
        error_log('[contact-form] mail() failed for enquiry from ' . $result['clean']['email']);

        return ['status' => 500, 'ok' => false, 'message' => 'We could not send your message just now. Please email us directly instead.'];
    }

    // Rotate the token (the page's form is reused without a reload) and restart
    // the fill-time clock for the next message.
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
    $_SESSION['form_ts'] = time();

    return ['status' => 200, 'ok' => true, 'csrf' => $_SESSION['csrf']];
}
