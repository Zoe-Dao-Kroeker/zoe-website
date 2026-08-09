<?php
/**
 * Mel Custom Theme — searchform.php
 * Used by get_search_form() wherever a search box appears (404, search page).
 * A unique id per instance keeps the label association valid when more than
 * one form renders on a page.
 */

$id = 'search-' . wp_unique_id();
?>
<form role="search" method="get" class="search-form"
      action="<?php echo esc_url( home_url( '/' ) ); ?>">
  <label class="screen-reader-text" for="<?php echo esc_attr( $id ); ?>">
    <?php echo esc_html_x( 'Search for:', 'label', 'zoe-theme' ); ?>
  </label>
  <input type="search" id="<?php echo esc_attr( $id ); ?>"
         class="search-form__field" name="s"
         value="<?php echo esc_attr( get_search_query() ); ?>"
         placeholder="Search the writing">
  <button type="submit" class="btn search-form__submit">Search</button>
</form>
