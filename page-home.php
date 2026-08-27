<?php
/**
 * Template Name: Home
 *
 * Zoe Dao-Kroeker Custom Theme — page-home.php
 * Content comes from the "Home Page Content" ACF field group
 * (inc/acf-fields.php, group_zoe_home). No hardcoded copy: every string
 * below is an editable field so Zoe can update this page from wp-admin.
 *
 * Markup is intentionally unstyled beyond the zoe- class names — real tokens
 * and CSS land in a later phase, once a brand exists (see
 * ZOE-website-status.md → "No brand on record").
 */

get_header();

if ( have_posts() ) :
    the_post();
?>

<main class="zoe-main" id="main">

  <section class="zoe-hero">
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
      <div class="zoe-ctas">
        <?php
        zoe_cta( get_field( 'hero_cta_primary' ) );
        zoe_cta( get_field( 'hero_cta_secondary' ), 'ghost' );
        ?>
      </div>
    </div>
    <?php $hero_image = get_field( 'hero_image' ); ?>
    <div class="zoe-hero__media">
      <?php if ( $hero_image ) : ?>
        <img src="<?php echo esc_url( $hero_image['url'] ); ?>" alt="<?php echo esc_attr( $hero_image['alt'] ); ?>">
      <?php endif; ?>
    </div>
  </section>

  <?php if ( have_rows( 'stats' ) ) : ?>
    <section class="zoe-statbar">
      <?php while ( have_rows( 'stats' ) ) : the_row(); ?>
        <div class="zoe-stat">
          <b><?php echo esc_html( get_sub_field( 'number' ) ); ?></b>
          <span><?php echo esc_html( get_sub_field( 'label' ) ); ?></span>
        </div>
      <?php endwhile; ?>
    </section>
  <?php endif; ?>

  <section class="zoe-section">
    <?php if ( $eyebrow = get_field( 'research_eyebrow' ) ) : ?>
      <div class="eyebrow"><?php echo esc_html( $eyebrow ); ?></div>
    <?php endif; ?>
    <?php if ( $heading = get_field( 'research_heading' ) ) : ?>
      <h2 class="zoe-section__heading"><?php echo esc_html( $heading ); ?></h2>
    <?php endif; ?>
    <?php if ( $intro = get_field( 'research_intro' ) ) : ?>
      <p class="zoe-section__intro"><?php echo esc_html( $intro ); ?></p>
    <?php endif; ?>
    <div class="zoe-ctas">
      <?php
      zoe_cta( get_field( 'research_cta_primary' ) );
      zoe_cta( get_field( 'research_cta_secondary' ), 'ghost' );
      ?>
    </div>
  </section>

  <section class="zoe-section">
    <?php if ( $eyebrow = get_field( 'work_eyebrow' ) ) : ?>
      <div class="eyebrow"><?php echo esc_html( $eyebrow ); ?></div>
    <?php endif; ?>
    <?php if ( $heading = get_field( 'work_heading' ) ) : ?>
      <h2 class="zoe-section__heading"><?php echo esc_html( $heading ); ?></h2>
    <?php endif; ?>
    <?php if ( $intro = get_field( 'work_intro' ) ) : ?>
      <p class="zoe-section__intro"><?php echo esc_html( $intro ); ?></p>
    <?php endif; ?>
    <?php if ( have_rows( 'work_cards' ) ) : ?>
      <div class="zoe-card-grid">
        <?php while ( have_rows( 'work_cards' ) ) : the_row(); ?>
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
    <?php if ( $eyebrow = get_field( 'process_eyebrow' ) ) : ?>
      <div class="eyebrow"><?php echo esc_html( $eyebrow ); ?></div>
    <?php endif; ?>
    <?php if ( $heading = get_field( 'process_heading' ) ) : ?>
      <h2 class="zoe-section__heading"><?php echo esc_html( $heading ); ?></h2>
    <?php endif; ?>
    <?php if ( have_rows( 'process_steps' ) ) : ?>
      <div class="zoe-process">
        <?php while ( have_rows( 'process_steps' ) ) : the_row(); ?>
          <div class="zoe-process__step">
            <b><?php echo esc_html( get_sub_field( 'kicker' ) ); ?></b>
            <h4><?php echo esc_html( get_sub_field( 'title' ) ); ?></h4>
            <p><?php echo esc_html( get_sub_field( 'description' ) ); ?></p>
          </div>
        <?php endwhile; ?>
      </div>
    <?php endif; ?>
  </section>

</main>

<?php endif; ?>

<?php get_footer(); ?>
