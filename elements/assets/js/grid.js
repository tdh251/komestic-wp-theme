( function( $ ) {
    "use strict";
    
    $( window ).on( 'elementor/frontend/init', function() {
        let isLoading = false;
        setTimeout(function(){
            $('.grid').each(function(index, element) { 
                var grid = $(this);
                const masonry = grid.find('.masonry');
                var isoOptions = {
                    layoutMode : 'masonry',
                    percentPosition: true,
                    itemSelector: '.grid__item',
                    masonry: {
                        columnWidth: '.grid-sizer',
                    },
                };
                if(masonry.length) {
                    var $grid_isotope = $(masonry).isotope(isoOptions);
                }
                 
                // Filter
                $(document).on('click', '.pxl-grid-filter .filter-item, .pxl-filter-widget .filter-item', function(e) {
                    e.preventDefault()
                    let filterItemCurrent = $(this);
                    let term_slug = filterItemCurrent.attr('data-filter');  
                    let filterWrap = filterItemCurrent.parent('.pxl-grid-filter');
                    $('.pxl-filter-widget .filter-item').removeClass('active');        
                    $(this).addClass('active');
                    if( $(filterWrap).hasClass('ajax') ){
                        let loadmore = grid.data('loadmore');
                        loadmore.term_slug = term_slug;
                        komestic_grid_ajax_handler( filterItemCurrent, grid, $grid_isotope, 
                            { action: 'komestic_load_more_post_grid', loadmore: loadmore, iso_options: isoOptions, handler_click: 'filter', scrolltop: 0 }
                        );
                    }else{
                        $grid_isotope.isotope({ filter: term_slug });
                    }
                });

                // Pagination
                grid.on('click', '.pagination .pagination__inner.ajax a.page-numbers', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    if( isLoading ) return;
                    isLoading = true;
                    console.log('clicked');
                    let $this = $(this);
                    let loadmore = grid.data('loadmore');
                    let paged = $this.attr('href');
                    paged = paged.replace('#', '');
                    loadmore.paged = parseInt(paged);
                    komestic_grid_ajax_handler( $this, grid, $grid_isotope, 
                        { 
                            action: 'komestic_load_more_post_grid', 
                            loadmore: loadmore, 
                            iso_options: isoOptions, 
                            handler_click: 'pagination', 
                            scrolltop: 0,
                            wpnonce: main_data.wpnonce 
                        }
                    );
                });

                // Load More
                grid.on('click', '.load-more .button--load-more', function(e) {
                    e.preventDefault();
                    let $this = $(this);
                    let loadmore = grid.data('loadmore');
                    loadmore.paged = parseInt(grid.data('start-page')) + 1; 
                    $this.addClass('button--loading');
                    $this.prop('disabled', true);
                    komestic_grid_ajax_handler( $this, grid, $grid_isotope, 
                        { action: 'komestic_load_more_post_grid', loadmore: loadmore, iso_options: isoOptions, handler_click: 'loadmore', scrolltop: 0, wpnonce: main_data.wpnonce }
                    );
                });
            });
        }, 300);

        function komestic_grid_ajax_handler($this, grid, $grid_isotope, args = {}){
            var settings = $.extend( true, {}, {
                action: '',
                loadmore: '',
                iso_options: {},
                handler_click: '',
                scrollTop: 0,
                wpnonce: ''
            }, args );
            $.ajax({
                url: main_data.ajax_url,
                type: 'POST',
                data: {
                    action: settings.action,
                    settings: settings.loadmore,
                    handler_click: settings.handler_click,
                    wpnonce: settings.wpnonce
                },
                beforeSend: function() {  
                    settings.scrollTop = $(window).scrollTop();
                    grid.find('.pxl-grid-loader').addClass('loading');
                    AppUtils.showLoading($('body'));
                },
                success: function( res ) {   
                    console.log(res.data)
                    if(res.status == false) return; 
                    if( settings.handler_click == 'loadmore' ){
                        let $htmlToAppend = $(res.data.html); 

                        grid.find('.grid__inner').append($htmlToAppend);
                        if (res.data.paged >= res.data.max) {
                            grid.find('.load-more').hide();
                        }
                    }else{
                        grid.find(".pagination").html(res.data.pagin_html);
                        grid.find('.grid__inner .grid__item').remove();
                        grid.find('.grid__inner').append(res.data.html);
                    }
                    grid.data('start-page', res.data.paged);

                    if(typeof onMouseenterImageDistortionTransition === 'function') onMouseenterImageDistortionTransition()
                },
                complete: function() {
                    setTimeout(() => {
                        isLoading = false;
                    }, 1000);
                    $(window).scrollTop(settings.scrollTop);
                    grid.find('.grid__item').addClass('pxl-invisible');
                    grid.find('.button--load-more').removeClass('button--loading').prop('disabled', true);
                    AppUtils.hideLoading($('body'));
                }
            });
        }
    });
     
} )( jQuery );