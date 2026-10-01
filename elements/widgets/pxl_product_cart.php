<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_product_cart',
        'title' => esc_html__('Case Product Cart', 'komestic' ),
        'icon' => 'eicon-woo-cart',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'tab_primary_content',
                    'label' => esc_html__('Content', 'komestic' ),
                    'tab' => 'content',
                    'controls' => array(
                        array(
                            'name' => 'terms_and_conditions_link_page',
                            'label' => esc_html__('Terms and Conditions Link Page', 'komestic' ),
                            'type' => 'url',
                            'label_block' => true,
                            'default' => [
                                'url' => 'http://komestic.local/terms-and-conditions',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_payment_method_content',
                    'label' => esc_html__('Payment Method', 'komestic' ),
                    'tab' => 'content',
                    'controls' => array(
                        array(
                            'name' => 'payment_method_title',
                            'label' => esc_html__('Title', 'komestic' ),
                            'type' => 'text',
                            'label_block' => true,
                            'default' => esc_html__('We accept', 'komestic'),
                        ),
                        array(
                            'name' => 'payment_method_imgs',
                            'label' => esc_html__('Images', 'komestic' ),
                            'type' => 'repeater',
                            'controls' => array(
                                array(
                                    'name' => 'payment_method_img',
                                    'label' => esc_html__('Image', 'komestic' ),
                                    'type' => 'media',
                                ),
                            ),
                        ),
                        array(
                            'name' => 'payment_method_justify_content',
                            'label' => esc_html__('Justify Content', 'komestic'),
                            'type' => 'choose',
                            'control_type' => 'responsive',
                            'separator' => 'before',
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
                                '{{WRAPPER}} .payment-method .grid .grid__inner' => 'justify-content: {{VALUE}};'
                            ],
                        ),
                        array(
                            'name' => 'payment_method_spacing_inline',
                            'label' => esc_html__('Column Spacing(px)', 'komestic' ),
                            'type' => 'slider',
                            'control_type' => 'responsive',
                            'size_units' => ['px'],
                            'selectors' => [
                                '{{WRAPPER}} .payment-method .grid .grid__inner' => '--pxl-spacing-inline: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'payment_method_spacing_block',
                            'label' => esc_html__('Row Spacing(px)', 'komestic' ),
                            'type' => 'slider',
                            'control_type' => 'responsive',
                            'size_units' => ['px'],
                            'selectors' => [
                                '{{WRAPPER}} .payment-method .grid .grid__inner' => '--pxl-spacing-block: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'payment_method_columns',
                            'label' => esc_html__('Columns', 'komestic' ),
                            'type' => 'select',
                            'control_type' => 'responsive',
                            'default' => '',
                            'options' => [
                                ''  => 'Default',
                                '100%' => '1',
                                '50%' => '2',
                                '33.3333333%' => '3',
                                '25%' => '4',
                                '20%' => '5',
                                '16.666666666%' => '6',
                                '14.28%' => '7',
                                '12.5%' => '8',
                                '11.111111111%' => '9',
                                '10%' => '10',
                                'auto' => 'Auto',
                            ],
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .payment-method .grid .grid__inner .grid__item' => '--pxl-width: {{VALUE}};'
                            ]
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_testimonial_content',
                    'label' => esc_html__('Testimonial', 'komestic' ),
                    'tab' => 'content',
                    'controls' => array(
                        array(
                            'name' => 'testimonial_icon',
                            'label' => esc_html__('Icon', 'komestic'),
                            'type' => 'icons',
                            'fa4compatibility' => 'icon',
                            'default' => [
                                'value' => [
                                    'url' => content_url('/uploads/2025/08/quotation-marks-2.svg'),
                                    'id' => 1952,
                                ],
                                'library' => 'svg',
                            ],
                        ),
                        array(
                            'name' => 'testimonials',
                            'label' => esc_html__('Testimonials', 'komestic' ),
                            'type' => 'repeater',
                            'title_field' => '{{{ testimonial_user_name }}}',
                            'controls' => array(
                                array(
                                    'name' => 'testimonial_rating',
                                    'label' => esc_html__('Rating', 'komestic' ),
                                    'type' => 'number',
                                    'min' => 0,
                                    'max' => 5,
                                    'default' => 5,
                                ),
                                array(
                                    'name' => 'testimonial_content',
                                    'label' => esc_html__('Content', 'komestic' ),
                                    'type' => 'textarea',
                                    'rows' => 5,
                                ),
                                array(
                                    'name' => 'testimonial_user_avt',
                                    'label' => esc_html__('User Avatar', 'komestic' ),
                                    'type' => 'media',
                                ),
                                array(
                                    'name' => 'testimonial_user_name',
                                    'label' => esc_html__('User Name', 'komestic' ),
                                    'type' => 'text',
                                ),
                            ),
                        ),
                    ),
                ),



                // Style
                array(
                    'name' => 'tab_payment_method_style',
                    'label' => esc_html__('Payment Method', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array_merge(
                        komestic_size_options([
                            'prefix' => 'img',
                            'selectors' => '{{WRAPPER}} .payment-method img',
                            'label' => 'Image Size',
                        ]),
                        array(
                            array(
                                'name'     => 'payment_method_img_css_filters',
                                'type'     => \Elementor\Group_Control_Css_Filter::get_type(),
                                'control_type' => 'group',
                                'selector' => '{{WRAPPER}} .payment-method .grid__inner img',
                            ),
                            array(
                                'name' => 'payment_method_img_border',
                                'type' => \Elementor\Group_Control_Border::get_type(),
                                'control_type' => 'group', 
                                'separator' => 'before',
                                'selector' => '{{WRAPPER}} .payment-method .grid__inner img',
                            ),
                            array(
                                'name'         => 'payment_method_img_box_shadow',
                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                'control_type' => 'group',
                                'selector'     => '{{WRAPPER}} .payment-method .grid__inner img',
                            ),
                            array(
                                'name' => 'payment_method_img_border_radius',
                                'label' => esc_html__('Border Radius', 'komestic' ),
                                'type' => 'dimensions',
                                'size_units' => [ 'px', 'custom' ],
                                'control_type' => 'responsive',
                                'selectors' => [
                                    '{{WRAPPER}} .payment-method .grid__inner img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    komestic_get_class_widget_path()
);