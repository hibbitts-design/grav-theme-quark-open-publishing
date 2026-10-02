<div align="center">

# 🌐 Quark Open Publishing

### Designed to accompany the Open Publishing Space Skeleton

<p><em>A Grav theme for open blogs and publishing spaces – embeddable anywhere, with Git-based open editing built in.</em></p>

[![Grav Discord Chat](https://img.shields.io/discord/501836936584101899.svg?logo=discord&colorB=728ADA&label=Grav%20Discord%20Chat)](https://chat.getgrav.org) [![Latest Release](https://img.shields.io/github/v/release/hibbitts-design/grav-theme-quark-open-publishing?style=flat-square&label=Release)](https://github.com/hibbitts-design/grav-theme-quark-open-publishing/releases/latest) [![License](https://img.shields.io/badge/License-MIT-blue.svg?style=flat-square)](https://github.com/hibbitts-design/grav-theme-quark-open-publishing/blob/master/LICENSE) [![PHP](https://img.shields.io/badge/PHP-%3E%3D8.0.2-8892BF?style=flat-square&logo=php&logoColor=white)](https://learn.getgrav.org/17/basics/requirements)

<p>Try the <a href="https://demo.hibbittsdesign.org/grav-open-publishing-quark/">demo</a></p>

<p>A free, open-source child theme of <a href="https://github.com/getgrav/grav-theme-quark">Quark</a>, the default <a href="https://getgrav.org">Grav CMS</a> theme, with Markdown file-based content, a built-in Admin panel, and no database required. Used by the <a href="https://github.com/hibbitts-design/grav-skeleton-open-publishing-space">Open Publishing Space</a> skeleton package.</p>

<a href="https://raw.githubusercontent.com/hibbitts-design/grav-theme-quark-open-publishing/refs/heads/master/screenshots/screenshot.webp">
<img alt="Open Publishing Space blog with a mountain hero image, blog post cards, and a sidebar with tags and archives" src="https://raw.githubusercontent.com/hibbitts-design/grav-theme-quark-open-publishing/refs/heads/master/screenshots/screenshot.webp" width="100%">
</a>

<p>Open Publishing Space – Blog</p>

</div>

Quark Open Publishing adds what open, collaborative blogs and publishing sites need on top of the Quark theme: pages that embed cleanly in other systems, links that open each page's source in your Git repository, and a set of shortcodes and page types for rich content.

## What Sets It Apart

- **Chromeless display for embedding** – add `/chromeless:true` to any page URL to show only its content, or hide the site menu, sidebar, and footer site-wide
- **Open authoring with Git Sync** – a "View Git Repository" or "View/Edit Page in Git Repository" link in the menu, footer, or page, with a custom icon and text
- **Built-in shortcodes** – Button, Embedly, Google Slides, H5P, iFrame, Link Preview Card, Markdown File, PDF, SpeakerDeck, and Twitter
- **Blogging extras** – featured (sticky) posts, an option to hide post summaries on full posts, and a Markdown-based sidebar
- **Content page types** – sections with side navigation, custom content lists, and dedicated H5P, iFrame, PDF, Embedly, and link preview card pages
- **Built on Quark** – a lightweight, responsive Spectre.css design with hero images, modular pages, and full-page mobile navigation
- **2026 Refresh with Dark Mode** – off, on, or following the visitor's system setting, with a dark palette based on Grav's Quark 2 theme
- **Open licensing and accessibility** – Creative Commons license display and hidden H1 page titles for screen readers

## When is Quark Open Publishing a Good Candidate?

Quark Open Publishing is a good fit when you:

- Want an open blog or publishing site built on Grav's default Quark theme
- Need to embed pages cleanly in an LMS or other site
- Value Git-based, open authoring of your writing

Other options might be better when you:

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

## Theme Options

All options are available in the Admin Panel under **Themes → Quark Open Publishing**.

- **Open Publishing Options** – chromeless site, H5P setup, Creative Commons license display, and menu dropdowns
- **Quark Options** – Dark Mode, production mode, grid size, custom logos, header and footer defaults, blog page and hero classes, and Spectre.css options
- **Custom Menu Items** – text, icon, URL, and target for extra menu links
- **Git Sync Link** – location, link type (view or edit), icon and text, and a custom Git repository URL

## Page URL Parameters

Add these to any page URL, for example `https://yoursite.com/blog/my-post/chromeless:true`.

| Parameter | Effect |
|---|---|
| `/chromeless:true` (or `/embedded:true`, `/standalone:true`) | Shows only the page content, with no site menu, sidebar, or footer – for embedding in other systems |
| `/hidepagetitle:true` | Hides the visible page title, keeping it as a hidden heading for screen readers |
| `/summaryonly:true` (or `/onlysummary:true`) | Shows only a post's summary, with a Continue Reading link when the post has one enabled |
| `/filter:<tag>` | On Sections pages, limits the section navigation to pages with that tag |

## Requirements

- PHP >= 8.0.2
- Grav CMS 1.7 or 2.0
- The [Quark theme](https://github.com/getgrav/grav-theme-quark) and required plugins, installed automatically as dependencies

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
