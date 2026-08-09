<?php
/**
 * Mel Custom Theme — archive.php
 * Category, tag, date, and other archives.
 * Same grid layout as home.php but shows the archive title.
 */

get_header();
?>

<main class="blog-archive" id="main">

  <header class="blog-archive__header">
    <div class="container">
      <span class="eyebrow eyebrow--muted"><?php
        if ( is_category() )      echo 'Category';
        elseif ( is_tag() )       echo 'Tag';
        elseif ( is_date() )      echo 'Archive';
        else                      echo 'Writing';
      ?></span>
      <h1 class="blog-archive__title"><?php the_archive_title(); ?></h1>
    </div>
  </header>

  <div class="container">

    <?php if ( have_posts() ) : ?>

    <div class="blog-grid">
      <?php while ( have_posts() ) : the_post(); ?>

      <?php
        $has_thumb = has_post_thumbnail();
        $cats      = get_the_category();
        $cat_name  = $cats ? $cats[0]->name : '';
      ?>
      <article class="blog-card" id="post-<?php the_ID(); ?>">
        <a href="<?php the_permalink(); ?>" class="blog-card__link">
          <div class="blog-card__img-wrap">
            <?php if ( $has_thumb ) : ?>
              <?php the_post_thumbnail( 'large', [ 'class' => 'blog-card__img' ] ); ?>
            <?php endif; ?>
            <div class="blog-card__body">
              <span class="blog-card__eyebrow"><?php echo $cat_name ? esc_html( $cat_name ) : 'Blog'; ?></span>
              <h2 class="blog-card__title"><?php the_title(); ?></h2>
              <p class="blog-card__excerpt"><?php echo wp_strip_all_tags( get_the_excerpt() ); ?></p>
              <p class="blog-card__meta"><time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo get_the_date( 'M j, Y' ); ?></time></p>
            </div>
          </div>
        </a>
      </article>

      <?php endwhile; ?>
    </div>

    <nav class="blog-pagination" aria-label="Posts navigation">
      <?php the_posts_pagination( [ 'mid_size' => 2, 'prev_text' => '←', 'next_text' => '→' ] ); ?>
    </nav>

    <?php else : ?>
    <p class="body-copy" style="padding: 80px 0; opacity: .5;">No posts found.</p>
    <?php endif; ?>

  </div>

</main>

<?php
get_footer();
