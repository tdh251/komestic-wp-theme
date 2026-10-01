( function( $ ) {
    "use strict";
    $( window ).on( 'elementor/frontend/init', function() {
        const widgets = [ 'pxl_image_carousel', 'pxl_product_categories', 'pxl_products_suggested', 'pxl_product_cart', 'pxl_products', 'pxl_testimonial_carousel', 'pxl_posts', 'pxl_slider', 'pxl_promo_card_carousel', 'pxl_video_carousel'];
        widgets.forEach(widget => {               
            elementorFrontend.hooks.addAction( `frontend/element_ready/${widget}.default`, function ($scope) {  
                initCarousel($scope)
            });
        });
    });

    $(window).on('load', function() {
        if($('.related.products').length) {
            initCarousel($('.related.products'));
        }
    });

    const textAnimatedIn = (slide, delay = 0) => {
        const $texts = $(slide).find('.slide__title');
        if (!$texts.length) return;
        $texts.each(function (i, el) {
            let splitText;
            const $el = $(el);
            if(!$el.attr('class').includes('text')) {
                return;
            }
            if (!$el.hasClass('split-initialized')) {
                splitText = new SplitText(el, {
                    type: "lines, chars",
                    linesClass: 'pxl-line',
                    charsClass: 'pxl-char',
                    tag: 'div',
                });
                $el.addClass('split-initialized');
            } else {
                splitText = {
                    lines: $el.find('.pxl-line'),
                    chars: $el.find('.pxl-char')
                };
            }

            if ($el.hasClass('text1')) {
                gsap.set(splitText.chars, { scaleX: 0, opacity: 0 });
                gsap.to(splitText.chars, {
                    opacity: 1,
                    scaleX: 1,
                    ease: 'power2.out',
                    duration: 1,
                    stagger: 0.05,
                });
            } else if ($el.hasClass('text2')) {
                gsap.set(splitText.lines, { css: { overflow: 'hidden' } });
                gsap.set(splitText.chars, { y: '100%' });
                gsap.to(splitText.chars, {
                    y: 0,
                    duration: 1,
                    ease: 'power2.out',
                    stagger: 0.015,
                    delay: delay / 1000
                });
            } else if ($el.hasClass('text3')) {
                gsap.set(splitText.lines, { opacity: 0, x: 100 });
                gsap.to(splitText.lines, {
                    opacity: 1,
                    x: 0,
                    duration: 1,
                    ease: 'power2.out',
                    stagger: 0.15,
                    delay: delay / 1000
                });
            }

            $el.removeClass('visibility-hidden');
        });
    };

    function calcContainerHeight($slides) {  
        let sum = 0;
        $slides.each(function(i, slide) {
            let $slide = $(slide);
            if($slide.hasClass('swiper-slide-visible')) {
                const $childFirst = $slide.children().first();
                if($childFirst.length) {
                    sum += $childFirst.outerHeight();
                }
            }
        })
        if(sum <= 0) return;
        $slides.closest('.swiper-container').css('height', sum+'px');
    }

    function initCarousel($scope){
        let $swipers = $scope.find('.pxl-swiper, .pxl-slider'); 
        if (!$swipers.length) return; 
        $swipers.each(function () {
            let $this = $(this);
            let swiper;
            const classes = $this.attr('class');
            const container = $this.find('.swiper-container');
            if (!container.length) return;
            const params = $(container).data('swiper') || {};
            let navigation = {
                nextEl: $this.find('.swiper-button-next')[0],
                prevEl: $this.find('.swiper-button-prev')[0],
            }
            const navigationWrap = $this.find('.swiper-navigation').first();
            let alternativeNavigation = $(navigationWrap).data('navigation-id');
            if(alternativeNavigation !== '' && alternativeNavigation !== undefined) {
                navigation = {
                    nextEl: $('#'+alternativeNavigation).find('.swiper-button-next')[0],
                    prevEl: $('#'+alternativeNavigation).find('.swiper-button-prev')[0],
                }
            }
            const settings = {
                effect: params['effect'],
                fadeEffect: {
                    crossFade: params['effect'] == 'fade'
                },
                allowTouchMove: params['allow_touch_move'] ?? true,
                direction: params['direction'] ?? 'horizontal',
                loop: params['loop'],
                autoplay: (params['autoplay']) ? {
                    delay: params['delay'],
                    disableOnInteraction: params['disable_on_interaction']
                } : false,
                mousewheel: false,
                wrapperClass: 'swiper-wrapper',
                slideClass:'swiper-slide',
                slidesPerView: 'auto', 
                slidesPerGroup: 1,
                spaceBetween: params['space_between'] || 0, 
                watchSlidesProgress: true,
                watchSlidesVisibility: true,
                observer: true,
                observeParents: true,
                speed: params['speed'],
                pagination: (params['pagination'] !== '' && params['pagination'] !== 'none') ? {
                    el: $this.find('.swiper-pagination')[0],
                    clickable: true,
                    type: params['pagination']
                } : false,
                navigation: params['navigation'] == true ? navigation : false,
                parallax: false,
                centeredSlides: params['centered_slides'] ?? false,
                initialSlide: params['initial_slide'] ?? 0,
                breakpoints: {
                    0: {
                        slidesPerView: params['slides_per_view_xs'] ?? 1,
                    },
                    576: {
                        slidesPerView: params['slides_per_view_sm'] ?? 1,
                    },
                    768: {
                        slidesPerView: params['slides_per_view_md'] ?? 2,
                    },
                    992: {
                        slidesPerView: params['slides_per_view_lg'] ?? 2,
                    },
                    1200: {
                        slidesPerView: params['slides_per_view_xl'] ?? 3,
                        spaceBetween: params['space_between'] ? 
                                    (params['space_between'] > 30 ? 30 : params['space_between']) 
                                    : 0,
                    },
                    1400: {
                        slidesPerView: params['slides_per_view_xxl'] ?? 3,
                    },
                },
                on : {
                    init: function() {
                        const swiper = this;
                        const slides = swiper.slides;
                        const activeIndex = swiper.activeIndex;
                        const realIndex = swiper.realIndex;
                        let index = params['loop'] == true ? activeIndex : realIndex;
                        if(params['direction'] != undefined && params['direction'] == 'vertical') {
                            calcContainerHeight($(slides));
                        }
                        if(classes.includes('pxl-slider')) {
                            textAnimatedIn(slides[index], params['speed']);
                        }
                    },
                    slideChange: function() {
                        const swiper = this;
                        const slides = swiper.slides;
                        const activeIndex = swiper.activeIndex;
                        const realIndex = swiper.realIndex;
                        let index = params['loop'] == true ? activeIndex : realIndex;
                        if(classes.includes('pxl-slider')) {
                            $(slides[index]).find('.wow').addClass('animated');
                        }else {
                            $(slides).find('.wow').addClass('pxl-invisible').removeClass('animated');
                            $(slides).find('.wow.pxl-post-item').addClass('pxl-invisible').removeClass('animated');
                        }
                        if(classes.includes('pxl-testimonial-carousel') && ($this.data('layout') == '3' || $this.data('layout') == '5')) {
                            const $images = $this.find('.images img');
                            $images.removeClass('active');
                            $images.removeClass('prev');
                            $images.removeClass('next');
                            $($images[index]).addClass('active');
                            if(index == $images.length - 1 ) {
                                $($images[0]).addClass('next')
                            }else {
                                $($images[index + 1]).addClass('next')
                            }

                            if(index - 1 < 0 ) {
                                $($images[$images.length - 1]).addClass('prev')
                            }else {
                                $($images[index - 1]).addClass('prev')
                            }
                        }
                        if(classes.includes('pxl-slider') && ($this.data('layout') == '3')) {
                            let $images = $this.find('.images > img');
                            if($images.length) {
                                $images.removeClass('is-active');
                                $($images[index]).addClass('is-active');
                            }
                        }
                        if(classes.includes('pxl-slider')) {
                            textAnimatedIn(slides[index], params['speed']);
                        }
                    },
                }
            };
            if(!$this.hasClass('swiper-initialized')) {
                swiper = new Swiper(container[0], settings);
                $this.addClass('swiper-initialized');
            }
        });
    };
} )( jQuery );