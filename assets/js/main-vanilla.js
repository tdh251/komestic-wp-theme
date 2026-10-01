
;(function ($) {
    "use strict";
    
    function blockLinkOnClick() {
        const elements = document.querySelectorAll('.post-navigation__button--empty');
        if(elements.length === 0) return;
        elements.forEach(element => {
            element.addEventListener('click', function (event) {  
                event.preventDefault(); 
                event.stopPropagation(); 
            })
        });
    }
    
    function onClickSubmitFormToID() {
        let currentButton = null;
        let form = null;
        const buttons = document.querySelectorAll('.pxl-button[data-action="submit"]');
        if (buttons.length === 0) 
            return;
        buttons.forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const formID = this.getAttribute('href');
                form = document.querySelector(formID);
                if (!form || form.tagName !== 'FORM' || this.classList.contains('button--loading')) {
                    return;
                }
                const submitInput = form.querySelector('input[type="submit"]');
                if (submitInput) {
                    submitInput.click();
                }
                form.querySelectorAll('input, textarea').forEach(input => {
                    input.readOnly = true;
                });
                currentButton = this;
                currentButton.classList.add('button--loading');
            });
        });
    
        document.addEventListener('wpcf7submit', function(event) {
            if (form) {
                form.querySelectorAll('input, textarea').forEach(input => {
                    input.readOnly = false;
                });
            }
            if (currentButton) {
                currentButton.classList.remove('button--loading');
                currentButton = null; 
            }
        });
    }
    

    document.addEventListener('DOMContentLoaded', function () {
        blockLinkOnClick()
        onClickSubmitFormToID()
    });
})();