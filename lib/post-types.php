<?php
// Menu icons for Custom Post Types
// https://developer.wordpress.org/resource/dashicons/
function add_menu_icons_styles(){
?>

<style>
#menu-posts .dashicons-admin-post:before {
    content: '\f161';
}
#menu-posts-notice .dashicons-admin-post:before {
    content: '\f109';
}
</style>

<?php
}
add_action( 'admin_head', 'add_menu_icons_styles' );


//Register Custom Post Types
add_action( 'init', 'register_cpt_notice' );

function register_cpt_notice() {

    $labels = array(
        'name' => _x( 'Notices', 'notice' ),
        'singular_name' => _x( 'Notice', 'notice' ),
        'add_new' => _x( 'Add New', 'notice' ),
        'add_new_item' => _x( 'Add New notice', 'notice' ),
        'edit_item' => _x( 'Edit notice', 'notice' ),
        'new_item' => _x( 'New notice', 'notice' ),
        'view_item' => _x( 'View notice', 'notice' ),
        'search_items' => _x( 'Search notices', 'notice' ),
        'not_found' => _x( 'No notices found', 'notice' ),
        'not_found_in_trash' => _x( 'No notices found in Trash', 'notice' ),
        'parent_item_colon' => _x( 'Parent notice:', 'notice' ),
        'menu_name' => _x( 'Notices', 'notice' ),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => false,

        'supports' => array( 'title', ),

        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,

        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => true,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( 'notice', $args );
}
