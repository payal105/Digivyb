<?php
declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/bootstrap.php';
require INCLUDES_DIR . '/contact-handler.php';

$result = handle_contact_submission($_POST, $_SERVER);

$wantsJson = str_contains((string) ($_SERVER['HTTP_ACCEPT'] ?? ''), 'application/json');

if ($wantsJson) {
    http_response_code($result['status']);
    header('Content-Type: application/json; charset=UTF-8');
    header('Cache-Control: no-store');
    echo json_encode(array_diff_key($result, ['status' => true]), JSON_UNESCAPED_UNICODE);
    exit;
}

// No-JavaScript fallback: send the visitor back to the contact page.
header('Location: /contact?' . ($result['ok'] ? 'sent=1' : 'error=1'), true, 303);
exit;
