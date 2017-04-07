<?php

/* Get post objects for select field options */
function get_post_objects( $query_args ) {
$args = wp_parse_args( $query_args, array(
    'post_type' => 'post',
) );
$posts = get_posts( $args );
$post_options = array();
if ( $posts ) {
    foreach ( $posts as $post ) {
        $post_options [ $post->ID ] = $post->post_title;
    }
}
return $post_options;
}


/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

/**
 * Hook in and add metaboxes. Can only happen on the 'cmb2_init' hook.
 */
add_action( 'cmb2_init', 'igv_cmb_metaboxes' );
function igv_cmb_metaboxes() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_igv_';

	/**
	 * Metaboxes declarations here
   * Reference: https://github.com/WebDevStudios/CMB2/blob/master/example-functions.php
	 */

  $expo_meta = new_cmb2_box( array(
    'id'            => $prefix . 'expo',
    'title'         => esc_html__( 'Expo Meta', 'cmb2' ),
    'object_types'  => array( 'post', ),
 	) );

  $expo_meta->add_field( array(
		'name' => esc_html__( 'Open Date', 'cmb2' ),
		'id'   => $prefix . 'expo_date_open',
		'type' => 'text_date_timestamp',
	) );

  $expo_meta->add_field( array(
		'name' => esc_html__( 'Close Date', 'cmb2' ),
		'id'   => $prefix . 'expo_date_close',
		'type' => 'text_date_timestamp',
	) );

  $expo_meta->add_field( array(
		'name'    => esc_html__( 'Location', 'cmb2' ),
		'id'      => $prefix . 'expo_location',
		'type'    => 'wysiwyg',
		'options' => array( 'textarea_rows' => 4, ),
	) );

  $expo_meta->add_field( array(
		'name' => esc_html__( 'Map Embed', 'cmb2' ),
		'id'   => $prefix . 'expo_map',
		'type' => 'textarea_code',
	) );

  $expo_meta->add_field( array(
		'name'    => esc_html__( 'Documentation', 'cmb2' ),
		'id'      => $prefix . 'expo_docu',
		'type'    => 'wysiwyg',
		'options' => array( 'textarea_rows' => 10, ),
	) );

  $expo_front_group = $expo_meta->add_field( array(
		'id'          => $prefix . 'expo_front',
    'name'    => esc_html__( 'Front images', 'cmb2' ),
		'type'        => 'group',
		'options'     => array(
			'group_title'   => esc_html__( 'Image {#}', 'cmb2' ), // {#} gets replaced by row number
			'add_button'    => esc_html__( 'Add Another Image', 'cmb2' ),
			'remove_button' => esc_html__( 'Remove Image', 'cmb2' ),
			'sortable'      => true, // beta
			'closed'     => true, // true to have the groups closed by default
		),
	) );

  $expo_meta->add_group_field( $expo_front_group, array(
		'name' => esc_html__( 'Image', 'cmb2' ),
		'id'   => 'image',
		'type' => 'file',
	) );

  // INFO

  $info_meta = new_cmb2_box( array(
    'id'            => $prefix . 'info_meta',
    'title'         => esc_html__( 'Info Meta', 'cmb2' ),
    'object_types'  => array( 'page', ),
 	) );

  $info_meta->add_field( array(
		'name'    => esc_html__( 'Donate', 'cmb2' ),
		'id'      => $prefix . 'info_donate',
		'type'    => 'wysiwyg',
		'options' => array( 'textarea_rows' => 5, ),
	) );

  $info_meta->add_field( array(
		'name'    => esc_html__( 'Submit', 'cmb2' ),
		'id'      => $prefix . 'info_submit',
		'type'    => 'wysiwyg',
		'options' => array( 'textarea_rows' => 10, ),
	) );

  // NOTICE

  $notice_meta = new_cmb2_box( array(
    'id'            => $prefix . 'notice_meta',
    'title'         => esc_html__( 'Notice Meta', 'cmb2' ),
    'object_types'  => array( 'notice', ),
 	) );

  $notice_meta->add_field( array(
		'name' => esc_html__( 'End Date', 'cmb2' ),
		'id'   => $prefix . 'notice_end_date',
		'type' => 'text_date_timestamp',
	) );

}
?>
