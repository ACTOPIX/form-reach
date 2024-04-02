(function($) {
    // Refactorisé pour utiliser jQuery dans le scope local
    window.modalTextGenerator = function() {
        var fr_type = ' type="text"',
            fr_required = $('#fr_generator-text-required').is(':checked') ? ' required="required"' : '',
            fr_label = $('#fr_generator-text-label').val() ? ' label="' + $('#fr_generator-text-label').val() + '"' : '',
            fr_name = $('#fr_generator-text-name').val() ? ' name="' + $('#fr_generator-text-name').val() + '"' : '',
            fr_class = $('#fr_generator-text-class').val() ? ' class="' + $('#fr_generator-text-class').val() + '"' : '',
            fr_id = $('#fr_generator-text-id').val() ? ' id="' + $('#fr_generator-text-id').val() + '"' : '',
            fr_value = $('#fr_generator-text-value').val() ? ' value="' + $('#fr_generator-text-value').val() + '"' : '',
            fr_placeholder = '';

        if ($('#fr_generator-text-placeholder').is(':checked')) {
            fr_placeholder = ' placeholder="' + $('#fr_generator-text-value').val() + '"';
            fr_value = ''; // Effacer la valeur si placeholder est coché
        }

        $('#fr_generatedTextShortcode').val('[input' + fr_type + fr_label + fr_name + fr_value + fr_id + fr_class + fr_required + fr_placeholder + ']');
    };
})(jQuery);

(function($) {
    window.modalEmailGenerator = function() {
        var fr_type = ' type="email"',
            fr_required = $('#fr_generator-email-required').is(':checked') ? ' required="required"' : '',
            fr_label = $('#fr_generator-email-label').val() ? ' label="' + $('#fr_generator-email-label').val() + '"' : '',
            fr_name = $('#fr_generator-email-name').val() ? ' name="' + $('#fr_generator-email-name').val() + '"' : '',
            fr_class = $('#fr_generator-email-class').val() ? ' class="' + $('#fr_generator-email-class').val() + '"' : '',
            fr_id = $('#fr_generator-email-id').val() ? ' id="' + $('#fr_generator-email-id').val() + '"' : '',
            fr_value = $('#fr_generator-email-value').val() ? ' value="' + $('#fr_generator-email-value').val() + '"' : '',
            fr_placeholder = '';

        if ($('#fr_generator-email-placeholder').is(':checked')) {
            fr_placeholder = ' placeholder="' + $('#fr_generator-email-value').val() + '"';
            fr_value = ''; // Reset value if placeholder is used
        }

        $('#fr_generatedEmailShortcode').val('[input' + fr_type + fr_label + fr_name + fr_value + fr_id + fr_class + fr_required + fr_placeholder + ']');
    };
})(jQuery);

(function($) {
    window.modalTelGenerator = function() {
        const fr_type = ' type="tel"',
            fr_required = $('#fr_generator-tel-required').is(':checked') ? ' required="required"' : '',
            fr_label = $('#fr_generator-tel-label').val() ? ` label="${$('#fr_generator-tel-label').val()}"` : '',
            fr_name = $('#fr_generator-tel-name').val() ? ` name="${$('#fr_generator-tel-name').val()}"` : '',
            fr_class = $('#fr_generator-tel-class').val() ? ` class="${$('#fr_generator-tel-class').val()}"` : '',
            fr_id = $('#fr_generator-tel-id').val() ? ` id="${$('#fr_generator-tel-id').val()}"` : '',
            fr_value = $('#fr_generator-tel-value').val() ? ` value="${$('#fr_generator-tel-value').val()}"` : '',
            fr_placeholder = $('#fr_generator-tel-placeholder').is(':checked') ? ` placeholder="${$('#fr_generator-tel-value').val()}"` : '';

        // Reset value if placeholder is used
        const final_value = fr_placeholder ? '' : fr_value;

        $('#fr_generatedTelShortcode').val(`[input${fr_type}${fr_label}${fr_name}${final_value}${fr_id}${fr_class}${fr_required}${fr_placeholder}]`);
    };
})(jQuery);

(function($) {
    window.modalTextareaGenerator = function() {
        var fr_type = ' type="textarea"',
            fr_required = $('#fr_generator-textarea-required').is(':checked') ? ' required="required"' : '',
            fr_label = $('#fr_generator-textarea-label').val() ? ' label="' + $('#fr_generator-textarea-label').val() + '"' : '',
            fr_cols = $('#fr_generator-textarea-cols').val() ? ' cols="' + $('#fr_generator-textarea-cols').val() + '"' : '',
            fr_rows = $('#fr_generator-textarea-rows').val() ? ' rows="' + $('#fr_generator-textarea-rows').val() + '"' : '',
            fr_name = $('#fr_generator-textarea-name').val() ? ' name="' + $('#fr_generator-textarea-name').val() + '"' : '',
            fr_class = $('#fr_generator-textarea-class').val() ? ' class="' + $('#fr_generator-textarea-class').val() + '"' : '',
            fr_id = $('#fr_generator-textarea-id').val() ? ' id="' + $('#fr_generator-textarea-id').val() + '"' : '',
            fr_value = $('#fr_generator-textarea-value').val() ? ' value="' + $('#fr_generator-textarea-value').val() + '"' : '',
            fr_placeholder = $('#fr_generator-textarea-placeholder').is(':checked') ? ' placeholder="' + $('#fr_generator-textarea-value').val() + '"' : '';

        // Reset value if placeholder is checked
        if ($('#fr_generator-textarea-placeholder').is(':checked')) {
            fr_value = '';
        }

        $('#fr_generatedTextareaShortcode').val('[input' + fr_type + fr_rows + fr_cols + fr_label + fr_name + fr_value + fr_id + fr_class + fr_required + fr_placeholder + ']');
    };
})(jQuery);

(function($) {
	document.addEventListener("DOMContentLoaded", function() {
		// Fonction pour vérifier et ajouter des attributs
		function checkAndAddAttributes(type) {
			const inputName = document.getElementById(`fr_generator-${type}-name`);
			const requiredName = document.getElementById(`requiredName${capitalizeFirstLetter(type)}`);
			const modalId = `fr_modal_${type}`;

			if (inputName && inputName.value !== "") {
				inputName.style.border = "solid 1px black";
				if (requiredName) requiredName.setAttribute("hidden", true);
				$(`#${modalId}`).modal('hide'); // Fermeture du modal Bootstrap
				transfertField(type); // Appel de la fonction de transfert
			} else if (inputName) {
				inputName.style.border = "solid 2px red";
				if (requiredName) requiredName.removeAttribute("hidden");
			}
		}

		// Fonction pour transférer le contenu du champ
		function transfertField(type) {
			const formContent = document.getElementById("fr_contenu_formulaire");
			const generatedShortcode = document.getElementById(`fr_generated${capitalizeFirstLetter(type)}Shortcode`);

			if (formContent && generatedShortcode) {
				formContent.value += "\n" + generatedShortcode.value + "\n";
				clearFormFields(type); // Réinitialisation des champs
			}
		}

		// Fonction pour réinitialiser les champs du formulaire
		function clearFormFields(type) {
			const fields = ["required", "placeholder", "label", "name", "class", "id", "value"];
			fields.forEach(field => {
				const element = document.getElementById(`fr_generator-${type}-${field}`);
				if (element) {
					if (element.type === "checkbox") {
						element.checked = false;
					} else {
						element.value = "";
					}
				}
			});
			const generatedShortcode = document.getElementById(`fr_generated${capitalizeFirstLetter(type)}Shortcode`);
			if (generatedShortcode) generatedShortcode.value = `[input type="${type}"]`;
		}

		// Fonction pour capitaliser la première lettre d'une chaîne
		function capitalizeFirstLetter(string) {
			return string.charAt(0).toUpperCase() + string.slice(1);
		}

		// Ajout d'écouteurs d'événements pour les boutons de soumission
		const types = ["text", "email", "textarea", "tel"];
		types.forEach(type => {
			const submitButton = document.getElementById(`fr_submit_${type}`);
			if (submitButton) {
				submitButton.addEventListener("click", function() {
					checkAndAddAttributes(type);
				});
			}
		});
	});
})(jQuery);

// Sets default values for the Mail form based on predefined values
function buttonDefaultMail() {
    // Retrieve default values defined in hidden inputs or other elements
    var defaultValues = {
        defaultMail: document.getElementsByName("contenuFormulaireMail")[0].value,
        defaultEmailSubmitText: document.getElementsByName("defaultEmailSubmitText")[0].value,
        defaultEmailSubmitTextColor: document.getElementsByName("defaultEmailSubmitTextColor")[0].value,
        defaultEmailSubmitColor: document.getElementsByName("defaultEmailSubmitColor")[0].value
    };

    // Apply these default values to the relevant form fields
    document.getElementById('fr_contenu_formulaire').value = defaultValues.defaultMail;
    document.getElementById('fr_email_submit').value = defaultValues.defaultEmailSubmitText;
    document.getElementById('fr_email_text_color').value = defaultValues.defaultEmailSubmitTextColor;
    document.getElementById('fr_email_submit_color').value = defaultValues.defaultEmailSubmitColor;
    document.getElementById('fr_color_text_code_email').value = defaultValues.defaultEmailSubmitTextColor;
    document.getElementById('fr_color_code_email').value = defaultValues.defaultEmailSubmitColor;
}

function buttonDefaultWhatsapp() {
	var defaultWhatsapp = document.getElementsByName("contenuFormulaireWhatsapp")[0].value;

	var defaultWhatsappSubmitText = document.getElementsByName("defaultWhatsappSubmitText")[0].value;
	var defaultWhatsappSubmitTextColor = document.getElementsByName("defaultWhatsappSubmitTextColor")[0].value;
	var defaultWhatsappSubmitColor = document.getElementsByName("defaultWhatsappSubmitColor")[0].value;

	document.getElementById('fr_contenu_formulaire').value = defaultWhatsapp;

	document.getElementById('fr_whatsapp_submit').value = defaultWhatsappSubmitText;
	document.getElementById('fr_whatsapp_text_color').value = defaultWhatsappSubmitTextColor;
	document.getElementById('fr_whatsapp_submit_color').value = defaultWhatsappSubmitColor;
	document.getElementById('fr_color_text_code_whatsapp').value = defaultWhatsappSubmitTextColor;
	document.getElementById('fr_color_code_whatsapp').value = defaultWhatsappSubmitColor;

}

// Default values for the email messages
function buttonDefaultEmailMessages() {
	var defaultEmailSuccess = document.getElementsByName("buttonDefaultEmailSuccess")[0].value;
	var defaultEmailError = document.getElementsByName("buttonDefaultEmailError")[0].value;
	
	document.getElementById('fr_email_success').value = defaultEmailSuccess;
	document.getElementById('fr_email_error').value = defaultEmailError;
}

// Default values for the whatsapp messages
function buttonDefaultWhatsappMessages() {
	var defaultWhatsappSuccess = document.getElementsByName("buttonDefaultWhatsappSuccess")[0].value;
	var defaultWhatsappError = document.getElementsByName("buttonDefaultWhatsappError")[0].value;

	document.getElementById('fr_whatsapp_success').value = defaultWhatsappSuccess;
	document.getElementById('fr_whatsapp_error').value = defaultWhatsappError;
}

// Default values for the email sending
function buttonDefaultEmailSending() {
	var defaultEmailAdminTo = document.getElementsByName("defaultEmailAdminTo")[0].value;
	var defaultEmailAdminFrom = document.getElementsByName("defaultEmailAdminFrom")[0].value;
	var defaultEmailAdminSubject = document.getElementsByName("defaultEmailAdminSubject")[0].value;
	var defaultEmailAdminContent = document.getElementsByName("defaultEmailAdminContent")[0].value;

	var defaultEmailUserTo = document.getElementsByName("defaultEmailUserTo")[0].value;
	var defaultEmailUserFrom = document.getElementsByName("defaultEmailUserFrom")[0].value;
	var defaultEmailUserSubject = document.getElementsByName("defaultEmailUserSubject")[0].value;
	var defaultEmailUserContent = document.getElementsByName("defaultEmailUserContent")[0].value;

	
	document.getElementById('fr_email_admin_to').value = defaultEmailAdminTo;
	document.getElementById('fr_email_admin_from').value = defaultEmailAdminFrom;
	document.getElementById('fr_email_admin_subject').value = defaultEmailAdminSubject;
	document.getElementById('fr_email_admin_content').value = defaultEmailAdminContent;

	document.getElementById('fr_email_user_to').value = defaultEmailUserTo;
	document.getElementById('fr_email_user_from').value = defaultEmailUserFrom;
	document.getElementById('fr_email_user_subject').value = defaultEmailUserSubject;
	document.getElementById('fr_email_user_content').value = defaultEmailUserContent;
}

// Sélectionnez le formulaire à surveiller
const formulaire = document.getElementById("post");

if (formulaire) {
    let modificationsEnregistrees = true; // Inverser la logique pour simplifier

    // Détecte les modifications dans le formulaire
	formulaire.addEventListener('input', (e) => {
		// Vérifie si l'élément déclencheur est différent de l'input à exclure
		if (e.target.id !== "fr_whatsapp_switch") {
			modificationsEnregistrees = false;
		}
	});


    // Gestionnaire d'événement 'beforeunload' pour avertir des modifications non enregistrées
    window.addEventListener('beforeunload', (e) => {
        if (!modificationsEnregistrees) {
            e.preventDefault();
            e.returnValue = ''; // Chrome requiert cette propriété pour afficher l'alerte
        }
    });

    // Gestionnaire de clics pour les boutons de soumission pour éviter les répétitions
    document.addEventListener('DOMContentLoaded', () => {
        const boutonsDeSoumission = document.querySelectorAll('#fr_whatsapp_switch, #fr_save_messages, #fr_saveFormWhatsapp, #fr_save_email, #fr_save_final, #fr_publish_final');

        boutonsDeSoumission.forEach(bouton => {
            bouton.addEventListener('click', () => {
                modificationsEnregistrees = true;
                document.getElementById("publish").click();
            });
        });
    });
}

(function($) {
// Mise en cache des sélecteurs pour une meilleure performance
var $h2 = $('h2');
var $metaboxwpadmin = $('#metaboxwpadmin');

// Gestion des événements de survol
$h2.hover(
	function() {
		$(this).removeClass();
	}
);

// Gestion des clics
$metaboxwpadmin.on('click', function() {
	$(this).attr('class', 'postbox'); // Cette ligne remplace toutes les classes par 'postbox'
});

// Fonction de configuration de la metabox, appelée initialement et sur le rechargement de la page
function setupMetabox() {
	$metaboxwpadmin.attr('class', 'postbox');
	// Supprimer une classe spécifique sur $h2 si nécessaire, sinon commenter
	$h2.removeClass('hndle');
}
setupMetabox();

// Vérification du rechargement de la page avec la Performance API
if (performance.getEntriesByType("navigation")[0].type === "reload") {
	setupMetabox();
}
})(jQuery);

// Adds animation to whatsapp tab when the tel is missing
document.addEventListener('DOMContentLoaded', function() {
    var inputWhatsapp = document.getElementById('fr_whatsapp_tel');
    var element = document.getElementById('fr_profile-tab');

    function updateElementClass() {
        if (inputWhatsapp && inputWhatsapp.value) {
            element.classList.remove('missing-information');
        } else {
            element.classList.add('missing-information');
        }
    }

    if (inputWhatsapp) {
        // Initialise on load
        updateElementClass();

        // Update on input change
        inputWhatsapp.addEventListener('input', updateElementClass);
    }
});

//Adds animation to email tab when the email is missing
function validateEmails(emails) {
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emails.split(",").every(email => emailPattern.test(email.trim()));
}

function updateUIBasedOnEmailValidation(inputEmail, element) {
    var isValidEmails = validateEmails(inputEmail.value);
    if (inputEmail.value === '' || !isValidEmails) {
        element.classList.add('missing-information');
        inputEmail.style.border = '2px solid red';
    } else {
        element.classList.remove('missing-information');
        inputEmail.style.border = '1px solid grey';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    var inputEmail = document.getElementById('fr_email_admin_to');
    var element = document.getElementById('fr_profile-tab');

    if (inputEmail && element) {
        updateUIBasedOnEmailValidation(inputEmail, element); // Initial validation on load

        inputEmail.addEventListener('input', () => updateUIBasedOnEmailValidation(inputEmail, element));
    }
});
