<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_products_bought_together',
        'title' => esc_html__('Case Product Bought Together', 'komestic' ),
        'icon' => 'eicon-product-stock',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
            ),
        ),
    ),
    komestic_get_class_widget_path()
);