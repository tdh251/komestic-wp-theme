<?php

add_action( 'wp_ajax_load_product_categories_callback', 'load_product_categories_callback' );
add_action( 'wp_ajax_nopriv_load_product_categories_callback', 'load_product_categories_callback' );
function load_product_categories_callback() {
    try {
        if(!isset($_POST['settings'])){
            throw new Exception(__('Something went wrong while requesting. Please try again!', 'komestic'));
        }
        $settings_raw = isset($_POST['settings']) ? wp_unslash($_POST['settings']) : '{}';
        $settings = json_decode($settings_raw, true);

        set_query_var('paged', $settings['paged']);

        $cat_arr = komestic_get_product_categories([
            'orderby' => $settings['orderby'] ?? 'date',
            'order'  => $settings['order'] ?? 'desc',
            'limit' => $settings['limit'] ?? 6,
            'hide_cat_empty' => $settings['hide_cat_empty'] ?? false,
            'include_ids' => $settings['include_ids'] ?? [],
        ]);
        $settings['categories'] = $cat_arr['categories'];
        ob_start();
        komestic_render_product_categories_html($settings);
        $html = ob_get_clean();

        $pagination_html = '';
        if($settings['event'] == 'pagination') {
            $pagination_html = komestic()->page->get_pagination($cat_arr['query'], true);
        }

        wp_send_json([
            'html' => $html,
            'paged' => $settings['paged'],
            'pagination_html' => $pagination_html,
        ]);

    } catch (Exception $e) {
        wp_send_json_error(['message' => $e->getMessage()]);
    }
    wp_die();
}