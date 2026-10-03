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

            // carry forward ?embedded=true, ?chromeless=true or ?standalone=true (as in Helios) to internal links
            var params = new URLSearchParams(window.location.search);
            ["embedded", "chromeless", "standalone"].forEach(function (name) {
                var value = params.get(name);
                if (value && value !== "false" && value !== "0") {
                    var target = new URL(newurl, window.location.href);
                    if (target.origin === window.location.origin) {
                        target.searchParams.set(name, value);
                        newurl = target.pathname + target.search + target.hash;
                    }
                }
            });

            if (e.ctrlKey || e.metaKey) {
              window.open(newurl,'_blank');
            } else {
              window.location.href = newurl;
            }
        }
    });
});
