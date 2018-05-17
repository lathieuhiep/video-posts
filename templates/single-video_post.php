<?php
/*
 * Template Single Video Post
 * */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();

?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php
        while ( have_posts() ) : the_post();

        $video_post_meta_select_type_video  =   get_post_meta( get_the_ID(), 'meta-select-video-post', true );
        $video_post_meta_url_video          =   get_post_meta( get_the_ID(), 'meta-video-post-url', true );

        ?>

            <div id="video-post-<?php the_ID() ?>" <?php post_class(); ?>>
                <?php the_title( '<h1 class="video-post__title entry-title">', '</h1>' ); ?>

                <div class="video-post__item">
                    <?php echo wp_oembed_get( $video_post_meta_url_video ); ?>
                </div>

                <div class="video-post__content">
                    <?php

                    the_content();

                    wp_link_pages( array(
                        'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'video-post' ) . '</span>',
                        'after'       => '</div>',
                        'link_before' => '<span>',
                        'link_after'  => '</span>',
                        'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'video-post' ) . ' </span>%',
                        'separator'   => '<span class="screen-reader-text">, </span>',
                    ) );

                    ?>
                </div><!-- .entry-content -->
            </div>

        <?php endwhile; ?>

    </main>
</div>

<?php
get_footer();