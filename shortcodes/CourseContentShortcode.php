<?php
namespace Grav\Plugin\Shortcodes;

use Grav\Common\Twig\Extension\GravExtension;
use Thunder\Shortcode\Shortcode\ShortcodeInterface;

/**
 * Course content shortcodes, with the same names and options as in Grav Helios Open Reader - hibbittsdesign.org
 *
 *   [objectives]...[/objectives]             [key-takeaways]...[/key-takeaways]   [reflection]...[/reflection]
 *   [definition]...[/definition]             [example]...[/example]               [case-study]...[/case-study]
 *   [project-brief]...[/project-brief]       [process-note]...[/process-note]     [feedback-requested]...[/feedback-requested]
 *   [announcement type="note"]...[/announcement]
 *   [exercise]...[/exercise]                 [references]...[/references]         [excerpt]...[/excerpt]
 *
 * Each one (except [excerpt]) can have its own heading, for example [objectives title="By the end of this week"].
 * The boxes use the theme's callout styles, like GitHub-style alerts (see css/callouts.css).
 */
class CourseContentShortcode extends Shortcode
{
    /**
     * The callout boxes: shortcode name => [alert type, default heading]
     * The alert types are the same as GitHub-style alerts: note, tip, important, warning and caution.
     */
    protected $callouts = [
        'objectives'         => ['tip', 'Learning Objectives'],
        'key-takeaways'      => ['note', 'Key Takeaways'],
        'reflection'         => ['tip', 'Reflection'],
        'definition'         => ['note', 'Definition'],
        'example'            => ['important', 'Example'],
        'case-study'         => ['caution', 'Case Study'],
        'project-brief'      => ['warning', 'Project Brief'],
        'process-note'       => ['note', 'Process Note'],
        'feedback-requested' => ['important', 'Feedback Requested'],
    ];

    // The alert types an [announcement] can use
    protected $alertTypes = ['note', 'tip', 'important', 'warning', 'caution'];

    public function init()
    {
        // The callout boxes
        foreach ($this->callouts as $name => $settings) {
            $type = $settings[0];
            $defaultTitle = $settings[1];

            $this->addShortcode($name, function (ShortcodeInterface $sc) use ($name, $type, $defaultTitle) {
                $title = $sc->getParameter('title', $defaultTitle);
                return $this->calloutBox($type, $title, $sc->getContent(), 'course-' . $name);
            });
        }

        // [announcement type="..."] - a callout box of any alert type (Important if not set)
        $this->addShortcode('announcement', function (ShortcodeInterface $sc) {
            $type = strtolower((string) $sc->getParameter('type', 'important'));
            if (!in_array($type, $this->alertTypes, true)) {
                $type = 'important';
            }
            $title = $sc->getParameter('title', 'Announcement');
            return $this->calloutBox($type, $title, $sc->getContent(), 'course-announcement');
        });

        // [exercise] - an activity box; the first link in it is shown as a button that opens the activity
        $this->addShortcode('exercise', function (ShortcodeInterface $sc) {
            $content = (string) $sc->getContent();
            $title = $sc->getParameter('title', 'Interactive Activity');

            if (preg_match('/<a\s[^>]*href=["\']([^"\']+)["\'][^>]*>/i', $content, $match)) {
                $link = htmlspecialchars(html_entity_decode($match[1], ENT_QUOTES, 'UTF-8'), ENT_QUOTES, 'UTF-8');
                $content = '<p><a class="btn btn-primary btn-sm" href="' . $link . '" target="_blank" rel="noopener">Open Interactive Activity <span aria-hidden="true">↗</span></a></p>';
            }

            return $this->calloutBox('tip', $title, $content, 'course-exercise');
        });

        // [references] - a list of sources, under a small heading
        $this->addShortcode('references', function (ShortcodeInterface $sc) {
            $content = $sc->getContent();
            if (!$content) {
                return '';
            }
            $title = htmlspecialchars($sc->getParameter('title', 'References'), ENT_QUOTES, 'UTF-8');

            return '<div class="course-references">'
                . '<p class="course-references-title">' . $title . '</p>'
                . '<div class="course-references-body">' . $content . '</div>'
                . '</div>';
        });

        // [excerpt] - a quoted passage
        $this->addShortcode('excerpt', function (ShortcodeInterface $sc) {
            $content = $sc->getContent();
            if (!$content) {
                return '';
            }
            return '<blockquote class="excerpt">' . $content . '</blockquote>';
        });
    }

    /**
     * Add a shortcode, unless another plugin already uses the same name (adding it twice would stop the site working)
     */
    protected function addShortcode($name, $handler)
    {
        $handlers = $this->shortcode->getHandlers();
        if ($handlers->has($name)) {
            return;
        }
        $handlers->add($name, $handler);
    }

    /**
     * A callout box: a heading and the shortcode's content, in the theme's callout style
     */
    protected function calloutBox($type, $title, $content, $extraClass)
    {
        if (!$content) {
            return '';
        }

        $safeTitle = htmlspecialchars((string) $title, ENT_QUOTES, 'UTF-8');

        return '<div class="md-alert md-alert--' . $type . ' ' . $extraClass . '" dir="auto">'
            . '<p class="md-alert-title">' . $this->alertIcon($type) . $safeTitle . '</p>'
            . '<div class="md-alert-body">' . $content . '</div>'
            . '</div>';
    }

    /**
     * The icon for an alert type: the GitHub Markdown Alerts plugin's icon when the plugin is installed
     * (so these boxes match > [!NOTE] alerts), otherwise a Font Awesome icon from the theme
     */
    protected function alertIcon($type)
    {
        if ($this->config->get('plugins.github-markdown-alerts.enabled')) {
            $icon = GravExtension::svgImageFunction('plugin://github-markdown-alerts/assets/icons/octicon-' . $type . '.svg');
            if ($icon) {
                return '<span aria-hidden="true">' . $icon . '</span> ';
            }
        }

        $fontAwesomeIcons = [
            'note'      => 'info-circle',
            'tip'       => 'lightbulb-o',
            'important' => 'exclamation-circle',
            'warning'   => 'exclamation-triangle',
            'caution'   => 'ban',
        ];

        return '<i class="fa fa-' . $fontAwesomeIcons[$type] . '" aria-hidden="true"></i> ';
    }
}
