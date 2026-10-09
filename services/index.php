<?php
declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/bootstrap.php';

$page = [
    'title' => 'Services',
    'description' => 'Website and app development, SEO and advertising, branding and video, content writing and social media — all the digital services your business needs, from one team.',
    'path' => '/services/',
    'nav' => 'services',
];

$hero = [
    'eyebrow' => 'Our Services',
    'h1' => ['Everything your brand', 'needs to get found', 'and grow.'],
    'lead' => 'Build it, make it look the part, get it found and keep people engaged. Four connected service areas, one team that talks to itself.',
    'crumbs' => [['Home', '/'], ['Services', null]],
    'actions' => [
        ['Get A Free Quote', '/contact', 'primary'],
    ],
];

require INCLUDES_DIR . '/head.php';
require INCLUDES_DIR . '/header.php';
require INCLUDES_DIR . '/page-hero.php';
?>

  <section class="section">
    <div class="container">
      <div class="hub-list">
<?php $n = 0; ?>
<?php foreach (services() as $slug => $service) : ?>
        <article class="hub-card reveal">
          <div class="hub-card-head">
            <span class="hub-icon"><i class="fa-solid <?= e($service['icon']) ?>" aria-hidden="true"></i></span>
            <span class="service-number"><?= e(sprintf('%02d', ++$n)) ?></span>
          </div>
          <div class="hub-card-body">
            <h2 class="hub-title"><?= e($service['name']) ?></h2>
            <p class="hub-desc"><?= e($service['lead']) ?></p>
            <ul class="hub-offerings">
<?php foreach ($service['offerings'] as $offering) : ?>
              <li><i class="fa-solid fa-check" aria-hidden="true"></i><?= e($offering['name']) ?></li>
<?php endforeach; ?>
            </ul>
            <a href="<?= e(service_url($slug)) ?>" class="btn-primary">
              <span>Explore <?= e($service['name']) ?></span>
              <i class="fa-solid fa-arrow-right"></i>
            </a>
          </div>
        </article>
<?php endforeach; ?>
      </div>
    </div>
  </section>

<?php
$ctaHeading = 'Not sure what you need?';
$ctaText = 'Tell us about your business and goals. We will recommend where to start — even if that is just one thing.';
require INCLUDES_DIR . '/cta-band.php';
require INCLUDES_DIR . '/footer.php';
