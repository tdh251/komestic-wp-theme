<?php
    $info_type = $widget->get_setting('info_type', 'custom');
    $info_custom = $widget->get_setting('info_custom', '');
    $post_type = get_post_type() === 'post' ? null : get_post_type().'-';
    $post_id   = get_the_ID();
?>
<div class="pxl-post-meta">
    <?php if(!empty($settings['_icon']['value'])) : ?>
        <div class="meta__label">
            <?php \Elementor\Icons_Manager::render_icon( $settings['_icon'], [ 'aria-hidden' => 'true', 'class' => 'pxl-icon' ], 'i' ); ?>
        </div>
    <?php endif; ?>
    <div class="meta__info">
        <?php 
            switch($info_type) {
                case 'category' : 
                    the_terms($post_id, $post_type.'category', '', ', ');
                    break;
                case 'tags' : 
                    pxl_print_html(get_the_tag_list(', '));
                    break;
                case 'author' : 
                    $author_id = get_post_field('post_author', $post_id);
                    pxl_print_html('<a href="'.esc_url(get_author_posts_url($author_id)).'" class="author-link"><span>'.esc_html__('By ', 'komestic').'</span>'.esc_attr(get_the_author_meta('display_name', $author_id)).'</a>');
                    break;
                case 'date' : 
                    $date_format = $widget->get_setting('date_format', 'd F, Y');
                    echo get_the_date($date_format, $post_id);
                    break;
                case 'comment' : 
                    $comment_number = get_comments_number();
                    $comment_show = ($comment_number == 0) ? 'No Comment' : str_pad($comment_number, 2, '0', STR_PAD_LEFT). ' Comment';
                    echo esc_html($comment_show);
                    break;
                default : 
                    $info_link = $widget->get_setting('info_link', '');
                    $link_attrs = komestic_get_link_attributes($info_link);
                    $tag = !is_null($link_attrs) ? 'a' : 'span';
                    echo '<'.$tag.' class="pxl-info-custom "'.$link_attrs.'>';
                    echo esc_html($info_custom);
                    echo '</'.$tag.'>';
                    break;
            }
        ?>
    </div>
</div>