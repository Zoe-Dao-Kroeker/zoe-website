<?php
/**
 * Mel Custom Theme — page.php
 * Generic page template for About, Guest Teaching, and any static WP Page.
 * No featured image hero. Editorial typography. Content edited in WP Admin.
 */

get_header();

while ( have_posts() ) : the_post();
?>

<main class="page-main" id="main">

  <header class="page-header">
    <div class="container">
      <h1 class="page-title"><?php the_title(); ?></h1>
    </div>
  </header>

  <div class="container">
    <div class="body-copy page-content">
      <?php the_content(); ?>
    </div>
  </div>

</main>

<?php
endwhile;

get_footer();
