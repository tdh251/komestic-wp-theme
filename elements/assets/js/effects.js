( function( $ ) {

    function hoverScaleSpotlight( $scope ) {
        let els = $scope.find('.hover-spotlight-scale');
        if(!els.length) return;
        const update = (e, isMouseenter) => {
            let item = $(e.currentTarget).find('.item-spotlight').first();
            if (isMouseenter && !item.length) {
                item = $('<span class="item-spotlight"></span>');
                $(e.currentTarget).prepend(item);
            }
            const { left, top, width, height } = e.currentTarget.getBoundingClientRect();
            const mouseX = e.clientX - left;
            const mouseY = e.clientY - top;
            const distToCorners = [
                Math.hypot(mouseX, mouseY), 
                Math.hypot(mouseX - width, mouseY), 
                Math.hypot(mouseX, mouseY - height),
                Math.hypot(mouseX - width, mouseY - height) 
            ];
            const maxRadius = Math.max(...distToCorners);
    
            gsap.to(item, {
                x: mouseX,
                y: mouseY,
                ease: "none",
                duration: 0.3,
                scale: isMouseenter ? (maxRadius / 10) + 0.2 : 0, 
            });
        };
        els.each(function(i, el) {
            $(el).on('mouseenter', (e) => update(e, true));
            $(el).on('mouseleave', (e) => update(e, false));
        })
    }
    
    function hoverTilt($scope) {
        const els = $scope.find(".hover-tilt");
        if(!els.length) return;
        const tilt = $(els).tilt({
            reverse: false,
            max: 10,
            speed: 250,
            perspective: 1000,
            transition: true,
            gyroscope: true,
            gyroscopeMinAngleX: -15,
            gyroscopeMaxAngleX: 15,
            gyroscopeMinAngleY: -15,
            gyroscopeMaxAngleY: 15,
            easing: "cubic-bezier(.03,.98,.52,.99)",    
        });

        tilt.on('change', function(e, transforms) {
            let tiltX = transforms.tiltX;
            let tiltY = transforms.tiltY;
            let tiltItems = $(this).find('.tilt-item');
            tiltItems.each(function() {
                let depth = 50;
                $(this).css({
                    'transform' : `translateZ(${depth}px) translateX(${tiltX * (depth / 50)}px) translateY(${tiltY * (depth / 50)}px)`,
                })
            }) 
        }); 
    }

    
    $( window ).on( 'elementor/frontend/init', function() {
    });
} )( jQuery );

