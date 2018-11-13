<?php

namespace Grav\Plugin\Shortcodes;

use Grav\Common\Utils;
use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class EmbedlyShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('embedly', function (ShortcodeInterface $sc) {

            // Get shortcode content and parameters
            $str = $sc->getContent();

            $embedlycardurl = $sc->getParameter('url', $sc->getBbCode());

            if ($embedlycardurl) {
                $output = '<a class="embedly-card" data-card-controls="0" data-card-align="left" href="' . $embedlycardurl . '" ></a><script async src="//cdn.embedly.com/widgets/platform.js" charset="UTF-8"></script>';

                return $output;
            }

        });
    }
}
