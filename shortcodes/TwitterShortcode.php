<?php

namespace Grav\Plugin\Shortcodes;

use Grav\Common\Utils;
use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class TwitterShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('twitter', function (ShortcodeInterface $sc) {

            // Get shortcode content and parameters
            $str = $sc->getContent();

            $twitterurl = $sc->getParameter('url', $sc->getBbCode());
            $twittertext = $sc->getParameter('text', $sc->getBbCode());
            $twittertheme = $sc->getParameter('theme', $sc->getBbCode());
            $twitterheight = $sc->getParameter('height', $sc->getBbCode());

            if ($twitterurl) {
                $output = '<div class="twitter-feed-wrapper"><a class="twitter-timeline" data-height="' . $twitterheight . '" data-theme="' . $twittertheme . '" data-chrome="noscrollbar" href="' . $twitterurl . '">' . $twittertext . '</a><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?"http":"https";if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></div>';

                return $output;
            }

        });
    }
}
