<?php
/*
Plugin Name: Options & Settings API
Description: Create options page
*/

function smp_cpt_activation(){
    register_post_type('custom', array(
        'label'  => null,
        'labels' => array(
            'name'               => 'Custom post',
            'singular_name'      => 'Custom post',
            'add_new'            => 'Add new custom post',
            'add_new_item'       => 'Add new custom post',
            'edit_item'          => 'Edit custom post',
            'new_item'           => 'New custom post',
            'view_item'          => 'Show custom post',
            'search_items'       => 'Search custom post',
            'not_found'          => 'Custom post not found',
            'not_found_in_trash' => 'Custom post not found in trash',
            'parent_item_colon'  => '',
            'menu_name'          => 'Custom post',
        ),
        'description'         => '',
        'public'              => true,
        'menu_position'       => 98,
        'menu_icon'           => 'dashicons-groups',
        'hierarchical'        => false,
        'supports'            => array('title','page-attributes','custom-fields'), // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
        'taxonomies'          => array(),
        'has_archive'         => false,
        'rewrite'             => true,
        'query_var'           => true,
    ) );
}

//register_activation_hook( __FILE__ , 'smp_cpt_activation' );
add_action('init', 'smp_cpt_activation');

include 'admin/create-page.php';

add_filter('template_include', 'custom_page_template');
function custom_page_template( $template ){
    if( is_single('custom') ){
        $template = wp_normalize_path( WP_PLUGIN_DIR ) . '/add-option-page/post-custom.php';
        return $template;
    }
    return $template;
}
