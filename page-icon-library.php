<?php
/**
 * Template Name: Icon Library
 *
 * Zoe Dao-Kroeker Custom Theme — page-icon-library.php
 * The full searchable Phosphor set. Globs the real folder at render time —
 * never a hardcoded list — so a future re-sync just works.
 */

get_header();

$icon_dir = get_theme_file_path( 'assets-icons/System Icons' );
$icon_dir_uri = get_theme_file_uri( 'assets-icons/System Icons' );
$icon_files = glob( $icon_dir . '/*.svg' );
sort( $icon_files );
?>

<main class="zoe-main" id="main">
  <header class="dg-header">
    <div class="eyebrow">Zoe Dao-Kroeker</div>
    <h1 class="dg-h1">Icon Library</h1>
    <p class="dg-lede">The full Phosphor set, Light weight — <?php echo (int) count( $icon_files ); ?> icons.</p>
  </header>

  <section class="dg-section">
    <input type="search" id="iconSearch" placeholder="Search icons&hellip;"
           style="width:100%; max-width:400px; padding: var(--sp-12) var(--sp-16); border: 1px solid var(--border); border-radius: var(--radius-pill); font-family: var(--font-sans); font-size: var(--type-body);">
    <div class="dg-icon-grid" id="iconGrid" style="margin-top: var(--sp-32); grid-template-columns: repeat(auto-fill, minmax(110px, 1fr));">
      <?php foreach ( $icon_files as $file ) :
          $name = basename( $file, '.svg' );
      ?>
        <div class="dg-icon-cell" data-name="<?php echo esc_attr( $name ); ?>">
          <img src="<?php echo esc_url( $icon_dir_uri . '/' . rawurlencode( basename( $file ) ) ); ?>" width="28" height="28" alt="" loading="lazy">
          <span><?php echo esc_html( $name ); ?></span>
        </div>
      <?php endforeach; ?>
    </div>
  </section>
</main>

<script>
document.getElementById('iconSearch').addEventListener('input', function (e) {
  var q = e.target.value.toLowerCase();
  document.querySelectorAll('#iconGrid .dg-icon-cell').forEach(function (cell) {
    cell.style.display = cell.getAttribute('data-name').indexOf(q) !== -1 ? '' : 'none';
  });
});
</script>

<?php get_footer(); ?>
