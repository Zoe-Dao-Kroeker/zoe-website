<?php
/**
 * Zoe Dao-Kroeker Custom Theme — functions.php
 *
 * STANDALONE from the start. No parent theme.
 *
 * 🔴 SCAFFOLD ONLY. Cloned from Mel-lif-lu-ous/Website/mel-theme (the workspace
 * donor) as structure and naming only — the theme-supports block, the enqueue
 * pattern, and the "no template_include filter" approach below are real and
 * meant to be kept. The two helper functions at the bottom (`mel_residency_posts`,
 * `mel_bandcamp_embed`) are NOT: they are Mel's actual content logic (a
 * one-pager with album sections and Bandcamp embeds), left in place
 * unrenamed on purpose so they read as obviously foreign rather than being
 * quietly relabelled "zoe_" and mistaken for real. Zoe's site is 8 pages plus
 * posts plus a `portfolio` CPT, not a one-pager — replace both functions with
 * whatever front-page.php actually needs once that's built, and delete these.
 */

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
define( 'ZOE_STYLE_VER', '0.1.0' );

add_action( 'wp_enqueue_scripts', function () {
    wp_enqueue_style(
        'zoe-tokens',
        get_stylesheet_directory_uri() . '/colors_and_type.css',
        [],
        ZOE_STYLE_VER
    );

    wp_enqueue_style(
        'zoe-style',
        get_stylesheet_directory_uri() . '/zoe.css',
        [ 'zoe-tokens' ],
        ZOE_STYLE_VER
    );
} );

// ── Nav appearance ───────────────────────────────────────────────────────
// Inherited from Mel, where the front page opens on a full-bleed photo, so the
// nav sits transparent over it and frosts on scroll. Zoe's front-page.php isn't
// built yet — revisit this once it exists; a plain nav-solid everywhere may be
// the right call if there's no full-bleed hero.
add_filter( 'body_class', function ( $classes ) {
    if ( ! is_front_page() ) {
        $classes[] = 'nav-solid';
    }
    return $classes;
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

// ── Helpers used by front-page.php ──────────────────────────────────────

/**
 * Posts for one album's residency, newest first.
 *
 * Categories are already correct on the site and must not be re-tagged:
 * japan-2025 belongs to Wildroot & Amber, iceland-2023 to Spákonufell.
 *
 * @param string $slug  Category slug.
 * @param int    $limit How many to return.
 * @return WP_Post[]
 */
function mel_residency_posts( $slug, $limit = 6 ) {
    return get_posts( [
        'category_name'    => $slug,
        'numberposts'      => $limit,
        'post_status'      => 'publish',
        'suppress_filters' => false,
    ] );
}

/**
 * Bandcamp player, embedded directly.
 *
 * Renders the real Bandcamp iframe rather than a click-to-load placeholder, so
 * the tracklist and play controls are visible on arrival (Lara's call,
 * August 9, 2026).
 *
 * `loading="lazy"` keeps the cost off the initial page load: the iframe is only
 * fetched as it approaches the viewport, so the top of the page still paints
 * without waiting on three third-party players.
 *
 * Two deliberate differences from the embed code Bandcamp hands out:
 *
 *   linkcol is Mel's brand forest (4d7a5c), not Bandcamp's default green
 *   (2ebd35), which was never in this palette.
 *
 *   The fixed 350px width becomes `width: 100%; max-width: 350px` in CSS so it
 *   behaves in the album grid.
 *
 * Height is per-album and must be passed in. Bandcamp's large player does not
 * reflow, so the iframe needs an exact pixel height or it scrolls internally or
 * leaves dead space.
 *
 * Do not try to calculate it from the track count. Observed: 4 tracks is 588,
 * 5 tracks is 588, 8 tracks is 720. There is a floor, and the growth above it
 * is not a clean per-track figure. **Copy the height out of the embed code
 * Bandcamp generates for that specific album** and put it in $albums.
 *
 * @param string $album_id Bandcamp EmbeddedPlayer album ID.
 * @param string $art_url  Unused. Kept so the call signature stays stable.
 * @param string $title    Album title, for the iframe title attribute.
 * @param string $href     Bandcamp album page, used as the in-iframe fallback link.
 * @param int    $height   Exact player height in pixels, from Bandcamp's own embed code.
 */
function mel_bandcamp_embed( $album_id, $art_url, $title, $href, $height = 588 ) {
    $src = sprintf(
        'https://bandcamp.com/EmbeddedPlayer/album=%s/size=large/bgcol=ffffff/linkcol=4d7a5c/transparent=true/',
        rawurlencode( $album_id )
    );
    ?>
    <div class="audio-embed">
        <iframe class="audio-embed__player"
                src="<?php echo esc_url( $src ); ?>"
                title="<?php echo esc_attr( sprintf( '%s on Bandcamp', wp_strip_all_tags( $title ) ) ); ?>"
                height="<?php echo (int) $height; ?>" loading="lazy" seamless
                allow="autoplay; encrypted-media">
            <a href="<?php echo esc_url( $href ); ?>">
                <?php echo esc_html( sprintf( '%s by Mel·lif·lu·ous', wp_strip_all_tags( $title ) ) ); ?>
            </a>
        </iframe>
    </div>
    <?php
}
