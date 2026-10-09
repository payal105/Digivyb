<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/bootstrap.php';

$page = [
    'title' => 'About Us',
    'description' => 'Meet the digivyb team — a small, hands-on digital studio combining design, development, SEO, advertising and content under one roof.',
    'path' => '/about',
    'nav' => 'about',
];

$hero = [
    'eyebrow' => 'About digivyb',
    'h1' => ['A small team that', 'treats your brand', 'like our own.'],
    'lead' => 'digivyb started with a simple frustration: agencies that hide behind jargon, hand over work and disappear. We built the studio we wished we could hire — clear, hands-on and invested in your results.',
    'crumbs' => [['Home', '/'], ['About Us', null]],
];

$beliefs = [
    ['icon' => 'fa-comments', 'title' => 'Plain talk', 'text' => 'We explain what we are doing and why, in language you do not need a glossary for. If something is not working, we tell you.'],
    ['icon' => 'fa-puzzle-piece', 'title' => 'Joined-up work', 'text' => 'Design, code, SEO, ads and content from one team means each piece supports the others instead of pulling in different directions.'],
    ['icon' => 'fa-bullseye', 'title' => 'Results over vanity', 'text' => 'We care about enquiries, sales and bookings — the numbers that pay your bills — not follower counts or impressive-looking dashboards.'],
    ['icon' => 'fa-handshake', 'title' => 'Long-term thinking', 'text' => 'We would rather build something that serves you for years than land a project and vanish. Many clients stay on with us after launch.'],
];

require INCLUDES_DIR . '/head.php';
require INCLUDES_DIR . '/header.php';
require INCLUDES_DIR . '/page-hero.php';
?>

  <section class="section">
    <div class="container">
      <div class="about-grid">
        <div class="about-image-wrap reveal">
          <img src="/images/about.png" alt="digivyb project dashboard" class="about-image-main" loading="lazy">
          <div class="about-image-badge">
            <div class="about-badge-icon">🎨</div>
            <div class="about-badge-text">
              <strong><span data-target="45" data-suffix="+">45+</span></strong>
              <span>Happy Clients</span>
            </div>
          </div>
        </div>

        <div class="about-content">
          <div class="reveal">
            <span class="section-label">Why digivyb?</span>
            <h2 class="section-title">Design and code you can actually be proud of.</h2>
          </div>

          <p class="about-description reveal reveal-delay-1">
            Every pixel, every page load, every "does this actually work on mobile" matters to us as much as it matters to you. We built digivyb around a simple idea: design that looks as good as it works, code that is built to last, and marketing that puts both in front of the right people.
          </p>

          <div class="about-stats reveal reveal-delay-2">
            <div class="about-stat">
              <div class="about-stat-number" data-target="120" data-suffix="+">120+</div>
              <div class="about-stat-label">Projects Delivered</div>
            </div>
            <div class="about-stat">
              <div class="about-stat-number" data-target="45" data-suffix="+">45+</div>
              <div class="about-stat-label">Businesses Served</div>
            </div>
            <div class="about-stat">
              <div class="about-stat-number" data-target="2" data-suffix="">2</div>
              <div class="about-stat-label">Founders, Hands-On</div>
            </div>
            <div class="about-stat">
              <div class="about-stat-number" data-target="8" data-suffix="+">8+</div>
              <div class="about-stat-label">Years Combined Experience</div>
            </div>
          </div>

          <div class="about-values reveal reveal-delay-3">
            <div class="about-value">Every project starts with a free consultation, no strings attached</div>
            <div class="about-value">Accessible by default, built to modern web standards</div>
            <div class="about-value">Transparent, fixed-price quotes with no hidden fees, ever</div>
            <div class="about-value">Built by a team that got tired of agencies hiding behind jargon</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section beliefs-section">
    <div class="container">
      <div class="team-header reveal">
        <span class="section-label">How we work</span>
        <h2 class="section-title">What you can expect<br>from us.</h2>
      </div>
      <div class="beliefs-grid">
<?php foreach ($beliefs as $i => $belief) : ?>
        <div class="belief-card reveal reveal-delay-<?= e((string) ($i % 4)) ?>">
          <span class="belief-icon"><i class="fa-solid <?= e($belief['icon']) ?>" aria-hidden="true"></i></span>
          <h3><?= e($belief['title']) ?></h3>
          <p><?= e($belief['text']) ?></p>
        </div>
<?php endforeach; ?>
      </div>
    </div>
  </section>

  <section id="team" class="section">
    <div class="container">
      <div class="team-header reveal">
        <span class="section-label">Our Team</span>
        <h2 class="section-title">The people behind<br>the work.</h2>
        <p class="section-subtitle" style="margin: 16px auto 0;">Designers, developers and marketers who got tired of watching great ideas die in bad handoffs.</p>
      </div>

      <div class="team-grid">
        <div class="team-card reveal">
          <div class="team-card-image">
            <img src="/images/team-1.png" alt="Payal Sharma - CEO & Co-founder" loading="lazy">
            <div class="team-card-overlay">
              <div class="team-name">Payal Sharma</div>
              <div class="team-role">CEO &amp; Co-founder</div>
            </div>
            <div class="team-card-social">
              <a href="#" class="team-social-btn" aria-label="Payal on LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
            </div>
          </div>
        </div>

        <div class="team-card reveal reveal-delay-1">
          <div class="team-card-image">
            <img src="/images/team-2.png" alt="Arjun Mehta - CTO" loading="lazy">
            <div class="team-card-overlay">
              <div class="team-name">Arjun Mehta</div>
              <div class="team-role">CTO &amp; Co-founder</div>
            </div>
            <div class="team-card-social">
              <a href="#" class="team-social-btn" aria-label="Arjun on LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
              <a href="#" class="team-social-btn" aria-label="Arjun on GitHub"><i class="fa-brands fa-github"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

<?php
$ctaHeading = 'Want to work with us?';
require INCLUDES_DIR . '/cta-band.php';
require INCLUDES_DIR . '/footer.php';
