<?php
declare(strict_types=1);

/**
 * Renders one service page. The calling stub sets $slug (a key of services()).
 */

$all = services();
if (!isset($all[$slug])) {
    http_response_code(404);
    require ROOT_DIR . '/404.php';
    exit;
}
$service = $all[$slug];

$faqSchema = [
    '@context' => 'https://schema.org',
    '@type' => 'FAQPage',
    'mainEntity' => array_map(
        static fn (array $faq): array => [
            '@type' => 'Question',
            'name' => $faq['q'],
            'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq['a']],
        ],
        $service['faqs']
    ),
];

$page = [
    'title' => $service['title'],
    'description' => $service['description'],
    'path' => service_url($slug),
    'nav' => 'services',
    'schema' => $faqSchema,
];

$hero = [
    'eyebrow' => $service['eyebrow'],
    'h1' => $service['h1'],
    'lead' => $service['lead'],
    'crumbs' => [['Home', '/'], ['Services', '/services/'], [$service['name'], null]],
    'actions' => [
        ['Get A Free Quote', '/contact?service=' . rawurlencode($service['name']), 'primary'],
        ['See Our Work', '/work', 'secondary'],
    ],
];

$ctaHeading = 'Ready to talk about ' . strtolower($service['eyebrow']) . '?';
$ctaService = $service['name'];

require INCLUDES_DIR . '/head.php';
require INCLUDES_DIR . '/header.php';
require INCLUDES_DIR . '/page-hero.php';
?>

  <section class="section service-offerings">
    <div class="container">
      <div class="services-header">
        <div>
          <span class="section-label reveal">What we do</span>
          <h2 class="section-title reveal reveal-delay-1">Everything under<br><?= e($service['name']) ?>.</h2>
        </div>
        <p class="section-subtitle reveal reveal-delay-2" style="max-width: 360px;">Use us for one service or several. They work best together, and we keep them joined up.</p>
      </div>

      <div class="services-grid">
<?php foreach ($service['offerings'] as $i => $offering) : ?>
        <div class="service-card reveal reveal-delay-<?= e((string) ($i % 3)) ?>">
          <div class="service-icon"><i class="fa-solid <?= e($offering['icon']) ?>" aria-hidden="true"></i></div>
          <span class="service-number"><?= e(sprintf('%02d', $i + 1)) ?></span>
          <h3 class="service-name"><?= e($offering['name']) ?></h3>
          <p class="service-desc"><?= e($offering['desc']) ?></p>
          <div class="service-tags">
<?php foreach ($offering['tags'] as $tag) : ?>
            <span class="service-tag"><?= e($tag) ?></span>
<?php endforeach; ?>
          </div>
        </div>
<?php endforeach; ?>
      </div>
    </div>
  </section>

  <div class="process-strip">
    <div class="container">
      <div class="process-header reveal">
        <span class="section-label">How it works</span>
        <h2 class="section-title" style="color: var(--color-text-primary);">A clear process,<br>no surprises.</h2>
      </div>
      <div class="process-steps">
<?php foreach ($service['process'] as $i => $step) : ?>
        <div class="process-step reveal reveal-delay-<?= e((string) $i) ?>">
          <div class="process-step-num"><?= e(sprintf('%02d', $i + 1)) ?></div>
          <h3 class="process-step-title"><?= e($step['title']) ?></h3>
          <p class="process-step-desc"><?= e($step['desc']) ?></p>
        </div>
<?php endforeach; ?>
      </div>
    </div>
  </div>

  <section class="section">
    <div class="container">
      <div class="split-block">
        <div class="reveal">
          <span class="section-label">What you get</span>
          <h2 class="section-title">Clear deliverables,<br>every time.</h2>
          <p class="section-subtitle">No vague retainers or mystery invoices. Here is what working with us looks like.</p>
        </div>
        <ul class="check-list reveal reveal-delay-1">
<?php foreach ($service['deliverables'] as $item) : ?>
          <li><i class="fa-solid fa-check" aria-hidden="true"></i><span><?= e($item) ?></span></li>
<?php endforeach; ?>
        </ul>
      </div>
    </div>
  </section>

  <section class="section faq-section">
    <div class="container">
      <div class="faq-layout">
        <div class="reveal">
          <span class="section-label">FAQ</span>
          <h2 class="section-title">Questions we<br>get asked a lot.</h2>
          <p class="section-subtitle">Not seeing yours? <a href="/contact" class="text-link">Ask us directly</a>.</p>
        </div>
        <div class="faq-list reveal reveal-delay-1">
<?php foreach ($service['faqs'] as $faq) : ?>
          <details class="faq-item">
            <summary><?= e($faq['q']) ?></summary>
            <p><?= e($faq['a']) ?></p>
          </details>
<?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  <section class="section related-services">
    <div class="container">
      <div class="reveal">
        <span class="section-label">Works well together</span>
        <h2 class="section-title">Related services</h2>
      </div>
      <div class="related-grid">
<?php foreach ($service['related'] as $i => $relatedSlug) : ?>
<?php $related = $all[$relatedSlug]; ?>
        <a href="<?= e(service_url($relatedSlug)) ?>" class="related-card reveal reveal-delay-<?= e((string) $i) ?>">
          <span class="related-icon"><i class="fa-solid <?= e($related['icon']) ?>" aria-hidden="true"></i></span>
          <span class="related-body">
            <strong><?= e($related['name']) ?></strong>
            <span><?= e($related['short']) ?></span>
          </span>
          <i class="fa-solid fa-arrow-right related-arrow" aria-hidden="true"></i>
        </a>
<?php endforeach; ?>
      </div>
    </div>
  </section>

<?php
require INCLUDES_DIR . '/cta-band.php';
require INCLUDES_DIR . '/footer.php';
