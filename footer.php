<?php
/**
 * @package Case-Themes
 */
$smooth_scroll = komestic()->get_opt('smooth_scroll', 'off');  
// Back To Top
$button_back_to_top = (bool)komestic()->get_theme_opt('button_back_to_top', '0');
$show_footer_404 = komestic()->get_theme_opt('404_show_footer', 'show');
?>
		</main><!-- #main -->

		<?php 
			if((is_404() && $show_footer_404 === 'show') || !is_404()) {
				komestic()->footer->getFooter(); 
			}
		?>
		<?php if($smooth_scroll === 'on') : ?>
			</div>
				</div>
		<?php endif; 
		if ($button_back_to_top) : ?>
			<a class="pxl-button button--back-to-top" href="#">
				<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
					<path d="M10.0035 3.4083L1.41176 12L0 10.5882L8.59171 1.99654H1.01905V0H12V10.981H10.0035V3.4083Z" fill="currentcolor"/>
				</svg>
			</a>
		<?php endif; 
		do_action( 'pxl_anchor_target') ?>
		<svg xmlns="http://www.w3.org/2000/svg" style="display: block; height: 0; width: 0;">
			<defs>
				<filter id="goo">
					<feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur"></feGaussianBlur>
					<feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 18 -7" result="goo"></feColorMatrix>
					<feBlend in="SourceGraphic" in2="goo"></feBlend>
				</filter>
			</defs>
		</svg>
		</div><!-- #wapper -->
	<?php wp_footer(); ?>
	</body>
</html>
