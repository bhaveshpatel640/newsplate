
var download = function (ar) {
    var prevfun = function () {
    };
    ar.forEach(function (address) {
        var pp = prevfun;
        var fun = function () {
            var iframe = jQuery('<iframe style="visibility: collapse;"></iframe>');
            jQuery('body').append(iframe);
            var content = iframe[0].contentDocument;
            var form = '<form action="' + address + '" method="POST"></form>';
            content.write(form);
            jQuery(form).submit();
            setTimeout(function () {
                jQuery(document).one('mousemove', function () { //<--slightly hacky!
                    iframe.remove();
                    pp();
                });
            }, 2000);
        }
        prevfun = fun;
    });
    prevfun();
}


jQuery(document).ready(function ($) {
//    jQuery(document).on("click", ".dlv_download", function(e) {
//        e.preventDefault();
//        var dl1 = $(this).attr('data-download1');
//        var dl2 = $(this).attr('data-download2');
//        download([dl1, dl2]);
//    });

    jQuery(document).on("click", ".lv_demo", function (e) {
        e.preventDefault();
        var dl = $(this).attr('data-download');
        var redirect = jQuery(this).attr('href');
        var data = {
            action: 'dlv_counter',
        };
        var url = dlv_script.url;
        jQuery.post(url, data, function (response) {
            if (response) {
                //alert(response);
                // download([response]);         
                jQuery.fileDownload(response)
                        .done(function () {
                            setTimeout(function () {
                                location.href = redirect;
                            }, 6000);
                        })
                        .fail(function () {
                           setTimeout(function () {
                                location.href = redirect;
                            }, 6000);
                        });
            }
        });

    });
});

function validateEmail(email) {
    var reg = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return reg.test(email);
}
jQuery(document).ready(function () {
    jQuery("#send").click(function () {
        var emailval = jQuery("#email").val();
        var mailvalid = validateEmail(emailval);
        if (mailvalid == false) {
            jQuery("#email").addClass("error");
        }
        else if (mailvalid == true) {
            jQuery("#email").removeClass("error");
        }
    });

//To display contact form onclick of button
    jQuery("#popup").click(function () {
        jQuery("#abc").fadeIn();
        jQuery("#popupContact").empty();
        jQuery("#popupContact").fadeIn();
        jQuery("#popupContact").append(create_popup());
        var dl1 = $('#popup').attr('data-download1');
        jQuery("#download").val(dl1);
    });
    jQuery(document).on('click', '#close', function (event) {
        event.stopPropagation();
        jQuery("#abc").fadeOut();
        jQuery("#popupContact").fadeOut();
    });

//$("#email").focus(function(){
    jQuery(document).on('click', '#email', function (event) {
        event.stopPropagation();
        jQuery("#email").val("");
        jQuery("#email").css("color", "black");
    });
});
//===============================
jQuery(document).ready(function ($) {

    $(document).on('click', '#popup_submit', function (e)
    {
        e.preventDefault();
        var name = jQuery("#name").val();
        var email = jQuery("#email").val();
        var dl1 = $('#popup').attr('data-download1');
        var download = jQuery("#download").val();
        var url = dlv_script.url;

        var data = {
            action: 'dlv_ajax',
            name: name,
            email: email,
            download: download,
        };
        $.post(url, data, function (status)
        {
            if (status == 'Name Error') {
                jQuery("#name").css("border", "1px solid red");
            }
            else if (status == 'Email Error') {
                jQuery("#name").css("border", "1px solid #28393a");
                jQuery("#email").css("border", "1px solid red");
                jQuery("#email").val("please enter correct email");
                jQuery("#email").css("color", "red");
            }
            else if (status == 'success') {
                loading();
            }
            else {
                alert("Error in mail sending.");
            }
        });

    });
    //=========================================
    //jQuery(document).on('click', '.link', function(e)
    //{
    //  e.preventDefault();
    //  window.location.href = jQuery(".link").attr('href');

    //});
});
//===============================
//for loading
function loading() {
    jQuery("#form").css('display', 'none');
    jQuery("#loading_submit").css("textAlign", "center");
    jQuery("#loading_submit").append("<br/><span style='font-size:16px; font-weight:bold;'>Please wait. Sending you email with your download.</span><br/><br/>");
    jQuery("#loading_submit").append(dl_script_content);
    jQuery("#loading_submit").css("fontSize", "11px");
    jQuery(".meter").show();
    jQuery(".meter > span").each(function () {
        jQuery(this)
                .data("origWidth", jQuery(this).width())
                .width(0)
                .animate({
                    width: jQuery(this).data("origWidth")
                }, 60000);
        setTimeout(function () {
            var name = jQuery("#name").val();
            var email = jQuery("#email").val();
            var download = jQuery("#download").val();
            var url = dlv_script.url;
            var data = {
                action: 'dlv_email_ajax',
                name: name,
                email: email,
                email_content: dl_email_content,
                prev_domain: dl_domain,
                download: download,
            };
            jQuery.post(url, data, function (response) {
                alert(response);
            });
            var subs_data = {
                subs_name: name,
                subs_email: email,
            };
            /**
             * mailget post
             */
            jQuery.post('http://www.formget.com/mailget/signups/subscribe/IjYxMiI_3D', subs_data, function (response)
            {
                if (response) {
                }

            });
        }, 60000);

    });
    setTimeout(function () {
        jQuery(".meter > span").fadeOut();
    }, 60000);
}