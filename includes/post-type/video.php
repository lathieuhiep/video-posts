<?php
/*
*---------------------------------------------------------------------
* Create Post Type Video
*---------------------------------------------------------------------
*/

add_action( 'init', 'video_post_type_create', 10 );

function video_post_type_create() {

    /* Start post type video */
    $labels = array(
        'name'                  =>  _x( 'Video Posts', 'post type general name', 'video-post' ),
        'singular_name'         =>  _x( 'Video Posts', 'post type singular name', 'video-post' ),
        'menu_name'             =>  _x( 'Video Posts', 'admin menu', 'video-post' ),
        'name_admin_bar'        =>  _x( 'All Video Post', 'add new on admin bar', 'video-post' ),
        'add_new'               =>  _x( 'Add New', 'Video Post', 'video-post' ),
        'add_new_item'          =>  esc_html__( 'Add New Video Post', 'video-post' ),
        'edit_item'             =>  esc_html__( 'Edit Video Post', 'video-post' ),
        'new_item'              =>  esc_html__( 'New Video Post', 'video-post' ),
        'view_item'             =>  esc_html__( 'View Video Post', 'video-post' ),
        'all_items'             =>  esc_html__( 'All Video Post', 'video-post' ),
        'search_items'          =>  esc_html__( 'Search Video Post', 'video-post' ),
        'not_found'             =>  esc_html__( 'No video post found', 'video-post' ),
        'not_found_in_trash'    =>  esc_html__( 'No video post found in trash', 'video-post' ),
        'parent_item_colon'     =>  ''
    );

    $args = array(
        'labels'            =>  $labels,
        'public'            =>  true,
        'show_ui'           =>  true,
        'show_in_menu'      =>  true,
        'query_var'         =>  true,
        'menu_icon'         =>  'dashicons-video-alt3',
        'rewrite'           =>  array( 'slug' => 'video' ),
        'capability_type'   =>  'post',
        'has_archive'       =>  true,
        'hierarchical'      =>  true,
        'menu_position'     =>  5,
        'supports'          =>  array( 'title', 'editor', 'thumbnail', 'excerpt' ),
    );

    register_post_type('video_post', $args );
    /* End post type video */

    /* Start taxonomy video */
    $taxonomy_labels = array(

        'name'              =>  _x( 'Video categories', 'taxonomy general name', 'video-post' ),
        'singular_name'     =>  _x( 'Video category', 'taxonomy singular name', 'video-post' ),
        'search_items'      =>  esc_html__( 'Search video category', 'video-post' ),
        'all_items'         =>  esc_html__( 'All Category', 'video-post' ),
        'parent_item'       =>  esc_html__( 'Parent category', 'video-post' ),
        'parent_item_colon' =>  esc_html__( 'Parent category:', 'video-post' ),
        'edit_item'         =>  esc_html__( 'Edit category', 'video-post' ),
        'update_item'       =>  esc_html__( 'Update category', 'video-post' ),
        'add_new_item'      =>  esc_html__( 'Add New category', 'video-post' ),
        'new_item_name'     =>  esc_html__( 'New category Name', 'video-post' ),
        'menu_name'         =>  esc_html__( 'Categories', 'video-post' ),

    );

    $taxonomy_args = array(

        'labels'            =>  $taxonomy_labels,
        'hierarchical'      =>  true,
        'public'            =>  true,
        'show_ui'           =>  true,
        'show_admin_column' =>  true,
        'query_var'         =>  true,
        'rewrite'           =>  array( 'slug' => 'video-category' ),

    );

    register_taxonomy( 'video_cat', array( 'video_post' ), $taxonomy_args );
    /* End taxonomy video */

    /* Start tag video */
    $taxonomy_tag_labels = array(
        'name'          =>  _x( 'Video tag', 'taxonomy general name', 'video-post' ),
        'singular_name' =>  _x( 'Tag', 'taxonomy singular name', 'video-post' ),
        'search_items'  =>  esc_html__( 'Search video tag', 'video-post' ),
        'edit_item'     =>  esc_html__( 'Edit Tag', 'video-post' ),
        'update_item'   =>  esc_html__( 'Update Tag', 'video-post' ),
        'add_new_item'  =>  esc_html__( 'Add New Tag', 'video-post' ),
        'new_item_name' =>  esc_html__( 'New Tag Name', 'video-post' ),
        'menu_name'     =>  esc_html__( 'Tag', 'video-post' ),
    );

    $taxonomy_tag_args = array(
        'hierarchical'      =>  '',
        'labels'            =>  $taxonomy_tag_labels,
        'show_ui'           =>  true,
        'show_admin_column' =>  true,
        'singular_label'    =>  _x( 'Video Tag', 'taxonomy singular label', 'video-post' ),
        'rewrite'           =>  array( 'slug' => 'video-tag' ),
    );

    register_taxonomy( 'video_tag', array( 'video_post' ), $taxonomy_tag_args );
    /* End tag video */

}