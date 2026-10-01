<?php
/**
 * @package Case-Themes
 */
get_header();
?>
<div class="container">
    <div class="main-content__inner">
        <?php while ( have_posts() ) {
            the_post();
            get_template_part( 'template-parts/content/content', 'page' );
            if ( comments_open() || get_comments_number() ) {
                comments_template();
            }
        } ?>
    </div>
</div>
<?php get_footer(); ?>