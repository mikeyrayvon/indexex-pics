<?php
add_action( 'init', 'create_artist_tax' );

function create_artist_tax() {
	register_taxonomy(
		'artist',
		'post',
		array(
			'label' => __( 'Artists' ),
			'rewrite' => array( 'slug' => 'artist' ),
			'hierarchical' => false,
		)
	);
}
