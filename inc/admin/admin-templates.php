<?php

if( !defined( 'ABSPATH' ) )
	exit; 

class Komestic_Admin_Templates extends Komestic_Base{

	public function __construct() {
		$this->add_action( 'admin_menu', 'register_page', 20 );
	}
 
	public function register_page() {
		add_submenu_page(
			'pxlart',
		    esc_html__( 'Templates', 'komestic' ),
		    esc_html__( 'Templates', 'komestic' ),
		    'manage_options',
		    'edit.php?post_type=pxl-template',
		    false
		);
	}
}
new Komestic_Admin_Templates;
