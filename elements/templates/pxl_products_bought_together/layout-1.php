<?php
global $product; 
if(!$product || !class_exists('WPCleverWoobt')) return;
$title_tag = $widget->get_setting('title_tag', 'h5');
ob_start();
Komestic_Woobt::instance()->komestic_show_items($product->get_id(), true);
$result = trim(ob_get_clean());
if (trim(strip_tags($result)) === '') {
    return;
}
?>
<div class="product-bought-together">
    <<?php echo esc_html($title_tag); ?> class="woobt-heading"><?php echo esc_html__('Frequently Bought Together', 'komestic'); ?></<?php echo esc_html($title_tag); ?>>
    <?php
        pxl_print_html($result);
    ?>
</div>
