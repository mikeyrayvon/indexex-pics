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

    $location = get_post_meta($post->ID, '_igv_expo_location', true);

    $date_format = 'j F Y';
    $format_converted = qtranxf_convertFormat($date_format, $date_format);

    $date_open = get_post_meta($post->ID, '_igv_expo_date_open', true);
    if (!empty($date_open)) {
      $open_str = qtranxf_strftime($format_converted, $date_open);
    }

    $date_close = get_post_meta($post->ID, '_igv_expo_date_close', true);
    if (!empty($date_close)) {
      $close_str = qtranxf_strftime($format_converted, $date_close);
    }

    $map = get_post_meta($post->ID, '_igv_expo_map', true);

    $docu = get_post_meta($post->ID, '_igv_expo_docu', true);

?>

        <article <?php post_class('grid-item item-s-12 no-gutter grid-row'); ?> id="post-<?php the_ID(); ?>">
          <div class="expo-details grid-item item-s-12 item-m-7 item-l-6 margin-bottom-basic">
            <h1 class="margin-bottom-basic"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
            <?php if (!empty($artists)) {
              echo '<p><ul class="artist-list">';
              foreach($artists as $artist) {
                echo '<li>' . $artist->name . '</li>';
              }
              echo '</ul></p>';
            } ?>
            <?php echo !empty($location) ? apply_filters('the_content', $location) : ''; ?>
            <?php echo !empty($date_open) ? '<p><time>' . $open_str . '</time>' : ''; ?>
            <?php echo !empty($date_close) ? ' - <time>' . $close_str . '</time>' : ''; ?>
            <?php echo !empty($date_open) ? '</p>' : ''; ?>
          </div>
          <div id="map-holder" class="grid-item item-s-12 item-m-5 item-l-4 offset-l-2 margin-bottom-basic">
            <?php echo !empty($map) ? $map : ''; ?>
          </div>
<?php
      if (!empty($docu)) {
?>
          <div class="grid-item item-s-12 item-l-8 margin-bottom-basic">
            <?php echo apply_filters('the_content', $docu); ?>
          </div>
<?php
      }
?>
          <div class="grid-item item-s-12 item-l-4">
            <?php the_content(); ?>
          </div>
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
