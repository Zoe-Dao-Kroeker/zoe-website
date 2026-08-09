<?php
/**
 * Mel Custom Theme — search.php
 * Search results. Editorial list rather than a card grid, matching the
 * residency post lists on the front page.
 */

get_header();

global $wp_query;
$found = (int) $wp_query->found_posts;
$term  = get_search_query();
?>

<main class="page-main" id="main">

  <header class="page-header">
    <div class="container">
      <span class="eyebrow eyebrow--muted">Search</span>
      <h1 class="page-title">
        <?php if ( $term ) : ?>
          <?php printf(
              /* translators: %s: search term */
              esc_html__( 'Results for &ldquo;%s&rdquo;', 'zoe-theme' ),
              esc_html( $term )
          ); ?>
        <?php else : ?>
          Search
        <?php endif; ?>
      </h1>
      <?php if ( $term ) : ?>
        <p class="meta">
          <?php echo esc_html( sprintf( _n( '%s result', '%s results', $found, 'zoe-theme' ), number_format_i18n( $found ) ) ); ?>
        </p>
      <?php endif; ?>
    </div>
  </header>

  <div class="container">

    <div class="search-page__form">
      <?php get_search_form(); ?>
    </div>

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

      <nav class="blog-pagination" aria-label="Search results navigation">
        <?php the_posts_pagination( [ 'mid_size' => 2, 'prev_text' => '&larr;', 'next_text' => '&rarr;' ] ); ?>
      </nav>

    <?php else : ?>

      <div class="body-copy search-page__empty">
        <p>Nothing matched that search. Try a different word, or start from
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">the beginning</a>.</p>
      </div>

    <?php endif; ?>

  </div>

</main>

<?php
get_footer();
