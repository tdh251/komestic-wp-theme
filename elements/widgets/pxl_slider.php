<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_slider',
        'title' => esc_html__('Case Slider', 'komestic'),
        'icon' => 'eicon-slides',
        'categories' => array('pxltheme-core'),
        'scripts'    => array(
            'komestic-swiper',
        ),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'tab_slider_layout',
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
                                    'label' => esc_html__('Layout 1', 'komestic'),
                                    'image' => get_template_directory_uri() . '/elements/assets/img-layouts/slider-1.webp',
                                ),
                                '2' => array(
                                    'label' => esc_html__('Layout 2', 'komestic'),
                                    'image' => get_template_directory_uri() . '/elements/assets/img-layouts/slider-2.webp',
                                ),
                                '3' => array(
                                    'label' => esc_html__('Layout 3', 'komestic'),
                                    'image' => get_template_directory_uri() . '/elements/assets/img-layouts/slider-3.webp',
                                ),
                            ),
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_slider_content',
                    'label' => esc_html__('Slides', 'komestic' ),
                    'tab' => 'content',
                    'controls' => array(
                        array(
                            'name' => 'slides',
                            'label' => esc_html__('Slides', 'komestic' ),
                            'type' => 'repeater',
                            'controls' => array(
                                array(
                                    'name' => 'slide_background',
                                    'type' => \Elementor\Group_Control_Background::get_type(),
                                    'control_type' => 'group',
                                    'types' => [ 'classic', 'gradient' ],
                                    'selector' => '{{WRAPPER}} .pxl-slider .swiper-slide{{CURRENT_ITEM}} .slide__background',
                                    'fields_options' => [
                                        'background' => [
                                            'label' => __( 'Background Slide', 'komestic' ),
                                        ],
                                    ],
                                ),
                                array(
                                    'name' => 'overlay_background',
                                    'type' => \Elementor\Group_Control_Background::get_type(),
                                    'control_type' => 'group',
                                    'types' => [ 'classic', 'gradient' ],
                                    'selector' => '{{WRAPPER}} .pxl-slider .swiper-slide{{CURRENT_ITEM}} .slide__background::before',
                                    'fields_options' => [
                                        'background' => [
                                            'label' => __( 'Background Overlay', 'komestic' ),
                                        ],
                                    ],
                                ),
                                array(
                                    'name' => 'title',
                                    'label' => esc_html__('Title', 'komestic' ),
                                    'type' => 'textarea',
                                    'rows' => 5,
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
                                    'default' => 'h1',
                                    'condition' => [
                                        'title!' => '',
                                    ],
                                ),
                                array(
                                    'name' => 'description',
                                    'label' => esc_html__('Description', 'komestic' ),
                                    'type' => 'textarea',
                                    'rows' => 3,
                                ),
                                array(
                                    'name' => 'btn_text',
                                    'label' => esc_html__('Button Text', 'komestic' ),
                                    'type' => 'text',
                                    'default' => esc_html__('Click Here', 'komestic'),
                                ),
                                array(
                                    'name' => 'btn_link',
                                    'label' => esc_html__('Link URL', 'komestic' ),
                                    'type' => 'url',
                                    'default' => [
                                        'url' => '#',
                                    ],
                                ),
                                [
                                    'name' => 'slide_item_container',
                                    'label' => esc_html__('Container', 'komestic'),
                                    'type' => 'slider',
                                    'control_type' => 'responsive',
                                    'size_units' => ['px', 'custom'],
                                    'range' => [
                                        'px' => [
                                            'min' => 0,
                                        ],
                                        '%' => [
                                            'min' => 0,
                                        ],
                                    ],
                                    'selectors' => [
                                        '{{WRAPPER}} .pxl-slider .swiper-slide{{CURRENT_ITEM}} .slide__container' => 'max-width: {{SIZE}}{{UNIT}};'
                                    ],
                                ],
                                array(
                                    'name' => 'container_item_dir',
                                    'label' => esc_html__('Container Direction', 'komestic'),
                                    'type' => 'choose',
                                    'control_type' => 'responsive',
                                    'options' => array(
                                        'row' => [
                                            'title' => esc_html__('Row', 'komestic' ),
                                            'icon' => 'eicon-arrow-right',
                                        ],
                                        'column' => [
                                            'title' => esc_html__('Column', 'komestic' ),
                                            'icon' => 'eicon-arrow-down',
                                        ],
                                        'row-reverse' => [
                                            'title' => esc_html__('Row Reverse', 'komestic' ),
                                            'icon' => 'eicon-arrow-left',
                                        ],
                                        'column-reverse' => [
                                            'title' => esc_html__('Column Reverse', 'komestic' ),
                                            'icon' => 'eicon-arrow-up',
                                        ],
                                    ),
                                    'selectors' => [
                                        '{{WRAPPER}} .pxl-slider .swiper-slide{{CURRENT_ITEM}} .slide__container' => 'flex-direction: {{VALUE}};'
                                    ],
                                ),
                                array(
                                    'name' => 'container_item_justify_content',
                                    'label' => esc_html__('Container Justify Content', 'komestic'),
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
                                        '{{WRAPPER}} .pxl-slider .swiper-slide{{CURRENT_ITEM}} .slide__container' => 'justify-content: {{VALUE}};'
                                    ],
                                ),
                                array(
                                    'name' => 'content_item_align',
                                    'label' => esc_html__('Align Items', 'komestic'),
                                    'type' => 'choose',
                                    'control_type' => 'responsive',
                                    'options' => array(
                                        'start' => [
                                            'title' => esc_html__('Start', 'komestic' ),
                                            'icon' => 'eicon-align-start-v',
                                        ],
                                        'center' => [
                                            'title' => esc_html__('Center', 'komestic' ),
                                            'icon' => 'eicon-align-center-v',
                                        ],
                                        'end' => [
                                            'title' => esc_html__('End', 'komestic' ),
                                            'icon' => 'eicon-align-end-v',
                                        ],
                                    ),
                                    'selectors' => [
                                        '{{WRAPPER}} .pxl-slider .swiper-slide{{CURRENT_ITEM}} .slide__inner' => 'align-items: {{VALUE}};'
                                    ],
                                ),
                                array(
                                    'name' => 'content_item_text_align',
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
                                        '{{WRAPPER}} .pxl-slider .swiper-slide{{CURRENT_ITEM}} .slide__inner' => 'text-align: {{VALUE}};',
                                    ],
                                ),
                                array(
                                    'name' => '_container_item_padding',
                                    'label' => esc_html__('Container Padding', 'komestic' ),
                                    'type' => 'dimensions',
                                    'size_units' => [ 'px', 'custom' ],
                                    'control_type' => 'responsive',
                                    'selectors' => [
                                        '{{WRAPPER}} .pxl-slider .swiper-slide{{CURRENT_ITEM}} .slide__container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                    ],
                                ),
                            ),
                            'title_field' => '{{{ title }}}',
                            'default' => [
                                [
                                    'title'    => esc_html__('Heading Title', 'komestic'),
                                    'description' => esc_html__('Lorem ipsum dolor sit amet! Aenean curae est posuere felis et sapien ornare dictum.', 'komestic'),
                                    'btn_text' => esc_html__('Click here', 'komestic'),
                                    'btn_link' => '#',
                                ]
                            ],

                        ),
                    ),
                ),
                array(
                    'name' => 'tab_layer_content',
                    'label' => esc_html__('Layer', 'komestic' ),
                    'tab' => 'content',
                    'controls' => array(
                        array(
                            'name' => 'layers',
                            'label' => esc_html__('Layers', 'komestic' ),
                            'type' => 'repeater',
                            'controls' => array_merge(
                                array(
                                    array(
                                        'name' => 'show_in_slide',
                                        'label' => esc_html__('Show in Slide', 'komestic'),
                                        'type' => 'number',
                                    ),
                                    array(
                                        'name' => 'layer',
                                        'label' => esc_html__('Choose Image', 'komestic'),
                                        'type' => 'media',
                                        'selectors' => [
                                            '{{WRAPPER}} .pxl-slider .slide__feature{{CURRENT_ITEM}}' => 'background-image: url({{URL}});',
                                        ],
                                    ),
                                    array(
                                        'name' => 'layer_align_seft',
                                        'label' => esc_html__('Align Seft', 'komestic'),
                                        'type' => 'choose',
                                        'control_type' => 'responsive',
                                        'options' => array(
                                            'start' => [
                                                'title' => esc_html__('Start', 'komestic' ),
                                                'icon' => 'eicon-align-start-v',
                                            ],
                                            'center' => [
                                                'title' => esc_html__('Center', 'komestic' ),
                                                'icon' => 'eicon-align-center-v',
                                            ],
                                            'end' => [
                                                'title' => esc_html__('End', 'komestic' ),
                                                'icon' => 'eicon-align-end-v',
                                            ],
                                        ),
                                        'selectors' => [
                                            '{{WRAPPER}} .pxl-slider img{{CURRENT_ITEM}}' => 'align-self: {{VALUE}};'
                                        ],
                                    ),
                                    array(
                                        'name' => 'layer_size_heading',
                                        'label' => esc_html__('Size', 'komestic'),
                                        'type' => 'heading',
                                    ),
                                    [
                                        'name' => 'layer_width',
                                        'label' => esc_html__('Width', 'komestic'),
                                        'type' => 'slider',
                                        'control_type' => 'responsive',
                                        'size_units' => ['px', '%', 'custom'],
                                        'range' => [
                                            'px' => [
                                                'min' => 0,
                                            ],
                                            '%' => [
                                                'min' => 0,
                                            ],
                                        ],
                                        'selectors' => [
                                            '{{WRAPPER}} .pxl-slider img{{CURRENT_ITEM}}' => 'width: {{SIZE}}{{UNIT}};'
                                        ],
                                    ],
                                    [
                                        'name' => 'layer_max_width',
                                        'label' => esc_html__('Max Width', 'komestic'),
                                        'type' => 'slider',
                                        'control_type' => 'responsive',
                                        'size_units' => ['px', '%', 'custom'],
                                        'range' => [
                                            'px' => [
                                                'min' => 0,
                                            ],
                                            '%' => [
                                                'min' => 0,
                                            ],
                                        ],
                                        'selectors' => [
                                            '{{WRAPPER}} .pxl-slider img{{CURRENT_ITEM}}' => 'max-width: {{SIZE}}{{UNIT}};'
                                        ],
                                    ],
                                    [
                                        'name' => 'layer_height',
                                        'label' => esc_html__('Height', 'komestic'),
                                        'type' => 'slider',
                                        'control_type' => 'responsive',
                                        'size_units' => ['px', '%', 'custom'],
                                        'range' => [
                                            'px' => [
                                                'min' => 0,
                                            ],
                                            '%' => [
                                                'min' => 0,
                                            ],
                                        ],
                                        'selectors' => [
                                            '{{WRAPPER}} .pxl-slider img{{CURRENT_ITEM}}' => 'height: {{SIZE}}{{UNIT}};'
                                        ],
                                    ],
                                    [
                                        'name' => 'layer_max_height',
                                        'label' => esc_html__('Max Height', 'komestic'),
                                        'type' => 'slider',
                                        'control_type' => 'responsive',
                                        'size_units' => ['px', '%', 'custom'],
                                        'range' => [
                                            'px' => [
                                                'min' => 0,
                                            ],
                                            '%' => [
                                                'min' => 0,
                                            ],
                                        ],
                                        'selectors' => [
                                            '{{WRAPPER}} .pxl-slider img{{CURRENT_ITEM}}' => 'max-height: {{SIZE}}{{UNIT}};'
                                        ],
                                    ],
                                    array(
                                        'name' => 'layer_z_index',
                                        'label' => esc_html__('Z index', 'komestic'),
                                        'type' => 'number',
                                        'selectors' => '{{WRAPPER}} .pxl-slider img{{CURRENT_ITEM}}',
                                    ),
                                    array(
                                        'name' => 'layer_position_heading',
                                        'label' => esc_html__('Position', 'komestic'),
                                        'type' => 'heading',
                                    ),
                                ),
                                komestic_position_options([
                                    'prefix' => 'layer',
                                    'selectors' => '{{WRAPPER}} .pxl-slider img{{CURRENT_ITEM}}',
                                ]),
                                komestic_get_animation_options([
                                    'prefix' => 'layer',
                                    'selectors' => '{{WRAPPER}} .pxl-slider img{{CURRENT_ITEM}}',
                                ]),
                            ),
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_slider_add_opts',
                    'label' => esc_html__('Additional Options', 'komestic' ),
                    'tab' => 'settings',
                    'controls' => array(
                        array(
                            'name' => 'allow_touch_move',
                            'label' => esc_html__('Allow Touch Move', 'komestic'),
                            'type' => 'switcher',
                            'default' => 'true',
                        ),
                        array(
                            'name' => 'autoplay',
                            'label' => esc_html__('Autoplay', 'komestic'),
                            'type' => 'switcher',
                            'default' => '',
                        ),
                        array(
                            'name' => 'disable_on_interaction',
                            'label' => esc_html__('Pause on Interaction', 'komestic'),
                            'type' => 'switcher',
                            'default' => '',
                            'condition' => [
                                'autoplay!' => '',
                            ],
                        ),
                        array(
                            'name' => 'delay',
                            'label' => esc_html__('Delay', 'komestic'),
                            'type' => 'number',
                            'default' => 3000,
                            'condition' => [
                                'autoplay!' => '',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-slider .swiper-container' => '--pxl-duration: {{VALUE}}ms;',
                            ],
                        ),
                        array(
                            'name' => 'loop',
                            'label' => esc_html__('Infinite Loop', 'komestic'),
                            'type' => 'switcher',
                            'default' => '',
                        ),
                        array(
                            'name' => 'speed',
                            'label' => esc_html__('Animation Speed', 'komestic'),
                            'type' => 'number',
                            'default' => 300,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-slider .swiper-container' => '--pxl-transition-duration: {{VALUE}}ms;',
                            ],
                        ),
                        array(
                            'name' => 'space_between',
                            'label' => esc_html__('Space Between(px)', 'komestic'),
                            'type' => 'number',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-swiper .swiper-inner .swiper-container-fade' => '--pxl-spacing-inline: {{VALUE}}ms;'
                            ]
                        ),
                        array(
                            'name' => 'swiper_pagination',
                            'type' => 'select',
                            'label' => esc_html__('Pagination', 'komestic'),
                            'separator' => 'before',
                            'options' => [
                                ''            => esc_html__('None', 'komestic'),
                                'bullets'     => esc_html__('Bullets', 'komestic'),
                                'progressbar' => esc_html__('Progressbar', 'komestic'),
                                'fraction'    => esc_html__('Fraction', 'komestic'),
                            ],
                        ),
                        array(
                            'name' => 'swiper_navigation',
                            'label' => esc_html__('Navigation', 'komestic'),
                            'type' => 'switcher',
                            'default' => '',
                        ),        
                        array(
                            'name' => 'nav_btn_icon_prev',
                            'label' => esc_html__('Button Icon Prev', 'komestic' ),
                            'type' => 'icons',
                            'fa4compatibility' => 'icon',
                            'default' => [
                                'value' => [
                                    'url' => content_url('/uploads/2025/06/arrow-left.svg'),
                                    'id' => 3614,
                                ],
                                'library' => 'svg',
                            ],
                            'condition' => [
                                'swiper_navigation!' => '',
                                'use_swiper_nav_widget' => ''
                            ],
                        ),
                        array(
                            'name' => 'nav_btn_icon_next',
                            'label' => esc_html__('Button Icon Next', 'komestic' ),
                            'type' => 'icons',
                            'fa4compatibility' => 'icon',
                            'default' => [
                                'value' => [
                                    'url' => content_url('/uploads/2025/06/arrow-right.svg'),
                                    'id' => 3615,
                                ],
                                'library' => 'svg',
                            ],
                            'condition' => [
                                'swiper_navigation!' => '',
                                'use_swiper_nav_widget' => ''
                            ],
                        ), 
                    ),
                ),
                array(
                    'name' => 'tab_slider_animated',
                    'label' => esc_html__('Animated', 'komestic' ),
                    'tab' => 'settings',
                    'controls' => array_merge(
                        array(
                            array(
                                'name' => 'title_anim_heading',
                                'type' => 'heading',
                                'separator' => 'before',
                                'label' => esc_html__('Title Animation', 'komestic' ),
                            ),
                        ),
                        komestic_get_animation_options([
                            'prefix' => 'title',
                            'selectors' => '{{WRAPPER}} .pxl-slider .slide__title',
                            'type' => 'slider'
                        ]),
                        array(
                            array(
                                'name' => 'button_anim_heading',
                                'type' => 'heading',
                                'separator' => 'before',
                                'label' => esc_html__('Button Animation', 'komestic' ),
                            ),
                        ),
                        komestic_get_animation_options([
                            'prefix' => 'button',
                            'selectors' => '{{WRAPPER}} .pxl-slider .slide__button-wrap',
                        ]),
                        array(
                            array(
                                'name' => 'desc_anim_heading',
                                'type' => 'heading',
                                'separator' => 'before',
                                'label' => esc_html__('Description Animation', 'komestic' ),
                            ),
                        ),
                        komestic_get_animation_options([
                            'prefix' => 'desc',
                            'selectors' => '{{WRAPPER}} .pxl-slider .slide__description',
                        ]),
                    ),
                ),
                array(
                    'name' => 'tab_general_style',
                    'label' => esc_html__('General', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'slider_min_height',
                            'label' => esc_html__('Min Height', 'komestic' ),
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
                                '{{WRAPPER}} .pxl-slider .swiper-slide .slide__inner' => 'min-height: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'inner_align_items_v',
                            'label' => esc_html__('Align Items', 'komestic'),
                            'type' => 'choose',
                            'control_type' => 'responsive',
                            'options' => array(
                                'start' => [
                                    'title' => esc_html__('Start', 'komestic' ),
                                    'icon' => 'eicon-align-start-v',
                                ],
                                'center' => [
                                    'title' => esc_html__('Center', 'komestic' ),
                                    'icon' => 'eicon-align-center-v',
                                ],
                                'end' => [
                                    'title' => esc_html__('End', 'komestic' ),
                                    'icon' => 'eicon-align-end-v',
                                ],
                            ),
                            'selectors' => [
                                '{{WRAPPER}} .pxl-slider .swiper-slide .slide__inner' => 'align-items: {{VALUE}};'
                            ],
                        ),
                        array(
                            'name' => 'slider_inner_padding',
                            'label' => esc_html__('Inner Padding', 'komestic' ),
                            'type' => 'dimensions',
                            'size_units' => [ 'px', 'custom' ],
                            'control_type' => 'responsive',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-slider .swiper-slide .slide__inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'slider_container',
                            'label' => esc_html__('Container', 'komestic' ),
                            'type' => 'slider',
                            'separator' => 'before',
                            'control_type' => 'responsive',
                            'size_units' => [ 'px', 'custom' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 500,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-slider .swiper-slide .slide__container' => 'max-width: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'slider_container_padding',
                            'label' => esc_html__('Container Padding', 'komestic' ),
                            'type' => 'dimensions',
                            'size_units' => [ 'px', 'custom' ],
                            'control_type' => 'responsive',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-slider .swiper-slide .slide__container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'slider_container_margin',
                            'label' => esc_html__('Container Margin', 'komestic' ),
                            'type' => 'dimensions',
                            'size_units' => [ 'px', 'custom' ],
                            'control_type' => 'responsive',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-slider .swiper-slide .slide__container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'title_spacing_bottom',
                            'label' => esc_html__('Title Spacing', 'komestic' ),
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
                                '{{WRAPPER}} .pxl-slider .swiper-slide .slide__title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'desc_spacing',
                            'label' => esc_html__('Description Spacing', 'komestic' ),
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
                                '{{WRAPPER}} .pxl-slider .swiper-slide .slide__description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
                                                '{{WRAPPER}} .pxl-slider .swiper-slide .slide__title' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'title_typography',
                                            'type' => \Elementor\Group_Control_Typography::get_type(),
                                            'control_type' => 'group',
                                            'selector' => '{{WRAPPER}} .pxl-slider .swiper-slide .slide__title',
                                        ),
                                    ],
                                ],
                                [
                                    'name' => 'title_highlight',
                                    'label' => esc_html__('Highlight', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [
                                        array(
                                            'name' => 'title_hl_block',
                                            'type' => 'choose',
                                            'label' => esc_html__('Width', 'komestic'),
                                            'options' => [
                                                'auto' => [
                                                    'title' => esc_html__('Auto', 'komestic'),
                                                    'icon' => 'eicon-arrow-right',
                                                ],
                                                '100%' => [
                                                    'title' => esc_html__('100%', 'komestic'),
                                                    'icon' => 'eicon-arrow-down',
                                                ],
                                            ],
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-slider .swiper-slide .slide__title .text--highlight' => 'display: {{VALUE}}',
                                            ],
                                        ),
                                        array(
                                            'name' => 'title_hl_color',
                                            'label' => esc_html__('Text Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-slider .swiper-slide .slide__title .text--highlight' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'title_hl_typography',
                                            'type' => \Elementor\Group_Control_Typography::get_type(),
                                            'control_type' => 'group',
                                            'selector' => '{{WRAPPER}} .pxl-slider .swiper-slide .slide__title .text--highlight',
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
                    'controls' => array(
                        array(
                            'name' => 'description_color',
                            'label' => esc_html__('Text Color', 'komestic' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-slider .swiper-slide .slide__description' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'description_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-slider .swiper-slide .slide__description',
                        )
                    ),
                ),
                array(
                    'name' => 'tab_button_style',
                    'label' => esc_html__('Button', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array_merge(
                        array(
                            array(
                                'name' => 'button_width',
                                'label' => esc_html__('Width', 'komestic' ),
                                'type' => 'slider',
                                'size_units' => ['px', 'custom'],
                                'control_type' => 'responsive',
                                'range' => [
                                    'px' => [
                                        'min' => 0,
                                        'max' => 1000,
                                    ],
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-slider .pxl-button' => 'width: {{SIZE}}{{UNIT}};',
                                ],
                            ),
                            array(
                                'name' => 'button_height',
                                'label' => esc_html__('Height', 'komestic' ),
                                'type' => 'slider',
                                'size_units' => ['px', 'custom'],
                                'control_type' => 'responsive',
                                'range' => [
                                    'px' => [
                                        'min' => 0,
                                        'max' => 1000,
                                    ],
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-slider .pxl-button' => 'height: {{SIZE}}{{UNIT}};',
                                ],
                            ),
                            array(
                                'name' => 'button_typography',
                                'type' => \Elementor\Group_Control_Typography::get_type(),
                                'control_type' => 'group',
                                'selector' => '{{WRAPPER}} .pxl-slider .pxl-button',
                            ),
                            array(
                                'name' => 'divider1',
                                'type' => 'divider',
                            ),
                            array(
                                'name' => 'button_controls',
                                'control_type' => 'tab',
                                'tabs' => [
                                    [
                                        'name' => 'button_normal',
                                        'label' => esc_html__('Normal', 'komestic' ),
                                        'type' => 'tab',
                                        'controls' => [  
                                            array(
                                                'name' => 'button_color',
                                                'label' => esc_html__('Color', 'komestic' ),
                                                'type' => 'color',
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-slider .pxl-button' => 'color: {{VALUE}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'button_background',
                                                'type' => \Elementor\Group_Control_Background::get_type(),
                                                'control_type' => 'group',
                                                'types' => [ 'classic', 'gradient' ],
                                                'selector' => '{{WRAPPER}} .pxl-slider .pxl-button',
                                            ),
                                            array(
                                                'name' => 'button_border',
                                                'type' => \Elementor\Group_Control_Border::get_type(),
                                                'separator' => 'before',
                                                'control_type' => 'group', 
                                                'selector' => '{{WRAPPER}} .pxl-slider .pxl-button',
                                            ),
                                            array(
                                                'name'         => 'button_box_shadow',
                                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                                'control_type' => 'group',
                                                'selector'     => '{{WRAPPER}} .pxl-slider .pxl-button',
                                            ),
                                            array(
                                                'name' => 'button_border_radius',
                                                'label' => esc_html__('Border Radius', 'komestic' ),
                                                'type' => 'dimensions',
                                                'size_units' => [ 'px', 'custom' ],
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-slider .pxl-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'button_padding',
                                                'label' => esc_html__('Padding', 'komestic' ),
                                                'type' => 'dimensions',
                                                'size_units' => [ 'px', 'custom' ],
                                                'control_type' => 'responsive',
                                                'separator' => 'before',
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-slider .pxl-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                                ],
                                            ),
                                        ],
                                    ],
                                    [
                                        'name' => 'button_hover',
                                        'label' => esc_html__('Hover', 'komestic' ),
                                        'type' => 'tab',
                                        'controls' => [
                                            array(
                                                'name' => 'button_hover_color',
                                                'label' => esc_html__('Color', 'komestic' ),
                                                'type' => 'color',
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-slider .pxl-button:hover' => 'color: {{VALUE}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'button_hover_background',
                                                'type' => \Elementor\Group_Control_Background::get_type(),
                                                'control_type' => 'group',
                                                'types' => [ 'classic' ],
                                                'selector' => '{{WRAPPER}} .pxl-slider .pxl-button:hover',
                                            ),
                                            array(
                                                'name' => 'button_transition',
                                                'label' => esc_html__('Transition(s)', 'komestic'),
                                                'type'  => 'slider',
                                                'size_units' => ['s'],
                                                'range' => [
                                                    's' => [
                                                        'min' => 0, 
                                                        'max' => 20
                                                    ],
                                                ],                                            
                                                'default' => [
                                                    'unit' => 's'
                                                ],
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-slider .pxl-button' => 'transition: all {{SIZE}}{{UNIT}} linear;'
                                                ]
                                            ),
                                            array(
                                                'name' => 'button_hover_border',
                                                'type' => \Elementor\Group_Control_Border::get_type(),
                                                'separator' => 'before',
                                                'control_type' => 'group', 
                                                'selector' => '{{WRAPPER}} .pxl-slider .pxl-button:hover',
                                            ),
                                            array(
                                                'name'         => 'button_hover_box_shadow',
                                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                                'control_type' => 'group',
                                                'selector'     => '{{WRAPPER}} .pxl-slider .pxl-button:hover',
                                            ),
                                            array(
                                                'name' => 'button_hover_border_radius',
                                                'label' => esc_html__('Border Radius', 'komestic' ),
                                                'type' => 'dimensions',
                                                'size_units' => [ 'px', 'custom' ],
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-slider .pxl-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'button_hover_padding',
                                                'label' => esc_html__('Padding', 'komestic' ),
                                                'type' => 'dimensions',
                                                'size_units' => [ 'px', 'custom' ],
                                                'control_type' => 'responsive',
                                                'separator' => 'before',
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-slider .pxl-button:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                                ],
                                            ),
                                        ],
                                    ],
                                ],
                            ), 
                        ),
                    ),
                ),
                swiper_bullets_pagination_style_options(),
                swiper_navigation_button_style_options(),
            ),
        ),
    ),
    komestic_get_class_widget_path()
);