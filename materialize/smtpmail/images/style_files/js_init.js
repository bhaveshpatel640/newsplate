jQuery.fn.outerHTML = function () {
    return jQuery('<div />').append(this.eq(0).clone()).html();
};
function formget_header_menu() {
    var $ = jQuery;
    var is_menu = $('#sub_menu').length;
    var list = $('#middle_header_container .header-logs ul').outerHTML();
    var width = $(window).width();
    if (width < 1020) {
        if (is_menu) {
            if ($('.mean-bar .mean-nav ul li:first-child ul').length < 1) {
                $('#sub_menu #menu ul').find('.formget-products').remove();
                var attach_menu = $('<li class="formget-products"><a href="#">Products</a></li>');
                $('#sub_menu #menu ul').prepend(attach_menu);
                $('#sub_menu #menu ul .formget-products').append(list);
            }

        } else {
            var menu_item = $('<div id="sub_menu" class="home_sub_menu"><div id="menu"></div></div>');
            menu_item.insertAfter("#middle_header_container");
            $('#sub_menu #menu').append(list);
        }
    } else {
        $('#sub_menu #menu').find('.formget-products').remove();
        if ($('#middle_header_container .header-logs ul').length < 1) {
            $('#middle_header_container .header-logs ul').append(list);
        }

        $('body').find('.home_sub_menu').remove();

    }
}
jQuery(document).ready(function () {
    formget_header_menu();
    /**
     * Responsive menu
     */
    jQuery('#menu').meanmenu({
        meanMenuClose: "X", // single character you want to represent the close menu button
        meanMenuCloseSize: "18px", // set font size of close button
        meanMenuOpen: "<span /><span /><span />", // text/markup you want when menu is closed
        meanRevealPosition: "right", // left right or center positions
        meanRevealPositionDistance: "0", // Tweak the position of the menu
        meanRevealColour: "", // override CSS colours for the reveal background
        meanRevealHoverColour: "", // override CSS colours for the reveal hover
        meanScreenWidth: "1030", // set the screen width you want meanmenu to kick in at
        meanNavPush: "", // set a height here in px, em or % if you want to budge your layout now the navigation is missing.
        meanShowChildren: true, // true to show children in the menu, false to hide them
        meanExpandableChildren: true, // true to allow expand/collapse children
        meanExpand: "+", // single character you want to represent the expand for ULs
        meanContract: "-", // single character you want to represent the contract for ULs
        meanRemoveAttrs: true // true to remove classes and IDs, false to keep them
    });
});
jQuery(window).resize(function () {
    formget_header_menu();
});
