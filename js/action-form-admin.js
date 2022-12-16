function modalTextGenerator(){

//Required checkboxe 1 generator
	if (document.getElementById("wpaf_generator-text-required").checked){
		var wpaf_required = ' required="required"';				
	} else {
		var wpaf_required = '';
	};

//Placeholder checkboxe 2 generator
	if (document.getElementById("wpaf_generator-text-placeholder").checked){
		var wpaf_placeholder = ' placeholder="placeholder"';
	} else {
		var wpaf_placeholder = '';
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
	}else{

		var wpaf_value = '';
	};

$("#wpaf_generatedTextShortcode").val('[input'+ wpaf_name + wpaf_value + wpaf_id + wpaf_class + wpaf_required + wpaf_placeholder +']');
};



function modalEmailGenerator(){

//Required checkboxe 1 generator
	if (document.getElementById("wpaf_generator-email-required").checked){
		var wpaf_required = ' required="required"';				
	} else {
		var wpaf_required = '';
	};

//Placeholder checkboxe 2 generator
	if (document.getElementById("wpaf_generator-email-placeholder").checked){
		var wpaf_placeholder = ' placeholder="placeholder"';
	} else {
		var wpaf_placeholder = '';
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
	}else{

		var wpaf_value = '';
	};

$("#wpaf_generatedEmailShortcode").val('[input'+ wpaf_name + wpaf_value + wpaf_id + wpaf_class + wpaf_required + wpaf_placeholder +']');
};


function modalTelGenerator(){

//Required checkboxe 1 generator
	if (document.getElementById("wpaf_generator-tel-required").checked){
		var wpaf_required = ' required="required"';				
	} else {
		var wpaf_required = '';
	};

//Placeholder checkboxe 2 generator
	if (document.getElementById("wpaf_generator-tel-placeholder").checked){
		var wpaf_placeholder = ' placeholder="placeholder"';
	} else {
		var wpaf_placeholder = '';
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
	}else{

		var wpaf_value = '';
	};

$("#wpaf_generatedTelShortcode").val('[input'+ wpaf_name + wpaf_value + wpaf_id + wpaf_class + wpaf_required + wpaf_placeholder +']');
};



function modalTextareaGenerator(){

//Required checkboxe 1 generator
	if (document.getElementById("wpaf_generator-textarea-required").checked){
		var wpaf_required = ' required="required"';				
	} else {
		var wpaf_required = '';
	};

//Placeholder checkboxe 2 generator
	if (document.getElementById("wpaf_generator-textarea-placeholder").checked){
		var wpaf_placeholder = ' placeholder="placeholder"';
	} else {
		var wpaf_placeholder = '';
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
	}else{

		var wpaf_value = '';
	};

$("#wpaf_generatedTextareaShortcode").val('[input'+ wpaf_name + wpaf_value + wpaf_id + wpaf_class + wpaf_required + wpaf_placeholder +']');
};

var retour = "\n\n";

function transfertText(){
 	document.getElementById("contenuFinal").append(document.getElementById("wpaf_generatedTextShortcode").value + retour);

	if(document.getElementById("wpaf_generator-text-required").checked){
		document.getElementById("wpaf_generator-text-required").checked=false;
 	}

	if (document.getElementById("wpaf_generator-text-placeholder").checked){
		document.getElementById("wpaf_generator-text-placeholder").checked=false;
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
		$("#wpaf_generatedTextShortcode").val("[input]")
	}
}

function transfertEmail(){
 	document.getElementById("contenuFinal").append(document.getElementById("wpaf_generatedEmailShortcode").value + retour);

	if(document.getElementById("wpaf_generator-email-required").checked){
		document.getElementById("wpaf_generator-email-required").checked=false;
 	}

	if (document.getElementById("wpaf_generator-email-placeholder").checked){
		document.getElementById("wpaf_generator-email-placeholder").checked=false;
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
		$("#wpaf_generatedEmailShortcode").val("[input]")
	}
}

function transfertTextarea(){
 	document.getElementById("contenuFinal").append(document.getElementById("wpaf_generatedTextareaShortcode").value + retour);

	if(document.getElementById("wpaf_generator-textarea-required").checked){
		document.getElementById("wpaf_generator-textarea-required").checked=false;
 	}

	if (document.getElementById("wpaf_generator-textarea-placeholder").checked){
		document.getElementById("wpaf_generator-textarea-placeholder").checked=false;
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
		$("#wpaf_generatedTextareaShortcode").val("[input]")
	}
}

function transfertTel(){
 	document.getElementById("contenuFinal").append(document.getElementById("wpaf_generatedTelShortcode").value + retour);

	if(document.getElementById("wpaf_generator-tel-required").checked){
		document.getElementById("wpaf_generator-tel-required").checked=false;
 	}

	if (document.getElementById("wpaf_generator-tel-placeholder").checked){
		document.getElementById("wpaf_generator-tel-placeholder").checked=false;
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
		$("#wpaf_generatedTelShortcode").val("[input]")
	}
}
