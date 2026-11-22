# Changelog

All notable changes to this project will be documented in this file.

## v2.2b 
- Reflected XSS in Contact form — add htmlspecialchars()

## v2.1 
- now available on Nginx
- Shortcodes in content
- Add blocks format & FA icon in TinyMCE
- Add backups in ConfigManager
- Add nested Child Theme
- Icons system in Antispam plugin
- Caching System
- Minify HTML & lazy loading img system
- .env support
- Add a Logger to help debug
- Add a marketplace to download & install plugins & themes
- Add 2 hooks adminContent & publicContent to modify full content before display
- Add console.log in debug mode to display execution time & queries count
- Fixed Apache 2.2 & 2.4 .htaccess issue
- Links Categories in blog
- Admin links burger (go to home site)
- Support functions.php in theme
- Fix page with a password
- Improve Antispam
- Debranding TinyMCE & wrap toolbar on small screens
- Required plugins are now hidden in PluginsManager
- Update to Font Awesome 6.7.2
- Update to TinyMCE 6.6
- Blog : Remove gallery dependancy

## v2.0.0 
- Comments blog can be nested
- Compatibility with PHP 7.4 - 8.3
- Users can be stay connected (cookies)
- Antispam fully Translated
- New Users Plugin
- Themes can modify plugins templates
- Blog plugin fully translated & MVC
- Contact plugin fully translated & MVC
- Responses as API
- FileManager MVC & translated
- TinyMCE : Add images from FileManager
- Gallery : MVC & translated
- PluginsManager : MVC & translated
- Page : MVC & translated
- SEO : MVC & translated
- Allow langs in theme
- Description in banner
- URL Generation by router when a port is specified
- Blog metadatas
- Remove Pagination when empty
- Contact : Bad message when mail function is not available
- Blog : empty categories
- TinyMCE : Upload img URL issue when CMS is in a sub directory
- Page : URL issue when CMS is in a sub directory
- Page templates has to be in .tpl format
- Users connect and managements
- Force use responses & controllers

## v1.3.2
- Add Categories System
- Add Categories for Blog plugin
- Add a hook `adminToolsTemplates` to display links tools in admin
- Can translate plugin name & description
- Add concatenation of strings in templates (by `~`)
- Gallery in MVC
- End of `header.php` & `footer.php` in public themes
- Blog List HTML entities
- Blog TOC empty headings

## v1.3.1  
- Table of Content in Blog
- Use spl_autoload to load all common class
- Content out of box with big images in blog
- Install with PHP installed as a CGI
- Mobile view Sidebar

## v1.3.0
- New brands for SEO plugin
- Lang class
- Admin menu expand
- Public Sidebar
- Router class
- MVC model (for blog, contact & page)
- Groups buttons
- Begin to translate to English
- Template Improvements
- Issue during install with logger when data folder dont exist
- Hide page title when selected in params

## v1.2.5
- OpenGraph for socials networks in blog article
- Socials Description in blog article
- Add button to refresh cache in configManager plugin
- Add func (show class) to display personnalized metas
- 1.2.3 & 1.2.4 blog config issue
- util::urlBuild relative path issue


## v1.2.4
- Updates are now displayed in every admin pages
- ConfigManager plugin is using cache to check only once a day a new update
- Files _after and _beforeChangeFiles couldnt get called
- V1.2.3 Issue with blog config changes

## v1.2.3
- Experimental : Use tabs instead long page for blog editing item
- Blog Author bloc
- Experimental : Form Help on Blog/Param

## v1.2.2
- FileManager v1.1
- Firefox autocompletion for honeypot
- Progress while FileManager upload ajax view

## v1.2.1
- Admin buttons overlap
- TinyMCE : Add vertical scrollbar

## v1.2.0
- ConfigManager can now update site with a simple click
- Global 'IS_ADMIN' available on each page
- Hooks beforeRunPlugin & adminBeforeRunPlugin, called before the displayed page
- Add a description in site to display in banner
- Auto upload and manual upload image in TinyMCE
- CSS vars
- Admin menu is generated out of header.php
- Admin menu in CSS, always visible on wide screen
- Add currentPlugin class (CSS)  on current Plugin in Admin menu
- Redirect to item after save (blog, page, galerie)
- TinyMCE v6
- Old Normalize changed by modern-normalize and moved from core to CSS
- SEO : don't show script when Analytics ID is empty
- Gallery : Introduction dont save content in Markdown format
- Gallery : TinyMCE introduction
- Labels for forms

## v1.1.1
- Antispam : Issue on radio click (JS)
- TinyCME : Use FA icon in editor without edit sources

## v1.1.0
- Add FileManager plugin
- Change .htaccess for Apache 2.4
- Gallery : Modify toggle view of hidden pictures and category display
- Admin : Change favicon
- Gallery : Issue on choose category
- Gallery : Issue on hidden pictures
- SEO : Fix width on float icons

## v1.0.2
- Delete automatically install.php file on admin if exist
- Possibility to use icon on menu item (page)
- Use Vanilla JS instead jQuery
- Issue with Pages menu on Admin

## v1.0.1
- Rights on install

## v1.0

- 2 hooks : beforeSaveEditor and beforeEditEditor, to modify content before save and edit it
- Hook endMainNavigation to add items on main menu
- Gallery support now png, gif, jpg and jpeg images
- FancyBox is now on all the site, not only in Gallery
- Font Awesome is used to display icons
- Templates system (.tpl)
- show::msg is now callable everywhere to add a or many messages in next view
- SEO plugin : Icons instead text in links
- SEO plugin : SEO menu place can be changed in admin
- Less permissions on files
