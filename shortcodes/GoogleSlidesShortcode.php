<?php
namespace Grav\Plugin\Shortcodes;

use Grav\Common\Utils;
use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class GoogleSlidesShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('googleslides', function(ShortcodeInterface $sc) {

            // Get shortcode content and parameters
            $str = $sc->getContent();

            $googleslidesurl= $sc->getParameter('url', $sc->getBbCode());

            $googleslidesratio= $sc->getParameter('aspectratio', $sc->getBbCode());

            if (empty($googleslidesratio)) {
              $googleslidesratio = "16-9";
            }

            if ($googleslidesurl) {
                $output = '<p><div class="video-responsive video-responsive-'.$googleslidesratio.'"><iframe src="'.$googleslidesurl.'" frameborder="0" width="960" height="569" allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true"></iframe></div></p>';

                return $output;
            }

        });
    }
}
