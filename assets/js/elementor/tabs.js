( function( $ ) {
    "use strict";
    
    const initTabs = function($scope) {
        let tabs = $scope.find('.tabs');
        if (!tabs.length) {
            return;
        }

        tabs.each(function() {
            const tabButtons = $(this).find('.tab__button');
            const tabContents = $(this).find('.tab__content');

            const initialActiveButton = tabButtons.filter('.active');
            if (initialActiveButton.length) {
                const index = initialActiveButton.index();
                tabContents.eq(index).addClass('active');
            } else {
                tabButtons.eq(0).addClass('active');
                tabContents.eq(0).addClass('active');
            }

            tabButtons.on('click', function(e) {
                e.preventDefault();
                
                const clickedButton = $(this);
                tabButtons.removeClass('active');
                tabContents.removeClass('active');
                clickedButton.addClass('active');
                const index = clickedButton.index();
                tabContents.eq(index).addClass('active');
            });
        });
    };

    $( window ).on( 'elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/pxl_product_tabs.default', function($scope) {
            initTabs($scope)
        } );
    } );

} )( jQuery );