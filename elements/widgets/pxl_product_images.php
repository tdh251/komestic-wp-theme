<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_product_images',
        'title' => esc_html__('Case Product Images', 'komestic' ),
        'icon' => 'eicon-product-images',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'tab_primary_content',
                    'label' => esc_html__('Content', 'komestic' ),
                    'tab' => 'content',
                    'controls' => array_merge(
                        komestic_image_dimension_options(),
                            array(
                                array(
                                'name' => 'style',
                                'label' => esc_html__('Style', 'komestic' ),
                                'type' => 'select',
                                'options' => [
                                    ''                    => esc_html__('Default', 'komestic' ),
                                    'style-1'  => esc_html__('Style 1', 'komestic' ),
                                ],
                                'default' => '',
                            ),
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_grid_add_opts',
                    'label' => esc_html__('Additional Options', 'komestic' ),
                    'tab' => 'settings',
                    'controls' => array(
                        array(
                            'name' => 'columns',
                            'label' => esc_html__('Columns', 'komestic' ),
                            'type' => 'select',
                            'control_type' => 'responsive',
                            'default' => '',
                            'options' => [
                                '1' => '1',
                                '2' => '2',
                                '3' => '3',
                                '4' => '4',
                                '5' => '5',
                                '6' => '6',
                            ],
                            'default' => '3',
                            'selectors' => [
                                '.single-product div.product .summary {{WRAPPER}} div.woocommerce-product-gallery .flex-control-nav' => 'grid-template-columns: repeat({{VALUE}}, 1fr);'
                            ]
                        ),
                    ),
                ),
            ),
        ),
    ),
    komestic_get_class_widget_path()
);