/*
Keep My Place for multi-page content (as in Grav Helios Open Reader) - hibbittsdesign.org
On a section or subsection page, remember it in the reader's browser (localStorage).
On its Section List page, show a "Continue reading" bar linking to that page; its close button forgets the saved place.
Each Section List page has its own saved place.
*/
(function () {

    // The storage name for one Section List page's saved place
    function savedPlaceKey(readerHomeUrl) {
        return 'qop-last-page|' + readerHomeUrl;
    }

    // On a section or subsection page: remember this page
    var savePlace = document.querySelector('.reader-save-place');
    if (savePlace) {
        try {
            localStorage.setItem(savedPlaceKey(savePlace.dataset.readerHome), JSON.stringify({
                url: savePlace.dataset.url,
                title: savePlace.dataset.title
            }));
        } catch (e) {
            // storage not available (for example in some private windows): nothing is remembered
        }
    }

    // On a Section List page: if a page was remembered, show the "Continue reading" bar
    var resume = document.querySelector('.reader-resume');
    if (resume) {
        var key = savedPlaceKey(resume.dataset.readerHome);
        var saved = null;
        try {
            saved = JSON.parse(localStorage.getItem(key));
        } catch (e) {
            saved = null;
        }

        if (saved && saved.url) {
            // (js/my.js carries ?embedded=true forward when the link is followed, as for other links)
            resume.querySelector('.reader-resume-link').href = saved.url;
            resume.querySelector('.reader-resume-title').textContent = saved.title;
            resume.hidden = false;

            // the close button forgets the saved place and hides the bar
            resume.querySelector('.reader-resume-dismiss').addEventListener('click', function () {
                try {
                    localStorage.removeItem(key);
                } catch (e) {
                    // nothing to forget
                }
                resume.hidden = true;

                // the button has gone, so keyboard and screen reader users continue from the search box beside it,
                // or the first section card when there's no search box
                var nextPlace = document.querySelector('.section-list-actions .reader-search input:not([type="hidden"]), .section-card-link');
                if (nextPlace) {
                    nextPlace.focus();
                }
            });
        }
    }

})();
