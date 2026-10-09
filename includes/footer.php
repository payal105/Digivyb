<?php
declare(strict_types=1);

/** Closes the page: footer, back-to-top, scripts. */
?>

  </main>

  <footer id="footer">
    <div class="container">
      <div class="footer-top">
        <div>
          <a href="/" class="footer-brand-logo" aria-label="<?= e(SITE_NAME) ?> home">
            <img src="/images/digivyb-logo.png" alt="<?= e(SITE_NAME) ?>" class="logo-image">
          </a>
          <p class="footer-brand-desc">A digital studio for websites, apps, SEO, advertising, design, video and content — everything your brand needs to get found and grow.</p>
          <div class="footer-social">
            <a href="#" class="footer-social-btn" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
            <a href="#" class="footer-social-btn" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
            <a href="#" class="footer-social-btn" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="#" class="footer-social-btn" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
          </div>
        </div>

        <div>
          <h4 class="footer-col-title">Services</h4>
          <ul class="footer-links">
<?php foreach (services() as $footerSlug => $footerService) : ?>
            <li><a href="<?= e(service_url($footerSlug)) ?>"><?= e($footerService['name']) ?></a></li>
<?php endforeach; ?>
          </ul>
        </div>

        <div>
          <h4 class="footer-col-title">Company</h4>
          <ul class="footer-links">
            <li><a href="/about">About Us</a></li>
            <li><a href="/work">Our Work</a></li>
            <li><a href="/contact">Contact</a></li>
            <li><a href="mailto:<?= e(CONTACT_EMAIL) ?>"><?= e(CONTACT_EMAIL) ?></a></li>
          </ul>
        </div>

        <div>
          <h4 class="footer-col-title">Let's talk</h4>
          <p class="footer-brand-desc">Tell us what you are working on. We reply within a few hours.</p>
          <div style="margin-top: 20px;">
            <a href="/contact" class="btn-primary" style="font-size:13px; padding: 11px 20px;">
              <span>Get A Free Quote</span>
            </a>
          </div>
        </div>
      </div>

      <div class="footer-bottom">
        <p class="footer-copyright">© <?= e(date('Y')) ?> <span><?= e(SITE_NAME) ?></span>. All rights reserved. Built with 🎧 in Mumbai.</p>
        <div class="footer-bottom-links">
          <a href="#">Privacy Policy</a>
          <a href="#">Terms of Service</a>
        </div>
      </div>
    </div>
  </footer>

  <button id="back-to-top" aria-label="Back to top">
    <i class="fa-solid fa-arrow-up"></i>
  </button>

  <script src="<?= e(asset('js/main.js')) ?>"></script>
</body>
</html>
