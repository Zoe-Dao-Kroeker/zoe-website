<?php
/**
 * Mel Custom Theme — header.php
 * HTML document head + fixed navigation + mobile drawer.
 * Called by get_header() in every custom template.
 *
 * The wordmark is live text in Newsreader, not an image: no vector logo exists,
 * and a typographic name scales and recolours better as type anyway. Swapping in
 * a real mark later means replacing the <span> without touching layout.
 *
 * Nav links are on-page anchors, since this is a one-pager. The section IDs they
 * point at are defined in front-page.php.
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

    <a href="<?php echo $home; ?>" class="nav__logo-link" aria-label="Mel·lif·lu·ous — home">
      <span class="nav__logo-text">Mel&middot;lif&middot;lu&middot;ous</span>
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
