(function ($) {
  "use strict";

  jQuery(document).ready(function ($) {
    if (
      wp_ajax.google_captcha_site_key !== "" &&
      wp_ajax.google_captcha_site_key !== null
    ) {
      onload();
    } else {
      jQuery("#simplevisitorregistration-userdetails").on(
        "submit",
        function (e) {
          e.preventDefault();
          process_form();
        }
      );
    }
  });
})(jQuery);

function onSubmit(token) {
  process_form();
}

function validate_registration_form(event) {
  event.preventDefault();
  var container = jQuery("#simplevisitorregistration-form-wrapper");
  container.addClass("svr-loading");
  if (!document.getElementById("fname").value) {
    jQuery(".register-message").text("Please enter a first name").show();
    container.removeClass("svr-loading");
    return;
  }
  if (!document.getElementById("lname").value) {
    jQuery(".register-message").text("Please enter a last name").show();
    container.removeClass("svr-loading");
    return;
  }
  if (!document.getElementById("email").value) {
    jQuery(".register-message").text("Please enter an email address").show();
    container.removeClass("svr-loading");
    return;
  }
  if (!document.getElementById("phone").value) {
    jQuery(".register-message").text("Please enter a phone number").show();
    container.removeClass("svr-loading");
    return;
  }
  if (!document.getElementById("cfield1").value) {
    jQuery(".register-message")
      .text("Please ensure all fields are filled out correctly")
      .show();
    container.removeClass("svr-loading");
    return;
  }
  grecaptcha.execute();
}

function resetForm() {
  jQuery(".simplevisitorregistration-complete-div").slideUp();
  var that = jQuery("#simplevisitorregistration-userdetails");
  that.trigger("reset").slideDown();
}

function onload() {
  var element = document.getElementById("visitor_submit");
  element.onclick = validate_registration_form;
}

function process_form() {
  var that = jQuery("#simplevisitorregistration-userdetails");
  var container = jQuery("#simplevisitorregistration-form-wrapper");
  var newFirstName = jQuery("#fname").val();
  var newLastName = jQuery("#lname").val();
  var newUserEmail = jQuery("#email").val();
  var cfield1 = jQuery("#cfield1").val();
  var phone = jQuery("#phone").val();
  var recaptcha = null;

  if (
    wp_ajax.google_captcha_site_key !== "" &&
    wp_ajax.google_captcha_site_key !== null
  ) {
    recaptcha = grecaptcha.getResponse();
  }
  jQuery(".register-message").text("");
  container.addClass("svr-loading");

  jQuery.ajax({
    type: "POST",
    dataType: "json",
    url: wp_ajax.ajax_url,
    data: {
      action: "register_user_front_end",
      phone: phone,
      fname: newFirstName,
      lname: newLastName,
      email: newUserEmail,
      security: wp_ajax._nonce,
      "g-recaptcha-response": recaptcha,
      cfield1: cfield1,
    },
    success: function (data) {
      container.removeClass("svr-loading");
      if (data.status == true) {
        jQuery("#simplevisitorregistration-userdetails")
          .trigger("reset")
          .slideUp();
        jQuery(".simplevisitorregistration-complete-div").css(
          "display",
          "block"
        );
      } else if (data.status == false) {
        jQuery(".register-message").text(data.message).show();
        if (
          wp_ajax.google_captcha_site_key !== "" &&
          wp_ajax.google_captcha_site_key !== null
        ) {
          grecaptcha.reset();
        }
      }
    },
    error: function (results) {},
  });
}
