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
		$content .= '<form accept-charset="UTF-8" method="post" action="'.plugin_dir_url(__FILE__).'process/validation.php">';

		$content .= '<label for="name">Prénom</label><br/>';
		$content .= '<input type="text" name="name" placeholder="Votre prénom" required/> <br/>';

		$content .= '<label for="email">Adresse mail</label><br/>';
		$content .= '<input type="email" name="email" placeholder="Votre email" required/> <br/>';

		$content .= '<label for="objectif">Quel est votre objectif ?</label><br/>';
		$content .= '<textarea name="objectif" placeholder="Votre objectif" required></textarea> <br/>';

		$content .= '<input type="submit" name="wp_action_form_submit" value="Envoyer"/>';

	/* fermeture du formulaire */
	$content .= '</form>';

	return $content;
    
}

add_shortcode( 'wp-action-form', 'wp_action_form_include' );
