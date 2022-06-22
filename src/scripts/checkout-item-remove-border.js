jQuery(document).ready(function ($) {
    $('.list-item').hover(
        function () {
            $(this).prev().find('.item').css({
                'border-bottom-color': 'transparent'
            })
        },
        function () {
            $(this).prev().find('.item').removeAttr('style')
        })
});
