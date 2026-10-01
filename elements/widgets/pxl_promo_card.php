<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_promo_card',
        'title' => esc_html__('Case Promo Card', 'komestic'),
        'icon' => 'eicon-menu-card',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'tab_primary_layout',
                    'label' => esc_html__('Layout', 'komestic'),
                    'tab' => 'layout',
                    'controls' => array(
                        array(
                            'name' => 'layout',
                            'label' => esc_html__('Layout', 'komestic'),
                            'type' => 'layoutcontrol',
                            'default' => '1',
                            'options' => array(
                                '1' => array(
                                    'label' => esc_html__('Default', 'komestic'),
                                    'image' => get_template_directory_uri() . '/elements/assets/imgs/promo-card-1.webp',
                                ),
                                '2' => array(
                                    'label' => esc_html__('Layout 2', 'komestic'),
                                    'image' => get_template_directory_uri() . '/elements/assets/imgs/promo-card-1.webp',
                                ),
                                '3' => array(
                                    'label' => esc_html__('Layout 3', 'komestic'),
                                    'image' => get_template_directory_uri() . '/elements/assets/imgs/promo-card-1.webp',
                                ),
                            ),
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_primary_content',
                    'label' => esc_html__('Promo Card', 'komestic' ),
                    'tab' => 'content',
                    'controls' => array_merge(
                        array(
                            array(
                                'name' => 'image',
                                'label' => esc_html__('Image', 'komestic'),
                                'type' => 'media',
                                'condition' => [
                                    'layout' => ['2', '3'],
                                ],
                            ),
                            array(
                                'name' => 'background_image',
                                'label' => esc_html__('Background Image', 'komestic'),
                                'type' => 'media',
                                'selectors' => [
                                    '{{WRAPPER}} .promo-card .promo-card__inner' => 'background-image: url({{URL}});'
                                ],
                                'condition' => [
                                    'layout' => ['1'],
                                ],
                            ),
                        ),
                        // komestic_size_options([
                        //     'prefix' => 'block',
                        //     'selectors' => '{{WRAPPER}} .promo-card .promo-card__inner',
                        //     'label' => 'Block Sizes',
                        // ]),
                        array(
                            array(
                                'name' => 'title',
                                'type' => 'textarea',
                                'label' => esc_html__('Title', 'komestic'),
                                'rows' => 5,
                                'separator' => 'before',
                                'default' => 'Case Title',
                            ),
                            array(
                                'name' => 'btn_text',
                                'type' => 'text',
                                'label' => esc_html__('Button Text', 'komestic'),
                                'separator' => 'before',
                                'condition' => [
                                    'layout' => ['1'],
                                ],
                            ),
                             array(
                                'name' => 'btn_link',
                                'type' => 'url',
                                'label' => esc_html__('Link URL', 'komestic'),
                                'default' => [
                                    'url' => '#',
                                ],
                            ),
                            array(
                                'name' => 'desc',
                                'type' => 'textarea',
                                'label' => esc_html__('Description', 'komestic'),
                                'separator' => 'before',
                                'condition' => [
                                    'layout' => ['2', '3'],
                                ],
                            ),
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_display_opts',
                    'label' => esc_html__('Display', 'komestic' ),
                    'tab' => 'settings',
                    'controls' => array_merge(
                        komestic_image_dimension_options([
                            'condition' => [
                                'layout' => ['2', '3'],
                            ],
                        ]),
                        array(
                            array(
                                'name' => 'title_tag',
                                'label' => esc_html__('Title HTML Tag', 'komestic'),
                                'type' => 'select',
                                'seperator' => 'before',
                                'options' => [
                                    ''   => esc_html__('Default', 'komestic'),
                                    'h1' => esc_html__('H1', 'komestic'),
                                    'h2' => esc_html__('H2', 'komestic'),
                                    'h3' => esc_html__('H3', 'komestic'),
                                    'h4' => esc_html__('H4', 'komestic'),
                                    'h5' => esc_html__('H5', 'komestic'),
                                    'h6' => esc_html__('H6', 'komestic'),
                                    'div' => esc_html__('div', 'komestic'),
                                    'p'  => esc_html__('p', 'komestic'),
                                    'span' => esc_html__('span', 'komestic'),
                                ],
                                'default' => '',
                            ),
                            array(
                                'name' => 'show_button',
                                'label' => esc_html__('Show Button', 'komestic' ),
                                'type' => 'switcher',
                                'default' => '',
                            ),
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_general_style',
                    'label' => esc_html__('General', 'komestic'),
                    'tab'   => 'style',
                    'controls' => [
                        array(
                            'name' => 'feature_spacing',
                            'label' => esc_html__('Featured Spacing', 'komestic' ),
                            'type' => 'slider',
                            'control_type' => 'responsive',
                            'size_units' => ['px', 'custom'],
                            'range' => [
                                'px' => [
                                    'max' => 1000,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .promo-card .promo-card__image' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'title_spacing',
                            'label' => esc_html__('Title Spacing', 'komestic' ),
                            'type' => 'slider',
                            'control_type' => 'responsive',
                            'size_units' => ['px', 'custom'],
                            'range' => [
                                'px' => [
                                    'max' => 1000,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .promo-card .promo-card__title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'button_spacing',
                            'label' => esc_html__('Button Spacing', 'komestic' ),
                            'type' => 'slider',
                            'control_type' => 'responsive',
                            'size_units' => ['px', 'custom'],
                            'range' => [
                                'px' => [
                                    'max' => 1000,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .promo-card .promo-card__button' => 'margin-top: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'desc_max_width',
                            'label' => esc_html__('Description Max Width', 'komestic' ),
                            'type' => 'slider',
                            'control_type' => 'responsive',
                            'size_units' => ['px', 'custom'],
                            'range' => [
                                'px' => [
                                    'max' => 1000,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .promo-card .promo-card__desc' => 'max-width: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                    ],
                ),
                array(
                    'name' => 'tab_block_style',
                    'label' => esc_html__('Block', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array_merge(
                        komestic_size_options([
                            'prefix' => 'block',
                            'selectors' => '{{WRAPPER}} .promo-card .promo-card__inner',
                            'label' => 'Block Size',
                        ]),
                        array(
                            array(
                                'name' => 'box_bg',
                                'type' => \Elementor\Group_Control_Background::get_type(),
                                'control_type' => 'group',
                                'types' => [ 'classic', 'gradient' ],
                                'selector' => '{{WRAPPER}} .promo-card .promo-card__inner',
                            ),
                            array(
                                'name' => 'box_border',
                                'type' => \Elementor\Group_Control_Border::get_type(),
                                'control_type' => 'group', 
                                'separator' => 'before',
                                'selector' => '{{WRAPPER}} .promo-card .promo-card__inner',
                            ),
                            array(
                                'name'         => 'box_box_shadow',
                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                'control_type' => 'group',
                                'selector'     => '{{WRAPPER}} .promo-card .promo-card__inner',
                            ),
                            array(
                                'name' => 'box_border_radius',
                                'label' => esc_html__('Border Radius', 'komestic' ),
                                'type' => 'dimensions',
                                'size_units' => [ 'px', '%', 'custom' ],
                                'selectors' => [
                                    '{{WRAPPER}} .promo-card .promo-card__inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                            ),
                            array(
                                'name' => 'box_paddding',
                                'label' => esc_html__('Padding', 'komestic' ),
                                'type' => 'dimensions',
                                'size_units' => [ 'px', '%', 'custom' ],
                                'selectors' => [
                                    '{{WRAPPER}} .promo-card .promo-card__inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                            ),
                        )
                    ),
                ),
                array(
                    'name' => 'tab_featured_style',
                    'label' => esc_html__('Featured', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array_merge(
                        komestic_size_options([
                            'prefix' => 'img',
                            'selectors' => '{{WRAPPER}} .promo-card .promo-card__image img',
                            'label' => 'Image Size',
                        ]),
                        array(
                            array(
                                'name' => 'featured_controls',
                                'control_type' => 'tab',
                                'tabs' => [
                                    [
                                        'name' => 'featured_normal',
                                        'label' => esc_html__('Normal', 'komestic' ),
                                        'type' => 'tab',
                                        'controls' => [  
                                            array(
                                                'name' => 'featured_opacity',
                                                'label' => esc_html__('Opacity', 'komestic' ),
                                                'type' => 'slider',
                                                'control_type' => 'responsive',
                                                'size_units' => ['px'],
                                                'range' => [
                                                    'px' => [
                                                        'min' => 0,
                                                        'max' => 1,
                                                        'step' => 0.01,
                                                    ],
                                                ],
                                                'selectors' => [
                                                    '{{WRAPPER}} .promo-card .promo-card__image' => 'opacity: {{SIZE}};',
                                                ],
                                            ),
                                            array(
                                                'name'     => 'featured_css_filters',
                                                'type'     => \Elementor\Group_Control_Css_Filter::get_type(),
                                                'control_type' => 'group',
                                                'selector' => '{{WRAPPER}} .promo-card .promo-card__image',
                                            ),
                                            array(
                                                'name' => 'featured_border',
                                                'type' => \Elementor\Group_Control_Border::get_type(),
                                                'control_type' => 'group', 
                                                'separator' => 'before',
                                                'selector' => '{{WRAPPER}} .promo-card .promo-card__image',
                                            ),
                                            array(
                                                'name'         => 'featured_box_shadow',
                                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                                'control_type' => 'group',
                                                'selector'     => '{{WRAPPER}} .promo-card .promo-card__image',
                                            ),
                                            array(
                                                'name' => 'featured_border_radius',
                                                'label' => esc_html__('Border Radius', 'komestic' ),
                                                'type' => 'dimensions',
                                                'size_units' => [ 'px', '%', 'custom' ],
                                                'control_type' => 'responsive',
                                                'selectors' => [
                                                    '{{WRAPPER}} .promo-card .promo-card__image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                                ],
                                            ),
                                        ],
                                    ],
                                    [
                                        'name' => 'featured_hover',
                                        'label' => esc_html__('Hover', 'komestic' ),
                                        'type' => 'tabs',
                                        'controls' => [
                                            array(
                                                'name' => 'featured_hover_style',
                                                'label' => esc_html__('Hover Style', 'komestic' ),
                                                'type' => 'select',
                                                'options' => [
                                                    ''                     => esc_html__('None', 'komestic'),
                                                    'image--default'  => esc_html__('Default', 'komestic'),
                                                    'image--parallax' => esc_html__('Parallax', 'komestic'),
                                                    'image--overlay-fade--x' => esc_html__('Overlay Fade X', 'komestic'),
                                                    'image--overlay-fade--y' => esc_html__('Overlay Fade Y', 'komestic'),
                                                    'image--flashing' => esc_html__('Flashing', 'komestic'),
                                                    'image--overlay-shine' => esc_html__('Shine', 'komestic'),
                                                    'image--distortion-transition' => esc_html__('Distortion Transition', 'komestic')
                                                ],
                                                'default' => 'image--default',
                                                'condition' => [
                                                    'layout!' => '1',
                                                ],
                                            ),
                                            array(
                                                'name' => 'img_displacement',
                                                'label' => esc_html__('Displacement', 'komestic' ),
                                                'type' => 'select',
                                                'options' => [
                                                    '1'                     => '1',
                                                    '2'                     => '2',
                                                    '3'                     => '3',
                                                    '4'                     => '4',
                                                    '5'                     => '5',
                                                ],
                                                'default' => '1',
                                                'condition' => [
                                                    'featured_hover_style' => 'image--distortion-transition',
                                                ],
                                            ),
                                            array(
                                                'name' => 'img_hover_scale',
                                                'label' => esc_html__('Scale', 'komestic' ),
                                                'type' => 'slider',
                                                'control_type' => 'responsive',
                                                'size_units' => ['px'],
                                                'range' => [
                                                    'px' => [
                                                        'min' => 0,
                                                        'max' => 2,
                                                        'step' => 0.05,
                                                    ],
                                                ],
                                                'selectors' => [
                                                    '{{WRAPPER}} .promo-card .promo-card__image' => '--pxl-scale: {{SIZE}};',
                                                ],
                                                'condition' => [
                                                    'featured_hover_style' => 'image--default',
                                                ],
                                            ),
                                            array(
                                                'name' => 'featured_hover_opacity',
                                                'label' => esc_html__('Opacity', 'komestic' ),
                                                'type' => 'slider',
                                                'control_type' => 'responsive',
                                                'size_units' => ['px'],
                                                'range' => [
                                                    'px' => [
                                                        'min' => 0,
                                                        'max' => 1,
                                                        'step' => 0.01,
                                                    ],
                                                ],
                                                'selectors' => [
                                                    '{{WRAPPER}} .product-suggested .product:hover .pxl-post-featured img' => 'opacity: {{SIZE}};',
                                                ],
                                            ),
                                            array(
                                                'name'     => 'featured_hover_css_filters',
                                                'type'     => \Elementor\Group_Control_Css_Filter::get_type(),
                                                'control_type' => 'group',
                                                'selector' => '{{WRAPPER}} .product-suggested .product:hover .pxl-post-featured img',
                                            ),
                                            array(
                                                'name' => 'featured_hover_border',
                                                'type' => \Elementor\Group_Control_Border::get_type(),
                                                'control_type' => 'group', 
                                                'separator' => 'before',
                                                'selector' => '{{WRAPPER}} .product-suggested .product:hover .pxl-post-featured',
                                            ),
                                            array(
                                                'name'         => 'featured_hover_box_shadow',
                                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                                'control_type' => 'group',
                                                'selector'     => '{{WRAPPER}} .product-suggested .product:hover .pxl-post-featured',
                                            ),
                                            array(
                                                'name' => 'featured_hover_border_radius',
                                                'label' => esc_html__('Border Radius', 'komestic' ),
                                                'type' => 'dimensions',
                                                'size_units' => [ 'px', '%', 'custom' ],
                                                'control_type' => 'responsive',
                                                'selectors' => [
                                                    '{{WRAPPER}} .product-suggested .product:hover .pxl-post-featured' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                                ],
                                            ),
                                        ],
                                    ],
                                ],
                            ),
                        )
                    ),
                ),
                array(
                    'name' => 'tab_title_style',
                    'label' => esc_html__('Title', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'title_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .promo-card .promo-card__title',
                        ),
                        array(
                            'name' => 'title_shadow',
                            'type' => \Elementor\Group_Control_Text_Shadow::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .promo-card .promo-card__title',
                        ),
                        array(
                            'name' => 'title_controls',
                            'control_type' => 'tab',
                            'tabs' => [
                                [
                                    'name' => 'title_normal',
                                    'label' => esc_html__('Normal', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [  
                                        array(
                                            'name' => 'title_color',
                                            'label' => esc_html__('Text Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .promo-card .promo-card__title a' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                    ],
                                ],
                                [
                                    'name' => 'title_hover',
                                    'label' => esc_html__('Hover', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [
                                        array(
                                            'name' => 'title_hover_color',
                                            'label' => esc_html__('Text Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .promo-card .promo-card__title a:hover' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                    ],
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_description_style',
                    'label' => esc_html__('Description', 'komestic' ),
                    'tab' => 'style',
                    'condition' => [
                        'layout!' => ['1']
                    ],
                    'controls' => array(
                        array(
                            'name' => 'desc_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .promo-card .promo-card__desc',
                        ),
                        array(
                            'name' => 'desc_color',
                            'label' => esc_html__('Color', 'komestic' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .promo-card .promo-card__desc' => 'color: {{VALUE}};',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'pxl_moution_effects',
                    'label' => esc_html__('Motion Effects', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array_merge(
                        komestic_get_animation_options([
                            'selectors' => '{{WRAPPER}} .promo-card',
                        ]),
                    ),
                ),

                elementor_tab_advanced_custom(),
            ),
        ),
    ),
    komestic_get_class_widget_path()
);