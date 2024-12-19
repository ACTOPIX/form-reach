// Import Bootstrap JS
import "bootstrap";

// Import Bootstrap SCSS
import "bootstrap/scss/bootstrap.scss";

(function ($) {
  // Refactorisé pour utiliser jQuery dans le scope local
  window.formreach_modalTextGenerator = function () {
    var formreach_type = ' type="text"',
      formreach_required = $("#formreach_generator-text-required").is(
        ":checked"
      )
        ? ' required="required"'
        : "",
      formreach_label = $("#formreach_generator-text-label").val()
        ? ' label="' + $("#formreach_generator-text-label").val() + '"'
        : "",
      formreach_name = $("#formreach_generator-text-name").val()
        ? ' name="' + $("#formreach_generator-text-name").val() + '"'
        : "",
      formreach_class = $("#formreach_generator-text-class").val()
        ? ' class="' + $("#formreach_generator-text-class").val() + '"'
        : "",
      formreach_id = $("#formreach_generator-text-id").val()
        ? ' id="' + $("#formreach_generator-text-id").val() + '"'
        : "",
      formreach_value = $("#formreach_generator-text-value").val()
        ? ' value="' + $("#formreach_generator-text-value").val() + '"'
        : "",
      formreach_placeholder = "";

    if ($("#formreach_generator-text-placeholder").is(":checked")) {
      formreach_placeholder =
        ' placeholder="' + $("#formreach_generator-text-value").val() + '"';
      formreach_value = ""; // Effacer la valeur si placeholder est coché
    }

    $("#formreach_generatedTextShortcode").val(
      "[formreach_input" +
        formreach_type +
        formreach_label +
        formreach_name +
        formreach_value +
        formreach_id +
        formreach_class +
        formreach_required +
        formreach_placeholder +
        "]"
    );
  };
})(jQuery);

(function ($) {
  window.formreach_modalEmailGenerator = function () {
    var formreach_type = ' type="email"',
      formreach_required = $("#formreach_generator-email-required").is(
        ":checked"
      )
        ? ' required="required"'
        : "",
      formreach_label = $("#formreach_generator-email-label").val()
        ? ' label="' + $("#formreach_generator-email-label").val() + '"'
        : "",
      formreach_name = $("#formreach_generator-email-name").val()
        ? ' name="' + $("#formreach_generator-email-name").val() + '"'
        : "",
      formreach_class = $("#formreach_generator-email-class").val()
        ? ' class="' + $("#formreach_generator-email-class").val() + '"'
        : "",
      formreach_id = $("#formreach_generator-email-id").val()
        ? ' id="' + $("#formreach_generator-email-id").val() + '"'
        : "",
      formreach_value = $("#formreach_generator-email-value").val()
        ? ' value="' + $("#formreach_generator-email-value").val() + '"'
        : "",
      formreach_placeholder = "";

    if ($("#formreach_generator-email-placeholder").is(":checked")) {
      formreach_placeholder =
        ' placeholder="' + $("#formreach_generator-email-value").val() + '"';
      formreach_value = ""; // Reset value if placeholder is used
    }

    $("#formreach_generatedEmailShortcode").val(
      "[formreach_input" +
        formreach_type +
        formreach_label +
        formreach_name +
        formreach_value +
        formreach_id +
        formreach_class +
        formreach_required +
        formreach_placeholder +
        "]"
    );
  };
})(jQuery);

(function ($) {
  window.formreach_modalTelGenerator = function () {
    const formreach_type = ' type="tel"',
      formreach_required = $("#formreach_generator-tel-required").is(":checked")
        ? ' required="required"'
        : "",
      formreach_label = $("#formreach_generator-tel-label").val()
        ? ` label="${$("#formreach_generator-tel-label").val()}"`
        : "",
      formreach_name = $("#formreach_generator-tel-name").val()
        ? ` name="${$("#formreach_generator-tel-name").val()}"`
        : "",
      formreach_class = $("#formreach_generator-tel-class").val()
        ? ` class="${$("#formreach_generator-tel-class").val()}"`
        : "",
      formreach_id = $("#formreach_generator-tel-id").val()
        ? ` id="${$("#formreach_generator-tel-id").val()}"`
        : "",
      formreach_value = $("#formreach_generator-tel-value").val()
        ? ` value="${$("#formreach_generator-tel-value").val()}"`
        : "",
      formreach_placeholder = $("#formreach_generator-tel-placeholder").is(
        ":checked"
      )
        ? ` placeholder="${$("#formreach_generator-tel-value").val()}"`
        : "";

    // Reset value if placeholder is used
    const formreach_final_value = formreach_placeholder ? "" : formreach_value;

    $("#formreach_generatedTelShortcode").val(
      `[formreach_input${formreach_type}${formreach_label}${formreach_name}${formreach_final_value}${formreach_id}${formreach_class}${formreach_required}${formreach_placeholder}]`
    );
  };
})(jQuery);

(function ($) {
  window.formreach_modalTextareaGenerator = function () {
    var formreach_type = ' type="textarea"',
      formreach_required = $("#formreach_generator-textarea-required").is(
        ":checked"
      )
        ? ' required="required"'
        : "",
      formreach_label = $("#formreach_generator-textarea-label").val()
        ? ' label="' + $("#formreach_generator-textarea-label").val() + '"'
        : "",
      formreach_cols = $("#formreach_generator-textarea-cols").val()
        ? ' cols="' + $("#formreach_generator-textarea-cols").val() + '"'
        : "",
      formreach_rows = $("#formreach_generator-textarea-rows").val()
        ? ' rows="' + $("#formreach_generator-textarea-rows").val() + '"'
        : "",
      formreach_name = $("#formreach_generator-textarea-name").val()
        ? ' name="' + $("#formreach_generator-textarea-name").val() + '"'
        : "",
      formreach_class = $("#formreach_generator-textarea-class").val()
        ? ' class="' + $("#formreach_generator-textarea-class").val() + '"'
        : "",
      formreach_id = $("#formreach_generator-textarea-id").val()
        ? ' id="' + $("#formreach_generator-textarea-id").val() + '"'
        : "",
      formreach_value = $("#formreach_generator-textarea-value").val()
        ? ' value="' + $("#formreach_generator-textarea-value").val() + '"'
        : "",
      formreach_placeholder = $("#formreach_generator-textarea-placeholder").is(
        ":checked"
      )
        ? ' placeholder="' +
          $("#formreach_generator-textarea-value").val() +
          '"'
        : "";

    // Reset value if placeholder is checked
    if ($("#formreach_generator-textarea-placeholder").is(":checked")) {
      formreach_value = "";
    }

    $("#formreach_generatedTextareaShortcode").val(
      "[formreach_input" +
        formreach_type +
        formreach_rows +
        formreach_cols +
        formreach_label +
        formreach_name +
        formreach_value +
        formreach_id +
        formreach_class +
        formreach_required +
        formreach_placeholder +
        "]"
    );
  };
})(jQuery);

(function ($) {
  document.addEventListener("DOMContentLoaded", function () {
    // Fonction pour vérifier et ajouter des attributs
    function formreach_checkAndAddAttributes(formreach_type) {
      const formreach_inputName = document.getElementById(
        `formreach_generator-${formreach_type}-name`
      );
      const formreach_requiredName = document.getElementById(
        `formreach_requiredName${formreach_capitalizeFirstLetter(
          formreach_type
        )}`
      );
      const formreach_modalId = `formreach_modal_${formreach_type}`;

      if (formreach_inputName && formreach_inputName.value !== "") {
        formreach_inputName.style.border = "solid 1px #8c8f94";
        if (formreach_requiredName)
          formreach_requiredName.setAttribute("hidden", true);
        $(`#${formreach_modalId}`).modal("hide"); // Fermeture du modal Bootstrap
        formreach_transfertField(formreach_type); // Appel de la fonction de transfert
      } else if (formreach_inputName) {
        formreach_inputName.style.border = "solid 2px red";
        if (formreach_requiredName)
          formreach_requiredName.removeAttribute("hidden");
      }
    }

    // Fonction pour vérifier l'utilisation des inputs du form builder dans l'email builder
    if (!document.getElementById("formreach_whatsapp_switch").checked) {
      var formreach_verifierCorrespondances = function () {
        var formreach_textarea1 = document.querySelector(
            "#formreach_contenu_formulaire"
          ),
          formreach_textarea2 = document.querySelector(
            "#formreach_email_admin_content"
          ),
          formreach_contenuTextarea1 = formreach_textarea1
            ? formreach_textarea1.value
            : "",
          formreach_contenuTextarea2 = formreach_textarea2
            ? formreach_textarea2.value
            : "",
          formreach_valeurs1 = (
            formreach_contenuTextarea1.match(/name="([^"]+)"/g) || []
          ).map((match) => match.slice(6, -1)),
          formreach_valeursManquantes1 = formreach_valeurs1
            .filter(
              (formreach_valeur) =>
                !formreach_contenuTextarea2.includes(`[${formreach_valeur}]`)
            )
            .map((formreach_valeur) => `[${formreach_valeur}] `),
          formreach_containerForm = document.getElementById(
            "formreach_warning_inputs_uncalled_container"
          ),
          formreach_containerEmail = document.getElementById(
            "formreach_warning_inputs_inexistent_container"
          ),
          formreach_messageForm = document.getElementById(
            "formreach_warning_inputs_uncalled"
          ),
          formreach_messageEmail = document.getElementById(
            "formreach_warning_inputs_inexistent"
          );

        if (formreach_valeursManquantes1.length) {
          formreach_containerForm.style.display = "block";
          setTimeout(() => {
            formreach_containerForm.style.opacity = "1";
          }, 200);
          setTimeout(() => {
            formreach_containerForm.style.height = "auto";
          }, 200);
          formreach_messageForm.innerHTML = `The following inputs are missing in the <u>email builder</u>: <strong>${formreach_valeursManquantes1.join(
            ", "
          )}</strong> `;
          formreach_containerEmail.style.display = "block";
          setTimeout(() => {
            formreach_containerEmail.style.opacity = "1";
          }, 200);
          setTimeout(() => {
            formreach_containerEmail.style.height = "auto";
          }, 200);
          formreach_valeursManquantes1 = formreach_valeurs1
            .filter(
              (formreach_valeur) =>
                !formreach_contenuTextarea2.includes(`[${formreach_valeur}]`)
            )
            .map(
              (formreach_valeur) =>
                `<span class="formreach_draggable" style="color:#41464b;font-weight:bold;" draggable="true">[${formreach_valeur}]</span>`
            );
          formreach_messageEmail.innerHTML = `The following draggable inputs  are not used: ${formreach_valeursManquantes1
            .join(", ")
            .replace(/,/g, " ")}`;
        } else {
          formreach_containerForm.style.opacity = "0";
          setTimeout(() => {
            formreach_containerForm.style.height = "0";
          }, 200);
          setTimeout(() => {
            formreach_containerForm.style.display = "none";
          }, 300);
          formreach_messageForm.innerHTML = "";
          formreach_containerEmail.style.opacity = "0";
          setTimeout(() => {
            formreach_containerEmail.style.height = "0";
          }, 200);
          setTimeout(() => {
            formreach_containerEmail.style.display = "none";
          }, 300);
          formreach_messageEmail.innerHTML = "";
        }

        document
          .querySelectorAll(".formreach_draggable")
          .forEach((draggable) => {
            draggable.addEventListener("dragstart", (event) => {
              event.dataTransfer.setData("text/plain", event.target.innerText);
            });
          });

        const formreach_draggableElements = document.querySelectorAll(
          ".formreach_draggable"
        );

        // Fonction pour ajouter le focus aux inputs spécifiés
        function formreach_focusInputs() {
          document.getElementById("formreach_email_admin_to").style.outline =
            "1.5px solid #2271B1";
          document.getElementById("formreach_email_admin_from").style.outline =
            "1.5px solid #2271B1";
          document.getElementById(
            "formreach_email_admin_subject"
          ).style.outline = "1.5px solid #2271B1";
          document.getElementById(
            "formreach_email_admin_content"
          ).style.outline = "1.5px solid #2271B1";
          document.getElementById("formreach_email_user_to").style.outline =
            "1.5px solid #2271B1";
          document.getElementById("formreach_email_user_from").style.outline =
            "1.5px solid #2271B1";
          document.getElementById(
            "formreach_email_user_subject"
          ).style.outline = "1.5px solid #2271B1";
          document.getElementById(
            "formreach_email_user_content"
          ).style.outline = "1.5px solid #2271B1";
        }

        function formreach_removeFocus() {
          document.getElementById("formreach_email_admin_to").style.outline =
            "";
          document.getElementById("formreach_email_admin_from").style.outline =
            "";
          document.getElementById(
            "formreach_email_admin_subject"
          ).style.outline = "";
          document.getElementById(
            "formreach_email_admin_content"
          ).style.outline = "";
          document.getElementById("formreach_email_user_to").style.outline = "";
          document.getElementById("formreach_email_user_from").style.outline =
            "";
          document.getElementById(
            "formreach_email_user_subject"
          ).style.outline = "";
          document.getElementById(
            "formreach_email_user_content"
          ).style.outline = "";
        }

        function formreach_handleDragStart(event) {
          formreach_focusInputs();
        }

        function formreach_handleDragEnd(event) {
          formreach_removeFocus();
        }

        formreach_draggableElements.forEach((element) => {
          element.setAttribute("draggable", "true");
          element.addEventListener("dragstart", formreach_handleDragStart);
          element.addEventListener("dragend", formreach_handleDragEnd);
        });
      };

      formreach_verifierCorrespondances();

      document.addEventListener("input", function (event) {
        if (event.target.matches("textarea")) {
          formreach_verifierCorrespondances();
        }
      });
    }

    // Fonction pour transférer le contenu du champ
    function formreach_transfertField(formreach_type) {
      const formreach_formContent = document.getElementById(
        "formreach_contenu_formulaire"
      );
      const formreach_generatedShortcode = document.getElementById(
        `formreach_generated${formreach_capitalizeFirstLetter(
          formreach_type
        )}Shortcode`
      );

      if (formreach_formContent && formreach_generatedShortcode) {
        // Vérifie s'il y a déjà du contenu dans la ligne précédente
        const formreach_previousLineContent = formreach_getPreviousLineContent(
          formreach_formContent
        );

        // Vérifie s'il y a du contenu après le curseur dans la dernière ligne
        const formreach_cursorPosition = formreach_formContent.selectionEnd;
        const formreach_textAfterCursor = formreach_formContent.value.substring(
          formreach_cursorPosition
        );
        const formreach_nextLineIndex = formreach_textAfterCursor.indexOf("\n");

        // Nombre de retours à la ligne à ajouter
        let formreach_lineBreaksToAdd = 1; // Par défaut, ajoute un retour à la ligne

        if (formreach_previousLineContent || formreach_nextLineIndex !== -1) {
          // Si la ligne précédente contient du contenu OU si le curseur est à la fin d'une ligne avec du contenu
          formreach_lineBreaksToAdd = 2; // Ajoute deux retours à la ligne
        }

        // Ajoute le nombre approprié de retours à la ligne avant generatedShortcode.value
        formreach_formContent.value +=
          "\n".repeat(formreach_lineBreaksToAdd) +
          formreach_generatedShortcode.value;

        formreach_clearFormFields(formreach_type); // Réinitialisation des champs
        if (!document.getElementById("formreach_whatsapp_switch").checked) {
          formreach_verifierCorrespondances();
        }
      }
    }

    // Fonction pour obtenir le contenu de la ligne précédente dans un textarea
    function formreach_getPreviousLineContent(formreach_textarea) {
      const formreach_cursorPosition = formreach_textarea.selectionStart;
      const formreach_textBeforeCursor = formreach_textarea.value.substring(
        0,
        formreach_cursorPosition
      );
      const formreach_previousLineIndex =
        formreach_textBeforeCursor.lastIndexOf("\n");

      if (formreach_previousLineIndex !== -1) {
        const formreach_previousLineContent =
          formreach_textBeforeCursor.substring(formreach_previousLineIndex + 1);
        return formreach_previousLineContent.trim(); // Retourne le contenu de la ligne précédente sans les espaces de début et de fin
      }

      return null; // Retourne null s'il n'y a pas de ligne précédente
    }

    // Fonction pour réinitialiser les champs du formulaire
    function formreach_clearFormFields(formreach_type) {
      const formreach_fields = [
        "required",
        "placeholder",
        "label",
        "name",
        "class",
        "id",
        "value",
      ];
      formreach_fields.forEach((formreach_field) => {
        const formreach_element = document.getElementById(
          `formreach_generator-${formreach_type}-${formreach_field}`
        );
        if (formreach_element) {
          if (formreach_element.type === "checkbox") {
            formreach_element.checked = false;
          } else {
            formreach_element.value = "";
          }
        }
      });
      const formreach_generatedShortcode = document.getElementById(
        `formreach_generated${formreach_capitalizeFirstLetter(
          formreach_type
        )}Shortcode`
      );
      if (formreach_generatedShortcode)
        formreach_generatedShortcode.value = `[formreach_input type="${formreach_type}"]`;
    }

    // Fonction pour capitaliser la première lettre d'une chaîne
    function formreach_capitalizeFirstLetter(formreach_string) {
      return (
        formreach_string.charAt(0).toUpperCase() + formreach_string.slice(1)
      );
    }

    // Ajout d'écouteurs d'événements pour les boutons de soumission
    const formreach_types = ["text", "email", "textarea", "tel"];
    formreach_types.forEach((formreach_type) => {
      const formreach_submitButton = document.getElementById(
        `formreach_submit_${formreach_type}`
      );
      if (formreach_submitButton) {
        formreach_submitButton.addEventListener("click", function () {
          formreach_checkAndAddAttributes(formreach_type);
        });
      }
    });
  });
})(jQuery);

// Sets default values for the Mail form based on predefined values
function formreach_buttonDefaultMail() {
  // Retrieve default values defined in hidden inputs or other elements
  var formreach_defaultValues = {
    formreach_defaultEmailForm: formReach.formreach_email_form_default,
    formreach_defaultEmailSubmitText:
      formReach.formreach_email_submit_text_default,
    formreach_defaultEmailSubmitTextColor:
      formReach.formreach_email_submit_text_color_default,
    formreach_defaultEmailSubmitColor:
      formReach.formreach_email_submit_color_default,
  };
  // Apply these default values to the relevant form fields
  document.getElementById("formreach_contenu_formulaire").value =
    formreach_defaultValues.formreach_defaultEmailForm;
  document.getElementById("formreach_email_submit").value =
    formreach_defaultValues.formreach_defaultEmailSubmitText;
  document.getElementById("formreach_email_text_color").value =
    formreach_defaultValues.formreach_defaultEmailSubmitTextColor;
  document.getElementById("formreach_email_submit_color").value =
    formreach_defaultValues.formreach_defaultEmailSubmitColor;
  document.getElementById("formreach_color_text_code_email").value =
    formreach_defaultValues.formreach_defaultEmailSubmitTextColor;
  document.getElementById("formreach_color_code_email").value =
    formreach_defaultValues.formreach_defaultEmailSubmitColor;
}

function formreach_buttonDefaultWhatsapp() {
  var formreach_defaultValues = {
    formreach_defaultWhatsappForm: formReach.formreach_whatsapp_form_default,
    formreach_defaultWhatsappSubmitText:
      formReach.formreach_whatsapp_submit_text_default,
    formreach_defaultWhatsappSubmitTextColor:
      formReach.formreach_whatsapp_submit_text_color_default,
    formreach_defaultWhatsappSubmitColor:
      formReach.formreach_whatsapp_submit_color_default,
  };
  document.getElementById("formreach_contenu_formulaire").value =
    formreach_defaultValues.formreach_defaultWhatsappForm;
  document.getElementById("formreach_whatsapp_submit").value =
    formreach_defaultValues.formreach_defaultWhatsappSubmitText;
  document.getElementById("formreach_whatsapp_text_color").value =
    formreach_defaultValues.formreach_defaultWhatsappSubmitTextColor;
  document.getElementById("formreach_whatsapp_submit_color").value =
    formreach_defaultValues.formreach_defaultWhatsappSubmitColor;
  document.getElementById("formreach_color_text_code_whatsapp").value =
    formreach_defaultValues.formreach_defaultWhatsappSubmitTextColor;
  document.getElementById("formreach_color_code_whatsapp").value =
    formreach_defaultValues.formreach_defaultWhatsappSubmitColor;
}

// Default values for the email messages
function formreach_buttonDefaultEmailMessages() {
  var formreach_defaultValues = {
    formreach_defaultEmailSuccess: formReach.formreach_email_success_default,
    formreach_defaultEmailError: formReach.formreach_email_error_default,
  };
  document.getElementById("formreach_email_success").value =
    formreach_defaultValues.formreach_defaultEmailSuccess;
  document.getElementById("formreach_email_error").value =
    formreach_defaultValues.formreach_defaultEmailError;
}

// Default values for the whatsapp messages
function formreach_buttonDefaultWhatsappMessages() {
  var formreach_defaultValues = {
    formreach_defaultWhatsappSuccess:
      formReach.formreach_whatsapp_success_default,
    formreach_defaultWhatsappError: formReach.formreach_whatsapp_error_default,
  };
  document.getElementById("formreach_whatsapp_success").value =
    formreach_defaultValues.defaultWhatsappSuccess;
  document.getElementById("formreach_whatsapp_error").value =
    formreach_defaultValues.defaultWhatsappError;
}

// Default values for the email sending
function formreach_buttonDefaultEmailSending() {
  var formreach_defaultValues = {
    formreach_defaultEmailAdminTo: formReach.formreach_email_admin_to_default,
    formreach_defaultEmailAdminFrom:
      formReach.formreach_email_admin_from_default,
    formreach_defaultEmailAdminSubject:
      formReach.formreach_email_admin_subject_default,
    formreach_defaultEmailAdminContent:
      formReach.formreach_email_admin_content_default,

    formreach_defaultEmailUserTo: formReach.formreach_email_user_to_default,
    formreach_defaultEmailUserFrom: formReach.formreach_email_user_from_default,
    formreach_defaultEmailUserSubject:
      formReach.formreach_email_user_subject_default,
    formreach_defaultEmailUserContent:
      formReach.formreach_email_user_content_default,
  };
  document.getElementById("formreach_email_admin_to").value =
    formreach_defaultValues.formreach_defaultEmailAdminTo;
  document.getElementById("formreach_email_admin_from").value =
    formreach_defaultValues.formreach_defaultEmailAdminFrom;
  document.getElementById("formreach_email_admin_subject").value =
    formreach_defaultValues.formreach_defaultEmailAdminSubject;
  document.getElementById("formreach_email_admin_content").value =
    formreach_defaultValues.formreach_defaultEmailAdminContent;

  document.getElementById("formreach_email_user_to").value =
    formreach_defaultValues.formreach_defaultEmailUserTo;
  document.getElementById("formreach_email_user_from").value =
    formreach_defaultValues.formreach_defaultEmailUserFrom;
  document.getElementById("formreach_email_user_subject").value =
    formreach_defaultValues.formreach_efaultEmailUserSubject;
  document.getElementById("formreach_email_user_content").value =
    formreach_defaultValues.formreach_defaultEmailUserContent;
}

// Sélectionnez le formulaire à surveiller
const formreach_formulaire = document.getElementById("post");

if (formreach_formulaire) {
  let formreach_modificationsEnregistrees = true; // Inverser la logique pour simplifier

  // Détecte les modifications dans le formulaire
  formreach_formulaire.addEventListener("input", (e) => {
    // Vérifie si l'élément déclencheur est différent de l'input à exclure
    if (e.target.id !== "formreach_whatsapp_switch") {
      formreach_modificationsEnregistrees = false;
    }
  });

  // Gestionnaire d'événement 'beforeunload' pour avertir des modifications non enregistrées
  window.addEventListener("beforeunload", (e) => {
    if (!formreach_modificationsEnregistrees) {
      e.preventDefault();
      e.returnValue = ""; // Chrome requiert cette propriété pour afficher l'alerte
    }
  });

  // Gestionnaire de clics pour les boutons de soumission pour éviter les répétitions
  document.addEventListener("DOMContentLoaded", () => {
    const formreach_boutonsDeSoumission = document.querySelectorAll(
      "#formreach_whatsapp_switch, #formreach_save_messages, #formreach_saveFormWhatsapp, #formreach_save_email, #formreach_save_final, #formreach_publish_final, #formreach_publish_whatsapp, #formreach_publish_email, #formreach_publish_messages"
    );

    formreach_boutonsDeSoumission.forEach((formreach_bouton) => {
      formreach_bouton.addEventListener("click", () => {
        formreach_modificationsEnregistrees = true;
        document.getElementById("publish").click();
      });
    });
  });
}

(function ($) {
  // Mise en cache des sélecteurs pour une meilleure performance
  var formreach_h2 = $("h2");
  var formreach_metaboxwpadmin = $("#formreach_metabox");

  // Gestion des événements de survol
  formreach_h2.hover(function () {
    $(this).removeClass();
  });

  // Gestion des clics
  formreach_metaboxwpadmin.on("click", function () {
    $(this).attr("class", "postbox"); // Cette ligne remplace toutes les classes par 'postbox'
  });

  // Fonction de configuration de la metabox, appelée initialement et sur le rechargement de la page
  function formreach_setupMetabox() {
    formreach_metaboxwpadmin.attr("class", "postbox");
    // Supprimer une classe spécifique sur formreach_h2 si nécessaire, sinon commenter
    formreach_h2.removeClass("hndle");
  }
  formreach_setupMetabox();

  // Vérification du rechargement de la page avec la Performance API
  if (performance.getEntriesByType("navigation")[0].type === "reload") {
    formreach_setupMetabox();
  }
})(jQuery);

// Adds animation to whatsapp tab when the tel is missing
document.addEventListener("DOMContentLoaded", function () {
  var formreach_inputWhatsapp = document.getElementById(
    "formreach_whatsapp_tel"
  );
  var formreach_element = document.getElementById("formreach_profile-tab");

  function formreach_updateElementClass() {
    if (formreach_inputWhatsapp && formreach_inputWhatsapp.value) {
      formreach_element.classList.remove("formreach_missing-information");
    } else {
      formreach_element.classList.add("formreach_missing-information");
    }
  }

  if (formreach_inputWhatsapp) {
    // Initialise on load
    formreach_updateElementClass();

    // Update on input change
    formreach_inputWhatsapp.addEventListener(
      "input",
      formreach_updateElementClass
    );
  }
});

function formreach_updateUIBasedOnEmailValidation(
  formreach_inputEmail,
  formreach_element
) {
  var formreach_isValidEmails = formreach_validateEmails(
    formreach_inputEmail.value
  );
  if (formreach_inputEmail.value === "" || !formreach_isValidEmails) {
    formreach_element.classList.add("formreach_missing-information");
    formreach_inputEmail.style.border = "2px solid red";
  } else {
    formreach_element.classList.remove("formreach_missing-information");
    formreach_inputEmail.style.border = "";
  }
}

document.addEventListener("DOMContentLoaded", function () {
  var formreach_inputEmail = document.getElementById(
    "formreach_email_admin_to"
  );
  var formreach_element = document.getElementById("formreach_profile-tab");

  if (formreach_inputEmail && formreach_element) {
    formreach_updateUIBasedOnEmailValidation(
      formreach_inputEmail,
      formreach_element
    ); // Initial validation on load

    formreach_inputEmail.addEventListener("input", () =>
      formreach_updateUIBasedOnEmailValidation(
        formreach_inputEmail,
        formreach_element
      )
    );
  }
});

// EMAIL Submit Button Update
document.addEventListener("DOMContentLoaded", function () {
  // Function to update color input based on text input
  function formreach_updateColorInput(
    formreach_textInput,
    formreach_colorInput
  ) {
    if (formreach_textInput && formreach_colorInput) {
      var formreach_colorValue = formreach_textInput.value.trim();
      if (
        formreach_colorValue.length <= 7 &&
        /^#([0-9A-F]{3}){1,2}$/i.test(formreach_colorValue)
      ) {
        formreach_colorInput.value = formreach_colorValue;
      }
    }
  }

  // Function to update text input based on color input
  function formreach_updateTextInput(
    formreach_colorInput,
    formreach_textInput
  ) {
    if (formreach_textInput && formreach_colorInput) {
      formreach_textInput.value = formreach_colorInput.value;
    }
  }

  // Update email text color inputs
  var formreach_colorPickerInputEmailText = document.getElementById(
    "formreach_email_text_color"
  );
  var formreach_colorTextInputEmailText = document.getElementById(
    "formreach_color_text_code_email"
  );
  formreach_updateColorInput(
    formreach_colorTextInputEmailText,
    formreach_colorPickerInputEmailText
  );
  formreach_updateTextInput(
    formreach_colorPickerInputEmailText,
    formreach_colorTextInputEmailText
  );

  // Listen for change events on email text color inputs
  if (formreach_colorPickerInputEmailText) {
    formreach_colorPickerInputEmailText.addEventListener("input", function () {
      formreach_updateTextInput(
        formreach_colorPickerInputEmailText,
        formreach_colorTextInputEmailText
      );
    });
  }

  if (formreach_colorTextInputEmailText) {
    formreach_colorTextInputEmailText.addEventListener("input", function () {
      formreach_updateColorInput(
        formreach_colorTextInputEmailText,
        formreach_colorPickerInputEmailText
      );
    });
  }

  // Update email button color inputs
  var formreach_colorPickerInputEmail = document.getElementById(
    "formreach_email_submit_color"
  );
  var formreach_colorTextInputEmail = document.getElementById(
    "formreach_color_code_email"
  );
  formreach_updateColorInput(
    formreach_colorTextInputEmail,
    formreach_colorPickerInputEmail
  );
  formreach_updateTextInput(
    formreach_colorPickerInputEmail,
    formreach_colorTextInputEmail
  );

  // Listen for change events on email button color inputs
  if (formreach_colorPickerInputEmail) {
    formreach_colorPickerInputEmail.addEventListener("input", function () {
      formreach_updateTextInput(
        formreach_colorPickerInputEmail,
        formreach_colorTextInputEmail
      );
    });
  }

  if (formreach_colorTextInputEmail) {
    formreach_colorTextInputEmail.addEventListener("input", function () {
      formreach_updateColorInput(
        formreach_colorTextInputEmail,
        formreach_colorPickerInputEmail
      );
    });
  }
});

// WhatsApp Submit Button Update
document.addEventListener("DOMContentLoaded", function () {
  // Function to update color input based on text input
  function formreach_updateColorInput(
    formreach_textInput,
    formreach_colorInput
  ) {
    if (formreach_textInput && formreach_colorInput) {
      var formreach_colorValue = formreach_textInput.value.trim();
      if (
        formreach_colorValue.length <= 7 &&
        /^#([0-9A-F]{3}){1,2}$/i.test(formreach_colorValue)
      ) {
        formreach_colorInput.value = formreach_colorValue;
      }
    }
  }

  // Function to update text input based on color input
  function formreach_updateTextInput(
    formreach_colorInput,
    formreach_textInput
  ) {
    if (formreach_textInput && formreach_colorInput) {
      formreach_textInput.value = formreach_colorInput.value;
    }
  }

  // Update WhatsApp text color inputs
  var formreach_colorPickerInputWhatsappText = document.getElementById(
    "formreach_whatsapp_text_color"
  );
  var formreach_colorTextInputWhatsappText = document.getElementById(
    "formreach_color_text_code_whatsapp"
  );
  formreach_updateColorInput(
    formreach_colorTextInputWhatsappText,
    formreach_colorPickerInputWhatsappText
  );
  formreach_updateTextInput(
    formreach_colorPickerInputWhatsappText,
    formreach_colorTextInputWhatsappText
  );

  // Listen for change events on WhatsApp text color inputs
  if (formreach_colorPickerInputWhatsappText) {
    formreach_colorPickerInputWhatsappText.addEventListener(
      "input",
      function () {
        formreach_updateTextInput(
          formreach_colorPickerInputWhatsappText,
          formreach_colorTextInputWhatsappText
        );
      }
    );
  }

  if (formreach_colorTextInputWhatsappText) {
    formreach_colorTextInputWhatsappText.addEventListener("input", function () {
      formreach_updateColorInput(
        formreach_colorTextInputWhatsappText,
        formreach_colorPickerInputWhatsappText
      );
    });
  }

  // Update WhatsApp button color inputs
  var formreach_colorPickerInputWhatsapp = document.getElementById(
    "formreach_whatsapp_submit_color"
  );
  var formreach_colorTextInputWhatsapp = document.getElementById(
    "formreach_color_code_whatsapp"
  );
  formreach_updateColorInput(
    formreach_colorTextInputWhatsapp,
    formreach_colorPickerInputWhatsapp
  );
  formreach_updateTextInput(
    formreach_colorPickerInputWhatsapp,
    formreach_colorTextInputWhatsapp
  );

  // Listen for change events on WhatsApp button color inputs
  if (formreach_colorPickerInputWhatsapp) {
    formreach_colorPickerInputWhatsapp.addEventListener("input", function () {
      formreach_updateTextInput(
        formreach_colorPickerInputWhatsapp,
        formreach_colorTextInputWhatsapp
      );
    });
  }

  if (formreach_colorTextInputWhatsapp) {
    formreach_colorTextInputWhatsapp.addEventListener("input", function () {
      updateColorInput(
        formreach_colorTextInputWhatsapp,
        formreach_colorPickerInputWhatsapp
      );
    });
  }
});

// Preview EMAIL Submit Button Update
document.addEventListener("DOMContentLoaded", () => {
  const formreach_updateButton = () => {
    const formreach_button = document.getElementById(
      "formreach_email_submit_result"
    );
    const formreach_buttonText = document.getElementById(
      "formreach_email_submit_text_result"
    );
    const formreach_buttonTextColorInput = document.getElementById(
      "formreach_email_text_color"
    );
    const formreach_buttonColorInput = document.getElementById(
      "formreach_email_submit_color"
    );
    const formreach_buttonTextInput = document.getElementById(
      "formreach_email_submit"
    );
    const formreach_buttonIconColor = document.getElementById(
      "formreach_icon_email"
    );
    const formreach_colorTextInputEmail = document.getElementById(
      "formreach_color_code_email"
    );
    const formreach_colorTextInputEmailText = document.getElementById(
      "formreach_color_text_code_email"
    );

    if (
      formreach_button &&
      formreach_buttonColorInput &&
      formreach_buttonTextInput &&
      formreach_buttonText &&
      formreach_buttonTextColorInput &&
      formreach_buttonIconColor &&
      formreach_colorTextInputEmail &&
      formreach_colorTextInputEmailText
    ) {
      formreach_button.style.backgroundColor =
        formreach_buttonColorInput.value ||
        formreach_colorTextInputEmail.value ||
        formreach_colorTextInputEmailText.value;
      formreach_buttonText.textContent = formreach_buttonTextInput.value;
      formreach_buttonText.style.color =
        formreach_buttonTextColorInput.value ||
        formreach_colorTextInputEmailText.value;
      formreach_buttonIconColor.style.fill =
        formreach_buttonTextColorInput.value ||
        formreach_colorTextInputEmailText.value;
    }
  };

  const formreach_inputs = [
    "#formreach_email_submit_color",
    "#formreach_email_submit",
    "#formreach_email_text_color",
    "#formreach_color_text_code_email",
    "#formreach_color_code_email",
  ];
  formreach_inputs.forEach((formreach_input) => {
    const formreach_element = document.querySelector(formreach_input);
    if (formreach_element) {
      formreach_element.addEventListener("input", formreach_updateButton);
    }
  });

  formreach_updateButton();

  // Preview WHATSAPP Submit Button Update
  const formreach_updateButtonWhatsapp = () => {
    const formreach_button = document.getElementById(
      "formreach_whatsapp_submit_result"
    );
    const formreach_buttonText = document.getElementById(
      "formreach_whatsapp_submit_text_result"
    );
    const formreach_buttonTextColorInput = document.getElementById(
      "formreach_whatsapp_text_color"
    );
    const formreach_buttonColorInput = document.getElementById(
      "formreach_whatsapp_submit_color"
    );
    const formreach_buttonTextInput = document.getElementById(
      "formreach_whatsapp_submit"
    );
    const formreach_buttonIconColor = document.getElementById(
      "formreach_icon_whatsapp"
    );
    const formreach_colorTextInputWhatsApp = document.getElementById(
      "formreach_color_code_whatsapp"
    );
    const formreach_colorTextInputWhatsAppText = document.getElementById(
      "formreach_color_text_code_whatsapp"
    );

    if (
      formreach_button &&
      formreach_buttonColorInput &&
      formreach_buttonTextInput &&
      formreach_buttonText &&
      formreach_buttonTextColorInput &&
      formreach_buttonIconColor &&
      formreach_colorTextInputWhatsApp &&
      formreach_colorTextInputWhatsAppText
    ) {
      formreach_button.style.backgroundColor =
        formreach_buttonColorInput.value ||
        formreach_colorTextInputWhatsApp.value ||
        formreach_colorTextInputWhatsAppText.value;
      formreach_buttonText.textContent = formreach_buttonTextInput.value;
      formreach_buttonText.style.color =
        formreach_buttonTextColorInput.value ||
        formreach_colorTextInputWhatsAppText.value;
      formreach_buttonIconColor.style.fill =
        formreach_buttonTextColorInput.value ||
        formreach_colorTextInputWhatsAppText.value;
    }
  };

  const formreach_inputsWhatsapp = [
    "#formreach_whatsapp_submit_color",
    "#formreach_whatsapp_submit",
    "#formreach_whatsapp_text_color",
    "#formreach_color_text_code_whatsapp",
    "#formreach_color_code_whatsapp",
  ];
  formreach_inputsWhatsapp.forEach((formreach_input) => {
    const formreach_element = document.querySelector(formreach_input);
    if (formreach_element) {
      formreach_element.addEventListener(
        "input",
        formreach_updateButtonWhatsapp
      );
    }
  });

  formreach_updateButtonWhatsapp();
});

// Autoresponder
document.addEventListener("DOMContentLoaded", function () {
  const formreach_checkbox = document.getElementById(
    "formreach_user_email_switch"
  );
  const formreach_maDiv = document.getElementById("formreach_user_email");

  function formreach_toggleDivDisplay() {
    if (formreach_maDiv) {
      formreach_maDiv.style.display = formreach_checkbox.checked
        ? "block"
        : "none";
    }
  }

  // Appeler la fonction pour initialiser l'état de la div en fonction de la case cochée
  formreach_toggleDivDisplay();

  // Ajouter un écouteur d'événement pour mettre à jour l'état de la div lorsque la case est cochée/décochée
  if (formreach_checkbox) {
    formreach_checkbox.addEventListener("input", formreach_toggleDivDisplay);
  }
});

import intlTelInput from "intl-tel-input";

document.addEventListener("DOMContentLoaded", function () {
  var formreach_whatsapp_tel = document.querySelector(
    "#formreach_whatsapp_tel"
  );
  if (formreach_whatsapp_tel) {
    var formreach_hiddenInput = document.querySelector(
      "#formreach_whatsapp_tel_international"
    );
    var formreach_whatsapp_message = document.querySelector(
      "#formreach_whatsapp_message"
    );

    // Initialise intl-tel-input
    var iti = intlTelInput(formreach_whatsapp_tel, {
      initialCountry: "auto",
      geoIpLookup: function (success, failure) {
        fetch("https://ipinfo.io/json")
          .then(function (resp) {
            return resp.json();
          })
          .then(function (resp) {
            var countryCode = resp && resp.country ? resp.country : "us";
            success(countryCode);
          })
          .catch(function () {
            success("us");
          });
      },
      separateDialCode: true,
      loadUtils: () => import("intl-tel-input/utils"),
      countryOrder: ["us", "fr", "de", "gb", "it"],
    });

    var reset = function () {
      formreach_whatsapp_tel.classList.remove("is-invalid");
      formreach_whatsapp_message.innerHTML = "";
      formreach_whatsapp_message.classList.add("d-none");
    };

    // Valide le numéro
    var validate = function () {
      reset();
      if (formreach_whatsapp_tel.value.trim()) {
        if (iti.isValidNumber()) {
          formreach_whatsapp_tel.classList.add("is-valid");
        } else {
          formreach_whatsapp_tel.classList.add("is-invalid");
          var errorCode = iti.getValidationError();
          formreach_whatsapp_message.innerHTML =
            "Invalid Number : " + formreach_errorMap[errorCode];
          formreach_whatsapp_message.classList.remove("d-none");
        }
      }
    };

    // Message d'erreur
    var formreach_errorMap = [
      "Invalid Number",
      "Invalid Country Code",
      "Too short",
      "Too long",
      "Invalid Number",
    ];

    // Événements
    formreach_whatsapp_tel.addEventListener("blur", validate);
    formreach_whatsapp_tel.addEventListener("change", reset);
    formreach_whatsapp_tel.addEventListener("keyup", validate);

    // Avant la soumission du formulaire
    var form = formreach_whatsapp_tel.form;
    form.addEventListener("submit", function (event) {
      validate();
      if (iti.isValidNumber()) {
        formreach_hiddenInput.value = iti.getNumber();
      } else {
        event.preventDefault();
      }
    });
  }
});

//missing email
function formreach_validateEmails(emails) {
  const formreach_emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emails
    .split(",")
    .every((email) => formreach_emailPattern.test(email.trim()));
}

document.addEventListener("DOMContentLoaded", function () {
  const formreach_input = document.getElementById("formreach_email_admin_to");
  const formreach_noticeId = "notification";
  let formreach_notice = document.getElementById(formreach_noticeId);

  if (formreach_input && !formreach_validateEmails(formreach_input.value)) {
    if (!formreach_notice) {
      formreach_notice = document.createElement("div");
      formreach_notice.id = formreach_noticeId;
      formreach_notice.className = "notice notice-error";
      formreach_notice.innerHTML =
        "<p>Please enter a valid email address in the 'Email' tab.</p>";
      document.body.insertBefore(formreach_notice, document.body.firstChild);
      formreach_input.placeholder = "You must enter a valid email address";
      formreach_input.classList.add("formreach_placeholder-error");
    }
  } else if (formreach_notice) {
    formreach_notice.remove();
    formreach_input.placeholder = "";
    formreach_input.classList.remove("formreach_placeholder-error");
  }
});

import { Tab } from "bootstrap";

// tabs memorizer
document.addEventListener("DOMContentLoaded", () => {
    const formreach_tabKey = "activeTab";
    const formreach_defaultTabSelector = '[data-bs-target="#formreach_formulaire"]';
    const formreach_sectionFOUC = document.getElementById('formreach_section_metabox');

    if (formreach_sectionFOUC) formreach_sectionFOUC.style.visibility = "visible";

    const formreach_getPostIdFromUrl = () =>
        new URLSearchParams(window.location.search).get('post');

    const formreach_currentPostId = formreach_getPostIdFromUrl();
    const formreach_storedPostId = localStorage.getItem('formreach_currentPostId');

    if (formreach_storedPostId !== formreach_currentPostId) {
        localStorage.removeItem(formreach_tabKey);
    }
    if (formreach_currentPostId) {
        localStorage.setItem('formreach_currentPostId', formreach_currentPostId);
    }

    const formreach_activeTab = localStorage.getItem(formreach_tabKey);
    const formreach_tabToActivate = document.querySelector(
        formreach_activeTab ? `[data-bs-target="${formreach_activeTab}"]` : formreach_defaultTabSelector
    );

    if (formreach_tabToActivate) {
        new bootstrap.Tab(formreach_tabToActivate).show();
    }

    document.querySelectorAll('[data-bs-toggle="tab"]').forEach(formreach_tab => {
        formreach_tab.addEventListener("shown.bs.tab", (event) =>
            localStorage.setItem(formreach_tabKey, event.target.getAttribute("data-bs-target"))
        );
    });
});
