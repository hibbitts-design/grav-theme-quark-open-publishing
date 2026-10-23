# v3.4.22
## 10/23/2026

1. [](#improved)
    * Demo content: a Mermaid flowchart on the Getting Started with OER page and a LaTeX Correcting a Formula example on the Maintaining an Open Reader page, matching the skeleton (drawn when the Mermaid and LaTeX Math plugins are installed)
1. [](#bugfix)
    * An iFrame page shown as a link with Page Inject (template=partials/iframelinkonly) now links to its iFrame Source address, instead of an empty link; a site address starting with / gets the site's base URL, as in Open Matter
    * The PDF and SpeakerDeck link-only templates no longer start their link address with a space

# v3.4.21
## 10/20/2026

1. [](#improved)
    * The small icons in the back link, Sections link and top Previous/Next links are centred on their text, rather than sitting low

# v3.4.20
## 10/18/2026

1. [](#improved)
    * French and German translations are complete, for every text the theme shows readers (search, guide pages, Previous/Next, Keep My Place, error pages and more), using the same words as Grav Helios Open Reader where they overlap
    * README: which languages are complete
    * Demo content: the Open Education Essentials guide's section pages' headings no longer repeat the names of their own pages, so the side list doesn't show a page's heading and a page with the same name (for example LMS Embedding) one under the other

# v3.4.19
## 10/18/2026

1. [](#new)
    * On guide pages, tap or click an image shown smaller than its full size to see it larger, filling the screen (handy for diagrams and screenshots on phones); Escape, the Close button or a tap closes it
1. [](#improved)
    * Links, outline buttons and text on blue use a slightly darker blue (#1d6ac9), as Quark's blue was below the 4.5:1 contrast text needs (3.7:1 on white); Dark Mode keeps its own link colours
    * Demo content: a Creative Commons license chart, with its attribution as a caption, on the Creative Commons Licenses page (it can be tapped to see it larger)
    * README: seeing an image larger

# v3.4.18
## 10/18/2026

1. [](#new)
    * On guide pages, the / key jumps to the guide's search box, ready to type (as on GitHub and many documentation sites)
    * With the Page TOC plugin, the side list marks the section you're reading as you scroll, as in Grav Helios Open Reader (screen readers hear it as the current location)
    * Keep My Place also remembers the section you were reading, so Continue reading goes back to it rather than the top of the page (when its headings have ids, as with the Page TOC plugin)
    * On phones, Previous/Next sit in a compact bar fixed to the bottom of the screen, in place of the links at the top and the tiles at the end of the page, as in Grav Helios Open Reader and Quark 2 Open Publishing (the guide's Show Sticky Prev/Next Bar setting, the same as in Open Reader, on by default). It steps aside while typing in a box such as the search box and while the menu is open, keeps links reached with the Tab key above it, and isn't used on phones turned sideways
1. [](#improved)
    * The side list takes the room left beside the page (up to 18rem) rather than a fixed quarter of the width, which left empty space on its right, so longer page titles wrap less
    * On phones, search boxes have 16px text (iPhones zoom the whole page in when a box with smaller text is tapped) and are taller, so they're easier to tap
    * On phones, the side list's rows are taller (about 42px), so they're easier to tap
    * The links at the top of section pages (back to the guide, Sections, and Previous/Next) are the same size as the page's text, a little larger than before
    * README: the / key for search, and the section you're reading marked in the side list
    * README: Keep My Place remembers the section you were reading
    * README: the Previous/Next bar on phones

# v3.4.17
## 10/18/2026

1. [](#bugfix)
    * Search finds the pages of the site's home page even when it's set to visible: false to keep it out of the menu (for example a guide that is the home page); other top-level pages set to visible: false are still left out
    * Search boxes: a clearer border (at least 3:1 contrast) and easier-to-read placeholder text (at least 4.5:1), which now says "Search these pages…" instead of "Search this content..." (screen readers hear the same words without the "…"), as in Quark 2 Open Publishing

# v3.4.16
## 10/17/2026

1. [](#bugfix)
    * On phones, a page whose text starts with a heading no longer has a larger gap below the "On this page" box than above it

# v3.4.15
## 10/17/2026

1. [](#bugfix)
    * "On this page" sections in the side list are easier to read and use: the same colour as the page names (the lighter shade was under 4.5:1 contrast), slightly larger text, and links at least 24px tall

# v3.4.14
## 10/17/2026

1. [](#improved)
    * Guides show Previous/Next at the top and bottom of their pages, and the reading progress, unless their home page sets otherwise, as in Grav Helios Open Reader (the Prev/Next Page Controls Position and Show Reading Progress settings); to keep the earlier look, set Prev/Next Page Controls Position to Bottom and turn off Show Reading Progress. Multi-Section pages are unchanged
    * README: the new Previous/Next and reading progress defaults

# v3.4.13
## 10/17/2026

1. [](#new)
    * Hide from Menu setting on guides (`hide_from_menu: true`, which works on any page): the page is left out of the site menu but stays visible, so a guide keeps its card on a Guides List page (`visible: false` still leaves a guide off the list, as in Grav Helios Open Reader)
1. [](#improved)
    * README: the Hide from Menu setting

# v3.4.12
## 10/17/2026

1. [](#new)
    * [hideifembedded]...[/hideifembedded] and [showifembedded]...[/showifembedded] shortcodes: content shown only on the site, or only when a page is embedded (for example in an LMS), the same as in Grav Open Course Hub and Grav Helios Course Hub
    * "On this page": with the Page TOC plugin, a guide page's sections (its headings) appear under it in the side list, and in an "On this page" box above the text on phones, as on Grav Open Course Hub's module pages; without the plugin, nothing changes
    * [badge] shortcode: a small label in the text, such as "Draft" or "Due Friday", in the same colours as section card badges, with the same options as Grav Open Course Hub and Grav Helios Course Hub
    * A page's Badge Label (such as "Draft") now also shows beside its section label on the page, and section pages have Badge Label and Badge Color settings too
    * Guides List page type (`reader-list.md`, the same as Grav Helios Open Reader's readers list): a card for each guide on the site, with its cover image, subtitle, author(s), edition and last updated date, optional group headings and badges (new Guides List Group, Badge Label and Badge Color settings on Section List pages), and cards per row, card image layout and description line limit settings
1. [](#improved)
    * README: the Show/Hide If Embedded shortcodes, the Page TOC plugin for a page's sections, badges, and the Guides List page
1. [](#bugfix)
    * Search leaves out the pages inside an unpublished page, such as the sections of an example guide that is turned off (Grav still counts them as published)

# v3.4.11
## 10/16/2026

1. [](#new)
    * Captions for images in guide pages: an italic line right after an image on its own line (such as `*Photo by …*`) shows as a caption – small, centred and just below the image – so photo credits and captions need no HTML
    * Image captions written in HTML (`<figure>` and `<figcaption>`, as from the Pressbooks Converter) are shown the same way, as in Grav Helios Open Reader
    * Cover Image Alt Text setting on a guide's home page, to describe the cover for screen readers (without it, the alt text is still "<title> cover")
1. [](#improved)
    * On a guide's first page, the left arrow key goes back to the guide's home page, so presenting with the arrow keys works both ways
    * README: the cover image alt text and the left arrow key on a guide's first page
1. [](#bugfix)
    * The "Skip to content" text was listed twice in the theme's language file, which stricter YAML readers reject

# v3.4.10
## 10/16/2026

1. [](#new)
    * On guide pages, the left and right arrow keys go to the previous and next page, and on a guide's home page the right arrow key follows Start Reading – handy when presenting by screen sharing (not while typing or scrolling a wide table)
    * [topics]...[/topics] shortcode: an A–Z topics index made from ## A, ## B, ... headings, the same as in Bootstrap4 Open Matter (Open Course Hub) and Grav Helios Course Hub, with large, keyboard-friendly letter links
1. [](#improved)
    * Images in a guide page's text are no taller than a little over half the screen, so an image and its text fit on screen together; an image on its own line is centred
    * README: the arrow keys and the Topics shortcode

# v3.4.9
## 10/15/2026

1. [](#new)
    * A "Skip to content" link, shown when it gets keyboard focus, takes keyboard users past the header to the page content, as in Quark 2 Open Publishing (not on embedded or chromeless pages); with the fixed header, the content stops below it

# v3.4.8
## 10/14/2026

1. [](#improved)
    * Demo pages: the blog, Standard Page and unpublished examples are numbered 15–19, so a converted Pressbooks book (numbered 10.) appears right after the sample guide, and the hidden Search page has no number, as in Grav Open Publishing Space 2.5.2

# v3.4.7
## 10/14/2026

1. [](#bugfix)
    * Embedded and chromeless pages stay embedded when a page redirects, such as a section without text of its own opening its first page

# v3.4.6
## 10/14/2026

1. [](#bugfix)
    * Embedded blog posts show their title and date (as Quark 2 Open Publishing does), and leave out their tags

# v3.4.5
## 10/14/2026

1. [](#bugfix)
    * Blog posts and the blog list page leave out their breadcrumbs when embedded

# v3.4.4
## 10/14/2026

1. [](#bugfix)
    * Printed blog posts include their title, subtitle and date
    * The blog's title prints at the top of the blog list
    * The Copy as Markdown button is left out of print

# v3.4.3
## 10/13/2026

1. [](#bugfix)
    * In chromeless mode (/chromeless:true), links to other sites and email links work
    * In chromeless mode, links with # or ? and links to files such as PDFs open the right address

# v3.4.2
## 10/13/2026

1. [](#improved)
    * README: converting a Pressbooks book with Grav Open Publishing Space as the destination fixes its section redirects and links
1. [](#bugfix)
    * Yes/No switches in the theme and page settings show their labels in Admin on hosts with PHP's native YAML extension

# v3.4.1
## 10/09/2026

1. [](#improved)
    * No "Setup Git Sync" link is shown before Git Sync is connected to a repository, so visitors don't see an unfinished setup step; set it up in the Admin Panel (its own menu item in Grav 2, or Plugins → Git Sync in Grav 1.7)
    * Demo content: the home page introduces Grav Open Publishing Space and its theme, with the sample guide as an example
    * Demo content: the Custom Page Types example is removed, and Read Me is now 20.readme, leaving 08–19 free for new pages (a converted Pressbooks book uses 10.)

# v3.4.0
## 10/09/2026

1. [](#improved)
    * The Git Sync link (Page location) and Creative Commons license now sit inside the content, centred, on standard, blog and guide pages
    * Open Publishing Options reordered: Creative Commons License first, H5P Setup last
    * A quieter Git Sync link (muted, underlined on hover)
1. [](#bugfix)
    * Valid HTML for the Git Sync link and Creative Commons license (no longer a block inside a paragraph)

# v3.3.7
## 10/08/2026

1. [](#improved)
    * Deprecated the [twitter] shortcode, as X has heavily restricted embedded timelines; it will be removed in a future release

# v3.3.6
## 10/07/2026

1. [](#improved)
    * An arrow on every section card, as in Helios Open Reader, to show they open parts of the guide
    * With 1 section card per row, card images are shown beside the text by default, as in Helios Open Reader
    * A Start Reading link after the section cards, as in Helios Open Reader
    * The search box on a Section List page starts on the left when there's no Continue reading bar

# v3.3.5
## 10/06/2026

1. [](#bugfix)
    * The Setup Git Sync link is no longer shown when the Git Sync plugin is turned off

# v3.3.4
## 10/06/2026

1. [](#improved)
    * Portrait cover images, such as book covers, are shown whole with either Cover Image Layout
    * Section cards with only a title have balanced spacing
1. [](#bugfix)
    * Exercise boxes keep their content, with only a link on its own shown as the activity button
    * Previous/Next and the reading progress skip sections that only redirect to their first page

# v3.3.3
## 10/06/2026

1. [](#improved)
    * The Section List page's subtitle uses Quark's light style instead of italics

# v3.3.2
## 10/06/2026

1. [](#new)
    * Section Page sub-pages, as in Helios Open Reader, so its publications can be copied in unchanged
    * Badge Label and Badge Color settings for section cards, as in Helios Open Reader
    * Section Author(s) setting, shown on section cards, as in Helios Open Reader
    * Copied Helios Open Reader publications keep their card layout, badges and parts (from part-1-section-1 folder names)
1. [](#improved)
    * Section Label (Plural) moved to the page's front matter (see the README), to keep the Section List settings simple
    * The Embedly script now loads only on pages with an Embedly card
1. [](#bugfix)
    * The Git Sync Link options display correctly in Admin 2

# v3.3.1
## 10/05/2026

1. [](#new)
    * Section Label (Plural) setting, for the Sections link on phones
1. [](#improved)
    * Larger links above section pages, with spacing to match
    * Part headings stand out more from the section cards, and the OER attribution's links are muted
    * Section pages are easier to read: a comfortable line length, slightly larger text, a Sections link on phones, and the page title as the largest heading
    * Wide tables scroll sideways on section pages, and footnotes are smaller
    * The list of sections stays in view beside section pages on wider screens
1. [](#bugfix)
    * The Display Dropdowns in Menu setting now shows Disabled by default, matching how the theme behaves

# v3.3.0
## 10/05/2026

1. [](#new)
    * Continue reading bar for returning readers on Section List pages, as in Helios Open Reader, replacing Continue Reading on the Start button
1. [](#improved)
    * Start button now sits below the guide's title and details, with a larger small cover image
    * Search box now shares a row with the Continue reading bar
    * Page titles on guide pages are now level 1 headings, with part and card headings below them

# v3.2.0
## 10/04/2026

1. [](#new)
    * Text below the section cards on Section List pages, after a line with just `===`, as in Helios Open Reader
1. [](#improved)
    * Small cover image now sits beside the guide's title and details, with a consistent 4:3 shape
    * Headings below the section cards match the part headings
    * OER attribution no longer repeats the license when the attribution text already names it
    * Demo guide now has its own cover image, a small cover and a lighter introduction

# v3.1.0
## 10/04/2026

1. [](#new)
    * Keep My Place for Section List pages: the Start button becomes Continue Reading for returning readers, as in Helios Open Reader
    * Last Updated date for Section List pages, as in Helios Open Reader
    * Parts, for grouping the sections of a Section List page under headings
    * Prev/Next Page Controls Position option for Section List pages, with compact Previous/Next links at the top
1. [](#improved)
    * Markdown tables now use Spectre's table style
    * Demo pages now use the Open Education Essentials guide
    * README notes GitHub Markdown Alerts 1.1.1 for Grav 1.7
1. [](#bugfix)
    * Search limited to a Section List page now works when that page is the site's homepage
    * TNTSearch's search box on Section List pages now matches the theme's search box height

# v3.0.2
## 10/04/2026

1. [](#improved)
    * Small cover image is now the default Cover Image Layout for Section List pages
    * Larger text on phones now also covers the smaller text on Section List and section pages
    * Compact, centred reading progress bar, with the dividing line below it, as in Helios Open Reader
    * Lighter layout below section pages, with a more visible progress track
    * Section List pages always use the Previous/Next tiles; Multi-Section pages can choose them in their own Sections Config tab, replacing the theme option
    * Embedded Section List pages show only their content, as in Helios Open Reader

# v3.0.1
## 10/03/2026

1. [](#new)
    * Cover Image Layout option for Section List pages: large (full width, the new default) or small
    * Text Size on Phones theme option, for larger body text on phones
1. [](#improved)
    * Larger small cover image
    * Section List page options grouped into Details, Sections and Attribution tabs
    * Multi-Section page options restored to their pre-3.0.0 tabs
    * Existing mytheme installations require manual update of mytheme/blueprints.yaml to surface the new theme option

# v3.0.0
## 10/03/2026

1. [](#new)
    * Section List page type for multi-page content, as in Helios Open Reader
    * Reader settings (subtitle, cover image, author(s), edition, section labels and Learning Objectives), as in Helios Open Reader
    * Reading progress, OER attribution and search box options for multi-page content
    * Previous/Next Navigation Style theme option
    * Callout shortcodes, as in Helios Open Reader (`[objectives]`, `[references]` and more)
    * GitHub-style alerts, with the GitHub Markdown Alerts plugin
    * Search with the SimpleSearch plugin (TNTSearch also supported)
    * Print stylesheet
    * Friendlier Page Not Found page
1. [](#improved)
    * `?embedded=true` and `?edit_link=false` URL parameters, as in Helios Open Reader
    * `ratio` and `title` options for the iFrame, Google Slides, PDF and H5P shortcodes
    * Search leaves out hidden top-level pages
    * Long titles in the sections side navigation now wrap neatly
    * Existing mytheme installations require manual update of mytheme/blueprints.yaml to surface the new theme option
1. [](#bugfix)
    * Embedly Card and Link Preview Card pages no longer show their HTML as text on Grav 2
    * Google Slides shortcode no longer shows its HTML as text on Grav 2
    * iFrame shortcode `aspectratio` option no longer ignored
    * H5P embeds keep resizing when Grav's cache is enabled
    * Cmd-click on internal links now opens a new tab

# v2.6.0
## 10/02/2026

1. [](#new)
    * 2026 Refresh: added Dark Mode option (Off, On, Auto (System)) in Quark Options > Visual Style, with a dark palette designed to match Quark
1. [](#improved)
    * Rewrote README in streamlined style with light and dark mode screenshots
    * Brought overridden templates in line with the latest Quark theme (2.1.5)
1. [](#bugfix)
    * Blog posts now find their blog from the `blog_url` setting and show the sidebar, breadcrumbs, and pagination by default (from Quark)
    * Popular Tags in the sidebar now lists only the current blog's tags, on both blog and post pages (from Quark)
    * Login status no longer causes an error if its template is unavailable (from Quark)
    * Embedly Card pages show their card again, instead of always reporting the link as no longer available
    * Embedly cards for pages on sites with bot protection (e.g. Medium) are no longer hidden as unavailable; only missing pages are
    * Embedly shortcode now also accepts the URL between tags (`[embedly]URL[/embedly]`), as in Bootstrap4 Open Matter

# v2.5.0
## 10/01/2026

1. [](#improved)
    * Removed support for the legacy Presentation plugin (Presentation List page type, presentation blueprints and partials, and related options and CSS)
    * Removed legacy NextGen Editor shortcode integration (NextGen Editor has been replaced by Editor Pro)

# v2.4.2
## 10/01/2026

1. [](#bugfix)
    * Git Sync edit links now use the configured remote branch instead of always `master`
    * Git Sync edit links now strip only a trailing `.git` from the repository URL (fixes repos such as `name.github.io`)
    * Restore missing CSS classes on Git Sync links
    * Fix unclosed wrapper `<div>` in iframe and PDF page templates
    * Fix H5P content title not displaying
    * Fix sidebar Atom/RSS feed links for subfolder installs and nested blogs
    * Only show featured posts that belong to the current blog

# v2.4.1
## 08/02/2026

1. [](#bugfix)
    * Handle unreachable Embedly URLs with a clear "no longer available" link instead of a silent broken card
    * Explicitly zero out image margin sides in the link preview card, for defensive consistency across any theme this shortcode is bundled with

# v2.4.0
## 07/11/2026

1. [](#improved)
    * Fix Grav 2 raw HTML/tagfilter escaping in Embedly, H5P, and Twitter shortcodes by moving embed scripts to the Assets API

1. [](#new)
    * Add self-hosted [linkpreviewcard] shortcode as a working replacement for legacy Embedly card

# v2.3.5
## 07/09/2026

1. [](#improved)
    * Add 1.7|2.0 compatibility flags

# v2.3.4
## 08/31/2025

1. [](#improved)
    * Minor theme cleanup

# v2.3.3
## 08/30/2025

1. [](#improved)
    * Changed theme author information to HibbittsDesign.org
    * Updated demo pages in theme '_demo' folder

1. [](#bugfix)
    * Support for system.images.auto_fix_orientation in blog listing and hero template (thanks to @Snickbrack for reporting the issue)

# v2.3.2
## 09/05/2024

1. [](#bugfix)
    * Fixed support for custom logo (thanks to @pamtbaau for the PR)
    
# v2.3.1
## 04/26/2022

1. [](#improved)
    * Additional support of the alias 'standalone' for 'chromeless'

# v2.3.0
## 09/27/2021

1. [](#bugfix)
    * Added needed script load for embedly.com embeds

# v2.2.9
## 09/27/2021

1. [](#new)
    * Added initial support for NextGen Editor custom media embeds

# v2.2.8
## 08/06/2021

1. [](#bugfix)
    * Added check for <a> (anchor tag) without href attribute

# v2.2.7
## 03/21/2021

1. [](#improved)
    * Updated demo pages in theme '_demo' folder

# v2.2.6
## 02/28/2021

1. [](#improved)
    * Reduced plugin dependencies, thanks to the new Grav Skeleton build process

# v2.2.5
## 02/17/2021

1. [](#bugfix)
    * Fixed incorrect variable name in iFrame template

# v2.2.4
## 02/16/2021

1. [](#improved)
    * Updated Default Editor PDF and H5P shortcode syntax to be compatible with NextGen shortcode previews

# v2.2.3
## 02/15/2021

1. [](#bugfix)
    * Revised fix for compatibility issue with Shortcode Gallery++ Plugin (thanks @sal0max)

# v2.2.2
## 02/15/2021

1. [](#bugfix)
    * Removed compatibility issue with Shortcode Gallery++ Plugin due to unexpected issues on Blog listing page

# v2.2.1
## 02/15/2021

1. [](#bugfix)
    * Fixed compatibility issue with Shortcode Gallery++ Plugin (thanks @sal0max)
1. [](#improved)
    * Shortcode formatting updated to use <span> tags and removed unneeded <p> tags

# v2.2.0
## 01/29/2021

1. [](#bugfix)
    * Removed unneeded <br> tags in Partial templates
1. [](#new)
    * Added H5P Partial templates for feature parity with Bootstrap4 Open Matter Theme

# v2.1.9
## 01/26/2021

1. [](#improved)
    * Updated theme blueprints for Grav 1.7

# v2.1.8
## 01/15/2021

1. [](#new)
    * GoogleSlides shortcode updated to handle double `_` characters in URL (thanks @GeorgesPapas)

# v2.1.7
## 01/05/2021

1. [](#new)
    * Initial NextGen Editor support for GoogleSlides, H5P and PDF shortcodes
1. [](#improved)
    * Updated ReadMe with note about no support for SCSS in this inherited theme (thanks to @zaszlo for the heads-up)

# v2.1.6
## 07/22/2020

1. [](#bugfix)
    * Updated templates for latest RC build (v.15)

# v2.1.5
## 07/19/2020

1. [](#bugfix)
    * Fixed Section and Subsection blueprint error

# v2.1.4
## 07/03/2020

1. [](#new)
    * Added GoogleSlides Shortcode ([googleslides url=""]), with aspect option ([googleslides url="" aspectratio="4-3"]), to display embedded Google Slides
1. [](#updated)
    * Updated demo pages in theme '_demo' folder

# v2.1.3
## 05/23/2020

1. [](#improved)
    * Updated inherited theme file paths for multisite compatibility

# v2.1.2
## 04/30/2020

1. [](#bugfix)
  * Added missing closing paragraph tag on `sections` page types (thanks to @lazybadger for finding the issue)

# v2.1.1
## 04/27/2020

1. [](#new)
  * Added support for optional display of title links for `embedlycard` page types

# v2.1.0
## 02/13/2020

1. [](#new)
  * Updated demo pages in theme '_demo' folder

# v2.0.9
## 02/06/2020

1. [](#new)
  * Support for Menu property in Sections pages (thanks to @awrog for the suggestion and initial Twig)

# v2.0.8
## 01/21/2020

1. [](#new)
  * Support for ReadingTime Plugin (thanks to @B1gG for the initial PR)
1. [](#improved)
    * Updated demo pages in theme '_demo' folder
1. [](#bugfix)
  * Restored display of taxonomy tags on blog post pages (Sections pages now use the `filter` taxonomy item, which is also needed to be in Taxonomy `site.yaml` config)

# v2.0.7
## 01/02/2020

1. [](#improved)
  * Updated CSS for left/right image alignment (thanks to @OleVik)

# v2.0.6
## 12/18/2019

1. [](#new)
  * Support for custom links (e.g. PDFs) with embedded Presentations

# v2.0.5
## 12/08/2019

1. [](#improved)
  * Changed reference of "Menubar" to "Menu" in theme setting

# v2.0.4
## 12/08/2019

1. [](#improved)
  * Reorganized theme options for Git Sync Link and Custom Menu Items
  * Renamed template/blueprint of CustomContentList to CustomPageTypes
  * Removed deprecated swipedeck template partials

# v2.0.3
## 11/27/2019

1. [](#improved)
    * Removed deprecated swipedeck template, blueprint and shortcode

# v2.0.2
## 11/22/2019

1. [](#improved)
    * Updated experimental Markdown file Shortcode ([markdownfile url=""]) to support displaying Grav Markdown pages (frontmatter is removed)

# v2.0.1
## 11/09/2019

1. [](#new)
    * Added experimental Markdown file Shortcode ([markdownfile url=""]) to embed external Markdown files (thanks to @OleVik for help along the way)

# v2.0.0
## 10/09/2019

1. [](#improved)
    * Removed theme option to hide homepage in menubar (set the 'visible' option to 'false' on homepage for same functionality)

# v1.9.9
## 10/04/2019

1. [](#bugfix)    
    * Support proper RSS feed URL when 'Append URL extension' is set to '.html'
1. [](#improved)
    * Updated demo pages in theme '_demo' folder

# v1.9.8
## 09/14/2019

1. [](#bugfix)    
    * Updated JS to prevent possible conflict with Bricklayer CSS

# v1.9.7
## 09/12/2019

1. [](#bugfix)    
    * Support CTRL + click to open links in new tab as expected

# v1.9.6
## 08/26/2019

1. [](#bugfix)
    * Fixed support for blog item taxonomy tags in 'chromeless' blog list view

# v1.9.5
## 08/16/2019

1. [](#improved)
    * Improved Twig 2.0 compatibility

# v1.9.4
## 08/10/2019

1. [](#bugfix)
    * Fixed automatic Git Sync Link for Presentations in a Presentation List page
1. [](#improved)
    * Added support to hide Git Sync Link for each embedded Presentation
    * Updated Presentation blueprint Git Sync options
    * Fine tuning of automatic Git Sync Link for embedded Presentations
    * Improved support for custom Git Sync Link text for pages and presentations

# v1.9.3
## 07/24/2019

1. [](#bugfix)
    * Support option to hide Git Sync Link for emebedded Presentations

# v1.9.2
## 07/24/2019

1. [](#improved)
    * Improved Git Sync Link appearance for emebedded Presentations

# v1.9.1
## 06/29/2019

1. [](#bugfix)
    * Sidebar Taxonomy List only includes child page taxonomy items

# v1.9.0
## 06/24/2019

1. [](#improved)
    * Updated demo pages in theme '_demo' folder

# v1.8.9
## 06/23/2019

1. [](#improved)
    * Improved visual alignment for modular page content on Blog listing pages
    * Updated demo pages in theme '_demo' folder

# v1.8.8
## 06/23/2019

1. [](#improved)
    * Added Japanese translation [#24](https://github.com/hibbitts-design/grav-theme-quark-open-publishing/pull/24)

# v1.8.7
## 06/21/2019

1. [](#new)
    * Support for modular page content on Blog listing pages
1. [](#improved)
    * Added notice color options for Alert modular pages
    * Updated demo pages in theme '_demo' folder

# v1.8.6
## 06/15/2019

1. [](#improved)
    * Updated theme blueprints YAML for Grav 1.6.10 Admin Panel YAML Linter

# v1.8.5
## 06/13/2019

1. [](#improved)
    * Support for direct link to Presentation Markdown file when Presentation images are stored in a child folder
    * Added custom Git Sync Link Text specific to embedded Presentations

# v1.8.4
## 06/10/2019

1. [](#improved)
    * Updated demo pages in theme '_demo' folder

# v1.8.3
## 06/05/2019

1. [](#improved)
    * Sections pages are now supported within a parent folder
    * Updated demo pages in theme '_demo' folder

# v1.8.2
## 06/03/2019

1. [](#improved)
    * Updated demo pages in theme '_demo' folder

# v1.8.1
## 06/03/2019

1. [](#new)
    * Added automatic Git Sync Link support for embedded Presentations
    * Added option to hide Presentation title
1. [](#improved)
    * Updated demo pages in theme '_demo' folder

# v1.8.0
## 05/18/2019

1. [](#improved)
    * Additional support for Alt tag on blog post header images (no longer requires image credit link)
    * Updated demo pages in theme '_demo' folder

# v1.7.9
## 05/16/2019

1. [](#bugfix)
    * Display of custom git sync text fixed to work with "View Git Repository" functionality

# v1.7.8
## 05/16/2019

1. [](#improved)
    * Updated page blueprint with custom Git Sync URLs

# v1.7.7
## 05/15/2019

1. [](#bugfix)
    * Fixed the handling of custom Git Sync URLs on pages

# v1.7.6
## 05/15/2019

1. [](#improved)
    * Links of embedded background images in Presentations are automatically opened in a new Browser window

# v1.7.5
## 05/14/2019

1. [](#improved)
    * Improved presentation of a single iFrame template link

# v1.7.4
## 05/10/2019

1. [](#improved)
    * Updated demo pages in theme '_demo' folder

# v1.7.3
## 05/09/2019

1. [](#improved)
    * Additional support of the alias 'embedded' for 'chromeless'

# v1.7.2
## 05/07/2019

1. [](#new)
    * Added default Favicon image file

# v1.7.1
## 05/05/2019

1. [](#improved)
    * Updated demo pages in theme '_demo' folder

# v1.7.0
## 05/04/2019

1. [](#new)
    * Initial support for Presentation list pages
1. [](#improved)
    * Added default page collection frontmatter for new Sections pages
    * Added sort options and order for Sections pages
    * Updated demo pages in theme '_demo' folder

# v1.6.9
## 04/27/2019

1. [](#improved)
    * Updated demo pages in theme '_demo' folder

# v1.6.8
## 04/25/2019

1. [](#improved)
    * Updated demo pages in theme '_demo' folder

# v1.6.7
## 04/24/2019

1. [](#improved)
    * Add support for taxonomy tags on Section child pages

# v1.6.6
## 04/24/2019

1. [](#improved)
    * Further improved taxonomy support for section-type pages

# v1.6.5
## 04/23/2019

1. [](#new)
    * Initial taxonomy support for section-type pages

# v1.6.4
## 04/23/2019

1. [](#improved)
    * Improved handling of Section Page Next/Prev buttons for previous Section with children pages
    * Removed extra space after icon with Git Sync links on Pages

# v1.6.3
## 04/17/2019

1. [](#improved)
    * Added paragraph wrapper to embedly, h5p, iframe, pdf, speakerdeck and swipedeck templates

# v1.6.2
## 04/15/2019

1. [](#bugfix)
    * Fixed Blueprint typo

# v1.6.1
## 04/12/2019

1. [](#bugfix)
    * Fixed mobile menu

# v1.6.0
## 04/11/2019

1. [](#new)
    * Set Grav dependency to 1.6+
    * Added Presentation Plugin as dependency
    * Added insert Presentation Shortcode button into Editor toolbar
    * Added example pages in theme '_demo' folder to include use of the Presentation Plugin
    * Implement assets rendering using **Deferred Block** Twig extension
1. [](#improved)
    * Twig 2.0 compatibility
    * Added paragraph wrapper to Bootstrap button, H5P, and Swipe Shortcodes

# v1.5.4
## 03/22/2019

1. [](#bugfix)
    * Removed unneeded `endblock` in Twig theme file

# v1.5.3
## 03/22/2019

1. [](#bugfix)
    * Corrected Grav dependency to 1.5.10

# v1.5.2
## 03/22/2019

1. [](#new)
    * Set Grav dependency to 1.5.10+ which has support for new **Deferred Block** Twig extension
    * Implement assets rendering using **Deferred Block** Twig extension

# v1.5.1
## 02/24/2019

1. [](#improved)
    * Added default padding for Font Awesome icons
    * Added 'Gill Sans MT' to default font family for Presentation pages

# v1.5.0
## 02/24/2019

1. [](#improved)
    * Added defaults for sample content, textscale and fonts with blueprint for Presentation Plugin
    * Added support for default aspect ratio when using the Presentation Plugin

# v1.4.9
## 02/13/2019

1. [](#improved)
    * For improved support of the Presentation Plugin, Markdown links with "=_target" are now handled better

# v1.4.8
## 02/09/2019

1. [](#improved)
    * Better support for flat lists of Section-type pages

# v1.4.7
## 02/07/2019

1. [](#improved)
    * iFrame template now supports both complete URLs and local Grav site page paths

# v1.4.6
## 02/06/2019

1. [](#new)
    * Added support for H5P content to be hosted on H5P.com (in addition to H5P.org and your own local server)

# v1.4.5
## 02/04/2019

1. [](#new)
    * Added option to show or hide Section Page Next/Prev buttons
1. [](#bugfix)
    * Fixed option to show or hide custom menu items

# v1.4.4
## 02/03/2019

1. [](#new)
    * Added support for 'visible' option setting in Section-type pages. For existing Section-type pages, ensure that any current 'visible: false' values are removed for those pages to be included.
    * Added Theme option to show or hide menubar dropdowns
1. [](#improved)
    * Updated demo pages in theme '_demo' folder

# v1.4.3
## 01/30/2019

1. [](#new)
    * Added iFrame template, blueprint, and shortcode (with responsive support for 4-3 and 16-9 aspect ratios)

# v1.4.2
## 01/29/2019

1. [](#improved)
    * Removed unneeded Pagination CSS for improved display on smaller screens (use Pagination Plugin 'Delta' settings to change the number of items shown instead)

# v1.4.1
## 01/28/2019

1. [](#improved)
    * Added 'onlysummary' alias for the URL parameter 'summaryonly'
    * Improved handling of embedded item summary pages

# v1.4.0
## 01/28/2019

1. [](#improved)
    * When displaying pages in 'chromeless' mode, a Creative Commons License is no longer displayed (it is assumed that this would be included in the parent system i.e. LMS)
1. [](#bugfix)
    * Fixed display of additional text for a Creative Commons License

# v1.3.9
## 01/09/2019

1. [](#bugfix)
    * Corrected Multi-Language reference for 'Feeling Lucky' sidebar widget

# v1.3.8
## 01/07/2019

1. [](#bugfix)
    * Removed experimental support for multiple blog compatibility for Featured Posts and Popular Tags

# v1.3.7
## 12/16/2018

1. [](#improved)
    * Experimental support of multiple blog compatibility for Featured Posts and Popular Tags. Note: use `- '@self'` for the filter in the Archives Plugin for use of multiple blogs. (Thanks to @pamtbaau for pointing me in the right direction)

# v1.3.6
## 12/12/2018

1. [](#improved)
    * Section-type pages now have the Folder Numeric Prefix option enabled by default (so Section pages can be manually sorted)

# v1.3.5
## 12/12/2018

1. [](#improved)
    * Updated Embedly Card, H5P, PDF, SpeakerDeck and Swipe Deck templates and blueprints (to align with latest Bootstrap4 Open Matter Theme release)
    * Updated demo pages in theme '_demo' folder
1. [](#bugfix)
    * Removed deprecated Twitter feed template and blueprint

# v1.3.4
## 11/13/2018

1. [](#bugfix)
    * Added 'THEME_QUARK' prefix to 'Continue Reading' button label

# v1.3.3
## 11/13/2018

1. [](#improved)
    * Twig template files cleanup and formatting (thanks RobLui)

# v1.3.2
## 11/09/2018

1. [](#improved)
    * Included option to show or hide page titles for embed.ly cards
    * Adjusted handling of padding for Headings in Sections template
    * Updated demo pages in theme '_demo' folder

# v1.3.1
## 11/07/2018

1. [](#improved)
    * Included option to show or hide page titles for embed.ly cards
    * Adjusted handling of padding for Headings in Sections template
    * Updated demo pages in theme '_demo' folder

# v1.3.0
## 11/06/2018

1. [](#bugfix)
    * Updated language.yaml references to include 'THEME_QUARK' prefix
    * Fixed incorrect H4 padding for sidebar items

# v1.2.9
## 10/19/2018

1. [](#improved)
    * Restored Admin Panel display name to Quark Open Publishing
    * Updated theme screenshots
    * Updated demo pages in theme '_demo' folder

# v1.2.8
## 10/12/2018

1. [](#improved)
    * Updated theme blueprints

# v1.2.7
## 10/11/2018

1. [](#improved)
    * Added support for no text prompt before Git Sync link on Pages

# v1.2.6
## 10/10/2018

1. [](#improved)
    * Testing changing Admin Panel display name from Quark Open Publishing to Quark Open Blogging
    * Updated theme screenshots
    * Updated demo pages in theme '_demo' folder

# v1.2.5
## 10/09/2018

1. [](#bugfix)
    * Restored check for option to hide Git Sync link in menu

# v1.2.4
## 10/08/2018

1. [](#improved)
    * Updated custom content list template and blueprint

# v1.2.3
## 10/07/2018

1. [](#improved)
    * Adjusted page title alignment for section-type pages
    * Updated demo pages in theme '_demo' folder

# v1.2.2
## 10/06/2018

1. [](#new)
    * Added blueprints for section-type pages
    * Added option to hide page titles for section-type pages
1. [](#improved)
    * Updated demo pages in theme '_demo' folder

# v1.2.1
## 10/05/2018

1. [](#new)
    * Added new 'section' and 'subsection' page templates
1. [](#improved)
    * Updated demo pages in theme '_demo' folder

# v1.2.0
## 09/24/2018

1. [](#improved)
    * Added multi-language compatibility for option to hide Homepage link in menubar

# v1.1.9
## 09/23/2018

1. [](#new)
    * Added the experimental alias 'embedded' for 'chromeless' as a URL parameter (i.e. https://demo.hibbittsdesign.org/grav-open-publishing-quark/embedded:true is the same as https://demo.hibbittsdesign.org/grav-open-publishing-quark/chromeless:true)
1. [](#improved)
    * Revised UI text for the site-wide 'chromeless' setting to better relate to the new\ experimental 'embedded' alias
    * Improved checks for the site-wide 'chromeless' setting

# v1.1.8
## 09/08/2018

1. [](#improved)
    * Updated various Git Sync-related blueprint text labels

# v1.1.7
## 09/06/2018

1. [](#new)
    * Added Twitter Shortcode ([twitter url="" text="" theme="" height=""]), where theme can be 'light' or 'dark'
    * Added Spectre.CSS Button Shortcode ([button url="" label="" target="" size="" classes=""])
    * Added PDF Shortcode ([pdf url="")
1. [](#improved)
    * Updated Theme ReadMe file

# v1.1.6
## 09/03/2018

1. [](#improved)
    * Improved support for Comments Plugin

# v1.1.5
## 08/23/2018

1. [](#bugfix)
    * Restored missing Error and Problems Plugin dependencies

# v1.1.4
## 08/23/2018

1. [](#new)
    * Added support for custom logo (thanks Andy)

# v1.1.3
## 08/23/2018

1. [](#new)
    * Added option for Sidebar Markdown area location to Sidebar page frontmatter
1. [](#improved)
    * Updated demo pages in theme '_demo' folder

# v1.1.2
## 08/21/2018

1. [](#new)
    * Added Image Captions plugin to theme dependencies

# v1.1.1
## 08/21/2018

1. [](#new)
    * Added support for page menu icons
1. [](#improved)
    * Updated demo pages in theme '_demo' folder

# v1.1.0
## 08/20/2018

1. [](#improved)
    * Updated theme blueprints

# v1.0.9
## 08/18/2018

1. [](#bugfix)
    * Escaped `query` in Twig templates for XSS protection

# v1.0.8
## 08/09/2018

1. [](#improved)
    * Revised the Italian translation for the "Continue Reading" button
    * Removed unneeded CSS from Blog "Hero" H1 H2 title text

# v1.0.7
## 08/09/2018

1. [](#bugfix)
    * Updated the "Continue Reading" button to support multi-language labels

# v1.0.6
## 08/06/2018

1. [](#improved)
    * Updated theme screenshots and blueprint

# v1.0.5
## 08/01/2018

1. [](#bugfix)
    * Restored check for "Continue Reading" button link in blog post lists
1. [](#improved)
    * Updated demo pages in theme '_demo' folder

# v1.0.4
## 08/01/2018

1. [](#improved)
    * Updated demo pages in theme '_demo' folder

# v1.0.3
## 07/31/2018

1. [](#new)
    * Added support for "Continue Reading" button link in blog post lists

# v1.0.2
## 07/13/2018

1. [](#improved)
    * Updated demo pages in theme '_demo' folder

# v1.0.1
## 07/13/2018

1. [](#new)
    * Added ability to define default hero classes for blog pages
    * Added SpeakerDeck ShortCode
1. [](#improved)
    * Updated demo pages in theme '_demo' folder
1. [](#bugfix)
    * Removed Image Captions Plugin as Theme dependency

# v1.0.0
## 07/10/2018

1. [](#new)
    * Added new 'hide_cc_license' page header option
    * Added classes to float images left(img.left), right(img.right) and align center(img.center)
    * Added Image Captions Plugin as Theme dependency
    * Added experimental ShortCode 'ClearBoth' to insert Div for clearing image floats
1. [](#improved)
    * Updated demo pages in theme '_demo' folder (to include image float examples)
    * Removed unneeded page template file (fullwidthpagemodular)
    * Removed unneeded modular page elements CSS

# v0.9.9
## 07/07/2018

1. [](#bugfix)
    * Restored responsive blog heading text

# v0.9.8
## 07/07/2018

1. [](#new)
    * Added support for custom global JavaScript (scripts.html.twig)
1. [](#improved)
    * Removed fixed blog header text color
    * Added bricklayer layout option check before jQuery call
    * Added check to hide Git Sync link note
    * Added better handling of pagination on small screens (thanks OleVik)
    * Updated Quark CSS files to latest development branch version
1. [](#bugfix)
    * Fixed display of link blog posts
    * Fixed Next Post and Previous Post button display issue

# v0.9.7
## 07/06/2018

1. [](#new)
    * Added templates and blueprints for PDFs and SpeakerDeck files
    * Added custom content list template and blueprint
1. [](#improved)
    * Updated link and title only templates for Embedly Cards and Swipe decks
    * Updated location of Git Sync link on blog list pages
    * Added drop shadow for blog hero H1,H2,H3 text
1. [](#bugfix)
    * Fixed incorrect responsive div classes

# v0.9.6
## 07/02/2018

1. [](#improved)
    * Updated demo pages in theme '_demo' folder
1. [](#bugfix)
    * Removed OERSchema dependency

# v0.9.5
## 06/19/2018

1. [](#new)
    * Added support for 'header_image' frontmatter option
    * Added option to turn off bricklayer layout for Blog list pages
1. [](#improved)
    * Blog header images now handled properly up to 'extra large' grid size

# v0.9.4
## 06/12/2018

1. [](#new)
    * Added example Modular collection page
    * Added full width page template for Modular pages
1. [](#improved)
    * Updated demo pages in theme '_demo' folder
1. [](#bugfix)
    * Restored theme ability to hide Blog Sidebar
    * Updated default checks for Blog list page options

# v0.9.3
## 06/10/2018

1. [](#improved)
    * Updated 'Read Me' page in default demo pages

# v0.9.2
## 04/29/2018

1. [](#new)
    * Added support for image captions on blog post image headers
1. [](#improved)
    * Updated modular item blueprint

# v0.9.1
## 04/06/2018

1. [](#new)
    * Added experimental H5P Shortcode support (in the formats of [h5p id=ID] and [h5p url=URL])
    * Added experimental Embed.ly Card Shortcode support (in the format of [embedly url=URL])
    * Added experimental Swipe Shortcode support (in the format of [swipe id=ID])
    * Added H5P content page template and blueprint
    * Added Swipe deck page template content page template and blueprint
    * Added display of Git Sync Link in additional page types
    * Added handling for Featherlight Plugin

# v0.9.0
## 03/27/2018

1. [](#new)
    * ChangeLog started...
