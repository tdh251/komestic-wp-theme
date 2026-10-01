<?php
$contact_forms[0] = 'Choose Form';
if(class_exists('WPCF7')) {
    $cf7 = get_posts('post_type="wpcf7_contact_form"&numberposts=-1');
    if ($cf7) {
        foreach ($cf7 as $cform) {
            $contact_forms[$cform->ID] = $cform->post_title;
        }
    } else {
        $contact_forms[esc_html__('No contact forms found', 'komestic')] = 0;
    }
}

pxl_add_custom_widget(
    array(
        'name' => 'pxl_contact_form7',
        'title' => esc_html__('Case Contact Form7', 'komestic'),
        'icon' => 'eicon-form-horizontal',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'tab_primary_content',
                    'label' => esc_html__('Contact Form', 'komestic'),
                    'tab' => 'content',
                    'controls' => array(
                        array(
                            'name' => 'cf7_id',
                            'label' => esc_html__('Choose Form', 'komestic'),
                            'type' => 'select',
                            'options' => $contact_forms,
                            'default' => '0',
                        ),
                        array(
                            'name' => 'submit_with_button_widget',
                            'label' => esc_html__('Submit with Button Widget', 'komestic'),
                            'type' => 'switcher',
                            'separator' => 'before',
                            'default' => '',
                        ),
                        array(
                            'name' => 'form_id',
                            'label' => esc_html__('Form ID', 'komestic'),
                            'type' => 'text',
                            'condition' => [
                                'submit_with_button_widget!' => '',
                            ],
                        ),

                    ),
                ),
                array(
                    'name' => 'tab_secondary_content',
                    'label' => esc_html__('Addtional Options', 'komestic'),
                    'tab' => 'content',
                    'controls' => array(
                        array(
                            'name' => 'spacing_inline',
                            'label' => esc_html__('Spacing Inline', 'komestic'),
                            'type' => 'slider',
                            'size_units' => ['px', 'custom'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-contact-form7 form.wpcf7-form' => '--pxl-spacing-inline: {{SIZE}}{{UNIT}};'
                            ],
                        ),
                        array(
                            'name' => 'spacing_block',
                            'label' => esc_html__('Spacing Block', 'komestic'),
                            'type' => 'slider',
                            'size_units' => ['px', 'custom'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-contact-form7 form.wpcf7-form' => '--pxl-spacing-block: {{SIZE}}{{UNIT}};'
                            ],
                        ),
                        array(
                            'name' => 'field_columns',
                            'label' => esc_html__('Columns', 'komestic' ),
                            'type' => 'select',
                            'control_type' => 'responsive',
                            'separator' => 'before',
                            'options' => [
                                ''     => esc_html__('Default', 'komestic'),
                                '100%' => '1',
                                '50%'  => '2',
                                '33.33333%' => '3',
                                '25%'  => '4',
                                '20%' => '5',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-contact-form7 form.wpcf7-form .pxl-form-control' => 'flex: 0 1 {{VALUE}};',
                            ],
                        ),
                    ),
                ),

                array(
                    'name' => 'tab_input_style',
                    'label' => esc_html__('Input Field', 'komestic'),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'textarea_resize',
                            'label' => esc_html__('Textarea Resize', 'komestic'),
                            'type' => 'select',
                            'options' => [
                                '' => esc_html__('Default', 'komestic'),
                                'both' => esc_html__('Both', 'komestic'),
                                'horizontal' => esc_html__('Horizontal', 'komestic'),
                                'vertical' => esc_html__('Vertical', 'komestic'),
                                'none' => esc_html__('None', 'komestic'),
                            ],
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-contact-form7 form.wpcf7-form textarea' => "resize: {{VALUE}};",
                            ],
                        ),
                        array(
                            'name' => 'textarea_height',
                            'label' => esc_html__('Textarea Height', 'komestic'),
                            'type' => 'slider',
                            'size_units' => ['px', '%', 'custom'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-contact-form7 form.wpcf7-form textarea' => "height: {{SIZE}}{{UNIT}};",
                            ],
                        ),
                        array(
                            'name' => 'divider2',
                            'type' => 'divider',
                        ),
                        array(
                            'name' => 'input_height',
                            'label' => esc_html__('Field Height', 'komestic' ),
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
                                '{{WRAPPER}} .pxl-contact-form7 form.wpcf7-form input:not([type="submit"])' => 'line-height: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'input_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-contact-form7 form.wpcf7-form input:not([type="submit"]), 
                            {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form textarea, 
                            {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form .pxl-select-higthlight',
                        ),
                        array(
                            'name' => 'input_controls',
                            'control_type' => 'tab',
                            'tabs' => [
                                [
                                    'name' => 'input_normal',
                                    'label' => esc_html__('Normal', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [  
                                        array(
                                            'name' => 'input_color',
                                            'label' => esc_html__('Text Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-contact-form7 form.wpcf7-form input:not([type="submit"]), 
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form textarea, 
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form .pxl-select-higthlight,
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form select' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'input_background',
                                            'type' => \Elementor\Group_Control_Background::get_type(),
                                            'control_type' => 'group',
                                            'types' => [ 'classic', 'gradient' ],
                                            'selector' => '{{WRAPPER}} .pxl-contact-form7 form.wpcf7-form input:not([type="submit"]), 
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form textarea, 
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form .pxl-select-higthlight,
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form select',
                                        ),
                                        array(
                                            'name' => 'input_border',
                                            'type' => \Elementor\Group_Control_Border::get_type(),
                                            'separator' => 'before',
                                            'control_type' => 'group', 
                                            'selector' => '{{WRAPPER}} .pxl-contact-form7 form.wpcf7-form input:not([type="submit"]), 
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form textarea, 
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form .pxl-select-higthlight,
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form select',
                                        ),
                                        array(
                                            'name'         => 'input_box_shadow',
                                            'label' => esc_html__( 'Box Shadow', 'komestic' ),
                                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                            'control_type' => 'group',
                                            'selector'     => '{{WRAPPER}} .pxl-contact-form7 form.wpcf7-form input:not([type="submit"]), 
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form textarea, 
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form .pxl-select-higthlight,
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form select',
                                        ),
                                        array(
                                            'name' => 'input_border_radius',
                                            'label' => esc_html__('Border Radius', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', '%', 'custom' ],
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-contact-form7 form.wpcf7-form input:not([type="submit"]), 
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form textarea, 
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form .pxl-select-higthlight,
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form select' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'input_padding',
                                            'label' => esc_html__('Padding', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', '%', 'custom' ],
                                            'control_type' => 'responsive',
                                            'separator' => 'before',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-contact-form7 form.wpcf7-form input:not([type="submit"]), 
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form textarea, 
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form .pxl-select-higthlight,
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form select' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                    ],
                                ],
                                [
                                    'name' => 'input_focus',
                                    'label' => esc_html__('Focus/Hover', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [
                                        array(
                                            'name' => 'input_focus_color',
                                            'label' => esc_html__('Text Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-contact-form7 form.wpcf7-form input:not([type="submit"]):focus,
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form input:hover,
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form textarea:focus, 
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form textarea:hover, 
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form .pxl-select-higthlight:focus,
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form .pxl-select-higthlight:hover,
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form select:focus,
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form select:hover' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'input_focus_bg',
                                            'label' => esc_html__('Background Color', 'komestic' ),
                                            'type' => \Elementor\Group_Control_Background::get_type(),
                                            'control_type' => 'group',
                                            'types' => [ 'classic', 'gradient' ],
                                            'selector' => '{{WRAPPER}} .pxl-contact-form7 form.wpcf7-form input:not([type="submit"]):focus,
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form input:hover,
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form textarea:focus, 
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form textarea:hover, 
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form .pxl-select-higthlight:focus,
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form .pxl-select-higthlight:hover,
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form select:focus,
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form select:hover',
                                        ),
                                        array(
                                            'name'         => 'input_focus_box_shadow',
                                            'label' => esc_html__( 'Box Shadow', 'komestic' ),
                                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                            'control_type' => 'group',
                                            'selector'     => '{{WRAPPER}} .pxl-contact-form7 form.wpcf7-form input:not([type="submit"]):focus,
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form input:hover,
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form textarea:focus, 
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form textarea:hover, 
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form .pxl-select-higthlight:focus,
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form .pxl-select-higthlight:hover,
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form select:focus,
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form select:hover',
                                            'separator' => 'before',
                                        ),
                                        array(
                                            'name' => 'input_focus_border',
                                            'type' => \Elementor\Group_Control_Border::get_type(),
                                            'separator' => 'before',
                                            'control_type' => 'group', 
                                            'selector' => '{{WRAPPER}} .pxl-contact-form7 form.wpcf7-form input:not([type="submit"]):focus,
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form input:hover,
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form textarea:focus, 
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form textarea:hover, 
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form .pxl-select-higthlight:focus,
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form .pxl-select-higthlight:hover,
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form select:focus,
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form select:hover',
                                        ),
                                        array(
                                            'name' => 'input_focus_border_radius',
                                            'label' => esc_html__('Border Radius', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', '%', 'custom' ],
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-contact-form7 form.wpcf7-form input:not([type="submit"]):focus,
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form input:hover,
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form textarea:focus, 
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form textarea:hover, 
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form .pxl-select-higthlight:focus,
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form .pxl-select-higthlight:hover, 
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form select:focus,
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form select:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'input_focus_padding',
                                            'label' => esc_html__('Padding', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', '%' ],
                                            'control_type' => 'responsive',
                                            'separator' => 'before',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-contact-form7 form.wpcf7-form input:not([type="submit"]):focus,
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form input:hover,
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form textarea:focus, 
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form textarea:hover, 
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form .pxl-select-higthlight:focus,
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form .pxl-select-higthlight:hover,
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form select:focus,
                                                {{WRAPPER}} .pxl-contact-form7 form.wpcf7-form select:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                    ],
                                ],
                            ],
                        ),
                    ),
                ),

                array(
                    'name' => 'tab_submit_style',
                    'label' => esc_html__('Button Submit', 'komestic' ),
                    'tab' => 'style',
                    'condition' => [
                        'submit_with_button_widget!' => '',
                    ],
                    'controls' => array_merge(
                        komestic_size_options([
                            'prefix' => 'btn',
                            'selectors' => '{{WRAPPER}} .pxl-contact-form7 form.wpcf7-form .wpcf7-submit',
                            'type' => 'basic',
                            'label' => 'Button Sizes',
                        ]),
                        array(
                            array(
                                'name' => 'btn_typography',
                                'type' => \Elementor\Group_Control_Typography::get_type(),
                                'control_type' => 'group',
                                'separator' => 'before',
                                'selector' => '{{WRAPPER}} .pxl-contact-form7 form.wpcf7-form .wpcf7-submit',
                            ),
                            array(
                                'name' => 'btn_controls',
                                'control_type' => 'tab',
                                'tabs' => [
                                    [
                                        'name' => 'btn_normal',
                                        'label' => esc_html__('Normal', 'komestic' ),
                                        'type' => 'tab',
                                        'controls' => [  
                                            array(
                                                'name' => 'btn_color',
                                                'label' => esc_html__('Text Color', 'komestic' ),
                                                'type' => 'color',
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-contact-form7 form.wpcf7-form .wpcf7-submit' => 'color: {{VALUE}};',
                                                ],
                                            ),

                                            array(
                                                'name' => 'btn_background',
                                                'type' => \Elementor\Group_Control_Background::get_type(),
                                                'control_type' => 'group',
                                                'types' => [ 'classic', 'gradient' ],
                                                'selector' => '{{WRAPPER}} .pxl-contact-form7 form.wpcf7-form .wpcf7-submit',
                                            ),
                                            array(
                                                'name' => 'btn_border',
                                                'type' => \Elementor\Group_Control_Border::get_type(),
                                                'separator' => 'before',
                                                'control_type' => 'group', 
                                                'selector' => '{{WRAPPER}} .pxl-contact-form7 form.wpcf7-form .wpcf7-submit',
                                            ),
                                            array(
                                                'name'         => 'btn_box_shadow',
                                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                                'control_type' => 'group',
                                                'selector'     => '{{WRAPPER}} .pxl-contact-form7 form.wpcf7-form .wpcf7-submit',
                                            ),
                                            array(
                                                'name' => 'btn_border_radius',
                                                'label' => esc_html__('Border Radius', 'komestic' ),
                                                'type' => 'dimensions',
                                                'size_units' => [ 'px', '%', 'custom' ],
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-contact-form7 form.wpcf7-form .wpcf7-submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'btn_padding',
                                                'label' => esc_html__('Padding', 'komestic' ),
                                                'type' => 'dimensions',
                                                'size_units' => [ 'px', 'custom' ],
                                                'control_type' => 'responsive',
                                                'separator' => 'before',
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-contact-form7 form.wpcf7-form .wpcf7-submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                                ],
                                            ),
                                        ],
                                    ],
                                    [
                                        'name' => 'btn_hover',
                                        'label' => esc_html__('Hover', 'komestic' ),
                                        'type' => 'tab',
                                        'controls' => [
                                            array(
                                                'name' => 'btn_hover_color',
                                                'label' => esc_html__('Text Color', 'komestic' ),
                                                'type' => 'color',
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-contact-form7 form.wpcf7-form .wpcf7-submit:hover' => 'color: {{VALUE}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'btn_hover_background',
                                                'type' => \Elementor\Group_Control_Background::get_type(),
                                                'control_type' => 'group',
                                                'types' => [ 'classic' ],
                                                'selector' => '{{WRAPPER}} .pxl-contact-form7 form.wpcf7-form .wpcf7-submit:hover',
                                            ),
                                            array(
                                                'name' => '_btn_hover_border_color',
                                                'label' => esc_html__('Border Color', 'komestic' ),
                                                'type' => 'color',
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-contact-form7 form.wpcf7-form .wpcf7-submit' => 'border-color: {{VALUE}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'btn_hover_border',
                                                'type' => \Elementor\Group_Control_Border::get_type(),
                                                'control_type' => 'group', 
                                                'selector' => '{{WRAPPER}} .pxl-contact-form7 form.wpcf7-form .wpcf7-submit:hover',
                                            ),
                                            array(
                                                'name'         => 'btn_hover_box_shadow',
                                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                                'control_type' => 'group',
                                                'selector'     => '{{WRAPPER}} .pxl-contact-form7 form.wpcf7-form .wpcf7-submit:hover',
                                            ),
                                            array(
                                                'name' => 'btn_hover_border_radius',
                                                'label' => esc_html__('Border Radius', 'komestic' ),
                                                'type' => 'dimensions',
                                                'size_units' => [ 'px', '%', 'custom' ],
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-contact-form7 form.wpcf7-form .wpcf7-submit:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'btn_hover_padding',
                                                'label' => esc_html__('Padding', 'komestic' ),
                                                'type' => 'dimensions',
                                                'size_units' => [ 'px', 'custom' ],
                                                'control_type' => 'responsive',
                                                'separator' => 'before',
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-contact-form7 form.wpcf7-form .wpcf7-submit:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    'name' => 'tab_message_style',
                    'tab' => 'style',
                    'label' => esc_html__('Message', 'komestic'),
                    'controls' => array(
                        array(
                            'name' => 'message_controls',
                            'control_type' => 'tab',
                            'tabs' => [
                                [
                                    'name' => 'valid_normal',
                                    'label' => esc_html__('Valid Error', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [  
                                        array(
                                            'name' => 'valid_typography',
                                            'type' => \Elementor\Group_Control_Typography::get_type(),
                                            'control_type' => 'group',
                                            'separator' => 'before',
                                            'selector' => '{{WRAPPER}} .pxl-contact-form7 form.wpcf7-form .wpcf7-not-valid-tip',
                                        ),
                                        array(
                                            'name' => 'valid_color',
                                            'label' => esc_html__('Text Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-contact-form7 form.wpcf7-form .wpcf7-not-valid-tip' => 'color: {{VALUE}};',
                                            ],
                                        ),

                                        array(
                                            'name' => 'valid_background',
                                            'type' => \Elementor\Group_Control_Background::get_type(),
                                            'control_type' => 'group',
                                            'types' => [ 'classic', 'gradient' ],
                                            'selector' => '{{WRAPPER}} .pxl-contact-form7 form.wpcf7-form .wpcf7-not-valid-tip',
                                        ),
                                        array(
                                            'name' => 'valid_border',
                                            'type' => \Elementor\Group_Control_Border::get_type(),
                                            'separator' => 'before',
                                            'control_type' => 'group', 
                                            'selector' => '{{WRAPPER}} .pxl-contact-form7 form.wpcf7-form .wpcf7-not-valid-tip',
                                        ),
                                        array(
                                            'name'         => 'valid_box_shadow',
                                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                            'control_type' => 'group',
                                            'selector'     => '{{WRAPPER}} .pxl-contact-form7 form.wpcf7-form .wpcf7-not-valid-tip',
                                        ),
                                        array(
                                            'name' => 'valid_border_radius',
                                            'label' => esc_html__('Border Radius', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', '%', 'custom' ],
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-contact-form7 form.wpcf7-form .wpcf7-not-valid-tip' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'valid_padding',
                                            'label' => esc_html__('Padding', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', 'custom' ],
                                            'control_type' => 'responsive',
                                            'separator' => 'before',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-contact-form7 form.wpcf7-form .wpcf7-not-valid-tip' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'valid_margin',
                                            'label' => esc_html__('Margin', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', 'custom' ],
                                            'control_type' => 'responsive',
                                            'separator' => 'before',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-contact-form7 form.wpcf7-form .wpcf7-not-valid-tip' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                    ],
                                ],
                                [
                                    'name' => 'message_normal',
                                    'label' => esc_html__('Message', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [
                                        array(
                                            'name' => 'message_typography',
                                            'type' => \Elementor\Group_Control_Typography::get_type(),
                                            'control_type' => 'group',
                                            'separator' => 'before',
                                            'selector' => '{{WRAPPER}} .pxl-contact-form7 form.wpcf7-form .wpcf7-response-output',
                                        ),
                                        array(
                                            'name' => 'message_color',
                                            'label' => esc_html__('Text Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-contact-form7 form.wpcf7-form .wpcf7-response-output' => 'color: {{VALUE}};',
                                            ],
                                        ),

                                        array(
                                            'name' => 'message_background',
                                            'type' => \Elementor\Group_Control_Background::get_type(),
                                            'control_type' => 'group',
                                            'types' => [ 'classic', 'gradient' ],
                                            'selector' => '{{WRAPPER}} .pxl-contact-form7 form.wpcf7-form .wpcf7-response-output',
                                        ),
                                        array(
                                            'name' => 'message_border',
                                            'type' => \Elementor\Group_Control_Border::get_type(),
                                            'separator' => 'before',
                                            'control_type' => 'group', 
                                            'selector' => '{{WRAPPER}} .pxl-contact-form7 form.wpcf7-form .wpcf7-response-output',
                                        ),
                                        array(
                                            'name'         => 'message_box_shadow',
                                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                            'control_type' => 'group',
                                            'selector'     => '{{WRAPPER}} .pxl-contact-form7 form.wpcf7-form .wpcf7-response-output',
                                        ),
                                        array(
                                            'name' => 'message_border_radius',
                                            'label' => esc_html__('Border Radius', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', '%', 'custom' ],
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-contact-form7 form.wpcf7-form .wpcf7-response-output' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'message_padding',
                                            'label' => esc_html__('Padding', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', 'custom' ],
                                            'control_type' => 'responsive',
                                            'separator' => 'before',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-contact-form7 form.wpcf7-form .wpcf7-response-output' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'message_margin',
                                            'label' => esc_html__('Margin', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', 'custom' ],
                                            'control_type' => 'responsive',
                                            'separator' => 'before',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-contact-form7 form.wpcf7-form .wpcf7-response-output' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                    ],
                                ],
                            ],
                        ), 
                    ),
                ),
                array(
                    'name' => 'pxl_motion_effects',
                    'tab' => 'style',
                    'label' => esc_html__('Motion Effects', 'komestic'),
                    'controls' => komestic_get_animation_options([
                        'selectors' => '{{WRAPPER}} .pxl-contact-form-wrapper',
                    ]),
                ),
                elementor_tab_advanced_custom(),

            ),
        ),
    ),
    komestic_get_class_widget_path()
);