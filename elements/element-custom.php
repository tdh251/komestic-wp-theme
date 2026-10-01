<?php 
/*
    General Custom Options
*/
add_action( 'elementor/element/container/section_layout/after_section_end', 'komestic_element_general_options', 1, 1 ); 
function komestic_element_general_options( \Elementor\Element_Base $el ) {
    $el->start_controls_section(
        'pxl_section_general_options',
        [
            'label' => esc_html__( 'Komestic General', 'komestic' ),
            'tab' => \Elementor\Controls_Manager::TAB_LAYOUT,
        ]
    );
    $el->add_responsive_control(
        'pxl_container_max_width',
        [
            'label' => esc_html__('Max Width', 'komestic' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ 'px', '%', 'custom' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}}' => 'max-width: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    $el->add_responsive_control(
        'pxl_container_min_width',
        [
            'label' => esc_html__('Min Width', 'komestic' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ 'px', '%', 'custom' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}}' => 'min-width: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    $el->add_responsive_control(
        'pxl_container_height',
        [
            'label' => esc_html__('Height', 'komestic' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ 'px', 'custom' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}}' => 'height: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    $el->add_responsive_control(
        'pxl_container_max_height',
        [
            'label' => esc_html__('Max Height', 'komestic' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ 'px', 'custom' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}}' => 'max-height: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    $el->add_control(
        'pxl_pointer_events',
        [
            'label' => esc_html__('Pointer Events', 'komestic'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                ''        => esc_html__('Auto', 'komestic'),
                'visible' => esc_html__('Visible', 'komestic'),
                'none'    => esc_html__('None', 'komestic'),
            ],
            'selectors' => [
                '{{WRAPPER}}' => 'pointer-events: {{VALUE}};',
            ],
        ]
    );
    $el->end_controls_section();
}

/*
    Background 
*/
add_action( 'elementor/element/container/section_layout/after_section_end', 'komestic_element_custom_background_overlay', 1, 1 ); 
function komestic_element_custom_background_overlay( \Elementor\Element_Base $el ) {
    $el->start_controls_section(
        'pxl_section_background_overlay',
        [
            'label' => esc_html__( 'Komestic Background Overlay', 'komestic' ),
            'tab' => \Elementor\Controls_Manager::TAB_LAYOUT,
        ]
    );
    $el->add_group_control(
        \Elementor\Group_Control_Background::get_type(),
        [
            'name' => 'pxl_background_overlay',
            'types' => [ 'classic', 'gradient', 'video' ],
            'selector' => '{{WRAPPER}} .pxl-background',
        ]
    );

    $el->end_controls_section();
}

/**
 * Shape
 */
add_action( 'elementor/element/container/section_layout/after_section_end', 'komestic_element_shapes', 1, 1 ); 
function komestic_element_shapes( \Elementor\Element_Base $el ) {
    $el->start_controls_section(
        'pxl_section_shapes',
        [
            'label' => esc_html__( 'Komestic Shapes', 'komestic' ),
            'tab' => \Elementor\Controls_Manager::TAB_LAYOUT,
        ]
    );
    $shape = new \Elementor\Repeater();
    $shape->add_control(
        'pxl_shape',
        [
            'label' => esc_html__( 'Shape', 'komestic' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => '',
            'options' => [
                ''       => esc_html__( 'Custom', 'komestic' ),
                'circle' => esc_html__( 'Circle', 'komestic' ),
            ],
            'default' => '',
        ],
    );
    $shape->add_control(
        'pxl_shape_size',
        [
            'label' => esc_html__( 'Size', 'komestic' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', '%', 'custom'],
            'range' => [
                'px' => ['min' => 0, 'max' => 2000],
                '%'  => ['min' => 0, 'max' => 100],
            ],
            'selectors' => [
                '{{WRAPPER}} .pxl-shape{{CURRENT_ITEM}}' => '--pxl-box-size: {{SIZE}}{{UNIT}};',
            ],
            'condition' => [
                'pxl_shape' => ['circle'],
            ],
        ]
    );
    $shape->add_control(
        'pxl_shape_size_toggle',
        [
            'label' => esc_html__( 'Size', 'komestic' ),
            'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
            'label_off' => esc_html__( 'Default', 'komestic' ),
            'label_on'  => esc_html__( 'Custom', 'komestic' ),
            'return_value' => 'yes',
        ]
    );
    $shape->start_popover();
    $shape->add_control(
        'pxl_shape_width',
        [
            'label' => esc_html__( 'Width', 'komestic' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', '%', 'custom'],
            'range' => [
                'px' => ['min' => 0, 'max' => 2000],
                '%'  => ['min' => 0, 'max' => 100],
            ],
            'selectors' => [
                '{{WRAPPER}} .pxl-shape{{CURRENT_ITEM}}' => 'width: {{SIZE}}{{UNIT}};',
            ],
            'condition' => [
                'pxl_shape_size_toggle' => 'yes',
            ],
        ]
    );
    $shape->add_control(
        'pxl_shape_height',
        [
            'label' => esc_html__( 'Height', 'komestic' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', '%', 'custom'],
            'range' => [
                'px' => ['min' => 0, 'max' => 2000],
                '%'  => ['min' => 0, 'max' => 100],
            ],
            'selectors' => [
                '{{WRAPPER}} .pxl-shape{{CURRENT_ITEM}}' => 'height: {{SIZE}}{{UNIT}};',
            ],
            'condition' => [
                'pxl_shape_size_toggle' => 'yes',
            ],
        ]
    );
    $shape->end_popover();
    $shape->add_group_control(
        \Elementor\Group_Control_Css_Filter::get_type(),
        [
            'name' => 'pxl_shape_css_filters',
            'selector' => '{{WRAPPER}} .pxl-shape{{CURRENT_ITEM}}',
        ]
    );
    $shape->add_group_control(
        \Elementor\Group_Control_Background::get_type(),
        [
            'name' => 'pxl_shape_background',
            'types' => [ 'classic', 'gradient'],
            'selector' => '{{WRAPPER}} .pxl-shape{{CURRENT_ITEM}}',
        ]
    );

    $shape->add_control(
        'pxl_shape_offset_toggle',
        [
            'label' => esc_html__( 'Offsets', 'komestic' ),
            'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
            'label_off' => esc_html__( 'Default', 'komestic' ),
            'label_on'  => esc_html__( 'Custom', 'komestic' ),
            'return_value' => 'yes',
        ]
    );
    $shape->start_popover();
    $shape->add_control(
        'pxl_shape_offset_top',
        [
            'label' => esc_html__( 'Top', 'komestic' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', '%', 'custom'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'default' => [
                'unit' => 'px',
                'size' => 0,
            ],
            'selectors' => [
                '{{WRAPPER}} .pxl-shape{{CURRENT_ITEM}}' => 'top: {{SIZE}}{{UNIT}};',
            ],
            'condition' => [
                'pxl_shape_offset_toggle' => 'yes',
            ],
        ]
    );

    $shape->add_control(
        'pxl_shape_offset_right',
        [
            'label' => esc_html__( 'Right', 'komestic' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', '%', 'custom'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .pxl-shape{{CURRENT_ITEM}}' => 'right: {{SIZE}}{{UNIT}};',
            ],
            'condition' => [
                'pxl_shape_offset_toggle' => 'yes',
            ],
        ]
    );

    $shape->add_control(
        'pxl_shape_offset_bottom',
        [
            'label' => esc_html__( 'Bottom', 'komestic' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', '%', 'custom'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .pxl-shape{{CURRENT_ITEM}}' => 'bottom: {{SIZE}}{{UNIT}};',
            ],
            'condition' => [
                'pxl_shape_offset_toggle' => 'yes',
            ],
        ]
    );

    $shape->add_control(
        'pxl_shape_offset_left',
        [
            'label' => esc_html__( 'Left', 'komestic' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', '%', 'custom'],
            'range' => [
                'px' => [ 'min' => 0, 'max' => 1000],
            ],
            'default' => [
                'unit' => 'px',
                'size' => 0,
            ],
            'selectors' => [
                '{{WRAPPER}} .pxl-shape{{CURRENT_ITEM}}' => 'left: {{SIZE}}{{UNIT}};',
            ],
            'condition' => [
                'pxl_shape_offset_toggle' => 'yes',
            ],
        ]
    );
    $shape->end_popover();
    $el->add_control(
        'pxl_shapes',
        [
            'label'   => esc_html__( 'Shapes', 'komestic' ),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $shape->get_controls(),
            'default' => [],
        ],
    );
    $el->end_controls_section();
}

/*
    Motion Effects 
*/
add_action( 'elementor/element/container/section_layout/after_section_end', 'komestic_moution_effects', 1, 1 ); 
function komestic_moution_effects( \Elementor\Element_Base $el ) {
    $el->start_controls_section(
        'pxl_section_motion_effetcs',
        [
            'label' => esc_html__( 'Komestic Motion Effects', 'komestic' ),
            'tab' => \Elementor\Controls_Manager::TAB_LAYOUT,
        ]
    );
    $el->add_control(
        'pxl_scrolling_effects',
        [
            'label' => esc_html__('Scrolling Effects', 'komestic'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                ''     => esc_html__('None', 'komestic'),
                'background-parallax' => esc_html__('Background Parallax', 'komestic'),
            ],
            'default' => '',
        ],
    );
    $el->add_group_control(
        \Elementor\Group_Control_Background::get_type(),
        [
            'name' => 'pxl_background_parallax',
            'types' => [ 'classic' ],
            'exclude' => ['color'],
            'selector' => '{{WRAPPER}} .pxl-background-parallax',
            'condition' => [
                'pxl_scrolling_effects' => ['background-parallax'],
            ],
        ],
    );
    $el->add_control(
        'parallax_params_toggle',
        [
            'label' => esc_html__( 'Parallax Params', 'komestic' ),
            'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
            'return_value' => 'yes',
            'condition' => [
                'pxl_scrolling_effects' => ['background-parallax'],
            ],
        ]
    );
    $el->start_popover();
    $el->add_control(
        'parallax_x',
        [
            'label' => esc_html__( 'X (translateX)', 'komestic' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ 'px' ],
            'range' => [
                'px' => [ 'min' => -500, 'max' => 500, 'step' => 1 ],
            ],
            'default' => [ 'size' => 0, 'unit' => 'px' ],
            'condition' => [
                'parallax_params_toggle' => 'yes',
            ],
        ]
    );

    $el->add_control(
        'parallax_y',
        [
            'label' => esc_html__( 'Y (translateY)', 'komestic' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ 'px' ],
            'range' => [
                'px' => [ 'min' => -500, 'max' => 500, 'step' => 1 ],
            ],
            'default' => [ 'size' => 0, 'unit' => 'px' ],
            'condition' => [
                'parallax_params_toggle' => 'yes',
            ],
        ]
    );

    $el->add_control(
        'parallax_rotate',
        [
            'label' => esc_html__( 'Rotate (deg)', 'komestic' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'range' => [
                'px' => [ 'min' => -180, 'max' => 180, 'step' => 1 ],
            ],
            'default' => [ 'size' => 0 ],
            'condition' => [
                'parallax_params_toggle' => 'yes',
            ],
        ]
    );

    $el->add_control(
        'parallax_scale',
        [
            'label' => esc_html__( 'Scale', 'komestic' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'range' => [
                'px' => [ 'min' => 0.1, 'max' => 3, 'step' => 0.1 ],
            ],
            'default' => [ 'size' => 1 ],
            'condition' => [
                'parallax_params_toggle' => 'yes',
            ],
        ]
    );

    $el->end_popover();
    $el->add_control(
        'divider_1',
        ['type' => \Elementor\Controls_Manager::DIVIDER,],
    );
    $el->add_control(
        'is_mouse_effects',
        [
            'label' => esc_html__('Mouse Effects', 'komestic'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => '',
        ],
    );
    $el->add_control(
        'divider_2',
        ['type' => \Elementor\Controls_Manager::DIVIDER,],
    );
    $el->add_control(
        'pxl_is_sticky',
        [
            'label' => esc_html__('Is Sticky', 'komestic'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => '',
        ],
    );
    $el->add_responsive_control(
        'pxl_sticky_offset_top',
        [
            'label' => esc_html__('Offset Top', 'komestic' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ 'px', 'custom' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}}.pxl-sticky' => 'top: {{SIZE}}{{UNIT}};',
            ],
            'condition' => [
                'pxl_is_sticky!' => '',
            ],
        ],
    );
    $el->add_control(
        'pxl_turn_off_sticky',
        [
            'label' => esc_html__('Sticky Disable Responsive', 'komestic' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'label_block' => true,
            'options' => [
                'xs' => 'XS <576px',
                'sm' => 'SM <768px',
                'md' => 'MD <992px',
                'lg' => 'LG <1200px',
                'xl' => 'XL <1400px',
            ],
            'default' => 'sm',
            'condition' => [
                'pxl_is_sticky!' => '',
            ],
        ],
    );
    $el->add_control(
        'divider_3',
        ['type' => \Elementor\Controls_Manager::DIVIDER,],
    );
    $el->add_control(
        'pxl_entrance_animation',
        [
            'label' => esc_html__('Entrance Animation', 'komestic'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'multiple' => false,
            'groups' => komestic_entrance_anim(),
            'default' => '',
        ],
    );
    $el->end_controls_section();
}


/*
    Class Render
*/
add_filter( 'pxl_custom_class', 'komestic_e_con_class_render', 1, 2);
function komestic_e_con_class_render($classes, $settings) {
    $classes = '';
    if(!empty($settings['pxl_template'])) {
        $classes .= 'e-template '.$settings['pxl_template_toggle_type'];
    }
    if(!empty($settings['pxl_entrance_animation'])) {
        $classes .= ' '.$settings['pxl_entrance_animation'];
    }
    if(!empty($settings['pxl_is_sticky'])) {
        $classes .= 'pxl-sticky'.' pxl-sticky-responsive-'.$settings['pxl_turn_off_sticky'];
    }
    return $classes;
}

/*
    HTML Before Content Render
*/
add_filter( 'pxl_element_container/before-render', 'komestic_element_before_render', 1, 2 );
function komestic_element_before_render($output, $settings) {
    $output = '';
    if($settings['pxl_scrolling_effects'] === 'background-parallax') {
        wp_enqueue_script('komestic-scrolling');
        $parallax_params = [
            'x' => $settings['parallax_x']['size'] ?? 0,
            'y' => $settings['parallax_y']['size'] ?? 0,
            'rotate' => $settings['parallax_rotate']['size'] ?? 0,
            'scale' => $settings['parallax_scale']['size'] ?? 1,
        ];
        $parallax_params = htmlspecialchars(json_encode($parallax_params), ENT_QUOTES, 'UTF-8');
        $output .= '<div class="pxl-background-parallax" data-parallax="'.$parallax_params.'"></div>';
    }
    if(!empty($settings['pxl_shapes'])) {
        foreach($settings['pxl_shapes'] as $shape) {
            $output .= '<div class="pxl-shape '.esc_attr($shape['pxl_shape'].' elementor-repeater-item-'.$shape['_id']).'"></div>';
        }
    }
    return $output;
}


/*
    HTML After Content Render
*/
add_filter( 'pxl_element_container/after-render', 'komestic_element_after_render', 1, 2) ;
function komestic_element_after_render($output, $settings) {
    $output = null;
    return $output;
}