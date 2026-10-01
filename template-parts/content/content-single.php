<?php
/**
 * Template part for displaying posts in loop
 *
 * @package Case-Themes
 */
$post_id = get_the_ID();
?>
<div id="pxl-post-<?php the_ID(); ?>" <?php post_class('blog-article__inner'); ?>>
    <div class="blog-article__content">
        <?php
            the_content();
            wp_link_pages( array(
                'before'      => '<div class="page-links">',
                'after'       => '</div>',
                'link_before' => '<span>',
                'link_after'  => '</span>',
            ) );
        ?>
    </div>
    <div class="blog-article__footer">
        <?php 
            komestic()->blog->get_tags();
            komestic()->blog->get_socials_share(); 
            komestic()->blog->get_post_navigation();
        ?>
    </div>
</div><!-- #post -->