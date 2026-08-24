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

  <section class="zoe-section zoe-section--intro">
    <?php if ( $eyebrow = get_field( 'intro_eyebrow' ) ) : ?>
      <div class="zoe-eyebrow"><?php echo esc_html( $eyebrow ); ?></div>
    <?php endif; ?>
    <?php if ( $heading = get_field( 'intro_heading' ) ) : ?>
      <h1 class="zoe-section__heading"><?php echo esc_html( $heading ); ?></h1>
    <?php endif; ?>
    <?php if ( $text = get_field( 'intro_text' ) ) : ?>
      <p class="zoe-section__intro"><?php echo esc_html( $text ); ?></p>
    <?php endif; ?>
  </section>

  <section class="zoe-section">
    <?php if ( $eyebrow = get_field( 'featured_eyebrow' ) ) : ?>
      <div class="zoe-eyebrow"><?php echo esc_html( $eyebrow ); ?></div>
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
      <div class="zoe-eyebrow"><?php echo esc_html( $eyebrow ); ?></div>
    <?php endif; ?>
    <?php if ( have_rows( 'stem_cards' ) ) : ?>
      <div class="zoe-card-grid">
        <?php while ( have_rows( 'stem_cards' ) ) : the_row(); ?>
          <div class="zoe-card">
            <div class="zoe-card__tag"><?php echo esc_html( get_sub_field( 'tag' ) ); ?></div>
            <h3 class="zoe-card__title"><?php echo esc_html( get_sub_field( 'title' ) ); ?></h3>
          </div>
        <?php endwhile; ?>
      </div>
    <?php endif; ?>
  </section>

  <section class="zoe-section">
    <?php if ( $eyebrow = get_field( 'learning_eyebrow' ) ) : ?>
      <div class="zoe-eyebrow"><?php echo esc_html( $eyebrow ); ?></div>
    <?php endif; ?>
    <?php if ( have_rows( 'learning_cards' ) ) : ?>
      <div class="zoe-card-grid">
        <?php while ( have_rows( 'learning_cards' ) ) : the_row(); ?>
          <div class="zoe-card">
            <div class="zoe-card__tag"><?php echo esc_html( get_sub_field( 'tag' ) ); ?></div>
            <h3 class="zoe-card__title"><?php echo esc_html( get_sub_field( 'title' ) ); ?></h3>
          </div>
        <?php endwhile; ?>
      </div>
    <?php endif; ?>
  </section>

</main>

<?php endif; ?>

<?php get_footer(); ?>
