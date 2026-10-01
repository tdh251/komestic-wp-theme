<?php 
$show_category = (bool)$widget->get_setting('show_category', '1');
$show_availability = (bool)$widget->get_setting('show_availability', '1');
$show_brand = (bool)$widget->get_setting('show_brand', '1');
$show_price_slider = (bool)$widget->get_setting('show_price_slider', '1');
$pa_attrs = $widget->get_setting('pa_attrs', []);

wc_get_template( 'filter.php', [
    'show_category' => $show_category,
    'show_availability' => $show_availability,
    'show_brand' => $show_brand,
    'show_price_slider' => $show_price_slider,
    'pa_attrs' => $pa_attrs
]);
?>



