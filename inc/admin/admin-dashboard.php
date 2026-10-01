<?php
/**
* The Komestic_Admin_Dashboard base class
*/

if( !defined( 'ABSPATH' ) )
	exit; 

class Komestic_Admin_Dashboard extends Komestic_Admin_Page {
	protected $id = null;
	protected $page_title = null;
	protected $menu_title = null;
	public $position = null;
	public function __construct() {
		$this->id = 'pxlart';
		$this->page_title = komestic()->get_name();
		$this->menu_title = komestic()->get_name();
		$this->position = '50';

		parent::__construct();
	}

	public function display() {
		get_template_part('inc/admin/views/admin-dashboard' );
	}
 
	public function save() {

	}
}
new Komestic_Admin_Dashboard;
