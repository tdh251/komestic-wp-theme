<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_image_gallery',
        'title' => esc_html__('Case Image Gallery', 'komestic' ),
        'icon' => 'eicon-gallery-grid',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'tab_primary_content',
                    'label' => esc_html__('Images', 'komestic' ),
                    'tab' => 'content',
                    'controls' => array_merge(
                        array(
                            array(
                                'name' => 'images',
                                'label' => esc_html__('Images', 'komestic' ),
                                'type' => 'repeater',
                                'controls' => array(
                                    array(
                                        'name' => 'image',
                                        'label' => esc_html__('Image', 'komestic' ),
                                        'type' => 'media',
                                    ),
                                    array(
                                        'name' => 'link_url',
                                        'label' => esc_html__('Link URL', 'komestic' ),
                                        'type' => 'url',
                                    ),
                                    // array(
                                    //     'name' => 'item_img_dimension',
                                    //     'label' => esc_html__( 'Dimension Custom', 'komestic' ),
                                    //     'type' => 'image_dimensions',
                                    //     'description' => esc_html__( 'Crop the original image size to any custom size. Set custom width or height to keep the original size ratio.', 'komestic' ),
                                    // ),
                                ),
                                // 'title_field' => '{{{link}}}',
                            ),
                        ),
                        komestic_image_dimension_options(),
                        array(
                            array(
                                'name' => 'has_overlay',
                                'label' => esc_html__('Overlay', 'komestic'),
                                'type' => 'switcher',
                                'separator' => 'before',
                                'default' => '',
                            ),
                            array(
                                'name' => 'overlay_bg',
                                'type' => \Elementor\Group_Control_Background::get_type(),
                                'control_type' => 'group',
                                'types' => [ 'classic', 'gradient' ],
                                'selector' => '{{WRAPPER}} .image-gallery .grid__inner .pxl-background-overlay',
                                'condition' => [
                                    'is_overlay!' => '',
                                ],
                            ),
                        )
                    ),
                ),
                array(
                    'name' => 'tab_additional_options',
                    'label' => esc_html__('Additional Options', 'komestic' ),
                    'tab' => 'content',
                    'controls' => array(
                        array(
                            'name' => 'grid_justify_content',
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
                                '{{WRAPPER}} .grid .grid__inner' => 'justify-content: {{VALUE}};'
                            ],
                        ),
                        array(
                            'name' => 'spacing_block',
                            'label' => esc_html__('Spacing Block', 'komestic'),
                            'type' => 'slider',
                            'control_type' => 'responsive',
                            'size_units' => ['px', 'custom'],
                            'separator' => 'before',
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .image-gallery .grid__inner' => '--pxl-spacing-block: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'spacing_inline',
                            'label' => esc_html__('Spacing Inline', 'komestic'),
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
                                '{{WRAPPER}} .image-gallery .grid__inner' => '--pxl-spacing-inline: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'columns',
                            'label' => esc_html__('Columns', 'komestic'),
                            'type' => 'select',
                            'control_type' => 'responsive',
                            'separator' => 'before',
                            'options' => [
                                ''     => esc_html__('Default', 'komestic'),
                                '100%' => '1',
                                '50%'  => '2',
                                '33.3333%' => '3',
                                '25%'  => '4',
                                '20%'  => '5',
                                '16.66666%' => '6',
                                '14.2857142857%' => '7',
                                '12.5%' => '8',
                                '11.1111111%' => '9',
                                '10%'   => '10',
                                'auto'     => esc_html__('Auto', 'komestic'),
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .image-gallery .grid__item'  => 'flex-basis: {{VALUE}};',
                            ],
                        ),
                    ),
                ),

                array(
                    'name' => 'tab_image_style',
                    'label' => esc_html__('Image', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array_merge(
                        komestic_size_options([
                            'prefix' => 'img',
                            'selectors' => '{{WRAPPER}} .image-gallery .grid__inner img',
                            'label' => 'Image Size',
                        ]),
                        array(
                            array(
                                'name' => 'image_controls',
                                'control_type' => 'tab',
                                'separator' => 'before',
                                'tabs' => [
                                    [
                                        'name' => 'image_normal',
                                        'label' => esc_html__('Normal', 'komestic' ),
                                        'type' => 'tab',
                                        'controls' => [  
                                            array(
                                                'name' => 'image_opacity',
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
                                                    '{{WRAPPER}} .image-gallery .grid__inner img' => 'opacity: {{SIZE}};',
                                                ],
                                            ),
                                            array(
                                                'name'     => 'image_css_filters',
                                                'type'     => \Elementor\Group_Control_Css_Filter::get_type(),
                                                'control_type' => 'group',
                                                'selector' => '{{WRAPPER}} .image-gallery .grid__inner img',
                                            ),
                                            array(
                                                'name' => 'image_border',
                                                'type' => \Elementor\Group_Control_Border::get_type(),
                                                'control_type' => 'group', 
                                                'separator' => 'before',
                                                'selector' => '{{WRAPPER}} .image-gallery .grid__inner img',
                                            ),
                                            array(
                                                'name'         => 'image_box_shadow',
                                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                                'control_type' => 'group',
                                                'selector'     => '{{WRAPPER}} .image-gallery .grid__inner img',
                                            ),
                                            array(
                                                'name' => 'image_border_radius',
                                                'label' => esc_html__('Border Radius', 'komestic' ),
                                                'type' => 'dimensions',
                                                'size_units' => [ 'px', 'custom' ],
                                                'control_type' => 'responsive',
                                                'selectors' => [
                                                    '{{WRAPPER}} .image-gallery .grid__inner img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                                ],
                                            ),
                                        ],
                                    ],
                                    [
                                        'name' => 'image_hover',
                                        'label' => esc_html__('Hover', 'komestic' ),
                                        'type' => 'tab',
                                        'controls' => [
                                            array(
                                                'name' => 'image_hover_opacity',
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
                                                    '{{WRAPPER}} .image-gallery .grid__inner img:hover,' => 'opacity: {{SIZE}};',
                                                ],
                                            ),
                                            array(
                                                'name'     => 'image_hover_css_filters',
                                                'type'     => \Elementor\Group_Control_Css_Filter::get_type(),
                                                'control_type' => 'group',
                                                'selector' => '{{WRAPPER}} .image-gallery .grid__inner img:hover',
                                            ),
                                            array(
                                                'name' => 'image_hover_border',
                                                'type' => \Elementor\Group_Control_Border::get_type(),
                                                'control_type' => 'group', 
                                                'separator' => 'before',
                                                'selector' => '{{WRAPPER}} .image-gallery .grid__inner img:hover',
                                            ),
                                            array(
                                                'name'         => 'image_hover_box_shadow',
                                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                                'control_type' => 'group',
                                                'selector'     => '{{WRAPPER}} .image-gallery .grid__inner img:hover',
                                            ),
                                            array(
                                                'name' => 'image_hover_border_radius',
                                                'label' => esc_html__('Border Radius', 'komestic' ),
                                                'type' => 'dimensions',
                                                'size_units' => [ 'px', 'custom' ],
                                                'control_type' => 'responsive',
                                                'selectors' => [
                                                    '{{WRAPPER}} .image-gallery .grid__inner img:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                                ],
                                            ),
    
                                            array(
                                                'name' => 'image_hover_overlay_bg',
                                                'type' => \Elementor\Group_Control_Background::get_type(),
                                                'control_type' => 'group',
                                                'types' => [ 'classic', 'gradient' ],
                                                'selector' => '{{WRAPPER}} .image-gallery .grid__inner:hover .pxl-background-overlay',
                                                'condition' => [
                                                    'is_overlay!' => '',
                                                ],
                                            ),
                                            array(
                                                'name' => 'image_hover_overlay_bg_opacity',
                                                'label' => esc_html__('Overlay Opacity', 'komestic' ),
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
                                                    '{{WRAPPER}} .image-gallery .grid__inner:hover .pxl-background-overlay' => 'opacity: {{SIZE}};',
                                                ],
                                                'condition' => [
                                                    'is_overlay!' => '',
                                                ],
                                            ),
                                        ],
                                    ],
                                ],
                            ),
                        ),
                    ),
                ),
                array(
                    'name' => 'pxl_moution_effects',
                    'label' => esc_html__('Motion Effects', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array_merge(
                        komestic_get_animation_options([
                            'selectors' => '{{WRAPPER}} .grid .grid__item',
                        ]),
                    ),
                ),

            ),
        ),
    ),
    komestic_get_class_widget_path()
);