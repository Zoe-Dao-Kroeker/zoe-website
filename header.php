<?php
/**
 * Zoe Dao-Kroeker Custom Theme — header.php
 * HTML document head + fixed navigation + mobile drawer.
 * Called by get_header() in every custom template.
 *
 * The wordmark is live text in Newsreader, not an image: reused from Mel as a
 * structural default, not a font decision for Zoe. No vector logo exists yet
 * for either brand.
 *
 * 🔴 $nav_items below is still Mel's: on-page anchors for a one-pager
 * (music/about/writing sections in front-page.php). Zoe's site is 8 real
 * pages, not anchors on one page — this needs to become either
 * `wp_nav_menu()` against a registered menu location, or a hardcoded list of
 * real page URLs resolved through a helper (see `loc_page_url()` in
 * loc-theme/functions.php for that pattern). Left as-is so it's obviously
 * unfinished rather than silently wrong.
 */

$is_one_pager = is_front_page();
$home         = esc_url( home_url( '/' ) );

// On interior views the anchors need to travel home first.
$prefix = $is_one_pager ? '' : $home;

$nav_items = [
    'music'   => 'Music',
    'about'   => 'About',
    'writing' => 'Writing',
];
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

<nav class="nav" id="nav" role="navigation" aria-label="Main navigation">
  <div class="nav__inner">

    <a href="<?php echo $home; ?>" class="nav__logo-link" aria-label="Zoe Dao-Kroeker — home">
      <span class="nav__logo-text">Zoe Dao-Kroeker</span>
    </a>

    <div class="nav__links">
      <?php foreach ( $nav_items as $anchor => $label ) : ?>
        <a href="<?php echo esc_url( $prefix . '#' . $anchor ); ?>" class="nav__link">
          <?php echo esc_html( $label ); ?>
        </a>
      <?php endforeach; ?>

      <a href="https://open.spotify.com/artist/3p646805chFAeNt3WasIYY"
         target="_blank" rel="noopener noreferrer"
         class="btn btn--on-dark btn--sm nav__cta">
        Listen
      </a>
    </div>

    <button class="nav__hamburger" id="navHamburger"
            aria-label="Open navigation menu"
            aria-expanded="false"
            aria-controls="navDrawer">
      <span></span>
      <span></span>
      <span></span>
    </button>

  </div>
</nav>

<div class="nav__drawer" id="navDrawer" aria-hidden="true" role="dialog" aria-label="Navigation menu">
  <?php foreach ( $nav_items as $anchor => $label ) : ?>
    <a href="<?php echo esc_url( $prefix . '#' . $anchor ); ?>" class="nav__drawer-link">
      <?php echo esc_html( $label ); ?>
    </a>
  <?php endforeach; ?>
  <a href="https://open.spotify.com/artist/3p646805chFAeNt3WasIYY"
     target="_blank" rel="noopener noreferrer"
     class="nav__drawer-cta">Listen on Spotify</a>
</div>
