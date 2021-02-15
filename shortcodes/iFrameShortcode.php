<?php
namespace Grav\Plugin\Shortcodes;

use Grav\Common\Utils;
use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class iFrameShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('iframe', function(ShortcodeInterface $sc) {

            // Get shortcode content and parameters
            $str = $sc->getContent();

            $iframeurl= $sc->getParameter('url', $sc->getBbCode());

            $iframeratio= $sc->getParameter('aspectratio', $sc->getBbCode());

            if (empty($iframeaspectratio)) {
              $iframeaspectratio = "";
            }

            if ($iframeurl) {
                $output = '<span class="video-responsive video-responsive-'.$iframeaspectratio.'"><iframe src="'.$iframeurl.'" width="640" height="480"></iframe></span>';

                return $output;
            }

        });
    }
}
