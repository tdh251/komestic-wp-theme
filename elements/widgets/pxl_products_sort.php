<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_products_sort',
        'title' => esc_html__('Case Products Sort', 'komestic' ),
        'icon' => 'eicon-sort-amount-desc',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
            ),
        ),
    ),
    komestic_get_class_widget_path()
);