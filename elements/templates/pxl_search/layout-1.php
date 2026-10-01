<?php
	$placeholder = $widget->get_setting('placeholder', '');
	$btn_text = $widget->get_setting('btn_text', []);
	$btn_icon = $widget->get_setting('btn_icon', []);
?>
<div class="pxl-search">
	<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url( '/' )); ?>">
		<div class="search-form-control">
			<input autocomplete="off" type="text" placeholder="<?php echo esc_attr($placeholder); ?>" name="s" class="search-field" />
			<button type="submit" class="pxl-button search-submit">
				<?php if(!empty($btn_icon['value'])) : ?>
					<span class="button__icon">
						<?php \Elementor\Icons_Manager::render_icon( $btn_icon, [ 'aria-hidden' => 'true', 'class' => 'pxl-icon' ], 'i' ); ?>
					</span>
				<?php endif; ?>
				<?php if(!empty($btn_text)) : ?>
					<span class="button__text">
						<?php echo esc_html($btn_text); ?>
					</span>
				<?php endif; ?>
			</button>
		</div>
	</form>
</div>
