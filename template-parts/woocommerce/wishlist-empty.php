
<?php
$template_id = komestic()->get_theme_opt('wishlist_empty_template_id', '');
if(!empty($template_id)) :
    echo Elementor\Plugin::$instance->frontend->get_builder_content_for_display((int)$template_id);
else : ?>
<div class="wishlist-empty">
    <div class="whishlist-empty__inner">
        <h5 class="wishlist-empty__title">
            <?php echo esc_html__('No product were added to the wishlist.', 'komestic'); ?>
        </h5>
    </div>
</div>
<?php endif;