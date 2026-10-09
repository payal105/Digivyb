<?php
declare(strict_types=1);

/**
 * Closing call-to-action band. Optional $ctaHeading / $ctaText / $ctaService
 * (service name used to pre-select the contact form dropdown).
 */

$ctaHeading = $ctaHeading ?? "Let's build something great together.";
$ctaText = $ctaText ?? 'Tell us what you are working on and we will come back with ideas and a clear quote — free, and with no pressure.';
$ctaHref = '/contact' . (isset($ctaService) ? '?service=' . rawurlencode((string) $ctaService) : '');
?>
  <section class="cta-band">
    <div class="container">
      <div class="cta-band-inner reveal">
        <div>
          <h2 class="cta-band-title"><?= e($ctaHeading) ?></h2>
          <p class="cta-band-text"><?= e($ctaText) ?></p>
        </div>
        <a href="<?= e($ctaHref) ?>" class="btn-primary">
          <span>Get A Free Quote</span>
          <i class="fa-solid fa-arrow-right"></i>
        </a>
      </div>
    </div>
  </section>
