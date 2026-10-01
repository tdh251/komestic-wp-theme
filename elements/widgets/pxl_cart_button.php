<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_cart_button',
        'title' => esc_html__('Case Cart Button', 'komestic' ),
        'icon' => 'eicon-sort-amount-desc',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'tab_primary_content',
                    'label' => esc_html__('Account Button', 'komestic' ),
                    'tab' => 'content',
                    'controls' => array( 
                        array(
                            'name' => 'action',
                            'label' => esc_html__('Action', 'komestic' ),
                            'type' => 'select',
                            'options' => [
                                'link' => esc_html__('Link', 'komestic'),
                                'drawer' => esc_html__('Drawer', 'komestic'),
                            ],
                            'default' => 'drawer',
                        ),
                        array(
                            'name' => 'link',
                            'label' => esc_html__('Link after Logged in', 'komestic' ),
                            'type' => 'url',
                            'default' => [
                                'url' => home_url('/cart'),
                            ],
                            'condition' => [
                                'action' => 'link',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_general_style',
                    'label' => esc_html__('General', 'komestic'),
                    'tab'   => 'style',
                    'controls' => [
                        array(
                            'name' => 'icon_spacing',
                            'label' => esc_html__('Icon Spacing', 'komestic' ),
                            'type' => 'slider',
                            'control_type' => 'responsive',
                            'size_units' => ['px', 'custom'],
                            'range' => [
                                'px' => [
                                    'max' => 1000,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .cart-button-wrap .cart-button' => 'gap: {{SIZE}}{{UNIT}};',
                            ],
                        ),

                        array(
                            'name' => 'label_spacing',
                            'label' => esc_html__('Label Spacing', 'komestic' ),
                            'type' => 'slider',
                            'control_type' => 'responsive',
                            'size_units' => ['px', 'custom'],
                            'range' => [
                                'px' => [
                                    'max' => 1000,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .cart-button-wrap .cart-button .label' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                            ],
                        ),

                    ],
                ),
                array(
                    'name' => 'tab_style_icon',
                    'label' => esc_html__('Icon', 'komestic'),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'icon_size',
                            'label' => esc_html__('Icon Size', 'komestic'),
                            'type' => 'slider',
                            'control_type' => 'responsive' ,
                            'size_units' => ['px', 'custom'],
                            'px' => [
                                'min' => 0,
                                'max' => 2000
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .cart-button-wrap svg' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
                            ],
                        ), 
                        array(
                            'name' => 'icon_color',
                            'label' => esc_html__('Icon Color', 'komestic' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .cart-button-wrap svg' => 'color: {{VALUE}};',
                            ],
                        ),
                    ),
                ),  
                array(
                    'name' => 'tab_label_style',
                    'label' => esc_html__('Label', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'label_color',
                            'label' => esc_html__('Text Color', 'komestic' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .cart-button-wrap .cart-button .label' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'label_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .cart-button-wrap .cart-button .label',
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_price_style',
                    'label' => esc_html__('Price', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'subtotal_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .cart-button-wrap .cart-button .subtotal',
                        ),
                        array(
                            'name' => 'subtotal_controls',
                            'control_type' => 'tab',
                            'tabs' => [
                                [
                                    'name' => 'subtotal_normal',
                                    'label' => esc_html__('Normal', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [  
                                        array(
                                            'name' => 'subtotal_color',
                                            'label' => esc_html__('Text Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .cart-button-wrap .cart-button .subtotal' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                    ],
                                ],
                                [
                                    'name' => 'subtotal_hover',
                                    'label' => esc_html__('Hover', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [
                                        array(
                                            'name' => 'subtotal_hover_color',
                                            'label' => esc_html__('Text Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .cart-button-wrap .cart-button:hover .subtotal' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                    ],
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_status_style',
                    'label' => esc_html__('Count', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'status_box_size',
                            'label' => esc_html__('Box Size', 'komestic'),
                            'type' => 'slider',
                            'control_type' => 'responsive' ,
                            'size_units' => ['px', 'custom'],
                            'px' => [
                                'min' => 0,
                                'max' => 2000
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .cart-button-wrap .icon .status' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; min-width: {{SIZE}}{{UNIT}};',
                            ],
                        ), 
                        array(
                            'name' => 'status_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .cart-button-wrap .icon .status',
                        ),
                        array(
                            'name' => 'status_color',
                            'label' => esc_html__('Text Color', 'komestic' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .cart-button-wrap .icon .status' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'status_background',
                            'type' => \Elementor\Group_Control_Background::get_type(),
                            'control_type' => 'group',
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .cart-button-wrap .icon .status',
                        ),
                        array(
                            'name' => 'status_border',
                            'type' => \Elementor\Group_Control_Border::get_type(),
                            'separator' => 'before',
                            'control_type' => 'group', 
                            'selector' => '{{WRAPPER}} .cart-button-wrap .icon .status',
                        ),
                        array(
                            'name'         => 'status_box_shadow',
                            'label' => esc_html__( 'Box Shadow', 'komestic' ),
                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                            'control_type' => 'group',
                            'selector'     => '{{WRAPPER}} .cart-button-wrap .icon .status',
                        ),
                        array(
                            'name' => 'status_border_radius',
                            'label' => esc_html__('Border Radius', 'komestic' ),
                            'type' => 'dimensions',
                            'size_units' => [ 'px', 'custom' ],
                            'control_type' => 'responsive',
                            'selectors' => [
                                '{{WRAPPER}} .cart-button-wrap .icon .status' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'status_padding',
                            'label' => esc_html__('Padding', 'komestic' ),
                            'type' => 'dimensions',
                            'size_units' => [ 'px', 'custom' ],
                            'control_type' => 'responsive',
                            'separator' => 'before',
                            'selectors' => [
                                '{{WRAPPER}} .cart-button-wrap .icon .status' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                    ),
                ),
            ),
        ),
    ),
    komestic_get_class_widget_path()
);