<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_navigation_my_account',
        'title' => esc_html__('Case Navigation My Account', 'komestic' ),
        'icon' => 'eicon-product-price',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'tab_primary_content',
                    'label' => esc_html__('Source', 'komestic' ),
                    'tab' => 'content',
                    'controls' => array(

                    ),
                ),
            ),
        ),
    ),
    komestic_get_class_widget_path()
);
