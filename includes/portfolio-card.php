<?php
declare(strict_types=1);

/** One portfolio tile. Expects $item (see portfolio-data.php). */
?>
        <div class="portfolio-item" data-category="<?= e($item['category']) ?>">
          <img src="/images/<?= e($item['image']) ?>" alt="<?= e($item['alt']) ?>" loading="lazy">
          <div class="portfolio-overlay">
            <div class="portfolio-category"><?= e($item['label']) ?></div>
            <div class="portfolio-name"><?= e($item['name']) ?></div>
          </div>
          <a href="#" class="portfolio-link" aria-label="View project: <?= e($item['name']) ?>"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
        </div>
