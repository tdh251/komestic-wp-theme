<?php 
$btn_text = isset($args['btn_text']) ? $args['btn_text'] : 'Click here';
if(!empty($btn_text)) : ?>
    <span class="button__text">
        <?php echo esc_html($btn_text); ?>
    </span>
<?php endif; ?>
<span class="button__icon">
    <svg class="button__icon--main" xmlns="http://www.w3.org/2000/svg" width="11" height="12" viewBox="0 0 11 12">
        <path d="M9.16987 3.62403L1.2939 11.5L0 10.2061L7.87505 2.33013H0.934282V0.5H11V10.5657H9.16987V3.62403Z" fill="currentcolor"/>
    </svg>
    <svg class="button__icon--copy" xmlns="http://www.w3.org/2000/svg" width="11" height="12" viewBox="0 0 11 12">
        <path d="M9.16987 3.62403L1.2939 11.5L0 10.2061L7.87505 2.33013H0.934282V0.5H11V10.5657H9.16987V3.62403Z" fill="currentcolor"/>
    </svg>
</span>