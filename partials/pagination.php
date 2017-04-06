<nav id="pagination" class="container grid-row">
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
      'prev_text' => $prev_text,
      'next_text' => $next_text,
    	'current' => max( 1, get_query_var('paged') ),
    	'total' => $wp_query->max_num_pages,
            'before_page_number' => '<span class="u-visuallyhidden">'.$translated.' </span>'
    ) );
    ?>
  </div>
</nav>
