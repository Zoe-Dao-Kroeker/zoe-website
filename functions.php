<?php
/**
 * Zoe Dao-Kroeker Custom Theme — functions.php
 *
 * STANDALONE from the start. No parent theme.
 *
 * Content model: Home / Research / Work / About, each a WP Page on a
 * dedicated page template (page-home.php etc.) with its structured content
 * (stats, cards, process steps) in ACF field groups registered in
 * inc/acf-fields.php — not hardcoded in PHP, so Zoe can edit it from
 * wp-admin's classic editor. See inc/acf-fields.php for the field
 * definitions and Website/zoe_dao_kroeker_wireframes_with_content.html for
 * the structure and copy they're built from.
 */

require_once get_stylesheet_directory() . '/inc/acf-fields.php';
require_once get_stylesheet_directory() . '/inc/template-helpers.php';

// ── Theme supports ───────────────────────────────────────────────────────
// A standalone theme declares these itself. These are the ones Hello Elementor
// used to provide, minus WooCommerce and the wc-product-gallery-* trio, which
// this site has no use for.
add_action( 'after_setup_theme', function () {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'html5', [
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script',
    ] );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'align-wide' );
    add_theme_support( 'editor-styles' );
    add_theme_support( 'custom-logo', [
        'height'      => 80,
        'width'       => 240,
        'flex-height' => true,
        'flex-width'  => true,
    ] );

    register_nav_menus( [
        'primary' => __( 'Primary Navigation', 'zoe-theme' ),
    ] );
} );

// ── Styles ───────────────────────────────────────────────────────────────
// Tokens first, then the stylesheet that consumes them.
//
// Priority is the default 10. The earlier priority-20-plus-dependency-checking
// arrangement existed solely to load after Hello Elementor's reset.css. With no
// parent there is nothing to out-order, so the simpler form is correct again.
//
// IMPORTANT: colors_and_type.css is a byte-identical copy of
// Design Guidelines/colors_and_type.css. Never hand-edit it here. Edit the
// canonical file, copy it over, and verify with `diff`.
//
// IMPORTANT: bump ZOE_STYLE_VER on every zoe.css change. The browser and CDN
// cache by ?ver= query string, not by file content, so a correct upload can
// still render stale.
define( 'ZOE_STYLE_VER', '0.38.0' );

add_action( 'wp_enqueue_scripts', function () {
    // Google Fonts — two families only. Sans is Open Sans (switched from
    // Inter, August 24, 2026); Fontdiner Swanky is h1 only, not the whole
    // heading system. Instrument Serif and JetBrains Mono, both from the
    // original LKI-copied system, were dropped the same day.
    wp_enqueue_style(
        'zoe-google-fonts',
        'https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&family=Fontdiner+Swanky&display=swap',
        [],
        null
    );

    wp_enqueue_style(
        'zoe-tokens',
        get_stylesheet_directory_uri() . '/colors_and_type.css',
        [ 'zoe-google-fonts' ],
        ZOE_STYLE_VER
    );

    wp_enqueue_style(
        'zoe-style',
        get_stylesheet_directory_uri() . '/zoe.css',
        [ 'zoe-tokens' ],
        ZOE_STYLE_VER
    );
} );

// ── Design Guidelines / Icon Library: noindex ───────────────────────────
// Client-facing (linked from the footer as "Media Kit") but not meant to
// rank in search — noindex and footer-linked are independent decisions, not
// opposites. No SEO plugin confirmed on this site, so this is a direct
// wp_head hook rather than a plugin-specific post-meta key.
add_action( 'wp_head', function () {
    if ( is_page_template( [ 'page-design-guidelines.php', 'page-icon-library.php' ] ) ) {
        echo '<meta name="robots" content="noindex, follow">' . "\n";
    }
} );

// ── Template routing ────────────────────────────────────────────────────
// Deliberately none, for now. WordPress resolves every template this theme
// uses through its own hierarchy: front-page.php, home.php, single-post.php,
// page.php, archive.php, search.php, 404.php, index.php. lki-child needed a
// template_include filter because one of its post types had a typo'd key that
// could not be renamed without breaking URLs. Zoe's `all-porfolio` category
// slug has the same shape of typo (see ZOE-website-status.md); whether it
// needs a filter depends on the decision about the `portfolio` CPT vs.
// categorised posts, still open.


/**
 * Serve the machine-readable design guidelines on two routes.
 *
 * /llms.txt                 — the convention an AI tool looks for by name.
 * /design-guidelines/?ai=1  — the same content off the URL a person hands out.
 *
 * One body, two routes. Standardised across the workspace Aug 30, 2026
 * so every brand answers the same way.
 *
 * This replaces what used to sit ON the guidelines page: a visible "For
 * AI tools:" paragraph plus a <script type="application/json"> island.
 * Both were removed. The paragraph existed because this theme computes
 * swatch hex in the BROWSER via getComputedStyle, so a tool fetching the
 * URL without running JS saw no values — a real problem, solved in the
 * wrong place. Nothing on the page is addressed to a machine now; the
 * export carries it instead.
 *
 * zoe_design_tokens_for_ai() is reused unchanged. It is the richest of
 * the brand exports — roles, fluid type ranges with line-heights,
 * spacing and radius — so it is worth keeping as-is rather than
 * flattening it to match the simpler themes.
 *
 * Served off `init` so it needs no rewrite flush.
 */
function zoe_serve_ai_export() {
	$path = strtok( isset( $_SERVER['REQUEST_URI'] ) ? $_SERVER['REQUEST_URI'] : '', '?' );

	$is_llms = ( '/llms.txt' === $path );
	$is_ai   = ( isset( $_GET['ai'] ) && '/design-guidelines/' === rtrim( $path, '/' ) . '/' );

	if ( ! $is_llms && ! $is_ai ) {
		return;
	}

	$tokens     = zoe_design_tokens_for_ai();
	$token_file = get_stylesheet_directory() . '/colors_and_type.css';
	$updated    = is_readable( $token_file ) ? gmdate( 'F j, Y', filemtime( $token_file ) ) : 'unknown';

	$out   = array();
	$out[] = '# Zoe Dao-Kroeker — Design Guidelines (machine-readable)';
	$out[] = '';
	$out[] = 'Generated live from colors_and_type.css, last changed ' . $updated . '.';
	$out[] = 'Human version: ' . home_url( '/design-guidelines/' );
	$out[] = '';
	$out[] = '## Type usage';
	$out[] = '';
	$out[] = 'Open Sans — body copy, UI, and every heading level except the H1/hero display face.';
	$out[] = 'Fontdiner Swanky — H1 and hero headlines ONLY, not the whole heading system.';
	$out[] = '';
	$out[] = '## Known gaps';
	$out[] = '';
	$out[] = 'Stated plainly so nothing here gets invented to fill them:';
	$out[] = '- Voice and tone are NOT documented for this site. Do not infer a house style';
	$out[] = '  from existing copy.';
	$out[] = '- Contrast ratios are computed in the browser on the human page and are not';
	$out[] = '  reproduced in this export.';
	$out[] = '';
	$out[] = '## Tokens';
	$out[] = '';
	$out[] = 'Full token set below, generated from colors_and_type.css — the single source of';
	$out[] = 'truth. Do not use any colour, font, weight, size or spacing value not listed here.';
	$out[] = '';
	$out[] = '```json';
	$out[] = wp_json_encode( $tokens, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );
	$out[] = '```';
	$out[] = '';

	nocache_headers();
	header( 'Content-Type: text/plain; charset=utf-8' );
	echo implode( "\n", $out ) . "\n";
	exit;
}
add_action( 'init', 'zoe_serve_ai_export', 0 );

/**
 * Point AI tools and browsers at the plain-text guidelines.
 */
function zoe_llms_txt_link() {
	printf(
		'<link rel="alternate" type="text/plain" href="%s" title="Design guidelines, plain text">' . "\n",
		esc_url( home_url( '/llms.txt' ) )
	);
}
add_action( 'wp_head', 'zoe_llms_txt_link' );

/**
 * Tell browsers never to cache pages on the STAGING SERVER.
 *
 * Ported from the KSA theme Aug 30, 2026. Staging sends no cache-control
 * header, so browsers cache the page and reviews happen against stale
 * markup — and a cached old page styled by new CSS looks like broken
 * design rather than a stale page, which sends you hunting a bug that
 * does not exist. Scoped to the Kinsta staging host; production keeps
 * its caching.
 */
function zoe_no_browser_cache_on_staging() {
	if ( is_admin() ) {
		return;
	}

	$host = isset( $_SERVER['HTTP_HOST'] ) ? strtolower( $_SERVER['HTTP_HOST'] ) : '';
	if ( false === strpos( $host, 'kinsta.cloud' ) ) {
		return;
	}

	nocache_headers();
	header( 'Cache-Control: no-store, no-cache, must-revalidate, max-age=0' );
}
add_action( 'template_redirect', 'zoe_no_browser_cache_on_staging' );
