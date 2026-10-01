<?php
/**
 * Template part for displaying default header layout
 */

$site_logo = komestic()->get_theme_opt( 'site_logo', ['url' => get_template_directory_uri().'/assets/images/logo.png'] );
$primary_menu = komestic()->get_page_opt('primary_menu');
?>
<header id="pxl-header" class="pxl-header default">
    <div id="header-desktop" class="header-desktop">
        <div class="container">
            <div class="header-inner">
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
                <div class="navigation-menu">
                    <?php
                        if ( has_nav_menu( 'primary' ) )
                        {
                            $attr_menu = array(
                                'theme_location' => 'primary',
                                'container'  => '',
                                'menu_id'    => '',
                                'menu_class' => 'pxl-menu-main',
                                'link_before'     => '<span>',
                                'link_after'      => '</span><svg class="drop-down" xmlns="http://www.w3.org/2000/svg" width="13" height="12" viewBox="0 0 13 12">
                                                        <path d="M10.9844 4L6.48688 8.0485L1.98837 4L0.984375 5.115L6.48688 10.0665L11.9884 5.115L10.9844 4Z" fill="currentcolor"/>
                                                    </svg>',
                                'walker'         => class_exists( 'PXL_Mega_Menu_Walker' ) ? new PXL_Mega_Menu_Walker : '',
                            );
                            if(isset($primary_menu) && !empty($primary_menu)) {
                                $attr_menu['menu'] = $primary_menu;
                            }
                            wp_nav_menu( $attr_menu );
                        } else { 
                            printf(
                                '<ul class="pxl-menu-main"><li><a class="create-new-menu" href="%1$s">%2$s</a></li></ul>',
                                esc_url( admin_url( 'nav-menus.php' ) ),
                                esc_html__( 'Create New Menu', 'komestic' )
                            );
                            ?>
                        <?php }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div id="header-mobile" class="header-mobile">
        <div class="container">
            <div class="header-inner">
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
                                if ( has_nav_menu( 'primary' ) )
                                {
                                    $attr_menu = array(
                                        'theme_location' => 'primary',
                                        'container'  => '',
                                        'menu_id'    => '',
                                        'menu_class' => 'pxl-menu-main',
                                        'link_before'     => '<span>',
                                        'link_after'      => '</span><svg class="drop-down" xmlns="http://www.w3.org/2000/svg" width="13" height="12" viewBox="0 0 13 12">
                                                                <path d="M10.9844 4L6.48688 8.0485L1.98837 4L0.984375 5.115L6.48688 10.0665L11.9884 5.115L10.9844 4Z" fill="currentcolor"/>
                                                            </svg>',
                                        'walker'         => class_exists( 'PXL_Mega_Menu_Walker' ) ? new PXL_Mega_Menu_Walker : '',
                                    );
                                    if(isset($primary_menu) && !empty($primary_menu)) {
                                        $attr_menu['menu'] = $primary_menu;
                                    }
                                    wp_nav_menu( $attr_menu );
                                } else { 
                                    printf(
                                        '<ul class="pxl-menu-main"><li><a class="create-new-menu" href="%1$s">%2$s</a></li></ul>',
                                        esc_url( admin_url( 'nav-menus.php' ) ),
                                        esc_html__( 'Create New Menu', 'komestic' )
                                    );
                                    ?>
                                <?php }
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
