
;(function ($) {
    "use strict";
    let windowWidth = $(window).width();
    let windowHeight = $(window).height();
    let lastScrollTop  = 150;

    $(window).on('load', function () {
        windowWidth = $(window).width();
        windowHeight = $(window).height();
    });

    $(window).on('resize', function () {
        windowWidth = $(window).width();
        windowHeight = $(window).height();
    });

    $(window).on('scroll', function () {
        if(!$('.header-sticky').length) return;
        let scrollTop = $(this).scrollTop();
        if (scrollTop > 150 && windowWidth >= 1200) {
            if (scrollTop > lastScrollTop) {
                $('.header-sticky.scroll-down').css('transform', 'translateY(0)');
                $('.header-sticky.scroll-up').css('transform', 'translateY(-105%)');
            } else {
                $('.header-sticky.scroll-up').css('transform', 'translateY(0)');
                $('.header-sticky.scroll-down').css('transform', 'translateY(-105%)');
            }
        } 
        else if (scrollTop < 100 && windowWidth >= 1200) {
            $('.header-sticky.scroll-up').css('transform', 'translateY(-105%)');
        }
        lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
    });

    $(document).ready(function () { 
        komesticToggleMobileSidebar();
        setTimeout(function(){
            komesticHandleSubmenu();
        }, 150)
    });

    // Toggle Mobile Menu
    function komesticToggleMobileSidebar() {
        $('.mobile-button-toggle').on('click', function(e) {
            e.preventDefault();
            const parent = $(this).closest('.header-mobile');
            $(parent).find('.mobile-sidebar').addClass('active');
            $('.body-overlay').addClass('active');
            $('body').addClass('body-overflow');
        })

        $(document.body).on('click', '.body-overlay, .mobile-sidebar .button-close', function(e) {
            e.preventDefault();
            const parent = $(this).closest('.header-mobile');
            $('.mobile-sidebar').removeClass('active');
            $('.body-overlay').removeClass('active');
            $('body').removeClass('body-overflow');
        })
        
    }
    // Menu Responsive Dropdown 
    function komesticHandleSubmenu() {
        const menuItems = $('.pxl-header li.menu-item-has-children');
        if(!menuItems.length) return;
        menuItems.each(function (i, menuItem) {
            let submenu = $(menuItem).find('> .sub-menu').first();
            if (!submenu.length) return;
            if( (submenu.offset().left + submenu.width() + 0 ) > $(window).width() )
                submenu.addClass('submenu-reverse');
            $(menuItem).on('click', '.drop-down', function (e) {
                if (windowWidth >= 1200) return;
                e.preventDefault();
                e.stopPropagation(); 
                $(menuItem).toggleClass('active')
                if($(menuItem).hasClass('active')) {
                    gsap.to(submenu, {
                        height: 'auto',
                        ease: 'power2.out',
                        duration: 0.5,
                    })
                    return;
                }
                gsap.to(submenu, {
                    height: 0,
                    ease: 'power2.out',
                    duration: 0.5,
                })
            });
        });
    }

})(jQuery);