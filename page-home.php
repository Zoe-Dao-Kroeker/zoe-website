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

  <!-- Moved directly under the hero, eyebrow dropped, white step backgrounds
       removed (.zoe-process--plain) — Lara's call, August 27, 2026. Heading
       still renders; only the "How I work" label above it is gone. -->
  <section class="zoe-section">
    <?php if ( $heading = get_field( 'process_heading' ) ) : ?>
      <h2 class="zoe-section__heading"><?php echo esc_html( $heading ); ?></h2>
    <?php endif; ?>
    <?php if ( have_rows( 'process_steps' ) ) : ?>
      <div class="zoe-process zoe-process--plain">
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

  <section class="zoe-section zoe-section--split">
    <div class="zoe-section__copy">
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
    </div>
    <div class="zoe-section__media">
      <?php
      /* Hand-drawn, not uploaded: a fixed decorative illustration for the
         1930s-airship study this section describes, styled/coloured to
         match the reference Lara supplied (cream body, gold diagonal
         band, tan fin and gondola) rather than Zoe's own brand palette —
         this one illustration isn't meant to be swapped per-project the
         way the hero images are, so it's inline markup, not an ACF field. */
      ?>
      <svg viewBox="0 0 420 260" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Illustration of a 1930s airship">
        <defs>
          <clipPath id="airshipBody">
            <path d="M20,130 C20,78 110,52 210,58 C295,63 355,92 388,122 C396,127 396,133 388,138 C355,168 295,197 210,202 C110,208 20,182 20,130 Z" />
          </clipPath>
        </defs>
        <g clip-path="url(#airshipBody)">
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
            <?php $card_image = get_sub_field( 'image' ); ?>
            <?php if ( $card_image ) : ?>
              <img class="zoe-card__image" src="<?php echo esc_url( $card_image['sizes']['medium_large'] ?? $card_image['url'] ); ?>" alt="<?php echo esc_attr( $card_image['alt'] ); ?>" loading="lazy">
            <?php endif; ?>
            <?php if ( $tag = get_sub_field( 'tag' ) ) : ?>
              <div class="zoe-card__tag"><?php echo esc_html( $tag ); ?></div>
            <?php endif; ?>
            <?php if ( $title = get_sub_field( 'title' ) ) : ?>
              <h3 class="zoe-card__title"><?php echo esc_html( $title ); ?></h3>
            <?php endif; ?>
            <?php if ( $description = get_sub_field( 'description' ) ) : ?>
              <p class="zoe-card__description"><?php echo esc_html( $description ); ?></p>
            <?php endif; ?>
            <?php $link_url = get_sub_field( 'link_url' ); $link_label = get_sub_field( 'link_label' ); ?>
            <?php if ( $link_url && $link_label ) : ?>
              <div class="zoe-ctas">
                <a class="btn-ghost btn-ghost--dark" href="<?php echo esc_url( $link_url ); ?>">
                  <?php echo esc_html( $link_label ); ?>
                  <svg width="13" height="13" viewBox="0 0 14 14" fill="none"><path d="M2 7h10M7 2l5 5-5 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                </a>
              </div>
            <?php endif; ?>
          </div>
        <?php endwhile; ?>
      </div>
    <?php endif; ?>
  </section>

</main>

<?php endif; ?>

<?php get_footer(); ?>
