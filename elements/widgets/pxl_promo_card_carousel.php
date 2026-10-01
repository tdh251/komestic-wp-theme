<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_promo_card_carousel',
        'title' => esc_html__('Case Promo Card Carousel', 'komestic'),
        'icon' => 'eicon-menu-card',
        'categories' => array('pxltheme-core'),
        'scripts' => [
            'komestic-swiper',
        ],
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
                                    'label' => esc_html__('1', 'komestic'),
                                    'image' => get_template_directory_uri() . '/elements/assets/img-layouts/testimonial-1.webp',
                                ),
                                '2' => array(
                                    'label' => esc_html__('2', 'komestic'),
                                    'image' => get_template_directory_uri() . '/elements/assets/img-layouts/testimonial-1.webp',
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
                                'name' => 'items',
                                'label' => esc_html__('Items', 'komestic' ),
                                'type' => 'repeater',
                                'title_field' => '{{{title}}}',
                                'controls' => array(
                                    array(
                                        'name' => 'image',
                                        'label' => esc_html__('Image', 'komestic'),
                                        'type' => 'media',
                                    ),
                                    array(
                                        'name' => 'title',
                                        'type' => 'textarea',
                                        'label' => esc_html__('Title', 'komestic'),
                                        'rows' => 5,
                                        'separator' => 'before',
                                        'default' => 'Case Title',
                                    ),
                                    array(
                                        'name' => 'desc',
                                        'type' => 'textarea',
                                        'label' => esc_html__('Description', 'komestic'),
                                        'rows' => 5,
                                    ),
                                    array(
                                        'name' => 'link',
                                        'type' => 'url',
                                        'label' => esc_html__('Link URL', 'komestic'),
                                        'default' => [
                                            'url' => '#',
                                        ],
                                    ),
                                ),
                            ),
                        ),                          
                        komestic_image_dimension_options(),
                        array(
                            array(
                                'name' => 'title_tag',
                                'label' => esc_html__('Title HTML Tag', 'komestic' ),
                                'type' => 'select',
                                'options' => [
                                    ''   => 'Default',
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
                                'default' => '',
                            ),
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_carousel_add_opts',
                    'label' => esc_html__('Additional Options', 'komestic' ),
                    'tab' => 'settings',
                    'controls' => array(
                        swiper_controls_options(),   
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
                                        array(
                                            'name' => 'title_background',
                                            'type' => \Elementor\Group_Control_Background::get_type(),
                                            'control_type' => 'group',
                                            'types' => [ 'classic', 'gradient' ],
                                            'selector' => '{{WRAPPER}} .promo-card .promo-card__title a',
                                        ),
                                        array(
                                            'name' => 'title_border',
                                            'type' => \Elementor\Group_Control_Border::get_type(),
                                            'separator' => 'before',
                                            'control_type' => 'group', 
                                            'selector' => '{{WRAPPER}} .promo-card .promo-card__title a',
                                        ),
                                        array(
                                            'name'         => 'title_box_shadow',
                                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                            'control_type' => 'group',
                                            'selector'     => '{{WRAPPER}} .promo-card .promo-card__title a',
                                        ),
                                        array(
                                            'name' => 'title_border_radius',
                                            'label' => esc_html__('Border Radius', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', '%', 'custom' ],
                                            'selectors' => [
                                                '{{WRAPPER}} .promo-card .promo-card__title a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'title_padding',
                                            'label' => esc_html__('Padding', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', 'custom' ],
                                            'control_type' => 'responsive',
                                            'separator' => 'before',
                                            'selectors' => [
                                                '{{WRAPPER}} .promo-card .promo-card__title a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                                '{{WRAPPER}} .promo-card:hover .promo-card__title a' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'title_hover_background',
                                            'type' => \Elementor\Group_Control_Background::get_type(),
                                            'control_type' => 'group',
                                            'types' => [ 'classic', 'gradient' ],
                                            'selector' => '{{WRAPPER}} .promo-card:hover .promo-card__title abutton--primary):hover',
                                            'fields_options' => [
                                                'color' => [
                                                    'selectors' => [
                                                        '{{WRAPPER}} .promo-card:hover .promo-card__title a--pxl-background-color: {{VALUE}};'
                                                    ],
                                                ],
                                            ],
                                        ),
                                        array(
                                            'name' => 'title_hover_border',
                                            'type' => \Elementor\Group_Control_Border::get_type(),
                                            'separator' => 'before',
                                            'control_type' => 'group', 
                                            'selector' => '{{WRAPPER}} .promo-card:hover .promo-card__title a',
                                        ),
                                        array(
                                            'name'         => 'title_hover_box_shadow',
                                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                            'control_type' => 'group',
                                            'selector'     => '{{WRAPPER}} .promo-card:hover .promo-card__title a',
                                        ),
                                        array(
                                            'name' => 'title_hover_border_radius',
                                            'label' => esc_html__('Border Radius', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', '%', 'custom' ],
                                            'selectors' => [
                                                '{{WRAPPER}} .promo-card:hover .promo-card__title a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'title_hover_padding',
                                            'label' => esc_html__('Padding', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', 'custom' ],
                                            'control_type' => 'responsive',
                                            'separator' => 'before',
                                            'selectors' => [
                                                '{{WRAPPER}} .promo-card:hover .promo-card__title a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                        'layout' => ['2']
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
                swiper_bullets_pagination_style_options(),
                swiper_navigation_button_style_options(),
                array(
                    'name' => 'pxl_motion_effects',
                    'tab' => 'style',
                    'label' => esc_html__('Motion Effects', 'komestic'),
                    'controls' => komestic_get_animation_options([
                        'selectors' => '{{WRAPPER}} .pxl-swiper .swiper-slide',
                    ]),
                ),
                elementor_tab_advanced_custom(),

            ),
        ),
    ),
    komestic_get_class_widget_path()
);