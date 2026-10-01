<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_products_suggested',
        'title' => esc_html__('Case Products Suggested', 'komestic' ),
        'icon' => 'eicon-product-related',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'tab_primary_layout',
                    'label' => esc_html__('Layout', 'komestic'),
                    'tab' => 'layout',
                    'controls' => array(
                        array(
                            'name'     => 'layout_type',
                            'label'    => esc_html__( 'Layout Type', 'komestic' ),
                            'type'     => 'select',
                            'options'  => [
                                'grid' => esc_html__('Grid', 'komestic'),
                                'carousel' => esc_html__('Carousel', 'komestic'),
                            ],
                            'default'  => 'grid',
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
                                '3' => array(
                                    'label' => esc_html__('Layout 3', 'komestic'),
                                    'image' => get_template_directory_uri() . '/elements/assets/img-layouts/testimonial-1.webp',
                                ),
                                '4' => array(
                                    'label' => esc_html__('Layout 4', 'komestic'),
                                    'image' => get_template_directory_uri() . '/elements/assets/img-layouts/testimonial-1.webp',
                                ),
                            ),
                        ),
                    ),
                ),
                array(
                    'name'     => 'tab_product_layout',
                    'label'    => esc_html__( 'Layout', 'komestic' ),
                    'tab'      => 'content',
                    'controls' => array(
                        array(
                            'name'     => 'suggest',
                            'label'    => esc_html__( 'Suggest Products', 'komestic' ),
                            'type'     => 'select',
                            'options'  => [
                                'recent' => esc_html__('Recent', 'komestic'),
                                'sale' => esc_html__('On Sale', 'komestic'),
                                'best_selling' => esc_html__('Best Selling', 'komestic'),
                                'top_rated' => esc_html__('Top Rated', 'komestic'),
                                'featured' => esc_html__('Featured', 'komestic'),
                                'package' => esc_html__('Package', 'komestic'),
                                'custom' => esc_html__('Custom', 'komestic'),
                            ],
                            'default'  => 'recent',
                        ),
                        array(
                            'name'     => 'product_id',
                            'label'    => esc_html__( 'Product', 'komestic' ),
                            'type'     => 'select2',
                            'multiple' => false,
                            'label_block' => true,
                            'default' => '',
                            'options'  => get_all_products_with_bought_together(),
                            'condition' => [
                                'suggest' => 'package',
                            ],
                        ),
                        array(
                            'name'     => 'product_ids',
                            'label'    => esc_html__( 'Products', 'komestic' ),
                            'type'     => 'select2',
                            'multiple' => true,
                            'label_block' => true,
                            'default' => '',
                            'options'  => get_all_products_id_name(),
                            'condition' => [
                                'suggest' => 'custom',
                            ],
                        ),
                        array(
                            'name'     => 'html_id',
                            'label'    => esc_html__( 'Html ID', 'komestic' ),
                            'type'     => 'text',
                            'default' => '',
                            'condition' => [
                                'suggest' => 'package',
                            ],
                            'description' => esc_html__('If you want to add a package to the cart, you need to set an html id. This ID must match the Case Button with the action Add to Cart.', 'komestic'),
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
                            'label' => esc_html__('View Posts', 'komestic' ),
                            'type' => 'number',
                            'default' => 6,
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
                                'name' => 'show_category',
                                'label' => esc_html__('Show Category', 'komestic' ),
                                'type' => 'switcher',
                                'default' => 'true',
                            ),
                        ),
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
                                '{{WRAPPER}} .product-suggested:not([data-layout="2"]) .product .product__featured' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .product-suggested[data-layout="2"] .product' => 'gap: {{SIZE}}{{UNIT}};',
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
                                '{{WRAPPER}} .product-suggested .product-categories' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
                            'condition' => [
                                'layout' => 1,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .product-suggested .product__attributes' => 'margin-top: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'name_spacing',
                            'label' => esc_html__('Name Spacing', 'komestic' ),
                            'type' => 'slider',
                            'control_type' => 'responsive',
                            'size_units' => ['px', 'custom'],
                            'range' => [
                                'px' => [
                                    'max' => 1000,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .product-suggested .product__name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'content_padding',
                            'label' => esc_html__('Content Padding', 'komestic' ),
                            'type' => 'dimensions',
                            'size_units' => [ 'px', 'custom' ],
                            'selectors' => [
                                '{{WRAPPER}} .product-suggested .product__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                '{{WRAPPER}} .product-suggested .product' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'divider_color',
                            'label' => esc_html__('Divider Color', 'komestic' ),
                            'type' => 'color',
                            'condition' => [
                                'layout' => '2',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .product-suggested[data-layout="2"] .swiper-slide-visible + .swiper-slide-visible .product,
                                {{WRAPPER}} .product-suggested[data-layout="2"] .grid + .grid .product' => 'border-color: {{VALUE}};',
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
                                            'selector' => '{{WRAPPER}} .product-suggested .pxl-product-item',
                                        ),
                                        array(
                                            'name' => 'box_border',
                                            'type' => \Elementor\Group_Control_Border::get_type(),
                                            'control_type' => 'group', 
                                            'selector' => '{{WRAPPER}} .product-suggested .pxl-product-item',
                                        ),
                                        array(
                                            'name'         => 'box_box_shadow',
                                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                            'control_type' => 'group',
                                            'selector'     => '{{WRAPPER}} .product-suggested .pxl-product-item',
                                        ),
                                        array(
                                            'name' => 'box_border_radius',
                                            'label' => esc_html__('Border Radius', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', '%', 'custom' ],
                                            'selectors' => [
                                                '{{WRAPPER}} .product-suggested .pxl-product-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'box_padding',
                                            'label' => esc_html__('Padding', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', '%', 'custom' ],
                                            'selectors' => [
                                                '{{WRAPPER}} .product-suggested .pxl-product-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                            'selector' => '{{WRAPPER}} .product-suggested .pxl-product-item:hover',
                                        ),
                                        array(
                                            'name'      => '_box_hover_border_color',
                                            'label'     => esc_html__('Border Color', 'komestic' ),
                                            'type'      => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .product-suggested .pxl-product-item:hover' => 'border-color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'box_hover_border',
                                            'type' => \Elementor\Group_Control_Border::get_type(),
                                            'separator' => 'before',
                                            'control_type' => 'group', 
                                            'selector' => '{{WRAPPER}} .product-suggested .pxl-product-item:hover',
                                        ),
                                        array(
                                            'name'         => 'box_hover_box_shadow',
                                            'label' => esc_html__( 'Box Shadow', 'komestic' ),
                                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                            'control_type' => 'group',
                                            'selector'     => '{{WRAPPER}} .product-suggested .pxl-product-item:hover',
                                        ),
                                        array(
                                            'name' => 'box_hover_border_radius',
                                            'label' => esc_html__('Border Radius', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', '%', 'custom' ],
                                            'selectors' => [
                                                '{{WRAPPER}} .product-suggested .pxl-product-item:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'box_hover_padding',
                                            'label' => esc_html__('Padding', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', '%', 'custom' ],
                                            'selectors' => [
                                                '{{WRAPPER}} .product-suggested .pxl-product-item:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                            'selectors' => '{{WRAPPER}} .product-suggested .product__featured img',
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
                        ),
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
                                                '{{WRAPPER}} .product-suggested .product__name a' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'title_typography',
                                            'type' => \Elementor\Group_Control_Typography::get_type(),
                                            'control_type' => 'group',
                                            'selector' => '{{WRAPPER}} .product-suggested .product__name',
                                        ),
                                    ],
                                ],
                                [
                                    'name' => 'title_hover',
                                    'label' => esc_html__('Hover', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [
                                        array(
                                            'name' => 'title_hover_color',
                                            'label' => esc_html__('Text Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .product-suggested .product__name a:hover' => 'color: {{VALUE}};',
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
                            'selector' => '{{WRAPPER}} .product-suggested .product-categories a',
                        ),
                        array(
                            'name' => 'cat_color',
                            'label' => esc_html__('Color', 'komestic' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .product-suggested .product-categories a' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'cat_hover_color',
                            'label' => esc_html__('Hover Color', 'komestic' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .product-suggested .product-categories a:hover' => 'color: {{VALUE}};',
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
                            'selector' => '{{WRAPPER}} .product-suggested .product__price .price',
                        ),
                        array(
                            'name' => 'price_color',
                            'label' => esc_html__('Color', 'komestic' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .product-suggested .product__price .price, 
                                {{WRAPPER}} .product-suggested .product__price .price--normal' => 'color: {{VALUE}};',
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
                                                '{{WRAPPER}} .product-suggested .product__price .price .price--sale' => 'color: {{VALUE}} !important;',
                                            ],
                                        ),
                                        array(
                                            'name' => 'price_ins_typography',
                                            'type' => \Elementor\Group_Control_Typography::get_type(),
                                            'control_type' => 'group',
                                            'selector' => '{{WRAPPER}} .product-suggested .product__price .price .price--sale',
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
                                                '{{WRAPPER}} .product-suggested .product__price .price .price--old' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'price_del_typography',
                                            'type' => \Elementor\Group_Control_Typography::get_type(),
                                            'control_type' => 'group',
                                            'selector' => '{{WRAPPER}} .product-suggested .product__price .price .price--old',
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
                    'condition' => [
                        'layout' => '1',
                    ],
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
                                            'selector' => '{{WRAPPER}} .product-suggested .product__label .product-label--onsale',
                                        ),
                                        array(
                                            'name' => 'label_sale_color',
                                            'label' => esc_html__('Text Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .product-suggested .product__label .product-label--onsale' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'label_sale_background',
                                            'type' => \Elementor\Group_Control_Background::get_type(),
                                            'control_type' => 'group',
                                            'types' => [ 'classic', 'gradient' ],
                                            'selector' => '{{WRAPPER}} .product-suggested .product__label .product-label--onsale',
                                        ),
                                        array(
                                            'name' => 'label_sale_border',
                                            'type' => \Elementor\Group_Control_Border::get_type(),
                                            'separator' => 'before',
                                            'control_type' => 'group', 
                                            'selector' => '{{WRAPPER}} .product-suggested .product__label .product-label--onsale',
                                        ),
                                        array(
                                            'name'         => 'label_sale_box_shadow',
                                            'label' => esc_html__( 'Box Shadow', 'komestic' ),
                                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                            'control_type' => 'group',
                                            'selector'     => '{{WRAPPER}} .product-suggested .product__label .product-label--onsale',
                                        ),
                                        array(
                                            'name' => 'label_sale_border_radius',
                                            'label' => esc_html__('Border Radius', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', 'custom' ],
                                            'control_type' => 'responsive',
                                            'selectors' => [
                                                '{{WRAPPER}} .product-suggested .product__label .product-label--onsale' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                                '{{WRAPPER}} .product-suggested .product__label .product-label--onsale' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                            'selector' => '{{WRAPPER}} .product-suggested .product__label .product-label--new',
                                        ),
                                        array(
                                            'name' => 'label_new_color',
                                            'label' => esc_html__('Text Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .product-suggested .product__label .product-label--new' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'label_new_background',
                                            'type' => \Elementor\Group_Control_Background::get_type(),
                                            'control_type' => 'group',
                                            'types' => [ 'classic', 'gradient' ],
                                            'selector' => '{{WRAPPER}} .product-suggested .product__label .product-label--new',
                                        ),
                                        array(
                                            'name' => 'label_new_border',
                                            'type' => \Elementor\Group_Control_Border::get_type(),
                                            'separator' => 'before',
                                            'control_type' => 'group', 
                                            'selector' => '{{WRAPPER}} .product-suggested .product__label .product-label--new',
                                        ),
                                        array(
                                            'name'         => 'label_new_box_shadow',
                                            'label' => esc_html__( 'Box Shadow', 'komestic' ),
                                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                            'control_type' => 'group',
                                            'selector'     => '{{WRAPPER}} .product-suggested .product__label .product-label--new',
                                        ),
                                        array(
                                            'name' => 'label_new_border_radius',
                                            'label' => esc_html__('Border Radius', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', 'custom' ],
                                            'control_type' => 'responsive',
                                            'selectors' => [
                                                '{{WRAPPER}} .product-suggested .product__label .product-label--new' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                                '{{WRAPPER}} .product-suggested .product__label .product-label--new' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                            'selector' => '{{WRAPPER}} .product-suggested .product__label .product-label--trending',
                                        ),
                                        array(
                                            'name' => 'label_trending_color',
                                            'label' => esc_html__('Text Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .product-suggested .product__label .product-label--trending' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'label_trending_background',
                                            'type' => \Elementor\Group_Control_Background::get_type(),
                                            'control_type' => 'group',
                                            'types' => [ 'classic', 'gradient' ],
                                            'selector' => '{{WRAPPER}} .product-suggested .product__label .product-label--trending',
                                        ),
                                        array(
                                            'name' => 'label_trending_border',
                                            'type' => \Elementor\Group_Control_Border::get_type(),
                                            'separator' => 'before',
                                            'control_type' => 'group', 
                                            'selector' => '{{WRAPPER}} .product-suggested .product__label .product-label--trending',
                                        ),
                                        array(
                                            'name'         => 'label_trending_box_shadow',
                                            'label' => esc_html__( 'Box Shadow', 'komestic' ),
                                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                            'control_type' => 'group',
                                            'selector'     => '{{WRAPPER}} .product-suggested .product__label .product-label--trending',
                                        ),
                                        array(
                                            'name' => 'label_trending_border_radius',
                                            'label' => esc_html__('Border Radius', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', 'custom' ],
                                            'control_type' => 'responsive',
                                            'selectors' => [
                                                '{{WRAPPER}} .product-suggested .product__label .product-label--trending' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                                '{{WRAPPER}} .product-suggested .product__label .product-label--trending' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    'condition' => [
                        'layout' => '1',
                    ],
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
                                    '{{WRAPPER}} .product-suggested .product .product__actions .button--shop-action' => 'height: {{SIZE}}{{UNIT}};',
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
                                    '{{WRAPPER}} .product-suggested .product .product__actions .button--shop-action' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
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
                                                '{{WRAPPER}} .product-suggested .product .product__actions .button--shop-action' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'btn_background',
                                            'type' => \Elementor\Group_Control_Background::get_type(),
                                            'control_type' => 'group',
                                            'types' => [ 'classic', 'gradient' ],
                                            'selector' => '{{WRAPPER}} .product-suggested .product .product__actions .button--shop-action',
                                        ),
                                        array(
                                            'name' => 'btn_border',
                                            'type' => \Elementor\Group_Control_Border::get_type(),
                                            'separator' => 'before',
                                            'control_type' => 'group', 
                                            'selector' => '{{WRAPPER}} .product-suggested .product .product__actions .button--shop-action',
                                        ),
                                        array(
                                            'name'         => 'btn_box_shadow',
                                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                            'control_type' => 'group',
                                            'selector'     => '{{WRAPPER}} .product-suggested .product .product__actions .button--shop-action',
                                        ),
                                        array(
                                            'name' => 'btn_border_radius',
                                            'label' => esc_html__('Border Radius', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', 'custom' ],
                                            'selectors' => [
                                                '{{WRAPPER}} .product-suggested .product .product__actions .button--shop-action' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                                '{{WRAPPER}} .product-suggested .product .product__actions .button--shop-action' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                                '{{WRAPPER}} .product-suggested .product .product__actions .button--shop-action:hover, 
                                                {{WRAPPER}} .product-suggested .product .product__actions .button--shop-action.added,
                                                {{WRAPPER}} .product-suggested .product .product__actions .button--shop-action.woosw-added' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'btn_hover_background',
                                            'type' => \Elementor\Group_Control_Background::get_type(),
                                            'control_type' => 'group',
                                            'types' => [ 'classic' ],
                                            'selector' => '{{WRAPPER}} .product-suggested .product .product__actions .button--shop-action:hover, 
                                            {{WRAPPER}} .product-suggested .product .product__actions .button--shop-action.added,
                                            {{WRAPPER}} .product-suggested .product .product__actions .button--shop-action.woosw-added',
                                        ),
                                        array(
                                            'name' => 'btn_hover_border',
                                            'type' => \Elementor\Group_Control_Border::get_type(),
                                            'separator' => 'before',
                                            'control_type' => 'group', 
                                            'selector' => '{{WRAPPER}} .product-suggested .product .product__actions .button--shop-action:hover, 
                                            {{WRAPPER}} .product-suggested .product .product__actions .button--shop-action.added,
                                            {{WRAPPER}} .product-suggested .product .product__actions .button--shop-action.woosw-added',
                                        ),
                                        array(
                                            'name'         => 'btn_hover_box_shadow',
                                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                            'control_type' => 'group',
                                            'selector'     => '{{WRAPPER}} .product-suggested .product .product__actions .button--shop-action:hover, 
                                            {{WRAPPER}} .product-suggested .product .product__actions .button--shop-action.added,
                                            {{WRAPPER}} .product-suggested .product .product__actions .button--shop-action.woosw-added',
                                        ),
                                        array(
                                            'name' => 'btn_hover_border_radius',
                                            'label' => esc_html__('Border Radius', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', 'custom' ],
                                            'selectors' => [
                                                '{{WRAPPER}} .product-suggested .product .product__actions .button--shop-action:hover, 
                                                {{WRAPPER}} .product-suggested .product .product__actions .button--shop-action.added,
                                                {{WRAPPER}} .product-suggested .product .product__actions .button--shop-action.woosw-added' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                                '{{WRAPPER}} .product-suggested .product .product__actions .button--shop-action:hover, 
                                                {{WRAPPER}} .product-suggested .product .product__actions .button--shop-action.added,
                                                {{WRAPPER}} .product-suggested .product .product__actions .button--shop-action.woosw-added' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    'condition' => [
                        'layout' => '1',
                    ],
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
                                '{{WRAPPER}} .product-suggested .product__attributes .variations .wpcvs-terms.wpcvs-type-image .wpcvs-term,
                                {{WRAPPER}} .product-suggested .product__attributes .variations .wpcvs-terms.wpcvs-type-color .wpcvs-term' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
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
                                '{{WRAPPER}} .product-suggested .product__attributes .variations .wpcvs-terms.wpcvs-type-image .wpcvs-term,
                                {{WRAPPER}} .product-suggested .product__attributes .variations .wpcvs-terms.wpcvs-type-color .wpcvs-term .wpcvs-term-inner' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
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
                                            'selector' => '{{WRAPPER}} .product-suggested .product__attributes .variations .wpcvs-terms.wpcvs-type-image .wpcvs-term,
                                            {{WRAPPER}} .product-suggested .product__attributes .variations .wpcvs-terms.wpcvs-type-color .wpcvs-term',
                                        ),
                                        array(
                                            'name' => 'wpcvs_term_image_border',
                                            'type' => \Elementor\Group_Control_Border::get_type(),
                                            'separator' => 'before',
                                            'control_type' => 'group', 
                                            'selector' => '{{WRAPPER}} .product-suggested .product__attributes .variations .wpcvs-terms.wpcvs-type-image .wpcvs-term,
                                            {{WRAPPER}} .product-suggested .product__attributes .variations .wpcvs-terms.wpcvs-type-color .wpcvs-term',
                                        ),
                                        array(
                                            'name'         => 'wpcvs_term_image_box_shadow',
                                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                            'control_type' => 'group',
                                            'selector'     => '{{WRAPPER}} .product-suggested .product__attributes .variations .wpcvs-terms.wpcvs-type-image .wpcvs-term,
                                            {{WRAPPER}} .product-suggested .product__attributes .variations .wpcvs-terms.wpcvs-type-color .wpcvs-term',
                                        ),
                                        array(
                                            'name' => 'bwpcvs_term_image_border_radius',
                                            'label' => esc_html__('Border Radius', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', 'custom' ],
                                            'selectors' => [
                                                '{{WRAPPER}} .product-suggested .product__attributes .variations .wpcvs-terms.wpcvs-type-image .wpcvs-term,
                                                {{WRAPPER}} .product-suggested .product__attributes .variations .wpcvs-terms.wpcvs-type-color .wpcvs-term' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                            'selector' => '{{WRAPPER}} .product-suggested .product__attributes .variations .wpcvs-terms.wpcvs-type-image .wpcvs-term.wpcvs-selected, {{WRAPPER}} .product-suggested .product__attributes .variations .wpcvs-terms.wpcvs-type-image .wpcvs-term:hover,
                                            {{WRAPPER}} .product-suggested .product__attributes .variations .wpcvs-terms.wpcvs-type-color .wpcvs-term.wpcvs-selected, {{WRAPPER}} .product-suggested .product__attributes .variations .wpcvs-terms.wpcvs-type-color .wpcvs-term:hover',
                                        ),
                                        array(
                                            'name' => 'wpcvs_term_image_selected_border',
                                            'type' => \Elementor\Group_Control_Border::get_type(),
                                            'separator' => 'before',
                                            'control_type' => 'group', 
                                            'selector' => '{{WRAPPER}} .product-suggested .product__attributes .variations .wpcvs-terms.wpcvs-type-image .wpcvs-term.wpcvs-selected, {{WRAPPER}} .product-suggested .product__attributes .variations .wpcvs-terms.wpcvs-type-image .wpcvs-term:hover,
                                            {{WRAPPER}} .product-suggested .product__attributes .variations .wpcvs-terms.wpcvs-type-color .wpcvs-term.wpcvs-selected, {{WRAPPER}} .product-suggested .product__attributes .variations .wpcvs-terms.wpcvs-type-color .wpcvs-term:hover',
                                        ),
                                        array(
                                            'name'         => 'wpcvs_term_image_selected_box_shadow',
                                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                            'control_type' => 'group',
                                            'selector'     => '{{WRAPPER}} .product-suggested .product__attributes .variations .wpcvs-terms.wpcvs-type-image .wpcvs-term.wpcvs-selected, {{WRAPPER}} .product-suggested .product__attributes .variations .wpcvs-terms.wpcvs-type-image .wpcvs-term:hover,
                                            {{WRAPPER}} .product-suggested .product__attributes .variations .wpcvs-terms.wpcvs-type-color .wpcvs-term.wpcvs-selected, {{WRAPPER}} .product-suggested .product__attributes .variations .wpcvs-terms.wpcvs-type-color .wpcvs-term:hover',
                                        ),
                                        array(
                                            'name' => 'bwpcvs_term_image_selected_border_radius',
                                            'label' => esc_html__('Border Radius', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', 'custom' ],
                                            'selectors' => [
                                                '{{WRAPPER}} .product-suggested .product__attributes .variations .wpcvs-terms.wpcvs-type-image .wpcvs-term.wpcvs-selected, {{WRAPPER}} .product-suggested .product__attributes .variations .wpcvs-terms.wpcvs-type-image .wpcvs-term:hover,
                                                {{WRAPPER}} .product-suggested .product__attributes .variations .wpcvs-terms.wpcvs-type-color .wpcvs-term.wpcvs-selected, {{WRAPPER}} .product-suggested .product__attributes .variations .wpcvs-terms.wpcvs-type-color .wpcvs-term:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                            'selector' => '{{WRAPPER}} .product-suggested .product__attributes .variations .wpcvs-terms.wpcvs-type-image .wpcvs-term.wpcvs-disabled,
                                            {{WRAPPER}} .product-suggested .product__attributes .variations .wpcvs-terms.wpcvs-type-color .wpcvs-term.wpcvs-disabled',
                                        ),
                                        array(
                                            'name' => 'wpcvs_term_image_disabled_border',
                                            'type' => \Elementor\Group_Control_Border::get_type(),
                                            'separator' => 'before',
                                            'control_type' => 'group', 
                                            'selector' => '{{WRAPPER}} .product-suggested .product__attributes .variations .wpcvs-terms.wpcvs-type-image .wpcvs-term.wpcvs-disabled,
                                            {{WRAPPER}} .product-suggested .product__attributes .variations .wpcvs-terms.wpcvs-type-color .wpcvs-term.wpcvs-disabled',
                                        ),
                                        array(
                                            'name'         => 'wpcvs_term_image_disabled_box_shadow',
                                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                            'control_type' => 'group',
                                            'selector'     => '{{WRAPPER}} .product-suggested .product__attributes .variations .wpcvs-terms.wpcvs-type-image .wpcvs-term.wpcvs-disabled,
                                            {{WRAPPER}} .product-suggested .product__attributes .variations .wpcvs-terms.wpcvs-type-color .wpcvs-term.wpcvs-disabled',
                                        ),
                                        array(
                                            'name' => 'bwpcvs_term_image_disabled_border_radius',
                                            'label' => esc_html__('Border Radius', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', 'custom' ],
                                            'selectors' => [
                                                '{{WRAPPER}} .product-suggested .product__attributes .variations .wpcvs-terms.wpcvs-type-image .wpcvs-term.wpcvs-disabled,
                                                {{WRAPPER}} .product-suggested .product__attributes .variations .wpcvs-terms.wpcvs-type-color .wpcvs-term.wpcvs-disabled' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    'condition' => [
                        'layout' => '1',
                    ],
                    'controls' => array(
                        array(
                            'name' => 'sale_bar_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .product-suggested .product .selling-bar p',
                        ),
                        array(
                            'name' => 'sale_bar_color',
                            'label' => esc_html__('Color', 'komestic' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .product-suggested .product .selling-bar p' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'sale_bar_background',
                            'type' => \Elementor\Group_Control_Background::get_type(),
                            'control_type' => 'group',
                            'types' => [ 'classic' ],
                            'selector' => '{{WRAPPER}} .product-suggested .product .selling-bar',
                        ),
                        array(
                            'name' => 'sale_bar_padding',
                            'label' => esc_html__('Padding', 'komestic' ),
                            'type' => 'dimensions',
                            'size_units' => [ 'px', 'custom' ],
                            'control_type' => 'responsive',
                            'separator' => 'before',
                            'selectors' => [
                                '{{WRAPPER}} .product-suggested .product .selling-bar' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                    )
                ),
                array(
                    'name' => 'tab_countdown_style',
                    'label' => esc_html__('Trending Countdown', 'komestic' ),
                    'tab' => 'style',
                    'condition' => [
                        'layout' => '1',
                    ],
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
                                '{{WRAPPER}} .product-suggested .product .countdown' => 'min-width: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'countdown_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .product-suggested .product .countdown',
                        ),
                        array(
                            'name' => 'countdown_color',
                            'label' => esc_html__('Color', 'komestic' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .product-suggested .product .countdown' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'countdown_background',
                            'type' => \Elementor\Group_Control_Background::get_type(),
                            'control_type' => 'group',
                            'types' => [ 'classic' ],
                            'selector' => '{{WRAPPER}} .product-suggested .product .countdown',
                        ),
                        array(
                            'name' => 'countdown_padding',
                            'label' => esc_html__('Padding', 'komestic' ),
                            'type' => 'dimensions',
                            'size_units' => [ 'px', 'custom' ],
                            'control_type' => 'responsive',
                            'separator' => 'before',
                            'selectors' => [
                                '{{WRAPPER}} .product-suggested .product .countdown' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                    )
                ),
                array(
                    'name' => 'tab_term_bar_style',
                    'label' => esc_html__('Attribute Bar', 'komestic' ),
                    'tab' => 'style',
                    'condition' => [
                        'layout' => '1',
                    ],
                    'controls' => array(
                        array(
                            'name' => 'attr_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .product-suggested .product .pa_terms li',
                        ),
                        array(
                            'name' => 'attr_color',
                            'label' => esc_html__('Color', 'komestic' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .product-suggested .product .pa_terms li' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'attr_background',
                            'type' => \Elementor\Group_Control_Background::get_type(),
                            'control_type' => 'group',
                            'types' => [ 'classic' ],
                            'selector' => '{{WRAPPER}} .product-suggested .product .pa_terms',
                        ),
                        array(
                            'name' => 'attr_padding',
                            'label' => esc_html__('Padding', 'komestic' ),
                            'type' => 'dimensions',
                            'size_units' => [ 'px', 'custom' ],
                            'control_type' => 'responsive',
                            'separator' => 'before',
                            'selectors' => [
                                '{{WRAPPER}} .product-suggested .product .pa_terms' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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