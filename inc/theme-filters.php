<?php
/**
 * Filters hook for the theme
 *
 * @package Case-Themes
 */

/* Custom Classs - Body */
function komestic_body_classes( $classes ) {   

	$classes[] = '';
    if (class_exists('ReduxFramework')) {
        $classes[] = ' pxl-redux-page';
		$sidebar = isset($_GET['sidebar']) ? sanitize_text_field($_GET['sidebar']) : null;

		$body_custom_class = komestic()->get_page_opt('body_custom_class');
		if(!empty($body_custom_class)) {
			$classes[] .= ' '.$body_custom_class;
		}
		if(isset($_GET['sidebar-shop'])) {
			$classes[] = ' sidebar-shop--'.$_GET['sidebar-shop'];
		}
    }


    return $classes;
}
add_filter( 'body_class', 'komestic_body_classes' );

/* Post Type Support */
function komestic_add_cpt_support() {
    $cpt_support = get_option( 'elementor_cpt_support' );
    
    if( ! $cpt_support ) {
        $cpt_support = [ 'page', 'post', 'project', 'service', 'team', 'footer', 'pxl-template' ];
        update_option( 'elementor_cpt_support', $cpt_support );
    }
    
    else if( ! in_array( 'project', $cpt_support ) ) {
        $cpt_support[] = 'project';
        update_option( 'elementor_cpt_support', $cpt_support );
    }

    else if( ! in_array( 'service', $cpt_support ) ) {
        $cpt_support[] = 'service';
        update_option( 'elementor_cpt_support', $cpt_support );
    }

	else if( ! in_array( 'team', $cpt_support ) ) {
        $cpt_support[] = 'team';
        update_option( 'elementor_cpt_support', $cpt_support );
    }

    else if( ! in_array( 'footer', $cpt_support ) ) {
        $cpt_support[] = 'footer';
        update_option( 'elementor_cpt_support', $cpt_support );
    }

    else if( ! in_array( 'pxl-template', $cpt_support ) ) {
        $cpt_support[] = 'pxl-template';
        update_option( 'elementor_cpt_support', $cpt_support );
    }

}
add_action( 'after_switch_theme', 'komestic_add_cpt_support');

add_filter( 'pxl_support_default_cpt', 'komestic_support_default_cpt' );
function komestic_support_default_cpt($postypes){
	return $postypes; // pxl-template
}

add_filter( 'pxl_theme_builder_post_types', 'komestic_theme_builder_post_type' );
function komestic_theme_builder_post_type($postypes){
	//default are header, footer, mega-menu
	return $postypes;
}

add_filter( 'pxl_theme_builder_layout_ids', 'komestic_theme_builder_layout_id' );
function komestic_theme_builder_layout_id($layout_ids){
	//default [], 
	$header_layout        = (int)komestic()->get_opt('header_layout');
	$header_sticky        = (int)komestic()->get_opt('header_sticky');
	$footer_layout        = (int)komestic()->get_opt('footer_layout');
	$page_title_layout        = (int)komestic()->get_opt('page_title_layout');
	$product_bottom_content        = (int)komestic()->get_opt('product_bottom_content');
	if( $header_layout > 0) 
		$layout_ids[] = $header_layout;
	if( $header_sticky > 0) 
		$layout_ids[] = $header_sticky;
	if( $footer_layout > 0) 
		$layout_ids[] = $footer_layout;
	if( $page_title_layout > 0) 
		$layout_ids[] = $page_title_layout;
	if( $product_bottom_content > 0) 
		$layout_ids[] = $product_bottom_content;

	$slider_template = komestic_get_templates_option('slider');
	if( count($slider_template) > 0){
		foreach ($slider_template as $key => $value) {
			$layout_ids[] = $key;
		}
	}

	$tab_template = komestic_get_templates_option('tab');
	if( count($tab_template) > 0){
		foreach ($tab_template as $key => $value) {
			$layout_ids[] = $key;
		}
	}
	
	$mega_menu_id = komestic_get_mega_menu_builder_id();
	if(!empty($mega_menu_id))
		$layout_ids = array_merge($layout_ids, $mega_menu_id);


	return $layout_ids;
}

add_filter( 'pxl_wg_get_source_id_builder', 'komestic_wg_get_source_builder' );
function komestic_wg_get_source_builder($wg_datas){
  $wg_datas['tabs'] = ['control_name' => 'tabs', 'source_name' => 'content_template'];
  $wg_datas['slides'] = ['control_name' => 'slides', 'source_name' => 'slide_template'];
  return $wg_datas;
}

/* Update primary color in Editor Builder */
add_action( 'elementor/preview/enqueue_styles', 'komestic_add_editor_preview_style' );
function komestic_add_editor_preview_style(){
    wp_add_inline_style( 'editor-preview', komestic_editor_preview_inline_styles() );
}
function komestic_editor_preview_inline_styles(){
    $theme_colors = komestic_get_theme_setting('theme_colors');
    ob_start();
        echo '.elementor-edit-area-active {';
            foreach ($theme_colors as $color => $value) {
                printf('--%1$s-color: %2$s;', str_replace('#', '',$color),  $value['value']);
            }
        echo '}';
    return ob_get_clean();
}
 
add_filter( 'get_the_archive_title', 'komestic_archive_title_remove_label' );
function komestic_archive_title_remove_label( $title ) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_author() ) {
		$title = get_the_author();
	} elseif ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	} elseif ( is_tax() ) {
		$title = single_term_title( '', false );
	} elseif ( is_home() ) {
		$title = single_post_title( '', false );
	}

	return $title;
}

add_filter( 'comment_reply_link', 'komestic_comment_reply_text' );
function komestic_comment_reply_text( $link ) {
	$link = str_replace( 'Reply', ''.esc_attr__('Reply', 'komestic').'', $link );
	return $link;
}
add_filter( 'pxl_enable_pagepopup', 'komestic_enable_pagepopup' );
function komestic_enable_pagepopup() {
	return false;
}
add_filter( 'pxl_enable_megamenu', 'komestic_enable_megamenu' );
function komestic_enable_megamenu() {
	return true;
}
add_filter( 'pxl_enable_onepage', 'komestic_enable_onepage' );
function komestic_enable_onepage() {
	return true;
}

add_filter( 'pxl_support_awesome_pro', 'komestic_support_awesome_pro' );
function komestic_support_awesome_pro() {
	return false;
}
 
add_filter( 'redux_pxl_iconpicker_field/get_icons', 'komestic_add_icons_to_pxl_iconpicker_field' );
function komestic_add_icons_to_pxl_iconpicker_field($icons){
	$custom_icons = []; //'Flaticon' => array(array('flaticon-marker' => 'flaticon-marker')),
	$icons = array_merge($custom_icons, $icons);
	return $icons;
}


add_filter("pxl_mega_menu/get_icons", "komestic_add_icons_to_megamenu");
function komestic_add_icons_to_megamenu($icons){
	$custom_icons = []; //'Flaticon' => array(array('flaticon-marker' => 'flaticon-marker')),
	$icons = array_merge($custom_icons, $icons);
	return $icons;
}
 

/**
 * Move comment field to bottom
 */
add_filter( 'comment_form_fields', 'komestic_comment_field_to_bottom' );
function komestic_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;
	return $fields;
}


/* ------Disable Lazy loading---- */
add_filter( 'wp_lazy_loading_enabled', '__return_false' );

/* ------ Export Settings ---- */
add_filter( 'pxl_export_wp_settings', 'komestic_export_wp_settings' );
function komestic_export_wp_settings($wp_options){
  $wp_options[] = 'mc4wp_default_form_id';
  return $wp_options;
}

/* ------ Theme Info ---- */
add_filter( 'pxl_server_info', 'komestic_add_server_info');
function komestic_add_server_info($infos){
  $infos = [
    'api_url' => 'https://api.casethemes.net/',
    'docs_url' => 'https://doc.casethemes.net/komestic/',
    'plugin_url' => 'https://api.casethemes.net/plugins/',
    'demo_url' => 'https://komestic.casethemes.net/',
    'support_url' => 'https://casethemes.ticksy.com/',
    'help_url' => 'https://doc.casethemes.net/komestic',
    'email_support' => 'casethemesagency@gmail.com',
    'video_url' => '#'
  ];
  
  return $infos;
}

/* ------ Template Filter ---- */
add_filter( 'pxl_template_type_support', 'komestic_template_type_support' );
function komestic_template_type_support($type) {
	$extra_type = [
		'header'          => esc_html__('Header Desktop', 'komestic'),
		'header-mobile'   => esc_html__('Header Mobile', 'komestic'),
        'footer'          => esc_html__('Footer', 'komestic'), 
        'mega-menu'       => esc_html__('Mega Menu', 'komestic') ,
		'page-title'      => esc_html__('Page Title', 'komestic'), 
		'post-title'      => esc_html__('Post Title', 'komestic'), 
		'panel'           => esc_html__('Panel', 'komestic'),
		'woocommerce'     => esc_html__('WooCommerce', 'komestic'),
	];
	return $extra_type;
}

/* Add Custom Font Face */
add_filter( 'elementor/fonts/groups', 'komestic_update_elementor_font_groups_control' );
function komestic_update_elementor_font_groups_control($font_groups){
  $pxlfonts_group = array( 'pxlfonts' => esc_html__( 'Komestic Fonts', 'komestic' ) );
  return array_merge( $pxlfonts_group, $font_groups );
}

add_filter( 'elementor/fonts/additional_fonts', 'komestic_update_elementor_font_control' );
function komestic_update_elementor_font_control($additional_fonts){
  $additional_fonts['Julietta-Messie'] = 'pxlfonts';
  return $additional_fonts;
}

add_filter( 'wpforms_frontend_disable_css', '__return_true' );

// add custom font to redux
add_filter( 'redux/'.komestic()->get_option_name().'/field/typography/custom_fonts', 'komestic_add_redux_option_typo_customfont', 10, 1 ); 
function komestic_add_redux_option_typo_customfont($fonts){
	$fonts = [
		'Theme Custom Fonts' => [
		]
	];
	return $fonts;
}

/* Edit Popup Elementor Pro */
function komestic_fix_elementor_popup_location( $that ){
    $loc = $that->get_location('popup');
    
    if( ! $loc['edit_in_content'] ){
        $args = [
            'label'           => $loc['label'],
            'multiple'        => $loc['multiple'],
            'public'          => $loc['public'],
            'edit_in_content' => true,
            'hook'            => $loc['hook'],
        ];
        
        $that->register_location('popup', $args);
    }
}
add_action('elementor/theme/register_locations', 'komestic_fix_elementor_popup_location', 9999999 );