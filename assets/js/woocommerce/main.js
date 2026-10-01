;(function($) {
    'use strict';

    let AjaxCart = {
        updateQuantityCartItem(product_id, quantity, $trigger) {
            $.ajax({
                type: 'POST',
                url: komestic_ajax.ajax_url,
                data: {
                    action: 'komestic_ajax_update_cart',
                    product_id: product_id,
                    quantity: quantity,
                    security: komestic_ajax.nonce
                },
                beforeSend : function() {
                    AppUtils.showLoading($trigger);
                },
                success: function(res) {
                    if(res.fragments) {
                        $.each(res.fragments, function(key, value) {
                            $(key).replaceWith(value);
                        });
                    }
                },
                complete: function() {
                    AppUtils.hideLoading($trigger);
                }
            });
        },
        toggleGiftPackage($trigger) {
            let isInput = $trigger.is('#gift_package');
            let product_id = isInput ? $trigger.val() : $('input[name="gift_package"]').val();
            $trigger = isInput ? $('body') : $trigger;
            if ($trigger.is('.is-loading, .button--loading')) return;
            $.ajax({
                type: 'POST',
                url: wc_add_to_cart_params.ajax_url,
                data: {
                    action: 'komestic_toggle_cart_gift_package',
                    product_id: product_id,
                },
                beforeSend: function() {
                    AppUtils.showLoading($trigger);
                },
                success: function(response) {
                    $trigger.closest('.cart-section').removeClass('active');
                    setTimeout(function() {
                        if (response && response.fragments) {
                            $.each(response.fragments, function(key, value) {
                                $(key).replaceWith(value);
                            });
                        }
                    }, 300);
                },
                complete: function() {
                    AppUtils.hideLoading($trigger, isInput);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('AJAX Error:', textStatus, errorThrown, jqXHR.responseText);
                }
            });
        },
        updateOrderNote($trigger, callback) {
            let $wrapper = $trigger.closest('.woocommerce-cart-form, .sidebar--shopping-cart');
            let note = $wrapper.find('textarea[name="note"]').val();
            if(!$trigger.hasClass('button-proceed-to-checkout')) {
                AppUtils.showLoading($trigger);
            }
            $.post(
                komestic_ajax.ajax_url,
                { 
                    action: 'komestic_update_order_note_to_section', 
                    note: note 
                },
                function(res) {
                    if($trigger.closest('.cart-section').length) {
                        $trigger.closest('.cart-section').removeClass('active');
                    }

                    if(res.success && res.data) {
                        $wrapper.find('textarea[name="note"]').val(res.data.note);
                    }
                    AppUtils.hideLoading($trigger);

                    if (typeof callback === "function") {
                        callback(); 
                    }
                }
            );
        },
        addToCartCustom() {
            $(document.body).on('click', '.single_mini_add_to_cart, .button--buy-now', function(e){
                e.preventDefault();
                let $this = $(this);
                if ($this.hasClass('disabled')) {
                    e.preventDefault();  
                    e.stopImmediatePropagation()
                    return false;
                }
                let product_id = $this.data('product_id');
                let quantity   = $this.data('quantity') || 1;
                AppUtils.showButtonLoading($this);
                $.ajax({
                    type: 'POST',
                    url: wc_add_to_cart_params.wc_ajax_url.toString().replace('%%endpoint%%', 'add_to_cart'),
                    data: {
                        product_id: product_id,
                        quantity: quantity
                    },
                    success: function(response){
                        if (response.error && response.product_url) {
                            window.location = response.product_url;
                        } else {
                            $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash]);
                            if ($this.is('.button--buy-now')) {
                                window.location.href = $this.data('url');
                            }
                        }
                    },
                    complete: function() {
                        AppUtils.hideButtonLoading($this);
                    }
                });
            });
        }
    }

    const AjaxShop = (function ($) {

        let isLoading = false;
        let debounceTimer = null;

        /* =======================
        * Loader
        * ======================= */
        function shopShowLoader() {
            AppUtils.showLoading($('body'));
            $('.woocommerce-pagination a').addClass('is-loading');
        }

        function shopHideLoader() {
            AppUtils.hideLoading($('body'));
            $('.woocommerce-pagination a').removeClass('is-loading');
        }

        /* =======================
        * Get current / target page
        * ======================= */
        function getPage($el) {

            if ($el && $el.hasClass('page-numbers')) {

                if ($el.hasClass('current')) {
                    return false;
                }

                let pageLink = $el.attr('href');
                let match = pageLink ? pageLink.match(/(?:\/page\/|[?&]paged=)(\d+)/) : null;
                return match ? parseInt(match[1], 10) : 1;
            }

            let $current = $('.woocommerce-pagination .page-numbers.current');
            let currentLink = $current.attr('href');
            let currentMatch = currentLink ? currentLink.match(/(?:\/page\/|[?&]paged=)(\d+)/) : null;

            return currentMatch ? parseInt(currentMatch[1], 10) : 1;
        }

        /* =======================
        * Build filter params
        * ======================= */
        function buildParams() {

            let params = {
                sort: $('#sort-filter').val() || '',
                product_cat: $('#product_cat').val() || '',
                stock_status: $('input[name="stock_status"]:checked').val() || '',
                product_brand: $('input[name="brand[]"]:checked').map(function () {
                    return $(this).val();
                }).get(),
                price_range: {
                    min: $('input[name="price_min"]').val() || '',
                    max: $('input[name="price_max"]').val() || ''
                },
                product_attrs: {}
            };

            $('input[name^="pa_"]:checked').each(function () {
                let taxonomy = $(this).attr('name').replace('[]', '');
                if (!params.product_attrs[taxonomy]) {
                    params.product_attrs[taxonomy] = [];
                }
                params.product_attrs[taxonomy].push($(this).val());
            });

            return params;
        }

        /* =======================
        * Main handler (DEBOUNCED)
        * ======================= */
        function handlerFilter(e) {

            e.preventDefault();

            clearTimeout(debounceTimer);

            debounceTimer = setTimeout(function () {

                if (isLoading) {
                    console.warn('Blocked duplicate request');
                    return;
                }

                let $this = $(e.currentTarget);
                let page = getPage($this);

                if (page === false) return;

                isLoading = true;

                shopShowLoader();

                $.ajax({
                    url: komestic_ajax.ajax_url,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        action: 'load_products_ajax',
                        security: komestic_ajax.nonce,
                        paged: page,
                        params: buildParams()
                    },

                    success: function (res) {

                        if (res && res.success) {

                            $('.shop-archive .products').html(res.data.products_html);
                            $('.woocommerce-pagination').html(res.data.pagination_html);
                            $('.woocommerce-result-key').html(res.data.keys_result_html);
                            $('.woocommerce-result-count').html(res.data.count_result_html);

                        } else {
                            console.error('AJAX response error', res);
                        }
                    },

                    error: function (jqXHR) {
                        console.error('AJAX Error:', jqXHR.status, jqXHR.statusText);
                    },

                    complete: function () {
                        isLoading = false;
                        shopHideLoader();
                        $('.sidebar--shop-filter').closest('.pxl-drawer.active').removeClass('active');
                        $('body').removeClass('body-overflow')
                    }
                });

            }, 300); 
        }

        /* =======================
        * Events
        * ======================= */
        function bindEvents() {

            // Pagination (mobile safe)
            $(document.body).on(
                'click',
                '.woocommerce-pagination a',
                handlerFilter
            );

            // Sort / checkbox / category select
            $(document.body).on(
                'change',
                '#sort-filter, .product-filter .filter-item.filter-item--checkbox, #product_cat',
                handlerFilter
            );

            // Category click
            $(document.body).on(
                'click',
                '.product-filter .filter-item--cat, .widget_product_categories .cat-item a, .product-categories .category-item a',
                function (e) {

                    e.preventDefault();

                    let $this = $(this);
                    let slug = $this.data('cat_slug') || '';

                    if ($this.closest('.cat-item').length) {
                        let url = $this.attr('href');
                        let path = new URL(url).pathname;
                        let parts = path.split('/').filter(Boolean);
                        slug = parts[parts.length - 1];
                    }

                    $('#product_cat').val(slug).trigger('change');
                    $('.product-filter .filter-item--cat').removeClass('checked');
                    $this.addClass('checked');
                }
            );

            // Price range debounce
            let priceTimer;
            $(document.body).on('price_range', function (e) {
                clearTimeout(priceTimer);
                priceTimer = setTimeout(function () {
                    handlerFilter.call(e.target, e);
                }, 500);
            });

            clearKey();
            removeKey();
        }

        /* =======================
        * Clear filters
        * ======================= */
        function clearKey() {

            $(document.body).on('click', '.button--clear-key', function () {

                $('#product_cat').val('');
                $('#sort-filter').val('');
                $('input[name="stock_status"]').prop('checked', false);
                $('input[name="brand[]"]').prop('checked', false);
                $('input[name="price_min"], input[name="price_max"]').val('');
                $('input[name^="pa_"]').prop('checked', false);

                handlerFilter.call(this, $.Event('click'));
            });
        }

        /* =======================
        * Remove single filter key
        * ======================= */
        function removeKey() {

            $(document.body).on('click', '.button--filter-key', function () {

                let key = $(this).data('key');
                let value = $(this).data('value');

                if (key === 'product_cat') {
                    $('#product_cat').val('').trigger('change');
                    return;
                }

                if (key === 'price_range') {

                    let $wrapper = $('.product-filter__section--price');
                    let minVal = $wrapper.find('.price-min').attr('min');
                    let maxVal = $wrapper.find('.price-max').attr('max');

                    $wrapper.find('.price-min').val(minVal);
                    $wrapper.find('.price-max').val(maxVal);

                    handlerFilter.call(this, $.Event('change'));
                    return;
                }

                let $input = $('input[name="' + key + '"][value="' + value + '"]');
                if ($input.length) {
                    $input.prop('checked', false).trigger('change');
                }
            });
        }

        return {
            init: function () {
                bindEvents();
            }
        };

    })(jQuery);


    const AjaxQuickView = (function($) {

        function handlerQuickView(e) {
            e.preventDefault();
            let $this = $(this);
            let productId = $this.data('product_id');
            let $target = $($this.attr('href'));
            let $quickView = $target.find('#pxl-quick-view')
            $quickView.empty();
            AppUtils.showButtonLoading($this);

            $.ajax({
                url: komestic_ajax.ajax_url,
                type: 'POST',
                data: {
                    action: 'komestic_ajax_quick_view',
                    product_id: productId,
                    security: komestic_ajax.nonce
                },
                success: function(res) {
                    if (!res.success) {
                        console.error(res.data?.message || 'No response');
                        return;
                    }

                    $quickView.html(res.data.html);
                    updateVariationsForm($target.find('form.variations_form'))
                    AppUtils.showPanel($target);
                },
                complete: function() {
                    AppUtils.hideButtonLoading($this);
                    AppUtils.hidePanel($target);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('AJAX Error:', textStatus, errorThrown);
                }
            });
        }

        function bindEvents() {
            $(document.body).on('click', '.button--quickview', handlerQuickView);
        }

        return {
            init: function () {
                bindEvents();
            }
        };
    })(jQuery);

    const AjaxQuickAdd = (function($) {
        function handlerQuickAdd(e) {
            e.preventDefault();
            let $this = $(this);
            let productId = $this.data('product_id');
            let $target = $($this.attr('href'));
            let $quickAdd = $('#pxl-quick-add');
            $quickAdd.empty();
            AppUtils.showButtonLoading($this);
            $.ajax({
                url: komestic_ajax.ajax_url,
                type: 'POST',
                data: {
                    action: 'komestic_ajax_quick_add',
                    product_id: productId,
                    security: komestic_ajax.nonce
                },
                success: function(res) {
                    if (!res.success) {
                        console.error(res.data?.message || 'No response');
                        return;
                    }
                    $quickAdd.html(res.data.html);
                    updateVariationsForm($target.find('form.variations_form'))
                    AppUtils.showPanel($target);
                },
                complete: function() {
                    AppUtils.hideButtonLoading($this);
                    AppUtils.hidePanel($target);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('AJAX Error:', textStatus, errorThrown);
                }
            });
        }

        function bindEvents() {
            $(document.body).on('click', '.button--quickadd', handlerQuickAdd);
        }
        return {
            init: function () {
                bindEvents();
            }
        };
    })(jQuery);

    const AjaxFilterProductCat = (function($) {
        function handlerFilterProductcat(e) {
            let $this = $(this);
            let $carousel = $this.closest('.e-parent').find('.pxl-swiper');
            if(!$carousel.length) {
                return;
            }
            $('.filter--carousel .filter__button').removeClass('is-active');
            $(this).addClass('is-active');
            let catSlug = $this.data('filter');
            let $wrapper = $carousel.find('.swiper-wrapper');
            let $container = $carousel.find('.swiper-container')
            $carousel.find('.product').addClass('pulse');
            $.ajax({
                url: komestic_ajax.ajax_url,
                type: 'POST',
                data: {
                    action: 'load_products_ajax',
                    params: {'product_cat' : catSlug},
                    paged: 1,
                    layout: 'carousel',
                    security: komestic_ajax.nonce
                },
                success: function(res) {
                    if (res.success) {
                        $wrapper.html(res.data.products_html);
                        $container.get(0).swiper.slideTo(0);
                    } else {
                        console.error(res.data.message);
                    }
                },
                complete: function() {
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('AJAX Error:', textStatus, errorThrown);
                }
            });
        }

        function bindEvents() {
            $(document.body).on('click', '.filter--carousel .filter__button', handlerFilterProductcat);
        }
        return {
            init: function () {
                bindEvents();
            }
        };
    })(jQuery);

    function updateVariationsForm($forms) {
        if(!$forms.length) return;
        
        $forms.each(function() {
            if (typeof $.fn.wc_variation_form === 'function') {
                $(this).wc_variation_form(); 
            }       
            $(this).trigger('wc_variation_form');
            $(this).find('.variations select').trigger('change');
        });
        $(document).trigger('wpcvs_init'); 
    }

    $(document).ajaxComplete(function(event, xhr, settings){
        if (settings.data && settings.data.indexOf('load_products_ajax') !== -1) {

            if (typeof $.fn.wc_variation_form === 'function') {
                if($('.variations_form').length) {
                    $('.variations_form').each(function() {
                        $(this).wc_variation_form();        
                        $(this).trigger('wc_variation_form');
                        $(this).find('.variations select').trigger('change');
                    });
                    $(document).trigger('wpcvs_init'); 
                }

            }
        }
    });

    function toggleDropdownWidget() {
        let widgets = document.getElementsByClassName('widget'); 
        widgets = Array.from(widgets); 
        if (widgets.length === 0) { 
            return;
        }
        widgets.forEach(widget => {
            const widgetTitle = widget.querySelector('.widget__title, .product-filter__section-header');
            const widgetContent = widget.querySelector('.widget__content, .product-filter__section-content');
            if(!widgetTitle || !widgetContent) return;
            const widgetContentHeight = widgetContent.scrollHeight;
            widgetContent.style.height = widgetContentHeight + 'px';
            widgetTitle.addEventListener('click', function (e) {
                e.preventDefault();
                widget.classList.toggle('is-close');
                 if (widget.classList.contains('is-close')) {
                    widgetContent.style.height = '0px';
                } else {
                    widgetContent.style.height = widgetContentHeight + 'px';
                }
            })
        });
    }
    
    function changeQuantityProduct() {
        $(document).on('click', '.quantity .icon-plus', function(e) {
            e.preventDefault();
            const $input = $(this).closest('.quantity').find('input.qty');
            $input[0].stepUp();
            $input.trigger('change');
        });

        $(document).on('click', '.quantity .icon-minus', function(e) {
            e.preventDefault();
            const $input = $(this).closest('.quantity').find('input.qty');
            if (parseInt($input.val()) > 1) {
                $input[0].stepDown();
                $input.trigger('change');
            }
        });

        $(document).on('change', '.quantity input.qty', function(e) {
            const $input = $(this);
            const val = Math.max(0, parseInt($input.val()) || 0);
            $input.val(val);
            
            const $quantityWrap = $input.closest('.quantity-wrap');
            $quantityWrap.find('.quantity-number').text(val);
            
            const $woobtThisProductQuantity = $('.woobt-summary').find('input[name="quantity"]');
            if($woobtThisProductQuantity.length) {
                $woobtThisProductQuantity.val(val);
            }
            
            const $btnAddToCart = $input.closest('.product').find('.button--add-to-cart');
            if ($btnAddToCart.length) {
                const $woobtAddToCart = $('.woobt-summary').find('.single_add_to_cart_button');
                $btnAddToCart.attr('data-quantity', val);
                const price = parseFloat($btnAddToCart.attr('data-price') || 0);
                const total = val * price;
                if($woobtAddToCart.length) {
                    $woobtAddToCart.attr('data-subtotal', total);
                }
                $btnAddToCart.find('> .button__text--price').html(wooFormatPrice(total));
            }
            const $btnBuyNow = $input.closest('.product').find('.button--buy-now');
            if($btnBuyNow.length) {
                $btnBuyNow.attr('data-quantity', val);
            }
            if($input.closest('[data-product_id]').length) {
                let $cartItem = $input.closest('[data-product_id]');
                let $trigger = $cartItem.hasClass('cart-table-item') ? $('body') : $('.sidebar--shopping-cart');
                let productId = $cartItem.data('product_id');
                AjaxCart.updateQuantityCartItem(productId, $input.val(), $trigger)
            }
        });
    }

    function toggleReviewForm() {
        const formReview = $('#review_form_wrapper');
        formReview.css('height', 0);
        $('.button--toggle-comment-form').on('click', function (e) {
            e.preventDefault();
            if (formReview.hasClass('is-open')) {
                formReview.removeClass('is-open').css('height', 0);
                formReview.find('.comment-form input, .comment-form textarea').val('')
                $('.button--toggle-comment-form').find('.button__text').text('Write A Review');
            } else {
                let formHeight = formReview.get(0).scrollHeight; 
                formReview.addClass('is-open').css('height', formHeight + 'px');
                $(this).find('.button__text').text('Cancel Review');
            }
        });
    }

    function updateCartOrderCheckout() {
        $(document.body).on('updated_checkout', function (e, data) {
            let shippingCost = $('input[name^="shipping_method"]:checked').data('cost');
            if (shippingCost) {
                $('.woocommerce-checkout-review-order-table')
                    .find('.pxl-shipping-cost')
                    .html(wooFormatPrice(shippingCost));
            }
        });
    }

    function triggerWooProductGallery() {
        $(document.body).on('click', '.flex-viewport', function () {
            const $trigger = $(this).parent('.woocommerce-product-gallery').find('.woocommerce-product-gallery__trigger');
            if($trigger) {
                $trigger.trigger('click');
            }
        });
    }

    function handlerClickProductButtonAction() {
        const btnLoaderHtml = `
            <span class="button__loader">
                <svg class="svg-loader" width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12.4999 2.32258C13.1413 2.32258 13.6612 1.80265 13.6612 1.16129C13.6612 0.519927 13.1413 0 12.4999 0C11.8586 0 11.3386 0.519927 11.3386 1.16129C11.3386 1.80265 11.8586 2.32258 12.4999 2.32258Z" fill="currentcolor"/>
                    <path d="M12.4999 24.0003C13.1413 24.0003 13.6612 23.4804 13.6612 22.839C13.6612 22.1977 13.1413 21.6777 12.4999 21.6777C11.8586 21.6777 11.3386 22.1977 11.3386 22.839C11.3386 23.4804 11.8586 24.0003 12.4999 24.0003Z" fill="currentcolor"/>
                    <path d="M7.08072 3.7552C7.72209 3.7552 8.24201 3.23527 8.24201 2.59391C8.24201 1.95254 7.72209 1.43262 7.08072 1.43262C6.43936 1.43262 5.91943 1.95254 5.91943 2.59391C5.91943 3.23527 6.43936 3.7552 7.08072 3.7552Z" fill="currentcolor"/>
                    <path d="M18.9258 20.8256C19.2355 21.3675 19.042 22.0643 18.5 22.4126C17.9581 22.7223 17.2613 22.5288 16.9129 21.9868C16.6033 21.4449 16.7968 20.7481 17.3387 20.3997C17.8807 20.0901 18.6162 20.2836 18.9258 20.8256Z" fill="currentcolor"/>
                    <path d="M3.6741 5.57427C4.21603 5.88395 4.40958 6.58072 4.09991 7.16137C3.79023 7.7033 3.09345 7.89685 2.51281 7.58718C1.97087 7.2775 1.77732 6.58072 2.087 6.00008C2.39668 5.41943 3.13216 5.26459 3.6741 5.57427Z" fill="currentcolor"/>
                    <path d="M22.4871 16.4124C23.029 16.7221 23.2226 17.4189 22.9129 17.9995C22.6032 18.5415 21.9064 18.735 21.3258 18.4253C20.7839 18.1157 20.5903 17.4189 20.9 16.8382C21.2097 16.2963 21.9064 16.1028 22.4871 16.4124Z" fill="currentcolor"/>
                    <path d="M1.66129 13.1614C2.30265 13.1614 2.82258 12.6415 2.82258 12.0002C2.82258 11.3588 2.30265 10.8389 1.66129 10.8389C1.01993 10.8389 0.5 11.3588 0.5 12.0002C0.5 12.6415 1.01993 13.1614 1.66129 13.1614Z" fill="currentcolor"/>
                    <path d="M23.3388 13.1614C23.9801 13.1614 24.5001 12.6415 24.5001 12.0002C24.5001 11.3588 23.9801 10.8389 23.3388 10.8389C22.6974 10.8389 22.1775 11.3588 22.1775 12.0002C22.1775 12.6415 22.6974 13.1614 23.3388 13.1614Z" fill="currentcolor"/>
                    <path d="M2.51291 16.4124C3.05485 16.1028 3.75162 16.2963 4.10001 16.8382C4.40969 17.3802 4.21614 18.077 3.67420 18.4253C3.13227 18.735 2.43549 18.5415 2.08711 17.9995C1.73872 17.4576 1.97098 16.7608 2.51291 16.4124Z" fill="currentcolor"/>
                    <path d="M21.3258 5.57455C21.8677 5.26487 22.5645 5.45842 22.9129 6.00036C23.2226 6.54229 23.029 7.23907 22.4871 7.58745C21.9452 7.89713 21.2484 7.70358 20.9 7.16165C20.5903 6.61971 20.7839 5.88423 21.3258 5.57455Z" fill="currentcolor"/>
                    <path d="M6.07431 20.8256C6.38398 20.2836 7.08076 20.0901 7.66140 20.3997C8.20334 20.7094 8.39689 21.4062 8.08721 21.9868C7.77753 22.5288 7.08076 22.7223 6.50011 22.4126C5.95818 22.0643 5.76463 21.3675 6.07431 20.8256Z" fill="currentcolor"/>
                    <path d="M16.9129 2.01305C17.2226 1.47112 17.9194 1.27757 18.5 1.58725C19.042 1.89692 19.2355 2.59370 18.9258 3.17434C18.6162 3.71628 17.9194 3.90983 17.3387 3.60015C16.7968 3.29047 16.6033 2.59370 16.9129 2.01305Z" fill="currentcolor"/>
                </svg>
            </span>`;
        $(document.body).on('click', '.woosw-btn, .woosc-btn, .add_to_cart_button', function(e) {
            e.preventDefault();
            let $btn = $(this);
            if(!$btn.find('.button__loader').length) {
                $btn.prepend(btnLoaderHtml);
                $btn.addClass('button--loading');
            }
        }) 
        $(document.body).on('click', '.archive-add-to-cart, .single_add_to_cart_button', function(e) {
            e.preventDefault();
            AppUtils.showButtonLoading($(this));
        })
    }

    function triggerSelectProductCat() {  
        $(document.body).on('change', 'select[name="product_cat"]', function () {
            let val = $(this).val(); 
            $('#wpcas_search_cats').val(val).trigger('change');
        });
        $(document.body).on('click touchstart', '.pxl-nice-select.product_cat', function(e) {
            let $this = $(this);
            let offset = $this.offset();
            let width = $this.outerWidth();
            let height = $this.outerHeight();
            $('.wpcas-area').removeClass('wpcas-position-01 wpcas-position-02 wpcas-position-03 wpcas-position-04 wpcas-position-05');
            $('#wpcas-area').
                css('top', offset.top + height).css('left', offset.left).
                css('width', width).css('max-width', width);
            $('body').addClass('wpcas-body-show wpcas-body-show-inline');
            $('.wpcas-area').addClass('wpcas-area-show wpcas-area-show-inline');
        })
    }

    function handlerCartSidebar() {
        let $cartSidebar = $('.sidebar--shopping-cart');
        if(!$cartSidebar.length) return;

        $cartSidebar.on('click', '.cart-actions .cart-actions__item', function(e) {
            e.preventDefault();
            let action = $(this).data('action');
            $cartSidebar.find('.cart-section--'+action).toggleClass('active');
        });

        $cartSidebar.on('click', '.cart-section .button-cancel', function (e) { 
            e.preventDefault();
            $(this).closest('.cart-section').removeClass('active');
        })

        $(document.body).on('added_to_cart', function (e) {  
            $('#pxl-quick-view, #pxl-quick-add').closest('.pxl-template').removeClass('active');
            $cartSidebar.addClass('active');
            AppUtils.hideButtonLoading($('.archive-add-to-cart.added'));
            $('body').addClass('body-overflow');
            $('#pxl-quick-view, #pxl-quick-add, .pxl-template').removeClass('actice');
            $(document.body).on('click', '.button--close, .body-overlay', function(e) {
                e.preventDefault();
                $cartSidebar.removeClass('active');
                $('body').removeClass('body-overflow');
            })
            console.log('Added')
        })
        ajaxCart();
    }

    function handlerCartPage() {
        // Add or remove gift wrap
        $(document.body).on('click', '.cart-section--add-gift-wrap .button-submit', function(e) {
            e.preventDefault();
            AjaxCart.toggleGiftPackage($(this));
        });
        $(document.body).on('change', '#gift_package', function() {
            AjaxCart.toggleGiftPackage($(this));
        });

        // Remove cart item
        $(document.body).on('click', '.remove_from_cart_button', function(e) {
            e.preventDefault();
            let $trigger = $(this).hasClass('remove-cart-item-sidebar') ? $('.sidebar--shopping-cart') :  $('body');
            AppUtils.showLoading($trigger); 
        })
        $(document.body).on('removed_from_cart', function (e, data) {  
            e.preventDefault();
            let $trigger = $(this).hasClass('remove-cart-item-sidebar') ? $('.sidebar--shopping-cart') :  $('body');
            AppUtils.hideLoading($trigger);
        })
        // Redirect if checked and update order note
        $(document.body).on('click', '.button-proceed-to-checkout', function(e) {
            e.preventDefault();
            let $this = $(this);
            let $argeeTermsAndConditions = $('#argee_terms_and_conditions');

            if ($argeeTermsAndConditions.prop('checked')) {
                AjaxCart.updateOrderNote($this, function() {
                    window.location.href = $this.attr('href');
                });
            } else {
                alert($argeeTermsAndConditions.attr('data-alert'));
            }
        });
        // Update order note 
        $(document.body).on('click', '.cart-section--note .button-submit', function(e) {
            e.preventDefault();
            let $this = $(this);
            AjaxCart.updateOrderNote($this)
        });

        //Add multiple products
        $(document.body).on('click', '.pxl-button[data-action="add_to_cart"]', function(e) {
            e.preventDefault();
            const $this = $(this);
            const $target = $($this.attr('href'));
            if(!$target.length) {
                return;
            }
            const $products = $target.find('.product');
            if (!$products.length) {
                return;
            }
            let product_ids = [];
            $products.each(function() {
                product_ids.push($(this).data('product_id'));
            });
            if (product_ids.length === 0) {
                return;
            }
            AppUtils.showButtonLoading($this);
            console.log(product_ids)
            $.ajax({
                url: wc_add_to_cart_params.ajax_url,
                type: 'POST',
                data: {
                    action: 'komestic_add_multiple_to_cart',
                    product_ids: product_ids,
                    security: komestic_ajax.nonce,
                },
                success: function(res) {
                    if (res.success && res.data.redirect) {
                        window.location.href = res.data.redirect;
                        return;
                    }
                    if (res.fragments) {
                        $.each(res.fragments, function(key, value) {
                            $(key).replaceWith(value);
                        });
                    }
                },
                complete: function() {
                    AppUtils.hideButtonLoading($this);
                }
            });
        });
    }

    function ajaxCart() {
        $(document.body).on('click', '.cart-section--shipping .button-submit', function(e) {
            e.preventDefault();

            let $form = $('form.woocommerce-shipping-calculator');
            if(!$form.length) return;

            let $btn = $(this);
            if ($btn.is('.is-loading, .button--loading')) {
                return;
            }
            AppUtils.showLoading($btn);

            $form.data('submit-btn', $btn);

            $form.trigger('submit');
        });
        $(document.body).on('submit', 'form.woocommerce-shipping-calculator', function(e){
            e.preventDefault();

            let $form = $(this);
            let $btn = $form.data('submit-btn'); 

            let data = {
                action: 'komestic_ajax_calc_fee_shipping',
                security: komestic_ajax.nonce,
                country: $form.find('#calc_shipping_country').val(),
                state: $form.find('#calc_shipping_state').val(),
                postcode: $form.find('#calc_shipping_postcode').val(),
                city: $form.find('#calc_shipping_city').val(),
            };

            $.post(komestic_ajax.ajax_url, data, function(res) {
                AppUtils.hideLoading($btn); 
                if(res.success && res.data) { 
                    $.each(res.data, function(selector, html){
                        $(selector).html(html);
                    });
                    $form.closest('.cart-section').removeClass('active');
                } else {
                    alert('An error occurred.');
                }
            });
        });
        
        $(document.body).on('click', '.ajax-cart-empty', function(e) {
            e.preventDefault();
            const $parent = $('#pxl-cart-sidebar');
            AppUtils.showLoading($parent);
            $.post(
                komestic_ajax.ajax_url,
                { 
                    action: 'komestic_ajax_empty_cart', 
                    security: komestic_ajax.nonce
                },
                function(res) {
                    if(res.fragments) {
                        $.each(res.fragments, function(key, value) {
                            $(key).replaceWith(value);
                        });
                    }
                    AppUtils.hideLoading($parent);
                }
            );
        })
    }

    function switcherCurrency() {
        const $element = $('.currency-switcher');
        if(!$element.length) return;

        const ajaxUpdateCurrency = (currency) => {
            $.post(
                komestic_ajax.ajax_url,
                { 
                    action: 'komestic_ajax_update_currency', 
                    currency: currency,
                    security: komestic_ajax.nonce
                },
                function(res) {
                    if(res.success) {
                        location.reload();
                        AppUtils.hideLoading($(document.body));
                    }
                }
            );
        }

        const options = $element.find('.option');
        const currentCurrencyCode = $element.find('.currency-selector .currency-code');
        const currentCurrencyFlag = $element.find('.currency-selector .pxl-flag-image');
        $element.on('click', '.option', function (e) {  
            e.preventDefault;
            const currency = $(this).attr('data-currency');
            const unit = $(this).attr('data-unit');
            const srcFlagImage = $(this).find('.pxl-flag-image').attr('src');
            $(options).removeClass('active');
            $(this).addClass('active');
            $(currentCurrencyCode).html(currency+'<span>'+unit+'</span>');
            $(currentCurrencyFlag).attr('src', srcFlagImage);
            AppUtils.showLoading($(document.body));
            ajaxUpdateCurrency(currency);
        })
    }
    
    function toggleAddressForm() {
        $(document.body).on('click', '.wc-address .button-edit', function(e) {
            e.preventDefault();
            let $trigger = $('form.address-form--'+$(this).data('action'));
            $('.address-form').removeClass('is-active');
            $trigger.addClass('is-active');
        })
    }

    function sliderRange() {
        $(document.body).on("input", ".form-control-slider-range .price-field input", function(e) {
            const $this   = $(this).closest('.form-control-slider-range');
            const $rangeInput = $this.find(".range-input input");
            const $priceInput = $this.find(".price-field input");
            const $range  = $this.find(".slider .progress");

            let minAttr = parseInt($rangeInput.eq(0).attr('min'));
            let maxAttr = parseInt($rangeInput.eq(1).attr('max'));
            let priceGap = 10;

            let minPrice = parseInt($priceInput.eq(0).val());
            let maxPrice = parseInt($priceInput.eq(1).val());

            if (maxPrice - minPrice >= priceGap && maxPrice <= maxAttr) {
                if ($(e.target).hasClass("price-min")) {
                    $rangeInput.eq(0).val(minPrice);
                    $range.css('left', ((minPrice - minAttr) / (maxAttr - minAttr)) * 100 + "%");
                } else {
                    $rangeInput.eq(1).val(maxPrice);
                    $range.css('right', 100 - ((maxPrice - minAttr) / (maxAttr - minAttr)) * 100 + "%");
                }
            }
            $(document.body).trigger("price_range");
        });

        $(document.body).on("input", ".form-control-slider-range .range-input input", function(e) {
            const $this   = $(this).closest('.form-control-slider-range');
            const $rangeInput = $this.find(".range-input input");
            const $priceInput = $this.find(".price-field input");
            const $range  = $this.find(".slider .progress");

            let minAttr = parseInt($rangeInput.eq(0).attr('min'));
            let maxAttr = parseInt($rangeInput.eq(1).attr('max'));
            let priceGap = 10;

            let minVal = parseInt($rangeInput.eq(0).val());
            let maxVal = parseInt($rangeInput.eq(1).val());

            if (maxVal - minVal < priceGap) {
                if ($(e.target).hasClass("price-min")) {
                    $rangeInput.eq(0).val(maxVal - priceGap);
                } else {
                    $rangeInput.eq(1).val(minVal + priceGap);
                }
            } else {
                if ($priceInput.length) {
                    $priceInput.eq(0).val(minVal);
                    $priceInput.eq(1).val(maxVal);
                }
                $range.css('left', ((minVal - minAttr) / (maxAttr - minAttr)) * 100 + "%");
                $range.css('right', 100 - ((maxVal - minAttr) / (maxAttr - minAttr)) * 100 + "%");
            }
            $(document.body).trigger("price_range");
        });

    }

    function toggleShopGrid() {
        $(document.body).on('click', '.button--shop-grid', function (e) {  
            e.preventDefault();
            $('.button--shop-grid').removeClass('button--active');
            $(this).addClass('button--active');
            const cols = $(this).data('columns');
            const $products = $('.shop-archive .products');
            if($products.length) {
                $products.removeClass('columns-1 columns-2 columns-3 columns-4 columns-5 columns-6');
                $products.addClass('columns-'+cols);
            }
        })
    }

    function comingSoon() {  
        $(document.body).on('click', '.button--login-facebook, .button--login-google', function(e) {
            e.preventDefault();
            alert('Coming Soon. Thanks!')
        })
    }

    $(document).ready(function () {  
        toggleDropdownWidget(); 
        changeQuantityProduct();
        toggleReviewForm();
        updateCartOrderCheckout();
        triggerWooProductGallery();
        handlerClickProductButtonAction()
        triggerSelectProductCat()
        handlerCartSidebar()
        handlerCartPage()
        switcherCurrency()
        toggleAddressForm()
        sliderRange()
        toggleShopGrid()
        AjaxShop.init()
        AjaxQuickView.init();
        AjaxQuickAdd.init();
        AjaxFilterProductCat.init()
        AjaxCart.addToCartCustom();
        comingSoon();
    })
})(jQuery);