<?php
/*
 * Video post function
 * */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Video_Post_Template_Loader {

    function __construct() {

        add_filter( 'template_include', array( $this, 'video_post_template_include' ), 1 );

    }

   function video_post_template_include( $template_path ) {

        if ( get_post_type() == 'video_post' && is_singular( 'video_post' ) ) {

            $template_path = video_post_server_path . 'templates/single-video_post.php';

        }

        return $template_path;

    }

}

new Video_Post_Template_Loader();



