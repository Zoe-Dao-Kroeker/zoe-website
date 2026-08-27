<?php
/**
 * Template Name: Work
 *
 * Zoe Dao-Kroeker Custom Theme — page-work.php
 * Content comes from the "Work Page Content" ACF field group
 * (inc/acf-fields.php, group_zoe_work).
 */

get_header();

if ( have_posts() ) :
    the_post();
?>

<main class="zoe-main" id="main">

  <section class="zoe-hero zoe-bg-block zoe-bg-block--sunburst zoe-hero--full">
    <div class="zoe-hero__copy">
      <?php if ( $eyebrow = get_field( 'intro_eyebrow' ) ) : ?>
        <div class="eyebrow"><?php echo esc_html( $eyebrow ); ?></div>
      <?php endif; ?>
      <?php if ( $heading = get_field( 'intro_heading' ) ) : ?>
        <h1 class="zoe-hero__heading"><?php echo esc_html( $heading ); ?></h1>
      <?php endif; ?>
      <?php if ( $text = get_field( 'intro_text' ) ) : ?>
        <p class="zoe-hero__intro"><?php echo esc_html( $text ); ?></p>
      <?php endif; ?>
    </div>
  </section>

  <section class="zoe-section">
    <?php if ( $eyebrow = get_field( 'featured_eyebrow' ) ) : ?>
      <div class="eyebrow"><?php echo esc_html( $eyebrow ); ?></div>
    <?php endif; ?>
    <?php if ( $title = get_field( 'featured_title' ) ) : ?>
      <h2 class="zoe-section__heading"><?php echo esc_html( $title ); ?></h2>
    <?php endif; ?>
    <?php if ( $description = get_field( 'featured_description' ) ) : ?>
      <p class="zoe-section__intro"><?php echo esc_html( $description ); ?></p>
    <?php endif; ?>
    <div class="zoe-ctas">
      <?php
      zoe_cta( get_field( 'featured_cta_primary' ) );
      zoe_cta( get_field( 'featured_cta_secondary' ), 'ghost' );
      ?>
    </div>
  </section>

  <section class="zoe-section">
    <?php if ( $eyebrow = get_field( 'stem_eyebrow' ) ) : ?>
      <div class="eyebrow"><?php echo esc_html( $eyebrow ); ?></div>
    <?php endif; ?>
    <?php zoe_portfolio_grid( 'stem-curriculum-kits' ); ?>
  </section>

  <section class="zoe-section">
    <?php if ( $eyebrow = get_field( 'learning_eyebrow' ) ) : ?>
      <div class="eyebrow"><?php echo esc_html( $eyebrow ); ?></div>
    <?php endif; ?>
    <?php zoe_portfolio_grid( 'learning-design-instructional-guides' ); ?>
  </section>

</main>

<?php endif; ?>

<?php get_footer(); ?>
