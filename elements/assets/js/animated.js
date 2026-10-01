( function( $ ) {

    function textAnimated($scope) {
        const $elements = $scope.find('.text-animated');
        if (!$elements.length) return;

        const getSplitAttrs = (type) => {
            switch (type) {
                case 'words':
                    return { type: 'words', wordsClass: 'word', tag: 'div' };
                case 'chars':
                    return { type: 'words,chars', wordsClass: 'word', charsClass: 'char', tag: 'div' };
                default:
                    return { type: 'lines', linesClass: 'line', tag: 'div' };
            }
        };

        const getAnimateTarget = (splitText, type) => {
            if (!splitText) return [];
            if (type === 'chars') return splitText.chars || [];
            if (type === 'words') return splitText.words || [];
            return splitText.lines || [];
        };

        const baseGsapParams = {
            x: 0,
            y: 0,
            opacity: 1,
            rotation: 0,
            rotateX: 0,
            duration: 0.5,
            delay: 0,
            scale: 1,
            force3D: true,
            scrollTrigger: {
                start: "top 90%",
                end: "top 45%",
                toggleActions: "play none none none",
                scrub: false,
            },
        };

        const applyEffects = (el) => {
            const $el = $(el);
            const $text = $el.find('> .heading__title-text');
            const splitType = $el.data('split-text') || 'lines';
            const elClass = $el.attr('class');

            if (!$text.length) return;

            // reset SplitText nếu đã có
            if (el.splitTextInstance) {
                el.splitTextInstance.revert();
                el.splitTextInstance = null;
            }

            // tạo SplitText
            const splitText = new SplitText($text[0], getSplitAttrs(splitType));
            el.splitTextInstance = splitText;
            $el.addClass('text-splitted');

            const animateTarget = getAnimateTarget(splitText, splitType);
            if (!animateTarget.length) return;

            // tính stagger
            let stagger = 0.02;
            if (splitType === 'words') stagger *= 2;
            if (splitType === 'lines') stagger *= 4;

            // clone gsapParams
            const gsapParams = { ...baseGsapParams, stagger, scrollTrigger: { ...baseGsapParams.scrollTrigger, trigger: el } };

            // xử lý hiệu ứng theo class
            if (elClass.includes('text-fade-in')) {
                gsapParams.opacity = 0;
                if (elClass.includes('text-fade-in-right')) gsapParams.x = 30;
                else if (elClass.includes('text-fade-in-left')) gsapParams.x = -30;
                else if (elClass.includes('text-fade-in-up')) gsapParams.y = 30;
                else if (elClass.includes('text-fade-in-down')) gsapParams.y = -30;

            } else if (elClass.includes('text-explosion')) {
                gsapParams.x = () => gsap.utils.random(-1000, 1000);
                gsapParams.y = () => gsap.utils.random(-1000, 1000);
                gsapParams.rotation = () => gsap.utils.random(-90, 90);
                gsapParams.scale = () => gsap.utils.random(0.5, 1.5);
                gsapParams.opacity = 0;

            } else if (elClass.includes('text-zigzag-zoom')) {
                animateTarget.forEach((target, i) => {
                    gsap.from(target, {
                        scale: (i % 2 === 0) ? 0 : 2,
                        opacity: 0,
                        duration: 0.75,
                        scrollTrigger: {
                            trigger: el,
                            start: "top 95%",
                            end: "top 60%",
                            toggleActions: "play none none none",
                            scrub: false,
                            // markers: true,
                        }
                    });
                });
                return;

            } else if (elClass.includes('text-flip-x')) {
                gsap.set($el[0], { perspective: '50px' });
                gsapParams.rotateX = 90;
                gsapParams.opacity = 0;

            } else if (elClass.includes('text-flip-y')) {
                gsap.set($el[0], { perspective: '50px' });
                gsapParams.rotateY = 90;
                gsapParams.opacity = 0;

            } else if (elClass.includes('text-zoom-in')) {
                gsapParams.scale = 0;
            }

            if (elClass.includes('text-reveal')) {
                gsapParams.scrollTrigger.scrub = true;
            }

            // đảm bảo hiện text trước khi animate
            $el.css('visibility', 'visible');

            // chạy animation
            gsap.from(animateTarget, gsapParams);
        };

        // khởi tạo
        $elements.each((i, el) => applyEffects(el));

        // handle resize + rebuild
        let resizeTimeout;
        $(window).on('resize', () => {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(() => {
                $elements.each((i, el) => {
                    if (el.splitTextInstance) {
                        el.splitTextInstance.revert();
                        el.splitTextInstance = null;
                    }
                    $(el).removeClass('text-splitted');
                    applyEffects(el);
                });
            }, 300);
        });
    }


    $( window ).on( 'elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction( `frontend/element_ready/pxl_heading.default`, function( $scope ) {
            textAnimated($scope);
        });
        elementorFrontend.hooks.addAction( `frontend/element_ready/pxl_text_editor.default`, function( $scope ) {
            textAnimated($scope);
        });
    });

})( jQuery );
