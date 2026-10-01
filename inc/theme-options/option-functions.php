<?php 
/**
 * Get Post List 
*/
if(!function_exists('komestic_list_post')){
    function komestic_list_post($post_type = 'post', $default = false){
        $post_list = array();
        $posts = get_posts(array('post_type' => $post_type, 'orderby' => 'date', 'order' => 'ASC', 'posts_per_page' => '-1'));
        if($default){
        	$post_list[-1] = esc_html__( 'Inherit', 'komestic' );
        }
        foreach($posts as $post){
            $post_list[$post->ID] = $post->post_title;
        }
        return $post_list;
    }
}

if(!function_exists('komestic_get_templates_option')){
	function komestic_get_templates_option($meta_value = 'df', $default = false){
        $post_list = array();
        if($default && !is_array($default)){
            $post_list[-1] = esc_html__('Inherit','komestic');
        }
        if(is_array($default)){
        	$key = isset($default['key']) ? $default['key'] : '0';
        	$post_list[$key] = !empty($default['value']) ? $default['value'] : esc_html__('None','komestic');
        }
        $args = array(
            'post_type' => 'pxl-template',
            'posts_per_page' => '-1',
            'orderby' => 'date',
            'order' => 'ASC',
            'meta_query' => array(
                array(
                    'key'       => 'template_type',
                    'value'     => $meta_value,
                    'compare'   => '='
                )
            )
        );

        $posts = get_posts($args);
        
        foreach($posts as $post){  
        	$template_type = get_post_meta( $post->ID, 'template_type', true );
        	if($template_type == 'df') continue;
            $post_list[$post->ID] = $post->post_title;
        }
         
        return $post_list;
    }
}

if(!function_exists('komestic_get_templates_slug')){
    function komestic_get_templates_slug($meta_value = 'df'){
        $post_list = array();
        $posts = get_posts(
        	array(
        		'post_type' => 'pxl-template', 
        		'orderby' => 'date', 
        		'order' => 'ASC', 
        		'posts_per_page' => '-1',
        		'meta_query' => array(
	                array(
	                    'key'       => 'template_type',
	                    'value'     => $meta_value,
	                    'compare'   => '='
	                )
	            )
        	)
        );
         
        foreach($posts as $post){
        	$template_type = get_post_meta( $post->ID, 'template_type', true );
        	if($template_type == 'df') continue;
        	$value_args = [
        		'post_id' => $post->ID, 
        		'title' => $post->post_title
        	];
        	$template_position = get_post_meta( $post->ID, 'template_position', true );
        	 
    		$value_args['position'] = !empty($template_position) ? $template_position : '';

            $post_list[$post->post_name] = $value_args;
        }
        return $post_list;
    }
}

if(!function_exists('komestic_header_opts')){
	function komestic_header_opts($args=[]){
		$args = wp_parse_args($args,[
			'default'         => false,
			'default_value'   => ''
		]);
		 
		$opts = array(
	        array(
				'id'      => 'header_layout',
				'type'    => 'select',
				'title'   => esc_html__('Header Layout', 'komestic'),
				'desc'    => sprintf(esc_html__('Please create your layout before choosing. %sClick Here%s','komestic'),'<a href="' . esc_url( admin_url( 'edit.php?post_type=pxl-template' ) ) . '">','</a>'),
				'options' => komestic_get_templates_option('header',$args['default']),
				'default' => $args['default_value']  
	        ),
            array(
				'id'      => 'header_layout_sticky',
				'type'    => 'select',
				'title'   => esc_html__('Header Sticky', 'komestic'),
				'desc'    => sprintf(esc_html__('Please create your layout before choosing. %sClick Here%s','komestic'),'<a href="' . esc_url( admin_url( 'edit.php?post_type=pxl-template' ) ) . '">','</a>'),
				'options' => komestic_get_templates_option('header',$args['default']),
				'default' => $args['default_value'],
	        )
	    );
 
		return $opts;
	}
}

if(!function_exists('komestic_header_mobile_opts')){
	function komestic_header_mobile_opts($args=[]){
		$args = wp_parse_args($args,[
			'default'         => false,
			'default_value'   => ''
		]);
		 
		$opts = array(
	        array(
				'id'      => 'header_mobile_layout',
				'type'    => 'select',
				'title'   => esc_html__('Header Layout', 'komestic'),
				'desc'    => sprintf(esc_html__('Please create your layout before choosing. %sClick Here%s','komestic'),'<a href="' . esc_url( admin_url( 'edit.php?post_type=pxl-template' ) ) . '">','</a>'),
				'options' => komestic_get_templates_option('header-mobile',$args['default']),
				'default' => $args['default_value']  
	        ),
	    );
 
		return $opts;
	}
}

if(!function_exists('komestic_page_title_options')){
	function komestic_page_title_options($args=[]){
		$args = wp_parse_args($args,[
			'default'         => false,
			// 'default_value'   => '1'
		]);
		if($args['default']){
			$page_title_mode_options = [
				'inherit'   => esc_html__('Inherit', 'komestic'),
	            'builder'   => esc_html__('Builder', 'komestic'),
	            'disable'   => esc_html__('Disable', 'komestic')
			];
			$page_title_default_value = 'inherit';
		}else{
			$page_title_mode_options = [
				'default'   => esc_html__('Default', 'komestic'),
	            'builder'   => esc_html__('Builder', 'komestic'),
	            'disable'   => esc_html__('Disable', 'komestic')
			];
			$page_title_default_value = 'default';
		}
		$opts = array(
	        array(
	            'id'           => 'page_title_mode',
	            'type'         => 'button_set',
	            'title'        => esc_html__( 'Page Title', 'komestic' ),
	            'options' => $page_title_mode_options, 
                'default' => $page_title_default_value
	        ),
	        array(
	            'id'       => 'page_title_layout',
	            'type'     => 'select',
	            'title'    => esc_html__('Page Title Layout', 'komestic'),
	            'desc'     => sprintf(esc_html__('Please create your layout before choosing. %sClick Here%s','komestic'),'<a href="' . esc_url( admin_url( 'edit.php?post_type=pxl-template' ) ) . '">','</a>'),
	            'options'  => komestic_get_templates_option('page-title', false),
	            'default'  => $page_title_default_value,
	            'required' => array( 'page_title_mode', '=', 'builder' )
	        ),
	    );
 
		return $opts;
	}
}

if(!function_exists('komestic_post_title_opts')){
	function komestic_post_title_opts($post_type = 'post'){
		$opts = array(
	        array(
	            'id'           => $post_type.'_title_mode',
	            'type'         => 'button_set',
	            'title'        => esc_html__( 'Post Title Mode', 'komestic' ),
	            'options' => [
					''         => esc_html__('Default', 'komestic'),
					'builder'  => esc_html__('Builder', 'komestic'),
					'disable'  => esc_html__('Disable', 'komestic')
				], 
                'default' => ''
	        ),
	        array(
	            'id'       => $post_type.'_title_layout',
	            'type'     => 'select',
	            'title'    => esc_html__('Post Title Layout', 'komestic'),
	            'desc'        => sprintf(esc_html__('Please create your layout before choosing. %sClick Here%s','komestic'),'<a href="' . esc_url( admin_url( 'edit.php?post_type=pxl-template' ) ) . '">','</a>'),
	            'options'  => komestic_get_templates_option('post-title', false),
	            'default'  => 'default',
	            'required' => array( $post_type.'_title_mode', '=', 'builder' )
	        ),
	    );
 
		return $opts;
	}
}

if(!function_exists('komestic_footer_opts')){
	function komestic_footer_opts($args=[]){
		$args = wp_parse_args($args,[
			'default'         => false,
			'default_value'   => ''
		]);
		 
		$opts = array(
	        array(
	            'id'          => 'footer_layout',
	            'type'        => 'select',
	            'title'       => esc_html__('Footer Layout', 'komestic'),
	            'desc'        => sprintf(esc_html__('Please create your layout before choosing. %sClick Here%s','komestic'),'<a href="' . esc_url( admin_url( 'edit.php?post_type=pxl-template' ) ) . '">','</a>'),
	            'options'     => komestic_get_templates_option('footer', $args['default']),
	            'default'     => $args['default_value'],
	        )
	    );
 
		return $opts;
	}
}
if(!function_exists('komestic_sidebar_options')){
	function komestic_sidebar_options($args=[]){
		$args = wp_parse_args($args,[
			'prefix'        => 'blog',
			'page_option'   => false,
			'default'       => 'right'
		]);
		$prefix = isset($args['prefix']) ? $args['prefix'].'_' : null;
		if($args['page_option']){
			$options = [
				'inherit'    => esc_html__('Inherit','komestic'),
				'left'       => esc_html__('Left','komestic'),
				'right'      => esc_html__('Right','komestic'),
				'disable'    => esc_html__('Disable','komestic'),
			];
		} else {
			$options = [
				'left'      => esc_html__('Left','komestic'),
				'right'     => esc_html__('Right','komestic'),
				'disable'   => esc_html__('Disable','komestic'),
			]; 
		}  
		$opts = [
			'id'       => $prefix.'sidebar',
			'type'     => 'button_set',
			'title'    => esc_html__('Sidebar', 'komestic'),
			'options'  => $options,
			'default'  => $args['default'],
		];
		return $opts;
	}
}


/* Get list menu */
function komestic_get_nav_menu_slug(){

    $menus = array(
        '-1' => esc_html__('Inherit', 'komestic')
    );

    $obj_menus = wp_get_nav_menus();

    foreach ($obj_menus as $obj_menu){
        $menus[$obj_menu->slug] = $obj_menu->name;
    }
    return $menus;
}

function komestic_get_menu_options() {
	$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
	$pxl_menus = '';
	if ( is_array( $menus ) && ! empty( $menus ) ) {
		$pxl_menus = array(
			'' => esc_html__('Default', 'komestic')
		);
		foreach ( $menus as $value ) {
			if ( is_object( $value ) && isset( $value->name, $value->slug ) ) {
				$pxl_menus[ $value->slug ] = $value->name;
			}
		}
	}
	return $pxl_menus;
}


// Get Page ID
function komestic_get_pages($prefix = '', $label = 'Set Page') {
	$args = array(
		'post_type'      => 'page', 
		'meta_key'       => '_elementor_edit_mode',
		'meta_compare'   => 'EXISTS',
		'posts_per_page' => -1 
	);
	
	$query = new WP_Query($args);
	$options = [
		'' => esc_html__('Default', 'komestic'),
	];
	if ($query->have_posts()) {
		while ($query->have_posts()) {
			$query->the_post();
			$options[get_the_ID()] = get_the_title();
		}
		wp_reset_postdata();
	}
	return array(
		'id'       => $prefix.'_page_id',
		'type'     => 'select',
		'title'    => sprintf('%1$s', esc_html($label)),
		'desc'     => sprintf(esc_html__('Please create your layout before choosing. %sClick Here%s','komestic'),'<a href="' . esc_url( admin_url( 'edit.php?post_type=pxl-page' ) ) . '">','</a>'),
		'options'  => $options,
		'default'  => '',
	);
}

function komestic_get_product_tabs_fields($total_tabs = 10) {
    $args = array();

    for ($i = 3; $i <= $total_tabs; $i++) {
        $args[] = array(
            'id'     => 'product_tab_' . $i . '_heading',
            'title'  => sprintf( esc_html__( 'Add %d', 'komestic' ), $i ),
            'type'   => 'section',
            'indent' => true,
            'required' => array( 'product_add_tabs', '>=', $i ),
        );

        $args[] = array(
            'id'      => 'product_tab_' . $i . '_title',
            'type'    => 'text',
            'title'   => esc_html__( 'Title', 'komestic' ),
            'default' => esc_html__( 'Title', 'komestic' ),
            'required' => array( 'product_add_tabs', '>=', $i ),
        );

        $args[] = array(
            'id'    => 'product_tab_' . $i . '_content',
            'type'  => 'editor',
            'title' => esc_html__( 'Content', 'komestic' ),
            'args'  => array(
                'teeny'         => true,
                'textarea_rows' => 10,
            ),
            'required' => array( 'product_add_tabs', '>=', $i ),
        );
    }

    return $args;
}



