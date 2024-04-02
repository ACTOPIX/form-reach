<?php
// Styles
wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css');
wp_enqueue_style('intl-tel-input-css', 'https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/css/intlTelInput.css');
wp_enqueue_style('form-reach-css', plugin_dir_url(__FILE__) . 'style/form-reach.css');

// Scripts
wp_enqueue_script('jquery');
wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js', array('jquery'), null, true);
wp_enqueue_script('intl-tel-input-js', 'https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/intlTelInput.min.js', array('jquery'), null, true);
wp_enqueue_script('form-reach-admin-js', plugin_dir_url(__FILE__) . 'js/form-reach-admin.js', array('jquery'), null, true);
wp_enqueue_script('form-reach-js', plugin_dir_url(__FILE__) . 'js/form-reach.js', array('jquery'), null, true);
?>

<section onload="modalTextGenerator(),modalTextareaGenerator(),modalEmailGenerator(),modalTelGenerator()">

	<div class="tab-content" id="fr_myTabContent">
		<ul class="nav nav-tabs" id="fr_myTab" role="tablist">
			<li class="nav-item" role="presentation">
				<button class="nav-link active" id="fr_home-tab" data-bs-toggle="tab" data-bs-target="#fr_formulaire" type="button" role="tab" aria-controls="home" aria-selected="true">Form</button>
			</li>
			<li class="nav-item" role="presentation">
				<button class="nav-link" id="fr_profile-tab" data-bs-toggle="tab" data-bs-target="#fr_email" type="button" role="tab" aria-controls="profile" aria-selected="false"><?php if( ($wp_stored_meta['fr_whatsapp_switch'][0]) == 1 ) { ?>WhatsApp<?php }else{?> Email<?php } ?></button>
			</li>
			<li class="nav-item" role="presentation">
				<button class="nav-link" id="fr_contact-tab" data-bs-toggle="tab" data-bs-target="#fr_message" type="button" role="tab" aria-controls="contact" aria-selected="false">Message</button>
			</li>
			<li id="fr_switch_container" class="ms-auto d-flex align-items-center">
				<!-- Email Icon -->
				<svg id="fr_mail_iconsvg" id="fr_mail_iconsvg" xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="<?php if( ($wp_stored_meta['fr_whatsapp_switch'][0]) == 0 ) { ?> #2271b1 <?php }else{ ?> #a4a4a4a4 <?php } ?>" class="bi bi-envelope me-2" viewBox="0 0 16 16"><path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/></svg>
				
				<!-- Toggle button to switch WhatsApp form -->
				<input type="checkbox" name="fr_whatsapp_switch" id="fr_whatsapp_switch" class="slider-input-whatsapp position-absolute" <?php if( ($wp_stored_meta['fr_whatsapp_switch'][0]) == 1 ) { ?>checked="checked"<?php }else{?><?php } ?> /><label id="fr_whatsapp_label" for="fr_whatsapp_switch" class="slider-label-whatsapp">Toggle</label>
				
				<!-- WhatsApp Icon -->
				<svg id="fr_whatsapp_iconsvg" xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="<?php if( ($wp_stored_meta['fr_whatsapp_switch'][0]) == 1 ) { ?> #25d366 <?php }else{ ?> #a4a4a4a4 <?php } ?>" class="bi bi-whatsapp ms-2" viewBox="0 0 16 16"><path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/></svg>
			</li>
		</ul>

		<!-- Creation of containers for the content associated with tabs -->
		<div id="fr_formulaire" class="tab-pane fade show active mt-3 container" role="tabpanel">

			<!-- Modal Button: Text -->
			<button type="button" name="button_text" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#fr_modal_text">Text</button>
			<!-- Modal Form Tag Generator: Text -->
			<div class="modal fade" id="fr_modal_text" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="fr_exampleModalLabel">Form Tag Generator: Text</h5>
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
													<label><input type="checkbox" id="fr_generator-text-required" name="required" onclick="modalTextGenerator()"> Required field</label>
												</fieldset>
											</td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="fr_generator-text-label">Label: </label></th>
											<td ><input type="text" name="label" class="tg-name oneline" id="fr_generator-text-label" onchange="modalTextGenerator()"></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="fr_generator-text-name">Name<span class="text-primary">*</span>: </label></th>
											<td><input type="text" name="name" class="tg-name oneline" id="fr_generator-text-name" onchange="modalTextGenerator()"></br>
											<span id ="requiredNameText" class="text-danger fst-italic" style="font-size: 12px;" hidden>*This field is required</span></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="fr_generator-text-value">Value: </label></th>
											<td><input type="text" name="value" class="oneline" id="fr_generator-text-value" onchange="modalTextGenerator()" ></td>
										</tr>

										<tr>
											<td></td>
											<td class="pt-n3"><input type="checkbox" name="placeholder"  id="fr_generator-text-placeholder" class="option" onclick="modalTextGenerator()" ><label for="fr_generator-text-placeholder">Use this text as placeholder for the field.</label></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="fr_generator-text-id">ID: </label></th>
											<td><input type="text" name="id" class="idvalue oneline option" id="fr_generator-text-id" onchange="modalTextGenerator()"></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="fr_generator-text-class">Class: </label></th>
											<td><input type="text" name="class" class="classvalue oneline option" id="fr_generator-text-class" onchange="modalTextGenerator()"></td>
										</tr>

									</tbody>
								</table>
							</div>
						</div>

						<div class="modal-footer position-relative">
							<div class="position-absolute start-0 ms-3">
								<input type="text" name="text" id="fr_generatedTextShortcode" readonly="readonly" style="width:365px" value="[input]" >
							</div>
							<div>
								<button type="button" id="fr_submit_text" class="btn btn-primary wp-blue">Finish</button>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Modal Button: Email -->
			<button type="button" name="button_email" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#fr_modal_email"> Email </button>
			<!-- Modal Form Tag Generator: Email -->
			<div class="modal fade" id="fr_modal_email" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="fr_exampleModalLabel">Form Tag Generator: Email</h5>
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
												<label><input type="checkbox" id="fr_generator-email-required" name="required" onclick="modalEmailGenerator()"> Required field</label>
												</fieldset>
											</td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="fr_generator-email-label">Label: </label></th>
											<td ><input type="text" name="label" class="tg-name oneline" id="fr_generator-email-label" onchange="modalEmailGenerator()"></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="fr_generator-email-name">Name<span class="text-primary">*</span>: </label></th>
											<td><input type="text" name="name" class="tg-name oneline" id="fr_generator-email-name" onchange="modalEmailGenerator()"></br>
											<span id ="requiredNameEmail" class="text-danger fst-italic" style="font-size: 12px;" hidden>*This field is required</span></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="fr_generator-email-value">Value: </label></th>
											<td><input type="text" name="value" class="oneline" id="fr_generator-email-value" onchange="modalEmailGenerator()"></td>
										</tr>

										<tr>
											<td></td>
											<td class="pt-n3"><input type="checkbox" id="fr_generator-email-placeholder" name="placeholder" class="option" onclick="modalEmailGenerator()"><label for="fr_generator-email-placeholder">Use this text as placeholder for the field.</label></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="fr_generator-email-id">ID: </label></th>
											<td><input type="text" name="id" class="idvalue oneline option" id="fr_generator-email-id" onchange="modalEmailGenerator()"></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="fr_generator-email-class">Class: </label></th>
											<td><input type="text" name="class" class="classvalue oneline option" id="fr_generator-email-class" onchange="modalEmailGenerator()"></td>
										</tr>

									</tbody>
								</table>
							</div>
						</div>

						<div class="modal-footer position-relative">
							<div class="position-absolute start-0 ms-3">
								<input type="text" name="text" id="fr_generatedEmailShortcode" readonly="readonly" style="width:365px" value="[input]" >
							</div>
							<div>
								<button type="button" id="fr_submit_email"class="btn btn-primary wp-blue">Finish</button>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Modal Button: Textarea -->
			<button type="button" name="button_zone_de_text" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#fr_modal_textarea"> Text area </button>
			<!-- Modal Form Tag Generator: Textarea -->
			<div class="modal fade" id="fr_modal_textarea" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="fr_exampleModalLabel">Form Tag Generator: Text area</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">

							<div class="d-flex align-items-center ms-4">
							<div class="col-6 mb-3">
								<div class="input-group" style="width:10em;">
									<span class="input-group-text" id="input-cols" style="font-size: 100%;"><strong>Columns:</strong></span>
									<input type="number" name="cols" class="form-control form-control-sm small-input" id="fr_generator-textarea-cols" min="0" max="50" value="0" onchange="modalTextareaGenerator()">
								</div>
								</div>
								<div class="col-6 mb-3">
									<div class="input-group" style="width:8em;">
										<span class="input-group-text" id="input-rows" style="font-size: 100%;"><strong>Rows:</strong></span>
										<input type="number" name="rows" class="form-control form-control-sm small-input" id="fr_generator-textarea-rows" min="0" max="50" value="0" onchange="modalTextareaGenerator()">
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
												<label><input type="checkbox" id="fr_generator-textarea-required" name="required" onclick="modalTextareaGenerator()"> Required field</label>
											</td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="fr_generator-textarea-label">Label: </label></th>
											<td><input type="text" name="label" class="tg-name oneline" id="fr_generator-textarea-label" onchange="modalTextareaGenerator()"></td>
										</tr>
										
										<tr>
											<th class="text-end" scope="row"><label for="fr_generator-textarea-name">Name<span class="text-primary">*</span>: </label></th>
											<td><input type="text" name="name" class="tg-name oneline" id="fr_generator-textarea-name" onchange="modalTextareaGenerator()"></br>
											<span id ="requiredNameTextarea" class="text-danger fst-italic" style="font-size: 12px;" hidden>*This field is required</span></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="fr_generator-textarea-value">Value: </label></th>
											<td><input type="text" name="value" class="oneline" id="fr_generator-textarea-value" onchange="modalTextareaGenerator()"></td>
										</tr>

										<tr>
											<td></td>
											<td class="pt-n3"><input type="checkbox" id="fr_generator-textarea-placeholder" name="placeholder" class="option" onclick="modalTextareaGenerator()"><label for="fr_generator-textarea-placeholder">Use this text as placeholder for the field.</label></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="fr_generator-textarea-id">ID: </label></th>
											<td><input type="text" name="id" class="idvalue oneline option" id="fr_generator-textarea-id" onchange="modalTextareaGenerator()"></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="fr_generator-textarea-class">Class: </label></th>
											<td><input type="text" name="class" class="classvalue oneline option" id="fr_generator-textarea-class" onchange="modalTextareaGenerator()"></td>
										</tr>

									</tbody>
								</table>
							</div>
						</div>

						<div class="modal-footer position-relative">
							<div class="position-absolute start-0 ms-3">
								<input type="text" name="text" id="fr_generatedTextareaShortcode" readonly="readonly" style="width:365px" value="[input]" >
							</div>
							<div>
								<button type="button" id="fr_submit_textarea" class="btn btn-primary wp-blue">Finish</button>
							</div>
						</div>
						<style>input[type=number]::-webkit-inner-spin-button { opacity: 1}</style>
					</div>
				</div>
			</div>

			<!-- Modal Button: Tel -->
			<button type="button" name="button_tel" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#fr_modal_tel"> Phone </button>
			<!-- Modal Form Tag Generator: Tel -->
			<div class="modal fade" id="fr_modal_tel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="fr_exampleModalLabel">Form Tag Generator: Tel</h5>
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
												<label><input type="checkbox"  id="fr_generator-tel-required"name="required" onclick="modalTelGenerator()">Required field</label>
												</fieldset>
											</td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="fr_generator-tel-label">Label: </label></th>
											<td ><input type="text" name="label" class="tg-name oneline" id="fr_generator-tel-label" onchange="modalTextGenerator()"></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="fr_generator-tel-name">Name<span class="text-primary">*</span>: </label></th>
											<td><input type="text" name="name" class="tg-name oneline" id="fr_generator-tel-name" onchange="modalTelGenerator()"></br>
											<span id ="requiredNameTel" class="text-danger fst-italic" style="font-size: 12px;" hidden>*This field is required</span></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="fr_generator-tel-value">Value: </label></th>
											<td><input type="text" name="value" class="oneline" id="fr_generator-tel-value" onchange="modalTelGenerator()"></td>
										</tr>

										<tr>
											<td></td>
											<td class="pt-n3"><input type="checkbox" id="fr_generator-tel-placeholder" name="placeholder" class="option" onclick="modalTelGenerator()"><label for="fr_generator-tel-placeholder">Use this text as placeholder for the field.</label></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="fr_generator-tel-id">ID: </label></th>
											<td><input type="text" name="id" class="idvalue oneline option" id="fr_generator-tel-id" onchange="modalTelGenerator()"></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="fr_generator-tel-class">Class: </label></th>
											<td><input type="text" name="class" class="classvalue oneline option" id="fr_generator-tel-class" onchange="modalTelGenerator()"></td>
										</tr>

									</tbody>
								</table>
							</div>
						</div>

						<div class="modal-footer position-relative">
							<div class="position-absolute start-0 ms-3">
								<input type="text" name="text" id="fr_generatedTelShortcode" readonly="readonly" style="width:365px" value="[input]" >
							</div>
							<div>
								<button type="button" id="fr_submit_tel" class="btn btn-primary wp-blue">Finish</button>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Modal Button: Dropdown Menu -->
			<button type="button" name="button_menu_deroulant" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#fr_modalMenu" disabled> Dropdown menu </button>

			<!-- Modal Button: Checkbox -->
			<button type="button" name="button_cases_a_cocher"class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#fr_modalCase" disabled> Checkbox </button>

			<!-- Modal Button: Radio Button -->
			<button type="button" name="button_boutons_radio" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#fr_modalRadio" disabled> Radio button </button>

			<!-- Modal Button: Date -->
			<button type="button" name="button_date" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#fr_modalDate" disabled> Date </button>
			
			<!-- Modal Button: File -->
			<button type="button" name="button_fichier" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#fr_modalFichier" disabled> File </button>

			<!-- Modal Button: Submit -->
			<button type="button" name="fr_button_modal_submit" id="fr_button_modal_submit" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#fr_button_modal_submit_content"> Submit </button>
			<!-- Modal Form Tag Generator: Submit -->
			<div class="modal fade" id="fr_button_modal_submit_content" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-sm modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="fr_exampleModalLabel">Form Submit Settings</h5>
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
													<?php if( ($wp_stored_meta['fr_whatsapp_switch'][0]) == 1 ){ ?>
														<label for="fr_whatsapp_submit" class="d-block mb-1" size="30"><strong>Whatsapp submit button: </strong></label>
														<input type="text" name="fr_whatsapp_submit" id="fr_whatsapp_submit" size="19" value="<?php if (!empty($wp_stored_meta['fr_whatsapp_submit'])) echo esc_attr($wp_stored_meta['fr_whatsapp_submit'][0]); ?>"></br>
														<div class="my-2">
															<input type="color" name="fr_whatsapp_text_color" id="fr_whatsapp_text_color" value="<?php if (!empty($wp_stored_meta['fr_whatsapp_text_color'])) echo esc_attr($wp_stored_meta['fr_whatsapp_text_color'][0]); ?>" class="color me-2">
															<input type="text" id="fr_color_text_code_whatsapp" size="9" oninput="updateColorPickerWhatsappText()" maxlength="7" placeholder="HEX code">
														</div>
														<script>
															// Get input elements
															var colorPickerInputWhatsappText = document.getElementById('fr_whatsapp_text_color');
															var colorTextInputWhatsappText = document.getElementById('fr_color_text_code_whatsapp');

															// Function to update the color picker input based on the text input
															function updateColorPickerWhatsappText() {
																var colorValue = colorTextInputWhatsappText.value.trim();

																// Check if the entered value is a valid HEX code
																if (colorValue.length <= 7 && /^#([0-9A-F]{3}){1,2}$/i.test(colorValue)) {
																	colorPickerInputWhatsappText.value = colorValue;
																}
															}

															// Function to update the text input based on the color picker input
															function updateTextColorWhatsappText() {
																colorTextInputWhatsappText.value = colorPickerInputWhatsappText.value;
															}

															// Call the functions on page load
															document.addEventListener('DOMContentLoaded', function () {
																updateColorPickerWhatsappText();
																updateTextColorWhatsappText();
															});

															// Listen for change events on the color picker input
															colorPickerInputWhatsappText.addEventListener('input', function () {
																updateTextColorWhatsappText();
															});
														</script>
														<label for="fr_color_code_whatsapp"class="d-block mb-1"><strong>Button color:</strong></label>
														<input type="color" name="fr_whatsapp_submit_color" id="fr_whatsapp_submit_color" value="<?php if (!empty($wp_stored_meta['fr_whatsapp_submit_color'])) echo esc_attr($wp_stored_meta['fr_whatsapp_submit_color'][0]); ?>" class="color me-2">
														<input type="text" id="fr_color_code_whatsapp" size="9" oninput="updateColorPickerWhatsapp()" maxlength="7" placeholder="HEX code">
														<script>
															// Get input elements
															var colorPickerInputWhatsapp = document.getElementById('fr_whatsapp_submit_color');
															var colorTextInputWhatsapp = document.getElementById('fr_color_code_whatsapp');

															// Function to update the color picker input based on the text input
															function updateColorPickerWhatsapp() {
																var colorValue = colorTextInputWhatsapp.value.trim();

																// Check if the entered value is a valid HEX code
																if (colorValue.length <= 7 && /^#([0-9A-F]{3}){1,2}$/i.test(colorValue)) {
																	colorPickerInputWhatsapp.value = colorValue;
																}
															}

															// Function to update the text input based on the color picker input
															function updateTextColorWhatsapp() {
																colorTextInputWhatsapp.value = colorPickerInputWhatsapp.value;
															}

															// Call the functions on page load
															document.addEventListener('DOMContentLoaded', function () {
																updateColorPickerWhatsapp();
																updateTextColorWhatsapp();
															});

															// Listen for change events on the color picker input
															colorPickerInputWhatsapp.addEventListener('input', function () {
																updateTextColorWhatsapp();
															});
														</script>
													<?php }else{?>
														<label for="fr_email_submit" class="d-block mb-1"><strong>Email submit button: </strong></label>
														<input type="text" name="fr_email_submit" id="fr_email_submit" size="19" value="<?php if (!empty($wp_stored_meta['fr_email_submit'])) echo esc_attr($wp_stored_meta['fr_email_submit'][0]); ?>"></br>
														<div class="my-2">
															<input type="color" name="fr_email_text_color" id="fr_email_text_color" value="<?php if (!empty($wp_stored_meta['fr_email_text_color'])) echo esc_attr($wp_stored_meta['fr_email_text_color'][0]); ?>" class="color me-2">
															<input type="text" id="fr_color_text_code_email" size="9" oninput="updateColorPickerEmailText()" maxlength="7" placeholder="HEX code">
														</div>
														<script>
															// Get input elements
															var colorPickerInputEmailText = document.getElementById('fr_email_text_color');
															var colorTextInputEmailText = document.getElementById('fr_color_text_code_email');

															// Function to update the color picker input based on the text input
															function updateColorPickerEmailText() {
																var colorValue = colorTextInputEmailText.value.trim();

																// Check if the entered value is a valid HEX code
																if (colorValue.length <= 7 && /^#([0-9A-F]{3}){1,2}$/i.test(colorValue)) {
																	colorPickerInputEmailText.value = colorValue;
																}
															}

															// Function to update the text input based on the color picker input
															function updateTextColorEmailText() {
																colorTextInputEmailText.value = colorPickerInputEmailText.value;
															}

															// Call the functions on page load
															document.addEventListener('DOMContentLoaded', function () {
																updateColorPickerEmailText();
																updateTextColorEmailText();
															});

															// Listen for change events on the color picker input
															colorPickerInputEmailText.addEventListener('input', function () {
																updateTextColorEmailText();
															});
														</script>
														<label for="fr_color_code_email"class="d-block mb-1"><strong>Button color:</strong></label>
														<input type="color" name="fr_email_submit_color" id="fr_email_submit_color" value="<?php if (!empty($wp_stored_meta['fr_email_submit_color'])) echo esc_attr($wp_stored_meta['fr_email_submit_color'][0]); ?>" class="color me-2">
														<input type="text" id="fr_color_code_email" size="9" oninput="updateColorPickerEmail()" maxlength="7" placeholder="HEX code">
														<script>
															// Get input elements
															var colorPickerInputEmail = document.getElementById('fr_email_submit_color');
															var colorTextInputEmail = document.getElementById('fr_color_code_email');

															// Function to update the color picker input based on the text input
															function updateColorPickerEmail() {
																var colorValue = colorTextInputEmail.value.trim();

																// Check if the entered value is a valid HEX code
																if (colorValue.length <= 7 && /^#([0-9A-F]{3}){1,2}$/i.test(colorValue)) {
																	colorPickerInputEmail.value = colorValue;
																}
															}

															// Function to update the text input based on the color picker input
															function updateTextColorEmail() {
																colorTextInputEmail.value = colorPickerInputEmail.value;
															}

															// Call the functions on page load
															document.addEventListener('DOMContentLoaded', function () {
																updateColorPickerEmail();
																updateTextColorEmail();
															});

															// Listen for change events on the color picker input
															colorPickerInputEmail.addEventListener('input', function () {
																updateTextColorEmail();
															});
														</script>
													<?php }?>
													<div>
														<?php if( ($wp_stored_meta['fr_whatsapp_switch'][0]) == 1 ) { ?>
															<div class="d-block mb-1 mt-3"><strong>Button preview:</strong></div>
															<button type="button" id="fr_whatsapp_submit_result" class="btn">
																	<svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" id="fr_whatsapp_svg_result" class="bi bi-whatsapp" viewBox="0 0 16 16">
																		<path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
																	</svg>
																	<span id="fr_whatsapp_submit_text_result"></span>
															</button>
															<script>
																var button = document.getElementById('fr_whatsapp_submit_result');
																var buttonText = document.getElementById('fr_whatsapp_submit_text_result');
																var buttonTextColorInput = document.getElementById('fr_whatsapp_text_color');
																var buttonColorInput = document.getElementById('fr_whatsapp_submit_color');
																var buttonTextInput = document.getElementById('fr_whatsapp_submit');
																var buttonIconColor = document.getElementById('fr_whatsapp_svg_result');
																var modalButton = document.getElementById('fr_button_modal_submit');

																document.addEventListener('DOMContentLoaded', function () {
																	updateButton();
																});

																function updateButton() {

																	button.style.backgroundColor = buttonColorInput.value;
																	buttonText.textContent = buttonTextInput.value;
																	buttonText.style.color = buttonTextColorInput.value;
																	buttonIconColor.setAttribute('fill', buttonTextColorInput.value);
																};

																buttonColorInput.addEventListener('input', updateButton);
																buttonTextInput.addEventListener('input', updateButton);
																buttonTextColorInput.addEventListener('input', updateButton);
																modalButton.addEventListener('click', updateButton);

															</script>
														<?php };?>

														<?php if( ($wp_stored_meta['fr_whatsapp_switch'][0]) == 0 ) { ?>
															<div class="d-block mb-1 mt-3"><strong>Button preview:</strong></div>
															<button type="button" id="fr_email_submit_result" class="btn">
																	<svg xmlns="http://www.w3.org/2000/svg" id="fr_email_svg_result" width="23" height="23" class="bi bi-envelope" viewBox="0 0 16 16">
																		<path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/>
																	</svg>
																	<span  id="fr_email_submit_text_result"></span>
															</button>
															<script>
																var button = document.getElementById('fr_email_submit_result');
																var buttonText = document.getElementById('fr_email_submit_text_result');
																var buttonTextColorInput = document.getElementById('fr_email_text_color');
																var buttonColorInput = document.getElementById('fr_email_submit_color');
																var buttonTextInput = document.getElementById('fr_email_submit');
																var buttonIconColor = document.getElementById('fr_email_svg_result');

																document.addEventListener('DOMContentLoaded', function () {
																	updateButton();
																});
																buttonColorInput.addEventListener('input', updateButton);
																buttonTextInput.addEventListener('input', updateButton);
																buttonTextColorInput.addEventListener('input', updateButton);

																function updateButton() {

																	button.style.backgroundColor = buttonColorInput.value;
																	buttonText.textContent = buttonTextInput.value;
																	buttonText.style.color = buttonTextColorInput.value;
																	buttonIconColor.setAttribute('fill', buttonTextColorInput.value);
																}

															</script>
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
								<button type="button" class="btn btn-primary wp-blue" data-bs-dismiss="modal">Finish</button>
							</div>
						</div>
					</div>
				</div>
			</div> 

			<!-- Final form shortcode container -->
			<textarea style="white-space:pre-line;width:100%;" spellcheck="false" <?php if( ($wp_stored_meta['fr_whatsapp_switch'][0]) == 1 ) { ?> name="fr_whatsapp_form_content" <?php } else { ?>name="fr_email_form_content" <?php } ?> id="fr_contenu_formulaire" rows="24" class="large-tet code mt-3 code"><?php if( ($wp_stored_meta['fr_whatsapp_switch'][0]) == 1 ) { if (! empty ($wp_stored_meta['fr_whatsapp_form_content'])) echo esc_textarea ( $wp_stored_meta['fr_whatsapp_form_content'][0] ); }else{ if (! empty ($wp_stored_meta['fr_email_form_content'])) echo esc_textarea ( $wp_stored_meta['fr_email_form_content'][0] ); } ?></textarea>
			
			<div class="row mt-2">
				<?php
					$form_id = $_GET['post'];
					$form_status = get_post_status($form_id);
				?>
				
				<!-- Publish form button -->
				<?php if ($form_status !== 'publish') : ?>
					<div class="col-auto pe-0">
						<input name="original_publish" type="hidden" value="Publish">
						<input type="submit" name="publish" id="fr_publish_final" class="btn btn-success btn-sm" value="Publish">
					</div>
				<?php endif; ?>

				<!-- Save form button -->
				<div class="col-auto pe-0">
					<button type="submit" id="fr_save_final" class="btn btn-primary btn-sm wp-blue">
						Save Changes
					</button>
				</div>

				<!-- Restore default form button -->
				<div class="col-auto">
					<button type="button" id="fr_default_final" class="btn btn-secondary btn-sm" <?php if( ($wp_stored_meta['fr_whatsapp_switch'][0]) == 0 ) { ?> onclick="buttonDefaultMail()"<?php }else{?> onclick="buttonDefaultWhatsapp()" <?php } ?>>
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-counterclockwise" viewBox="0 0 16 16">
							<path fill-rule="evenodd" d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2v1z"/>
							<path d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466z"/>
						</svg> Restore default
					</button>
				</div>
			</div>


			<!-- Default Forms -->
			<input type="hidden" name="contenuFormulaireMail" value="<?php echo $wp_stored_meta['fr_email_form_default'][0];?>" />
			<input type="hidden" name="contenuFormulaireWhatsapp" value="<?php echo $wp_stored_meta['fr_whatsapp_form_default'][0];?>"/>
			<!-- Default Submit -->
			<input type="hidden" name="defaultEmailSubmitText" value="<?php echo $wp_stored_meta['fr_email_submit_text_default'][0];?>" />
			<input type="hidden" name="defaultEmailSubmitTextColor" value="<?php echo $wp_stored_meta['fr_email_submit_text_color_default'][0];?>"/>
			<input type="hidden" name="defaultEmailSubmitColor" value="<?php echo $wp_stored_meta['fr_email_submit_color_default'][0];?>" />
			<input type="hidden" name="defaultWhatsappSubmitText" value="<?php echo $wp_stored_meta['fr_whatsapp_submit_text_default'][0];?>" />
			<input type="hidden" name="defaultWhatsappSubmitTextColor" value="<?php echo $wp_stored_meta['fr_whatsapp_submit_text_color_default'][0];?>"/>
			<input type="hidden" name="defaultWhatsappSubmitColor" value="<?php echo $wp_stored_meta['fr_whatsapp_submit_color_default'][0];?>" />
		</div>

		<!-- WhatsApp tab + international number & flag -->
		<?php if( ($wp_stored_meta['fr_whatsapp_switch'][0]) == 1 ){ ?> 
			<div id="fr_email" class="tab-pane fade mt-3 container" role="tabpanel">						
				<div class="form-group">
					<label for="fr_whatsapp_tel" class="d-block mb-1"><strong>Number :</strong></label>
					<input type="tel" id="fr_whatsapp_tel" name="fr_whatsapp_tel" autocomplete="on" pattern="^[\d\u002D\u0028\u0029]*$" value="<?php if (!empty($wp_stored_meta['fr_whatsapp_tel'])) echo esc_attr($wp_stored_meta['fr_whatsapp_tel'][0]); ?>" class="form-control" />
					<span id="fr_whatsapp_message" class="text-danger hide"></span>
					<input type="hidden" id="fr_whatsapp_flag" name="fr_whatsapp_flag" value="<?php if (!empty($wp_stored_meta['fr_whatsapp_flag'])) echo esc_attr($wp_stored_meta['fr_whatsapp_flag'][0]); ?>" />
					<input type="hidden" id="fr_whatsapp_tel_international" name="fr_whatsapp_tel_international" value="<?php if (!empty($wp_stored_meta['fr_whatsapp_tel_international'])) echo esc_attr($wp_stored_meta['fr_whatsapp_tel_international'][0]); ?>" />
				</div>

				<div class="row mt-3">
					<?php
						$form_id = $_GET['post'];
						$form_status = get_post_status($form_id);
					?>
				
					<!-- Publish form button -->
					<?php if ($form_status !== 'publish') : ?>
						<div id="publishing-action" class="col-auto pe-0">
							<input name="original_publish" type="hidden" id="fr_publishFormWhatsapp" value="Publish">
							<input type="submit" name="publish" id="publish" class="btn btn-success btn-sm" value="Publish">
						</div>
					<?php endif; ?>
						
					<!-- Save form button -->
					<div class="col-auto pe-0">
						<button type="submit" id="fr_saveFormWhatsapp" style="height:min-content;" class="btn btn-primary btn-sm wp-blue">
							Save Changes
						</button>
					</div>
				</div>
				<script>
					var phoneInput = document.querySelector('#fr_whatsapp_tel');
					phoneInput.addEventListener('input', (event) => {
					var inputValue = event.target.value;
					var sanitizedValue = inputValue.replace(/[^\d()-]/g, '');
					event.target.value = sanitizedValue;
					});

					function initWhatsapp() {
						var input = document.querySelector("#fr_whatsapp_tel");
						var countryInput = document.querySelector("#fr_whatsapp_country_code");
						const msg = document.querySelector("#fr_whatsapp_message");

						// Error codes returned by getValidationError
						const errorMap = ["☓ Invalid number", "☓ Invalid country code", "☓ Too short", "☓ Too long", "☓ Invalid number"];

						window.intlTelInput(input, {
							initialCountry: '<?php if (!empty($wp_stored_meta['fr_whatsapp_flag'])) echo esc_attr($wp_stored_meta['fr_whatsapp_flag'][0]); ?>',
							separateDialCode: true,
							utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/utils.js",
							formatOnDisplay: false,
							nationalMode: true,
							preferredCountries: ['us', 'in', 'de', 'gb', 'fr'],
							hiddenInput: "fr_whatsapp_tel_international",
						});

						const reset = () => {
							input.classList.remove("error");
							msg.innerHTML = "";
							msg.classList.add("hide");
						};

						if(document.getElementById('fr_saveFormWhatsapp')){

							document.getElementById('fr_saveFormWhatsapp').addEventListener('click', function(e) {
								if (e.defaultPrevented) {
									// If the submission button has been disabled, we prevent the submission
									e.preventDefault();
								}
							});
						};

						input.addEventListener('input', () => {
							reset();
							if (input.value.trim()) {
								if (iti.isValidNumber()) {
									if(document.getElementById('fr_saveFormWhatsapp') && document.getElementById('fr_saveFormWhatsapp').disabled){
										document.getElementById('fr_saveFormWhatsapp').removeAttribute('disabled');
									};
									document.getElementById('fr_saveFormWhatsapp').style.opacity ='1';
									if(document.getElementById('fr_whatsapp_switch') && document.getElementById('fr_whatsapp_switch').disabled){
										document.getElementById('fr_whatsapp_switch').removeAttribute('disabled');
									};
									document.getElementById('fr_switch_container').style.opacity ='1';
									if(document.getElementById('fr_contact-tab') && document.getElementById('fr_contact-tab').disabled){
										document.getElementById('fr_contact-tab').removeAttribute('disabled');
									};
									document.getElementById('fr_contact-tab').style.opacity ='1';
									if(document.getElementById('fr_home-tab') && document.getElementById('fr_home-tab').disabled){
										document.getElementById('fr_home-tab').removeAttribute('disabled');
									};
									document.getElementById('fr_home-tab').style.opacity ='1';
									msg.innerHTML = "✓ Valid";
									input.style.borderColor = null;
									input.style.outlineColor = null;
									msg.classList.remove("text-danger");
									msg.classList.add("text-success");
									msg.classList.remove("hide");
								} else {
									document.getElementById('fr_saveFormWhatsapp').setAttribute('disabled', 'disabled');
									document.getElementById('fr_saveFormWhatsapp').style.opacity ='0.4';
									document.getElementById('fr_whatsapp_switch').setAttribute('disabled', 'disabled');
									document.getElementById('fr_switch_container').style.opacity ='0.4';
									document.getElementById('fr_contact-tab').setAttribute('disabled', 'disabled');
									document.getElementById('fr_contact-tab').style.opacity ='0.4';
									document.getElementById('fr_home-tab').setAttribute('disabled', 'disabled');
									document.getElementById('fr_home-tab').style.opacity ='0.4';
									input.classList.add("error");
									input.style.borderColor = "red";
									input.style.outlineColor = "red";
									const errorCode = iti.getValidationError();
									msg.innerHTML = errorMap[errorCode];
									msg.classList.remove("text-success");
									msg.classList.add("text-danger");
									msg.classList.remove("hide");
								}
							}
						});

						input.addEventListener('click', () => {
							reset();
							if (input.value.trim()) {
								if (iti.isValidNumber()) {
									if(document.getElementById('fr_saveFormWhatsapp') && document.getElementById('fr_saveFormWhatsapp').disabled){
										document.getElementById('fr_saveFormWhatsapp').removeAttribute('disabled');
									};
									document.getElementById('fr_saveFormWhatsapp').style.opacity ='1';
									if(document.getElementById('fr_whatsapp_switch') && document.getElementById('fr_whatsapp_switch').disabled){
										document.getElementById('fr_whatsapp_switch').removeAttribute('disabled');
									};
									document.getElementById('fr_switch_container').style.opacity ='1';
									if(document.getElementById('fr_contact-tab') && document.getElementById('fr_contact-tab').disabled){
										document.getElementById('fr_contact-tab').removeAttribute('disabled');
									};
									document.getElementById('fr_contact-tab').style.opacity ='1';
									if(document.getElementById('fr_home-tab') && document.getElementById('fr_home-tab').disabled){
										document.getElementById('fr_home-tab').removeAttribute('disabled');
									};
									document.getElementById('fr_home-tab').style.opacity ='1';
									msg.innerHTML = "✓ Valid";
									input.style.borderColor = null;
									input.style.outlineColor = null;
									msg.classList.remove("text-danger");
									msg.classList.add("text-success");
									msg.classList.remove("hide");
								} else {
									document.getElementById('fr_saveFormWhatsapp').setAttribute('disabled', 'disabled');
									document.getElementById('fr_saveFormWhatsapp').style.opacity ='0.4';
									document.getElementById('fr_whatsapp_switch').setAttribute('disabled', 'disabled');
									document.getElementById('fr_switch_container').style.opacity ='0.4';
									document.getElementById('fr_contact-tab').setAttribute('disabled', 'disabled');
									document.getElementById('fr_contact-tab').style.opacity ='0.4';
									document.getElementById('fr_home-tab').setAttribute('disabled', 'disabled');
									document.getElementById('fr_home-tab').style.opacity ='0.4';
									input.classList.add("error");
									input.style.borderColor = "red";
									input.style.outlineColor = "red";
									const errorCode = iti.getValidationError();
									msg.innerHTML = errorMap[errorCode];
									msg.classList.remove("text-success");
									msg.classList.add("text-danger");
									msg.classList.remove("hide");
								}
							}
						});

						document.querySelector('#fr_profile-tab').addEventListener('click', () => {
							reset();
							if (input.value.trim()) {
								if (iti.isValidNumber()) {
									if(document.getElementById('fr_saveFormWhatsapp') && document.getElementById('fr_saveFormWhatsapp').disabled){
										document.getElementById('fr_saveFormWhatsapp').removeAttribute('disabled');
									};
									document.getElementById('fr_saveFormWhatsapp').style.opacity ='1';
									if(document.getElementById('fr_whatsapp_switch') && document.getElementById('fr_whatsapp_switch').disabled){
										document.getElementById('fr_whatsapp_switch').removeAttribute('disabled');
									};
									document.getElementById('fr_switch_container').style.opacity ='1';
									if(document.getElementById('fr_contact-tab') && document.getElementById('fr_contact-tab').disabled){
										document.getElementById('fr_contact-tab').removeAttribute('disabled');
									};
									document.getElementById('fr_contact-tab').style.opacity ='1';
									if(document.getElementById('fr_home-tab') && document.getElementById('fr_home-tab').disabled){
										document.getElementById('fr_home-tab').removeAttribute('disabled');
									};
									document.getElementById('fr_home-tab').style.opacity ='1';
									msg.innerHTML = "✓ Valid";
									input.style.borderColor = null;
									input.style.outlineColor = null;
									msg.classList.remove("text-danger");
									msg.classList.add("text-success");
									msg.classList.remove("hide");
								} else {
									document.getElementById('fr_saveFormWhatsapp').setAttribute('disabled', 'disabled');
									document.getElementById('fr_saveFormWhatsapp').style.opacity ='0.4';
									document.getElementById('fr_whatsapp_switch').setAttribute('disabled', 'disabled');
									document.getElementById('fr_switch_container').style.opacity ='0.4';
									document.getElementById('fr_contact-tab').setAttribute('disabled', 'disabled');
									document.getElementById('fr_contact-tab').style.opacity ='0.4';
									document.getElementById('fr_home-tab').setAttribute('disabled', 'disabled');
									document.getElementById('fr_home-tab').style.opacity ='0.4';
									input.classList.add("error");
									input.style.borderColor = "red";
									input.style.outlineColor = "red";
									const errorCode = iti.getValidationError();
									msg.innerHTML = errorMap[errorCode];
									msg.classList.remove("text-success");
									msg.classList.add("text-danger");
									msg.classList.remove("hide");
								}
							}
						});

						var iti = window.intlTelInputGlobals.getInstance(input);

						// Save the selected flag value
						document.querySelector('#fr_whatsapp_tel').addEventListener('countrychange', function() {
							document.querySelector('#fr_whatsapp_flag').value = iti.getSelectedCountryData().iso2;
						});

						// Save the phone number in international format
						document.querySelector('#fr_whatsapp_tel').addEventListener('blur', function() {
							document.querySelector('#fr_whatsapp_tel_international').value = iti.getNumber();
						});
					}

					jQuery(document).ready(function() {
							initWhatsapp();
					});
				</script>
			</div>
			
		<?php }else{?>
		<!-- Mail tab construction -->
			<style>
				body {
				overflow-y: scroll;
				scrollbar-width: none; /* Firefox */
				-ms-overflow-style: none; /* Internet Explorer 10+ */
				}

				body::-webkit-scrollbar {
				width: 0px; /* Safari and Chrome */
				height: 0px;
				}
			</style>
			<div id="fr_email" class="tab-pane fade mt-3 container" role="tabpanel">
				<div class="row">
					<div class="col-xl-10 col-lg-10 col-md-10 col-xs-12 col-sm-12">
							<div class="alert alert-primary d-flex align-items-center text-primary" role="alert" style="margin-right:auto;">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" role="img" fill="#2271b1" class="bi bi-info-circle" viewBox="0 0 16 16">
									<path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
								</svg>
								<div class="ms-2">
									If you named your inputs 'email' and 'message,' you need to write <strong>[email]</strong> and <strong>[message]</strong> to retrieve the user's information.</br>You can also send emails to multiple addresses by separating them with a <strong>comma</strong>.
								</div>
							</div>
					</div>
				</div>


				<div class="form-group">
					<label for="fr_email_admin_to"><strong>To</strong></label><br>
					<input type="text" name="fr_email_admin_to" id="fr_email_admin_to" class="large-text code" value="<?php if (! empty ($wp_stored_meta['fr_email_admin_to'])) echo esc_attr ( $wp_stored_meta['fr_email_admin_to'][0] ); ?>"/>
					
					<label for="fr_email_admin_from"><strong>From</strong></label>
					<input type="text" name="fr_email_admin_from" id="fr_email_admin_from" class="large-text code" value="<?php if (! empty ($wp_stored_meta['fr_email_admin_from'])) echo esc_attr ( $wp_stored_meta['fr_email_admin_from'][0] ); ?>"/>
					
					<label for="fr_email_admin_subject" ><strong>Subject</strong></label>
					<input type="text" name="fr_email_admin_subject" id="fr_email_admin_subject" class="large-text code" value="<?php if (! empty ($wp_stored_meta['fr_email_admin_subject'])) echo esc_attr ( $wp_stored_meta['fr_email_admin_subject'][0] ); ?>"/>
					
					<label for="fr_email_admin_content"><strong>Message content</strong></label>
					<textarea cols="100" rows="18" name="fr_email_admin_content" id="fr_email_admin_content" class="large-text code"><?php if (! empty ($wp_stored_meta['fr_email_admin_content'])) echo esc_attr ( $wp_stored_meta['fr_email_admin_content'][0] ); ?></textarea>
				</div>
				
				<div class="ms-auto d-flex align-items-center">
					<input  type="checkbox" id="fr_user_email_switch" name="fr_user_email_switch" class="me-0 mt-1"<?php if($wp_stored_meta['fr_user_email_switch'][0] == 1){?>checked<?php };?>/>
					<label  for="fr_user_email_switch" class="ms-0 mt-1"><h2>Enable the autoresponder</h2></label>
				</div>

				<div class="form-group" id="fr_user_email">
					<label for="fr_email_user_to"><strong>To</strong></label><br>
					<input type="text" name="fr_email_user_to" id="fr_email_user_to" class="large-text code" value="<?php if (! empty ($wp_stored_meta['fr_email_user_to'])) echo esc_attr ( $wp_stored_meta['fr_email_user_to'][0] ); ?>"/>
					
					<label for="fr_email_user_from"><strong>From</strong></label>
					<input type="text" name="fr_email_user_from" id="fr_email_user_from" class="large-text code" value="<?php if (! empty ($wp_stored_meta['fr_email_user_from'])) echo esc_attr ( $wp_stored_meta['fr_email_user_from'][0] ); ?>"/>
					
					<label for="fr_email_user_subject" ><strong>Subject</strong></label>
					<input type="text" name="fr_email_user_subject" id="fr_email_user_subject" class="large-text code" value="<?php if (! empty ($wp_stored_meta['fr_email_user_subject'])) echo esc_attr ( $wp_stored_meta['fr_email_user_subject'][0] ); ?>"/>
					
					<label for="fr_email_user_content"><strong>Message content</strong></label>
					<textarea cols="100" rows="18" name="fr_email_user_content" id="fr_email_user_content" class="large-text code"><?php if (! empty ($wp_stored_meta['fr_email_user_content'])) echo esc_attr ( $wp_stored_meta['fr_email_user_content'][0] ); ?></textarea>
				</div>

				<script>
					const checkbox = document.getElementById("fr_user_email_switch");
					var maDiv = document.getElementById("fr_user_email");
						if (checkbox.checked == true){
							maDiv.style.display = "block";
						} else {
							maDiv.style.display = "none";
						}
					checkbox.addEventListener('input', function() {
						var maDiv = document.getElementById("fr_user_email");
						if (checkbox.checked == true){
							maDiv.style.display = "block";
						} else {
							maDiv.style.display = "none";
						}
					});
				</script>
				<div class="row mt-2">
					<?php
						$form_id = $_GET['post'];
						$form_status = get_post_status($form_id);
					?>
					
					<!-- Publish form button -->
					<?php if ($form_status !== 'publish') : ?>
						<div id="publishing-action" class="col-auto pe-0">
							<input name="original_publish" type="hidden" id="fr_publish_email" value="Publish">
							<input type="submit" name="publish" id="publish" class="btn btn-success btn-sm" value="Publish">
						</div>
					<?php endif; ?>

					<!-- Save form button -->
					<div class="col-auto pe-0">
						<button type="submit" id="fr_save_email" style="height:min-content;" class="btn btn-primary btn-sm wp-blue">
							Save Changes
						</button>
					</div>

					<!-- Restore default form button -->
					<div class="col-auto">
						<button type="button" id="fr_default_email" style="height:min-content;" class="btn btn-secondary btn-sm" <?php if( ($wp_stored_meta['fr_whatsapp_switch'][0]) == 0 ) { ?> onclick="buttonDefaultEmailSending()"<?php }?>>
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-counterclockwise" viewBox="0 0 16 16">
								<path fill-rule="evenodd" d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2v1z"/>
								<path d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466z"/>
							</svg> Restore default
						</button>
					</div>

					<!-- Default values -->
					<input type="hidden" name="defaultEmailAdminTo" value="<?php echo $wp_stored_meta['fr_email_admin_to_default'][0];?>" />
					<input type="hidden" name="defaultEmailAdminFrom" value="<?php echo $wp_stored_meta['fr_email_admin_from_default'][0];?>"/>
					<input type="hidden" name="defaultEmailAdminSubject" value="<?php echo $wp_stored_meta['fr_email_admin_subject_default'][0];?>" />
					<input type="hidden" name="defaultEmailAdminContent" value="<?php echo $wp_stored_meta['fr_email_admin_content_default'][0];?>"/>

					<input type="hidden" name="defaultEmailUserTo" value="<?php echo $wp_stored_meta['fr_email_user_to_default'][0];?>" />
					<input type="hidden" name="defaultEmailUserFrom" value="<?php echo $wp_stored_meta['fr_email_user_from_default'][0];?>"/>
					<input type="hidden" name="defaultEmailUserSubject" value="<?php echo $wp_stored_meta['fr_email_user_subject_default'][0];?>" />
					<input type="hidden" name="defaultEmailUserContent" value="<?php echo $wp_stored_meta['fr_email_user_content_default'][0];?>"/>
				</div>
			</div>

		<?php } ?>
		<!-- Success and Error messages-->
		<div id="fr_message" class="tab-pane fade mt-3 container" role="tabpanel">
			<div class="mb-3 col-xl-8 col-lg-8 col-md-8 col-xs-12 col-sm-12">
				<label for="<?php if ($wp_stored_meta['fr_whatsapp_switch'][0] == 1){?>fr_whatsapp_success<?php }else{?>fr_email_success<?php }?>" class="form-label"><strong>The user's message has been sent successfully:</strong></label>
				<div class="alert alert-success">
					<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
						<path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
					</svg>
					<?php if ($wp_stored_meta['fr_whatsapp_switch'][0] == 1){?> <input type="text" name="fr_whatsapp_success" id="fr_whatsapp_success" class="large-text w-75" style="background-color: transparent;" value="<?php if (! empty ($wp_stored_meta['fr_whatsapp_success'])) echo esc_attr ( $wp_stored_meta['fr_whatsapp_success'][0] );?>"/><?php }else{
					?> <input type="text" name="fr_email_success" id="fr_email_success" class="large-text w-75" style="background-color: transparent;" value="<?php if (! empty ($wp_stored_meta['fr_email_success'])) echo esc_attr ( $wp_stored_meta['fr_email_success'][0] );?>"/><?php };?>
				</div>
			</div>

			<div class="mb-3 col-xl-8 col-lg-8 col-md-8 col-xs-12 col-sm-12">
				<label for="<?php if ($wp_stored_meta['fr_whatsapp_switch'][0] == 1){?>fr_whatsapp_error<?php }else{?>fr_email_error<?php }?>" class="form-label"><strong>The user's message could not be sent:</strong></label>
				<div class="alert alert-danger">
					<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
						<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
					</svg>
					<?php if ($wp_stored_meta['fr_whatsapp_switch'][0] == 1){?> <input type="text" name="fr_whatsapp_error" id="fr_whatsapp_error" class="large-text w-75" style="background-color: transparent;" value="<?php if (! empty ($wp_stored_meta['fr_whatsapp_error'])) echo esc_attr ( $wp_stored_meta['fr_whatsapp_error'][0] );?>"/><?php };?>
					<?php if ($wp_stored_meta['fr_whatsapp_switch'][0] == 0){?> <input type="text" name="fr_email_error" id="fr_email_error" class="large-text w-75" style="background-color: transparent;" value="<?php if (! empty ($wp_stored_meta['fr_email_error'])) echo esc_attr ( $wp_stored_meta['fr_email_error'][0] );?>"/><?php };?>
				</div>
			</div>
			<div class="row mt-2">
				<?php
					$form_id = $_GET['post'];
					$form_status = get_post_status($form_id);
				?>
				
				<!-- Publish form button -->
				<?php if ($form_status !== 'publish') : ?>
					<div id="publishing-action" class="col-auto pe-0">
						<input name="original_publish" type="hidden" id="fr_publish_messages" value="Publish">
						<input type="submit" name="publish" id="publish" class="btn btn-success btn-sm" value="Publish">
					</div>
				<?php endif; ?>

				<!-- Save form button -->
				<div class="col-auto pe-0">
					<button type="submit" id="fr_save_messages" style="height:min-content;" class="btn btn-primary btn-sm wp-blue">
						Save Changes
					</button>
				</div>

				<!-- Restore default form button -->
				<div class="col-auto">
					<button type="button" id="fr_default_messages" style="height:min-content;" class="btn btn-secondary btn-sm" <?php if( ($wp_stored_meta['fr_whatsapp_switch'][0]) == 0 ) { ?> onclick="buttonDefaultEmailMessages()"<?php }else{?> onclick="buttonDefaultWhatsappMessages()" <?php } ?>>
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-counterclockwise" viewBox="0 0 16 16">
							<path fill-rule="evenodd" d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2v1z"/>
							<path d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466z"/>
						</svg> Restore default
					</button>
				</div>

				<!-- Default Forms -->
				<input type="hidden" name="buttonDefaultEmailSuccess" value="<?php echo $wp_stored_meta['fr_email_success_default'][0];?>" />
				<input type="hidden" name="buttonDefaultEmailError" value="<?php echo $wp_stored_meta['fr_email_error_default'][0];?>"/>
				<input type="hidden" name="buttonDefaultWhatsappSuccess" value="<?php echo $wp_stored_meta['fr_whatsapp_success_default'][0];?>" />
				<input type="hidden" name="buttonDefaultWhatsappError" value="<?php echo $wp_stored_meta['fr_whatsapp_error_default'][0];?>"/>
			</div>
		</div>

		<!-- Flyout menu -->
		<script src="https://use.fontawesome.com/4630774b91.js"></script>

		<button type="button" class="flyout-button"></button>

		<div class="flyout-menu" style="display:none;">
			<a style="transform: scale(0); opacity:0;" href="https://form-reach.com/documentation" title="Documentation" target="_blank"><i class="fa fa-book"  aria-hidden="true"></i></a>
			<a style="transform: scale(0); opacity:0;" href="https://form-reach.com/suggestion" title="Suggestion" target="_blank"><i class="fa fa-lightbulb-o"  aria-hidden="true"></i></a>
		<a style="transform: scale(0); opacity:0;" href="https://form-reach.com/support" title="Support" target="_blank"><i class="fa fa-life-ring" aria-hidden="true"></i></a>
		</div>

		<script>
		let flyoutButton = document.querySelector(".flyout-button");
		let flyoutMenu = document.querySelector(".flyout-menu");
		let menuOpen = false;

		flyoutButton.addEventListener("click", () => {
			if (!menuOpen) {
				flyoutButton.style.pointerEvents = "none";
				flyoutMenu.style.display = "block";
				flyoutMenu.querySelectorAll("a").forEach((a, index) => {
					setTimeout(() => {
						a.style.transition = "transform .4s cubic-bezier(0.680, -0.550, 0.265, 1.550), opacity .4s cubic-bezier(0.680, -0.550, 0.265, 1.550)";
						a.style.transform = "scale(1)";
						a.style.opacity = "1";
					}, (2 - index) * 30);
				});
				setTimeout(() => {
					flyoutButton.style.pointerEvents = "auto";
				}, (2 + 1) * 30);
				menuOpen = true;
			} else {
				flyoutButton.style.pointerEvents = "none";
				flyoutMenu.querySelectorAll("a").forEach((a, index) => {
					setTimeout(() => {
						a.style.transition = "transform .4s cubic-bezier(0.680, -0.550, 0.265, 1.550), opacity .4s cubic-bezier(0.680, -0.550, 0.265, 1.550)";
						a.style.transform = "scale(0)";
						a.style.opacity = "0";
					}, index * 30);
				});
				setTimeout(() => {
					flyoutMenu.style.display = "none";
					flyoutButton.style.pointerEvents = "auto";
				}, (2 + 1) * 100);
				menuOpen = false;
			}
		});
		</script>

	</div>
</section>