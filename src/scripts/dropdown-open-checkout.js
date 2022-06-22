jQuery(document).ready(function ($) {
    var $toggleMenu = $(".toggleMenu");
    var $iconClose = $(".button-close ");
    var $toggleOnCurtainMenu = $(".toggle-on-curtain-menu");
    var $curtainDropdown = $(".curtain-menu");
    var $headerNavigationA = $("header nav a");

    function closeMegaMenu(obj){
        $toggleOnCurtainMenu.removeClass('hide');
        $curtainDropdown.addClass('hide');
        $iconClose.addClass('hide');
        $toggleMenu.removeAttr("style");

    }

    function closeCheckoutDropdown() {
        $curtainDropdown.stop().animate({
            opacity : '0'
        }, 300);
        $curtainDropdown.removeClass('show').addClass('hide');
        $toggleOnCurtainMenu.toggleClass('hide');
        $toggleMenu.removeAttr("style");
    }

    function openMegaMenu(obj, e){
        e.preventDefault();
        var $linkKey = obj.data('toggle');

        $curtainDropdown.each(function (i) {
            var $el = $(this);
            if($el.data('toggle') === $linkKey) {
                $el.toggleClass('hide');
            }
        });
        $toggleOnCurtainMenu.toggleClass('hide');
        $iconClose.toggleClass('hide');
        obj.css("color", "#3a957c");
    }

    function dropdownInit(){
        var wid = $(window).width();
        if(wid < 1025){
            $toggleMenu.on('click', function (e) {
                openMegaMenu($(this), e);
            });

            $iconClose.on('click', function () {
                closeMegaMenu();
            });

            //close the shopping cart menu when clicking outside of it
            $(document).click(function(event) {
                var $target = $(event.target);
                if(!$target.closest('#curtain-menu').length && !$target.closest('#toggleMenu').length) {
                    closeMegaMenu()
                }
            });
        } else if(wid > 1025) {
            $toggleMenu.mouseenter(function (e) {
                var $linkKey = $(this).data('toggle');
                $curtainDropdown.each(function (i) {
                    var $el = $(this);
                    if($el.data('toggle') === $linkKey) {
                        $el.removeClass('hide').addClass('show');
                        $el.stop().animate({
                            opacity : '1'
                        }, 200);
                    }
                });
            });

            $curtainDropdown.mouseleave(function () {
                closeCheckoutDropdown();
            });
        }
    }




    dropdownInit();

    $(window).on("resize" ,function(){
        dropdownInit();
    });
});
