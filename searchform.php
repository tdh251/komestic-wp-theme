<?php
/**
 * Search Form
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url( '/' )); ?>">
	<div class="search-form-control">
        <input type="text" placeholder="<?php esc_attr_e('Search here...', 'komestic'); ?>" name="s" class="search-field" />
    	<button type="submit" class="search-submit">
            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 17 16" fill="none">
                <path d="M15.9257 14.3738L12.1782 10.6616C13.1417 9.57071 13.6697 8.19811 13.6697 6.76917C13.6697 3.4306 10.8177 0.714355 7.31237 0.714355C3.80702 0.714355 0.955078 3.4306 0.955078 6.76917C0.955078 10.1077 3.80702 12.824 7.31237 12.824C8.62833 12.824 9.88238 12.446 10.9546 11.7283L14.7305 15.4686C14.8883 15.6247 15.1006 15.7108 15.3281 15.7108C15.5434 15.7108 15.7477 15.6326 15.9027 15.4905C16.2322 15.1885 16.2427 14.6878 15.9257 14.3738ZM7.31237 2.29387C9.90339 2.29387 12.0112 4.30144 12.0112 6.76917C12.0112 9.23691 9.90339 11.2445 7.31237 11.2445C4.72136 11.2445 2.6135 9.23691 2.6135 6.76917C2.6135 4.30144 4.72136 2.29387 7.31237 2.29387Z" fill="currentcolor"/>
            </svg>
        </button>
    </div>
</form>