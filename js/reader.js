/*
Keep My Place for multi-page content (as in Grav Helios Open Reader) - hibbittsdesign.org
On a section or subsection page, remember it in the reader's browser (localStorage).
On its Section List page, change the Start button to "Continue Reading", linking to that page.
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

    // On a Section List page: if a page was remembered, the Start button continues from it
    var startButton = document.querySelector('.section-list-start a[data-reader-home]');
    if (startButton) {
        var saved = null;
        try {
            saved = JSON.parse(localStorage.getItem(savedPlaceKey(startButton.dataset.readerHome)));
        } catch (e) {
            saved = null;
        }

        if (saved && saved.url) {
            // (js/my.js carries ?embedded=true forward when the link is followed, as for other links)
            startButton.href = saved.url;
            startButton.querySelector('.section-list-start-text').textContent = startButton.dataset.continueText;
            // the page's title, shown when hovering over the button and read by screen readers
            startButton.title = saved.title;
            startButton.setAttribute('aria-label', startButton.dataset.continueText + ': ' + saved.title);
        }
    }

})();
