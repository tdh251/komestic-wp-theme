<?php
add_filter('pxl_extra_post_types', function($post_types) {
    $post_types['store'] = array(
        'status'  => true,
        'item_name'   => esc_html__('Store', 'komestic'),
        'items_name'  => esc_html__('Stores', 'komestic'),
        'args'    => array(
            'show_in_menu'    => 'edit.php?post_type=product',
            'menu_icon'       => 'dashicons-store',
            'supports'        => array('title', 'editor'),
            'rewrite'         => array('slug' => 'store'),
            'has_archive'     => false,
            'public'          => true,
        ),
        'labels'  => array(
            'add_new_item'       => esc_html__('Add New Store', 'komestic'),
            'edit_item'          => esc_html__('Edit Store', 'komestic'),
            'new_item'           => esc_html__('New Store', 'komestic'),
            'view_item'          => esc_html__('View Store', 'komestic'),
            'all_items'          => esc_html__('All Stores', 'komestic'),
            'search_items'       => esc_html__('Search Stores', 'komestic'),
            'not_found'          => esc_html__('No stores found.', 'komestic'),
            'not_found_in_trash' => esc_html__('No stores found in Trash.', 'komestic'),
        ),
        'post_featured' => false, 
    );
    return $post_types;
});

function get_all_stores() {
    $stores = get_posts(array(
        'post_type'      => 'store',
        'posts_per_page' => -1,
        'post_status'    => 'publish'
    ));
    return $stores;
}

function get_store_options() {
    $options = [];
    $stores = get_all_stores();
    if(!empty($stores)) {
        foreach($stores as $store) {
            $options[$store->ID] = $store->post_title;
        }
    }
    return $options;
}