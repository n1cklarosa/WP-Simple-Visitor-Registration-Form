<?php

/**
 * Provide a admin area view with help details on setting up the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://nicklarosa.net
 * @since      1.0.0
 *
 * @package    Simple_Visitor_Registration
 * @subpackage Simple_Visitor_Registration/admin/partials
 */
 

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) die;
?>
<div class="wphead">
    <h2>Common Questions</h2>
</div>

<h4>How do I enable Google ReCaptcha?</h4>

<p>Once the plugin has been activated, you will see a new admin section titled "Simple Visitor Registration", with a sub menu "Visitor Registration reCAPTCHA". Enter your Google ReCaptcha Site Key and Secret into the relevant fields and save. Your form shuold now be using Captcha. Please not this is only compatible iwth v2 of ReCaptcha.</p>

<h4>How can I add another link to the confirmation page?</h4>

<p>This can be achieved with shortcode attributes atrrbiutes. Here is an example shortcode with a custom link showing "View Menu" along side the "add a guest" link. `[visitor_registration_form customlink="/view-menu" customlinktext="View Menu"]`</p>

<h4>Can I remove old entries from my database?</h4>

<p>Of course! Head to the 'Export and Delete Entries' page in the admin section under 'Simple Visitor Registration' and press on the "Delete all entries" . <span style="color:red">A quick warning, this is permanant, so be sure to export and backup your entries before pressing this button.</span></p>

<h4>How do I use the shortcode?</h4>

<p>The shortcode to display form is</p> <code>[visitor_registration_form]</code>. <p>Place this into the content of any post or page.</p>

A complete version of the shortcode looks like the following: These values are not required, they are offered to allow you to brand your form.</p>

<code>[visitor_registration_form fnametext="First Name" lnametext="Surname" emailtext="Email Address" phonetext="Phone Number" customfield1="Room Number" inputfieldbordertop="0px solid black !important" inputfieldborderleft="0px solid black !important" inputfieldborderright="0px solid black !important" inputfieldborderbottom="2px solid black !important" inputfieldwidth="100%" inputfieldtextcolour="#000 !important" inputfieldpadding="10px 20px !important" inputfieldmargin="10px 0px !important" buttoncolour="#000 !important" buttontextcolour="#fff !important" buttonpadding="20px 20px !important" buttonmargin="10px 0px !important" buttonwidth="100% !important" buttontext="Register" errortextcolor="#fff !important"  customlink="/view-menu" customlinktext="View Menu"]</code>

<h4>Style Customisation</h4>
 
<p>The following shortcode attributes can be used to customise the form without having to alter your theme. A custom field can also be added using the 'customfield1' option.</p>

fnametext - Customise the First Name placeholder text<br />
lnametext - Customise the Last Name placeholder text<br />
emailtext - Customise the Email Address placeholder text<br />
phonetext - Customise the Phone Number placeholder text <br />
inputfieldbordertop - Text fields top border css properties<br />
inputfieldborderleft - Text fields left border css properties<br />
inputfieldborderright - Text fields right border css properties<br />
inputfieldborderbottom - Text fields bottom border css properties<br />
inputfieldfontsize - Text field font size css properties<br />
inputfieldbackgroundcolor - Text fields background color css properties<br />
inputfieldwidth'- Text fields width value css properties<br />
inputfieldlineheight - Text field line height css properties<br />
inputfieldtextcolor - Text field font color css properties<br />
inputfieldpadding - Text field padding css properties<br />
inputfieldmargin - Text field margin css properties<br />
buttoncolour - Button font background color css properties<br />
buttontextcolor - Button font color css properties<br />
buttonpadding - Button padding css properties<br />
buttonmargin - Button margin css properties<br />
buttonwidth - Button width css properties<br />
errortextcolor - Error text color css properties<br />
buttontext - Customise the Register Button Text<br />

<h4>Add another field to your form</h4>


customfield1 - Name of an optional extra field eg. roomNumber