<?php
$is_custom_link = (bool)$widget->get_setting('custom_link_page', '');
$link_page_attrs = function_exists( 'woosw_get_page_url' ) ? 'href="'.woosw_get_page_url().'"' : 'href="#"'; 
if($is_custom_link) {
    $link_page_attrs = komestic_get_link_attributes($settings['link_page']);
}
?>
<div class="wishlist-button-wrap">
    <a <?php pxl_print_html($link_page_attrs); ?> class="pxl-button wishlist-button">
        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="24" viewBox="0 0 28 24" fill="none">
            <path d="M20.2727 0.5C17.9799 0.5 15.9871 1.54953 14.5099 3.53506C14.3201 3.7902 14.1505 4.04545 14 4.29307C13.8495 4.0454 13.68 3.7902 13.4901 3.53506C12.0129 1.54953 10.0201 0.5 7.72727 0.5C3.48095 0.5 0.618183 3.91095 0.618183 8.09272C0.618183 13.5503 5.80531 16.9863 13.3307 23.2577C13.5245 23.4192 13.7623 23.5 14 23.5C14.2377 23.5 14.4755 23.4192 14.6693 23.2577C22.1929 16.988 27.3818 13.551 27.3818 8.09272C27.3818 3.91341 24.5215 0.5 20.2727 0.5ZM14 21.0957C7.07062 15.363 2.70909 12.3249 2.70909 8.09272C2.70909 5.3587 4.43284 2.59091 7.72727 2.59091C9.33722 2.59091 10.6996 3.31233 11.7766 4.73519C12.6299 5.86255 12.9846 7.02609 12.996 7.06415C13.1256 7.51077 13.5348 7.81818 14 7.81818C14.466 7.81818 14.8757 7.50983 15.0046 7.06206C15.0175 7.01736 16.3379 2.59091 20.2727 2.59091C23.5672 2.59091 25.2909 5.3587 25.2909 8.09272C25.2909 12.329 20.9074 15.3814 14 21.0957Z" fill="black"/>
        </svg>
        <span class="wishlist-text">
            <span class="label">
                <?php echo esc_html__('Wishlist', 'komestic'); ?>
            </span>
            <span class="count pxl-wishlist-count">
                <?php pxl_print_html(komestic_get_wishlist_count()); ?>
            </span>
        </span>
    </a>
</div>