<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_post_featured',
        'title' => esc_html__('Case Post Featured', 'komestic' ),
        'icon' => 'eicon-featured-image',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'tab_image_content',
                    'label' => esc_html__('Image', 'komestic' ),
                    'tab' => 'content',
                    'controls' => komestic_image_dimension_options(),
                ),
                array(
                    'name' => 'tab_image_style',
                    'label' => esc_html__('Image', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array_merge(
                        komestic_size_options([
                            'selectors' => '{{WRAPPER}} .pxl-post-featured',
                            'label' => esc_html__('Image Sizes', 'komestic')
                        ]),
                        array(
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
                                    '{{WRAPPER}} .pxl-post-featured' => 'opacity: {{SIZE}};',
                                ],
                            ),
                            array(
                                'name'     => 'image_css_filters',
                                'type'     => \Elementor\Group_Control_Css_Filter::get_type(),
                                'control_type' => 'group',
                                'selector' => '{{WRAPPER}} .pxl-post-featured',
                            ),
                            array(
                                'name' => 'image_border',
                                'type' => \Elementor\Group_Control_Border::get_type(),
                                'control_type' => 'group', 
                                'separator' => 'before',
                                'selector' => '{{WRAPPER}} .pxl-post-featured',
                            ),
                            array(
                                'name'         => 'image_box_shadow',
                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                'control_type' => 'group',
                                'selector'     => '{{WRAPPER}} .pxl-post-featured',
                            ),
                            array(
                                'name' => 'image_border_radius',
                                'label' => esc_html__('Border Radius', 'komestic' ),
                                'type' => 'dimensions',
                                'size_units' => [ 'px', 'custom' ],
                                'control_type' => 'responsive',
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-post-featured' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                        'selectors' => '{{WRAPPER}} .pxl-post-featured',
                    ]),
                ),
            ),
        ),
    ),
    komestic_get_class_widget_path()
);