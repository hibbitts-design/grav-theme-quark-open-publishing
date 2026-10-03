<?php
namespace Grav\Plugin\Shortcodes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class PDFShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('pdf', function (ShortcodeInterface $sc) {

            // the PDF's address, from url="..." or between the tags
            $pdfurl = $sc->getParameter('url', $sc->getBbCode());
            if (!$pdfurl) {
                $pdfurl = $sc->getContent();
            }

            // ratio="16:9" (the default), "4:3" or "portrait" (letter/A4, as in Helios)
            $ratio = $sc->getParameter('ratio');
            $ratioClass = '';
            if ($ratio === '4:3') {
                $ratioClass = ' video-responsive-4-3';
            } elseif ($ratio === 'portrait') {
                $ratioClass = ' video-responsive-portrait';
                // Spectre has no portrait ratio, so add one (an 11 x 8.5 letter page) - added via shortcode-core so it is kept for cached pages
                $this->shortcode->addAssets('inlineCss', '.video-responsive-portrait::before{padding-bottom:129.4118%}');
            }

            // title="..." gives the PDF an accessible name
            $title = htmlspecialchars($sc->getParameter('title', 'PDF document'), ENT_QUOTES, 'UTF-8');

            if ($pdfurl) {
                return '<span class="video-responsive' . $ratioClass . '"><iframe src="https://docs.google.com/gview?url=' . $pdfurl . '&embedded=true" title="' . $title . '" width="640" height="480" style="border:none"></iframe></span>';
            }

        });
    }
}
