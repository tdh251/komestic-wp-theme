<?php 
if(class_exists('WC_Shortcodes')) {
	include_once get_template_directory() . '/inc/modules/shortcodes/class-komestic-wc-shortcode-products.php';
	class Komestic_WC_Shortcodes extends WC_Shortcodes {
		public static function komestic_recent_products( $atts ) {
			$atts = array_merge(
				array(
					'limit'        => '12',
					'orderby'      => 'date',
					'order'        => 'DESC',
					'category'     => '',
					'cat_operator' => 'IN',
				),
				(array) $atts
			);
	
			$shortcode = new Komestic_WC_Shortcode_Products( $atts, 'komestic_recent_products' );
	
			return $shortcode->komestic_get_products();
		}
	
		public static function komestic_sale_products( $atts ) {
			$atts = array_merge(
				array(
					'limit'        => '12',
					'orderby'      => 'title',
					'order'        => 'ASC',
					'category'     => '',
					'cat_operator' => 'IN',
				),
				(array) $atts
			);
	
			$shortcode = new Komestic_WC_Shortcode_Products( $atts, 'komestic_sale_products' );
	
			return $shortcode->komestic_get_products();
		}
	
		public static function komestic_best_selling_products( $atts ) {
			$atts = array_merge(
				array(
					'limit'        => '12',
					'columns'      => '4',
					'category'     => '',
					'cat_operator' => 'IN',
				),
				(array) $atts
			);
	
			$shortcode = new Komestic_WC_Shortcode_Products( $atts, 'komestic_best_selling_products' );
	
			return $shortcode->komestic_get_products();
		}
	
		public static function komestic_top_rated_products( $atts ) {
			$atts = array_merge(
				array(
					'limit'        => '12',
					'columns'      => '4',
					'orderby'      => 'title',
					'order'        => 'ASC',
					'category'     => '',
					'cat_operator' => 'IN',
				),
				(array) $atts
			);
	
			$shortcode = new Komestic_WC_Shortcode_Products( $atts, 'komestic_top_rated_products' );
	
			return $shortcode->komestic_get_products();
		}
	
	
		public static function komestic_featured_products( $atts ) {
			$atts = array_merge(
				array(
					'limit'        => '12',
					'columns'      => '4',
					'orderby'      => 'date',
					'order'        => 'DESC',
					'category'     => '',
					'cat_operator' => 'IN',
				),
				(array) $atts
			);
	
			$atts['visibility'] = 'featured';
	
			$shortcode = new Komestic_WC_Shortcode_Products( $atts, 'komestic_featured_products' );
	
			return $shortcode->komestic_get_products();
		}
	}
}