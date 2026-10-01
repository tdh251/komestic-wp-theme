<?php
include_once get_template_directory() . '/inc/modules/shortcodes/class-komestic-wc-shortcodes.php';

// Hiển thị lời chào + description trong trang My Account
function komestic_account_greeting_shortcode() {
    if ( ! is_user_logged_in() ) {
        return ''; // nếu chưa login thì không hiện
    }

    $current_user = wp_get_current_user();

    // Cho phép class trong thẻ <a>
    $allowed_html = array(
        'a' => array(
            'href'  => array(),
            'class' => array(),
            'title' => array(),
            'target'=> array(),
        ),
        'span' => array(
            'class' => array(),
        ),
    );

    ob_start();
    ?>
    <div class="wc-dashboard__greeting">
		<?php
		printf(
			wp_kses( __( '%1$s (not %2$s? <a href="%3$s">Log out</a>)', 'komestic' ), $allowed_html ),
			'<span class="hello">Hello <span class="user-name">' . esc_html( $current_user->display_name) . '</span>!</span>',
			'<span>' . esc_html( $current_user->display_name ) . '</span>',
			esc_url( wc_logout_url() )
		);
		?>
	</div>
	
	<div class="wc-dashboard__do-something">
		<?php
		$dashboard_desc = __( 'Today is a great day to check your account page. You can check <a class="text-underline" href="%1$s">your last orders</a>, or have a look to <a class="text-underline" href="%2$s"> your wishlist </a>. Or maybe you can start to shop <a class="text-underline" href="%3$s">our latest offers</a>?', 'komestic' );
		if ( wc_shipping_enabled() ) {
			$dashboard_desc = __( 'Today is a great day to check your account page. You can check <a class="text-underline" href="%1$s">your last orders</a>, or have a look to <a class="text-underline" href="%2$s"> your wishlist </a>. Or maybe you can start to shop <a class="text-underline" href="%3$s">our latest offers</a>?', 'komestic' );
		}
		printf(
			wp_kses( $dashboard_desc, $allowed_html ),
			esc_url( wc_get_endpoint_url( 'orders' ) ),
			esc_url( wc_get_endpoint_url( 'wishlist' ) ),
			esc_url( wc_get_endpoint_url( '' ) )
		);
		?>
	</div>

    <?php
    return ob_get_clean();
}



function register_komestic_shortcodes() {
    if(!function_exists('pxl_register_shortcode')){
        return;
    }
    pxl_register_shortcode( 'komestic_recent_products', array( 'Komestic_WC_Shortcodes', 'komestic_recent_products' ) );
    pxl_register_shortcode( 'komestic_sale_products', array( 'Komestic_WC_Shortcodes', 'komestic_sale_products' ) );
    pxl_register_shortcode( 'komestic_best_selling_products', array( 'Komestic_WC_Shortcodes', 'komestic_best_selling_products' ) );
    pxl_register_shortcode( 'komestic_top_rated_products', array( 'Komestic_WC_Shortcodes', 'komestic_top_rated_products' ) );
    pxl_register_shortcode( 'komestic_featured_products', array( 'Komestic_WC_Shortcodes', 'komestic_featured_products' ) );
    pxl_register_shortcode( 'komestic_account_greeting', 'komestic_account_greeting_shortcode' );
}
add_action( 'init', 'register_komestic_shortcodes' );
