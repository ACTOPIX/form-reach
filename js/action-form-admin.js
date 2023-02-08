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
 	document.getElementById("wpaf_contenu_formulaire").append(retour + document.getElementById("wpaf_generatedTextShortcode").value + retour);

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
 	document.getElementById("wpaf_contenu_formulaire").append(retour + document.getElementById("wpaf_generatedEmailShortcode").value + retour);

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
 	document.getElementById("wpaf_contenu_formulaire").append(retour + document.getElementById("wpaf_generatedTextareaShortcode").value + retour);

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
 	document.getElementById("wpaf_contenu_formulaire").append(retour + document.getElementById("wpaf_generatedTelShortcode").value + retour);

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

function switchWhatsapp() {

	if(document.getElementById("wpaf_whatsapp_switch").checked){

		document.getElementById("wpaf_whatsapp_iconsvg").setAttribute("style","visibility : visible");
		document.getElementById("wpaf_mail_iconsvg").setAttribute("style","visibility : hidden");
		document.getElementById("wpaf_span_whatsapp").setAttribute("style","display : block");
		document.getElementById("wpaf_span_mail").setAttribute("style","display : none");


	}else{

		document.getElementById("wpaf_whatsapp_iconsvg").setAttribute("style","visibility : hidden");
		document.getElementById("wpaf_mail_iconsvg").setAttribute("style","visibility : visible");
		document.getElementById("wpaf_span_whatsapp").setAttribute("style","display : none");
		document.getElementById("wpaf_span_mail").setAttribute("style","display : block");

	};
};
