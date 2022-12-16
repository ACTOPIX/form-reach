<?php
/**
 * Plugin Name: wp-action-form
 * Description: Formulaire WordPress
 * Version: 1.0
 */

include 'action-form-admin.php';

function wp_action_form_include() {


	//Déclaration de la variable en 'string' pour contenir l'HTML
	$content = '';
	
	$content .= '
						<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
						<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"></script>
						<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
                        <script src="'.plugin_dir_url(__FILE__).'js/wp-action-form.js"></script>
						<script src="https://www.google.com/recaptcha/api.js?render=6LcYu_gaAAAAANJVIQPE35j97DxUCXXozlLiXhpK"></script>

						<form id="action_form" accept-charset="UTF-8" name="action_form" method="post" action="javascript:void(0)">
						
							<div class="form-floating mb-3 mt-3">
								'.wp_nonce_field('nonce_verification').'
								<input type="text" class="form-control" id="name" name="name" placeholder="Prénom" required/>
								<label for="name">Prénom</label>
							</div>
								
							<div class="form-floating mb-3 mt-3">
								<input type="email" class="form-control" id="email" name="email" placeholder="Adresse mail" required/>
								<label for="email">Adresse mail</label>
							</div>
								
							<div class="form-floating mb-3 mt-3">
								<textarea class="form-control" style="height: 100px" id="objectif" name="objectif" placeholder="Quel est votre objectif ?" required></textarea>
								<label for="floatingTextarea2">Quel est votre objectif ?</label>
							</div>

        					<input type="hidden" name="g-recaptcha-response" value="" id="g-recaptcha-response">

							<button type="submit" id="submit" name="wp_action_form_submit" class="btn btn-primary mb-3 mt-3 g-recaptcha">
								<div id="submitContent">
									<svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
										<path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/>
									</svg> Envoyer
								</div>
								<div id="spinner" class="spinner-border spinner-border-sm" style="display:none"></div>
							</button>
							
							</form>
							
							<div id="success_message" class="alert alert-success position-absolute start-50 translate-middle" style="display:none">
								<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
									<path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
								</svg>
								Le formulaire a été envoyé avec succès.
							</div>

							<div id="error_message" class="alert alert-danger position-absolute start-50 translate-middle" style="display:none">
								<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
									<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
								</svg>
								Le formulaire n\'a pas pu être envoyé suite à une erreur. Veuillez réessayer.
							</div>';
								
	return $content;
						

	//Pour ajouter un input file, rajouter ces lignes dans le content
			// 	<div class="mb-3">
			// 	<label for="formFileMultiple" class="form-label"></label>
			// 	<input class="form-control" type="file" name="file" accept=".jpg, .jpeg, .png" multiple>
			// </div>
}

add_shortcode( 'wp-action-form', 'wp_action_form_include' );
							
function wp_action_form_whatsapp_include() {
	
	//Déclaration de la variable en 'string' pour contenir l'HTML
	$content = '';
	
	$content .= '
						<meta charset="UTF-8">
						<meta http-equiv="X-UA-Compatible" content="IE=edge">
						<meta name="viewport" content="width=device-width, initial-scale=1.0">
						<title>Document</title>
						<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
						<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"></script>
						<script src="https://www.google.com/recaptcha/api.js"></script>
					
						<form id="2" accept-charset="UTF-8" name="contact_form" method="post" action="'.plugin_dir_url(__FILE__).'process/validation.php">
							<div class="form-floating mb-3 mt-3">
								<input type="text" class="form-control" id="prenom" name="name" placeholder="Prénom" required/>
								<label for="name">Prénom</label>
							</div>
								
							<div class="form-floating mb-3 mt-3">
								<input type="email" class="form-control" id="mail" name="email" placeholder="Adresse mail" required/>
								<label for="email">Adresse mail</label>
							</div>
								
							<div class="form-floating mb-3 mt-3">
								<textarea class="form-control" style="height: 100px" name="objectif" placeholder="Quel est votre objectif ?" required></textarea>
								<label for="floatingTextarea2">Quel est votre objectif ?</label>
							</div>

							<button type="submit" id ="whatsapp" name="whatsapp" class="btn btn-success">
								<svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
									<path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
								</svg> WhatsApp
							</button>
						</form>';
				
	return $content;
    
	//Pour ajouter un input file, rajouter ces lignes dans le content
		// 	<div class="mb-3">
		// 	<label for="formFileMultiple" class="form-label"></label>
		// 	<input class="form-control" type="file" name="file" accept=".jpg, .jpeg, .png" multiple>
		// </div>
}
add_shortcode( 'wp-action-form-whatsapp', 'wp_action_form_whatsapp_include' );