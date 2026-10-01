<?php

if( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

use Automattic\WooCommerce\Enums\CatalogVisibility;
/**
 * Class WC_Shortcode_Products
 *
 * This class handles the display of products in various formats.
 */
if(class_exists('WC_Shortcode_Products')) {
	class Komestic_WC_Shortcode_Products extends WC_Shortcode_Products {
	
		public function __construct( $attributes = array(), $type = 'products' ) {
			
			parent::__construct( $attributes, $type );
		}
	
		/**
		 * Parse attributes.
		 *
		 * @since  3.2.0
		 * @param  array $attributes Shortcode attributes.
		 * @return array
		 */
		protected function parse_attributes( $attributes ) {
			$attributes = $this->parse_legacy_attributes( $attributes );
	
			$attributes = shortcode_atts(
				array(
					'limit'          => '-1',      // Results limit.
					'columns'        => '',        // Number of columns.
					'rows'           => '',        // Number of rows. If defined, limit will be ignored.
					'orderby'        => '',        // menu_order, title, date, rand, price, popularity, rating, or id.
					'order'          => '',        // ASC or DESC.
					'ids'            => '',        // Comma separated IDs.
					'skus'           => '',        // Comma separated SKUs.
					'category'       => '',        // Comma separated category slugs or ids.
					'cat_operator'   => 'IN',      // Operator to compare categories. Possible values are 'IN', 'NOT IN', 'AND'.
					'attribute'      => '',        // Single attribute slug.
					'terms'          => '',        // Comma separated term slugs or ids.
					'terms_operator' => 'IN',      // Operator to compare terms. Possible values are 'IN', 'NOT IN', 'AND'.
					'tag'            => '',        // Comma separated tag slugs.
					'tag_operator'   => 'IN',      // Operator to compare tags. Possible values are 'IN', 'NOT IN', 'AND'.
					'visibility'     => CatalogVisibility::VISIBLE, // Product visibility setting. Possible values are 'visible', 'catalog', 'search', 'hidden'.
					'class'          => '',        // HTML class.
					'page'           => 1,         // Page for pagination.
					'paginate'       => false,     // Should results be paginated.
					'cache'          => true,      // Should shortcode output be cached.
				),
				$attributes,
				$this->type
			);
	
			if ( ! absint( $attributes['columns'] ) ) {
				$attributes['columns'] = wc_get_default_products_per_row();
			}
	
			return $attributes;
		}
	
		public function komestic_get_products() {
			$products = $this->get_query_results();
			$product_ids_string = '';
			if ( $products->ids ) {
				$product_ids_string = implode('-', $products->ids);
			}
			return $product_ids_string;
		}
	
	}
}