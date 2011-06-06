=== Janrain Engage - Authentication from Facebook, Google, Yahoo, Windows Live ID and OpenID ===
Contributors: brianellin, forestb
Donate link: http://www.janrain.com/products/engage/
Tags: rpx, authentication, facebook, facebook connect, facebookconnect, openid, twitter, google, yahoo, api, oauth, myspace, linkedin, windows live, login, registration, register, social api, social apis, widget, community, sharing, share, publish, publishing, share button, share widget, social widget, tweet, status update, news feed, newsfeed
Requires at least: 3.0.0
Tested up to: 3.0.0
Stable tag: 0.3.1

The Janrain Engage (formerly RPX) wordpress plugin. Requires profiles with email address. http://www.janrain.com/products/engage/

== Description ==
[Janrain Engage](http://www.janrain.com/products/engage/ "Janrain Engage") (formerly RPX) connects your Wordpress site or blog to the social networks and enables you to increase registration rates and drive engagement.  Janrain Engage helps you:

* Quickly register and login users with their existing accounts from Facebook, Twitter, Google, Yahoo!, LinkedIn, Windows Live, MySpace, AOL or OpenID. 
* Build rich user profiles by enabling your visitors to import their profile data from their social network or email accounts.
* Create new accounts without registering and maintaining a password.
* Display verified identity and the icon of a user’s preferred network on blog comments.

The Janrain Engage plug-in is easy to install and configure in minutes, with no template modifications required.

== Installation ==

1. Copy the `rpx` directory and its contents to your `/wp-content/plugins/` directory.
2. Activate the rpx plugin through the 'Plugins' menu in WordPress
3. Visit the RPX configuration page by going to 'Settings' ->
'Options,' and follow the instructions to finish your installation.
If you don't already have an RPX account and API key, you may click
the "Get an RPX API Key" button to kick off the automatic configuation
of your wordpress installation.  If you have already created an RPX
account and site for your WordPress blog, just past your API Key into
the box and click "Save." 
4. Due to the new email address requirements in Wordpress 3 You can only 
use this plugin with providers that return the email address.
You must enable the email address data option in the provider settings
when using Facebook. If the provider settings does not show email as a 
profile option the plugin will not work for that provider.

== Frequently Asked Questions ==

= How do I enable Facebook, Twitter, MySpace, and Live ID authentication? =

Go to https://rpxnow.com/ and sign-in.  In the left navigation bar
there is a tab for each of those providers which includes instructions
for setting up each one.  All three require you to obtain an API key
and secret for your individual site, and approve their developer terms
of service. The plugin does not currently support Twitter as Twitter
does not share email addresses and Wordpress 3 requires this.

= Help! The plugin doesn't work = 

Send as much information about your php/wordpress version and runtime
as you can to forest -at- janrain.com.  We'll do our best to get the
plugin working with your configuration.

Note: using a modern version of PHP and Wordpress usually fixes most
problems, so make sure you are up to date.

== Screenshots ==

1. The Janrain Engage sign-in widget.  You can fully customize which identity providers to support, and the order in which they appear on the widget.
2. Example of the return user sign-in experience with Janrain Engage.  Janrain Engage remembers the user’s preferred network.
3. Comments enabled through Janrain Engage.  Clicking on the favicons for each network beneath the comments section allows users to sign-in via the Janrain Engage interface.

