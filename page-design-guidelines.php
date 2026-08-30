<?php
/**
 * Template Name: Design Guidelines
 *
 * Zoe Dao-Kroeker Custom Theme — page-design-guidelines.php
 *
 * Follows the section list and conventions in
 * ../../WORKSPACE-design-guidelines-playbook.md, structurally mirroring
 * larakroekerinteractive.com/design-guidelines/ per Lara's instruction —
 * same section order, same self-checking swatch mechanism, Zoe's own
 * colours/logo/photography/copy.
 *
 * The page must be incapable of lying: every swatch below renders from
 * `background: var(--token)`, and the hex printed under it is read live
 * from the rendered element via getComputedStyle(), not typed in. If
 * colors_and_type.css drifts, this page drifts with it.
 *
 * AI-readable export: the swatch hex values only exist once JS runs
 * getComputedStyle() in a real browser — a tool that just fetches this
 * URL's HTML sees none of them. zoe_design_tokens_for_ai()
 * (inc/template-helpers.php) reads colors_and_type.css directly, so the
 * export carries real values with no JS execution required.
 *
 * Aug 30, 2026: that export moved OFF this page and onto two routes,
 * /llms.txt and /design-guidelines/?ai=1 (see zoe_serve_ai_export() in
 * functions.php), matching every other brand in the workspace. The
 * visible "For AI tools:" paragraph and the <script type=
 * "application/json"> island that used to sit here were removed with
 * it — nothing on the page is addressed to a machine any more. The rule
 * now is that if a model can't find a value, that's a gap in the
 * guidelines for humans too, and gets fixed there.
 */

get_header();
?>

<main class="zoe-main dg" id="main">

  <!-- ============================================================
       Header
       ============================================================ -->
  <header class="dg-header zoe-bg-block zoe-bg-block--dark">
    <div class="eyebrow">Zoe Dao-Kroeker</div>
    <h1 class="dg-h1">Design Guidelines</h1>
    <p class="dg-lede">The source of truth for the Zoe Dao-Kroeker visual identity &mdash; colour, type, logos, photography, icons, spacing, and the rules around them. Follow these whenever you create or update anything for the site.</p>
    <p class="dg-ai-line">Built to be read by people and AI alike &mdash; a plain-text version is at <a href="<?php echo esc_url( home_url( '/llms.txt' ) ); ?>">/llms.txt</a>.</p>

    <div class="dg-meta">
      <div class="dg-meta__item">
        <p class="dg-meta__label">Draft</p>
        <p class="dg-meta__value">v<?php echo esc_html( wp_get_theme()->get( 'Version' ) ); ?> (Aug 2026)</p>
      </div>
      <div class="dg-meta__item">
        <p class="dg-meta__label">Built by</p>
        <p class="dg-meta__value">Lara Kroeker</p>
      </div>
      <div class="dg-meta__item">
        <p class="dg-meta__label">Sources</p>
        <p class="dg-meta__value">
          <a href="<?php echo esc_url( get_stylesheet_directory_uri() . '/colors_and_type.css' ); ?>">Token file</a> &middot;
          <a href="<?php echo esc_url( home_url( '/llms.txt' ) ); ?>">Plain text for AI</a> &middot;
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Live site</a>
        </p>
      </div>
    </div>
  </header>


  <!-- ============================================================
       01 — Foundation
       ============================================================ -->
  <section class="dg-section" id="foundation">
    <div class="eyebrow">01 — Foundation</div>
    <h2 class="zoe-section__heading">Purpose, vision, and mission.</h2>

    <div class="dg-pvm">
      <div class="dg-pvm__item">
        <h3>Purpose</h3>
        <p>To design learning experiences and AI tools that keep young people thinking for themselves — and to bring ten years of doing that hands-on into a team building what comes next in education technology.</p>
      </div>
      <div class="dg-pvm__item">
        <h3>Vision</h3>
        <p>A classroom where AI makes kids sharper, more curious thinkers — not a shortcut that quietly does the thinking for them.</p>
      </div>
      <div class="dg-pvm__item">
        <h3>Mission</h3>
        <p>Turn a decade of STEM curriculum design and a research-backed framework for AI literacy into work people can see, trust, and want to hire.</p>
      </div>
    </div>

    <div class="eyebrow" style="margin-top: var(--sp-56)">Voice &amp; Mood</div>
    <div class="dg-tags">
      <span class="dg-tag">Curious</span>
      <span class="dg-tag">Grounded</span>
      <span class="dg-tag">Direct</span>
      <span class="dg-tag">Warm</span>
      <span class="dg-tag">Rigorous</span>
    </div>
  </section>

  <!-- ============================================================
       02 — Logo
       ============================================================ -->
  <section class="dg-section" id="logo">
    <div class="eyebrow">02 — Logo</div>
    <h2 class="zoe-section__heading">Logo files, light and dark.</h2>
    <p class="zoe-section__intro">Two versions: one for light backgrounds, one for dark.</p>
    <div class="dg-logo-row">
      <div class="dg-logo-card">
        <img src="<?php echo esc_url( home_url( '/wp-content/uploads/2026/08/ZDK-Logo-Light.png' ) ); ?>" alt="Zoe Dao-Kroeker logo, for light backgrounds" style="max-height:120px;">
        <div class="dg-ctas">
          <a class="btn-pill" href="<?php echo esc_url( home_url( '/wp-content/uploads/2026/08/ZDK-Logo-Light.png' ) ); ?>" download>For light backgrounds<span class="arr" aria-hidden="true"><svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M2.5 11.5L11.5 2.5M11.5 2.5H4.5M11.5 2.5V9.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg></span></a>
        </div>
      </div>
      <div class="dg-logo-card dg-logo-card--dark">
        <img src="<?php echo esc_url( home_url( '/wp-content/uploads/2026/08/ZDK-Logo-Dark.png' ) ); ?>" alt="Zoe Dao-Kroeker logo, for dark backgrounds" style="max-height:120px;">
        <div class="dg-ctas">
          <a class="btn-ghost" href="<?php echo esc_url( home_url( '/wp-content/uploads/2026/08/ZDK-Logo-Dark.png' ) ); ?>" download>For dark backgrounds<svg width="13" height="13" viewBox="0 0 14 14" fill="none"><path d="M2 7h10M7 2l5 5-5 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg></a>
        </div>
      </div>
    </div>
  </section>

  <!-- ============================================================
       03 — Photography
       ============================================================ -->
  <?php
  // Product shots of the STEM curriculum kits (Line Following Robot, Mecanum
  // Drive Car, Electric Piano, Skating Robot, Cart Pushing Bot) were removed
  // August 30, 2026 at Lara's request. This list is now populated purely from
  // the About page below — no hardcoded photos.
  $dg_photos = [];
  // About page photos (August 27, 2026, Lara: "for photography add photos
  // from the about page") — read live off the About page's own ACF fields
  // rather than a second hardcoded list, so a new photo added there shows
  // up here too. Skips rows with no image (the closing dark panel row has
  // none) and the hero illustration (a drawn graphic, not a photo).
  $dg_about_blocks = get_field( 'background_blocks', 12773 ) ?: [];
  foreach ( $dg_about_blocks as $block ) {
      if ( ! empty( $block['image']['url'] ) ) {
          $dg_photos[] = [
              'file' => $block['image']['url'],
              'alt'  => $block['title'] ?? 'Photo from the About page',
              'raw'  => true,
          ];
      }
  }
  ?>
  <section class="dg-section" id="photography">
    <div class="eyebrow">03 — Photography</div>
    <h2 class="zoe-section__heading">Photography from the site.</h2>
    <p class="zoe-section__intro">Real photos already in use &mdash; the people and process photos from the About page.</p>
    <div class="dg-photo-grid">
      <?php foreach ( $dg_photos as $photo ) :
          $src = ! empty( $photo['raw'] ) ? esc_url( $photo['file'] ) : esc_url( home_url( $photo['file'] ) );
      ?>
        <img src="<?php echo $src; ?>" alt="<?php echo esc_attr( $photo['alt'] ); ?>" loading="lazy">
      <?php endforeach; ?>
    </div>
  </section>

  <!-- ============================================================
       04 — Illustration
       ============================================================ -->
  <?php
  // Read these out of the media library rather than hardcoding a list, same
  // rule as Photography above: this page documents what the site actually
  // uses, so a new illustration uploaded for a page appears here on its own.
  // Matches the "... hero illustration" naming the existing art already uses.
  $dg_illos = get_posts( [
      'post_type'      => 'attachment',
      'post_mime_type' => 'image',
      'post_status'    => 'inherit',
      'posts_per_page' => 12,
      's'              => 'illustration',
      'orderby'        => 'title',
      'order'          => 'ASC',
  ] );
  ?>
  <?php if ( $dg_illos ) : ?>
  <section class="dg-section" id="illustration">
    <div class="eyebrow">04 — Illustration</div>
    <h2 class="zoe-section__heading">Illustration.</h2>
    <p class="zoe-section__intro">The drawn character illustrations, one per page hero. Flat vector, consistent character and palette throughout, each on a transparent ground so it can sit on any of the page colours.</p>
    <div class="dg-illo-grid">
      <?php foreach ( $dg_illos as $dg_illo ) :
          $dg_illo_src = wp_get_attachment_image_url( $dg_illo->ID, 'large' );
          if ( ! $dg_illo_src ) {
              continue;
          }
          $dg_illo_alt = get_post_meta( $dg_illo->ID, '_wp_attachment_image_alt', true );
      ?>
        <figure class="dg-illo">
          <img src="<?php echo esc_url( $dg_illo_src ); ?>" alt="<?php echo esc_attr( $dg_illo_alt ? $dg_illo_alt : $dg_illo->post_title ); ?>" loading="lazy">
          <figcaption><?php echo esc_html( $dg_illo->post_title ); ?></figcaption>
        </figure>
      <?php endforeach; ?>
    </div>
  </section>
  <?php endif; ?>

  <!-- ============================================================
       05 — Icons
       ============================================================ -->
  <?php
  $dg_icon_dir = get_theme_file_path( 'assets-icons/System Icons' );
  $dg_icon_dir_uri = get_theme_file_uri( 'assets-icons/System Icons' );
  $dg_icon_sample = [
      'lightbulb-filament', 'brain', 'robot', 'graduation-cap', 'flask',
      'game-controller', 'lightning-a', 'compass', 'chat-centered-dots',
      'lock-key', 'gear', 'heart', 'map-pin-area', 'moon', 'music-notes',
      'paint-brush-broad', 'house', 'globe-hemisphere-east',
  ];
  ?>
  <section class="dg-section" id="icons">
    <div class="eyebrow">05 — Icons</div>
    <h2 class="zoe-section__heading">Icon set.</h2>
    <p class="zoe-section__intro">Phosphor icons, Light weight. A sample below — <?php echo (int) count( glob( $dg_icon_dir . '/*.svg' ) ); ?> icons in the full set.</p>
    <div class="dg-icon-grid">
      <?php foreach ( $dg_icon_sample as $icon ) :
          $icon_path = $dg_icon_dir . '/' . $icon . '-light.svg';
          if ( ! file_exists( $icon_path ) ) {
              continue;
          }
      ?>
        <div class="dg-icon-cell">
          <img src="<?php echo esc_url( $dg_icon_dir_uri . '/' . rawurlencode( $icon . '-light.svg' ) ); ?>" width="28" height="28" alt="" loading="lazy">
          <span><?php echo esc_html( $icon ); ?></span>
        </div>
      <?php endforeach; ?>
    </div>
    <a class="btn-ghost btn-ghost--dark" href="<?php echo esc_url( home_url( '/icon-library/' ) ); ?>" style="margin-top: var(--sp-24);">Browse the full library, <?php echo (int) count( glob( $dg_icon_dir . '/*.svg' ) ); ?> icons<svg width="13" height="13" viewBox="0 0 14 14" fill="none"><path d="M2 7h10M7 2l5 5-5 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg></a>
  </section>

  <!-- ============================================================
       06 — Colour
       ============================================================ -->
  <section class="dg-section" id="colour">
    <div class="eyebrow">06 — Colour</div>
    <h2 class="zoe-section__heading">Colour palette.</h2>
    <p class="zoe-section__intro">Every swatch below shows its real colour and hex code, read live from the site's own stylesheet.</p>

    <div class="dg-swatch-group">
      <h3>Surface</h3>
      <div class="dg-swatch-row">
        <div class="dg-swatch-item"><div class="dg-swatch" data-token="--zoe-white" data-label="White" data-note="Cards and raised surfaces"></div></div>
        <div class="dg-swatch-item"><div class="dg-swatch" data-token="--zoe-neutral" data-label="Neutral" data-note="Default page canvas"></div></div>
        <div class="dg-swatch-item"><div class="dg-swatch dg-swatch--dark" data-token="--zoe-dark" data-label="Dark" data-note="Nav pill, footer accents"></div></div>
      </div>
    </div>

    <div class="dg-swatch-group">
      <h3>Primary</h3>
      <!-- No per-swatch usage notes here on purpose (Lara, August 27, 2026):
           two of the four had gone wrong ("illustration accent" / "icon
           strokes" — neither was actually true) and stayed wrong until this
           audit caught them. Hex + label is what this page can guarantee is
           correct; a written rule about exactly where/how to use a colour is
           the kind of thing that's easy to get subtly wrong and then have an
           AI tool (or a person) follow too literally. Less to get wrong. -->
      <div class="dg-swatch-row">
        <div class="dg-swatch-item"><div class="dg-swatch" data-token="--zoe-coral" data-label="Coral"></div></div>
        <div class="dg-swatch-item"><div class="dg-swatch dg-swatch--dark" data-token="--zoe-magenta" data-label="Magenta"></div></div>
        <div class="dg-swatch-item"><div class="dg-swatch" data-token="--zoe-green" data-label="Green"></div></div>
        <div class="dg-swatch-item"><div class="dg-swatch" data-token="--zoe-blue" data-label="Blue"></div></div>
      </div>
    </div>

    <div class="dg-swatch-group">
      <h3>Greys</h3>
      <div class="dg-swatch-row dg-swatch-row--5">
        <div class="dg-swatch-item"><div class="dg-swatch dg-swatch--dark" data-token="--zoe-grey-1" data-label="Grey 1" data-note="Any text"></div></div>
        <div class="dg-swatch-item"><div class="dg-swatch dg-swatch--dark" data-token="--zoe-grey-2" data-label="Grey 2" data-note="Body text"></div></div>
        <div class="dg-swatch-item"><div class="dg-swatch" data-token="--zoe-grey-3" data-label="Grey 3" data-note="Large text only"></div></div>
        <div class="dg-swatch-item"><div class="dg-swatch" data-token="--zoe-grey-4" data-label="Grey 4" data-note="Fills and dividers"></div></div>
        <div class="dg-swatch-item"><div class="dg-swatch" data-token="--zoe-grey-5" data-label="Grey 5" data-note="Hairline borders"></div></div>
      </div>
    </div>

    <div class="dg-swatch-group">
      <h3>CTA</h3>
      <div class="dg-swatch-row">
        <div class="dg-swatch-item"><div class="dg-swatch" data-token="--zoe-cta" data-label="CTA" data-note="Buttons and links"></div></div>
        <div class="dg-swatch-item"><div class="dg-swatch" data-token="--zoe-cta-dark" data-label="CTA dark" data-note="Pressed state"></div></div>
        <div class="dg-swatch-item"><div class="dg-swatch" data-token="--zoe-cta-light" data-label="CTA light" data-note="Tinted background"></div></div>
      </div>
    </div>

  </section>

  <!-- ============================================================
       07 — Type
       ============================================================ -->
  <section class="dg-section" id="type">
    <div class="eyebrow">07 — Type</div>
    <h2 class="zoe-section__heading">Fonts and type sizes.</h2>
    <p class="zoe-section__intro">Two fonts, used across the whole site: Open Sans for everything, and Fontdiner Swanky for page titles and hero headlines only.</p>

    <div class="dg-type-families">
      <div><span class="dg-type-label">Display / H1 only</span><div class="dg-type-glyph" style="font-family: var(--font-display); font-weight: var(--fw-regular);">Aa</div><span class="dg-type-sub">Fontdiner Swanky · 400</span></div>
      <div><span class="dg-type-label">UI / body / H2+</span><div class="dg-type-glyph" style="font-family: var(--font-sans); font-weight: var(--fw-black);">Aa</div><span class="dg-type-sub">Open Sans &middot; Light 300 (lead/intro) &middot; Body 400 &middot; Semibold 600 (h3) &middot; Bold 700 (h2) &middot; Black 800 (h1, h4)</span></div>
    </div>

    <?php
    // Printed ranges below are computed from colors_and_type.css via
    // zoe_type_range(), not typed in — the h1 row used to read "42→77px"
    // after the token had already been resized to 35→67px (caught in the
    // August 27, 2026 audit). Can't go stale again since it's not text
    // anyone maintains by hand.
    $zoe_tokens = zoe_read_design_tokens();
    /**
     * Type row meta. Prints three things a reader actually needs:
     *
     *   1. The HTML element the role maps to (H1-H4, P, SPAN). This is
     *      the document outline, so it is an SEO fact, not decoration —
     *      "Section heading" means nothing to a crawler, <h2> does.
     *   2. The CSS truth, including the fluid range.
     *   3. A portable size in BOTH px and pt, because a clamp() cannot be
     *      typed into any tool that isn't a browser and those tools ask
     *      for different units: Canva, Figma and social templates want
     *      px; PowerPoint, Word and Google Docs want pt. px x 0.75 = pt.
     *
     * The portable size uses the MAX of a fluid range — that is the size
     * the design is drawn at, and a slide or document is a wide surface.
     */
    $dg_type_meta = function ( $name, $tag = '', $font = '' ) use ( $zoe_tokens ) {
        $r  = zoe_type_range( $zoe_tokens[ '--type-' . $name ] ?? '' );
        $px = $r['max'];
        $pt = rtrim( rtrim( number_format( round( $px * 0.75, 1 ), 1 ), '0' ), '.' );
        printf(
            '%s--type-%s &middot; %s&rarr;%spx %s%s<br><span class="dg-type-portable">%spx &middot; %spt &mdash; slides, docs &amp; social</span>',
            $tag ? '<span class="dg-type-tag">' . esc_html( $tag ) . '</span> ' : '',
            esc_html( $name ),
            esc_html( $r['min'] ),
            esc_html( $r['max'] ),
            $r['fluid'] ? 'fluid' : 'fixed',
            $font ? ' &middot; ' . esc_html( $font ) : '',
            esc_html( $px ),
            esc_html( $pt )
        );
    };
    ?>
    <div class="dg-type-scale">
      <div class="dg-type-row"><span class="eyebrow" style="margin:0">Eyebrow</span><span class="dg-type-meta"><?php $dg_type_meta( 'micro', 'SPAN' ); ?></span></div>
      <div class="dg-type-row"><span style="font-family:var(--font-display); font-size:var(--type-h1); line-height:var(--type-h1-lh); font-weight:var(--fw-regular);">Page title</span><span class="dg-type-meta"><?php $dg_type_meta( 'h1', 'H1', 'Fontdiner Swanky' ); ?></span></div>
      <div class="dg-type-row"><h2 style="font-size:var(--type-h2); line-height:var(--type-h2-lh);">Section heading</h2><span class="dg-type-meta"><?php $dg_type_meta( 'h2', 'H2' ); ?></span></div>
      <div class="dg-type-row"><h3 style="font-size:var(--type-h3); line-height:var(--type-h3-lh);">Subheading</h3><span class="dg-type-meta"><?php $dg_type_meta( 'h3', 'H3' ); ?></span></div>
      <div class="dg-type-row"><h4 style="font-size:var(--type-h4); line-height:var(--type-h4-lh);">Card title</h4><span class="dg-type-meta"><?php $dg_type_meta( 'h4', 'H4' ); ?></span></div>
      <div class="dg-type-row"><span style="font-size:var(--type-lead); line-height:var(--type-lead-lh); font-weight:var(--fw-light);">Lead paragraph, for openings and introductions.</span><span class="dg-type-meta"><?php $dg_type_meta( 'lead', 'P' ); ?></span></div>
      <div class="dg-type-row"><span style="font-size:var(--type-body); line-height:var(--type-body-lh);">Body copy, the standard reading size used everywhere else.</span><span class="dg-type-meta"><?php $dg_type_meta( 'body', 'P' ); ?></span></div>
      <div class="dg-type-row"><span style="font-size:var(--type-small); line-height:var(--type-small-lh);">Small text, for captions, buttons and list items.</span><span class="dg-type-meta"><?php $dg_type_meta( 'small', 'P' ); ?></span></div>
    </div>

    <?php
    /**
     * Weights. The page documented the type SCALE but never the weights,
     * while the site uses five of them — so the source of truth was
     * silent on half of its own typography. Added Aug 30, 2026.
     *
     * Values are read from the tokens, and the sample renders at the
     * weight it names, so a wrong number here would be visible rather
     * than merely wrong.
     */
    $zoe_weights = array(
      array( 'light',    'Light',    'Lead paragraphs and intros' ),
      array( 'regular',  'Regular',  'Body copy, and the H1 display face' ),
      array( 'semibold', 'Semibold', 'H3 subheadings' ),
      array( 'bold',     'Bold',     'H2, H4, card titles' ),
      array( 'black',    'Black',    'Nav, emphasis, the heaviest level' ),
    );
    ?>
    <h3 class="dg-subhead">Weights</h3>
    <div class="dg-weight-scale">
      <?php foreach ( $zoe_weights as $w ) :
        list( $key, $label, $use ) = $w;
        $val = trim( $zoe_tokens[ '--fw-' . $key ] ?? '' );
      ?>
        <div class="dg-type-row">
          <span style="font-weight:var(--fw-<?php echo esc_attr( $key ); ?>); font-size:var(--type-h4);"><?php echo esc_html( $label ); ?></span>
          <span class="dg-type-meta">
            <span class="dg-type-tag"><?php echo esc_html( $val ); ?></span>
            --fw-<?php echo esc_html( $key ); ?>
            <br><span class="dg-type-portable"><?php echo esc_html( $use ); ?></span>
          </span>
        </div>
      <?php endforeach; ?>
    </div>

  </section>

  <!-- ============================================================
       08 — Spacing
       ============================================================ -->
  <section class="dg-section" id="spacing">
    <div class="eyebrow">08 — Spacing</div>
    <h2 class="zoe-section__heading">Spacing, corners, and shadows.</h2>
    <p class="zoe-section__intro">The spacing scale, corner-radius options, and shadow styles used across the site.</p>

    <h3 class="dg-sub">Spacing</h3>
    <?php
    // Defined before the row so the sentence can be printed above the blocks
    // while still being generated from the same array that draws them. The
    // per-block captions became this one sentence (Lara, August 30, 2026):
    // they wrapped to one or two lines each, which was what knocked the blocks
    // and their numbers off a shared baseline. Generated, not typed, so
    // editing the scale rewrites the prose with it.
    $dg_sp = [
          [ '120', 'Section breaks' ], [ '80', 'Section padding' ], [ '64', 'Large card padding' ],
          [ '48', 'Between blocks' ], [ '32', 'Grid gutters' ], [ '24', 'Card padding' ],
          [ '16', 'Paragraph rhythm' ], [ '12', 'Label to field' ], [ '8', 'Inside components' ], [ '4', 'Hairline gaps' ],
    ];
    $dg_sp_prose = [];
    foreach ( $dg_sp as $step ) {
        $dg_sp_prose[] = $step[0] . ' ' . strtolower( $step[1] );
    }
    $dg_sp_last  = array_pop( $dg_sp_prose );
    $dg_sp_words = implode( ', ', $dg_sp_prose ) . ', and ' . $dg_sp_last;
    ?>
    <p class="dg-scale-note">Ten steps, each with a job: <?php echo esc_html( $dg_sp_words ); ?>.</p>
    <div class="dg-spacing-row">
      <?php
      foreach ( $dg_sp as $step ) :
      ?>
        <div class="dg-sp-item">
          <?php // Emit the raw step as a custom property and let CSS size the block.
                // Inline width/height would beat the mobile media query on specificity,
                // which is how the 120 block used to overflow its column on a phone. ?>
          <div class="dg-sp-bar" style="--dg-sp-step: <?php echo (int) $step[0]; ?>;"></div>
          <b><?php echo esc_html( $step[0] ); ?></b>
        </div>
      <?php endforeach; ?>
    </div>

    <h3 class="dg-sub">Radius</h3>
    <p class="dg-scale-note">Six steps, and the rule is that bigger surfaces take rounder corners: 0 for square edges, 6px on dense UI, 14px on cards, 20px on image wells, 32px on large panels like the hero blocks, and a full pill for buttons and tags.</p>
    <div class="dg-radius-row">
      <div class="dg-radius-item"><div class="dg-radius-box" style="border-radius: var(--radius-none);"></div><b>0</b><span>Square</span></div>
      <div class="dg-radius-item"><div class="dg-radius-box" style="border-radius: var(--radius-sm);"></div><b>6px</b><span>Dense UI</span></div>
      <div class="dg-radius-item"><div class="dg-radius-box" style="border-radius: var(--radius-md);"></div><b>14px</b><span>Cards</span></div>
      <div class="dg-radius-item"><div class="dg-radius-box" style="border-radius: var(--radius-lg);"></div><b>20px</b><span>Image wells</span></div>
      <div class="dg-radius-item"><div class="dg-radius-box" style="border-radius: var(--radius-xl);"></div><b>32px</b><span>Large surfaces</span></div>
      <div class="dg-radius-item"><div class="dg-radius-box" style="border-radius: var(--radius-pill); width:80px;"></div><b>pill</b><span>CTAs</span></div>
    </div>

    <h3 class="dg-sub">Elevation</h3>
    <div class="zoe-card-grid">
      <div class="card"><b>Flat</b><p>Hairline border, default rest</p></div>
      <div class="card" style="box-shadow: var(--shadow-xs);"><b>Shadow XS</b><p>Hover lift on cards</p></div>
      <div class="card" style="box-shadow: var(--shadow-inset-hairline);"><b>Inset hairline</b><p>Pill button bottom edge</p></div>
    </div>
  </section>

  <!-- ============================================================
       09 — Buttons
       ============================================================ -->
  <section class="dg-section" id="buttons">
    <div class="eyebrow">09 — Buttons</div>
    <h2 class="zoe-section__heading">Buttons.</h2>
    <p class="zoe-section__intro">Three styles: a filled pill for the main action on a page, an outline for a secondary action, and a plain text link for everything else.</p>
    <div class="dg-btn-demo">
      <div class="dg-btn-demo__panel">
        <div class="eyebrow">On light</div>
        <div class="dg-ctas">
          <a class="btn-pill" href="#" onclick="return false">Book a call<span class="arr" aria-hidden="true"><svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M2.5 11.5L11.5 2.5M11.5 2.5H4.5M11.5 2.5V9.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg></span></a>
          <a class="btn-outline" href="#" onclick="return false">Outline</a>
          <a class="btn-ghost btn-ghost--dark" href="#" onclick="return false">Ghost link<svg width="13" height="13" viewBox="0 0 14 14" fill="none"><path d="M2 7h10M7 2l5 5-5 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg></a>
        </div>
      </div>
    </div>
  </section>

</main>

<script>
(function () {
  // Self-checking colour swatches: the hex printed under each swatch is read
  // from the ACTUAL rendered colour via getComputedStyle(), never typed in —
  // if colors_and_type.css drifts, the printed hex drifts with it. Runs
  // immediately, not on DOMContentLoaded, since this script sits after the
  // swatches in the page rather than being deferred to the footer.
  //
  // Each swatch box lives inside a .dg-swatch-item wrapper; the meta block
  // is appended INTO that wrapper (not as a sibling of .dg-swatch within the
  // grid row), so swatch + meta stay one grid cell instead of splitting into
  // two — that split was the original bug here.
  function toHex(rgbStr) {
    var m = rgbStr.match(/\d+(\.\d+)?/g);
    if (!m) return '#000000';
    return '#' + m.slice(0, 3).map(function (n) {
      return ('0' + parseInt(n, 10).toString(16)).slice(-2);
    }).join('').toUpperCase();
  }

  document.querySelectorAll('.dg-swatch').forEach(function (el) {
    var token = el.getAttribute('data-token');
    var fixedHex = el.getAttribute('data-hex');
    if (token) {
      el.style.background = 'var(' + token + ')';
    } else if (fixedHex) {
      el.style.background = fixedHex;
    }
    var hex = toHex(getComputedStyle(el).backgroundColor);
    var note = el.getAttribute('data-note');
    var meta = document.createElement('div');
    meta.className = 'dg-swatch__meta';
    // Note span only exists when data-note is actually set (the four
    // Primary swatches deliberately have none, August 27, 2026 — see the
    // comment above them) — an empty <span> left a blank line under those.
    meta.innerHTML = '<b>' + (el.getAttribute('data-label') || '') + '</b>' +
      '<code>' + hex + '</code>' +
      '<span class="dg-swatch__token">' + (token || '') + '</span>' +
      (note ? '<span class="dg-swatch__note">' + note + '</span>' : '');
    el.parentElement.appendChild(meta);
  });
}());
</script>

<?php get_footer(); ?>
