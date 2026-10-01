<?php 
$footer_display = komestic()->get_page_opt('footer_display', 'show'); 

if($footer_display === 'show') :
?>
    <footer class="footer footer--builder">
        <?php if(isset($args['footer_layout']) && $args['footer_layout'] > 0) : ?>
            <div class="footer__inner">
                <?php $post = get_post($args['footer_layout']);
                if (!is_wp_error($post) && function_exists('pxl_print_html')){
                    $content = \Elementor\Plugin::$instance->frontend->get_builder_content( $args['footer_layout'] );
                    pxl_print_html($content);
                } ?>
            </div>
        <?php endif; ?>
    </footer>
<?php endif; ?>