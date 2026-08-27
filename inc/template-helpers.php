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
