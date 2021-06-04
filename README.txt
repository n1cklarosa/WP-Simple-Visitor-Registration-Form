=== Simple Visitor Registration Form ===
Contributors: nicklarosa
Donate link: https://nicklarosa.net
Tags: registration, form
Requires at least: 5.0
Tested up to: 5.7
Stable tag: 1.0.1
Requires PHP: 7.0
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Add a simple visitor registration form to any wordpress site.

== Description ==

There are loads of great full featured form plugins available for wordpress. Some take a little getting to know in order to get the most out of them. This plugin is not one of those, it is something simple to help physical venues create a visitor registration form with the use of a single shortcode.

Once a patron of a venue has filled out the form, they have the option to add a new guest or visit a customisable link of the venue's choice. Entries can then be exported to CSV by the Wordpress administrator with exact date along side the details added into the form.

Links to your form can be place at the entrance to a location as a requirement of entry.

**Features**

- Simple shortcode to instantly create a form with First and Last Name, phone and Email
- Add a custom form field, eg. "Destination Room Number" or any other information that might be handy.
- Customise view using attributes- Google Recaptcha

**How to Contribute**

If you want to contribute to Simple Visitor Registration Form, you can [fork the GitHub repository](https://github.com/n1cklarosa/WP-Simple-Visitor-Registration-Form) - all pull requests will be reviewed and merged if they fit into the goals for the plugin.

== Installation ==

Upload the Simple Visitor Registration Form plugin to your wordpress website, activate it, and then use the shortcode to build your registraion form.

== Screenshots ==

1. Example of form working in TwentyTwenty theme

== Frequently Asked Questions ==

= How do I enable Google ReCaptcha? =

Once the plugin has been activated, you will see a new admin section titled "Simple Visitor Registration", with a sub menu "Visitor Registration reCAPTCHA". Enter your Google ReCaptcha Site Key and Secret into the relevant fields and save. Your form shuold now be using Captcha. Please not this only compatible iwth v2 of ReCaptcha.

= How can I add another link to the confirmation page? =

This can be achieved with shortcode attributes atrrbiutes. Here is an example shortcode with a custom link showing "View Menu" along side the "add a guest" link. `[visitor_registration_form customlink="/view-menu" customlinktext="View Menu"]`

= Can I remove old entries from my database? =

Of course! Head to the 'Export and Delete Entries' page in the admin section under 'Simple Visitor registration' and press on the "Delete all entries" buttons. A warning, this is permanant, so besure to export your entries before pressing this button.

= How do I use the shortcode? =

The shortcode to display form is `[visitor_registration_form]`. Place is the content of any post or page.

A complete version of the shortcode looks like the following:

`[visitor_registration_form fnametext="First Name" lnametext="Surname" emailtext="Email Address" phonetext="Phone Number" customfield1="Room Number" inputfieldbordertop="0px solid black !important" inputfieldborderleft="0px solid black !important" inputfieldborderright="0px solid black !important" inputfieldborderbottom="2px solid black !important" inputfieldwidth="100%" inputfieldtextcolour="#000 !important" inputfieldpadding="10px 20px !important" inputfieldmargin="10px 0px !important" buttoncolour="#000 !important" buttontextcolour="#fff !important" buttonpadding="20px 20px !important" buttonmargin="10px 0px !important" buttonwidth="100% !important" buttontext="Register" errortextcolor="#fff !important"  customlink="/view-menu" customlinktext="View Menu"]`

== Changelog ==

= 1.0.1 =
* Fixed a bug when not using recaptcha field

= 1.0.0 =
* First publicly available version.

== Upgrade Notice ==

= 1.0.1 =
* Fixed a bug when not using recaptcha field

= 1.0.0 =
* First publicly available version.