<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_image',
        'title' => esc_html__('Case Image', 'komestic' ),
        'icon' => 'eicon-image',
        'categories' => array('pxltheme-core'),
        'scripts' => [
        ],
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'tab_image_content',
                    'label' => esc_html__('Image', 'komestic' ),
                    'tab' => 'content',
                    'controls' => array_merge(
                        array(
                            array(
                                'name' => 'image',
                                'label' => esc_html__('Image', 'komestic' ),
                                'type' => 'media',
                            ),
                        ),
                        komestic_image_dimension_options(),
                        array(
                            array(
                                'name' => 'image_link',
                                'label' => esc_html__('Link URL', 'komestic' ),
                                'type' => 'url',
                            ),
                            array(
                                'name' => 'is_overlay',
                                'label' => esc_html__('Overlay', 'komestic'),
                                'type' => 'switcher',
                                'separator' => 'before',
                                'default' => '',
                            ),
                            array(
                                'name' => 'overlay_background',
                                'type' => \Elementor\Group_Control_Background::get_type(),
                                'control_type' => 'group',
                                'types' => [ 'classic', 'gradient' ],
                                'selector' => '{{WRAPPER}} .pxl-image-wrapper:after',
                                'condition' => [
                                    'is_overlay!' => '',
                                ],
                            ),
                        )
                    ),
                ),
                array(
                    'name' => 'tab_image_style',
                    'label' => esc_html__('Image', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array_merge(
                        komestic_size_options([
                            'selectors' => '{{WRAPPER}} .pxl-image-wrapper img',
                            'label' => esc_html__('Image Sizes', 'komestic')
                        ]),
                        array(
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
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-image-wrapper' => 'text-align: {{VALUE}};',
                                ],
                            ),
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
                                                    '{{WRAPPER}} .pxl-image-wrapper img' => 'opacity: {{SIZE}};',
                                                ],
                                            ),
                                            array(
                                                'name'     => 'image_css_filters',
                                                'type'     => \Elementor\Group_Control_Css_Filter::get_type(),
                                                'control_type' => 'group',
                                                'selector' => '{{WRAPPER}} .pxl-image-wrapper img',
                                            ),
                                            array(
                                                'name' => 'image_border',
                                                'type' => \Elementor\Group_Control_Border::get_type(),
                                                'control_type' => 'group', 
                                                'separator' => 'before',
                                                'selector' => '{{WRAPPER}} .pxl-image-wrapper img',
                                            ),
                                            array(
                                                'name'         => 'image_box_shadow',
                                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                                'control_type' => 'group',
                                                'selector'     => '{{WRAPPER}} .pxl-image-wrapper img',
                                            ),
                                            array(
                                                'name' => 'image_border_radius',
                                                'label' => esc_html__('Border Radius', 'komestic' ),
                                                'type' => 'dimensions',
                                                'size_units' => [ 'px', 'custom' ],
                                                'control_type' => 'responsive',
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-image-wrapper img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                                    '{{WRAPPER}} .pxl-image-wrapper img:hover' => 'opacity: {{SIZE}};',
                                                ],
                                            ),
                                            array(
                                                'name'     => 'image_hover_css_filters',
                                                'type'     => \Elementor\Group_Control_Css_Filter::get_type(),
                                                'control_type' => 'group',
                                                'selector' => '{{WRAPPER}} .pxl-image-wrapper img:hover',
                                            ),
                                            array(
                                                'name' => 'image_hover_border',
                                                'type' => \Elementor\Group_Control_Border::get_type(),
                                                'control_type' => 'group', 
                                                'separator' => 'before',
                                                'selector' => '{{WRAPPER}} .pxl-image-wrapper img:hover',
                                            ),
                                            array(
                                                'name'         => 'image_hover_box_shadow',
                                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                                'control_type' => 'group',
                                                'selector'     => '{{WRAPPER}} .pxl-image-wrapper img:hover',
                                            ),
                                            array(
                                                'name' => 'image_hover_border_radius',
                                                'label' => esc_html__('Border Radius', 'komestic' ),
                                                'type' => 'dimensions',
                                                'size_units' => [ 'px', 'custom' ],
                                                'control_type' => 'responsive',
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-image-wrapper img:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'image_hover_effect',
                                                'label' => esc_html__('Hover Effect', 'komestic' ),
                                                'type' => 'select',
                                                'separator' => 'before',
                                                'options' => [
                                                    ''               => esc_html__('None', 'komestic'),
                                                    'hover-image-parallax' => esc_html__('Parallax', 'komestic'),
                                                    'hover-distortion-transition' => esc_html__('Image Distortion', 'komestic'),
                                                ],
                                                'default' => '',
                                            ),
                                        ],
                                    ],
                                ],
                            ),
                        ),
                    ),
                ),
                array(
                    'name' => 'pxl_motion_effects',
                    'tab' => 'style',
                    'label' => esc_html__('Motion Effects', 'komestic'),
                    'controls' => komestic_get_animation_options([
                        'selectors' => '{{WRAPPER}} .pxl-image-wrapper',
                        'type' => 'image',
                    ]),
                ),
            ),
        ),
    ),
    komestic_get_class_widget_path()
);