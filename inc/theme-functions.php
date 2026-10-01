<?php
/**
 * Helper functions for the theme
 *
 * @package Case-Themes
 */

add_filter( 'comment_form_fields', 'move_cookie_consent_before_submit' );
function move_cookie_consent_before_submit( $fields ) {
    if ( isset( $fields['cookies'] ) ) {
        $cookies = $fields['cookies'];
        unset( $fields['cookies'] );

        $new_fields = [];

        foreach ( $fields as $key => $value ) {
            $new_fields[ $key ] = $value;
            if ( $key === 'comment' ) {
                $new_fields['cookies'] = $cookies;
            }
        }
        return $new_fields;
    }
    return $fields;
}


/**
 * Paginate Links
 */
function komestic_ajax_paginate_links($link){
    $parts = parse_url($link);
    if( !isset($parts['query']) ) return $link;
    parse_str($parts['query'], $query);
    if(isset($query['page']) && !empty($query['page'])){
        return '#' . $query['page'];
    }
    return '#';
}

/* Highlight Shortcode  */
if(function_exists( 'pxl_register_shortcode' )) {
    function komestic_highlight_shortcode( $atts = array() ) {
        extract(shortcode_atts(array(
         'text' => '',
         'image' => 0,
         'svg'  => 0 
        ), $atts));
        $output = null;
        if(!empty($text)) {
            $output = '<span class="text--highlight">'.$text.'</span>';
        }elseif($image !== 0) {
            $image_html = komestic_get_image_by_size([
                'img_id' => (int)$image,
                'img_dimension' => 'full',
                'attr' => [
                    'class' => 'image--highlight wow zoomIn', 
                    'alt'   => get_the_title($image),
                ],
            ]);
            $output = !empty($image_html) ? $image_html : '';
        }elseif($svg !== 0) {
            $svg_arr = [
                'value' => [
                    'url' => wp_get_attachment_url($svg), 
                    'id' => $svg, 
                ],
                'library' => 'svg',
            ];
            if (class_exists( '\Elementor\Icons_Manager' )) {
            ob_start(); ?>
                <div class="svg--highlight wow zoomIn"> 
                    <?php \Elementor\Icons_Manager::render_icon( $svg_arr, [ 'aria-hidden' => 'true', 'class' => 'pxl-icon' ], 'i' ); ?>
                </div> 
                <?php
                $output = ob_get_clean();
            }
        }
        return $output;
    }
    pxl_register_shortcode('highlight', 'komestic_highlight_shortcode');
}

if(function_exists( 'pxl_register_shortcode' )) {
    function komestic_spacing_shortcode() {
        ob_start();  ?>
            <div class="pxl-spacing-block"></div> 
        <?php $output = ob_get_clean();
        return $output;
    }
    pxl_register_shortcode('pxl_spacing_block', 'komestic_spacing_shortcode');
}

/**
 * Custom Widget Archive - Count
 */
add_filter('get_archives_link', 'komestic_wg_archive_count');
function komestic_wg_archive_count($links) {
    $dir = '';
    $links = str_replace('</a>&nbsp;(', ' <span class="pxl-count '.$dir.'">', $links);
    $links = str_replace(')', '</span></a>', $links);
    return $links;
}

/**
 * Get mega menu builder ID
 */
function komestic_get_mega_menu_builder_id(){
    $mn_id = [];
    $menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
    if ( is_array( $menus ) && ! empty( $menus ) ) {
        foreach ( $menus as $menu ) {
            if ( is_object( $menu )){
                $menu_obj = get_term( $menu->term_id, 'nav_menu' );
                $menu = wp_get_nav_menu_object( $menu_obj ) ;
                $menu_items = wp_get_nav_menu_items( $menu->term_id, array( 'update_post_term_cache' => false ) );
                foreach ($menu_items as $menu_item) {
                    if( !empty($menu_item->pxl_megaprofile)){
                        $mn_id[] = (int)$menu_item->pxl_megaprofile;
                    }
                }  
            }
        }
    }
    return $mn_id;
}

/* Mouse Move Animation */
function komestic_mouse_move_animation() { 
    $mouse_move_animation = komestic()->get_theme_opt('mouse_move_animation', 'off'); 
    if($mouse_move_animation == 'on') {
        wp_enqueue_script( 'komestic-cursor', get_template_directory_uri() . '/assets/js/libs/cursor.js', array( 'jquery' ), '1.0.0', true ); ?>  
        <div class="pxl-cursor pxl-js-cursor">
            <div class="pxl-cursor-wrapper">
                <div class="pxl-cursor--follower pxl-js-follower"></div>
                <div class="pxl-cursor--label pxl-js-label"></div>
                <div class="pxl-cursor--drap pxl-js-drap"></div>
                <div class="pxl-cursor--icon pxl-js-icon"></div>
            </div>
        </div>
    <?php }
}

/**
 * Start - User custom fields.
 */
add_action( 'show_user_profile', 'komestic_user_fields' );
add_action( 'edit_user_profile', 'komestic_user_fields' );
function komestic_user_fields($user){
    $user_position = get_user_meta($user->ID, 'user_position', true);
    $user_facebook = get_user_meta($user->ID, 'user_facebook', true);
    $user_twitter = get_user_meta($user->ID, 'user_twitter', true);
    $user_instagram = get_user_meta($user->ID, 'user_instagram', true);
    $user_pinterest = get_user_meta($user->ID, 'user_pinterest', true);
    ?>
    <h3><?php esc_html_e('Komestic User Info Custom', 'komestic'); ?></h3>
    <table class="form-table">
        <tr>
            <th><label for="user_position"><?php esc_html_e('Author Position', 'komestic'); ?></label></th>
            <td>
                <input id="user_position" name="user_position" type="text" value="<?php echo esc_attr(isset($user_position) ? $user_position : ''); ?>" />
            </td>
        </tr>
        <tr>
            <th><label for="user_facebook"><?php esc_html_e('Facebook', 'komestic'); ?></label></th>
            <td>
                <input id="user_facebook" name="user_facebook" type="text" value="<?php echo esc_attr(isset($user_facebook) ? $user_facebook : ''); ?>" />
            </td>
        </tr>
        <tr>
            <th><label for="user_instagram"><?php esc_html_e('Instagram', 'komestic'); ?></label></th>
            <td>
                <input id="user_instagram" name="user_instagram" type="text" value="<?php echo esc_attr(isset($user_instagram) ? $user_instagram : ''); ?>" />
            </td>
        </tr>
        <tr>
            <th><label for="user_twitter"><?php esc_html_e('Twitter', 'komestic'); ?></label></th>
            <td>
                <input id="user_twitter" name="user_twitter" type="text" value="<?php echo esc_attr(isset($user_twitter) ? $user_twitter : ''); ?>" />
            </td>
        </tr>
        <tr>
            <th><label for="user_pinterest"><?php esc_html_e('Pinterest', 'komestic'); ?></label></th>
            <td>
                <input id="user_pinterest" name="user_pinterest" type="text" value="<?php echo esc_attr(isset($user_pinterest) ? $user_pinterest : ''); ?>" />
            </td>
        </tr>
    </table>
    <?php
}

add_action( 'personal_options_update', 'komestic_save_user_custom_fields' );
add_action( 'edit_user_profile_update', 'komestic_save_user_custom_fields' );
function komestic_save_user_custom_fields( $user_id )
{
    if ( !current_user_can( 'edit_user', $user_id ) )
        return false;
    if(isset($_POST['user_position']))
        update_user_meta( $user_id, 'user_position', $_POST['user_position'] );
    if(isset($_POST['user_facebook']))
        update_user_meta( $user_id, 'user_facebook', $_POST['user_facebook'] );
    if(isset($_POST['user_twitter']))
        update_user_meta( $user_id, 'user_twitter', $_POST['user_twitter'] );
    if(isset($_POST['user_instagram']))
        update_user_meta( $user_id, 'user_instagram', $_POST['user_instagram'] );
    if(isset($_POST['user_pinterest']))
        update_user_meta( $user_id, 'user_pinterest', $_POST['user_pinterest'] );
}

/* Author Social */
function komestic_get_user_social($author_id) {
    $author_id = isset($author_id) ? $author_id : get_the_author_meta( 'ID' );
    $user_facebook = get_user_meta($author_id, 'user_facebook', true);
    $user_twitter = get_user_meta($author_id, 'user_twitter', true);
    $user_pinterest = get_user_meta($author_id, 'user_pinterest', true);
    $user_instagram = get_user_meta($author_id, 'user_instagram', true); ?>
    <div class="author-card__socials">
        <?php if(!empty($user_facebook)) : ?>
            <a href="<?php echo esc_url($user_facebook); ?>" class="button button--only-icon author-card__social">
                <span class="button__icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="9" height="16" viewBox="0 0 9 16">
                        <path d="M5.37776 3.60529V5.86104H8.01494L7.59735 8.89968H5.37776V15.9006C4.93274 15.9659 4.47744 16 4.01528 16C3.48181 16 2.95794 15.955 2.44778 15.8679V8.89968H0.015625V5.86104H2.44778V3.10103C2.44778 1.38872 3.75952 0 5.37844 0V0.00145253C5.38324 0.00145253 5.38736 0 5.39216 0H8.01562V2.62797H6.30139C5.79192 2.62797 5.37844 3.06548 5.37844 3.60457L5.37776 3.60529Z" fill="currentcolor"/>
                    </svg>
                </span>
            </a>
        <?php endif; ?>
        <?php if(!empty($user_instagram)) : ?>
            <a href="<?php echo esc_url($user_instagram); ?>" class="button button--only-icon author-card__social">   
                <span class="button__icon">
                    <svg width="16" height="15" viewBox="0 0 16 15" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.6692 0H3.90543C1.76054 0 0.015625 1.74543 0.015625 3.89095V10.9958C0.015625 13.1413 1.76054 14.8867 3.90543 14.8867H11.6692C13.8141 14.8867 15.559 13.1413 15.559 10.9958V3.89095C15.559 1.74543 13.8141 0 11.6692 0ZM1.38783 3.89095C1.38783 2.50252 2.51741 1.37259 3.90543 1.37259H11.6692C13.0572 1.37259 14.1868 2.50252 14.1868 3.89095V10.9958C14.1868 12.3842 13.0572 13.5141 11.6692 13.5141H3.90543C2.51741 13.5141 1.38783 12.3842 1.38783 10.9958V3.89095Z" fill="currentcolor"/>
                        <path d="M7.78615 11.0611C9.78072 11.0611 11.4043 9.4379 11.4043 7.44187C11.4043 5.44583 9.7816 3.82263 7.78615 3.82263C5.7907 3.82263 4.16797 5.44583 4.16797 7.44187C4.16797 9.4379 5.7907 11.0611 7.78615 11.0611ZM7.78615 5.1961C9.02473 5.1961 10.0321 6.2038 10.0321 7.44275C10.0321 8.6817 9.02473 9.68939 7.78615 9.68939C6.54757 9.68939 5.54017 8.6817 5.54017 7.44275C5.54017 6.2038 6.54757 5.1961 7.78615 5.1961Z" fill="currentcolor"/>
                        <path d="M11.7405 4.40587C12.2776 4.40587 12.7154 3.96887 12.7154 3.43073C12.7154 2.89259 12.2785 2.45557 11.7405 2.45557C11.2025 2.45557 10.7656 2.89259 10.7656 3.43073C10.7656 3.96887 11.2025 4.40587 11.7405 4.40587Z" fill="currentcolor"/>
                    </svg>
                </span>     
            </a>
        <?php endif; ?>
        <?php if(!empty($user_twitter)) : ?>
            <a href="<?php echo esc_url($user_twitter); ?>" class="button button--only-icon author-card__social">
                <span class="button__icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="15" viewBox="0 0 17 15">
                        <path d="M0.0541078 0L6.23148 8.26147L0.015625 14.9786H1.41497L6.85749 9.09796L11.2545 14.9786H16.0156L9.49099 6.25244L15.277 0H13.8777L8.86592 5.41597L4.81619 0H0.0550358H0.0541078ZM2.11135 1.03083H4.29812L13.9565 13.9478H11.7697L2.11135 1.03083Z" fill="currentcolor"/>
                    </svg>
                </span>
            </a>
        <?php endif; ?>
        <?php if(!empty($user_pinterest)) : ?>
            <a href="<?php echo esc_url($user_pinterest); ?>" class="button button--only-icon author-card__social">
                <span class="button__icon">
                    <svg width="auto" height="18" viewBox="0 0 10 13" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.68058 4.78942C9.68058 5.47211 9.58532 6.10716 9.3948 6.69459C9.22016 7.28201 8.96614 7.79006 8.63274 8.21872C8.29933 8.63151 7.90242 8.96491 7.44201 9.21893C6.98159 9.45708 6.47355 9.56821 5.91787 9.55234C5.72736 9.56821 5.53684 9.55234 5.34633 9.50471C5.17168 9.4412 5.00498 9.3777 4.84622 9.31419C4.70333 9.23481 4.57632 9.13955 4.46519 9.02841C4.35405 8.91728 4.26673 8.81408 4.20323 8.71883C4.10797 9.09986 4.02859 9.41739 3.96508 9.67141C3.90157 9.92543 3.84601 10.1239 3.79838 10.2668C3.76663 10.3938 3.74281 10.489 3.72693 10.5525C3.72693 10.6002 3.72693 10.6161 3.72693 10.6002C3.67931 10.7431 3.63168 10.878 3.58405 11.005C3.53642 11.132 3.48085 11.267 3.41735 11.4099C3.35384 11.5369 3.2824 11.656 3.20301 11.7671C3.13951 11.8782 3.076 11.9894 3.0125 12.1005C2.82198 12.2275 2.67116 12.2831 2.56002 12.2672C2.46476 12.2672 2.38538 12.2275 2.32188 12.1481C2.27425 12.0687 2.24249 11.9894 2.22662 11.91C2.21074 11.8465 2.2028 11.8068 2.2028 11.7909C2.18693 11.6798 2.17899 11.5607 2.17899 11.4337C2.17899 11.2908 2.17899 11.1558 2.17899 11.0288C2.19486 10.886 2.21074 10.7431 2.22662 10.6002C2.25837 10.4573 2.29012 10.3303 2.32188 10.2191C2.32188 10.2033 2.32981 10.1556 2.34569 10.0763C2.37744 9.981 2.42507 9.79842 2.48858 9.52852C2.55208 9.24275 2.6394 8.85377 2.75054 8.36161C2.86167 7.86944 3.0125 7.21851 3.20301 6.40881C3.15539 6.31355 3.11569 6.19448 3.08394 6.05159C3.05219 5.90871 3.02837 5.78963 3.0125 5.69438C2.99662 5.58324 2.98868 5.48798 2.98868 5.4086C2.98868 5.32922 2.98868 5.29747 2.98868 5.31334C2.98868 5.04344 3.02044 4.8053 3.08394 4.59891C3.16332 4.37664 3.25858 4.18612 3.36972 4.02736C3.49673 3.85272 3.63961 3.72571 3.79838 3.64632C3.97302 3.55107 4.14766 3.4955 4.3223 3.47962C4.48106 3.4955 4.61601 3.52725 4.72715 3.57488C4.85416 3.62251 4.95735 3.70189 5.03674 3.81303C5.11612 3.92416 5.17168 4.04323 5.20344 4.17024C5.25107 4.28138 5.27488 4.41633 5.27488 4.57509C5.27488 4.71798 5.25107 4.89262 5.20344 5.09901C5.15581 5.28953 5.10024 5.48798 5.03674 5.69438C4.97323 5.90077 4.90179 6.12304 4.8224 6.36118C4.7589 6.58345 4.70333 6.79778 4.6557 7.00418C4.60807 7.21057 4.60014 7.39315 4.63189 7.55191C4.67952 7.6948 4.75096 7.83769 4.84622 7.98057C4.95735 8.10759 5.0923 8.20284 5.25107 8.26635C5.40983 8.32985 5.57653 8.36955 5.75117 8.38542C6.08458 8.36955 6.38623 8.26635 6.65613 8.07583C6.92602 7.88532 7.15623 7.61542 7.34675 7.26614C7.55314 6.91686 7.70397 6.52789 7.79923 6.09922C7.91036 5.65468 7.96593 5.17046 7.96593 4.64654C7.96593 4.28138 7.90242 3.9321 7.77541 3.59869C7.6484 3.26529 7.45788 2.98745 7.20386 2.76518C6.96572 2.52704 6.66406 2.33652 6.29891 2.19363C5.94963 2.05075 5.53684 1.98724 5.06055 2.00312C4.53663 1.98724 4.06034 2.07456 3.63168 2.26508C3.21889 2.4556 2.86167 2.70168 2.56002 3.00333C2.25837 3.30498 2.02816 3.6622 1.8694 4.07499C1.71063 4.47189 1.63125 4.88468 1.63125 5.31334C1.63125 5.48798 1.63919 5.63881 1.65507 5.76582C1.68682 5.87695 1.71857 5.99603 1.75033 6.12304C1.79796 6.23417 1.84558 6.33737 1.89321 6.43263C1.95672 6.51201 2.02816 6.60727 2.10754 6.7184C2.1393 6.73428 2.16311 6.76603 2.17899 6.81366C2.19486 6.84541 2.2028 6.86923 2.2028 6.8851C2.21868 6.90098 2.22662 6.93273 2.22662 6.98036C2.22662 7.01212 2.21868 7.04387 2.2028 7.07562C2.18693 7.12325 2.17105 7.17088 2.15517 7.21851C2.15517 7.25026 2.14724 7.29789 2.13136 7.3614C2.11548 7.4249 2.09961 7.48047 2.08373 7.5281C2.06785 7.55985 2.05992 7.59954 2.05992 7.64717C2.04404 7.67892 2.02022 7.71861 1.98847 7.76624C1.9726 7.798 1.94878 7.82181 1.91703 7.83769C1.88528 7.83769 1.85352 7.84562 1.82177 7.8615C1.79002 7.8615 1.75033 7.84562 1.7027 7.81387C1.46455 7.71861 1.25022 7.58366 1.0597 7.40902C0.885063 7.21851 0.742176 7.01212 0.631041 6.78985C0.519907 6.56758 0.432587 6.31355 0.369081 6.02778C0.305576 5.74201 0.273823 5.45623 0.273823 5.17046C0.273823 4.66241 0.377019 4.15437 0.583412 3.64632C0.805681 3.13828 1.12321 2.66993 1.53599 2.24126C1.94878 1.8126 2.46476 1.47126 3.08394 1.21724C3.70312 0.947339 4.4255 0.804452 5.25107 0.788576C5.91787 0.804452 6.52118 0.923525 7.06097 1.14579C7.61665 1.35219 8.085 1.6459 8.46603 2.02693C8.84707 2.40797 9.14078 2.83663 9.34717 3.31292C9.56944 3.77333 9.68058 4.2655 9.68058 4.78942Z" fill="currentcolor"/>
                    </svg>
                </span>
            </a>
        <?php endif; ?>
    </div>
<?php } 

// Get Image By Size
if(!function_exists('komestic_get_image_by_size')){
    function komestic_get_image_by_size( $params = [], $post_id = null, $placeholder = false ) {
        $params = array_merge([
            'img_id' => '',
            'img_dimension' => 'full',
            'attr' => [],
        ], $params );        
        $params['img_id'] = !is_null($post_id) ? get_post_thumbnail_id($post_id) : ($params['img_id']  ?? '');
        $dimensions = $params['img_dimension'];

        if(!is_array($dimensions)) {
            $size = get_intermediate_image_sizes();
            foreach ($size as $s) {
                $dimensions = wp_get_additional_image_sizes()[$s] ?? [
                    'width'  => get_option("{$s}_size_w"),
                    'height' => get_option("{$s}_size_h"),
                ];
            }
        }
        $thumbnail = ($placeholder && empty($params['img_id'])) ? '<img src="https://placehold.co/'.$dimensions['width'].'x'.$dimensions['height'].'/" class="pxl-image-placeholder '.esc_attr($params['attr']['class'] ?? '').'" alt="'.esc_attr__('Image Placeholder', 'komestic').'" />' : '';

        if ( empty($params['img_id']) ) 
            return $thumbnail;

        $img_id = apply_filters( 'pxl_object_id', $params['img_id'] );
        $img_dimension = isset($params['img_dimension']) ? $params['img_dimension'] : 'thumbnail';
        $img_attr = isset($params['attr']) ? $params['attr'] : [];
        $img_attr['class'] = isset($img_attr['class']) ? $img_attr['class'] : '';
        $img_attr['alt']   = isset($img_attr['alt']) ? $img_attr['alt'] : trim( wp_strip_all_tags(get_post_meta( $img_id, '_wp_attachment_image_alt', true )) );
        $img_attr['loading'] = 'lazy';
        global $_wp_additional_image_sizes;

        $post = get_post( $post_id );
        if(!empty($post)) {
            $post_title = trim(wp_strip_all_tags( $post->post_title, true));
            $post_excerpt = trim(wp_strip_all_tags( $post->post_excerpt, true));
            if(empty(trim($img_attr['alt']))) {
                $img_attr['alt'] = !empty($post_excerpt) ? $post_excerpt : $post_title;
            }
        }

        if ( !is_array($img_dimension) ) {
            $img_attr['class'] .= ' attachment-'.$img_dimension;
            $thumbnail = wp_get_attachment_image( $img_id, $img_dimension, false, $img_attr );
        }else {
            $img_w = $img_dimension['width'];
            $img_h = $img_dimension['height'];
            // if(!function_exists('pxl_resize')) {
            //     return $thumbnail;
            // }
            $img_crop = pxl_resize( $img_id, null, $img_w, $img_h, true );
            if (!isset($img_crop['url'])) return  ;
            $img_attr = pxl_stringify_attributes(
                array_merge(
                    [
                        'src' => $img_crop['url'],
                        'width' => $img_w,
                        'height' => $img_h,
                    ],
                    $img_attr,
                )
            );
            $thumbnail = '<img ' . $img_attr . ' />';
        } 
        return $thumbnail;
    }
}