<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_product_share',
        'title' => esc_html__('Case Product Share', 'komestic' ),
        'icon' => 'eicon-share',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'tab_primary_content',
                    'label' => esc_html__( 'Product Share', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array(
                            array(
                            'name'    => 'facebook',
                            'label'   => esc_html__('Facebook', 'komestic'),
                            'type'    => 'switcher',
                            'default' => 'true',
                        ),
                        array(
                            'name'    => 'twitter',
                            'label'   => esc_html__('Twitter / X', 'komestic'),
                            'type'    => 'switcher',
                            'default' => 'true',
                        ),
                        array(
                            'name'    => 'pinterest',
                            'label'   => esc_html__('Pinterest', 'komestic'),
                            'type'    => 'switcher',
                            'default' => '',
                        ),
                        array(
                            'name'    => 'linkedin',
                            'label'   => esc_html__('LinkedIn', 'komestic'),
                            'type'    => 'switcher',
                            'default' => '',
                        ),
                        array(
                            'name'    => 'whatsapp',
                            'label'   => esc_html__('WhatsApp', 'komestic'),
                            'type'    => 'switcher',
                            'default' => '',
                        ),
                        array(
                            'name'    => 'telegram',
                            'label'   => esc_html__('Telegram', 'komestic'),
                            'type'    => 'switcher',
                            'default' => '',
                        ),
                        array(
                            'name'    => 'instagram',
                            'label'   => esc_html__('Instagram', 'komestic'),
                            'type'    => 'switcher',
                            'default' => 'true',
                        ),
                        array(
                            'name' => 'instagram_link',
                            'label' => esc_html__('Instagram Link', 'komestic' ),
                            'type' => 'url',
                            'default' => [
                                'url' => 'https://www.instagram.com/',
                            ],
                            'condition' => [
                                'instagram!' => '', 
                            ]
                        ),
                        array(
                            'name'    => 'youtube',
                            'label'   => esc_html__('YouTube', 'komestic'),
                            'type'    => 'switcher',
                            'default' => 'true',
                        ),
                        array(
                            'name' => 'youtube_link',
                            'label' => esc_html__('Youtube Link', 'komestic' ),
                            'type' => 'url',
                            'default' => [
                                'url' => 'https://www.youtube.com/',
                            ],
                            'condition' => [
                                'youtube!' => '', 
                            ]
                        ),
                        array(
                            'name'    => 'tiktok',
                            'label'   => esc_html__('TikTok', 'komestic'),
                            'type'    => 'switcher',
                            'default' => 'true',
                        ),
                        array(
                            'name' => 'tiktok_link',
                            'label' => esc_html__('TikTok Link', 'komestic' ),
                            'type' => 'url',
                            'default' => [
                                'url' => 'https://www.tiktok.com/',
                            ],
                            'condition' => [
                                'tiktok!' => '', 
                            ]
                        ),
                        array(
                            'name'    => 'snapchat',
                            'label'   => esc_html__('Snapchat', 'komestic'),
                            'type'    => 'switcher',
                            'default' => '',
                        ),
                        array(
                            'name' => 'snapchat_link',
                            'label' => esc_html__('Snapchat Link', 'komestic' ),
                            'type' => 'url',
                            'default' => [
                                'url' => 'https://www.snapchat.com/',
                            ],
                            'condition' => [
                                'snapchat!' => '', 
                            ]
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_icon_style',
                    'label' => esc_html__('Icon', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'icon_box_size',
                            'label' => esc_html__('Box Size', 'komestic'),
                            'type' => 'slider',
                            'control_type' => 'responsive',
                            'size_units' => ['px', 'custom'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .product-share .pxl-button' => '--pxl-box-size: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'icon_controls',
                            'control_type' => 'tab',
                            'tabs' => [
                                [
                                    'name' => 'icon_normal',
                                    'label' => esc_html__('Normal', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [  
                                        array(
                                            'name' => 'icon_color',
                                            'label' => esc_html__('Icon Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .product-share .pxl-button' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'icon_bacground',
                                            'type' => \Elementor\Group_Control_Background::get_type(),
                                            'control_type' => 'group',
                                            'types' => [ 'classic', 'gradient' ],
                                            'selector' => '{{WRAPPER}} .product-share .pxl-button',
                                        ),
                                        array(
                                            'name' => 'icon_border',
                                            'type' => \Elementor\Group_Control_Border::get_type(),
                                            'separator' => 'before',
                                            'control_type' => 'group', 
                                            'selector' => '{{WRAPPER}} .product-share .pxl-button',
                                        ),
                                        array(
                                            'name'         => 'icon_box_shadow',
                                            'label' => esc_html__( 'Box Shadow', 'komestic' ),
                                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                            'control_type' => 'group',
                                            'selector'     => '{{WRAPPER}} .product-share .pxl-button',
                                        ),
                                        array(
                                            'name' => 'icon_border_radius',
                                            'label' => esc_html__('Border Radius', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', 'custom' ],
                                            'control_type' => 'responsive',
                                            'selectors' => [
                                                '{{WRAPPER}} .product-share .pxl-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'icon_padding',
                                            'label' => esc_html__('Padding', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', 'custom' ],
                                            'control_type' => 'responsive',
                                            'separator' => 'before',
                                            'selectors' => [
                                                '{{WRAPPER}} .product-share .pxl-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                    ],
                                ],
                                [
                                    'name' => 'icon_hover',
                                    'label' => esc_html__('Hover', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [
                                        array(
                                            'name' => 'icon_color_hover',
                                            'label' => esc_html__('Icon Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .product-share .pxl-button:hover' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'icon_hover_background',
                                            'label' => esc_html__('Background Color', 'komestic' ),
                                            'type' => \Elementor\Group_Control_Background::get_type(),
                                            'control_type' => 'group',
                                            'types' => [ 'classic', 'gradient' ],
                                            'selector' => '{{WRAPPER}} .product-share .pxl-button:hover',
                                        ),
                                        array(
                                            'name' => 'icon_hover_border',
                                            'type' => \Elementor\Group_Control_Border::get_type(),
                                            'separator' => 'before',
                                            'control_type' => 'group', 
                                            'selector' => '{{WRAPPER}} .product-share .pxl-button:hover',
                                        ),
                                        array(
                                            'name'         => 'icon_hover_box_shadow',
                                            'label' => esc_html__( 'Box Shadow', 'komestic' ),
                                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                            'control_type' => 'group',
                                            'selector'     => '{{WRAPPER}} .product-share .pxl-button:hover',
                                        ),
                                        array(
                                            'name' => 'icon_hover_border_radius',
                                            'label' => esc_html__('Border Radius', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', 'custom' ],
                                            'control_type' => 'responsive',
                                            'selectors' => [
                                                '{{WRAPPER}} .product-share .pxl-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'icon_hover_padding',
                                            'label' => esc_html__('Padding', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', 'custom' ],
                                            'control_type' => 'responsive',
                                            'separator' => 'before',
                                            'selectors' => [
                                                '{{WRAPPER}} .product-share .pxl-button:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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