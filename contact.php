<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/bootstrap.php';
require INCLUDES_DIR . '/contact-handler.php';

$csrf = contact_form_token();

// Pre-select the dropdown from ?service=, but only for known values.
$requested = (string) ($_GET['service'] ?? '');
$selectedService = in_array($requested, contact_service_options(), true) ? $requested : '';
$wasSent = ($_GET['sent'] ?? '') === '1';
$hadError = ($_GET['error'] ?? '') === '1';

$page = [
    'title' => 'Contact Us',
    'description' => 'Tell us about your project. Get a free quote or consultation for website development, apps, SEO, advertising, design, video, content and social media.',
    'path' => '/contact',
    'nav' => 'contact',
];

$hero = [
    'eyebrow' => 'Contact Us',
    'h1' => ['Let\'s build something', 'great together.', 'Tell us about it.'],
    'lead' => 'Ready to get started? Book a free consultation or drop us a message and our team will get back to you within a few hours.',
    'crumbs' => [['Home', '/'], ['Contact', null]],
];

require INCLUDES_DIR . '/head.php';
require INCLUDES_DIR . '/header.php';
require INCLUDES_DIR . '/page-hero.php';
?>

  <section id="contact" class="section">
    <div class="container">
      <div class="contact-layout">
        <div class="contact-left">
          <span class="section-label reveal">Get in touch</span>
          <h2 class="section-title reveal reveal-delay-1">We'd love to hear<br>about your project.</h2>
          <p class="section-subtitle reveal reveal-delay-2">Share a few details and we will come back with ideas and a clear, fixed quote — free and with no pressure.</p>

          <div class="contact-info-items reveal reveal-delay-2">
            <div class="contact-info-item">
              <div class="contact-info-icon">📍</div>
              <div>
                <div class="contact-info-label">Headquarters</div>
                <div class="contact-info-value">42 Tech Park, Bandra West,<br>Mumbai, Maharashtra 400050</div>
              </div>
            </div>
            <div class="contact-info-item">
              <div class="contact-info-icon">✉️</div>
              <div>
                <div class="contact-info-label">Email</div>
                <div class="contact-info-value"><a href="mailto:<?= e(CONTACT_EMAIL) ?>"><?= e(CONTACT_EMAIL) ?></a></div>
              </div>
            </div>
            <div class="contact-info-item">
              <div class="contact-info-icon">💬</div>
              <div>
                <div class="contact-info-label">Response Time</div>
                <div class="contact-info-value">Within a few hours, every time</div>
              </div>
            </div>
          </div>

          <div class="contact-social reveal reveal-delay-3">
            <a href="#" class="contact-social-btn" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
            <a href="#" class="contact-social-btn" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
            <a href="#" class="contact-social-btn" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="#" class="contact-social-btn" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
          </div>
        </div>

        <div class="reveal reveal-delay-1">
          <div class="contact-form">
<?php if ($wasSent) : ?>
            <div class="form-success show" role="status">✅ Message sent! We'll be in touch within a few hours.</div>
<?php elseif ($hadError) : ?>
            <div class="form-error show" role="alert">Something went wrong sending your message. Please check the details and try again, or email us directly.</div>
<?php endif; ?>
            <form id="contact-form" action="/api/contact" method="post" novalidate>
              <input type="hidden" name="csrf" value="<?= e($csrf) ?>">
              <div class="form-hp" aria-hidden="true">
                <label for="contact-website">Leave this field empty</label>
                <input type="text" id="contact-website" name="website" tabindex="-1" autocomplete="off">
              </div>

              <div class="form-row">
                <div class="form-group">
                  <label class="form-label" for="contact-name">Your Name</label>
                  <input type="text" id="contact-name" name="name" class="form-input" placeholder="Priya Sharma" required maxlength="100" autocomplete="name">
                  <span class="field-error" data-error-for="name"></span>
                </div>
                <div class="form-group">
                  <label class="form-label" for="contact-email">Email</label>
                  <input type="email" id="contact-email" name="email" class="form-input" placeholder="priya@company.io" required maxlength="254" autocomplete="email">
                  <span class="field-error" data-error-for="email"></span>
                </div>
              </div>

              <div class="form-group">
                <label class="form-label" for="contact-company">Company <span class="form-optional">(optional)</span></label>
                <input type="text" id="contact-company" name="company" class="form-input" placeholder="Your business or brand" maxlength="100" autocomplete="organization">
              </div>

              <div class="form-group">
                <label class="form-label" for="contact-service">What are you looking for?</label>
                <select id="contact-service" name="service" class="form-select">
                  <option value="">Select an option...</option>
<?php foreach (contact_service_options() as $option) : ?>
                  <option value="<?= e($option) ?>"<?= $option === $selectedService ? ' selected' : '' ?>><?= e($option) ?></option>
<?php endforeach; ?>
                </select>
                <span class="field-error" data-error-for="service"></span>
              </div>

              <div class="form-group">
                <label class="form-label" for="contact-message">Tell us about your project</label>
                <textarea id="contact-message" name="message" class="form-textarea" placeholder="What are you trying to achieve? Do you have an existing website or brand? What's your timeline and budget range?" required minlength="10" maxlength="5000"></textarea>
                <span class="field-error" data-error-for="message"></span>
              </div>

              <div class="form-submit">
                <span class="form-note">🔒 No spam. We reply within a few hours.</span>
                <button type="submit" class="btn-primary">
                  <span>Send Message</span>
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </button>
              </div>
            </form>
            <div class="form-success" id="form-success" role="status">✅ Message sent! We'll be in touch within a few hours.</div>
            <div class="form-error" id="form-error" role="alert"></div>
          </div>
        </div>
      </div>
    </div>
  </section>

<?php require INCLUDES_DIR . '/footer.php';
