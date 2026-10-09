<?php
declare(strict_types=1);

/**
 * Opens <body>: cursor, canvas, optional preloader, header and mobile menu.
 * Expects $page: nav (active key), preloader? (bool).
 */

$activeNav = (string) ($page['nav'] ?? '');
$showPreloader = !empty($page['preloader']);

$navItems = [
    ['key' => 'home', 'label' => 'Home', 'href' => '/'],
    ['key' => 'about', 'label' => 'About Us', 'href' => '/about'],
    ['key' => 'services', 'label' => 'Services', 'href' => '/services/', 'children' => services()],
    ['key' => 'work', 'label' => 'Work', 'href' => '/work'],
    ['key' => 'contact', 'label' => 'Contact', 'href' => '/contact'],
];
?>
<body<?= $showPreloader ? ' class="preloader-active"' : '' ?>>

  <a href="#main" class="skip-link">Skip to content</a>

  <div id="cursor"></div>
  <div id="cursor-follower"></div>

  <canvas id="particle-canvas" aria-hidden="true"></canvas>

<?php if ($showPreloader) : ?>
  <div id="preloader">
    <div class="preloader-logo">Tuning Your Vybe</div>
    <div class="preloader-letters">
<?php foreach (str_split('DIGIVYB') as $letter) : ?>
      <span class="preloader-letter"><?= e($letter) ?></span>
<?php endforeach; ?>
    </div>
    <div class="preloader-bar-wrap">
      <div class="preloader-bar">
        <div class="preloader-bar-fill"></div>
      </div>
      <div class="preloader-percent">0%</div>
    </div>
  </div>
<?php endif; ?>

  <header id="header" class="hero-state">
    <div class="container">
      <div class="header-inner">
        <a href="/" class="header-logo" aria-label="<?= e(SITE_NAME) ?> home">
          <img src="/images/digivyb-logo.png" alt="<?= e(SITE_NAME) ?>" class="logo-image">
        </a>

        <nav class="header-nav" aria-label="Main navigation">
<?php foreach ($navItems as $navItem) : ?>
<?php $isActive = $navItem['key'] === $activeNav; ?>
<?php if (!empty($navItem['children'])) : ?>
          <div class="nav-item has-dropdown">
            <a href="<?= e($navItem['href']) ?>"<?= $isActive ? ' class="active" aria-current="page"' : '' ?> aria-haspopup="true"><?= e($navItem['label']) ?> <i class="fa-solid fa-chevron-down nav-caret" aria-hidden="true"></i></a>
            <div class="nav-dropdown">
<?php foreach ($navItem['children'] as $childSlug => $child) : ?>
              <a href="<?= e(service_url($childSlug)) ?>">
                <i class="fa-solid <?= e($child['icon']) ?>" aria-hidden="true"></i>
                <span><?= e($child['name']) ?></span>
              </a>
<?php endforeach; ?>
              <a href="/services/" class="nav-dropdown-all">View all services <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
            </div>
          </div>
<?php else : ?>
          <a href="<?= e($navItem['href']) ?>"<?= $isActive ? ' class="active" aria-current="page"' : '' ?>><?= e($navItem['label']) ?></a>
<?php endif; ?>
<?php endforeach; ?>
        </nav>

        <div class="header-cta">
          <a href="/contact" class="btn-outline">Get A Free Quote</a>
          <button class="theme-toggle-btn" id="theme-toggle-btn" aria-label="Toggle theme" title="Toggle light/dark mode">
            <i class="fa-solid fa-moon" id="theme-icon"></i>
          </button>
          <button class="hamburger-btn" id="hamburger-btn" aria-label="Open Menu" aria-expanded="false" aria-controls="menu-overlay">
            <span></span>
            <span></span>
            <span></span>
          </button>
        </div>
      </div>
    </div>
  </header>

  <div id="menu-overlay">
    <div class="menu-overlay-header">
      <div class="menu-overlay-logo">
        <img src="/images/digivyb-logo.png" alt="<?= e(SITE_NAME) ?>" class="logo-image">
      </div>
      <button class="menu-close-btn" id="menu-close-btn" aria-label="Close Menu">✕</button>
    </div>
    <nav class="menu-overlay-nav" aria-label="Mobile navigation">
<?php foreach ($navItems as $navItem) : ?>
      <a href="<?= e($navItem['href']) ?>"><?= e($navItem['label']) ?> <i class="fa-solid fa-arrow-right"></i></a>
<?php if (!empty($navItem['children'])) : ?>
<?php foreach ($navItem['children'] as $childSlug => $child) : ?>
      <a href="<?= e(service_url($childSlug)) ?>" class="menu-sub-link"><?= e($child['name']) ?></a>
<?php endforeach; ?>
<?php endif; ?>
<?php endforeach; ?>
    </nav>
    <div class="menu-overlay-footer">
      <div class="menu-overlay-social">
        <a href="#">LinkedIn</a>
        <a href="#">Instagram</a>
        <a href="#">Facebook</a>
        <a href="#">YouTube</a>
      </div>
    </div>
  </div>

  <main id="main">
