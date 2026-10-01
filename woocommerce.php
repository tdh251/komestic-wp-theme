<?php 
get_header();
$sidebar = komestic()->get_sidebar_value('shop'); 
?>
<div class="container">
    <div class="main-content__inner <?php echo esc_attr('main-content__inner--'.$sidebar['sidebar_class']); ?>">
        <div class="shop-archive">
            <?php woocommerce_content(); ?>
        </div>
        <?php if($sidebar['is_sidebar'] && is_shop()) : ?>
            <aside id="sidebar" class="sidebar">
                <?php get_sidebar(); ?>
            </aside>
        <?php endif; ?>
    </div>
</div>
<?php get_footer();

