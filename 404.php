<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/bootstrap.php';

http_response_code(404);

$page = [
    'title' => 'Page not found',
    'description' => 'The page you were looking for could not be found.',
    'path' => '/404',
    'robots' => 'noindex, nofollow',
];

$hero = [
    'eyebrow' => 'Error 404',
    'h1' => ['This page', 'wandered off,', 'but we can help.'],
    'lead' => 'The page you were looking for does not exist or has moved. Try one of these instead.',
    'actions' => [
        ['Back to home', '/', 'primary'],
        ['Our services', '/services/', 'secondary'],
    ],
];

require INCLUDES_DIR . '/head.php';
require INCLUDES_DIR . '/header.php';
require INCLUDES_DIR . '/page-hero.php';
require INCLUDES_DIR . '/footer.php';
