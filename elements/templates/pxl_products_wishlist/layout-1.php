
<?php
if (!class_exists('WPCleverWoosw')) {
    return esc_html__('You need install WPC Smart Wishlist Plugin', 'komestic');
}
$wishlist_key = WPCleverWoosw::get_key();
$wishlist_product_ids = WPCleverWoosw::get_ids();
$post_ids = array_keys($wishlist_product_ids);

if (empty($post_ids)) {
    pxl_print_html(komestic_render_wishlist_empty_html());
    return;
}

$title_tag = $widget->get_setting('title_tag', 'h6');
$img_dimension = $widget->get_setting('img_dimension', 'custom');
if($img_dimension === 'custom') {
    $custom_img_dimension = $widget->get_setting('custom_img_dimension', []);
    $img_dimension = (!empty($custom_img_dimension['width']) && !empty($custom_img_dimension['height'])) ? $custom_img_dimension : 'full';
}
$entrance_anim = $widget->get_setting('entrance_anim', '');
$anim_delay = $widget->get_setting('anim_delay', 0);
?>

<div class="grid pxl-products">
    <div class="grid__inner woosw-items" data-key="<?php echo esc_attr($wishlist_key); ?>">
        <?php foreach($post_ids as $key => $post_id) : 
            global $product;
            $product = wc_get_product($post_id);
        ?>
            <div class="grid__item <?php echo esc_attr($entrance_anim); ?>" <?php if($anim_delay !== 0) : ?> data-wow-delay="<?php echo esc_attr(($key * $anim_delay).'ms') ?>" <?php endif; ?>>
                <div class="product woosw-item" data-id="<?php echo esc_attr($post_id); ?>">
                    <button class="pxl-button button--close-deactive woosw-item--remove">
                        <span class="button__icon">
                            <span class="icon-close"></span>
                        </span>
                    </button>
                    <?php 
                        wc_get_template(
                            'template-parts/woocommerce/content-product/default.php',
                            array(
                                'product'  => $product,
                                'img_dimension' => $img_dimension,
                            ),
                        );
                    ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>