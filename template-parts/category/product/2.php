<?php
/**
 * @package Case-Themes
 */

$thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true );
$category_link = get_term_link( $category );
$image_html = komestic_get_image_by_size([
    'img_id' => $thumbnail_id,
    'img_dimension' => $img_dimension,
]);
?>
<div class="<?php  echo esc_attr($item_class); ?>" <?php if($anim_delay != 0) : ?> data-wow-delay="<?php echo esc_attr(($key * $anim_delay).'ms') ?>" <?php endif; ?>>
    <div class="category-item">
        <div class="category-item__featured">
            <a href="<?php echo esc_url( $category_link ); ?>">
                <?php pxl_print_html($image_html); ?>
            </a>
        </div>
        <<?php echo esc_attr($title_tag); ?> class="category-item__name">
            <a class="category-item__name-link" href="<?php echo esc_url( $category_link ); ?>">
                <?php echo esc_html( $category->name ); ?>
            </a>
            <?php if($show_count) : ?>
                <span class="category-item__count"><?php echo esc_html($category->count); ?></span>
            <?php endif; ?>
        </<?php echo esc_attr($title_tag); ?>>
    </div>
</div>
