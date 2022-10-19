<?php
/**
 * Plugin Name: wp-action-form
 * Description: Formulaire WordPress
 * Version: 1.0
 */

function wp_action_form() {

    $formulaire = '<form accept-charset="UTF-8" action="';
    $url = plugins_url( 'validation.php', __FILE__ );
    $fin_formulaire = '" method="post">';

    echo $formulaire;
    echo $url;
    echo $fin_formulaire;
    
    echo '<p>';
    echo 'Prénom* <br/>';
    echo '<input type="text" name="name" pattern="[a-zA-Z0-9 ]+" placeholder="Votre prénom" autofocus required />';
    echo '</p>';
    echo '<p>';
    echo 'Email* <br/>';
    echo '<input type="email" name="email" placeholder="Votre email" required />';
    echo '</p>';
    echo '<p>';
    echo 'Quel est votre objectif ?* <br />';
    echo '<textarea name="objectif" placeholder="Votre objectif" required></textarea>';
    echo '</p>';
    echo '<p>';
    echo '*requis';
    echo '</p>';
    echo '<p><input type="submit" name="submit" id="submit" value="Envoyer"/></p>';
    echo '</form>';
    
}

function shortcode() {
    ob_start();
    
    wp_action_form();

    return ob_get_clean();
}

add_shortcode( 'wp-action-form', 'shortcode' );
