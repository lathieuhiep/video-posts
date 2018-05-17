<?php
/*
*---------------------------------------------------------------------
* Option Meta boxes Post Type Video
*---------------------------------------------------------------------
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class WP_Video_PostType_Custom_Meta_Box {

    /**
     * Constructor.
     */
    public function __construct() {

        if ( is_admin() ) {

            add_action( 'load-post.php',     array( $this, 'init_metabox' ) );
            add_action( 'load-post-new.php', array( $this, 'init_metabox' ) );

        }

    }

    /**
     * Meta box initialization.
     */
    public function init_metabox() {

        add_action( 'add_meta_boxes', array( $this, 'video_post_meta_box'  ) );
        add_action( 'save_post', array( $this, 'video_post_meta_box_save' ), 10, 2 );

    }

    /**
     * Adds the meta box.
     */
    public function video_post_meta_box() {

        add_meta_box( 'video-post-meta-box', 'Options Video Post', array( $this, 'video_post_meta_box_option' ), 'video_post', 'advanced', 'low' );

    }

    public function video_post_meta_box_option( $post, $metabox ) {

        // Add nonce for security and authentication.
        // Add nonce for security and authentication.
        wp_nonce_field( 'custom_nonce_action', 'custom_nonce' );
        $video_post_get_meta = get_post_meta( $post->ID );

?>

        <div class="video-post-option-meta-box">
            <div id="meta-box-type-video-post" class="meta-box-video-post-item">
                <label for="meta-select-video-post" class="video-post-meta-box-label">
                    <?php esc_html_e( 'Type Video:', 'video-post' ); ?>
                </label>

                <select name="meta-select-video-post" id="meta-select-video-post" class="video-meta-box-select">
                    <option value="link-url" <?php if ( isset ( $video_post_get_meta['meta-select-video-post'] ) ) selected( $video_post_get_meta['meta-select-video-post'][0], 'link-url' ); ?>>
                        <?php esc_html_e( 'Link Url', 'video-post' ); ?>
                    </option>

                    <option value="video-html" <?php if ( isset ( $video_post_get_meta['meta-select-video-post'] ) ) selected( $video_post_get_meta['meta-select-video-post'][0], 'video-html' ); ?>>
                        <?php esc_html_e( 'Video HTML5', 'video-post' ); ?>
                    </option>
                </select>
            </div>

            <div id="meta-box-type-video-url" class="meta-box-video-post-item">
                <label for="meta-video-post-url" class="video-post-meta-box-label">
                    <?php esc_html_e( 'Video URL:', 'video-post' ); ?>
                </label>

                <input type="url" name="meta-video-post-url" id="meta-video-post-url" value="<?php if ( isset ( $video_post_get_meta['meta-video-post-url'] ) ) echo $video_post_get_meta['meta-video-post-url'][0]; ?>" size="40" style="width: 30%" />
            </div>
        </div>

<?php

    }

    /**
     * Saves video meta boxes
     */
    public function video_post_meta_box_save( $post_id ) {

        // Add nonce for security and authentication.
        $nonce_name   = isset( $_POST['custom_nonce'] ) ? $_POST['custom_nonce'] : '';
        $nonce_action = 'custom_nonce_action';

        $video_post_meta_box_key    =   array(
            'meta-select-video-post',
            'meta-video-post-url'
        );

        // Check if nonce is set.
        if ( ! isset( $nonce_name ) ) {
            return;
        }

        // Check if nonce is valid.
        if ( ! wp_verify_nonce( $nonce_name, $nonce_action ) ) {
            return;
        }

        // Check if user has permissions to save data.
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }

        // Check if not an autosave.
        if ( wp_is_post_autosave( $post_id ) ) {
            return;
        }

        // Check if not a revision.
        if ( wp_is_post_revision( $post_id ) ) {
            return;
        }

        foreach ( $video_post_meta_box_key as $video_post_meta_box_key_item ) :

            if( isset( $_POST[ $video_post_meta_box_key_item ] ) ) :

                update_post_meta( $post_id, $video_post_meta_box_key_item, $_POST[ $video_post_meta_box_key_item ] );

            endif;

        endforeach;

    }

}

new WP_Video_PostType_Custom_Meta_Box();