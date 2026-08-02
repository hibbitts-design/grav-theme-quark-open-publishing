<?php

namespace Grav\Plugin\Shortcodes;

use Grav\Common\Grav;
use Grav\Common\HTTP\Client;
use Grav\Common\Utils;
use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class EmbedlyShortcode extends Shortcode
{
    const REACHABLE_CACHE_SECONDS = 604800;   // 7 days
    const UNREACHABLE_CACHE_SECONDS = 3600;   // 1 hour

    public function init()
    {
        $this->shortcode->getHandlers()->add('embedly', function (ShortcodeInterface $sc) {

            // Get shortcode content and parameters
            $str = $sc->getContent();

            $embedlycardurl = $sc->getParameter('url', $sc->getBbCode());

            if ($embedlycardurl) {
                $title = $sc->getParameter('title', '');
                $align = $sc->getParameter('align', 'left');

                return static::renderCard($embedlycardurl, $align, $title);
            }

        });
    }

    /**
     * Renders the embedly-card anchor, or a plain "unavailable" link if the target
     * URL isn't reachable. Shared by the shortcode and the standalone embedlycard
     * page type template, so both stay in sync automatically.
     */
    public static function renderCard(string $embedlycardurl, string $align = 'left', string $title = ''): string
    {
        $safeUrl = htmlspecialchars($embedlycardurl, ENT_QUOTES);

        if (!static::isUrlReachable($embedlycardurl)) {
            return '<a class="embedly-card embedly-card-unavailable" href="' . $safeUrl . '" target="_blank" rel="nofollow noopener noreferrer">This linked content is no longer available</a>';
        }

        $safeAlign = htmlspecialchars($align ?: 'left', ENT_QUOTES);
        $safeTitle = htmlspecialchars($title, ENT_QUOTES);

        Grav::instance()['assets']->addJs('//cdn.embedly.com/widgets/platform.js', ['loading' => 'async']);

        return '<a class="embedly-card" data-card-controls="0" data-card-align="' . $safeAlign . '" href="' . $safeUrl . '">' . $safeTitle . '</a>';
    }

    public static function isUrlReachable(string $url): bool
    {
        if (!preg_match('#^https?://#i', $url)) {
            return false;
        }

        $cache = Grav::instance()['cache'];
        $cacheKey = 'embedly-reachable-' . md5($url);
        $cached = $cache->fetch($cacheKey);

        if ($cached !== false) {
            return (bool) $cached['reachable'];
        }

        $isReachable = false;

        try {
            $response = Client::getClient()->request('GET', $url, ['timeout' => 5]);
            $isReachable = $response->getStatusCode() === 200;
        } catch (\Exception $e) {
            $isReachable = false;
        }

        $cache->save(
            $cacheKey,
            ['reachable' => $isReachable],
            $isReachable ? self::REACHABLE_CACHE_SECONDS : self::UNREACHABLE_CACHE_SECONDS
        );

        return $isReachable;
    }
}
