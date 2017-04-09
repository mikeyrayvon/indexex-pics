<?php
get_header();
?>

<main id="main-content">
  <section id="posts">
    <div class="container">

<?php
if( have_posts() ) {
  while( have_posts() ) {
    the_post();

    $post_count = wp_count_posts()->publish;
    $friends_url = home_url('/amigos');
    $donate = get_post_meta($post->ID, '_igv_info_donate', true);
    $submit = get_post_meta($post->ID, '_igv_info_submit', true);
?>
      <article <?php post_class('grid-row'); ?> id="post-<?php the_ID(); ?>">
        <div class="grid-item item-s-12 item-m-8 item-l-5 font-size-large margin-bottom-basic">
          <?php the_content(); ?>
          <p><?php _e('[:es]Tengo un total de ' . $post_count . ' exposiciones.[:en]I have a total of ' . $post_count . ' exhibitions.'); ?></p>
          <div id="weather"></div>
          <?php /*
          <p><?php _e('[:es]Y tengo <a href="' . $friends_url . '">amigos</a> maravillosos.[:en]And I have wonderful <a href="' . $friends_url . '">friends</a>.'); ?></p>
          */ ?>
        </div>
        <div class="grid-item item-s-12 item-m-6 item-l-5 offset-l-1 margin-bottom-basic">
          <?php
            if (!empty($submit)) {
              echo apply_filters('the_content', $submit);
            }
          ?>
        </div>
        <div class="grid-item item-s-12 item-m-6 item-l-4 margin-bottom-basic">
          <?php
            if (!empty($donate)) {
              echo apply_filters('the_content', $donate);
            }
          ?>

          <form id="donation-form" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
            <input type="hidden" name="cmd" value="_s-xclick">
            <input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
            ">
          </form>



        </div>

      </article>
<?php
}
  }
?>

    </div>
  </section>

</main>

<?php
get_footer();
?>
