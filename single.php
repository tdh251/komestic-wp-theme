<?php
/**
 * @package Case-Themes
 */
get_header();
$sidebar = komestic()->get_sidebar_value('post'); 
?>
<div class="container">
    <div class="main-content__inner <?php echo esc_attr('main-content__inner--'.$sidebar['sidebar_class']); ?>">
        <article class="blog-article">
            <?php while ( have_posts() ) {
                the_post();
                get_template_part( 'template-parts/content/content-single', get_post_format() );
                if ( comments_open() || get_comments_number() ) {
                    comments_template();
                }
            } ?>
        </article>
        <?php if($sidebar['is_sidebar']) : ?>
            <aside id="sidebar" class="sidebar">
                <?php get_sidebar(); ?>
            </aside>
        <?php endif; ?>
    </div>
</div>
<?php get_footer();


