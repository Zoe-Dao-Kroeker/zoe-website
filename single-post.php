<?php
/**
 * Mel Custom Theme — single-post.php
 * Single blog post — editorial layout.
 * With featured image: dark hero (same pattern as portfolio pages).
 * Without featured image: title-header on white, solid nav.
 */

get_header();

while ( have_posts() ) : the_post();

$thumb_url = get_the_post_thumbnail_url( null, 'full' );
$cats      = get_the_category();
$cat_name  = $cats ? $cats[0]->name : 'Writing';
$cat_url   = $cats ? get_category_link( $cats[0]->term_id ) : '#';

?>

<?php if ( $thumb_url ) : ?>
<!-- ============================================================
     HERO — featured image with gradient overlay (same as portfolio)
     ============================================================ -->
<section class="hero" aria-label="Post hero">
  <div class="hero__bg" aria-hidden="true" style="background: linear-gradient(to top, rgba(16,30,42,.97) 0%, rgba(16,30,42,.55) 45%, rgba(16,30,42,.2) 100%), url(<?php echo esc_url( $thumb_url ); ?>) center center / cover no-repeat;"></div>
  <div class="hero__body">
    <span class="eyebrow eyebrow--light reveal">
      <a href="<?php echo esc_url( $cat_url ); ?>" style="color:inherit;text-decoration:none;"><?php echo esc_html( $cat_name ); ?></a>
    </span>
    <h1 class="hero__h1 reveal d1"><?php the_title(); ?></h1>
    <?php $excerpt = get_the_excerpt(); if ( $excerpt ) : ?>
    <p class="hero__lead reveal d2"><?php echo esc_html( $excerpt ); ?></p>
    <?php endif; ?>
  </div>
</section>

<?php else : ?>
<!-- ============================================================
     TITLE HEADER — no featured image, white background
     ============================================================ -->
<div class="post-title-header">
  <div class="container">
    <span class="eyebrow eyebrow--muted">
      <a href="<?php echo esc_url( $cat_url ); ?>" style="color:inherit;text-decoration:none;"><?php echo esc_html( $cat_name ); ?></a>
    </span>
    <h1 class="post-title"><?php the_title(); ?></h1>
    <p class="post-meta-bar">
      <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo get_the_date( 'F j, Y' ); ?></time>
    </p>
  </div>
</div>
<?php endif; ?>

<!-- ============================================================
     POST CONTENT
     ============================================================ -->
<main class="post-main" id="main">
  <div class="container">
    <div class="body-copy post-content">
      <?php the_content(); ?>
    </div>

    <footer class="post-footer" style="margin-top:64px; padding-top:32px; border-top:1px solid var(--qp-hairline);">
      <a href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ?: home_url( '/' ) ); ?>" class="eyebrow eyebrow--muted" style="text-decoration:none; display:inline-flex; align-items:center; gap:6px;">
        ← Back to Blog
      </a>
    </footer>
  </div>
</main>

<?php

// Scroll reveal (for hero variant) — same as portfolio
if ( $thumb_url ) :
?>
<script>
(function () {
  var revealEls = document.querySelectorAll('.hero .reveal');
  revealEls.forEach(function (el) { el.classList.add('is-visible'); });

  var io = new IntersectionObserver(function (entries) {
    entries.forEach(function (e) {
      if (e.isIntersecting) { e.target.classList.add('is-visible'); io.unobserve(e.target); }
    });
  }, { threshold: 0.12 });
  document.querySelectorAll('.reveal:not(.is-visible)').forEach(function (el) { io.observe(el); });
})();
</script>
<?php endif; ?>

<?php
endwhile;

get_footer();
