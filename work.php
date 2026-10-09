<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/bootstrap.php';

$page = [
    'title' => 'Our Work',
    'description' => 'A selection of websites, e-commerce stores, web apps, mobile apps and brand work from the Digivyb studio.',
    'path' => '/work',
    'nav' => 'work',
];

$hero = [
    'eyebrow' => 'Our Work',
    'h1' => ['Work we\'re proud', 'to put our name', 'on.'],
    'lead' => 'A selection of websites, stores, apps and brand projects. Every one started with a conversation about what the business really needed.',
    'crumbs' => [['Home', '/'], ['Our Work', null]],
];

$portfolio = require INCLUDES_DIR . '/portfolio-data.php';

require INCLUDES_DIR . '/head.php';
require INCLUDES_DIR . '/header.php';
require INCLUDES_DIR . '/page-hero.php';
?>

  <section id="portfolio" class="section">
    <div class="container">
      <div class="portfolio-header">
        <div class="portfolio-filter reveal" role="group" aria-label="Filter projects">
          <button class="filter-btn active" data-filter="all">All</button>
          <button class="filter-btn" data-filter="web">Websites</button>
          <button class="filter-btn" data-filter="ecommerce">E-Commerce</button>
          <button class="filter-btn" data-filter="design">Branding &amp; UI</button>
          <button class="filter-btn" data-filter="mobile">Mobile Apps</button>
        </div>
      </div>

      <div class="portfolio-grid reveal reveal-delay-1">
<?php foreach ($portfolio as $item) : ?>
<?php require INCLUDES_DIR . '/portfolio-card.php'; ?>
<?php endforeach; ?>
      </div>
    </div>
  </section>

<?php
$ctaHeading = 'Have a project in mind?';
require INCLUDES_DIR . '/cta-band.php';
require INCLUDES_DIR . '/footer.php';
