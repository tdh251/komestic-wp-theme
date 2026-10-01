<?php

global $product;
if ( ! comments_open() ) {
	return;
}

global $post, $wp_query;

$wp_query->comments = get_comments( array(
    'post_id' => $post->ID,
    'status'  => 'approve',
) );

$wp_query->comment_count = count( $wp_query->comments );

$wp_query->max_num_comment_pages = get_comment_pages_count( $wp_query->comments );

$rating_count = $product->get_rating_count();
$average_rating = round($product->get_average_rating(), 2);
$rating_arr = komestic_get_star_rating_counts($product->get_id());
$rating_number = ((int)$average_rating === $average_rating)
    ? $average_rating . '.0/5.0'
    : $average_rating . '/5.0';
?>
<div class="product-reviews">
    <div id="reviews" class="reviews">
        <h2 class="reviews__title">
            <?php echo esc_html('Customer Reviews', 'komestic'); ?>
        </h2>
        <div class="reviews__inner">
            <div class="reviews__header">
                <div class="rating-meta">
                    <div class="meta-group">
                        <div class="rating-star-count">
                            <?php echo wc_get_rating_html( $average_rating, $rating_count ); ?>
                            <span class="rating-count">
                                <?php echo esc_html('('.$rating_count.')'); ?>
                            </span>
                        </div>
                        <div class="rating-number">
                            <?php echo esc_html($rating_number) ?>
                        </div>
                    </div>
                    <div class="rating-count-text">
                        <?php echo esc_html('Based on '.$rating_count.' reviews', 'komestic'); ?>
                    </div>
                </div>
                <ul class="rating-list">
                    <?php foreach($rating_arr as $number => $rating) :
                        $percent = 0;
                        if($rating_count !== 0)
                            $percent = ($rating / $rating_count) * 100;
                    ?>
                        <li>
                            <div class="number-star">
                                <?php echo esc_html($number); ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14" viewBox="0 0 16 14" fill="none">
                                    <path d="M7.99998 0L10.058 4.95914L15.5 5.34753L11.33 8.80085L12.6352 14L7.99998 11.1752L3.36474 14L4.66999 8.80085L0.5 5.34753L5.94193 4.95914L7.99998 0Z" fill="#1F1F1F"/>
                                </svg>
                            </div>
                            <div class="rating-progress-bar">
                                <div class="slider" style="width: <?php echo esc_attr($percent.'%'); ?>"></div>
                            </div>
                            <span class="rating-count">
                                <?php echo esc_html($rating); ?>
                            </span>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <button class="pxl-button button--primary button--toggle-comment-form">
                    <span class="button__text">
                        <?php echo esc_html__('Write a review', 'komestic'); ?>
                    </span>
                </button>
            </div>
            <div id="comments">	
                <?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>
                    <div id="review_form_wrapper">
                        <h6 class="title"><?php echo esc_html__('Write a review', 'komestic'); ?></h6>
                        <div id="review_form">
                            <?php
                            $commenter = wp_get_current_commenter();
                            $comment_form = array(
                                'title_reply' => have_comments() ? esc_html__( 'Write a review', 'komestic' ) : sprintf( esc_html__( 'Be the first to review &ldquo;%s&rdquo;', 'komestic' ), get_the_title() ),
                                'title_reply_to' => esc_html__( 'Leave a Reply to %s', 'komestic' ),
                                'title_reply_before' => '<span id="reply-title" class="comment-reply-title" role="heading" aria-level="3">',
                                'title_reply_after'  => '</span>',
                                'comment_notes_after' => '',
                                'logged_in_as' => '',
                                'comment_field'  => '', 
                                'class_submit'         => 'pxl-button button--primary',
                                'label_submit' => esc_html__( 'Submit Review', 'komestic' ),
                                'submit_button'     => '<button name="%1$s" type="submit" id="%2$s" class="%3$s" /><span class="button__text">%4$s</span></button><button class="pxl-button button--primary button--toggle-comment-form"><span class="button__text">'.esc_html__('Cancel review', 'komestic').'</span></button>',
                            );
                            
                            $name_email_required = (bool) get_option( 'require_name_email', 1 );
                            
                            $fields = array();
                            
                            if ( wc_review_ratings_enabled() ) {
                                $fields['rating'] = array(
                                    'label' => __( 'Your rating', 'komestic' ),
                                    'type' => 'rating', 
                                    'required' => true,
                                    'html' => '<div class="comment-form-rating"><label for="rating" id="comment-form-rating-label">' . esc_html__( 'Your rating', 'komestic' ) . ( wc_review_ratings_required() ? '&nbsp;<span class="required">*</span>' : '' ) . '</label><select name="rating" id="rating" required>
                                        <option value="">' . esc_html__( 'Rate&hellip;', 'komestic' ) . '</option>
                                        <option value="5">' . esc_html__( 'Perfect', 'komestic' ) . '</option>
                                        <option value="4">' . esc_html__( 'Good', 'komestic' ) . '</option>
                                        <option value="3">' . esc_html__( 'Average', 'komestic' ) . '</option>
                                        <option value="2">' . esc_html__( 'Not that bad', 'komestic' ) . '</option>
                                        <option value="1">' . esc_html__( 'Very poor', 'komestic' ) . '</option>
                                    </select></div>'
                                );
                            }
                            
                            $fields['author'] = array(
                                'label' => __( 'Name', 'komestic' ),
                                'type'  => 'text',
                                'value' => $commenter['comment_author'],
                                'required'  => $name_email_required,
                                'autocomplete' => 'name',
                            );
                            
                            $fields['email'] = array(
                                'label' => __( 'Email', 'komestic' ),
                                'type'  => 'email',
                                'value' => $commenter['comment_author_email'],
                                'required' => $name_email_required,
                                'autocomplete' => 'email',
                            );
                            
            
                            $comment_form['fields'] = array();
                            foreach ( $fields as $key => $field ) {
                                if ( isset($field['html']) ) {
                                    $comment_form['fields'][$key] = $field['html'];
                                } else {
                                    $field_html = '<p class="comment-form__control comment-form-' . esc_attr( $key ) . '">';
                                    
                                    $field_html .= '<input placeholder="'.esc_html( $field['label'] ).'" id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" type="' . esc_attr( $field['type'] ) . '" autocomplete="' . esc_attr( $field['autocomplete'] ) . '" value="' . esc_attr( $field['value'] ) . '" size="30" ' . ( $field['required'] ? 'required' : '' ) . ' />';
                                    $field_html .= '<label for="' . esc_attr( $key ) . '">' . esc_html( $field['label'] );
                                    if ( $field['required'] ) {
                                        $field_html .= '&nbsp;<span class="required">*</span>';
                                    }
                                    $field_html .= '</label>';
                                    
                                    $field_html .= '</p>';
                                    $comment_form['fields'][ $key ] = $field_html;
                                }
                            }
                            
                            $account_page_url = wc_get_page_permalink( 'myaccount' );
                            if ( $account_page_url ) {
                                /* translators: %s opening and closing link tags respectively */
                                $comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( esc_html__( 'You must be %1$slogged in%2$s to post a review.', 'komestic' ), '<a href="' . esc_url( $account_page_url ) . '">', '</a>' ) . '</p>';
                            }
                            
                            $comment_form['comment_field'] = '<p class="comment-form__control comment-form-comment"><textarea placeholder="'.esc_html__('Your review *', 'komestic').'" id="comment" name="comment" cols="45" rows="8" required></textarea><label for="comment">' . esc_html__( 'Your review', 'komestic' ) . '&nbsp;<span class="required">*</span></label></p>';
                            
                            comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
                            ?>
                        </div>
                    </div>
                <?php else : ?>
                    <p class="woocommerce-verification-required"><?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review.', 'komestic' ); ?></p>
                <?php endif; ?>
                <?php if ( have_comments() ) : ?>
                    <ol class="commentlist">
                        <?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'komestic_woocommerce_comments' ) ) ); ?>
                    </ol>
                    <?php
                    if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
                        echo '<nav class="woocommerce-pagination">';
                        paginate_comments_links(
                            apply_filters(
                                'woocommerce_comment_pagination_args',
                                array(
                                    'prev_text' => is_rtl() ? '&rarr;' : '&larr;',
                                    'next_text' => is_rtl() ? '&larr;' : '&rarr;',
                                    'type'      => 'list',
                                )
                            )
                        );
                        echo '</nav>';
                    endif;
                    ?>
                <?php else : ?>
                    <p class="woocommerce-noreviews"><?php esc_html_e( 'There are no reviews yet.', 'komestic' ); ?></p>
                <?php endif; ?>
            
            </div>
        </div>
    </div>
</div>

