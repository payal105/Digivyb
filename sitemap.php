<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/bootstrap.php';

$paths = ['/', '/about', '/services/', '/work', '/contact'];
foreach (array_keys(services()) as $slug) {
    $paths[] = service_url($slug);
}

header('Content-Type: application/xml; charset=UTF-8');
echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
foreach ($paths as $path) {
    echo '  <url><loc>' . e(site_url($path)) . '</loc></url>' . "\n";
}
echo '</urlset>' . "\n";
