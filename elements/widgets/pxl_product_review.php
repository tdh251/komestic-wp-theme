<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_product_review',
        'title' => esc_html__('Case Product Review', 'komestic' ),
        'icon' => 'eicon-review',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
            ),
        ),
    ),
    komestic_get_class_widget_path()
);