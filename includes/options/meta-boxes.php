<?php
/*
*---------------------------------------------------------------------
* Option Meta boxes Post Type Video
*---------------------------------------------------------------------
*/

add_action('add_meta_boxes', 'video_post_meta_box');

function video_post_meta_box() {

    add_meta_box( 'video-post', 'Options Video Post', 'video_post_meta_box_option', 'video_post', 'advanced', 'low' );
}

function video_post_meta_box_option( $post, $metabox ) {

    wp_nonce_field( basename(__FILE__), "meta-box-video-post-nonce" );

?>

    <p>
        <label for="meta-select-video" class="prfx-row-title">
            <?php esc_html_e( 'Type Video', 'video-post' ); ?>
        </label>

        <select name="meta-select-video" id="meta-select-video">

        </select>
    </p>

<?php

}