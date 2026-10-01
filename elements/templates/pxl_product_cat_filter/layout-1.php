<?php
$cat_ids = $widget->get_setting('cat_ids', []);
if(empty($cat_ids)) {
    pxl_print_html('<p class="pxl-notification">'.esc_html__('No Product Category Found.', 'komestic').'</p>');
    return;
}
$filter_active = $widget->get_setting('filter_active', 1);
$entrance_anim = $widget->get_setting('entrance_anim', '');
?>

<div class="product-category-filter filter filter--carousel <?php echo esc_attr($entrance_anim); ?>">
    <div class="filter-buttons">
        <?php 
        foreach($cat_ids as $key => $id) : 
            $term = get_term( $id, 'product_cat' );
            if ( ! is_wp_error( $term ) && $term ) :
                $filter_active_class = (($key + 1) === $filter_active) ? ' is-active' : '';
        ?>
                <button class="pxl-button filter__button<?php echo esc_attr($filter_active_class); ?>" data-filter="<?php echo esc_attr($term->slug); ?>">
                    <?php echo esc_html($term->name); ?>
                </button>
        <?php 
            endif;
        endforeach;
        ?>
    </div>
</div>