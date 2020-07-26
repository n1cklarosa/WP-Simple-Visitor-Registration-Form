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

#### Customise

The following shortcode attributes can be used to customise the form without having to alter your theme. A custom field can also be added using the 'customfield1' option

fnametext - Customise the First Name placeholder text lnametext - Customise the Last Name placeholder text emailtext - Customise the Email Address placeholder text phonetext - Customise the Phone Number placeholder text 
inputfieldbordertop - Text fields top border css properties inputfieldborderleft - Text fields left border css properties inputfieldborderright - Text fields right border css properties inputfieldborderbottom - Text fields bottom border css properties inputfieldfontsize - Text field font size css properties inputfieldbackgroundcolor - Text fields background color css properties inputfieldwidth'- Text fields width value css properties inputfieldlineheight - Text field line height css properties inputfieldtextcolor - Text field font color css properties inputfieldpadding - Text field padding css properties inputfieldmargin - Text field margin css properties buttoncolour - Button font background color css properties buttontextcolor - Button font color css properties buttonpadding - Button padding css properties buttonmargin - Button margin css properties buttonwidth - Button width css properties errortextcolor - Error text color css properties customfield1 - Name of an extra field eg. Room Number buttontext - Customise the Register Button Text

`[visitor_registration_form fnametext="First Name" lnametext="Surname" emailtext="Email Address" phonetext="Phone Number" customfield1="Company" inputfieldbordertop="0px solid black !important" inputfieldborderleft="0px solid black !important" inputfieldborderright="0px solid black !important" inputfieldborderbottom="2px solid black !important" inputfieldwidth="100%" inputfieldtextcolour="#000 !important" inputfieldpadding="10px 20px !important" inputfieldmargin="10px 0px !important" buttoncolour="#000 !important" buttontextcolour="#fff !important" buttonpadding="20px 20px !important" buttonmargin="10px 0px !important" buttonwidth="100% !important" buttontext="Register" errortextcolor="#fff !important"]`
 