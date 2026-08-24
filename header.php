<?php
/**
 * Zoe Dao-Kroeker Custom Theme — header.php
 * HTML document head + fixed navigation.
 * Called by get_header() in every page template.
 *
 * Nav items come from the "primary" registered menu location
 * (Appearance → Menus), not a hardcoded list, so Zoe/Lara can add, reorder,
 * or rename items — including the external Résumé link — without touching
 * code. One <ul> serves both the desktop bar and the mobile menu: the
 * hamburger button in footer.php's script toggles a single "is-open" class
 * on it rather than rendering the menu twice, so there's one place for its
 * styling to drift instead of two (see the design playbook's "Rollover/hover
 * states — consistent, not per-component" note for why that matters).
 *
 * Logo: renders the real uploaded logo (Appearance → Customize → Site
 * Identity) when one is set, falling back to the live-text wordmark
 * otherwise — so this keeps working even if the logo is ever unset.
 */

$home = esc_url( home_url( '/' ) );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link" href="#main">Skip to content</a>

<nav class="zoe-nav" id="nav" role="navigation" aria-label="Main navigation">
  <div class="zoe-nav__inner">

    <?php if ( has_custom_logo() ) : ?>
      <div class="zoe-nav__logo-link"><?php the_custom_logo(); ?></div>
    <?php else : ?>
      <a href="<?php echo $home; ?>" class="zoe-nav__logo-link"
         aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) . ' — home' ); ?>">
        <span class="zoe-nav__logo-text"><?php bloginfo( 'name' ); ?></span>
      </a>
    <?php endif; ?>

    <?php
    wp_nav_menu( [
        'theme_location' => 'primary',
        'container'      => false,
        'menu_id'        => 'primary-menu',
        'menu_class'     => 'zoe-nav__links',
        'depth'          => 1,
    ] );
    ?>

    <button class="zoe-nav__hamburger" id="navHamburger"
            aria-label="Open navigation menu"
            aria-expanded="false"
            aria-controls="primary-menu">
      <span></span>
      <span></span>
      <span></span>
    </button>

  </div>
</nav>
