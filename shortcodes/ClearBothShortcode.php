<?php

namespace Grav\Plugin\Shortcodes;

use Grav\Common\Utils;
use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class ClearBothShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('clearboth', function (ShortcodeInterface $sc) {

            // Get shortcode content and parameters
            $str = $sc->getContent();

            $output = '<div style="clear: both;"></div>';

            return $output;

        });
    }
}
