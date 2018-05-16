<?php
/*
*---------------------------------------------------------------------
* Option Meta boxes Post Type Video
*---------------------------------------------------------------------
*/

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

        <div class="video-option-meta-box">
            <p>
                <label for="meta-select-video" class="video-meta-box-label">
                    <?php esc_html_e( 'Type Video:', 'video-post' ); ?>
                </label>

                <select name="meta-select-video" id="meta-select-video" class="video-meta-box-select">
                    <option value="link-url" <?php if ( isset ( $video_post_get_meta['meta-select-video'] ) ) selected( $video_post_get_meta['meta-select-video'][0], 'link-url' ); ?>>
                        <?php esc_html_e( 'Link Url', 'video-post' ); ?>
                    </option>

                    <option value="video-html" <?php if ( isset ( $video_post_get_meta['meta-select-video'] ) ) selected( $video_post_get_meta['meta-select-video'][0], 'video-html' ); ?>>
                        <?php esc_html_e( 'Video HTML5', 'video-post' ); ?>
                    </option>
                </select>
            </p>
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

        if( isset( $_POST[ 'meta-select-video' ] ) ) {
            update_post_meta( $post_id, 'meta-select-video', $_POST[ 'meta-select-video' ] );
        }

    }

}

new WP_Video_PostType_Custom_Meta_Box();