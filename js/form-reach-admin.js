function modalTextGenerator(){

	var fr_type = ' type="text"';

//Required checkboxe 1 generator
	if (document.getElementById("fr_generator-text-required").checked){
		var fr_required = ' required="required"';				
	} else {
		var fr_required = '';
	};


//Label shortcode generator
	if(document.getElementById("fr_generator-text-label").value.length>0){

		var fr_label = ' label="'+document.getElementById("fr_generator-text-label").value+'"';
	}else{

		var fr_label =	'';
	};

//Name shortcode generator
	if(document.getElementById("fr_generator-text-name").value.length>0){

		var fr_name = ' name="'+document.getElementById("fr_generator-text-name").value+'"';
	}else{

		var fr_name =	'';
	};

//Class shortcode generator
	if(document.getElementById("fr_generator-text-class").value.length>0){

		var fr_class = ' class="'+document.getElementById("fr_generator-text-class").value+'"';
	}else{

		var fr_class = '';
	};

//Id shortcode generator
	if(document.getElementById("fr_generator-text-id").value.length>0){

		var fr_id = ' id="'+document.getElementById("fr_generator-text-id").value+'"';
	}else{

		var fr_id = '';
	};

//Valeur shortcode generator
	if(document.getElementById("fr_generator-text-value").value.length>0){

		var fr_value = ' value="'+document.getElementById("fr_generator-text-value").value+'"';
		document.getElementById("fr_generator-text-placeholder").disabled=false;
	}else{

		var fr_value = '';
		document.getElementById("fr_generator-text-placeholder").disabled=true;
	};
	

//Placeholder checkboxe 2 generator
	if (document.getElementById("fr_generator-text-placeholder").checked){
		var fr_placeholder = ' placeholder="'+document.getElementById("fr_generator-text-value").value+'"';
		var fr_value = '';

	} else {
		var fr_placeholder = '';
	};

$("#fr_generatedTextShortcode").val('[input' + fr_type + fr_label + fr_name + fr_value + fr_id + fr_class + fr_required + fr_placeholder +']');
};



function modalEmailGenerator(){

	var fr_type = ' type="email"';

//Required checkboxe 1 generator

	if (document.getElementById("fr_generator-email-required").checked){
		var fr_required = ' required="required"';				
	} else {
		var fr_required = '';
	};


//Label shortcode generator
	if(document.getElementById("fr_generator-email-label").value.length>0){

		var fr_label = ' label="'+document.getElementById("fr_generator-email-label").value+'"';
	}else{
		
		var fr_label =	'';
	};

//Name shortcode generator
	if(document.getElementById("fr_generator-email-name").value.length>0){

		var fr_name = ' name="'+document.getElementById("fr_generator-email-name").value+'"';
	}else{

		var fr_name =	'';
	};

//Class shortcode generator
	if(document.getElementById("fr_generator-email-class").value.length>0){

		var fr_class = ' class="'+document.getElementById("fr_generator-email-class").value+'"';
	}else{

		var fr_class = '';
	};

//Id shortcode generator
	if(document.getElementById("fr_generator-email-id").value.length>0){

		var fr_id = ' id="'+document.getElementById("fr_generator-email-id").value+'"';
	}else{

		var fr_id = '';
	};

//Valeur shortcode generator
	if(document.getElementById("fr_generator-email-value").value.length>0){

		var fr_value = ' value="'+document.getElementById("fr_generator-email-value").value+'"';
		document.getElementById("fr_generator-email-placeholder").disabled=false;
	}else{

		var fr_value = '';
		document.getElementById("fr_generator-email-placeholder").disabled=true;
	};

//Placeholder checkboxe 2 generator
	if (document.getElementById("fr_generator-email-placeholder").checked){
		var fr_placeholder = ' placeholder="'+document.getElementById("fr_generator-email-value").value+'"';
		var fr_value = '';

	} else {
		var fr_placeholder = '';
	};

$("#fr_generatedEmailShortcode").val('[input' + fr_type + fr_label + fr_name + fr_value + fr_id + fr_class + fr_required + fr_placeholder +']');
};


function modalTelGenerator(){

	var fr_type = ' type="tel"';

//Required checkboxe 1 generator
	if (document.getElementById("fr_generator-tel-required").checked){
		var fr_required = ' required="required"';				
	} else {
		var fr_required = '';
	};

//Label shortcode generator
	if(document.getElementById("fr_generator-tel-label").value.length>0){

		var fr_label = ' label="'+document.getElementById("fr_generator-tel-label").value+'"';
	}else{

		var fr_label =	'';
	};

//Name shortcode generator
	if(document.getElementById("fr_generator-tel-name").value.length>0){

		var fr_name = ' name="'+document.getElementById("fr_generator-tel-name").value+'"';
	}else{

		var fr_name = '';
	};

//Class shortcode generator
	if(document.getElementById("fr_generator-tel-class").value.length>0){

		var fr_class = ' class="'+document.getElementById("fr_generator-tel-class").value+'"';
	}else{

		var fr_class = '';
	};

//Id shortcode generator
	if(document.getElementById("fr_generator-tel-id").value.length>0){

		var fr_id = ' id="'+document.getElementById("fr_generator-tel-id").value+'"';
	}else{

		var fr_id = '';
	};

//Valeur shortcode generator
	if(document.getElementById("fr_generator-tel-value").value.length>0){

		var fr_value = ' value="'+document.getElementById("fr_generator-tel-value").value+'"';
		document.getElementById("fr_generator-tel-placeholder").disabled=false;
	}else{

		var fr_value = '';
		document.getElementById("fr_generator-tel-placeholder").disabled=true;
	};

//Placeholder checkboxe 2 generator
	if (document.getElementById("fr_generator-tel-placeholder").checked){
		var fr_placeholder = ' placeholder="'+document.getElementById("fr_generator-tel-value").value+'"';
		var fr_value = '';

	} else {
		var fr_placeholder = '';
	};

$("#fr_generatedTelShortcode").val('[input' + fr_type + fr_label + fr_name + fr_value + fr_id + fr_class + fr_required + fr_placeholder +']');
};



function modalTextareaGenerator(){

	var fr_type = ' type="textarea"';

//Required checkboxe 1 generator
	if (document.getElementById("fr_generator-textarea-required").checked){
		var fr_required = ' required="required"';		
	} else {
		var fr_required = '';		
	};

//Label shortcode generator
	if(document.getElementById("fr_generator-textarea-label").value.length>0){

		var fr_label = ' label="'+document.getElementById("fr_generator-textarea-label").value+'"';		
	}else{

		var fr_label =	'';
	};

//cols shortcode generator
	if(document.getElementById("fr_generator-textarea-cols").value.length>0){

		var fr_cols = ' cols="'+document.getElementById("fr_generator-textarea-cols").value+'"';
	}else{

		var fr_cols =	'';
	};

//rows shortcode generator
	if(document.getElementById("fr_generator-textarea-rows").value.length>0){

		var fr_rows = ' rows="'+document.getElementById("fr_generator-textarea-rows").value+'"';
	}else{

		var fr_rows =	'';
	};

//Name shortcode generator
	if(document.getElementById("fr_generator-textarea-name").value.length>0){

		var fr_name = ' name="'+document.getElementById("fr_generator-textarea-name").value+'"';
	}else{

		var fr_name =	'';
	};

//Class shortcode generator
	if(document.getElementById("fr_generator-textarea-class").value.length>0){

		var fr_class = ' class="'+document.getElementById("fr_generator-textarea-class").value+'"';
	}else{

		var fr_class = '';
	};

//Id shortcode generator
	if(document.getElementById("fr_generator-textarea-id").value.length>0){

		var fr_id = ' id="'+document.getElementById("fr_generator-textarea-id").value+'"';
	}else{

		var fr_id = '';
	};

//Valeur shortcode generator
	if(document.getElementById("fr_generator-textarea-value").value.length>0){

		var fr_value = ' value="'+document.getElementById("fr_generator-textarea-value").value+'"';
		document.getElementById("fr_generator-textarea-placeholder").disabled=false;
	}else{

		var fr_value = '';
		document.getElementById("fr_generator-textarea-placeholder").disabled=true;
	};

//Placeholder checkboxe 2 generator
	if (document.getElementById("fr_generator-textarea-placeholder").checked){
		var fr_placeholder = ' placeholder="'+document.getElementById("fr_generator-textarea-value").value+'"';
		var fr_value = '';

	} else {
		var fr_placeholder = '';
	};

$("#fr_generatedTextareaShortcode").val('[input' + fr_type + fr_rows + fr_cols +fr_label + fr_name + fr_value + fr_id + fr_class + fr_required + fr_placeholder +']');
};

var retour = "\n";

function transfertText(){
 	document.getElementById("fr_contenu_formulaire").value += retour + document.getElementById("fr_generatedTextShortcode").value + retour;

	if(document.getElementById("fr_generator-text-required").checked){
		document.getElementById("fr_generator-text-required").checked=false;
 	}

	if (document.getElementById("fr_generator-text-placeholder").checked){
		document.getElementById("fr_generator-text-placeholder").checked=false;
	}

	if(document.getElementById("fr_generator-text-label").value.length>0){
		$("#fr_generator-text-label").val("");
	}

	if(document.getElementById("fr_generator-text-name").value.length>0){
		$("#fr_generator-text-name").val("");
	}

	if(document.getElementById("fr_generator-text-class").value.length>0){
		$("#fr_generator-text-class").val("");
	}

	if(document.getElementById("fr_generator-text-id").value.length>0){
		$("#fr_generator-text-id").val("");
	}

	if(document.getElementById("fr_generator-text-value").value.length>0){
		$("#fr_generator-text-value").val("");
	}

	if(document.getElementById("fr_generatedTextShortcode").value.length>0){
		$("#fr_generatedTextShortcode").val('[input type="text"');
	}
}

function transfertEmail(){
 	document.getElementById("fr_contenu_formulaire").value += retour + document.getElementById("fr_generatedEmailShortcode").value + retour;

	if(document.getElementById("fr_generator-email-required").checked){
		document.getElementById("fr_generator-email-required").checked=false;
 	}

	if (document.getElementById("fr_generator-email-placeholder").checked){
		document.getElementById("fr_generator-email-placeholder").checked=false;
	}

	if(document.getElementById("fr_generator-email-label").value.length>0){
		$("#fr_generator-email-label").val("");
	}

	if(document.getElementById("fr_generator-email-name").value.length>0){
		$("#fr_generator-email-name").val("");
	}

	if(document.getElementById("fr_generator-email-class").value.length>0){
		$("#fr_generator-email-class").val("");
	}

	if(document.getElementById("fr_generator-email-id").value.length>0){
		$("#fr_generator-email-id").val("");
	}

	if(document.getElementById("fr_generator-email-value").value.length>0){
		$("#fr_generator-email-value").val("");
	}

	if(document.getElementById("fr_generatedEmailShortcode").value.length>0){
		$("#fr_generatedEmailShortcode").val('[input type="mail"')
	}
}

function transfertTextarea(){
 	document.getElementById("fr_contenu_formulaire").value += retour + document.getElementById("fr_generatedTextareaShortcode").value + retour;

	if(document.getElementById("fr_generator-textarea-required").checked){
		document.getElementById("fr_generator-textarea-required").checked=false;
 	}

	if (document.getElementById("fr_generator-textarea-placeholder").checked){
		document.getElementById("fr_generator-textarea-placeholder").checked=false;
	}

	if(document.getElementById("fr_generator-textarea-label").value.length>0){
		$("#fr_generator-textarea-label").val("");
	}

	if(document.getElementById("fr_generator-textarea-rows").value.length>0){
		$("#fr_generator-textarea-rows").val("");
	}

	if(document.getElementById("fr_generator-textarea-cols").value.length>0){
		$("#fr_generator-textarea-cols").val("");
	}

	if(document.getElementById("fr_generator-textarea-name").value.length>0){
		$("#fr_generator-textarea-name").val("");
	}

	if(document.getElementById("fr_generator-textarea-class").value.length>0){
		$("#fr_generator-textarea-class").val("");
	}

	if(document.getElementById("fr_generator-textarea-id").value.length>0){
		$("#fr_generator-textarea-id").val("");
	}

	if(document.getElementById("fr_generator-textarea-value").value.length>0){
		$("#fr_generator-textarea-value").val("");
	}

	if(document.getElementById("fr_generatedTextareaShortcode").value.length>0){
		$("#fr_generatedTextareaShortcode").val('[input type="textarea"');
	}
}

function transfertTel(){
 	document.getElementById("fr_contenu_formulaire").value += retour + document.getElementById("fr_generatedTelShortcode").value + retour;

	if(document.getElementById("fr_generator-tel-required").checked){
		document.getElementById("fr_generator-tel-required").checked=false;
 	}

	if (document.getElementById("fr_generator-tel-placeholder").checked){
		document.getElementById("fr_generator-tel-placeholder").checked=false;
	}

	if(document.getElementById("fr_generator-tel-label").value.length>0){
		$("#fr_generator-tel-label").val("");
	}

	if(document.getElementById("fr_generator-tel-name").value.length>0){
		$("#fr_generator-tel-name").val("");
	}

	if(document.getElementById("fr_generator-tel-class").value.length>0){
		$("#fr_generator-tel-class").val("");
	}

	if(document.getElementById("fr_generator-tel-id").value.length>0){
		$("#fr_generator-tel-id").val("");
	}

	if(document.getElementById("fr_generator-tel-value").value.length>0){
		$("#fr_generator-tel-value").val("");
	}

	if(document.getElementById("fr_generatedTelShortcode").value.length>0){
		$("#fr_generatedTelShortcode").val('[input type="tel"')
	}
}

// Default values for the form construction container
function buttonDefaultMail() {
	var defaultMail = document.getElementsByName("contenuFormulaireMail")[0].value;

	var defaultEmailSubmitText = document.getElementsByName("defaultEmailSubmitText")[0].value;
	var defaultEmailSubmitTextColor = document.getElementsByName("defaultEmailSubmitTextColor")[0].value;
	var defaultEmailSubmitColor = document.getElementsByName("defaultEmailSubmitColor")[0].value;

	document.getElementById('fr_contenu_formulaire').value = defaultMail;

	document.getElementById('fr_email_submit').value = defaultEmailSubmitText;
	document.getElementById('fr_email_text_color').value = defaultEmailSubmitTextColor;
	document.getElementById('fr_email_submit_color').value = defaultEmailSubmitColor;
	document.getElementById('fr_color_text_code_email').value = defaultEmailSubmitTextColor;
	document.getElementById('fr_color_code_email').value = defaultEmailSubmitColor;
	
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

// Select the form to monitor
const formulaire = document.getElementById("post");
if (formulaire) {
	// Initialize the non-persistent modification variable to false
	let modificationNonEnregistree = false;

	// Initialize the variable to track if the switch button has been used to submit the form
	let switchSubmitted = false;

	// Initialize the variable to track if the publish button has been used to submit the form
	let publishSubmitted = false;

	// Add an "input" event handler to the form to detect changes
	formulaire.addEventListener('input', function(e) {
		modificationNonEnregistree = true;
	});

	// Add a "change" event handler to the form to detect changes
	formulaire.addEventListener('change', function(e) {
		modificationNonEnregistree = true;
	});

	// Add a "submit" event handler to the form to disable the confirmation dialog box
	formulaire.addEventListener('submit', function(event) {
		// Reset the modification flag and switchSubmitted
		modificationNonEnregistree = false;
		switchSubmitted = false;

		// If the form has been submitted by the switch button, set `switchSubmitted` to true
		if (event.submitter.id === 'fr_whatsapp_switch') {
		switchSubmitted = true;
		}

		// If the form has been submitted by the publish button, set `publishSubmitted` to true
		if (event.submitter.id === 'fr_publish_final') {
		publishSubmitted = true;
		}
	});

	// Add a "beforeunload" event handler to the window to display the confirmation dialog box
	window.addEventListener('beforeunload', function(e) {
		// Check if there are any unsaved modifications
		if (modificationNonEnregistree && !switchSubmitted && !publishSubmitted) {
		// Display the confirmation dialog box
		e.preventDefault();
		e.returnValue = '';
		window.alert('You have unsaved changes!');
		}
	});




	document.addEventListener('DOMContentLoaded', function() {

		const switchButton = document.getElementById('fr_whatsapp_switch');

		// Add a "click" event handler to the switch button
		switchButton.addEventListener('click', function(e) {
			// Set `switchSubmitted` to true to indicate that the form has been submitted by the switch button
			switchSubmitted = true;
			// Submit the form to save the modifications.
			formulaire.submit();
		});

		
	});

	// Submit function
	document.addEventListener('DOMContentLoaded', function() {

		const saveButtonMessages = document.getElementById('fr_save_messages');
		const saveButtonWhatsapp = document.getElementById('fr_saveFormWhatsapp');
		const saveButtonEmail = document.getElementById('fr_save_email');
		const saveButtonFinal = document.getElementById('fr_save_final');

		if(saveButtonMessages){

			saveButtonMessages.addEventListener('click', function(e) {
				formulaire.submit();
			});
		}

		if(saveButtonWhatsapp){

			saveButtonWhatsapp.addEventListener('click', function(e) {
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

