<?php

echo ($_POST['name']);

    // Si le bouton submit est cliqué, envoi du mail
    if(isset($_POST['submit'])) {
        //Adresse mail de réception
        $to = "axel.barel@gmail.com";  
        
        //Obtention et filtre des données de l'utilisateur
        $name = sanitize_text_field($_POST['name']); 
        $email = sanitize_email($_POST['email']); 
        $objectif = esc_textarea($_POST['objectif']);

        //Sujet du mail que nous recevrons
        $subject = "Message d'un utilisateur";

        //Sujet du mail de confirmation pour l'utilisateur
        $subject2 = "Confirmation : Votre message a bien été envoyé"; 
        
        //Email que nous recevrons
        $message = "Prénom de l'utilisateur : " . $name . "\n"
        . "Adresse mail : " . $email . "\n\n"
        . "Message: " . "\n" . $objectif;
        
        //Message de confirmation pour l'utilisateur
        $message2 = "Cher" . $name . "\n"
        . "Merci de nous avoir contactés. Nous vous répondrons sous peu !" . "\n\n"
        . "Vous avez soumis le message suivant : " . "\n" . $objectif . "\n\n";
        
        
        //fonction mail PHP
        $result1 = wp_mail($to, $subject, $message); // Mail envoyé à notre l'adresse
        $result2 = wp_mail($fromEmail, $subject2, $message2); //Mail de confirmation envoyé au client
        
    //Vérification de l'envoie des mails
    //     if ($result1 && $result2 != null) {
    //         $succés = "Votre message a été soumis avec succès !";
    //     } else {
    //         $echec = "Erreur : le message n'a pas été envoyé. Veuillez réessayer plus tard";
    //     }

    header("Location:http://wp-action-form.local/action-form/");
        
}
