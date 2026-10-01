;(function () {
    "use strict";
    function loadProductCategories() {
        const elements = document.getElementsByClassName('pxl-product-categories');
        if(elements.length === 0) return;
        Array.from(elements).forEach(element => {  
            element.addEventListener('click', function(e) {
                const targetPagination = e.target.closest('.pagination .pagination__inner.ajax a');
                const targetLoadMore = e.target.closest('.load-more .load-more__inner > button');
                if(!targetPagination && !targetLoadMore) return;
                const inner = element.querySelector('.grid__inner');
                const maxPages = element.getAttribute('data-max-pages') || 1;
                const rawSettings = element.getAttribute('data-settings') || {};
                const settings = rawSettings ? JSON.parse(rawSettings) : {};
                const wpnonce = komestic_ajax_object.wpnonce;
                const ajaxUrl = komestic_ajax_object.ajax_url;
                let page = 1;
                let targetWrap = null;
                if(targetPagination) {
                    e.preventDefault();
                    if(targetPagination.classList.contains('button--loading')) 
                        return
                    targetPagination.classList.add('button');
                    targetWrap = element.querySelector('.pagination');
                    const href = targetPagination.getAttribute('href') || '#1';
                    page = href.replace('#', '') || 1;
                    targetPagination.classList.add('button--loading');
                }
                if(targetLoadMore) {
                    if(targetLoadMore.classList.contains('button--loading')) 
                        return;
                    page += 1;
                    targetWrap = element.querySelector('.load-more');
                    targetLoadMore.classList.add('button--loading');
                }
                
                settings.paged = parseInt(page);
                const formData = new FormData();
                formData.append('action', 'load_product_categories_callback');
                formData.append('page', page);
                formData.append('settings', JSON.stringify(settings));
                formData.append('wpnonce', wpnonce);
                fetch(ajaxUrl, {
                    method: 'POST',
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    let html = data.html;
                    if(inner) {
                        if(settings['event'] == 'loadmore') {
                            inner.insertAdjacentHTML('beforeend', html)
                            return
                        }
                        inner.innerHTML = html
                        targetWrap.innerHTML = data.pagination_html;
                    }
                })
                .catch(error => {
                    console.error('Ajax Erorr:', error)
                }) 
                .finally(() => {
                    let loader = null;
                    if(settings['event'] == 'loadmore') {
                        loader = targetLoadMore.querySelector('.button__loader');
                        loader.remove();
                        targetLoadMore.classList.remove('button--loading');
                        if(page >= maxPages) {
                            targetWrap.remove();
                        }
                        return
                    }
                
                    loader = targetPagination.querySelector('.button__loader')
                    loader.remove();
                    targetPagination.classList.remove('button--loading');
                })
            })
        })
    }

    document.addEventListener('DOMContentLoaded', function () {   
        loadProductCategories()     
    });
})();