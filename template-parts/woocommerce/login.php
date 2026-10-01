<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}
?>
<div id="customer_login" class="login<?php echo esc_attr($class) ?>">
	<div class="login__inner">
		<?php if(isset($class) && 'pxl-popup' === trim($class)) : ?>
			<button class="pxl-button button--close">
				<span class="icon-close"></span>
			</button>
		<?php endif; ?>
		<h3 class="login__title"><?php esc_html_e( 'Login', 'komestic' ); ?></h3>
		<div class="login__box">
			<form class="form form--login" method="post" novalidate>
				<?php do_action( 'woocommerce_login_form_start' ); ?>
				<p class="form__control">
					<input type="text" class="form__field form__field--text" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) && is_string( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" required aria-required="true" placeholder="<?php echo esc_attr('name@example.com'); ?>"/><?php // @codingStandardsIgnoreLine ?>
					<label for="username" class="form__label label--placeholder"><?php esc_html_e( 'Username *', 'komestic' ); ?></label>
				</p>
				<p class="form__control">
					<input class="form__field form__field--text" type="password" name="password" id="password" autocomplete="current-password" required aria-required="true" placeholder="<?php echo esc_attr('password'); ?>"/>
					<label for="password" class="form__label label--placeholder"><?php esc_html_e( 'Password *', 'komestic' ); ?></label>
				</p>
	
				<?php do_action( 'woocommerce_login_form' ); ?>
	
				<p class="form__row">
					<label class="form__label form-checkbox-control">
						<input class="form__field form__field--checkbox woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> 
						<span class="checkbox">
							<svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9">
								<path d="M4.27183 7.28352L0.81519 3.64176L0 4.5L4.27183 9L12 0.858241L11.1848 0L4.27183 7.28352Z" fill="currentcolor"/>
							</svg>
						</span>
						<span class="label-text"><?php esc_html_e( 'Remember me', 'komestic' ); ?></span>
					</label>
					<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
					<span class="form__lost-password">
						<a class="button--lost-password button--toggle" href="<?php echo esc_url('#loss-password'); //echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Forgot password?', 'komestic' ); ?></a>
					</span>
				</p>
				<button type="submit" class="pxl-button form__submit button--login button--primary button--submit <?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="login" value="<?php esc_attr_e( 'Log in', 'komestic' ); ?>">
					<span class="button__text">
						<?php esc_html_e( 'Log in', 'komestic' ); ?>
					</span>
				</button>
				<?php do_action( 'woocommerce_login_form_end' ); ?>
			</form>
			<p class="register">
				<span class="text-underline">
					<?php echo esc_html__('New customer? ', 'komestic'); ?>
					<a href="<?php echo esc_url(wc_get_page_permalink('myaccount').'?action=register'); ?>">
						<?php echo esc_html__('Create your account', 'komestic'); ?>
						<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12">
							<path d="M3.49216 0.778156L3.49238 1.38992C3.49241 1.46368 3.52172 1.53441 3.57388 1.58657C3.62604 1.63873 3.69677 1.66804 3.77053 1.66807L9.50586 1.66796L0.58139 10.5925C0.529254 10.6447 0.499979 10.7155 0.5 10.7892C0.500021 10.863 0.529336 10.9338 0.581502 10.9859L1.01416 11.4186C1.12271 11.5272 1.29891 11.5272 1.40758 11.4185L10.332 2.49393L10.3318 8.22965C10.3319 8.30341 10.3612 8.37414 10.4133 8.4263C10.4655 8.47846 10.5362 8.50778 10.61 8.50781L11.2217 8.50781C11.2955 8.50778 11.3662 8.47846 11.4184 8.4263C11.4705 8.37414 11.4999 8.30341 11.4999 8.22965L11.5 0.778156C11.5 0.704394 11.4707 0.633662 11.4185 0.581504C11.3663 0.529347 11.2956 0.500031 11.2218 0.5L3.77031 0.500002C3.69655 0.500032 3.62581 0.529347 3.57366 0.581505C3.5215 0.633662 3.49219 0.704394 3.49216 0.778156Z" fill="currentcolor"/>
						</svg>
					</a>
				</span>
			</p>
		</div>
	</div>
</div>