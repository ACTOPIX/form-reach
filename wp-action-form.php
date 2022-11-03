<?php
/**
 * Plugin Name: wp-action-form
 * Description: Formulaire WordPress
 * Version: 1.0
 */

function admin (){
	
	add_menu_page( 'WP Action Form - Admin', 'WP Admin', 'manage_options', 'wp-admin', 'admin_page' );
}

add_action( "admin_menu", "admin" );

function admin_page(){
	
	//Déclaration de la variable en 'string' pour contenir l'HTML
	$content = '';
	
	$content .= '<!DOCTYPE html>
				<html lang="en">
					<head>
						<meta charset="UTF-8">
						<meta http-equiv="X-UA-Compatible" content="IE=edge">
						<meta name="viewport" content="width=device-width, initial-scale=1.0">
						<title>Document</title>
						<link rel="stylesheet" href="style/admin.css">
						<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
						<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"></script>
					</head>
					<body>
						<h1 class="p-5">Formulaire de contact</h1>


						<form class="position-absolute top-2 end-0 pe-5">
							<div class="row g-1 align-items-center">
								<div class="col-auto">
									<input type="search" style="width=200px" name="search" class="form-control" placeholder="Rechercher">
								</div>

								<div class="col-auto">
								<button type="submit" name="search_submit" class="btn btn-primary mx-auto">
									<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
										<path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
									</svg>
								</button>
								</div>
							</div>
						</form>


						<div class="input-group mt-5 w-50 ps-5 pt-4">
							<select class="form-select" id="inputGroupSelect04">
								<option selected>Action groupées</option>
								<option value="1">Fusionner</option>
								<option value="2">Duppliquer</option>
								<option value="3">Supprimer</option>
							</select>
							<button class="btn btn-outline-secondary" type="button">Appliquer</button>
						</div>

						<div class="w-75 ps-5 pt-3">
							<table class="table table-striped table-hover table-bordered p-3">
								<thead>
									<tr>
										<th scope="col">

										</th>
										<th scope="col">
											Titre
										</th>
										<th scope="col">
											Code court
										</th>
										<th scope="col">
											Auteur
										</th>
										<th scope="col">
											Date
										</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th scope="row">
											<input class="form-check-input" type="checkbox" id="checkboxNoLabel" value="">
										</th>
										<td>
											WP-Action-Form 1
										</td>
										<td>
											[wp-action-form]
										</td>
										<td>
											Axel
										</td>
										<td>
											17/10/2022
										</td>
									</tr>
									<tr>
										<th scope="row"><input class="form-check-input" type="checkbox" id="checkboxNoLabel" value=""></th>
										<td>
											WhatsApp 1
										</td>
										<td>
											[wp-action-form-whatsapp]
										</td>
										<td>
											Axel
										</td>
										<td>
											24/10/2022
										</td>
									</tr>
							</table>
						</div>
					</body>
				</html>';
								
	echo $content;
								

}

function wp_action_form_include() {
	
	//Déclaration de la variable en 'string' pour contenir l'HTML
	$content = '';
	
	$content .= '<!DOCTYPE html>
				<html lang="en">
					<head>
						<meta charset="UTF-8">
						<meta http-equiv="X-UA-Compatible" content="IE=edge">
						<meta name="viewport" content="width=device-width, initial-scale=1.0">
						<title>Document</title>
						<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
						<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"></script>
						<script src="https://www.google.com/recaptcha/api.js"></script>
						<script>
							function onSubmit(token) {
								document.getElementById("1").submit();
							}
						</script>
					</head>
					<body>
						<form id="1" accept-charset="UTF-8" name="contact_form" method="post" action="'.plugin_dir_url(__FILE__).'process/validation.php">
							<div class="form-floating mb-3 mt-3">
							'.wp_nonce_field('nonce_verification').'
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

     						<input type="hidden" name="g-recaptcha-response" id="recaptcha">

							<button type="submit" id="envoi_button" name="wp_action_form_submit" class="btn btn-primary mb-3 mt-3 g-recaptcha" data-sitekey="6LcYu_gaAAAAANJVIQPE35j97DxUCXXozlLiXhpK" data-callback="onSubmit" data-action="submit">
								<svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
									<path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/>
								</svg> Envoyer
							</button>
						</form>
					</body>
				</html>';
								
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
	
	$content .= '<!DOCTYPE html>
				<html lang="en">
					<head>
						<meta charset="UTF-8">
						<meta http-equiv="X-UA-Compatible" content="IE=edge">
						<meta name="viewport" content="width=device-width, initial-scale=1.0">
						<title>Document</title>
						<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
						<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"></script>
						<script src="https://www.google.com/recaptcha/api.js"></script>
					</head>
					<body>
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
						</form>
					</body>
				</html>';
				
	return $content;
    
	//Pour ajouter un input file, rajouter ces lignes dans le content
		// 	<div class="mb-3">
		// 	<label for="formFileMultiple" class="form-label"></label>
		// 	<input class="form-control" type="file" name="file" accept=".jpg, .jpeg, .png" multiple>
		// </div>
}
add_shortcode( 'wp-action-form-whatsapp', 'wp_action_form_whatsapp_include' );

//clées reCaptcha
$public_key='6LcYu_gaAAAAANJVIQPE35j97DxUCXXozlLiXhpK';
$secret_key='6LcYu_gaAAAAABimzPHTm0YalpPykqaShey0KstW';

// if(isset($_POST['_wpnonce'])){
// 	$recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
// 	$recaptcha_secret = '6LcYu_gaAAAAABimzPHTm0YalpPykqaShey0KstW';
// 	$recaptcha_response = $_POST['g-recaptcha-response'];
	
// 	$recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '& response=' . $recaptcha_response);
// 	$recaptcha = json_decode($recaptcha, true);
	
// 	if ($recaptcha['success'] == 1 AND $recaptcha['score'] >= 0.5 AND $recaptcha['action'] == "login") {
		
// 		//succés
// 		console.log("succés recaptcha");

		
// 	}else {
		
// 		//reCaptcha non vérifié, derirection vers l'erreur
// 		console.log("erreur recaptcha");
		
// 	}
	
// }


//  if(isset($_POST['wp_action_form_submit'])) 
// {
// 		//La réponse donnée par le formulaire soumis */
// 		$response_key = $_POST['g-recaptcha-response'];
// 		//Envoi les données à l'API pour obtenir une réponse  */
// 		$response = file_get_contents($url.'?secret='.$private_key.'&response='.$response_key.'&remoteip='.$_SERVER['REMOTE_ADDR']);
// 		//json décode la réponse en un objet */
// 		$response = json_decode($response);
	
// 		//if success */
// 		if($response->success == 1)
// 		{
// 				echo "Vous avez passé la validation !";
// 			}
// 			else
// 			{
// 					echo "Vous êtes un robot et nous n'aimons pas les robots.";
// 				}
// 			}
			
?>