<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_heading',
        'title' => esc_html__('Case Heading', 'komestic' ),
        'icon' => 'eicon-heading',
        'categories' => array('pxltheme-core'),
        'scripts' => [
            'komestic-animated',
        ],
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'tab_heading_content',
                    'label' => esc_html__('Title', 'komestic' ),
                    'tab' => 'content',
                    'controls' => array(
                        array(
                            'name' => 'subtitle',
                            'label' => esc_html__('Subtitle', 'komestic' ),
                            'type' => 'textarea',
                            'default' => esc_html__('Subtitle', 'komestic'),
                            'rows' => 2,
                            'description' => esc_html__('Highlight use shortcode: [highlight text="..."] or [highlight_image img_id="123"]', 'komestic'),
                        ),
                        array(
                            'name' => 'subtitle_style',
                            'label' => esc_html__('Subtitle Style', 'komestic' ),
                            'type' => 'select',
                            'options' => [
                                'heading__subtitle--default' => esc_html__('Default', 'komestic'),
                                'heading__subtitle--custom' => esc_html__('Custom', 'komestic'),
                            ],
                            'default' => 'heading__subtitle--default',
                            'condition' => [
                                'subtitle!' => '',
                            ],
                        ),
                        array(
                            'name' => 'subtitle_spacing',
                            'label' => esc_html__('Subtitle Spacing', 'komestic' ),
                            'type' => 'slider',
                            'control_type' => 'responsive',
                            'size_units' => [ 'px', 'custom' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 500,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-heading .heading__subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'subtitle!' => '',
                            ],
                        ),
                        array(
                            'name' => 'title',
                            'label' => esc_html__('Title', 'komestic' ),
                            'type' => 'textarea',
                            'separator' => 'before',
                            'rows' => 10,
                            'default' => esc_html__('Heading Title', 'komestic'),
                            'label_block' => true,
                            'description' => esc_html__('Highlight use shortcode: [highlight text="..."] or [highlight_image img_id="123"]', 'komestic'),
                        ),
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
                            'default' => 'h2',
                            'condition' => [
                                'title!' => '',
                            ],
                        ),
                        array(
                            'name' => 'title_style',
                            'label' => esc_html__('Title Style', 'komestic' ),
                            'type' => 'select',
                            'options' => [
                                '' => esc_html__('Default', 'komestic'),
                                'heading__title--custom' => esc_html__('Custom', 'komestic'),
                                'heading__title--primary' => esc_html__('Primary', 'komestic'),
                                'heading__title--secondary' => esc_html__('Secondary', 'komestic'),
                            ],
                            'default' => '',
                            'condition' => [
                                'title!' => '',
                            ],
                        ),
                        array(
                            'name' => 'title_text_background',
                            'type' => \Elementor\Group_Control_Background::get_type(),
                            'control_type' => 'group',
                            'types' => [ 'classic'],
                            'selector' => '{{WRAPPER}} .pxl-heading .heading__title',
                            'condition' => [
                                'title_style' => 'text-image',
                            ],
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
                                '{{WRAPPER}} .pxl-heading' => 'text-align: {{VALUE}};',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_title_style',
                    'label' => esc_html__('Title', 'komestic' ),
                    'tab' => 'style',
                    'condition' => [
                        'title!' => '',
                    ],
                    'controls' => array_merge(
                        array(
                            array(
                                'name' => 'title_controls',
                                'control_type' => 'tab',
                                'tabs' => [
                                    [
                                        'name' => 'title_normal',
                                        'label' => esc_html__('Normal', 'komestic'),
                                        'type' => 'tab',
                                        'controls' => [
                                            array(
                                                'name' => 'title_color',
                                                'label' => esc_html__('Text Color', 'komestic' ),
                                                'type' => 'color',
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-heading .heading__title' => 'color: {{VALUE}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'title_typography',
                                                'type' => \Elementor\Group_Control_Typography::get_type(),
                                                'control_type' => 'group',
                                                'selector' => '{{WRAPPER}} .pxl-heading .heading__title',
                                            ),
                                        ],
                                    ],
                                    [
                                        'name' => 'title_text_hightlight',
                                        'label' => esc_html__('Text Highlight', 'komestic' ),
                                        'type' => 'tab',
                                        'controls' => [
                                            array(
                                                'name' => 'title_text_highlight_color',
                                                'label' => esc_html__('Text Color', 'komestic' ),
                                                'type' => 'color',
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-heading .heading__title .pxl-text-highlight' => 'color: {{VALUE}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'title_text_highlight_typography',
                                                'type' => \Elementor\Group_Control_Typography::get_type(),
                                                'control_type' => 'group',
                                                'selector' => '{{WRAPPER}} .pxl-heading .heading__title .pxl-text-highlight',
                                            ),
                                        ],
                                    ],
                                    [
                                        'name' => 'title_media_highlight',
                                        'label' => esc_html__('Media Highlight', 'komestic' ),
                                        'type' => 'tab',
                                        'controls' => array_merge(
                                            komestic_size_options([
                                                'prefix' => 'title_image',
                                                'selectors' => '{{WRAPPER}} .pxl-heading .image--highlight',
                                                'type' => 'basic',
                                                'label' => esc_html__('Image Sizes', 'komestic'),
                                            ]),
                                            array(
                                                array(
                                                    'name' => 'title_svg_color',
                                                    'label' => esc_html__('SVG Color', 'komestic' ),
                                                    'type' => 'color',
                                                    'separator' => 'before',
                                                    'selectors' => [
                                                        '{{WRAPPER}} .pxl-heading .heading__title .pxl-svg-highlight' => 'color: {{VALUE}};',
                                                    ],
                                                ),
                                                array(
                                                    'name' => 'title_svg_size',
                                                    'label' => esc_html__('SVG Size', 'komestic'),
                                                    'type' => 'slider',
                                                    'size_units' => ['px', 'custom'],
                                                    'range' => [
                                                        'px' => [
                                                            'min' => 0,
                                                        ],
                                                    ],
                                                    'selectors' => [
                                                        '{{WRAPPER}} .pxl-heading .heading__title .pxl-svg-highlight svg' => 'width: {{SIZE}}{{UNIT}}; height: auto;'
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
                    'name' => 'tab_subtitle_style',
                    'label' => esc_html__('Subtitle', 'komestic' ),
                    'tab' => 'style',
                    'condition' => [
                        'subtitle!' => '',
                    ],
                    'controls' => array(
                        array(
                            'name' => 'subtitle_controls',
                            'control_type' => 'tab',
                            'tabs' => [
                                [
                                    'name' => 'subtitle_normal',
                                    'label' => esc_html__('Normal', 'komestic'),
                                    'type' => 'tab',
                                    'controls' => [
                                        array(
                                            'name' => 'subtitle_color',
                                            'label' => esc_html__('Text Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-heading .heading__subtitle' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'subtitle_typography',
                                            'type' => \Elementor\Group_Control_Typography::get_type(),
                                            'control_type' => 'group',
                                            'selector' => '{{WRAPPER}} .pxl-heading .heading__subtitle',
                                        ),
                                    ],
                                ],
                                [
                                    'name' => 'subtitle_text_hightlight',
                                    'label' => esc_html__('Text Highlight', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [
                                        array(
                                            'name' => 'subtitle_text_highlight_color',
                                            'label' => esc_html__('Text Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-heading .heading__subtitle .pxl-text-highlight' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'subtitle_text_highlight_typography',
                                            'type' => \Elementor\Group_Control_Typography::get_type(),
                                            'control_type' => 'group',
                                            'selector' => '{{WRAPPER}} .pxl-heading .heading__subtitle .pxl-text-highlight',
                                        ),
                                    ],
                                ],
                                [
                                    'name' => 'subtitle_media_highlight',
                                    'label' => esc_html__('Media Highlight', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => array_merge(
                                        komestic_size_options([
                                            'prefix' => 'subtitle_image',
                                            'selectors' => '{{WRAPPER}} .pxl-heading .pxl-image-highlight img',
                                            'type' => 'basic',
                                            'label' => esc_html__('Image Sizes', 'komestic'),
                                        ]),
                                        array(
                                            array(
                                                'name' => 'subtitle_svg_color',
                                                'label' => esc_html__('SVG Color', 'komestic' ),
                                                'type' => 'color',
                                                'separator' => 'before',
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-heading .heading__subtitle .pxl-svg-highlight' => 'color: {{VALUE}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'subtitle_svg_size',
                                                'label' => esc_html__('SVG Size', 'komestic'),
                                                'type' => 'slider',
                                                'size_units' => ['px', 'custom'],
                                                'range' => [
                                                    'px' => [
                                                        'min' => 0,
                                                    ],
                                                ],
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-heading .heading__subtitle .pxl-svg-highlight svg' => 'width: {{SIZE}}{{UNIT}}; height: auto;'
                                                ],
                                            ),
                                        )
                                    ),
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'pxl_moution_effects',
                    'label' => esc_html__('Motion Effects', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array_merge(
                        array(
                            array(
                                'name' => 'title_anim_heading',
                                'type' => 'heading',
                                'label' => esc_html__('Title Animation', 'komestic' ),
                                'condition' => [
                                    'title!' => ''
                                ]
                            ),
                        ),
                        komestic_get_animation_options([
                            'prefix' => 'title',
                            'selectors' => '{{WRAPPER}} .pxl-heading .heading__title',
                            'condition' => [
                                'title!' => ''
                            ],
                            'type' => 'text',
                        ]),
                        array(
                            array(
                                'name' => 'subtitle_anim_heading',
                                'type' => 'heading',
                                'separator' => 'before',
                                'label' => esc_html__('Subtitle Animation', 'komestic' ),
                                'condition' => [
                                    'subtitle!' => ''
                                ]
                            ),
                        ),
                        komestic_get_animation_options([
                            'prefix' => 'subtitle',
                            'selectors' => '{{WRAPPER}} .pxl-heading .heading__subtitle',
                            'condition' => [
                                'subtitle!' => ''
                            ],
                            'type' => 'text',
                        ]),
                    ),
                ),

                elementor_tab_advanced_custom(),
            ),
        ),
    ),
    komestic_get_class_widget_path()
);