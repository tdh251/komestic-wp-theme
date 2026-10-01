<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_product_price',
        'title' => esc_html__('Case Product Price', 'komestic' ),
        'icon' => 'eicon-product-price',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
            ),
        ),
    ),
    komestic_get_class_widget_path()
);