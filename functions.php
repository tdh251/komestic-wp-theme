<?php
/**
 * Theme functions: init, enqueue scripts and styles, include required files and widgets.
 *
 * @package Case-Themes
 * @since Komestic 1.0
 */

if(!defined('DEV_MODE')){ define('DEV_MODE', true); }

if(!defined('THEME_DEV_MODE_ELEMENTS') && is_user_logged_in()){
    define('THEME_DEV_MODE_ELEMENTS', true);
}
 
require_once get_template_directory() . '/inc/classes/class-main.php';

if ( is_admin() ){ 
	require_once get_template_directory() . '/inc/admin/admin-init.php'; }
 
/**
 * Theme Require
*/
add_filter('request', function( $query_vars ) {
    if ( isset($query_vars['product_cat']) && is_array($query_vars['product_cat']) ) {
        $query_vars['product_cat'] = implode(',', array_map('sanitize_title', $query_vars['product_cat']));
    }
    return $query_vars;
});

komestic()->require_folder('inc');
komestic()->require_folder('inc/core');
komestic()->require_folder('inc/classes');
komestic()->require_folder('inc/theme-options');
require_once get_template_directory() . '/inc/modules/shortcodes/init.php';
if(class_exists('Woocommerce')){
    require_once get_template_directory() . '/inc/modules/woocommerce/init.php';
}
komestic()->require_folder('inc/helpers');
require_once get_template_directory() . '/inc/modules/widgets/init.php';
require_once get_template_directory() . '/inc/modules/assets/enqueue.php';
komestic()->require_folder('template-parts/widgets');

require_once get_template_directory() . '/woocommerce/wc-function.php';

require_once get_template_directory() . '/inc/modules/ajax/ajax-handlers.php';

