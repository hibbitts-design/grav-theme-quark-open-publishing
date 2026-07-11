<?php

// Developed with the assistance of Claude Code (claude.ai)

namespace Grav\Plugin\Shortcodes;

use Grav\Common\Grav;
use Grav\Common\HTTP\Client;
use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class LinkPreviewCardShortcode extends Shortcode
{
    const SUCCESS_CACHE_SECONDS = 604800; // 7 days
    const FAILURE_CACHE_SECONDS = 3600;   // 1 hour

    public function init()
    {
        $this->shortcode->getHandlers()->add('linkpreviewcard', [$this, 'handleShortcode']);
    }

    public function handleShortcode(ShortcodeInterface $shortcode)
    {
        $url = $shortcode->getParameter('url', $shortcode->getBbCode());

        if (!$url) {
            $url = $shortcode->getContent();
        }

        if (!$url) {
            return '';
        }

        return $this->renderCard($url);
    }

    private function renderCard(string $url): string
    {
        $url = trim($url);

        if (!$this->isHttpUrl($url)) {
            $safeUrl = htmlspecialchars($url, ENT_QUOTES);
            return '<a href="' . $safeUrl . '">' . $safeUrl . '</a>';
        }

        $cache = Grav::instance()['cache'];
        $cacheKey = 'linkpreviewcard-' . md5($url);
        $linkData = $cache->fetch($cacheKey);

        if ($linkData === false) {
            $linkData = $this->fetchLinkData($url);
            $cacheSeconds = $linkData['ok'] ? self::SUCCESS_CACHE_SECONDS : self::FAILURE_CACHE_SECONDS;
            $cache->save($cacheKey, $linkData, $cacheSeconds);
        }

        return $this->buildCardHtml($url, $linkData);
    }

    private function isHttpUrl(string $url): bool
    {
        return (bool) preg_match('#^https?://#i', $url);
    }

    private function fetchLinkData(string $url): array
    {
        $linkData = [
            'ok' => false,
            'title' => null,
            'description' => null,
            'image' => null,
            'site_name' => null,
            'favicon' => null,
        ];

        try {
            $response = Client::getClient()->request('GET', $url, ['timeout' => 5]);

            if ($response->getStatusCode() !== 200) {
                return $linkData;
            }

            $html = $response->getContent();

            libxml_use_internal_errors(true);
            $document = new \DOMDocument();
            $document->loadHTML($html);
            libxml_use_internal_errors(false);

            $xpath = new \DOMXPath($document);

            $linkData['title'] = $this->getMetaTagContent($xpath, 'og:title') ?? $this->getPageTitle($xpath);
            $linkData['description'] = $this->pickLongerDescription(
                $this->getMetaTagContent($xpath, 'og:description'),
                $this->getMetaDescription($xpath)
            );
            $linkData['site_name'] = $this->getMetaTagContent($xpath, 'og:site_name') ?? $this->getHostName($url);

            $image = $this->getMetaTagContent($xpath, 'og:image');
            $linkData['image'] = $image ? $this->resolveUrl($url, $image) : null;

            $linkData['favicon'] = $this->resolveUrl($url, $this->getFaviconPath($xpath));

            $linkData['ok'] = (bool) ($linkData['title'] || $linkData['description']);
        } catch (\Exception $e) {
            error_log('LinkPreviewCardShortcode: failed to fetch ' . $url . ' - ' . $e->getMessage());
        }

        return $linkData;
    }

    private function getMetaTagContent(\DOMXPath $xpath, string $property): ?string
    {
        $nodes = $xpath->query('//meta[@property="' . $property . '"]/@content');

        if ($nodes->length === 0) {
            return null;
        }

        $value = trim($nodes->item(0)->nodeValue);

        return $value !== '' ? $value : null;
    }

    private function getPageTitle(\DOMXPath $xpath): ?string
    {
        $nodes = $xpath->query('//title');

        return $nodes->length > 0 ? trim($nodes->item(0)->textContent) : null;
    }

    private function getMetaDescription(\DOMXPath $xpath): ?string
    {
        $nodes = $xpath->query('//meta[@name="description"]/@content');

        return $nodes->length > 0 ? trim($nodes->item(0)->nodeValue) : null;
    }

    private function pickLongerDescription(?string $ogDescription, ?string $metaDescription): ?string
    {
        if (!$ogDescription) {
            return $metaDescription;
        }

        if (!$metaDescription) {
            return $ogDescription;
        }

        return strlen($metaDescription) > strlen($ogDescription) ? $metaDescription : $ogDescription;
    }

    private function getFaviconPath(\DOMXPath $xpath): string
    {
        $nodes = $xpath->query('//link[@rel="icon" or @rel="shortcut icon" or @rel="apple-touch-icon"]/@href');

        return $nodes->length > 0 ? trim($nodes->item(0)->nodeValue) : '/favicon.ico';
    }

    private function getHostName(string $url): ?string
    {
        $host = parse_url($url, PHP_URL_HOST);

        return $host ? preg_replace('/^www\./', '', $host) : null;
    }

    private function resolveUrl(string $baseUrl, string $urlToResolve): ?string
    {
        if ($this->isHttpUrl($urlToResolve)) {
            return $urlToResolve;
        }

        $baseParts = parse_url($baseUrl);

        if (!isset($baseParts['scheme'], $baseParts['host'])) {
            return null;
        }

        $origin = $baseParts['scheme'] . '://' . $baseParts['host'];

        if (strpos($urlToResolve, '//') === 0) {
            return $baseParts['scheme'] . ':' . $urlToResolve;
        }

        if (strpos($urlToResolve, '/') === 0) {
            return $origin . $urlToResolve;
        }

        $baseDirectory = rtrim(dirname($baseParts['path'] ?? '/'), '/');

        return $origin . $baseDirectory . '/' . $urlToResolve;
    }

    /**
     * All layout/sizing is inlined so the card looks right in any theme with zero CSS setup.
     * Anything not set here (color, font-family, link decoration) is left to inherit from
     * the surrounding theme on purpose, so the card blends into whatever site it's dropped into.
     */
    private function buildCardHtml(string $url, array $linkData): string
    {
        $safeUrl = htmlspecialchars($url, ENT_QUOTES);

        if (!$linkData['ok']) {
            return '<a href="' . $safeUrl . '" class="link-preview-fallback" style="word-break:break-all;">' . $safeUrl . '</a>';
        }

        $title = htmlspecialchars($linkData['title'] ?? $url, ENT_QUOTES);
        $description = htmlspecialchars($linkData['description'] ?? '', ENT_QUOTES);
        $host = $this->getHostName($url) ?? $url;
        $safeHost = htmlspecialchars($host, ENT_QUOTES);
        $siteName = htmlspecialchars($linkData['site_name'] ?? $host, ENT_QUOTES);

        $imageHtml = $linkData['image']
            ? $this->buildImageHtml($linkData['image'], $title)
            : '';

        $faviconHtml = $linkData['favicon']
            ? $this->buildFaviconHtml($linkData['favicon'])
            : '';

        $descriptionHtml = $description !== ''
            ? '<p class="link-preview-card-description" style="font-size:0.8em;line-height:1.5;margin:0;opacity:0.75;">' . $description . '</p>'
            : '';

        return <<<HTML
        <div class="link-preview-card" style="max-width:600px;overflow:hidden;font-family:inherit;">
            <div class="link-preview-card-header" style="display:flex;align-items:center;gap:0.4em;padding-top:0.25em;">
                {$faviconHtml}
                <span class="link-preview-card-sitename" style="font-size:0.7em;font-weight:700;letter-spacing:0.04em;text-transform:uppercase;opacity:0.65;">{$siteName}</span>
            </div>
            {$imageHtml}
            <div class="link-preview-card-body" style="padding:0.4em 0;">
                <h3 class="link-preview-card-title" style="font-size:1.1em;font-weight:700;margin:0 0 0.4em;">{$title}</h3>
                {$descriptionHtml}
                <a href="{$safeUrl}" class="link-preview-card-cta" target="_blank" rel="nofollow noopener noreferrer" style="display:block;font-size:0.8em;font-weight:600;margin-top:0;">Read more on {$safeHost} &rsaquo;</a>
            </div>
        </div>
        HTML;
    }

    private function buildImageHtml(string $imageUrl, string $safeTitle): string
    {
        $safeImage = htmlspecialchars($imageUrl, ENT_QUOTES);

        return '<img src="' . $safeImage . '" class="link-preview-card-img" alt="' . $safeTitle . '"'
            . ' style="display:block;width:100%;height:auto;margin-top:0.4em;">';
    }

    private function buildFaviconHtml(string $faviconUrl): string
    {
        $safeFavicon = htmlspecialchars($faviconUrl, ENT_QUOTES);

        return '<img src="' . $safeFavicon . '" class="link-preview-card-favicon" alt="" onerror="this.remove()"'
            . ' style="width:1em;height:1em;object-fit:contain;vertical-align:middle;">';
    }
}
