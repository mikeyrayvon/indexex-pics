<?php
get_header();
?>

<main id="main-content">
  <section id="posts">
    <div class="container">
      <div class="grid-row">

<?php
if( have_posts() ) {
  while( have_posts() ) {
    the_post();

    $artists = get_the_terms($post, 'artist');

    $date_format = 'j M Y';
    $format_converted = qtranxf_convertFormat($date_format, $date_format);

    $date_open = get_post_meta($post->ID, '_igv_expo_date_open', true);
    if (!empty($date_open)) {
      $open_str = qtranxf_strftime($format_converted, $date_open);
    }

    $date_close = get_post_meta($post->ID, '_igv_expo_date_close', true);
    if (!empty($date_close)) {
      $close_str = qtranxf_strftime($format_converted, $date_close);
    }

    $images = get_post_meta($post->ID, '_igv_expo_front', true);

?>

        <article <?php post_class('grid-item item-s-12 no-gutter margin-bottom-basic'); ?> id="post-<?php the_ID(); ?>">
          <div class="grid-row margin-bottom-small align-items-end">
            <div class="grid-item item-s-12 item-m-6 item-l-8 margin-bottom-tiny">
              <h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
            </div>
            <div class="expo-details grid-item item-s-12 item-m-6 item-l-4 margin-bottom-tiny">
              <?php if (!empty($artists)) {
                echo '<ul class="artist-list">';
                foreach($artists as $artist) {
                  echo '<li>' . $artist->name . '</li>';
                }
                echo '</ul>';
              } ?>
              <?php echo !empty($date_open) ? '<p><time>' . $open_str . '</time>' : ''; ?>
              <?php echo !empty($date_close) ? ' - <time>' . $close_str . '</time>' : ''; ?>
              <?php echo !empty($date_open) ? '</p>' : ''; ?>
            </div>
          </div>

<?php
      if (!empty($images)) {
?>
          <div class="front-images-holder grid-row">
<?php
        foreach ($images as $image) {
          $img_src = wp_get_attachment_image_url( $image['image_id'], 'medium' );
          $img_srcset = wp_get_attachment_image_srcset( $image['image_id'], 'medium' );
?>

            <div class="grid-item item-s-12 item-m-6 item-l-4 margin-bottom-small">
              <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
                <img src="<?php echo esc_url( $img_src ); ?>" srcset="<?php echo esc_attr( $img_srcset ); ?>">
              </a>
            </div>

<?php
        }
?>
          </div>
<?php
      }
?>
        </article>

<?php
  }
} else {
?>
        <article class="u-alert grid-item item-s-12"><?php _e('Sorry, no posts matched your criteria :{'); ?></article>
<?php
} ?>

      </div>
    </div>
  </section>

  <?php get_template_part('partials/pagination'); ?>

</main>

<?php
get_footer();
?>
