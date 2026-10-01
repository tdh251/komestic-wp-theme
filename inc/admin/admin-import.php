<?php
/**
* The Komestic_Admin_Import class
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

class Komestic_Admin_Import extends Komestic_Admin_Page {
	protected $id = null;
	protected $page_title = null;
	protected $menu_title = null;
	public $parent = null;
	public function __construct() {

		$this->id = 'pxlart-import-demos';
		$this->page_title = esc_html__( 'Import Demos', 'komestic' );
		$this->menu_title = esc_html__( 'Import Demos', 'komestic' );
		$this->parent = 'pxlart';
		//$this->position = '10';

		parent::__construct();
	}

	public function display() {
		get_template_part( 'inc/admin/views/admin-demos' );
	}


	public function save() {

	}
}
new Komestic_Admin_Import;