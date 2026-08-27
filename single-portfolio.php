<?php
/**
 * Zoe Dao-Kroeker Custom Theme — single-portfolio.php
 * One individual project page — real `portfolio` CPT content, linked to
 * from the Work page's card grids (see inc/template-helpers.php,
 * zoe_portfolio_grid()). No page builder needed here: title, category,
 * featured image, and the post's own content, in the site's real system
 * (zoe-* classes, current tokens) rather than the Mel-derived markup still
 * in single-post.php.
 *
 * Two columns (.zoe-portfolio-layout, zoe.css): the project itself on the
 * left (eyebrow, featured image, title, body, back link — image now comes
 * before the title, not after); a right-hand sidebar listing every other
 * published portfolio project, grouped under the same two category
 * headings Work's own card grids use, image + title only, no excerpt.
 */

get_header();

while ( have_posts() ) : the_post();
    $cats       = get_the_category();
    $cat_name   = $cats ? $cats[0]->name : '';
    // Always the Work page itself, not the category archive — Lara's
    // call; every project's "back" should land in the same place.
    $work_link  = home_url( '/work/' );
    $current_id = get_the_ID();

    // Same two categories, same order, as Work's own card grids
    // (page-work.php / zoe_portfolio_grid()).
    $sidebar_categories = [
        'stem-curriculum-kits'                 => 'STEM Curriculum & Kits',
        'learning-design-instructional-guides' => 'Learning Design & Instructional Guides',
    ];
?>

<main class="zoe-main" id="main">

  <article class="zoe-section zoe-section--intro zoe-portfolio-layout">

    <div class="zoe-portfolio-main">
      <?php if ( $cat_name ) : ?>
        <div class="eyebrow"><?php echo esc_html( $cat_name ); ?></div>
      <?php endif; ?>

      <?php if ( has_post_thumbnail() ) : ?>
        <img src="<?php the_post_thumbnail_url( 'large' ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>"
             style="width:100%; border-radius: var(--radius-lg); margin-bottom: var(--sp-32);">
      <?php endif; ?>

      <h1 class="zoe-section__heading"><?php the_title(); ?></h1>

      <div class="body-copy page-content" style="max-width: 70ch;">
        <?php the_content(); ?>
      </div>

      <div class="zoe-ctas" style="margin-top: var(--sp-48);">
        <a class="btn-ghost btn-ghost--dark" href="<?php echo esc_url( $work_link ); ?>">
          <svg width="13" height="13" viewBox="0 0 14 14" fill="none" style="transform: rotate(180deg);"><path d="M2 7h10M7 2l5 5-5 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
          Back to Work
        </a>
      </div>
    </div>

    <aside class="zoe-portfolio-sidebar">
      <?php foreach ( $sidebar_categories as $slug => $label ) :
          $projects = get_posts( [
              'post_type'   => 'portfolio',
              'category_name' => $slug,
              'numberposts' => -1,
              'post_status' => 'publish',
              'orderby'     => 'menu_order date',
              'order'       => 'DESC',
              'exclude'     => [ $current_id ],
          ] );
          if ( ! $projects ) {
              continue;
          }
      ?>
        <h3><?php echo esc_html( $label ); ?></h3>
        <ul>
          <?php foreach ( $projects as $p ) : ?>
            <li>
              <a href="<?php echo esc_url( get_permalink( $p ) ); ?>">
                <?php if ( has_post_thumbnail( $p ) ) : ?>
                  <img src="<?php echo esc_url( get_the_post_thumbnail_url( $p, 'thumbnail' ) ); ?>" alt="<?php echo esc_attr( get_the_title( $p ) ); ?>" loading="lazy">
                <?php endif; ?>
                <span><?php echo esc_html( get_the_title( $p ) ); ?></span>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php endforeach; ?>
    </aside>

  </article>

</main>

<?php
endwhile;

get_footer();
