/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var $ = jQuery;
$(document).ready(function () {
   
    /**
     * Owl Slider on Homepage
     * Crausel slider
     * @type @call;$
     */
    var owl = $("#fslider");
    owl.owlCarousel({
        autoPlay: 3000, //Set AutoPlay to 3 seconds
        items: 4,
        itemsDesktop: [1190, 3],
        itemsDesktopSmall: [900, 3],
        itemsTablet: [600, 2], //2 items between 600 and 0
        itemsMobile: [390, 1] // itemsMobile disabled - inherit from itemsTablet option
    });
    // Custom Navigation Events
    $("#front_slider .next").click(function () {
        owl.trigger('owl.next');
    });
    $("#front_slider .prev").click(function () {
        owl.trigger('owl.prev');
    });

    /**
     * Video popup on home page
     */
    $("#home_video").colorbox({iframe: true, innerWidth: 640, innerHeight: 390});

    /**
     * Purchase button on extension page
     */
    $('#elm_form input').change(function () {
        $('input:checked').each(function () {
            $('#extension_purchase').attr('href', $(this).val());
        });
    });

    $('#extension_purchase').click(function (e) {
        e.preventDefault();
        if ($(this).attr('href') != '') {
            window.location.href = $(this).attr('href');
        } else {
            alert('Please check at least one subscription');
        }
    });
    /**
     * Faq button
     */
    $('#qaplus_searchsubmit').attr('class', 'fbtn green small');
    $('#qaplus_searchsubmit').css('border', '0');
    /**
     * Remove anchor from commnet url
     */
    $("#comment_list .url").each(function () {
        $(this).attr('href', '#');
        $(this).removeAttr("href");
        $(this).replaceWith(function () {
            return $("<b />").append($(this).contents());
        });
    });

});

$(window).resize(function () {
    var wi = $(window).width();
    fg_remove_xsclass(wi);
});
$(window).load(function () {
    var wi = $(window).width();
    fg_remove_xsclass(wi);
});

function fg_remove_xsclass(wi) {
    var elem = $('.element-list');
    if (wi <= 400) {
        elem.find(".col-xs-6").removeClass('col-xs-6');
    }
    if (wi > 400) {
        elem.find(".col-md-4,.col-md-3 ").addClass('col-xs-6');
    }
}

function moveUp($item) {
    $before = $item.prev();
    $item.insertBefore($before);
}

function moveDown($item) {
    $after = $item.next();
    $item.insertAfter($after);
}
/**
 * 
 * @param {type} param
 
 jQuery(document).ready(function () {
 var width = jQuery(window).width();
 if (width < 680) {
 var sidebar_banner = jQuery(".sidebar-banner").detach();
 sidebar_banner.appendTo('#content_wrapper .blog-content');
 }
 });
 */