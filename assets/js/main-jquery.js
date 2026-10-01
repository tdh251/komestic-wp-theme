;(function ($) {
    

    "use strict";
    
    let pxl_window_height;
    let pxl_window_width;
    let lastScrollTop = 0;

    $(window).on('load', function () {
        let preloader = $('.preloader');
        if (preloader.length) {
            $(".preloader").addClass("loaded").removeClass("loading");
        }
        $('.pxl-header-mobile-elementor, .pxl-slider').css('opacity', '1');
        $('.pxl-gallery-scroll').parents('body').addClass('body-overflow').addClass('body-visible-sm');
        $('blockquote:not(.pxl-blockquote)').append('<i class="pxl-blockquote-icon flaticon-quote-1 text-gradient"></i>');
        pxl_window_width = $(window).width();
        pxl_window_height = $(window).height();
    });

    $(window).on('scroll', function () {
        let scrollTop = $(this).scrollTop();
        lastScrollTop = scrollTop;
        if (lastScrollTop <= pxl_window_height) {
            $('.pxl-scroll-top, .button--back-to-top').addClass('pxl-off').removeClass('pxl-on');
        } else {
            $('.pxl-scroll-top, .button--back-to-top').addClass('pxl-on').removeClass('pxl-off');
        }
    });

    $(window).on('resize', function () {
        pxl_window_height = $(window).height();
        pxl_window_width = $(window).width();
        updateTranslateZToParentHeight()
    });
    function initNiceSelect() {
        const selects = $('.pxl-nice-select');
        if(!selects.length) return;
        selects.each(function () {  
            let $select = $(this);
            if(!$select.hasClass('initialized')) {
                $select.niceSelect();
                $select.addClass('initialized');
            }
        })
    }
    $(document).ready(function () {
        $(".preloader").addClass("loading");
        initCounter() 
        setTimeout(function() {
            initNiceSelect()
        }, 500)
        komestic_type_file_upload();
        updateTranslateZToParentHeight()
        komesticSmoothScroll()
        onClickCallActionAnchor()
        onClickBackToTop()
        setTimeout(function() {
            toggleMenu()
        }, 300)

        customCss()
        // Event
        toggleDrawer();
        onMouseenterActive()
        insertBlobsHtmlButton()
        switcherLanguage()
        playVideoOnMouseenter()
        onMouseenterImageDistortionTransition()
        initPXLCarousel()
        imageParallax(); 
        ajaxPaginationProductCategories();
        
        /* Scroll To Top */
        $('.button--back-to-top').on('click', function () {
            $('html, body').animate({scrollTop: 0}, 1200);
            return false;
        });

        /* End Animate Time Delay */

        /* Lightbox Popup */
        setTimeout(function() {
            $('.pxl-action-popup').magnificPopup({
                type: 'iframe',
                mainClass: 'mfp-fade',
                removalDelay: 160,
                preloader: false,
                fixedContentPos: false
            });
        }, 300);

        $('.pxl-gallery-lightbox').each(function () {
            $(this).magnificPopup({
                delegate: '.lightbox',
                type: 'image',
                gallery: {
                    enabled: true
                },
                mainClass: 'mfp-fade',
            });
        });

    });

    $(document).ajaxComplete(function(event, xhr, settings){
        if (typeof elementorFrontend !== 'undefined') {
            elementorFrontend.init();
        }
        setTimeout(function() {
            insertBlobsHtmlButton();
        }, 300)
    });

    function playVideoOnMouseenter() {
        let $videos = $('.video');
        if(!$videos.length) return;
        $videos.on('mouseenter', function(){
            if($(this).find('.video__play').length) {
                $(this).find('.video__play')[0].play();
            }
        }).on('mouseleave', function(){
            if($(this).find('.video__play').length) {
                $(this).find('.video__play')[0].pause();
            }
        });
    }

    function switcherLanguage() {
        const element = $('.language-switcher');
        if(!element.length) return;
        const options = element.find('.option');
        const currentLanguageCode = element.find('.language-selector .language-code');
        const currentLanguageFlag = element.find('.language-selector .pxl-flag-image');
        $(options).on('click', function (e) {  
            e.preventDefault;
            const languageCode = $(this).attr('data-code');
            const srcFlagImage = $(this).find('.pxl-flag-image').attr('src');
            $(options).removeClass('active');
            $(this).addClass('active');
            $(currentLanguageCode).text(languageCode);
            $(currentLanguageFlag).attr('src', srcFlagImage);
        })
    }

    function insertBlobsHtmlButton() {
        const buttons = $('.pxl-button.button--primary, .pxl-button.button--only-text');
        if(buttons.length === 0) return;
        const blobsHtml = `<div class="button__blobs">
                    <div></div>
                    <div></div>
                    <div></div>
                    </div>`
        buttons.each(function() {
            let buttonBlobs = $(this).find('.button__blobs');
            if(buttonBlobs.length) return;
            $(this).append(blobsHtml)
        })
    }

    function imageParallax() {
        const $els = $('.image--parallax');
        if (!$els.length) return;
        $els.each(function (i, element) {
            const $el = $(element);
            const $image = $el.find('img');

            $el.on('mousemove', function (e) {
                const rect = element.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;

                const moveX = (x - rect.width / 2) * 0.1;
                const moveY = (y - rect.height / 2) * 0.1;

                gsap.to($image[0], {
                    x: -moveX,
                    y: -moveY,
                    scale: 1.15,
                    duration: 0.5,
                    ease: "none"
                });
            });

            $el.on('mouseleave', function () {
            gsap.to($image[0], {
                x: 0,
                y: 0,
                scale: 1,
                duration: 0.5,
                ease: "none"
            });
            });
        });
    }

    /* Preloader Default */
    $.fn.extend({
        jQueryImagesLoaded: function () {
          var $imgs = this.find('img[src!=""]')

          if (!$imgs.length) {
            return $.Deferred()
              .resolve()
              .promise()
          }

          var dfds = []

          $imgs.each(function () {
            var dfd = $.Deferred()
            dfds.push(dfd)
            var img = new Image()
            img.onload = function () {
              dfd.resolve()
            }
            img.onerror = function () {
              dfd.resolve()
            }
            img.src = this.src
          })

          return $.when.apply($, dfds)
        }
    })


    /* Custom Type File Upload*/
    function komestic_type_file_upload() {

        var multipleSupport = typeof $('<input/>')[0].multiple !== 'undefined',
        isIE = /msie/i.test( navigator.userAgent );

        $.fn.pxl_custom_type_file = function() {

            return this.each(function() {

            var $file = $(this).addClass('pxl-file-upload-hidden'),
            $wrap = $('<div class="pxl-file-upload-wrapper">'),
            $button = $('<button type="button" class="pxl-file-upload-button">Choose File</button>'),
            $input = $('<input type="text" class="pxl-file-upload-input" placeholder="No File Choose" />'),
            $label = $('<label class="pxl-file-upload-button" for="'+ $file[0].id +'">Choose File</label>');
            $file.css({
                position: 'absolute',
                opacity: '0',
                visibility: 'hidden'
            });

            $wrap.insertAfter( $file )
            .append( $file, $input, ( isIE ? $label : $button ) );

            $file.attr('tabIndex', -1);
            $button.attr('tabIndex', -1);

            $button.on('click', function () {
                $file.focus().click();
            });

            $file.change(function() {

            var files = [], fileArr, filename;

            if ( multipleSupport ) {
                fileArr = $file[0].files;
                for ( var i = 0, len = fileArr.length; i < len; i++ ) {
                files.push( fileArr[i].name );
                }
                filename = files.join(', ');
            } else {
                filename = $file.val().split('\\').pop();
            }

            $input.val( filename )
                .attr('title', filename)
                .focus();
            });

            $input.on({
                blur: function() { $file.trigger('blur'); },
                keydown: function( e ) {
                if ( e.which === 13 ) {
                    if ( !isIE ) { 
                        $file.trigger('click'); 
                    }
                } else if ( e.which === 8 || e.which === 46 ) {
                    $file.replaceWith( $file = $file.clone( true ) );
                    $file.trigger('change');
                    $input.val('');
                } else if ( e.which === 9 ){
                    return;
                } else {
                        return false;
                    }
                }
            });

            });

        };
        $('.wpcf7-file[type=file]').pxl_custom_type_file();
    }

    function onClickCallActionAnchor() {  
        let anchorButtons = $('.pxl-atc-anchor');
        if (!anchorButtons.length) return
        $(anchorButtons).on('click', function(e) {
            e.preventDefault(); 
            let target = $(this).attr('href'); 
            let offset = parseInt($(this).attr('data-target-offset'));
            if ($(target).length) { 
                $('html, body').animate({
                    scrollTop: $(target).offset().top + offset
                }, 1000); 
            } 
        });
    }

    function onClickBackToTop() {  
        let backToTopBtn = $('.back-to-top-button');
        if (!backToTopBtn.length) return
        $(backToTopBtn).on('click', function(e) {
            e.preventDefault(); 
            $('html, body').animate({
                scrollTop: 0,
            }, 1000); 
        });
    }

    function onSubmitForm() {  
        $(document).on('wpcf7submit', function(event) {
            
        });
    }

    function initPXLCarousel() {
        $(document.body).on('click', '.pxl-carousel .navigation__button', function(e) {
            e.preventDefault();

            let $btn = $(this);
            let $carousel = $btn.closest('.pxl-carousel');
            let $carouselItems = $carousel.find('.pxl-carousel__item');
            let currentIndex = $carouselItems.index($carousel.find('.pxl-carousel__item.is-active'));

            if ($btn.hasClass('navigation-button__next')) {
                let nextIndex = currentIndex + 1;
                $carouselItems.eq(currentIndex).removeClass('is-active');
                if (nextIndex >= $carouselItems.length) {
                    nextIndex = 0;
                }
                $carouselItems.eq(nextIndex).addClass('is-active');
            } else {
                let previousIndex = currentIndex - 1;
                $carouselItems.eq(currentIndex).removeClass('is-active');
                if (previousIndex < 0) {
                    previousIndex = $carouselItems.length - 1;
                }
                $carouselItems.eq(previousIndex).addClass('is-active');
            }
        });
    }
    
    function toggleMenu() {
        let els = $('.pxl-vertical-menu > li > a');
        if (!els.length) return;
        $('.pxl-vertical-menu .sub-menu').animate({ height: 0 }, 0);
        $(els).on('click', function (e) {
            e.preventDefault(); 
            let submenu = $(this).siblings('.sub-menu').first();
            if (submenu.length) {
                if (submenu.hasClass('active')) {
                    submenu.removeClass('active').animate({ height: 0 }, 300);
                } else {
                    submenu.addClass('active').css('height', 'auto');
                    let height = submenu.outerHeight(); 
                    submenu.css('height', 0);
                    submenu.animate({ height: height }, 300);
                }
            }
        });
    }
    
    function toggleDrawer() {
        let drawerTmp = null; 
        $(document.body).on('click', '.button--toggle', function(e) {
            e.preventDefault();
            const drawer = $(this).attr('href'); 

            if (drawer && drawer.startsWith('#') && $(drawer).length) {
                $(drawer).addClass('active');
                $('body').addClass('body-overflow');
                if($(drawer).is('#loss-password')) {
                    $('#customer_login').removeClass('active');
                }
                drawerTmp = drawer;
            } else if (drawer && drawer !== '#') {
                window.location.href = drawer;
            }
        });
        $(document.body).on('click', `.button--close, .pxl-template-overlay, .body-overlay`, function (e) {
            e.preventDefault();
            if(drawerTmp === null) return;
            $(drawerTmp).removeClass('active');
            $('body').removeClass('body-overflow');
        })
        const $cursor = $('.pxl-cursor--close');
        if ($cursor.length) {
            $(document.body).on('mousemove mouseleave', '.body-overlay', e => {
                if (e.type === 'mousemove') {
                    $cursor.css({
                        transform: `translate(${e.clientX}px, ${e.clientY}px)`,
                        opacity: 1
                    });
                } else if (e.type === 'mouseleave') {
                    $cursor.css({ opacity: 0 });
                }
            });
        }
    }

    function updateTranslateZToParentHeight() {
        const els = $('.hover-3d-cube-flip');
        if(!els.length) return;
        els.each(function() {
            const height = $(this).height();
            $(this).css({'--pxl-translate-z': `${height / 2}px`})
        })
    }

    function komesticSmoothScroll() {
        if(!$('#smooth-content').length || !$('#smooth-wrapper').length || pxl_window_width < 768 ) return
        window.smoother = ScrollSmoother.create({
            wrapper: "#smooth-wrapper",
            content: "#smooth-content",
            smooth: 3.5,
            normalizeScroll: true,
            ignoreMobileResize: true,
            effects: true,
            smoothTouch: 3.5,
            speed: 1,
        });
    }

    function onMouseenterActive() {
        let elements = $('.pxl-pricing');
        if(!elements) return;
        $(elements).on('mouseenter', function () {
            $(elements).removeClass('active');
            $(this).addClass('active');
        })
    }

    function customCss() {
        // if($('.swiper-boxshadow').length) {
        //     const elements = $('.swiper-boxshadow');
        //     elements.parent('.elementor-widget-container').css({'pointer-events': 'none'})
        //     elements.find('.swiper-wrapper').css({'pointer-events': 'auto'})
        // }
        
    }

    function initCounter() {
		gsap.registerPlugin(ScrollTrigger);
		let $elements = $('.number-value.counter');
		if (!$elements.length) return;
		$elements.each(function () {
			let $el = $(this);
			let delimiter = $el.attr('data-delimiter') || '';
			let rawText = $.trim($el.text());
			let numberOnly = rawText.replace(/[^0-9.,]/g, '');
			let normalized = numberOnly.replace(/,/g, '.');
			let targetValue = parseFloat(normalized);
			let decimalPlace = countDecimals(targetValue);
			if (isNaN(targetValue)) {
				console.warn('Counter: Invalid number format in');
				return;
			}
			gsap.fromTo(
				this,
				{ innerText: 0 },
				{
					innerText: targetValue,
					duration: 1.2,
					scrollTrigger: {
						trigger: $el[0],
						start: 'top 95%',
						toggleActions: 'play reset play reset'
					},
					snap: { innerText: 1 },
					onUpdate: function () {
						let raw = $el[0].innerText.replace(/[^0-9.,]/g, '');
						let normalized = raw.replace(/,/g, '.');
						let current = parseFloat(normalized);
						if (!isNaN(current)) {
							$el[0].innerText = formatNumber(current, decimalPlace, delimiter);
						}
					}
				}
			);
		});

		function countDecimals(val) {
			if (Math.floor(val) === val) return 0;
			let parts = val.toString().split('.');
			return parts[1] ? parts[1].length : 0;
		}

		function formatNumber(value, decimals, delimiter) {
			if (delimiter === '') return parseFloat(value).toFixed(decimals);

			let locale = 'en-US';
			let options = {
				minimumFractionDigits: decimals,
				maximumFractionDigits: decimals,
				useGrouping: true
			};

			if (delimiter === '.') {
				locale = 'de-DE'; // 1.234,56
			} else if (delimiter === ' ') {
				locale = 'fr-FR'; // 1 234,56
			}

			return new Intl.NumberFormat(locale, options).format(value);
		}
	}

    function ajaxPaginationProductCategories() {
        const $elements = $('.pxl-product-categories');
        if ($elements.length === 0) return;

        $elements.on('click', function(e) {
            const $element = $(this);
            const $targetPagination = $(e.target).closest('.pagination .pagination__inner.ajax a');
            const $targetLoadMore = $(e.target).closest('.load-more .load-more__inner > button');

            if (!$targetPagination.length && !$targetLoadMore.length) return;

            const $inner = $element.find('.grid__inner');
            const maxPages = parseInt($element.data('max-pages')) || 1;
            const rawSettings = $element.attr('data-settings') || '{}';
            const settings = rawSettings ? JSON.parse(rawSettings) : {};
            const wpnonce = komestic_ajax_object.wpnonce;
            const ajaxUrl = komestic_ajax_object.ajax_url;

            let page = 1;
            let $targetWrap = null;

            if ($targetPagination.length) {
                e.preventDefault();
                AppUtils.showButtonLoading($targetPagination);
                $targetWrap = $element.find('.pagination');
                const href = $targetPagination.attr('href') || '#1';
                page = href.replace('#', '') || 1;


            }

            if ($targetLoadMore.length) {
                AppUtils.showButtonLoading($targetLoadMore);
                page += 1;
            }

            settings.paged = parseInt(page);

            $.ajax({
                url: ajaxUrl,
                type: 'POST',
                dataType: 'json',
                data: {
                    action: 'load_product_categories_callback',
                    page: page,
                    settings: JSON.stringify(settings),
                    wpnonce: wpnonce
                },
                success: function(data) {
                    let html = data.html;
                    if ($inner.length) {
                        if (settings['event'] === 'loadmore') {
                            $inner.append(html);
                            return;
                        }
                        $inner.html(html);
                        $targetWrap.html(data.pagination_html);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Ajax Error:', error);
                },
                complete: function() {
                    let $loader = null;

                    if (settings['event'] === 'loadmore') {                        
                        if (page >= maxPages) {
                            $targetWrap.remove();
                        }
                        AppUtils.hideButtonLoading($targetLoadMore);
                        return;
                    }
                    AppUtils.hideButtonLoading($targetPagination);
                }
            });
        });
    }
})(jQuery);