<?php
/**
 * Mel Custom Theme — home.php
 *
 * The posts index: every post, newest first. Paired with single-post.php.
 *
 * Named home.php rather than post.php on purpose. WordPress resolves both
 * home.php and single-post.php natively, so this theme needs no template
 * routing filter at all. "home" is WordPress's own word for the posts index,
 * which is confusing here because the front page is the one-pager, but letting
 * the hierarchy do its job beats adding a filter to rename a file.
 */

get_header();
?>

<main class="blog-archive" id="main">

  <header class="blog-archive__header">
    <div class="container">
      <span class="eyebrow eyebrow--muted">Writing</span>
      <h1 class="blog-archive__title">
        <?php echo esc_html( get_the_title( (int) get_option( 'page_for_posts' ) ) ?: 'Musings' ); ?>
      </h1>
      <p class="lead">
        Notes on process, fabrication, installation design, and the parts of making
        that do not fit into songs.
      </p>
    </div>
  </header>

  <div class="container">

    <?php if ( have_posts() ) : ?>

    <div class="blog-grid">
      <?php while ( have_posts() ) : the_post();
        $cats     = get_the_category();
        $cat_name = $cats ? $cats[0]->name : '';
      ?>
      <article class="blog-card" id="post-<?php the_ID(); ?>">
        <a href="<?php the_permalink(); ?>" class="blog-card__link">
          <div class="blog-card__img-wrap">
            <?php if ( has_post_thumbnail() ) : ?>
              <?php the_post_thumbnail( 'large', [ 'class' => 'blog-card__img', 'loading' => 'lazy' ] ); ?>
            <?php endif; ?>
            <div class="blog-card__body">
              <?php if ( $cat_name ) : ?>
                <span class="blog-card__eyebrow"><?php echo esc_html( $cat_name ); ?></span>
              <?php endif; ?>
              <h2 class="blog-card__title"><?php the_title(); ?></h2>
              <p class="blog-card__excerpt"><?php echo esc_html( wp_strip_all_tags( get_the_excerpt() ) ); ?></p>
              <p class="blog-card__meta">
                <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
                  <?php echo esc_html( get_the_date( 'M j, Y' ) ); ?>
                </time>
              </p>
            </div>
          </div>
        </a>
      </article>
      <?php endwhile; ?>
    </div>

    <nav class="blog-pagination" aria-label="Posts navigation">
      <?php the_posts_pagination( [ 'mid_size' => 2, 'prev_text' => '&larr;', 'next_text' => '&rarr;' ] ); ?>
    </nav>

    <?php else : ?>
      <p class="body-copy" style="padding: 80px 0;">No posts yet.</p>
    <?php endif; ?>

  </div>

</main>

<?php
get_footer();
