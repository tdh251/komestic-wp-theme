<?php

//Custom products layout on archive page
add_filter( 'loop_shop_columns', 'komestic_loop_shop_columns', 20 ); 
function komestic_loop_shop_columns() {
	$sidebar = komestic()->get_sidebar_value('shop'); 
	$columns = isset($_GET['col']) ? sanitize_text_field($_GET['col']) : komestic()->get_theme_opt('product_columns', 3);
	return $columns;
}
 
// Change number of products that are displayed per page (shop page)
add_filter( 'loop_shop_per_page', 'komestic_loop_shop_per_page', 20 );
function komestic_loop_shop_per_page( $limit ) {
	$limit = komestic()->get_theme_opt('products_per_page', 12);
	return $limit;
}

/* Pagination Args */
function komestic_filter_woocommerce_pagination_args( $array ) { 
	$array['end_size'] = 1;
	$array['mid_size'] = 1;
    return $array; 
}; 
add_filter( 'woocommerce_pagination_args', 'komestic_filter_woocommerce_pagination_args', 10, 1 ); 

/* Flex Slider Arrow */
add_filter( 'woocommerce_single_product_carousel_options', 'komestic_update_woo_flexslider_options' );
function komestic_update_woo_flexslider_options( $options ) {
	$options['directionNav'] = false;
	return $options;
}

/* Single Thumbnail Size */
$single_img_size = komestic()->get_theme_opt('single_img_size');
if(!empty($single_img_size['width']) && !empty($single_img_size['height'])) {
	add_filter('woocommerce_get_image_size_single', function ($size) {
		$single_img_size = komestic()->get_theme_opt('single_img_size');
		$single_img_size_width = preg_replace('/[^0-9]/', '', $single_img_size['width']);
		$single_img_size_height = preg_replace('/[^0-9]/', '', $single_img_size['height']);
		$size['width'] = $single_img_size_width;
	    $size['height'] = $single_img_size_height;
	    $size['crop'] = 1;
	    return $size;
	});
}
add_filter('woocommerce_get_image_size_gallery_thumbnail', function ($size) {
    $size['width'] = 300;
    $size['height'] = 300;
    $size['crop'] = 1;
    return $size;
});

add_filter('woocommerce_get_image_size_thumbnail', function ($size) {
    $size['width'] = 576;
    $size['height'] = 726;
    $size['crop'] = 1;
    return $size;
});



