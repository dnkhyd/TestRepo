=== Facebook Social Plugins ===
Contributors: olussier
Donate link: http://olussier.net/donate
Tags: facebook, social plugins, like button, activity, comments, like box, recommendations, widget, sidebar
Requires at least: 2.8
Tested up to: 2.9
Stable tag: 1.2.3

Add Facebook social plugins to your blog. 

== Description ==

[Facebook's social plugins](http://developers.facebook.com/plugins) allow you to easily integrate Facebook's social features on your blog. This plugin makes adding the social plugins to your plugin as simple as a few clicks.  

The Like button can be added at the top or bottom of articles. You can control where and how it appears. It is also available as a widget.

The Activity feed, Comments, the Like Box and Recommendations are also available as widgets.

Please note that the Comments widget is available only if you provide a Facebook application ID.

== Installation ==

1. Extract and upload the directory to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= Do you use iframes or XFBML? =

Both. XFBML is preferred but requires that your provide a Facebook application ID (in the settings page). If no application ID is provided, iframes will be used.

= Why can't I see the Comments widget? =

The Comments widget works only with XFBML, which requires that you provide a Facebook application ID (in the settings page). If no application ID is provided, the Comments widget is not available.

= I have a problem with your plugin or would like to suggest a change / new feature. How? =
You can contact me in many ways. You can post a comment on my [latest blog post about the plugin](http://olussier.net/tag/social-plugins/) or on the [plugin's page](http://olussier.net/demo/facebook-social-plugins/). Also, I am [@olussier](http://twitter.com/olussier) on Twitter.

== Changelog ==

= 1.2.3 =
* Bug fixes

= 1.2.2 =
* Bug fixes

= 1.2.1 =
* Fixed a display problem with widgets using iframes

= 1.2.0 =
* Plugins are now always displayed in the blog's default language (no support for multilingual blogs yet though)
* Added basic Open Graph tags to articles to improve how likes are displayed on Facebook 

= 1.1.0 =
* Added the layout option for the Like button ("standard" or "button & count")
* Added Like button at the top of articles
* Added options to choose where and how the Like button appears
* Added an option to hide Like button from specific pages 

= 1.0.1 =
* Fixed a compatibilty problem with PHP 4

= 1.0 =
* Added XFBML support. A Facebook application ID must be provided in the settings page, otherwise iframes are used.
* Added the following widgets: Like Box, Recommendations and Comments

= 0.1 =
* First version: Like button and Activity feed

== Upgrade Notice ==

= 1.2.3 =
* Bug fixes

= 1.2.2 =
* Bug fixes

= 1.2.1 =
* Fixed a (horrible) bug when displaying widgets using iframes

= 1.2.0 =
* Plugins are now always displayed in the blog's default language (no support for multilingual blogs yet though)
* Added basic Open Graph tags to articles to improve how likes are displayed on Facebook

= 1.1.0 =
* Added the layout option for the Like button ("standard" or "button & count")
* You can now choose to add the Like button at the top or bottom of your articles (or both) 
* You can now choose where and how the Like button appears (lots of options)
* You can provide a list of pages where not to show the Like button (comma-separated list of IDs or slugs) 

= 1.0.1 =
* Fixed a compatibilty problem with PHP 4