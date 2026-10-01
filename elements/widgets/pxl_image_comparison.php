<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_image_comparison',
        'title' => esc_html__('Case Image Comparison', 'komestic' ),
        'icon' => 'eicon-image-before-after',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'tab_primary_content',
                    'label' => esc_html__('Image Comparison', 'komestic' ),
                    'tab' => 'content',
                    'controls' => array_merge(
                        array(
                            array(
                                'name' => 'image_before',
                                'label' => esc_html__('Image Before', 'komestic'),
                                'type' => 'media',
                            ),
                            array(
                                'name' => 'image_after',
                                'label' => esc_html__('Image After', 'komestic'),
                                'type' => 'media',
                            ),
                        ),                          
                        komestic_image_dimension_options(),
                    ),
                ),
                array(
                    'name' => 'pxl_motion_effects',
                    'tab' => 'style',
                    'label' => esc_html__('Motion Effects', 'komestic'),
                    'controls' => komestic_get_animation_options([
                        'selectors' => '{{WRAPPER}} .pxl-image-comparison',
                    ]),
                ),
            ),
        ),
    ),
    komestic_get_class_widget_path()
);