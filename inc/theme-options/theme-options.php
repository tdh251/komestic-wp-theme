<?php
add_action('after_setup_theme', 'theme_options_setup', 1);
function theme_options_setup() {
    if (!class_exists('ReduxFramework')) {
        return;
    }
    
    $opt_name = komestic()->get_option_name();
    $version = komestic()->get_version();
    
    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => '', //$theme->get('Name'),
        // Name that appears at the top of your panel
        'display_version'      => $version,
        // Version that appears at the top of your panel
        'menu_type'            => 'submenu', //class_exists('Pxltheme_pCore') ? 'submenu' : '',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => esc_html__('Theme Options', 'komestic'),
        'page_title'           => esc_html__('Theme Options', 'komestic'),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => false,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => false,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-admin-generic',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => true,
        // Show the time the page took to load, etc
        'update_notice'        => true,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field
        'show_options_object' => false,
        // OPTIONAL -> Give you extra features
        'page_priority'        => 80,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'pxlart', //class_exists('Komestic_Admin_Page') ? 'case' : '',
        // For a full list of options, visit: //codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => 'pxlart-theme-options',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.
    
        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.
    
        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.
    
        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        ),
    );
    
    Redux::SetArgs($opt_name, $args);
    
    // Color
    Redux::setSection($opt_name, array(
        'title'  => esc_html__('Global Colors', 'komestic'),
        'icon'       => 'el el-filter',
        'fields' => array(
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
            array(
                'id'      => 'link_color',
                'type'    => 'link_color',
                'title'   => esc_html__('Link Colors', 'komestic'),
                'default' => array(
                    'regular' => '',
                    'hover'   => '',
                    'active'  => ''
                ),
                'output'  => array('a')
            ),
            array(
                'id'          => 'gradient_color',
                'type'        => 'color_gradient',
                'title'       => esc_html__('Gradient Color', 'komestic'),
                'transparent' => false,
                'default'  => array(
                    'from' => '',
                    'to'   => '', 
                ),
            ),
        )
    ));
    
    // Typography
    Redux::setSection($opt_name, array(
        'title'  => esc_html__('Typography', 'komestic'),
        'icon'   => 'el-icon-text-width',
        'fields' => array(
            array(
                'id'          => 'primary_font',
                'type'        => 'typography',
                'title'       => esc_html__('Primary Font', 'komestic'),
                'google'      => false,
                'font-backup' => false,
                'all_styles'  => false,
                'line-height'  => false,
                'font-size'  => false,
                'color'  => false,
                'font-style'  => false,
                'font-weight'  => false,
                'text-align'  => false,
            ),
            array(
                'id'          => 'secondary_font',
                'type'        => 'typography',
                'title'       => esc_html__('Secondary Font', 'komestic'),
                'google'      => false,
                'font-backup' => false,
                'all_styles'  => false,
                'line-height'  => false,
                'font-size'  => false,
                'color'  => false,
                'font-style'  => false,
                'font-weight'  => false,
                'text-align'  => false,
            ),
            array(
                'id'          => 'heading_font',
                'type'        => 'typography',
                'title'       => esc_html__('Heading Font', 'komestic'),
                'google'      => false,
                'font-backup' => false,
                'all_styles'  => false,
                'line-height'  => false,
                'font-size'  => false,
                'font-style'  => false,
                'font-weight'  => true,
                'text-align'  => false,
                'color' => true
            ),
            array(
                'id'          => 'font_heading_h1',
                'type'        => 'typography',
                'title'       => esc_html__('Heading H1', 'komestic'),
                'google'      => false,
                'font-backup' => false,
                'all_styles'  => true,
                'text-align'  => false,
                'line-height' => true,
                'font-size'   => true,
                'font-backup' => false,
                'font-style'  => false,
                'output'      => array('h1', '.h1'),
                'units'       => 'px',
                'font-family' => false,
                'color' => false
            ),
    
            array(
                'id'          => 'font_heading_h2',
                'type'        => 'typography',
                'title'       => esc_html__('Heading H2', 'komestic'),
                'google'      => true,
                'font-backup' => true,
                'all_styles'  => true,
                'text-align'  => false,
                'line-height' => true,
                'font-size'   => true,
                'font-backup' => false,
                'font-style'  => false,
                'output'      => array('h2', '.h2'),
                'units'       => 'px',
                'font-family' => false,
                'color' => false
            ),
    
            array(
                'id'          => 'font_heading_h3',
                'type'        => 'typography',
                'title'       => esc_html__('Heading H3', 'komestic'),
                'google'      => true,
                'font-backup' => true,
                'all_styles'  => true,
                'text-align'  => false,
                'line-height' => true,
                'font-size'   => true,
                'font-backup' => false,
                'font-style'  => false,
                'output'      => array('h3', '.h3'),
                'units'       => 'px',
                'font-family' => false,
                'color' => false
            ),
    
            array(
                'id'          => 'font_heading_h4',
                'type'        => 'typography',
                'title'       => esc_html__('Heading H4', 'komestic'),
                'google'      => true,
                'font-backup' => true,
                'all_styles'  => true,
                'text-align'  => false,
                'line-height' => true,
                'font-size'   => true,
                'font-backup' => false,
                'font-style'  => false,
                'output'      => array('h4', '.h4'),
                'units'       => 'px',            
                'font-family' => false,
                'color' => false
            ),
    
            array(
                'id'          => 'font_heading_h5',
                'type'        => 'typography',
                'title'       => esc_html__('Heading H5', 'komestic'),
                'google'      => true,
                'font-backup' => true,
                'all_styles'  => true,
                'text-align'  => false,
                'line-height' => true,
                'font-size'   => true,
                'font-backup' => false,
                'font-style'  => false,
                'output'      => array('h5', '.h5'),
                'units'       => 'px',
                'font-family' => false,
                'color' => false
            ),
    
            array(
                'id'          => 'font_heading_h6',
                'type'        => 'typography',
                'title'       => esc_html__('Heading H6', 'komestic'),
                'google'      => true,
                'font-backup' => true,
                'all_styles'  => true,
                'text-align'  => false,
                'line-height' => true,
                'font-size'   => true,
                'font-backup' => false,
                'font-style'  => false,
                'output'      => array('h6', '.h6'),
                'units'       => 'px',
                'font-family' => false,
                'color' => false
            ),
        )
    ));
    
    // General
    Redux::setSection($opt_name, array(
        'title'  => esc_html__('General', 'komestic'),
        'icon'   => 'el el-wrench',
        'fields' => array(
            array(
                'id'       => 'site_loader',
                'type'     => 'button_set',
                'title'    => esc_html__('Site Loader', 'komestic'),
                'options'  => array(
                    'on' => esc_html__('On', 'komestic'),
                    'off' => esc_html__('Off', 'komestic'),
                ),
                'default'  => 'off',
            ),
            array(
                'id'       => 'mouse_move_animation',
                'type'     => 'button_set',
                'title'    => esc_html__('Mouse Move Animation', 'komestic'),
                'options'  => array(
                    'on' => esc_html__('On', 'komestic'),
                    'off' => esc_html__('Off', 'komestic'),
                ),
                'default'  => 'off',
            ),
            array(
                'id'       => 'smooth_scroll',
                'type'     => 'button_set',
                'title'    => esc_html__('Smooth Scroll', 'komestic'),
                'options'  => array(
                    'on' => esc_html__('On', 'komestic'),
                    'off' => esc_html__('Off', 'komestic'),
                ),
                'default'  => 'off',
            ),
            array(
                'id'       => 'button_back_to_top',
                'type'     => 'switch',
                'title'    => esc_html__('Back to Top', 'komestic'),
                'default'  => false,
            ),
        )
    ));
    
    Redux::setSection($opt_name, array(
        'title' => esc_html__('Components ', 'komestic'),
        'icon'  => 'eicon-layout-settings',
    ));
    // Header
    Redux::setSection($opt_name, array(
        'title'  => esc_html__('Header', 'komestic'),
        'icon'   => 'eicon-header',
        'subsection' => true,
        'fields' => array_merge(
            array(
                array(
                    'id'       => 'site_logo',
                    'type'     => 'media',
                    'title'    => esc_html__('Site Logo', 'komestic'),
                        'default' => array(
                        'url'=>get_template_directory_uri().'/assets/images/logo.png'
                    ),
                    'url'      => false,
                    'desc'    => sprintf(esc_html__('You can also choose a logo to apply to each Page. Please edit the page and you will see Page Options. %sView Now.%s','komestic'),'<a class="pxl-admin-popup" href="' . esc_url( get_template_directory_uri() ) . '/inc/theme-options/instruct/logo_m_page.png">','</a>'),
                ),
                array(
                    'id' => 'header_desktop_heading',
                    'title' => esc_html__('Header Desktop', 'komestic'),
                    'type'  => 'section',
                    'indent' => true,
                ),
            ),
            komestic_header_opts(),
            array(
                array(
                    'id'       => 'header_sticky_show_on_scroll',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Sticky Show on Scroll', 'komestic'),
                    'options'  => array(
                        'scroll-up' => esc_html__('Scroll To Top', 'komestic'),
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
            komestic_header_mobile_opts(),
        ),
    ));
    Redux::setSection($opt_name, array(
        'title'  => esc_html__('Page Title', 'komestic'),
        'icon'   => 'eicon-archive-title',
        'subsection' => true,
        'fields'     => array_merge(
            array(
                array(
                    'title' => esc_html__('Page Title', 'komestic'),
                    'type'  => 'section',
                    'id' => 'page_general_h',
                    'indent' => true,
                ),
            ),
            komestic_page_title_options(),
        )
    ));
    // Footer
    Redux::setSection($opt_name, array(
        'title'  => esc_html__('Footer', 'komestic'),
        'icon'   => 'eicon-footer',
        'subsection' => true,
        'fields' => array_merge(
            komestic_footer_opts(),
        )
    ));

    // Pages Settings
    Redux::setSection($opt_name, array(
        'title' => esc_html__('Pages', 'komestic'),
        'icon'  => 'eicon-progress-tracker',
    ));
    Redux::setSection($opt_name, array(
        'title'      => esc_html__('Search Result', 'komestic'),
        'icon'       => 'eicon-search-results',
        'subsection' => true,
        'fields'     => array_merge(
            array(
                array(
                    'id' => 'search_general_heading',
                    'title' => esc_html__('General', 'komestic'),
                    'type'  => 'section',
                    'indent' => true,
                ),
                komestic_sidebar_options(['prefix' => 'search']),
                array(
                    'id' => 'sg_search_title_h',
                    'title' => esc_html__('Search Title', 'komestic'),
                    'type'  => 'section',
                    'indent' => true,
                ),
            ),
            komestic_post_title_opts('search'),
            array(
                array(
                    'id'       => 'search_title_custom',
                    'type'     => 'text',
                    'title'    => esc_html__('Post Title Custom', 'komestic'),
                    'required' => array('search_title_mode', '!=', 'disable'),
                    'default'  => esc_html__('Search Results', 'komestic'),
                ),
                array(
                    'id' => 'search_breadcrumb_heading',
                    'title' => esc_html__('Breadcrumb', 'komestic'),
                    'type'  => 'section',
                    'indent' => true,
                ),
                array(
                    'id'       => 'search_breadcrumb',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Search Title', 'komestic'),
                    'options'  => array(
                        'default' => esc_html__('Use Search Title', 'komestic'),
                        'custom'  => esc_html__('Use Custom Title', 'komestic'),
                    ),
                    'default'  => 'default',
                ),       
                array(
                    'id'      => 'search_breadcrumb_text',
                    'type'    => 'text',
                    'title'   => esc_html__('Custom Search Title', 'komestic'),
                    'default' => esc_html__('Search Results', 'komestic'),
                    'required' => array( 0 => 'search_breadcrumb', 1 => 'equals', 2 => 'custom' ),
                ),     
            ),
        ),
    ));
    Redux::setSection($opt_name, array(
        'title'  => esc_html__('404 Error', 'komestic'),
        'icon'   => 'eicon-error-404',
        'subsection' => true,
        'fields' => array(
            array(
                'id'       => '404_page_title',
                'type'     => 'button_set',
                'title'    => esc_html__('Show Page Title', 'komestic'),
                'options'  => array(
                    'show' => esc_html__('Show', 'komestic'),
                    'hide' => esc_html__('Hide', 'komestic'),
                ),
                'default'  => 'show',
            ),
            array(
                'id'      => '404_page_title_custom',
                'type'    => 'text',
                'title'   => esc_html__('Page Title', 'komestic'),
                'default' => esc_html__('404 Page', 'komestic'),
                'required' => array( 0 => '404_page_title', 1 => 'equals', 2 => 'show' ),
            ),
            array(
                'id'       => '404_show_header',
                'type'     => 'button_set',
                'title'    => esc_html__('Show Header', 'komestic'),
                'options'  => array(
                    'show' => esc_html__('Show', 'komestic'),
                    'hide' => esc_html__('Hide', 'komestic'),
                ),
                'default'  => 'show',
            ),
            array(
				'id'      => '404_header_layout',
				'type'    => 'select',
				'title'   => esc_html__('Header Layout', 'komestic'),
				'desc'    => sprintf(esc_html__('Please create your layout before choosing. %sClick Here%s','komestic'),'<a href="' . esc_url( admin_url( 'edit.php?post_type=pxl-template' ) ) . '">','</a>'),
				'options' => komestic_get_templates_option('header', ''),
				'default' => '',
                'required' => array( 0 => '404_show_header', 1 => 'equals', 2 => 'show' ),
	        ),
            array(
                'id'       => '404_show_footer',
                'type'     => 'button_set',
                'title'    => esc_html__('Show Footer', 'komestic'),
                'options'  => array(
                    'show' => esc_html__('Show', 'komestic'),
                    'hide' => esc_html__('Hide', 'komestic'),
                ),
                'default'  => 'show',
            ),
            array(
				'id'      => '404_footer_layout',
				'type'    => 'select',
				'title'   => esc_html__('Footer Layout', 'komestic'),
				'desc'    => sprintf(esc_html__('Please create your layout before choosing. %sClick Here%s','komestic'),'<a href="' . esc_url( admin_url( 'edit.php?post_type=pxl-template' ) ) . '">','</a>'),
				'options' => komestic_get_templates_option('header', ''),
				'default' => '',
                'required' => array( 0 => '404_show_footer', 1 => 'equals', 2 => 'show' ),
	        ),
            komestic_get_pages('404'),
        )
    ));
        
    // Standard
    Redux::setSection($opt_name, array(
        'title' => esc_html__('Blog', 'komestic'),
        'icon'  => 'eicon-post',
        'fields'     => array(
        )
    ));
    Redux::setSection($opt_name, array(
        'title' => esc_html__('Blog Standard', 'komestic'),
        'icon'  => 'eicon-archive-posts',
        'subsection' => true,
        'fields'     => array(
            array(
                'id' => 'blog_display_h',
                'title' => esc_html__('Display', 'komestic'),
                'type'  => 'section',
                'indent' => true,
            ),
            komestic_sidebar_options(),
            array(
                'id'       => 'blog_title_custom',
                'type'     => 'text',
                'title'    => esc_html__('Post Title Custom', 'komestic'),
                'default'  => esc_html__('Our Blog', 'komestic'),
            ),
            array(
                'id' => 'blog_breadcrumb_heading',
                'title' => esc_html__('Breadcrumb', 'komestic'),
                'type'  => 'section',
                'indent' => true,
            ),
            array(
                'id'       => 'blog_breadcrumb',
                'type'     => 'button_set',
                'title'    => esc_html__('Breadcrumb', 'komestic'),
                'options'  => array(
                    'default' => esc_html__('Default', 'komestic'),
                    'custom'  => esc_html__('Custom', 'komestic'),
                ),
                'default'  => 'default',
            ),            
            array(
                'id'      => 'blog_breadcrumb_text',
                'type'    => 'text',
                'title'   => esc_html__('Breadcrumb Text', 'komestic'),
                'default' => esc_html__('Blog', 'komestic'),
                'required' => array( 0 => 'blog_breadcrumb', 1 => 'equals', 2 => 'custom' ),
            ),
        )
    ));
    Redux::setSection($opt_name, array(
        'title'      => esc_html__('Single Post', 'komestic'),
        'icon'       => 'eicon-single-post',
        'subsection' => true,
        'fields'     => array_merge(
            array(
                array(
                    'id' => 'single_post_general_heading',
                    'title' => esc_html__('General', 'komestic'),
                    'type'  => 'section',
                    'indent' => true,
                ),
                komestic_sidebar_options(['prefix' => 'post']),
                array(
                    'id'          => 'single_post_header_layout',
                    'type'        => 'select',
                    'title'       => esc_html__('Header Layout', 'komestic'),
                    'desc'        => sprintf(esc_html__('Please create your layout before choosing. %sClick Here%s','komestic'),'<a href="' . esc_url( admin_url( 'edit.php?post_type=pxl-template' ) ) . '">','</a>'),
                    'options'     => komestic_get_templates_option('header', true),
                    'default'     => '-1',
                ),
                array(
                    'id'       => 'single_post_footer_display',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Footer Display', 'komestic'),
                    'options'  => array(
                        'show' => esc_html__('Show', 'komestic'),
                        'hide'  => esc_html__('Hide', 'komestic'),
                    ),
                    'default'  => 'show',
                ),
                array(
                    'id'          => 'single_post_footer_layout',
                    'type'        => 'select',
                    'title'       => esc_html__('Footer Layout', 'komestic'),
                    'desc'        => sprintf(esc_html__('Please create your layout before choosing. %sClick Here%s','komestic'),'<a href="' . esc_url( admin_url( 'edit.php?post_type=pxl-template' ) ) . '">','</a>'),
                    'options'     => komestic_get_templates_option('footer', true),
                    'default'     => '-1',
                    'required'   => array('single_post_footer_display', '=', 'show'),
                ),
                
                array(
                    'id' => 'single_post_title_heading',
                    'title' => esc_html__('Post Title', 'komestic'),
                    'type'  => 'section',
                    'indent' => true,
                ),
            ),
            komestic_post_title_opts(),
            array(
                array(
                    'id'       => 'single_post_title_custom',
                    'type'     => 'text',
                    'title'    => esc_html__('Post Title Custom', 'komestic'),
                    'required' => array('team_title_mode', '!=', 'disable'),
                ),
                array(
                    'id' => 'single_post_breadcrumb_heading',
                    'title' => esc_html__('Breadcrumb', 'komestic'),
                    'type'  => 'section',
                    'indent' => true,
                ),
                array(
                    'id'       => 'single_post_breadcrumb',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Breadcrumb', 'komestic'),
                    'options'  => array(
                        'default' => esc_html__('Default', 'komestic'),
                        'custom'  => esc_html__('Custom', 'komestic'),
                    ),
                    'default'  => 'default',
                ),            
                array(
                    'id'      => 'single_post_breadcrumb_text',
                    'type'    => 'text',
                    'title'   => esc_html__('Breadcrumb Text', 'komestic'),
                    'default' => esc_html__('Blog Details', 'komestic'),
                    'required' => array( 0 => 'single_post_breadcrumb', 1 => 'equals', 2 => 'custom' ),
                ),
                array(
                    'id' => 'single_post_display_heading',
                    'title' => esc_html__('Display', 'komestic'),
                    'type'  => 'section',
                    'indent' => true,
                ),
                array(
                    'id'       => 'single_post_tags',
                    'title'    => esc_html__('Tags', 'komestic'),
                    'subtitle' => esc_html__('Display the Tag for blog post.', 'komestic'),
                    'type'     => 'switch',
                    'default'  => true
                ),
                array(
                    'id'       => 'single_post_social_share',
                    'title'    => esc_html__('Social Share', 'komestic'),
                    'subtitle' => esc_html__('Display the Social Share for blog post.', 'komestic'),
                    'type'     => 'switch',
                    'default'  => true,
                ),
                array(
                    'id'       => 'single_post_social_vimeo',
                    'title'    => esc_html__('Vimeo', 'komestic'),
                    'type'     => 'switch',
                    'default'  => true,
                    'indent' => true,
                    'required' => array('single_post_social_share', 'equals', '1'),
                ),
                array(
                    'id'       => 'single_post_social_facebook',
                    'title'    => esc_html__('Facebook', 'komestic'),
                    'type'     => 'switch',
                    'default'  => true,
                    'indent' => true,
                    'required' => array('single_post_social_share', 'equals', '1'),
                ),
                array(
                    'id'       => 'single_post_pinterest_facebook',
                    'title'    => esc_html__('Pinterest', 'komestic'),
                    'type'     => 'switch',
                    'default'  => true,
                    'indent' => true,
                    'required' => array('single_post_social_share', 'equals', '1'),
                ),
                array(
                    'id'       => 'single_post_social_instagram',
                    'title'    => esc_html__('Instagram', 'komestic'),
                    'type'     => 'switch',
                    'default'  => true,
                    'indent' => true,
                    'required' => array('single_post_social_share', 'equals', '1'),
                ),
                array(
                    'id'       => 'single_post_social_twitter',
                    'title'    => esc_html__('Twitter', 'komestic'),
                    'type'     => 'switch',
                    'default'  => true,
                    'indent' => true,
                    'required' => array('single_post_social_share', 'equals', '1'),
                ),
            ),
        ),
    ));
    
    
    // Shop Settings
    if(class_exists('Woocommerce')) {
        Redux::setSection($opt_name, array(
            'title' => esc_html__('Woocommerce', 'komestic'),
            'icon'  => 'eicon-woo-settings',
            'fields'     => array(
            )
        ));
        Redux::setSection($opt_name, array(
            'title'      => esc_html__('Shop', 'komestic'),
            'icon'       => 'eicon-products-archive',
            'subsection' => true,
            'fields'     =>array(
                array(
                    'title' => esc_html__('General', 'komestic'),
                    'type'  => 'section',
                    'id' => 'shop_general_h',
                    'indent' => true,
                ),
                komestic_sidebar_options(['prefix' => 'shop']),
                array(
                    'id'       => 'product_image_dimensions',
                    'type'     => 'dimensions',
                    'units'    => array('px',),
                    'title'    => esc_html__('Image Dimensions', 'komestic'),
                    'default'  => array(
                        'Width'   => '576', 
                        'Height'  => '726'
                    ),
                ),
                array(
                    'id'          => 'pa_display_in_box_thumbnail',
                    'type'        => 'select',
                    'title'       => esc_html__('PA Display in Box Thumbnail', 'komestic'),
                    'options'     => komestic_get_all_pa(),
                    'default'     => '0',
                ),
                array(
                    'id'          => 'gift_package',
                    'type'        => 'select',
                    'title'       => esc_html__('Gift Package', 'komestic'),
                    'data'     => 'posts',
                    'args'     => array(
                        'post_type'      => 'product',
                        'posts_per_page' => -1,
                        'post_status'    => 'publish',
                    ),
                    'default'     => '',
                ),
                array(
                    'id'          => 'shop_header_layout',
                    'type'        => 'select',
                    'title'       => esc_html__('Shop Header', 'komestic'),
                    'desc'        => sprintf(esc_html__('Please create your layout before choosing. %sClick Here%s','komestic'),'<a href="' . esc_url( admin_url( 'edit.php?post_type=pxl-template' ) ) . '">','</a>'),
                    'options'     => komestic_get_templates_option('header', true),
                    'default'     => '-1',
                ),
                array(
                    'id'          => 'shop_footer_layout',
                    'type'        => 'select',
                    'title'       => esc_html__('Shop Footer', 'komestic'),
                    'desc'        => sprintf(esc_html__('Please create your layout before choosing. %sClick Here%s','komestic'),'<a href="' . esc_url( admin_url( 'edit.php?post_type=pxl-template' ) ) . '">','</a>'),
                    'options'     => komestic_get_templates_option('footer', true),
                    'default'     => '-1',
                ),
                array(
                    'id'      => 'shop_drawer_filter',
                    'type'    => 'select',
                    'title'   => esc_html__('Shop Drawer Filter', 'komestic'),
                    'desc'    => sprintf(esc_html__('You need to use %sCase Products Filter%s widget in this template. Please create your layout before choosing. %sClick Here%s','komestic'),'<strong>', '</strong>', '<a href="' . esc_url( admin_url( 'edit.php?post_type=pxl-template' ) ) . '">','</a>'),
                    'options' => komestic_get_templates_option('panel', true),
                    'default' => '' ,
                ),
                array(
                    'id'      => 'compare_products_modal',
                    'type'    => 'select',
                    'title'   => esc_html__('Compare Products Modal', 'komestic'),
                    'desc'    => sprintf(esc_html__('You need to use %sCase Products Compare%s widget in this template. Please create your layout before choosing. %sClick Here%s.','komestic'),'<strong>', '</strong>', '<a href="' . esc_url( admin_url( 'edit.php?post_type=pxl-template' )) . '">','</a>'),
                    'options' => komestic_get_templates_option('panel', true),
                    'default' => '' ,
                ),
                array(
                    'id'      => 'quick_view_modal',
                    'type'    => 'select',
                    'title'   => esc_html__('Quick View Modal', 'komestic'),
                    'desc'    => sprintf(esc_html__('You need to use %sCase Product Quick View%s widget in this template. Please create your layout before choosing. %sClick Here%s.','komestic'),'<strong>', '</strong>', '<a href="' . esc_url( admin_url( 'edit.php?post_type=pxl-template' )) . '">','</a>'),
                    'options' => komestic_get_templates_option('panel', true),
                    'default' => '' ,
                ),
                array(
                    'id'      => 'quick_add_modal',
                    'type'    => 'select',
                    'title'   => esc_html__('Quick Add Modal', 'komestic'),
                    'desc'    => sprintf(esc_html__('You need to use %sCase Product Quick Add%s widget in this template. Please create your layout before choosing. %sClick Here%s.','komestic'),'<strong>', '</strong>', '<a href="' . esc_url( admin_url( 'edit.php?post_type=pxl-template' )) . '">','</a>'),
                    'options' => komestic_get_templates_option('panel', true),
                    'default' => '' ,
                ),
                array(
                    'id'      => 'shop_page_title_custom',
                    'type'    => 'text',
                    'title'   => esc_html__('Page Title', 'komestic'),
                    'default' => '',
                    'desc'     => 'Ex: Shop',
                ),
                array(
                    'id' => 'shop_breadcrumb_heading',
                    'title' => esc_html__('Breadcrumb', 'komestic'),
                    'type'  => 'section',
                    'indent' => true,
                ),
                array(
                    'id'       => 'shop_breadcrumb',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Breadcrumb', 'komestic'),
                    'options'  => array(
                        'default' => esc_html__('Default', 'komestic'),
                        'custom'  => esc_html__('Custom', 'komestic'),
                    ),
                    'default'  => 'default',
                ),            
                array(
                    'id'      => 'shop_breadcrumb_text',
                    'type'    => 'text',
                    'title'   => esc_html__('Breadcrumb Text', 'komestic'),
                    'default' => esc_html__('Shop', 'komestic'),
                    'required' => array( 0 => 'shop_breadcrumb', 1 => 'equals', 2 => 'custom' ),
                ),
                array(
                    'id' => 'shop_breadcrumb_heading',
                    'title' => esc_html__('Breadcrumb', 'komestic'),
                    'type'  => 'section',
                    'indent' => true,
                ),
                array(
                    'id'       => 'shop_breadcrumb',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Breadcrumb', 'komestic'),
                    'options'  => array(
                        'default' => esc_html__('Default', 'komestic'),
                        'custom'  => esc_html__('Custom', 'komestic'),
                    ),
                    'default'  => 'default',
                ),            
                array(
                    'id'      => 'shop_breadcrumb_text',
                    'type'    => 'text',
                    'title'   => esc_html__('Breadcrumb Text', 'komestic'),
                    'default' => esc_html__('Shop', 'komestic'),
                    'required' => array( 0 => 'shop_breadcrumb', 1 => 'equals', 2 => 'custom' ),
                ),
                array(
                    'id'        => 'product_columns',
                    'type'      => 'slider',
                    'title'     => esc_html__('Columns', 'komestic'),
                    'desc'      => esc_html__('Number of related products displayed per row.', 'komestic'),
                    "default"   => 3,
                    "min"       => 1,
                    "step"      => 1,
                    "max"       => 6,
                    'display_value' => 'label'
                ), 
                array(
                    'id'        => 'products_per_page',
                    'type'      => 'slider',
                    'title'     => esc_html__('Product Per Page', 'komestic'),
                    'desc'      => esc_html__('Number of related products displayed on page.', 'komestic'),
                    "default"   => 9,
                    "min"       => 1,
                    "step"      => 1,
                    "max"       => 100,
                    'display_value' => 'label'
                ),
            ),
        ));
        Redux::setSection($opt_name, array(
            'title'      => esc_html__('Single Product', 'komestic'),
            'icon'       => 'eicon-single-product',
            'subsection' => true,
            'fields'     => array_merge(
                array(
                    array(
                        'title' => esc_html__('General', 'komestic'),
                        'type'  => 'section',
                        'id' => 'shop_title_heading',
                        'indent' => true,
                    ), 
                    array(
                        'id'          => 'product_out_of_stock_template_id',
                        'type'        => 'select',
                        'title'       => esc_html__('Product Out Of Stock Template', 'komestic'),
                        'desc'        => sprintf(esc_html__('Please create your layout before choosing. %sClick Here%s','komestic'),'<a href="' . esc_url( admin_url( 'edit.php?post_type=pxl-template' ) ) . '">','</a>'),
                        'options'     => komestic_get_templates_option('woocommerce', false),
                        'default'     => '-1',
                    ),
                    array(
                        'id'          => 'out_of_stock_modal',
                        'type'        => 'select',
                        'title'       => esc_html__('Out Of Stock Modal', 'komestic'),
                        'desc'        => sprintf(esc_html__('Please create your layout before choosing. %sClick Here%s','komestic'),'<a href="' . esc_url( admin_url( 'edit.php?post_type=pxl-template' ) ) . '">','</a>'),
                        'options'     => komestic_get_templates_option('panel', false),
                        'default'     => '-1',
                    ),
                    
                    array(
                        'title' => esc_html__('Post Title', 'komestic'),
                        'type'  => 'section',
                        'id' => 'single_product_title_heading',
                        'indent' => true,
                    ),
                ),
                komestic_post_title_opts('product'),
                array(
                    array(
                        'id'       => 'single_product_title_custom',
                        'type'     => 'text',
                        'title'    => esc_html__('Post Title Custom', 'komestic'),
                    ),
                    array(
                        'id' => 'single_product_breadcrumb_heading',
                        'title' => esc_html__('Breadcrumb', 'komestic'),
                        'type'  => 'section',
                        'indent' => true,
                    ),
                    array(
                        'id'       => 'single_product_breadcrumb',
                        'type'     => 'button_set',
                        'title'    => esc_html__('Breadcrumb', 'komestic'),
                        'options'  => array(
                            'default' => esc_html__('Default', 'komestic'),
                            'custom'  => esc_html__('Custom', 'komestic'),
                        ),
                        'default'  => 'default',
                    ),            
                    array(
                        'id'      => 'single_product_breadcrumb_text',
                        'type'    => 'text',
                        'title'   => esc_html__('Breadcrumb Text', 'komestic'),
                        'default' => esc_html__('Single Product', 'komestic'),
                        'required' => array( 0 => 'single_product_breadcrumb', 1 => 'equals', 2 => 'custom' ),
                    ),
                    array(
                        'id' => 'related_product_heading',
                        'title' => esc_html__('Related Product', 'komestic'),
                        'type'  => 'section',
                        'indent' => true,
                    ),
                    array(
                        'id'        => 'related_product_columns',
                        'type'      => 'slider',
                        'title'     => esc_html__('Columns', 'komestic'),
                        'desc'      => esc_html__('Number of related products displayed per row.', 'komestic'),
                        "default"   => 3,
                        "min"       => 1,
                        "step"      => 1,
                        "max"       => 10,
                        'display_value' => 'label'
                    ), 
                    array(
                        'id'        => 'related_products_per_page',
                        'type'      => 'slider',
                        'title'     => esc_html__('Product Per Page', 'komestic'),
                        'desc'      => esc_html__('Number of related products displayed on page.', 'komestic'),
                        "default"   => 4,
                        "min"       => 1,
                        "step"      => 1,
                        "max"       => 10,
                        'display_value' => 'label'
                    ), 
                    array(
                        'id' => 'single_product_header_heading',
                        'title' => esc_html__('Header', 'komestic'),
                        'type'  => 'section',
                        'indent' => true,
                    ),
                    array(
                        'id'       => 'single_product_header_display',
                        'type'     => 'button_set',
                        'title'    => esc_html__('Header Display', 'komestic'),
                        'options'  => array(
                            'show' => esc_html__('Show', 'komestic'),
                            'hide'  => esc_html__('Hide', 'komestic'),
                        ),
                        'default'  => 'show',
                    ),
                    array(
                        'id'          => 'single_product_header_layout',
                        'type'        => 'select',
                        'title'       => esc_html__('Header Layout', 'komestic'),
                        'desc'        => sprintf(esc_html__('Please create your layout before choosing. %sClick Here%s','komestic'),'<a href="' . esc_url( admin_url( 'edit.php?post_type=pxl-template' ) ) . '">','</a>'),
                        'options'     => komestic_get_templates_option('header', true),
                        'default'     => '-1',
                        'required'   => array('single_product_header_display', '=', 'show'),
                    ),
                    array(
                        'id' => 'single_product_footer_heading',
                        'title' => esc_html__('Footer', 'komestic'),
                        'type'  => 'section',
                        'indent' => true,
                    ),
                    array(
                        'id'       => 'single_product_footer_display',
                        'type'     => 'button_set',
                        'title'    => esc_html__('Footer Display', 'komestic'),
                        'options'  => array(
                            'show' => esc_html__('Show', 'komestic'),
                            'hide'  => esc_html__('Hide', 'komestic'),
                        ),
                        'default'  => 'show',
                    ),
                    array(
                        'id'          => 'single_product_footer_layout',
                        'type'        => 'select',
                        'title'       => esc_html__('Footer Layout', 'komestic'),
                        'desc'        => sprintf(esc_html__('Please create your layout before choosing. %sClick Here%s','komestic'),'<a href="' . esc_url( admin_url( 'edit.php?post_type=pxl-template' ) ) . '">','</a>'),
                        'options'     => komestic_get_templates_option('footer', true),
                        'default'     => '-1',
                        'required'   => array('single_product_footer_display', '=', 'show'),
                    ),                    
                )
            ),
        ));

        Redux::setSection($opt_name, array(
            'title'      => esc_html__('Wishlist', 'komestic'),
            'icon'       => 'eicon-products-archive',
            'subsection' => true,
            'fields'     =>array(
                array(
                    'id'      => 'wishlist_empty_template_id',
                    'type'    => 'select',
                    'title'   => esc_html__('Wishlist Empty Template', 'komestic'),
                    'desc'    => sprintf(esc_html__('Please create your layout before choosing. %sClick Here%s','komestic'),'<a href="' . esc_url( admin_url( 'edit.php?post_type=pxl-template' ) ) . '">','</a>'),
                    'options' => komestic_get_templates_option('woocommerce', true),
                    'default' => '' ,
                ),
            ),
        ));
        Redux::setSection($opt_name, array(
            'title'      => esc_html__('My Account', 'komestic'),
            'icon'       => 'eicon-products-archive',
            'subsection' => true,
            'fields'     =>array(
                // array(
                //     'id'      => 'template_dashboard',
                //     'type'    => 'select',
                //     'title'   => esc_html__('Dashboard Template', 'komestic'),
                //     'desc'    => sprintf(esc_html__('Please create your layout before choosing. %sClick Here%s','komestic'),'<a href="' . esc_url( admin_url( 'edit.php?post_type=pxl-template' ) ) . '">','</a>'),
                //     'options' => komestic_get_templates_option('woocommerce', true),
                //     'default' => '' ,
                // ),
                komestic_get_pages('my_account_dashboard', 'Dashboard'),
                komestic_get_pages('my_account_orders', 'My Orders'),
                komestic_get_pages('my_account_edit_address', 'Address'),
            ),
        ));
    }
}