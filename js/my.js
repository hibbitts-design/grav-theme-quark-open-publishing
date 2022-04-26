$(document).ready(function () {
    $("a.newwindow").attr("target", "_blank");
    $("a.topwindow").attr("target", "_top");

    $('a[target="_blank"]').addClass("external-link");
    $('a[target="_top"]').addClass("external-link");

    $('#body-wrapper').on('click', 'a:not(.external-link, [href^="#"], [class^="glightbox"])', function (e) {
        if (($(this).attr('rel') != 'lightbox') && ($(this).attr('href') != null)) {
            e.preventDefault();
            var url = window.location.href;
            var newurl = $(this).attr('href');

            if (url.indexOf("chromeless:true") >= 0) {
                newurl = newurl + "/chromeless:true";
            }

            if (url.indexOf("embedded:true") >= 0) {
                newurl = newurl + "/embedded:true";
            }

            if (url.indexOf("standalone:true") >= 0) {
                newurl = newurl + "/standalone:true";
            }

            if (url.indexOf("hidepagetitle:true") >= 0) {
                newurl = newurl + "/hidepagetitle:true";
            }

            if (e.ctrlKey || e.metakey) {
              window.open(newurl,'_blank');
            } else {
              window.location.href = newurl;
            }
        }
    });
});
