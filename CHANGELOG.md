# v1.5.4
## 03/22/2019

1. [](#bugfix)
    * Removed unneeded `endblock` in Twig theme file

# v1.5.3
## 03/22/2019

1. [](#bugfix)
    * Corrected Grav version dependency to 1.5.10

# v1.5.2
## 03/22/2019

1. [](#new)
    * Set Dependency of Grav 1.5.10+ which has support for new **Deferred Block** Twig extension
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
