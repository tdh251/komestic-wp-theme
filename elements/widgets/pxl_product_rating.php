<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_product_rating',
        'title' => esc_html__('Case Product Rating', 'komestic' ),
        'icon' => 'eicon-product-rating',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
            ),
        ),
    ),
    komestic_get_class_widget_path()
);