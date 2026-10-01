<?php
 
add_action( 'pxl_post_metabox_register', 'komestic_page_options_register' );
function komestic_page_options_register( $metabox ) {
	$panels = [
		'post' => [
			'opt_name'            => 'post_option',
			'display_name'        => esc_html__( 'Post Options', 'komestic' ),
			'show_options_object' => false,
			'context'  => 'advanced',
			'priority' => 'default',
			'sections'  => [
				'post_settings' => [
					'title'  => esc_html__( 'Settings', 'komestic' ),
					'icon'   => 'el el-cog',
					'fields' => array(
						array(
							'id' => 'post_layout_heading',
							'title' => esc_html__('Layout', 'komestic'),
							'type'  => 'section',
							'indent' => true,
						),
						komestic_sidebar_options(['prefix' => 'post', 'page_option' => true, 'default' => 'inherit']),
					),
				],
			]
		],
		'store' => [
			'opt_name'            => 'store_option',
			'display_name'        => esc_html__( 'Store Options', 'komestic' ),
			'show_options_object' => false,
			'context'  => 'advanced',
			'priority' => 'default',
			'sections'  => [
				'store_info' => [
					'title'  => esc_html__( 'Info', 'komestic' ),
					'icon'   => 'el el-cog',
					'fields' => array(
						array(
							'id'    => 'store_address',
							'type'  => 'text',
							'title' => esc_html__('Address', 'komestic'),
							'placeholder' => esc_html__('26 Hung Vuong, Ha Noi, Viet Nam', 'komestic'),
						),
						array(
							'id'    => 'store_phone_number',
							'type'  => 'text',
							'title' => esc_html__('Phone Number', 'komestic'),
							'placeholder' => esc_html__('+84346 463 346', 'komestic'),
						),
						array(
							'id'    => 'store_google_map',
							'type'  => 'text',
							'title' => esc_html__('Link Google Map', 'komestic'),
						),
					),
				],
			]
		],
		'page' => [
			'opt_name'            => 'pxl_page_options',
			'display_name'        => esc_html__( 'Page Options', 'komestic' ),
			'show_options_object' => false,
			'context'  => 'advanced',
			'priority' => 'default',
			'sections'  => [
				'header' => [
					'title'  => esc_html__( 'Header', 'komestic' ),
					'icon'   => 'eicon-header',
					'fields' => array_merge(
						array(
							array(
								'id'       => 'header_display',
								'type'     => 'button_set',
								'title'    => esc_html__('Header Display', 'komestic'),
								'options'  => array(
									'show'  => esc_html__('Show', 'komestic'),
									'hide'  => esc_html__('Hide', 'komestic'),
								),
								'default'  => 'show',
							),
							array(
				                'id'       => 'primary_menu',
				                'type'     => 'select',
				                'title'    => esc_html__( 'Header Menu', 'komestic' ),
				                'options'  => komestic_get_nav_menu_slug(),
				                'default' => '',
				                'description' => 'When you select Custom Menu. The custom menu will apply to the entire layout when you use Case Nav Menu widget in Elementor and Menu on header layout in Mobile.'
				            ),
							array(
								'id'       => 'site_logo',
								'type'     => 'media',
								'title'    => esc_html__('Mobile Logo', 'komestic'),
								'url'      => false,
								'desc'    => sprintf(esc_html__('You can also choose a logo to apply to each Page. Please edit the page and you will see Page Options. %sView Now.%s','komestic'),'<a class="pxl-admin-popup" href="' . esc_url( get_template_directory_uri() ) . '/inc/theme-options/instruct/logo_m_page.png">','</a>'),
							),
							array(
								'id' => 'header_desktop_heading',
								'title' => esc_html__('Header Desktop', 'komestic'),
								'type'  => 'section',
								'indent' => true,
								'required'   => array('header_display', '=', 'show'),
							),
						),
						komestic_header_opts([
							'default' => true, 
							'default_value' => '-1'
						]),
						array(
							array(
								'id'       => 'header_sticky_show_on_scroll',
								'type'     => 'button_set',
								'title'    => esc_html__('Sticky Show on Scroll', 'komestic'),
								'options'  => array(
									'-1'         => esc_html__('Inherit', 'komestic'),
									'scroll-up'  => esc_html__('Scroll To Top', 'komestic'),
									'scroll-down'  => esc_html__('Scroll To Bottom', 'komestic'),
								),
								'default'  => 'scroll-up',
								'required' => array( 0 => 'header_layout_sticky', 1 => '!=', 2 => '' ),
							),
							array(
								'id' => 'header_mobile_heading',
								'title' => esc_html__('Header Mobile', 'komestic'),
								'type'  => 'section',
								'indent' => true,
							),
						),
						komestic_header_mobile_opts([
							'default'         => true,
							'default_value'   => '-1'
						]),
					),
				],
				'layouts' => [
					'title'  => esc_html__( 'Layouts', 'komestic' ),
					'icon'   => 'eicon-layout-settings',
					'fields' => array_merge(
						array(
							array(
								'id' => 'page_breadcrumb_heading',
								'title' => esc_html__('Breadcrumb', 'komestic'),
								'type'  => 'section',
								'indent' => true,
							),
							array(
								'id'       => 'page_breadcrumb',
								'type'     => 'button_set',
								'title'    => esc_html__('Breadcrumb', 'komestic'),
								'options'  => array(
									'default' => esc_html__('Default', 'komestic'),
									'custom'  => esc_html__('Custom', 'komestic'),
								),
								'default'  => 'default',
							),   
							array(
								'id'       => 'page_breadcrumb_text',
								'type'     => 'text',
								'title'    => esc_html__('Breadcrumb Text', 'komestic'),
								'required' => array( 0 => 'page_breadcrumb', 1 => 'equals', 2 => 'custom' ),
							),
							array(
								'id' => 'page_title_heading',
								'title' => esc_html__('Page Title', 'komestic'),
								'type'  => 'section',
								'indent' => true,
							),
						),
				        komestic_page_title_options([
							'default'         => true,
							'default_value'   => 'inherit'
						]),
				        array(
							array(
								'id'       => 'page_title_custom',
								'type'     => 'text',
								'title'    => esc_html__('Page Title Custom', 'komestic'),
							),
							array(
								'id' => 'sidebar_heading',
								'title' => esc_html__('Sidebar', 'komestic'),
								'type'  => 'section',
								'indent' => true,
							),
							komestic_sidebar_options([
								'prefix' => 'page', 
								'default' => 'disable'
							]),
					    ),
				    ),
				],
				'footer' => [
					'title'  => esc_html__( 'Footer', 'komestic' ),
					'icon'   => 'eicon-footer',
					'fields' => array(
						array(
							'id'       => 'footer_display',
							'type'     => 'button_set',
							'title'    => esc_html__('Footer Display', 'komestic'),
							'options'  => array(
								'show' => esc_html__('Show', 'komestic'),
								'hide'  => esc_html__('Hide', 'komestic'),
							),
							'default'  => 'show',
						),
						array(
							'id'          => 'footer_layout',
							'type'        => 'select',
							'title'       => esc_html__('Footer Layout', 'komestic'),
							'desc'        => sprintf(esc_html__('Please create your layout before choosing. %sClick Here%s','komestic'),'<a href="' . esc_url( admin_url( 'edit.php?post_type=pxl-template' ) ) . '">','</a>'),
							'options'     => komestic_get_templates_option('footer', true),
							'default'     => '-1',
							'required'   => array('footer_display', '=', 'show'),
						),
						array(
							'id'       => 'footer_fixed',
							'type'     => 'button_set',
							'title'    => esc_html__('Footer Fixed', 'komestic'),
							'options'  => array(
								'inherit' => esc_html__('Inherit', 'komestic'),
								'on' => esc_html__('On', 'komestic'),
								'off' => esc_html__('Off', 'komestic'),
							),
							'default'  => 'inherit',
							'required'   => array('footer_display', '=', 'show'),
						),
					)
				    
				],
				'appearance' => [
					'title'  => esc_html__( 'Appearance', 'komestic' ),
					'icon'   => 'eicon-custom',
					'fields' => array(
						array(
							'id' => 'general_heading',
							'title' => esc_html__('General', 'komestic'),
							'type'  => 'section',
							'indent' => true,
						),
						array(
							'id' => 'body_custom_class',
							'type' => 'text',
							'title' => esc_html__('Body Custom Class', 'komestic'),
						), 
						array(
							'id' => 'colors_heading',
							'title' => esc_html__('Colors', 'komestic'),
							'type'  => 'section',
							'indent' => true,
						),
						array(
							'id'        => 'body_background_color',
							'type'      => 'color',
							'title'     => esc_html__('Body Background Color', 'komestic'),
							'default'   => '',
							'transparent' => false,
							'output'    => array(
								'background-color' => 'body',
							)
						),
						array(
							'id'          => 'primary_color',
							'type'        => 'color',
							'title'       => esc_html__('Primary Color', 'komestic'),
							'transparent' => false,
							'default'     => ''
						),
						array(
							'id'          => 'secondary_color',
							'type'        => 'color',
							'title'       => esc_html__('Secondary Color', 'komestic'),
							'transparent' => false,
							'default'     => ''
						),
						array(
							'id'          => 'third_color',
							'type'        => 'color',
							'title'       => esc_html__('Third Color', 'komestic'),
							'transparent' => false,
							'default'     => ''
						),
					)
				],
			]
		],
		'product' => [
			'opt_name'            => 'pxl_product_options',
			'display_name'        => esc_html__( 'Product Options', 'komestic' ),
			'show_options_object' => false,
			'context'  => 'advanced',
			'priority' => 'default',
			'sections'  => [
				'info' => [
					'title'  => esc_html__( 'Settings', 'komestic' ),
					'icon'   => 'el-icon-website',
					'fields' => array(
						array(
							'id'    => 'show_selling_fast_bar',
							'type'  => 'switch',
							'title' => esc_html__('Selling Fast Bar', 'komestic'),
							'default'  => '',
				        ),
						array(
							'id'    => 'is_product_trending',
							'type'  => 'switch',
							'title' => esc_html__('Product Trending', 'komestic'),
							'default'  => '',
				        ),
						array(
							'id'            => 'date_time_trending',
							'type'          => 'datetime',
							'title'         => 'Date/Time Trending',
							'split'         => false,
							'separator'     => '  ',
							'required'       => array( 'is_product_trending', 'equals', '1' ),
						),

						// array(
						// 	'id'       => 'stores_out_of_this_product',
						// 	'type'     => 'select',
						// 	'multi'    => true,
						// 	'title'    => esc_html__( 'Stores Out of This Product', 'komestic' ), 
						// 	'options'  => get_store_options(),
						// 	'default'  => array()
						// )
						array(
							'id'=> 'product_features',
							'type' => 'multi_text',
							'title' => esc_html__('Features', 'komestic'),
							'add_text' => 'Add Feature',
						),
					),
				],
				'tabs' => [
					'title'  => esc_html__( 'Info', 'komestic' ),
					'icon'   => 'el-icon-website',
					'fields' => array_merge(
						array(
							array(
								'id'      => 'product_add_tabs',
								'type'    => 'spinner',
								'title'   => esc_html__('Add Tabs', 'komestic'),
								'default' => 2,
								'min'     => 2,
								'max'     => 10,
							),
							array(
								'id'     => 'product_tab_1_heading',
								'title'  => esc_html__( 'Description', 'komestic' ),
								'type'   => 'section',
								'indent' => true,
							),
							array(
								'id'      => 'product_tab_1_title',
								'type'    => 'text',
								'title'   => esc_html__('Title', 'komestic'),
								'default' => esc_html__('Description', 'komestic'),
							),
							array(
								'id'    => 'product_tab_1_content',
								'type'  => 'editor',
								'title' => esc_html__('Description', 'komestic'),
								'args'  => array(
									'teeny'         => true,
									'textarea_rows' => 10,
								),
							),
							array(
								'id'     => 'product_tab_2_heading',
								'title'  => esc_html__( 'Ingredients', 'komestic' ),
								'type'   => 'section',
								'indent' => true,
							),
							array(
								'id'      => 'product_tab_2_title',
								'type'    => 'text',
								'title'   => esc_html__('Title', 'komestic'),
								'default' => esc_html__('Ingredients', 'komestic'),
							),
							array(
								'id'    => 'product_tab_2_content',
								'type'  => 'editor',
								'title' => esc_html__('Ingredients', 'komestic'),
								'args'  => array(
									'teeny'         => true,
									'textarea_rows' => 10,
								),
							),
						),
						komestic_get_product_tabs_fields(),
						// array(
						// ),
					),
				],

			],
		],
		'pxl-template' => [
			'opt_name'            => 'pxl_hidden_template_options',
			'display_name'        => esc_html__( 'Template Options', 'komestic' ),
			'show_options_object' => false,
			'context'  => 'advanced',
			'priority' => 'default',
			'sections'  => [
				'header' => [
					'title'  => esc_html__( 'General', 'komestic' ),
					'icon'   => 'el-icon-website',
					'fields' => array(
						array(
							'id'    => 'template_type',
							'type'  => 'select',
							'title' => esc_html__('Template Type', 'komestic'),
				            'options' => [
				            	'df'       	   => esc_html__('Select Type', 'komestic'), 
								'header'       => esc_html__('Header Desktop', 'komestic'),
								'header-mobile'=> esc_html__('Header Mobile', 'komestic'),
								'footer'       => esc_html__('Footer', 'komestic'), 
								'mega-menu'    => esc_html__('Mega Menu', 'komestic'), 
								'page-title'   => esc_html__('Page Title', 'komestic'), 
								'post-title'   => esc_html__('Post Title', 'komestic'), 
								'panel'        => esc_html__('Panel', 'komestic'),
								'woocommerce'  => esc_html__('WooCommerce', 'komestic'),
				            ],
				            'default' => 'df',
				        ),
				        array(
							'id'    => 'header_type',
							'type'  => 'select',
							'title' => esc_html__('Header Type', 'komestic'),
				            'options' => [
				            	'pxl-header-default'       	   => esc_html__('Default', 'komestic'), 
								'pxl-header-transparent'       => esc_html__('Transparent', 'komestic'),
				            ],
				            'default' => 'pxl-header-default',
				            'indent' => true,
                			'required' => array( 0 => 'template_type', 1 => 'equals', 2 => 'header' ),
				        ),
						array(
							'id'    => 'panel_open',
							'type'  => 'select',
							'title' => esc_html__('Panel Open', 'komestic'),
				            'options' => [
				            	'popup'            => esc_html__('Popup', 'komestic'), 
								'drawer-top'       => esc_html__('Drawer Top', 'komestic'),
								'drawer-right'     => esc_html__('Drawer Right', 'komestic'),
								'drawer-bottom'    => esc_html__('Drawer Bottom', 'komestic'),
								'drawer-left'      => esc_html__('Drawer Left', 'komestic'),
				            ],
							'required' => array( 0 => 'template_type', 1 => 'equals', 2 => 'panel' ),
				            'default' => 'popup',
				        ),
					),
				    
				],
			]
		],
	];
 
	$metabox->add_meta_data( $panels );
}
 