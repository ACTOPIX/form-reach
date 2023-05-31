function modalTextGenerator(){

	var wpaf_type = ' type="text"';

//Required checkboxe 1 generator
	if (document.getElementById("wpaf_generator-text-required").checked){
		var wpaf_required = ' required="required"';				
	} else {
		var wpaf_required = '';
	};


//Label shortcode generator
	if(document.getElementById("wpaf_generator-text-label").value.length>0){

		var wpaf_label = ' label="'+document.getElementById("wpaf_generator-text-label").value+'"';
	}else{

		var wpaf_label =	'';
	};

//Name shortcode generator
	if(document.getElementById("wpaf_generator-text-name").value.length>0){

		var wpaf_name = ' name="'+document.getElementById("wpaf_generator-text-name").value+'"';
	}else{

		var wpaf_name =	'';
	};

//Class shortcode generator
	if(document.getElementById("wpaf_generator-text-class").value.length>0){

		var wpaf_class = ' class="'+document.getElementById("wpaf_generator-text-class").value+'"';
	}else{

		var wpaf_class = '';
	};

//Id shortcode generator
	if(document.getElementById("wpaf_generator-text-id").value.length>0){

		var wpaf_id = ' id="'+document.getElementById("wpaf_generator-text-id").value+'"';
	}else{

		var wpaf_id = '';
	};

//Valeur shortcode generator
	if(document.getElementById("wpaf_generator-text-value").value.length>0){

		var wpaf_value = ' value="'+document.getElementById("wpaf_generator-text-value").value+'"';
		document.getElementById("wpaf_generator-text-placeholder").disabled=false;
	}else{

		var wpaf_value = '';
		document.getElementById("wpaf_generator-text-placeholder").disabled=true;
	};
	

//Placeholder checkboxe 2 generator
	if (document.getElementById("wpaf_generator-text-placeholder").checked){
		var wpaf_placeholder = ' placeholder="'+document.getElementById("wpaf_generator-text-value").value+'"';
		var wpaf_value = '';

	} else {
		var wpaf_placeholder = '';
	};

$("#wpaf_generatedTextShortcode").val('[input' + wpaf_type + wpaf_label + wpaf_name + wpaf_value + wpaf_id + wpaf_class + wpaf_required + wpaf_placeholder +']');
};



function modalEmailGenerator(){

	var wpaf_type = ' type="email"';

//Required checkboxe 1 generator

	if (document.getElementById("wpaf_generator-email-required").checked){
		var wpaf_required = ' required="required"';				
	} else {
		var wpaf_required = '';
	};


//Label shortcode generator
	if(document.getElementById("wpaf_generator-email-label").value.length>0){

		var wpaf_label = ' label="'+document.getElementById("wpaf_generator-email-label").value+'"';
	}else{
		
		var wpaf_label =	'';
	};

//Name shortcode generator
	if(document.getElementById("wpaf_generator-email-name").value.length>0){

		var wpaf_name = ' name="'+document.getElementById("wpaf_generator-email-name").value+'"';
	}else{

		var wpaf_name =	'';
	};

//Class shortcode generator
	if(document.getElementById("wpaf_generator-email-class").value.length>0){

		var wpaf_class = ' class="'+document.getElementById("wpaf_generator-email-class").value+'"';
	}else{

		var wpaf_class = '';
	};

//Id shortcode generator
	if(document.getElementById("wpaf_generator-email-id").value.length>0){

		var wpaf_id = ' id="'+document.getElementById("wpaf_generator-email-id").value+'"';
	}else{

		var wpaf_id = '';
	};

//Valeur shortcode generator
	if(document.getElementById("wpaf_generator-email-value").value.length>0){

		var wpaf_value = ' value="'+document.getElementById("wpaf_generator-email-value").value+'"';
		document.getElementById("wpaf_generator-email-placeholder").disabled=false;
	}else{

		var wpaf_value = '';
		document.getElementById("wpaf_generator-email-placeholder").disabled=true;
	};

//Placeholder checkboxe 2 generator
	if (document.getElementById("wpaf_generator-email-placeholder").checked){
		var wpaf_placeholder = ' placeholder="'+document.getElementById("wpaf_generator-email-value").value+'"';
		var wpaf_value = '';

	} else {
		var wpaf_placeholder = '';
	};

$("#wpaf_generatedEmailShortcode").val('[input' + wpaf_type + wpaf_label + wpaf_name + wpaf_value + wpaf_id + wpaf_class + wpaf_required + wpaf_placeholder +']');
};


function modalTelGenerator(){

	var wpaf_type = ' type="tel"';

//Required checkboxe 1 generator
	if (document.getElementById("wpaf_generator-tel-required").checked){
		var wpaf_required = ' required="required"';				
	} else {
		var wpaf_required = '';
	};

//Label shortcode generator
	if(document.getElementById("wpaf_generator-tel-label").value.length>0){

		var wpaf_label = ' label="'+document.getElementById("wpaf_generator-tel-label").value+'"';
	}else{

		var wpaf_label =	'';
	};

//Name shortcode generator
	if(document.getElementById("wpaf_generator-tel-name").value.length>0){

		var wpaf_name = ' name="'+document.getElementById("wpaf_generator-tel-name").value+'"';
	}else{

		var wpaf_name = '';
	};

//Class shortcode generator
	if(document.getElementById("wpaf_generator-tel-class").value.length>0){

		var wpaf_class = ' class="'+document.getElementById("wpaf_generator-tel-class").value+'"';
	}else{

		var wpaf_class = '';
	};

//Id shortcode generator
	if(document.getElementById("wpaf_generator-tel-id").value.length>0){

		var wpaf_id = ' id="'+document.getElementById("wpaf_generator-tel-id").value+'"';
	}else{

		var wpaf_id = '';
	};

//Valeur shortcode generator
	if(document.getElementById("wpaf_generator-tel-value").value.length>0){

		var wpaf_value = ' value="'+document.getElementById("wpaf_generator-tel-value").value+'"';
		document.getElementById("wpaf_generator-tel-placeholder").disabled=false;
	}else{

		var wpaf_value = '';
		document.getElementById("wpaf_generator-tel-placeholder").disabled=true;
	};

//Placeholder checkboxe 2 generator
	if (document.getElementById("wpaf_generator-tel-placeholder").checked){
		var wpaf_placeholder = ' placeholder="'+document.getElementById("wpaf_generator-tel-value").value+'"';
		var wpaf_value = '';

	} else {
		var wpaf_placeholder = '';
	};

$("#wpaf_generatedTelShortcode").val('[input' + wpaf_type + wpaf_label + wpaf_name + wpaf_value + wpaf_id + wpaf_class + wpaf_required + wpaf_placeholder +']');
};



function modalTextareaGenerator(){

	var wpaf_type = ' type="textarea"';

//Required checkboxe 1 generator
	if (document.getElementById("wpaf_generator-textarea-required").checked){
		var wpaf_required = ' required="required"';		
	} else {
		var wpaf_required = '';		
	};

//Label shortcode generator
	if(document.getElementById("wpaf_generator-textarea-label").value.length>0){

		var wpaf_label = ' label="'+document.getElementById("wpaf_generator-textarea-label").value+'"';		
	}else{

		var wpaf_label =	'';
	};

//cols shortcode generator
	if(document.getElementById("wpaf_generator-textarea-cols").value.length>0){

		var wpaf_cols = ' cols="'+document.getElementById("wpaf_generator-textarea-cols").value+'"';
	}else{

		var wpaf_cols =	'';
	};

//rows shortcode generator
	if(document.getElementById("wpaf_generator-textarea-rows").value.length>0){

		var wpaf_rows = ' rows="'+document.getElementById("wpaf_generator-textarea-rows").value+'"';
	}else{

		var wpaf_rows =	'';
	};

//Name shortcode generator
	if(document.getElementById("wpaf_generator-textarea-name").value.length>0){

		var wpaf_name = ' name="'+document.getElementById("wpaf_generator-textarea-name").value+'"';
	}else{

		var wpaf_name =	'';
	};

//Class shortcode generator
	if(document.getElementById("wpaf_generator-textarea-class").value.length>0){

		var wpaf_class = ' class="'+document.getElementById("wpaf_generator-textarea-class").value+'"';
	}else{

		var wpaf_class = '';
	};

//Id shortcode generator
	if(document.getElementById("wpaf_generator-textarea-id").value.length>0){

		var wpaf_id = ' id="'+document.getElementById("wpaf_generator-textarea-id").value+'"';
	}else{

		var wpaf_id = '';
	};

//Valeur shortcode generator
	if(document.getElementById("wpaf_generator-textarea-value").value.length>0){

		var wpaf_value = ' value="'+document.getElementById("wpaf_generator-textarea-value").value+'"';
		document.getElementById("wpaf_generator-textarea-placeholder").disabled=false;
	}else{

		var wpaf_value = '';
		document.getElementById("wpaf_generator-textarea-placeholder").disabled=true;
	};

//Placeholder checkboxe 2 generator
	if (document.getElementById("wpaf_generator-textarea-placeholder").checked){
		var wpaf_placeholder = ' placeholder="'+document.getElementById("wpaf_generator-textarea-value").value+'"';
		var wpaf_value = '';

	} else {
		var wpaf_placeholder = '';
	};

$("#wpaf_generatedTextareaShortcode").val('[input' + wpaf_type + wpaf_rows + wpaf_cols +wpaf_label + wpaf_name + wpaf_value + wpaf_id + wpaf_class + wpaf_required + wpaf_placeholder +']');
};

var retour = "\n";

function transfertText(){
 	document.getElementById("wpaf_contenu_formulaire").value += retour + document.getElementById("wpaf_generatedTextShortcode").value + retour;

	if(document.getElementById("wpaf_generator-text-required").checked){
		document.getElementById("wpaf_generator-text-required").checked=false;
 	}

	if (document.getElementById("wpaf_generator-text-placeholder").checked){
		document.getElementById("wpaf_generator-text-placeholder").checked=false;
	}

	if(document.getElementById("wpaf_generator-text-label").value.length>0){
		$("#wpaf_generator-text-label").val("");
	}

	if(document.getElementById("wpaf_generator-text-name").value.length>0){
		$("#wpaf_generator-text-name").val("");
	}

	if(document.getElementById("wpaf_generator-text-class").value.length>0){
		$("#wpaf_generator-text-class").val("");
	}

	if(document.getElementById("wpaf_generator-text-id").value.length>0){
		$("#wpaf_generator-text-id").val("");
	}

	if(document.getElementById("wpaf_generator-text-value").value.length>0){
		$("#wpaf_generator-text-value").val("");
	}

	if(document.getElementById("wpaf_generatedTextShortcode").value.length>0){
		$("#wpaf_generatedTextShortcode").val('[input type="text"');
	}
}

function transfertEmail(){
 	document.getElementById("wpaf_contenu_formulaire").value += retour + document.getElementById("wpaf_generatedEmailShortcode").value + retour;

	if(document.getElementById("wpaf_generator-email-required").checked){
		document.getElementById("wpaf_generator-email-required").checked=false;
 	}

	if (document.getElementById("wpaf_generator-email-placeholder").checked){
		document.getElementById("wpaf_generator-email-placeholder").checked=false;
	}

	if(document.getElementById("wpaf_generator-email-label").value.length>0){
		$("#wpaf_generator-email-label").val("");
	}

	if(document.getElementById("wpaf_generator-email-name").value.length>0){
		$("#wpaf_generator-email-name").val("");
	}

	if(document.getElementById("wpaf_generator-email-class").value.length>0){
		$("#wpaf_generator-email-class").val("");
	}

	if(document.getElementById("wpaf_generator-email-id").value.length>0){
		$("#wpaf_generator-email-id").val("");
	}

	if(document.getElementById("wpaf_generator-email-value").value.length>0){
		$("#wpaf_generator-email-value").val("");
	}

	if(document.getElementById("wpaf_generatedEmailShortcode").value.length>0){
		$("#wpaf_generatedEmailShortcode").val('[input type="mail"')
	}
}

function transfertTextarea(){
 	document.getElementById("wpaf_contenu_formulaire").value += retour + document.getElementById("wpaf_generatedTextareaShortcode").value + retour;

	if(document.getElementById("wpaf_generator-textarea-required").checked){
		document.getElementById("wpaf_generator-textarea-required").checked=false;
 	}

	if (document.getElementById("wpaf_generator-textarea-placeholder").checked){
		document.getElementById("wpaf_generator-textarea-placeholder").checked=false;
	}

	if(document.getElementById("wpaf_generator-textarea-label").value.length>0){
		$("#wpaf_generator-textarea-label").val("");
	}

	if(document.getElementById("wpaf_generator-textarea-rows").value.length>0){
		$("#wpaf_generator-textarea-rows").val("");
	}

	if(document.getElementById("wpaf_generator-textarea-cols").value.length>0){
		$("#wpaf_generator-textarea-cols").val("");
	}

	if(document.getElementById("wpaf_generator-textarea-name").value.length>0){
		$("#wpaf_generator-textarea-name").val("");
	}

	if(document.getElementById("wpaf_generator-textarea-class").value.length>0){
		$("#wpaf_generator-textarea-class").val("");
	}

	if(document.getElementById("wpaf_generator-textarea-id").value.length>0){
		$("#wpaf_generator-textarea-id").val("");
	}

	if(document.getElementById("wpaf_generator-textarea-value").value.length>0){
		$("#wpaf_generator-textarea-value").val("");
	}

	if(document.getElementById("wpaf_generatedTextareaShortcode").value.length>0){
		$("#wpaf_generatedTextareaShortcode").val('[input type="textarea"');
	}
}

function transfertTel(){
 	document.getElementById("wpaf_contenu_formulaire").value += retour + document.getElementById("wpaf_generatedTelShortcode").value + retour;

	if(document.getElementById("wpaf_generator-tel-required").checked){
		document.getElementById("wpaf_generator-tel-required").checked=false;
 	}

	if (document.getElementById("wpaf_generator-tel-placeholder").checked){
		document.getElementById("wpaf_generator-tel-placeholder").checked=false;
	}

	if(document.getElementById("wpaf_generator-tel-label").value.length>0){
		$("#wpaf_generator-tel-label").val("");
	}

	if(document.getElementById("wpaf_generator-tel-name").value.length>0){
		$("#wpaf_generator-tel-name").val("");
	}

	if(document.getElementById("wpaf_generator-tel-class").value.length>0){
		$("#wpaf_generator-tel-class").val("");
	}

	if(document.getElementById("wpaf_generator-tel-id").value.length>0){
		$("#wpaf_generator-tel-id").val("");
	}

	if(document.getElementById("wpaf_generator-tel-value").value.length>0){
		$("#wpaf_generator-tel-value").val("");
	}

	if(document.getElementById("wpaf_generatedTelShortcode").value.length>0){
		$("#wpaf_generatedTelShortcode").val('[input type="tel"')
	}
}

// Default values for the form construction container
function buttonDefaultMail() {
	var defaultMail = document.getElementsByName("contenuFormulaireMail")[0].value;

	var defaultEmailSubmitText = document.getElementsByName("defaultEmailSubmitText")[0].value;
	var defaultEmailSubmitTextColor = document.getElementsByName("defaultEmailSubmitTextColor")[0].value;
	var defaultEmailSubmitColor = document.getElementsByName("defaultEmailSubmitColor")[0].value;

	document.getElementById('wpaf_contenu_formulaire').value = defaultMail;

	document.getElementById('wpaf_email_submit').value = defaultEmailSubmitText;
	document.getElementById('wpaf_email_text_color').value = defaultEmailSubmitTextColor;
	document.getElementById('wpaf_email_submit_color').value = defaultEmailSubmitColor;
	document.getElementById('wpaf_color_text_code_email').value = defaultEmailSubmitTextColor;
	document.getElementById('wpaf_color_code_email').value = defaultEmailSubmitColor;
	
}

function buttonDefaultWhatsapp() {
	var defaultWhatsapp = document.getElementsByName("contenuFormulaireWhatsapp")[0].value;

	var defaultWhatsappSubmitText = document.getElementsByName("defaultWhatsappSubmitText")[0].value;
	var defaultWhatsappSubmitTextColor = document.getElementsByName("defaultWhatsappSubmitTextColor")[0].value;
	var defaultWhatsappSubmitColor = document.getElementsByName("defaultWhatsappSubmitColor")[0].value;

	document.getElementById('wpaf_contenu_formulaire').value = defaultWhatsapp;

	document.getElementById('wpaf_whatsapp_submit').value = defaultWhatsappSubmitText;
	document.getElementById('wpaf_whatsapp_text_color').value = defaultWhatsappSubmitTextColor;
	document.getElementById('wpaf_whatsapp_submit_color').value = defaultWhatsappSubmitColor;
	document.getElementById('wpaf_color_text_code_whatsapp').value = defaultWhatsappSubmitTextColor;
	document.getElementById('wpaf_color_code_whatsapp').value = defaultWhatsappSubmitColor;

}

// Default values for the email messages
function buttonDefaultEmailMessages() {
	var defaultEmailSuccess = document.getElementsByName("buttonDefaultEmailSuccess")[0].value;
	var defaultEmailError = document.getElementsByName("buttonDefaultEmailError")[0].value;
	
	document.getElementById('wpaf_email_success').value = defaultEmailSuccess;
	document.getElementById('wpaf_email_error').value = defaultEmailError;
}

// Default values for the whatsapp messages
function buttonDefaultWhatsappMessages() {
	var defaultWhatsappSuccess = document.getElementsByName("buttonDefaultWhatsappSuccess")[0].value;
	var defaultWhatsappError = document.getElementsByName("buttonDefaultWhatsappError")[0].value;

	document.getElementById('wpaf_whatsapp_success').value = defaultWhatsappSuccess;
	document.getElementById('wpaf_whatsapp_error').value = defaultWhatsappError;
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

	
	document.getElementById('wpaf_email_admin_to').value = defaultEmailAdminTo;
	document.getElementById('wpaf_email_admin_from').value = defaultEmailAdminFrom;
	document.getElementById('wpaf_email_admin_subject').value = defaultEmailAdminSubject;
	document.getElementById('wpaf_email_admin_content').value = defaultEmailAdminContent;

	document.getElementById('wpaf_email_user_to').value = defaultEmailUserTo;
	document.getElementById('wpaf_email_user_from').value = defaultEmailUserFrom;
	document.getElementById('wpaf_email_user_subject').value = defaultEmailUserSubject;
	document.getElementById('wpaf_email_user_content').value = defaultEmailUserContent;
}

// Sélectionne le formulaire à surveiller
const formulaire = document.getElementById("post");
if(formulaire){

	// Initialise la variable de modification non enregistrée à false
	let modificationNonEnregistree = false;

	// Initialise la variable pour savoir si le bouton switch a été utilisé pour soumettre le formulaire
	let switchSubmitted = false;

	// Ajoute un gestionnaire d'événements "input" au formulaire pour détecter les modifications
	formulaire.addEventListener('input', function(e) {
	modificationNonEnregistree = true;
	});

	// Ajoute un gestionnaire d'événements "change" au formulaire pour détecter les modifications
	formulaire.addEventListener('change', function(e) {
	modificationNonEnregistree = true;
	});

	// Ajoute un gestionnaire d'événements "submit" au formulaire pour désactiver la boîte de dialogue de confirmation
	formulaire.addEventListener('submit', function(event) {
	modificationNonEnregistree = false;
	// Si le formulaire a été soumis par le bouton switch, on met switchSubmitted à true
	if (event.submitter.id === 'wpaf_whatsapp_switch') {
		switchSubmitted = true;
	}
	});

	// Ajoute un gestionnaire d'événements "beforeunload" à la fenêtre pour afficher la boîte de dialogue de confirmation
	window.addEventListener('beforeunload', function(e) {
	// Vérifie s'il y a des modifications non enregistrées
	if (modificationNonEnregistree && !switchSubmitted) {
		// Affiche la boîte de dialogue de confirmation
		e.preventDefault();
		e.returnValue = '';
		window.alert('You have unsaved changes!');
	}
	});


	document.addEventListener('DOMContentLoaded', function() {

		const switchButton = document.getElementById('wpaf_whatsapp_switch');

		// Ajoute un gestionnaire d'événements "click" au bouton de switch
		switchButton.addEventListener('click', function(e) {
			// Met switchSubmitted à true pour indiquer que le formulaire a été soumis par le bouton switch
			switchSubmitted = true;
			// Soumet le formulaire pour enregistrer les modifications
			formulaire.submit();
		});

		
	});

	// Submit function
	document.addEventListener('DOMContentLoaded', function() {

		const saveButtonMessages = document.getElementById('wpaf_save_messages');
		const saveButtonEmail = document.getElementById('wpaf_save_email');
		const saveButtonFinal = document.getElementById('wpaf_save_final');

		if(saveButtonMessages){

			saveButtonMessages.addEventListener('click', function(e) {
				formulaire.submit();
			});
		}

		if(saveButtonEmail){

			saveButtonEmail.addEventListener('click', function(e) {
				formulaire.submit();
			});
		}

		if(saveButtonFinal){

			saveButtonFinal.addEventListener('click', function(e) {
				formulaire.submit();
			});
		}
	});
};