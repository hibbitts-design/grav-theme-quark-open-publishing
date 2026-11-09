<?php

namespace HibbittsDesign;

use Grav\Common\Grav;

/**
 * Content of a guide's pages - hibbittsdesign.org
 *
 *   beforeConversion()   a Glossary page lists its terms; guide pages use Markdown Extra (for footnotes)
 *   afterConversion()    footnotes screen readers can follow; table captions and figure numbers (FigureNumbers.php)
 *   skipCacheIfNumbered() pages in a numbered guide skip Grav's content cache (their numbers depend on other pages)
 *
 * The theme or plugin calls these from its own event handlers, with its guide page templates and translation prefix.
 * The same file is in Quark Open Publishing, Quark 2 Open Publishing and Helios Open Reader – keep the copies the same.
 */
class GuideContent
{
    // header settings added to pages before conversion, by page path, to remove again afterwards
    protected static $addedHeaderSettings = [];

    /**
     * Before a page's Markdown is converted (onPageContentRaw).
     */
    public static function beforeConversion($page, array $guideTemplates): void
    {
        $header = $page->header();

        // a Glossary page (a section, or a standard page in the guide) lists its terms at the end, unless
        // [glossary] places them
        if (is_array($header->glossary ?? null)) {
            $content = (string) $page->getRawContent();
            if (!preg_match('/\[glossary\s*\/?\]/', $content)) {
                $page->setRawContent(rtrim($content) . "\n\n[glossary]\n");
            }
        }

        if (!in_array($page->template(), $guideTemplates, true)) {
            return;
        }

        // Markdown Extra, unless the page sets markdown: extra: itself
        $markdown = (array) ($header->markdown ?? []);
        if (!array_key_exists('extra', $markdown)) {
            $markdown['extra'] = true;
            $header->markdown = $markdown;
            static::$addedHeaderSettings[$page->path()][] = 'markdown_extra';
        }
    }

    /**
     * After conversion (onPageContentProcessed). $prefix is the theme's or plugin's translation prefix, such as
     * 'THEME_QUARK_OPEN_PUBLISHING'.
     */
    public static function afterConversion($page, array $guideTemplates, string $prefix): void
    {
        static::removeAddedHeaderSettings($page);
        if (!in_array($page->template(), $guideTemplates, true)) {
            return;
        }

        $content = static::accessibleFootnotes($page->getRawContent(), $prefix);

        $language = Grav::instance()['language'];
        $content = static::figureNumbers()::process($page, $content, [
            'figure' => $language->translate($prefix . '.FIGURE_NUMBER'),
            'table' => $language->translate($prefix . '.TABLE_NUMBER'),
        ]);

        $page->setRawContent($content);
    }

    /**
     * When a page is opened (onPageInitialized): a page's figure numbers depend on the pages before it, but Grav's
     * content cache only notices changes to the page itself, so pages in a numbered guide skip it (unless the page
     * sets cache_enable itself).
     */
    public static function skipCacheIfNumbered($page, array $guideTemplates): void
    {
        if (!$page || !in_array($page->template(), $guideTemplates, true) || isset($page->header()->cache_enable)) {
            return;
        }
        if (static::figureNumbers()::numberingOn($page)) {
            $page->header()->cache_enable = false;
            static::$addedHeaderSettings[$page->path()][] = 'cache_enable';
        }
    }

    // footnote links with names and roles that screen readers understand
    protected static function accessibleFootnotes(string $content, string $prefix): string
    {
        if (strpos($content, 'footnote-ref') === false) {
            return $content;
        }

        // <a href="#fn:1" class="footnote-ref">1</a> gets role="doc-noteref" aria-label="Footnote 1"
        $content = preg_replace_callback('/(<a href="#fn:[^"]*" class="footnote-ref")>(\d+)<\/a>/', function ($match) use ($prefix) {
            $label = static::translateAttribute([$prefix . '.FOOTNOTE_REF', $match[2]]);
            return $match[1] . ' role="doc-noteref" aria-label="' . $label . '">' . $match[2] . '</a>';
        }, $content) ?? $content;

        $content = str_replace('class="footnote-backref"', 'class="footnote-backref" role="doc-backlink" aria-label="'
            . static::translateAttribute($prefix . '.FOOTNOTE_BACK') . '"', $content);
        $content = str_replace('<div class="footnotes">', '<div class="footnotes" role="doc-endnotes" aria-label="'
            . static::translateAttribute($prefix . '.FOOTNOTES') . '">', $content);

        return $content;
    }

    // remove the header settings added before conversion, so they can't be saved into the page's file
    protected static function removeAddedHeaderSettings($page): void
    {
        $header = $page->header();
        foreach (static::$addedHeaderSettings[$page->path()] ?? [] as $setting) {
            if ($setting === 'cache_enable') {
                unset($header->cache_enable);
            }
            if ($setting === 'markdown_extra') {
                $markdown = (array) ($header->markdown ?? []);
                unset($markdown['extra']);
                if ($markdown) {
                    $header->markdown = $markdown;
                } else {
                    unset($header->markdown);
                }
            }
        }
        unset(static::$addedHeaderSettings[$page->path()]);
    }

    // a translated string, escaped for an HTML attribute
    protected static function translateAttribute($key): string
    {
        return htmlspecialchars(Grav::instance()['language']->translate($key), ENT_QUOTES, 'UTF-8');
    }

    // FigureNumbers.php, from the same folder (loaded once, even with two copies installed)
    protected static function figureNumbers(): string
    {
        if (!class_exists(FigureNumbers::class)) {
            require_once __DIR__ . '/FigureNumbers.php';
        }

        return FigureNumbers::class;
    }
}
