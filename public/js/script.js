
jQuery(document).ready(function ($) {

    $("body").delegate("#mobileMenuBtn", "click", function () {
        if ($(this).hasClass("active")) {
            $(this).removeClass("active");
            $("#navWrap #navigation-container").removeClass("open");
        } else {
            $(this).addClass("active");
            $("#navWrap #navigation-container").addClass("open");
        }

    });




    //social link hover (rolls up on mouseover and mouseout. grabs the items height and uses that to determine movement.
    $(".scHdr").hover(function () {
        var h = $(this).height();
        $(this).stop().animate({backgroundPositionY: "-" + h + "px"}, 300);
    }, function () {
        var h = $(this).height();
        $(this).stop().animate({backgroundPositionY: "-" + (h * 2) + "px"}, 300, function () {
            $(this).css({backgroundPositionY: "0px"});
        });
    });

////////////////////////////////////////////////fade btns
    $('.fadeThis').append('<span class="hover"></span>').each(function () {
        var $span = $('> span.hover', this).css('opacity', 0);


        $(this).hover(function () {
            if ($(this).hasClass('inactive')) {
                //do nothing
            } else {
                $span.stop().fadeTo(300, 1);
            }
        }, function () {
            if ($(this).hasClass('active')) {
                //do nothing
            } else {
                $span.stop().fadeTo(300, 0);
            }
        });
    });


    ////////////////////////////////////////////////////////menu//////////////////////////
    $("ul#navUL li").hover(function () {
        $(this).find(".mBtn").css({backgroundPosition: "0px bottom"}).stop().animate({color: "#ba0605"});
        $(this).find(".subMenu").stop(true, true).slideDown(200);
    }, function () {
        $(this).find(".mBtn").css({backgroundPosition: "0px top"}).stop().animate({color: "#5a5a5b"});
        $(this).find(".subMenu").stop(true, true).slideUp(200);
    });

    $(".subMenu .menuContent a").hover(function () {
        $(this).stop().animate({paddingLeft: "5px", color: "#ba0605"});
    }, function () {
        $(this).stop().animate({paddingLeft: "0px", color: "#5a5a5b"});
    });

    /////////////////anchor slide
    $(".scroll").click(function (event) {
        //prevent the default action for the click event
        event.preventDefault();

        //get the full url - like mysitecom/index.htm#home
        var full_url = this.href;

        //split the url by # and get the anchor target name - home in mysitecom/index.htm#home
        var parts = full_url.split("#");
        var trgt = parts[1];

        //get the top offset of the target anchor
        var target_offset = $("#" + trgt).offset();
        var target_top = target_offset.top;

        //goto that anchor by setting the body scroll top to anchor top
        $('html, body').animate({scrollTop: target_top}, 500);
    });



});
(function ($) {
    var body = $('body'),
            _window = $(window),
            nav, button, menu;

    nav = $('#primary-navigation');
    button = nav.find('.menu-toggle');
    menu = nav.find('.nav-menu');





});

jQuery(document).ready(function ($) {

    $(".at-drop-down").hover(function () {
        $(this).find('ul').slideToggle('slow');
    });
    //$(window).resize(function(){

    //if ($(window).width() < 767) {  

    //jQuery('#navWrap .sub-menu').hide();

    //jQuery("#navWrap li:has(ul)").click(function(){

    //jQuery(" ul",this).toggle('slow');
    //});
    //}  
    //else{
    //}


    //});

    $(function () {
        jQuery('.page-scroll').bind('click', function (event) {
            var $anchor = $(this);
            jQuery('html, body').stop().animate({
                scrollTop: jQuery($anchor.attr('href')).offset().top
            }, 1500);
            event.preventDefault();
        });
    });

    $('.page-scroll').click(function () {
        var _attr = $(this).attr('href');
        if (_attr == "#sample-consumer-view") {
            $(_attr).css("display", "block");
            $(_attr).removeClass('hidden');
            $('#sample-web-integration').css("display", "none");
            $('#sample-web-integration').addClass("hidden");
        } else if (_attr == "#3-in-1") {
            $(_attr).addClass("show");
            $(_attr).removeClass("hidden");
            $("#pen").addClass('hidden');
            $("#charger").addClass('hidden');
            $("#dispenser").addClass('hidden');
            $("#swatch").addClass('hidden');
        } else if (_attr == "#pen") {
            $(_attr).addClass("show");
            $(_attr).removeClass("hidden");
            $("#3-in-1").addClass('hidden');
            $("#charger").addClass('hidden');
            $("#dispenser").addClass('hidden');
            $("#swatch").addClass('hidden');
        } else if (_attr == "#charger") {
            $(_attr).addClass("show");
            $(_attr).removeClass("hidden");
            $("#3-in-1").addClass('hidden');
            $("#pen").addClass('hidden');
            $("#dispenser").addClass('hidden');
            $("#swatch").addClass('hidden');
        } else if (_attr == "#dispenser") {
            $(_attr).addClass("show");
            $(_attr).removeClass("hidden");
            $("#3-in-1").addClass('hidden');
            $("#pen").addClass('hidden');
            $("#charger").addClass('hidden');
            $("#swatch").addClass('hidden');
        } else if (_attr == "#swatch") {
            $(_attr).addClass("show");
            $(_attr).removeClass("hidden");
            $("#3-in-1").addClass('hidden');
            $("#pen").addClass('hidden');
            $("#charger").addClass('hidden');
            $("#dispenser").addClass('hidden');
        }
        else {
            $(_attr).css("display", "block");
            $(_attr).removeClass('hidden');
            $('#sample-consumer-view').css("display", "none")
            $('#sample-consumer-view').addClass("hidden")
        }
    });
    $('.closeBtn').click(function () {
        var data_target = $(this).attr('data-target');
        if (typeof (data_target) != "undefined") {
            $('#' + data_target).addClass('hidden');
            $('#' + data_target).removeClass('show');
        } else {
            $(this).parent('div').css('display', 'none');
        }
    });



});
