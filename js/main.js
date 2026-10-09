/* =========================================================
   digivyb — Main JavaScript
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

  // The intro plays once per browser session, and only on pages that have a
  // preloader (the home page). Everywhere else the hero animates in at once.
  const skipIntro = !preloader || document.documentElement.classList.contains('no-intro');

  function finishIntro() {
    preloader?.classList.add('hidden');
    document.body.classList.remove('preloader-active');
    if (preloader) {
      try { sessionStorage.setItem('dv-intro', '1'); } catch (err) { /* storage unavailable */ }
    }
  }

  if (skipIntro) {
    finishIntro();
    // Wait a frame so the initial hidden state paints before animating in.
    requestAnimationFrame(() => animateHeroEntrance());
  } else {
    window.addEventListener('load', () => {
      setTimeout(() => {
        finishIntro();
        animateHeroEntrance();
      }, 2200);
    });

    // Fallback in case window.load is slow
    setTimeout(finishIntro, 3500);
  }


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
    const hoverEls = document.querySelectorAll('a, button, .portfolio-item, .service-card, .team-card, .filter-btn');
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

  // The hero is a dark video backdrop in both themes, so the header gets a
  // dark treatment (.over-hero) for as long as it is floating above it.
  function updateOverHero() {
    if (!header || !heroSection) return;
    const heroBottom = heroSection.offsetHeight - header.offsetHeight;
    header.classList.toggle('over-hero', window.scrollY < heroBottom);
  }
  updateOverHero();
  window.addEventListener('resize', updateOverHero);

  let lastScroll = 0;
  window.addEventListener('scroll', () => {
    const scrollY = window.scrollY;
    updateOverHero();

    // Scrolled state
    if (scrollY > 60) {
      header?.classList.add('scrolled');
      header?.classList.remove('hero-state');
    } else {
      header?.classList.remove('scrolled');
      header?.classList.add('hero-state');
    }

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
     4. ACTIVE NAV LINK — set server-side (aria-current) per page
  ============================================= */


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
    hamburgerBtn?.setAttribute('aria-expanded', 'true');
  }

  function closeMenu() {
    menuOverlay?.classList.remove('open');
    document.body.classList.remove('menu-open');
    hamburgerBtn?.setAttribute('aria-expanded', 'false');
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
      const hash = link.getAttribute('href');
      if (!hash || hash.length < 2) {
        e.preventDefault(); // placeholder link: do nothing instead of jumping to top
        return;
      }
      const target = document.querySelector(hash);
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
      filterBtns.forEach(b => {
        b.classList.remove('active');
        b.setAttribute('aria-pressed', 'false');
      });
      btn.classList.add('active');
      btn.setAttribute('aria-pressed', 'true');

      // Filter items
      portfolioItems.forEach(item => {
        const category = item.dataset.category;
        clearTimeout(item.hideTimer); // a stale hide must not fire after we re-show the item
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
          item.hideTimer = setTimeout(() => {
            item.style.display = 'none';
          }, 300);
        }
      });
    });
  });

  filterBtns.forEach(b => b.setAttribute('aria-pressed', String(b.classList.contains('active'))));

  // Add transition to portfolio items
  portfolioItems.forEach(item => {
    item.style.transition = 'opacity 0.35s ease, transform 0.35s ease';
  });


  /* =============================================
     10. CONTACT FORM SUBMIT
  ============================================= */
  const contactForm = document.getElementById('contact-form');
  const formSuccess = document.getElementById('form-success');
  const formError = document.getElementById('form-error');

  function setFieldErrors(errors) {
    contactForm.querySelectorAll('[data-error-for]').forEach(el => {
      el.textContent = errors[el.dataset.errorFor] || '';
      el.setAttribute('role', 'alert');
    });
  }

  function showFormError(message) {
    if (!formError) return;
    formError.textContent = message;
    formError.classList.add('show');
  }

  contactForm?.addEventListener('submit', async (e) => {
    e.preventDefault();

    const submitBtn = contactForm.querySelector('[type="submit"]');
    const submitLabel = submitBtn?.querySelector('span');
    setFieldErrors({});
    formError?.classList.remove('show');
    formSuccess?.classList.remove('show');

    if (submitBtn) submitBtn.disabled = true;
    if (submitLabel) submitLabel.textContent = 'Sending...';

    try {
      const response = await fetch(contactForm.action, {
        method: 'POST',
        headers: { 'Accept': 'application/json' },
        body: new FormData(contactForm),
      });
      const data = await response.json().catch(() => ({}));

      if (response.ok && data.ok) {
        contactForm.reset();
        const tokenInput = contactForm.querySelector('input[name="csrf"]');
        if (tokenInput && data.csrf) tokenInput.value = data.csrf;
        formSuccess?.classList.add('show');
      } else if (data.errors) {
        setFieldErrors(data.errors);
        contactForm.querySelector('.field-error:not(:empty)')
          ?.closest('.form-group')?.querySelector('input, select, textarea')?.focus();
      } else {
        showFormError(data.message || 'Something went wrong. Please try again, or email us directly.');
      }
    } catch (err) {
      showFormError('We could not reach the server. Please check your connection and try again.');
    } finally {
      if (submitBtn) submitBtn.disabled = false;
      if (submitLabel) submitLabel.textContent = 'Send Message';
    }
  });


  /* =============================================
     11. BACK TO TOP
  ============================================= */
  const backToTopBtn = document.getElementById('back-to-top');
  backToTopBtn?.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });


  /* =============================================
     12. NUMBERS COUNTER ANIMATION
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
     14. LIGHT / DARK THEME TOGGLE
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
     15. INTERACTIVE PARTICLE NETWORK
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
