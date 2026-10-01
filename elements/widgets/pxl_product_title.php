<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_product_title',
        'title' => esc_html__('Case Product Title', 'komestic' ),
        'icon' => 'eicon-product-title',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'tab_primary_content',
                    'label' => esc_html__('Title', 'komestic' ),
                    'tab' => 'content',
                    'controls' => array(
                        array(
                            'name' => 'title_tag',
                            'label' => esc_html__('Title HTML Tag', 'komestic' ),
                            'type' => 'select',
                            'options' => [
                                'h1' => 'H1',
                                'h2' => 'H2',
                                'h3' => 'H3',
                                'h4' => 'H4',
                                'h5' => 'H5',
                                'h6' => 'H6',
                                'div' => 'div',
                                'p' => 'p',
                                'span' => 'span',
                            ],
                            'default' => 'h4',
                        ),
                        array(
                            'name' => 'text_align',
                            'label' => esc_html__('Alignment', 'komestic' ),
                            'type' => 'choose',
                            'control_type' => 'responsive',
                            'separator' => 'before',
                            'options' => [
                                'left' =>  [
                                    'title' => esc_html__('Left', 'komestic'),
                                    'icon' => 'eicon-text-align-left',
                                ],
                                'center' =>  [
                                    'title' => esc_html__('Center', 'komestic'),
                                    'icon' => 'eicon-text-align-center',
                                ],
                                'right' =>  [
                                    'title' => esc_html__('Right', 'komestic'),
                                    'icon' => 'eicon-text-align-right',
                                ],
                                'justify' =>  [
                                    'title' => esc_html__('Justify', 'komestic'),
                                    'icon' => 'eicon-text-align-justify',
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .product-title' => 'text-align: {{VALUE}};',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_title_style',
                    'label' => esc_html__('Title', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'title_color',
                            'label' => esc_html__('Text Color', 'komestic' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .product-title' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'title_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .product-title',
                        ),
                    ),
                    
                ),
            ),
        ),
    ),
    komestic_get_class_widget_path()
);