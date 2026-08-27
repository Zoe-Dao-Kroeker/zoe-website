<?php
/**
 * Template Name: About
 *
 * Zoe Dao-Kroeker Custom Theme — page-about.php
 * Content comes from the "About Page Content" ACF field group
 * (inc/acf-fields.php, group_zoe_about).
 */

get_header();

if ( have_posts() ) :
    the_post();
?>

<main class="zoe-main" id="main">

  <?php $hero_image = get_field( 'hero_image' ); ?>
  <section class="zoe-hero zoe-bg-block zoe-bg-block--green<?php echo $hero_image ? '' : ' zoe-hero--full'; ?>">
    <div class="zoe-hero__copy">
      <?php if ( $eyebrow = get_field( 'hero_eyebrow' ) ) : ?>
        <div class="eyebrow"><?php echo esc_html( $eyebrow ); ?></div>
      <?php endif; ?>
      <?php if ( $heading = get_field( 'hero_heading' ) ) : ?>
        <h1 class="zoe-hero__heading"><?php echo esc_html( $heading ); ?></h1>
      <?php endif; ?>
      <?php if ( $intro = get_field( 'hero_intro' ) ) : ?>
        <p class="zoe-hero__intro"><?php echo esc_html( $intro ); ?></p>
      <?php endif; ?>
    </div>
    <?php if ( $hero_image ) : ?>
      <div class="zoe-hero__media">
        <img src="<?php echo esc_url( $hero_image['url'] ); ?>" alt="<?php echo esc_attr( $hero_image['alt'] ); ?>">
      </div>
    <?php endif; ?>
  </section>

  <section class="zoe-section">
    <?php if ( $eyebrow = get_field( 'background_eyebrow' ) ) : ?>
      <div class="eyebrow"><?php echo esc_html( $eyebrow ); ?></div>
    <?php endif; ?>
    <?php if ( have_rows( 'background_blocks' ) ) : ?>
      <div class="zoe-process">
        <?php while ( have_rows( 'background_blocks' ) ) : the_row(); ?>
          <div class="zoe-process__step">
            <b><?php echo esc_html( get_sub_field( 'kicker' ) ); ?></b>
            <h4><?php echo esc_html( get_sub_field( 'title' ) ); ?></h4>
            <div><?php the_sub_field( 'body' ); ?></div>
          </div>
        <?php endwhile; ?>
      </div>
    <?php endif; ?>
  </section>

  <section class="zoe-section">
    <?php if ( $eyebrow = get_field( 'publications_eyebrow' ) ) : ?>
      <div class="eyebrow"><?php echo esc_html( $eyebrow ); ?></div>
    <?php endif; ?>
    <?php if ( have_rows( 'publications_cards' ) ) : ?>
      <div class="zoe-card-grid">
        <?php while ( have_rows( 'publications_cards' ) ) : the_row(); ?>
          <div class="zoe-card">
            <div class="zoe-card__tag"><?php echo esc_html( get_sub_field( 'tag' ) ); ?></div>
            <h3 class="zoe-card__title"><?php echo esc_html( get_sub_field( 'title' ) ); ?></h3>
            <p class="zoe-card__description"><?php echo esc_html( get_sub_field( 'description' ) ); ?></p>
          </div>
        <?php endwhile; ?>
      </div>
    <?php endif; ?>
  </section>

  <section class="zoe-section">
    <?php if ( $eyebrow = get_field( 'facilitation_eyebrow' ) ) : ?>
      <div class="eyebrow"><?php echo esc_html( $eyebrow ); ?></div>
    <?php endif; ?>
    <?php if ( have_rows( 'facilitation_cards' ) ) : ?>
      <div class="zoe-card-grid">
        <?php while ( have_rows( 'facilitation_cards' ) ) : the_row(); ?>
          <div class="zoe-card">
            <div class="zoe-card__tag"><?php echo esc_html( get_sub_field( 'tag' ) ); ?></div>
            <h3 class="zoe-card__title"><?php echo esc_html( get_sub_field( 'title' ) ); ?></h3>
            <p class="zoe-card__description"><?php echo esc_html( get_sub_field( 'description' ) ); ?></p>
          </div>
        <?php endwhile; ?>
      </div>
    <?php endif; ?>
  </section>

  <section class="zoe-section zoe-section--center">
    <?php if ( $heading = get_field( 'closing_heading' ) ) : ?>
      <h2 class="zoe-section__heading"><?php echo esc_html( $heading ); ?></h2>
    <?php endif; ?>
    <?php if ( $text = get_field( 'closing_text' ) ) : ?>
      <p class="zoe-section__intro"><?php echo esc_html( $text ); ?></p>
    <?php endif; ?>
    <div class="zoe-ctas zoe-ctas--center">
      <?php
      zoe_cta( get_field( 'closing_cta_primary' ) );
      zoe_cta( get_field( 'closing_cta_secondary' ), 'ghost' );
      ?>
    </div>
  </section>

</main>

<?php endif; ?>

<?php get_footer(); ?>
