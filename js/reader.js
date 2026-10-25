/*
Keep My Place for multi-page content (as in Grav Helios Open Reader) - hibbittsdesign.org
On a section or subsection page, remember it in the reader's browser (localStorage).
On its Section List page, show a "Continue reading" bar linking to that page; its close button forgets the saved place.
Each Section List page has its own saved place. The section being read on that page (the last heading scrolled up
near the top of the window) is remembered too, so "Continue reading" goes back to it rather than the top of the page.
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
        var placeKey = savedPlaceKey(savePlace.dataset.readerHome);
        var rememberPlace = function () {
            try {
                // localStorage only stores text, so the details are turned into text (JSON) first
                localStorage.setItem(placeKey, JSON.stringify(placeDetails));
            } catch (error) {
                // storage not available (for example in some private windows): nothing is remembered
            }
        };

        // The section being read: the last heading (with an id to link to, as the Page TOC plugin gives them) that has
        // scrolled up to near the top of the window, under the site header - the same point as the side list uses to
        // mark the section you're reading. Before the first heading, no section is remembered (the top of the page).
        var placeHeadings = document.querySelectorAll('.reader-content h2[id], .reader-content h3[id]');

        // A page opened at one of its headings (from "Continue reading" or a link ending in # and the heading's id)
        // starts with that section, as the page loads before the browser has scrolled to it
        var linkedHeading = null;
        try {
            linkedHeading = document.getElementById(decodeURIComponent(window.location.hash.slice(1)));
        } catch (error) {
            // a # part that isn't valid (such as a stray %) is left alone, so the rest of the page still works
        }
        for (var h = 0; h < placeHeadings.length; h++) {
            if (placeHeadings[h] === linkedHeading) {
                placeDetails.section = linkedHeading.id;
            }
        }
        rememberPlace();

        if (placeHeadings.length > 0) {
            var checkPending = false;
            var rememberSection = function () {
                checkPending = false;
                var section = '';
                for (var i = 0; i < placeHeadings.length; i++) {
                    if (placeHeadings[i].getBoundingClientRect().top <= 120) {
                        section = placeHeadings[i].id;
                    }
                }
                // at the very end of the page the last section is being read, even if its heading never reaches the top
                if (window.innerHeight + window.scrollY >= document.documentElement.scrollHeight - 2) {
                    section = placeHeadings[placeHeadings.length - 1].id;
                }
                // only saved when the section changes, rather than on every scroll
                if (section !== (placeDetails.section || '')) {
                    placeDetails.section = section;
                    rememberPlace();
                }
            };
            // checked at most twice a second while scrolling ("passive" tells the browser this never stops scrolling)
            window.addEventListener('scroll', function () {
                if (!checkPending) {
                    checkPending = true;
                    setTimeout(rememberSection, 500);
                }
            }, { passive: true });
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
            // the saved page, at the section being read when there is one (# and the heading's id)
            var resumeUrl = saved.url;
            if (saved.section) {
                resumeUrl = resumeUrl + '#' + encodeURIComponent(saved.section);
            }
            resume.querySelector('.reader-resume-link').href = resumeUrl;
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

    // On guide pages, the / key jumps to the guide's search box, ready to type - as on GitHub and many documentation sites.
    // It's left alone while typing (so a / can still be typed) and with Ctrl, Alt or Cmd held; Shift is fine, as some
    // keyboards need it to type a /.
    document.addEventListener('keydown', function (event) {
        if (event.key !== '/' || event.ctrlKey || event.altKey || event.metaKey) {
            return;
        }
        var target = event.target;
        if (target.isContentEditable || ['INPUT', 'TEXTAREA', 'SELECT'].indexOf(target.tagName) !== -1) {
            return;
        }
        // nothing while the phone menu is open (Quark adds mobile-nav-open to the page then), as the box is behind it
        if (document.body.classList.contains('mobile-nav-open')) {
            return;
        }
        // the guide's search box that can be seen (on its home page, or in the side list on its other pages);
        // offsetParent is empty for a box that isn't shown
        var boxes = document.querySelectorAll('.reader-search input[type="search"]');
        for (var i = 0; i < boxes.length; i++) {
            if (boxes[i].offsetParent !== null) {
                // stop the / from being typed into the box
                event.preventDefault();
                boxes[i].focus();
                return;
            }
        }
    });

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

/*
The section being read: with the Page TOC plugin, the side list shows the current page's sections, and the one you're
reading is marked as you scroll (as in Grav Helios Open Reader's table of contents). It's the last section whose heading
has scrolled up to near the top of the window, or the first section before then, and the last one at the very end of the
page. Screen readers hear it as the current location (aria-current) - hibbittsdesign.org
*/
(function () {
    // each link in the side list's "On this page" list, with the heading it jumps to
    var sections = [];
    var links = document.querySelectorAll('.reader-page-sections a');
    for (var i = 0; i < links.length; i++) {
        var heading = document.getElementById(decodeURIComponent(links[i].hash.slice(1)));
        if (heading) {
            sections.push({ link: links[i], heading: heading });
        }
    }
    if (sections.length === 0) {
        return;
    }

    // a heading counts as reached a little below the top of the window, under the site header (headings reached from
    // these links also stop about this far down - see css/reader.css)
    var reachedAt = 120;
    var current = null;

    function update() {
        var reading = sections[0];
        for (var i = 0; i < sections.length; i++) {
            if (sections[i].heading.getBoundingClientRect().top <= reachedAt) {
                reading = sections[i];
            }
        }
        // at the very end of the page the last section is being read, even if its heading never reaches the top
        if (window.innerHeight + window.scrollY >= document.documentElement.scrollHeight - 2) {
            reading = sections[sections.length - 1];
        }
        if (reading === current) {
            return;
        }
        if (current) {
            current.link.classList.remove('is-current');
            current.link.removeAttribute('aria-current');
        }
        reading.link.classList.add('is-current');
        reading.link.setAttribute('aria-current', 'location');
        current = reading;
    }

    // checked on every scroll - a quick check of a few headings ("passive" tells the browser this never stops scrolling)
    window.addEventListener('scroll', update, { passive: true });
    window.addEventListener('resize', update);
    update();
})();

/*
Tap or click an image in a guide page's text to see it larger, filling the screen - handy for diagrams and screenshots,
especially on phones. Only images shown smaller than their full size, and not already links, get this. The larger
view is a dialog: Escape, the Close button, or a tap anywhere closes it, and keyboard focus goes back to the image -
hibbittsdesign.org
*/
(function () {
    var content = document.querySelector('.reader-content');
    // (very old browsers without dialogs keep the images as they are)
    if (!content || typeof HTMLDialogElement === 'undefined') {
        return;
    }
    var largerLabel = content.dataset.imageLargerLabel || 'Show image larger';
    var closeLabel = content.dataset.imageCloseLabel || 'Close';
    var dialog = null;

    // the dialog is made the first time it's needed, and used for every image
    function makeDialog() {
        dialog = document.createElement('dialog');
        dialog.className = 'reader-image-dialog';
        var closeButton = document.createElement('button');
        closeButton.type = 'button';
        closeButton.className = 'reader-image-close';
        closeButton.setAttribute('aria-label', closeLabel);
        closeButton.innerHTML = '<span aria-hidden="true">&times;</span>';
        var largeImage = document.createElement('img');
        dialog.appendChild(closeButton);
        dialog.appendChild(largeImage);
        // a tap or click anywhere (the image, the dark background or the Close button) closes it
        dialog.addEventListener('click', function () {
            dialog.close();
        });
        document.body.appendChild(dialog);
    }

    function showLarger(image) {
        if (!dialog) {
            makeDialog();
        }
        var largeImage = dialog.querySelector('img');
        largeImage.src = image.currentSrc || image.src;
        largeImage.alt = image.alt;
        dialog.setAttribute('aria-label', image.alt || largerLabel);
        dialog.showModal();
    }

    // An image shown at least a fifth smaller than its full size, and not already a link, works as a button that shows
    // it larger: it can be reached with the Tab key and opened with Enter or Space, and screen readers hear it as a
    // button named with its alt text. (The image itself becomes the button, rather than going inside one, so the
    // layout and captions that depend on where the image sits stay as they are - see css/reader.css)
    function setUp(image) {
        if (image.closest('a, button') || image.naturalWidth < image.clientWidth * 1.2) {
            return;
        }
        image.classList.add('reader-image-zoom');
        image.setAttribute('role', 'button');
        image.setAttribute('tabindex', '0');
        image.setAttribute('aria-label', image.alt || largerLabel);
        image.addEventListener('click', function () {
            showLarger(image);
        });
        image.addEventListener('keydown', function (event) {
            if (event.key === 'Enter' || event.key === ' ') {
                // (Space would otherwise scroll the page)
                event.preventDefault();
                showLarger(image);
            }
        });
    }

    var images = content.querySelectorAll('img');
    for (var i = 0; i < images.length; i++) {
        if (images[i].complete) {
            setUp(images[i]);
        } else {
            images[i].addEventListener('load', function (event) {
                setUp(event.currentTarget);
            });
        }
    }
})();

/*
Side Box: when the side list and the Side Box under it fit in the window together, the side list stays in view while
reading (as it does without a Side Box); when they don't, both scroll with the page, so neither is cut off. The CSS
keeps the side list in view only while it has the reader-side-box-fits class - hibbittsdesign.org
*/
(function () {
    var nav = document.getElementById('sections-nav');
    if (!nav || !nav.querySelector('.reader-side-box')) {
        return;
    }

    function checkFit() {
        // the side list's full height, as it is when it scrolls with the page
        nav.classList.remove('reader-side-box-fits');
        var fullHeight = nav.offsetHeight;
        // the most room it has while staying in view (its max-height in css/reader.css; none on narrow screens)
        nav.classList.add('reader-side-box-fits');
        var room = parseFloat(getComputedStyle(nav).maxHeight);
        if (!(fullHeight <= room)) {
            nav.classList.remove('reader-side-box-fits');
        }
    }

    checkFit();
    window.addEventListener('resize', checkFit);
    // again once images (in the Side Box, for example) have loaded and changed its height
    window.addEventListener('load', checkFit);
})();
