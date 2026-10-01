<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$comment = $args['comment'];
$list_args = $args['args']; 
$depth = $args['depth'];
$rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
    <div id="comment-<?php comment_ID(); ?>" class="comment_container">
        <div class="comment__user-avatar">
            <?php if ( $list_args['avatar_size'] != 0 ) : 
                echo get_avatar( $comment, 90 );
            endif; ?>
        </div>
        <div class="comment__content">
            <div class="comment__meta">
                <div class="comment__user-name">
                    <?php printf( '%s', get_comment_author_link() ); ?>
                </div>
                <div class="comment__divider"></div>
                <?php if ( $rating && wc_review_ratings_enabled() ) : ?>
                    <div class="comment__rating">
                        <?php echo wc_get_rating_html( $rating ); ?>
                    </div>
                <?php endif; ?>
                <div class="comment__date">
                    <?php echo get_comment_date( 'M D, Y' ); ?>
                </div>
            </div>
            <div class="comment__text"><?php comment_text(); ?></div>
        </div>
    </div>
</li>
