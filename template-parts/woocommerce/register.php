<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}
?>

<div class="register" id="customer_register">
    <div class="register__inner">
        <h3 class="register__title"><?php esc_html_e( 'Create Account', 'komestic' ); ?></h3>
        <div class="register__box">
            <form method="post" class="form form--register" <?php do_action( 'woocommerce_register_form_tag' ); ?> >
        
                <?php do_action( 'woocommerce_register_form_start' ); ?>
    
                <p class="form__control">
                    <input class="form__field form__field--text" name="first_name" id="reg_first_name" value="<?php echo ! empty($_POST['first_name']) ? esc_attr($_POST['first_name']) : ''; ?>" autocomplete="first_name" placeholder="<?php echo esc_attr('First Name'); ?>" />
                    <label class="form__label label--placeholder"  for="reg_first_name"><?php _e('First name', 'komestic'); ?></label>
                </p>
    
                <p class="form__control">
                    <input type="text" class="form__field form__field--text" name="last_name" id="reg_last_name" value="<?php echo ! empty($_POST['last_name']) ? esc_attr($_POST['last_name']) : ''; ?>" placeholder="<?php echo esc_attr('Last Name'); ?>" />
                    <label class="form__label label--placeholder" for="reg_last_name"><?php _e('Last name', 'komestic'); ?></label>
                </p>
    
                <?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
        
                    <p class="form__control">
                        <input type="text" class="form__field form__field--text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" required aria-required="true" placeholder="<?php echo esc_attr('User Name'); ?>" /><?php // @codingStandardsIgnoreLine ?>
                        <label class="form__label label--placeholder" for="reg_username"><?php esc_html_e( 'Username', 'komestic' ); ?>&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text"><?php esc_html_e( 'Required', 'komestic' ); ?></span></label>
                    </p>
        
                <?php endif; ?>
    
                <p class="form__control">
                    <input type="email" class="form__field form__field--text" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" required aria-required="true" placeholder="<?php echo esc_attr('Email'); ?>" /><?php // @codingStandardsIgnoreLine ?>
                    <label class="form__label label--placeholder" for="reg_email"><?php esc_html_e( 'Email address', 'komestic' ); ?>&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text"><?php esc_html_e( 'Required', 'komestic' ); ?></span></label>
                </p>
        
                <?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
        
                    <p class="form__control">
                        <input type="password" class="form__field form__field--text" name="password" id="reg_password" autocomplete="new-password" required aria-required="true" placeholder="<?php echo esc_attr('Password'); ?>"/>
                        <label class="form__label label--placeholder" for="reg_password"><?php esc_html_e( 'Password', 'komestic' ); ?>&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text"><?php esc_html_e( 'Required', 'komestic' ); ?></span></label>
                    </p>
        
                <?php else : ?>
        
                    <p><?php esc_html_e( 'A link to set a new password will be sent to your email address.', 'komestic' ); ?></p>
        
                <?php endif; ?>
        
                <?php do_action( 'woocommerce_register_form' ); ?>
        
                <p class="woocommerce-form-row form-row">
                    <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
                    <button type="submit" class="pxl-button button--register button--primary button--submit pxl-button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?> woocommerce-form-register__submit" name="register" value="<?php esc_attr_e( 'Register', 'komestic' ); ?>">
                        <span class="button__text">
                            <?php esc_html_e( 'Register', 'komestic' ); ?>
                        </span>
                    </button>
                </p>
                <?php do_action( 'woocommerce_register_form_end' ); ?>
            </form>
        </div>
    </div>
</div>