<?php

namespace Grav\Plugin\Shortcodes;

use Grav\Common\Utils;
use Thunder\Shortcode\Shortcode\ShortcodeInterface;

/**
 * Glossary shortcodes - hibbittsdesign.org
 *
 *   [term]OER[/term]                            a term, linked to its glossary entry (js/glossary.js shows the definition)
 *   [term name="OER"]open resources[/term]      when the text differs from the term in the glossary
 *   [glossary]                                  the glossary's terms, in alphabetical order
 *
 * A guide's Glossary page is a page in the guide with the terms in its front matter:
 *
 *   glossary:
 *     - term: OER
 *       definition: 'Open Educational Resources'
 *
 * The same file is in Quark Open Publishing, Quark 2 Open Publishing and Helios Open Reader – keep the copies the same.
 */
class GlossaryShortcode extends Shortcode
{
    // published pages with a glossary, found once per request
    protected static $glossaryPages = null;

    public function init()
    {
        $this->shortcode->getHandlers()->add('term', function (ShortcodeInterface $sc) {
            return $this->renderTerm($sc);
        });

        $this->shortcode->getHandlers()->add('glossary', function (ShortcodeInterface $sc) {
            return $this->renderGlossary();
        });
    }

    protected function renderTerm(ShortcodeInterface $sc): string
    {
        $text = (string) $sc->getContent();
        $name = $this->plainText((string) $sc->getParameter('name', $text));
        $page = $this->currentPage();

        $glossaryPage = $page ? $this->glossaryPageFor($page) : null;
        $entry = $glossaryPage ? ($this->entries($glossaryPage)[$this->key($name)] ?? null) : null;
        if (!$entry) {
            return $text; // not in the glossary: plain text
        }

        $samePage = $glossaryPage->rawRoute() === $page->rawRoute();
        $href = ($samePage ? '' : $glossaryPage->url()) . '#' . $entry['id'];

        return '<a class="glossary-term" href="' . $this->escape($href) . '"'
            . ' data-glossary-term="' . $this->escape($entry['term']) . '"'
            . ' data-glossary-definition="' . $this->escape($this->plainText(Utils::processMarkdown($entry['definition'], false))) . '"'
            . ' data-glossary-link-text="' . $this->escape($glossaryPage->title()) . '">'
            . $text . '</a>';
    }

    protected function renderGlossary(): string
    {
        $page = $this->currentPage();
        $entries = $page ? $this->allEntries($page) : [];
        if (!$entries) {
            return '';
        }

        usort($entries, function ($a, $b) {
            return strnatcasecmp($a['term'], $b['term']);
        });

        // Not a <dl>: Grav's .md output would run each term into its definition.
        // The term/definition roles keep the pairing for screen readers.
        $output = '<div class="glossary-list">' . "\n";
        foreach ($entries as $entry) {
            $id = $this->escape($entry['id']);
            $output .= '<div class="glossary-entry" id="' . $id . '">' . "\n"
                . '<p class="glossary-entry-term"><strong role="term" id="' . $id . '-term">' . $this->escape($entry['term']) . '</strong></p>' . "\n"
                . '<div class="glossary-entry-definition" role="definition" aria-labelledby="' . $id . '-term">'
                . Utils::processMarkdown($entry['definition'], true) . '</div>' . "\n"
                . '</div>' . "\n";
        }

        return $output . '</div>';
    }

    /**
     * The first Glossary page inside the page's guide, or the site's first one when the page isn't in a guide.
     */
    protected function glossaryPageFor($page)
    {
        $home = $this->guideHome($page);

        foreach ($this->glossaryPages() as $glossaryPage) {
            if (!$home || $this->isInside($glossaryPage, $home)) {
                return $glossaryPage;
            }
        }

        return null;
    }

    protected function glossaryPages(): array
    {
        if (static::$glossaryPages === null) {
            static::$glossaryPages = [];
            foreach ($this->grav['pages']->all() as $page) {
                if ($page->published() && is_array($page->header()->glossary ?? null)) {
                    static::$glossaryPages[] = $page;
                }
            }
        }

        return static::$glossaryPages;
    }

    // the nearest Section List or Sections page above the page (or the page itself)
    protected function guideHome($page)
    {
        for ($current = $page; $current && !$current->root(); $current = $current->parent()) {
            if (in_array($current->template(), ['section-list', 'sections'], true)) {
                return $current;
            }
        }

        return null;
    }

    // raw routes, as a guide that is the site's home page has the route "/"
    protected function isInside($page, $home): bool
    {
        $homeRoute = rtrim($home->rawRoute(), '/');

        return $page->rawRoute() === $homeRoute || strpos($page->rawRoute(), $homeRoute . '/') === 0;
    }

    /**
     * All of a page's glossary entries, as written: ['term' => ..., 'definition' => ..., 'id' => ...]
     */
    protected function allEntries($page): array
    {
        $entries = [];
        $usedIds = [];
        foreach ((array) ($page->header()->glossary ?? []) as $item) {
            $term = trim((string) ($item['term'] ?? ''));
            if ($term === '') {
                continue;
            }
            // "Open Resources" -> "glossary-open-resources" (terms with no Latin letters get a short hash)
            $slug = trim(preg_replace('/[^a-z0-9]+/', '-', mb_strtolower($term)), '-');
            $id = $baseId = 'glossary-' . ($slug !== '' ? $slug : substr(md5($term), 0, 8));
            // a repeated term still gets its own id: "glossary-oer-2"
            for ($n = 2; isset($usedIds[$id]); $n++) {
                $id = $baseId . '-' . $n;
            }
            $usedIds[$id] = true;

            $entries[] = [
                'term' => $term,
                'definition' => (string) ($item['definition'] ?? ''),
                'id' => $id,
            ];
        }

        return $entries;
    }

    /**
     * A page's glossary entries keyed by term in lower case. A repeated term uses its first definition
     * (the Glossary page lists every entry, so the author can see the repeat).
     */
    protected function entries($page): array
    {
        $byTerm = [];
        foreach ($this->allEntries($page) as $entry) {
            $byTerm += [$this->key($entry['term']) => $entry];
        }

        return $byTerm;
    }

    protected function currentPage()
    {
        return $this->shortcode->getPage() ?? $this->grav['page'];
    }

    protected function key(string $term): string
    {
        return mb_strtolower(trim($term));
    }

    protected function plainText(string $html): string
    {
        return trim(html_entity_decode(strip_tags($html), ENT_QUOTES, 'UTF-8'));
    }

    protected function escape(string $text): string
    {
        return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
    }
}
