<?php 
$header_display = komestic()->get_page_opt('header_display', 'show');
if($header_display === 'show') : 
    $site_logo = komestic()->get_opt( 'site_logo', ['url' => get_template_directory_uri().'/assets/images/logo.png', 'id' => 'null'] );
    $primary_menu = komestic()->get_page_opt('primary_menu');
    $header_layout = komestic()->get_opt('header_layout');

    $post_header = get_post((int) $header_layout);
    $header_type = get_post_meta( $post_header->ID, 'header_type', true );

    // Header Mobile
    $header_mobile_layout = komestic()->get_opt('header_mobile_layout');
    $header_mobile_layout_count = (int)komestic()->get_opt('header_mobile_layout');
    $post_header_mobile = get_post($header_mobile_layout);
    $is_header_mobile_builder = ( $header_mobile_layout_count > 0 ) && class_exists('Pxltheme_Core') && is_callable( 'Elementor\Plugin::instance' );
    
    // Header Sticky
    $header_sticky_show_on_scroll = komestic()->get_opt('header_sticky_show_on_scroll');
    $has_header_sticky = isset($args['header_layout_sticky']) && $args['header_layout_sticky'] > 0 || false;

?>
    <header id="pxl-header" class="pxl-header elementor">
        <div id="header-desktop" class="header-desktop">
            <div class="container">
                <div class="header-inner">
                    <?php echo Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $args['header_layout']); ?>
                </div>
            </div>
        </div>
        <?php if($has_header_sticky) : ?>
            <div id="header-sticky" class="header-sticky <?php echo esc_attr($header_sticky_show_on_scroll); ?>">
                <div class="container">
                    <div class="header-inner">
                        <?php echo Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $args['header_layout_sticky']); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div id="header-mobile" class="header-mobile">
            <div class="container">
                <div class="header-inner">
                    <?php if (!$is_header_mobile_builder) : ?>
                        <div class="site-logo">
                            <?php
                                if ($site_logo['url']) {
                                    printf(
                                        '<a href="%1$s" title="%2$s" rel="home"><img src="%3$s" alt="%2$s"/></a>',
                                        esc_url( home_url( '/' ) ),
                                        esc_attr( get_bloginfo( 'name' ) ),
                                        esc_url( $site_logo['url'] )
                                    );
                                }
                            ?>
                        </div>
                        <button class="pxl-button mobile-button-toggle">
                            <span class="hamburger">
                                <span class="line line-1"></span>
                                <span class="line line-2"></span>
                                <span class="line line-3"></span>
                            </span>
                        </button>
                    <?php else : ?>
                        <?php echo Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $header_mobile_layout ); ?>
                    <?php endif; ?>
                </div>
                <div class="mobile-sidebar">
                    <div class="sidebar-wrap">
                        <div class="sidebar-inner">
                            <div class="site-logo">
                                <?php
                                    if ($site_logo['url']) {
                                        printf(
                                            '<a href="%1$s" title="%2$s" rel="home"><img src="%3$s" alt="%2$s"/></a>',
                                            esc_url( home_url( '/' ) ),
                                            esc_attr( get_bloginfo( 'name' ) ),
                                            esc_url( $site_logo['url'] )
                                        );
                                    }
                                ?>
                            </div>
                            <?php komestic_mobile_search_form(); ?>
                            <div class="navigation-menu">
                                <?php 
                                    if ( has_nav_menu('primary-mobile') ) :
                                        $attr_menu = array(
                                            'theme_location' => 'primary-mobile',
                                            'container'  => '',
                                            'menu_id'    => '',
                                            'menu_class' => 'pxl-menu-main',
                                            'link_before'     => '<span>',
                                            'link_after'      => '</span>
                                                                <svg class="drop-down" xmlns="http://www.w3.org/2000/svg" width="13" height="12" viewBox="0 0 13 12">
                                                                    <path d="M10.9844 4L6.48688 8.0485L1.98837 4L0.984375 5.115L6.48688 10.0665L11.9884 5.115L10.9844 4Z" fill="currentcolor"/>
                                                                </svg>',
                                            'walker'         => class_exists( 'PXL_Mega_Menu_Walker' ) ? new PXL_Mega_Menu_Walker : '',
                                        );
                                        if(isset($primary_menu) && !empty($primary_menu)) {
                                            $attr_menu['menu'] = $primary_menu;
                                        }
                                        wp_nav_menu( $attr_menu );
                                    elseif ( has_nav_menu( 'primary' ) ) :
                                        $attr_menu = array(
                                            'theme_location' => 'primary',
                                            'container'  => '',
                                            'menu_id'    => '',
                                            'menu_class' => 'pxl-menu-main',
                                            'link_before'     => '<span>',
                                            'link_after'      => '</span>
                                                                <svg class="drop-down" xmlns="http://www.w3.org/2000/svg" width="13" height="12" viewBox="0 0 13 12">
                                                                    <path d="M10.9844 4L6.48688 8.0485L1.98837 4L0.984375 5.115L6.48688 10.0665L11.9884 5.115L10.9844 4Z" fill="currentcolor"/>
                                                                </svg>',
                                            'walker'         => class_exists( 'PXL_Mega_Menu_Walker' ) ? new PXL_Mega_Menu_Walker : '',
                                        );
                                        if(isset($primary_menu) && !empty($primary_menu)) {
                                            $attr_menu['menu'] = $primary_menu;
                                        }
                                        wp_nav_menu( $attr_menu );
    
                                    else : ?>
                                        <ul class="pxl-menu-main">
                                            <?php wp_list_pages( array(
                                                'depth'        => 0,
                                                'show_date'    => '',
                                                'date_format'  => get_option( 'date_format' ),
                                                'child_of'     => 0,
                                                'exclude'      => '',
                                                'title_li'     => '',
                                                'echo'         => 1,
                                                'authors'      => '',
                                                'sort_column'  => 'menu_order, post_title',
                                                'link_before'  => '',
                                                'link_after'   => '',
                                                'item_spacing' => 'preserve',
                                                'walker'       => '',
                                            ) ); ?>
                                        </ul>
                                    <?php endif;
                                ?>
                            </div>
                        </div>
                    </div>
                    <button class="pxl-button button-close">
                        <span class="button__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="12" viewBox="0 0 13 12">
                                <path d="M10.9844 4L6.48688 8.0485L1.98837 4L0.984375 5.115L6.48688 10.0665L11.9884 5.115L10.9844 4Z" fill="currentcolor"/>
                            </svg>
                        </span>
                    </button>
                </div>
            </div>
        </div>


    </header>
<?php endif; ?>