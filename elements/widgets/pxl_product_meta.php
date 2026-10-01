<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_product_meta',
        'title' => esc_html__('Case Product Meta', 'komestic' ),
        'icon' => 'eicon-product-meta',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
            ),
        ),
    ),
    komestic_get_class_widget_path()
);