<?php
/**
 * Mel Custom Theme — 404.php
 *
 * Not found. Rather than a dead end, offers the three things a lost visitor
 * most likely wants: the music, the writing, and search.
 *
 * Gets the solid nav treatment automatically: the body_class filter in
 * functions.php adds nav-solid on everything that is not the front page.
 */

get_header();

// The most recent writing, as a way back in.
$recent = get_posts( [ 'numberposts' => 3, 'post_status' => 'publish' ] );
?>

<main class="page-main error-404" id="main">
  <div class="container">

    <span class="eyebrow">404</span>
    <h1 class="page-title">That page has wandered off.</h1>

    <div class="body-copy error-404__body">
      <p>The link may be old, or the page may have moved during the site rebuild.
      Everything below still works.</p>
    </div>

    <div class="error-404__actions">
      <a class="btn" href="<?php echo esc_url( home_url( '/' ) ); ?>">Back to the music</a>
      <a class="btn btn--ghost" href="<?php echo esc_url( home_url( '/#writing' ) ); ?>">Read the writing</a>
    </div>

    <div class="error-404__search">
      <?php get_search_form(); ?>
    </div>

    <?php if ( $recent ) : ?>
      <span class="eyebrow">Recent writing</span>
      <ul class="post-list">
        <?php foreach ( $recent as $p ) : ?>
          <li class="post-list__item">
            <a class="post-list__link" href="<?php echo esc_url( get_permalink( $p ) ); ?>">
              <span class="post-list__title"><?php echo esc_html( get_the_title( $p ) ); ?></span>
              <span class="post-list__date"><?php echo esc_html( get_the_date( 'M Y', $p ) ); ?></span>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>

  </div>
</main>

<?php
get_footer();
