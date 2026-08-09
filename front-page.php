<?php
/**
 * 🔴 SCAFFOLD ONLY — this entire file is Mel's, unrenamed on purpose.
 *
 * Zoe's site is 8 static pages plus categorised posts plus a `portfolio` CPT,
 * not a one-pager. Every section below (hero slideshow, three album blocks,
 * Bandcamp embeds, residency categories) is Mel-specific content logic that
 * does not apply to Zoe's content model and needs a full rewrite, not a
 * find-and-replace. Kept as a structural reference only — see mel-theme's own
 * README.md for what each part does before reusing any of the patterns here
 * (the hero deferred-loading technique and the "query, never hardcode"
 * discipline are both worth carrying over; the content itself is not).
 *
 * Original file docblock follows, unmodified:
 */
/**
 * Mel·lif·lu·ous Custom Theme — front-page.php
 * The one-pager. The pre-footer CTA and footer live in footer.php.
 *
 * Content model: each album section pulls its own residency posts by category.
 * japan-2025 belongs to Wildroot & Amber, iceland-2023 to Spákonufell. Those
 * categories are already correct on the site and must not be re-tagged.
 *
 * Images are referenced by attachment ID, never by URL. Several filenames in the
 * media library contain a zero-width character (Wildroot-Amber<ZWSP>-Featured-Image),
 * so a hardcoded URL would break in ways that are invisible in an editor.
 *
 * All three album descriptions are Lara's own words, added August 9, 2026,
 * verbatim including em dashes. Do not "tidy" them.
 *
 * The $albums array is the record for every streaming and embed ID this site uses,
 * and for each player's exact pixel height.
 */

get_header();

// ── Media (attachment IDs on staging) ───────────────────────────────────
$img_hero              = 13963; // traditional-japanese-countryside, 2000x1333
$img_wildroot_cover    = 14634; // Album-Cover-SpotifyAppleBandcamp, 2048x2048
$img_spakonufell_cover = 11521; // Icelandic collage, 1456x816
$img_trees_cover       = 12262; // Talking to the Trees, 2560x1452
$img_about             = 12348; // Lara portrait, 2-1.jpg, 1080x1080 square
                                // Was 13349 (the Itoshima house), replaced Aug 9, 2026.

// $img_hero above is no longer the hero: the single background photo was replaced
// by the slideshow below. Kept as a record of what used to be there, and because
// it is a good fallback if the slideshow is ever pulled back out.

/*
 * ── Hero slideshow ──────────────────────────────────────────────────────
 * Featured images from eleven posts Lara chose, in her order. Attachment IDs,
 * not URLs, for the same reason as everything else on this page.
 *
 * All eleven are landscape (ratios 1.33 to 1.78), so a full-bleed hero crops
 * them all acceptably. Resolved from her list of post URLs on August 9, 2026;
 * the post each one belongs to is noted so they can be traced back.
 *
 * Only the first image gets a real src. The rest carry data-src and are swapped
 * in by the handler in footer.php just before they are needed. Ordinary
 * loading="lazy" would not help here: every slide is stacked inside the
 * viewport, so the browser would fetch all eleven on arrival.
 */
$hero_slides = [
    14250, // Tides and Tangled Cables
    14244, // A Little Bliss, a Little Brew, and a Brightening World
    14236, // A Voice Remembering You
    14217, // In the Space Between Notes
    14134, // Rain, Reverie, and the Cleanup God
    13349, // From Deadlines to Rice Fields: A Creative Shift
    10287, // What if you could remake yourself?
    10288, // What if a Bird was a Fish
    10328, // A New Phase
    10269, // The Beauty of the Process
    10178, // First day in Skagastörnd
];

// ── Albums, newest first ────────────────────────────────────────────────
$albums = [
    [
        'title'    => 'Wildroot &amp; Amber',
        'year'     => '2025',
        // "Current release" removed on Lara's instruction, August 9, 2026. It was
        // the one tag on the page that goes stale on its own the moment the next
        // album lands, with nothing to prompt anyone to update it.
        'tags'     => [ 'Itoshima, Japan' ],
        'cover'    => $img_wildroot_cover,
        'bandcamp' => 'https://larakroeker.bandcamp.com/album/wildroot-amber',
        'embed_id' => '1394245195',
        'embed_h'  => 588,   // 5 tracks, from Bandcamp's own embed code
        'spotify'  => 'https://open.spotify.com/artist/3p646805chFAeNt3WasIYY',
        'apple'    => 'https://music.apple.com/album/1830735032',
        'category' => 'japan-2025',
        'subtitle' => 'A body of work shaped by memory, objects, and the quiet rituals of everyday life.',
        // Lara's own copy, August 9, 2026. Verbatim, em dashes included.
        'body'     => '<p>Wildroot &amp; Amber is an album shaped by rice fields, ritual, and the
                       quiet rhythms of Japan. In May 2025, I traveled to Itoshima for an artist
                       residency, walking each day past fields and sea while carrying fragments
                       of my past &mdash; letters, home videos, remembered voices &mdash; into
                       the studio.</p>

                       <p>Layered with field recordings gathered there, these materials became
                       five songs that move between the intimate and the elemental. The earth
                       keeps memory; beneath thought, something older hums. To remember is not to
                       think, but to return.</p>

                       <p>The project extends into an interactive installation inspired by the
                       apothecary &mdash; bottles as vessels, not of remedies but of memory.
                       Glass jars release voices, wind, and water, folding fragments directly
                       into the music.</p>

                       <p>Together, the songs and installation form a sonic shelf of traces
                       &mdash; each piece a container for what might otherwise be lost.</p>',
    ],
    [
        'title'    => 'Spákonufell',
        'year'     => '2023',
        'tags'     => [ 'Iceland' ],
        'cover'    => $img_spakonufell_cover,
        'bandcamp' => 'https://larakroeker.bandcamp.com/album/sp-konufell',
        'embed_id' => '4281818887',
        'embed_h'  => 720,   // 8 tracks, from Bandcamp's own embed code
        'spotify'  => 'https://open.spotify.com/album/0oDjRcYDcZAxEPGJR70Zv9',
        'apple'    => 'https://music.apple.com/album/1705280650',
        'category' => 'iceland-2023',
        'subtitle' => 'An album shaped by solitude, snow, and the strange magic of Iceland.',
        // Lara's own copy, August 9, 2026. Verbatim, em dashes included.
        'body'     => '<p>In February and March 2023, I traveled to Skagastr&ouml;nd, a remote
                       town in northwestern Iceland, for an artist residency that would transform
                       the way I make music. Each morning, I opened my window to the mountain
                       Sp&aacute;konufell&mdash;rising through frost.</p>

                       <p>During my time there, I wrote and recorded this album in the freezer of
                       an abandoned fish factory, surrounded by creaking pipes, frozen air, and
                       the silence of deep winter. It was strange and beautiful.
                       Sp&aacute;konufell is both a place and a feeling.</p>

                       <p>A call into the unknown. A whisper from the land.</p>

                       <p>The mountain itself appears on the album cover in artwork by the
                       incredible Lena J. Fahl&eacute;n, whose vision captures the haunting quiet
                       and deep magic of the landscape.</p>',
    ],
    [
        'title'    => 'Talking to the Trees',
        'year'     => '2026',
        'tags'     => [ 'Collaboration' ],
        'cover'    => $img_trees_cover,
        'bandcamp' => 'https://larakroeker.bandcamp.com/album/talking-to-the-trees',
        'embed_id' => '655265029',
        'embed_h'  => 588,   // 4 tracks, from Bandcamp's own embed code
        'spotify'  => '', // none exists yet, see MEL-content-status.md
        'apple'    => '',
        'category' => '',
        'subtitle' => 'Songs shaped by forest, collaboration, and listening closely to what&rsquo;s already there.',
        // Lara's own copy, August 9, 2026. Verbatim, em dashes included.
        'body'     => '<p>Born from a quiet walk beneath the branches, Talking to the Trees
                       carries the echo of ivy winding its way toward destruction, and the steady
                       devotion of a friend who would not let the forest fall silent.</p>

                       <p>Sasha&rsquo;s care for the trees became the seed of this
                       work&mdash;an invocation to listen more deeply, to honor what stands
                       rooted among us.</p>

                       <p>Every sound in this project begins in the wild: the rustle of leaves,
                       the resonance of wood, the voice and violin bent and reshaped until they
                       blur into something otherworldly. Nature becomes instrument, memory
                       becomes music, and poetry weaves through it all like a low, enduring
                       current.</p>

                       <p>This is not just a collection of sounds, but a listening
                       practice&mdash;an invitation to hear the living breath of the forest.</p>',
    ],
];
?>

<main id="main">

<!-- ============================================================
     1. HERO
     ============================================================ -->
<section class="hero" id="top" aria-label="Introduction">
  <?php
  /*
   * Slideshow, not a single background image.
   *
   * The gradient that used to be part of the .hero__bg background shorthand is
   * now its own overlay element stacked above the images, because it has to sit
   * over whichever slide is showing.
   *
   * Only slide 0 carries a src, with fetchpriority="high" since it is the
   * largest thing above the fold. The other ten carry data-src and are fetched
   * by the handler in footer.php one slide ahead of when they are shown.
   * loading="lazy" would do nothing useful here: all eleven are stacked inside
   * the viewport, so the browser would treat every one as urgent and download
   * roughly 11 full-width photographs before the page settled.
   *
   * alt is empty on all of them by design. They are decorative here, and each
   * one already carries its real caption on the post it belongs to.
   */
  ?>
  <div class="hero__slides" aria-hidden="true">
    <?php foreach ( $hero_slides as $i => $slide_id ) :
        $slide_url = wp_get_attachment_image_url( $slide_id, '1536x1536' );
        if ( ! $slide_url ) {
            continue;
        }
        ?>
      <img class="hero__slide<?php echo 0 === $i ? ' is-active' : ''; ?>"
           <?php if ( 0 === $i ) : ?>
           src="<?php echo esc_url( $slide_url ); ?>" fetchpriority="high"
           <?php else : ?>
           data-src="<?php echo esc_url( $slide_url ); ?>"
           <?php endif; ?>
           alt="" decoding="async" draggable="false">
    <?php endforeach; ?>
  </div>
  <div class="hero__scrim" aria-hidden="true"></div>

  <div class="hero__body">
    <span class="eyebrow eyebrow--light reveal">Violin, voice &amp; electronics</span>
    <?php
    /*
     * Lara's copy, August 9, 2026, used as written.
     *
     * No .accent span. She asked for no italics in the headline, so the page
     * spends zero of its one permitted italic accent. The guideline is a
     * maximum, so that is fine.
     */
    ?>
    <h1 class="hero__h1 reveal d1">
      Music made in unusual places
    </h1>
    <p class="hero__lead reveal d2">
      Mel&middot;lif&middot;lu&middot;ous is the experimental music project of Vancouver
      artist Lara Kroeker, where violin, voice and electronics come together to
      create immersive, textural sound. Her work is shaped by place, travel and
      experimentation, with recent artist residencies in Iceland and Japan inspiring
      new ways of listening, recording and composing. From recording in a remote fish
      factory in Iceland to creating new work in Itoshima, Japan, Lara follows
      curiosity wherever it leads.
    </p>
    <?php
    /*
     * The streaming links are the hero's only call to action. They replaced a
     * "Hear the music" / "Read the writing" button pair, which was a layer of
     * indirection: both merely scrolled further down a page the visitor is
     * already on, where these go straight to where the music is.
     *
     * Deliberately not repeated in the intro block below. That sits directly
     * under the hero, so the same four links inside one screen would read as a
     * mistake. They appear once more in the pre-footer CTA, which is far enough
     * down to be a genuine second chance.
     *
     * PHP comment rather than HTML so this reasoning is not shipped to visitors.
     */
    ?>
    <div class="stream-row hero__streams reveal d3">
      <span class="eyebrow eyebrow--light" style="margin-bottom:0;">Listen on</span>
      <a class="stream-link" href="https://open.spotify.com/artist/3p646805chFAeNt3WasIYY"
         target="_blank" rel="noopener noreferrer">Spotify</a>
      <a class="stream-link" href="https://music.apple.com/artist/1692317652"
         target="_blank" rel="noopener noreferrer">Apple Music</a>
      <a class="stream-link" href="https://larakroeker.bandcamp.com"
         target="_blank" rel="noopener noreferrer">Bandcamp</a>
      <a class="stream-link" href="https://www.youtube.com/watch?v=n4_z0htUxbk&amp;list=PLYU6sr-jxZWHc68HjO5Y_HBhL51rwn1S6"
         target="_blank" rel="noopener noreferrer">YouTube</a>
    </div>
  </div>
</section>

<!-- ============================================================
     2. INTRO
     Sits directly under the hero photo. Carries the dictionary-definition
     conceit from the previous site, the bio, and the streaming links.
     The links replace what used to be a "read more" here: the visitor's most
     likely next action is to go and listen, so send them straight there.
     Colours are Mel's canvas, not the old build's lime green.
     ============================================================ -->
<section class="sec intro" id="intro" aria-labelledby="intro-heading">
  <div class="container">
    <div class="intro__inner">

      <h2 class="display-h2 intro__q reveal" id="intro-heading">
        How do you use Mel&middot;lif&middot;lu&middot;ous in a sentence?
      </h2>

      <p class="lead intro__example reveal d1">
        She emitted a low, melodious sound, a kind of mellifluous howl.
      </p>

      <div class="body-copy intro__bio reveal d2">
        <p>I&rsquo;m Lara, a violinist and electronic musician. I use violin and voice as my
        starting point, building songs live with loops on the Push 3. My work blends acoustic
        and electronic sound&mdash;layering, stretching, and reshaping it into something
        immersive. I&rsquo;ve released three albums and continue to explore new ways of
        performing and composing through technology.</p>
      </div>

    </div>
  </div>
</section>

<hr class="sec-rule">

<!-- ============================================================
     3 to 5. ALBUMS
     Each album carries its own residency posts.
     ============================================================ -->
<div id="music">
<?php foreach ( $albums as $i => $album ) :
    $posts    = $album['category'] ? mel_residency_posts( $album['category'], 6 ) : [];
    $cover    = wp_get_attachment_image_url( $album['cover'], 'large' );
    $reverse  = ( $i % 2 === 1 );
    $band     = $reverse ? ' sec--neutral' : '';
    $plain    = wp_strip_all_tags( $album['title'] );
    ?>
<section class="sec<?php echo $band; ?>" aria-labelledby="album-<?php echo (int) $i; ?>">
  <div class="container">
    <div class="album<?php echo $reverse ? ' album--reverse' : ''; ?> reveal">

      <div class="album__media">
        <?php mel_bandcamp_embed( $album['embed_id'], $cover, $plain, $album['bandcamp'], $album['embed_h'] ); ?>
      </div>

      <div class="album__text">
        <?php if ( $album['tags'] ) : ?>
          <div class="tag-row">
            <?php foreach ( $album['tags'] as $tag ) : ?>
              <span class="tag"><?php echo esc_html( $tag ); ?></span>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>

        <h2 class="album__title" id="album-<?php echo (int) $i; ?>">
          <?php echo wp_kses_post( $album['title'] ); ?>
        </h2>
        <?php if ( ! empty( $album['subtitle'] ) ) : ?>
          <p class="album__subtitle"><?php echo wp_kses_post( $album['subtitle'] ); ?></p>
        <?php endif; ?>
        <p class="album__meta"><?php echo esc_html( $album['year'] ); ?></p>

        <div class="body-copy album__body"><?php echo wp_kses_post( $album['body'] ); ?></div>

        <div class="album__actions">
          <a class="btn" href="<?php echo esc_url( $album['bandcamp'] ); ?>"
             target="_blank" rel="noopener noreferrer">Bandcamp</a>
          <?php if ( $album['spotify'] ) : ?>
            <a class="btn btn--ghost" href="<?php echo esc_url( $album['spotify'] ); ?>"
               target="_blank" rel="noopener noreferrer">Spotify</a>
          <?php endif; ?>
          <?php if ( $album['apple'] ) : ?>
            <a class="btn btn--ghost" href="<?php echo esc_url( $album['apple'] ); ?>"
               target="_blank" rel="noopener noreferrer">Apple Music</a>
          <?php endif; ?>
        </div>

        <?php if ( $posts ) : ?>
          <span class="eyebrow">From the residency</span>
          <?php
          /*
           * Thumbnails are forced square with object-fit: cover rather than using
           * each image's own ratio. All 40 posts have a featured image, but the
           * ratios run from 0.71 (portrait) to 1.79 (widescreen) inside the same
           * list. A fixed square centre-crops either orientation and keeps the rows
           * even; honouring the real ratios would make the list ragged.
           *
           * `medium` is requested rather than something larger because the slot is
           * 80px, and because the musings images only have `medium` and `thumbnail`
           * generated. Asking for a bigger size there would serve the full original.
           */
          ?>
          <ul class="post-list post-list--thumbs">
            <?php foreach ( $posts as $p ) :
              $thumb_id = get_post_thumbnail_id( $p ); ?>
              <li class="post-list__item">
                <a class="post-list__link" href="<?php echo esc_url( get_permalink( $p ) ); ?>">
                  <?php if ( $thumb_id ) : ?>
                    <span class="post-list__thumb">
                      <?php echo wp_get_attachment_image( $thumb_id, 'medium', false, [
                          'alt'      => '',
                          'loading'  => 'lazy',
                          'decoding' => 'async',
                      ] ); ?>
                    </span>
                  <?php endif; ?>
                  <span class="post-list__title"><?php echo esc_html( get_the_title( $p ) ); ?></span>
                  <span class="post-list__date"><?php echo esc_html( get_the_date( 'M Y', $p ) ); ?></span>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
          <?php
          $cat = get_category_by_slug( $album['category'] );
          if ( $cat && $cat->count > count( $posts ) ) : ?>
            <p class="post-list__more">
              <a class="btn btn--text" href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>">
                All <?php echo (int) $cat->count; ?> posts
              </a>
            </p>
          <?php endif; ?>
        <?php endif; ?>
      </div>

    </div>
  </div>
</section>
<?php endforeach; ?>
</div>

<!-- ============================================================
     6. ABOUT
     ============================================================ -->
<section class="sec" id="about">
  <div class="container">
    <div class="grid-2-even reveal">
      <div>
        <span class="eyebrow">About</span>
        <h2 class="display-h2">The spaces between things.</h2>
        <?php
        /*
         * Lara's own copy, first person, August 9, 2026. Used as written.
         *
         * The heading above is pulled from her last paragraph ("I'm drawn to the
         * spaces between things") so it introduces the copy instead of competing
         * with it. The previous heading and the third-person bio it sat on are
         * both gone.
         */
        ?>
        <div class="body-copy">
          <p>I&rsquo;m Lara Kroeker, the artist behind Mel&middot;lif&middot;lu&middot;ous, a
          Vancouver-based violinist, vocalist and experimental composer. My roots are in
          classical music, but curiosity has always pulled me beyond the expected. I blend
          violin, voice, electronics, loops and found sounds to create immersive,
          genre-bending work shaped by place, memory and connection.</p>

          <p>After years working as a designer and creative director, I&rsquo;ve returned to
          music with a renewed sense of freedom and curiosity. Recent artist residencies in
          Iceland and Japan have given me space to experiment, collaborate and create in
          unfamiliar places. From recording in a remote fish factory in Iceland to developing
          new work in Itoshima, Japan, I&rsquo;m interested in what happens when you step
          outside the familiar and follow sound somewhere unexpected.</p>

          <p>Music has always been a way for me to make sense of the world. I&rsquo;m drawn to
          the spaces between things: acoustic and electronic, instinct and discipline,
          technology and something deeply human. That&rsquo;s where I find my sound.</p>
        </div>
      </div>
      <div>
        <?php
        /*
         * Portrait of Lara, swapped in on her instruction (August 9, 2026) for the
         * photo of the Itoshima house that used to sit here. That photo is still the
         * featured image on the "From Deadlines to Rice Fields" post, which is where
         * it belongs.
         *
         * This one is square (1080x1080) where the old one was 1600x1142 landscape.
         * .album__art sets no aspect-ratio, so it renders at its own shape and simply
         * comes out taller in the column than the landscape photo did. .about__portrait
         * caps that height so it cannot tower over the copy beside it.
         *
         * The alt text is now accurate; it said "performing" before, which the
         * photograph of a house never was.
         */
        echo wp_get_attachment_image( $img_about, 'large', false, [
            'class'   => 'album__art about__portrait',
            'alt'     => 'Lara Kroeker',
            'loading' => 'lazy',
        ] ); ?>
      </div>
    </div>
  </div>
</section>

<!-- ============================================================
     7. WRITING
     ============================================================ -->
<?php
// Six, on Lara's instruction (August 9, 2026). .grid-3 lays them out as two
// rows of three, so six fills the grid evenly where four or five would leave a
// ragged last row.
$musings = mel_residency_posts( 'musings', 6 );
if ( $musings ) : ?>
<section class="sec sec--neutral" id="writing">
  <div class="container">
    <span class="eyebrow reveal">Writing</span>
    <h2 class="display-h2 reveal">Musings</h2>
    <p class="lead reveal" style="margin-bottom:48px;">
      Notes on process, fabrication, installation design, and the parts of making that do not
      fit into songs.
    </p>

    <div class="grid-3 reveal d1">
      <?php foreach ( $musings as $p ) :
          $thumb = get_post_thumbnail_id( $p ); ?>
        <article class="blog-card">
          <a href="<?php echo esc_url( get_permalink( $p ) ); ?>" class="blog-card__link">
            <?php if ( $thumb ) : ?>
              <?php echo wp_get_attachment_image( $thumb, 'medium_large', false, [
                  'class'   => 'blog-card__img',
                  'alt'     => '',
                  'loading' => 'lazy',
              ] ); ?>
            <?php endif; ?>
            <h3 class="h3"><?php echo esc_html( get_the_title( $p ) ); ?></h3>
            <p class="meta"><?php echo esc_html( get_the_date( 'F j, Y', $p ) ); ?></p>
          </a>
        </article>
      <?php endforeach; ?>
    </div>

    <?php $mus = get_category_by_slug( 'musings' );
    if ( $mus && $mus->count > count( $musings ) ) : ?>
      <p class="post-list__more reveal">
        <a class="btn btn--ghost" href="<?php echo esc_url( get_category_link( $mus->term_id ) ); ?>">
          Read all <?php echo (int) $mus->count; ?> posts
        </a>
      </p>
    <?php endif; ?>
  </div>
</section>
<?php endif; ?>

</main>

<?php get_footer();
