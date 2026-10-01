<?php
$post_type = ['product'];
pxl_add_custom_widget(
    array(
        'name' => 'pxl_products_wishlist',
        'title' => esc_html__('Case Products Wishlist', 'komestic' ),
        'icon' => 'eicon-heart',
        'categories' => array('pxltheme-core'),
        'scripts' => [
            'imagesloaded',
            'pxl-post-grid',
            'komestic-swiper',
        ],
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'tab_primary_content',
                    'label' => esc_html__('Display', 'komestic' ),
                    'tab' => 'content',
                    'controls' => array(),
                ),
                array(
                    'name' => 'tab_display_opts',
                    'label' => esc_html__('Display', 'komestic' ),
                    'tab' => 'content',
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
                                'name' => 'is_products_wishlist',
                                'label' => esc_html__('Is Product Wishlist', 'komestic' ),
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
                ),
                array(
                    'name' => 'tab_general_style',
                    'label' => esc_html__('General', 'komestic'),
                    'tab'   => 'style',
                    'controls' => [
                        array(
                            'name' => 'featured_spacing',
                            'label' => esc_html__('Featured Spacing', 'komestic' ),
                            'type' => 'slider',
                            'control_type' => 'responsive',
                            'size_units' => ['px', 'custom'],
                            'range' => [
                                'px' => [
                                    'max' => 1000,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-products[data-layout="1"] .product__featured' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .pxl-products[data-layout="2"] .product' => 'gap: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'categories_spacing',
                            'label' => esc_html__('Categories Spacing', 'komestic' ),
                            'type' => 'slider',
                            'control_type' => 'responsive',
                            'size_units' => ['px', 'custom'],
                            'range' => [
                                'px' => [
                                    'max' => 1000,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-products .product-categories' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'attrs_spacing',
                            'label' => esc_html__('Attributes Spacing', 'komestic' ),
                            'type' => 'slider',
                            'control_type' => 'responsive',
                            'size_units' => ['px', 'custom'],
                            'range' => [
                                'px' => [
                                    'max' => 1000,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-products .product__attributes' => 'margin-top: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'layout' => '1',
                            ],
                        ),
                        array(
                            'name' => 'product_height',
                            'label' => esc_html__('Height', 'komestic' ),
                            'type' => 'slider',
                            'control_type' => 'responsive',
                            'size_units' => ['px', 'custom'],
                            'range' => [
                                'px' => [
                                    'max' => 1000,
                                ],
                            ],
                            'condition' => [
                                'layout' => '2',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-products .product' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                    ],
                ),
                array(
                    'name' => 'tab_block_style',
                    'label' => esc_html__('Block', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'box_controls',
                            'control_type' => 'tab',
                            'tabs' => [
                                [
                                    'name' => 'box_normal',
                                    'label' => esc_html__('Normal', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [  
                                        array(
                                            'name' => 'box_bg',
                                            'type' => \Elementor\Group_Control_Background::get_type(),
                                            'control_type' => 'group',
                                            'types' => [ 'classic', 'gradient' ],
                                            'selector' => '{{WRAPPER}} .pxl-products .pxl-product-item',
                                        ),
                                        array(
                                            'name' => 'box_border',
                                            'type' => \Elementor\Group_Control_Border::get_type(),
                                            'control_type' => 'group', 
                                            'selector' => '{{WRAPPER}} .pxl-products .pxl-product-item',
                                        ),
                                        array(
                                            'name'         => 'box_box_shadow',
                                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                            'control_type' => 'group',
                                            'selector'     => '{{WRAPPER}} .pxl-products .pxl-product-item',
                                        ),
                                        array(
                                            'name' => 'box_border_radius',
                                            'label' => esc_html__('Border Radius', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', '%', 'custom' ],
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-products .pxl-product-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'box_padding',
                                            'label' => esc_html__('Padding', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', '%', 'custom' ],
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-products .pxl-product-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                    ],
                                ],
                                [
                                    'name' => 'box_hover',
                                    'label' => esc_html__('Hover', 'komestic' ),
                                    'type' => 'tabs',
                                    'controls' => [
                                        array(
                                            'name' => 'box_hover_bg',
                                            'type' => \Elementor\Group_Control_Background::get_type(),
                                            'control_type' => 'group',
                                            'types' => [ 'classic', 'gradient' ],
                                            'selector' => '{{WRAPPER}} .pxl-products .pxl-product-item:hover',
                                        ),
                                        array(
                                            'name'      => '_box_hover_border_color',
                                            'label'     => esc_html__('Border Color', 'komestic' ),
                                            'type'      => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-products .pxl-product-item:hover' => 'border-color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'box_hover_border',
                                            'type' => \Elementor\Group_Control_Border::get_type(),
                                            'separator' => 'before',
                                            'control_type' => 'group', 
                                            'selector' => '{{WRAPPER}} .pxl-products .pxl-product-item:hover',
                                        ),
                                        array(
                                            'name'         => 'box_hover_box_shadow',
                                            'label' => esc_html__( 'Box Shadow', 'komestic' ),
                                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                            'control_type' => 'group',
                                            'selector'     => '{{WRAPPER}} .pxl-products .pxl-product-item:hover',
                                        ),
                                        array(
                                            'name' => 'box_hover_border_radius',
                                            'label' => esc_html__('Border Radius', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', '%', 'custom' ],
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-products .pxl-product-item:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'box_hover_padding',
                                            'label' => esc_html__('Padding', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', '%', 'custom' ],
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-products .pxl-product-item:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                    ],
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_featured_style',
                    'label' => esc_html__('Product Featured', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array_merge(
                        komestic_size_options([
                            'prefix' => 'featured',
                            'selectors' => '{{WRAPPER}} .pxl-products .product__featured img',
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
                                                    '{{WRAPPER}} .product-suggested .product__featured img' => 'opacity: {{SIZE}};',
                                                ],
                                            ),
                                            array(
                                                'name'     => 'featured_css_filters',
                                                'type'     => \Elementor\Group_Control_Css_Filter::get_type(),
                                                'control_type' => 'group',
                                                'selector' => '{{WRAPPER}} .product-suggested .product__featured img',
                                            ),
                                            array(
                                                'name' => 'featured_border',
                                                'type' => \Elementor\Group_Control_Border::get_type(),
                                                'control_type' => 'group', 
                                                'separator' => 'before',
                                                'selector' => '{{WRAPPER}} .product-suggested .product__featured',
                                            ),
                                            array(
                                                'name'         => 'featured_box_shadow',
                                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                                'control_type' => 'group',
                                                'selector'     => '{{WRAPPER}} .product-suggested .product__featured',
                                            ),
                                            array(
                                                'name' => 'featured_border_radius',
                                                'label' => esc_html__('Border Radius', 'komestic' ),
                                                'type' => 'dimensions',
                                                'size_units' => [ 'px', '%', 'custom' ],
                                                'control_type' => 'responsive',
                                                'selectors' => [
                                                    '{{WRAPPER}} .product-suggested .product__featured' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                                    '{{WRAPPER}} .product-suggested .product:hover .product__featured img' => 'opacity: {{SIZE}};',
                                                ],
                                            ),
                                            array(
                                                'name'     => 'featured_hover_css_filters',
                                                'type'     => \Elementor\Group_Control_Css_Filter::get_type(),
                                                'control_type' => 'group',
                                                'selector' => '{{WRAPPER}} .product-suggested .product:hover .product__featured img',
                                            ),
                                            array(
                                                'name' => 'featured_hover_border',
                                                'type' => \Elementor\Group_Control_Border::get_type(),
                                                'control_type' => 'group', 
                                                'separator' => 'before',
                                                'selector' => '{{WRAPPER}} .product-suggested .product:hover .product__featured',
                                            ),
                                            array(
                                                'name'         => 'featured_hover_box_shadow',
                                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                                'control_type' => 'group',
                                                'selector'     => '{{WRAPPER}} .product-suggested .product:hover .product__featured',
                                            ),
                                            array(
                                                'name' => 'featured_hover_border_radius',
                                                'label' => esc_html__('Border Radius', 'komestic' ),
                                                'type' => 'dimensions',
                                                'size_units' => [ 'px', '%', 'custom' ],
                                                'control_type' => 'responsive',
                                                'selectors' => [
                                                    '{{WRAPPER}} .product-suggested .product:hover .product__featured' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    'name' => 'tab_name_style',
                    'label' => esc_html__('Product Name', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'title_controls',
                            'control_type' => 'tab',
                            'tabs' => [
                                [
                                    'name' => 'title_normal',
                                    'label' => esc_html__('Normal', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [  
                                        array(
                                            'name' => 'title_color',
                                            'label' => esc_html__('Text Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-products .product__name a' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'title_typography',
                                            'type' => \Elementor\Group_Control_Typography::get_type(),
                                            'control_type' => 'group',
                                            'selector' => '{{WRAPPER}} .pxl-products .product__name',
                                        ),
                                    ],
                                ],
                                [
                                    'name' => 'title_hover',
                                    'label' => esc_html__('Hover', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [
                                        array(
                                            'name' => 'title_hover_style',
                                            'label' => esc_html__('Hover Style', 'komestic' ),
                                            'type' => 'select',
                                            'groups' => [
                                                [
                                                    'label' => esc_html__('Default', 'komestic'),
                                                    'options' => [
                                                        'hover-text-default' => esc_html__('Default', 'komestic'),
                                                    ],
                                                ],
                                                [
                                                    'label' => esc_html__('Underline', 'komestic'),
                                                    'options' => [
                                                        'hover-text-underline' => esc_html__('Underline', 'komestic'),
                                                        'hover-text-underline--slide-ltr' => esc_html__('Slide LTR', 'komestic'),
                                                        'hover-text-underline--slide-rtl' => esc_html__('Slide RTL', 'komestic'),
                                                    ],
                                                ],
                                            ],
                                            'default' => 'hover-text-default',
                                        ),
                                        array(
                                            'name' => 'title_underline_h',
                                            'label' => esc_html__('Underline Weight(px)', 'komestic'),
                                            'type' => 'slider',
                                            'size_units' => ['px'],
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-products .pxl-product-item .product__name' => "--pxl-height: {{SIZE}}{{UNIT}};",
                                            ],
                                            'condition' => [
                                                'title_hover_style' => ['hover-text-underline', 'hover-text-underline--slide-ltr', 'hover-text-underline--slide-rtl'],
                                            ],
                                        ),
                                        array(
                                            'name' => 'title_divider',
                                            'type' => 'divider',
                                        ),
                                        array(
                                            'name' => 'title_hover_color',
                                            'label' => esc_html__('Text Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-products .product__name:hover' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                    ],
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_category_style',
                    'label' => esc_html__('Product Category', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'cat_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-products .product-categories a',
                        ),
                        array(
                            'name' => 'cat_color',
                            'label' => esc_html__('Color', 'komestic' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-products .product-categories a' => 'color: {{VALUE}};',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_price_style',
                    'label' => esc_html__('Product Price', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'price_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-products .product__price .price',
                        ),
                        array(
                            'name' => 'price_color',
                            'label' => esc_html__('Color', 'komestic' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-products .product__price .price, 
                                {{WRAPPER}} .pxl-products .product__price .price--normal' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'price_controls',
                            'control_type' => 'tab',
                            'tabs' => [
                                [
                                    'name' => 'price_sale',
                                    'label' => esc_html__('Sale', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [  
                                        array(
                                            'name' => 'price_ins_color',
                                            'label' => esc_html__('Text Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-products .product__price .price .price--sale' => 'color: {{VALUE}} !important;',
                                            ],
                                        ),
                                        array(
                                            'name' => 'price_ins_typography',
                                            'type' => \Elementor\Group_Control_Typography::get_type(),
                                            'control_type' => 'group',
                                            'selector' => '{{WRAPPER}} .pxl-products .product__price .price .price--sale',
                                        ),
                                    ],
                                ],
                                [
                                    'name' => 'price_old',
                                    'label' => esc_html__('Old', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [  
                                        array(
                                            'name' => 'price_del_color',
                                            'label' => esc_html__('Text Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-products .product__price .price .price--old' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'price_del_typography',
                                            'type' => \Elementor\Group_Control_Typography::get_type(),
                                            'control_type' => 'group',
                                            'selector' => '{{WRAPPER}} .pxl-products .product__price .price .price--old',
                                        ),
                                    ],
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_label_style',
                    'label' => esc_html__('Product Label', 'komestic'),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'label_controls',
                            'control_type' => 'tab',
                            'tabs' => [
                                [
                                    'name' => 'label_sale',
                                    'label' => esc_html__('Sale', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [  
                                        array(
                                            'name' => 'label_sale_typography',
                                            'type' => \Elementor\Group_Control_Typography::get_type(),
                                            'control_type' => 'group',
                                            'selector' => '{{WRAPPER}} .pxl-products .product__label .product-label--onsale',
                                        ),
                                        array(
                                            'name' => 'label_sale_color',
                                            'label' => esc_html__('Text Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-products .product__label .product-label--onsale' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'label_sale_background',
                                            'type' => \Elementor\Group_Control_Background::get_type(),
                                            'control_type' => 'group',
                                            'types' => [ 'classic', 'gradient' ],
                                            'selector' => '{{WRAPPER}} .pxl-products .product__label .product-label--onsale',
                                        ),
                                        array(
                                            'name' => 'label_sale_border',
                                            'type' => \Elementor\Group_Control_Border::get_type(),
                                            'separator' => 'before',
                                            'control_type' => 'group', 
                                            'selector' => '{{WRAPPER}} .pxl-products .product__label .product-label--onsale',
                                        ),
                                        array(
                                            'name'         => 'label_sale_box_shadow',
                                            'label' => esc_html__( 'Box Shadow', 'komestic' ),
                                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                            'control_type' => 'group',
                                            'selector'     => '{{WRAPPER}} .pxl-products .product__label .product-label--onsale',
                                        ),
                                        array(
                                            'name' => 'label_sale_border_radius',
                                            'label' => esc_html__('Border Radius', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', 'custom' ],
                                            'control_type' => 'responsive',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-products .product__label .product-label--onsale' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'label_sale_padding',
                                            'label' => esc_html__('Padding', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', 'custom' ],
                                            'control_type' => 'responsive',
                                            'separator' => 'before',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-products .product__label .product-label--onsale' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                    ],
                                ],
                                [
                                    'name' => 'label_new',
                                    'label' => esc_html__('New', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [  
                                        array(
                                            'name' => 'label_new_typography',
                                            'type' => \Elementor\Group_Control_Typography::get_type(),
                                            'control_type' => 'group',
                                            'selector' => '{{WRAPPER}} .pxl-products .product__label .product-label--new',
                                        ),
                                        array(
                                            'name' => 'label_new_color',
                                            'label' => esc_html__('Text Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-products .product__label .product-label--new' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'label_new_background',
                                            'type' => \Elementor\Group_Control_Background::get_type(),
                                            'control_type' => 'group',
                                            'types' => [ 'classic', 'gradient' ],
                                            'selector' => '{{WRAPPER}} .pxl-products .product__label .product-label--new',
                                        ),
                                        array(
                                            'name' => 'label_new_border',
                                            'type' => \Elementor\Group_Control_Border::get_type(),
                                            'separator' => 'before',
                                            'control_type' => 'group', 
                                            'selector' => '{{WRAPPER}} .pxl-products .product__label .product-label--new',
                                        ),
                                        array(
                                            'name'         => 'label_new_box_shadow',
                                            'label' => esc_html__( 'Box Shadow', 'komestic' ),
                                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                            'control_type' => 'group',
                                            'selector'     => '{{WRAPPER}} .pxl-products .product__label .product-label--new',
                                        ),
                                        array(
                                            'name' => 'label_new_border_radius',
                                            'label' => esc_html__('Border Radius', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', 'custom' ],
                                            'control_type' => 'responsive',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-products .product__label .product-label--new' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'label_new_padding',
                                            'label' => esc_html__('Padding', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', 'custom' ],
                                            'control_type' => 'responsive',
                                            'separator' => 'before',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-products .product__label .product-label--new' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                    ],
                                ],
                                [
                                    'name' => 'label_trending',
                                    'label' => esc_html__('Trending', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [  
                                        array(
                                            'name' => 'label_trending_typography',
                                            'type' => \Elementor\Group_Control_Typography::get_type(),
                                            'control_type' => 'group',
                                            'selector' => '{{WRAPPER}} .pxl-products .product__label .product-label--trending',
                                        ),
                                        array(
                                            'name' => 'label_trending_color',
                                            'label' => esc_html__('Text Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-products .product__label .product-label--trending' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'label_trending_background',
                                            'type' => \Elementor\Group_Control_Background::get_type(),
                                            'control_type' => 'group',
                                            'types' => [ 'classic', 'gradient' ],
                                            'selector' => '{{WRAPPER}} .pxl-products .product__label .product-label--trending',
                                        ),
                                        array(
                                            'name' => 'label_trending_border',
                                            'type' => \Elementor\Group_Control_Border::get_type(),
                                            'separator' => 'before',
                                            'control_type' => 'group', 
                                            'selector' => '{{WRAPPER}} .pxl-products .product__label .product-label--trending',
                                        ),
                                        array(
                                            'name'         => 'label_trending_box_shadow',
                                            'label' => esc_html__( 'Box Shadow', 'komestic' ),
                                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                            'control_type' => 'group',
                                            'selector'     => '{{WRAPPER}} .pxl-products .product__label .product-label--trending',
                                        ),
                                        array(
                                            'name' => 'label_trending_border_radius',
                                            'label' => esc_html__('Border Radius', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', 'custom' ],
                                            'control_type' => 'responsive',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-products .product__label .product-label--trending' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'label_trending_padding',
                                            'label' => esc_html__('Padding', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', 'custom' ],
                                            'control_type' => 'responsive',
                                            'separator' => 'before',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-products .product__label .product-label--trending' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                    ],
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_button_style',
                    'label' => esc_html__('Product Button', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array_merge(
                        array(
                            array(
                                'name' => 'btn_h',
                                'label' => esc_html__('Height', 'komestic' ),
                                'type' => 'slider',
                                'size_units' => ['px', 'custom'],
                                'control_type' => 'responsive',
                                'range' => [
                                    'px' => [
                                        'min' => 0,
                                        'max' => 1000,
                                    ],
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-products .product .product__actions .button--shop-action' => 'height: {{SIZE}}{{UNIT}};',
                                ],
                            ),
                            array(
                                'name' => 'btn_box_size',
                                'label' => esc_html__('Box Size', 'komestic' ),
                                'type' => 'slider',
                                'size_units' => ['px', 'custom'],
                                'control_type' => 'responsive',
                                'range' => [
                                    'px' => [
                                        'min' => 0,
                                        'max' => 1000,
                                    ],
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-products .product .product__actions .button--shop-action' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                                ],
                            ),
                            array(
                                'name' => 'divider1',
                                'type' => 'divider',
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
                                            'label' => esc_html__('Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-products .product .product__actions .button--shop-action' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'btn_background',
                                            'type' => \Elementor\Group_Control_Background::get_type(),
                                            'control_type' => 'group',
                                            'types' => [ 'classic', 'gradient' ],
                                            'selector' => '{{WRAPPER}} .pxl-products .product .product__actions .button--shop-action',
                                        ),
                                        array(
                                            'name' => 'btn_border',
                                            'type' => \Elementor\Group_Control_Border::get_type(),
                                            'separator' => 'before',
                                            'control_type' => 'group', 
                                            'selector' => '{{WRAPPER}} .pxl-products .product .product__actions .button--shop-action',
                                        ),
                                        array(
                                            'name'         => 'btn_box_shadow',
                                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                            'control_type' => 'group',
                                            'selector'     => '{{WRAPPER}} .pxl-products .product .product__actions .button--shop-action',
                                        ),
                                        array(
                                            'name' => 'btn_border_radius',
                                            'label' => esc_html__('Border Radius', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', 'custom' ],
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-products .product .product__actions .button--shop-action' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                                '{{WRAPPER}} .pxl-products .product .product__actions .button--shop-action' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                    ],
                                ],
                                [
                                    'name' => 'btn_hover',
                                    'label' => esc_html__('Hover/Active', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [
                                        array(
                                            'name' => 'btn_hover_color',
                                            'label' => esc_html__('Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-products .product .product__actions .button--shop-action:hover, 
                                                {{WRAPPER}} .pxl-products .product .product__actions .button--shop-action.added,
                                                {{WRAPPER}} .pxl-products .product .product__actions .button--shop-action.woosw-added' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'btn_hover_background',
                                            'type' => \Elementor\Group_Control_Background::get_type(),
                                            'control_type' => 'group',
                                            'types' => [ 'classic' ],
                                            'selector' => '{{WRAPPER}} .pxl-products .product .product__actions .button--shop-action:hover, 
                                            {{WRAPPER}} .pxl-products .product .product__actions .button--shop-action.added,
                                            {{WRAPPER}} .pxl-products .product .product__actions .button--shop-action.woosw-added',
                                        ),
                                        array(
                                            'name' => 'btn_hover_border',
                                            'type' => \Elementor\Group_Control_Border::get_type(),
                                            'separator' => 'before',
                                            'control_type' => 'group', 
                                            'selector' => '{{WRAPPER}} .pxl-products .product .product__actions .button--shop-action:hover, 
                                            {{WRAPPER}} .pxl-products .product .product__actions .button--shop-action.added,
                                            {{WRAPPER}} .pxl-products .product .product__actions .button--shop-action.woosw-added',
                                        ),
                                        array(
                                            'name'         => 'btn_hover_box_shadow',
                                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                            'control_type' => 'group',
                                            'selector'     => '{{WRAPPER}} .pxl-products .product .product__actions .button--shop-action:hover, 
                                            {{WRAPPER}} .pxl-products .product .product__actions .button--shop-action.added,
                                            {{WRAPPER}} .pxl-products .product .product__actions .button--shop-action.woosw-added',
                                        ),
                                        array(
                                            'name' => 'btn_hover_border_radius',
                                            'label' => esc_html__('Border Radius', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', 'custom' ],
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-products .product .product__actions .button--shop-action:hover, 
                                                {{WRAPPER}} .pxl-products .product .product__actions .button--shop-action.added,
                                                {{WRAPPER}} .pxl-products .product .product__actions .button--shop-action.woosw-added' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                                '{{WRAPPER}} .pxl-products .product .product__actions .button--shop-action:hover, 
                                                {{WRAPPER}} .pxl-products .product .product__actions .button--shop-action.added,
                                                {{WRAPPER}} .pxl-products .product .product__actions .button--shop-action.woosw-added' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    'name' => 'tab_variation_image_style',
                    'label' => esc_html__('Variation Image/Color', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'wpcvs_term_image_box_size',
                            'label' => esc_html__('Box Size', 'komestic' ),
                            'type' => 'slider',
                            'size_units' => ['px', 'custom'],
                            'control_type' => 'responsive',
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-products .product__attributes .variations .wpcvs-terms.wpcvs-type-image .wpcvs-term,
                                {{WRAPPER}} .pxl-products .product__attributes .variations .wpcvs-terms.wpcvs-type-color .wpcvs-term' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'wpcvs_term_image_dot_size',
                            'label' => esc_html__('Dot Size', 'komestic' ),
                            'type' => 'slider',
                            'size_units' => ['px', 'custom'],
                            'control_type' => 'responsive',
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-products .product__attributes .variations .wpcvs-terms.wpcvs-type-image .wpcvs-term,
                                {{WRAPPER}} .pxl-products .product__attributes .variations .wpcvs-terms.wpcvs-type-color .wpcvs-term .wpcvs-term-inner' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'wpcvs_term_image_controls',
                            'control_type' => 'tab',
                            'tabs' => [
                                [
                                    'name' => 'wpcvs_term_image_normal',
                                    'label' => esc_html__('Normal', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [  
                                        array(
                                            'name' => 'wpcvs_term_image_background',
                                            'type' => \Elementor\Group_Control_Background::get_type(),
                                            'control_type' => 'group',
                                            'types' => [ 'classic', 'gradient' ],
                                            'selector' => '{{WRAPPER}} .pxl-products .product__attributes .variations .wpcvs-terms.wpcvs-type-image .wpcvs-term,
                                            {{WRAPPER}} .pxl-products .product__attributes .variations .wpcvs-terms.wpcvs-type-color .wpcvs-term',
                                        ),
                                        array(
                                            'name' => 'wpcvs_term_image_border',
                                            'type' => \Elementor\Group_Control_Border::get_type(),
                                            'separator' => 'before',
                                            'control_type' => 'group', 
                                            'selector' => '{{WRAPPER}} .pxl-products .product__attributes .variations .wpcvs-terms.wpcvs-type-image .wpcvs-term,
                                            {{WRAPPER}} .pxl-products .product__attributes .variations .wpcvs-terms.wpcvs-type-color .wpcvs-term',
                                        ),
                                        array(
                                            'name'         => 'wpcvs_term_image_box_shadow',
                                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                            'control_type' => 'group',
                                            'selector'     => '{{WRAPPER}} .pxl-products .product__attributes .variations .wpcvs-terms.wpcvs-type-image .wpcvs-term,
                                            {{WRAPPER}} .pxl-products .product__attributes .variations .wpcvs-terms.wpcvs-type-color .wpcvs-term',
                                        ),
                                        array(
                                            'name' => 'bwpcvs_term_image_border_radius',
                                            'label' => esc_html__('Border Radius', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', 'custom' ],
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-products .product__attributes .variations .wpcvs-terms.wpcvs-type-image .wpcvs-term,
                                                {{WRAPPER}} .pxl-products .product__attributes .variations .wpcvs-terms.wpcvs-type-color .wpcvs-term' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                    ],
                                ],
                                [
                                    'name' => 'wpcvs_term_image_selected',
                                    'label' => esc_html__('Hover/Selected', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [
                                        array(
                                            'name' => 'wpcvs_term_image_selected_background',
                                            'type' => \Elementor\Group_Control_Background::get_type(),
                                            'control_type' => 'group',
                                            'types' => [ 'classic', 'gradient' ],
                                            'selector' => '{{WRAPPER}} .pxl-products .product__attributes .variations .wpcvs-terms.wpcvs-type-image .wpcvs-term.wpcvs-selected, {{WRAPPER}} .pxl-products .product__attributes .variations .wpcvs-terms.wpcvs-type-image .wpcvs-term:hover,
                                            {{WRAPPER}} .pxl-products .product__attributes .variations .wpcvs-terms.wpcvs-type-color .wpcvs-term.wpcvs-selected, {{WRAPPER}} .pxl-products .product__attributes .variations .wpcvs-terms.wpcvs-type-color .wpcvs-term:hover',
                                        ),
                                        array(
                                            'name' => 'wpcvs_term_image_selected_border',
                                            'type' => \Elementor\Group_Control_Border::get_type(),
                                            'separator' => 'before',
                                            'control_type' => 'group', 
                                            'selector' => '{{WRAPPER}} .pxl-products .product__attributes .variations .wpcvs-terms.wpcvs-type-image .wpcvs-term.wpcvs-selected, {{WRAPPER}} .pxl-products .product__attributes .variations .wpcvs-terms.wpcvs-type-image .wpcvs-term:hover,
                                            {{WRAPPER}} .pxl-products .product__attributes .variations .wpcvs-terms.wpcvs-type-color .wpcvs-term.wpcvs-selected, {{WRAPPER}} .pxl-products .product__attributes .variations .wpcvs-terms.wpcvs-type-color .wpcvs-term:hover',
                                        ),
                                        array(
                                            'name'         => 'wpcvs_term_image_selected_box_shadow',
                                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                            'control_type' => 'group',
                                            'selector'     => '{{WRAPPER}} .pxl-products .product__attributes .variations .wpcvs-terms.wpcvs-type-image .wpcvs-term.wpcvs-selected, {{WRAPPER}} .pxl-products .product__attributes .variations .wpcvs-terms.wpcvs-type-image .wpcvs-term:hover,
                                            {{WRAPPER}} .pxl-products .product__attributes .variations .wpcvs-terms.wpcvs-type-color .wpcvs-term.wpcvs-selected, {{WRAPPER}} .pxl-products .product__attributes .variations .wpcvs-terms.wpcvs-type-color .wpcvs-term:hover',
                                        ),
                                        array(
                                            'name' => 'bwpcvs_term_image_selected_border_radius',
                                            'label' => esc_html__('Border Radius', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', 'custom' ],
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-products .product__attributes .variations .wpcvs-terms.wpcvs-type-image .wpcvs-term.wpcvs-selected, {{WRAPPER}} .pxl-products .product__attributes .variations .wpcvs-terms.wpcvs-type-image .wpcvs-term:hover,
                                                {{WRAPPER}} .pxl-products .product__attributes .variations .wpcvs-terms.wpcvs-type-color .wpcvs-term.wpcvs-selected, {{WRAPPER}} .pxl-products .product__attributes .variations .wpcvs-terms.wpcvs-type-color .wpcvs-term:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                    ],
                                ],
                                [
                                    'name' => 'wpcvs_term_image_disabled',
                                    'label' => esc_html__('Disabled', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [
                                        array(
                                            'name' => 'wpcvs_term_image_disabled_background',
                                            'type' => \Elementor\Group_Control_Background::get_type(),
                                            'control_type' => 'group',
                                            'types' => [ 'classic', 'gradient' ],
                                            'selector' => '{{WRAPPER}} .pxl-products .product__attributes .variations .wpcvs-terms.wpcvs-type-image .wpcvs-term.wpcvs-disabled,
                                            {{WRAPPER}} .pxl-products .product__attributes .variations .wpcvs-terms.wpcvs-type-color .wpcvs-term.wpcvs-disabled',
                                        ),
                                        array(
                                            'name' => 'wpcvs_term_image_disabled_border',
                                            'type' => \Elementor\Group_Control_Border::get_type(),
                                            'separator' => 'before',
                                            'control_type' => 'group', 
                                            'selector' => '{{WRAPPER}} .pxl-products .product__attributes .variations .wpcvs-terms.wpcvs-type-image .wpcvs-term.wpcvs-disabled,
                                            {{WRAPPER}} .pxl-products .product__attributes .variations .wpcvs-terms.wpcvs-type-color .wpcvs-term.wpcvs-disabled',
                                        ),
                                        array(
                                            'name'         => 'wpcvs_term_image_disabled_box_shadow',
                                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                            'control_type' => 'group',
                                            'selector'     => '{{WRAPPER}} .pxl-products .product__attributes .variations .wpcvs-terms.wpcvs-type-image .wpcvs-term.wpcvs-disabled,
                                            {{WRAPPER}} .pxl-products .product__attributes .variations .wpcvs-terms.wpcvs-type-color .wpcvs-term.wpcvs-disabled',
                                        ),
                                        array(
                                            'name' => 'bwpcvs_term_image_disabled_border_radius',
                                            'label' => esc_html__('Border Radius', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', 'custom' ],
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-products .product__attributes .variations .wpcvs-terms.wpcvs-type-image .wpcvs-term.wpcvs-disabled,
                                                {{WRAPPER}} .pxl-products .product__attributes .variations .wpcvs-terms.wpcvs-type-color .wpcvs-term.wpcvs-disabled' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                    ],
                                ],
                            ],
                        ), 
                    )
                ),
                array(
                    'name' => 'tab_sale_bar_style',
                    'label' => esc_html__('Sale Bar', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'sale_bar_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-products .product .selling-bar p',
                        ),
                        array(
                            'name' => 'sale_bar_color',
                            'label' => esc_html__('Color', 'komestic' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-products .product .selling-bar p' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'sale_bar_background',
                            'type' => \Elementor\Group_Control_Background::get_type(),
                            'control_type' => 'group',
                            'types' => [ 'classic' ],
                            'selector' => '{{WRAPPER}} .pxl-products .product .selling-bar',
                        ),
                        array(
                            'name' => 'sale_bar_padding',
                            'label' => esc_html__('Padding', 'komestic' ),
                            'type' => 'dimensions',
                            'size_units' => [ 'px', 'custom' ],
                            'control_type' => 'responsive',
                            'separator' => 'before',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-products .product .selling-bar' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                    )
                ),
                array(
                    'name' => 'tab_countdown_style',
                    'label' => esc_html__('Trending Countdown', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'countdown_min_w',
                            'label' => esc_html__('Min Width', 'komestic' ),
                            'type' => 'slider',
                            'size_units' => ['px', 'custom'],
                            'control_type' => 'responsive',
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-products .product .countdown' => 'min-width: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'countdown_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-products .product .countdown',
                        ),
                        array(
                            'name' => 'countdown_color',
                            'label' => esc_html__('Color', 'komestic' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-products .product .countdown' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'countdown_background',
                            'type' => \Elementor\Group_Control_Background::get_type(),
                            'control_type' => 'group',
                            'types' => [ 'classic' ],
                            'selector' => '{{WRAPPER}} .pxl-products .product .countdown',
                        ),
                        array(
                            'name' => 'countdown_padding',
                            'label' => esc_html__('Padding', 'komestic' ),
                            'type' => 'dimensions',
                            'size_units' => [ 'px', 'custom' ],
                            'control_type' => 'responsive',
                            'separator' => 'before',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-products .product .countdown' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                    )
                ),
                array(
                    'name' => 'tab_term_bar_style',
                    'label' => esc_html__('Attribute Bar', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'attr_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-products .product .pa_terms li',
                        ),
                        array(
                            'name' => 'attr_color',
                            'label' => esc_html__('Color', 'komestic' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-products .product .pa_terms li' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'attr_background',
                            'type' => \Elementor\Group_Control_Background::get_type(),
                            'control_type' => 'group',
                            'types' => [ 'classic' ],
                            'selector' => '{{WRAPPER}} .pxl-products .product .pa_terms',
                        ),
                        array(
                            'name' => 'attr_padding',
                            'label' => esc_html__('Padding', 'komestic' ),
                            'type' => 'dimensions',
                            'size_units' => [ 'px', 'custom' ],
                            'control_type' => 'responsive',
                            'separator' => 'before',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-products .product .pa_terms' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                    )
                ),
                swiper_bullets_pagination_style_options(),
                swiper_navigation_button_style_options(),
                array(
                    'name' => 'pxl_motion_effects',
                    'tab' => 'style',
                    'label' => esc_html__('Motion Effects', 'komestic'),
                    'controls' => komestic_get_animation_options([
                        'selectors' => '{{WRAPPER}} .grid .grid__item, {{WRAPPER}} .pxl-swiper .swiper-slide',
                    ]),
                ),
            ),
        ),
    ),
    komestic_get_class_widget_path()
);