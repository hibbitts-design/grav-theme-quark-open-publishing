<?php
namespace Grav\Plugin\Shortcodes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class iFrameShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('iframe', function(ShortcodeInterface $sc) {

            $iframeurl = $sc->getParameter('url', $sc->getBbCode());

            // ratio="16:9" (the default), "4:3" or "1:1" (as in Helios), or the earlier aspectratio="4-3" or "1-1"
            $ratio = $sc->getParameter('ratio', $sc->getParameter('aspectratio'));
            $ratioClass = '';
            if ($ratio === '4:3' || $ratio === '4-3') {
                $ratioClass = ' video-responsive-4-3';
            } elseif ($ratio === '1:1' || $ratio === '1-1') {
                $ratioClass = ' video-responsive-1-1';
            }

            // title="..." gives the embedded content an accessible name
            $title = htmlspecialchars($sc->getParameter('title', 'Embedded content'), ENT_QUOTES, 'UTF-8');

            if ($iframeurl) {
                return '<span class="video-responsive' . $ratioClass . '"><iframe src="' . $iframeurl . '" title="' . $title . '" width="640" height="480"></iframe></span>';
            }

        });
    }
}
