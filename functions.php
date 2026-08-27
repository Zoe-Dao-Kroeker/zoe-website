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
define( 'ZOE_STYLE_VER', '0.9.0' );

add_action( 'wp_enqueue_scripts', function () {
    // Google Fonts. Sans is Open Sans (switched from Inter, August 24,
    // 2026); Fontdiner Swanky is h1 only, not the whole heading system.
    wp_enqueue_style(
        'zoe-google-fonts',
        'https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&family=Instrument+Serif:ital@0;1&family=JetBrains+Mono:wght@400;500&family=Fontdiner+Swanky&display=swap',
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

