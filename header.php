<!DOCTYPE html>
<html lang="en" prefix="og: http://ogp.me/ns#">
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title><?php wp_title('|',true,'right'); bloginfo('name'); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <?php
    get_template_part('partials/globie');
    get_template_part('partials/seo');
  ?>

  <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
  <link rel="apple-touch-icon" sizes="152x152" href="<?php bloginfo('stylesheet_directory'); ?>/img/dist/apple-touch-icon.png">
  <link rel="icon" type="image/png" href="<?php bloginfo('stylesheet_directory'); ?>/img/dist/favicon-32x32.png" sizes="32x32">
  <link rel="icon" type="image/png" href="/path/favicon-16x16.png" sizes="16x16">
  <link rel="manifest" href="<?php bloginfo('stylesheet_directory'); ?>/manifest.json">
  <link rel="mask-icon" href="<?php bloginfo('stylesheet_directory'); ?>/img/dist/safari-pinned-tab.svg" color="#d1bba7">
  <link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/img/dist/favicon.ico">
  <meta name="apple-mobile-web-app-title" content="indexex.site">
  <meta name="application-name" content="indexex.site">
  <meta name="msapplication-config" content="<?php bloginfo('stylesheet_directory'); ?>/browserconfig.xml">
  <meta name="theme-color" content="#d1bba7">

  <?php if (is_singular() && pings_open(get_queried_object())) { ?>
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
  <?php } ?>
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<!--[if lt IE 9]><p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p><![endif]-->

<section id="main-container">

<?php
if (!is_paged() && !is_single()) {
$args = array(
	'post_type'              => array( 'notice' ),
	'posts_per_page'         => '1',
);
$query = new WP_Query( $args );

if ( $query->have_posts() ) {
	while ( $query->have_posts() ) {
		$query->the_post();

    $active = true;

    $end_date = get_post_meta($post->ID, '_igv_notice_end_date', true);

    if (!empty($end_date)) {
      $active = time() > $end_date ? false : true;
    }

    if ($active) {
?>
<div id="notice" class="padding-top-small padding-bottom-tiny">
  <div class="container">
    <div class="grid-row">
      <div class="grid-item item-s-12 item-m-6">
        <?php the_content(); ?>
      </div>
    </div>
  </div>
</div>
<?php
    }
	}
}

wp_reset_postdata();
}
?>

<?php
if (qtranxf_getLanguage() == 'es') {
  $lang_switch = is_404() ? home_url() : qtranxf_convertURL('', 'en', false, true);
} else {
  $lang_switch = is_404() ? home_url() : qtranxf_convertURL('', 'es', false, true);
}
?>

  <header id="header" class="container margin-top-small margin-bottom-large">
    <nav id="main-nav" class="grid-row align-items-start">
      <div class="grid-item item-s-8 item-l-6 margin-bottom-small">
        <h1><a href="<?php echo home_url(); ?>" title="<?php _e('[:es]Mi nombre[:en]My name[:]'); ?>"><?php bloginfo('name'); ?></a></h1>
      </div>
      <div id="header-search-holder" class="grid-item item-s-12 item-l-4 margin-top-micro no-gutter">
        <?php get_search_form(true); ?>
      </div>
      <div class="grid-item item-s-4 item-l-2 no-gutter grid-row text-align-right font-size-large">
        <div class="grid-item item-s-12 item-l-8">
          <a href="<?php echo $lang_switch; ?>" title="<?php _e('[:es]English[:en]Español[:]'); ?>"><?php _e('[:es]Eng[:en]Esp'); ?></a>
        </div>
        <div class="grid-item item-s-12 item-l-4">
          <a href="<?php echo home_url('/info'); ?>" title="<?php _e('[:es]Quien soy?[:en]Who am I?[:]'); ?>">?</a>
        </div>
      </div>
    </nav>
  </header>
