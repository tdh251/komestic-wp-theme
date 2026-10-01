<?php 

/**
 * Get class widget path
*/
if(!function_exists('komestic_get_class_widget_path')){
    function komestic_get_class_widget_path(){
        $upload_dir = wp_upload_dir();
        $cls_path = $upload_dir['basedir'].'/elementor-widget/';
        if(!is_dir($cls_path)) {
            wp_mkdir_p( $cls_path );
        }
        return $cls_path;
    }
}

add_filter( 'elementor/icons_manager/additional_tabs', function( $tabs ) {
    $tabs['flaticon'] = [
        'name'          => 'flaticon',
        'label'         => esc_html__( 'Flaticon', 'komestic' ),
        'labelIcon'     => 'flaticon-bag', 
        'prefix'        => 'flaticon-',
        'displayPrefix' => 'flaticon',
        'url'           => get_stylesheet_directory_uri() . '/assets/css/flaticon.css',
        'fetchJson'     => get_stylesheet_directory_uri() . '/assets/fonts/flaticon/flaticon.json',
        'ver'           => '1.0.0',
    ];
    return $tabs;
});

/**
 * Get post type options
*/
function komestic_get_post_type_options($pt_supports=[]){
    $post_types = get_post_types([
        'public'   => true,
    ], 'objects');
    $excluded_post_type = [
        'page',
        'attachment',
        'revision',
        'nav_menu_item',
        'custom_css',
        'customize_changeset',
        'oembed_cache',
        'e-landing-page',
        'header',
        'footer',
        'mega-menu',
        'elementor_library'
    ];

    $result_some = [];
    $result_any = [];
    if (!is_array($post_types))
        return $result;
    foreach ($post_types as $post_type) {
        if (!$post_type instanceof WP_Post_Type)
            continue;
        if (in_array($post_type->name, $excluded_post_type))
            continue;

        if(!empty($pt_supports) && in_array($post_type->name, $pt_supports)){
            $result_some[$post_type->name] = $post_type->labels->singular_name;
        }else{
            $result_any[$post_type->name] = $post_type->labels->singular_name;
        }
    }

    if(!empty($pt_supports))
        return $result_some;
    else   
        return $result_any;
}

// 
function komestic_get_post_layout($pt_supports = [], $condition = []) {
    $post_types  = komestic_get_post_type_options($pt_supports); 
    $result = [];
    if (!is_array($post_types))
        return $result;
    foreach ($post_types as $name => $label) {
        $condition['post_type'] = [$name];
        $result[] = array(
            'name'     => 'layout_'.$name,
            'label'    => sprintf(esc_html__( 'Select Template of %s', 'komestic' ), $label),
            'type'     => 'layoutcontrol',
            'default' => $name.'-1',
            'options'  => komestic_get_layout_options($name),
            'condition' => $condition,
        );
    }
    return $result;  
}
function komestic_get_layout_options($post_type){
    $option_layouts = [];
    switch ($post_type) {
        case 'post':  
            $option_layouts = [
                'post-1' => [
                    'label' => esc_html__( 'Post 1', 'komestic' ),
                    'image' => get_template_directory_uri() . '/elements/assets/img-layouts/post-1.webp'
                ],
                'post-2' => [
                    'label' => esc_html__( 'Post 2', 'komestic' ),
                    'image' => get_template_directory_uri() . '/elements/assets/img-layouts/post-2.webp'
                ],
                'post-3' => [
                    'label' => esc_html__( 'Post 3', 'komestic' ),
                    'image' => get_template_directory_uri() . '/elements/assets/img-layouts/post-3.webp'
                ],
            ];
            break;
        case 'product' :
            $option_layouts = [
                'product-1' => [
                    'label' => esc_html__( 'Product 1', 'komestic' ),
                    'image' => get_template_directory_uri() . '/elements/assets/img-layouts/product-1.webp'
                ],
            ];
            break;

    }
    return $option_layouts;
}

function komestic_get_term_by_post_type($pt_supports = [], $args=[]){
    $args = wp_parse_args($args, ['condition' => 'post_type', 'custom_condition' => []]); 
    $post_types  = komestic_get_post_type_options($pt_supports); 
    $result = [];
    if (!is_array($post_types))
        return $result;
    foreach ($post_types as $name => $label) {
         
        $taxonomy = get_object_taxonomies($name, 'names');
        
        if($name == 'post') $taxonomy = ['category'];

        $result[] = array(
            'name'     => 'source_'.$name,
            'label'    => sprintf(esc_html__( 'Select Term of %s', 'komestic' ), $label),
            'type'     => \Elementor\Controls_Manager::SELECT2,
            'multiple' => true,
            'options'  => pxl_get_grid_term_options($name,$taxonomy),
            'condition' => array_merge(
                [
                    $args['condition'] => [$name]
                ],
                $args['custom_condition']
            )
        );
    }
    return $result;
}

function komestic_get_ids_by_post_type($pt_supports = [], $args = []){
    $args = wp_parse_args($args, ['condition' => 'post_type', 'custom_condition' => []]);
    $post_types = komestic_get_post_type_options($pt_supports);
    $result = [];
    if (!is_array($post_types))
        return $result;
    foreach ($post_types as $name => $label) {

        $posts = komestic_list_post($name, false);
 
        $result[] = array(
            'name' => 'source_' . $name . '_post_ids',
            'label' => sprintf(esc_html__('Select posts', 'komestic'), $label),
            'type'     => \Elementor\Controls_Manager::SELECT2,
            'multiple' => true,
            'options' => $posts,
            'condition' => array_merge(
                [
                    $args['condition'] => [$name]
                ],
                $args['custom_condition']
            )
        );
    }
    return $result;
}

function komestic_get_term_by_post_type_custom($pt_supports = [], $args = []) {
    $args = wp_parse_args($args, ['condition' => 'post_type_custom', 'custom_condition' => []]); 
    $post_types  = komestic_get_post_type_options($pt_supports); 
    $result = [];
    if (!is_array($post_types))
        return $result;
    foreach ($post_types as $name => $label) {
        $taxonomy = ($name == 'post') ? ['category'] : get_object_taxonomies($name, 'names');
        $result[] = array(
            'name'     => 'source_'.$name,
            'label'    => sprintf(esc_html__( 'Select Term of %s', 'komestic' ), $label),
            'type'     => 'select2',
            'multiple' => true,
            'options'  => pxl_get_grid_term_options($name,$taxonomy),
            'condition' => array_merge(
                [
                    $args['condition'] => [$name]
                ],
                $args['custom_condition']
            )
        );
    }
    return $result;
}

function komestic_get_ids_by_post_type_custom($pt_supports = [], $args = []){
    $args = wp_parse_args($args, ['condition' => 'post_type_custom', 'custom_condition' => []]);
    $post_types = komestic_get_post_type_options($pt_supports);
    $result = [];
    if (!is_array($post_types))
        return $result;
    foreach ($post_types as $name => $label) {
        if($name === 'current') {
            $posts = komestic_list_post(get_post_type(), false);
        }else {
            $posts = komestic_list_post($name, false);
        }
 
        $result[] = array(
            'name' => 'source_' . $name . '_post_ids',
            'label' => sprintf(esc_html__('Select posts', 'komestic'), $label),
            'type'     => \Elementor\Controls_Manager::SELECT2,
            'multiple' => true,
            'options' => $posts,
            'condition' => array_merge(
                [
                    $args['condition'] => [$name]
                ],
                $args['custom_condition']
            )
        );
    }
    return $result;
}
/**
 * Animation List
*/
function komestic_entrance_anim($type = 'normal') {
    $options =  [
        [
            'label' => esc_html__( 'None', 'komestic' ),
            'options' => [
                '' => esc_html__( 'None', 'komestic' ),
            ],
        ],
        [
            'label' => esc_html__( 'Fading', 'komestic' ),
            'options' => [
                'wow fadeIn'       => esc_html__( 'Fade In', 'komestic' ),
                'wow fadeInUp'     => esc_html__( 'Fade In Up', 'komestic' ),
                'wow fadeInRight'  => esc_html__( 'Fade In Right', 'komestic' ),
                'wow fadeInDown'   => esc_html__( 'Fade In Down', 'komestic' ),
                'wow fadeInLeft'   => esc_html__( 'Fade In Left', 'komestic' ),
            ],
        ],
        [
            'label' => esc_html__( 'Zooming', 'komestic' ),
            'options' => [
                'wow zoomIn'       => esc_html__( 'Zoom In', 'komestic' ),
                'wow zoomInUp'     => esc_html__( 'Zoom In Up', 'komestic' ),
                'wow zoomInRight'  => esc_html__( 'Zoom In Right', 'komestic' ),
                'wow zoomInDown'   => esc_html__( 'Zoom In Down', 'komestic' ),
                'wow zoomInLeft'   => esc_html__( 'Zoom In Left', 'komestic' ),
                'wow zoomInUpLeft' => esc_html__( 'Zoom In Up Left', 'komestic' ),
                'wow zoomInUpRight'=> esc_html__( 'Zoom In Up Right', 'komestic' ),
                'wow zoomInDownLeft'=> esc_html__( 'Zoom In Down Left', 'komestic' ),
                'wow zoomInDownRight'=> esc_html__( 'Zoom In Down Right', 'komestic' ),
            ],
        ],
        [
            'label' => esc_html__( 'Bouncing', 'komestic' ),
            'options' => [
                'wow bounceIn'       => esc_html__( 'Bounce In', 'komestic' ),
                'wow bounceInUp'     => esc_html__( 'Bounce In Up', 'komestic' ),
                'wow bounceInRight'  => esc_html__( 'Bounce In Right', 'komestic' ),
                'wow bounceInDown'   => esc_html__( 'Bounce In Down', 'komestic' ),
                'wow bounceInLeft'   => esc_html__( 'Bounce In Left', 'komestic' ),
            ],
        ],
        [
            'label' => esc_html__( 'Reveal', 'komestic' ),
            'options' => [
                'wow revealIn'       => esc_html__( 'Reveal In', 'komestic' ),
                'wow revealInUp'     => esc_html__( 'Reveal In Up', 'komestic' ),
                'wow revealInRight'  => esc_html__( 'Reveal In Right', 'komestic' ),
                'wow revealInDown'   => esc_html__( 'Reveal In Down', 'komestic' ),
                'wow revealInLeft'   => esc_html__( 'Reveal In Left', 'komestic' ),
                'wow revealInVertical' => esc_html__('Reveal In Vertical', 'komestic'),
                'wow revealInHorizontal' => esc_html__('Reveal In Horizontal', 'komestic'),
                'wow revealCircle'   => esc_html__('Reveal Circle', 'komestic')
            ],
        ],
    ];
    if($type === 'image') {
        $options = array_merge(
            $options, 
            [
                [
                    'label' => esc_html__( 'Reveal Image', 'komestic' ),
                    'options' => [
                        'wow revealImageIn'       => esc_html__( 'Reveal In', 'komestic' ),
                        'wow revealImageInUp'     => esc_html__( 'Reveal In Up', 'komestic' ),
                        'wow revealImageInRight'  => esc_html__( 'Reveal In Right', 'komestic' ),
                        'wow revealImageInDown'   => esc_html__( 'Reveal In Down', 'komestic' ),
                        'wow revealImageInLeft'   => esc_html__( 'Reveal In Left', 'komestic' ),
                        'wow revealImageInVertical' => esc_html__('Reveal In Vertical', 'komestic'),
                        'wow revealImageInHorizontal' => esc_html__('Reveal In Horizontal', 'komestic'),
                        'wow revealImageCircle'   => esc_html__('Reveal Circle', 'komestic')
                    ],
                ],
            ],
        );
    }
    if($type === 'text') {
        $options = array_merge(
            $options, 
            [
                [
                    'label' => esc_html__( 'Gsap Animate', 'komestic' ),
                    'options' => [
                        'text-animated text-fade-in'       => esc_html__('Fade In', 'komestic'),
                        'text-animated text-fade-in-up'    => esc_html__('Fade In Up', 'komestic'),
                        'text-animated text-fade-in-right' => esc_html__('Fade In Right', 'komestic'),
                        'text-animated text-fade-in-down'  => esc_html__('Fade In Down', 'komestic'),
                        'text-animated text-fade-in-left'  => esc_html__('Fade In Left', 'komestic'),
                        'text-animated text-explosion'     => esc_html__('Explosion', 'komestic'),
                        'text-animated text-zigzag-zoom'   => esc_html__('Zigzag Zoom', 'komestic'),
                        'text-animated text-flip-x'        => esc_html__('Flip X', 'komestic'),
                        'text-animated text-flip-y'        => esc_html__('Flip Y', 'komestic'),
                        'text-animated text-zoom-in'        => esc_html__('Zoom In', 'komestic'),
                    ],
                ],
            ],
        );
    }
    if($type === 'slider') {
        $options = array_merge(
            $options, 
            [
                [
                    'label' => esc_html__( 'Gsap Animate', 'komestic' ),
                    'options' => [
                        'text1'       => esc_html__('Effect 1', 'komestic'),
                        'text2'       => esc_html__('Effect 2', 'komestic'),
                        'text3'       => esc_html__('Effect 3', 'komestic'),
                        'text4'       => esc_html__('Effect 4', 'komestic'),
                    ],
                ],
            ],
        );
    }
    return $options;
}

if (!function_exists('komestic_get_animation_options')) {
    function komestic_get_animation_options($args = []) {
        $prefix    = isset($args['prefix'])     ? $args['prefix'] . '_' : '';
        $condition = isset($args['condition'])  ? $args['condition']  : [];
        $selectors = isset($args['selectors'])  ? $args['selectors'] : null;
        $type      = isset($args['type'])       ? $args['type'] : 'normal';
        $options = [
            array(
                'name' => $prefix.'entrance_anim',
                'label' => esc_html__('Entrance Animation', 'komestic'),
                'type' => 'select',
                'groups' => komestic_entrance_anim($type),
                'default' => '',
                'condition' => $condition,
            ),
            array(
                'name' => $prefix.'anim_duration',
                'label' => esc_html__('Animation Duration(ms)', 'komestic'),
                'type' => 'number',
                'default' => 1000,
                'selectors' => [
                    $selectors => 'animation-duration: {{VALUE}}ms;-webkit-animation-duration: {{VALUE}}ms;',
                ],
                'control_type' => 'responsive',
                'condition' => array_merge(
                    $condition,
                    [
                        $prefix.'entrance_anim!' => ['text-animated', '']
                    ]
                ),
            ),
            array(
                'name' => $prefix.'anim_delay',
                'label' => esc_html__('Animation Delay(ms)', 'komestic'),
                'type' => 'number',
                'control_type' => 'responsive',
                'default' => 0,
                'selectors' => [
                    $selectors => 'animation-delay: {{VALUE}}ms;-webkit-animation-delay: {{VALUE}}ms;',
                ],
                'condition' => array_merge(
                    $condition,
                    [
                        $prefix.'entrance_anim!' => ['text-animated', '']
                    ]
                ),
            ), 
        ];
        if($type === 'text') {
            $options = array_merge(
                $options, 
                [
                    [
                        'name' => $prefix . 'split_type',
                        'label' => esc_html__('Animation On', 'komestic'),
                        'type' => 'select',
                        'options' => [
                            'lines' => esc_html__('Lines', 'komestic'),
                            'words' => esc_html__('Words', 'komestic'),
                            'chars' => esc_html__('Chars', 'komestic'),
                        ],
                        'default' => 'chars',
                        'condition' => $condition,
                        'description' => esc_html__('This option only applies to gsap animate', 'komestic'),
                    ],
                ],
            );
        }
        return $options;
    }
}

// Element Position Options
if(!function_exists('komestic_position_options')) {
    function komestic_position_options($args = []) {
        $prefix = isset($args['prefix']) ? $args['prefix'].'_' : '';
        $selectors = isset($args['selectors']) ? $args['selectors'] : '';
        $label = isset($args['label']) ? $args['label'] : 'Position';
        $separator = isset($args['separator']);
        $options = [
            [
                'name' => $prefix.'position',
                'label' => $label,
                'type' => 'select',
                'control_type' => 'responsive',
                'options' => array(
                    ''         => esc_html__('Default', 'komestic'),
                    'relative' => esc_html__('Relative', 'komestic'),
                    'absolute' => esc_html__('Absolute', 'komestic'),
                    'sticky'   => esc_html__('Sticky', 'komestic'),
                ),
                'default' => '',
                'selectors' => [
                    $selectors => 'position: {{VALUE}}; top: auto; left: auto; right: auto; bottom: auto;',
                ],
            ],
            [
                'name' => $prefix.'offset_top',
                'label' => esc_html__('Top', 'komestic' ),
                'type' => 'slider',
                'size_units' => ['px', '%', 'custom'],
                'control_type' => 'responsive',
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    $selectors => 'top: {{SIZE}}{{UNIT}};',
                ],
                'default' => [
                    'size' => 0,
                    'unit' => 'px',
                ],
                'condition' => [
                    $prefix.'position' => ['absolute', 'sticky'],
                ],
            ],
            [
                'name' => $prefix.'offset_right',
                'label' => esc_html__('Right', 'komestic' ),
                'type' => 'slider',
                'size_units' => ['px', '%', 'custom'],
                'control_type' => 'responsive',
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    $selectors => 'right: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    $prefix.'position' => ['absolute', 'sticky'],
                ],
            ],
            [
                'name' => $prefix.'offset_bottom',
                'label' => esc_html__('Bottom', 'komestic' ),
                'type' => 'slider',
                'size_units' => ['px', '%', 'custom'],
                'control_type' => 'responsive',
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    $selectors => 'bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    $prefix.'position' => ['absolute', 'sticky'],
                ],
            ],
            [
                'name' => $prefix.'offset_left',
                'label' => esc_html__('Left', 'komestic' ),
                'type' => 'slider',
                'size_units' => ['px', '%', 'custom'],
                'control_type' => 'responsive',
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    $selectors => 'left: {{SIZE}}{{UNIT}};',
                ],
                'default' => [
                    'size' => 0,
                    'unit' => 'px',
                ],
                'condition' => [
                    $prefix.'position' => ['absolute', 'sticky'],
                ],
            ],
        ];
        if($separator) {
            $options[0]['separator'] = 'before';
        };
        return $options;
    }
}


// Image Dimension Options
if(!function_exists('komestic_image_dimension_options')) {
    function komestic_image_dimension_options($args = []) {
        $condition = isset($args['condition']) ? $args['condition'] : [];
        $options = [
            array(
                'name' => 'img_dimension',
                'label' => esc_html__('Image Dimension', 'komestic'),
                'type' => 'select',
                'options' => [
                    ''              => esc_html__('Default', 'komestic'),
                    'thumbnail'     => esc_html__('Thumbnail', 'komestic'),
                    'thumb'         => esc_html__('Thumb (Alias of Thumbnail)', 'komestic'),
                    'medium'        => esc_html__('Medium', 'komestic'),
                    'medium_large'  => esc_html__('Medium Large', 'komestic'),
                    'large'         => esc_html__('Large', 'komestic'),
                    'full'          => esc_html__('Full (Original)', 'komestic'),
                    'custom'        => esc_html__('Custom', 'komestic'),
                ],
                'default' => '',
                'condition' => $condition,
            ),
            array(
                'name' => 'custom_img_dimension',
                'label' => esc_html__( 'Dimension Custom', 'komestic' ),
                'type' => 'image_dimensions',
                'description' => esc_html__( 'Crop the original image size to any custom size. Set custom width or height to keep the original size ratio.', 'komestic' ),
                'condition' => array_merge(
                    [
                        'img_dimension' => 'custom',
                    ],
                    $condition
                ),
            ),
        ];
        return $options;
    }
}

// Grid Options
function grid_controls_options($args = []) {
    $filter = isset($args['filter']) ? $args['filter'] : false;
    $condition = isset($args['condition']) ? $args['condition'] : [];
    $selectors = isset($args['selectors']) ? $args['selectors'] : null;
    $options = [];
    $options = array(
        'name' => 'grid_controls',
        'control_type' => 'tab',
        'tabs' => [
            [
                'name' => 'grid_options',
                'label' => esc_html__('Options', 'komestic' ),
                'type' => 'tab',
                'controls' => array(
                    array(
                        'name' => 'grid_justify_content',
                        'label' => esc_html__('Justify Content', 'komestic'),
                        'type' => 'choose',
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
                            '{{WRAPPER}} .grid .grid__inner' => 'justify-content: {{VALUE}};'
                        ],
                    ),
                    array(
                        'name' => 'grid_spacing_inline',
                        'label' => esc_html__('Column Spacing(px)', 'komestic' ),
                        'type' => 'slider',
                        'control_type' => 'responsive',
                        'size_units' => ['px'],
                        'selectors' => [
                            '{{WRAPPER}} .grid .grid__inner' => '--pxl-spacing-inline: {{SIZE}}{{UNIT}};',
                        ],
                    ),
                    array(
                        'name' => 'grid_spacing_block',
                        'label' => esc_html__('Row Spacing(px)', 'komestic' ),
                        'type' => 'slider',
                        'control_type' => 'responsive',
                        'size_units' => ['px'],
                        'selectors' => [
                            '{{WRAPPER}} .grid .grid__inner' => '--pxl-spacing-block: {{SIZE}}{{UNIT}};',
                        ],
                    ),
                    array(
                        'name' => 'grid_pagination',
                        'label' => esc_html__('Pagination', 'komestic' ),
                        'type' => 'select',
                        'separator' => 'before',
                        'default' => '',
                        'options' => [
                            ''     => esc_html__('Disable', 'komestic' ),
                            'pagination' => esc_html__('Pagination', 'komestic' ),
                            'loadmore'  => esc_html__('Loadmore', 'komestic' ),
                        ],
                    ),
                    array(
                        'name' => 'grid_pagination_justify_content',
                        'label' => esc_html__('Justify Content', 'komestic'),
                        'type' => 'choose',
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
                            '{{WRAPPER}} .grid .pagination .pagination__inner' => 'justify-content: {{VALUE}};'
                        ],
                        'condition' => [
                            'grid_pagination' => 'pagination',
                        ],
                    ),
                    array(
                        'name' => 'grid_pagination_gap',
                        'label' => esc_html__('Gap', 'komestic'),
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
                            '{{WRAPPER}} .grid .pagination .pagination__inner' => "gap: {{SIZE}}{{UNIT}};",
                        ],
                        'condition' => [
                            'grid_pagination' => 'pagination',
                        ],
                    ),
                    array(
                        'name' => 'grid_pagination_spacing_top',
                        'label' => esc_html__('Spacing Top', 'komestic'),
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
                            '{{WRAPPER}} .pxl-grid .pagination .pagination__inner' => "margin-top: {{SIZE}}{{UNIT}};",
                        ],
                        'condition' => [
                            'grid_pagination' => 'pagination',
                        ],
                    ),
                    
                    array(
                        'name' => 'btn_load_more_justify_content',
                        'label' => esc_html__('Justify Content', 'komestic'),
                        'type' => 'choose',
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
                        'condition' => [
                            'grid_pagination' => 'loadmore',
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .grid .load-more' => 'justify-content: {{VALUE}};'
                        ],
                    ),
                    array(
                        'name' => 'load_more_text',
                        'type' => 'text',
                        'label' => esc_html__('Button Text', 'komestic'),
                        'condition' => [
                            'grid_pagination' => 'loadmore',
                        ],
                    ),
                    array(
                        'name' => 'loadmore_spacing',
                        'label' => esc_html__('Button Spacing', 'komestic' ),
                        'type' => 'slider',
                        'control_type' => 'responsive',
                        'size_units' => ['px', 'custom'],
                        'range' => [
                            'px' => [
                                'max' => 1000,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .grid .load-more' => 'margin-top: {{SIZE}}{{UNIT}};',
                        ],
                        'condition' => [
                            'grid_pagination' => 'loadmore',
                        ],
                    ),
                ),
            ],
            [
                'name' => 'grid_responsive',
                'label' => esc_html__('Responsive', 'komestic' ),
                'type' => 'tab',
                'condition' => [
                    'layout_type' => 'grid',
                ],
                'controls' => [
                    array(
                        'name' => 'columns',
                        'label' => esc_html__('Columns', 'komestic' ),
                        'type' => 'select',
                        'control_type' => 'responsive',
                        'default' => '',
                        'options' => [
                            ''  => 'Default',
                            '100%' => '1',
                            '50%' => '2',
                            '33.3333333%' => '3',
                            '25%' => '4',
                            '20%' => '5',
                            '16.666666666%' => '6',
                        ],
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .grid .grid__inner .grid__item' => '--pxl-width: {{VALUE}};'
                        ]
                    ),
                    array(
                        'name' => 'grid_items',
                        'label' => esc_html__('Columns Custom', 'komestic' ),
                        'type' => 'repeater',
                        'controls' => array(
                            array(
                                'name' => 'grid_item_width',
                                'label' => esc_html__('Width', 'komestic'),
                                'type' => 'slider',
                                'control_type' => 'responsive',
                                'size_units' => ['%', 'custom'],
                                'range' => [
                                    'px' => [
                                        'min' => 0,
                                        'max' => 1000,
                                    ],
                                ],
                                'default' => [
                                    'unit' => '%',
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .grid .grid__inner .grid__item{{CURRENT_ITEM}}' => '--pxl-width: {{SIZE}}{{UNIT}};',
                                ],
                            ),
                            array(
                                'name' => 'grid_item_height',
                                'label' => esc_html__('Height', 'komestic'),
                                'type' => 'slider',
                                'control_type' => 'responsive',
                                'size_units' => ['px', 'custom'],
                                'range' => [
                                    'px' => [
                                        'min' => 0,
                                        'max' => 1000,
                                    ],
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .grid .grid__inner .grid__item{{CURRENT_ITEM}}' => 'height: {{SIZE}}{{UNIT}};',
                                ],
                            ),
                            array(
                                'name' => 'grid_item_img_dimension',
                                'label' => esc_html__('Image Dimension', 'komestic'),
                                'type' => 'select',
                                'options' => [
                                    ''              => esc_html__('Default', 'komestic'),
                                    'thumbnail'     => esc_html__('Thumbnail', 'komestic'),
                                    'thumb'         => esc_html__('Thumb (Alias of Thumbnail)', 'komestic'),
                                    'medium'        => esc_html__('Medium', 'komestic'),
                                    'medium_large'  => esc_html__('Medium Large', 'komestic'),
                                    'large'         => esc_html__('Large', 'komestic'),
                                    'full'          => esc_html__('Full (Original)', 'komestic'),
                                    'custom'        => esc_html__('Custom', 'komestic'),
                                ],
                                'default' => '',
                            ),
                            array(
                                'name' => 'grid_item_img_dimension_custom',
                                'label' => esc_html__( 'Image Dimension Custom', 'komestic' ),
                                'type' => 'image_dimensions',
                                'separator' => 'before',
                                'description' => esc_html__( 'Crop the original image size to any custom size. Set custom width or height to keep the original size ratio.', 'komestic' ),
                                'condition' => [
                                    'grid_item_img_dimension' => 'custom',
                                ],
                            ),
                        ),
                    ),
                ],
            ],
        ],
    );

    return $options;
}


// Swiper Options
function swiper_controls_options($args = []) {
    $condition = isset($args['condition']) ? $args['condition'] : [];
    return array(
        'name' => 'swiper_controls',
        'control_type' => 'tab',
        'tabs' => [
            [
                'name' => 'swiper_options',
                'label' => esc_html__('Options', 'komestic' ),
                'type' => 'tab',
                'condition' => [
                    'layout_type' => 'carousel',
                ],
                'controls' => [  
                    array(
                        'name' => 'swiper_boxshadow',
                        'label' => esc_html__('Slide with Box Shadow', 'komestic' ),
                        'type' => 'select',
                        'options' => array(
                            ''                 => esc_html__('No', 'komestic' ),
                            'swiper-boxshadow' => esc_html__('Yes', 'komestic' ),
                        ),
                        'default' => '',
                    ),
                    array(
                        'name' => 'swiper_divider',
                        'type' => 'divider',
                    ),
                    array(
                        'name' => 'allow_touch_move',
                        'label' => esc_html__('Allow Touch Move', 'komestic'),
                        'type' => 'switcher',
                        'default' => 'true',
                    ),
                    array(
                        'name' => 'autoplay',
                        'label' => esc_html__('Autoplay', 'komestic'),
                        'type' => 'switcher',
                        'default' => '',
                    ),
                    array(
                        'name' => 'disable_on_interaction',
                        'label' => esc_html__('Pause on Interaction', 'komestic'),
                        'type' => 'switcher',
                        'default' => '',
                        'condition' => [
                            'autoplay!' => '',
                        ],
                    ),
                    array(
                        'name' => 'delay',
                        'label' => esc_html__('Delay', 'komestic'),
                        'type' => 'number',
                        'default' => 3000,
                        'condition' => [
                            'autoplay!' => '',
                        ],
                    ),
                    array(
                        'name' => 'loop',
                        'label' => esc_html__('Infinite Loop', 'komestic'),
                        'type' => 'switcher',
                        'default' => '',
                    ),
                    array(
                        'name' => 'speed',
                        'label' => esc_html__('Animation Speed', 'komestic'),
                        'type' => 'number',
                        'default' => 300,
                    ),
                    array(
                        'name' => 'space_between',
                        'label' => esc_html__('Space Between(px)', 'komestic'),
                        'type' => 'number',
                        'control_type' => 'responsive',
                        'default' => 30,
                    ),
                    array(
                        'name' => 'swiper_pagination',
                        'type' => 'select',
                        'label' => esc_html__('Pagination', 'komestic'),
                        'separator' => 'before',
                        'options' => [
                            ''            => esc_html__('None', 'komestic'),
                            'bullets'     => esc_html__('Bullets', 'komestic'),
                            'progressbar' => esc_html__('Progressbar', 'komestic'),
                            'fraction'    => esc_html__('Fraction', 'komestic'),
                        ],
                    ),
                    array(
                        'name' => 'swiper_navigation',
                        'label' => esc_html__('Navigation', 'komestic'),
                        'type' => 'switcher',
                        'default' => '',
                    ),
                    array(
                        'name' => 'use_swiper_nav_widget',
                        'label' => esc_html__('Use Navigation Widget', 'komestic'),
                        'type' => 'switcher',
                        'default' => '',
                        'condition' => [
                            'swiper_navigation!' => '',
                        ],
                    ),
                    array(
                        'name' => 'nav_widget_id',
                        'type' => 'text',
                        'label' => esc_html__('Enter ID Your Widget Navigation', 'komestic'),
                        'condition' => [
                            'swiper_navigation!' => '',
                            'use_swiper_nav_widget!' => ''
                        ],
                        'description' => esc_html__('You need to enter the unique ID you created from the navigation carousel widget, and the navigation with this ID will function as a navigation carousel.', 'komestic'),
                    ),
                    array(
                        'name' => 'nav_btn_icon_prev',
                        'label' => esc_html__('Button Icon Prev', 'komestic' ),
                        'type' => 'icons',
                        'fa4compatibility' => 'icon',
                        'default' => [
                            'value' => 'flaticon flaticon-chevron-left',
                            'library' => 'Flaticon',
                        ],
                        'condition' => [
                            'swiper_navigation!' => '',
                            'use_swiper_nav_widget' => ''
                        ],
                    ),
                    array(
                        'name' => 'nav_btn_icon_next',
                        'label' => esc_html__('Button Icon Next', 'komestic' ),
                        'type' => 'icons',
                        'fa4compatibility' => 'icon',
                        'default' => [
                            'value' => 'flaticon flaticon-chevron-right',
                            'library' => 'Flaticon',
                        ],
                        'condition' => [
                            'swiper_navigation!' => '',
                            'use_swiper_nav_widget' => ''
                        ],
                    ),
                ],
            ],
            [
                'name' => 'swiper_layout',
                'label' => esc_html__('Layout', 'komestic' ),
                'type' => 'tab',
                'controls' => [
                    array(
                        'name' => 'swiper_container',
                        'label' => esc_html__('Container', 'komestic'),
                        'type' => 'slider',
                        'control_type' => 'responsive',
                        'size_units' => ['px', 'custom'],
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 1000,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-swiper .swiper-inner' => 'max-width: {{SIZE}}{{UNIT}}; margin: 0 auto;',
                        ],
                    ),
                    array(
                        'name' => 'swiper_padding',
                        'label' => esc_html__('Padding', 'komestic' ),
                        'type' => 'dimensions',
                        'size_units' => [ 'px', 'custom' ],
                        'control_type' => 'responsive',
                        'selectors' => [
                            '{{WRAPPER}} .pxl-swiper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ),
                    array(
                        'name' => 'swiper_nav_margin',
                        'label' => esc_html__('Navigation Margin', 'komestic' ),
                        'type' => 'dimensions',
                        'size_units' => [ 'px', 'custom' ],
                        'control_type' => 'responsive',
                        'separator' => 'before',
                        'selectors' => [
                            '{{WRAPPER}} .pxl-swiper .swiper-navigation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ),
                    array(
                        'name' => 'swiper_pagination_margin',
                        'label' => esc_html__('Pagination Margin', 'komestic' ),
                        'type' => 'dimensions',
                        'size_units' => [ 'px', 'custom' ],
                        'control_type' => 'responsive',
                        'separator' => 'before',
                        'selectors' => [
                            '{{WRAPPER}} .pxl-swiper .swiper-pagination' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ),
                ],
            ],
            [
                'name' => 'swiper_responsive',
                'label' => esc_html__('Responsive', 'komestic' ),
                'type' => 'tab',
                'controls' => [
                    array(
                        'name' => 'slides_per_view_xs',
                        'label' => esc_html__('Slides Per View(<576px)', 'komestic' ),
                        'type' => 'select',
                        'default' => '',
                        'options' => [
                            ''  => 'Default',
                            '1' => '1',
                            '2' => '2',
                            '3' => '3',
                            '4' => '4',
                            '5' => '5',
                            '6' => '6',
                        ],
                    ),
                    array(
                        'name' => 'slides_per_view_sm',
                        'label' => esc_html__('Slides Per View(≥576px)', 'komestic' ),
                        'type' => 'select',
                        'default' => '',
                        'options' => [
                            ''  => 'Default',
                            '1' => '1',
                            '2' => '2',
                            '3' => '3',
                            '4' => '4',
                            '5' => '5',
                            '6' => '6',
                        ],
                    ),
                    array(
                        'name' => 'slides_per_view_md',
                        'label' => esc_html__('Slides Per View(≥768px)', 'komestic' ),
                        'type' => 'select',
                        'default' => '',
                        'options' => [
                            ''  => 'Default',
                            '1' => '1',
                            '2' => '2',
                            '3' => '3',
                            '4' => '4',
                            '5' => '5',
                            '6' => '6',
                        ],
                    ),
                    array(
                        'name' => 'slides_per_view_lg',
                        'label' => esc_html__('Slides Per View(≥992px)', 'komestic' ),
                        'type' => 'select',
                        'default' => '',
                        'options' => [
                            ''  => 'Default',
                            '1' => '1',
                            '2' => '2',
                            '3' => '3',
                            '4' => '4',
                            '5' => '5',
                            '6' => '6',
                        ],
                    ),
                    array(
                        'name' => 'slides_per_view_xl',
                        'label' => esc_html__('Slides Per View(≥1200px)', 'komestic' ),
                        'type' => 'select',
                        'default' => '',
                        'options' => [
                            ''  => 'Default',
                            '1' => '1',
                            '2' => '2',
                            '3' => '3',
                            '4' => '4',
                            '5' => '5',
                            '6' => '6',
                            '7' => '7',
                        ],
                    ),
                    array(
                        'name' => 'slides_per_view_xxl',
                        'label' => esc_html__('Slides Per View(≥1400px)', 'komestic' ),
                        'type' => 'select',
                        'default' => '',
                        'options' => [
                            ''  => 'Default',
                            '1' => '1',
                            '2' => '2',
                            '3' => '3',
                            '4' => '4',
                            '5' => '5',
                            '6' => '6',
                            '7' => '7',
                            '8' => '8',
                        ],
                    ),
                ],
            ],
        ],
    );
}

// Bullets Pagination Carousel Style Options
function swiper_bullets_pagination_style_options() {
    return [
        'name' => 'tab_swiper_bullets_pagination_style',
        'label' => esc_html__('Pagination Bullets', 'komestic'),
        'tab' => 'style',
        'condition' => [
            'swiper_pagination' => 'bullets',
        ],
        'controls' => [
            array(
                'name' => 'bullet_size',
                'label' => esc_html__('Bullet Size', 'komestic' ),
                'type' => 'slider',
                'size_units' => ['px', 'custom'],
                'control_type' => 'responsive',
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pxl-swiper .swiper-pagination.swiper-pagination-bullets .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; min-width: {{SIZE}}{{UNIT}};',
                ],
            ),
            array(
                'name' => 'bullet_dot_size',
                'label' => esc_html__('Dot Inset', 'komestic' ),
                'type' => 'slider',
                'size_units' => ['px', 'custom'],
                'control_type' => 'responsive',
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pxl-swiper .swiper-pagination.swiper-pagination-bullets .swiper-pagination-bullet:before' => 'inset: {{SIZE}}{{UNIT}};',
                ],
            ),
            array(
                'name' => 'divider_bullet_1',
                'type' => 'divider',
            ),
            array(
                'name' => 'bullet_controls',
                'control_type' => 'tab',
                'tabs' => [
                    [
                        'name' => 'swiper_bullet_layout',
                        'label' => esc_html__('Layout', 'komestic' ),
                        'type' => 'tab',
                        'controls' => array_merge(
                            array(
                                array(
                                    'name' => 'bullets_spacing_top',
                                    'label' => esc_html__('Spacing Top', 'komestic'),
                                    'type' => 'slider',
                                    'control_type' => 'responsive',
                                    'size_units' => ['px', 'custom'],
                                    'range' => [
                                        'px' => [
                                            'min' => 0,
                                            'max' => 1000,
                                        ],
                                    ],
                                    'selectors' => [
                                        '{{WRAPPER}} .pxl-swiper .swiper-pagination.swiper-pagination-bullets' => 'margin-top: {{SIZE}}{{UNIT}};',
                                    ],
                                ),
                                array (
                                    'name' => 'swiper_bullets_width',
                                    'label' => esc_html__('Width', 'komestic' ),
                                    'type' => 'slider',
                                    'size_units' => ['px', '%', 'custom'],
                                    'control_type' => 'responsive',
                                    'range' => [
                                        'px' => [
                                            'min' => 0,
                                            'max' => 1920,
                                        ],
                                    ],
                                    'selectors' => [
                                        '{{WRAPPER}} .pxl-swiper .swiper-pagination-bullets' => 'width: {{SIZE}}{{UNIT}};',
                                    ],
                                ),
                                array (
                                    'name' => 'swiper_bullets_height',
                                    'label' => esc_html__('Height', 'komestic' ),
                                    'type' => 'slider',
                                    'size_units' => ['px', '%', 'custom'],
                                    'control_type' => 'responsive',
                                    'range' => [
                                        'px' => [
                                            'min' => 0,
                                            'max' => 1920,
                                        ],
                                    ],
                                    'selectors' => [
                                        '{{WRAPPER}} .pxl-swiper .swiper-pagination-bullets' => 'height: {{SIZE}}{{UNIT}};',
                                    ],
                                ),
                                array(
                                    'name' => 'swiper_bullets_flex_dir',
                                    'label' => esc_html__('Direction', 'komestic'),
                                    'type' => 'select',
                                    'separator' => 'before',
                                    'options' => [
                                        '' => esc_html__('Default', 'komestic'),
                                        'row' => esc_html__('Row', 'komestic'),
                                        'column' => esc_html__('Column', 'komestic'),
                                    ],
                                    'selectors' => [
                                        '{{WRAPPER}} .pxl-swiper .swiper-pagination-bullets' => 'flex-direction: {{VALUE}};',
                                    ],
                                ),
                                array(
                                    'name' => 'swiper_bullets_content_h',
                                    'label' => esc_html__('Justify Content', 'komestic' ),
                                    'type' => 'choose',
                                    'control_type' => 'responsive',
                                    'separator' => 'before',
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
                                    'condition' => [
                                        'swiper_bullets_flex_dir!' => 'column',
                                    ],
                                    'selectors' => [
                                        '{{WRAPPER}} .pxl-swiper .swiper-pagination-bullets' => 'justify-content: {{VALUE}};',
                                    ],
                                ),
                                array(
                                    'name' => 'swiper_bullets_content_v',
                                    'label' => esc_html__('Justify Content', 'komestic' ),
                                    'type' => 'choose',
                                    'control_type' => 'responsive',
                                    'separator' => 'before',
                                    'options' => [
                                        'start' => [
                                            'title' => esc_html__('Start', 'komestic' ),
                                            'icon' => 'eicon-justify-start-v',
                                        ],
                                        'center' => [
                                            'title' => esc_html__('Center', 'komestic' ),
                                            'icon' => 'eicon-justify-center-v',
                                        ],
                                        'end' => [
                                            'title' => esc_html__('End', 'komestic' ),
                                            'icon' => 'eicon-justify-end-v',
                                        ],
                                    ],
                                    'condition' => [
                                        'swiper_bullets_flex_dir' => 'column',
                                    ],
                                    'selectors' => [
                                        '{{WRAPPER}} .pxl-swiper .swiper-pagination-bullets' => 'justify-content: {{VALUE}};',
                                    ],
                                ),
                                array(
                                    'name' => 'align_items_h',
                                    'label' => esc_html__('Align Items', 'komestic'),
                                    'type' => 'choose',
                                    'control_type' => 'responsive',
                                    'options' => array(
                                        'start' => [
                                            'title' => esc_html__('Start', 'komestic' ),
                                            'icon' => 'eicon-align-start-h',
                                        ],
                                        'center' => [
                                            'title' => esc_html__('Center', 'komestic' ),
                                            'icon' => 'eicon-align-center-h',
                                        ],
                                        'end' => [
                                            'title' => esc_html__('End', 'komestic' ),
                                            'icon' => 'eicon-align-end-h',
                                        ],
                                    ),
                                    'selectors' => [
                                        '{{WRAPPER}} .pxl-swiper .swiper-pagination-bullets' => 'align-items: {{VALUE}};'
                                    ],
                                    'condition' => [
                                        'swiper_bullets_flex_dir!' => 'column',
                                    ]
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
                                        '{{WRAPPER}} .pxl-swiper .swiper-pagination-bullets' => 'align-items: {{VALUE}};'
                                    ],
                                    'condition' => [
                                        'swiper_bullets_flex_dir' => 'column',
                                    ]
                                ),
                            ),
                            komestic_position_options([
                                'prefix' => 'swiper_bullet',
                                'selectors' => '{{WRAPPER}} .pxl-swiper .swiper-pagination-bullets',
                            ]),
                        ),
                    ],
                    [
                        'name' => 'bullet_normal',
                        'label' => esc_html__('Normal', 'komestic' ),
                        'type' => 'tab',
                        'controls' => [  
                            array(
                                'name' => 'bullet_color',
                                'label' => esc_html__('Bullet Color', 'komestic' ),
                                'type' => 'color',
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-swiper .swiper-pagination.swiper-pagination-bullets .swiper-pagination-bullet' => 'color: {{VALUE}};',
                                ],
                            ),
                            array(
                                'name' => 'bullet_background',
                                'type' => \Elementor\Group_Control_Background::get_type(),
                                'control_type' => 'group',
                                'types' => [ 'classic', 'gradient' ],
                                'selector' => '{{WRAPPER}} .pxl-swiper .swiper-pagination.swiper-pagination-bullets .swiper-pagination-bullet',
                            ),
                            array(
                                'name' => 'bullet_border',
                                'type' => \Elementor\Group_Control_Border::get_type(),
                                'separator' => 'before',
                                'control_type' => 'group', 
                                'selector' => '{{WRAPPER}} .pxl-swiper .swiper-pagination.swiper-pagination-bullets .swiper-pagination-bullet',
                            ),
                            array(
                                'name'         => 'bullet_box_shadow',
                                'label' => esc_html__( 'Box Shadow', 'komestic' ),
                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                'control_type' => 'group',
                                'selector'     => '{{WRAPPER}} .pxl-swiper .swiper-pagination.swiper-pagination-bullets .swiper-pagination-bullet',
                            ),
                            array(
                                'name' => 'bullet_border_radius',
                                'label' => esc_html__('Border Radius', 'komestic' ),
                                'type' => 'dimensions',
                                'size_units' => [ 'px', 'custom' ],
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-swiper .swiper-pagination.swiper-pagination-bullets .swiper-pagination-bullet' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                            ),
                        ],
                    ],
                    [
                        'name' => 'bullet_hover',
                        'label' => esc_html__('Hover/Active', 'komestic' ),
                        'type' => 'tabs',
                        'controls' => [
                            array(
                                'name' => 'bullet_hove_color',
                                'label' => esc_html__('Bullet Color', 'komestic' ),
                                'type' => 'color',
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-swiper .swiper-pagination.swiper-pagination-bullets .swiper-pagination-bullet:hover' => 'color: {{VALUE}};',
                                ],
                            ),
                            array(
                                'name' => '_bullet_hover_border_color',
                                'label' => esc_html__('Border Color', 'komestic' ),
                                'type' => 'color',
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-swiper .swiper-pagination.swiper-pagination-bullets .swiper-pagination-bullet:hover' => 'border-color: {{VALUE}};',
                                ],
                            ),
                            array(
                                'name' => 'bullet_hover_background',
                                'type' => \Elementor\Group_Control_Background::get_type(),
                                'control_type' => 'group',
                                'types' => [ 'classic', 'gradient' ],
                                'selector' => '{{WRAPPER}} .pxl-swiper .swiper-pagination.swiper-pagination-bullets .swiper-pagination-bullet:hover',
                            ),
                            array(
                                'name' => 'bullet_hover_border',
                                'type' => \Elementor\Group_Control_Border::get_type(),
                                'separator' => 'before',
                                'control_type' => 'group', 
                                'selector' => '{{WRAPPER}} .pxl-swiper .swiper-pagination.swiper-pagination-bullets .swiper-pagination-bullet:hover'
                            ),
                            array(
                                'name'         => 'bullet_hover_box_shadow',
                                'label' => esc_html__( 'Box Shadow', 'komestic' ),
                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                'control_type' => 'group',
                                'selector'     => '{{WRAPPER}} .pxl-swiper .swiper-pagination.swiper-pagination-bullets .swiper-pagination-bullet:hover'
                            ),
                            array(
                                'name' => 'bullet_hover_border_radius',
                                'label' => esc_html__('Border Radius', 'komestic' ),
                                'type' => 'dimensions',
                                'size_units' => [ 'px', 'custom' ],
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-swiper .swiper-pagination.swiper-pagination-bullets .swiper-pagination-bullet:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                            ),
                        ],
                    ],
                ],
            ),
        ],
    ];
}

// Source Post Settings
function komestic_source_post_settings($post_type) {
    return array(
        'name' => 'tab_source',
        'label' => esc_html__('Source', 'komestic' ),
        'tab' => 'settings',
        'controls' => array_merge(
            array(
                array(
                    'name'     => 'select_post_by',
                    'label'    => esc_html__( 'Select posts by', 'komestic' ),
                    'type'     => 'select',
                    'multiple' => true,
                    'options'  => [
                        'term_selected' => esc_html__( 'Terms selected', 'komestic' ),
                        'post_selected' => esc_html__( 'Posts selected ', 'komestic' ),
                    ],
                    'default'  => 'term_selected',
                ) 
            ),
            komestic_get_term_by_post_type($post_type, ['custom_condition' => ['select_post_by' => 'term_selected']]),
            komestic_get_ids_by_post_type($post_type, ['custom_condition' => ['select_post_by' => 'post_selected']]),
            array(
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
    );
}

// Grid Pagination Options Style  
function grid_pagination_style_options() {
    return [
        'name' => 'tab_grid_pagination_style',
        'label' => esc_html__('Pagination', 'komestic'),
        'tab' => 'style',
        'condition' => [
            'grid_pagination' => 'pagination',
        ],
        'controls' => [
            array(
                'name' => 'pagination_box_sz',
                'label' => esc_html__('Box Size', 'komestic' ),
                'type' => 'slider',
                'size_units' => ['px', 'custom'],
                'control_type' => 'responsive',
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .grid .grid-pagination .page-numbers' => '--pxl-box-size: {{SIZE}}{{UNIT}};',
                ],
            ),
            array(
                'name' => 'pagination_typography',
                'type' => \Elementor\Group_Control_Typography::get_type(),
                'control_type' => 'group',
                'selector' => '{{WRAPPER}} .grid .grid-pagination .page-numbers',
            ),
            array(
                'name' => 'divider_pagination_1',
                'type' => 'divider',
            ),
            array(
                'name' => 'pagination_controls',
                'control_type' => 'tab',
                'tabs' => [
                    [
                        'name' => 'pagination_normal',
                        'label' => esc_html__('Normal', 'komestic' ),
                        'type' => 'tab',
                        'controls' => [  
                            array(
                                'name' => 'pagination_color',
                                'label' => esc_html__('Text Color', 'komestic' ),
                                'type' => 'color',
                                'selectors' => [
                                    '{{WRAPPER}} .grid .grid-pagination .page-numbers' => 'color: {{VALUE}};',
                                ],
                            ),
                            array(
                                'name' => 'pagination_bg',
                                'type' => \Elementor\Group_Control_Background::get_type(),
                                'control_type' => 'group',
                                'types' => [ 'classic', 'gradient' ],
                                'selector' => '{{WRAPPER}} .grid .grid-pagination .page-numbers',
                            ),
                            array(
                                'name' => 'pagination_border',
                                'type' => \Elementor\Group_Control_Border::get_type(),
                                'separator' => 'before',
                                'control_type' => 'group', 
                                'selector' => '{{WRAPPER}} .grid .grid-pagination .page-numbers',
                            ),
                            array(
                                'name'         => 'pagination_box_shadow',
                                'label' => esc_html__( 'Box Shadow', 'komestic' ),
                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                'control_type' => 'group',
                                'selector'     => '{{WRAPPER}} .grid .grid-pagination .page-numbers',
                            ),
                            array(
                                'name' => 'pagination_border_radius',
                                'label' => esc_html__('Border Radius', 'komestic' ),
                                'type' => 'dimensions',
                                'size_units' => [ 'px', 'custom' ],
                                'selectors' => [
                                    '{{WRAPPER}} .grid .grid-pagination .page-numbers' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                            ),
                        ],
                    ],
                    [
                        'name' => 'pagination_hover',
                        'label' => esc_html__('Hover/Current', 'komestic' ),
                        'type' => 'tabs',
                        'controls' => [
                            array(
                                'name' => 'pagination_hove_color',
                                'label' => esc_html__('Text Color', 'komestic' ),
                                'type' => 'color',
                                'selectors' => [
                                    '{{WRAPPER}} .grid .grid-pagination .page-numbers:hover' => 'color: {{VALUE}};',
                                ],
                            ),
                            array(
                                'name' => '_pagination_hover_border_color',
                                'label' => esc_html__('Border Color', 'komestic' ),
                                'type' => 'color',
                                'selectors' => [
                                    '{{WRAPPER}} .grid .grid-pagination .page-numbers:hover' => 'border-color: {{VALUE}};',
                                ],
                            ),
                            array(
                                'name' => 'pagination_hover_bg',
                                'type' => \Elementor\Group_Control_Background::get_type(),
                                'control_type' => 'group',
                                'types' => [ 'classic', 'gradient' ],
                                'selector' => '{{WRAPPER}} .grid .grid-pagination .page-numbers:hover',
                            ),
                            array(
                                'name' => 'pagination_hover_border',
                                'type' => \Elementor\Group_Control_Border::get_type(),
                                'separator' => 'before',
                                'control_type' => 'group', 
                                'selector' => '{{WRAPPER}} .grid .grid-pagination .page-numbers:hover'
                            ),
                            array(
                                'name'         => 'pagination_hover_box_shadow',
                                'label' => esc_html__( 'Box Shadow', 'komestic' ),
                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                'control_type' => 'group',
                                'selector'     => '{{WRAPPER}} .grid .grid-pagination .page-numbers:hover'
                            ),
                            array(
                                'name' => 'pagination_hover_border_radius',
                                'label' => esc_html__('Border Radius', 'komestic' ),
                                'type' => 'dimensions',
                                'size_units' => [ 'px', 'custom' ],
                                'selectors' => [
                                    '{{WRAPPER}} .grid .grid-pagination .page-numbers:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                            ),
                        ],
                    ],
                ],
            ),
        ],
    ];
}

// Swiper Navigation Carousel Style Options
function swiper_navigation_button_style_options() {
    $options = [
        'name' => 'tab_swiper_nav_btn_style',
        'tab' => 'style',
        'label' => esc_html__('Navigation Button', 'komestic'),
        'condition' => [
            'swiper_navigation!' => '',
        ],
        'controls' => [
            array(
                'name' => 'nav_btn_box_size',
                'label' => esc_html__('Box Size', 'komestic' ),
                'type' => 'slider',
                'size_units' => ['px' , 'custom'],
                'control_type' => 'responsive',
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pxl-swiper .swiper-navigation .pxl-swiper-button, 
                    {{WRAPPER}} .pxl-slider .swiper-navigation .pxl-swiper-button' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; min-width: {{SIZE}}{{UNIT}};',
                ],
            ),
            array(
                'name' => 'nav_btn_icon_size',
                'label' => esc_html__('Icon Size', 'komestic'),
                'type' => 'slider',
                'control_type' => 'responsive' ,
                'size_units' => ['px', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0, 
                        'max' => 1000
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pxl-swiper .swiper-navigation .pxl-swiper-button,
                    {{WRAPPER}} .pxl-slider .swiper-navigation .pxl-swiper-button' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .pxl-swiper .swiper-navigation .pxl-swiper-button svg,
                    {{WRAPPER}} .pxl-slider .swiper-navigation .pxl-swiper-button svg' => 'width: {{SIZE}}{{UNIT}}; height : auto;',
                ],
            ),
            array(
                'name' => 'nav_btn_controls',
                'control_type' => 'tab',
                'tabs' => [
                    [
                        'name' => 'nav_btn_layout',
                        'label' => esc_html__('Layout', 'komestic' ),
                        'type' => 'tab',
                        'controls' => array_merge(
                            array(
                                array(
                                    'name' => 'swiper_nav_display',
                                    'label' => esc_html__('Display', 'komestic'),
                                    'type' => 'select',
                                    'control_type' => 'responsive',
                                    'options' => [
                                        '' => esc_html__('Auto', 'komestic'),
                                        'none' => esc_html__('None', 'komestic'),
                                    ],
                                    'default' => '',
                                    'selectors' => [
                                        '{{WRAPPER}} .pxl-swiper .swiper-navigation' => 'display: {{VALUE}};',
                                    ],
                                ),
                                array (
                                    'name' => 'swiper_nav_width',
                                    'label' => esc_html__('Width', 'komestic' ),
                                    'type' => 'slider',
                                    'size_units' => ['px', '%', 'custom'],
                                    'control_type' => 'responsive',
                                    'range' => [
                                        'px' => [
                                            'min' => 0,
                                            'max' => 1920,
                                        ],
                                    ],
                                    'selectors' => [
                                        '{{WRAPPER}} .pxl-swiper .swiper-navigation' => 'width: {{SIZE}}{{UNIT}};',
                                    ],
                                    'condition' => [
                                        'swiper_navigation!' => '',
                                        'use_swiper_nav_widget' => ''
                                    ],
                                ),
                                array(
                                    'name' => 'nav_gap',
                                    'label' => esc_html__('Gap', 'komestic'),
                                    'type' => 'slider',
                                    'control_type' => 'responsive',
                                    'size_units' => ['px', 'custom'],
                                    'range' => [
                                        'px' => [
                                            'min' => 0,
                                            'max' => 1000,
                                        ],
                                    ],
                                    'selectors' => [
                                        '{{WRAPPER}} .pxl-swiper .swiper-navigation' => 'gap: {{SIZE}}{{UNIT}};',
                                    ],
                                    'condition' => [
                                        'swiper_navigation!' => '',
                                        'use_swiper_nav_widget' => ''
                                    ],
                                ),
                                array(
                                    'name' => 'nav_spacing_top',
                                    'label' => esc_html__('Spacing Top', 'komestic'),
                                    'type' => 'slider',
                                    'control_type' => 'responsive',
                                    'size_units' => ['px', 'custom'],
                                    'range' => [
                                        'px' => [
                                            'min' => 0,
                                            'max' => 1000,
                                        ],
                                    ],
                                    'selectors' => [
                                        '{{WRAPPER}} .pxl-swiper .swiper-navigation' => 'margin-top: {{SIZE}}{{UNIT}};',
                                    ],
                                    'condition' => [
                                        'swiper_navigation!' => '',
                                        'use_swiper_nav_widget' => ''
                                    ],
                                ),
                                array(
                                    'name' => 'swiper_navjustify_content_h',
                                    'label' => esc_html__('Justify Content', 'komestic' ),
                                    'type' => 'choose',
                                    'control_type' => 'responsive',
                                    'separator' => 'before',
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
                                        'space-around' => [
                                            'title' => esc_html__('Space Around', 'komestic' ),
                                            'icon' => 'eicon-justify-space-around-h',
                                        ],
                                        'space-evenly' => [
                                            'title' => esc_html__('Space Evenly', 'komestic' ),
                                            'icon' => 'eicon-justify-space-evenly-h',
                                        ],
                                        'space-between' => [
                                            'title' => esc_html__('Space Between', 'komestic' ),
                                            'icon' => 'eicon-justify-space-between-h',
                                        ],
                                    ],
                                    'label_block' => true,
                                    'selectors' => [
                                        '{{WRAPPER}} .pxl-swiper .swiper-navigation' => 'justify-content: {{VALUE}};',
                                    ],
                                    'condition' => [
                                        'swiper_navigation!' => '',
                                        'use_swiper_nav_widget' => ''
                                    ],
                                ),
                            ),
                            komestic_position_options([
                                'prefix' => 'nav_btn',
                                'selectors' => '{{WRAPPER}} .pxl-swiper .swiper-navigation',
                                'condition' => [
                                    'swiper_navigation!' => '',
                                    'use_swiper_nav_widget' => ''
                                ],
                            ]),
                        ),
                    ],
                    [
                        'name' => 'nav_btn_normal',
                        'label' => esc_html__('Normal', 'komestic' ),
                        'type' => 'tab',
                        'controls' => [  
                            array(
                                'name' => 'nav_btn_color',
                                'label' => esc_html__('Color', 'komestic' ),
                                'type' => 'color',
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-swiper .swiper-navigation .pxl-swiper-button, {{WRAPPER}} .pxl-slider .swiper-navigation .pxl-swiper-button' => 'color: {{VALUE}};',
                                ],
                            ),
                            array(
                                'name' => 'nav_btn_background',
                                'type' => \Elementor\Group_Control_Background::get_type(),
                                'control_type' => 'group',
                                'types' => [ 'classic', 'gradient' ],
                                'selector' => '{{WRAPPER}} .pxl-swiper .swiper-navigation .pxl-swiper-button, {{WRAPPER}} .pxl-slider .swiper-navigation .pxl-swiper-button',
                            ),
                            array(
                                'name' => 'nav_btn_border',
                                'type' => \Elementor\Group_Control_Border::get_type(),
                                'separator' => 'before',
                                'control_type' => 'group', 
                                'selector' => '{{WRAPPER}} .pxl-swiper .swiper-navigation .pxl-swiper-button, {{WRAPPER}} .pxl-slider .swiper-navigation .pxl-swiper-button',
                            ),
                            array(
                                'name'         => 'nav_btn_box_shadow',
                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                'control_type' => 'group',
                                'selector'     => '{{WRAPPER}} .pxl-swiper .swiper-navigation .pxl-swiper-button, {{WRAPPER}} .pxl-slider .swiper-navigation .pxl-swiper-button',
                            ),
                            array(
                                'name' => 'nav_btn_border_radius',
                                'label' => esc_html__('Border Radius', 'komestic' ),
                                'type' => 'dimensions',
                                'size_units' => [ 'px', 'custom' ],
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-swiper .swiper-navigation .pxl-swiper-button, {{WRAPPER}} .pxl-slider .swiper-navigation .pxl-swiper-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                            ),
                            array(
                                'name' => 'nav_btn_padding',
                                'label' => esc_html__('Padding', 'komestic' ),
                                'type' => 'dimensions',
                                'size_units' => [ 'px', 'custom' ],
                                'control_type' => 'responsive',
                                'separator' => 'before',
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-swiper .swiper-navigation .pxl-swiper-button, {{WRAPPER}} .pxl-slider .swiper-navigation .pxl-swiper-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                            ),
                        ],
                    ],
                    [
                        'name' => 'nav_btn_hover',
                        'label' => esc_html__('Hover', 'komestic' ),
                        'type' => 'tabs',
                        'controls' => [
                            array(
                                'name' => 'nav_btn_hover_color',
                                'label' => esc_html__('Color', 'komestic' ),
                                'type' => 'color',
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-swiper .swiper-navigation .pxl-swiper-button:hover, {{WRAPPER}} .pxl-slider .swiper-navigation .pxl-swiper-button:hover' => 'color: {{VALUE}};',
                                ],
                            ),
                            array(
                                'name' => '_nav_btn_hover_border_color',
                                'label' => esc_html__('Border Color', 'komestic' ),
                                'type' => 'color',
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-swiper .swiper-navigation .pxl-swiper-button:hover, {{WRAPPER}} .pxl-slider .swiper-navigation .pxl-swiper-button:hover' => 'border-color: {{VALUE}};',
                                ],
                            ),
                            array(
                                'name' => 'nav_btn_hover_background',
                                'type' => \Elementor\Group_Control_Background::get_type(),
                                'control_type' => 'group',
                                'types' => [ 'classic', 'gradient' ],
                                'selector' => '{{WRAPPER}} .pxl-swiper .swiper-navigation .pxl-swiper-button:hover, {{WRAPPER}} .pxl-slider .swiper-navigation .pxl-swiper-button:hover',
                            ),
                            array(
                                'name' => 'nav_btn_hover_border',
                                'type' => \Elementor\Group_Control_Border::get_type(),
                                'separator' => 'before',
                                'control_type' => 'group', 
                                'selector' => '{{WRAPPER}} .pxl-swiper .swiper-navigation .pxl-swiper-button:hover, {{WRAPPER}} .pxl-slider .swiper-navigation .pxl-swiper-button:hover',
                            ),
                            array(
                                'name'         => 'nav_btn_hover_box_shadow',
                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                'control_type' => 'group',
                                'selector'     => '{{WRAPPER}} .pxl-swiper .swiper-navigation .pxl-swiper-button:hover, {{WRAPPER}} .pxl-slider .swiper-navigation .pxl-swiper-button:hover',
                            ),
                            array(
                                'name' => 'nav_btn_hover_border_radius',
                                'label' => esc_html__('Border Radius', 'komestic' ),
                                'type' => 'dimensions',
                                'size_units' => [ 'px', 'custom' ],
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-swiper .swiper-navigation .pxl-swiper-button:hover, {{WRAPPER}} .pxl-slider .swiper-navigation .pxl-swiper-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                            ),
                            array(
                                'name' => 'nav_btn_hover_padding',
                                'label' => esc_html__('Padding', 'komestic' ),
                                'type' => 'dimensions',
                                'size_units' => [ 'px', 'custom' ],
                                'control_type' => 'responsive',
                                'separator' => 'before',
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-swiper .swiper-navigation .pxl-swiper-button:hover, {{WRAPPER}} .pxl-slider .swiper-navigation .pxl-swiper-button:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                            ),
                        ],
                    ],
                ],
            ),
        ]
    ];
    return $options;
}

// Load More Button Style Options
function load_more_button_style_options() {
    $options = [
        'name' => 'tab_load_more_btn_style',
        'tab' => 'style',
        'label' => esc_html__('Load More', 'komestic'),
        'condition' => [
            'grid_pagination' => 'loadmore',
        ],
        'controls' => [
            array(
                'name' => 'btn_load_more_icon_translate_y',
                'label' => esc_html__('Icon Translate Y', 'komestic'),
                'type' => 'slider',
                'control_type' => 'responsive' ,
                'size_units' => ['px', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0, 
                        'max' => 1000
                    ],
                ],
                'condition' => [
                    'load_more_style' => ['load-more-button-default'],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pxl-load-more-wrapper .pxl-load-more-button' => '--pxl-translate-y: {{SIZE}}{{UNIT}};',
                ],
            ),
            array(
                'name' => 'btn_load_more_icon_sz',
                'label' => esc_html__('Icon Size', 'komestic'),
                'type' => 'slider',
                'control_type' => 'responsive' ,
                'size_units' => ['px', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0, 
                        'max' => 1000
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pxl-load-more-wrapper .pxl-load-more-button .pxl-btn-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .pxl-load-more-wrapper .pxl-load-more-button .pxl-btn-icon svg' => 'height: {{SIZE}}{{UNIT}}; width : auto;',
                ],
            ),
            array(
                'name' => 'btn_load_more_h',
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
                'condition' => [
                    'load_more_style' => ['pxl-btn-split'],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pxl-load-more-wrapper .pxl-load-more-button' => 'height: {{SIZE}}{{UNIT}};--pxl-height: {{SIZE}}{{UNIT}};',
                ],
            ),
            array(
                'name' => 'btn_load_more_box_size',
                'label' => esc_html__('Box Size', 'komestic' ),
                'type' => 'slider',
                'size_units' => ['px' , 'custom'],
                'control_type' => 'responsive',
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'condition' => [
                    'load_more_style' => ['load-more-button-default'],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pxl-load-more-wrapper .pxl-load-more-button' => '--pxl-box-size: {{SIZE}}{{UNIT}};',
                ],
            ),
            array(
                'name' => 'btn_load_more_divider2',
                'type' => 'divider',
            ),
            array(
                'name' => 'btn_load_more_typography',
                'type' => \Elementor\Group_Control_Typography::get_type(),
                'control_type' => 'group',
                'selector' => '{{WRAPPER}} .pxl-load-more-wrapper .pxl-load-more-button',
            ),
            array(
                'name' => 'btn_load_more_text_shadow',
                'label' => esc_html__('Text Shadow', 'komestic' ),
                'type' => \Elementor\Group_Control_Text_Shadow::get_type(),
                'control_type' => 'group',
                'selector' => '{{WRAPPER}} .pxl-load-more-wrapper .pxl-load-more-button',
            ),
            array(
                'name' => 'btn_load_more_controls',
                'control_type' => 'tab',
                'tabs' => [
                    [
                        'name' => 'btn_load_more_normal',
                        'label' => esc_html__('Normal', 'komestic' ),
                        'type' => 'tab',
                        'controls' => [  
                            array(
                                'name' => 'btn_load_more_color',
                                'label' => esc_html__('Color', 'komestic' ),
                                'type' => 'color',
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-load-more-wrapper .pxl-load-more-button' => 'color: {{VALUE}};',
                                ],
                            ),
                            array(
                                'name' => 'btn_load_more_icon_border_style',
                                'label' => esc_html__( 'Border Style', 'komestic' ),
                                'type' => 'select',
                                'default' => '',
                                'options' => [
                                    '' => esc_html__( 'Default', 'komestic' ),
                                    'none' => esc_html__( 'None', 'komestic' ),
                                    'solid'  => esc_html__( 'Solid', 'komestic' ),
                                    'dashed' => esc_html__( 'Dashed', 'komestic' ),
                                    'dotted' => esc_html__( 'Dotted', 'komestic' ),
                                    'double' => esc_html__( 'Double', 'komestic' ),
                                ],
                                'condition' => [
                                    'load_more_style' => ['load-more-button-default'],
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-load-more-wrapper .pxl-load-more-button' => 'border-style: {{VALUE}};',
                                ],
                            ),
                            array(
                                'name' => 'btn_load_more_border_color',
                                'label' => esc_html__('Border Color', 'komestic' ),
                                'type' => 'color',
                                'condition' => [
                                    'load_more_style' => ['load-more-button-default'],
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-load-more-wrapper .pxl-load-more-button' => 'border-top-color: {{VALUE}};border-right-color: {{VALUE}};',
                                ],
                            ),
                            array(
                                'name' => 'btn_load_more_border_inner_color',
                                'label' => esc_html__('Border Inner Color', 'komestic' ),
                                'type' => 'color',
                                'condition' => [
                                    'load_more_style' => ['load-more-button-default'],
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-load-more-wrapper .pxl-load-more-button:before' => 'border-color: {{VALUE}};',
                                ],
                            ),
                            array(
                                'name' => 'btn_load_more_bg',
                                'type' => \Elementor\Group_Control_Background::get_type(),
                                'control_type' => 'group',
                                'types' => [ 'classic', 'gradient' ],
                                'selector' => '{{WRAPPER}} .pxl-load-more-wrapper .pxl-load-more-button:not(.pxl-btn-split),
                                {{WRAPPER}} .pxl-load-more-wrapper .btn.pxl-btn-split .pxl-btn-icon, 
                                {{WRAPPER}} .pxl-load-more-wrapper .btn.pxl-btn-split .pxl-btn-text',

                            ),
                            array(
                                'name' => '_btn_load_more_border',
                                'type' => \Elementor\Group_Control_Border::get_type(),
                                'separator' => 'before',
                                'control_type' => 'group', 
                                'selector' => '{{WRAPPER}} .pxl-load-more-wrapper .pxl-load-more-button:not(.pxl-btn-split),
                                {{WRAPPER}} .pxl-load-more-wrapper .btn.pxl-btn-split .pxl-btn-icon, 
                                {{WRAPPER}} .pxl-load-more-wrapper .btn.pxl-btn-split .pxl-btn-text',                            ),
                            array(
                                'name'         => 'btn_load_more_box_shadow',
                                'label' => esc_html__( 'Box Shadow', 'komestic' ),
                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                'control_type' => 'group',
                                'selector' => '{{WRAPPER}} .pxl-load-more-wrapper .pxl-load-more-button:not(.pxl-btn-split),
                                {{WRAPPER}} .pxl-load-more-wrapper .btn.pxl-btn-split .pxl-btn-icon, 
                                {{WRAPPER}} .pxl-load-more-wrapper .btn.pxl-btn-split .pxl-btn-text',                            ),
                            array(
                                'name' => 'btn_load_more_border_radius',
                                'label' => esc_html__('Border Radius', 'komestic' ),
                                'type' => 'dimensions',
                                'size_units' => [ 'px', 'custom' ],
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-load-more-wrapper .pxl-load-more-button:not(.pxl-btn-split),
                                    {{WRAPPER}} .pxl-load-more-wrapper .btn.pxl-btn-split .pxl-btn-icon, 
                                    {{WRAPPER}} .pxl-load-more-wrapper .btn.pxl-btn-split .pxl-btn-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                            ),
                            array(
                                'name' => 'btn_load_more_padding',
                                'label' => esc_html__('Padding', 'komestic' ),
                                'type' => 'dimensions',
                                'size_units' => [ 'px', 'custom' ],
                                'control_type' => 'responsive',
                                'separator' => 'before',
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-load-more-wrapper .pxl-load-more-button:not(.pxl-btn-split),
                                    {{WRAPPER}} .pxl-load-more-wrapper .btn.pxl-btn-split .pxl-btn-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                            ),
                        ],
                    ],
                    [
                        'name' => 'btn_load_more_hover',
                        'label' => esc_html__('Hover', 'komestic' ),
                        'type' => 'tabs',
                        'controls' => [
                            array(
                                'name' => 'btn_load_more_hover_color',
                                'label' => esc_html__('Color', 'komestic' ),
                                'type' => 'color',
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-load-more-wrapper .pxl-load-more-button:hover' => 'color: {{VALUE}};',
                                ],
                            ),
                            array(
                                'name' => 'btn_load_more_hover_border_color',
                                'label' => esc_html__('Border Color', 'komestic' ),
                                'type' => 'color',
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-load-more-wrapper .load-more-button-default:hover' => 'border-top-color: {{VALUE}};border-right-color: {{VALUE}};',
                                ],
                            ),
                            array(
                                'name' => 'btn_load_more_hover_border_inner_color',
                                'label' => esc_html__('Border Inner Color', 'komestic' ),
                                'type' => 'color',
                                'condition' => [
                                    'load_more_style' => ['load-more-button-default'],
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-load-more-wrapper .pxl-load-more-button:hover:before' => 'border-color: {{VALUE}};',
                                ],
                            ),
                            array(
                                'name' => 'btn_load_more_hover_bg',
                                'type' => \Elementor\Group_Control_Background::get_type(),
                                'control_type' => 'group',
                                'types' => [ 'classic', 'gradient' ],
                                'selector' => '{{WRAPPER}} .pxl-load-more-wrapper .pxl-load-more-button:hover',
                            ),
                            array(
                                'name'         => 'btn_load_more_hover_box_shadow',
                                'label' => esc_html__( 'Box Shadow', 'komestic' ),
                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                'control_type' => 'group',
                                'selector'     => '{{WRAPPER}} .pxl-load-more-wrapper .pxl-load-more-button:hover',
                            ),
                            array(
                                'name' => 'btn_load_more_hover_border_radius',
                                'label' => esc_html__('Border Radius', 'komestic' ),
                                'type' => 'dimensions',
                                'size_units' => [ 'px', 'custom' ],
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-load-more-wrapper .pxl-load-more-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                            ),
                            array(
                                'name' => 'btn_load_more_hover_padding',
                                'label' => esc_html__('Padding', 'komestic' ),
                                'type' => 'dimensions',
                                'size_units' => [ 'px', 'custom' ],
                                'control_type' => 'responsive',
                                'separator' => 'before',
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-load-more-wrapper .pxl-load-more-button:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                            ),
                        ],
                    ],
                ],
            ),
        ]

    ];
    return $options;
}

// Toggle Size Options
function komestic_size_options($args = []) {
    $prefix = ( isset($args['prefix']) && !empty($args['prefix']) ) ? '_'.$args['prefix'] : null;
    $label  = ( isset($args['label']) && !empty($args['label']) ) ? $args['label'] : 'Sizes';
    $selectors = (isset($args['selectors'])) ? $args['selectors'] : null;
    $type  = isset($args['type']) ? $args['type'] : null;
    $separator = isset($args['separator']);
    $options = [
        [
            'name' => $prefix.'popover_sizes',
            'label' => esc_html($label),
            'type' => 'popover_toggle',
            'default' => '',
        ],
        [
            'name' => $prefix.'start_popover_sizes',
            'type' => 'pxl_start_popover',
        ],
        [
            'name' => $prefix.'width',
            'label' => esc_html__('Width', 'komestic'),
            'type' => 'slider',
            'size_units' => ['px', '%', 'custom'],
            'control_type' => 'responsive',
            'range' => [
                'px' => [
                    'min' => 0,
                ],
                '%' => [
                    'min' => 0,
                ],
            ],
            'selectors' => [
                $selectors => 'width: {{SIZE}}{{UNIT}};'
            ],
        ],
        [
            'name' => $prefix.'min_width',
            'label' => esc_html__('Min Width', 'komestic'),
            'type' => 'slider',
            'control_type' => 'responsive',
            'size_units' => ['px', '%', 'custom'],
            'range' => [
                'px' => [
                    'min' => 0,
                ],
                '%' => [
                    'min' => 0,
                ],
            ],
            'selectors' => [
                $selectors => 'min-width: {{SIZE}}{{UNIT}};'
            ],
        ],
        [
            'name' => $prefix.'max_width',
            'label' => esc_html__('Max Width', 'komestic'),
            'type' => 'slider',
            'control_type' => 'responsive',
            'size_units' => ['px', '%', 'custom'],
            'range' => [
                'px' => [
                    'min' => 0,
                ],
                '%' => [
                    'min' => 0,
                ],
            ],
            'selectors' => [
                $selectors => 'max-width: {{SIZE}}{{UNIT}};'
            ],
        ],
        [
            'name' => $prefix.'sizes_divider',
            'type' => 'divider',
        ],
        [
            'name' => $prefix.'height',
            'label' => esc_html__('Height', 'komestic'),
            'type' => 'slider',
            'control_type' => 'responsive',
            'size_units' => ['px', '%', 'custom'],
            'range' => [
                'px' => [
                    'min' => 0,
                ],
                '%' => [
                    'min' => 0,
                ],
            ],
            'selectors' => [
                $selectors => 'height: {{SIZE}}{{UNIT}};'
            ],
        ],
        [
            'name' => $prefix.'min_height',
            'label' => esc_html__('Min Height', 'komestic'),
            'type' => 'slider',
            'separator' => 'before',
            'control_type' => 'responsive',
            'size_units' => ['px', '%', 'custom'],
            'range' => [
                'px' => [
                    'min' => 0,
                ],
                '%' => [
                    'min' => 0,
                ],
            ],
            'selectors' => [
                $selectors => 'min-height: {{SIZE}}{{UNIT}};'
            ],
        ],
        [
            'name' => $prefix.'max_height',
            'label' => esc_html__('Max Height', 'komestic'),
            'type' => 'slider',
            'separator' => 'before',
            'control_type' => 'responsive',
            'size_units' => ['px', '%', 'custom'],
            'range' => [
                'px' => [
                    'min' => 0,
                ],
                '%' => [
                    'min' => 0,
                ],
            ],
            'selectors' => [
                $selectors => 'max-height: {{SIZE}}{{UNIT}};'
            ],
        ],
        [
            'name' => $prefix.'end_popover_sizes',
            'type' => 'pxl_end_popover',
        ],
    ];

    if($type == 'basic') {
        $options = [
            [
                'name' => $prefix.'popover_sizes',
                'label' => esc_html($label),
                'type' => 'popover_toggle',
                'default' => '',
            ],
            [
                'name' => $prefix.'start_popover_sizes',
                'type' => 'pxl_start_popover',
            ],
            [
                'name' => $prefix.'width',
                'label' => esc_html__('Width', 'komestic'),
                'type' => 'slider',
                'control_type' => 'responsive',
                'size_units' => ['px', '%', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                    ],
                    '%' => [
                        'min' => 0,
                    ],
                ],
                'selectors' => [
                    $selectors => 'width: {{SIZE}}{{UNIT}};'
                ],
            ],
            [
                'name' => $prefix.'height',
                'label' => esc_html__('Height', 'komestic'),
                'type' => 'slider',
                'control_type' => 'responsive',
                'size_units' => ['px', '%', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                    ],
                    '%' => [
                        'min' => 0,
                    ],
                ],
                'selectors' => [
                    $selectors => 'height: {{SIZE}}{{UNIT}};'
                ],
            ],
            [
                'name' => $prefix.'end_popover_sizes',
                'type' => 'pxl_end_popover',
            ],
        ];
    }

    if($separator) {
        $options[0]['separator'] = 'before';
    }
    return $options;
}

// Elementor Tab Advanced Custom
function elementor_tab_advanced_custom($args = []) {
    $custom_options = isset($args['custom_options']) && is_array($args['custom_options']) ? $args['custom_options'] : [];
    $options =  array_merge(
        [
            [
                'name' => 'pxl_width',
                'label' => esc_html__('Width', 'komestic' ),
                'type' => 'slider',
                'size_units' => ['px', '%', 'custom'],
                'control_type' => 'responsive',
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1920,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}' => 'width: {{SIZE}}{{UNIT}} !important;',
                ],
            ],
            [
                'name' => 'pxl_min_width',
                'label' => esc_html__('Min Width', 'komestic' ),
                'type' => 'slider',
                'size_units' => ['px', '%', 'custom'],
                'control_type' => 'responsive',
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1920,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}' => 'min-width: {{SIZE}}{{UNIT}} !important;',
                ],
            ],
            [
                'name' => 'pxl_max_width',
                'label' => esc_html__('Max Width', 'komestic' ),
                'type' => 'slider',
                'size_units' => ['px', '%', 'custom'],
                'control_type' => 'responsive',
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1920,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}' => 'max-width: {{SIZE}}{{UNIT}} !important;',
                ],
            ],
            [
                'name' => 'pxl_height',
                'label' => esc_html__('Height', 'komestic' ),
                'type' => 'slider',
                'size_units' => ['px', '%', 'custom'],
                'control_type' => 'responsive',
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1920,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}' => 'height: {{SIZE}}{{UNIT}} !important;',
                ],
            ],
            [
                'name' => 'pxl_min_height',
                'label' => esc_html__('Min Height', 'komestic' ),
                'type' => 'slider',
                'size_units' => ['px', '%', 'custom'],
                'control_type' => 'responsive',
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1920,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}' => 'min-height: {{SIZE}}{{UNIT}};',
                ],
            ],
            [
                'name' => 'pxl_max_height',
                'label' => esc_html__('Max Height', 'komestic' ),
                'type' => 'slider',
                'size_units' => ['px', '%', 'custom'],
                'control_type' => 'responsive',
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1920,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}' => 'max-height: {{SIZE}}{{UNIT}};',
                ],
            ],
        ],
        $custom_options,
        komestic_position_options([
            'prefix' => 'pxl_element',
            'selectors' => '{{WRAPPER}}',
        ]),
        array(
            array(
                'name' => 'pxl_overflow',
                'label' => esc_html__('Overflow', 'komestic'),
                'type' => 'select',
                'options' => [
                    ''     => esc_html('Default', 'komestic'),
                    'hidden' => esc_html__('Hidden', 'komestic'),
                    'auto' => esc_html__('Auto', 'komestic'),
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}' => 'overflow: {{VALUE}};',
                ],
            ),
        )
    );

    return array(
        'name' => 'tab_addvanced_custom',
        'label' => esc_html__('Komestic Custom', 'komestic'),
        'tab' => 'advanced',
        'controls' => $options,
    );
}

function elementor_tab_motion_effects() {
    $options = [

    ];
    return array(
        'name' => 'tab_addvanced_motion_effect_custom',
        'label' => esc_html__('Komestic Motion Effect', 'komestic'),
        'tab' => 'advanced',
        'controls' => $options,
    );
}

