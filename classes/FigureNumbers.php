<?php

namespace HibbittsDesign;

use Grav\Common\Grav;

/**
 * Captions and numbers for figures and tables on a guide's pages - hibbittsdesign.org
 *
 *   ![Alt text](photo.jpg)          an image with an italic line just below it,
 *   *A caption*                     or an HTML <figure> with a <figcaption>
 *
 *   Table: A caption                a "Table:" line just above or below a table
 *                                   becomes the table's <caption> (always)
 *
 * With Number Figures and Tables turned on for the guide (number_figures: true on its home page), captioned figures
 * and tables are numbered by section, counting across the section's pages: "Figure 3.2" is the second figure in
 * Section 3. Captions that already start with a number ("Figure 3.1 ...", as in many Pressbooks books) are left alone.
 *
 * The same file is in Quark Open Publishing, Quark 2 Open Publishing and Helios Open Reader – keep the copies the same.
 */
class FigureNumbers
{
    // how many numbered figures and tables each page has, by route (counted once per request)
    protected static $counts = [];

    /**
     * $labels: ['figure' => 'Figure %s:', 'table' => 'Table %s:'], translated.
     */
    public static function process($page, string $html, array $labels): string
    {
        if (strpos($html, '<img') === false && strpos($html, '<table') === false) {
            return $html;
        }

        $home = self::guideHome($page);
        $numbering = $home && !empty($home->header()->number_figures);
        $section = self::sectionOf($page);

        $prefix = '';
        $figures = 0;
        $tables = 0;
        if ($numbering && $section) {
            $prefix = self::sectionNumber($section, $home);
            [$figures, $tables] = self::countBefore($page, $section);
        }

        return self::captionAndNumber($html, $numbering, $prefix, $figures, $tables, $labels);
    }

    /**
     * True for a page in a guide with numbering on. Its numbers depend on the pages before it, so its content
     * shouldn't come from Grav's cache, which only notices changes to the page itself.
     */
    public static function numberingOn($page): bool
    {
        $home = self::guideHome($page);

        return $home && !empty($home->header()->number_figures) && self::sectionOf($page) !== null;
    }

    // Small text replacements rather than re-saving the page through a DOM parser, which would change other markup
    // (such as lower-casing the viewBox of inline SVG icons).
    protected static function captionAndNumber(string $html, bool $numbering, string $prefix, int $figures, int $tables, array $labels): string
    {
        $html = self::tableCaptions($html);
        if (!$numbering) {
            return $html;
        }

        $pattern = '#'
            . '(?:<figcaption\b[^>]*>'                               // an HTML figure's caption
            . '|(?<table><caption\b[^>]*>)'                          // a table's caption
            . '|<p>\s*(?:<a\b[^>]*>\s*)?<img\b[^>]*>(?:\s*</a>)?'    // an image (or linked image) on its own, then
            . '\s*(?:<br\s*/?>\s*|</p>\s*<p>\s*)?<em>'               // an italic line just below it
            . '(?=(?:(?!</?em\b|</p>).)*</em>\s*</p>))'              // that is the whole rest of the paragraph
            . '(?=(?<numbered>\s*(?i:figure|fig\.?|table)\s*\d)|)'   // caption already numbered by the author?
            . '#s';

        return preg_replace_callback($pattern, function ($match) use (&$figures, &$tables, $prefix, $labels) {
            if (($match['numbered'] ?? '') !== '') {
                return $match[0];
            }
            $type = ($match['table'] ?? '') !== '' ? 'table' : 'figure';
            $count = $type === 'table' ? ++$tables : ++$figures;
            $number = ($prefix !== '' ? $prefix . '.' : '') . $count;

            return $match[0] . '<span class="figure-number figure-number-' . $type . '">'
                . htmlspecialchars(sprintf($labels[$type], $number), ENT_QUOTES, 'UTF-8') . '</span> ';
        }, $html) ?? $html;
    }

    /**
     * A "Table: A caption" paragraph just above a table (or else just below one) becomes its <caption>.
     */
    protected static function tableCaptions(string $html): string
    {
        if (strpos($html, 'Table:') === false) {
            return $html;
        }

        // above: <p>Table: …</p> <table>
        $html = preg_replace('#<p>\s*Table:\s*((?:(?!</p>).)*)</p>\s*(<table\b[^>]*>)(?!\s*<caption)#s',
            '$2<caption>$1</caption>', $html) ?? $html;

        // below: <table>…</table> <p>Table: …</p>
        return preg_replace_callback('#(<table\b[^>]*>)((?:(?!<table\b).)*?</table>)\s*<p>\s*Table:\s*((?:(?!</p>).)*)</p>#s',
            function ($match) {
                if (preg_match('#^\s*<caption#', $match[2])) {
                    return $match[0]; // already has a caption
                }
                return $match[1] . '<caption class="caption-bottom">' . $match[3] . '</caption>' . $match[2];
            }, $html) ?? $html;
    }

    // the guide's home page: the nearest Section List page above, or for a top-level section (Helios Open Reader's
    // single-publication mode, where sections sit beside their home page) the site's top-level one
    protected static function guideHome($page)
    {
        for ($current = $page; $current && !$current->root(); $current = $current->parent()) {
            if (in_array($current->template(), ['section-list', 'guide'], true)) {
                return $current;
            }
        }

        $section = self::sectionOf($page);
        if ($section && $section->parent() && $section->parent()->root()) {
            foreach (Grav::instance()['pages']->root()->children() as $child) {
                if (in_array($child->template(), ['section-list', 'guide'], true)) {
                    return $child;
                }
            }
        }

        return null;
    }

    protected static function sectionOf($page)
    {
        for ($current = $page; $current && !$current->root(); $current = $current->parent()) {
            if ($current->template() === 'section') {
                return $current;
            }
        }

        return null;
    }

    // the section's number as shown on its card: its Section Number, or its position among the numbered sections
    protected static function sectionNumber($section, $home): string
    {
        $header = $section->header();
        if (($header->numbered ?? true) === false) {
            return '';
        }
        if (!empty($header->section_number)) {
            return (string) $header->section_number;
        }

        $position = 0;
        foreach (self::sections($section, $home) as $candidate) {
            if (($candidate->header()->numbered ?? true) === false) {
                continue;
            }
            $position++;
            if ($candidate->rawRoute() === $section->rawRoute()) {
                return (string) $position;
            }
        }

        return '';
    }

    // the guide's sections, in card order
    protected static function sections($section, $home): array
    {
        $parent = $section->parent();
        $children = $parent->children()->visible();

        if ($home->rawRoute() === $parent->rawRoute()) {
            $order = $home->header()->content['order'] ?? null;
            if (!empty($order['by'])) {
                $children = $children->order($order['by'], $order['dir'] ?? 'asc');
            }
            return iterator_to_array($children);
        }

        // sections beside their home page (single-publication mode): only the sections
        return array_filter(iterator_to_array($children), function ($child) {
            return $child->template() === 'section';
        });
    }

    /**
     * Numbered figures and tables on the section's pages before this one: [figures, tables].
     */
    protected static function countBefore($page, $section): array
    {
        $figures = 0;
        $tables = 0;
        foreach (self::sectionPages($section) as $earlier) {
            if ($earlier->rawRoute() === $page->rawRoute()) {
                return [$figures, $tables];
            }
            [$pageFigures, $pageTables] = self::countOn($earlier);
            $figures += $pageFigures;
            $tables += $pageTables;
        }

        return [0, 0]; // the page isn't one of the section's pages
    }

    protected static function countOn($page): array
    {
        $route = $page->rawRoute();
        if (!isset(self::$counts[$route])) {
            $html = (string) $page->content(); // already numbered, as it's a page of the same guide
            self::$counts[$route] = [
                substr_count($html, 'figure-number-figure'),
                substr_count($html, 'figure-number-table'),
            ];
        }

        return self::$counts[$route];
    }

    // the section and its pages, in reading order
    protected static function sectionPages($page): array
    {
        $pages = [$page];
        foreach ($page->children()->visible() as $child) {
            $pages = array_merge($pages, self::sectionPages($child));
        }

        return $pages;
    }
}
