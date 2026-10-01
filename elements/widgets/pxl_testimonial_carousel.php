<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_testimonial_carousel',
        'title' => esc_html__('Case Testimonial Carousel', 'komestic' ),
        'icon' => 'eicon-testimonial-carousel',
        'categories' => array('pxltheme-core'),
        'scripts' => [
            'komestic-swiper',
        ],
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'tab_testimonial_layout',
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
                                    'label' => esc_html__('Testimonial 1', 'komestic'),
                                    'image' => get_template_directory_uri() . '/elements/assets/img-layouts/testimonial-1.webp',
                                ),
                                '2' => array(
                                    'label' => esc_html__('Testimonial 2', 'komestic'),
                                    'image' => get_template_directory_uri() . '/elements/assets/img-layouts/testimonial-1.webp',
                                ),
                                '3' => array(
                                    'label' => esc_html__('Testimonial 3', 'komestic'),
                                    'image' => get_template_directory_uri() . '/elements/assets/img-layouts/testimonial-1.webp',
                                ),
                                '4' => array(
                                    'label' => esc_html__('Testimonial 4', 'komestic'),
                                    'image' => get_template_directory_uri() . '/elements/assets/img-layouts/testimonial-1.webp',
                                ),
                                '5' => array(
                                    'label' => esc_html__('Testimonial 5', 'komestic'),
                                    'image' => get_template_directory_uri() . '/elements/assets/img-layouts/testimonial-1.webp',
                                ),
                                '6' => array(
                                    'label' => esc_html__('Testimonial 6', 'komestic'),
                                    'image' => get_template_directory_uri() . '/elements/assets/img-layouts/testimonial-1.webp',
                                ),
                            ),
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_testimonial_content',
                    'label' => esc_html__('Items', 'komestic' ),
                    'tab' => 'content',
                    'controls' => array(
                        array(
                            'name' => '_icon',
                            'label' => esc_html__('Icon', 'komestic'),
                            'type' => 'icons',
                            'fa4compatibility' => 'icon',
                            'default' => [
                                'value' => [
                                    'url' => content_url('/uploads/2025/09/quotation-marks-3.svg'),
                                    'id' => 3537,
                                ],
                                'library' => 'svg',
                            ],
                            'condition' => [
                                'layout!' => ['2'],
                            ],
                        ),
                        array(
                            'name' => 'items',
                            'label' => esc_html__('Items', 'komestic' ),
                            'type' => 'repeater',
                            'controls' => array(
                                array(
                                    'name' => 'featured',
                                    'label' => esc_html__('Featured', 'komestic' ),
                                    'type' => 'media',
                                ),
                                array(
                                    'name' => 'rating',
                                    'label' => esc_html__('Rating', 'komestic'),
                                    'type' => 'number',
                                    'min' => 0,
                                    'max' => 5,
                                ),
                                array(
                                    'name' => 'content',
                                    'label' => esc_html__('Content', 'komestic'),
                                    'type' => 'textarea',
                                    'rows' => 10,
                                    'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'komestic'),
                                ),
                                array(
                                    'name' => 'image',
                                    'label' => esc_html__('Image', 'komestic' ),
                                    'type' => 'media',
                                ),
                                array(
                                    'name' => 'name',
                                    'label' => esc_html__('Name', 'komestic'),
                                    'type' => 'text',
                                ),
                                array(
                                    'name' => 'title',
                                    'label' => esc_html__('Title', 'komestic'),
                                    'type' => 'text',
                                ),
                                array(
                                    'name' => 'is_verified',
                                    'label' => esc_html__('Is Verified', 'komestic'),
                                    'type' => 'select',
                                    'default' => 'verified',
                                    'options' => [
                                        'verified' => esc_html__('Verified', 'komestic'),
                                        'not-verified' => esc_html__('Not Verified', 'komestic'),
                                    ],
                                ),
                                array(
                                    'name' => 'link',
                                    'label' => esc_html__('Link URL', 'komestic' ),
                                    'type' => 'url',
                                ),
                                array(
                                    'name'     => 'product_id',
                                    'label'    => esc_html__( 'Product', 'komestic' ),
                                    'type'     => 'select2',
                                    'multiple' => false,
                                    'label_block' => true,
                                    'default' => '',
                                    'options'  => get_all_products_id_name(),
                                ),
                            ),
                            'title_field' => '{{{ name }}}',
                            'default' => [
                                [
                                    'content' => esc_html__('“I would recommend practitioners at this center to everyone! They are great to work with and are excellent trainers. Thank you all!”', 'komestic'),
                                    'name'    => 'Benjamin Taylor',
                                    'title'   => 'Recommend!',
                                    'rating'  => 5,
                                ],
                                [
                                    'content' => esc_html__('“I would recommend practitioners at this center to everyone! They are great to work with and are excellent trainers. Thank you all!”', 'komestic'),
                                    'name'    => 'Emilio J. Harper',
                                    'title'   => 'Recommend!',
                                    'rating'  => 5,
                                ],
                            ],

                        ),
                    ),
                ),
                array(
                    'name' => 'tab_testimonial_display',
                    'label' => esc_html__('Display', 'komestic' ),
                    'tab' => 'settings',
                    'controls' => array_merge(
                        komestic_image_dimension_options(),
                        array(
                            array(
                                'name' => 'show_rating',
                                'label' => esc_html__('Show Rating', 'komestic' ),
                                'type' => 'switcher',
                                'default' => 'true',
                            ),   
                            array(
                                'name' => 'show_user',
                                'label' => esc_html__('Show User', 'komestic' ),
                                'type' => 'switcher',
                                'default' => 'true',
                            ),
                            array(
                                'name' => 'show_icon',
                                'label' => esc_html__('Show Icon', 'komestic' ),
                                'type' => 'switcher',
                                'default' => 'true',
                            ),
                        )
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
                    'name' => 'tab_gereral_style',
                    'label' => esc_html__('General', 'komestic'),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'rating_spacing',
                            'label' => esc_html__('Rating Spacing', 'komestic'),
                            'type' => 'slider',
                            'size_units' => ['px', 'custom'],
                            'range' => [
                                'px' => [
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-testimonial-carousel .testimonial .testimonial__rating' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'rating_gap',
                            'label' => esc_html__('Rating Gap', 'komestic'),
                            'type' => 'slider',
                            'size_units' => ['px', 'custom'],
                            'range' => [
                                'px' => [
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-testimonial-carousel .testimonial .testimonial__rating' => 'gap: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'divider_spacing_top',
                            'label' => esc_html__('Divider Spacing Top', 'komestic'),
                            'type' => 'slider',
                            'size_units' => ['px', 'custom'],
                            'range' => [
                                'px' => [
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-testimonial-carousel .testimonial .divider' => 'margin-top: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'divider_spacing_bottom',
                            'label' => esc_html__('Divider Spacing Bottom', 'komestic'),
                            'type' => 'slider',
                            'size_units' => ['px', 'custom'],
                            'range' => [
                                'px' => [
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-testimonial-carousel .testimonial .divider' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'title_spacing',
                            'label' => esc_html__('Title Spacing', 'komestic'),
                            'type' => 'slider',
                            'size_units' => ['px', 'custom'],
                            'separator' => 'before',
                            'range' => [
                                'px' => [
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-testimonial-carousel .testimonial .testimonial__title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'content_spacing',
                            'label' => esc_html__('Content Spacing', 'komestic'),
                            'type' => 'slider',
                            'size_units' => ['px', 'custom'],
                            'range' => [
                                'px' => [
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-testimonial-carousel .testimonial__content' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'user_gap',
                            'label' => esc_html__('User Gap', 'komestic'),
                            'type' => 'slider',
                            'size_units' => ['px', 'custom'],
                            'range' => [
                                'px' => [
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-testimonial-carousel .testimonial .user' => 'gap: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'product_gap',
                            'label' => esc_html__('Product Gap', 'komestic'),
                            'type' => 'slider',
                            'size_units' => ['px', 'custom'],
                            'range' => [
                                'px' => [
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-testimonial-carousel .testimonial .product' => 'gap: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_box_style',
                    'label' => esc_html__('Box', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'box_controls',
                            'control_type' => 'tab',
                            'tabs' => [
                                [
                                    'name' => 'box_normal',
                                    'label' => esc_html__('Normal', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [  
                                        array(
                                            'name' => 'box_bg',
                                            'type' => \Elementor\Group_Control_Background::get_type(),
                                            'control_type' => 'group',
                                            'types' => [ 'classic', 'gradient' ],
                                            'selector' => '{{WRAPPER}} .pxl-testimonial-carousel .testimonial',
                                        ),
                                        array(
                                            'name' => 'box_border',
                                            'type' => \Elementor\Group_Control_Border::get_type(),
                                            'separator' => 'before',
                                            'control_type' => 'group', 
                                            'selector' => '{{WRAPPER}} .pxl-testimonial-carousel .testimonial',
                                        ),
                                        array(
                                            'name'         => 'box_box_shadow',
                                            'label' => esc_html__( 'Box Shadow', 'komestic' ),
                                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                            'control_type' => 'group',
                                            'selector'     => '{{WRAPPER}} .pxl-testimonial-carousel .testimonial',
                                        ),
                                        array(
                                            'name' => 'box_border_radius',
                                            'label' => esc_html__('Border Radius', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', '%', 'custom' ],
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-testimonial-carousel .testimonial' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'box_padding',
                                            'label' => esc_html__('Padding', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', '%', 'custom' ],
                                            'control_type' => 'responsive',
                                            'separator' => 'before',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-testimonial-carousel .testimonial' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                    ],
                                ],
                                [
                                    'name' => 'box_hover',
                                    'label' => esc_html__('Hover', 'komestic' ),
                                    'type' => 'tabs',
                                    'controls' => [
                                        array(
                                            'name' => 'box_hove_color',
                                            'label' => esc_html__('Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-testimonial-carousel .testimonial:hover' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'box_hover_bg',
                                            'type' => \Elementor\Group_Control_Background::get_type(),
                                            'control_type' => 'group',
                                            'types' => [ 'classic', 'gradient' ],
                                            'selector' => '{{WRAPPER}} .pxl-testimonial-carousel .testimonial:hover',
                                        ),
                                        array(
                                            'name' => '_box_hover_border_color',
                                            'label' => esc_html__('Border Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-testimonial-carousel .testimonial:hover' => 'border-color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'box_hover_border',
                                            'type' => \Elementor\Group_Control_Border::get_type(),
                                            'separator' => 'before',
                                            'control_type' => 'group', 
                                            'selector' => '{{WRAPPER}} .pxl-testimonial-carousel .testimonial:hover',
                                        ),
                                        array(
                                            'name'         => 'box_hover_box_shadow',
                                            'label' => esc_html__( 'Box Shadow', 'komestic' ),
                                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                            'control_type' => 'group',
                                            'selector'     => '{{WRAPPER}} .pxl-testimonial-carousel .testimonial:hover',
                                        ),
                                        array(
                                            'name' => 'box_hover_border_radius',
                                            'label' => esc_html__('Border Radius', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', '%', 'custom' ],
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-testimonial-carousel .testimonial:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'box_hover_padding',
                                            'label' => esc_html__('Padding', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', '%', 'custom' ],
                                            'control_type' => 'responsive',
                                            'separator' => 'before',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-testimonial-carousel .testimonial:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                    ],
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_divider_style',
                    'label' => esc_html__('Divider', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'divider_weight',
                            'label' => esc_html__('Weight', 'komestic'),
                            'type' => 'slider',
                            'size_units' => ['px', 'custom'],
                            'range' => [
                                'px' => [
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-testimonial-carousel .testimonial .divider' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'divider_color',
                            'label' => esc_html__('Color', 'komestic' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-testimonial-carousel .testimonial .divider' => 'background-color: {{VALUE}};',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_featured_style',
                    'label' => esc_html__('Testimonial Featured', 'komestic' ),
                    'tab' => 'style',
                    'condition' => [
                        'layout!' => ['2'],
                    ],
                    'controls' => array(
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
                                '{{WRAPPER}} .pxl-testimonial-carousel .testimonial-images img, {{WRAPPER}} .pxl-testimonial-carousel .testimonial__image img' => 'opacity: {{SIZE}};',
                            ],
                        ),
                        array(
                            'name'     => 'featured_css_filters',
                            'type'     => \Elementor\Group_Control_Css_Filter::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-testimonial-carousel .testimonial-images img, {{WRAPPER}} .pxl-testimonial-carousel .testimonial__image img',
                        ),
                        array(
                            'name' => 'featured_border',
                            'type' => \Elementor\Group_Control_Border::get_type(),
                            'control_type' => 'group', 
                            'separator' => 'before',
                            'selector' => '{{WRAPPER}} .pxl-testimonial-carousel .testimonial-images, {{WRAPPER}} .pxl-testimonial-carousel .testimonial__image img',
                        ),
                        array(
                            'name'         => 'featured_box_shadow',
                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                            'control_type' => 'group',
                            'selector'     => '{{WRAPPER}} .pxl-testimonial-carousel .testimonial-images, {{WRAPPER}} .pxl-testimonial-carousel .testimonial__image img',
                        ),
                        array(
                            'name' => 'featured_border_radius',
                            'label' => esc_html__('Border Radius', 'komestic' ),
                            'type' => 'dimensions',
                            'size_units' => [ 'px', '%', 'custom' ],
                            'control_type' => 'responsive',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-testimonial-carousel .testimonial-images, {{WRAPPER}} .pxl-testimonial-carousel .testimonial__image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_rating_style',
                    'label' => esc_html__('Testimonial Rating', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'rating_icon_size',
                            'label' => esc_html__('Icon Size', 'komestic'),
                            'type' => 'slider',
                            'size_units' => ['px', 'custom'],
                            'range' => [
                                'px' => [
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-testimonial-carousel .testimonial .testimonial__rating svg' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
                            ],
                        ),
                        array(
                            'name' => 'rating_color',
                            'label' => esc_html__('Color', 'komestic' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-testimonial-carousel .testimonial .testimonial__rating' => 'color: {{VALUE}};',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_title_style',
                    'label' => esc_html__('Testimonial Title', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'title_color',
                            'label' => esc_html__('Color', 'komestic' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-testimonial-carousel .testimonial__title' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'title_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-testimonial-carousel .testimonial__title',
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_content_style',
                    'label' => esc_html__('Testimonial Content', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'content_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-testimonial-carousel .testimonial__content',
                        ),
                        array(
                            'name' => 'content_color',
                            'label' => esc_html__('Text Color', 'komestic' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-testimonial-carousel .testimonial__content' => 'color: {{VALUE}};',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_user_image_style',
                    'label' => esc_html__('User Image', 'komestic' ),
                    'tab' => 'style',
                    'condition' => [
                        'layout!' => ['2'],
                    ],
                    'controls' => array(
                        array(
                            'name' => 'user_image_box_size',
                            'label' => esc_html__('Box Size', 'komestic'),
                            'type' => 'slider',
                            'size_units' => ['px', 'custom'],
                            'range' => [
                                'px' => [
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-testimonial-carousel .testimonial__user .user__image' => '--pxl-box-size: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'user_image_opacity',
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
                                '{{WRAPPER}} .pxl-testimonial-carousel .testimonial__user .user__image' => 'opacity: {{SIZE}};',
                            ],
                        ),
                        array(
                            'name'     => 'user_image_css_filters',
                            'type'     => \Elementor\Group_Control_Css_Filter::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-testimonial-carousel .testimonial__user .user__image',
                        ),
                        array(
                            'name' => 'user_image_border',
                            'type' => \Elementor\Group_Control_Border::get_type(),
                            'control_type' => 'group', 
                            'separator' => 'before',
                            'selector' => '{{WRAPPER}} .pxl-testimonial-carousel .testimonial__user .user__image',
                        ),
                        array(
                            'name'         => 'user_image_box_shadow',
                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                            'control_type' => 'group',
                            'selector'     => '{{WRAPPER}} .pxl-testimonial-carousel .testimonial__user .user__image',
                        ),
                        array(
                            'name' => 'user_image_border_radius',
                            'label' => esc_html__('Border Radius', 'komestic' ),
                            'type' => 'dimensions',
                            'size_units' => [ 'px', '%', 'custom' ],
                            'control_type' => 'responsive',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-testimonial-carousel .testimonial__user .user__image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_is_verified_style',
                    'label' => esc_html__('Is Verified', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'is_verified_controls',
                            'control_type' => 'tab',
                            'tabs' => [
                                [
                                    'name' => 'user_verified_normal',
                                    'label' => esc_html__('Normal', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [  
                                        array(
                                            'name' => 'user_verified_color',
                                            'label' => esc_html__('Text Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-testimonial-carousel .testimonial .testimonial__verified' => 'color: {{VALUE}};',
                                                '{{WRAPPER}} .pxl-testimonial-carousel .testimonial .testimonial__verified .tick' => 'background-color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'user_verified_typography',
                                            'type' => \Elementor\Group_Control_Typography::get_type(),
                                            'control_type' => 'group',
                                            'selector' => '{{WRAPPER}} .pxl-testimonial-carousel .testimonial .testimonial__verified',
                                        ),
                                    ],
                                ],
                                [
                                    'name' => 'user_not_verified',
                                    'label' => esc_html__('Hover', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [
                                        array(
                                            'name' => 'user_not_verified_color',
                                            'label' => esc_html__('Text Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-testimonial-carousel .testimonial .testimonial__not-verified' => 'color: {{VALUE}};',
                                                '{{WRAPPER}} .pxl-testimonial-carousel .testimonial .testimonial__not-verified .tick' => 'background-color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'user_not_verified_typography',
                                            'type' => \Elementor\Group_Control_Typography::get_type(),
                                            'control_type' => 'group',
                                            'selector' => '{{WRAPPER}} .pxl-testimonial-carousel .testimonial .testimonial__not-verified',
                                        ),
                                    ],
                                ],
                            ]
                        )
                    ),
                ),
                array(
                    'name' => 'tab_user_name_style',
                    'label' => esc_html__('User Name', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'user_name_color',
                            'label' => esc_html__('Text Color', 'komestic' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-testimonial-carousel .testimonial__user .user__name' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'user_name_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-testimonial-carousel .testimonial__user .user__name',
                        ),
                        array(
                            'name' => 'user_name_shadow',
                            'type' => \Elementor\Group_Control_Text_Shadow::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-testimonial-carousel .testimonial__user .user__name',
                        ),
                        
                    ),
                ),
                array(
                    'name' => 'tab_product_image_style',
                    'label' => esc_html__('Product Image', 'komestic' ),
                    'tab' => 'style',
                    'condition' => [
                        'layout!' => ['4'],
                    ],
                    'controls' => array(
                        array(
                            'name' => 'product_image_box_size',
                            'label' => esc_html__('Box Size', 'komestic'),
                            'type' => 'slider',
                            'size_units' => ['px', 'custom'],
                            'range' => [
                                'px' => [
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-testimonial-carousel .product .product__featured' => '--pxl-box-size: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'product_image_opacity',
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
                                '{{WRAPPER}} .pxl-testimonial-carousel .product .product__featured' => 'opacity: {{SIZE}};',
                            ],
                        ),
                        array(
                            'name'     => 'product_image_css_filters',
                            'type'     => \Elementor\Group_Control_Css_Filter::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-testimonial-carousel .product .product__featured',
                        ),
                        array(
                            'name' => 'product_image_border',
                            'type' => \Elementor\Group_Control_Border::get_type(),
                            'control_type' => 'group', 
                            'separator' => 'before',
                            'selector' => '{{WRAPPER}} .pxl-testimonial-carousel .product .product__featured',
                        ),
                        array(
                            'name'         => 'product_image_box_shadow',
                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                            'control_type' => 'group',
                            'selector'     => '{{WRAPPER}} .pxl-testimonial-carousel .product .product__featured',
                        ),
                        array(
                            'name' => 'product_image_border_radius',
                            'label' => esc_html__('Border Radius', 'komestic' ),
                            'type' => 'dimensions',
                            'size_units' => [ 'px', '%', 'custom' ],
                            'control_type' => 'responsive',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-testimonial-carousel .product .product__featured' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_product_name_style',
                    'label' => esc_html__('Product Name', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'product_name_controls',
                            'control_type' => 'tab',
                            'tabs' => [
                                [
                                    'name' => 'product_name_normal',
                                    'label' => esc_html__('Normal', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [  
                                        array(
                                            'name' => 'product_name_color',
                                            'label' => esc_html__('Text Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-testimonial-carousel .product .product__name' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                    ],
                                ],
                                [
                                    'name' => 'product_name_hover',
                                    'label' => esc_html__('Hover', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [
                                        array(
                                            'name' => 'product_name_hover_color',
                                            'label' => esc_html__('Text Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-testimonial-carousel .product .product__name:hover' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                    ],
                                ],
                            ]
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_product_price_style',
                    'label' => esc_html__('Product Price', 'komestic' ),
                    'tab' => 'style',
                    'condition' => [
                        'layout!' => ['4'],
                    ],
                    'controls' => array(
                        array(
                            'name' => 'price_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-testimonial-carousel .product .product__price .price',
                        ),
                        array(
                            'name' => 'price_color',
                            'label' => esc_html__('Color', 'komestic' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-testimonial-carousel .product .product__price .price, 
                                {{WRAPPER}} .pxl-testimonial-carousel .product .product__price .price--normal' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'price_controls',
                            'control_type' => 'tab',
                            'tabs' => [
                                [
                                    'name' => 'price_sale',
                                    'label' => esc_html__('Sale', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [  
                                        array(
                                            'name' => 'price_ins_color',
                                            'label' => esc_html__('Text Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-testimonial-carousel .product .product__price .price--sale' => 'color: {{VALUE}} !important;',
                                            ],
                                        ),
                                        array(
                                            'name' => 'price_ins_typography',
                                            'type' => \Elementor\Group_Control_Typography::get_type(),
                                            'control_type' => 'group',
                                            'selector' => '{{WRAPPER}} .pxl-testimonial-carousel .product .product__price .price--sale',
                                        ),
                                    ],
                                ],
                                [
                                    'name' => 'price_old',
                                    'label' => esc_html__('Old', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [  
                                        array(
                                            'name' => 'price_del_color',
                                            'label' => esc_html__('Text Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-testimonial-carousel .product .product__price .price--old' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'price_del_typography',
                                            'type' => \Elementor\Group_Control_Typography::get_type(),
                                            'control_type' => 'group',
                                            'selector' => '{{WRAPPER}} .pxl-testimonial-carousel .product .product__price .price--old',
                                        ),
                                    ],
                                ],
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
            ),
        ),
    ),
    komestic_get_class_widget_path()
);