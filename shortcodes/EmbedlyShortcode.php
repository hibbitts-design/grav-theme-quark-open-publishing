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

            if (!$embedlycardurl) {
                $embedlycardurl = $str;
            }

            if (!$embedlycardurl) {
                return '';
            }

            // Values from the Embedly Card page type arrive HTML-escaped, so decode them before use
            $embedlycardurl = trim(html_entity_decode($embedlycardurl, ENT_QUOTES | ENT_HTML5));
            $title = html_entity_decode($sc->getParameter('title', ''), ENT_QUOTES | ENT_HTML5);
            $align = html_entity_decode($sc->getParameter('align', 'left'), ENT_QUOTES | ENT_HTML5);

            return static::renderCard($embedlycardurl, $this->config->get('theme.dark_mode.mode', 'disabled'), $align, $title);

        });
    }

    /**
     * Renders the embedly-card anchor, or a plain "unavailable" link if the target
     * URL isn't reachable. Shared by the shortcode and the standalone embedlycard
     * page type template, so both stay in sync automatically.
     */
    public static function renderCard(string $embedlycardurl, string $mode, string $align = 'left', string $title = ''): string
    {
        $safeUrl = htmlspecialchars($embedlycardurl, ENT_QUOTES);

        if (!static::isUrlReachable($embedlycardurl)) {
            return '<a class="embedly-card embedly-card-unavailable" href="' . $safeUrl . '" target="_blank" rel="nofollow noopener noreferrer">This linked content is no longer available</a>';
        }

        $safeAlign = htmlspecialchars($align ?: 'left', ENT_QUOTES);
        $safeTitle = htmlspecialchars($title, ENT_QUOTES);
        $darkAttr = ($mode === 'enabled') ? ' data-card-theme="dark"' : '';

        Grav::instance()['assets']->addJs('//cdn.embedly.com/widgets/platform.js', ['loading' => 'async']);

        if ($mode === 'auto') {
            Grav::instance()['assets']->addInlineJs(
                "if(window.matchMedia&&window.matchMedia('(prefers-color-scheme: dark)').matches){document.querySelectorAll('a.embedly-card').forEach(function(e){e.setAttribute('data-card-theme','dark')})}",
                ['group' => 'bottom']
            );
        }

        return '<a class="embedly-card" data-card-controls="0" data-card-align="' . $safeAlign . '"' . $darkAttr . ' href="' . $safeUrl . '">' . $safeTitle . '</a>';
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
            // Only a missing page counts as unavailable; sites behind bot protection (e.g. Cloudflare) answer server requests with 403 even when the page exists
            $isReachable = !in_array($response->getStatusCode(), [404, 410], true);
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
