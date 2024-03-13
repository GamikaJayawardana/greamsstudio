(function($) {
    "use strict";

    $(document).ready( function() {

        $(".popup-link").magnificPopup({
            type: 'image',
            fixedContentPos: false
        });

        $(".popup-gallery").magnificPopup({
            type: 'image',
            fixedContentPos: false,
            gallery: {
                enabled: true
            },
        });

        $(".popup-video, .popup-vimeo, .popup-gmaps").magnificPopup({
            type: "iframe",
            mainClass: "mfp-fade",
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false
        });
        
        $.scrollUp({
            scrollName: 'scrollUp', 
            topDistance: '1110',
            topSpeed: 2000, 
            animation: 'slide', 
            animationInSpeed: 300, 
            animationOutSpeed: 300, 
            scrollText: '<i class="fal fa-angle-up"></i>', 
            activeOverlay: false, 
        });

        $(window).scroll(function() {
            var Width = $(document).width();

            if ($("body").scrollTop() > 100 || $("html").scrollTop() > 100) {
                if (Width > 767) {
                    $("header").addClass("sticky");
                }
            } else {
                $("header").removeClass("sticky");
            }
        });

        new WOW().init();

        $('#hamburger').on('click', function() {            
            $('.mobile-nav').addClass('show');
            $('.overlay').addClass('active');
        });

        $('.close-nav').on('click', function() {            
            $('.mobile-nav').removeClass('show');            
            $('.overlay').removeClass('active');          
        });

        $(".overlay").on("click", function () {
            $(".mobile-nav").removeClass("show");
            $('.overlay').removeClass('active');
        });

        $("#mobile-menu").metisMenu();

        $('.search-btn').on('click', function() {            
            $('.search-box').toggleClass('show');
        });

        
    }); // end document ready function

    function loader() {
        $(window).on('load', function() {
            $(".preloader").addClass('loaded');                    
            $(".preloader").delay(500).fadeOut(); 
        });
    }
    loader();

})(jQuery); 
