== Private Site with Custom Login Page ==
Contributors: joaorosa
Plugin URI: 
Tags: private website, private site, custom login, login page, private intranet, private site intranet, lock-in website, only logged in users, force login, lock site, intranet, login system
Author URI: https://globalisp.pt
Author: Global ISP
Donate link: 
Requires at least: 3.0
Tested up to: 4.8.2
Stable tag: 1.2.0
Version: 1.2.0

Make your website private! Only logged in users can view your website. Perfect for intranets or in development websites.

== Description ==

This plugin makes the users login in order to visit the website. Everytime a guest user tries to access the website it will be redirected to a login page of your choice.

The plugin is very easy to configure: Create the login page, go to "Private Intranet" tab in your admin menu, select the login page and the page you want the user to be redirected to, save the changes and you'r all set!.

The "/wp-login" page will still be available.

== Features ==

* Compatible with any theme
* Translation ready
* Make your website private - Only logged in user can access it
* Redirect Guest users to the login page
* Choose a custom login page (instead of wp-admin/wp-login)
* Choose the page to which users should be redirected after the login
* Use the shortcode [private-website-intranet-login] for more flexibility (You need to activate this option in the "Private Intranet" menu)


== Installation ==

1. Go to "Plugins" --> "Add New" --> "Upload Plugin"
1. Upload the file "private-website-intranet.zip"
1. Activate the plugin in the "Plugins" menu.

== Frequently Asked Questions ==

= How do I configure the plugin? =

You have 2 ways to configure the plugin. One with the a shortcode (that gives you more flexibility), and another one without.

Configuration without shortcode:

1. Create a Login page;
2. Go to the menu "Private Intranet", choose the previously created login page and the page to which the user should be redirected to after login (you can leave it blank);
3. Save all changes;
4. You are all set!

Configuration with shortcode:

1. Create a Login page and add the shortcode [private-website-intranet-login] to the content of the page;
2. Go to the menu "Private Intranet", choose the desired login page and page the user should be redirected to after login;
3. In the menu "Private Intranet", check the box "Use shortcode to place the login form?";
4. Save all changes;
5. You are all set!

= I'm trapped and can't acces the login page I defined! What can I do? =

Just access /wp-login and login to your website. For example: http://example.com/wp-login.

= I have a feature to request or a bug to report. Where can I do it?

Please do try to contact me if you have an issue or a suggestions!
You can use the "Support" tab at the top of this page to contact me. Just create a new post and i'll attend to you as soon as I can.

= Is the plugin translation ready? =

Yes, the plugin is translation ready. Right now, the plugin is available in English (US) and Portuguese (PT).


== Screenshots ==

1. Settings Page.
2. Default Login Page.

== Changelog ==

= 1.2 =

* From now on, there's no need for a shortcode in the login page. Just select your desired login page in the "Private Intranet" menu;
* You can still use a shortcode if you want more flexibility on your login page visual. Just check the box "Use shortcode to place the login form?" and place the shortcode [private-website-intranet-login] in the login page;

= 1.1.1 =

* Fixed bug where the user wasn't being redirected to the defined "Redirect After Login" page.

= 1.1 =
* Fixed bug where, if no login page was set, the plugin would send the user into a redirect loop
* Fixed bug where "/wp-login" wasn't available.
* Added functionality: When a logged in user tries to access the defined login page, it will be redirected to the defined "Redirect After Login" page

= 1.0 =
* Plugin Launch

== Upgrade Notice ==

* Bug fixes
* Functionality added