<?php
/**
 * Template Name: Research
 *
 * Zoe Dao-Kroeker Custom Theme — page-research.php
 * Content comes from the "Research Page Content" ACF field group
 * (inc/acf-fields.php, group_zoe_research).
 */

get_header();

if ( have_posts() ) :
    the_post();
?>

<main class="zoe-main" id="main">

  <?php $hero_image = get_field( 'hero_image' ); ?>
  <section class="zoe-hero zoe-bg-block zoe-bg-block--lavender<?php echo $hero_image ? '' : ' zoe-hero--full'; ?>">
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
    <?php if ( $hero_image ) : ?>
      <div class="zoe-hero__media">
        <img src="<?php echo esc_url( $hero_image['url'] ); ?>" alt="<?php echo esc_attr( $hero_image['alt'] ); ?>">
      </div>
    <?php endif; ?>
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
    <?php if ( $eyebrow = get_field( 'problem_eyebrow' ) ) : ?>
      <div class="eyebrow"><?php echo esc_html( $eyebrow ); ?></div>
    <?php endif; ?>
    <?php if ( $heading = get_field( 'problem_heading' ) ) : ?>
      <h2 class="zoe-section__heading"><?php echo esc_html( $heading ); ?></h2>
    <?php endif; ?>
    <div class="zoe-section__intro">
      <?php the_field( 'problem_body' ); ?>
    </div>
    <?php if ( $question = get_field( 'problem_field_question' ) ) : ?>
      <div class="zoe-note"><strong>Field question:</strong> <?php echo esc_html( $question ); ?></div>
    <?php endif; ?>
  </section>

  <section class="zoe-section">
    <?php if ( $eyebrow = get_field( 'framework_eyebrow' ) ) : ?>
      <div class="eyebrow"><?php echo esc_html( $eyebrow ); ?></div>
    <?php endif; ?>
    <?php if ( $heading = get_field( 'framework_heading' ) ) : ?>
      <h2 class="zoe-section__heading"><?php echo esc_html( $heading ); ?></h2>
    <?php endif; ?>
    <?php if ( $intro = get_field( 'framework_intro' ) ) : ?>
      <p class="zoe-section__intro"><?php echo esc_html( $intro ); ?></p>
    <?php endif; ?>
    <?php if ( have_rows( 'framework_steps' ) ) : ?>
      <div class="zoe-process">
        <?php while ( have_rows( 'framework_steps' ) ) : the_row(); ?>
          <div class="zoe-process__step">
            <b><?php echo esc_html( get_sub_field( 'kicker' ) ); ?></b>
            <h4><?php echo esc_html( get_sub_field( 'title' ) ); ?></h4>
            <p><?php echo esc_html( get_sub_field( 'description' ) ); ?></p>
          </div>
        <?php endwhile; ?>
      </div>
    <?php endif; ?>
    <?php if ( have_rows( 'framework_cards' ) ) : ?>
      <div class="zoe-card-grid">
        <?php while ( have_rows( 'framework_cards' ) ) : the_row(); ?>
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
    <?php if ( $eyebrow = get_field( 'findings_eyebrow' ) ) : ?>
      <div class="eyebrow"><?php echo esc_html( $eyebrow ); ?></div>
    <?php endif; ?>
    <?php if ( $heading = get_field( 'findings_heading' ) ) : ?>
      <h2 class="zoe-section__heading"><?php echo esc_html( $heading ); ?></h2>
    <?php endif; ?>
    <?php if ( have_rows( 'findings_cards' ) ) : ?>
      <div class="zoe-feature">
        <?php while ( have_rows( 'findings_cards' ) ) : the_row(); ?>
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
    <?php if ( $eyebrow = get_field( 'matters_eyebrow' ) ) : ?>
      <div class="eyebrow"><?php echo esc_html( $eyebrow ); ?></div>
    <?php endif; ?>
    <?php if ( have_rows( 'matters_cards' ) ) : ?>
      <div class="zoe-card-grid">
        <?php while ( have_rows( 'matters_cards' ) ) : the_row(); ?>
          <div class="zoe-card">
            <div class="zoe-card__tag"><?php echo esc_html( get_sub_field( 'tag' ) ); ?></div>
            <h3 class="zoe-card__title"><?php echo esc_html( get_sub_field( 'title' ) ); ?></h3>
            <p class="zoe-card__description"><?php echo esc_html( get_sub_field( 'description' ) ); ?></p>
          </div>
        <?php endwhile; ?>
      </div>
    <?php endif; ?>
  </section>

</main>

<?php endif; ?>

<?php get_footer(); ?>
