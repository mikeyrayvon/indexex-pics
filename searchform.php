<form role="search" method="get" id="searchform" class="searchform grid-row" action="<?php echo esc_url( home_url( '/' ) ); ?>">
  <label class="u-visuallyhidden" for="s"><?php _x( 'Search for:', 'label' ); ?></label>
  <div class="grid-item item-s-8">
    <input id="search-text-input" type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" />
  </div>
  <div class="grid-item item-s-4 text-align-right">
    <input type="submit" id="searchsubmit" value="<?php _e('[:es]Buscar[:en]Search[:]'); ?>" />
  </div>
</form>
