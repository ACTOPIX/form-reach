<!doctype html>
<html lang="en">
	<head>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/css/intlTelInput.css">
		<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/intlTelInput.min.js"></script>
		<script src="<?php echo plugin_dir_url(__FILE__); ?>js/action-form-admin.js"></script>
		<script src="<?php echo plugin_dir_url(__FILE__); ?>js/wp-action-form.js"></script>
	</head>



	<body onload="modalTextGenerator(),modalTextareaGenerator(),modalEmailGenerator(),modalTelGenerator()">
	
		<div class="tab-content" id="wpaf_myTabContent">

			<ul class="nav nav-tabs" id="wpaf_myTab" role="tablist">
			<li class="nav-item" role="presentation">
				<button class="nav-link active" id="wpaf_home-tab" data-bs-toggle="tab" data-bs-target="#wpaf_formulaire" type="button" role="tab" aria-controls="home" aria-selected="true">Formulaire</button>
			</li>
			<li class="nav-item" role="presentation">
				<button class="nav-link" id="wpaf_profile-tab" data-bs-toggle="tab" data-bs-target="#wpaf_email" type="button" role="tab" aria-controls="profile" aria-selected="false"><?php if( ($wp_stored_meta['wpaf_whatsapp_switch'][0]) == 1 ) { ?>WhatsApp<?php }else{?> Email<?php } ?></button>
			</li>
			<li class="nav-item" role="presentation">
				<button class="nav-link" id="wpaf_contact-tab" data-bs-toggle="tab" data-bs-target="#wpaf_message" type="button" role="tab" aria-controls="contact" aria-selected="false">Message</button>
			</li>

			<!-- Boutton toggle changement de formulaire WhatsAPP -->
			<p class="wpaf_type_text">Formulaire <span id="wpaf_span_mail" class="wpaf_span"<?php if( ($wp_stored_meta['wpaf_whatsapp_switch'][0]) == 1 ) { ?> style="display:none" <?} else {?> style="display:block" <?}?>>Mail</span><span id="wpaf_span_whatsapp" class="wpaf_span"<?php if( ($wp_stored_meta['wpaf_whatsapp_switch'][0]) == 1 ) { ?> style="display:block" <?} else {?> style="display:none" <?}?>>WhatsApp</span></p>
			<input type="checkbox" name="wpaf_whatsapp_switch" id="wpaf_whatsapp_switch" <?php if( ($wp_stored_meta['wpaf_whatsapp_switch'][0]) == 1 ) { ?>checked="checked"<?php }else{?><?php } ?> /><label id="wpaf_whatsapp_label"for="wpaf_whatsapp_switch">Toggle</label>

			<!-- Style du boutton toggle changement de formulaire WhatsAPP -->
			<style>
			#wpaf_whatsapp_switch{
				height: 0;
				width: 0;
				visibility: hidden;
				user-select: none;
			}
			#wpaf_whatsapp_label {
				cursor: pointer;
				text-indent: -9999px;
				width: 50px;
				height: 25.5px;
				background: grey;
				display: block;
				border-radius: 100px;
				position: absolute;
				right:5em;t
				top:0.4em;
				user-select: none;
			}
			#wpaf_whatsapp_label:after {
				content: '';
				position: absolute;
				top: 2.562px;
				left: 2.5px;
				width: 20px;
				height: 20px;
				background: #fff;
				border-radius: 22.5px;
				transition: 0.3s;
			}
			#wpaf_whatsapp_switch:checked + #wpaf_whatsapp_label {
				background: #25D366;
			}
			#wpaf_whatsapp_switch:checked + #wpaf_whatsapp_label:after {
				left: calc(100% - 2.5px);
				transform: translateX(-100%);
			}
			#wpaf_whatsapp_label:active:after {
				width: 32.5px;
			}
			.wpaf_iconsvg{
				top:0.4em;
				right:2em;
				position:absolute;
			}

			.wpaf_type_text{
				position:absolute;
				right:10em;
			}

			.wpaf_span{
				font-weight:bolder;
				text-align:center;
			}
			</style>

			<!-- Mail Icon -->
			<?php if( ($wp_stored_meta['wpaf_whatsapp_switch'][0]) == 0 ) { ?>
				<svg id="wpaf_mail_iconsvg" class="wpaf_iconsvg" id="wpaf_mail_iconsvg" xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
					<path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/>
				</svg>
			<?php } ?>
			<!-- Mail Icon -->

			<!-- WhatsApp Icon -->
			<?php if( ($wp_stored_meta['wpaf_whatsapp_switch'][0]) == 1 ) { ?>
				<svg id="wpaf_whatsapp_iconsvg" class="wpaf_iconsvg" xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
					<path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
				</svg>
			<?php } ?>
			<!-- WhatsApp Icon -->

			</ul>


			<div id="wpaf_formulaire" class="tab-pane fade show active mt-3" role="tabpanel">

				<button type="button" name="button_text" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#wpaf_modalTexte" > Texte </button>

					<div class="modal fade" id="wpaf_modalTexte" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="wpaf_exampleModalLabel">Générateur de balise de formulaire : Texte</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
								<form method="GET" id="testform"></form>
									<div class="table-responsive">

										<table class="table table-borderless">
											<tbody>
												<tr>
													<th class="text-end"scope="row">Type : </th>
													<td>
														<fieldset>
														<legend class="screen-reader-text">Type de champ</legend>
														<label><input type="checkbox" id="wpaf_generator-text-required" name="required" onclick="modalTextGenerator()"> Champ obligatoire</label>
														</fieldset>
													</td>
												</tr>

												<tr>
													<th class="text-end" scope="row"><label for="wpaf_generator-text-label">Label :</label></th>
													<td ><input type="text" name="label" class="tg-name oneline" id="wpaf_generator-text-label" onchange="modalTextGenerator()"></td>
												</tr>

												<tr>
													<th class="text-end" scope="row"><label for="wpaf_generator-text-name">Nom :</label></th>
													<td ><input type="text" name="name" class="tg-name oneline" id="wpaf_generator-text-name" onchange="modalTextGenerator()"></td>
												</tr>

												<tr>
													<th class="text-end" scope="row"><label for="wpaf_generator-text-value">Valeur :</label></th>
													<td><input type="text" name="value" class="oneline" id="wpaf_generator-text-value" onchange="modalTextGenerator()" ></td>
												</tr>

												<tr>
													<td></td>
													<td class="pt-n3"><input type="checkbox" name="placeholder"  id="wpaf_generator-text-placeholder" class="option" onclick="modalTextGenerator()" ><label for="wpaf_generator-text-placeholder">Utilisez ce texte comme texte indicatif du champ.</label></td>
												</tr>

												<tr>
													<th class="text-end" scope="row"><label for="wpaf_generator-id">ID :</label></th>
													<td><input type="text" name="id" class="idvalue oneline option" id="wpaf_generator-text-id" onchange="modalTextGenerator()"></td>
												</tr>

												<tr>
													<th class="text-end" scope="row"><label for="wpaf_generator-class">Class :</label></th>
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
										<button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="transfertText()">Terminer</button>
									</div>
								</div>
							</div>
						</div>
					</div>

				<button type="button" name="button_e-mail" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#wpaf_modalEmail"> E-mail </button>

					<div class="modal fade" id="wpaf_modalEmail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="wpaf_exampleModalLabel">Générateur de balise de formulaire : E-mail</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<div class="table-responsive">
										<table class="table table-borderless">
											<tbody>
												<tr>
													<th class="text-end"scope="row">Type : </th>
													<td>
														<fieldset>
														<legend class="screen-reader-text">Type de champ</legend>
														<label><input type="checkbox" id="wpaf_generator-email-required" name="required" onclick="modalEmailGenerator()"> Champ obligatoire</label>
														</fieldset>
													</td>
												</tr>

												<tr>
													<th class="text-end" scope="row"><label for="wpaf_generator-email-label">Label :</label></th>
													<td ><input type="text" name="label" class="tg-name oneline" id="wpaf_generator-email-label" onchange="modalEmailGenerator()"></td>
												</tr>

												<tr>
													<th class="text-end" scope="row"><label for="wpaf_generator-email-name">Nom :</label></th>
													<td ><input type="text" name="name" class="tg-name oneline" id="wpaf_generator-email-name" onchange="modalEmailGenerator()"></td>
												</tr>

												<tr>
													<th class="text-end" scope="row"><label for="wpaf_generator-email-value">Valeur :</label></th>
													<td><input type="text" name="value" class="oneline" id="wpaf_generator-email-value" onchange="modalEmailGenerator()"></td>
												</tr>

												<tr>
													<td></td>
													<td class="pt-n3"><input type="checkbox" id="wpaf_generator-email-placeholder" name="placeholder" class="option" onclick="modalEmailGenerator()"><label for="wpaf_generator-email-placeholder">Utilisez ce texte comme texte indicatif du champ.</label></td>
												</tr>

												<tr>
													<th class="text-end" scope="row"><label for="wpaf_generator-email-id">ID :</label></th>
													<td><input type="text" name="id" class="idvalue oneline option" id="wpaf_generator-email-id" onchange="modalEmailGenerator()"></td>
												</tr>

												<tr>
													<th class="text-end" scope="row"><label for="wpaf_generator-email-class">Class :</label></th>
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
										<button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="transfertEmail()">Terminer</button>
									</div>
								</div>
							</div>
						</div>
					</div>


				<button type="button" name="button_zone_de_text" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#wpaf_modalZone"> Zone de texte </button>

					<div class="modal fade" id="wpaf_modalZone" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="wpaf_exampleModalLabel">Générateur de balise de formulaire : Zone de texte</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<div class="table-responsive">
										<table class="table table-borderless">
											<tbody>
												<tr>
													<th class="text-end"scope="row">Type : </th>
													<td>
														<fieldset>
														<legend class="screen-reader-text">Type de champ</legend>
														<label><input type="checkbox" id="wpaf_generator-textarea-required" name="required" onclick="modalTextareaGenerator()"> Champ obligatoire</label>
														</fieldset>
													</td>
												</tr>

												<tr>
													<th class="text-end" scope="row"><label for="wpaf_generator-textarea-rows">Lignes :</label></th>
													<td ><input type="number" name="rows" class="tg-name oneline" id="wpaf_generator-textarea-rows" style="width:11%;padding-right: 0px;" min="0" max="50" value="0" onchange="modalTextareaGenerator()"></td>
												</tr>

												</tr>
													<th class="text-end" scope="row"><label for="wpaf_generator-textarea-cols">Colonnes :</label></th>
													<td ><input type="number" name="cols" class="tg-name oneline" id="wpaf_generator-textarea-cols" style="width:11%;padding-right: 0px;" min="0" max="50" value="0" onchange="modalTextareaGenerator()"></td>
												<tr>
													<th class="text-end" scope="row"><label for="wpaf_generator-textarea-label">Label :</label></th>
													<td ><input type="text" name="label" class="tg-name oneline" id="wpaf_generator-textarea-label" onchange="modalTextareaGenerator()"></td>
												</tr>
												
												<tr>
													<th class="text-end" scope="row"><label for="wpaf_generator-textarea-name">Nom :</label></th>
													<td ><input type="text" name="name" class="tg-name oneline" id="wpaf_generator-textarea-name" onchange="modalTextareaGenerator()"></td>
												</tr>

												<tr>
													<th class="text-end" scope="row"><label for="wpaf_generator-textarea-value">Valeur :</label></th>
													<td><input type="text" name="value" class="oneline" id="wpaf_generator-textarea-value" onchange="modalTextareaGenerator()"></td>
												</tr>

												<tr>
													<td></td>
													<td class="pt-n3"><input type="checkbox" id="wpaf_generator-textarea-placeholder" name="placeholder" class="option" onclick="modalTextareaGenerator()"><label for="wpaf_generator-textarea-placeholder">Utilisez ce texte comme texte indicatif du champ.</label></td>
												</tr>

												<tr>
													<th class="text-end" scope="row"><label for="wpaf_generator-textarea-id">ID :</label></th>
													<td><input type="text" name="id" class="idvalue oneline option" id="wpaf_generator-textarea-id" onchange="modalTextareaGenerator()"></td>
												</tr>

												<tr>
													<th class="text-end" scope="row"><label for="wpaf_generator-textarea-class">Class :</label></th>
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
										<button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="transfertTextarea()">Terminer</button>
									</div>
								</div>
								<style>input[type=number]::-webkit-inner-spin-button { opacity: 1}</style>
							</div>
						</div>
					</div>



				<button type="button" name="button_tel" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#wpaf_modalTel"> Tel </button>

					<div class="modal fade" id="wpaf_modalTel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="wpaf_exampleModalLabel">Générateur de balise de formulaire : Tel</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<div class="table-responsive">
										<table class="table table-borderless">
											<tbody>
												<tr>
													<th class="text-end"scope="row">Type : </th>
													<td>
														<fieldset>
														<legend class="screen-reader-text">Type de champ</legend>
														<label><input type="checkbox"  id="wpaf_generator-tel-required"name="required" onclick="modalTelGenerator()"> Champ obligatoire</label>
														</fieldset>
													</td>
												</tr>

												<tr>
													<th class="text-end" scope="row"><label for="wpaf_generator-tel-label">Label :</label></th>
													<td ><input type="text" name="label" class="tg-name oneline" id="wpaf_generator-tel-label" onchange="modalTextGenerator()"></td>
												</tr>

												<tr>
													<th class="text-end" scope="row"><label for="wpaf_generator-tel-name">Nom :</label></th>
													<td ><input type="text" name="name" class="tg-name oneline" id="wpaf_generator-tel-name" onchange="modalTelGenerator()"></td>
												</tr>

												<tr>
													<th class="text-end" scope="row"><label for="wpaf_generator-tel-value">Valeur :</label></th>
													<td><input type="text" name="value" class="oneline" id="wpaf_generator-tel-value" onchange="modalTelGenerator()"></td>
												</tr>

												<tr>
													<td></td>
													<td class="pt-n3"><input type="checkbox" id="wpaf_generator-tel-placeholder" name="placeholder" class="option" onclick="modalTelGenerator()"><label for="wpaf_generator-tel-placeholder">Utilisez ce texte comme texte indicatif du champ.</label></td>
												</tr>

												<tr>
													<th class="text-end" scope="row"><label for="wpaf_generator-tel-id">ID :</label></th>
													<td><input type="text" name="id" class="idvalue oneline option" id="wpaf_generator-tel-id" onchange="modalTelGenerator()"></td>
												</tr>

												<tr>
													<th class="text-end" scope="row"><label for="wpaf_generator-tel-class">Class :</label></th>
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
										<button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="transfertTel()">Terminer</button>
									</div>
								</div>
							</div>
						</div>
					</div>

				<button type="button" name="button_menu_deroulant" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#wpaf_modalMenu" disabled> Menu Déroulant </button>

					<div class="modal fade" id="wpaf_modalMenu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="wpaf_exampleModalLabel">Générateur de balise de formulaire : Menu Déroulant</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<div class="table-responsive">
										<table class="table table-borderless">
											<tbody>
												<tr>
													<th class="text-end"scope="row">Type : </th>
													<td>
														<fieldset>
														<legend class="screen-reader-text">Type de champ</legend>
														<label><input type="checkbox" name="required"> Champ obligatoire</label>
														</fieldset>
													</td>
												</tr>

												<tr>
													<th class="text-end" scope="row"><label for="wpaf_generator-text-label">Label :</label></th>
													<td ><input type="text" name="label" class="tg-name oneline" id="wpaf_generator-text-label" onchange="modalTextGenerator()" value=""></td>
												</tr>

												<tr>
													<th class="text-end" scope="row"><label for="wpaf_generator-text-name">Nom :</label></th>
													<td ><input type="text" name="name" class="tg-name oneline" id="wpaf_generator-text-name"></td>
												</tr>

												<tr>
													<th class="text-end" scope="row"><label for="wpaf_generator-text-value">Valeur :</label></th>
													<td><input type="text" name="value" class="oneline" id="wpaf_generator-text-value"></td>
												</tr>

												<tr>
													<td></td>
													<td class="pt-n3"><input type="checkbox" name="placeholder" class="option"><label for="wpaf_generator-text-placeholder">Utilisez ce texte comme texte indicatif du champ.</label></td>
												</tr>

												<tr>
													<th class="text-end" scope="row"><label for="wpaf_generator-text-id">ID :</label></th>
													<td><input type="text" name="id" class="idvalue oneline option" id="wpaf_generator-text-id"></td>
												</tr>

												<tr>
													<th class="text-end" scope="row"><label for="wpaf_generator-text-class">Class :</label></th>
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
										<button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="transfert()">Terminer</button>
									</div>
								</div>
							</div>
						</div>
					</div>

				<button type="button" name="button_cases_a_cocher"class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#wpaf_modalCase" disabled> Case à cocher </button>

					<div class="modal fade" id="wpaf_modalCase" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="wpaf_exampleModalLabel">Générateur de balise de formulaire : Casa à cocher</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<div class="table-responsive">
										<table class="table table-borderless">
											<tbody>
												<tr>
													<th class="text-end"scope="row">Type : </th>
													<td>
														<fieldset>
														<legend class="screen-reader-text">Type de champ</legend>
														<label><input type="checkbox" name="required"> Champ obligatoire</label>
														</fieldset>
													</td>
												</tr>

												<tr>
													<th class="text-end" scope="row"><label for="wpaf_generator-text-label">Label :</label></th>
													<td ><input type="text" name="label" class="tg-name oneline" id="wpaf_generator-text-label" onchange="modalTextGenerator()" value=""></td>
												</tr>

												<tr>
													<th class="text-end" scope="row"><label for="wpaf_generator-text-name">Nom :</label></th>
													<td ><input type="text" name="name" class="tg-name oneline" id="wpaf_generator-text-name"></td>
												</tr>

												<tr>
													<th class="text-end" scope="row"><label for="wpaf_generator-text-value">Valeur :</label></th>
													<td><input type="text" name="value" class="oneline" id="wpaf_generator-text-value"></td>
												</tr>

												<tr>
													<td></td>
													<td class="pt-n3"><input type="checkbox" name="placeholder" class="option"><label for="wpaf_generator-text-placeholder">Utilisez ce texte comme texte indicatif du champ.</label></td>
												</tr>

												<tr>
													<th class="text-end" scope="row"><label for="wpaf_generator-text-id">ID :</label></th>
													<td><input type="text" name="id" class="idvalue oneline option" id="wpaf_generator-text-id"></td>
												</tr>

												<tr>
													<th class="text-end" scope="row"><label for="wpaf_generator-text-class">Class :</label></th>
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
										<button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="transfert()">Terminer</button>
									</div>
								</div>
							</div>
						</div>
					</div>

				<button type="button" name="button_boutons_radio" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#wpaf_modalRadio" disabled> Bouton Radio </button>

					<div class="modal fade" id="wpaf_modalRadio" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Générateur de balise de formulaire : Bouton Radio</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<div class="table-responsive">
										<table class="table table-borderless">
											<tbody>
												<tr>
													<th class="text-end"scope="row">Type : </th>
													<td>
														<fieldset>
														<legend class="screen-reader-text">Type de champ</legend>
														<label><input type="checkbox" name="required"> Champ obligatoire</label>
														</fieldset>
													</td>
												</tr>

												<tr>
													<th class="text-end" scope="row"><label for="wpaf_generator-text-label">Label :</label></th>
													<td ><input type="text" name="label" class="tg-name oneline" id="wpaf_generator-text-label" onchange="modalTextGenerator()" value=""></td>
												</tr>

												<tr>
													<th class="text-end" scope="row"><label for="wpaf_generator-text-name">Nom :</label></th>
													<td ><input type="text" name="name" class="tg-name oneline" id="wpaf_generator-text-name"></td>
												</tr>

												<tr>
													<th class="text-end" scope="row"><label for="wpaf_generator-text-value">Valeur :</label></th>
													<td><input type="text" name="value" class="oneline" id="wpaf_generator-text-value"></td>
												</tr>

												<tr>
													<td></td>
													<td class="pt-n3"><input type="checkbox" name="placeholder" class="option"><label for="wpaf_generator-text-placeholder">Utilisez ce texte comme texte indicatif du champ.</label></td>
												</tr>

												<tr>
													<th class="text-end" scope="row"><label for="wpaf_generator-text-id">ID :</label></th>
													<td><input type="text" name="id" class="idvalue oneline option" id="wpaf_generator-text-id"></td>
												</tr>

												<tr>
													<th class="text-end" scope="row"><label for="wpaf_generator-text-class">Class :</label></th>
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
										<button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="transfert()">Terminer</button>
									</div>
								</div>
							</div>
						</div>
					</div>

				<button type="button" name="button_date" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#wpaf_modalDate" disabled> Date </button>

					<div class="modal fade" id="wpaf_modalDate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="wpaf_exampleModalLabel">Générateur de balise de formulaire : Date</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<div class="table-responsive">
										<table class="table table-borderless">
											<tbody>
												<tr>
													<th class="text-end"scope="row">Type : </th>
													<td>
														<fieldset>
														<legend class="screen-reader-text">Type de champ</legend>
														<label><input type="checkbox" name="required"> Champ obligatoire</label>
														</fieldset>
													</td>
												</tr>

												<tr>
													<th class="text-end" scope="row"><label for="wpaf_generator-text-label">Label :</label></th>
													<td ><input type="text" name="label" class="tg-name oneline" id="wpaf_generator-text-label" onchange="modalTextGenerator()" value=""></td>
												</tr>

												<tr>
													<th class="text-end" scope="row"><label for="wpaf_generator-text-name">Nom :</label></th>
													<td ><input type="text" name="name" class="tg-name oneline" id="wpaf_generator-text-name"></td>
												</tr>

												<tr>
													<th class="text-end" scope="row"><label for="wpaf_generator-text-value">Valeur :</label></th>
													<td><input type="text" name="value" class="oneline" id="wpaf_generator-text-value"></td>
												</tr>

												<tr>
													<td></td>
													<td class="pt-n3"><input type="checkbox" name="placeholder" class="option"><label for="wpaf_generator-text-placeholder">Utilisez ce texte comme texte indicatif du champ.</label></td>
												</tr>

												<tr>
													<th class="text-end" scope="row"><label for="wpaf_generator-text-id">ID :</label></th>
													<td><input type="text" name="id" class="idvalue oneline option" id="wpaf_generator-text-id"></td>
												</tr>

												<tr>
													<th class="text-end" scope="row"><label for="wpaf_generator-text-class">Class :</label></th>
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
										<button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="transfert()">Terminer</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					
				<button type="button" name="button_fichier" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#wpaf_modalFichier" disabled> Fichier </button>

					<div class="modal fade" id="wpaf_modalFichier" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="wpaf_exampleModalLabel">Générateur de balise de formulaire : Fichier</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<div class="table-responsive">
										<table class="table table-borderless">
											<tbody>
												<tr>
													<th class="text-end"scope="row">Type : </th>
													<td>
														<fieldset>
														<legend class="screen-reader-text">Type de champ</legend>
														<label><input type="checkbox" name="required"> Champ obligatoire</label>
														</fieldset>
													</td>
												</tr>

												<tr>
													<th class="text-end" scope="row"><label for="wpaf_generator-text-label">Label :</label></th>
													<td><input type="text" name="label" class="tg-name oneline" id="wpaf_generator-text-label" onchange="modalTextGenerator()" value=""></td>
												</tr>

												<tr>
													<th class="text-end" scope="row"><label for="wpaf_generator-text-name">Nom :</label></th>
													<td><input type="text" name="name" class="tg-name oneline" id="wpaf_generator-text-name"></td>
												</tr>

												<tr>
													<th class="text-end" scope="row"><label for="wpaf_generator-text-value">Valeur :</label></th>
													<td><input type="text" name="value" class="oneline" id="wpaf_generator-text-value"></td>
												</tr>

												<tr>
													<td></td>
													<td class="pt-n3"><input type="checkbox" name="placeholder" class="option"><label for="wpaf_generator-text-placeholder">Utilisez ce texte comme texte indicatif du champ.</label></td>
												</tr>

												<tr>
													<th class="text-end" scope="row"><label for="wpaf_generator-text-id">ID :</label></th>
													<td><input type="text" name="id" class="idvalue oneline option" id="wpaf_generator-text-id"></td>
												</tr>

												<tr>
													<th class="text-end" scope="row"><label for="wpaf_generator-text-class">Class :</label></th>
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
										<button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="transfert()">Terminer</button>
									</div>
								</div>
							</div>
						</div>
					</div>

					<textarea style="white-space:pre-line;width:100%;" <?php if( ($wp_stored_meta['wpaf_whatsapp_switch'][0]) == 1 ) { ?> name="wpaf_contenu_formulaire_whatsapp" <?} else { ?>name="wpaf_contenu_formulaire_mail" <?} ?> id="wpaf_contenu_formulaire" rows="24" class="large-tet code mt-3"><?php if( ($wp_stored_meta['wpaf_whatsapp_switch'][0]) == 1 ) { if (! empty ($wp_stored_meta['wpaf_contenu_formulaire_whatsapp'])) echo esc_textarea ( $wp_stored_meta['wpaf_contenu_formulaire_whatsapp'][0] ); }else{ if (! empty ($wp_stored_meta['wpaf_contenu_formulaire_mail'])) echo esc_textarea ( $wp_stored_meta['wpaf_contenu_formulaire_mail'][0] ); } ?></textarea>
					
					<!-- Boutton de création de formulaire par défaut -->
					<button id="defaultForm" style="height:min-content;" class="btn btn-secondary btn-sm" <?php if( ($wp_stored_meta['wpaf_whatsapp_switch'][0]) == 0 ) { ?> onclick="buttonDefaultMail()"<?php }else{?> onclick="buttonDefaultWhatsapp()" <?php } ?>>
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-counterclockwise" viewBox="0 0 16 16">
						<path fill-rule="evenodd" d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2v1z"/>
						<path d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466z"/>
					</svg> Rétablir par défaut
					</button>

					<!-- Formulaires par défaut -->
					<input type="hidden" name="contenuFormulaireMail" value="<?php echo $wp_stored_meta['wpaf_contenu_formulaire_mail'][0];?>" />
					<input type="hidden" name="contenuFormulaireWhatsapp" value="<?php echo $wp_stored_meta['wpaf_contenu_formulaire_whatsapp'][0];?>" />
			</div>

			<?php if( ($wp_stored_meta['wpaf_whatsapp_switch'][0]) == 1 )
			{ ?>
				<div id="wpaf_email" class="tab-pane fade mt-3" role="tabpanel">						
					<div class="form-group">
						<label for="wpaf_whatsapp_tel" class="d-block mb-1"><strong>Numéro :</strong></label>
						<input type="tel" id="wpaf_whatsapp_tel" name="wpaf_whatsapp_tel" autocomplete="on" pattern="^[\d\u002D\u0028\u0029]*$" value="<?php if (!empty($wp_stored_meta['wpaf_whatsapp_tel'])) echo esc_attr($wp_stored_meta['wpaf_whatsapp_tel'][0]); ?>" class="form-control" />
						
						<!-- <span id="wpaf_whatsapp_valid" class="text-success">✓ Valid</span> -->
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

							// Codes d'erreur renvoyés par getValidationError.
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
									// Si le bouton de soumission a été désactivé, on empêche la soumission
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

							// Enregistre la valeur du drapeau sélectionné
							document.querySelector('#wpaf_whatsapp_tel').addEventListener('countrychange', function() {
								document.querySelector('#wpaf_whatsapp_flag').value = iti.getSelectedCountryData().iso2;
							});

							// Enregistre le numéro au format international
							document.querySelector('#wpaf_whatsapp_tel').addEventListener('blur', function() {
								document.querySelector('#wpaf_whatsapp_tel_international').value = iti.getNumber();
							});
						}

						jQuery(document).ready(function() {
							initWhatsApp();
						});
					</script>		
				</div>
				
			<?php }else{?> 
				<div id="wpaf_email" class="tab-pane fade mt-3" role="tabpanel">
					<table>
						<tbody>
							<tr>
								<th scope="row" style="text-align:right;">
									<label for="wpaf_pour">Pour :</label>
								</th>
								<td>
									<input type="text" name="wpaf_pour" id="wpaf_pour" class="large-text code" value="<?php if (! empty ($wp_stored_meta['wpaf_pour'])) echo esc_attr ( $wp_stored_meta['wpaf_pour'][0] ); ?>"/>
								</td>
							</tr>
							<tr>
								<th scope="row" style="text-align:right;">
									<label for="wpaf_de">De :</label>
								</th>
								<td>
									<input type="text" name="wpaf_de" id="wpaf_de" class="large-text code" value="<?php if (! empty ($wp_stored_meta['wpaf_de'])) echo esc_attr ( $wp_stored_meta['wpaf_de'][0] ); ?>"/>
								</td>
							</tr>
							<tr>
								<th scope="row" style="text-align:right;">
									<label for="wpaf_objet" >Objet :</label>
								</th>
								<td>
									<input type="text" name="wpaf_objet" id="wpaf_objet" class="large-text code" value="<?php if (! empty ($wp_stored_meta['wpaf_objet'])) echo esc_attr ( $wp_stored_meta['wpaf_objet'][0] ); ?>"/>
								</td>
							</tr>
							<tr>
								<th scope="row" style="text-align:right;">
									<label for="wpaf_contenu">Contenu du message :</label>
								</th>
								<td>
									<textarea cols="100" rows="18" name="wpaf_contenu" id="wpaf_contenu" class="large-text code"> <?php if (! empty ($wp_stored_meta['wpaf_contenu'])) echo esc_attr ( $wp_stored_meta['wpaf_contenu'][0] ); ?></textarea>
								</td>
							</tr>
						</tbody>
					</table>
				</div>

			<?php } ?>
			<div id="wpaf_message" class="tab-pane fade mt-3" role="tabpanel">
				<div class="mb-3">
					<label for="wpaf_succes" class="form-label"><strong>Le message de l'expéditeur a été envoyé :</strong></label>
					<input type="text" name="wpaf_succes" id="wpaf_succes" class="large-text w-100"  value="<?php if (! empty ($wp_stored_meta['wpaf_succes'])) echo esc_attr ( $wp_stored_meta['wpaf_succes'][0] );?>"/>   
				</div>

				<div class="mb-3">
					<label for="wpaf_erreur" class="form-label"><strong>Le message de l'expéditeur n'a pas pu être envoyé :</strong></label>
					<input type="text"  name="wpaf_erreur" id="wpaf_erreur" class="large-text w-100"   value="<?php if (! empty ($wp_stored_meta['wpaf_erreur'])) echo esc_attr ( $wp_stored_meta['wpaf_erreur'][0] );?>"/> 
				</div>
			</div>
		</div>
	</body>
</html>
