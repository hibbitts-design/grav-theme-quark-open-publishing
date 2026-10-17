<?php
namespace Grav\Plugin\Shortcodes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

/**
 * [badge] - a small label in the text, such as "Draft", "New" or "Due Friday", with the same options as in
 * Grav Open Course Hub and Grav Helios Course Hub, so content moves between them unchanged - hibbittsdesign.org
 *
 * Examples: [badge label="Draft"]  [badge]Draft[/badge]  [badge label="New" color="green"]
 *           [badge label="New" type="success"]  [badge label="Read more" url="https://..."]
 * color can be default, blue, green, yellow, red, purple or plain (the same colours as section card badges);
 * type is the Bootstrap name used in Open Course Hub (primary, secondary, success, info, warning, danger, light, dark)
 */
class BadgeShortcode extends Shortcode
{
    /** The colours a badge can have (the same as the Badge Color setting on sections) */
    protected $colors = ['default', 'blue', 'green', 'yellow', 'red', 'purple', 'plain'];

    /** Open Course Hub's Bootstrap badge types, and the colour each one becomes here */
    protected $typeColors = [
        'primary'   => 'default',
        'secondary' => 'plain',
        'success'   => 'green',
        'info'      => 'blue',
        'warning'   => 'yellow',
        'danger'    => 'red',
        'light'     => 'plain',
        'dark'      => 'plain',
    ];

    public function init()
    {
        // Shortcode Core can include a starter [badge] of its own; remove it first so this one is used
        // (a shortcode name can only be added once)
        $handlers = $this->shortcode->getHandlers();
        if ($handlers->has('badge')) {
            $handlers->remove('badge');
        }
        $handlers->add('badge', function (ShortcodeInterface $sc) {
            // the badge text, from label="..." or the text between [badge] and [/badge]
            $label = (string) $sc->getParameter('label', '');
            if ($label === '') {
                $label = trim(strip_tags((string) $sc->getContent()));
            }
            if ($label === '') {
                return '';
            }

            // color="..." if it's one of ours, or else Open Course Hub's type="..." turned into a colour; plain by default
            $color = (string) $sc->getParameter('color', '');
            if (!in_array($color, $this->colors, true)) {
                $type = (string) $sc->getParameter('type', 'secondary');
                $color = isset($this->typeColors[$type]) ? $this->typeColors[$type] : 'plain';
            }

            $badge = '<span class="content-badge content-badge-' . $color . '">' . htmlspecialchars($label, ENT_QUOTES) . '</span>';

            // with url="...", the badge is a link, as in Open Course Hub
            $url = (string) $sc->getParameter('url', '');
            if ($url !== '') {
                $target = (string) $sc->getParameter('target', '_self');
                return '<a class="content-badge-link" href="' . htmlspecialchars($url, ENT_QUOTES) . '" target="' . htmlspecialchars($target, ENT_QUOTES) . '">' . $badge . '</a>';
            }

            return $badge;
        });
    }
}
