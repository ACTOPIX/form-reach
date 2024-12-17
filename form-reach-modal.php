<?php

if ( !defined('ABSPATH') ) exit;

wp_enqueue_style('bootstrap-css',  plugin_dir_url(__FILE__) . 'assets/bootstrap/bootstrap.min.css', array(), '5.2.2');
wp_enqueue_style('intl-tel-input-css',  plugin_dir_url(__FILE__) . 'assets/intl-tel-input/intlTelInput.css', array(), '18.1.1');
wp_enqueue_style('form-reach-css', plugin_dir_url(__FILE__) . 'style/form-reach.css', array(), '1.0.0');

wp_enqueue_script('jquery');
wp_enqueue_script('bootstrap-js',  plugin_dir_url(__FILE__) . 'assets/bootstrap/bootstrap.min.js', array('jquery'), '5.2.2', true);
wp_enqueue_script('intl-tel-input-js',  plugin_dir_url(__FILE__) . 'assets/intl-tel-input/intlTelInput.min.js', array('jquery'), '18.1.1', true);
wp_enqueue_script('form-reach-admin-js', plugin_dir_url(__FILE__) . 'js/form-reach-admin.js', array('jquery'), '1.0.0', true);

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

    return '[formreach_input type="text" label="' . $label_name . '" name="' . $name_attr . '" required="required" placeholder="' . $placeholder_name . '"]' . "\n\n" .
           '[formreach_input type="email" label="' . $label_email . '" name="' . $email_attr . '" required="required" placeholder="' . $placeholder_email . '"]' . "\n\n" .
           '[formreach_input type="textarea" rows="10" label="' . $label_message . '" name="' . $message_attr . '" required="required" placeholder="' . $placeholder_message . '"]';
}

function formreach_whatsapp_form_default() {
    $label_name = esc_html__('Name', 'form-reach-domain');
    $name_attr = esc_attr__('name', 'form-reach-domain');
    $placeholder_name = esc_attr__('Enter your name', 'form-reach-domain');

    $label_message = esc_html__('Message', 'form-reach-domain');
    $message_attr = esc_attr__('message', 'form-reach-domain');
    $placeholder_message = esc_attr__('Enter your message', 'form-reach-domain');

    return '[formreach_input type="text" label="' . $label_name . '" name="' . $name_attr . '" required="required" placeholder="' . $placeholder_name . '"]' . "\n\n" .
           '[formreach_input type="textarea" rows="10" label="' . $label_message . '" name="' . $message_attr . '" required="required" placeholder="' . $placeholder_message . '"]';
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

$formreach_phpFlag = !empty( $formreach_stored_meta['formreach_whatsapp_flag'] ) ? esc_attr( $formreach_stored_meta['formreach_whatsapp_flag'][0] ) : '';
    
wp_localize_script('form-reach-admin-js', 'formReach', array_merge($formreach_defaultform, array(
    'phpFlag' => $formreach_phpFlag,
	'utilsScriptUrl' => plugins_url('assets/intl-tel-input/utils.js', __FILE__)
)));

?>

<section onload="formreach_modalTextGenerator(),formreach_modalTextareaGenerator(),formreach_modalEmailGenerator(),formreach_modalTelGenerator()" id="formreach_section_metabox" style="visibility: hidden;">

	<div class="tab-content" id="formreach_myTabContent">
		<ul class="nav nav-tabs" id="formreach_myTab" role="tablist">
			<li class="nav-item" role="presentation">
				<button class="nav-link" id="formreach_home-tab" data-bs-toggle="tab" data-bs-target="#formreach_formulaire" type="button" role="tab" aria-controls="home" aria-selected="true">Form</button>
			</li>
			<li class="nav-item" role="presentation">
				<button class="nav-link" id="formreach_profile-tab" data-bs-toggle="tab" data-bs-target="#formreach_email" type="button" role="tab" aria-controls="profile" aria-selected="false"><?php if( ($formreach_stored_meta['formreach_whatsapp_switch'][0]) == 1 ) { ?>WhatsApp<?php }else{?> Email<?php } ?></button>
			</li>
			<li class="nav-item" role="presentation">
				<button class="nav-link" id="formreach_contact-tab" data-bs-toggle="tab" data-bs-target="#formreach_message" type="button" role="tab" aria-controls="contact" aria-selected="false">Message</button>
			</li>
			<li id="formreach_switch_container" class="ms-auto d-flex align-items-center">
				<!-- Email Icon -->
				 <?php $formreach_envelope_svg_color = (isset($formreach_stored_meta['formreach_whatsapp_switch'][0]) && $formreach_stored_meta['formreach_whatsapp_switch'][0] == 0) ? '#2271b1' : '#a4a4a4'; ?>
				<svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 26 26" fill="none" style="margin: 0 8px 0 8px"><g clip-path="url(#clip0_660_96)"><path d="M24.9983 9.48608C25.1887 9.33472 25.4719 9.47632 25.4719 9.71558V19.7009C25.4719 20.9949 24.4221 22.0447 23.1282 22.0447H2.81567C1.52173 22.0447 0.471924 20.9949 0.471924 19.7009V9.72046C0.471924 9.47632 0.750244 9.3396 0.945557 9.49097C2.03931 10.3406 3.4895 11.4197 8.46997 15.0378C9.50024 15.7898 11.2385 17.3718 12.9719 17.3621C14.7151 17.3767 16.4875 15.7605 17.4788 15.0378C22.4592 11.4197 23.9045 10.3357 24.9983 9.48608ZM12.9719 15.7947C14.1047 15.8142 15.7356 14.3689 16.5559 13.7732C23.0354 9.07105 23.5286 8.66089 25.0227 7.48901C25.3059 7.26929 25.4719 6.92749 25.4719 6.56616V5.63843C25.4719 4.34448 24.4221 3.29468 23.1282 3.29468H2.81567C1.52173 3.29468 0.471924 4.34448 0.471924 5.63843V6.56616C0.471924 6.92749 0.637939 7.2644 0.921143 7.48901C2.41528 8.65601 2.90845 9.07105 9.38794 13.7732C10.2083 14.3689 11.8391 15.8142 12.9719 15.7947Z" fill="<?php echo htmlspecialchars($formreach_envelope_svg_color, ENT_QUOTES, 'UTF-8'); ?>"/></g><defs><clipPath id="clip0_660_96"><rect width="25" height="25" fill="white" transform="translate(0.471924 0.169678)"/></clipPath></defs>
                </svg>				
				<!-- Toggle button to switch WhatsApp form -->
				<input type="checkbox" name="formreach_whatsapp_switch" id="formreach_whatsapp_switch" class="formreach_slider-input-whatsapp position-absolute" <?php if( ($formreach_stored_meta['formreach_whatsapp_switch'][0]) == 1 ) { ?>checked="checked"<?php }else{?><?php } ?> /><label id="formreach_whatsapp_label" for="formreach_whatsapp_switch" class="formreach_slider-label-whatsapp">Toggle</label>
				
				<!-- WhatsApp Icon -->
				 <?php $formreach_whatsapp_svg_color = (isset($formreach_stored_meta['formreach_whatsapp_switch'][0]) && $formreach_stored_meta['formreach_whatsapp_switch'][0] == 0) ? '#a4a4a4' : '#25d366'; ?>
				<svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 27 27" fill="none" style="margin: 0 8px 0 8px"><path d="M21.774 5.12051C19.5645 2.90566 16.6219 1.6875 13.4947 1.6875C7.04004 1.6875 1.7877 6.93984 1.7877 13.3945C1.7877 15.4564 2.32559 17.4709 3.34863 19.248L1.6875 25.3125L7.89434 23.683C9.60293 24.6164 11.5277 25.1068 13.4895 25.1068H13.4947C19.9441 25.1068 25.3125 19.8545 25.3125 13.3998C25.3125 10.2727 23.9836 7.33535 21.774 5.12051ZM13.4947 23.1346C11.7439 23.1346 10.0301 22.6652 8.53769 21.7793L8.18437 21.5684L4.50352 22.5334L5.48438 18.9422L5.25234 18.573C4.27676 17.0227 3.76523 15.235 3.76523 13.3945C3.76523 8.03145 8.13164 3.66504 13.5 3.66504C16.0998 3.66504 18.5414 4.67754 20.3766 6.51797C22.2117 8.3584 23.3402 10.8 23.335 13.3998C23.335 18.7682 18.8578 23.1346 13.4947 23.1346ZM18.8314 15.8467C18.5414 15.699 17.1018 14.9924 16.8328 14.8975C16.5639 14.7973 16.3688 14.7498 16.1736 15.0451C15.9785 15.3404 15.4195 15.9943 15.2455 16.1947C15.0768 16.3898 14.9027 16.4162 14.6127 16.2686C12.8936 15.409 11.765 14.734 10.6313 12.7881C10.3307 12.2713 10.9318 12.3082 11.4908 11.1902C11.5857 10.9951 11.5383 10.8264 11.4645 10.6787C11.3906 10.5311 10.8053 9.09141 10.5627 8.50605C10.3254 7.93652 10.0828 8.01563 9.90352 8.00508C9.73477 7.99453 9.53965 7.99453 9.34453 7.99453C9.14941 7.99453 8.83301 8.06836 8.56406 8.3584C8.29512 8.65371 7.54102 9.36035 7.54102 10.8C7.54102 12.2396 8.59043 13.6318 8.73281 13.827C8.88047 14.0221 10.7947 16.9752 13.732 18.2461C15.5883 19.0477 16.316 19.1162 17.2441 18.9791C17.8084 18.8947 18.9738 18.2725 19.2164 17.5869C19.459 16.9014 19.459 16.316 19.3852 16.1947C19.3166 16.0629 19.1215 15.9891 18.8314 15.8467Z" fill="<?php echo htmlspecialchars($formreach_whatsapp_svg_color, ENT_QUOTES, 'UTF-8'); ?>"/>
                </svg>
			</li>
		</ul>

		<!-- Creation of containers for the content associated with tabs -->
		<div id="formreach_formulaire" class="tab-pane fade  mt-3 container" role="tabpanel">
		
		<?php if( ($formreach_stored_meta['formreach_whatsapp_switch'][0]) == 0 ) { ?>
			<div class="row">
				<div class="col-xl-10 col-lg-10 col-md-10 col-xs-12 col-sm-12 formreach_warning-container" id="formreach_warning_inputs_uncalled_container" style="height:0;opacity:0;">
					<div class="alert alert-primary d-flex align-items-center text-primary" role="alert" style="margin-right:auto;">
						<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none"><g clip-path="url(#clip0_660_94)"><path d="M13 0.40625C6.04515 0.40625 0.40625 6.04718 0.40625 13C0.40625 19.9569 6.04515 25.5938 13 25.5938C19.9548 25.5938 25.5938 19.9569 25.5938 13C25.5938 6.04718 19.9548 0.40625 13 0.40625ZM13 5.99219C14.1779 5.99219 15.1328 6.94708 15.1328 8.125C15.1328 9.30292 14.1779 10.2578 13 10.2578C11.8221 10.2578 10.8672 9.30292 10.8672 8.125C10.8672 6.94708 11.8221 5.99219 13 5.99219ZM15.8438 18.8906C15.8438 19.2272 15.5709 19.5 15.2344 19.5H10.7656C10.4291 19.5 10.1562 19.2272 10.1562 18.8906V17.6719C10.1562 17.3353 10.4291 17.0625 10.7656 17.0625H11.375V13.8125H10.7656C10.4291 13.8125 10.1562 13.5397 10.1562 13.2031V11.9844C10.1562 11.6478 10.4291 11.375 10.7656 11.375H14.0156C14.3522 11.375 14.625 11.6478 14.625 11.9844V17.0625H15.2344C15.5709 17.0625 15.8438 17.3353 15.8438 17.6719V18.8906Z" fill="#2271b1"/></g><defs><clipPath id="clip0_660_94"><rect width="26" height="26" fill="white"/></clipPath></defs></svg>
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
								<input type="text" name="text" id="formreach_generatedTextShortcode" readonly="readonly" style="width:365px" value="[formreach_input]" >
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
								<input type="text" name="text" id="formreach_generatedEmailShortcode" readonly="readonly" style="width:365px" value="[formreach_input]" >
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
								<input type="text" name="text" id="formreach_generatedTextareaShortcode" readonly="readonly" style="width:365px" value="[formreach_input]" >
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
								<input type="text" name="text" id="formreach_generatedTelShortcode" readonly="readonly" style="width:365px" value="[formreach_input]" >
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
															<button type="button" id="formreach_whatsapp_submit_result" class="btn" style="display: flex;align-items: center;width: fit-content;justify-content: space-around;">
																	<svg  xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 27 27" style="margin-right: 0.4em;"><path id="formreach_icon_whatsapp" d="M21.774 5.12051C19.5645 2.90566 16.6219 1.6875 13.4947 1.6875C7.04004 1.6875 1.7877 6.93984 1.7877 13.3945C1.7877 15.4564 2.32559 17.4709 3.34863 19.248L1.6875 25.3125L7.89434 23.683C9.60293 24.6164 11.5277 25.1068 13.4895 25.1068H13.4947C19.9441 25.1068 25.3125 19.8545 25.3125 13.3998C25.3125 10.2727 23.9836 7.33535 21.774 5.12051ZM13.4947 23.1346C11.7439 23.1346 10.0301 22.6652 8.53769 21.7793L8.18437 21.5684L4.50352 22.5334L5.48438 18.9422L5.25234 18.573C4.27676 17.0227 3.76523 15.235 3.76523 13.3945C3.76523 8.03145 8.13164 3.66504 13.5 3.66504C16.0998 3.66504 18.5414 4.67754 20.3766 6.51797C22.2117 8.3584 23.3402 10.8 23.335 13.3998C23.335 18.7682 18.8578 23.1346 13.4947 23.1346ZM18.8314 15.8467C18.5414 15.699 17.1018 14.9924 16.8328 14.8975C16.5639 14.7973 16.3688 14.7498 16.1736 15.0451C15.9785 15.3404 15.4195 15.9943 15.2455 16.1947C15.0768 16.3898 14.9027 16.4162 14.6127 16.2686C12.8936 15.409 11.765 14.734 10.6313 12.7881C10.3307 12.2713 10.9318 12.3082 11.4908 11.1902C11.5857 10.9951 11.5383 10.8264 11.4645 10.6787C11.3906 10.5311 10.8053 9.09141 10.5627 8.50605C10.3254 7.93652 10.0828 8.01563 9.90352 8.00508C9.73477 7.99453 9.53965 7.99453 9.34453 7.99453C9.14941 7.99453 8.83301 8.06836 8.56406 8.3584C8.29512 8.65371 7.54102 9.36035 7.54102 10.8C7.54102 12.2396 8.59043 13.6318 8.73281 13.827C8.88047 14.0221 10.7947 16.9752 13.732 18.2461C15.5883 19.0477 16.316 19.1162 17.2441 18.9791C17.8084 18.8947 18.9738 18.2725 19.2164 17.5869C19.459 16.9014 19.459 16.316 19.3852 16.1947C19.3166 16.0629 19.1215 15.9891 18.8314 15.8467Z" fill="white"/></svg>
																	<span id="formreach_whatsapp_submit_text_result" ></span>
															</button>
														<?php };?>

														<?php if( ($formreach_stored_meta['formreach_whatsapp_switch'][0]) == 0 ) { ?>
															<div class="d-block mb-1 mt-3"><strong>Button preview:</strong></div>
															<button type="button" id="formreach_email_submit_result" class="btn" style="display: flex;align-items: center;width: fit-content;justify-content: space-around;">
																	<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 26 26" fill="none" style="margin-right: 0.4em;"><g clip-path="url(#clip0_660_96)"><path id="formreach_icon_email" d="M24.9983 9.48608C25.1887 9.33472 25.4719 9.47632 25.4719 9.71558V19.7009C25.4719 20.9949 24.4221 22.0447 23.1282 22.0447H2.81567C1.52173 22.0447 0.471924 20.9949 0.471924 19.7009V9.72046C0.471924 9.47632 0.750244 9.3396 0.945557 9.49097C2.03931 10.3406 3.4895 11.4197 8.46997 15.0378C9.50024 15.7898 11.2385 17.3718 12.9719 17.3621C14.7151 17.3767 16.4875 15.7605 17.4788 15.0378C22.4592 11.4197 23.9045 10.3357 24.9983 9.48608ZM12.9719 15.7947C14.1047 15.8142 15.7356 14.3689 16.5559 13.7732C23.0354 9.07105 23.5286 8.66089 25.0227 7.48901C25.3059 7.26929 25.4719 6.92749 25.4719 6.56616V5.63843C25.4719 4.34448 24.4221 3.29468 23.1282 3.29468H2.81567C1.52173 3.29468 0.471924 4.34448 0.471924 5.63843V6.56616C0.471924 6.92749 0.637939 7.2644 0.921143 7.48901C2.41528 8.65601 2.90845 9.07105 9.38794 13.7732C10.2083 14.3689 11.8391 15.8142 12.9719 15.7947Z" fill="white"/></g><defs><clipPath id="clip0_660_96"><rect width="25" height="25" fill="white" transform="translate(0.471924 0.169678)"/></clipPath></defs></svg>
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
					<button type="button" id="formreach_default_final" style="height:min-content; display:flex; align-items:center; justify-content:space-around ;width:105%" class="btn btn-secondary btn-sm" <?php if( ($formreach_stored_meta['formreach_whatsapp_switch'][0]) == 0 ) { ?> onclick="formreach_buttonDefaultMail()"<?php }else{?> onclick="formreach_buttonDefaultWhatsapp()" <?php } ?>>
						<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 26 26" fill="none"><path d="M10.5299 11.9272H0.595095C0.266454 11.9272 0 11.6608 0 11.3321V1.39734C0 1.0687 0.266454 0.802246 0.595095 0.802246H2.97548C3.30412 0.802246 3.57057 1.0687 3.57057 1.39734V5.27102C5.84051 2.75014 9.13769 1.17269 12.8032 1.19932C19.5926 1.24862 25.0249 6.73485 25.0105 13.5243C24.996 20.3044 19.4953 25.7963 12.7119 25.7963C9.53363 25.7963 6.63715 24.5905 4.45444 22.6117C4.20157 22.3825 4.18992 21.9892 4.43128 21.7479L6.11575 20.0634C6.33762 19.8415 6.69408 19.8295 6.92909 20.0374C8.46821 21.3993 10.4925 22.2257 12.7119 22.2257C17.5355 22.2257 21.4399 18.3221 21.4399 13.4976C21.4399 8.67402 17.5363 4.76955 12.7119 4.76955C9.81099 4.76955 7.24296 6.18171 5.65633 8.35663H10.5299C10.8585 8.35663 11.125 8.62309 11.125 8.95173V11.3321C11.125 11.6608 10.8585 11.9272 10.5299 11.9272Z" fill="white"/>
						</svg>
						Restore default
					</button>
				</div>
			</div>
		</div>

		

		<!-- WhatsApp tab + international number & flag -->
		<?php if( ($formreach_stored_meta['formreach_whatsapp_switch'][0]) == 1 ){ ?> 
			<div id="formreach_email" class="tab-pane fade mt-3 container" role="tabpanel">						
				<div class="form-group">
					<label for="formreach_whatsapp_tel" class="d-block mb-1"><strong>Number :</strong></label>
					<input type="tel" id="formreach_whatsapp_tel" name="formreach_whatsapp_tel" autocomplete="on" pattern="^[\d\u002D\u0028\u0029]*$" value="<?php if (!empty($formreach_stored_meta['formreach_whatsapp_tel'])) echo esc_attr($formreach_stored_meta['formreach_whatsapp_tel'][0]); ?>" class="form-control" />
					<span id="formreach_whatsapp_message" class="text-danger hide"></span>
					<input type="hidden" id="formreach_whatsapp_flag" name="formreach_whatsapp_flag" value="<?php if (!empty($formreach_stored_meta['formreach_whatsapp_flag'])) echo esc_attr($formreach_stored_meta['formreach_whatsapp_flag'][0]); ?>" />
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
								<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none"><g clip-path="url(#clip0_660_94)"><path d="M13 0.40625C6.04515 0.40625 0.40625 6.04718 0.40625 13C0.40625 19.9569 6.04515 25.5938 13 25.5938C19.9548 25.5938 25.5938 19.9569 25.5938 13C25.5938 6.04718 19.9548 0.40625 13 0.40625ZM13 5.99219C14.1779 5.99219 15.1328 6.94708 15.1328 8.125C15.1328 9.30292 14.1779 10.2578 13 10.2578C11.8221 10.2578 10.8672 9.30292 10.8672 8.125C10.8672 6.94708 11.8221 5.99219 13 5.99219ZM15.8438 18.8906C15.8438 19.2272 15.5709 19.5 15.2344 19.5H10.7656C10.4291 19.5 10.1562 19.2272 10.1562 18.8906V17.6719C10.1562 17.3353 10.4291 17.0625 10.7656 17.0625H11.375V13.8125H10.7656C10.4291 13.8125 10.1562 13.5397 10.1562 13.2031V11.9844C10.1562 11.6478 10.4291 11.375 10.7656 11.375H14.0156C14.3522 11.375 14.625 11.6478 14.625 11.9844V17.0625H15.2344C15.5709 17.0625 15.8438 17.3353 15.8438 17.6719V18.8906Z" fill="#2271b1"/></g><defs><clipPath id="clip0_660_94"><rect width="26" height="26" fill="white"/></clipPath></defs>
								</svg>
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
						<button type="button" id="formreach_default_email" style="height:min-content; display:flex; align-items:center; justify-content:space-around ;width:105%" class="btn btn-secondary btn-sm" <?php if( ($formreach_stored_meta['formreach_whatsapp_switch'][0]) == 0 ) { ?> onclick="formreach_buttonDefaultEmailSending()"<?php }?>>
							<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 26 26" fill="none"><path d="M10.5299 11.9272H0.595095C0.266454 11.9272 0 11.6608 0 11.3321V1.39734C0 1.0687 0.266454 0.802246 0.595095 0.802246H2.97548C3.30412 0.802246 3.57057 1.0687 3.57057 1.39734V5.27102C5.84051 2.75014 9.13769 1.17269 12.8032 1.19932C19.5926 1.24862 25.0249 6.73485 25.0105 13.5243C24.996 20.3044 19.4953 25.7963 12.7119 25.7963C9.53363 25.7963 6.63715 24.5905 4.45444 22.6117C4.20157 22.3825 4.18992 21.9892 4.43128 21.7479L6.11575 20.0634C6.33762 19.8415 6.69408 19.8295 6.92909 20.0374C8.46821 21.3993 10.4925 22.2257 12.7119 22.2257C17.5355 22.2257 21.4399 18.3221 21.4399 13.4976C21.4399 8.67402 17.5363 4.76955 12.7119 4.76955C9.81099 4.76955 7.24296 6.18171 5.65633 8.35663H10.5299C10.8585 8.35663 11.125 8.62309 11.125 8.95173V11.3321C11.125 11.6608 10.8585 11.9272 10.5299 11.9272Z" fill="white"></path>
							</svg>
							Restore default
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
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 35 35" fill="none"><path d="M8.4911 21.4554L0.366101 13.3304C-0.122034 12.8422 -0.122034 12.0508 0.366101 11.5626L2.13383 9.79481C2.62196 9.30663 3.41346 9.30663 3.9016 9.79481L9.37499 15.2682L21.0984 3.54481C21.5865 3.05668 22.378 3.05668 22.8662 3.54481L24.6339 5.31259C25.122 5.80072 25.122 6.59218 24.6339 7.08036L10.2589 21.4554C9.77069 21.9435 8.97924 21.9435 8.4911 21.4554Z" fill="#0f5132"/>
					</svg>
					<?php if ($formreach_stored_meta['formreach_whatsapp_switch'][0] == 1){?> <input type="text" name="formreach_whatsapp_success" id="formreach_whatsapp_success" class="large-text w-75" style="background-color: transparent;" value="<?php if (! empty ($formreach_stored_meta['formreach_whatsapp_success'])) echo esc_attr ( $formreach_stored_meta['formreach_whatsapp_success'][0] );?>"/><?php }else{
					?> <input type="text" name="formreach_email_success" id="formreach_email_success" class="large-text w-75" style="background-color: transparent;" value="<?php if (! empty ($formreach_stored_meta['formreach_email_success'])) echo esc_attr ( $formreach_stored_meta['formreach_email_success'][0] );?>"/><?php };?>
				</div>
			</div>

			<div class="mb-3 col-xl-8 col-lg-8 col-md-8 col-xs-12 col-sm-12">
				<label for="<?php if ($formreach_stored_meta['formreach_whatsapp_switch'][0] == 1){?>formreach_whatsapp_error<?php }else{?>formreach_email_error<?php }?>" class="form-label"><strong>The user's message could not be sent:</strong></label>
				<div class="alert alert-danger">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 384 512" style="margin-right:2px"><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" fill="#842029"/>
					</svg>
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
					<button type="button" id="formreach_default_messages" style="height:min-content; display:flex; align-items:center; justify-content:space-around ;width:105%" class="btn btn-secondary btn-sm" <?php if( ($formreach_stored_meta['formreach_whatsapp_switch'][0]) == 0 ) { ?> onclick="formreach_buttonDefaultEmailMessages()"<?php }else{?> onclick="formreach_buttonDefaultWhatsappMessages()" <?php } ?>>
						<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 26 26" fill="none"><path d="M10.5299 11.9272H0.595095C0.266454 11.9272 0 11.6608 0 11.3321V1.39734C0 1.0687 0.266454 0.802246 0.595095 0.802246H2.97548C3.30412 0.802246 3.57057 1.0687 3.57057 1.39734V5.27102C5.84051 2.75014 9.13769 1.17269 12.8032 1.19932C19.5926 1.24862 25.0249 6.73485 25.0105 13.5243C24.996 20.3044 19.4953 25.7963 12.7119 25.7963C9.53363 25.7963 6.63715 24.5905 4.45444 22.6117C4.20157 22.3825 4.18992 21.9892 4.43128 21.7479L6.11575 20.0634C6.33762 19.8415 6.69408 19.8295 6.92909 20.0374C8.46821 21.3993 10.4925 22.2257 12.7119 22.2257C17.5355 22.2257 21.4399 18.3221 21.4399 13.4976C21.4399 8.67402 17.5363 4.76955 12.7119 4.76955C9.81099 4.76955 7.24296 6.18171 5.65633 8.35663H10.5299C10.8585 8.35663 11.125 8.62309 11.125 8.95173V11.3321C11.125 11.6608 10.8585 11.9272 10.5299 11.9272Z" fill="white"></path>
						</svg>
						Restore default
					</button>
				</div>


			</div>
		</div>

		<!-- Flyout menu -->
		<?php formreach_add_flyout_menu(); ?>
		
	</div>
</section>
