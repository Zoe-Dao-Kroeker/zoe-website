<?php
/**
 * Zoe Dao-Kroeker Custom Theme — single-portfolio.php
 * One individual project page — real `portfolio` CPT content, linked to
 * from the Work page's card grids (see inc/template-helpers.php,
 * zoe_portfolio_grid()). No page builder needed here: title, category,
 * featured image, and the post's own content, in the site's real system
 * (zoe-* classes, current tokens) rather than the Mel-derived markup still
 * in single-post.php.
 */

get_header();

while ( have_posts() ) : the_post();
    $cats     = get_the_category();
    $cat_name = $cats ? $cats[0]->name : '';
    // Always the Work page itself, not the category archive — Lara's
    // call; every project's "back" should land in the same place.
    $work_link = home_url( '/work/' );
?>

<main class="zoe-main" id="main">

  <article class="zoe-section zoe-section--intro">
    <?php if ( $cat_name ) : ?>
      <div class="eyebrow"><?php echo esc_html( $cat_name ); ?></div>
    <?php endif; ?>
    <h1 class="zoe-section__heading"><?php the_title(); ?></h1>

    <?php if ( has_post_thumbnail() ) : ?>
      <img src="<?php the_post_thumbnail_url( 'large' ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>"
           style="width:100%; border-radius: var(--radius-lg); margin: var(--sp-32) 0;">
    <?php endif; ?>

    <div class="body-copy page-content" style="max-width: 70ch;">
      <?php the_content(); ?>
    </div>

    <div class="zoe-ctas" style="margin-top: var(--sp-48);">
      <a class="btn-ghost btn-ghost--dark" href="<?php echo esc_url( $work_link ); ?>">
        <svg width="13" height="13" viewBox="0 0 14 14" fill="none" style="transform: rotate(180deg);"><path d="M2 7h10M7 2l5 5-5 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
        Back to Work
      </a>
    </div>
  </article>

</main>

<?php
endwhile;

get_footer();
