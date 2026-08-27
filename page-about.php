<?php
/**
 * Template Name: About
 *
 * Zoe Dao-Kroeker Custom Theme — page-about.php
 * Content comes from the "About Page Content" ACF field group
 * (inc/acf-fields.php, group_zoe_about).
 *
 * Reworked August 27, 2026 from a set of layout mockups Lara supplied —
 * same site tokens/components throughout (zoe.css, colors_and_type.css),
 * different arrangement per section than the rest of the site uses:
 * an alternating photo/text timeline (Background), an asymmetric
 * featured-card layout (Publications), a fixed sidebar beside a stacked
 * card list (Facilitation), and a bordered CTA bar (Closing) in place of
 * the plain centred section the rest of the site's closing sections use.
 * No content changed from what was already in ACF — just how it renders.
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
    <div class="zoe-timeline-intro">
      <?php if ( $eyebrow = get_field( 'background_eyebrow' ) ) : ?>
        <div class="eyebrow"><?php echo esc_html( $eyebrow ); ?></div>
      <?php endif; ?>
      <?php if ( $heading = get_field( 'background_heading' ) ) : ?>
        <h2 class="zoe-section__heading"><?php echo esc_html( $heading ); ?></h2>
      <?php endif; ?>
      <?php if ( $intro = get_field( 'background_intro' ) ) : ?>
        <p class="zoe-section__intro"><?php echo esc_html( $intro ); ?></p>
      <?php endif; ?>
    </div>

    <?php
    // Plain array (not have_rows/the_row) so the last row can be popped
    // off and rendered as the dark closing panel instead of another
    // timeline entry.
    $bg_blocks   = get_field( 'background_blocks' ) ?: [];
    $final_block = count( $bg_blocks ) > 1 ? array_pop( $bg_blocks ) : null;
    ?>

    <?php if ( $bg_blocks ) : ?>
      <div class="zoe-timeline">
        <?php foreach ( $bg_blocks as $i => $block ) : ?>
          <div class="zoe-timeline__row<?php echo ( $i % 2 === 1 ) ? ' zoe-timeline__row--reverse' : ''; ?>">
            <div class="zoe-timeline__copy">
              <?php if ( ! empty( $block['kicker'] ) ) : ?>
                <div class="eyebrow"><?php echo esc_html( $block['kicker'] ); ?></div>
              <?php endif; ?>
              <?php if ( ! empty( $block['title'] ) ) : ?>
                <h3 class="zoe-timeline__title"><?php echo esc_html( $block['title'] ); ?></h3>
              <?php endif; ?>
              <?php if ( ! empty( $block['body'] ) ) : ?>
                <div class="body-copy"><?php echo $block['body']; ?></div>
              <?php endif; ?>
            </div>
            <?php if ( ! empty( $block['image'] ) ) : ?>
              <div class="zoe-timeline__media">
                <img src="<?php echo esc_url( $block['image']['url'] ); ?>" alt="<?php echo esc_attr( $block['image']['alt'] ); ?>" loading="lazy">
              </div>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <?php if ( $final_block ) : ?>
      <div class="zoe-timeline__final zoe-section--dark">
        <?php if ( ! empty( $final_block['kicker'] ) ) : ?>
          <div class="eyebrow"><?php echo esc_html( $final_block['kicker'] ); ?></div>
        <?php endif; ?>
        <?php if ( ! empty( $final_block['title'] ) ) : ?>
          <h2 class="zoe-section__heading"><?php echo esc_html( $final_block['title'] ); ?></h2>
        <?php endif; ?>
        <?php if ( ! empty( $final_block['body'] ) ) : ?>
          <div class="body-copy zoe-timeline__final-body"><?php echo $final_block['body']; ?></div>
        <?php endif; ?>
        <?php if ( $tags = get_field( 'background_final_tags' ) ) : ?>
          <div class="zoe-tag-list">
            <?php foreach ( array_filter( array_map( 'trim', explode( ',', $tags ) ) ) as $tag ) : ?>
              <span class="zoe-tag"><?php echo esc_html( $tag ); ?></span>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>
    <?php endif; ?>
  </section>

  <section class="zoe-section">
    <?php if ( $eyebrow = get_field( 'publications_eyebrow' ) ) : ?>
      <div class="eyebrow"><?php echo esc_html( $eyebrow ); ?></div>
    <?php endif; ?>
    <?php if ( $heading = get_field( 'publications_heading' ) ) : ?>
      <h2 class="zoe-section__heading"><?php echo esc_html( $heading ); ?></h2>
    <?php endif; ?>
    <?php
    $pub_cards          = get_field( 'publications_cards' ) ?: [];
    $pub_featured       = array_shift( $pub_cards );
    $pub_featured_image = get_field( 'publications_featured_image' );
    ?>
    <?php if ( $pub_featured || $pub_cards ) : ?>
      <?php
      // Back to one uniform grid, all cards the same size — the
      // asymmetric featured-card layout left an awkward empty gap under
      // the first card whenever it had no image, which is every card
      // right now. array_unshift puts the featured one back at the
      // front instead of losing its position.
      if ( $pub_featured ) {
          array_unshift( $pub_cards, $pub_featured );
      }
      ?>
      <div class="zoe-card-grid">
        <?php foreach ( $pub_cards as $i => $card ) : ?>
          <div class="zoe-card<?php echo ! empty( $card['highlight'] ) ? ' zoe-card--highlight' : ''; ?>">
            <?php if ( ! empty( $card['tag'] ) ) : ?>
              <div class="zoe-card__tag"><?php echo esc_html( $card['tag'] ); ?></div>
            <?php endif; ?>
            <?php if ( ! empty( $card['title'] ) ) : ?>
              <h3 class="zoe-card__title"><?php echo esc_html( $card['title'] ); ?></h3>
            <?php endif; ?>
            <?php if ( ! empty( $card['description'] ) ) : ?>
              <p class="zoe-card__description"><?php echo esc_html( $card['description'] ); ?></p>
            <?php endif; ?>
            <?php if ( $i === 0 && $pub_featured_image ) : ?>
              <img src="<?php echo esc_url( $pub_featured_image['url'] ); ?>" alt="<?php echo esc_attr( $pub_featured_image['alt'] ); ?>" style="width:100%; border-radius: var(--radius-md); margin-top: var(--sp-16);" loading="lazy">
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </section>

  <section class="zoe-section">
    <div class="zoe-facilitation-split">
      <div>
        <?php if ( $eyebrow = get_field( 'facilitation_eyebrow' ) ) : ?>
          <div class="eyebrow"><?php echo esc_html( $eyebrow ); ?></div>
        <?php endif; ?>
        <?php if ( $heading = get_field( 'facilitation_heading' ) ) : ?>
          <h2 class="zoe-section__heading"><?php echo esc_html( $heading ); ?></h2>
        <?php endif; ?>
        <?php if ( $intro = get_field( 'facilitation_intro' ) ) : ?>
          <p class="zoe-section__intro"><?php echo esc_html( $intro ); ?></p>
        <?php endif; ?>
        <?php if ( $fac_image = get_field( 'facilitation_image' ) ) : ?>
          <img class="zoe-facilitation-split__photo" src="<?php echo esc_url( $fac_image['url'] ); ?>" alt="<?php echo esc_attr( $fac_image['alt'] ); ?>" loading="lazy">
        <?php endif; ?>
      </div>
      <?php if ( $fac_cards = get_field( 'facilitation_cards' ) ) : ?>
        <div class="zoe-facilitation-split__list">
          <?php foreach ( $fac_cards as $card ) : ?>
            <div class="zoe-facilitation-split__item<?php echo ! empty( $card['highlight'] ) ? ' zoe-facilitation-split__item--highlight' : ''; ?>">
              <?php if ( ! empty( $card['tag'] ) ) : ?>
                <div class="zoe-card__tag"><?php echo esc_html( $card['tag'] ); ?></div>
              <?php endif; ?>
              <?php if ( ! empty( $card['title'] ) ) : ?>
                <h3 class="zoe-card__title"><?php echo esc_html( $card['title'] ); ?></h3>
              <?php endif; ?>
              <?php if ( ! empty( $card['description'] ) ) : ?>
                <p class="zoe-card__description"><?php echo esc_html( $card['description'] ); ?></p>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
  </section>

  <section class="zoe-section">
    <div class="zoe-cta-bar">
      <div>
        <?php if ( $heading = get_field( 'closing_heading' ) ) : ?>
          <h2 class="zoe-cta-bar__heading"><?php echo esc_html( $heading ); ?></h2>
        <?php endif; ?>
        <?php if ( $text = get_field( 'closing_text' ) ) : ?>
          <p class="zoe-cta-bar__text"><?php echo esc_html( $text ); ?></p>
        <?php endif; ?>
      </div>
      <div class="zoe-ctas">
        <?php
        zoe_cta( get_field( 'closing_cta_primary' ) );
        zoe_cta( get_field( 'closing_cta_secondary' ), 'ghost' );
        ?>
      </div>
    </div>
  </section>

</main>

<?php endif; ?>

<?php get_footer(); ?>
