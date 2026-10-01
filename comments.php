<?php
/**
 * @package Case-Themes
 */

if ( post_password_required() ) return; 
$close_div = is_user_logged_in() ? '' : '</div>';
?>
<div class="comment">
    <?php if ( have_comments() ) : ?>
        <?php the_comments_navigation(); ?>
        <div class="comment__list">
            <?php
                wp_list_comments( array(
                    'style'      => 'div',
                    'short_ping' => true,
                    'callback'   => 'komestic_comment_list',
                    'max_depth'  => 3
                ));
            ?>
        </div>
        <?php the_comments_navigation(); 
    endif;
    $args = array(
            'id_form'           => 'commentform',
            'id_submit'         => 'submit',
            'class_container'   => 'comment__form',
            'class_form'        => 'comment__form-main',
            'title_reply_before'=> '<h3 id="reply-title" class="comment__form-title">',
            'title_reply_after' => '</h3>',
            'title_reply'       => esc_attr__( 'Leave a comment', 'komestic'),
            'title_reply_to'    => esc_attr__( 'Leave a comment', 'komestic') . '%s',
            'cancel_reply_link' => esc_attr__( 'Cancel Comment', 'komestic'),
            'class_submit'         => 'pxl-button button--only-text',
            'submit_field'      => '<p class="comment__form-submit">%1$s %2$s</p>',
            'submit_button'     => '<button name="%1$s" type="submit" id="%2$s" class="%3$s" /><span class="button__text">'.esc_html__('Post Comment', 'komestic').' </span></button>',
            'comment_notes_before' => esc_html__('', 'komestic'),
            'fields' => apply_filters( 'comment_form_default_fields', array(
                'author' =>
                    '<p class="comment__form-note">'.esc_html__('Your email address will not be published. Required field are marked', 'komestic').'<span class="require">'.esc_html__('*', 'komestic').'</span></p>'.
                    '<div class="comment__form-fields">'.
                        '<div class="comment__form-field-group">'.
                            '<p class="comment__form-field comment__form-field--name">' .
                                '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" placeholder="' . esc_attr__('Your Name *', 'komestic') . '" aria-required="true" class="comment__form-input" />' .
                            '</p>',
                'email' =>
                            '<p class="comment__form-field comment__form-field--email">' .
                                '<input id="email" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" placeholder="' . esc_attr__('Your Email *', 'komestic') . '" autocomplete="email" aria-required="true" class="comment__form-input" />' . 
                            '</p>'.
                        '</div>',
            )),
            'comment_field' => '
                        <p class="comment__form-field comment__form-field--comment">'.
                            '<textarea id="comment" name="comment" placeholder="' . esc_attr__('Write Comment...*', 'komestic') . '" aria-required="true" class="comment__form-textarea"></textarea>' . 
                        '</p>'. 
                    $close_div,
    );
    comment_form($args); ?>
</div>