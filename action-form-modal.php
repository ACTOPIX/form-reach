<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/css/intlTelInput.css">
<link rel="stylesheet" href="<?php echo plugin_dir_url(__FILE__); ?>style/action-form.css">
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/intlTelInput.min.js"></script>
<script src="<?php echo plugin_dir_url(__FILE__); ?>js/action-form-admin.js"></script>
<script src="<?php echo plugin_dir_url(__FILE__); ?>js/wp-action-form.js"></script>

<section onload="modalTextGenerator(),modalTextareaGenerator(),modalEmailGenerator(),modalTelGenerator()">

	<div class="tab-content" id="wpaf_myTabContent">
		<ul class="nav nav-tabs" id="wpaf_myTab" role="tablist">
			<li class="nav-item" role="presentation">
				<button class="nav-link active" id="wpaf_home-tab" data-bs-toggle="tab" data-bs-target="#wpaf_formulaire" type="button" role="tab" aria-controls="home" aria-selected="true">Form</button>
			</li>
			<li class="nav-item" role="presentation">
				<button class="nav-link" id="wpaf_profile-tab" data-bs-toggle="tab" data-bs-target="#wpaf_email" type="button" role="tab" aria-controls="profile" aria-selected="false"><?php if( ($wp_stored_meta['wpaf_whatsapp_switch'][0]) == 1 ) { ?>WhatsApp<?php }else{?> Email<?php } ?></button>
			</li>
			<li class="nav-item" role="presentation">
				<button class="nav-link" id="wpaf_contact-tab" data-bs-toggle="tab" data-bs-target="#wpaf_message" type="button" role="tab" aria-controls="contact" aria-selected="false">Message</button>
			</li>
			<li class="ms-auto d-flex align-items-center">
				<!-- Email Icon -->
				<svg id="wpaf_mail_iconsvg" id="wpaf_mail_iconsvg" xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="<?php if( ($wp_stored_meta['wpaf_whatsapp_switch'][0]) == 0 ) { ?> #0d6efd <?php }else{ ?> #a4a4a4a4 <?php } ?>" class="bi bi-envelope me-2" viewBox="0 0 16 16"><path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/></svg>
				
				<!-- Toggle button to switch WhatsApp form -->
				<input type="checkbox" name="wpaf_whatsapp_switch" id="wpaf_whatsapp_switch" class="slider-input-whatsapp position-absolute" <?php if( ($wp_stored_meta['wpaf_whatsapp_switch'][0]) == 1 ) { ?>checked="checked"<?php }else{?><?php } ?> /><label id="wpaf_whatsapp_label" for="wpaf_whatsapp_switch" class="slider-label-whatsapp">Toggle</label>
				
				<!-- WhatsApp Icon -->
				<svg id="wpaf_whatsapp_iconsvg" xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="<?php if( ($wp_stored_meta['wpaf_whatsapp_switch'][0]) == 1 ) { ?> #25d366 <?php }else{ ?> #a4a4a4a4 <?php } ?>" class="bi bi-whatsapp ms-2" viewBox="0 0 16 16"><path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/></svg>
			</li>
		</ul>

		<!-- Adds animation to whatsapp tab when the tel is missing -->
			<script>
				document.addEventListener('DOMContentLoaded', function() {
					var inputWhatsapp = document.getElementById('wpaf_whatsapp_tel');
					var element = document.getElementById('wpaf_profile-tab');
					if(inputWhatsapp){
						if (inputWhatsapp.value === '') {
							element.classList.add('missing-information');
						}else {
							element.classList.remove('missing-information');
						};

						inputWhatsapp.addEventListener('input', function() {
							if (inputWhatsapp.value !== '') {
								element.classList.remove('missing-information');
							}else {
								element.classList.add('missing-information');
							}
						});
					}
					
				});
			</script>
			<!-- Adds animation to email tab when the email is missing -->
			<script>
			document.addEventListener('DOMContentLoaded', function() {
				var inputEmail = document.getElementById('wpaf_email_admin_to');
				var element = document.getElementById('wpaf_profile-tab');
				if (inputEmail){
					if (inputEmail.value === '') {
						element.classList.add('missing-information');
					}else {
						element.classList.remove('missing-information');
					};

					inputEmail.addEventListener('input', function() {
						if (inputEmail.value !== '') {
							element.classList.remove('missing-information');
						}else {
							element.classList.add('missing-information');
						}
					});
				}
				
			});
			</script>

		<!-- Creation of containers for the content associated with tabs -->
		<div id="wpaf_formulaire" class="tab-pane fade show active mt-3 container" role="tabpanel">

			<!-- Modal Button: Text -->
			<button type="button" name="button_text" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#wpaf_modal_text">Text</button>
			<!-- Modal Form Tag Generator: Text -->
			<div class="modal fade" id="wpaf_modal_text" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="wpaf_exampleModalLabel">Form Tag Generator: Text</h5>
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
													<label><input type="checkbox" id="wpaf_generator-text-required" name="required" onclick="modalTextGenerator()"> Required field</label>
												</fieldset>
											</td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="wpaf_generator-text-label">Label: </label></th>
											<td ><input type="text" name="label" class="tg-name oneline" id="wpaf_generator-text-label" onchange="modalTextGenerator()"></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="wpaf_generator-text-name"><span class="text-primary">*</span>Name: </label></th>
											<td><input type="text" name="name" class="tg-name oneline" id="wpaf_generator-text-name" onchange="modalTextGenerator()"></br>
											<span id ="requiredNameText" class="text-danger fst-italic" style="font-size: 12px;" hidden>*This field is required</span></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="wpaf_generator-text-value">Value: </label></th>
											<td><input type="text" name="value" class="oneline" id="wpaf_generator-text-value" onchange="modalTextGenerator()" ></td>
										</tr>

										<tr>
											<td></td>
											<td class="pt-n3"><input type="checkbox" name="placeholder"  id="wpaf_generator-text-placeholder" class="option" onclick="modalTextGenerator()" ><label for="wpaf_generator-text-placeholder">Use this text as placeholder for the field.</label></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="wpaf_generator-text-id">ID: </label></th>
											<td><input type="text" name="id" class="idvalue oneline option" id="wpaf_generator-text-id" onchange="modalTextGenerator()"></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="wpaf_generator-text-class">Class: </label></th>
											<td><input type="text" name="class" class="classvalue oneline option" id="wpaf_generator-text-class" onchange="modalTextGenerator()"></td>
										</tr>

									</tbody>
								</table>
							</div>
						</div>

						<div class="modal-footer position-relative">
							<div class="position-absolute start-0 ms-3">
								<input type="text" name="text" id="wpaf_generatedTextShortcode" readonly="readonly" style="width:365px" value="[input]" >
							</div>
							<div>
								<button type="button" id="wpaf_submit_text" class="btn btn-primary">Finish</button>
							</div>
						</div>

						<script>
							document.getElementById("wpaf_submit_text").addEventListener("click", checkAndAddAttributes);

							function checkAndAddAttributes() {
								// Checking if the input has been filled
								const inputName = document.getElementById("wpaf_generator-text-name");
								if (inputName.value !== "") {
									// Adding hidden to the button
									document.getElementById("requiredNameText").setAttribute("hidden", "");
									// Close the Bootstrap modal
									$('#wpaf_modal_text').modal('hide');
									// Call the transfert function
									transfertText();
								}else{
									// Removing hidden from the button
									document.getElementById("requiredNameText").removeAttribute("hidden", "");
								};
							};
						</script>
					</div>
				</div>
			</div>

			<!-- Modal Button: Email -->
			<button type="button" name="button_email" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#wpaf_modal_email"> Email </button>
			<!-- Modal Form Tag Generator: Email -->
			<div class="modal fade" id="wpaf_modal_email" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="wpaf_exampleModalLabel">Form Tag Generator: Email</h5>
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
												<label><input type="checkbox" id="wpaf_generator-email-required" name="required" onclick="modalEmailGenerator()"> Required field</label>
												</fieldset>
											</td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="wpaf_generator-email-label">Label: </label></th>
											<td ><input type="text" name="label" class="tg-name oneline" id="wpaf_generator-email-label" onchange="modalEmailGenerator()"></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="wpaf_generator-email-name"><span class="text-primary">*</span>Name: </label></th>
											<td><input type="text" name="name" class="tg-name oneline" id="wpaf_generator-email-name" onchange="modalEmailGenerator()"></br>
											<span id ="requiredNameEmail" class="text-danger fst-italic" style="font-size: 12px;" hidden>*This field is required</span></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="wpaf_generator-email-value">Value: </label></th>
											<td><input type="text" name="value" class="oneline" id="wpaf_generator-email-value" onchange="modalEmailGenerator()"></td>
										</tr>

										<tr>
											<td></td>
											<td class="pt-n3"><input type="checkbox" id="wpaf_generator-email-placeholder" name="placeholder" class="option" onclick="modalEmailGenerator()"><label for="wpaf_generator-email-placeholder">Use this text as placeholder for the field.</label></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="wpaf_generator-email-id">ID: </label></th>
											<td><input type="text" name="id" class="idvalue oneline option" id="wpaf_generator-email-id" onchange="modalEmailGenerator()"></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="wpaf_generator-email-class">Class: </label></th>
											<td><input type="text" name="class" class="classvalue oneline option" id="wpaf_generator-email-class" onchange="modalEmailGenerator()"></td>
										</tr>

									</tbody>
								</table>
							</div>
						</div>

						<div class="modal-footer position-relative">
							<div class="position-absolute start-0 ms-3">
								<input type="text" name="text" id="wpaf_generatedEmailShortcode" readonly="readonly" style="width:365px" value="[input]" >
							</div>
							<div>
								<button type="button" id="wpaf_submit_email"class="btn btn-primary">Finish</button>
							</div>
						</div>
						<script>
							document.getElementById("wpaf_submit_email").addEventListener("click", checkAndAddAttributes);

							function checkAndAddAttributes() {
								// Checking if the input has been filled
								const inputName = document.getElementById("wpaf_generator-email-name");
								if (inputName.value !== "") {
									// Adding hidden to the button
									document.getElementById("requiredNameEmail").setAttribute("hidden", "");
									// Close the Bootstrap modal
									$('#wpaf_modal_email').modal('hide');
									// Call the transfert function
									transfertEmail();
								}else{
									// Removing hidden from the button
									document.getElementById("requiredNameEmail").removeAttribute("hidden", "");
								};
							};
						</script>
					</div>
				</div>
			</div>

			<!-- Modal Button: Textarea -->
			<button type="button" name="button_zone_de_text" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#wpaf_modal_textarea"> Text area </button>
			<!-- Modal Form Tag Generator: Textarea -->
			<div class="modal fade" id="wpaf_modal_textarea" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="wpaf_exampleModalLabel">Form Tag Generator: Text area</h5>
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
												<label><input type="checkbox" id="wpaf_generator-textarea-required" name="required" onclick="modalTextareaGenerator()"> Required field</label>
												</fieldset>
											</td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="wpaf_generator-textarea-rows">Rows: </label></th>
											<td ><input type="number" name="rows" class="tg-name oneline" id="wpaf_generator-textarea-rows" style="width:11%;padding-right: 0px;" min="0" max="50" value="0" onchange="modalTextareaGenerator()"></td>
										</tr>

										</tr>
											<th class="text-end" scope="row"><label for="wpaf_generator-textarea-cols">Columns: </label></th>
											<td ><input type="number" name="cols" class="tg-name oneline" id="wpaf_generator-textarea-cols" style="width:11%;padding-right: 0px;" min="0" max="50" value="0" onchange="modalTextareaGenerator()"></td>
										<tr>
											<th class="text-end" scope="row"><label for="wpaf_generator-textarea-label">Label: </label></th>
											<td ><input type="text" name="label" class="tg-name oneline" id="wpaf_generator-textarea-label" onchange="modalTextareaGenerator()"></td>
										</tr>
										
										<tr>
											<th class="text-end" scope="row"><label for="wpaf_generator-textarea-name"><span class="text-primary">*</span>Name: </label></th>
											<td><input type="text" name="name" class="tg-name oneline" id="wpaf_generator-textarea-name" onchange="modalTextareaGenerator()"></br>
											<span id ="requiredNameTextarea" class="text-danger fst-italic" style="font-size: 12px;" hidden>*This field is required</span></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="wpaf_generator-textarea-value">Value: </label></th>
											<td><input type="text" name="value" class="oneline" id="wpaf_generator-textarea-value" onchange="modalTextareaGenerator()"></td>
										</tr>

										<tr>
											<td></td>
											<td class="pt-n3"><input type="checkbox" id="wpaf_generator-textarea-placeholder" name="placeholder" class="option" onclick="modalTextareaGenerator()"><label for="wpaf_generator-textarea-placeholder">Use this text as placeholder for the field.</label></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="wpaf_generator-textarea-id">ID: </label></th>
											<td><input type="text" name="id" class="idvalue oneline option" id="wpaf_generator-textarea-id" onchange="modalTextareaGenerator()"></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="wpaf_generator-textarea-class">Class: </label></th>
											<td><input type="text" name="class" class="classvalue oneline option" id="wpaf_generator-textarea-class" onchange="modalTextareaGenerator()"></td>
										</tr>

									</tbody>
								</table>
							</div>
						</div>

						<div class="modal-footer position-relative">
							<div class="position-absolute start-0 ms-3">
								<input type="text" name="text" id="wpaf_generatedTextareaShortcode" readonly="readonly" style="width:365px" value="[input]" >
							</div>
							<div>
								<button type="button" id="wpaf_submit_textarea" class="btn btn-primary">Finish</button>
							</div>
						</div>
						<style>input[type=number]::-webkit-inner-spin-button { opacity: 1}</style>
						<script>
							document.getElementById("wpaf_submit_textarea").addEventListener("click", checkAndAddAttributes);

							function checkAndAddAttributes() {
								// Checking if the input has been filled
								const inputName = document.getElementById("wpaf_generator-textarea-name");
								if (inputName.value !== "") {
									// Adding hidden to the button
									document.getElementById("requiredNameTextarea").setAttribute("hidden", "");
									// Close the Bootstrap modal
									$('#wpaf_modal_textarea').modal('hide');
									// Call the transfert function
									transfertTextarea();
								}else{
									// Removing hidden from the button
									document.getElementById("requiredNameTextarea").removeAttribute("hidden", "");
								};
							};
						</script>
					</div>
				</div>
			</div>

			<!-- Modal Button: Tel -->
			<button type="button" name="button_tel" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#wpaf_modal_tel"> Tel </button>
			<!-- Modal Form Tag Generator: Tel -->
			<div class="modal fade" id="wpaf_modal_tel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="wpaf_exampleModalLabel">Form Tag Generator: Tel</h5>
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
												<label><input type="checkbox"  id="wpaf_generator-tel-required"name="required" onclick="modalTelGenerator()">Required field</label>
												</fieldset>
											</td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="wpaf_generator-tel-label">Label: </label></th>
											<td ><input type="text" name="label" class="tg-name oneline" id="wpaf_generator-tel-label" onchange="modalTextGenerator()"></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="wpaf_generator-tel-name"><span class="text-primary">*</span>Name: </label></th>
											<td><input type="text" name="name" class="tg-name oneline" id="wpaf_generator-tel-name" onchange="modalTelGenerator()"></br>
											<span id ="requiredNameTel" class="text-danger fst-italic" style="font-size: 12px;" hidden>*This field is required</span></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="wpaf_generator-tel-value">Value: </label></th>
											<td><input type="text" name="value" class="oneline" id="wpaf_generator-tel-value" onchange="modalTelGenerator()"></td>
										</tr>

										<tr>
											<td></td>
											<td class="pt-n3"><input type="checkbox" id="wpaf_generator-tel-placeholder" name="placeholder" class="option" onclick="modalTelGenerator()"><label for="wpaf_generator-tel-placeholder">Use this text as placeholder for the field.</label></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="wpaf_generator-tel-id">ID: </label></th>
											<td><input type="text" name="id" class="idvalue oneline option" id="wpaf_generator-tel-id" onchange="modalTelGenerator()"></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="wpaf_generator-tel-class">Class: </label></th>
											<td><input type="text" name="class" class="classvalue oneline option" id="wpaf_generator-tel-class" onchange="modalTelGenerator()"></td>
										</tr>

									</tbody>
								</table>
							</div>
						</div>

						<div class="modal-footer position-relative">
							<div class="position-absolute start-0 ms-3">
								<input type="text" name="text" id="wpaf_generatedTelShortcode" readonly="readonly" style="width:365px" value="[input]" >
							</div>
							<div>
								<button type="button" id="wpaf_submit_tel" class="btn btn-primary">Finish</button>
							</div>
						</div>
						<script>
							document.getElementById("wpaf_submit_tel").addEventListener("click", checkAndAddAttributes);

							function checkAndAddAttributes() {
								// Checking if the input has been filled
								const inputName = document.getElementById("wpaf_generator-tel-name");
								if (inputName.value !== "") {
									// Adding hidden to the button
									document.getElementById("requiredNameTel").setAttribute("hidden", "");
									// Close the Bootstrap modal
									$('#wpaf_modal_tel').modal('hide');
									// Call the transfert function
									transfertTel();
								}else{
									// Removing hidden from the button
									document.getElementById("requiredNameTel").removeAttribute("hidden", "");
								};
							};
						</script>
					</div>
				</div>
			</div>

			<!-- Modal Button: Dropdown Menu -->
			<button type="button" name="button_menu_deroulant" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#wpaf_modalMenu" disabled> Dropdown menu </button>
			<!-- Modal Form Tag Generator: Dropdown menu -->
			<div class="modal fade" id="wpaf_modalMenu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="wpaf_exampleModalLabel">Form Tag Generator: Dropdown menu</h5>
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
												<label><input type="checkbox" name="required"> Required field</label>
												</fieldset>
											</td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="wpaf_generator-text-label">Label: </label></th>
											<td ><input type="text" name="label" class="tg-name oneline" id="wpaf_generator-text-label" onchange="modalTextGenerator()" value=""></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="wpaf_generator-text-name"><span class="text-primary">*</span>Name: </label></th>
											<td ><input type="text" name="name" class="tg-name oneline" id="wpaf_generator-text-name"></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="wpaf_generator-text-value">Value: </label></th>
											<td><input type="text" name="value" class="oneline" id="wpaf_generator-text-value"></td>
										</tr>

										<tr>
											<td></td>
											<td class="pt-n3"><input type="checkbox" name="placeholder" class="option"><label for="wpaf_generator-text-placeholder">Use this text as placeholder for the field.</label></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="wpaf_generator-text-id">ID: </label></th>
											<td><input type="text" name="id" class="idvalue oneline option" id="wpaf_generator-text-id"></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="wpaf_generator-text-class">Class: </label></th>
											<td><input type="text" name="class" class="classvalue oneline option" id="wpaf_generator-text-class"></td>
										</tr>

									</tbody>
								</table>
							</div>
						</div>

						<div class="modal-footer position-relative">
							<div class="position-absolute start-0 ms-3">
								<input type="text" name="text" readonly="readonly" style="width:365px">
							</div>
							<div>
								<button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="transfert()">Finish</button>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Modal Button: Checkbox -->
			<button type="button" name="button_cases_a_cocher"class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#wpaf_modalCase" disabled> Checkbox </button>
			<!-- Modal Form Tag Generator: Checkbox -->
			<div class="modal fade" id="wpaf_modalCase" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="wpaf_exampleModalLabel">Form Tag Generator: Checkbox</h5>
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
												<label><input type="checkbox" name="required"> Required field</label>
												</fieldset>
											</td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="wpaf_generator-text-label">Label: </label></th>
											<td ><input type="text" name="label" class="tg-name oneline" id="wpaf_generator-text-label" onchange="modalTextGenerator()" value=""></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="wpaf_generator-text-name"><span class="text-primary">*</span>Name: </label></th>
											<td ><input type="text" name="name" class="tg-name oneline" id="wpaf_generator-text-name"></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="wpaf_generator-text-value">Value: </label></th>
											<td><input type="text" name="value" class="oneline" id="wpaf_generator-text-value"></td>
										</tr>

										<tr>
											<td></td>
											<td class="pt-n3"><input type="checkbox" name="placeholder" class="option"><label for="wpaf_generator-text-placeholder">Use this text as placeholder for the field.</label></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="wpaf_generator-text-id">ID: </label></th>
											<td><input type="text" name="id" class="idvalue oneline option" id="wpaf_generator-text-id"></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="wpaf_generator-text-class">Class: </label></th>
											<td><input type="text" name="class" class="classvalue oneline option" id="wpaf_generator-text-class"></td>
										</tr>

									</tbody>
								</table>
							</div>
						</div>

						<div class="modal-footer position-relative">
							<div class="position-absolute start-0 ms-3">
								<input type="text" name="text" readonly="readonly" style="width:365px">
							</div>
							<div>
								<button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="transfert()">Finish</button>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Modal Button: Radio Button -->
			<button type="button" name="button_boutons_radio" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#wpaf_modalRadio" disabled> Radio button </button>
			<!-- Modal Form Tag Generator: Radio Button -->
			<div class="modal fade" id="wpaf_modalRadio" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Form Tag Generator: Radio button</h5>
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
												<label><input type="checkbox" name="required"> Required field</label>
												</fieldset>
											</td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="wpaf_generator-text-label">Label: </label></th>
											<td ><input type="text" name="label" class="tg-name oneline" id="wpaf_generator-text-label" onchange="modalTextGenerator()" value=""></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="wpaf_generator-text-name"><span class="text-primary">*</span>Name: </label></th>
											<td ><input type="text" name="name" class="tg-name oneline" id="wpaf_generator-text-name"></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="wpaf_generator-text-value">Value: </label></th>
											<td><input type="text" name="value" class="oneline" id="wpaf_generator-text-value"></td>
										</tr>

										<tr>
											<td></td>
											<td class="pt-n3"><input type="checkbox" name="placeholder" class="option"><label for="wpaf_generator-text-placeholder">Use this text as placeholder for the field.</label></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="wpaf_generator-text-id">ID: </label></th>
											<td><input type="text" name="id" class="idvalue oneline option" id="wpaf_generator-text-id"></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="wpaf_generator-text-class">Class: </label></th>
											<td><input type="text" name="class" class="classvalue oneline option" id="wpaf_generator-text-class"></td>
										</tr>

									</tbody>
								</table>
							</div>
						</div>

						<div class="modal-footer position-relative">
							<div class="position-absolute start-0 ms-3">
								<input type="text" name="text" readonly="readonly" style="width:365px">
							</div>
							<div>
								<button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="transfert()">Finish</button>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Modal Button: Date -->
			<button type="button" name="button_date" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#wpaf_modalDate" disabled> Date </button>
			<!-- Modal Form Tag Generator: Date -->
			<div class="modal fade" id="wpaf_modalDate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="wpaf_exampleModalLabel">Form Tag Generator: Date</h5>
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
												<label><input type="checkbox" name="required"> Required field</label>
												</fieldset>
											</td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="wpaf_generator-text-label">Label: </label></th>
											<td ><input type="text" name="label" class="tg-name oneline" id="wpaf_generator-text-label" onchange="modalTextGenerator()" value=""></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="wpaf_generator-text-name"><span class="text-primary">*</span>Name: </label></th>
											<td ><input type="text" name="name" class="tg-name oneline" id="wpaf_generator-text-name"></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="wpaf_generator-text-value">Value: </label></th>
											<td><input type="text" name="value" class="oneline" id="wpaf_generator-text-value"></td>
										</tr>

										<tr>
											<td></td>
											<td class="pt-n3"><input type="checkbox" name="placeholder" class="option"><label for="wpaf_generator-text-placeholder">Use this text as placeholder for the field.</label></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="wpaf_generator-text-id">ID: </label></th>
											<td><input type="text" name="id" class="idvalue oneline option" id="wpaf_generator-text-id"></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="wpaf_generator-text-class">Class: </label></th>
											<td><input type="text" name="class" class="classvalue oneline option" id="wpaf_generator-text-class"></td>
										</tr>

									</tbody>
								</table>
							</div>
						</div>

						<div class="modal-footer position-relative">
							<div class="position-absolute start-0 ms-3">
								<input type="text" name="text" readonly="readonly" style="width:365px">
							</div>
							<div>
								<button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="transfert()">Finish</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<!-- Modal Button: File -->
			<button type="button" name="button_fichier" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#wpaf_modalFichier" disabled> File </button>
			<!-- Modal Form Tag Generator: File -->
			<div class="modal fade" id="wpaf_modalFichier" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="wpaf_exampleModalLabel">Form Tag Generator: File</h5>
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
												<label><input type="checkbox" name="required"> Required field</label>
												</fieldset>
											</td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="wpaf_generator-text-label">Label: </label></th>
											<td><input type="text" name="label" class="tg-name oneline" id="wpaf_generator-text-label" onchange="modalTextGenerator()" value=""></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="wpaf_generator-text-name"><span class="text-primary">*</span>Name: </label></th>
											<td><input type="text" name="name" class="tg-name oneline" id="wpaf_generator-text-name"></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="wpaf_generator-text-value">Value: </label></th>
											<td><input type="text" name="value" class="oneline" id="wpaf_generator-text-value"></td>
										</tr>

										<tr>
											<td></td>
											<td class="pt-n3"><input type="checkbox" name="placeholder" class="option"><label for="wpaf_generator-text-placeholder">Use this text as placeholder for the field.</label></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="wpaf_generator-text-id">ID: </label></th>
											<td><input type="text" name="id" class="idvalue oneline option" id="wpaf_generator-text-id"></td>
										</tr>

										<tr>
											<th class="text-end" scope="row"><label for="wpaf_generator-text-class">Class: </label></th>
											<td><input type="text" name="class" class="classvalue oneline option" id="wpaf_generator-text-class"></td>
										</tr>

									</tbody>
								</table>
							</div>
						</div>

						<div class="modal-footer position-relative">
							<div class="position-absolute start-0 ms-3">
								<input type="text" name="text" readonly="readonly" style="width:365px">
							</div>
							<div>
								<button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="transfert()">Finish</button>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Modal Button: Submit -->
			<button type="button" name="wpaf_button_modal_submit" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#wpaf_button_modal_submit"> Submit </button>
			<!-- Modal Form Tag Generator: Submit -->
			<div class="modal fade" id="wpaf_button_modal_submit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-sm modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="wpaf_exampleModalLabel">Form Submit Settings</h5>
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
													<?php if( ($wp_stored_meta['wpaf_whatsapp_switch'][0]) == 1 ){ ?>
														<label for="wpaf_whatsapp_submit" class="d-block mb-1" size="30"><strong>Whatsapp submit button: </strong></label>
														<input type="text" name="wpaf_whatsapp_submit" id="wpaf_whatsapp_submit" size="19" value="<?php if (!empty($wp_stored_meta['wpaf_whatsapp_submit'])) echo esc_attr($wp_stored_meta['wpaf_whatsapp_submit'][0]); ?>"></br>
														<div class="my-2">
															<input type="color" name="wpaf_whatsapp_text_color" id="wpaf_whatsapp_text_color" value="<?php if (!empty($wp_stored_meta['wpaf_whatsapp_text_color'])) echo esc_attr($wp_stored_meta['wpaf_whatsapp_text_color'][0]); ?>" class="color me-2">
															<input type="text" id="wpaf_color_text_code_whatsapp" size="9" oninput="updateColorPickerWhatsappText()" maxlength="7" placeholder="HEX code">
														</div>
														<script>
															// Get input elements
															var colorPickerInputWhatsappText = document.getElementById('wpaf_whatsapp_text_color');
															var colorTextInputWhatsappText = document.getElementById('wpaf_color_text_code_whatsapp');

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
														<label for="wpaf_color_code_whatsapp"class="d-block mb-1"><strong>Button color:</strong></label>
														<input type="color" name="wpaf_whatsapp_submit_color" id="wpaf_whatsapp_submit_color" value="<?php if (!empty($wp_stored_meta['wpaf_whatsapp_submit_color'])) echo esc_attr($wp_stored_meta['wpaf_whatsapp_submit_color'][0]); ?>" class="color me-2">
														<input type="text" id="wpaf_color_code_whatsapp" size="9" oninput="updateColorPickerWhatsapp()" maxlength="7" placeholder="HEX code">
														<script>
															// Get input elements
															var colorPickerInputWhatsapp = document.getElementById('wpaf_whatsapp_submit_color');
															var colorTextInputWhatsapp = document.getElementById('wpaf_color_code_whatsapp');

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
														<label for="wpaf_email_submit" class="d-block mb-1"><strong>Email submit button: </strong></label>
														<input type="text" name="wpaf_email_submit" id="wpaf_email_submit" size="19" value="<?php if (!empty($wp_stored_meta['wpaf_email_submit'])) echo esc_attr($wp_stored_meta['wpaf_email_submit'][0]); ?>"></br>
														<div class="my-2">
															<input type="color" name="wpaf_email_text_color" id="wpaf_email_text_color" value="<?php if (!empty($wp_stored_meta['wpaf_email_text_color'])) echo esc_attr($wp_stored_meta['wpaf_email_text_color'][0]); ?>" class="color me-2">
															<input type="text" id="wpaf_color_text_code_email" size="9" oninput="updateColorPickerEmailText()" maxlength="7" placeholder="HEX code">
														</div>
														<script>
															// Get input elements
															var colorPickerInputEmailText = document.getElementById('wpaf_email_text_color');
															var colorTextInputEmailText = document.getElementById('wpaf_color_text_code_email');

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
														<label for="wpaf_color_code_email"class="d-block mb-1"><strong>Button color:</strong></label>
														<input type="color" name="wpaf_email_submit_color" id="wpaf_email_submit_color" value="<?php if (!empty($wp_stored_meta['wpaf_email_submit_color'])) echo esc_attr($wp_stored_meta['wpaf_email_submit_color'][0]); ?>" class="color me-2">
														<input type="text" id="wpaf_color_code_email" size="9" oninput="updateColorPickerEmail()" maxlength="7" placeholder="HEX code">
														<script>
															// Get input elements
															var colorPickerInputEmail = document.getElementById('wpaf_email_submit_color');
															var colorTextInputEmail = document.getElementById('wpaf_color_code_email');

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
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div class="modal-footer position-relative">
							<div>
								<button type="button" class="btn btn-primary" data-bs-dismiss="modal">Finish</button>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Final form shortcode container -->
			<textarea style="white-space:pre-line;width:100%;" spellcheck="false" <?php if( ($wp_stored_meta['wpaf_whatsapp_switch'][0]) == 1 ) { ?> name="wpaf_whatsapp_form_content" <?php } else { ?>name="wpaf_email_form_content" <?php } ?> id="wpaf_contenu_formulaire" rows="24" class="large-tet code mt-3 code"><?php if( ($wp_stored_meta['wpaf_whatsapp_switch'][0]) == 1 ) { if (! empty ($wp_stored_meta['wpaf_whatsapp_form_content'])) echo esc_textarea ( $wp_stored_meta['wpaf_whatsapp_form_content'][0] ); }else{ if (! empty ($wp_stored_meta['wpaf_email_form_content'])) echo esc_textarea ( $wp_stored_meta['wpaf_email_form_content'][0] ); } ?></textarea>
			
			<div class="row mt-2">
				<!-- Save form button -->
				<div class="col-auto pe-0">
					<button id="wpaf_saveForm" style="height:min-content;" class="btn btn-primary btn-sm">
						Save Changes
					</button>
				</div>

				<!-- Restore default form button -->
				<div class="col-auto">
					<button id="defaultForm" style="height:min-content;" class="btn btn-secondary btn-sm" <?php if( ($wp_stored_meta['wpaf_whatsapp_switch'][0]) == 0 ) { ?> onclick="buttonDefaultMail()"<?php }else{?> onclick="buttonDefaultWhatsapp()" <?php } ?>>
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-counterclockwise" viewBox="0 0 16 16">
							<path fill-rule="evenodd" d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2v1z"/>
							<path d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466z"/>
						</svg> Restore default
					</button>
				</div>
			</div>


			<!-- Default Forms -->
			<input type="hidden" name="contenuFormulaireMail" value="<?php echo $wp_stored_meta['wpaf_email_form_default'][0];?>" />
			<input type="hidden" name="contenuFormulaireWhatsapp" value="<?php echo $wp_stored_meta['wpaf_whatsapp_form_default'][0];?>"/>
		</div>

		<!-- WhatsApp tab + international number & flag -->
		<?php if( ($wp_stored_meta['wpaf_whatsapp_switch'][0]) == 1 ){ ?> 
			<div id="wpaf_email" class="tab-pane fade mt-3 container" role="tabpanel">						
				<div class="form-group">
					<label for="wpaf_whatsapp_tel" class="d-block mb-1"><strong>Number :</strong></label>
					<input type="tel" id="wpaf_whatsapp_tel" name="wpaf_whatsapp_tel" autocomplete="on" pattern="^[\d\u002D\u0028\u0029]*$" value="<?php if (!empty($wp_stored_meta['wpaf_whatsapp_tel'])) echo esc_attr($wp_stored_meta['wpaf_whatsapp_tel'][0]); ?>" class="form-control" />
					<span id="wpaf_whatsapp_message" class="text-danger hide"></span>
					<input type="hidden" id="wpaf_whatsapp_flag" name="wpaf_whatsapp_flag" value="<?php if (!empty($wp_stored_meta['wpaf_whatsapp_flag'])) echo esc_attr($wp_stored_meta['wpaf_whatsapp_flag'][0]); ?>" />
					<input type="hidden" id="wpaf_whatsapp_tel_international" name="wpaf_whatsapp_tel_international" value="<?php if (!empty($wp_stored_meta['wpaf_whatsapp_tel_international'])) echo esc_attr($wp_stored_meta['wpaf_whatsapp_tel_international'][0]); ?>" />
				</div>

				<script>
					var phoneInput = document.querySelector('#wpaf_whatsapp_tel');
					phoneInput.addEventListener('input', (event) => {
					var inputValue = event.target.value;
					var sanitizedValue = inputValue.replace(/[^\d()-]/g, '');
					event.target.value = sanitizedValue;
					});

					function initWhatsApp() {
						var input = document.querySelector("#wpaf_whatsapp_tel");
						var countryInput = document.querySelector("#wpaf_whatsapp_country_code");
						const msg = document.querySelector("#wpaf_whatsapp_message");

						// Error codes returned by getValidationError
						const errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];

						window.intlTelInput(input, {
							initialCountry: '<?php if (!empty($wp_stored_meta['wpaf_whatsapp_flag'])) echo esc_attr($wp_stored_meta['wpaf_whatsapp_flag'][0]); ?>',
							separateDialCode: true,
							utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/utils.js",
							formatOnDisplay: false,
							nationalMode: true,
							preferredCountries: ['us', 'in', 'de', 'gb', 'fr'],
							hiddenInput: "wpaf_whatsapp_tel_international",
						});

						const reset = () => {
							input.classList.remove("error");
							msg.innerHTML = "";
							msg.classList.add("hide");
						};

						document.getElementById('publish').addEventListener('click', function(e) {
							if (e.defaultPrevented) {
								// If the submission button has been disabled, we prevent the submission
								e.preventDefault();
							}
						});

						input.addEventListener('keyup', () => {
							reset();
							if (input.value.trim()) {
								if (iti.isValidNumber()) {
									document.getElementById('publish').removeAttribute('disabled');
									msg.innerHTML = "✓ Valid";
									msg.classList.remove("text-danger");
									msg.classList.add("text-success");
									msg.classList.remove("hide");
								} else {
									document.getElementById('publish').setAttribute('disabled', 'disabled');
									input.classList.add("error");
									const errorCode = iti.getValidationError();
									msg.innerHTML = errorMap[errorCode];
									msg.classList.remove("text-success");
									msg.classList.add("text-danger");
									msg.classList.remove("hide");
								}
							}
						});

						var input = document.querySelector("#wpaf_whatsapp_tel");
						var iti = window.intlTelInputGlobals.getInstance(input);

						// Save the selected flag value
						document.querySelector('#wpaf_whatsapp_tel').addEventListener('countrychange', function() {
							document.querySelector('#wpaf_whatsapp_flag').value = iti.getSelectedCountryData().iso2;
						});

						// Save the phone number in international format
						document.querySelector('#wpaf_whatsapp_tel').addEventListener('blur', function() {
							document.querySelector('#wpaf_whatsapp_tel_international').value = iti.getNumber();
						});
					}

					jQuery(document).ready(function() {
						initWhatsApp();
					});
				</script>
				<div class="row mt-2">
					<!-- Save form button -->
					<div class="col-auto pe-0">
						<button id="wpaf_saveForm" style="height:min-content;" class="btn btn-primary btn-sm">
							Save Changes
						</button>
					</div>

					<!-- Restore default form button -->
					<div class="col-auto">
						<button id="defaultForm" style="height:min-content;" class="btn btn-secondary btn-sm" <?php if( ($wp_stored_meta['wpaf_whatsapp_switch'][0]) == 0 ) { ?> onclick="buttonDefaultMail()"<?php }else{?> onclick="buttonDefaultWhatsapp()" <?php } ?>>
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-counterclockwise" viewBox="0 0 16 16">
								<path fill-rule="evenodd" d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2v1z"/>
								<path d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466z"/>
							</svg> Restore default
						</button>
					</div>
				</div>	
			</div>
			
		<?php }else{?>
		<!-- Mail construction -->
			<div id="wpaf_email" class="tab-pane fade mt-3 container" role="tabpanel">
				<div class="row">
					<div class="col-xl-8 col-lg-8 col-md-8 col-xs-12 col-sm-12">
							<div class="alert alert-primary d-flex align-items-center text-primary" role="alert" style="margin-right:auto;">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" role="img" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
									<path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
								</svg>
								<div class="ms-2">
									To retrieve the user's information, you need to use the <strong>names</strong> you assigned to your inputs and enclose them in brackets.</br> If you named your inputs 'email' and 'message,' you need to write <strong>[email]</strong> and <strong>[message]</strong>.
								</div>
							</div>
					</div>
				</div>


				<div class="form-group">
					<label for="wpaf_email_admin_to"><strong>To</strong></label><br>
					<input type="text" name="wpaf_email_admin_to" id="wpaf_email_admin_to" class="large-text code" value="<?php if (! empty ($wp_stored_meta['wpaf_email_admin_to'])) echo esc_attr ( $wp_stored_meta['wpaf_email_admin_to'][0] ); ?>"/>
					
					<label for="wpaf_email_admin_from"><strong>From</strong></label>
					<input type="text" name="wpaf_email_admin_from" id="wpaf_email_admin_from" class="large-text code" value="<?php if (! empty ($wp_stored_meta['wpaf_email_admin_from'])) echo esc_attr ( $wp_stored_meta['wpaf_email_admin_from'][0] ); ?>"/>
					
					<label for="wpaf_email_admin_subject" ><strong>Subject</strong></label>
					<input type="text" name="wpaf_email_admin_subject" id="wpaf_email_admin_subject" class="large-text code" value="<?php if (! empty ($wp_stored_meta['wpaf_email_admin_subject'])) echo esc_attr ( $wp_stored_meta['wpaf_email_admin_subject'][0] ); ?>"/>
					
					<label for="wpaf_email_admin_content"><strong>Message content</strong></label>
					<textarea cols="100" rows="18" name="wpaf_email_admin_content" id="wpaf_email_admin_content" class="large-text code"><?php if (! empty ($wp_stored_meta['wpaf_email_admin_content'])) echo esc_attr ( $wp_stored_meta['wpaf_email_admin_content'][0] ); ?></textarea>
				</div>
				
				<label for="wpaf_user_email_switch"><h2>Enable the autoresponder:</h2></label>
				<input type="checkbox" id="wpaf_user_email_switch" name="wpaf_user_email_switch" <?php if($wp_stored_meta['wpaf_user_email_switch'][0] == 1){?>checked<?php };?>/>

				<div class="form-group" id="wpaf_user_email">
					<label for="wpaf_email_user_to"><strong>To</strong></label><br>
					<input type="text" name="wpaf_email_user_to" id="wpaf_email_user_to" class="large-text code" value="<?php if (! empty ($wp_stored_meta['wpaf_email_user_to'])) echo esc_attr ( $wp_stored_meta['wpaf_email_user_to'][0] ); ?>"/>
					
					<label for="wpaf_email_user_from"><strong>From</strong></label>
					<input type="text" name="wpaf_email_user_from" id="wpaf_email_user_from" class="large-text code" value="<?php if (! empty ($wp_stored_meta['wpaf_email_user_from'])) echo esc_attr ( $wp_stored_meta['wpaf_email_user_from'][0] ); ?>"/>
					
					<label for="wpaf_email_user_subject" ><strong>Subject</strong></label>
					<input type="text" name="wpaf_email_user_subject" id="wpaf_email_user_subject" class="large-text code" value="<?php if (! empty ($wp_stored_meta['wpaf_email_user_subject'])) echo esc_attr ( $wp_stored_meta['wpaf_email_user_subject'][0] ); ?>"/>
					
					<label for="wpaf_email_user_content"><strong>Message content</strong></label>
					<textarea cols="100" rows="18" name="wpaf_email_user_content" id="wpaf_email_user_content" class="large-text code"><?php if (! empty ($wp_stored_meta['wpaf_email_user_content'])) echo esc_attr ( $wp_stored_meta['wpaf_email_user_content'][0] ); ?></textarea>
				</div>
				<script>
					const checkbox = document.getElementById("wpaf_user_email_switch");
					var maDiv = document.getElementById("wpaf_user_email");
						if (checkbox.checked == true){
							maDiv.style.display = "block";
						} else {
							maDiv.style.display = "none";
						}
					checkbox.addEventListener('input', function() {
						var maDiv = document.getElementById("wpaf_user_email");
						if (checkbox.checked == true){
							maDiv.style.display = "block";
						} else {
							maDiv.style.display = "none";
						}
					});
				</script>
				<div class="row mt-2">
					<!-- Save form button -->
					<div class="col-auto pe-0">
						<button id="wpaf_saveForm" style="height:min-content;" class="btn btn-primary btn-sm">
							Save Changes
						</button>
					</div>

					<!-- Restore default form button -->
					<div class="col-auto">
						<button id="defaultForm" style="height:min-content;" class="btn btn-secondary btn-sm" <?php if( ($wp_stored_meta['wpaf_whatsapp_switch'][0]) == 0 ) { ?> onclick="buttonDefaultMail()"<?php }else{?> onclick="buttonDefaultWhatsapp()" <?php } ?>>
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-counterclockwise" viewBox="0 0 16 16">
								<path fill-rule="evenodd" d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2v1z"/>
								<path d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466z"/>
							</svg> Restore default
						</button>
					</div>
				</div>
			</div>

		<?php } ?>
		<!-- Success and Error messages-->
		<div id="wpaf_message" class="tab-pane fade mt-3 container" role="tabpanel">
			<div class="mb-3 col-xl-8 col-lg-8 col-md-8 col-xs-12 col-sm-12">
				<label for="<?php if ($wp_stored_meta['wpaf_whatsapp_switch'][0] == 1){?>wpaf_whatsapp_success<?php }else{?>wpaf_email_success<?php }?>" class="form-label"><strong>The user's message has been sent successfully:</strong></label>
				<div class="alert alert-success">
					<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
						<path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
					</svg>
					<?php if ($wp_stored_meta['wpaf_whatsapp_switch'][0] == 1){?> <input type="text" name="wpaf_whatsapp_success" id="wpaf_whatsapp_success" class="large-text w-75" style="background-color: transparent;" value="<?php if (! empty ($wp_stored_meta['wpaf_whatsapp_success'])) echo esc_attr ( $wp_stored_meta['wpaf_whatsapp_success'][0] );?>"/><?php }else{
					?> <input type="text" name="wpaf_email_success" id="wpaf_email_success" class="large-text w-75" style="background-color: transparent;" value="<?php if (! empty ($wp_stored_meta['wpaf_email_success'])) echo esc_attr ( $wp_stored_meta['wpaf_email_success'][0] );?>"/><?php };?>
				</div>
			</div>

			<div class="mb-3 col-xl-8 col-lg-8 col-md-8 col-xs-12 col-sm-12">
				<label for="<?php if ($wp_stored_meta['wpaf_whatsapp_switch'][0] == 1){?>wpaf_whatsapp_error<?php }else{?>wpaf_email_error<?php }?>" class="form-label"><strong>The user's message could not be sent:</strong></label>
				<div class="alert alert-danger">
					<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
						<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
					</svg>
					<?php if ($wp_stored_meta['wpaf_whatsapp_switch'][0] == 1){?> <input type="text" name="wpaf_whatsapp_error" id="wpaf_whatsapp_error" class="large-text w-75" style="background-color: transparent;" value="<?php if (! empty ($wp_stored_meta['wpaf_whatsapp_error'])) echo esc_attr ( $wp_stored_meta['wpaf_whatsapp_error'][0] );?>"/><?};?>
					<?php if ($wp_stored_meta['wpaf_whatsapp_switch'][0] == 0){?> <input type="text" name="wpaf_email_error" id="wpaf_email_error" class="large-text w-75" style="background-color: transparent;" value="<?php if (! empty ($wp_stored_meta['wpaf_email_error'])) echo esc_attr ( $wp_stored_meta['wpaf_email_error'][0] );?>"/><?php };?>
				</div>
			</div>
			<div class="row mt-2">
				<!-- Save form button -->
				<div class="col-auto pe-0">
					<button id="wpaf_saveForm" style="height:min-content;" class="btn btn-primary btn-sm">
						Save Changes
					</button>
				</div>

				<!-- Restore default form button -->
				<div class="col-auto">
					<button id="defaultForm" style="height:min-content;" class="btn btn-secondary btn-sm" <?php if( ($wp_stored_meta['wpaf_whatsapp_switch'][0]) == 0 ) { ?> onclick="buttonDefaultMail()"<?php }else{?> onclick="buttonDefaultWhatsapp()" <?php } ?>>
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-counterclockwise" viewBox="0 0 16 16">
							<path fill-rule="evenodd" d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2v1z"/>
							<path d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466z"/>
						</svg> Restore default
					</button>
				</div>
			</div>
		</div>
	</div>
</section>
