<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_video_carousel',
        'title' => esc_html__('Case Video Carousel', 'komestic' ),
        'icon' => 'eicon-video',
        'categories' => array('pxltheme-core'),
        'scripts' => [
            'komestic-swiper',
        ],
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'tab_primary_content',
                    'label' => esc_html__('Video', 'komestic' ),
                    'tab' => 'content',
                    'controls' =>  array(
                        array(
                            'name' => 'items',
                            'label' => esc_html__('Items', 'komestic' ),
                            'type' => 'repeater',
                            'controls' => array(
                                array(
                                    'name' => 'src',
                                    'label' => esc_html__('SRC', 'komestic' ),
                                    'type' => 'media',
                                    'media_types' => ['image', 'video'],
                                ),
                                array(
                                    'name'     => 'product_id',
                                    'label'    => esc_html__( 'Product', 'komestic' ),
                                    'type'     => 'select2',
                                    'multiple' => false,
                                    'label_block' => true,
                                    'default' => '',
                                    'options'  => get_all_products_id_name(),
                                ),
                            ),
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_carousel_add_opts',
                    'label' => esc_html__('Additional Options', 'komestic' ),
                    'tab' => 'settings',
                    'controls' => array(
                        swiper_controls_options(),   
                    ),
                ),
                array(
                    'name' => 'pxl_motion_effects',
                    'tab' => 'style',
                    'label' => esc_html__('Motion Effects', 'komestic'),
                    'controls' => komestic_get_animation_options([
                        'selectors' => '{{WRAPPER}} .pxl-swiper .swiper-slide',
                    ]),
                ),
            ),
        ),
    ),
    komestic_get_class_widget_path()
);