<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_product_checkout',
        'title' => esc_html__('Case Product Checkout', 'komestic' ),
        'icon' => 'eicon-checkout',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
            ),
        ),
    ),
    komestic_get_class_widget_path()
);