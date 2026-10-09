<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/bootstrap.php';

header('Content-Type: text/plain; charset=UTF-8');
echo "User-agent: *\n";
echo "Allow: /\n";
echo "Disallow: /api/\n\n";
echo 'Sitemap: ' . site_url('/sitemap.xml') . "\n";
