<?php
declare(strict_types=1);

/**
 * Shared bootstrap: site config + small helpers. Every page requires this first.
 */

const SITE_NAME = 'digivyb';
// Public contact address: shown on the site and used as the sender of form emails.
const CONTACT_EMAIL = 'info@digivyb.com';
// "From" address on contact-form emails. It only labels the message; it does not
// need to be a real mailbox, but it must be on the site's own domain.
const MAIL_FROM = 'no-reply@digivyb.com';
// Private inbox that actually receives contact-form enquiries (never shown on the site).
const FORM_RECIPIENT = 'digivyb@gmail.com';
// Production hostname. Used for canonical URLs, the sitemap and mail instead of
// the (spoofable) Host header. www.digivyb.com redirects here (see .htaccess).
const SITE_HOST = 'digivyb.com';

// Keep search engines out while the content is still being finalised.
// Set to true when the site is ready to be found on Google.
const ALLOW_INDEXING = false;
const INCLUDES_DIR = __DIR__;
const ROOT_DIR = __DIR__ . '/..';

// Belt and braces alongside the robots meta tag: also covers non-HTML responses.
if (!ALLOW_INDEXING && PHP_SAPI !== 'cli' && !headers_sent()) {
    header('X-Robots-Tag: noindex, nofollow');
}

// Never show PHP errors to visitors; log them instead.
ini_set('display_errors', '0');
ini_set('log_errors', '1');

/** HTML-escape for output. */
function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/** Request host, validated so it is safe to echo into URLs. */
function site_host(): string
{
    if (SITE_HOST !== '' && !is_dev()) {
        return SITE_HOST;
    }

    $host = strtolower((string) ($_SERVER['HTTP_HOST'] ?? 'localhost'));

    return preg_match('/^[a-z0-9.-]+(:\d{1,5})?$/', $host) === 1 ? $host : 'localhost';
}

function is_https(): bool
{
    return (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        || ($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '') === 'https';
}

/** True when running on a local development machine. */
function is_dev(): bool
{
    if (PHP_SAPI === 'cli-server') {
        return true;
    }
    if (SITE_HOST !== '') {
        return false; // production host configured: never trust the Host header for this
    }
    $host = strtolower((string) ($_SERVER['HTTP_HOST'] ?? ''));

    return preg_match('/^(localhost|127\.0\.0\.1)(:\d+)?$/', $host) === 1;
}

/** Absolute URL for a site path, e.g. site_url('/about'). */
function site_url(string $path = '/'): string
{
    return (is_https() ? 'https' : 'http') . '://' . site_host() . $path;
}

/** Root-relative asset URL with a cache-busting version from the file's mtime. */
function asset(string $path): string
{
    $file = ROOT_DIR . '/' . $path;
    $version = is_file($file) ? (string) filemtime($file) : '1';

    return '/' . $path . '?v=' . $version;
}

/**
 * All service groups, keyed by slug. Single source of truth for the nav,
 * footer, home/hub cards, contact dropdown, sitemap and the service pages.
 *
 * @return array<string, array<string, mixed>>
 */
function services(): array
{
    static $services = null;

    return $services ??= require INCLUDES_DIR . '/services-data.php';
}

/**
 * Allowed values for the contact form's "What are you looking for?" field.
 *
 * @return list<string>
 */
function contact_service_options(): array
{
    $options = ['Not sure yet — I need advice'];
    foreach (services() as $service) {
        $options[] = $service['name'];
    }
    $options[] = 'Something else';

    return $options;
}

/** Starts the session with hardened cookie settings (used by the contact form). */
function start_secure_session(): void
{
    if (session_status() === PHP_SESSION_ACTIVE) {
        return;
    }
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'secure' => is_https(),
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
    session_start();
}

/** Public URL of a service page. */
function service_url(string $slug): string
{
    return '/services/' . $slug;
}
