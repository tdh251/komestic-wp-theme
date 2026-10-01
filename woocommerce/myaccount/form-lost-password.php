<?php
/**
 * Lost password form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-lost-password.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.2.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_lost_password_form' );
?>

<form method="post" class="woocommerce-ResetPassword lost_reset_password">

	<p class="lost-password__message"><?php echo apply_filters( 'woocommerce_lost_password_message', esc_html__( 'Please enter your registered email address to receive an email to reset your password', 'komestic' ) ); ?></p><?php // @codingStandardsIgnoreLine ?>

	<p class="form__control">
		<input class="form__field form__field--text" type="text" name="user_login" id="user_login" autocomplete="username" required aria-required="true" placeholder="<?php echo esc_attr('name@example.com'); ?>"/>
		<label for="user_login" class="form__label label--placeholder"><?php esc_html_e( 'Username or email', 'komestic' ); ?>&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text"><?php esc_html_e( 'Required', 'komestic' ); ?></span></label>
	</p>

	<div class="clear"></div>

	<?php do_action( 'woocommerce_lostpassword_form' ); ?>

	<p class="woocommerce-form-row form-row">
		<input type="hidden" name="wc_reset_password" value="true" />
		<button type="submit" class="woocommerce-Button pxl-button button--primary<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" value="<?php esc_attr_e( 'Submit', 'komestic' ); ?>">
			<span class="button__text">
				<?php esc_html_e( 'Submit', 'komestic' ); ?>
			</span>
		</button>
	</p>

	<?php wp_nonce_field( 'lost_password', 'woocommerce-lost-password-nonce' ); ?>

</form>
<?php
do_action( 'woocommerce_after_lost_password_form' );
