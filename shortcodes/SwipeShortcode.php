<?php

namespace Grav\Plugin\Shortcodes;

use Grav\Common\Utils;
use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class SwipeShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('swipe', function (ShortcodeInterface $sc) {

            // Get shortcode content and parameters
            $str = $sc->getContent();

            $swipedeckid = $sc->getParameter('id', $sc->getBbCode());

            if ($swipedeckid) {
                $output = '<div class="embed-responsive embed-responsive-16by9"><figure><iframe width="600" height="338" src="https://www.swipe.to/embed/' . $swipedeckid . '" allowfullscreen></iframe></figure></div><br>';

                return $output;
            }

        });
    }
}
