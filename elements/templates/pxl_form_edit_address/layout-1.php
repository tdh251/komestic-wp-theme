<div class="wc-address">
    <?php 
    komestic_edit_address('billing');
    komestic_edit_address('shipping');
    ?>
    <div class="address-info">
        <div class="address-info__item address-info__item--billing">
            <div class="address-info__title">
                <?php echo esc_html__('Billing', 'komestic'); ?>
            </div>
            <div class="address-info__content">
                <p><?php pxl_print_html(komestic_get_user_billing()); ?></p>
                <button class="pxl-button button--primary button-edit" data-action="billing">
                    <span class="button__text">
                        <?php  echo esc_html__('Edit', 'komestic'); ?>
                    </span>
                </button>
            </div>
        </div>
        <div class="address-info__item address-info__item--shipping">
            <div class="address-info__title">
                <?php echo esc_html__('Shipping', 'komestic'); ?>
            </div>
            <div class="address-info__content">
                <p><?php pxl_print_html(komestic_get_user_shipping()); ?></p>
                <button class="pxl-button button--primary button-edit" data-action="shipping">
                    <span class="button__text">
                        <?php  echo esc_html__('Edit', 'komestic'); ?>
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>
