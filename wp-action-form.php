<?php
/**
 * Plugin Name: wp-action-form
 * Description: Formulaire WordPress
 * Version: 1.0
 */

function wp_action_form() {
    echo `<form accept-charset="UTF-8" action="validation.php" method="post">`;
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
    include 'validation.php';
    envoi_mail();
    wp_action_form();

    return ob_get_clean();
}

add_shortcode( 'wp-action-form', 'shortcode' );