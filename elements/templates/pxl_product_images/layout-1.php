<?php
    global $product;

    if ( !$product ) {
        return;
    }
    $style = $widget->get_setting('style', '');
?>
<div class="product-images <?php echo esc_attr($style); ?>">
    <?php  woocommerce_show_product_images();  ?>
</div>