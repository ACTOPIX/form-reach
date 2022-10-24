<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php
/**
 * Plugin Name: wp-action-form
 * Description: Formulaire WordPress
 * Version: 1.0
 */


function wp_action_form_include() {
	$public_key='6LdPM5kiAAAAADDmAOrtEDSCT9g6XlSTLsZIIoqZ';

	//Création d'une variable "string" pour contenir l'HTML
	$content = '';
	
	//ouverture du formulaire
	$content .= '<form accept-charset="UTF-8" method="post" action="'.plugin_dir_url(__FILE__).'process/validation.php">
	<div class="form-floating mb-3 mt-3">
	<input type="text" class="form-control" id="prenom" name="name" placeholder="Prénom" required/>
	<label for="name">Prénom</label
	</div>
	
	<div class="form-floating mb-3 mt-3">
	<input type="email" class="form-control" id="mail" name="email" placeholder="Adresse mail" required/>
	<label for="email">Adresse mail</label
	</div>
	
	
	<div class="form-floating mb-3 mt-3">
	<textarea class="form-control" style="height: 100px" name="objectif" placeholder="Quel est votre objectif ?" required></textarea>
	<label for="floatingTextarea2">Quel est votre objectif ?</label
	</div>

	<div class="g-recaptcha mb-3 mt-3" data-sitekey="'. $public_key .'"></div>
	
	<input type="submit" name="wp_action_form_submit" class="btn btn-primary mb-3 mt-3" value="Envoyer"/>
	</form>';
	
	return $content;
    
}
//clées reCaptcha
	$public_key='6LdPM5kiAAAAADDmAOrtEDSCT9g6XlSTLsZIIoqZ';
	$private_key='6LdPM5kiAAAAABWt9daBZFnTHFwcoMkGAm2Sgrkr';
	$url = "https://www.google.com/recaptcha/api/siteverify";


     if(isset($_POST['wp_action_form_submit'])) 
	{
		//La réponse donnée par le formulaire soumis */
		$response_key = $_POST['g-recaptcha-response'];
		//Envoi les données à l'API pour obtenir une réponse  */
		$response = file_get_contents($url.'?secret='.$private_key.'&response='.$response_key.'&remoteip='.$_SERVER['REMOTE_ADDR']);
		//json décode la réponse en un objet */
		$response = json_decode($response);

		//if success */
		if($response->success == 1)
		{
			echo "Vous avez passé la validation !";
		}
		else
		{
			echo "Vous êtes un robot et nous n'aimons pas les robots.";
		}
	}

add_shortcode( 'wp-action-form', 'wp_action_form_include' );
?>
