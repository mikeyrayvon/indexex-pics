<nav id="pagination" class="container grid-row">
<?php
if (is_single()) {
?>
  <div class="grid-item item-s-6">
    <?php next_post_link("%link", "&larr; %title"); ?>
  </div>
  <div class="grid-item item-s-6 text-align-right">
    <?php previous_post_link("%link", "%title &rarr;"); ?>
  </div>
<?php
} else {
?>
  <div class="grid-item item-s-12 text-align-center">
    <?php
    global $wp_query;

    $currentLang = qtranxf_getLanguage();
    $prev_text = $currentLang == 'en' ? 'Newer' : 'Adelante';
    $next_text = $currentLang == 'en' ? 'Older' : 'Atrás';

    $big = 999999999; // need an unlikely integer
    $translated = __( 'Page', 'mytextdomain' ); // Supply translatable string

    echo paginate_links( array(
    	'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
    	'format' => '?paged=%#%',
      'prev_text' => '&larr;' . $prev_text,
      'next_text' => $next_text . '&rarr;',
    	'current' => max( 1, get_query_var('paged') ),
    	'total' => $wp_query->max_num_pages,
            'before_page_number' => '<span class="u-visuallyhidden">'.$translated.' </span>'
    ) );
    ?>
  </div>
<?php
}
?>
</nav>
