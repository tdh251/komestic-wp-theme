<main>

	<div class="pxl-dashboard-wrap">

		<?php get_template_part( 'inc/admin/views/admin', 'tabs' ); ?>
	 
		<div class="pxl-row">
			<div class="pxl-col pxl-col-4">
				<div class="pxl-dsb-box-wrap pxl-dsb-box featured-box">
					<h4 class="pxl-dsb-title-heading"><?php esc_html_e( 'Unlock Premium Features', 'komestic' ); ?></h4>
					<?php get_template_part( 'inc/admin/views/admin', 'featured' ); ?>
				</div>
			</div>    
		 	<div class="pxl-col pxl-col-4">
		 		<div class="pxl-dsb-box-wrap pxl-dsb-box activation-box">
			 		<h4 class="pxl-dsb-title-heading"><?php esc_html_e( 'Theme Activation', 'komestic' ); ?></h4>
					<?php get_template_part( 'inc/admin/views/admin', 'registration' ); ?>
				</div>
			</div>	
			<div class="pxl-col pxl-col-4">
				<div class="pxl-dsb-box-wrap pxl-dsb-box system-info-box">
					<h4 class="pxl-dsb-title-heading"><?php esc_html_e( 'System status', 'komestic' ); ?></h4>
					<?php get_template_part( 'inc/admin/views/admin', 'system-info' ); ?>
				</div>
			</div> 
	 		 
		</div> 
 
	</div> 

</main>
