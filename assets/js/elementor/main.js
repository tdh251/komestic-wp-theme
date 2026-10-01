( function( $ ) {
    "use strict";

    function containerElementAfterRender(){
        let _elementor = typeof elementor != 'undefined' ? elementor : elementorFrontend;
        _elementor.hooks.addFilter('pxl_element_container/after-render', function(ouput, settings) {
        });
    } 

    function containerElementBeforeRender(){
        let _elementor = typeof elementor != 'undefined' ? elementor : elementorFrontend;
        _elementor.hooks.addFilter( 'pxl_element_container/before-render', function( output, settings) {
            if(typeof settings.pxl_scrolling_effects != 'background-parallax' && settings.pxl_background_parallax !== 'undefined'){
                output += '<div class="pxl-background-parallax"></div>';
            }
            if (typeof settings.pxl_shapes != 'undefined' && settings.pxl_shapes.length > 0) {
                settings.pxl_shapes.forEach(function (item) {
                    let classes = 'pxl-shape '+ item.pxl_shape +' elementor-repeater-item-' + item._id;
                    output += `<div class="${classes}"></div>`;
                });
            }  
            return output;
        });
    } 

    function initCountdown() {
        let $countdowns = $('.countdown, .pxl-countdown');
        if (!$countdowns.length) return;

        function splitTime($el, num, unit) {
            let html = '';
            if (!$el.hasClass('split')) return '';
            num = (num < 10) ? '0' + num.toString() : num.toString();
            let digits = num.split('').map(Number);
            digits.forEach(n => {
                html += '<span class="value">' + n + '</span>';
            });
            if (unit !== '') {
                html += '<span class="unit">' + unit + '</span>';
            }
            return html;
        }

        $countdowns.each(function () {
            let $countdown = $(this);

            if ($countdown.data('countdown-inited')) return;
            $countdown.data('countdown-inited', true);

            let get_date_time = $countdown.data('time');
            if (get_date_time === undefined) return;

            let count_down_date = new Date(get_date_time).getTime();

            let $days = $countdown.find('.days');
            let $hours = $countdown.find('.hours');
            let $minutes = $countdown.find('.minutes');
            let $seconds = $countdown.find('.seconds');

            let day_unit = $days.data('unit') || '';
            let hour_unit = $hours.data('unit') || '';
            let minute_unit = $minutes.data('unit') || '';
            let second_unit = $seconds.data('unit') || '';

            let timer = setInterval(function () {
                let now = new Date().getTime();
                let distance = count_down_date - now;

                // Days
                if ($days.length) {
                    let days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    let dayHtml = splitTime($days, days, day_unit);
                    if (dayHtml === '') {
                        dayHtml = '<span class="value">' + days + '</span>';
                        if (day_unit !== '') {
                            dayHtml += '<span class="unit">' + day_unit + '</span>';
                        }
                    }
                    $days.html(dayHtml);
                }

                // Hours
                if ($hours.length) {
                    let hours = ($days.length)
                        ? Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))
                        : Math.floor(distance / (1000 * 60 * 60));
                    let hourHtml = splitTime($hours, hours, hour_unit);
                    if (hourHtml === '') {
                        hourHtml = '<span class="value">' + hours + '</span>';
                        if (hour_unit !== '') {
                            hourHtml += '<span class="unit">' + hour_unit + '</span>';
                        }
                    }
                    $hours.html(hourHtml);
                }

                // Minutes
                if ($minutes.length) {
                    let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    let minuteHtml = splitTime($minutes, minutes, minute_unit);
                    if (minuteHtml === '') {
                        minuteHtml = '<span class="value">' + minutes + '</span>';
                        if (minute_unit !== '') {
                            minuteHtml += '<span class="unit">' + minute_unit + '</span>';
                        }
                    }
                    $minutes.html(minuteHtml);
                }

                // Seconds
                if ($seconds.length) {
                    let seconds = Math.floor((distance % (1000 * 60)) / 1000);
                    let secondHtml = splitTime($seconds, seconds, second_unit);
                    if (secondHtml === '') {
                        secondHtml = '<span class="value">' + seconds + '</span>';
                        if (second_unit !== '') {
                            secondHtml += '<span class="unit">' + second_unit + '</span>';
                        }
                    }
                    $seconds.html(secondHtml);
                }

                // Expired
                if (distance < 0) {
                    clearInterval(timer);
                    $countdown.addClass('expired').html('<span class="value">EXPIRED</span>');
                }
            }, 1000);
        });
    }

    function initImageCompare() {
        const container = document.querySelector('.pxl-image-comparison');
        if (!container) return;

        const afterImage = container.querySelector('.images img.image-before');
        const slider = container.querySelector('.button--slider');

        let isDragging = false;

        slider.addEventListener('mousedown', (e) => {
            e.preventDefault();
            isDragging = true;
        });

        window.addEventListener('mouseup', () => {
            isDragging = false;
        });

        window.addEventListener('mousemove', (e) => {
            if (!isDragging) return;

            const rect = container.getBoundingClientRect();
            let x = e.clientX - rect.left;

            if (x < 0) x = 0;
            if (x > rect.width) x = rect.width;

            let percent = (x / rect.width) * 100;

            afterImage.style.clipPath = `inset(0 ${100 - percent}% 0 0)`;
            slider.style.left = `${percent}%`;
        });

        // Nút Before / After
        container.querySelector('.navigation__button--before').addEventListener('click', () => {
            afterImage.style.clipPath = `inset(0 0 0 0)`;
            slider.style.left = `100%`;
        });

        container.querySelector('.navigation__button--after').addEventListener('click', () => {
            afterImage.style.clipPath = `inset(0 0 0 100%)`;
            slider.style.left = `0%`;
        });
    }

    function hiddenProductAttributes() {  
        let $pas = $('.pa_terms');
        if(!$pas.length) return;
        $pas.each(function (i, pa) {  
            const $pa = $(pa);
            const attr = $pa.data('pa');
            let $variationsForm = $pa.closest('.product').find('.variations_form');
            let $attrs = $variationsForm.find('[data-attribute]');
            if($attrs.length === 1) {
                $variationsForm.parent().hide();
            }else {
                $variationsForm.find('[data-attribute="'+attr+'"]').hide();
            }
        })
    }

    $( window ).on( 'elementor/frontend/init', function() {
        containerElementAfterRender();
        containerElementBeforeRender();
        hiddenProductAttributes();
        initCountdown();
        elementorFrontend.hooks.addAction('frontend/element_ready/pxl_image_comparison.default', function() {
            initImageCompare();
        });
        
    });


} )( jQuery );