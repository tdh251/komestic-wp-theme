<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_archive_product',
        'title' => esc_html__('Case Archive Products', 'komestic' ),
        'icon' => 'eicon-archive-products',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'tab_general_style',
                    'label' => esc_html__('Top Bar', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'btns_heading',
                            'type' => 'heading',
                            'label' => esc_html__('Buttons', 'komestic'),
                        ),
                        array(
                            'name' => 'btns_justify_content_h',
                            'label' => esc_html__('Justify Content', 'komestic'),
                            'type' => 'choose',
                            'control_type' => 'responsive',
                            'options' => array(
                                'start' => [
                                    'title' => esc_html__('Start', 'komestic' ),
                                    'icon' => 'eicon-justify-start-h',
                                ],
                                'center' => [
                                    'title' => esc_html__('Center', 'komestic' ),
                                    'icon' => 'eicon-justify-center-h',
                                ],
                                'end' => [
                                    'title' => esc_html__('End', 'komestic' ),
                                    'icon' => 'eicon-justify-end-h',
                                ],
                            ),
                            'selectors' => [
                                '{{WRAPPER}} .woocommerce-topbar .buttons' => 'justify-content: {{VALUE}};'
                            ],
                        ),
                        array(
                            'name' => 'btns_padding',
                            'label' => esc_html__('Padding', 'komestic' ),
                            'type' => 'dimensions',
                            'size_units' => [ 'px', 'custom' ],
                            'control_type' => 'responsive',
                            'selectors' => [
                                '{{WRAPPER}} .woocommerce-topbar .buttons' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_display_opts',
                    'label' => esc_html__('Display', 'komestic' ),
                    'tab' => 'settings',
                    'controls' => array_merge(
                        komestic_image_dimension_options(),
                        array(
                            array(
                                'name' => 'show_result_count',
                                'label' => esc_html__('Show Result Count', 'komestic' ),
                                'type' => 'switcher',
                                'default' => 'true',
                            ),
                            array(
                                'name' => 'show_btn_shop_filter',
                                'label' => esc_html__('Show Button Shop Filter', 'komestic' ),
                                'type' => 'switcher',
                                'default' => 'true',
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
                                '{{WRAPPER}} .woocommerce ul.products' => 'grid-template-columns: repeat({{VALUE}}, 1fr);'
                            ]
                        ),
                    ),
                ),
            ),
        ),
    ),
    komestic_get_class_widget_path()
);