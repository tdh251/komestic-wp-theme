<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_product_stock',
        'title' => esc_html__('Case Product Stock', 'komestic' ),
        'icon' => 'eicon-product-stock',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
            ),
        ),
    ),
    komestic_get_class_widget_path()
);