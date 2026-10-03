<div align="center">

# 🌐 Quark Open Publishing

### Designed to accompany the Open Publishing Space Skeleton

<p><em>A Grav theme for open blogs and publishing spaces – embeddable anywhere, with Git-based open editing built in.</em></p>

[![Grav Discord Chat](https://img.shields.io/discord/501836936584101899.svg?logo=discord&colorB=728ADA&label=Grav%20Discord%20Chat)](https://chat.getgrav.org) [![Latest Release](https://img.shields.io/github/v/release/hibbitts-design/grav-theme-quark-open-publishing?style=flat-square&label=Release)](https://github.com/hibbitts-design/grav-theme-quark-open-publishing/releases/latest) [![License](https://img.shields.io/badge/License-MIT-blue.svg?style=flat-square)](https://github.com/hibbitts-design/grav-theme-quark-open-publishing/blob/master/LICENSE) [![PHP](https://img.shields.io/badge/PHP-%3E%3D8.0.2-8892BF?style=flat-square&logo=php&logoColor=white)](https://learn.getgrav.org/17/basics/requirements)

<p>Try the <a href="https://demo.hibbittsdesign.org/grav-open-publishing-quark/">demo</a></p>

<p>A free, open-source child theme of <a href="https://github.com/getgrav/grav-theme-quark">Quark</a>, the default <a href="https://getgrav.org">Grav CMS</a> theme, with Markdown file-based content, a built-in Admin panel, and no database required. Used by the <a href="https://github.com/hibbitts-design/grav-skeleton-open-publishing-space">Open Publishing Space</a> skeleton package.</p>

<a href="https://raw.githubusercontent.com/hibbitts-design/grav-theme-quark-open-publishing/refs/heads/master/screenshots/screenshot.webp"><img alt="Open Publishing Space blog with a mountain hero image, blog post cards, and a sidebar with tags and archives, in light mode" src="https://raw.githubusercontent.com/hibbitts-design/grav-theme-quark-open-publishing/refs/heads/master/screenshots/screenshot.webp" width="49%"></a> <a href="https://raw.githubusercontent.com/hibbitts-design/grav-theme-quark-open-publishing/refs/heads/master/screenshots/screenshot-dark.webp"><img alt="Open Publishing Space blog with a mountain hero image, blog post cards, and a sidebar with tags and archives, in dark mode" src="https://raw.githubusercontent.com/hibbitts-design/grav-theme-quark-open-publishing/refs/heads/master/screenshots/screenshot-dark.webp" width="49%"></a>

<p>Open Publishing Space – Blog in light mode (left) and dark mode (right)</p>

</div>

Quark Open Publishing adds what open, collaborative blogs and publishing sites need on top of the Quark theme: pages that embed cleanly in other systems, links that open each page's source in your Git repository, multi-page content such as a short guide or handbook, and a set of shortcodes and page types for rich content.

## What Sets It Apart

- **Multi-page content that carries over to Grav Helios Open Reader** – a Section List page type for a short guide or handbook alongside your blog, with section cards, section labels, Learning Objectives, reading progress, Previous/Next navigation, and OER attribution, using the same page settings as [Grav Helios Open Reader](https://github.com/hibbitts-design/grav-skeleton-helios-open-reader)
- **Chromeless display for embedding** – add `/chromeless:true` or `?embedded=true` to any page URL to show only its content, or hide the site menu, sidebar, and footer site-wide
- **Open authoring with Git Sync** – a "View Git Repository" or "View/Edit Page in Git Repository" link in the menu, footer, or page, with a custom icon and text
- **Built-in shortcodes** – Button, Embedly, Google Slides, H5P, iFrame, Link Preview Card, Markdown File, PDF, SpeakerDeck, and Twitter, with `title` (and `ratio`) options for accessible, well-proportioned embeds
- **Callout shortcodes** – `[objectives]`, `[key-takeaways]`, `[reflection]`, `[definition]`, `[example]`, `[case-study]`, `[project-brief]`, `[process-note]`, `[feedback-requested]`, `[announcement]`, `[exercise]`, `[references]`, and `[excerpt]`, plus GitHub-style alerts (`> [!NOTE]` etc.), with the same names and options as Grav Helios Open Reader
- **Blogging extras** – featured (sticky) posts, an option to hide post summaries on full posts, and a Markdown-based sidebar
- **Content page types** – multi-page content with section cards, sections with side navigation, custom content lists, and dedicated H5P, iFrame, PDF, Embedly, and link preview card pages
- **Search** – with the SimpleSearch plugin, results grouped by section with the search words highlighted, and a search box on multi-page content that searches just that content
- **Built on Quark** – a lightweight, responsive Spectre.css design with hero images, modular pages, and full-page mobile navigation
- **2026 Refresh with Dark Mode** – off, on, or following the visitor's system setting, with a dark palette designed to match Quark
- **Open licensing and accessibility** – Creative Commons license display, OER attribution for multi-page content, and hidden H1 page titles for screen readers
- **Print-friendly pages** – printed pages show just the content in black on white, with link addresses, whatever the Dark Mode setting

## When is Quark Open Publishing a Good Candidate?

Quark Open Publishing is a good fit when you:

- Want an open blog or publishing site built on Grav's default Quark theme
- Need to embed pages cleanly in an LMS or other site
- Value Git-based, open authoring of your writing
- Want to publish a short guide or handbook alongside your blog

Other options might be better when you:

- Want to publish substantial, standalone open content, such as an open textbook, or several readers on one site – consider [Grav Helios Open Reader](https://github.com/hibbitts-design/grav-skeleton-helios-open-reader)
- Need only a standard blog without these extras – the [Quark theme](https://github.com/getgrav/grav-theme-quark) is enough
- Need comments, memberships, or newsletters built in
- Want zero-server publishing directly from GitHub – consider [Docsify-This](https://docsify-this.net)

## Quick Start

The easiest way to get started is the [Open Publishing Space](https://github.com/hibbitts-design/grav-skeleton-open-publishing-space) skeleton package, which includes this theme already configured.

### Installing in an Existing Site
1. In the Admin Panel, go to **Themes → Add** and install **Quark Open Publishing**, or from the root of your Grav site run `bin/gpm install quark-open-publishing`
2. The parent **Quark** theme and required plugins are installed as dependencies

### Setting as the Default Theme
1. In the Admin Panel, go to **Themes**, select **Quark Open Publishing**, and press **Activate**, or in `user/config/system.yaml` set the theme under `pages`:
   ```yaml
   pages:
     theme: quark-open-publishing
   ```
2. Clear the Grav cache (`bin/grav clearcache`)

> [!TIP]
> Make your customizations in a child theme (the skeleton package includes one called `mytheme`), so they are kept when Quark Open Publishing is updated.

### Updating an Existing Site

Updating the theme keeps your pages and settings as they are, with the new features off until you turn them on. To use them:

1. **New theme options** – replace the `form:` section of `user/themes/mytheme/blueprints.yaml` with the one from the theme's `blueprints.yaml`, so the Previous/Next Navigation Style option appears under **Themes → My Theme**
2. **Search** – turn on the SimpleSearch plugin in **Plugins → SimpleSearch**; on sites set up with an earlier Open Publishing Space skeleton, also clear its **Category** filter (set to `blog`), or search finds only blog posts in that category
3. **GitHub-style alerts** – install the [GitHub Markdown Alerts plugin](https://github.com/trilbymedia/grav-plugin-github-markdown-alerts) (Grav 2)
4. **Multi-page content** – choose the Section List page type for a new page in the Admin Panel, or copy the `05.multi-page-content` example from the theme's `_demo/pages` folder

## Theme Options

All options are available in the Admin Panel under **Themes → Quark Open Publishing**.

- **Open Publishing Options** – chromeless site, H5P setup, Creative Commons license display, menu dropdowns, and the Previous/Next navigation style for multi-page content (classic buttons, or tiles with the reading progress)
- **Quark Options** – Dark Mode, production mode, grid size, custom logos, header and footer defaults, blog page and hero classes, and Spectre.css options
- **Custom Menu Items** – text, icon, URL, and target for extra menu links
- **Git Sync Link** – location, link type (view or edit), icon and text, and a custom Git repository URL

## Page URL Parameters

Add these to any page URL, for example `https://yoursite.com/blog/my-post/chromeless:true` or `https://yoursite.com/blog/my-post?embedded=true`.

| Parameter | Effect |
|---|---|
| `/chromeless:true` (or `/embedded:true`, `/standalone:true`) | Shows only the page content, with no site menu, sidebar, or footer – for embedding in other systems |
| `?embedded=true` (or `?chromeless=true`, `?standalone=true`) | Same as `/chromeless:true`, using the same parameter as Grav Helios Open Reader; carried forward as you follow links |
| `?edit_link=false` (or `?hidegitlink=true`) | Hides the Git Sync link on that page |
| `/hidepagetitle:true` | Hides the visible page title, keeping it as a hidden heading for screen readers |
| `/summaryonly:true` (or `/onlysummary:true`) | Shows only a post's summary, with a Continue Reading link when the post has one enabled |
| `/filter:<tag>` | On Sections and Section List pages, limits the section navigation and section cards to pages with that tag |

## Multi-Page Content

The **Section List** page type (`section-list.md`) publishes a short guide or handbook as a set of pages: a home page with a card for each section, then each section (`section.md`) and its subsections (`subsection.md`). Section pages have a side list of the sections, Previous/Next navigation, a link back to the home page, and a search box. The earlier **Sections** page type (`sections.md`) remains available, with the side list on its home page instead of cards.

Settings, in the Admin Panel page editor:

- **Section List page** – subtitle, cover image, author(s), edition, section label (e.g. "Unit" or "Chapter"), Start button text, search box, reading progress, cards per row, and OER attribution (license, license URL, and attribution text)
- **Section** – section number, a section label override, Learning Objectives, and a card description and image
- **Subsection** – Learning Objectives

### Moving to Grav Helios Open Reader

When a guide grows into substantial, standalone content, it can move to [Grav Helios Open Reader](https://github.com/hibbitts-design/grav-skeleton-helios-open-reader) with little rework:

1. Copy the Section List page folder into the Open Reader site's `pages` folder – it becomes one of its publications
2. Rename each `subsection.md` to `section-page.md`
3. Rename the section folders to `section-1`, `section-2`, and so on (for example `01.section-1`), as in the Open Reader demo
4. Set a `section_number` on each section to keep its label (e.g. "Unit 2") at the top of its pages

Page settings, callout shortcodes, GitHub-style alerts, and embed shortcodes carry over unchanged.

## Search

Search uses the [SimpleSearch plugin](https://github.com/getgrav/grav-plugin-simplesearch), included with the Open Publishing Space skeleton. Results are grouped by section, with the search words highlighted. On a Section List page and its section pages, the search box searches only that page and the pages inside it, with a link on the results page to search the whole site.

The [TNTSearch plugin](https://github.com/trilbymedia/grav-plugin-tntsearch) can be used instead for fuzzy (i.e. approximate) searches with results shown as you type – install and enable it, and the Search page and search boxes use it in place of SimpleSearch.

> [!NOTE]
> Search limited to a Section List page works only with SimpleSearch. With TNTSearch enabled, the search box on a Section List page searches the whole site.

## Printing

To leave something out when a page is printed, add the `no-print` class (as in Grav Helios Open Reader).

## Requirements

- PHP >= 8.0.2
- Grav CMS 1.7 or 2.0
- The [Quark theme](https://github.com/getgrav/grav-theme-quark) and required plugins, installed automatically as dependencies
- Optional: the [SimpleSearch plugin](https://github.com/getgrav/grav-plugin-simplesearch) for search, and the [GitHub Markdown Alerts plugin](https://github.com/trilbymedia/grav-plugin-github-markdown-alerts) (Grav 2) for GitHub-style alerts

## Support

### Contact and Support
- Share your feedback in the [Open Publishing Space Survey](https://docs.google.com/forms/d/e/1FAIpQLSeDVXsE1k9mljDvGD687QZO8alchaXqe4dXcIKmnjjWVXatgQ/viewform)
- Follow [@hibbittsdesign@mastodon.social](https://mastodon.social/@hibbittsdesign) on Mastodon for updates
- 👩🏻‍💻🧑🏻‍💻 Join the [Grav Discord](https://chat.getgrav.org) and often find me there
- Add a ⭐️ [star on GitHub](https://github.com/hibbitts-design/grav-theme-quark-open-publishing) to the Quark Open Publishing project repository
- For bugs or feature requests, [open an issue](https://github.com/hibbitts-design/grav-theme-quark-open-publishing/issues) on GitHub

### Professional Services

By leveraging his extensive UX design expertise and systems-oriented approach, Paul helps teams and individuals utilize open content in education and publication settings. Professional services include user experience and workflow consulting, premium support subscriptions, workshops, and custom development. Interested? Send a note to [paul@hibbittsdesign.org](mailto:paul@hibbittsdesign.org).

## License

MIT – Hibbitts Design
