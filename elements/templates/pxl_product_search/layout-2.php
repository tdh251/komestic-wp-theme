<div class="product-search" data-layout="2">
    <form role="search" method="get" class="product-search__form form" action="<?php echo esc_url(home_url( '/' )); ?>">
        <div class="form__field-wrap">
            <div class="form__field-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                    <path d="M17.8208 16.9391L12.9593 12.0776C12.9591 12.0773 12.9591 12.0769 12.9593 12.0766C14 10.8493 14.6047 9.31182 14.6789 7.70445C14.8881 3.34969 11.4228 -0.155678 7.06592 0.0053334C3.22827 0.150592 0.150589 3.22827 0.00533106 7.06592C-0.155645 11.4228 3.34975 14.8881 7.70455 14.6788C9.31185 14.6045 10.8492 13.9998 12.0765 12.9593C12.0768 12.959 12.0772 12.959 12.0775 12.9593L16.9391 17.8208C17.1845 18.0624 17.5792 18.0593 17.8208 17.814C18.0597 17.5713 18.0597 17.1818 17.8208 16.9391ZM1.40542 8.75825C0.926813 6.62185 1.55198 4.51341 3.03272 3.03269C4.51347 1.55198 6.62185 0.92678 8.75832 1.40542C10.7796 1.85839 12.8291 3.90769 13.2821 5.92879C13.761 8.06543 13.1358 10.1741 11.6549 11.6549C10.1741 13.1358 8.06532 13.761 5.92868 13.282C3.90758 12.829 1.85839 10.7794 1.40542 8.75825Z" fill="#777777"/>
                </svg>
            </div>
            <input autocomplete="off" type="search" name="search" class="form__field search" placeholder="<?php echo esc_attr( 'Enter Your Search' ); ?>" value="">
        </div>
        <input type="hidden" value="product" name="post_type">
    </form>
</div>
<!-- 
<div class="wpcas-search-result ps-container ps-theme-wpc">

</div> -->