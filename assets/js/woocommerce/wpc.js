;(function($) {
    'use strict';

    function renderAttributeValueOnSelected() {
        $('.product-single-mini .variations_form .variation').each(function () {
            let $variation = $(this);
            let $el = $variation.find('.wpcvs-term.wpcvs-selected'); 
            let $label = $variation.find('.label');

            if ($label.length) {
                let textNode = $label.contents().get(0);
                if (textNode && textNode.nodeType === 3) {
                    let text = textNode.nodeValue.trim();
                    if (!text.endsWith(':')) {
                        textNode.nodeValue = text + ': ';
                    }
                }

                let $span = $label.find('.wpcvs-attribute-selected');
                if (!$span.length) {
                    $span = $('<span class="wpcvs-attribute-selected"></span>');
                    $label.append($span);
                }

                if ($el.length) {
                    $span.text($el.data('label'));
                } else {
                    $span.text('');
                }
            }
        });
    }

    $(document).on('wpcvs_init', renderAttributeValueOnSelected)

    $(document).on('wpcvs_selected', function(e, attr, term, title){
        let $attr = $('.product-single-mini .wpcvs-terms[data-attribute="'+attr+'"]');
        if($attr.length) {
            $attr.closest('.variation').find('.label .wpcvs-attribute-selected').html(title);
        }
    });
    // Variations
    $(document).on('wpcvs_single_reset_data wpcvs_archive_reset_data', function (event, e) {  
        let $target = $(e['target']);
        let $product = $target.closest(wpcvs_vars.single_product);
        let $name = $product.find('.summary .product-title');
        let $price = $product.find('.summary .product-price');
        let $btn_add_to_cart = $product.find('.summary .single_add_to_cart_button');
        let $stock = $product.find('.summary .product-stock');

        if ($name.length) {
            $name.html($name.data('o_name'));
        }

        if ($price.length) {
            $price.html($price.data('o_price'));
        }

        if($stock.length) {
            $stock.html($stock.data('o_stock'));
        }

        if($btn_add_to_cart.length) {
            const $total = $btn_add_to_cart.find('> .button__text--price');
            $total.html($total.data('o_total'))
            $btn_add_to_cart.attr('data-price', 0);
        }
    })
    
    $(document).on('wpcvs_single_found_variation wpcvs_archive_found_variation', function (event, e, t) { 
        let $target = $(e.target);
        let $product = $target.closest(wpcvs_vars.single_product);
        let $name = $product.data('$name') || $product.find('.summary .product-title');
        let $price = $product.data('$price') || $product.find('.summary .product-price');
        let $quantity = $product.data('$quantity') || $product.find('.summary input[name="quantity"]');
        let $btnAddToCart = $product.data('$btnAddToCart') || $product.find('.summary .single_add_to_cart_button, .summary .single_mini_add_to_cart');
        let $stock = $product.data('$stock') || $product.find('.summary .product-stock');
        let $btnCompare = $product.data('$btnCompare') || $product.find('.summary .button--compare');
        let $btnByNow = $product.data('$btnByNow') || $product.find('.summary .button--buy-now');
        $product.data({ $name, $price, $quantity, $btnAddToCart, $stock, $btnCompare, $btnByNow });

        const displayPrice = parseFloat(t.display_price) || 0;
        const quantity = parseInt($quantity.val()) || 0;
        const total = quantity * displayPrice;

        // Tên
        if ($name.length) {
            if (!$name.data('o_name')) $name.data('o_name', $name.html());
            $name.html(t.wpcvs_name || $name.data('o_name'));
        }

        // Giá
        if ($price.length) {
            if (!$price.data('o_price')) $price.data('o_price', $price.html());
            $price.html(t.price_html || $price.data('o_price'));
        }

        // Tồn kho
        if ($stock.length) {
            if (!$stock.data('o_stock')) $stock.data('o_stock', $stock.html());
            if (t.is_in_stock === false) {
                $stock.addClass('out-of-stock').find('> .product-label').html('Out Of Stock');
            } else {
                $stock.removeClass('out-of-stock').html($stock.data('o_stock'));
            }
        }

        // Add to Cart
        if ($btnAddToCart.length) {
            const $total = $btnAddToCart.find('> .button__text--price');
            if (!$total.data('o_total')) $total.data('o_total', $total.html());
            $total.html(wooFormatPrice(total > displayPrice ? total : displayPrice));
            $btnAddToCart.attr('data-price', displayPrice);
        }

        // let $woobtSelects = $product.find('.woobt-product select');
        // $woobtSelects.each(function () {
        //     if (!$(this).parent().hasClass('woobt-nice-select')) {
        //         $(this).niceSelect();
        //     }
        // });

        let $woobtThisSelect = $product.find('.woobt-product.woobt-product-this select');
        if ($woobtThisSelect.length) {
            $woobtThisSelect.val(t['variation_id']);
            $woobtThisSelect.niceSelect('update');
        }

        if ($btnByNow.length && t['variation_id'] !== '') {
            $btnByNow.attr('data-product_id', t['variation_id']);
            if (t['is_in_stock'] == false) {
                $btnByNow.addClass('disabled');
            } else {
                $btnByNow.removeClass('disabled');
            }
        }

    });

    $(document).on('wpcvs_archive_found_variation', function (event, e, t) { 
        let $target = $(e.target);
        let $product = $target.closest('.product');
        let $image = $product.find('.product__featured img, .product-image img');
        let $labelSale = $product.find('.product-label--onsale');
        let $btnAddToCart = $('.single_mini_add_to_cart');
        if (!$image.length || !$product.length) return;

        if ($image.data('o_src') == undefined) {
            $image.data('o_src', $image.attr('src'));
        }
        if ($image.data('o_srcset') == undefined) {
            $image.data('o_srcset', $image.attr('srcset'));
        }
        if ($image.data('o_sizes') == undefined) {
            $image.data('o_sizes', $image.attr('sizes'));
        }
        if (t['image']['wpcvs_src'] != undefined && t['image']['wpcvs_src'] !=
            '') {
            $image.attr('src', t['image']['wpcvs_src']);
        } else {
            $image.attr('src', $image.data('o_src'));
        }

        if (t['image']['wpcvs_srcset'] != undefined &&
            t['image']['wpcvs_srcset'] != '') {
            $image.attr('srcset', t['image']['wpcvs_srcset']);
        } else {
            $image.attr('srcset', $image.data('o_srcset'));
        }

        if (t['image']['wpcvs_sizes'] != undefined &&
            t['image']['wpcvs_sizes'] != '') {
            $image.attr('sizes', t['image']['wpcvs_sizes']);
        } else {
            $image.attr('sizes', $image.data('o_sizes'));
        }

        if(t['display_price'] < t['display_regular_price']) {
            let regular_price = t['display_regular_price']; 
            let sale_price    = t['display_price'];  

            let discount_amount = regular_price - sale_price;
            let percentage = parseInt((discount_amount / regular_price) * 10);
            if($labelSale.length) {
                $labelSale.show();
                $labelSale.html('-'+percentage+'%');
            }
        }else {
            $labelSale.hide()
        }

        if($btnAddToCart.length) {
            $btnAddToCart.attr('data-product_id', t['variation_id']);
            if(t['is_in_stock'] == false) {
                $btnAddToCart.addClass('disabled');
            }else {
                $btnAddToCart.removeClass('disabled');
            }
        }
        console.log(t)

    });

    /**
     * Bought Together
     */
    $(document).on('woobt_calc_price', function(event, total, total_ori, total_ori_regular, $wrap) {        
        let $totalAmount = $wrap.find('.price');
        let $btnTotalAmount = $wrap.find('.pxl-woobt-total');
        $btnTotalAmount.html(wooFormatPrice(total_ori));
        if(total_ori == total_ori_regular) {
            $totalAmount.html(wooFormatPrice(total_ori));
        }else {
            const priceHtml = `<span class="price--regular">${wooFormatPrice(total_ori)}</span><span class="price--old">${wooFormatPrice(total_ori_regular)}</span>`;
            $totalAmount.html(priceHtml)
        }
    })

    /**
     * Wishlist 
     */
    $(document.body).on('click', '.woosw-item--remove', function(e) {
        let $wooswItem = $(this).closest('.woosw-item');
        $wooswItem.addClass('pulse');
        $wooswItem.closest('.grid__item').attr('data-id', $wooswItem.data('id'));
    })
    $(document.body).on('woosw_remove', function(e, id) {
        $('.grid__item[data-id="'+id+'"]').remove();
        if($('.woosw-item').length === 0) {
            location.reload();
        }
    })
    $(document.body).on('woosw_add', function (e, id) {  
        let $woosw_btn = $('.woosw-btn[data-id="'+id+'"]');
        if($woosw_btn.length) {
            $woosw_btn.find('.button__loader').remove();
            $woosw_btn.removeClass('button--loading')
        }
    })
    $(document.body).on('woosw_change_count', function(e, count) {
        $('.pxl-wishlist-count').text(count)
    });
    $(document.body).on('woosw_empty', function(e, key) {

    });
    /**
     * Ajax Search 
     */
    $(document).off('click touch', 'input[type="search"]:not(#wpcas_search_keyword, #wpcsa_search_input, #woosc_search_input)')

    $(document).ready(function () {  

    })
})(jQuery);