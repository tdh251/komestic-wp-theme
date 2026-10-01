<?php
/**
 * @package Case-Themes
 */

get_header();
$sidebar = komestic()->get_sidebar_value('blog'); 
$pagination_html = komestic()->page->get_pagination();
?>
<div class="container">
    <div class="main-content__inner <?php echo esc_attr('main-content__inner--'.$sidebar['sidebar_class']); ?>">
        <div class="blog-archive">
            <div class="blog-archive__inner">
                <?php if ( have_posts() ) {
                    while ( have_posts() ) {
                        the_post();
                        get_template_part( 'template-parts/content/archive/standard' );
                    } ?>
                    <?php
                } else {
                    get_template_part( 'template-parts/content/content', 'none' );
                } ?>
            </div>
            <?php if(!is_null($pagination_html)) : ?>
                <div class="pagination pagination--grid">
                    <?php echo wp_kses_post($pagination_html); ?>
                </div>
            <?php endif; ?>
        </div>
        <?php if($sidebar['is_sidebar']) : ?>
            <aside id="sidebar" class="sidebar">
                <?php get_sidebar(); ?>
            </aside>
        <?php endif; ?>
    </div>
</div>
<?php get_footer();

