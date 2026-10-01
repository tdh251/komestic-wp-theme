<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_text_marquee',
        'title' => esc_html__('Case Text Marquee', 'komestic' ),
        'icon' => 'eicon-wordart',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'tab_primary_content',
                    'label' => esc_html__('Text Marquee', 'komestic' ),
                    'tab' => 'content',
                    'controls' => array(   
                        array(
                            'name' => 'items',
                            'label' => esc_html__('Texts', 'komestic' ),
                            'type' => 'repeater',
                            'controls' => array(
                                array(
                                    'name' => 'text',
                                    'label' => esc_html__('Text', 'komestic' ),
                                    'type' => 'textarea',
                                    'rows' => 10,
                                ),
                                array( 
                                    'name' => 'link_url',
                                    'label' => esc_html__('Link URL', 'komestic' ),
                                    'type' => 'url',
                                ),
                                array(
                                    'name' => 'show_underline',
                                    'label' => esc_html__('Show Underline', 'komestic' ),
                                    'type' => 'switcher',
                                    'separator' => 'before',
                                    'default' => '',
                                ),
                            ),
                            'title_field' => '{{{ text }}}',
                            'default' => [
                                [
                                    'text' =>  esc_html__('Limited Time Offer: 20% Off Sitewide!', 'komestic'),
                                ],
                                [
                                    'text' =>  esc_html__('Hurry! Flash Sale Ending Soon!', 'komestic'),
                                ],
                                [
                                    'text' =>  esc_html__('FREE SHIPPING ON ORDERS OVER $200', 'komestic'),
                                ],
                            ],
                        ),
                        array(
                            'name' => 'separator_icon',
                            'label' => esc_html__('Separator', 'komestic'),
                            'type' => 'icons',
                            'separator' => 'before',
                            'fa4compatibility' => 'icon',
                        ),
                        array(
                            'name' => 'direction',
                            'label' => esc_html__('Direction', 'komestic'),
                            'type' => 'select',
                            'options' => [
                                'rtl' => esc_html__('Right to Left', 'komestic'),
                                'ltr' => esc_html__('Left to Right', 'komestic'),
                            ],
                            'default' => 'rtl',
                        ),
                        array(
                            'name' => 'duration',
                            'label' => esc_html__('Duration(s)', 'komestic'),
                            'type' => 'number',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-text-marquee .text-marquee-item' => '--pxl-duration: {{VALUE}}s;',
                            ],
                        ),
                        array(
                            'name' => 'gap',
                            'label' => esc_html__('Gap', 'komestic'),
                            'type' => 'slider',
                            'size_units' => ['px', '%'],
                            'control_type' => 'responsive',
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-text-marquee' => '--pxl-spacing: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                    ),
                ),

                array(
                    'name' => 'tab_text_style',
                    'label' => esc_html__('Text', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array_merge(
                        array(
                            array(
                                'name' => 'text_color',
                                'label' => esc_html__('Text Color', 'komestic' ),
                                'type' => 'color',
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-text-marquee .text-marquee-item' => 'color: {{VALUE}};',
                                ],
                            ),
                            
                            array(
                                'name' => 'text_typography',
                                'type' => \Elementor\Group_Control_Typography::get_type(),
                                'control_type' => 'group',
                                'selector' => '{{WRAPPER}} .pxl-text-marquee .text-marquee-item',
                            ),
                            array(
                                'name' => 'text_stroke',
                                'type' => \Elementor\Group_Control_Text_Stroke::get_type(),
                                'control_type' => 'group',
                                'selector' => '{{WRAPPER}} .pxl-text-marquee .text-marquee-item',
                            ),
                            array(
                                'name' => 'text_divider',
                                'type' => 'divider',
                            ),
                            array(
                                'name' => 'text_controls',
                                'control_type' => 'tab',
                                'tabs' => [
                                    [
                                        'name' => 'text_hightlight',
                                        'label' => esc_html__('Text Highlight', 'komestic' ),
                                        'type' => 'tab',
                                        'controls' => [
                                            array(
                                                'name' => 'text_highlight_color',
                                                'label' => esc_html__('Text Color', 'komestic' ),
                                                'type' => 'color',
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-text-marquee .text-marquee-item .pxl-text-highlight' => 'color: {{VALUE}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'text_highlight_typography',
                                                'type' => \Elementor\Group_Control_Typography::get_type(),
                                                'control_type' => 'group',
                                                'selector' => '{{WRAPPER}} .pxl-text-marquee .text-marquee-item .pxl-text-highlight',
                                            ),
                                            array(
                                                'name' => 'text_highlight_stroke',
                                                'type' => \Elementor\Group_Control_Text_Stroke::get_type(),
                                                'control_type' => 'group',
                                                'selector' => '{{WRAPPER}} .pxl-text-marquee .text-marquee-item .pxl-text-highlight',
                                            ),
                                        ],
                                    ],
                                    [
                                        'name' => 'text_media_highlight',
                                        'label' => esc_html__('Media Highlight', 'komestic' ),
                                        'type' => 'tab',
                                        'controls' => array_merge(
                                            komestic_size_options([
                                                'prefix' => 'text_image',
                                                'selectors' => '{{WRAPPER}} .pxl-heading .pxl-image-highlight img',
                                                'type' => 'basic',
                                                'label' => esc_html__('Image Sizes', 'komestic'),
                                            ]),
                                            array(
                                                array(
                                                    'name' => 'text_svg_color',
                                                    'label' => esc_html__('SVG Color', 'komestic' ),
                                                    'type' => 'color',
                                                    'separator' => 'before',
                                                    'selectors' => [
                                                        '{{WRAPPER}} .pxl-text-marquee .text-marquee-item .pxl-svg-highlight' => 'color: {{VALUE}};',
                                                    ],
                                                ),
                                                array(
                                                    'name' => 'text_svg_size',
                                                    'label' => esc_html__('SVG Size', 'komestic'),
                                                    'type' => 'slider',
                                                    'size_units' => ['px', 'custom'],
                                                    'range' => [
                                                        'px' => [
                                                            'min' => 0,
                                                        ],
                                                    ],
                                                    'selectors' => [
                                                        '{{WRAPPER}} .pxl-text-marquee .text-marquee-item .pxl-svg-highlight svg' => 'width: {{SIZE}}{{UNIT}}; height: auto;'
                                                    ],
                                                ),
                                            )
                                        ),
                                    ],
                                ],
                            ),
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_link_style',
                    'label' => esc_html__( 'Link', 'komestic' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'link_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'selector' => '{{WRAPPER}} .pxl-text-marquee a',
                            'control_type' => 'group',
                        ),
                        array(
                            'name' => 'link_controls',
                            'control_type' => 'tab',
                            'tabs' => [
                                [
                                    'name' => 'link_normal',
                                    'label' => esc_html__('Normal', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [  
                                        array(
                                            'name' => 'link_color',
                                            'label' => esc_html__( 'Color', 'komestic' ),
                                            'type' => \Elementor\Controls_Manager::COLOR,
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-text-marquee a' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'link_highlight_stroke',
                                            'type' => \Elementor\Group_Control_Text_Stroke::get_type(),
                                            'control_type' => 'group',
                                            'selector' => '{{WRAPPER}} .pxl-text-marquee .pxl-text-highlight',
                                        ),
                                        array(
                                            'name' => 'link_highlight_shadow',
                                            'type' => \Elementor\Group_Control_Text_Shadow::get_type(),
                                            'control_type' => 'group',
                                            'selector' => '{{WRAPPER}} .pxl-text-marquee .pxl-text-highlight',
                                        ),
                                    ],
                                ],
                                [
                                    'name' => 'link_hover',
                                    'label' => esc_html__('Hover', 'komestic' ),
                                    'type' => \Elementor\Controls_Manager::TAB,
                                    'controls' => [
                                        array(
                                            'name' => 'link_hover_style',
                                            'label' => esc_html__( 'Style', 'komestic' ),
                                            'type' => 'select',
                                            'options' => [
                                                'link-hover-default' => 'Default',
                                                'link-hover-underline-slide' => 'Underline Slide'
                                            ],
                                            'default' => 'link-hover-default',
                                            'condition' => [
                                                'link_style!' => 'link-underline',
                                            ],
                                        ),
                                        array(
                                            'name' => 'link_color_hover',
                                            'label' => esc_html__( 'Color Hover', 'komestic' ),
                                            'type' => \Elementor\Controls_Manager::COLOR,
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-text-marquee a:hover' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'link_highlight_stroke_hover',
                                            'type' => \Elementor\Group_Control_Text_Stroke::get_type(),
                                            'control_type' => 'group',
                                            'selector' => '{{WRAPPER}} .pxl-text-marquee a:hover',
                                        ),
                                        array(
                                            'name' => 'link_highlight_shadow_hover',
                                            'type' => \Elementor\Group_Control_Text_Shadow::get_type(),
                                            'control_type' => 'group',
                                            'selector' => '{{WRAPPER}} .pxl-text-marquee a:hover',
                                        ),
                                    ],
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_style_separator',
                    'label' => esc_html__('Separator', 'komestic'),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'separator_size',
                            'label' => esc_html__('Icon Size', 'komestic'),
                            'type' => 'slider',
                            'control_type' => 'responsive' ,
                            'size_units' => ['px', 'custom'],
                            'px' => [
                                'min' => 0,
                                'max' => 2000
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-text-marquee .separator svg' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
                                '{{WRAPPER}} .pxl-text-marquee .separator ' => 'font-size: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'separator_color',
                            'label' => esc_html__('Icon Color', 'komestic' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-text-marquee .separator' => 'color: {{VALUE}};',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'pxl_motion_effects',
                    'tab' => 'style',
                    'label' => esc_html__('Motion Effects', 'komestic'),
                    'controls' => komestic_get_animation_options([
                        'selectors' => '{{WRAPPER}} .pxl-text-marquee',
                    ]),
                ),

                elementor_tab_advanced_custom(),
            ),
        ),
    ),
    komestic_get_class_widget_path()
);