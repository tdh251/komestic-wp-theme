<?php
global $product; 
if(!$product) return;
$title_tag = $widget->get_setting('title_tag', 'h4');
?>
<<?php echo esc_attr($title_tag); ?> class="product-title">
    <?php echo esc_html($product->get_name());  ?>
</<?php echo esc_attr($title_tag); ?>>
