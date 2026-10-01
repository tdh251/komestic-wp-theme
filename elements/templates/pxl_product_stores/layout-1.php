<?php
global $product;
$product_id = ( $product instanceof WC_Product ) ? $product->get_id() : 0;
$stores = get_all_stores();
$stores_out_of_this_product = (array) get_post_meta( $product_id, 'stores_out_of_this_product', true );
if(empty($stores)) return;
?>
<div class="product-stores">
    <div class="store-list">
        <?php foreach($stores as $key => $store) : 
            $store_address = get_post_meta($store->ID, 'store_address', true);
            $store_tel = get_post_meta($store->ID, 'store_phone_number', true);
            $store_google_map_link = get_post_meta($store->ID, 'store_google_map', true);
            $store_out_of_this_product = in_array($store->ID, $stores_out_of_this_product) ? '' : ' checked';
        ?>
        <div class="store-item">
            <h6 class="store-title">
                <?php echo esc_html($store->post_title); ?>
            </h6>
            <div class="store-out-of-this-product">
                <div class="checkbox<?php echo esc_attr($store_out_of_this_product); ?>">
                    <svg class="tick" width="9" height="6" viewBox="0 0 9 6" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3.10631 4.9152L7.9158 0.105764C8.05749 -0.0359791 8.29014 -0.0345284 8.43043 0.105764L8.89478 0.57011C9.03507 0.710402 9.03507 0.94451 8.89478 1.08475L4.08535 5.89424C3.94505 6.03453 3.7124 6.03598 3.57065 5.89424L3.10631 5.42989C2.96456 5.28815 2.96456 5.05694 3.10631 4.9152Z" fill="white"/>
                        <path d="M1.05308 2.10317L3.89743 4.94755C4.035 5.08517 4.03338 5.31131 3.89743 5.44726L3.44662 5.89808C3.31067 6.03397 3.08286 6.03397 2.94692 5.89808L0.102566 3.0537C-0.0333788 2.91775 -0.034996 2.69161 0.102566 2.554L0.553384 2.10317C0.690998 1.96561 0.915469 1.96561 1.05308 2.10317Z" fill="white"/>
                    </svg>
                </div>
                <p class="note"><?php echo esc_html__('Pickup available. Usually ready in 24 hours', 'komestic'); ?></p>
            </div>
            <div class="store-meta">
                <span class="store-address">
                    <a href="<?php echo esc_url($store_google_map_link); ?>" target="_blank">
                        <?php echo esc_html($store_address); ?>
                    </a>
                </span>
                <span class="store-tel">
                    <a href="<?php echo esc_attr('tel:'.preg_replace('/\D/', '', $store_tel)); ?>">
                        <?php echo esc_html($store_tel); ?>
                    </a>
                </span>
            </div>
            <div class="store-google-map">
                <a class="pxl-button button--link-underline" href="<?php echo esc_url($store_google_map_link); ?>" target="_blank">
                    <span class="button__text">
                        <?php echo esc_html("See Direction on Google map"); ?>
                    </span>
                    <span class="button__icon">
                        <svg class="button__icon--main" xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10" fill="none">
                            <path d="M2.72017 0.252869L2.72037 0.809018C2.7204 0.876074 2.74705 0.940376 2.79446 0.987792C2.84188 1.03521 2.90618 1.06186 2.97324 1.06189L8.18722 1.06178L0.073992 9.17501C0.0265952 9.22247 -1.9048e-05 9.2868 1.02285e-08 9.35386C1.90685e-05 9.42093 0.0266696 9.48524 0.0740934 9.53267L0.467422 9.926C0.56611 10.0247 0.726286 10.0247 0.825076 9.9259L8.93831 1.81266L8.9381 7.02695C8.93813 7.09401 8.96478 7.15831 9.0122 7.20573C9.05961 7.25315 9.12391 7.2798 9.19097 7.27982L9.74712 7.27982C9.81418 7.2798 9.87848 7.25315 9.92589 7.20573C9.97331 7.15831 9.99996 7.09401 9.99999 7.02695L10.0001 0.252869C10.0001 0.185813 9.97341 0.121511 9.92599 0.0740953C9.87858 0.0266786 9.81428 2.81812e-05 9.74722 5.2761e-07L2.97303 1.77739e-06C2.90598 2.94369e-05 2.84168 0.0266789 2.79426 0.0740956C2.74684 0.121511 2.72019 0.185814 2.72017 0.252869Z" fill="#1F1F1F"/>
                        </svg>
                        <svg class="button__icon--copy" xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10" fill="none">
                            <path d="M2.72017 0.252869L2.72037 0.809018C2.7204 0.876074 2.74705 0.940376 2.79446 0.987792C2.84188 1.03521 2.90618 1.06186 2.97324 1.06189L8.18722 1.06178L0.073992 9.17501C0.0265952 9.22247 -1.9048e-05 9.2868 1.02285e-08 9.35386C1.90685e-05 9.42093 0.0266696 9.48524 0.0740934 9.53267L0.467422 9.926C0.56611 10.0247 0.726286 10.0247 0.825076 9.9259L8.93831 1.81266L8.9381 7.02695C8.93813 7.09401 8.96478 7.15831 9.0122 7.20573C9.05961 7.25315 9.12391 7.2798 9.19097 7.27982L9.74712 7.27982C9.81418 7.2798 9.87848 7.25315 9.92589 7.20573C9.97331 7.15831 9.99996 7.09401 9.99999 7.02695L10.0001 0.252869C10.0001 0.185813 9.97341 0.121511 9.92599 0.0740953C9.87858 0.0266786 9.81428 2.81812e-05 9.74722 5.2761e-07L2.97303 1.77739e-06C2.90598 2.94369e-05 2.84168 0.0266789 2.79426 0.0740956C2.74684 0.121511 2.72019 0.185814 2.72017 0.252869Z" fill="#1F1F1F"/>
                        </svg>
                    </span>
                </a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>