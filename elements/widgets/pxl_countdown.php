<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_countdown',
        'title' => esc_html__('Case Count Down', 'komestic' ),
        'icon' => 'eicon-site-logo',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'tab_primary_content',
                    'label' => esc_html__('Count Timer', 'komestic' ),
                    'tab' => 'content',
                    'controls' => array(
                        array(
                            'name' => 'layout_style',
                            'label' => esc_html__('Layout Style', 'komestic'),
                            'type' => 'select',
                            'options' => [
                                '1' => esc_html__('Style 1', 'komestic'),
                                '2' => esc_html__('Style 2', 'komestic'),
                                'custom' => esc_html__('Custom', 'komestic'),
                            ],
                            'default' => '1',
                        ),
                        array(
                            'name' => 'date_time',
                            'label' => esc_html__( 'Date Time', 'komestic' ),
				            'type' => 'date_time',
                        ),
                        array(
                            'name' => 'day_unit',
                            'label' => esc_html__( 'Day Unit', 'komestic' ),
                            'type' => 'text',
                            'default' => 'Days',
                        ),
                        array(
                            'name' => 'hours_unit',
                            'label' => esc_html__( 'Hours Unit', 'komestic' ),
                            'type' => 'text',
                            'default' => 'Hours',
                        ),
                        array(
                            'name' => 'minute_unit',
                            'label' => esc_html__( 'Minute Unit', 'komestic' ),
                            'type' => 'text',
                            'default' => 'Minutes',
                        ),
                        array(
                            'name' => 'second_unit',
                            'label' => esc_html__( 'Second Unit', 'komestic' ),
                            'type' => 'text',
                            'default' => 'Seconds',
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_general_style',
                    'label' => esc_html__('General', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'flex_wrap',
                            'label' => esc_html__('Wrap', 'komestic' ),
                            'type' => 'choose',
                            'options' => [
                                'nowrap' => [
                                    'title' => esc_html__('Nowrap', 'komestic'),
                                    'icon'  => 'eicon-nowrap'
                                ],
                                'wrap' => [
                                    'title' => esc_html__('Wrap', 'komestic'),
                                    'icon'  => 'eicon-wrap'
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-countdown' => 'flex-wrap: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'justify-content',
                            'label' => esc_html__('Justify Content', 'komestic' ),
                            'type' => 'choose',
                            'control_type' => 'responsive',
                            'options' => [
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
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-countdown' => 'justify-content: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'align_items_v',
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
                                '{{WRAPPER}} .pxl-countdown' => 'align-items: {{VALUE}};'
                            ],
                        ),
                    ),
                    
                ),
                array(
                    'name' => 'tab_timer_style',
                    'label' => esc_html__('Timer', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'title_color',
                            'label' => esc_html__('Text Color', 'komestic' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-countdown .countdown__timer .value' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'title_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-countdown .countdown__timer .value',
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_separator_style',
                    'label' => esc_html__('Separator', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'separator_color',
                            'label' => esc_html__('Text Color', 'komestic' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-countdown .separator' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'separator_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-countdown .separator',
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_unit_style',
                    'label' => esc_html__('Unit', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'unit_color',
                            'label' => esc_html__('Text Color', 'komestic' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-countdown .countdown__timer .unit' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'unit_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-countdown .countdown__timer .unit',
                        ),
                    ),
                ),

                elementor_tab_advanced_custom(),
                elementor_tab_motion_effects(),

                array(
                    'name' => 'pxl_motion_effects',
                    'tab' => 'style',
                    'label' => esc_html__('Motion Effects', 'komestic'),
                    'controls' => komestic_get_animation_options([
                        'selectors' => '{{WRAPPER}} .pxl-countdown',
                    ]),
                ),
            ),
        ),
    ),
    komestic_get_class_widget_path()
);