<?php

namespace Grav\Plugin\Shortcodes;

use Grav\Common\Utils;
use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class SpeakerdeckShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('speakerdeck', function (ShortcodeInterface $sc) {

            // Get shortcode content and parameters
            $str = $sc->getContent();

            $speakerdeckid = $sc->getParameter('id', $sc->getBbCode());

            if ($speakerdeckid) {
                $output = '<script async class="speakerdeck-embed" data-id=".$speakerdeckid." data-ratio="1.77777777777778" src="//speakerdeck.com/assets/embed.js"></script>';

                return $output;
            }

        });
    }
}
