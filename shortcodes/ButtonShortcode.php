<?php

namespace Grav\Plugin\Shortcodes;

use Grav\Common\Utils;
use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class ButtonShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('button', function (ShortcodeInterface $sc) {

            // Get shortcode content and parameters
            $str = $sc->getContent();

            $buttonurl = $sc->getParameter('url', $sc->getBbCode());
            $buttontarget = $sc->getParameter('target', $sc->getBbCode());
            $buttonstyle = $sc->getParameter('style', $sc->getBbCode());
            $buttonsize = $sc->getParameter('size', $sc->getBbCode());
            $buttonclasses = $sc->getParameter('classes', $sc->getBbCode());
            $buttonlabel = $sc->getParameter('label', $sc->getBbCode());

            if (empty($buttonsize)) {
                $buttonsize = "btn";
            } else {
                $buttonsize = "btn btn-" . $buttonsize;
            }

            if (!empty($buttonurl) && !empty($buttonlabel)) {
                $output = '<p><a href="' . $buttonurl . '" target="' . $buttontarget . '" class="' . $buttonsize . ' btn-' . $buttonstyle . ' ' . $buttonclasses . '">' . $buttonlabel . '</a></p>';

                return $output;
            }

        });
    }
}
