<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"></script>
<?php
/**
 * Plugin Name: wp-action-form
 * Description: Formulaire WordPress
 * Version: 1.0
 */

function wp_action_form_include() {
	/* Création d'une variable "string" pour contenir l'HTML */
		$content = '';

	/* ouverture du formulaire */
		$content .= '<form accept-charset="UTF-8" method="post" action="'.plugin_dir_url(__FILE__).'process/validation.php">
		            <div class="form-floating mb-3 mt-3">
					<input type="text" class="form-control" id="prenom" name="name" pattern="[a-zA-Z0-9] placeholder="Prénom" required/>
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
		
					<input type="submit" name="wp_action_form_submit" class="btn btn-primary mb-3 mt-3" value="Envoyer"/>
					</form>';

	return $content;
    
}

add_shortcode( 'wp-action-form', 'wp_action_form_include' );
