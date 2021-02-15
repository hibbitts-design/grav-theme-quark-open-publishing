<?php
namespace Grav\Plugin\Shortcodes;

use Grav\Common\Utils;
use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class GoogleSlidesShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getRawHandlers()->add('googleslides', function(ShortcodeInterface $sc) {

            // Get shortcode content and parameters
            $str = $sc->getContent();

            $googleslidesurl= $sc->getParameter('url', $sc->getBbCode());

            $googleslidesratio= $sc->getParameter('aspectratio', $sc->getBbCode());

            if (empty($googleslidesratio)) {
              $googleslidesratio = "16-9";
            }

            if ($googleslidesurl) {
                $output = '<span class="video-responsive video-responsive-'.$googleslidesratio.'"><iframe src="'.$googleslidesurl.'" frameborder="0" width="960" height="569" allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true"></iframe></span>';

                return $output;

            } else {

                if ($str) {

                    return '<span class="video-responsive video-responsive-'.$googleslidesratio.'"><iframe src="'.$str.'" frameborder="0" width="960" height="569" allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true"></iframe></span>';

                }

            }

        });
    }
}
