(function ($) {
    "use strict";

    function scrollParallax() {
        const $els = $('[data-parallax]');
        if (!$els.length || $(window).width() <= 991) return;

        $els.each((i, el) => {
            const $el = $(el);
            const params = $el.data('parallax') || {};
            const elClass = $el.attr('class') || '';

            // tránh khởi tạo lại nhiều lần
            if ($el.hasClass('inited')) return;
            $el.addClass('inited');

            // lấy params
            const x = parseFloat(params.x) || 0;
            const y = parseFloat(params.y) || 0;
            const rotate = parseFloat(params.rotate) || 0;
            const scale = parseFloat(params.scale) || 1;

            // xử lý parent
            let parent = el;
            if (elClass.includes('pxl-background-parallax')) {
                parent = $el.closest('.e-con.elementor-element');
                parent.css({ overflow: 'hidden', position: 'relative' });

                // set vị trí ban đầu để background không lộ ra khoảng trống
                gsap.set(el, {
                    left: x > 0 ? -x : undefined,
                    right: x < 0 ? x : undefined,
                    top: y > 0 ? -y : undefined,
                    bottom: y < 0 ? y : undefined
                });
            }

            // tạo gsap parallax
            gsap.to(el, {
                x,
                y,
                rotate,
                scale,
                ease: "none",
                scrollTrigger: {
                    trigger: parent[0] || parent,
                    start: "top 95%",
                    end: "bottom 0%",
                    scrub: true,
                },
            });
        });
    }

    $(document).ready(function() {
        scrollParallax();
    })
})(jQuery);
