<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_product_page_mini',
        'title' => esc_html__('Case Product Page Mini', 'komestic' ),
        'icon' => 'eicon-product-price',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'tab_display_opts',
                    'label' => esc_html__('Display', 'komestic' ),
                    'tab' => 'content',
                    'controls' => array_merge(
                        komestic_image_dimension_options(),
                        array(
                            array(
                                'name'     => 'product_id',
                                'label'    => esc_html__( 'Product', 'komestic' ),
                                'type'     => 'select2',
                                'multiple' => false,
                                'label_block' => true,
                                'default' => '',
                                'options'  => get_all_products_id_name(),
                            ),
                            array(
                                'name' => 'title_tag',
                                'label' => esc_html__('Title HTML Tag', 'komestic'),
                                'type' => 'select',
                                'seperator' => 'before',
                                'options' => [
                                    ''   => esc_html__('Default', 'komestic'),
                                    'h1' => esc_html__('H1', 'komestic'),
                                    'h2' => esc_html__('H2', 'komestic'),
                                    'h3' => esc_html__('H3', 'komestic'),
                                    'h4' => esc_html__('H4', 'komestic'),
                                    'h5' => esc_html__('H5', 'komestic'),
                                    'h6' => esc_html__('H6', 'komestic'),
                                    'div' => esc_html__('div', 'komestic'),
                                    'p'  => esc_html__('p', 'komestic'),
                                    'span' => esc_html__('span', 'komestic'),
                                ],
                                'default' => '',
                            ),
                        ),
                    ),
                ),
                array(
                    'name' => 'pxl_motion_effects',
                    'tab' => 'style',
                    'label' => esc_html__('Motion Effects', 'komestic'),
                    'controls' => komestic_get_animation_options([
                        'selectors' => '{{WRAPPER}} .product-single-mini',
                    ]),
                ),
            ),
        ),
    ),
    komestic_get_class_widget_path()
);