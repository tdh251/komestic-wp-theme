<?php  
$footer_display = komestic()->get_page_opt('footer_display', 'show'); 
if($footer_display === 'show') :
?>
    <footer id="footer" class="footer footer--default"> 
        <div class="container">
            <div class="footer__inner">
                <?php echo wp_kses_post(''.esc_attr(date("Y")).' &copy; All rights reserved by <a target="_blank" rel="nofollow" href="https://themeforest.net/user/case-themes/portfolio">Case-Themes</a>'); ?>
            </div>
        </div>
    </footer>
<?php endif; ?>