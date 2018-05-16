<?php
/*
Plugin Name: Video Posts
Plugin URI: https://www.facebook.com/lathieuhiep
Description: Plugin video post type.
Version: 1.0.0
Author: La Thiếu Hiệp
Author URI: https://www.facebook.com/lathieuhiep
License: GPLv2 or later
Text Domain: video-post
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

if ( !class_exists( 'WP_Video_PostType' ) ) :

    class WP_Video_PostType {

        /*
        * This method loads other methods of the class.
        */
        function __construct() {

            /* Load define */
            $this->video_post_define();

            /* load languages */
            $this->video_post_languages();

            /* load includes */
            $this->video_post_includes();

            /*load script*/
            $this ->video_post_script();

        }

        /* Load define */
        function video_post_define() {

            define( 'video_post_path', plugin_dir_url( __FILE__ ) );

            define( 'video_post_server_path', dirname( __FILE__ ) );

        }

        /* Load languages */
        function video_post_languages() {

            add_action( 'plugins_loaded', array( $this, 'video_post_text_domain' ) );

        }

        /* Text domain */
        function video_post_text_domain() {

            load_plugin_textdomain( 'video-post', false, video_post_path . 'languages' );

        }

        /* Load includes */
        function video_post_includes() {

            require_once video_post_server_path . '/includes/video-post-includes.php';

        }

        /* Load script */
        function video_post_script() {

            add_action( 'wp_enqueue_scripts',array( $this, 'video_post_frontend_scripts' ) );

        }

        /* Frontend scripts */
        function video_post_frontend_scripts() {

            wp_enqueue_style( 'video-post', video_post_path. 'assets/css/video-post.css', array(), '' );

        }

    }

    $WP_Video_PostType = new WP_Video_PostType();

endif;