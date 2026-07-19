/*=====================================================
Template Name   : WexNix 
Description     : School, College, University And Courses HTML5 Template
Author          : LunarTemp
Version         : 1.0
=======================================================*/


(function ($) {
    
    "use strict";

    // multi level dropdown menu
    $('.dropdown-menu a.dropdown-toggle').on('click', function (e) {
        if (!$(this).next().hasClass('show')) {
            $(this).parents('.dropdown-menu').first().find('.show').removeClass('show');
        }
        var $subMenu = $(this).next('.dropdown-menu');
        $subMenu.toggleClass('show');

        $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function (e) {
            $('.wexnix_dropdown-submenu .show').removeClass('show');
        });
        return false;
    });


    // data-background    
    $(document).on('ready', function () {
        $("[data-background]").each(function () {
            $(this).css("background-image", "url(" + $(this).attr("data-background") + ")");
        });
    });


    // navbar Search
    if ($('.wexnix_search-box-outer').length) {
        $('.wexnix_search-box-outer').on('click', function () {
            $('body').addClass('wexnix_search-active');
        });
        $('.wexnix_close-search').on('click', function () {
            $('body').removeClass('wexnix_search-active');
        });
    }


    // wow init
    new WOW().init();


    // hero slider
    $('.wexnix_hero-slider').owlCarousel({
        loop: true,
        nav: true,
        dots: false,
        margin: 0,
        autoplay: true,
        autoplayHoverPause: true,
        autoplayTimeout: 5000,
        items: 1,
        navText: [
            "<i class='fas fa-long-arrow-left'></i>",
            "<i class='fas fa-long-arrow-right'></i>"
        ],

        onInitialized: function(event) {
        var $firstAnimatingElements = $('.owl-item').eq(event.item.index).find("[data-animation]");
        doAnimations($firstAnimatingElements);
        },

        onChanged: function(event){
        var $firstAnimatingElements = $('.owl-item').eq(event.item.index).find("[data-animation]");
        doAnimations($firstAnimatingElements);
        }
    });

    //hero slider do animations
    function doAnimations(elements) {
		var animationEndEvents = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
		elements.each(function () {
			var $this = $(this);
			var $animationDelay = $this.data('delay');
			var $animationDuration = $this.data('duration');
			var $animationType = 'animated ' + $this.data('animation');
			$this.css({
				'animation-delay': $animationDelay,
				'-webkit-animation-delay': $animationDelay,
                'animation-duration': $animationDuration,
                '-webkit-animation-duration': $animationDuration,
			});
			$this.addClass($animationType).one(animationEndEvents, function () {
				$this.removeClass($animationType);
			});
		});
	}


    // testimonial-slider
    $('.wexnix_testimonial-slider').owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        dots: true,
        autoplay: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 4
            }
        }
    });


    // event-slider
    $('.wexnix_event-slider').owlCarousel({
        loop: true,
        margin: 25,
        nav: true,
        dots: true,
        autoplay: false,
        navText: [
            "<i class='fas fa-angle-left'></i>",
            "<i class='fas fa-angle-right'></i>"
        ],
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 3
            }
        }
    });


    // department-slider
    $('.wexnix_department-slider').owlCarousel({
        loop: true,
        margin: 25,
        nav: true,
        dots: true,
        autoplay: false,
        navText: [
            "<i class='fas fa-angle-left'></i>",
            "<i class='fas fa-angle-right'></i>"
        ],
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 4
            }
        }
    });


    // partner-slider
    $('.wexnix_partner-slider').owlCarousel({
        loop: true,
        margin: 70,
        nav: false,
        dots: false,
        autoplay: true,
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 3
            },
            1000: {
                items: 6
            }
        }
    });


    // preloader
    $(window).on('load', function () {
        $(".wexnix_preloader").fadeOut("slow");
    });


    // fun fact counter
    $('.wexnix_counter').countTo();
    $('.wexnix_counter-box').appear(function () {
        $('.wexnix_counter').countTo();
    }, {
        accY: -100
    });


    // magnific popup init
    $(".wexnix_popup-gallery").magnificPopup({
        delegate: '.wexnix_popup-img',
        type: 'image',
        gallery: {
            enabled: true
        },
    });

    $(".wexnix_popup-youtube, .wexnix_popup-vimeo, .wexnix_popup-gmaps").magnificPopup({
        type: "iframe",
        mainClass: "mfp-fade",
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false
    });



    // scroll to top
    $(window).on('scroll',function () {
        if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
            $("#scroll-top").addClass('active');
        } else {
            $("#scroll-top").removeClass('active');
        }
    });

    $("#scroll-top").on('click', function () {
        $("html, body").animate({ scrollTop: 0 }, 1500);
        return false;
    });


    // navbar fixed top
    $(window).on('scroll', function () {
        if ($(this).scrollTop() > 50) {
            $('.navbar').addClass("fixed-top");
        } else {
            $('.navbar').removeClass("fixed-top");
        }
    });


    // project filter
    $(window).on('load', function () {
        if ($(".wexnix_filter-box").children().length > 0) {
            $(".wexnix_filter-box").isotope({
                itemSelector: '.wexnix_filter-item',
                masonry: {
                    columnWidth: 1
                },
            });

            $('.wexnix_filter-btn').on('click', 'li', function () {
                var filterValue = $(this).attr('data-filter');
                $(".wexnix_filter-box").isotope({ filter: filterValue });
            });

            $(".wexnix_filter-btn li").each(function () {
                $(this).on("click", function () {
                    $(this).siblings("li.active").removeClass("active");
                    $(this).addClass("active");
                });
            });
        }
    });


    // progress bar
    $(document).ready(function(){
        var progressBar = $('.progress');
        if(progressBar.length) {
        progressBar.each(function () {
            var Self = $(this);
            Self.appear(function () {
            var progressValue = Self.data('value');
            Self.find('.progress-bar').animate({
                width:progressValue+'%'           
            }, 1000);
            });
        })
        }
    });


    // countdown
    if ($('#countdown').length) {
        $('#countdown').countdown('2030/01/30', function (event) {
            $(this).html(event.strftime('' + '<div class="row">' + '<div class="col countdown-single">' + '<h2 class="mb-0">%-D</h2>' + '<h5 class="mb-0">Day%!d</h5>' + '</div>' + '<div class="col countdown-single">' + '<h2 class="mb-0">%H</h2>' + '<h5 class="mb-0">Hours</h5>' + '</div>' + '<div class="col countdown-single">' + '<h2 class="mb-0">%M</h2>' + '<h5 class="mb-0">Minutes</h5>' + '</div>' + '<div class="col countdown-single">' + '<h2 class="mb-0">%S</h2>' + '<h5 class="mb-0">Seconds</h5>' + '</div>' + '</div>'));
        });
    }


    // copywrite date
    let date = new Date().getFullYear();
    $("#date").html(date);


})(jQuery);










