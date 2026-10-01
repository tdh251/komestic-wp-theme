<?php 
/**
 * Actions Hook for the theme
 *
 * @package Case-Themes
 */

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
add_action( 'wp_head', 'komestic_pingback_header' );
function komestic_pingback_header(){
    if ( is_singular() && pings_open() ) {
        echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
    }
}
// Dynamic Panel
add_action( 'pxl_anchor_target', 'komestic_hook_anchor_templates_panel');
function komestic_hook_anchor_templates_panel(){
    $templates = komestic_get_templates_slug('panel');
    if(empty($templates)) return;

    foreach ($templates as $slug => $values){
        $args = [
            'slug' => $slug,
            'post_id' => $values['post_id']
        ];
        if( did_action('pxl_anchor_target_template_'.$values['post_id']) <= 0){  
            do_action( 'pxl_anchor_target_template_'.$values['post_id'], $args );  
        }
    } 
}
if(!function_exists('komestic_hook_anchor_panel')){
    function komestic_hook_anchor_panel($args){ 
        $panel_open = get_post_meta($args['post_id'], 'panel_open', true);
        $template_class = 'pxl-template';
        if($panel_open == 'popup') {
            $template_class .= ' pxl-popup';
        }elseif(str_contains($panel_open, 'drawer')) {
            $template_class .= ' pxl-drawer';
            $drawer_position = explode('-', $panel_open)[1];
        }
    ?>
        <div id="<?php echo esc_attr('template-'.$args['post_id'])?>" class="<?php echo esc_attr($template_class); ?>" <?php if(isset($drawer_position)) : ?> data-drawer="<?php echo esc_attr($drawer_position); ?>" <?php endif; ?>>
            <?php echo Elementor\Plugin::$instance->frontend->get_builder_content_for_display( (int)$args['post_id']); ?>
        </div>
    <?php }
}