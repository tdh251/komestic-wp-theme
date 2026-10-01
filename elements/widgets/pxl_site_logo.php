<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_site_logo',
        'title' => esc_html__('Case Site Logo', 'komestic' ),
        'icon' => 'eicon-site-logo',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'tab_logo_content',
                    'label' => esc_html__('Site Logo', 'komestic' ),
                    'tab' => 'content',
                    'controls' => array_merge(
                        array(
                            array(
                                'name' => 'logo_image',
                                'label' => esc_html__('Logo', 'komestic' ),
                                'type' => 'media',
                            ),
                            array(
                                'name' => 'logo_link',
                                'label' => esc_html__('Link', 'komestic' ),
                                'type' => 'url',
                                'default' => [
                                    'url' => home_url('/'),
                                ],
                            ),
                        ),
                        komestic_size_options([
                            'prefix' => 'logo',
                            'selectors' => '{{WRAPPER}} .pxl-site-logo img',
                            'type' => 'basic',
                            'label' => esc_html__('Logo Sizes', 'komestic'),
                            'separator' => true,
                        ]),
                        array(
                            array(
                                'name' => 'justify_content_row',
                                'label' => esc_html__('Justify Content', 'komestic'),
                                'type' => 'choose',
                                'separator' => 'before',
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
                                    '{{WRAPPER}} .pxl-site-logo' => 'justify-content: {{VALUE}};'
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
                            'selectors' => '{{WRAPPER}} .pxl-site-logo',
                        ]),
                    ),
                ),

                elementor_tab_advanced_custom(),
            ),
        ),
    ),
    komestic_get_class_widget_path()
);