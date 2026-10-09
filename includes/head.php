<?php
declare(strict_types=1);

/**
 * Opens <html> and <head>. Expects $page:
 *  title, description, path (canonical path), schema? (extra JSON-LD array)
 */

$pageTitle = (string) ($page['title'] ?? SITE_NAME);
$fullTitle = (string) ($page['full_title'] ?? ($pageTitle . ' | ' . SITE_NAME));
$pageDescription = (string) ($page['description'] ?? '');
$canonical = site_url((string) ($page['path'] ?? '/'));
$ogImage = site_url('/images/digivyb-logo.png');
$robots = ALLOW_INDEXING ? (string) ($page['robots'] ?? 'index, follow') : 'noindex, nofollow';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= e($fullTitle) ?></title>
  <meta name="description" content="<?= e($pageDescription) ?>">
  <meta name="author" content="<?= e(SITE_NAME) ?>">
  <meta name="robots" content="<?= e($robots) ?>">
  <link rel="canonical" href="<?= e($canonical) ?>">

  <meta property="og:site_name" content="<?= e(SITE_NAME) ?>">
  <meta property="og:title" content="<?= e($fullTitle) ?>">
  <meta property="og:description" content="<?= e($pageDescription) ?>">
  <meta property="og:type" content="website">
  <meta property="og:url" content="<?= e($canonical) ?>">
  <meta property="og:image" content="<?= e($ogImage) ?>">
  <meta name="twitter:card" content="summary_large_image">

  <link rel="icon" type="image/png" href="/images/digivyb-icon.png">
  <link rel="apple-touch-icon" href="/images/digivyb-icon.png">

  <link rel="stylesheet" href="<?= e(asset('css/style.css')) ?>">
  <link rel="stylesheet" href="<?= e(asset('css/extras.css')) ?>">
  <link rel="stylesheet" href="<?= e(asset('css/hero-dark.css')) ?>">
  <link rel="stylesheet" href="<?= e(asset('css/pages.css')) ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <script>
    // Theme switcher is hidden for now — force light mode.
    document.documentElement.setAttribute('data-theme', 'light');
    document.documentElement.classList.add('js');
    // The intro animation only plays once per browser session.
    try { if (sessionStorage.getItem('dv-intro')) document.documentElement.classList.add('no-intro'); } catch (err) {}
  </script>
<?php if (!empty($page['schema'])) : ?>
  <script type="application/ld+json"><?= json_encode($page['schema'], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP) ?></script>
<?php endif; ?>
</head>
