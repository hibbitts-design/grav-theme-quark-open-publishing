<?php

namespace Grav\Plugin\Shortcodes;

use Grav\Common\Utils;
use Thunder\Shortcode\Shortcode\ShortcodeInterface;

/**
 * Deprecated: [twitter] will be removed in a future release. It embeds a timeline from X (Twitter), which X has
 * heavily restricted since 2023, so it often no longer displays. Use a plain link or [linkpreviewcard] instead - hibbittsdesign.org
 */
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
                $this->grav['assets']->addInlineJs(
                    '!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?"http":"https";if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");'
                );

                return '<div class="twitter-feed-wrapper"><a class="twitter-timeline" data-height="' . $twitterheight . '" data-theme="' . $twittertheme . '" data-chrome="noscrollbar" href="' . $twitterurl . '">' . $twittertext . '</a></div>';
            }

        });
    }
}
