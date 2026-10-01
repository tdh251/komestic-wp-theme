<?php
defined( 'ABSPATH' ) || exit;

if ( class_exists( 'WPCleverWoosc' ) ) {
    
    // class Komestic_WPCleverWoosc extends WPCleverWoosc {
        
    //     protected static $instance = null;

    //     public static function instance() {
    //         if ( is_null( self::$instance ) ) {
    //             self::$instance = new self();
    //         }
    //         return self::$instance;
    //     }

    //     public function __construct() { 
    //         parent::__construct();
    //         // add_action( 'wc_ajax_komestic_woosc_load', [ $this, 'komestic_ajax_load' ] );
    //     }

    //     public function komestic_woosc_popup() {

    //     }

    //     function komestic_get_popup($ajax = true, $context = "") {
    //         return '<h1>Tu Tutututu </h1>';;
    //     }
 
        // function komestic_ajax_load() {
        //     $data = [
        //         'message' => 'Đã nhận',
        //         'debug'   => $_REQUEST,
        //     ];
        //     if ( isset( $_REQUEST['get_data'] ) && sanitize_key( $_REQUEST['get_data'] ) === 'popup' ) {
        //         $data['popup'] = $this->komestic_get_popup( true, 'popup' );
        //     }

        //     wp_send_json( $data );
        // }
    // }

    // add_action( 'wp_footer', function() {
    //     Komestic_WPCleverWoosc::instance()->komestic_woosc_popup();
    // });
}