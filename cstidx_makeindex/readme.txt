=== cstidx_makeindex ===
Contributors: sloanthrasher
Donate link: https://sloansweb.com/say-thanks
Tags: table of contents, idx, index, page index, headings
Requires at least: 5.0
Tested up to: 6.6
Requires PHP: 7.2
Stable tag: 1.0
License: GPLv3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html
Plugin URI: https://sloansweb.com/page-6/
Author: Sloan Thrasher
Author URI: https://sloansweb.com/about/

== Description ==
**cstidx_makeindex** is a WordPress plugin designed to generate a dynamic, hierarchical index of page content based on headings using a customizable shortcode. The plugin automatically indexes page sections such as headings, classes, or any other specified elements. This is especially helpful for longer pages, enabling users to navigate directly to specific areas of interest.

Key Features:
* Automatically creates an index from headings or specified elements.
* Six built-in styles for index placement.
* Styles that float the index to the left or right, or fixed positions (top/bottom, left/right).
* Custom CSS option for personalized designs.
* Simple and customizable shortcode usage.

== Installation ==

There are two ways to install the cstidx_makeindex plugin:

= From the WordPress Plugin Directory =

1. Go to the WordPress dashboard.
2. Navigate to **Plugins > Add New**.
3. Search for **cstidx_makeindex** in the search box.
4. Click **Install Now** once you find the plugin.
5. After installation, click **Activate** to enable the plugin.

= Manual Installation =

1. Upload the plugin files to the `/wp-content/plugins/cstidx_makeindex` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. Navigate to the 'Settings' menu and select 'Index A Page' to configure the plugin.
4. Use the `[cstidx_index]` shortcode in any page or post to generate the index.

== Frequently Asked Questions ==

= How do I add the index to my page? =
Simply add the `[cstidx_index]` shortcode to any post or page where you want the index to appear.

= Can I customize the style of the index? =
Yes! The plugin includes six built-in styles. Additionally, you can use the 'Custom' option to add your own CSS in the plugin's settings.

= What elements are indexed by default? =
By default, the plugin indexes `h2`, `h3`, and `h4` headings. You can modify the default selectors in the settings.

== Screenshots ==

1. **Example of Index** - Shows an example of the generated index on a page.
2. **Plugin Settings Page** - The settings page where the index customization options are configured.
3. **Shortcode** - Shortcode Example.

== Changelog ==

= 1.0 =
* Initial release.

== Upgrade Notice ==

= 1.0 =
First release. No upgrade necessary.

== License ==

This plugin is licensed under the GPLv3 or later. For more information, visit [GPL License](http://www.gnu.org/licenses/gpl-3.0.html).
