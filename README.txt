=== Plugin Name ===
Contributors: (this should be a list of wordpress.org userid's)
Donate link: https://nicklarosa.net
Tags: registration
Requires at least: 5.0
Tested up to: 5.4
Stable tag: 5.0
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Add a simple visitor registration form to any wordpress content

# WP-Simple-Visitor-Registration-Form

### Installation

1. Upload project to your plugins folder in its own directory. eg. to the `/wp-content/plugins/WP-simple-visitor-registration/` directory.
2. Head to your plugin screen to activate it

### Google ReCAPTCHA

Once the plugin has been activated, you will see a new admin section titled "Simple Visitor Registration", with a sub menu "Visitor Registration reCAPTCHA". Enter your Google ReCaptcha Site Key and Secret into the relevant fields

#### Security

ReCaptcha keys can be stored as environment variables rather than saving them to the database.

e.g.

```
putenv("GOOGLE_CAPTCHA_SITE_KEY=foobar");
putenv("GOOGLE_CAPTCHA_SECRET_KEY=foobar");
```

### Shortcode

This plugin will provide the ability to add a form with the following shortcode from any WYSIWYG editor in wordpress. This will use some default styling, however, styles can be altered with a little CSS using the attributes found under "Customise".

`[visitor_registration_form]`

### Adding a custom link to confirmation

By default, the form will return the option to add a guest once a the form has been submitted. You may want to add a link to a menu or location policies upon the form being submitted. I have set up a few shortcode attributes you can use to make this happen

Example with a custom link showing "View Menu" along side the add a guest. 

`[visitor_registration_form customlink="/view-menu" customlinktext="View Menu"]`

#### Customise

The following shortcode attributes can be used to customise the form without having to alter your theme. A custom field can also be added using the 'customfield1' option

fnametext - Customise the First Name placeholder textlnametext - Customise the Last Name placeholder textemailtext - Customise the Email Address placeholder textphonetext - Customise the Phone Number placeholder text 
inputfieldbordertop - Text fields top border css propertiesinputfieldborderleft - Text fields left border css propertiesinputfieldborderright - Text fields right border css propertiesinputfieldborderbottom - Text fields bottom border css propertiesinputfieldfontsize - Text field font size css propertiesinputfieldbackgroundcolor - Text fields background color css propertiesinputfieldwidth'- Text fields width value css propertiesinputfieldlineheight - Text field line height css propertiesinputfieldtextcolor - Text field font color css propertiesinputfieldpadding - Text field padding css propertiesinputfieldmargin - Text field margin css propertiesbuttoncolour - Button font background color css propertiesbuttontextcolor - Button font color css propertiesbuttonpadding - Button padding css propertiesbuttonmargin - Button margin css propertiesbuttonwidth - Button width css propertieserrortextcolor - Error text color css propertiescustomfield1 - Name of an extra field eg. Room Numberbuttontext - Customise the Register Button Text

`[visitor_registration_form fnametext="First Name" lnametext="Surname" emailtext="Email Address" phonetext="Phone Number" customfield1="Company" inputfieldbordertop="0px solid black !important" inputfieldborderleft="0px solid black !important" inputfieldborderright="0px solid black !important" inputfieldborderbottom="2px solid black !important" inputfieldwidth="100%" inputfieldtextcolour="#000 !important" inputfieldpadding="10px 20px !important" inputfieldmargin="10px 0px !important" buttoncolour="#000 !important" buttontextcolour="#fff !important" buttonpadding="20px 20px !important" buttonmargin="10px 0px !important" buttonwidth="100% !important" buttontext="Register" errortextcolor="#fff !important"]`
 