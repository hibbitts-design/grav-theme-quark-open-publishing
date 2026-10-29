<?php

namespace HibbittsDesign;

use DOMDocument;
use DOMElement;
use Grav\Common\Grav;
use Grav\Common\Page\Markdown\MarkdownOutput;

/**
 * A page's .md address (Grav 2) with its callouts kept as callouts.
 *
 * Grav 2 makes a page's Markdown version from the finished HTML page. Callout boxes have no Markdown form, so they
 * came out as plain text. Before Grav converts the page, this turns each box back into a GitHub-style callout:
 *
 *   > [!TIP]
 *   > The box's text
 *
 * which Docsify-This, GitHub and Obsidian all show as a callout. It handles:
 *   - GitHub-style alerts (> [!TIP] and so on) and callout shortcodes such as [objectives]: <div class="md-alert md-alert--tip">
 *   - the Markdown Notices plugin's boxes (! to !!!!): <div class="notices yellow">
 *
 * Web pages are not changed – only the Markdown version.
 *
 * The same file is in Quark 2 Open Publishing, Quark Open Publishing, Open Matter, Helios Open Reader and Helios Course
 * Hub – keep the copies the same. Each one turns it on with these lines in onThemeInitialized (Grav 2 only, as Grav 1.7
 * has no .md addresses):
 *
 *   if (class_exists('Grav\Common\Page\Markdown\MarkdownOutput')) {
 *       if (!class_exists('HibbittsDesign\CalloutsMarkdownOutput')) {
 *           require_once __DIR__ . '/classes/CalloutsMarkdownOutput.php';
 *       }
 *       \HibbittsDesign\CalloutsMarkdownOutput::useForMarkdownVersions($this->grav);
 *   }
 *
 * (The class_exists check matters when two of them are installed together: PHP stops if a class is loaded twice.)
 */
class CalloutsMarkdownOutput extends MarkdownOutput
{
    // The five callout types GitHub knows
    const ALERT_TYPES = ['note', 'tip', 'important', 'warning', 'caution'];

    // The Markdown Notices plugin's colours (! yellow, !! red, !!! blue, !!!! green) and the callout type for each.
    // Open Matter uses Bootstrap's colours instead (alert-warning and so on).
    const NOTICE_TYPES = [
        'yellow' => 'warning', 'red' => 'caution', 'blue' => 'note', 'green' => 'tip',
        'alert-warning' => 'warning', 'alert-danger' => 'caution', 'alert-info' => 'note', 'alert-success' => 'tip',
    ];

    // Set once this converter is in use, so a second theme or plugin calling useForMarkdownVersions() changes nothing
    protected static $inUse = false;

    /**
     * Makes Grav use this converter for .md addresses. Grav makes the Markdown with its 'markdown_output' service,
     * so this swaps in this version of it.
     */
    public static function useForMarkdownVersions(Grav $grav): void
    {
        if (self::$inUse || !isset($grav['markdown_output'])) {
            return;
        }

        unset($grav['markdown_output']); // Grav won't replace a service that's already set
        $grav['markdown_output'] = function ($grav) {
            return new CalloutsMarkdownOutput($grav);
        };
        self::$inUse = true;
    }

    /**
     * Grav calls this to turn a page's HTML into Markdown.
     */
    public function convert(string $html): string
    {
        $markdown = parent::convert($this->calloutsAsQuotes($html));

        // Grav's converter writes [ and ] in text as \[ and \], so > \[!TIP\] needs putting back to > [!TIP].
        // (In the pattern, \\\\ matches one \ in the Markdown.)
        // (?? keeps the Markdown as it was if the pattern ever fails)
        return preg_replace('/^((?:> ?)+)\\\\\[!([A-Z]+)\\\\\]/m', '$1[!$2]', $markdown) ?? $markdown;
    }

    /**
     * Replaces each callout box in the HTML with a quote that starts with its marker: <blockquote><p>[!TIP]</p>…
     */
    protected function calloutsAsQuotes(string $html): string
    {
        // Most pages have no callouts, so leave them as they are
        if (strpos($html, 'md-alert') === false && strpos($html, 'notices') === false) {
            return $html;
        }

        // Read the HTML into a DOMDocument, so its boxes can be found and moved.
        // The <?xml …> line tells it the text is UTF-8, and the wrapper <div> keeps the HTML in one piece.
        $document = new DOMDocument();
        $loaded = @$document->loadHTML(
            '<?xml encoding="utf-8"?><div id="callouts-root">' . $html . '</div>',
            LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD
        );
        if (!$loaded) {
            return $html;
        }

        // A list of the <div>s first, as the loop below changes the page while it works
        $divs = iterator_to_array($document->getElementsByTagName('div'));

        foreach ($divs as $div) {
            if ($this->hasClass($div, 'md-alert')) {
                $this->replaceAlert($document, $div);
            } elseif ($this->hasClass($div, 'notices')) {
                $this->replaceNotice($document, $div);
            }
        }

        // Turn the page back into HTML: everything inside the wrapper <div>
        $result = '';
        foreach ($document->getElementById('callouts-root')->childNodes as $node) {
            $result .= $document->saveHTML($node);
        }

        return $result;
    }

    /**
     * An alert or shortcode box: <div class="md-alert md-alert--tip"> with a title and a body inside.
     * A title other than the type's own name (such as "Learning Objectives") is kept in bold as the first line.
     */
    protected function replaceAlert(DOMDocument $document, DOMElement $box): void
    {
        $type = null;
        foreach (self::ALERT_TYPES as $alertType) {
            if ($this->hasClass($box, 'md-alert--' . $alertType)) {
                $type = $alertType;
            }
        }
        if ($type === null) {
            return;
        }

        $quote = $this->newQuote($document, $type);

        foreach (iterator_to_array($box->childNodes) as $child) {
            if (!$child instanceof DOMElement) {
                continue;
            }

            if ($this->hasClass($child, 'md-alert-title')) {
                $title = $this->visibleText($child);
                if ($title !== '' && strtolower($title) !== $type) {
                    $bold = $document->createElement('strong');
                    $bold->appendChild($document->createTextNode($title));
                    $line = $document->createElement('p');
                    $line->appendChild($bold);
                    $quote->appendChild($line);
                }
            } elseif ($this->hasClass($child, 'md-alert-body')) {
                $this->moveChildren($child, $quote);
            }
        }

        $box->parentNode->replaceChild($quote, $box);
    }

    /**
     * A Markdown Notices box: <div class="notices yellow"> with the text straight inside.
     */
    protected function replaceNotice(DOMDocument $document, DOMElement $box): void
    {
        $type = null;
        foreach (self::NOTICE_TYPES as $colour => $noticeType) {
            if ($this->hasClass($box, $colour)) {
                $type = $noticeType;
            }
        }
        if ($type === null) {
            return;
        }

        $quote = $this->newQuote($document, $type);
        $this->moveChildren($box, $quote);
        $box->parentNode->replaceChild($quote, $box);
    }

    /**
     * A new <blockquote> that starts with the callout's marker, such as <p>[!TIP]</p>
     */
    protected function newQuote(DOMDocument $document, string $type): DOMElement
    {
        $quote = $document->createElement('blockquote');
        $marker = $document->createElement('p');
        $marker->appendChild($document->createTextNode('[!' . strtoupper($type) . ']'));
        $quote->appendChild($marker);

        return $quote;
    }

    /**
     * Moves everything inside one element to the end of another
     */
    protected function moveChildren(DOMElement $from, DOMElement $to): void
    {
        while ($from->firstChild) {
            $to->appendChild($from->firstChild);
        }
    }

    /**
     * An element's text, leaving out icons marked aria-hidden="true" (screen readers skip them too)
     */
    protected function visibleText(DOMElement $element): string
    {
        $text = '';
        foreach ($element->childNodes as $child) {
            if ($child instanceof DOMElement) {
                if ($child->getAttribute('aria-hidden') !== 'true') {
                    $text .= $this->visibleText($child);
                }
            } else {
                $text .= $child->textContent;
            }
        }

        return trim($text);
    }

    /**
     * Whether an element has a class, such as "tip" in class="md-alert md-alert--tip"
     */
    protected function hasClass(DOMElement $element, string $class): bool
    {
        $classes = explode(' ', $element->getAttribute('class'));

        return in_array($class, $classes, true);
    }
}
