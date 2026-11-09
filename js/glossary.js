/*
Glossary terms ([term]...[/term]): hover, click, tap or Enter shows the term's definition in a small box.
Without this script, a term is a plain link to its glossary entry.

The same file is in Quark Open Publishing, Quark 2 Open Publishing and Helios Open Reader (assets/glossary.js) –
keep the copies the same - hibbittsdesign.org
*/
(function () {
    'use strict';

    var TERM = 'a.glossary-term[data-glossary-definition]';
    var canHover = window.matchMedia && window.matchMedia('(hover: hover) and (pointer: fine)').matches;

    var box, boxTerm, boxDefinition, boxLink, boxLinkText; // made on first use
    var current = null;  // the term the box is showing
    var pinned = false;  // opened by click, tap or Enter (rather than hover): stays open and has focus
    var hideTimer = null;

    function element(tag, className, id) {
        var el = document.createElement(tag);
        el.className = className;
        if (id) { el.id = id; }
        return el;
    }

    // A non-modal dialog, named by the term and described by the definition.
    // Spans, as the box is placed inside the term's paragraph.
    function makeBox() {
        box = element('span', 'glossary-popover', 'glossary-popover');
        box.setAttribute('role', 'dialog');
        box.setAttribute('tabindex', '-1');
        box.setAttribute('aria-labelledby', 'glossary-popover-term');
        box.setAttribute('aria-describedby', 'glossary-popover-definition');
        box.hidden = true;

        boxTerm = element('span', 'glossary-popover-term', 'glossary-popover-term');
        boxDefinition = element('span', 'glossary-popover-definition', 'glossary-popover-definition');
        boxLink = element('a', 'glossary-popover-link');
        boxLinkText = document.createElement('span');
        var arrow = document.createElement('span');
        arrow.setAttribute('aria-hidden', 'true');
        arrow.textContent = ' →';
        boxLink.appendChild(boxLinkText);
        boxLink.appendChild(arrow);

        box.appendChild(boxTerm);
        box.appendChild(boxDefinition);
        box.appendChild(boxLink);

        box.addEventListener('mouseenter', function () { clearTimeout(hideTimer); });
        box.addEventListener('mouseleave', function () { if (!pinned) { hideSoon(); } });
    }

    function show(term, byClick) {
        if (!box) { makeBox(); }
        clearTimeout(hideTimer);
        if (current && current !== term) { current.setAttribute('aria-expanded', 'false'); }
        current = term;
        pinned = byClick;

        // right after the term, so Tab moves from the term into the box
        term.insertAdjacentElement('afterend', box);
        boxTerm.textContent = term.getAttribute('data-glossary-term') || term.textContent;
        boxDefinition.textContent = term.getAttribute('data-glossary-definition');
        boxLink.href = term.getAttribute('href');
        boxLinkText.textContent = term.getAttribute('data-glossary-link-text') || 'Glossary';

        box.hidden = false;
        term.setAttribute('aria-expanded', 'true');
        term.setAttribute('aria-controls', 'glossary-popover'); // set now, as the box only exists once opened
        place();
        if (byClick) { box.focus({ preventScroll: true }); } // so screen readers announce it
    }

    // below the term (above it if there's no room), kept inside the window
    function place() {
        if (!box || box.hidden || !current) { return; }
        var rect = current.getBoundingClientRect();
        var gap = 8;
        var left = Math.max(gap, Math.min(rect.left, document.documentElement.clientWidth - box.offsetWidth - gap));
        var top = rect.bottom + gap;
        if (top + box.offsetHeight > window.innerHeight && rect.top - box.offsetHeight - gap > 0) {
            top = rect.top - box.offsetHeight - gap;
        }
        box.style.left = left + 'px';
        box.style.top = top + 'px';
    }

    function hide(returnFocus) {
        clearTimeout(hideTimer);
        if (!box || box.hidden) { return; }
        box.hidden = true;
        if (current) {
            current.setAttribute('aria-expanded', 'false');
            if (returnFocus) { current.focus(); }
        }
        current = null;
        pinned = false;
    }

    function hideSoon() {
        clearTimeout(hideTimer);
        hideTimer = setTimeout(function () { hide(false); }, 300);
    }

    function prepareTerms() {
        document.querySelectorAll(TERM).forEach(function (term) {
            term.setAttribute('aria-haspopup', 'dialog');
            term.setAttribute('aria-expanded', 'false');
        });
    }

    document.addEventListener('click', function (event) {
        var term = event.target.closest(TERM);
        if (term) {
            // with a modifier key (e.g. to open in a new tab), follow the link instead
            if (event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) { return; }
            event.preventDefault();
            if (current === term && pinned) { hide(false); } else { show(term, true); }
        } else if (box && !box.hidden && !box.contains(event.target)) {
            hide(false);
        }
    });

    document.addEventListener('mouseover', function (event) {
        if (!canHover) { return; }
        var term = event.target.closest(TERM);
        if (term && term !== current && !pinned) { show(term, false); } else if (term) { clearTimeout(hideTimer); }
    });

    document.addEventListener('mouseout', function (event) {
        var term = event.target.closest(TERM);
        if (term && term === current && !pinned && !(box && box.contains(event.relatedTarget))) { hideSoon(); }
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && box && !box.hidden) {
            // only move focus back to the term if it was in the box
            hide(pinned || box.contains(document.activeElement));
        }
    });

    document.addEventListener('focusin', function (event) {
        if (box && !box.hidden && !box.contains(event.target) && event.target !== current) { hide(false); }
    });

    window.addEventListener('scroll', place, { passive: true });
    window.addEventListener('resize', place);

    // Helios Open Reader swaps in new pages without reloading
    document.addEventListener('htmx:beforeSwap', function () { hide(false); });
    document.addEventListener('htmx:afterSwap', prepareTerms);

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', prepareTerms);
    } else {
        prepareTerms();
    }
})();
