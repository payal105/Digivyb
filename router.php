<?php
declare(strict_types=1);

/**
 * Local development router for PHP's built-in server:
 *   php -S localhost:8080 router.php
 * Mimics the production .htaccess (extensionless URLs, 404 page, blocked includes/).
 */

if (PHP_SAPI !== 'cli-server') {
    http_response_code(404);
    exit;
}

$path = parse_url((string) $_SERVER['REQUEST_URI'], PHP_URL_PATH) ?: '/';
$path = rawurldecode($path);

if (preg_match('#^/includes(/|$)#', $path) === 1 || str_contains($path, '..')) {
    http_response_code(404);
    require __DIR__ . '/404.php';
    return true;
}

$aliases = ['/robots.txt' => '/robots.php', '/sitemap.xml' => '/sitemap.php'];
$path = $aliases[$path] ?? $path;
$file = __DIR__ . $path;

// Real static files (css, js, images, video) are served as-is.
if ($path !== '/' && is_file($file) && !str_ends_with($path, '.php')) {
    return false;
}

$candidates = [
    __DIR__ . rtrim($path, '/') . '.php',
    __DIR__ . rtrim($path, '/') . '/index.php',
    $path === '/' ? __DIR__ . '/index.php' : '',
];
if (str_ends_with($path, '.php') && is_file($file)) {
    array_unshift($candidates, $file);
}

foreach ($candidates as $candidate) {
    if ($candidate !== '' && is_file($candidate) && realpath($candidate) !== __FILE__) {
        $_SERVER['SCRIPT_NAME'] = substr($candidate, strlen(__DIR__));
        chdir(dirname($candidate));
        require $candidate;

        return true;
    }
}

http_response_code(404);
require __DIR__ . '/404.php';
return true;
