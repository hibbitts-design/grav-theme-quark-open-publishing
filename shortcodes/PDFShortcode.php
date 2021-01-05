<?php

namespace Grav\Plugin\Shortcodes;

use Grav\Common\Utils;
use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class PDFShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('pdf', function (ShortcodeInterface $sc) {

            // Get shortcode content and parameters
            $str = $sc->getContent();

            $pdfurl = $sc->getParameter('url', $sc->getBbCode());

            if ($pdfurl) {
                $output = '<div class="video-responsive"><iframe src="https://docs.google.com/gview?url=' . $pdfurl . '&embedded=true" width="640" height="480" style="border:none"></iframe></div>';

                return $output;

            } else {

              if ($str) {

                    return '<p><div class="video-responsive"><iframe src="https://docs.google.com/gview?url='.$str.'&embedded=true" width="640" height="480"></iframe></div></p>';

              }

          }

        });
    }
}
