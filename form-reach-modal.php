<?php

if ( !defined('ABSPATH') ) exit;

wp_enqueue_style('form-reach-css', plugin_dir_url(__FILE__) . 'assets/css/form-reach.min.css', array(), '1.0.0');

wp_enqueue_script('jquery');

// Styles
wp_enqueue_style('form-reach-intl-tel-input-css', plugin_dir_url(__FILE__) . 'assets/css/intlTelInput.min.css', array(), '1.0.0');

// Scripts
wp_enqueue_script('form-reach-bundle-js', plugin_dir_url(__FILE__) . 'assets/js/bundle.min.js', array('jquery'), '1.0.0', true);

// Passer le chemin vers utils.js à admin.js
wp_localize_script('form-reach-bundle-js', 'form_reach_params', array(
	'utilsScript' => plugin_dir_url(__FILE__) . 'assets/js/utils.js',
));

//Default Form
function formreach_email_form_default() {
    $label_name = esc_html__('Name', 'form-reach-domain');
    $name_attr = esc_attr__('name', 'form-reach-domain');
    $placeholder_name = esc_attr__('Enter your name', 'form-reach-domain');

    $label_email = esc_html__('Email address', 'form-reach-domain');
    $email_attr = esc_attr__('email', 'form-reach-domain');
    $placeholder_email = esc_attr__('Enter your email', 'form-reach-domain');

    $label_message = esc_html__('Message', 'form-reach-domain');
    $message_attr = esc_attr__('message', 'form-reach-domain');
    $placeholder_message = esc_attr__('Enter your message', 'form-reach-domain');

    return '[input type="text" label="' . $label_name . '" name="' . $name_attr . '" required="required" placeholder="' . $placeholder_name . '"]' . "\n\n" .
           '[input type="email" label="' . $label_email . '" name="' . $email_attr . '" required="required" placeholder="' . $placeholder_email . '"]' . "\n\n" .
           '[input type="textarea" rows="10" label="' . $label_message . '" name="' . $message_attr . '" required="required" placeholder="' . $placeholder_message . '"]';
}

function formreach_whatsapp_form_default() {
    $label_name = esc_html__('Name', 'form-reach-domain');
    $name_attr = esc_attr__('name', 'form-reach-domain');
    $placeholder_name = esc_attr__('Enter your name', 'form-reach-domain');

    $label_message = esc_html__('Message', 'form-reach-domain');
    $message_attr = esc_attr__('message', 'form-reach-domain');
    $placeholder_message = esc_attr__('Enter your message', 'form-reach-domain');

    return '[input type="text" label="' . $label_name . '" name="' . $name_attr . '" required="required" placeholder="' . $placeholder_name . '"]' . "\n\n" .
           '[input type="textarea" rows="10" label="' . $label_message . '" name="' . $message_attr . '" required="required" placeholder="' . $placeholder_message . '"]';
}


$formreach_defaultform = array(
    'formreach_email_form_default' => formreach_email_form_default(),
    'formreach_whatsapp_form_default' => formreach_whatsapp_form_default(),
	// Submit Default
	'formreach_email_submit_text_default' => esc_html__("Send", 'form-reach-domain'),
	'formreach_email_submit_text_color_default' => esc_attr("#ffffff"),
	'formreach_email_submit_color_default' => esc_attr("#0d6efd"),
	'formreach_whatsapp_submit_text_default' => esc_html__("WhatsApp", 'form-reach-domain'),
	'formreach_whatsapp_submit_text_color_default' => esc_attr("#ffffff"),
	'formreach_whatsapp_submit_color_default' => esc_attr("#198754"),
	// Default Values
	'formreach_email_admin_to_default' => get_option('admin_email'),
	'formreach_email_admin_from_default' => esc_html__("Form Reach", 'form-reach-domain'),
	'formreach_email_admin_subject_default' => esc_html__("User Message", 'form-reach-domain'),
	'formreach_email_admin_content_default' => esc_html__("Name: [name]\nEmail: [email]\nMessage: [message]", 'form-reach-domain'),
	'formreach_email_user_to_default' => esc_attr("[email]"),
	'formreach_email_user_from_default' => esc_html__("Form Reach", 'form-reach-domain'),
	'formreach_email_user_subject_default' => esc_html__("Form Reach", 'form-reach-domain'),
	'formreach_email_user_content_default' => esc_html__("Thank you for reaching out to us.\n\nWe acknowledge receipt of your message and assure you that we will respond as soon as possible.", 'form-reach-domain'),
	// Error/Success default
	'formreach_email_success_default' => esc_html__("The form has been successfully submitted.", 'form-reach-domain'),
	'formreach_email_error_default' => esc_html__("The form could not be submitted due to an error. Please try again.", 'form-reach-domain'),
	'formreach_whatsapp_success_default' => esc_html__("The message has been successfully submitted. Click on the 'Continue to Conversation' button.", 'form-reach-domain'),
	'formreach_whatsapp_error_default' => esc_html__("The message could not be submitted due to an error. Please try again.", 'form-reach-domain')
);

?>

<section onload="formreach_modalTextGenerator(),formreach_modalTextareaGenerator(),formreach_modalEmailGenerator(),formreach_modalTelGenerator()">

	<div class="tab-content" id="formreach_myTabContent">
		<ul class="nav nav-tabs" id="formreach_myTab" role="tablist">
			<li class="nav-item" role="presentation">
				<button class="nav-link active" id="formreach_home-tab" data-bs-toggle="tab" data-bs-target="#formreach_formulaire" type="button" role="tab" aria-controls="home" aria-selected="true">Form</button>
			</li>
			<li class="nav-item" role="presentation">
				<button class="nav-link" id="formreach_profile-tab" data-bs-toggle="tab" data-bs-target="#formreach_email" type="button" role="tab" aria-controls="profile" aria-selected="false"><?php if( ($formreach_stored_meta['formreach_whatsapp_switch'][0]) == 1 ) { ?>WhatsApp<?php }else{?> Email<?php } ?></button>
			</li>
			<li class="nav-item" role="presentation">
				<button class="nav-link" id="formreach_contact-tab" data-bs-toggle="tab" data-bs-target="#formreach_message" type="button" role="tab" aria-controls="contact" aria-selected="false">Message</button>
			</li>
			<li id="formreach_switch_container" class="ms-auto d-flex align-items-center">
				<!-- Email Icon -->
				<i class="fa fa-envelope mx-2" style="color: <?php if( ($formreach_stored_meta['formreach_whatsapp_switch'][0]) == 0 ) { ?> #2271b1 <?php }else{ ?> #a4a4a4a4 <?php } ?>; font-size: 27px;"></i>				
				<!-- Toggle button to switch WhatsApp form -->
				<input type="checkbox" name="formreach_whatsapp_switch" id="formreach_whatsapp_switch" class="formreach_slider-input-whatsapp position-absolute" <?php if( ($formreach_stored_meta['formreach_whatsapp_switch'][0]) == 1 ) { ?>checked="checked"<?php }else{?><?php } ?> /><label id="formreach_whatsapp_label" for="formreach_whatsapp_switch" class="formreach_slider-label-whatsapp">Toggle</label>
				
				<!-- WhatsApp Icon -->
				<i class="fa fa-whatsapp mx-2" style="color: <?php if( ($formreach_stored_meta['formreach_whatsapp_switch'][0]) == 1 ) { ?> #25d366 <?php }else{ ?> #a4a4a4a4 <?php } ?>; font-size: 27px;"></i>
			</li>
		</ul>

		<!-- Creation of containers for the content associated with tabs -->
		<div id="formreach_formulaire" class="tab-pane fade show active mt-3 container" role="tabpanel">
		
		<?php if( ($formreach_stored_meta['formreach_whatsapp_switch'][0]) == 0 ) { ?>
			<div class="row">
				<div class="col-xl-10 col-lg-10 col-md-10 col-xs-12 col-sm-12 formreach_warning-container" id="formreach_warning_inputs_uncalled_container" style="height:0;opacity:0;">
					<div class="alert alert-primary d-flex align-items-center text-primary" role="alert" style="margin-right:auto;">
						<i class="fa-solid fa-circle-info mx-2" style="color:#2271b1;font-size:27px;"></i>
						<div class="ms-2" id="formreach_warning_inputs_uncalled">
						</div>
					</div>
				</div>
			</div>
		<?php };?>
			
			<!-- Modal Button: Text -->
			<button type="button" name="button_text" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#formreach_modal_text">Text</button>
			<!-- Modal Form Tag Generator: Text -->
			<div class="modal fade" id="formreach_modal_text" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="formreach_exampleModalLabel">Form Tag Generator: Text</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<div class="table-responsive">
								<table class="table table-borderless">
									<tbody>
										<tr>
											<th class="text-end"scope="row">Type: </th>
											<td>
												<fieldset>
													<legend class="screen-reader-text">Field type</legend>
													<label><input type="checkbox" id="formreach_generator-text-required" name="required" onclick="formreach_modalTextGenerator()"> Required field</label>
												</fieldset>
											</td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="formreach_generator-text-label">Label: </label></th>
											<td ><input type="text" name="label" class="tg-name oneline" id="formreach_generator-text-label" onchange="formreach_modalTextGenerator()"></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="formreach_generator-text-name">Name<span class="text-primary">*</span>: </label></th>
											<td><input type="text" name="name" class="tg-name oneline" id="formreach_generator-text-name" onchange="formreach_modalTextGenerator()"></br>
											<span id="formreach_requiredNameText" class="text-danger fst-italic" style="font-size: 12px;" hidden>*This field is required</span></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="formreach_generator-text-value">Value: </label></th>
											<td><input type="text" name="value" class="oneline" id="formreach_generator-text-value" onchange="formreach_modalTextGenerator()" ></td>
										</tr>

										<tr>
											<td></td>
											<td class="pt-n3"><input type="checkbox" name="placeholder"  id="formreach_generator-text-placeholder" class="option" onclick="formreach_modalTextGenerator()" ><label for="formreach_generator-text-placeholder">Use this text as placeholder for the field.</label></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="formreach_generator-text-id">ID: </label></th>
											<td><input type="text" name="id" class="idvalue oneline option" id="formreach_generator-text-id" onchange="formreach_modalTextGenerator()"></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="formreach_generator-text-class">Class: </label></th>
											<td><input type="text" name="class" class="classvalue oneline option" id="formreach_generator-text-class" onchange="formreach_modalTextGenerator()"></td>
										</tr>

									</tbody>
								</table>
							</div>
						</div>

						<div class="modal-footer position-relative">
							<div class="position-absolute start-0 ms-3">
								<input type="text" name="text" id="formreach_generatedTextShortcode" readonly="readonly" style="width:365px" value="[input]" >
							</div>
							<div>
								<button type="button" id="formreach_submit_text" class="btn btn-primary formreach_wp-blue">Finish</button>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Modal Button: Email -->
			<button type="button" name="button_email" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#formreach_modal_email"> Email </button>
			<!-- Modal Form Tag Generator: Email -->
			<div class="modal fade" id="formreach_modal_email" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="formreach_exampleModalLabel">Form Tag Generator: Email</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<div class="table-responsive">
								<table class="table table-borderless">
									<tbody>
										<tr>
											<th class="text-end"scope="row">Type: </th>
											<td>
												<fieldset>
												<legend class="screen-reader-text">Field type</legend>
												<label><input type="checkbox" id="formreach_generator-email-required" name="required" onclick="formreach_modalEmailGenerator()"> Required field</label>
												</fieldset>
											</td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="formreach_generator-email-label">Label: </label></th>
											<td ><input type="text" name="label" class="tg-name oneline" id="formreach_generator-email-label" onchange="formreach_modalEmailGenerator()"></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="formreach_generator-email-name">Name<span class="text-primary">*</span>: </label></th>
											<td><input type="text" name="name" class="tg-name oneline" id="formreach_generator-email-name" onchange="formreach_modalEmailGenerator()"></br>
											<span id="formreach_requiredNameEmail" class="text-danger fst-italic" style="font-size: 12px;" hidden>*This field is required</span></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="formreach_generator-email-value">Value: </label></th>
											<td><input type="text" name="value" class="oneline" id="formreach_generator-email-value" onchange="formreach_modalEmailGenerator()"></td>
										</tr>

										<tr>
											<td></td>
											<td class="pt-n3"><input type="checkbox" id="formreach_generator-email-placeholder" name="placeholder" class="option" onclick="formreach_modalEmailGenerator()"><label for="formreach_generator-email-placeholder">Use this text as placeholder for the field.</label></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="formreach_generator-email-id">ID: </label></th>
											<td><input type="text" name="id" class="idvalue oneline option" id="formreach_generator-email-id" onchange="formreach_modalEmailGenerator()"></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="formreach_generator-email-class">Class: </label></th>
											<td><input type="text" name="class" class="classvalue oneline option" id="formreach_generator-email-class" onchange="formreach_modalEmailGenerator()"></td>
										</tr>

									</tbody>
								</table>
							</div>
						</div>

						<div class="modal-footer position-relative">
							<div class="position-absolute start-0 ms-3">
								<input type="text" name="text" id="formreach_generatedEmailShortcode" readonly="readonly" style="width:365px" value="[input]" >
							</div>
							<div>
								<button type="button" id="formreach_submit_email"class="btn btn-primary formreach_wp-blue">Finish</button>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Modal Button: Textarea -->
			<button type="button" name="button_zone_de_text" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#formreach_modal_textarea"> Text area </button>
			<!-- Modal Form Tag Generator: Textarea -->
			<div class="modal fade" id="formreach_modal_textarea" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="formreach_exampleModalLabel">Form Tag Generator: Text area</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">

							<div class="d-flex align-items-center ms-4">
							<div class="col-6 mb-3">
								<div class="input-group" style="width:10em;">
									<span class="input-group-text" id="formreach_input-cols" style="font-size: 100%;"><strong>Columns:</strong></span>
									<input type="number" name="cols" class="form-control form-control-sm small-input" id="formreach_generator-textarea-cols" min="0" max="50" value="0" onchange="formreach_modalTextareaGenerator()">
								</div>
								</div>
								<div class="col-6 mb-3">
									<div class="input-group" style="width:8em;">
										<span class="input-group-text" id="formreach_input-rows" style="font-size: 100%;"><strong>Rows:</strong></span>
										<input type="number" name="rows" class="form-control form-control-sm small-input" id="formreach_generator-textarea-rows" min="0" max="50" value="0" onchange="formreach_modalTextareaGenerator()">
									</div>
								</div>
							</div>



							<div class="table-responsive">
								<table class="table table-borderless">
									<tbody>
										<tr>
											<th class="text-end"scope="row">Type: </th>
											<td>
												<legend class="screen-reader-text">Field type</legend>
												<label><input type="checkbox" id="formreach_generator-textarea-required" name="required" onclick="formreach_modalTextareaGenerator()"> Required field</label>
											</td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="formreach_generator-textarea-label">Label: </label></th>
											<td><input type="text" name="label" class="tg-name oneline" id="formreach_generator-textarea-label" onchange="formreach_modalTextareaGenerator()"></td>
										</tr>
										
										<tr>
											<th class="text-end" scope="row"><label for="formreach_generator-textarea-name">Name<span class="text-primary">*</span>: </label></th>
											<td><input type="text" name="name" class="tg-name oneline" id="formreach_generator-textarea-name" onchange="formreach_modalTextareaGenerator()"></br>
											<span id="formreach_requiredNameTextarea" class="text-danger fst-italic" style="font-size: 12px;" hidden>*This field is required</span></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="formreach_generator-textarea-value">Value: </label></th>
											<td><input type="text" name="value" class="oneline" id="formreach_generator-textarea-value" onchange="formreach_modalTextareaGenerator()"></td>
										</tr>

										<tr>
											<td></td>
											<td class="pt-n3"><input type="checkbox" id="formreach_generator-textarea-placeholder" name="placeholder" class="option" onclick="formreach_modalTextareaGenerator()"><label for="formreach_generator-textarea-placeholder">Use this text as placeholder for the field.</label></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="formreach_generator-textarea-id">ID: </label></th>
											<td><input type="text" name="id" class="idvalue oneline option" id="formreach_generator-textarea-id" onchange="formreach_modalTextareaGenerator()"></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="formreach_generator-textarea-class">Class: </label></th>
											<td><input type="text" name="class" class="classvalue oneline option" id="formreach_generator-textarea-class" onchange="formreach_modalTextareaGenerator()"></td>
										</tr>

									</tbody>
								</table>
							</div>
						</div>

						<div class="modal-footer position-relative">
							<div class="position-absolute start-0 ms-3">
								<input type="text" name="text" id="formreach_generatedTextareaShortcode" readonly="readonly" style="width:365px" value="[input]" >
							</div>
							<div>
								<button type="button" id="formreach_submit_textarea" class="btn btn-primary formreach_wp-blue">Finish</button>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Modal Button: Tel -->
			<button type="button" name="button_tel" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#formreach_modal_tel"> Phone </button>
			<!-- Modal Form Tag Generator: Tel -->
			<div class="modal fade" id="formreach_modal_tel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="formreach_exampleModalLabel">Form Tag Generator: Tel</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<div class="table-responsive">
								<table class="table table-borderless">
									<tbody>
										<tr>
											<th class="text-end"scope="row">Type: </th>
											<td>
												<fieldset>
												<legend class="screen-reader-text">Field type</legend>
												<label><input type="checkbox"  id="formreach_generator-tel-required"name="required" onclick="formreach_modalTelGenerator()">Required field</label>
												</fieldset>
											</td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="formreach_generator-tel-label">Label: </label></th>
											<td ><input type="text" name="label" class="tg-name oneline" id="formreach_generator-tel-label" onchange="formreach_modalTextGenerator()"></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="formreach_generator-tel-name">Name<span class="text-primary">*</span>: </label></th>
											<td><input type="text" name="name" class="tg-name oneline" id="formreach_generator-tel-name" onchange="formreach_modalTelGenerator()"></br>
											<span id="formreach_requiredNameTel" class="text-danger fst-italic" style="font-size: 12px;" hidden>*This field is required</span></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="formreach_generator-tel-value">Value: </label></th>
											<td><input type="text" name="value" class="oneline" id="formreach_generator-tel-value" onchange="formreach_modalTelGenerator()"></td>
										</tr>

										<tr>
											<td></td>
											<td class="pt-n3"><input type="checkbox" id="formreach_generator-tel-placeholder" name="placeholder" class="option" onclick="formreach_modalTelGenerator()"><label for="formreach_generator-tel-placeholder">Use this text as placeholder for the field.</label></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="formreach_generator-tel-id">ID: </label></th>
											<td><input type="text" name="id" class="idvalue oneline option" id="formreach_generator-tel-id" onchange="formreach_modalTelGenerator()"></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="formreach_generator-tel-class">Class: </label></th>
											<td><input type="text" name="class" class="classvalue oneline option" id="formreach_generator-tel-class" onchange="formreach_modalTelGenerator()"></td>
										</tr>

									</tbody>
								</table>
							</div>
						</div>

						<div class="modal-footer position-relative">
							<div class="position-absolute start-0 ms-3">
								<input type="text" name="text" id="formreach_generatedTelShortcode" readonly="readonly" style="width:365px" value="[input]" >
							</div>
							<div>
								<button type="button" id="formreach_submit_tel" class="btn btn-primary formreach_wp-blue">Finish</button>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Modal Button: Dropdown Menu -->
			<button type="button" name="button_menu_deroulant" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#formreach_modalMenu" disabled> Dropdown menu </button>

			<!-- Modal Button: Checkbox -->
			<button type="button" name="button_cases_a_cocher"class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#formreach_modalCase" disabled> Checkbox </button>

			<!-- Modal Button: Radio Button -->
			<button type="button" name="button_boutons_radio" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#formreach_modalRadio" disabled> Radio button </button>

			<!-- Modal Button: Date -->
			<button type="button" name="button_date" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#formreach_modalDate" disabled> Date </button>
			
			<!-- Modal Button: File -->
			<button type="button" name="button_fichier" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#formreach_modalFichier" disabled> File </button>

			<!-- Modal Button: Submit -->
			<button type="button" name="formreach_button_modal_submit" id="formreach_button_modal_submit" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#formreach_button_modal_submit_content"> Submit </button>

			<!-- Modal Form Tag Generator: Submit -->
			<div class="modal fade" id="formreach_button_modal_submit_content" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-sm modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="formreach_exampleModalLabel">Form Submit Settings</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<div class="table-responsive">
								<table class="table table-borderless">
									<tbody>
										<tr>
											<th class="text-end"scope="row"></th>
											<td>
												<div class="form-group">
													<?php if( ($formreach_stored_meta['formreach_whatsapp_switch'][0]) == 1 ){ ?>
														<label for="formreach_whatsapp_submit" class="d-block mb-1" size="30"><strong>Whatsapp submit button: </strong></label>
														<input type="text" name="formreach_whatsapp_submit" id="formreach_whatsapp_submit" size="19" value="<?php if (!empty($formreach_stored_meta['formreach_whatsapp_submit'])) echo esc_attr($formreach_stored_meta['formreach_whatsapp_submit'][0]); ?>"></br>
														<div class="my-2">
															<input type="color" name="formreach_whatsapp_text_color" id="formreach_whatsapp_text_color" value="<?php if (!empty($formreach_stored_meta['formreach_whatsapp_text_color'])) echo esc_attr($formreach_stored_meta['formreach_whatsapp_text_color'][0]); ?>" class="formreach_color me-2">
															<input type="text" id="formreach_color_text_code_whatsapp" size="9" maxlength="7" placeholder="HEX code">
														</div>
														<label for="formreach_color_code_whatsapp"class="d-block mb-1"><strong>Button color:</strong></label>
														<input type="color" name="formreach_whatsapp_submit_color" id="formreach_whatsapp_submit_color" value="<?php if (!empty($formreach_stored_meta['formreach_whatsapp_submit_color'])) echo esc_attr($formreach_stored_meta['formreach_whatsapp_submit_color'][0]); ?>" class="formreach_color me-2">
														<input type="text" id="formreach_color_code_whatsapp" size="9" maxlength="7" placeholder="HEX code">
													<?php }else{?>
														<label for="formreach_email_submit" class="d-block mb-1"><strong>Email submit button: </strong></label>
														<input type="text" name="formreach_email_submit" id="formreach_email_submit" size="19" value="<?php if (!empty($formreach_stored_meta['formreach_email_submit'])) echo esc_attr($formreach_stored_meta['formreach_email_submit'][0]); ?>"></br>
														<div class="my-2">
															<input type="color" name="formreach_email_text_color" id="formreach_email_text_color" value="<?php if (!empty($formreach_stored_meta['formreach_email_text_color'])) echo esc_attr($formreach_stored_meta['formreach_email_text_color'][0]); ?>" class="formreach_color me-2">
															<input type="text" id="formreach_color_text_code_email" size="9" maxlength="7" placeholder="HEX code">
														</div>
														<label for="formreach_color_code_email"class="d-block mb-1"><strong>Button color:</strong></label>
														<input type="color" name="formreach_email_submit_color" id="formreach_email_submit_color" value="<?php if (!empty($formreach_stored_meta['formreach_email_submit_color'])) echo esc_attr($formreach_stored_meta['formreach_email_submit_color'][0]); ?>" class="formreach_color me-2">
														<input type="text" id="formreach_color_code_email" size="9" maxlength="7" placeholder="HEX code">
													<?php }?>
													<div>
														<?php if( ($formreach_stored_meta['formreach_whatsapp_switch'][0]) == 1 ) { ?>
															<div class="d-block mb-1 mt-3"><strong>Button preview:</strong></div>
															<button type="button" id="formreach_whatsapp_submit_result" class="btn">
																	<i id="formreach_icon_whatsapp" class="fa fa-whatsapp"></i>
																	<span id="formreach_whatsapp_submit_text_result" ></span>
															</button>
														<?php };?>

														<?php if( ($formreach_stored_meta['formreach_whatsapp_switch'][0]) == 0 ) { ?>
															<div class="d-block mb-1 mt-3"><strong>Button preview:</strong></div>
															<button type="button" id="formreach_email_submit_result" class="btn">
																	<i class="fa fa-envelope" id="formreach_icon_email"></i>
																	<span  id="formreach_email_submit_text_result"></span>
															</button>
														<?php };?>
													</div>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div class="modal-footer position-relative">
							<div>
								<button type="button" class="btn btn-primary formreach_wp-blue" data-bs-dismiss="modal">Finish</button>
							</div>
						</div>
					</div>
				</div>
			</div> 

			<!-- Final form shortcode container -->
			<textarea style="white-space:pre-line;width:100%;" spellcheck="false" <?php if( ($formreach_stored_meta['formreach_whatsapp_switch'][0]) == 1 ) { ?> name="formreach_whatsapp_form_content" <?php } else { ?>name="formreach_email_form_content" <?php } ?> id="formreach_contenu_formulaire" rows="24" class="large-tet code mt-3 code"><?php if( ($formreach_stored_meta['formreach_whatsapp_switch'][0]) == 1 ) { if (! empty ($formreach_stored_meta['formreach_whatsapp_form_content'])) echo esc_textarea ( $formreach_stored_meta['formreach_whatsapp_form_content'][0] ); }else{ if (! empty ($formreach_stored_meta['formreach_email_form_content'])) echo esc_textarea ( $formreach_stored_meta['formreach_email_form_content'][0] ); } ?></textarea>
			
			<div class="row mt-2">
				<?php
					$formreach_form_id = filter_input(INPUT_GET, 'post', FILTER_VALIDATE_INT);

					if ($formreach_form_id) {
						$formreach_form_status = get_post_status($formreach_form_id);

						if (!$formreach_form_status) {
							$formreach_form_status = 'invalid';
						}
					} else {
						$formreach_form_status = 'new';
					}
				?>
				
				<!-- Publish form button -->
				<?php if ($formreach_form_status !== 'publish') : ?>
					<div class="col-auto pe-0">
						<input name="original_publish" type="hidden" value="Publish">
						<input type="submit" name="publish" id="formreach_publish_final" class="btn btn-success btn-sm" value="Publish">
					</div>
				<?php endif; ?>

				<!-- Save form button -->
				<div class="col-auto pe-0">
					<button type="submit" id="formreach_save_final" class="btn btn-primary btn-sm formreach_wp-blue">
						Save Changes
					</button>
				</div>

				<!-- Restore default form button -->
				<div class="col-auto">
					<button type="button" id="formreach_default_final" class="btn btn-secondary btn-sm" <?php if( ($formreach_stored_meta['formreach_whatsapp_switch'][0]) == 0 ) { ?> onclick="formreach_buttonDefaultMail()"<?php }else{?> onclick="formreach_buttonDefaultWhatsapp()" <?php } ?>>
						<i class="fa-solid fa-rotate-left"></i> Restore default
					</button>
				</div>
			</div>
		</div>

		

		<!-- WhatsApp tab + international number & flag -->
		<?php if( ($formreach_stored_meta['formreach_whatsapp_switch'][0]) == 1 ){ ?> 
			<div id="formreach_email" class="tab-pane fade mt-3 container" role="tabpanel">						
				<div class="form-group">
					<label for="formreach_whatsapp_tel" class="d-block mb-1"><strong>Number :</strong></label>
					<input type="tel" id="formreach_whatsapp_tel" name="formreach_whatsapp_tel" value="<?php if (!empty($formreach_stored_meta['formreach_whatsapp_tel_international'])) echo esc_attr($formreach_stored_meta['formreach_whatsapp_tel_international'][0]); ?>" class="form-control" />
					<span id="formreach_whatsapp_message" class="text-danger ms-3 d-none"></span>
					<input type="hidden" id="formreach_whatsapp_tel_international" name="formreach_whatsapp_tel_international" value="<?php if (!empty($formreach_stored_meta['formreach_whatsapp_tel_international'])) echo esc_attr($formreach_stored_meta['formreach_whatsapp_tel_international'][0]); ?>" />
				</div>

				<div class="row mt-3">
					<?php
						$formreach_form_id = filter_input(INPUT_GET, 'post', FILTER_VALIDATE_INT);

						if ($formreach_form_id) {
							$formreach_form_status = get_post_status($formreach_form_id);

							if (!$formreach_form_status) {
								$formreach_form_status = 'invalid';
							}
						} else {
							$formreach_form_status = 'new';
						}
					?>
				
					<!-- Publish form button -->
					<?php if ($formreach_form_status !== 'publish') : ?>
						<div id="publishing-action" class="col-auto pe-0">
							<input name="original_publish" type="hidden" id="formreach_publishFormWhatsapp" value="Publish">
							<input type="submit" name="publish" id="publish" class="btn btn-success btn-sm" value="Publish">
						</div>
					<?php endif; ?>
						
					<!-- Save form button -->
					<div class="col-auto pe-0">
						<button type="submit" id="formreach_saveFormWhatsapp" style="height:min-content;" class="btn btn-primary btn-sm formreach_wp-blue">
							Save Changes
						</button>
					</div>
				</div>
			</div>
			
		<?php }else{?>
			<div id="formreach_email" class="tab-pane fade mt-3 container" role="tabpanel">
				<div class="row">
					<div class="col-xl-10 col-lg-10 col-md-10 col-xs-12 col-sm-12 formreach_warning-container" id="formreach_warning_inputs_inexistent_container" style="height:0;opacity:0;">
							<div class="alert alert-primary d-flex align-items-center text-primary" role="alert" style="margin-right:auto;">
								<i class="fa-solid fa-circle-info mx-2" style="color:#2271b1;font-size:27px;"></i>
								<div class="ms-2" id="formreach_warning_inputs_inexistent">
								</div>
							</div>
					</div>
				</div>

				<div class="form-group">
					<label for="formreach_email_admin_to"><strong>To</strong></label><br>
					<input type="text" name="formreach_email_admin_to" id="formreach_email_admin_to" class="large-text code" value="<?php if (! empty ($formreach_stored_meta['formreach_email_admin_to'])) echo esc_attr ( $formreach_stored_meta['formreach_email_admin_to'][0] ); ?>"/>
					
					<label for="formreach_email_admin_from"><strong>From</strong></label>
					<input type="text" name="formreach_email_admin_from" id="formreach_email_admin_from" class="large-text code" value="<?php if (! empty ($formreach_stored_meta['formreach_email_admin_from'])) echo esc_attr ( $formreach_stored_meta['formreach_email_admin_from'][0] ); ?>"/>
					
					<label for="formreach_email_admin_subject" ><strong>Subject</strong></label>
					<input type="text" name="formreach_email_admin_subject" id="formreach_email_admin_subject" class="large-text code" value="<?php if (! empty ($formreach_stored_meta['formreach_email_admin_subject'])) echo esc_attr ( $formreach_stored_meta['formreach_email_admin_subject'][0] ); ?>"/>
					
					<label for="formreach_email_admin_content"><strong>Message content</strong></label>
					<textarea cols="100" rows="18" name="formreach_email_admin_content" id="formreach_email_admin_content" class="large-text code"><?php if (! empty ($formreach_stored_meta['formreach_email_admin_content'])) echo esc_attr ( $formreach_stored_meta['formreach_email_admin_content'][0] ); ?></textarea>
				</div>
				
				<div class="ms-auto d-flex align-items-center">
					<input  type="checkbox" id="formreach_user_email_switch" name="formreach_user_email_switch" class="me-0 mt-1"<?php if($formreach_stored_meta['formreach_user_email_switch'][0] == 1){?>checked<?php };?>/>
					<label  for="formreach_user_email_switch" class="ms-0 mt-1"><h2>Enable the autoresponder</h2></label>
				</div>

				<div class="form-group" id="formreach_user_email">
					<label for="formreach_email_user_to"><strong>To</strong></label><br>
					<input type="text" name="formreach_email_user_to" id="formreach_email_user_to" class="large-text code" value="<?php if (! empty ($formreach_stored_meta['formreach_email_user_to'])) echo esc_attr ( $formreach_stored_meta['formreach_email_user_to'][0] ); ?>"/>
					
					<label for="formreach_email_user_from"><strong>From</strong></label>
					<input type="text" name="formreach_email_user_from" id="formreach_email_user_from" class="large-text code" value="<?php if (! empty ($formreach_stored_meta['formreach_email_user_from'])) echo esc_attr ( $formreach_stored_meta['formreach_email_user_from'][0] ); ?>"/>
					
					<label for="formreach_email_user_subject" ><strong>Subject</strong></label>
					<input type="text" name="formreach_email_user_subject" id="formreach_email_user_subject" class="large-text code" value="<?php if (! empty ($formreach_stored_meta['formreach_email_user_subject'])) echo esc_attr ( $formreach_stored_meta['formreach_email_user_subject'][0] ); ?>"/>
					
					<label for="formreach_email_user_content"><strong>Message content</strong></label>
					<textarea cols="100" rows="18" name="formreach_email_user_content" id="formreach_email_user_content" class="large-text code"><?php if (! empty ($formreach_stored_meta['formreach_email_user_content'])) echo esc_attr ( $formreach_stored_meta['formreach_email_user_content'][0] ); ?></textarea>
				</div>

				<div class="row mt-2">
				<?php
					$formreach_form_id = filter_input(INPUT_GET, 'post', FILTER_VALIDATE_INT);

					if ($formreach_form_id) {
						$formreach_form_status = get_post_status($formreach_form_id);

						if (!$formreach_form_status) {
							$formreach_form_status = 'invalid';
						}
					} else {
						$formreach_form_status = 'new';
					}
				?>

					
					<!-- Publish form button -->
					<?php if ($formreach_form_status !== 'publish') : ?>
						<div id="publishing-action" class="col-auto pe-0">
							<input name="original_publish" type="hidden" id="formreach_publish_email" value="Publish">
							<input type="submit" name="publish" id="publish" class="btn btn-success btn-sm" value="Publish">
						</div>
					<?php endif; ?>

					<!-- Save form button -->
					<div class="col-auto pe-0">
						<button type="submit" id="formreach_save_email" style="height:min-content;" class="btn btn-primary btn-sm formreach_wp-blue">
							Save Changes
						</button>
					</div>

					<!-- Restore default form button -->
					<div class="col-auto">
						<button type="button" id="formreach_default_email" style="height:min-content;" class="btn btn-secondary btn-sm" <?php if( ($formreach_stored_meta['formreach_whatsapp_switch'][0]) == 0 ) { ?> onclick="formreach_buttonDefaultEmailSending()"<?php }?>>
							<i class="fa-solid fa-rotate-left"></i> Restore default
						</button>
					</div>		
				</div>
			</div>

		<?php } ?>
		<!-- Success and Error messages-->
		<div id="formreach_message" class="tab-pane fade mt-3 container" role="tabpanel">
			<div class="mb-3 col-xl-8 col-lg-8 col-md-8 col-xs-12 col-sm-12">
				<label for="<?php if ($formreach_stored_meta['formreach_whatsapp_switch'][0] == 1){?>formreach_whatsapp_success<?php }else{?>formreach_email_success<?php }?>" class="form-label"><strong>The user's message has been sent successfully:</strong></label>
				<div class="alert alert-success">
					<i class="fas fa-check mx-2" style="font-size:20px;vertical-align:sub;"></i>
					<?php if ($formreach_stored_meta['formreach_whatsapp_switch'][0] == 1){?> <input type="text" name="formreach_whatsapp_success" id="formreach_whatsapp_success" class="large-text w-75" style="background-color: transparent;" value="<?php if (! empty ($formreach_stored_meta['formreach_whatsapp_success'])) echo esc_attr ( $formreach_stored_meta['formreach_whatsapp_success'][0] );?>"/><?php }else{
					?> <input type="text" name="formreach_email_success" id="formreach_email_success" class="large-text w-75" style="background-color: transparent;" value="<?php if (! empty ($formreach_stored_meta['formreach_email_success'])) echo esc_attr ( $formreach_stored_meta['formreach_email_success'][0] );?>"/><?php };?>
				</div>
			</div>

			<div class="mb-3 col-xl-8 col-lg-8 col-md-8 col-xs-12 col-sm-12">
				<label for="<?php if ($formreach_stored_meta['formreach_whatsapp_switch'][0] == 1){?>formreach_whatsapp_error<?php }else{?>formreach_email_error<?php }?>" class="form-label"><strong>The user's message could not be sent:</strong></label>
				<div class="alert alert-danger">
					<i class="fas fa-times mx-2" style="font-size:20px; vertical-align:sub;"></i>
					<?php if ($formreach_stored_meta['formreach_whatsapp_switch'][0] == 1){?> <input type="text" name="formreach_whatsapp_error" id="formreach_whatsapp_error" class="large-text w-75" style="background-color: transparent;" value="<?php if (! empty ($formreach_stored_meta['formreach_whatsapp_error'])) echo esc_attr ( $formreach_stored_meta['formreach_whatsapp_error'][0] );?>"/><?php };?>
					<?php if ($formreach_stored_meta['formreach_whatsapp_switch'][0] == 0){?> <input type="text" name="formreach_email_error" id="formreach_email_error" class="large-text w-75" style="background-color: transparent;" value="<?php if (! empty ($formreach_stored_meta['formreach_email_error'])) echo esc_attr ( $formreach_stored_meta['formreach_email_error'][0] );?>"/><?php };?>
				</div>
			</div>
			<div class="row mt-2">
				<?php
					$formreach_form_id = filter_input(INPUT_GET, 'post', FILTER_VALIDATE_INT);

					if ($formreach_form_id) {
						$formreach_form_status = get_post_status($formreach_form_id);

						if (!$formreach_form_status) {
							$formreach_form_status = 'invalid';
						}
					} else {
						$formreach_form_status = 'new';
					}
				?>
				
				<!-- Publish form button -->
				<?php if ($formreach_form_status !== 'publish') : ?>
					<div id="publishing-action" class="col-auto pe-0">
						<input name="original_publish" type="hidden" id="formreach_publish_messages" value="Publish">
						<input type="submit" name="publish" id="publish" class="btn btn-success btn-sm" value="Publish">
					</div>
				<?php endif; ?>

				<!-- Save form button -->
				<div class="col-auto pe-0">
					<button type="submit" id="formreach_save_messages" style="height:min-content;" class="btn btn-primary btn-sm formreach_wp-blue">
						Save Changes
					</button>
				</div>

				<!-- Restore default form button -->
				<div class="col-auto">
					<button type="button" id="formreach_default_messages" style="height:min-content;" class="btn btn-secondary btn-sm" <?php if( ($formreach_stored_meta['formreach_whatsapp_switch'][0]) == 0 ) { ?> onclick="formreach_buttonDefaultEmailMessages()"<?php }else{?> onclick="formreach_buttonDefaultWhatsappMessages()" <?php } ?>>
						<i class="fa-solid fa-rotate-left"></i> Restore default
					</button>
				</div>


			</div>
		</div>

		<!-- Flyout menu -->
		<?php formreach_add_flyout_menu(); ?>
		
	</div>
</section>