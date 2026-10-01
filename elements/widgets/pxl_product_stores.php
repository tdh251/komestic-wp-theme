<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_product_stores',
        'title' => esc_html__('Case Product Stores', 'komestic' ),
        'icon' => 'eicon-lightbox-expand',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
            ),
        ),
    ),
    komestic_get_class_widget_path()
);