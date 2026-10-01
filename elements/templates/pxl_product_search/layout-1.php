
<div class="product-search" data-layout="1">
    <form role="search" method="get" class="product-search__form form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <select name="product_cat" class="product_cat pxl-nice-select form__select">
            <option value="0"><?php echo esc_html__( 'All Categories', 'komestic' ); ?></option>
            <?php
            $product_cats = get_terms( array(
                'taxonomy'   => 'product_cat',
                'hide_empty' => false, 
            ) );

            if ( ! is_wp_error( $product_cats ) && ! empty( $product_cats ) ) {
                foreach ( $product_cats as $cat ) {
                    echo '<option value="' . esc_attr( $cat->slug ) . '">' . esc_html( $cat->name ) . '</option>';
                }
            }
            ?>
        </select>
        <div class="divider"></div>
        <div class="form__field-wrap">
            <input autocomplete="off" type="search" name="s" class="form__field search" placeholder="<?php echo esc_attr( 'Search product...' ); ?>" value="">
        </div>
        <button type="submit" class="pxl-button button--primary">
            <span class="button__icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.2401 8.54684C14.2401 10.0988 13.6236 11.5871 12.5262 12.6845C11.4288 13.7818 9.94047 14.3983 8.38856 14.3983C6.83664 14.3983 5.34829 13.7818 4.25092 12.6845C3.15355 11.5871 2.53706 10.0988 2.53706 8.54684C2.53706 6.99506 3.1535 5.50683 4.25077 4.40956C5.34805 3.31228 6.83627 2.69584 8.38806 2.69584C9.93984 2.69584 11.4281 3.31228 12.5253 4.40956C13.6226 5.50683 14.2391 6.99506 14.2391 8.54684H14.2401ZM13.3491 14.6328C11.8022 15.8935 9.83342 16.5178 7.84279 16.379C5.85216 16.2401 3.9891 15.3484 2.6323 13.8852C1.27549 12.422 0.526754 10.4971 0.538278 8.50165C0.549802 6.50622 1.32072 4.59005 2.69434 3.14261C4.06795 1.69518 5.94118 0.825105 7.93329 0.70924C9.92539 0.593374 11.8869 1.24041 13.419 2.51884C14.9512 3.79727 15.939 5.61115 16.1818 7.59179C16.4246 9.57243 15.9041 11.5712 14.7261 13.1818L19.1421 17.5968C19.3296 17.7845 19.4349 18.0389 19.4348 18.3042C19.4347 18.5695 19.3292 18.8238 19.1416 19.0113C18.9539 19.1988 18.6995 19.3041 18.4342 19.304C18.1689 19.3039 17.9146 19.1985 17.7271 19.0108L13.3491 14.6328Z" fill="white"/>
                </svg>
            </span>
        </button>
        <input type="hidden" value="product" name="post_type">
    </form>
</div>

