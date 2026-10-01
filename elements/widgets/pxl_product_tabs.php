<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_product_tabs',
        'title' => esc_html__('Case Product Tabs', 'komestic' ),
        'icon' => 'eicon-product-tabs',
        'categories' => array('pxltheme-core'),
        'scripts' => [
            'komestic-tabs',
        ],
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'tab_text_style',
                    'label' => esc_html__( 'Text', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'text_controls',
                            'control_type' => 'tab',
                            'tabs' => [
                                [
                                    'name' => 'text_normal',
                                    'label' => esc_html__('Normal', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [  
                                        array(
                                            'name' => 'text_color',
                                            'label' => esc_html__( 'Text Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .product-tabs .tab__content p' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'text_typography',
                                            'type' => \Elementor\Group_Control_Typography::get_type(),
                                            'control_type' => 'group',
                                            'separator' => 'before',
                                            'selector' => '{{WRAPPER}} .product-tabs .tab__content p',
                                        ),
                                        array(
                                            'name' => 'text_bold',
                                            'label' => esc_html__( 'Text Strong Weight', 'komestic' ),
                                            'type' => 'select',
                                            'options' => [
                                                '' => esc_html__('Default', 'komestic'),
                                                '100' => '100',
                                                '200' => '200',
                                                '300' => '300',
                                                '400' => '400',
                                                '500' => '500',
                                                '600' => '600',
                                                '700' => '700',
                                                '800' => '800',
                                                '900' => '900',
                                            ],
                                            'selectors' => [
                                                '{{WRAPPER}} .product-tabs .tab__content p strong' => 'font-weight: {{VALUE}};',
                                            ]
                                        ),
                                        array(
                                            'name' => 'text_bold_color',
                                            'label' => esc_html__( 'Text Strong Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .product-tabs .tab__content p strong' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                    ],
                                ],
                                [
                                    'name' => 'text_highlight',
                                    'label' => esc_html__('Highlight', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [
                                        array(
                                            'name' => 'text_highlight_color',
                                            'label' => esc_html__( 'Text Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .product-tabs .tab__content p .text--highlight' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'text_highlight_typography',
                                            'type' => \Elementor\Group_Control_Typography::get_type(),
                                            'control_type' => 'group',
                                            'selector' => '{{WRAPPER}} .product-tabs .tab__content p .text--highlight',
                                        ),
                                        array(
                                            'name' => 'hl_spacing_block',
                                            'label' => esc_html__('Spacing Block', 'komestic'),
                                            'type' => 'slider',
                                            'control_type' => 'responsive' ,
                                            'size_units' => ['px', 'custom'],
                                            'range' => [
                                                'px' => [
                                                    'max' => 100,
                                                ],
                                            ],
                                            'selectors' => [
                                                '{{WRAPPER}} .product-tabs .tab__content .pxl-spacing-block' => 'margin-block: {{SIZE}}{{UNIT}};',
                                            ],
                                        ), 
                                    ],
                                ],
                            ],
                        ),
                    ),
                ),
            ),
        ),
    ),
    komestic_get_class_widget_path()
);