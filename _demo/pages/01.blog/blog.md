---
title: Blog
sitemap:
    changefreq: monthly
body_classes: 'header-image fullwidth'
blog_url: blog
show_sidebar: true
show_breadcrumbs: true
show_pagination: true
content:
    items:
        - '@self.children'
    limit: 5
    order:
        by: date
        dir: desc
    pagination: true
    url_taxonomy_filters: true
display_post_summary:
    enabled: false
continue_link_as_button: false
hide_git_sync_repo_link: false
modular_content:
    items: '@self.modular'
    order:
        by: folder
        dir: desc
feed:
    description: 'Sample Blog Description'
    limit: 10
pagination: true
---

## My Open Publishing Space
### Publish, share and collaboratively edit Markdown-based content
