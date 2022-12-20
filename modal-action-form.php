   <!doctype html>
<html lang="en">
<head>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
	<script src="<?echo plugin_dir_url(__FILE__)?>js/action-form-admin.js"></script>
</head>
<body>
 
<div class="tab-content" id="wpaf_myTabContent">

<ul class="nav nav-tabs" id="wpaf_myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="wpaf_home-tab" data-bs-toggle="tab" data-bs-target="#wpaf_formulaire" type="button" role="tab" aria-controls="home" aria-selected="true">formulaire</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="wpaf_profile-tab" data-bs-toggle="tab" data-bs-target="#wpaf_email" type="button" role="tab" aria-controls="profile" aria-selected="false">email</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="wpaf_contact-tab" data-bs-toggle="tab" data-bs-target="#wpaf_message" type="button" role="tab" aria-controls="contact" aria-selected="false">message</button>
  </li>
</ul>

<!-- Boutton toggle changement de formulaire WhatsAPP -->

<input type="checkbox" id="switch" /><label for="switch">Toggle</label>

<style>

/* input[type=checkbox]{
	height: 0;
	width: 0;
	visibility: hidden;
}

label {
	cursor: pointer;
	text-indent: -9999px;
	width: 200px;
	height: 100px;
	background: grey;
	display: block;
	border-radius: 100px;
	position: relative;
}

label:after {
	content: '';
	position: absolute;
	top: 5px;
	left: 5px;
	width: 90px;
	height: 90px;
	background: #fff;
	border-radius: 90px;
	transition: 0.3s;
}

input:checked + label {
	background: #25D366;
}

input:checked + label:after {
	left: calc(100% - 5px);
	transform: translateX(-100%);
}

label:active:after {
	width: 130px;
}

// centering
body {
	display: flex;
	justify-content: center;
	align-items: center;
	height: 100vh;
} */

</style>
<!-- Boutton toggle changement de formulaire WhatsAPP -->

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
										<td ><input type="text" name="label" class="tg-name oneline" id="wpaf_generator-text-label" onchange="modalTextGenerator()" value=""></td>
									</tr>

									<tr>
										<th class="text-end" scope="row"><label for="wpaf_generator-text-name">Nom :</label></th>
										<td ><input type="text" name="name" class="tg-name oneline" id="wpaf_generator-text-name" onchange="modalTextGenerator()" value=""></td>
									</tr>

									<tr>
										<th class="text-end" scope="row"><label for="wpaf_generator-text-value">Valeur :</label></th>
										<td><input type="text" name="value" class="oneline" id="wpaf_generator-text-value" onchange="modalTextGenerator()" ></td>
									</tr>

									<tr>
										<td></td>
										<td class="pt-n3"><input type="checkbox" name="placeholder"  id="wpaf_generator-text-placeholder" class="option" onclick="modalTextGenerator()"> Utilisez ce texte comme texte indicatif du champ.</td>
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
										<td ><input type="text" name="label" class="tg-name oneline" id="wpaf_generator-text-email" onchange="modalTextGenerator()" value=""></td>
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
										<td class="pt-n3"><input type="checkbox" id="wpaf_generator-email-placeholder" name="placeholder" class="option" onclick="modalEmailGenerator()"> Utilisez ce texte comme texte indicatif du champ.</td>
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
										<th class="text-end" scope="row"><label for="wpaf_generator-textarea-label">Label :</label></th>
										<td ><input type="text" name="label" class="tg-name oneline" id="wpaf_generator-textarea-label" onchange="modalTextGenerator()" value=""></td>
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
										<td class="pt-n3"><input type="checkbox" id="wpaf_generator-textarea-placeholder" name="placeholder" class="option" onclick="modalTextareaGenerator()"> Utilisez ce texte comme texte indicatif du champ.</td>
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
										<td ><input type="text" name="label" class="tg-name oneline" id="wpaf_generator-tel-label" onchange="modalTextGenerator()" value=""></td>
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
										<td class="pt-n3"><input type="checkbox" id="wpaf_generator-tel-placeholder" name="placeholder" class="option" onclick="modalTelGenerator()"> Utilisez ce texte comme texte indicatif du champ.</td>
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
										<td class="pt-n3"><input type="checkbox" name="placeholder" class="option"> Utilisez ce texte comme texte indicatif du champ.</td>
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
										<td class="pt-n3"><input type="checkbox" name="placeholder" class="option"> Utilisez ce texte comme texte indicatif du champ.</td>
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
										<td class="pt-n3"><input type="checkbox" name="placeholder" class="option"> Utilisez ce texte comme texte indicatif du champ.</td>
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
										<td class="pt-n3"><input type="checkbox" name="placeholder" class="option"> Utilisez ce texte comme texte indicatif du champ.</td>
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
										<td class="pt-n3"><input type="checkbox" name="placeholder" class="option"> Utilisez ce texte comme texte indicatif du champ.</td>
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

		<textarea style="width:100%" id="wpaf_contenu_formulaire" name="wpaf_contenu_formulaire" rows="24" class="large-tet code mt-3"><?php if (! empty ($wp_stored_meta['wpaf_contenu_formulaire'])) echo esc_textarea ( $wp_stored_meta['wpaf_contenu_formulaire'][0] ); ?></textarea>

  </div>


	<div id="wpaf_email" class="tab-pane fade mt-3" role="tabpanel">
		<form> 
			<table>
				<tbody>
					<tr>
						<th scope="row" style="text-align:right;">
							<label for="wpaf_pour">Pour :</label>
						</th>
						<td>
							<input type="text" name="wpaf_pour" id="wpaf_pour" class="large-text code" size"70" value="<?php if (! empty ($wp_stored_meta['wpaf_pour'])) echo esc_attr ( $wp_stored_meta['wpaf_pour'][0] ); ?> "/>
						</td>
					</tr>
					<tr>
						<th scope="row" style="text-align:right;">
							<label for="wpaf_de">De :</label>
						</th>
						<td>
							<input type="text" name="wpaf_de" id="wpaf_de" class="large-text code" size"70" value="<?php if (! empty ($wp_stored_meta['wpaf_de'])) echo esc_attr ( $wp_stored_meta['wpaf_de'][0] ); ?> "/>
						</td>
					</tr>
					<tr>
						<th scope="row" style="text-align:right;">
							<label for="wpaf_objet" >Objet :</label>
						</th>
						<td>
							<input type="text" name="wpaf_objet" id="wpaf_objet" class="large-text code" size"70" value="<?php if (! empty ($wp_stored_meta['wpaf_objet'])) echo esc_attr ( $wp_stored_meta['wpaf_objet'][0] ); ?> "/>
						</td>
					</tr>
					<tr>
						<th scope="row" style="text-align:right;">
							<label for="wpaf_contenu">Contenu du message :</label>
						</th>
						<td>
							<textarea cols="100" rows="18" name="wpaf_contenu" id="wpaf_contenu" class="large-text code" size"70"> <?php if (! empty ($wp_stored_meta['wpaf_contenu'])) echo esc_attr ( $wp_stored_meta['wpaf_contenu'][0] ); ?></textarea>
						</td>
					</tr>
			</tbody>
			</table>
		</form> 
	</div>
	
	<div id="wpaf_message" class="tab-pane fade mt-3" role="tabpanel">
		<div class="mb-3">
			<label for="wpaf_succes" class="form-label"><strong>Le message de l'expéditeur a été envoyé :</strong></label>
			<input type="text" name="wpaf_succes" id="wpaf_succes" class="large-text w-100"  value="<?php if (! empty ($wp_stored_meta['wpaf_succes'])) echo esc_attr ( $wp_stored_meta['wpaf_succes'][0] ); ?> "/>   
		</div>

		<div class="mb-3">
			<label for="wpaf_erreur" class="form-label"><strong>Le message de l'expéditeur n'a pas pu être envoyé :</strong></label>
			<input type="text"  name="wpaf_erreur" id="wpaf_erreur" class="large-text w-100"   value="<?php if (! empty ($wp_stored_meta['wpaf_erreur'])) echo esc_attr ( $wp_stored_meta['wpaf_erreur'][0] ); ?> "/> 
		</div>
	</div>
</div>
</body>
</html>
