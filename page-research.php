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
  <section class="zoe-hero zoe-bg-block zoe-bg-block--blue<?php echo $hero_image ? '' : ' zoe-hero--full'; ?>">
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

  <section class="zoe-section zoe-section--dark">
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
      <div class="zoe-process zoe-process--plain zoe-process--cols2">
        <?php while ( have_rows( 'framework_steps' ) ) : the_row(); ?>
          <div class="zoe-process__step">
            <b><?php echo esc_html( get_sub_field( 'kicker' ) ); ?></b>
            <h4><?php echo esc_html( get_sub_field( 'title' ) ); ?></h4>
            <p><?php echo esc_html( get_sub_field( 'description' ) ); ?></p>
          </div>
        <?php endwhile; ?>
      </div>
    <?php endif; ?>
    <?php /* framework_cards (design principle + the 4P-to-question cards)
             removed from display for now, Lara's call — the data is
             still there in ACF (Research Page Content -> The framework),
             just not rendered here. */ ?>
  </section>

  <section class="zoe-section">
    <?php if ( $eyebrow = get_field( 'demo_eyebrow' ) ) : ?>
      <div class="eyebrow"><?php echo esc_html( $eyebrow ); ?></div>
    <?php endif; ?>
    <?php if ( $heading = get_field( 'demo_heading' ) ) : ?>
      <h2 class="zoe-section__heading"><?php echo esc_html( $heading ); ?></h2>
    <?php endif; ?>
    <?php if ( $intro = get_field( 'demo_intro' ) ) : ?>
      <p class="zoe-section__intro"><?php echo esc_html( $intro ); ?></p>
    <?php endif; ?>
    <?php
    $demo_photo = get_field( 'demo_photo' );
    $demo_gifs  = array_filter( [ get_field( 'demo_gif_1' ), get_field( 'demo_gif_2' ), get_field( 'demo_gif_3' ) ] );
    $demo_items = $demo_photo ? array_merge( [ $demo_photo ], $demo_gifs ) : $demo_gifs;
    ?>
    <?php if ( $demo_items ) : ?>
      <div class="zoe-demo-grid">
        <?php foreach ( $demo_items as $item ) : ?>
          <img src="<?php echo esc_url( $item['url'] ); ?>" alt="<?php echo esc_attr( $item['alt'] ); ?>" loading="lazy">
        <?php endforeach; ?>
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
    <?php if ( $findings_intro = get_field( 'findings_intro' ) ) : ?>
      <p class="zoe-section__intro"><?php echo esc_html( $findings_intro ); ?></p>
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

  <section class="zoe-section zoe-section--split">
    <div class="zoe-section__copy">
      <?php if ( $eyebrow = get_field( 'prototype_eyebrow' ) ) : ?>
        <div class="eyebrow"><?php echo esc_html( $eyebrow ); ?></div>
      <?php endif; ?>
      <?php if ( $heading = get_field( 'prototype_heading' ) ) : ?>
        <h2 class="zoe-section__heading"><?php echo esc_html( $heading ); ?></h2>
      <?php endif; ?>
      <?php if ( $intro = get_field( 'prototype_intro' ) ) : ?>
        <p class="zoe-section__intro"><?php echo esc_html( $intro ); ?></p>
      <?php endif; ?>
    </div>
    <div class="zoe-section__media">
      <?php
      /* Same airship illustration used on Home's research teaser
         (page-home.php) — reused here rather than redrawn, since this
         section is literally about that prototype. */
      ?>
      <svg viewBox="0 0 420 260" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Illustration of a 1930s airship">
        <defs>
          <clipPath id="airshipBodyPrototype">
            <path d="M20,130 C20,78 110,52 210,58 C295,63 355,92 388,122 C396,127 396,133 388,138 C355,168 295,197 210,202 C110,208 20,182 20,130 Z" />
          </clipPath>
        </defs>
        <g clip-path="url(#airshipBodyPrototype)">
          <rect x="0" y="0" width="420" height="260" fill="#F4EFE4" />
          <polygon points="0,190 420,70 420,130 0,250" fill="#EDC24E" />
          <rect x="0" y="66" width="420" height="14" fill="#FFFFFF" opacity="0.55" />
          <line x1="0" y1="150" x2="420" y2="150" stroke="#C9BFA8" stroke-width="2" opacity="0.6" />
        </g>
        <path d="M20,130 C20,78 110,52 210,58 C295,63 355,92 388,122 C396,127 396,133 388,138 C355,168 295,197 210,202 C110,208 20,182 20,130 Z"
              fill="none" stroke="#2B1810" stroke-width="4" stroke-linejoin="round" />
        <path d="M348,92 L402,34 L388,100 Z" fill="#E8A15C" stroke="#2B1810" stroke-width="4" stroke-linejoin="round" />
        <rect x="168" y="196" width="72" height="30" rx="12" fill="#D9B25A" stroke="#2B1810" stroke-width="4" />
        <circle cx="186" cy="211" r="4" fill="#2B1810" />
        <circle cx="204" cy="211" r="4" fill="#2B1810" />
        <circle cx="222" cy="211" r="4" fill="#2B1810" />
      </svg>
    </div>
    <?php if ( have_rows( 'prototype_cards' ) ) : ?>
      <div class="zoe-card-grid zoe-section__full">
        <?php while ( have_rows( 'prototype_cards' ) ) : the_row(); ?>
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
    <?php if ( $matters_heading = get_field( 'matters_heading' ) ) : ?>
      <h2 class="zoe-section__heading"><?php echo esc_html( $matters_heading ); ?></h2>
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

  <section class="zoe-section">
    <?php if ( $eyebrow = get_field( 'piloting_eyebrow' ) ) : ?>
      <div class="eyebrow"><?php echo esc_html( $eyebrow ); ?></div>
    <?php endif; ?>
    <?php if ( $heading = get_field( 'piloting_heading' ) ) : ?>
      <h2 class="zoe-section__heading"><?php echo esc_html( $heading ); ?></h2>
    <?php endif; ?>
    <?php if ( $intro = get_field( 'piloting_intro' ) ) : ?>
      <p class="zoe-section__intro"><?php echo esc_html( $intro ); ?></p>
    <?php endif; ?>
    <?php if ( have_rows( 'piloting_trials' ) || have_rows( 'piloting_apply' ) ) : ?>
      <div class="zoe-piloting-cols">
        <?php if ( have_rows( 'piloting_trials' ) ) : ?>
          <div>
            <?php if ( $trials_label = get_field( 'piloting_trials_label' ) ) : ?>
              <h3><?php echo esc_html( $trials_label ); ?></h3>
            <?php endif; ?>
            <ol>
              <?php while ( have_rows( 'piloting_trials' ) ) : the_row(); ?>
                <li><?php echo esc_html( get_sub_field( 'item' ) ); ?></li>
              <?php endwhile; ?>
            </ol>
          </div>
        <?php endif; ?>
        <?php if ( have_rows( 'piloting_apply' ) ) : ?>
          <div>
            <?php if ( $apply_label = get_field( 'piloting_apply_label' ) ) : ?>
              <h3><?php echo esc_html( $apply_label ); ?></h3>
            <?php endif; ?>
            <ol>
              <?php while ( have_rows( 'piloting_apply' ) ) : the_row(); ?>
                <li><?php echo esc_html( get_sub_field( 'item' ) ); ?></li>
              <?php endwhile; ?>
            </ol>
          </div>
        <?php endif; ?>
      </div>
    <?php endif; ?>
  </section>

</main>

<?php endif; ?>

<?php get_footer(); ?>
