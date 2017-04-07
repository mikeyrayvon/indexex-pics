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

    $donate = get_post_meta($post->ID, '_igv_info_donate', true);
    $submit = get_post_meta($post->ID, '_igv_info_submit', true);


?>
      <article <?php post_class('grid-row'); ?> id="post-<?php the_ID(); ?>">
        <div class="grid-item item-s-12 item-m-8 item-l-5 font-size-large">
          <?php the_content(); ?>
        </div>
        <div class="grid-item item-s-12 item-m-6 item-l-4 offset-l-1">
          <?php
            if (!empty($submit)) {
              echo apply_filters('the_content', $submit);
            }
          ?>
        </div>
        <div class="grid-item item-s-12 item-m-6 item-l-4">
          <?php
            if (!empty($donate)) {
              echo apply_filters('the_content', $donate);
            }
          ?>

          <form id="donation-form" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
            <input type="hidden" name="cmd" value="_donations">
            <input type="hidden" name="business" value="TTDMQ3DFLDW7Q">
            <input type="hidden" name="lc" value="US">
            <input type="hidden" name="item_name" value="Indice de Exposiciones Exteriores">
            <input type="hidden" name="currency_code" value="MXN">
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
