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
    $label = esc_html( $cta['label'] );

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
