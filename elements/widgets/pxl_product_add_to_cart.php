<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_product_add_to_cart',
        'title' => esc_html__('Case Product Add To Cart', 'komestic' ),
        'icon' => 'eicon-product-add-to-cart',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
            ),
        ),
    ),
    komestic_get_class_widget_path()
);