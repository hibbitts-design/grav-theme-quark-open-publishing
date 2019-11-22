<?php
namespace Grav\Plugin\Shortcodes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;
use Grav\Common\Page;
use Grav\Common\Utils;

class MarkdownFileShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('markdownfile', function(ShortcodeInterface $sc) {

            // Get shortcode content and parameters
            $str = $sc->getContent();

            $markdownfileurl= $sc->getParameter('url', $sc->getBbCode());

              try {

                  $headers = get_headers($markdownfileurl);
                  $headers = substr($headers[0], 9, 3);

                  if ($headers != "200") {

                      return "Unable to retrieve file with URL " . $markdownfileurl ;

                  }

                  $file = file_get_contents($markdownfileurl);
                  $file = preg_replace('/---[\s\S]*---/', '', $file);
                  $markdown = Utils::processMarkdown($file);

                  return $markdown;

              } catch (Exception $e) {

                  error_log($e);

              }

              return;

        });
    }
}
