<?php
/**
 * Zoe Dao-Kroeker Custom Theme — inc/template-helpers.php
 * Small render helpers shared by the four page templates.
 */

/**
 * Returns `target`/`rel` attributes when $url points off-site, empty string
 * otherwise. Keeps CTA links (many of which point at external tools like the
 * 4P's AI Tool, or a résumé host) from needing a manual "opens in new tab"
 * field per link. Returns rather than echoes so it composes inside printf().
 *
 * @param string $url
 * @return string
 */
function zoe_external_link_atts( $url ) {
    if ( ! $url ) {
        return '';
    }
    $host = wp_parse_url( $url, PHP_URL_HOST );
    if ( $host && $host !== wp_parse_url( home_url(), PHP_URL_HOST ) ) {
        return ' target="_blank" rel="noopener noreferrer"';
    }
    return '';
}

/**
 * Prints a CTA <a> from an ACF sub-array shaped ['label' => ..., 'url' => ...],
 * skipping entirely if either half is empty. Used for every hero/section CTA
 * across all four templates so an editor leaving a CTA blank doesn't render
 * an empty link.
 *
 * Markup and arrow SVGs are copied from larakroekerinteractive.com/design-
 * guidelines/ — three variants, matching that site's button system exactly:
 * 'pill' (filled, diagonal arrow in a circle — the one primary action per
 * view), 'outline' (bordered, no arrow), 'ghost' (text only, straight arrow).
 *
 * @param array  $cta     ['label' => string, 'url' => string]
 * @param string $variant 'pill' (default), 'outline', or 'ghost'.
 */
function zoe_cta( $cta, $variant = 'pill' ) {
    if ( empty( $cta['label'] ) || empty( $cta['url'] ) ) {
        return;
    }

    $href = esc_url( $cta['url'] );
    $atts = zoe_external_link_atts( $cta['url'] );

    // The original wireframe copy baked an arrow glyph into the label text
    // itself (e.g. "See the work →", "Try the tool ↗"). Pill and ghost
    // variants below already render their own SVG arrow, so a baked-in
    // glyph doubles up. Strip a trailing arrow (with any spacing around it)
    // at render time rather than hand-editing every ACF field — catches
    // today's content and anything pasted in later the same way.
    $label = trim( preg_replace( '/\s*[\x{2192}\x{2197}\x{00BB}]+\s*$/u', '', $cta['label'] ) );
    $label = esc_html( $label );

    if ( 'outline' === $variant ) {
        printf( '<a class="btn-outline" href="%s"%s>%s</a>', $href, $atts, $label );
        return;
    }

    if ( 'ghost' === $variant ) {
        printf(
            '<a class="btn-ghost btn-ghost--dark" href="%s"%s>%s<svg width="13" height="13" viewBox="0 0 14 14" fill="none"><path d="M2 7h10M7 2l5 5-5 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg></a>',
            $href, $atts, $label
        );
        return;
    }

    printf(
        '<a class="btn-pill" href="%s"%s>%s<span class="arr" aria-hidden="true"><svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M2.5 11.5L11.5 2.5M11.5 2.5H4.5M11.5 2.5V9.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg></span></a>',
        $href, $atts, $label
    );
}

/**
 * Reads every `--token: value;` declaration straight out of
 * colors_and_type.css and returns them as ['--name' => 'raw css value'].
 * The Design Guidelines page's Type table and its AI-readable JSON export
 * both build off this instead of hand-typed numbers, so neither can drift
 * out of sync with the actual token file again (August 27, 2026 — the
 * page's h1 range label had gone stale after the token was resized, since
 * it was hand-typed prose, not derived).
 *
 * @return array<string,string>
 */
function zoe_read_design_tokens() {
    static $tokens = null;
    if ( null !== $tokens ) {
        return $tokens;
    }
    $tokens = [];
    $path = get_theme_file_path( 'colors_and_type.css' );
    if ( ! file_exists( $path ) ) {
        return $tokens;
    }
    $css = file_get_contents( $path );
    // Strip comments first so a --token mentioned in the header prose above
    // :root (there's a lot of it) never gets picked up as a declaration.
    $css = preg_replace( '#/\*.*?\*/#s', '', $css );
    if ( preg_match_all( '/(--[a-z0-9-]+)\s*:\s*([^;]+);/i', $css, $rows, PREG_SET_ORDER ) ) {
        foreach ( $rows as $row ) {
            $tokens[ $row[1] ] = trim( $row[2] );
        }
    }
    return $tokens;
}

/**
 * Converts a single rem or px value to a whole px number. Every token in
 * colors_and_type.css assumes a 16px root (nothing on this site overrides
 * html { font-size }), so the multiply is safe.
 *
 * @param string $value e.g. "2.2rem" or "14px"
 * @return int|null
 */
function zoe_rem_to_px( $value ) {
    if ( preg_match( '/([\d.]+)\s*rem/', $value, $m ) ) {
        return (int) round( (float) $m[1] * 16 );
    }
    if ( preg_match( '/([\d.]+)\s*px/', $value, $m ) ) {
        return (int) round( (float) $m[1] );
    }
    return null;
}

/**
 * Given a --type-* value — either a plain rem/px, or a clamp(min, preferred,
 * max) — returns ['min' => px, 'max' => px, 'fluid' => bool]. Powers both
 * the Type table's printed ranges and the AI-readable export.
 *
 * @param string $value
 * @return array{min:?int,max:?int,fluid:bool}
 */
function zoe_type_range( $value ) {
    if ( preg_match( '/^clamp\(\s*([^,]+),\s*([^,]+),\s*([^)]+)\)$/i', trim( $value ), $m ) ) {
        return [
            'min'   => zoe_rem_to_px( trim( $m[1] ) ),
            'max'   => zoe_rem_to_px( trim( $m[3] ) ),
            'fluid' => true,
        ];
    }
    $px = zoe_rem_to_px( $value );
    return [ 'min' => $px, 'max' => $px, 'fluid' => false ];
}

/**
 * Builds the AI-readable design-token export: real hex/px values only, no
 * prescriptive "use this colour for X" rules. Lara's explicit call (August
 * 27, 2026) after two of the hand-written swatch notes turned out wrong
 * ("illustration accent" / "icon strokes" — neither was true) — usage notes
 * are opinions that go stale; raw token values read straight off the CSS
 * file can't. An AI tool reading this page should get facts to reason from,
 * not rules that might be mis-stated and box it in.
 *
 * @return array
 */
function zoe_design_tokens_for_ai() {
    $t = zoe_read_design_tokens();

    $colors = [];
    foreach ( $t as $name => $value ) {
        if ( 0 === strpos( $name, '--zoe-' ) && preg_match( '/^#[0-9a-f]{3,6}$/i', $value ) ) {
            $colors[ str_replace( '--zoe-', '', $name ) ] = strtoupper( $value );
        }
    }

    // 'display' and 'body-lg' removed Aug 30, 2026 — both had zero call
    // sites outside their own specimen rows. Eight real roles.
    $type_names = [ 'h1', 'h2', 'h3', 'h4', 'lead', 'body', 'small', 'micro' ];
    $scale = [];
    foreach ( $type_names as $name ) {
        if ( isset( $t[ '--type-' . $name ] ) ) {
            $r = zoe_type_range( $t[ '--type-' . $name ] );
            $scale[ str_replace( '-', '_', $name ) ] = [
                'min_px' => $r['min'],
                'max_px' => $r['max'],
                'fluid'  => $r['fluid'],
                'line_height' => $t[ '--type-' . $name . '-lh' ] ?? null,
                // The size to use anywhere that isn't a browser — slides,
                // documents, social templates, print. A clamp() is
                // unusable in those tools; this is one number they accept.
                // px * 0.75 = pt, taken from the max because that is the
                // size the design is drawn at.
                'pt_for_print_and_slides' => round( $r['max'] * 0.75, 1 ),
            ];
        }
    }

    $spacing = [];
    foreach ( $t as $name => $value ) {
        if ( preg_match( '/^--sp-(\d+)$/', $name, $m ) ) {
            $spacing[] = zoe_rem_to_px( $value );
        }
    }
    sort( $spacing, SORT_NUMERIC );

    $radius = [];
    foreach ( [ 'none', 'sm', 'md', 'lg', 'xl', 'pill' ] as $name ) {
        if ( isset( $t[ '--radius-' . $name ] ) ) {
            $radius[ $name ] = trim( $t[ '--radius-' . $name ] );
        }
    }

    return [
        'site'   => get_bloginfo( 'name' ),
        'source' => home_url( '/design-guidelines/' ),
        'note'   => 'Generated directly from this theme\'s colors_and_type.css at page load — always current, not hand-maintained.',
        'colors' => [
            'primitives' => $colors,
            'roles'      => [
                'background'      => $t['--bg'] ?? null,
                'background_raised' => $t['--bg-raised'] ?? null,
                'background_inverse' => $t['--bg-inverse'] ?? null,
                'text'            => $t['--fg'] ?? null,
                'text_muted'      => $t['--fg-muted'] ?? null,
                'text_on_dark'    => $t['--fg-on-dark'] ?? null,
                'accent'          => $t['--accent'] ?? null,
                'accent_deep'     => $t['--accent-deep'] ?? null,
                'cta'             => $t['--cta'] ?? null,
                'border'          => $t['--border'] ?? null,
            ],
        ],
        'type'   => [
            'fonts' => [
                'sans'    => 'Open Sans — body copy, UI, and every heading level, H1 included',
            ],
            'weights' => [
                'regular'  => $t['--fw-regular'] ?? null,
                'medium'   => $t['--fw-medium'] ?? null,
                'semibold' => $t['--fw-semibold'] ?? null,
                'bold'     => $t['--fw-bold'] ?? null,
                'black'    => $t['--fw-black'] ?? null,
            ],
            // Which weight each heading level actually renders at, so a
            // deck or a document can reproduce the hierarchy rather than
            // guessing from the numbers above.
            // Zoe's outline is h1 > h2 > h3. There is no <h4> on the site:
            // the two that existed sat directly under an <h2>, skipping a
            // level, and were corrected to <h3> Aug 30, 2026.
            //
            // --type-h4 is still a real SIZE, used by card titles and
            // timeline rows — which are <h3> elements. So <h3> renders at
            // two sizes here depending on the component, and that is
            // deliberate: the heading LEVEL is about document structure,
            // the type token is about scale. They are not the same axis.
            'heading_weights' => [
                'h1' => 'black',     // 800
                'h2' => 'bold',
                'h3' => 'semibold',  // 700 where it titles a block: cards, timeline rows, process steps
            ],
            'heading_elements_in_use' => [ 'h1', 'h2', 'h3' ],
            // h4 is BOLDER than h3 on purpose. h4 renders at 16-18px and is
            // used for card titles — a UI label competing with an eyebrow
            // and an excerpt inside a bordered box, not a subheading in
            // flowing prose. At that size weight has to do the work size
            // no longer can.
            'scale_px' => $scale,
        ],
        'spacing_px' => $spacing,
        'radius'     => $radius,
    ];
}

/**
 * Renders a .zoe-card-grid of real `portfolio` posts in one category —
 * featured image, category name as the tag, title, trimmed excerpt — each
 * card a clickable link to its own single-portfolio.php page. Used by the
 * Work page's two sections (August 24, 2026): these used to be hand-entered
 * ACF repeater rows with no images or links; Lara asked for the real
 * content instead — every published post in the category, not a curated
 * selection.
 *
 * No tags exist on any of these posts (checked directly, not assumed), so
 * the card's small tag line uses the post's real category name rather than
 * inventing a sub-label ("Curriculum"/"Kit") that isn't backed by data.
 *
 * @param string $category_slug
 */
function zoe_portfolio_grid( $category_slug ) {
    $posts = get_posts( [
        'post_type'      => 'portfolio',
        'category_name'  => $category_slug,
        'numberposts'    => -1,
        'post_status'    => 'publish',
        'orderby'        => 'menu_order date',
        'order'          => 'DESC',
    ] );

    if ( ! $posts ) {
        return;
    }

    echo '<div class="zoe-card-grid">';
    foreach ( $posts as $p ) {
        $cats = get_the_category( $p->ID );
        $tag  = $cats ? $cats[0]->name : '';
        $excerpt = wp_trim_words( wp_strip_all_tags( get_the_excerpt( $p ) ), 20 );
        ?>
        <a class="zoe-card" href="<?php echo esc_url( get_permalink( $p ) ); ?>">
          <?php if ( has_post_thumbnail( $p ) ) : ?>
            <img class="zoe-card__image" src="<?php echo esc_url( get_the_post_thumbnail_url( $p, 'medium_large' ) ); ?>" alt="<?php echo esc_attr( get_the_title( $p ) ); ?>" loading="lazy">
          <?php endif; ?>
          <?php if ( $tag ) : ?>
            <div class="zoe-card__tag"><?php echo esc_html( $tag ); ?></div>
          <?php endif; ?>
          <h3 class="zoe-card__title"><?php echo esc_html( get_the_title( $p ) ); ?></h3>
          <?php if ( $excerpt ) : ?>
            <p class="zoe-card__description"><?php echo esc_html( $excerpt ); ?></p>
          <?php endif; ?>
        </a>
        <?php
    }
    echo '</div>';
}
