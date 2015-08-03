=== LH Personalised Content ===
Contributors: shawfactor
Tags: personalise, personalize, emails, user, name, first name, sender email, sender name, sender
Requires: 3.0
Tested up to: 4.2
Version: 1.1
Stable tag: Trunk

This plugin allows one to personalise wordpress emails, or content for a logged in user.

== Description ==
This plugin allows one to personalise content for a logged in user or emails for a email recipeient that is in the user database.  It uses shortcode type functionality in any email, page, post, or custpm post type. It extract stored details of the viewer or reader. A default text can be specified for situations where there are no stored details.

This can allow you to offer a more customised service for example with a more helpful unsubscribe link.  Or you could create your own "profile" page for logged in users only.

Check out [our documentation][docs] for more information. 

All tickets for the project are being tracked on [GitHub][].

[docs]: https://github.com/shawfactor/lh-personalised-content
[GitHub]: https://github.com/shawfactor/lh-login-page


== Changelog ==
= 1.0 =
* Launch of the plugin


= 1.1 =
* Enhanced documentation


= 1.2 =
* Filter title

== Installation ==

1. In the wordpress admin plugin section of your site, click "Add New" or download and Unzip the file into your wordpress plugins folder.
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Add the shortcode to your posts, pages, cpt's or emails as described in the how to use section

= How to use  =

Simplest: Put [lh_personalised_content]Content[/lh_personalised_content] in your page, post, or email template.  eg: If you want to welcome only logged in users you could put [lh_personalised_content]Welcome logged in users[/lh_personalised_content]

This plugin also allows you to create personalised templates for logged in users or email recipients. By the use of placeholders based on wordpress user data. The following data is supported: %user_login% - the users username, %user_email% - the users email, %first_name% - the users first name, %last_name% - the users last name, %display_name% - the users display name, %ID% - the users ID, %description% - the users bio or description.

More attributes will be added in time.

The shortcode also has a loggedout attribute. This is only displayed to logged out users.

Examples:

*  [lh_personalised_content]%display_name%[/lh_personalised_content]     will display display name to logged in users and nothing to logged out users
*  [lh_personalised_content loggedout="Hello guest"]%first_name%[/lh_personalised_content] will display the users first name to logged in users and "hello guest" to logged out users


