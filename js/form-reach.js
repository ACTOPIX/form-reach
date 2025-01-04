jQuery(document).ready(function ($) {
  var formreach_siteKey = formReach.formreach_key_site;
  var formreach_recaptchaSwitch = formReach.formreach_recaptcha_switch;

  function handleFormSubmit(
    formreach_event,
    formreach_formId,
    formreach_spinnerSelector,
    formreach_submitContentSelector,
    formreach_serializeDataArray,
    formreach_shortcodeId
  ) {
    formreach_event.preventDefault();
    var formreach_form = $(formreach_formId);

    var formreach_processDataAjax = function (formreach_response) {
      $(formreach_spinnerSelector).hide();
      $(formreach_submitContentSelector).show();

      if (formreach_response.success) {
        $("#formreach_success_message_" + formreach_shortcodeId)
          .fadeIn(500)
          .delay(5000)
          .fadeOut(500);

        // Email validation if response.success is true
        if (formreach_response.emailValid === false) {
          $("#error_message").fadeIn(500).delay(5000).fadeOut(500);
          return;
        }

        switch (formreach_formId) {
          case "#formreach_whatsapp":
            var formreach_options =
              "width=600,height=400,left=" +
              (screen.width - 600) / 2 +
              ",top=" +
              (screen.height - 400) / 2;
            window.open(
              formreach_response.whatsapp_link,
              "_blank",
              formreach_options
            );
            break;
          case "#formreach_mail":
            // No specific action needed for mail on success
            break;
          default:
            console.log("Unknown form ID");
        }
      } else {
        $("#formreach_error_message_" + formreach_shortcodeId)
          .fadeIn(500)
          .delay(5000)
          .fadeOut(500);
      }

      formreach_form[0].reset();
    };

    var formreach_performAjaxSubmit = function () {
      var formreach_actionName = "";
      switch (formreach_formId) {
        case "#formreach_mail":
          formreach_actionName = "submit_contact_form";
          break;
        case "#formreach_whatsapp":
          formreach_actionName = "submit_whatsapp_form";
          break;
        default:
          console.log("Unknown form ID");
      }
      formreach_serializeDataArray.push({
        name: "action",
        value: formreach_actionName,
      });

      $.ajax({
        type: "POST",
        url: formReach.formreach_ajax_url,
        data: formreach_serializeDataArray,
        beforeSend: function () {
          $(formreach_submitContentSelector).hide();
          $(formreach_spinnerSelector).show();
        },
        dataType: "json",
        success: formreach_processDataAjax,
        error: function () {
          $(formreach_spinnerSelector).hide();
          $(formreach_submitContentSelector).show();
          $("#formreach_error_message_" + formreach_shortcodeId)
            .fadeIn(500)
            .delay(5000)
            .fadeOut(500);
        },
      });
    };

    if (formreach_recaptchaSwitch !== "1") {
      formreach_performAjaxSubmit();
    } else {
      grecaptcha.ready(function () {
        grecaptcha
          .execute(formreach_siteKey, { action: "submit" })
          .then(function (token) {
            formreach_serializeDataArray.push({
              name: "recaptcha_response",
              value: token,
            });
            formreach_performAjaxSubmit();
          });
      });
    }
  }

  $("#formreach_mail, #formreach_whatsapp").submit(function (formreach_event) {
    var formreach_formId = "#" + $(this).attr("id");
    var formreach_spinnerSelector = "";
    var formreach_submitContentSelector = "";
    const formreach_shortcodeId = $(this)
      .find('input[name="formreach_container_post"]')
      .val();

    switch (formreach_formId) {
      case "#formreach_mail":
        formreach_spinnerSelector =
          "#formreach_spinner_" + formreach_shortcodeId;
        formreach_submitContentSelector =
          "#formreach_submitContent_" + formreach_shortcodeId;
        break;
      case "#formreach_whatsapp":
        formreach_spinnerSelector =
          "#formreach_spinnerWhatsapp_" + formreach_shortcodeId;
        formreach_submitContentSelector =
          "#formreach_submitContentWhatsapp_" + formreach_shortcodeId;
        break;
      default:
        console.log("Unknown form ID");
    }

    var formreach_serializeDataArray = $(this).serializeArray();
    var formreach_nonce = $(this)
      .find('input[name="formreach_send_contact_nonce"]')
      .val();
    formreach_serializeDataArray.push({
      name: "formreach_send_contact_nonce",
      value: formreach_nonce,
    });
    handleFormSubmit(
      formreach_event,
      formreach_formId,
      formreach_spinnerSelector,
      formreach_submitContentSelector,
      formreach_serializeDataArray,
      formreach_shortcodeId
    );
  });

  $('input[type="email"]').on("input", function () {
    var formreach_emailValue = this.value;
    var formreach_isValidEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(
      formreach_emailValue
    );
    var formreach_feedbackElement = this.nextElementSibling;
    var formreach_submitButton = $(this)
      .closest("form")
      .find('button[type="submit"]');

    if (formreach_isValidEmail) {
      formreach_feedbackElement.style.display = "none";
      formreach_submitButton.prop("disabled", false);
    } else {
      formreach_feedbackElement.style.display = "block";
      formreach_submitButton.prop("disabled", true);
    }
  });
});
