# v1.2.9
## 03/11/2018

1. [](#improved)
    * Updated ReadMe file

# v1.2.8
## 03/01/2018

1. [](#improved)
    * Restored support for custom Git Sync link icon

# v1.2.7
## 02/23/2018

1. [](#improved)
    * Updated names of example modular pages to all lowercase
1. [](#bugfix)
    * Corrected display of default modular template

# v1.2.6
## 02/21/2018

1. [](#improved)
    * Updated global handling of 'chromeless' and 'hidepagetitle' URL flags (thanks Ricardo)

# v1.2.5
## 01/23/2018

1. [](#new)
    * Added default content for pages created using Admin Panel button bar

# v1.2.4
## 01/21/2018

1. [](#improved)
    * Relocated Blog summary only display and custom icon from Theme options to Blog List options

# v1.2.3
## 01/16/2018

1. [](#bugfix)
    * Do not display breadcrumbs (when enabled) if the 'summaryonly' URL flag is present

# v1.2.2
## 01/16/2018

1. [](#new)
    * Added experimental support for Blog page list option to display 'Continue readings...' links as buttons in Blog page summaries

# v1.2.1
## 01/11/2018

1. [](#bugfix)
    * Removed display of 'Edit in Git' link with use of 'summaryonly' URL flag

# v1.2.0
## 01/11/2018

1. [](#new)
    * Added experimental support for new 'summaryonly' URL flag to only display summary on blog posts
    * Added experimental support for new 'hidepagetitle' URL flag to hide page title
    * Added Auto Date plugin as dependency
    * Added support for opening links in top window
1. [](#improved)
    * Added CSS for default alert style

# v1.1.9
## 12/19/2017

1. [](#new)
    * Added MediaPicker functionality for (blog) item header images
1. [](#improved)
    * Updated embed.ly card template
    * Updated open publishing space demo pages in theme '_demo' folder
1. [](#bugfix)
    * Renamed 'blog_item' modular template to 'item'
    * Renamed 'reminders' modular template to 'alert'

# v1.1.8
## 12/04/2017

1. [](#new)
    * Added scripts template to hold global JavaScript code

# v1.1.7
## 11/23/2017

1. [](#new)
    * Added example 'Twitter Feed' page in '_demo' pages folder for use with included Page Inject plugin
    * Added example 'Embed.ly Card' page in '_demo' pages folder for use with included Page Inject plugin
    * Added support for modular page content to be displayed above blog entry list
    * Added example 'highlight-item' page in '_demo' pages folder for use with included Page Inject plugin
    * Added example 'reminders' page in '_demo' pages folder for use with included Page Inject plugin
    * Added support for blog header image credit storage in external meta file
1. [](#improved)
    * Updated embed.ly card page template and blueprint with alignment option
1. [](#bugfix)
    * Fixed modular 'default' template
        *
# v1.1.6
## 11/19/2017

1. [](#improved)
    * Revised name of sidebar folder from 'sidebar-markdown-widget' to 'sidebar'

# v1.1.5
## 11/09/2017

1. [](#new)
    * Added experimental embed.ly card page template
    * Added experimental Twitter feed page template
    * Added blog list page metadata blueprint

# v1.1.4
## 10/26/2017

1. [](#new)
    * Option to display Creative Commons license with icon only

# v1.1.3
## 10/25/2017

1. [](#improved)
    * Improved display of Git Sync links within pages

# v1.1.2
## 10/24/2017

1. [](#improved)
    * Improved footer display when displaying Git Sync link

# v1.1.1
## 10/24/2017

1. [](#improved)
    * Improved default handling after initial installation of theme

# v1.1.0
## 10/23/2017

1. [](#bugfix)
    * Restored needed CSS classes to handle 'chromeless' external links

# v1.0.9
## 10/23/2017

1. [](#new)
    * Further streamlined Git Sync setup step by automating 'Edit in Git' tree URL calculation

# v1.0.8
## 10/16/2017

1. [](#new)
    * Added Markdown-based Footer page

# v1.0.7
## 10/11/2017

1. [](#bugfix)
    * 'featured' posts are now only displayed on their parent blog page (to support multiple blogs on one site)

# v1.0.6
## 10/10/2017

1. [](#new)
    * Added support for blog post title icons (default and per page)

# v1.0.5
## 10/09/2017

1. [](#bugfix)
    * Fixed incorrect position of image credit in very wide Browser windows

# v1.0.4
## 10/06/2017

1. [](#bugfix)
    * Changed page header option name from `hidefrompostlist` to `hide_from_post_list`
1. [](#improved)
    * Adjusted position of Alternative Text field in Blueprint

# v1.0.3
## 10/06/2017

1. [](#new)
    * Added support for image alt text on blog post image headers
    * Added page header option to hide posts from blog index
1. [](#improved)
    * Revised layout for Blog Item Image Captions options in Blueprint

# v1.0.2
## 10/04/2017

1. [](#new)
    * Added support for image captions on blog post image headers
1. [](#bugfix)
    * Fixed issue of Edit Page in Git links when in 'chromeless' mode

# v1.0.1
## 09/22/2017

1. [](#bugfix)
    * Fixed issue of View in Git links when in 'chromeless' mode

# v1.0.0
## 09/22/2017

1. [](#improved)
    * Improved installation process of theme into standard Grav Blog Site skeleton

# v0.9.9
## 09/21/2017

1. [](#bugfix)
    * Corrected Twig logic checks for handling of non Git Sync Plugin Git syncing choice

# v0.9.8
## 09/21/2017

1. [](#new)
    * Added support for non Git Sync Plugin Git syncing (e.g. upcoming cPanel Git Feature)
1. [](#improved)
    * Improved global handling of 'chromeless' display mode for embedded pages (thanks Ricardo)

# v0.9.7
## 08/30/2017

1. [](#new)
    * Added OER Schema plugin as theme dependency
    * Added TNTSearch plugin as skeleton dependency
1. [](#improved)
    * Breadcrumbs now remain visible on all screen sizes

# v0.9.6
## 08/23/2017

1. [](#bugfix)
    * Corrected theme settings calculation during Git Repository Tree URL setup

# v0.9.5
## 08/22/2017

1. [](#improved)
    * Included demo pages updated
    * Increased support for 'chromeless' display mode for embedded blogs
    * Revised display order of Previous/Next buttons
    * Added a visual fill effect for buttons upon hover
    * Added hidden label for SimpleSearch Plugin search field
    * Added option to hide homepage link in menubar
    * Changed default display of Git Sync link to 'Menu'
    * Added option to choose window target for custom menu items
    * Added note about 'Page' Git Sync link location for chromeless display
1. [](#bugfix)
    * Removed unexpected multi-page duplication of 'featured' posts

# v0.9.4
## 08/18/2017

1. [](#new)
    * Image ALT tags now supported for blog page header images
    * Added hidden h1 page titles for use by screen readers
    * Underlines displayed now on focus and hover for page text links

# v0.9.3
## 08/17/2017

1. [](#improved)
    * Updated theme dependencies

# v0.9.2
## 08/16/2017

1. [](#improved)
    * Revised theme description

# v0.9.1
## 08/16/2017

1. [](#bugfix)
    * Revised potential PHP classname conflict when using MyTheme inherited theme config

# v0.9.0
## 08/15/2017

1. [](#new)
    * ChangeLog started...
