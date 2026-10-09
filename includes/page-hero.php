<?php
declare(strict_types=1);

/**
 * Compact dark hero for inner pages. Expects $hero:
 *  eyebrow, h1 (string | [line, accentLine, highlightLine]), lead,
 *  crumbs? [[label, href|null], ...], actions? [[label, href, 'primary'|'secondary'], ...]
 * It keeps id="hero" so the header's dark "over-hero" state works here too.
 */

$h1 = $hero['h1'] ?? '';
$crumbs = $hero['crumbs'] ?? [];
$actions = $hero['actions'] ?? [];
?>
  <section id="hero" class="page-hero">
    <div class="hero-bg" aria-hidden="true">
      <div class="hero-glow hero-glow-1"></div>
      <div class="hero-glow hero-glow-2"></div>
      <div class="hero-grid"></div>
    </div>

    <div class="container">
      <div class="hero-content">
<?php if ($crumbs) : ?>
        <nav class="breadcrumbs hero-animate" aria-label="Breadcrumb">
<?php foreach ($crumbs as $i => $crumb) : ?>
<?php if ($i > 0) : ?><span aria-hidden="true">/</span><?php endif; ?>
<?php if (!empty($crumb[1])) : ?>
          <a href="<?= e($crumb[1]) ?>"><?= e($crumb[0]) ?></a>
<?php else : ?>
          <span aria-current="page"><?= e($crumb[0]) ?></span>
<?php endif; ?>
<?php endforeach; ?>
        </nav>
<?php endif; ?>

<?php if (!empty($hero['eyebrow'])) : ?>
        <div class="hero-badge hero-animate">
          <span class="hero-badge-dot"></span>
          <?= e($hero['eyebrow']) ?>
        </div>
<?php endif; ?>

        <h1 class="hero-title hero-animate">
<?php if (is_array($h1)) : ?>
          <?= e($h1[0]) ?>
          <span class="accent-line"><?= e($h1[1]) ?></span>
          <span class="highlight"><?= e($h1[2]) ?></span>
<?php else : ?>
          <?= e($h1) ?>
<?php endif; ?>
        </h1>

<?php if (!empty($hero['lead'])) : ?>
        <p class="hero-description hero-animate"><?= e($hero['lead']) ?></p>
<?php endif; ?>

<?php if ($actions) : ?>
        <div class="hero-actions hero-animate">
<?php foreach ($actions as $action) : ?>
<?php if (($action[2] ?? 'primary') === 'primary') : ?>
          <a href="<?= e($action[1]) ?>" class="hero-btn-primary"><?= e($action[0]) ?> <i class="fa-solid fa-arrow-right"></i></a>
<?php else : ?>
          <a href="<?= e($action[1]) ?>" class="hero-btn-secondary"><?= e($action[0]) ?></a>
<?php endif; ?>
<?php endforeach; ?>
        </div>
<?php endif; ?>
      </div>
    </div>
  </section>
