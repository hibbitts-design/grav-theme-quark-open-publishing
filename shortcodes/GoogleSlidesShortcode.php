<?php
namespace Grav\Plugin\Shortcodes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class GoogleSlidesShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('googleslides', function(ShortcodeInterface $sc) {

            // the slides address, from url="..." or between the tags
            $googleslidesurl = $sc->getParameter('url', $sc->getBbCode());
            if (!$googleslidesurl) {
                $googleslidesurl = $sc->getContent();
            }

            // ratio="16:9" (the default) or "4:3" (as in Helios), or the earlier aspectratio="4-3"
            $ratio = $sc->getParameter('ratio', $sc->getParameter('aspectratio'));
            $ratioClass = '';
            if ($ratio === '4:3' || $ratio === '4-3') {
                $ratioClass = ' video-responsive-4-3';
            }

            // title="..." gives the slides an accessible name
            $title = htmlspecialchars($sc->getParameter('title', 'Google Slides presentation'), ENT_QUOTES, 'UTF-8');

            if ($googleslidesurl) {
                return '<span class="video-responsive' . $ratioClass . '"><iframe src="' . $googleslidesurl . '" title="' . $title . '" frameborder="0" width="960" height="569" allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true"></iframe></span>';
            }

        });
    }
}
