<?php
namespace Grav\Plugin\Shortcodes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

/**
 * [showifembedded]...[/showifembedded] - content shown only when the page is embedded (for example in an LMS
 * with ?embedded=true, or with the Chromeless Site setting on), as in Grav Open Course Hub and Grav Helios
 * Course Hub - hibbittsdesign.org
 *
 * The content is wrapped in a "chromeless-show" box, hidden by default; css shows that box on embedded pages
 * (see templates/partials/base.html.twig), so the same cached page works both ways.
 */
class ShowIfEmbeddedShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('showifembedded', static function (ShortcodeInterface $sc) {
            return '<div class="chromeless-show">' . $sc->getContent() . '</div>';
        });
    }
}
