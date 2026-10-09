<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/bootstrap.php';

$page = [
    'title' => SITE_NAME,
    'full_title' => SITE_NAME . ' — Websites, Apps & Digital Marketing',
    'description' => 'digivyb is a digital studio for website and app development, SEO, advertising, graphic design, video, content writing and social media — everything your brand needs to get found and grow.',
    'path' => '/',
    'nav' => 'home',
    'preloader' => true,
    'schema' => [
        '@context' => 'https://schema.org',
        '@type' => 'Organization',
        'name' => SITE_NAME,
        'url' => site_url('/'),
        'logo' => site_url('/images/digivyb-logo.png'),
        'email' => CONTACT_EMAIL,
    ],
];

$techStack = ['React', 'Next.js', 'React Native', 'Flutter', 'Vue.js', 'TypeScript', 'Node.js', 'Tailwind CSS', 'Figma', 'Shopify', 'WordPress', 'GraphQL'];
$clients = ['NovaTech', 'AxisCloud', 'ZenStack', 'HyperScale', 'SkyForge', 'PulseAPI', 'Craftlayer'];

$testimonials = [
    ['initials' => 'AK', 'name' => 'Amit Khanna', 'role' => 'CTO, NovaTech Solutions', 'text' => "digivyb didn't just build our site, they explained every decision along the way. Our old agency just handed us an invoice."],
    ['initials' => 'SR', 'name' => 'Sneha Reddy', 'role' => 'VP Engineering, ZenStack', 'text' => 'Our checkout page loaded so slowly we were losing carts before checkout even opened. digivyb rebuilt it, and our load time dropped from 9 seconds to under 2.'],
    ['initials' => 'PG', 'name' => 'Priya Gupta', 'role' => 'Co-founder, AxisCloud', 'text' => 'We needed a mobile app fast, without cutting corners on accessibility. digivyb shipped both in ten weeks, and it still runs flawlessly today.'],
    ['initials' => 'VN', 'name' => 'Vikram Nair', 'role' => 'Founder, SkyForge Labs', 'text' => "Launch day traffic tripled overnight and the site didn't blink. That's exactly what you want to hear from your dev team."],
    ['initials' => 'RA', 'name' => 'Rahul Ahuja', 'role' => 'Marketing Lead, HyperScale', 'text' => 'Every agency says they\'ll deliver a fast site. digivyb is the first one that actually did, and kept it that way every month after.'],
    ['initials' => 'MS', 'name' => 'Meera Shah', 'role' => 'Operations Lead, PulseAPI', 'text' => "Our team isn't technical, but digivyb's updates always made sense to everyone in the room. That alone was worth switching agencies for."],
];

$portfolio = array_slice(require INCLUDES_DIR . '/portfolio-data.php', 0, 3);

require INCLUDES_DIR . '/head.php';
require INCLUDES_DIR . '/header.php';
?>

  <!-- ====== HERO ====== -->
  <section id="hero">
    <div class="hero-bg">
      <video
        class="hero-bg-video"
        autoplay
        muted
        loop
        playsinline
        poster="/images/hero-bg.png"
        aria-hidden="true">
        <source src="/videos/hero-bg.mp4" type="video/mp4">
      </video>
      <div class="hero-glow hero-glow-1" aria-hidden="true"></div>
      <div class="hero-glow hero-glow-2" aria-hidden="true"></div>
      <div class="hero-glow hero-glow-3" aria-hidden="true"></div>
      <div class="hero-grid" aria-hidden="true"></div>
      <div class="hero-bg-scrim" aria-hidden="true"></div>
      <div class="hero-bg-gradient"></div>
    </div>

    <div class="container">
      <div class="hero-content">
        <div class="hero-badge hero-animate" style="opacity:0;transform:translateY(20px);transition:all 0.7s ease;">
          <span class="hero-badge-dot"></span>
          From Idea to Launch — 120+ Projects Delivered
        </div>

        <h1 class="hero-title hero-animate" style="opacity:0;transform:translateY(30px);transition:all 0.7s ease 0.12s;">
          Design That Converts.
          <span class="accent-line">Code That Scales.</span>
          <span class="highlight">Support That Lasts.</span>
        </h1>

        <p class="hero-description hero-animate" style="opacity:0;transform:translateY(20px);transition:all 0.7s ease 0.24s;">
          A digital studio for websites, apps, SEO, advertising, design, video and content — everything your brand needs to get found, look credible and grow, under one roof.
        </p>

        <div class="hero-actions hero-animate" style="opacity:0;transform:translateY(20px);transition:all 0.7s ease 0.36s;">
          <a href="/contact" class="hero-btn-primary">
            Get A Free Quote
            <i class="fa-solid fa-arrow-right"></i>
          </a>
          <a href="/work" class="hero-btn-secondary">View Our Work</a>
        </div>

        <div class="hero-stats hero-animate" style="opacity:0;transform:translateY(20px);transition:all 0.7s ease 0.48s;">
          <div class="hero-stat">
            <div class="hero-stat-number"><span data-target="120" data-suffix="+">0+</span></div>
            <div class="hero-stat-label">Projects Delivered</div>
          </div>
          <div class="hero-stat">
            <div class="hero-stat-number"><span data-target="98" data-suffix="%">0%</span></div>
            <div class="hero-stat-label">Client Retention Rate</div>
          </div>
          <div class="hero-stat">
            <div class="hero-stat-number"><span data-target="30" data-suffix="+">0+</span></div>
            <div class="hero-stat-label">Industries Served</div>
          </div>
          <div class="hero-stat">
            <div class="hero-stat-number"><span data-target="8" data-suffix="+">0+</span></div>
            <div class="hero-stat-label">Years of Experience</div>
          </div>
        </div>
      </div>
    </div>

    <a href="#about" class="hero-scroll-indicator">
      <div class="scroll-line"></div>
      Scroll
    </a>
  </section>

  <!-- ====== TECH TICKER ====== -->
  <div class="marquee-section">
    <p class="marquee-label">Technologies we build with</p>
    <div class="marquee-track">
<?php for ($loop = 0; $loop < 2; $loop++) : ?>
<?php foreach ($techStack as $tech) : ?>
      <div class="marquee-item"<?= $loop === 1 ? ' aria-hidden="true"' : '' ?>><span class="marquee-dot"></span> <?= e($tech) ?></div>
<?php endforeach; ?>
<?php endfor; ?>
    </div>
  </div>

  <!-- ====== CLIENTS STRIP ====== -->
  <div class="clients-section">
    <div class="container">
      <p class="clients-label">Trusted by growing businesses at</p>
      <div class="clients-logos">
<?php foreach ($clients as $client) : ?>
        <div class="client-logo"><?= e($client) ?></div>
<?php endforeach; ?>
      </div>
    </div>
  </div>

  <!-- ====== ABOUT TEASER ====== -->
  <section id="about" class="section">
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
            <h2 class="section-title">One team for everything your brand does online.</h2>
          </div>

          <p class="about-description reveal reveal-delay-1">
            Most businesses end up juggling a web developer, a designer, an SEO freelancer and someone for social media — none of whom talk to each other. digivyb brings it together: design and code that look as good as they work, and marketing that actually points people at them.
          </p>

          <div class="about-values reveal reveal-delay-2">
            <div class="about-value">Every project starts with a free consultation, no strings attached</div>
            <div class="about-value">Transparent, fixed-price quotes with no hidden fees, ever</div>
            <div class="about-value">Plain-language updates and reporting — no jargon, no smoke</div>
            <div class="about-value">A small, hands-on team that answers your emails</div>
          </div>

          <div class="reveal reveal-delay-3" style="margin-top: 36px;">
            <a href="/about" class="btn-primary">
              <span>More About Us</span>
              <i class="fa-solid fa-arrow-right"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ====== SERVICES ====== -->
  <section id="services" class="section">
    <div class="container">
      <div class="services-header">
        <div>
          <span class="section-label reveal">Our Services</span>
          <h2 class="section-title reveal reveal-delay-1">Everything you need<br>to launch and grow.</h2>
        </div>
        <p class="section-subtitle reveal reveal-delay-2" style="max-width: 340px;">From your first sketch to your millionth visitor — build it, show it off, and get it found.</p>
      </div>

      <div class="services-grid services-grid-2">
<?php $n = 0; ?>
<?php foreach (services() as $slug => $service) : ?>
        <a href="<?= e(service_url($slug)) ?>" class="service-card service-card-link reveal reveal-delay-<?= e((string) ($n % 2)) ?>">
          <div class="service-icon"><i class="fa-solid <?= e($service['icon']) ?>" aria-hidden="true"></i></div>
          <span class="service-number"><?= e(sprintf('%02d', ++$n)) ?></span>
          <h3 class="service-name"><?= e($service['name']) ?></h3>
          <p class="service-desc"><?= e($service['short']) ?></p>
          <div class="service-tags">
<?php foreach (array_slice($service['offerings'], 0, 4) as $offering) : ?>
            <span class="service-tag"><?= e($offering['name']) ?></span>
<?php endforeach; ?>
          </div>
          <span class="service-more">Explore <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></span>
        </a>
<?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- ====== PROCESS ====== -->
  <div class="process-strip">
    <div class="container">
      <div class="process-header reveal">
        <span class="section-label">How It Works</span>
        <h2 class="section-title" style="color: var(--color-text-primary);">From first idea<br>to launch day</h2>
      </div>
      <div class="process-steps">
        <div class="process-step reveal">
          <div class="process-step-num">01</div>
          <h3 class="process-step-title">Discover</h3>
          <p class="process-step-desc">We start with a call to understand your business, your customers, and what success actually looks like for this project.</p>
        </div>
        <div class="process-step reveal reveal-delay-1">
          <div class="process-step-num">02</div>
          <h3 class="process-step-title">Plan &amp; Design</h3>
          <p class="process-step-desc">Strategy, wireframes and creative concepts you can react to and revise — no surprises once the work begins.</p>
        </div>
        <div class="process-step reveal reveal-delay-2">
          <div class="process-step-num">03</div>
          <h3 class="process-step-title">Build &amp; Create</h3>
          <p class="process-step-desc">Our team builds, writes, designs and tests, with regular check-ins so you always know where things stand.</p>
        </div>
        <div class="process-step reveal reveal-delay-3">
          <div class="process-step-num">04</div>
          <h3 class="process-step-title">Launch &amp; Grow</h3>
          <p class="process-step-desc">We go live together, then stay on — reporting, refining and shipping improvements long after launch.</p>
        </div>
      </div>
    </div>
  </div>

  <!-- ====== WORK TEASER ====== -->
  <section id="portfolio" class="section">
    <div class="container">
      <div class="portfolio-header">
        <div>
          <span class="section-label reveal">Selected Work</span>
          <h2 class="section-title reveal reveal-delay-1">Work we're proud<br>to show off.</h2>
        </div>
        <a href="/work" class="btn-outline reveal reveal-delay-2">View all work <i class="fa-solid fa-arrow-right"></i></a>
      </div>

      <div class="portfolio-grid reveal reveal-delay-1">
<?php foreach ($portfolio as $item) : ?>
<?php require INCLUDES_DIR . '/portfolio-card.php'; ?>
<?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- ====== TESTIMONIALS ====== -->
  <section id="testimonials" class="section" style="padding-bottom: 60px;">
    <div class="container">
      <div class="testimonials-header reveal">
        <span class="section-label">Testimonials</span>
        <h2 class="section-title">Teams that love working with us.</h2>
        <p class="section-subtitle">Hear from the founders and teams we've worked with.</p>
      </div>
    </div>

    <div class="testimonials-track-wrap">
      <div class="testimonials-track">
<?php for ($loop = 0; $loop < 2; $loop++) : ?>
<?php foreach ($testimonials as $t) : ?>
        <div class="testimonial-card"<?= $loop === 1 ? ' aria-hidden="true"' : '' ?>>
          <div class="testimonial-stars">★★★★★</div>
          <p class="testimonial-text">"<?= e($t['text']) ?>"</p>
          <div class="testimonial-author">
            <div class="testimonial-avatar"><?= e($t['initials']) ?></div>
            <div>
              <div class="testimonial-author-name"><?= e($t['name']) ?></div>
              <div class="testimonial-author-title"><?= e($t['role']) ?></div>
            </div>
          </div>
        </div>
<?php endforeach; ?>
<?php endfor; ?>
      </div>
    </div>
  </section>

<?php
require INCLUDES_DIR . '/cta-band.php';
require INCLUDES_DIR . '/footer.php';
