<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_product_categories',
        'title' => esc_html__('Case Product Categories', 'komestic'),
        'icon' => 'eicon-product-categories',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'tab_primary_layout',
                    'label' => esc_html__('Layout', 'komestic'),
                    'tab' => 'layout',
                    'controls' => array(
                        array(
                            'name' => 'layout_type',
                            'label' => esc_html__('Layout Type', 'komestic' ),
                            'type' => 'select',
                            'default' => 'grid',
                            'options' => [
                                'grid' => esc_html__('Grid', 'komestic' ),
                                'carousel' => esc_html__('Carousel', 'komestic' ),
                            ],
                            'condition' => [
                                // 'layout' => [],
                            ],
                        ),
                        array(
                            'name' => 'layout2_style',
                            'label' => esc_html__('Layout Style', 'komestic' ),
                            'type' => 'select',
                            'default' => '1',
                            'options' => [
                                '1' => '1',
                                '2' => '2',
                            ],
                            'condition' => [
                                'layout' => '2',
                            ],
                        ),
                        array(
                            'name' => 'layout',
                            'label' => esc_html__('Layout', 'komestic'),
                            'type' => 'layoutcontrol',
                            'default' => '1',
                            'options' => array(
                                '1' => array(
                                    'label' => esc_html__('Default', 'komestic'),
                                    'image' => get_template_directory_uri() . '/elements/assets/img-layouts/testimonial-1.webp',
                                ),
                                '2' => array(
                                    'label' => esc_html__('Layout 2', 'komestic'),
                                    'image' => get_template_directory_uri() . '/elements/assets/img-layouts/testimonial-1.webp',
                                ),
                            ),
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_source_content',
                    'label' => esc_html__('Source', 'komestic' ),
                    'tab' => 'content',
                    'controls' => array (
                        array(
                            'name'     => 'include_ids',
                            'label'    => esc_html__( 'Select Term of Product', 'komestic' ),
                            'type'     => 'select2',
                            'multiple' => true,
                            'options'  => komestic_get_term_options('product', ['product_cat']),
                        ),
                        array(
                            'name' => 'orderby',
                            'label' => esc_html__('Order By', 'komestic' ),
                            'type' => 'select',
                            'default' => 'date',
                            'options' => [
                                'date' => esc_html__('Date', 'komestic' ),
                                'ID' => esc_html__('ID', 'komestic' ),
                                'author' => esc_html__('Author', 'komestic' ),
                                'title' => esc_html__('Title', 'komestic' ),
                                'rand' => esc_html__('Random', 'komestic' ),
                            ],
                        ),
                        array(
                            'name' => 'order',
                            'label' => esc_html__('Sort Order', 'komestic' ),
                            'type' => 'select',
                            'default' => 'desc',
                            'options' => [
                                'desc' => esc_html__('Descending', 'komestic' ),
                                'asc' => esc_html__('Ascending', 'komestic' ),
                            ],
                        ),
                        array(
                            'name' => 'limit',
                            'label' => esc_html__('View Categories', 'komestic' ),
                            'type' => 'number',
                            'default' => 6,
                        ),
                        array(
                            'name' => 'hide_cat_empty',
                            'label' => esc_html__('Hide Empty', 'komestic' ),
                            'type' => 'switcher',
                            'default' => '',
                        ),            
                    ),
                ),
                array(
                    'name' => 'tab_display_opts',
                    'label' => esc_html__('Display', 'komestic' ),
                    'tab' => 'settings',
                    'controls' => array_merge(
                        komestic_image_dimension_options(),
                        array(
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
                            array(
                                'name' => 'show_count',
                                'label' => esc_html__('Show Count', 'komestic'),
                                'type' => 'switcher',
                                'default' => '',
                            ),
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_grid_add_opts',
                    'label' => esc_html__('Additional Options', 'komestic' ),
                    'tab' => 'settings',
                    'controls' => array(
                        grid_controls_options(),
                    ),
                    'condition' => [
                        'layout_type' => 'grid',
                    ],
                ),
                array(
                    'name' => 'tab_swiper_add_opts',
                    'label' => esc_html__('Additional Options', 'komestic' ),
                    'tab' => 'settings',
                    'controls' => array(
                        swiper_controls_options(),
                    ),
                    'condition' => [
                        'layout_type' => 'carousel',
                    ],
                ),
                array(
                    'name' => 'tab_featured_style',
                    'label' => esc_html__('Featured', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array_merge(
                        komestic_size_options([
                            'prefix' => 'img',
                            'selectors' => '{{WRAPPER}} .pxl-product-categories .category-item__featured',
                            'label' => 'Image Size',
                        ]),
                        array(
                            array(
                                'name' => 'featured_controls',
                                'control_type' => 'tab',
                                'tabs' => [
                                    [
                                        'name' => 'featured_normal',
                                        'label' => esc_html__('Normal', 'komestic' ),
                                        'type' => 'tab',
                                        'controls' => [  
                                            array(
                                                'name' => 'featured_opacity',
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
                                                    '{{WRAPPER}} .pxl-product-categories .category-item__featured img' => 'opacity: {{SIZE}};',
                                                ],
                                            ),
                                            array(
                                                'name'     => 'featured_css_filters',
                                                'type'     => \Elementor\Group_Control_Css_Filter::get_type(),
                                                'control_type' => 'group',
                                                'selector' => '{{WRAPPER}} .pxl-product-categories .category-item__featured img',
                                            ),
                                            array(
                                                'name' => 'featured_border',
                                                'type' => \Elementor\Group_Control_Border::get_type(),
                                                'control_type' => 'group', 
                                                'separator' => 'before',
                                                'selector' => '{{WRAPPER}} .pxl-product-categories .category-item__featured',
                                            ),
                                            array(
                                                'name'         => 'featured_box_shadow',
                                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                                'control_type' => 'group',
                                                'selector'     => '{{WRAPPER}} .pxl-product-categories .category-item__featured',
                                            ),
                                            array(
                                                'name' => 'featured_border_radius',
                                                'label' => esc_html__('Border Radius', 'komestic' ),
                                                'type' => 'dimensions',
                                                'size_units' => [ 'px', '%', 'custom' ],
                                                'control_type' => 'responsive',
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-product-categories .category-item__featured' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                                ],
                                            ),
                                        ],
                                    ],
                                    [
                                        'name' => 'featured_hover',
                                        'label' => esc_html__('Hover', 'komestic' ),
                                        'type' => 'tabs',
                                        'controls' => [
                                            array(
                                                'name' => 'featured_hover_opacity',
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
                                                    '{{WRAPPER}} .pxl-product-categories .category-item__featured:hover img' => 'opacity: {{SIZE}};',
                                                ],
                                            ),
                                            array(
                                                'name'     => 'featured_hover_css_filters',
                                                'type'     => \Elementor\Group_Control_Css_Filter::get_type(),
                                                'control_type' => 'group',
                                                'selector' => '{{WRAPPER}} .pxl-product-categories .category-item__featured:hover img',
                                            ),
                                            array(
                                                'name' => 'featured_hover_border',
                                                'type' => \Elementor\Group_Control_Border::get_type(),
                                                'control_type' => 'group', 
                                                'separator' => 'before',
                                                'selector' => '{{WRAPPER}} .pxl-product-categories .category-item__featured:hover',
                                            ),
                                            array(
                                                'name'         => 'featured_hover_box_shadow',
                                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                                'control_type' => 'group',
                                                'selector'     => '{{WRAPPER}} .pxl-product-categories .category-item__featured:hover',
                                            ),
                                            array(
                                                'name' => 'featured_hover_border_radius',
                                                'label' => esc_html__('Border Radius', 'komestic' ),
                                                'type' => 'dimensions',
                                                'size_units' => [ 'px', '%', 'custom' ],
                                                'control_type' => 'responsive',
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-product-categories .category-item__featured:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                                ],
                                            ),
                                        ],
                                    ],
                                ],
                            ),
                        )
                    ),
                ),
                array(
                    'name' => 'tab_title_style',
                    'label' => esc_html__('Title', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'title_color',
                            'label' => esc_html__('Text Color', 'komestic' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-product-categories .category-item__name .category-item__name-link' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'title_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-product-categories .category-item__name .category-item__name-link',
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
                                                '{{WRAPPER}} .pxl-product-categories .category-item__name .category-item__name-link' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'btn_background',
                                            'type' => \Elementor\Group_Control_Background::get_type(),
                                            'control_type' => 'group',
                                            'types' => [ 'classic', 'gradient' ],
                                            'selector' => '{{WRAPPER}} .pxl-product-categories .category-item__name .category-item__name-link',
                                        ),
                                        array(
                                            'name' => 'btn_border',
                                            'type' => \Elementor\Group_Control_Border::get_type(),
                                            'separator' => 'before',
                                            'control_type' => 'group', 
                                            'selector' => '{{WRAPPER}} .pxl-product-categories .category-item__name .category-item__name-link',
                                        ),
                                        array(
                                            'name'         => 'btn_box_shadow',
                                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                            'control_type' => 'group',
                                            'selector'     => '{{WRAPPER}} .pxl-product-categories .category-item__name .category-item__name-link',
                                        ),
                                        array(
                                            'name' => 'btn_border_radius',
                                            'label' => esc_html__('Border Radius', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', '%', 'custom' ],
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-product-categories .category-item__name .category-item__name-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                                '{{WRAPPER}} .pxl-product-categories .category-item__name .category-item__name-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                            'label' => esc_html__('Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-product-categories .category-item__name .category-item__name-link:hover' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'btn_hover_background',
                                            'type' => \Elementor\Group_Control_Background::get_type(),
                                            'control_type' => 'group',
                                            'types' => [ 'classic' ],
                                            'selector' => '{{WRAPPER}} .pxl-product-categories .category-item__name .category-item__name-link:hover',
                                        ),
                                        array(
                                            'name' => '_btn_hover_border_color',
                                            'label' => esc_html__('Border Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-product-categories .category-item__name .category-item__name-link' => 'border-color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'btn_hover_border',
                                            'type' => \Elementor\Group_Control_Border::get_type(),
                                            'control_type' => 'group', 
                                            'separator' => 'before',
                                            'selector' => '{{WRAPPER}} .pxl-product-categories .category-item__name .category-item__name-link:hover',
                                        ),
                                        array(
                                            'name'         => 'btn_hover_box_shadow',
                                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                            'control_type' => 'group',
                                            'selector'     => '{{WRAPPER}} .pxl-product-categories .category-item__name .category-item__name-link:hover',
                                        ),
                                        array(
                                            'name' => 'btn_hover_border_radius',
                                            'label' => esc_html__('Border Radius', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', '%', 'custom' ],
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-product-categories .category-item__name .category-item__name-link:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                                '{{WRAPPER}} .pxl-product-categories .category-item__name .category-item__name-link:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                    ],
                                ],
                            ],
                        ), 
                    ),
                ),
                array(
                    'name' => 'pxl_moution_effects',
                    'label' => esc_html__('Motion Effects', 'komestic' ),
                    'tab' => 'style',
                    'controls' => komestic_get_animation_options([
                        'selectors' => '{{WRAPPER}} .pxl-swiper .swiper-slide, {{WRAPPER}} .grid .grid__item',
                    ]),
                ),
                elementor_tab_advanced_custom(),
            ),
        ),
    ),
    komestic_get_class_widget_path()
);