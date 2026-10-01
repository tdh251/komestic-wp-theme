<?php
$img_dimension = $widget->get_setting('img_dimension', 'custom');
if($img_dimension === 'custom') {
    $custom_img_dimension = $widget->get_setting('custom_img_dimension', []);
    $img_dimension = (!empty($custom_img_dimension['width']) && !empty($custom_img_dimension['height'])) ? $custom_img_dimension : ['width' => 767, 'height' => 767];
}
?>
<div class="pxl-products-compare"> 
    <?php pxl_print_html(komestic_render_compare_table_html()); ?>
</div>