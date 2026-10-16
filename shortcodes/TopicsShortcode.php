<?php
namespace Grav\Plugin\Shortcodes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

/**
 * [topics]...[/topics] - an alphabetical topics index with A-Z links at the top, made from single-letter
 * headings (## A, ## B, ...). The same shortcode and Markdown as in Bootstrap4 Open Matter (Open Course Hub)
 * and Grav Helios Course Hub, so a topics page moves between them unchanged - hibbittsdesign.org
 */
class TopicsShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('topics', function(ShortcodeInterface $sc) {
            // The content between [topics] and [/topics], already turned from Markdown into HTML
            $content = $sc->getContent();

            // Find the single-letter headings (<h2>A</h2>, <h2>B</h2>, ...) - these letters have topics
            preg_match_all('/<h2[^>]*>\s*([A-Z])\s*<\/h2>/i', $content, $matches);
            $lettersWithTopics = array_unique(array_map('strtoupper', $matches[1]));

            // The A-Z index: a letter with topics links to its heading; a letter without is shown faded,
            // and left out for screen readers (aria-hidden), which then hear only the letters they can follow
            $indexItems = [];
            foreach (range('A', 'Z') as $letter) {
                if (in_array($letter, $lettersWithTopics)) {
                    $indexItems[] = '<a href="#' . strtolower($letter) . '">' . $letter . '</a>';
                } else {
                    $indexItems[] = '<span class="topics-index-empty" aria-hidden="true">' . $letter . '</span>';
                }
            }
            $index = '<nav class="topics-index" aria-label="Topics A–Z index">' . implode('', $indexItems) . '</nav>';

            // Give each letter heading the anchor the index links to (#a, #b, ...) and the letter style
            $body = preg_replace_callback(
                '/<h2[^>]*>\s*([A-Z])\s*<\/h2>/i',
                function($match) {
                    $letter = strtoupper($match[1]);
                    return '<h2 class="topics-letter" id="' . strtolower($letter) . '">' . $letter . '</h2>';
                },
                $content
            );

            return '<div class="topics-section">' . $index . $body . '</div>';
        });
    }
}
