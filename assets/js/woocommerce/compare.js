;(function($) {
    'use strict'

    $(document.body).on('click', '.button--compare', function(e) {
        e.preventDefault();
        let $this = $(this);
        let $template = $($this.attr('href'));
        let $compare = $('#pxl-compare-list');
        if($this.hasClass('added')) {
            AppUtils.showPanel($template);
            AppUtils.hidePanel($template);
            $this.closest('.pxl-template').removeClass('active');
            return;
        }
        // $compare.empty();
        let product_id = $this.data('product_id');
        AppUtils.showButtonLoading($this);
        $.post(komestic_ajax.ajax_url, {
            action: 'komestic_ajax_add_to_compare',
            product_id: product_id,
            security: komestic_ajax.nonce,
        }, function(res) {
            if (res.success) {
                renderAjaxRes(res.data);
                $this.addClass('added');
                AppUtils.showPanel($template);
                $('#pxl-quick-view, #pxl-quick-add').closest('.pxl-template').removeClass('active');
            } else {
                console.log(res.data?.message || 'Error adding to compare');
            }
        }).always(function() {
            AppUtils.hideButtonLoading($this);
            AppUtils.hidePanel($template);
        });
    })

    $(document.body).on('click', '.remove-compare', function(e) {
        e.preventDefault();
        let $this = $(this);
        let $target = $($this.closest('#pxl-compare-list'));
        let product_id = $this.data('product_id');
        $this.closest('.product').addClass('pulse');
        $.post(komestic_ajax.ajax_url, {
            action: 'komestic_ajax_remove_from_compare',
            product_id: product_id,
            security: komestic_ajax.nonce,
        }, function(res) {
            if (res.success) {
                renderAjaxRes(res.data);
                $('.button--compare[data-product_id="'+product_id+'"]').removeClass('added');
            } else {
                console.log(res.data?.message || 'Error remove to compare');
            }
        })
    })

    $(document.body).on('click', '.clear-compare', function (e) {
        e.preventDefault();
        let $this = $(this);
        let $target = $this.closest('.pxl-template');
        $target.find('.product').addClass('pulse');
        AppUtils.showButtonLoading($this);
        $.post(komestic_ajax.ajax_url, {
            action: 'komestic_ajax_clear_compare',
            security: komestic_ajax.nonce,
        }, function(res) {
            if (res.success) {
                renderAjaxRes(res.data);
                $('.button--compare').removeClass('added');
            } else {
                console.log(res.data?.message || 'Error clear compare');
            }
        }).always(function() {
            AppUtils.hideButtonLoading($this);
        })
    })

})(jQuery)