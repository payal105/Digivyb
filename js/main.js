/* =========================================================
   DIGIVYB — Main JavaScript
   All interactive features, animations, UI logic
   ========================================================= */

document.addEventListener('DOMContentLoaded', () => {

  /* =============================================
     1. PRELOADER
  ============================================= */
  const preloader = document.getElementById('preloader');
  const letters = document.querySelectorAll('.preloader-letter');

  // Stagger letter animations
  letters.forEach((letter, i) => {
    letter.style.animationDelay = `${i * 0.08}s`;
  });

  // Count up animation
  const percentEl = document.querySelector('.preloader-percent');
  let count = 0;
  const countInterval = setInterval(() => {
    count = Math.min(count + Math.floor(Math.random() * 8) + 2, 100);
    if (percentEl) percentEl.textContent = count + '%';
    if (count >= 100) clearInterval(countInterval);
  }, 60);

  // Hide preloader after animation
  window.addEventListener('load', () => {
    setTimeout(() => {
      preloader?.classList.add('hidden');
      document.body.classList.remove('preloader-active');
      animateHeroEntrance();
    }, 2200);
  });

  // Fallback in case window.load is slow
  setTimeout(() => {
    preloader?.classList.add('hidden');
    document.body.classList.remove('preloader-active');
  }, 3500);


  /* =============================================
     2. CUSTOM CURSOR
  ============================================= */
  const cursor = document.getElementById('cursor');
  const cursorFollower = document.getElementById('cursor-follower');
  let cursorX = 0, cursorY = 0;
  let followerX = 0, followerY = 0;

  if (cursor && cursorFollower && window.innerWidth > 900) {
    document.addEventListener('mousemove', (e) => {
      cursorX = e.clientX;
      cursorY = e.clientY;
      cursor.style.left = cursorX + 'px';
      cursor.style.top = cursorY + 'px';
    });

    function animateCursor() {
      followerX += (cursorX - followerX) * 0.12;
      followerY += (cursorY - followerY) * 0.12;
      cursorFollower.style.left = followerX + 'px';
      cursorFollower.style.top = followerY + 'px';
      requestAnimationFrame(animateCursor);
    }
    animateCursor();

    // Hover states for interactive elements
    const hoverEls = document.querySelectorAll('a, button, .portfolio-item, .service-card, .team-card, .blog-card, .filter-btn, .faq-question');
    hoverEls.forEach(el => {
      el.addEventListener('mouseenter', () => {
        cursor.classList.add('cursor-hover');
        cursorFollower.classList.add('cursor-hover');
      });
      el.addEventListener('mouseleave', () => {
        cursor.classList.remove('cursor-hover');
        cursorFollower.classList.remove('cursor-hover');
      });
    });
  }


  /* =============================================
     3. HEADER SCROLL BEHAVIOR
  ============================================= */
  const header = document.getElementById('header');
  const heroSection = document.getElementById('hero');

  let lastScroll = 0;
  window.addEventListener('scroll', () => {
    const scrollY = window.scrollY;

    // Scrolled state
    if (scrollY > 60) {
      header?.classList.add('scrolled');
      header?.classList.remove('hero-state');
    } else {
      header?.classList.remove('scrolled');
      header?.classList.add('hero-state');
    }

    // Active nav link
    updateActiveNavLink();

    // Back to top
    const backToTop = document.getElementById('back-to-top');
    if (scrollY > 400) {
      backToTop?.classList.add('visible');
    } else {
      backToTop?.classList.remove('visible');
    }

    lastScroll = scrollY;
  });

  // Initialize hero state
  if (window.scrollY <= 60) {
    header?.classList.add('hero-state');
  }


  /* =============================================
     4. ACTIVE NAV LINK ON SCROLL
  ============================================= */
  const navLinks = document.querySelectorAll('.header-nav a, .menu-overlay-nav a');
  const sections = document.querySelectorAll('section[id]');

  function updateActiveNavLink() {
    const scrollY = window.scrollY;
    sections.forEach(section => {
      const sectionTop = section.offsetTop - 120;
      const sectionHeight = section.offsetHeight;
      const sectionId = section.getAttribute('id');
      if (scrollY >= sectionTop && scrollY < sectionTop + sectionHeight) {
        navLinks.forEach(link => {
          link.classList.remove('active');
          if (link.getAttribute('href') === `#${sectionId}`) {
            link.classList.add('active');
          }
        });
      }
    });
  }


  /* =============================================
     5. HAMBURGER MENU
  ============================================= */
  const hamburgerBtn = document.getElementById('hamburger-btn');
  const menuOverlay = document.getElementById('menu-overlay');
  const menuCloseBtn = document.getElementById('menu-close-btn');
  const menuLinks = document.querySelectorAll('.menu-overlay-nav a');

  function openMenu() {
    menuOverlay?.classList.add('open');
    document.body.classList.add('menu-open');
  }

  function closeMenu() {
    menuOverlay?.classList.remove('open');
    document.body.classList.remove('menu-open');
  }

  hamburgerBtn?.addEventListener('click', openMenu);
  menuCloseBtn?.addEventListener('click', closeMenu);

  menuLinks.forEach(link => {
    link.addEventListener('click', closeMenu);
  });

  // Close on ESC
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeMenu();
  });


  /* =============================================
     6. SMOOTH SCROLL FOR ANCHOR LINKS
  ============================================= */
  document.querySelectorAll('a[href^="#"]').forEach(link => {
    link.addEventListener('click', (e) => {
      const target = document.querySelector(link.getAttribute('href'));
      if (target) {
        e.preventDefault();
        const headerHeight = header?.offsetHeight || 80;
        const targetTop = target.getBoundingClientRect().top + window.scrollY - headerHeight;
        window.scrollTo({ top: targetTop, behavior: 'smooth' });
      }
    });
  });


  /* =============================================
     7. SCROLL REVEAL ANIMATION
  ============================================= */
  const revealObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('revealed');
      }
    });
  }, {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
  });

  document.querySelectorAll('.reveal').forEach(el => {
    revealObserver.observe(el);
  });


  /* =============================================
     8. HERO ENTRANCE ANIMATION
  ============================================= */
  function animateHeroEntrance() {
    const heroElements = document.querySelectorAll('.hero-animate');
    heroElements.forEach((el, i) => {
      setTimeout(() => {
        el.style.opacity = '1';
        el.style.transform = 'translateY(0)';
      }, i * 120);
    });
  }


  /* =============================================
     9. PORTFOLIO FILTER
  ============================================= */
  const filterBtns = document.querySelectorAll('.filter-btn');
  const portfolioItems = document.querySelectorAll('.portfolio-item[data-category]');

  filterBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      const filter = btn.dataset.filter;

      // Update active state
      filterBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');

      // Filter items
      portfolioItems.forEach(item => {
        const category = item.dataset.category;
        if (filter === 'all' || category.includes(filter)) {
          item.style.opacity = '0';
          item.style.transform = 'scale(0.95)';
          item.style.display = 'block';
          requestAnimationFrame(() => {
            setTimeout(() => {
              item.style.opacity = '1';
              item.style.transform = 'scale(1)';
            }, 50);
          });
        } else {
          item.style.opacity = '0';
          item.style.transform = 'scale(0.95)';
          setTimeout(() => {
            item.style.display = 'none';
          }, 300);
        }
      });
    });
  });

  // Add transition to portfolio items
  portfolioItems.forEach(item => {
    item.style.transition = 'opacity 0.35s ease, transform 0.35s ease';
  });


  /* =============================================
     10. PRICING TOGGLE (MONTHLY / ANNUAL)
  ============================================= */
  const pricingToggle = document.getElementById('pricing-toggle');
  const monthlyPrices = document.querySelectorAll('.price-monthly');
  const annualPrices = document.querySelectorAll('.price-annual');
  const monthlyLabel = document.getElementById('monthly-label');
  const annualLabel = document.getElementById('annual-label');

  function updatePricing() {
    const isAnnual = pricingToggle?.checked;

    monthlyPrices.forEach(el => {
      el.style.display = isAnnual ? 'none' : 'inline';
    });
    annualPrices.forEach(el => {
      el.style.display = isAnnual ? 'inline' : 'none';
    });

    monthlyLabel?.classList.toggle('active', !isAnnual);
    annualLabel?.classList.toggle('active', isAnnual);
  }

  pricingToggle?.addEventListener('change', updatePricing);
  updatePricing(); // Initialize


  /* =============================================
     11. FAQ ACCORDION
  ============================================= */
  const faqItems = document.querySelectorAll('.faq-item');

  faqItems.forEach(item => {
    const question = item.querySelector('.faq-question');
    question?.addEventListener('click', () => {
      const isOpen = item.classList.contains('open');

      // Close all
      faqItems.forEach(i => i.classList.remove('open'));

      // Open clicked (if it was closed)
      if (!isOpen) {
        item.classList.add('open');
      }
    });
  });

  // Open first FAQ by default
  faqItems[0]?.classList.add('open');


  /* =============================================
     12. CONTACT FORM SUBMIT
  ============================================= */
  const contactForm = document.getElementById('contact-form');
  const formSuccess = document.getElementById('form-success');

  contactForm?.addEventListener('submit', (e) => {
    e.preventDefault();

    const submitBtn = contactForm.querySelector('[type="submit"]');
    if (submitBtn) {
      submitBtn.textContent = 'Sending...';
      submitBtn.disabled = true;
    }

    // Simulate form submission
    setTimeout(() => {
      contactForm.reset();
      if (submitBtn) {
        submitBtn.textContent = 'Send Message';
        submitBtn.disabled = false;
      }
      formSuccess?.classList.add('show');
      setTimeout(() => formSuccess?.classList.remove('show'), 5000);
    }, 1500);
  });


  /* =============================================
     13. BACK TO TOP
  ============================================= */
  const backToTopBtn = document.getElementById('back-to-top');
  backToTopBtn?.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });


  /* =============================================
     14. NUMBERS COUNTER ANIMATION
  ============================================= */
  function animateCounter(el) {
    const target = parseInt(el.dataset.target, 10);
    const duration = 2000;
    const step = target / (duration / 16);
    let current = 0;

    const timer = setInterval(() => {
      current = Math.min(current + step, target);
      el.textContent = Math.round(current) + (el.dataset.suffix || '');
      if (current >= target) clearInterval(timer);
    }, 16);
  }

  const counterObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        animateCounter(entry.target);
        counterObserver.unobserve(entry.target);
      }
    });
  }, { threshold: 0.5 });

  document.querySelectorAll('[data-target]').forEach(el => {
    counterObserver.observe(el);
  });


  /* =============================================
     15. SCROLL-BASED HEADER NAV STYLE
  ============================================= */
  // Run once on load
  updateActiveNavLink();

  /* =============================================
     16. LIGHT / DARK THEME TOGGLE
  ============================================= */
  const themeToggleBtn = document.getElementById('theme-toggle-btn');
  const themeIcon = document.getElementById('theme-icon');
  const htmlEl = document.documentElement;

  // Theme switcher is hidden for now — force light mode regardless of
  // any theme saved earlier, since there's no UI to correct it back.
  const savedTheme = 'light';
  htmlEl.setAttribute('data-theme', savedTheme);
  syncThemeIcon(savedTheme);

  themeToggleBtn?.addEventListener('click', () => {
    const current = htmlEl.getAttribute('data-theme') || 'dark';
    const next = current === 'dark' ? 'light' : 'dark';

    // Animate icon out → switch → animate in
    if (themeIcon) {
      themeIcon.style.transform = 'rotate(90deg) scale(0)';
      themeIcon.style.opacity = '0';
      setTimeout(() => {
        htmlEl.setAttribute('data-theme', next);
        localStorage.setItem('dv-theme', next);
        syncThemeIcon(next);
        themeIcon.style.transform = 'rotate(0deg) scale(1)';
        themeIcon.style.opacity = '1';
      }, 200);
    } else {
      htmlEl.setAttribute('data-theme', next);
      localStorage.setItem('dv-theme', next);
      syncThemeIcon(next);
    }
  });

  function syncThemeIcon(theme) {
    if (!themeIcon) return;
    // Dark mode → show sun (click to go light)
    // Light mode → show moon (click to go dark)
    themeIcon.className = theme === 'dark' ? 'fa-solid fa-sun' : 'fa-solid fa-moon';
    themeIcon.style.transition = 'transform 0.5s cubic-bezier(0.34,1.56,0.64,1), opacity 0.2s ease';
  }


  /* =============================================
     17. INTERACTIVE PARTICLE NETWORK
  ============================================= */
  (function initParticles() {
    const canvas = document.getElementById('particle-canvas');
    if (!canvas) return;
    const ctx = canvas.getContext('2d');

    /* ── Config ── */
    const CFG = {
      count:           100,      // number of particles
      connectDist:     145,      // max px distance to draw a line
      mouseRadius:     170,      // repulsion radius around cursor
      repelStrength:   5.5,      // how strongly particles flee the cursor
      returnSpeed:     0.045,    // lerp speed back toward drift position
      driftSpeed:      0.38,     // base drift velocity magnitude
      minRadius:       1,        // smallest dot radius (px)
      maxRadius:       2.5,      // largest dot radius (px)
    };

    let W, H;
    let mouse = { x: -9999, y: -9999 };
    let particles = [];
    let animId = null;

    /* ── Resize ── */
    function resize() {
      W = canvas.width  = window.innerWidth;
      H = canvas.height = window.innerHeight;
    }

    /* ── Theme helper ── */
    function isDark() {
      return document.documentElement.getAttribute('data-theme') !== 'light';
    }

    /* ── Particle class ── */
    function Particle() {
      this.spawn();
    }

    Particle.prototype.spawn = function() {
      /* real position */
      this.x  = Math.random() * W;
      this.y  = Math.random() * H;
      /* drift anchor (follows natural wandering) */
      this.ox = this.x;
      this.oy = this.y;
      /* velocity for the drift anchor */
      const angle = Math.random() * Math.PI * 2;
      const speed = CFG.driftSpeed * (0.5 + Math.random() * 0.8);
      this.vx = Math.cos(angle) * speed;
      this.vy = Math.sin(angle) * speed;
      /* appearance */
      this.r     = CFG.minRadius + Math.random() * (CFG.maxRadius - CFG.minRadius);
      this.alpha = 0.18 + Math.random() * 0.32;
    };

    Particle.prototype.update = function() {
      /* advance the drift anchor */
      this.ox += this.vx;
      this.oy += this.vy;

      /* soft wall bounce */
      if (this.ox < -10)    { this.ox = W + 10; this.x = this.ox; }
      if (this.ox > W + 10) { this.ox = -10;    this.x = this.ox; }
      if (this.oy < -10)    { this.oy = H + 10; this.y = this.oy; }
      if (this.oy > H + 10) { this.oy = -10;    this.y = this.oy; }

      /* mouse repulsion */
      const dx   = this.x - mouse.x;
      const dy   = this.y - mouse.y;
      const dist = Math.sqrt(dx * dx + dy * dy);

      if (dist < CFG.mouseRadius && dist > 0.5) {
        const norm  = 1 / dist;
        const force = ((CFG.mouseRadius - dist) / CFG.mouseRadius);
        /* quadratic fall-off for a softer feel */
        const push  = force * force * CFG.repelStrength;
        this.x += dx * norm * push;
        this.y += dy * norm * push;
      }

      /* lerp real position back toward drift anchor */
      this.x += (this.ox - this.x) * CFG.returnSpeed;
      this.y += (this.oy - this.y) * CFG.returnSpeed;
    };

    Particle.prototype.draw = function() {
      const dark = isDark();
      ctx.beginPath();
      ctx.arc(this.x, this.y, this.r, 0, Math.PI * 2);
      ctx.fillStyle = dark
        ? `rgba(105,200,199,${this.alpha})`
        : `rgba(21,143,141,${this.alpha * 0.65})`;
      ctx.fill();
    };

    /* ── Draw connection lines ── */
    function drawLines() {
      const dark = isDark();
      for (let i = 0; i < particles.length; i++) {
        for (let j = i + 1; j < particles.length; j++) {
          const dx   = particles[i].x - particles[j].x;
          const dy   = particles[i].y - particles[j].y;
          const dist = Math.sqrt(dx * dx + dy * dy);
          if (dist < CFG.connectDist) {
            /* brightness boost when near mouse */
            const mdx   = (particles[i].x + particles[j].x) / 2 - mouse.x;
            const mdy   = (particles[i].y + particles[j].y) / 2 - mouse.y;
            const mDist = Math.sqrt(mdx * mdx + mdy * mdy);
            const glow  = mDist < CFG.mouseRadius
              ? 0.35 * (1 - mDist / CFG.mouseRadius)
              : 0;
            const alpha = (1 - dist / CFG.connectDist) * 0.14 + glow;

            ctx.beginPath();
            ctx.moveTo(particles[i].x, particles[i].y);
            ctx.lineTo(particles[j].x, particles[j].y);
            ctx.strokeStyle = dark
              ? `rgba(105,200,199,${alpha})`
              : `rgba(21,143,141,${alpha * 0.55})`;
            ctx.lineWidth = 0.7;
            ctx.stroke();
          }
        }
      }
    }

    /* ── Animation loop ── */
    function loop() {
      ctx.clearRect(0, 0, W, H);
      for (let i = 0; i < particles.length; i++) {
        particles[i].update();
        particles[i].draw();
      }
      drawLines();
      animId = requestAnimationFrame(loop);
    }

    /* ── Init ── */
    function init() {
      resize();
      particles = Array.from({ length: CFG.count }, () => new Particle());
      if (animId) cancelAnimationFrame(animId);
      loop();
    }

    /* ── Event listeners ── */
    window.addEventListener('resize', () => {
      resize();
      /* respawn so particles fill new viewport */
      particles.forEach(p => p.spawn());
    });

    window.addEventListener('mousemove', e => {
      mouse.x = e.clientX;
      mouse.y = e.clientY;
    });

    window.addEventListener('mouseleave', () => {
      mouse.x = -9999;
      mouse.y = -9999;
    });

    /* Touch support */
    window.addEventListener('touchmove', e => {
      if (e.touches[0]) {
        mouse.x = e.touches[0].clientX;
        mouse.y = e.touches[0].clientY;
      }
    }, { passive: true });

    window.addEventListener('touchend', () => {
      mouse.x = -9999;
      mouse.y = -9999;
    });

    init();
  })();

});
