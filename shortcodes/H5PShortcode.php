<?php

namespace Grav\Plugin\Shortcodes;

use Grav\Common\Grav;
use Grav\Common\Utils;
use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class H5PShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('h5p', function (ShortcodeInterface $sc) {

            // Get shortcode content and parameters
            $str = $sc->getContent();

            $h5pid = $sc->getParameter('id', $sc->getBbCode());

            $h5psrc = null;

            if ($h5pid) {
                $config = Grav::instance()['config'];
                $h5proot = $config->get('themes.' . $config->get('system.pages.theme') . '.h5pembedrootpath');

                $h5psrc = (strpos($h5proot, 'h5p.com') !== false)
                    ? $h5proot . $h5pid . '/embed'
                    : $h5proot . $h5pid;
            } else {
                $h5purl = $sc->getParameter('url', $sc->getBbCode());
                $h5psrc = $h5purl ?: $str;
            }

            if ($h5psrc) {
                $this->grav['assets']->addJs('https://h5p.org/sites/all/modules/h5p/library/js/h5p-resizer.js');

                return '<span><iframe src="' . $h5psrc . '" width="400" height="300" frameborder="0" allowfullscreen="allowfullscreen"></iframe></span>';
            }

        });
    }
}
