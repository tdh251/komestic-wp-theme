<?php
defined( 'ABSPATH' ) || exit;
?>

<div class="product-filter sidebar sidebar--shop-filter">
    <div class="product-filter__inner">
        <!-- Categories -->
         <?php if($show_category) : ?>
            <div class="product-filter__section product-filter__section--category">
                <h6 class="product-filter__section-header">
                    <span>
                        <?php echo esc_html__("Categories", 'komestic'); ?>
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                        <path d="M7.42899 3.82906L0.236257 11.0242C-0.0786644 11.3399 -0.0786644 11.8514 0.236257 12.1679C0.551176 12.4837 1.06269 12.4837 1.37761 12.1679L7.99963 5.54352L14.6217 12.1671C14.9366 12.4829 15.4481 12.4829 15.7638 12.1671C16.0787 11.8514 16.0787 11.3391 15.7638 11.0234L8.57114 3.82827C8.25948 3.5174 7.73993 3.5174 7.42899 3.82906Z" fill="currentcolor"/>
                    </svg>
                </h6>
                <div class="product-filter__section-content">
                    <ul class="product-filter__list">
                        <?php 
                            $categories = get_terms( 'product_cat', ['hide_empty' => true]);
                            if(!empty($categories)) {
                                foreach($categories as $key => $category) { ?>
                                    <li class="product-filter__list-item">
                                        <a class="filter-item filter-item--cat" href="<?php echo esc_url(get_term_link( $category )); ?>" data-cat_slug="<?php echo esc_attr($category->slug); ?>"><?php pxl_print_html($category->name.'<span class="pxl-count-item"> [ '.$category->count.' ] </span>'); ?></a>
                                    </li>
                                <?php }
                            }
                        ?>
                        <input type="hidden" id="product_cat" name="product_cat" value="">
                    </ul>
                </div>
            </div>
        <?php endif; ?>

        <!-- Availability -->
        <?php if($show_availability) : 
            $product_count_instock = komestic_count_products_by_stock();
            $product_count_outofstock = komestic_count_products_by_stock(false);
        ?>
            <div class="product-filter__section product-filter__section--availability">
                <h6 class="product-filter__section-header">
                    <span>
                        <?php echo esc_html__("Availability", 'komestic'); ?>
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                        <path d="M7.42899 3.82906L0.236257 11.0242C-0.0786644 11.3399 -0.0786644 11.8514 0.236257 12.1679C0.551176 12.4837 1.06269 12.4837 1.37761 12.1679L7.99963 5.54352L14.6217 12.1671C14.9366 12.4829 15.4481 12.4829 15.7638 12.1671C16.0787 11.8514 16.0787 11.3391 15.7638 11.0234L8.57114 3.82827C8.25948 3.5174 7.73993 3.5174 7.42899 3.82906Z" fill="currentcolor"/>
                    </svg>
                </h6>
                <div class="product-filter__section-content">
                    <ul class="product-filter__list">
                        <li class="product-filter__list-item">
                            <label for="produc_in_stock" class="product-filter__field form-checkbox-control">
                                <input type="radio" class="filter-item filter-item--checkbox" name="stock_status" value="instock">
                                <span class="checkbox">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9">
                                        <path d="M4.27183 7.28352L0.81519 3.64176L0 4.5L4.27183 9L12 0.858241L11.1848 0L4.27183 7.28352Z" fill="currentcolor"/>
                                    </svg>
                                </span>
                                <span class="label-text">
                                    <?php echo esc_html('In Stock'); ?>
                                    <span class="pxl-count-item">
                                        <?php echo esc_html('[ '.$product_count_instock.' ]'); ?>
                                    </span>
                                </span>
                            </label>
                        </li>
                        <li class="product-filter__list-item">
                            <label for="produc_out_of_stock" class="product-filter__field form-checkbox-control">
                                <input type="radio" class="filter-item filter-item--checkbox" name="stock_status" value="outofstock">
                                <span class="checkbox">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9">
                                        <path d="M4.27183 7.28352L0.81519 3.64176L0 4.5L4.27183 9L12 0.858241L11.1848 0L4.27183 7.28352Z" fill="currentcolor"/>
                                    </svg>
                                </span>
                                <span class="label-text">
                                    <?php echo esc_html('Out Of Stock'); ?>
                                    <span class="pxl-count-item">
                                        <?php echo esc_html('[ '.$product_count_outofstock.' ]'); ?>
                                    </span>
                                </span>
                            </label>
                        </li>
                    </ul>
                </div>
            </div>
        <?php endif; ?>
        <!-- Brands -->
        <?php if($show_brand) :
            $brands = get_terms( [
                'taxonomy' => 'product_brand',
                'hide_empty' => true
            ]);
        ?>
            <div class="product-filter__section product-filter__section--brand">
                <h6 class="product-filter__section-header">
                    <span><?php echo esc_html__("Brands", 'komestic'); ?></span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                        <path d="M7.42899 3.82906L0.236257 11.0242C-0.0786644 11.3399 -0.0786644 11.8514 0.236257 12.1679C0.551176 12.4837 1.06269 12.4837 1.37761 12.1679L7.99963 5.54352L14.6217 12.1671C14.9366 12.4829 15.4481 12.4829 15.7638 12.1671C16.0787 11.8514 16.0787 11.3391 15.7638 11.0234L8.57114 3.82827C8.25948 3.5174 7.73993 3.5174 7.42899 3.82906Z" fill="currentcolor"/>
                    </svg>
                </h6>
                <div class="product-filter__section-content">
                    <ul class="product-filter__list">
                        <?php if ( ! empty( $brands ) ) : ?>
                            <?php foreach ( $brands as $key => $brand ) : ?>
                                <li class="product-filter__list-item">
                                    <label for="<?php echo esc_attr($brand->slug.'-'.$key); ?>" class="product-filter__field form-checkbox-control">
                                        <input type="checkbox" 
                                            class="filter-item filter-item--checkbox" 
                                            name="brand[]" 
                                            value="<?php echo esc_attr($brand->slug); ?>" 
                                            id="<?php echo esc_attr($brand->slug.'-'.$key); ?>">
                                        <div class="checkbox">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9">
                                                <path d="M4.27183 7.28352L0.81519 3.64176L0 4.5L4.27183 9L12 0.858241L11.1848 0L4.27183 7.28352Z" fill="currentcolor"/>
                                            </svg>
                                        </div>
                                        <span class="label-text">
                                            <?php echo esc_html($brand->name); ?>
                                            <span class="pxl-count-item"><?php echo esc_html('[ '.$brand->count.' ]'); ?></span>
                                        </span>
                                    </label>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li class="pxl-notification"><?php echo esc_html__('Brand Not Found!', 'komestic'); ?></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        <?php endif; ?>
         
        <!-- First Attributes -->
        <?php
            if(!empty($pa_attrs) && isset($pa_attrs[0])) {
                komestic_render_product_attribute_filter($pa_attrs[0], true); 
            }
        ?>

        <!-- Price -->
        <?php
            $price_point = komestic_get_min_max_price();
        ?>
        <div class="product-filter__section product-filter__section--price">
            <h6 class="product-filter__section-header">
                <span>
                    <?php echo esc_html__("Price", 'komestic'); ?>
                </span>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                    <path d="M7.42899 3.82906L0.236257 11.0242C-0.0786644 11.3399 -0.0786644 11.8514 0.236257 12.1679C0.551176 12.4837 1.06269 12.4837 1.37761 12.1679L7.99963 5.54352L14.6217 12.1671C14.9366 12.4829 15.4481 12.4829 15.7638 12.1671C16.0787 11.8514 16.0787 11.3391 15.7638 11.0234L8.57114 3.82827C8.25948 3.5174 7.73993 3.5174 7.42899 3.82906Z" fill="currentcolor"/>
                </svg>
            </h6>
            <div class="product-filter__section-content">
                <div class="form-control-slider-range">
                    <div class="slider">
                        <div class="progress"></div>
                    </div>
                    <div class="range-input">
                        <input type="range" name="price_min" class="price-min" min="<?php echo esc_attr($price_point['min']); ?>" max="<?php echo esc_attr($price_point['max']); ?>" value="<?php echo esc_attr($price_point['min']); ?>" step="1">
                        <input type="range" name="price_max" class="price-max" min="<?php echo esc_attr($price_point['min']); ?>" max="<?php echo esc_attr($price_point['max']); ?>" value="<?php echo esc_attr($price_point['max']); ?>" step="1">
                    </div>
                    <div class="price-fields">
                        <div class="price-label"><?php echo esc_html__('Price:', 'komestic'); ?></div>
                        <div class="price-range">
                            <div class="price-field price-field--min">
                                <span class="currency"><?php pxl_print_html(get_woocommerce_currency_symbol()); ?></span>
                                <input type="number" name="price_min_tmp" class="price-min" value="<?php echo esc_attr($price_point['min']); ?>" min="<?php echo esc_attr($price_point['min']); ?>" max="<?php echo esc_attr($price_point['max']); ?>">
                            </div>
                            <span class="separator"></span>
                            <div class="price-field price-field--max">
                                <span class="currency"><?php pxl_print_html(get_woocommerce_currency_symbol()); ?></span>
                                <input type="number" name="price_max_tmp" class="price-max" value="<?php echo esc_attr($price_point['max']); ?>" min="<?php echo esc_attr($price_point['min']); ?>" max="<?php echo esc_attr($price_point['max']); ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Other Attributes -->
        <?php 
        foreach($pa_attrs as $key => $pa) {
            if($key === 0) {
                continue;
            }
            komestic_render_product_attribute_filter($pa, true); 
        }
        ?>
    </div>
</div>