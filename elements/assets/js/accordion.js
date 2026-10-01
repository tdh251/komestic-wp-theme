( function( $ ) {
    "use strict";
    const initAccordion = function($scope) {
        const els = $scope.find('.pxl-accordion');
        if (!els.length) return;

        els.each(function() {
            const $el = $(this);
            let $items = $el.find('.accordion-item');

            $items.each(function() {
                const $item = $(this);
                if ($item.hasClass('active')) {
                    const $content = $item.find('.accordion-content');
                    gsap.set($content[0], { height: $content[0].scrollHeight });
                }
            });

            $items.off('click.accordion').on('click.accordion', function(e) {
                e.preventDefault();
                const $currentItem = $(e.currentTarget).closest('.accordion-item');
                const $currentContent = $currentItem.find('.accordion-content');

                if ($currentItem.hasClass('active')) {
                    $currentItem.removeClass('active');
                    gsap.to($currentContent[0], { height: 0, duration: 0.5 });
                    return;
                }

                const $activeItem = $el.find('.accordion-item.active');
                const $activeContent = $activeItem.find('.accordion-content');

                $activeItem.removeClass('active');
                gsap.to($activeContent[0], { height: 0, duration: 0.5 });

                $currentItem.addClass('active');
                gsap.to($currentContent[0], {
                    height: $currentContent[0].scrollHeight,
                    duration: 0.5,
                    onComplete: () => gsap.set($currentContent[0], { height: 'auto' })
                });
            });

        });
    };

    $( window ).on( 'elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction( `frontend/element_ready/pxl_accordion.default`, function( $scope ) {
            initAccordion($scope);
        });
        elementorFrontend.hooks.addAction( `frontend/element_ready/pxl_product_accordion.default`, function( $scope ) {
            initAccordion($scope);
        });
    });
} )( jQuery );