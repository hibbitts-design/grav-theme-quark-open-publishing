<?php
namespace Grav\Theme;

use Grav\Common\Grav;
use Grav\Common\Theme;

class QuarkOpenPublishing extends Quark
{

    public static function getblogpageheroclasses()
    {
        $config = Grav::instance()['config'];
        return $config->get('themes.' . $config->get('system.pages.theme') . '.blog_page_hero_classes');
    }

    public static function getSubscribedEvents()
    {
        return [
            'onTwigLoader' => ['onTwigLoader', 0],
            'onShortcodeHandlers' => ['onShortcodeHandlers', 0],
            'onTwigSiteVariables' => ['onTwigSiteVariables', 0],
            'onTwigInitialized' => ['onTwigInitialized', 0],
            'registerNextGenEditorPlugin' => ['registerNextGenEditorPluginShortcodes', 0]
        ];
    }

    public function registerNextGenEditorPluginShortcodes($event) {
        $plugins = $event['plugins'];

        $plugins['js'][] = 'user://themes/quark-open-publishing/nextgen-editor/shortcodes/googleslides.js';
        $plugins['js'][] = 'user://themes/quark-open-publishing/nextgen-editor/shortcodes/h5p.js';
        $plugins['js'][] = 'user://themes/quark-open-publishing/nextgen-editor/shortcodes/pdf.js';

        $event['plugins']  = $plugins;
        return $event;
    }

    // Add images to twig template paths to allow inclusion of SVG files
    public function onTwigLoader()
    {
        $theme_paths = Grav::instance()['locator']->findResources('theme://images');
        foreach (array_reverse($theme_paths) as $images_path) {
            $this->grav['twig']->addPath($images_path, 'images');
        }
    }

    public function onTwigInitialized()
    {
        $twig = $this->grav['twig'];

        $form_class_variables = [
            //'form_outer_classes' => 'form-horizontal',
            'form_button_outer_classes' => 'button-wrapper',
            'form_button_classes' => 'btn',
            'form_errors_classes' => '',
            'form_field_outer_classes' => 'form-group',
            'form_field_outer_label_classes' => 'form-label-wrapper',
            'form_field_label_classes' => 'form-label',
            //'form_field_outer_data_classes' => 'col-9',
            'form_field_input_classes' => 'form-input',
            'form_field_textarea_classes' => 'form-input',
            'form_field_select_classes' => 'form-select',
            'form_field_radio_classes' => 'form-radio',
            'form_field_checkbox_classes' => 'form-checkbox',
        ];

        $twig->twig_vars = array_merge($twig->twig_vars, $form_class_variables);

    }

    public function onShortcodeHandlers()
    {
        $this->grav['shortcode']->registerAllShortcodes('theme://shortcodes');
    }

    public function onTwigSiteVariables()
    {
        if ($this->isAdmin() && ($this->grav['config']->get('plugins.shortcode-core.enabled'))) {
            $this->grav['assets']->add('theme://editor-buttons/admin/js/shortcode-pdf.js');
            $this->grav['assets']->add('theme://editor-buttons/admin/js/shortcode-h5p.js');
        }
    }

}

?>
