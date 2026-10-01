<?php
$btn_text = isset($args['btn_text']) ? $args['btn_text'] : 'Click here';
?>
<span class="button__text">
    <span class="button__icon button__icon--copy">
        <svg width="18" height="12" viewBox="0 0 18 12" xmlns="http://www.w3.org/2000/svg">
            <path d="M0.75 5.24994L14.688 5.25002L10.7197 1.28027L11.7803 0.219613L17.5607 5.99994L11.7803 11.7803L10.7197 10.7196L14.688 6.75002L0.75 6.74994L0.75 5.24994Z" fill="currentcolor"/>
        </svg>
    </span>
    <?php echo esc_html($btn_text); ?>
    <span class="button__icon button__icon--main">
        <svg width="18" height="12" viewBox="0 0 18 12" xmlns="http://www.w3.org/2000/svg">
            <path d="M0.75 5.24994L14.688 5.25002L10.7197 1.28027L11.7803 0.219613L17.5607 5.99994L11.7803 11.7803L10.7197 10.7196L14.688 6.75002L0.75 6.74994L0.75 5.24994Z" fill="currentcolor"/>
        </svg>
    </span>
</span>