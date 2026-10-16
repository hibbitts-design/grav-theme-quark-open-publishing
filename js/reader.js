/*
Keep My Place for multi-page content (as in Grav Helios Open Reader) - hibbittsdesign.org
On a section or subsection page, remember it in the reader's browser (localStorage).
On its Section List page, show a "Continue reading" bar linking to that page; its close button forgets the saved place.
Each Section List page has its own saved place.
Also, on section pages, wide tables scroll sideways inside the text column instead of running past it.
*/

// Everything is inside this function, which runs straight away, so its variable names
// can't clash with other scripts on the page
(function () {

    // The storage name for one Section List page's saved place
    function savedPlaceKey(readerHomeUrl) {
        return 'qop-last-page|' + readerHomeUrl;
    }

    // On a section or subsection page: remember this page.
    // The template adds a hidden element with the page's details in data- attributes
    // (data-reader-home, data-url and data-title, which JavaScript reads as dataset.readerHome and so on).
    var savePlace = document.querySelector('.reader-save-place');
    if (savePlace) {
        var placeDetails = {
            url: savePlace.dataset.url,
            title: savePlace.dataset.title
        };
        try {
            // localStorage only stores text, so the details are turned into text (JSON) first
            localStorage.setItem(savedPlaceKey(savePlace.dataset.readerHome), JSON.stringify(placeDetails));
        } catch (error) {
            // storage not available (for example in some private windows): nothing is remembered
        }
    }

    // On a Section List page: if a page was remembered, show the "Continue reading" bar
    var resume = document.querySelector('.reader-resume');
    if (resume) {
        var key = savedPlaceKey(resume.dataset.readerHome);
        var saved = null;
        try {
            // turn the stored text back into details (null when nothing was saved)
            saved = JSON.parse(localStorage.getItem(key));
        } catch (error) {
            saved = null;
        }

        if (saved && saved.url) {
            // (js/my.js carries ?embedded=true forward when the link is followed, as for other links)
            resume.querySelector('.reader-resume-link').href = saved.url;
            resume.querySelector('.reader-resume-title').textContent = saved.title;
            resume.hidden = false;

            // the close button forgets the saved place and hides the bar
            var dismissButton = resume.querySelector('.reader-resume-dismiss');
            dismissButton.addEventListener('click', function () {
                try {
                    localStorage.removeItem(key);
                } catch (error) {
                    // nothing to forget
                }
                resume.hidden = true;

                // The button has gone, so keyboard and screen reader users continue from the search box beside it,
                // or from the first section card when there's no search box
                // (both the SimpleSearch and TNTSearch plugins give their search field the "form-input" class)
                var nextPlace = document.querySelector('.section-list-actions .reader-search .form-input');
                if (!nextPlace) {
                    nextPlace = document.querySelector('.section-card-link');
                }
                if (nextPlace) {
                    nextPlace.focus();
                }
            });
        }
    }

    // On a section page: put each table in the page's text inside a box that scrolls sideways when the table is too wide
    var tables = document.querySelectorAll('.reader-content table');
    for (var i = 0; i < tables.length; i++) {
        var table = tables[i];

        // make the box, put it where the table is, then move the table into it
        var scrollBox = document.createElement('div');
        scrollBox.className = 'reader-table-scroll';
        table.parentNode.insertBefore(scrollBox, table);
        scrollBox.appendChild(table);

        // when the table is wider than the box, keyboard users can reach the box with Tab and scroll it with the arrow keys
        if (scrollBox.scrollWidth > scrollBox.clientWidth) {
            scrollBox.tabIndex = 0;
        }
    }

    // On guide pages, the left and right arrow keys go to the previous and next page - as when presenting slides,
    // for example by screen sharing. On a Section List page, the right arrow key follows its Start Reading button,
    // and on the guide's first page the left arrow key goes back to the guide's home page.
    document.addEventListener('keydown', function (event) {
        // leave the keys alone with a modifier key held, so browser shortcuts still work
        if (event.altKey || event.ctrlKey || event.metaKey || event.shiftKey) {
            return;
        }
        // and while typing, or in a box that scrolls sideways (such as a wide table), where the arrow keys scroll it
        var target = event.target;
        var typingTags = ['INPUT', 'TEXTAREA', 'SELECT'];
        if (target.isContentEditable || typingTags.indexOf(target.tagName) !== -1) {
            return;
        }
        if (target.closest && target.closest('.reader-table-scroll')) {
            return;
        }

        // the page's own Previous/Next links (tiles at the bottom, or the compact links at the top)
        var link = null;
        if (event.key === 'ArrowLeft') {
            link = document.querySelector('.reader-nav-prev, .reader-prev-next-top a[rel="prev"]');
            // no previous page (the guide's first page): back to the guide's home page, the link above the page title
            if (!link) {
                link = document.querySelector('.reader-back-link a');
            }
        }
        if (event.key === 'ArrowRight') {
            link = document.querySelector('.reader-nav-next, .reader-prev-next-top a[rel="next"], .section-list-start a');
        }
        if (link) {
            window.location.href = link.href;
        }
    });

})();
