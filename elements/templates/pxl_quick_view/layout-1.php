<?php
$product_id_demo = 0;
if ( isset($_GET['action']) && $_GET['action'] === 'elementor' ) {
    $product_ids = get_all_products_id_name();
    $keys = array_keys($product_ids);
    $product_id_demo = isset($keys[2]) ? $keys[2] : 0;
}
?>

<div id="pxl-quick-view" class="product-quick-view">
    <?php pxl_print_html(komestic_render_product_quick_view_html($product_id_demo)); ?>
</div>