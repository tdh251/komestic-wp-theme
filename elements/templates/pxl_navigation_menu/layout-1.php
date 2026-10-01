<?php
$menu_hover_style = $widget->get_setting('menu_hover_style', '');
add_filter('nav_menu_link_attributes', function($attrs, $item, $args, $depth) use ($menu_hover_style) {
    if ($depth == 0 && !empty($menu_hover_style)) {
        if (isset($attrs['class'])) {
            $attrs['class'] .= ' ' . $menu_hover_style;
        } else {
            $attrs['class'] = $menu_hover_style;
        }
    }
    return $attrs;
}, 10, 4);


// $submenu_show_effect = $widget->get_setting('submenu_show_effect', '');
$primary_menu = komestic()->get_page_opt('primary_menu');
$menu         = !empty($primary_menu) ? $primary_menu : $widget->get_setting('menu', 0);

if(!empty($menu)) {
    $menu_attrs = [
        'theme_location' => 'primary',
        'menu_class'   => 'pxl-menu-main',
        'walker'       => class_exists( 'PXL_Mega_Menu_Walker' ) ? new PXL_Mega_Menu_Walker : '',
        'link_before'  => '<span class="menu-text">',
        'link_after'   => '</span>
                            <svg class="drop-down" xmlns="http://www.w3.org/2000/svg" width="13" height="12" viewBox="0 0 13 12">
                                <path d="M10.9844 4L6.48688 8.0485L1.98837 4L0.984375 5.115L6.48688 10.0665L11.9884 5.115L10.9844 4Z" fill="currentcolor"/>
                            </svg>',        
        'menu'         => wp_get_nav_menu_object($menu)
    ];
}elseif(has_nav_menu( 'primary' )) {
    $menu_attrs = array(
        'theme_location' => 'primary',
        'menu_class'     => 'pxl-menu-main',
        'link_before'  => '<span class="menu-text">',
        'link_after'   => '</span>
                            <svg class="drop-down" xmlns="http://www.w3.org/2000/svg" width="13" height="12" viewBox="0 0 13 12">
                                <path d="M10.9844 4L6.48688 8.0485L1.98837 4L0.984375 5.115L6.48688 10.0665L11.9884 5.115L10.9844 4Z" fill="currentcolor"/>
                            </svg>',
        'walker'         => class_exists( 'PXL_Mega_Menu_Walker' ) ? new PXL_Mega_Menu_Walker : '',
    );
}
?>
<div class="pxl-navigation-menu">
    <?php wp_nav_menu($menu_attrs); ?>
</div>
