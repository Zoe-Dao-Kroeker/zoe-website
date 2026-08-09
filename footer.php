<?php
/**
 * Zoe Dao-Kroeker Custom Theme — footer.php
 * Pre-footer CTA + footer bar + JS + closing body/html.
 * Called by get_footer() in every custom template.
 *
 * 🔴 SCAFFOLD ONLY. This whole file is still Mel's content, unrenamed on
 * purpose: the CTA below ("Listen") and the four social circles further down
 * (Instagram, Bandcamp, Spotify, Apple Music) are Mel's real profile links,
 * not placeholders — do not just relabel them. Zoe's terminal action and
 * actual social links are open questions, not something to guess at here.
 */
?>

<!-- =============================================================
     Pre-footer CTA
     ============================================================= -->
<section class="cta-sec" id="listen" aria-labelledby="cta-heading">
  <div class="container">
    <span class="eyebrow eyebrow--light">Listen</span>
    <h2 class="display-h2" id="cta-heading">
      <!-- No .accent here, deliberately. The guidelines allow the 300-italic
           forest accent ONCE per page and the hero headline spends it. This
           heading also used to repeat the hero's exact phrase ("one layer at a
           time"), which reads as sloppy on a single page.
           PLACEHOLDER: needs Lara's own closing line. -->
      Three albums so far, and the next one already starting.
    </h2>
    <div class="stream-row">
      <a class="stream-link" href="https://open.spotify.com/artist/3p646805chFAeNt3WasIYY"
         target="_blank" rel="noopener noreferrer">Spotify</a>
      <a class="stream-link" href="https://music.apple.com/artist/1692317652"
         target="_blank" rel="noopener noreferrer">Apple Music</a>
      <a class="stream-link" href="https://larakroeker.bandcamp.com"
         target="_blank" rel="noopener noreferrer">Bandcamp</a>
    </div>
  </div>
</section>

<!-- =============================================================
     Footer
     ============================================================= -->
<footer class="footer" role="contentinfo">
  <div class="container">
    <div class="footer__inner">

      <div>
        <span class="footer__wordmark">Mel&middot;lif&middot;lu&middot;ous</span>
        <p class="footer__copy">&copy; <?php echo esc_html( date( 'Y' ) ); ?> Mel&middot;lif&middot;lu&middot;ous. Music by Lara Kroeker.</p>
      </div>

      <?php
      /*
       * The in-page nav (Music / About / Writing / Contact) was removed here on
       * Lara's instruction, August 9, 2026. On a one-pager it duplicated the
       * fixed header nav a screen-height below it, and every link just scrolled
       * back up the same page.
       *
       * What stays is the two things that actually leave the site: social
       * profiles and the streaming platforms.
       */
      ?>
      <div class="footer__links">
        <a class="footer__social footer__social--circle" href="https://instagram.com/mel__lif__lu__ous/"
           target="_blank" rel="noreferrer noopener" aria-label="Instagram">
          <span aria-hidden="true">IG</span>
        </a>
        <a class="footer__social footer__social--circle" href="https://larakroeker.bandcamp.com"
           target="_blank" rel="noreferrer noopener" aria-label="Bandcamp">
          <span aria-hidden="true">BC</span>
        </a>
        <a class="footer__social footer__social--circle" href="https://open.spotify.com/artist/3p646805chFAeNt3WasIYY"
           target="_blank" rel="noreferrer noopener" aria-label="Spotify">
          <span aria-hidden="true">SP</span>
        </a>
        <a class="footer__social footer__social--circle" href="https://music.apple.com/artist/1692317652"
           target="_blank" rel="noreferrer noopener" aria-label="Apple Music">
          <span aria-hidden="true">AM</span>
        </a>
      </div>



    </div>
  </div>
</footer>

<script>
(function () {
  // ── Nav: transparent → frosted on scroll ────────────────────────
  var nav = document.getElementById('nav');
  if (nav) {
    var ticking = false;
    window.addEventListener('scroll', function () {
      if (!ticking) {
        requestAnimationFrame(function () {
          nav.classList.toggle('scrolled', window.scrollY > 40);
          ticking = false;
        });
        ticking = true;
      }
    }, { passive: true });
  }

  // ── Hamburger: slide-down drawer ────────────────────────────────
  var btn    = document.getElementById('navHamburger');
  var drawer = document.getElementById('navDrawer');
  function closeDrawer() {
    drawer.classList.remove('is-open');
    btn.classList.remove('is-open');
    btn.setAttribute('aria-expanded', 'false');
    drawer.setAttribute('aria-hidden', 'true');
    btn.setAttribute('aria-label', 'Open navigation menu');
  }
  if (btn && drawer) {
    btn.addEventListener('click', function () {
      var open = drawer.classList.toggle('is-open');
      btn.classList.toggle('is-open', open);
      btn.setAttribute('aria-expanded', open ? 'true' : 'false');
      drawer.setAttribute('aria-hidden', open ? 'false' : 'true');
      btn.setAttribute('aria-label', open ? 'Close navigation menu' : 'Open navigation menu');
    });
    drawer.addEventListener('click', function (e) {
      if (e.target.tagName === 'A') closeDrawer();
    });
    // Escape closes it, so keyboard users are not trapped.
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && drawer.classList.contains('is-open')) {
        closeDrawer();
        btn.focus();
      }
    });
  }

  // ── Hero slideshow ──────────────────────────────────────────────
  // Crossfades the hero photos. Two things worth knowing before editing:
  //
  // 1. Only the first slide ships with a src. The rest carry data-src and are
  //    given a real src one step before they are needed, so arriving at the page
  //    downloads one photograph rather than eleven. Ordinary loading="lazy" is
  //    useless here because every slide is stacked inside the viewport, so the
  //    browser would consider all of them urgent.
  //
  // 2. It stops when the hero scrolls out of view and when the tab is hidden.
  //    A timer swapping full-width images behind content nobody is looking at is
  //    pure battery drain.
  var slidesWrap = document.querySelector('.hero__slides');
  var slides = slidesWrap ? slidesWrap.querySelectorAll('.hero__slide') : [];
  var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  if (slides.length > 1 && !reduce) {
    var DWELL = 5000;   // ms each photo holds. The crossfade itself is --dur-slow.
    var cur = 0, timer = null, heroVisible = true;

    function preload(i) {
      var img = slides[i];
      if (img && img.dataset.src) {
        img.src = img.dataset.src;
        delete img.dataset.src;
      }
    }
    preload(1); // have the second one ready before the first advance

    function advance() {
      var next = (cur + 1) % slides.length;
      preload(next);
      slides[cur].classList.remove('is-active');
      slides[next].classList.add('is-active');
      cur = next;
      preload((next + 1) % slides.length); // stay one ahead
    }
    function start() { if (!timer && heroVisible) timer = setInterval(advance, DWELL); }
    function stop()  { if (timer) { clearInterval(timer); timer = null; } }

    // Pause once the hero is off screen.
    var hero = document.querySelector('.hero');
    if (hero && 'IntersectionObserver' in window) {
      new IntersectionObserver(function (entries) {
        heroVisible = entries[0].isIntersecting;
        heroVisible ? start() : stop();
      }, { threshold: 0 }).observe(hero);
    } else {
      start();
    }

    // Pause in a background tab.
    document.addEventListener('visibilitychange', function () {
      document.hidden ? stop() : start();
    });

    start();
  }

  // ── Scroll reveal ───────────────────────────────────────────────
  var revealEls = document.querySelectorAll('.reveal');
  if (!('IntersectionObserver' in window) ||
      window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    // No observer, or the visitor asked for less motion: show everything.
    revealEls.forEach(function (el) { el.classList.add('is-visible'); });
  } else {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (e) {
        if (e.isIntersecting) {
          e.target.classList.add('is-visible');
          io.unobserve(e.target);
        }
      });
    }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
    revealEls.forEach(function (el) { io.observe(el); });
  }

}());
</script>

<?php wp_footer(); ?>
</body>
</html>
