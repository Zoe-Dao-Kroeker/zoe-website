<?php
/**
 * Zoe Dao-Kroeker Custom Theme — footer.php
 * Footer bar + nav JS + closing body/html.
 * Called by get_footer() in every page template.
 *
 * Links (email, LinkedIn, Instagram, résumé) come from the Site Settings
 * ACF options page (inc/acf-fields.php, group_zoe_site_options), not
 * hardcoded — Zoe/Lara update them from wp-admin, not from this file. Each
 * link only renders if its field is filled in, so a blank résumé URL (it
 * hasn't been supplied yet) just omits that link rather than pointing
 * nowhere.
 *
 * Closing CTA: one dark banner above the footer bar, on every page —
 * structurally copied from larakroekerinteractive.com's own closing
 * section, repainted in Zoe's tokens (see zoe.css's .zoe-closing-cta
 * comment). Always links to LinkedIn specifically, not a generic CTA —
 * Lara's call, August 27, 2026 — so it renders only when both the
 * heading and the LinkedIn URL are filled in.
 */

$contact_email = get_field( 'contact_email', 'option' );
$linkedin_url  = get_field( 'linkedin_url', 'option' );
$instagram_url = get_field( 'instagram_url', 'option' );
$resume_url    = get_field( 'resume_url', 'option' );

$closing_eyebrow   = get_field( 'closing_eyebrow', 'option' );
$closing_heading   = get_field( 'closing_heading', 'option' );
$closing_cta_label = get_field( 'closing_cta_label', 'option' );
?>

<?php if ( $closing_heading && $linkedin_url ) : ?>
  <section class="zoe-closing-cta">
    <div class="zoe-closing-cta__inner">
      <?php if ( $closing_eyebrow ) : ?>
        <div class="eyebrow"><?php echo esc_html( $closing_eyebrow ); ?></div>
      <?php endif; ?>
      <h2 class="zoe-closing-cta__heading"><?php echo esc_html( $closing_heading ); ?></h2>
      <div class="zoe-ctas zoe-ctas--center">
        <a class="btn-pill btn-pill--cta" href="<?php echo esc_url( $linkedin_url ); ?>" target="_blank" rel="noopener noreferrer">
          <?php echo esc_html( $closing_cta_label ?: 'Connect on LinkedIn' ); ?>
          <span class="arr" aria-hidden="true"><svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M2.5 11.5L11.5 2.5M11.5 2.5H4.5M11.5 2.5V9.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg></span>
        </a>
      </div>
    </div>
  </section>
<?php endif; ?>

<footer class="zoe-footer" role="contentinfo">
  <div class="zoe-footer__inner">
    <?php if ( $contact_email ) : ?>
      <a class="zoe-footer__link" href="<?php echo esc_url( 'mailto:' . antispambot( $contact_email ) ); ?>">Email</a>
    <?php endif; ?>
    <?php if ( $linkedin_url ) : ?>
      <a class="zoe-footer__link" href="<?php echo esc_url( $linkedin_url ); ?>" target="_blank" rel="noopener noreferrer">LinkedIn</a>
    <?php endif; ?>
    <?php if ( $instagram_url ) : ?>
      <a class="zoe-footer__link" href="<?php echo esc_url( $instagram_url ); ?>" target="_blank" rel="noopener noreferrer">Instagram</a>
    <?php endif; ?>
    <?php if ( $resume_url ) : ?>
      <a class="zoe-footer__link" href="<?php echo esc_url( $resume_url ); ?>" target="_blank" rel="noopener noreferrer">Résumé</a>
    <?php endif; ?>
    <a class="zoe-footer__link" href="<?php echo esc_url( home_url( '/design-guidelines/' ) ); ?>">Media Kit</a>
    <span class="zoe-footer__copy">&copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?></span>
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

  // ── Hamburger: toggles the same <ul> the desktop bar renders ─────
  // (#primary-menu, from wp_nav_menu() in header.php) rather than a second
  // copy of the menu, so there's one place for its markup/behaviour to
  // drift instead of two.
  var btn  = document.getElementById('navHamburger');
  var menu = document.getElementById('primary-menu');
  function closeMenu() {
    if (!menu || !btn) return;
    menu.classList.remove('is-open');
    btn.classList.remove('is-open');
    btn.setAttribute('aria-expanded', 'false');
    btn.setAttribute('aria-label', 'Open navigation menu');
  }
  if (btn && menu) {
    btn.addEventListener('click', function () {
      var open = menu.classList.toggle('is-open');
      btn.classList.toggle('is-open', open);
      btn.setAttribute('aria-expanded', open ? 'true' : 'false');
      btn.setAttribute('aria-label', open ? 'Close navigation menu' : 'Open navigation menu');
    });
    menu.addEventListener('click', function (e) {
      if (e.target.tagName === 'A') closeMenu();
    });
    // Escape closes it, so keyboard users are not trapped.
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && menu.classList.contains('is-open')) {
        closeMenu();
        btn.focus();
      }
    });
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
