<?php
defined( 'ABSPATH' ) || exit;

$is_active = ( 'billing' === $load_address ) ? ' is-active' : '';
?>
<form method="post" novalidate class="address-form address-form--<?php echo esc_attr($load_address); ?> <?php echo esc_attr($is_active); ?>">
    <div class="woocommerce-address-fields">
        <?php do_action( "woocommerce_before_edit_address_form_{$load_address}" ); ?>

        <div class="woocommerce-address-fields__field-wrapper">
            <?php
            foreach ( $address as $key => $field ) {
                woocommerce_form_field( $key, $field, wc_get_post_data_by_key( $key, $field['value'] ) );
            }
            ?>
        </div>

        <?php do_action( "woocommerce_after_edit_address_form_{$load_address}" ); ?>

        <p class="buttons">
            <button type="submit" class="pxl-button button--primary button-submit<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="save_address" value="<?php esc_attr_e( 'Update', 'komestic' ); ?>">
                <span class="button__text">
                    <?php esc_html_e( 'Update', 'komestic' ); ?>
                </span>
            </button>
            <button type="button" class="pxl-button button--primary button-cancel">
                <span class="button__text">
                    <?php esc_html_e('Cancel', 'komestic'); ?>
                </span>
            </button>
            <?php wp_nonce_field( 'woocommerce-edit_address', 'woocommerce-edit-address-nonce' ); ?>
            <input type="hidden" name="action" value="edit_address" />
        </p>
    </div>

</form>