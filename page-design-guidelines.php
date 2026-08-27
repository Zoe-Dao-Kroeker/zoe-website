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
 * AI-readable export (added August 27, 2026, same audit that found the
 * .zoe-note colour bug and the stale h1 label below): the swatch hex values
 * only exist once JS runs getComputedStyle() in a real browser — a tool that
 * just fetches this URL's HTML sees none of them. zoe_design_tokens_for_ai()
 * (inc/template-helpers.php) reads colors_and_type.css directly and prints
 * a plain JSON block server-side, so any AI tool given this page's URL gets
 * real values with no JS execution required. See the <script type=
 * "application/json"> block right after this header, and the plain-English
 * paragraph above it for tools that only read visible text.
 */

get_header();
$zoe_ai_tokens = zoe_design_tokens_for_ai();
?>

<main class="zoe-main dg" id="main">

  <!-- ============================================================
       Header
       ============================================================ -->
  <header class="dg-header">
    <div class="eyebrow">Zoe Dao-Kroeker</div>
    <h1 class="dg-h1">Design Guidelines</h1>
    <p class="dg-lede">Colour, type, and the small decisions underneath them — read directly off this site's own stylesheet, so this page can't say something the site doesn't already do.</p>
    <p class="dg-tagline">&ldquo;I design how kids learn — and study what happens when AI joins the room.&rdquo;</p>
    <div class="dg-meta">
      <span>Draft</span><span>v1.0</span><span>Built by Lara Kroeker Interactive</span>
      <span>Sources: <a href="<?php echo esc_url( home_url( '/wp-content/themes/zoe-theme/colors_and_type.css' ) ); ?>">colors_and_type.css</a></span>
    </div>
  </header>

  <!-- ============================================================
       For AI tools reading this page: plain-text summary first (for a
       tool that only reads visible text), then a full machine-readable
       JSON block right after (for anything that parses page source).
       Both are generated from colors_and_type.css, not hand-typed.
       ============================================================ -->
  <p class="dg-ai-summary">
    For AI tools: this site's core palette is Dark <?php echo esc_html( $zoe_ai_tokens['colors']['primitives']['dark'] ?? '' ); ?>,
    Coral <?php echo esc_html( $zoe_ai_tokens['colors']['primitives']['coral'] ?? '' ); ?>,
    Magenta <?php echo esc_html( $zoe_ai_tokens['colors']['primitives']['magenta'] ?? '' ); ?>,
    Green <?php echo esc_html( $zoe_ai_tokens['colors']['primitives']['green'] ?? '' ); ?>,
    Blue <?php echo esc_html( $zoe_ai_tokens['colors']['primitives']['blue'] ?? '' ); ?>,
    and CTA amber <?php echo esc_html( $zoe_ai_tokens['colors']['primitives']['cta'] ?? '' ); ?>. Body/UI type is Open Sans;
    Fontdiner Swanky is used for H1s and hero headlines only. Full colour, type,
    spacing and radius values are in the JSON block below this paragraph.
  </p>
  <script type="application/json" id="zoe-design-tokens"><?php echo wp_json_encode( $zoe_ai_tokens, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES ); ?></script>

  <!-- ============================================================
       01 — Foundation
       ============================================================ -->
  <section class="dg-section" id="foundation">
    <div class="eyebrow">01 — Foundation</div>
    <h2 class="zoe-section__heading">What this practice stands for.</h2>

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
    <h2 class="zoe-section__heading">One version, for now.</h2>
    <p class="zoe-section__intro">No light/dark pair exists yet — this is the real file, not a placeholder for one that doesn't.</p>
    <div class="dg-logo-card">
      <img src="<?php echo esc_url( home_url( '/wp-content/uploads/2021/08/ZDK-Logo-File.webp' ) ); ?>" alt="Zoe Dao-Kroeker logo" style="max-height:120px;">
      <div class="dg-ctas">
        <a class="btn-pill" href="<?php echo esc_url( home_url( '/wp-content/uploads/2021/08/ZDK-Logo-File.webp' ) ); ?>" download>Download logo<span class="arr" aria-hidden="true"><svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M2.5 11.5L11.5 2.5M11.5 2.5H4.5M11.5 2.5V9.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg></span></a>
      </div>
    </div>
  </section>

  <!-- ============================================================
       03 — Photography
       ============================================================ -->
  <?php
  $dg_photos = [
      [ 'file' => '/wp-content/uploads/2025/08/Line-Following-Robot.webp', 'alt' => 'Line Following Robot kit' ],
      [ 'file' => '/wp-content/uploads/2025/08/Mecanum-Drive-Car.webp', 'alt' => 'Mecanum Drive Car kit' ],
      [ 'file' => '/wp-content/uploads/2025/08/Electric-Piano.webp', 'alt' => 'Electric Piano circuit build' ],
      [ 'file' => '/wp-content/uploads/2025/08/Skating-Robot.webp', 'alt' => 'Skating Robot project' ],
      [ 'file' => '/wp-content/uploads/2025/08/Cart-Pushing-Bot.webp', 'alt' => 'Cart Pushing Robot field trip guide' ],
  ];
  ?>
  <section class="dg-section" id="photography">
    <div class="eyebrow">03 — Photography</div>
    <h2 class="zoe-section__heading">Real kits, not stock.</h2>
    <p class="zoe-section__intro">Pulled from the actual STEM curriculum photography already in the media library — the same kits named on the Work page.</p>
    <div class="dg-photo-grid">
      <?php foreach ( $dg_photos as $photo ) : ?>
        <img src="<?php echo esc_url( home_url( $photo['file'] ) ); ?>" alt="<?php echo esc_attr( $photo['alt'] ); ?>" loading="lazy">
      <?php endforeach; ?>
    </div>
  </section>

  <!-- ============================================================
       04 — Icons
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
    <div class="eyebrow">04 — Icons</div>
    <h2 class="zoe-section__heading">Static, for utility and inline use.</h2>
    <p class="zoe-section__intro">Phosphor, Light weight, always this suffix. A sample below, <?php echo (int) count( glob( $dg_icon_dir . '/*.svg' ) ); ?> in the full set.</p>
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
       05 — Colour
       ============================================================ -->
  <section class="dg-section" id="colour">
    <div class="eyebrow">05 — Colour</div>
    <h2 class="zoe-section__heading">Four groups, always in this order.</h2>
    <p class="zoe-section__intro">Every swatch below renders from its real CSS variable, and the hex printed under it is read live via <code>getComputedStyle()</code> — if the token file drifts, this page drifts with it.</p>

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
       06 — Type
       ============================================================ -->
  <section class="dg-section" id="type">
    <div class="eyebrow">06 — Type</div>
    <h2 class="zoe-section__heading">Open Sans, Fontdiner Swanky.</h2>
    <p class="zoe-section__intro">Two families, on purpose — Instrument Serif and JetBrains Mono (both carried over from LKI's system at first) were dropped August 24, 2026.</p>

    <div class="dg-type-families">
      <div><span class="dg-type-label">Display / H1 only</span><div class="dg-type-glyph" style="font-family: var(--font-display); font-weight: 400;">Aa</div><span class="dg-type-sub">Fontdiner Swanky · 400</span></div>
      <div><span class="dg-type-label">UI / body / H2+</span><div class="dg-type-glyph" style="font-family: var(--font-sans); font-weight: var(--fw-black);">Aa</div><span class="dg-type-sub">Open Sans · Light 300 / Black 800</span></div>
    </div>

    <?php
    // Printed ranges below are computed from colors_and_type.css via
    // zoe_type_range(), not typed in — the h1 row used to read "42→77px"
    // after the token had already been resized to 35→67px (caught in the
    // August 27, 2026 audit). Can't go stale again since it's not text
    // anyone maintains by hand.
    $zoe_tokens = zoe_read_design_tokens();
    $dg_type_meta = function ( $name, $font = '' ) use ( $zoe_tokens ) {
        $r = zoe_type_range( $zoe_tokens[ '--type-' . $name ] ?? '' );
        printf(
            '--type-%s &middot; %s&rarr;%spx %s%s',
            esc_html( $name ),
            esc_html( $r['min'] ),
            esc_html( $r['max'] ),
            $r['fluid'] ? 'fluid' : 'fixed',
            $font ? ' &middot; ' . esc_html( $font ) : ''
        );
    };
    ?>
    <div class="dg-type-scale">
      <div class="dg-type-row"><span class="eyebrow" style="margin:0">Eyebrow</span><span class="dg-type-meta">--type-micro · 12px fixed, tracked</span></div>
      <div class="dg-type-row"><span style="font-family:var(--font-display); font-size:var(--type-display); line-height:var(--type-display-lh); font-weight:400;">Hero headline</span><span class="dg-type-meta"><?php $dg_type_meta( 'display', 'Fontdiner Swanky' ); ?></span></div>
      <div class="dg-type-row"><span style="font-family:var(--font-display); font-size:var(--type-h1); line-height:var(--type-h1-lh); font-weight:400;">Page title</span><span class="dg-type-meta"><?php $dg_type_meta( 'h1', 'Fontdiner Swanky' ); ?></span></div>
      <div class="dg-type-row"><span style="font-size:var(--type-h2); line-height:var(--type-h2-lh); font-weight:var(--fw-black);">Section heading</span><span class="dg-type-meta"><?php $dg_type_meta( 'h2' ); ?></span></div>
      <div class="dg-type-row"><span style="font-size:var(--type-h4); line-height:var(--type-h4-lh); font-weight:var(--fw-black);">Card title</span><span class="dg-type-meta"><?php $dg_type_meta( 'h4' ); ?></span></div>
      <div class="dg-type-row"><span style="font-size:var(--type-lead); line-height:var(--type-lead-lh);">Lead paragraph, for openings and introductions.</span><span class="dg-type-meta"><?php $dg_type_meta( 'lead' ); ?></span></div>
      <div class="dg-type-row"><span style="font-size:var(--type-body-lg); line-height:var(--type-body-lg-lh);">Intro paragraph, a step above body copy.</span><span class="dg-type-meta"><?php $dg_type_meta( 'body-lg' ); ?></span></div>
      <div class="dg-type-row"><span style="font-size:var(--type-body); line-height:var(--type-body-lh);">Body copy, the standard reading size used everywhere else.</span><span class="dg-type-meta"><?php $dg_type_meta( 'body' ); ?></span></div>
      <div class="dg-type-row"><span style="font-size:var(--type-small); line-height:var(--type-small-lh);">Small text, for captions, buttons and list items.</span><span class="dg-type-meta"><?php $dg_type_meta( 'small' ); ?></span></div>
    </div>
  </section>

  <!-- ============================================================
       07 — Spacing
       ============================================================ -->
  <section class="dg-section" id="spacing">
    <div class="eyebrow">07 — Spacing</div>
    <h2 class="zoe-section__heading">Space. Shape. Depth.</h2>
    <p class="zoe-section__intro">Spacing sets the rhythm, radius gives every edge its character, elevation decides what sits above what.</p>

    <h3 class="dg-sub">Spacing</h3>
    <div class="dg-spacing-row">
      <?php
      $dg_sp = [
          [ '120', 'Section breaks' ], [ '80', 'Section padding' ], [ '64', 'Large card padding' ],
          [ '48', 'Between blocks' ], [ '32', 'Grid gutters' ], [ '24', 'Card padding' ],
          [ '16', 'Paragraph rhythm' ], [ '12', 'Label to field' ], [ '8', 'Inside components' ], [ '4', 'Hairline gaps' ],
      ];
      foreach ( $dg_sp as $step ) :
      ?>
        <div class="dg-sp-item">
          <div class="dg-sp-bar" style="width: <?php echo max( 4, (int) $step[0] * 0.9 ); ?>px; height: <?php echo max( 4, (int) $step[0] * 0.9 ); ?>px;"></div>
          <b><?php echo esc_html( $step[0] ); ?></b>
          <span><?php echo esc_html( $step[1] ); ?></span>
        </div>
      <?php endforeach; ?>
    </div>

    <h3 class="dg-sub">Radius</h3>
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
       08 — Buttons
       ============================================================ -->
  <section class="dg-section" id="buttons">
    <div class="eyebrow">08 — Buttons</div>
    <h2 class="zoe-section__heading">One dark pill. One flash of CTA yellow.</h2>
    <p class="zoe-section__intro">Three levels of emphasis: a filled pill for the main action, an outline for the secondary one, a ghost link for everything else. Aim for one filled pill per view.</p>
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
