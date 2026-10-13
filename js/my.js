$(document).ready(function () {
    $("a.newwindow").attr("target", "_blank");
    $("a.topwindow").attr("target", "_top");

    $('a[target="_blank"]').addClass("external-link");
    $('a[target="_top"]').addClass("external-link");

    $('#body-wrapper').on('click', 'a:not(.external-link, [href^="#"], [class^="glightbox"])', function (e) {
        if (($(this).attr('rel') != 'lightbox') && ($(this).attr('href') != null)) {
            var target = new URL($(this).attr('href'), window.location.href);

            // only links to this site carry the display options forward (not other sites, mailto: or tel:)
            if (target.origin !== window.location.origin) {
                return;
            }

            e.preventDefault();
            var url = window.location.href;

            // carry forward /chromeless:true, /embedded:true, /standalone:true and /hidepagetitle:true,
            // added to the page path (before any ? or #), but not to links to files such as PDFs
            var lastPart = target.pathname.split("/").pop();
            var isFile = lastPart.indexOf(".") >= 0;
            if (!isFile) {
                ["chromeless", "embedded", "standalone", "hidepagetitle"].forEach(function (name) {
                    var param = name + ":true";
                    if (url.indexOf(param) >= 0 && target.pathname.indexOf(param) < 0) {
                        if (target.pathname.slice(-1) !== "/") {
                            target.pathname = target.pathname + "/";
                        }
                        target.pathname = target.pathname + param;
                    }
                });
            }

            // carry forward ?embedded=true, ?chromeless=true or ?standalone=true (as in Helios)
            var params = new URLSearchParams(window.location.search);
            ["embedded", "chromeless", "standalone"].forEach(function (name) {
                var value = params.get(name);
                if (value && value !== "false" && value !== "0") {
                    target.searchParams.set(name, value);
                }
            });

            var newurl = target.pathname + target.search + target.hash;

            if (e.ctrlKey || e.metaKey) {
              window.open(newurl,'_blank');
            } else {
              window.location.href = newurl;
            }
        }
    });
});
