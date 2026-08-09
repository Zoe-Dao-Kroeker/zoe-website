<?php
/**
 * Mel Custom Theme — index.php
 *
 * The universal fallback. WordPress falls back to this file for any request no
 * more specific template handles, so every theme needs one even when it is
 * rarely hit in practice.
 *
 * On this site the specific templates cover almost everything:
 *   front-page.php    the one-pager
 *   page.php          static pages (About, Contact, album pages)
 *   single-blog.php   individual posts, via the template_include filter
 *   archive.php       category, tag, date and author archives
 *   search.php        search results
 *   404.php           not found
 *
 * Delegating to archive.php keeps one list layout rather than two that drift.
 */

$archive = get_stylesheet_directory() . '/archive.php';

if ( file_exists( $archive ) ) {
    require $archive;
    return;
}

// Belt and braces: if archive.php is ever removed, still render something sane.
get_header();
?>
<main class="page-main" id="main">
  <header class="page-header">
    <div class="container">
      <h1 class="page-title"><?php echo esc_html( wp_get_document_title() ); ?></h1>
    </div>
  </header>
  <div class="container">
    <?php if ( have_posts() ) : ?>
      <ul class="post-list">
        <?php while ( have_posts() ) : the_post(); ?>
          <li class="post-list__item">
            <a class="post-list__link" href="<?php the_permalink(); ?>">
              <span class="post-list__title"><?php the_title(); ?></span>
              <span class="post-list__date"><?php echo esc_html( get_the_date( 'M Y' ) ); ?></span>
            </a>
          </li>
        <?php endwhile; ?>
      </ul>
      <nav class="blog-pagination" aria-label="Posts navigation">
        <?php the_posts_pagination( [ 'mid_size' => 2, 'prev_text' => '&larr;', 'next_text' => '&rarr;' ] ); ?>
      </nav>
    <?php else : ?>
      <p class="body-copy">Nothing here yet.</p>
    <?php endif; ?>
  </div>
</main>
<?php
get_footer();
