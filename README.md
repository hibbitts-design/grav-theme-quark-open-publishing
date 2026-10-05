<div align="center">

# 🌐 Quark Open Publishing

### Designed to accompany the Open Publishing Space Skeleton

<p><em>A Grav theme for open guides and blogs – embeddable anywhere, with Git-based open editing built in.</em></p>

[![Grav Discord Chat](https://img.shields.io/discord/501836936584101899.svg?logo=discord&colorB=728ADA&label=Grav%20Discord%20Chat)](https://chat.getgrav.org) [![Latest Release](https://img.shields.io/github/v/release/hibbitts-design/grav-theme-quark-open-publishing?style=flat-square&label=Release)](https://github.com/hibbitts-design/grav-theme-quark-open-publishing/releases/latest) [![License](https://img.shields.io/badge/License-MIT-blue.svg?style=flat-square)](https://github.com/hibbitts-design/grav-theme-quark-open-publishing/blob/master/LICENSE) [![PHP](https://img.shields.io/badge/PHP-%3E%3D8.0.2-8892BF?style=flat-square&logo=php&logoColor=white)](https://learn.getgrav.org/17/basics/requirements)

<p>Try the <a href="https://demo.hibbittsdesign.org/grav-open-publishing-quark/">demo</a></p>

<p>A free, open-source child theme of <a href="https://github.com/getgrav/grav-theme-quark">Quark</a>, the default <a href="https://getgrav.org">Grav CMS</a> theme, with Markdown file-based content, a built-in Admin panel, and no database required. Used by the <a href="https://github.com/hibbitts-design/grav-skeleton-open-publishing-space">Open Publishing Space</a> skeleton package.</p>

<a href="https://raw.githubusercontent.com/hibbitts-design/grav-theme-quark-open-publishing/refs/heads/master/screenshots/screenshot.webp"><img alt="Open Publishing Space blog with a mountain hero image, blog post cards, and a sidebar with tags and archives, in light mode" src="https://raw.githubusercontent.com/hibbitts-design/grav-theme-quark-open-publishing/refs/heads/master/screenshots/screenshot.webp" width="49%"></a> <a href="https://raw.githubusercontent.com/hibbitts-design/grav-theme-quark-open-publishing/refs/heads/master/screenshots/screenshot-dark.webp"><img alt="Open Publishing Space blog with a mountain hero image, blog post cards, and a sidebar with tags and archives, in dark mode" src="https://raw.githubusercontent.com/hibbitts-design/grav-theme-quark-open-publishing/refs/heads/master/screenshots/screenshot-dark.webp" width="49%"></a>

<p>Open Publishing Space – Blog in light mode (left) and dark mode (right)</p>

</div>

Quark Open Publishing adds what open, collaborative blogs and publishing sites need on top of the Quark theme: pages that embed cleanly in other systems, links that open each page's source in your Git repository, guides with section cards and reading progress – even long ones, grouped into parts – and a set of shortcodes and page types for rich content.

## What Sets It Apart

- **Guides that carry over to Grav Helios Open Reader** – a Section List page type for guides alongside your blog, even long ones grouped into parts, with section cards, section labels, Learning Objectives, reading progress, Previous/Next navigation, Keep My Place, a last updated date, and OER attribution, using the same page settings as [Grav Helios Open Reader](https://github.com/hibbitts-design/grav-skeleton-helios-open-reader)
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

1. **New theme options** – replace the `form:` section of `user/themes/mytheme/blueprints.yaml` with the one from the theme's `blueprints.yaml`, so the Text Size on Phones option appears under **Themes → My Theme**
2. **Search** – turn on the SimpleSearch plugin in **Plugins → SimpleSearch**; on sites set up with an earlier Open Publishing Space skeleton, also clear its **Category** filter (set to `blog`), or search finds only blog posts in that category
3. **GitHub-style alerts** – install the [GitHub Markdown Alerts plugin](https://github.com/trilbymedia/grav-plugin-github-markdown-alerts): version 2 on Grav 2, or [version 1.1.1](https://github.com/trilbymedia/grav-plugin-github-markdown-alerts/releases/tag/1.1.1) on Grav 1.7 (download it and copy it to `user/plugins/github-markdown-alerts`)
4. **Multi-page content** – choose the Section List page type for a new page in the Admin Panel, or copy the `01.open-education-essentials` example guide from the theme's `_demo/pages` folder

## Theme Options

All options are available in the Admin Panel under **Themes → Quark Open Publishing**.

- **Open Publishing Options** – chromeless site, H5P setup, Creative Commons license display, and menu dropdowns
- **Quark Options** – Dark Mode, text size on phones, production mode, grid size, custom logos, header and footer defaults, blog page and hero classes, and Spectre.css options
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

The **Section List** page type (`section-list.md`) publishes a guide as a set of pages: a home page with a card for each section, then each section (`section.md`) and its subsections (`subsection.md`). Section pages have a side list of the sections, Previous/Next navigation, a link back to the home page, and a search box. The earlier **Sections** page type (`sections.md`) remains available, with the side list on its home page instead of cards; its **Sections Config** tab can switch its Next/Prev buttons to the same tiles. When embedded (for example with `?embedded=true`), Section List pages show only their content, as in Grav Helios Open Reader, while Sections pages keep their side list and buttons.

The Section List page's own text appears above the section cards. To show some of it below the cards, as in Grav Helios Open Reader, add a line with just `===` – the text after it appears below the cards.

Footnotes (`[^1]`) need Grav's Markdown Extra. Turn it on for the whole site with **Markdown Extra** in the Admin Panel's System Configuration, or for one page by adding this to its front matter:

```yaml
markdown:
    extra: true
```

For longer guides:

- **Parts** – give sections the same **Part** setting to group them under a heading on the home page and a label in the side list; section numbers, Previous/Next and the reading progress continue across parts
- **Keep My Place** – when a reader returns, a **Continue reading** bar above the section cards links to the last page they visited (remembered in their browser), as in Grav Helios Open Reader; its close button forgets the place
- **Previous/Next at the top** – compact Previous/Next links beside the link back to the home page, as well as the tiles at the bottom
- **Comfortable reading** – section pages keep lines to a comfortable length with slightly larger text, wide tables scroll sideways, footnotes sit as small notes below the text, and on phones a **Contents** link jumps to the list of sections

Settings, in the Admin Panel page editor:

- **Section List page** – subtitle, cover image (small, beside the title and details, or large at the top), author(s), edition, last updated date, Start button text (the button below the details, linking to the first section), section label (e.g. "Unit" or "Chapter"), search box, reading progress, Keep My Place, Previous/Next position (bottom, or top and bottom), cards per row, and OER attribution (license, license URL, and attribution text)
- **Section** – section number, a section label override, Part, Learning Objectives, and a card description and image
- **Subsection** – Learning Objectives

### Moving to Grav Helios Open Reader

Quark Open Publishing is for a site built around a blog and one or more guides – even long ones, grouped into parts – and is free and open source. [Grav Helios Open Reader](https://github.com/hibbitts-design/grav-skeleton-helios-open-reader) is for a site built for reading, such as open textbooks and course readers, and runs on Helios, a premium Grav theme. When a site becomes mainly about reading, its guides can move to Open Reader with little rework. Open Reader adds:

- A table of contents on every page, highlighting where you are as you read
- Several publications on one site, each with its own home page, gathered on a readers list
- A plain-text version of each publication (`llms-full.txt`), for ebook tools, search and other uses

To move a guide:

1. Copy the Section List page folder into the Open Reader site's `pages` folder – it becomes one of its publications
2. Rename each `subsection.md` to `section-page.md`
3. Rename the section folders to `section-1`, `section-2`, and so on (for example `01.section-1`), as in the Open Reader demo. For a guide with parts, use `part-1-section-1`, `part-1-section-2`, `part-2-section-1`, and so on, and list the part titles in a `parts` block on the Section List page (see the Open Reader README); in Open Reader, Previous/Next and the reading progress stay within each part
4. Set a `section_number` on each section to keep its label (e.g. "Unit 2") at the top of its pages

Page settings, callout shortcodes, GitHub-style alerts, and embed shortcodes carry over unchanged. In Open Reader the cover image is always shown full width, like the large Cover Image Layout.

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
- Optional: the [SimpleSearch plugin](https://github.com/getgrav/grav-plugin-simplesearch) for search, and the [GitHub Markdown Alerts plugin](https://github.com/trilbymedia/grav-plugin-github-markdown-alerts) for GitHub-style alerts (version 2 on Grav 2, version 1.1.1 on Grav 1.7)

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
