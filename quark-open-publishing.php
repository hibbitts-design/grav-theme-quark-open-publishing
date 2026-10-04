<?php

// Developed with the assistance of Claude Code (claude.ai)

namespace Grav\Theme;

use Grav\Common\Grav;
use Grav\Common\Theme;
use RocketTheme\Toolbox\Event\Event;

class QuarkOpenPublishing extends Quark
{
    // The search route set in the SimpleSearch plugin, for example '/search'
    protected $searchRoute = '/search';

    public static function getblogpageheroclasses()
    {
        $config = Grav::instance()['config'];
        return $config->get('themes.' . $config->get('system.pages.theme') . '.blog_page_hero_classes');
    }

    public static function getSubscribedEvents()
    {
        return [
            'onThemeInitialized' => ['onThemeInitialized', 0],
            'onTwigLoader' => ['onTwigLoader', 0],
            // after plugins (priority 0), so a shortcode name a plugin already uses is left to that plugin
            'onShortcodeHandlers' => ['onShortcodeHandlers', -10],
            'onTwigSiteVariables' => ['onTwigSiteVariables', 0],
            'onTwigInitialized' => ['onTwigInitialized', 0],
            'onPagesInitialized' => ['onSearchPagesInitialized', 10],
            'onSimpleSearchCollection' => ['onSimpleSearchCollection', 0]
        ];
    }

    public function onThemeInitialized()
    {
        // Style GitHub-style alerts (> [!NOTE] etc., as in Helios) with the theme's own callout styles (css/callouts.css),
        // unless the GitHub Markdown Alerts plugin's wrapper class has been customised
        if ($this->config->get('plugins.github-markdown-alerts.wrapper_class', 'md-alert md-alert--') === 'md-alert md-alert--') {
            $this->config->set('plugins.github-markdown-alerts.include_css', false);
        }
    }

    // Add images to twig template paths to allow inclusion of SVG files
    public function onTwigLoader()
    {
        $theme_paths = Grav::instance()['locator']->findResources('theme://images');
        foreach ($theme_paths as $images_path) {
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

        // Make open_publishing_search_groups() available to the search results template
        $twig->twig()->addFunction(
            new \Twig\TwigFunction('open_publishing_search_groups', [$this, 'searchGroups'])
        );
    }

    public function onShortcodeHandlers()
    {
        $this->grav['shortcode']->registerAllShortcodes('theme://shortcodes');
    }

    public function onTwigSiteVariables()
    {
        $uri = $this->grav['uri'];
        $twig = $this->grav['twig'];

        // Embedded mode via Grav params (/chromeless:true, /embedded:true, /standalone:true)
        // or query strings (?embedded=true, ?chromeless=true, ?standalone=true – as in Helios)
        $embeddedMode = false;
        foreach (['chromeless', 'embedded', 'standalone'] as $name) {
            if ($this->isTrueParam($uri->param($name)) || $this->isTrueParam($uri->query($name))) {
                $embeddedMode = true;
            }
        }
        $twig->twig_vars['embedded_mode'] = $embeddedMode;

        // Hide the Git Sync link via ?edit_link=false or ?hidegitlink=true (as in Helios), or /edit_link:false or /hidegitlink:true
        $hideGitLink = false;
        if ($uri->query('edit_link') === 'false' || $uri->param('edit_link') === 'false') {
            $hideGitLink = true;
        }
        if ($this->isTrueParam($uri->query('hidegitlink')) || $this->isTrueParam($uri->param('hidegitlink'))) {
            $hideGitLink = true;
        }
        $twig->twig_vars['hide_git_link'] = $hideGitLink;

        // The SimpleSearch route, for the search box
        $twig->twig_vars['search_route'] = $this->searchRoute;

        // The Multi-Page Content (Section List) page that search is limited to, if any (see getSearchScopePage)
        $twig->twig_vars['search_scope_page'] = $this->getSearchScopePage();

        if ($this->isAdmin() && ($this->grav['config']->get('plugins.shortcode-core.enabled'))) {
            $this->grav['assets']->add('theme://editor-buttons/admin/js/shortcode-pdf.js');
            $this->grav['assets']->add('theme://editor-buttons/admin/js/shortcode-h5p.js');
        }
    }

    /**
     * Is a URL parameter turned on? (anything except empty, false or 0)
     */
    private function isTrueParam($value)
    {
        return $value !== null && $value !== false && $value !== '' && $value !== 'false' && $value !== '0';
    }

    /*
     * ------------------------------------------------------------------------------------------------
     * Search (SimpleSearch plugin), with results grouped by section, best matches first and the
     * search words highlighted, as in Grav Helios Open Reader - hibbittsdesign.org
     * ------------------------------------------------------------------------------------------------
     */

    /**
     * Remember the search route set in the SimpleSearch plugin (a page-based '@self' route is left to the plugin)
     */
    public function onSearchPagesInitialized()
    {
        if ($this->isAdmin() || !$this->config->get('plugins.simplesearch.enabled')) {
            return;
        }

        $route = (string) $this->config->get('plugins.simplesearch.route', '/search');
        if ($route !== '' && $route !== '/' && $route[0] === '/') {
            $this->searchRoute = $route;
        }
    }

    /**
     * Before SimpleSearch looks for the search words: leave out pages that are not worth finding
     */
    public function onSimpleSearchCollection(Event $event)
    {
        $collection = $event['collection'];

        // the footer and sidebar are shared parts of every page, and the Search page only describes searching
        $skipRoutes = ['/footer', '/sidebar', $this->searchRoute];

        // When searching from a Multi-Page Content page, only its own pages are searched
        $scopePage = $this->getSearchScopePage();

        // First find the pages to leave out, then remove them (removing pages while looping over them can skip some)
        $pagesToRemove = [];
        foreach ($collection as $page) {
            if (in_array($page->route(), $skipRoutes, true)) {
                $pagesToRemove[] = $page;
            } elseif ($this->isInHiddenTopLevelPage($page)) {
                $pagesToRemove[] = $page;
            } elseif ($scopePage && !$this->isPageOrChildOf($page, $scopePage)) {
                $pagesToRemove[] = $page;
            }
        }
        foreach ($pagesToRemove as $page) {
            $collection->remove($page);
        }
    }

    /**
     * The page that search is limited to, from ?scope=/its-route (added by the search box on a Multi-Page Content page).
     * Only a Section List page is accepted; otherwise (or with no scope) this returns null and the whole site is searched.
     */
    protected function getSearchScopePage()
    {
        // The scope from the address, for example '/open-education-essentials' (empty when there isn't one)
        $scope = (string) $this->grav['uri']->query('scope');

        // No scope, or not a page address (page addresses start with /): search the whole site
        if ($scope === '') {
            return null;
        }
        if (substr($scope, 0, 1) !== '/') {
            return null;
        }

        // Find the page at that address
        $scopePage = $this->grav['pages']->find($scope);

        // No page there, or it isn't a Section List page: search the whole site
        if (!$scopePage) {
            return null;
        }
        if ($scopePage->template() !== 'section-list') {
            return null;
        }

        return $scopePage;
    }

    /**
     * Is the page the given parent page itself, or one of the pages inside it?
     */
    protected function isPageOrChildOf($page, $parentPage)
    {
        // rawRoute() is the page's address from its folders, for example '/open-education-essentials'. Unlike route(), it
        // stays the same when the page is the site's home page (whose route is '/', which every page would be inside)
        $route = $page->rawRoute();
        $parentRoute = $parentPage->rawRoute();

        // the parent page itself
        if ($route === $parentRoute) {
            return true;
        }

        // a page inside it: its route starts with the parent's route and a slash,
        // for example '/open-education-essentials/what-is-open-education' starts with '/open-education-essentials/'
        $parentRouteWithSlash = $parentRoute . '/';
        $start = substr($route, 0, strlen($parentRouteWithSlash));
        if ($start === $parentRouteWithSlash) {
            return true;
        }

        return false;
    }

    /**
     * Is the page a top-level page set to visible: false, or inside one? (for example, an older demo page kept
     * at its address but hidden from the menu). Only an explicit visible: false counts, so top-level pages
     * that are hidden just because their folder has no number (such as "readme") are still searched.
     */
    protected function isInHiddenTopLevelPage($page)
    {
        // the top-level page is the first of the page's parents, or the page itself when it has none
        $topLevelPage = $page;
        $parents = $this->getParentPages($page);
        if (count($parents) > 0) {
            $topLevelPage = $parents[0];
        }

        // hidden only when its settings say visible: false
        $header = $topLevelPage->header();
        if (isset($header->visible) && $header->visible === false) {
            return true;
        }

        return false;
    }

    /**
     * The pages above a page, from the top of the site down (the site's hidden root page is not included)
     */
    protected function getParentPages($page)
    {
        $parents = [];
        $parent = $page->parent();

        // stop at the site's hidden root page, the only page without a parent of its own
        while ($parent && $parent->parent()) {
            // add each parent to the start of the list, so the list runs from the top down
            array_unshift($parents, $parent);
            $parent = $parent->parent();
        }

        return $parents;
    }

    /**
     * Search results for the results template, grouped by top-level section (for example Blog) with the best matches first.
     *
     * Returns a list of groups, each like:
     *   ['title' => 'Blog', 'items' => [ ['url' => ..., 'title_html' => ..., 'trail' => ..., 'snippet_html' => ...], ... ]]
     */
    public function searchGroups($results, $query)
    {
        // SimpleSearch treats commas as separators between search words, so do the same
        $terms = [];
        foreach (explode(',', (string) $query) as $term) {
            $term = trim($term);
            // skip empty words, and words with unreadable characters (they cannot be highlighted)
            if ($term !== '' && mb_check_encoding($term, 'UTF-8')) {
                $terms[] = $term;
            }
        }
        if (!$results || count($terms) === 0) {
            return [];
        }

        $siteTitle = (string) $this->config->get('site.title');
        $groups = [];
        $position = 0;

        foreach ($results as $page) {
            // the group is the page's top-level section; pages at the top of the site go under the site title
            $parents = $this->getParentPages($page);
            $groupTitle = $siteTitle;
            $trailTitles = [];
            if (count($parents) > 0) {
                $groupTitle = $parents[0]->title();
                foreach (array_slice($parents, 1) as $parent) {
                    $trailTitles[] = $parent->title();
                }
            }

            $title = (string) $page->title();

            // Pages whose title has a search word come first, then the others in SimpleSearch's order
            $rank = $position;
            if (!$this->containsAnyTerm($title, $terms)) {
                $rank = $rank + 100000;
            }
            $position++;

            $item = [
                'url' => $page->url(),
                'title_html' => $this->highlightTerms($title, $terms),
                'trail' => implode(' › ', $trailTitles),
                'snippet_html' => $this->highlightTerms($this->searchSnippet($page, $terms), $terms),
                'rank' => $rank,
            ];

            // Add the page to its group, creating the group the first time
            if (!isset($groups[$groupTitle])) {
                $groups[$groupTitle] = ['title' => $groupTitle, 'items' => [], 'rank' => $rank];
            }
            $groups[$groupTitle]['items'][] = $item;

            // A group's rank is the rank of its best page
            if ($rank < $groups[$groupTitle]['rank']) {
                $groups[$groupTitle]['rank'] = $rank;
            }
        }

        // Sort the pages in each group, then the groups, by rank (lowest first)
        $sortedGroups = [];
        foreach ($groups as $group) {
            usort($group['items'], [$this, 'compareRank']);
            $sortedGroups[] = $group;
        }
        usort($sortedGroups, [$this, 'compareRank']);

        return $sortedGroups;
    }

    /**
     * For sorting search results and groups: the lower rank comes first
     */
    public function compareRank($a, $b)
    {
        return $a['rank'] - $b['rank'];
    }

    /**
     * Does the text contain any of the search words (ignoring upper and lower case)?
     */
    protected function containsAnyTerm($text, $terms)
    {
        foreach ($terms as $term) {
            if (mb_stripos($text, $term) !== false) {
                return true;
            }
        }
        return false;
    }

    /**
     * About 160 characters of a page's text, from just before the first search word, with … where it is cut
     */
    protected function searchSnippet($page, $terms)
    {
        $length = 160;

        // The page's text without HTML, on one line
        $text = strip_tags((string) $page->content());
        $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $text = trim(preg_replace('/\s+/u', ' ', $text));

        // Leave out the page title if the text starts with it (it is already shown)
        $title = (string) $page->title();
        if ($title !== '' && mb_stripos($text, $title) === 0) {
            $text = trim(mb_substr($text, mb_strlen($title)));
        }
        if ($text === '') {
            return '';
        }

        // Start about 50 characters before the first search word found
        $start = 0;
        foreach ($terms as $term) {
            $found = mb_stripos($text, $term);
            if ($found !== false) {
                $start = max(0, $found - 50);
                break;
            }
        }

        // Begin at the start of a word
        if ($start > 0) {
            $nextSpace = mb_strpos($text, ' ', $start);
            if ($nextSpace !== false && $nextSpace - $start < 20) {
                $start = $nextSpace + 1;
            }
        }

        $snippet = mb_substr($text, $start, $length);

        // End at the end of a word, and show … where the text is cut
        $isCutAtEnd = $start + $length < mb_strlen($text);
        if ($isCutAtEnd) {
            $lastSpace = mb_strrpos($snippet, ' ');
            if ($lastSpace !== false && $lastSpace > $length - 30) {
                $snippet = mb_substr($snippet, 0, $lastSpace);
            }
            $snippet = $snippet . '…';
        }
        if ($start > 0) {
            $snippet = '…' . $snippet;
        }

        return trim($snippet);
    }

    /**
     * Make text safe for HTML, with each search word wrapped in <mark> to highlight it
     */
    protected function highlightTerms($text, $terms)
    {
        // A pattern that finds any of the search words, ignoring upper and lower case
        $quotedTerms = [];
        foreach ($terms as $term) {
            $quotedTerms[] = preg_quote($term, '/');
        }
        $pattern = '/(' . implode('|', $quotedTerms) . ')/iu';

        // Split the text into pieces: the search words, and the text between them.
        // Each piece is made safe for HTML on its own, so a search word never matches inside an HTML code like &amp;
        $pieces = preg_split($pattern, (string) $text, -1, PREG_SPLIT_DELIM_CAPTURE);

        // If the search words could not be used (for example, unreadable characters), show the text without highlighting
        if ($pieces === false) {
            return htmlspecialchars((string) $text, ENT_QUOTES, 'UTF-8');
        }

        $html = '';
        foreach ($pieces as $index => $piece) {
            $safePiece = htmlspecialchars($piece, ENT_QUOTES, 'UTF-8');
            $isSearchWord = ($index % 2 === 1);
            if ($isSearchWord) {
                $html = $html . '<mark>' . $safePiece . '</mark>';
            } else {
                $html = $html . $safePiece;
            }
        }

        return $html;
    }

}

?>
