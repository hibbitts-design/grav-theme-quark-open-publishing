<?php
namespace Grav\Plugin\Shortcodes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

/**
 * [hideifembedded]...[/hideifembedded] - content shown on the site, but hidden when the page is embedded
 * (for example in an LMS with ?embedded=true, or with the Chromeless Site setting on), as in Grav Open Course Hub
 * and Grav Helios Course Hub - hibbittsdesign.org
 *
 * The content is wrapped in a "chromeless-hide" box; css hides that box on embedded pages
 * (see templates/partials/base.html.twig), so the same cached page works both ways.
 */
class HideIfEmbeddedShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('hideifembedded', static function (ShortcodeInterface $sc) {
            return '<div class="chromeless-hide">' . $sc->getContent() . '</div>';
        });
    }
}
