<?php

  //Appel de wp-load
	$path = preg_replace('/wp-content.*$/','',__DIR__);
	require_once($path."wp-load.php");

  // Si le bouton submit est cliqué, envoi du mail
     if(isset($_POST['wp_action_form_submit'])) {
          //Adresse mail de réception
               $to = get_option('admin_email');
               
          //Obtention et filtre des données de l'utilisateur
               $name = sanitize_text_field($_POST['name']); 
               $email = sanitize_email($_POST['email']); 
               $objectif = sanitize_textarea_field($_POST['objectif']);
          
          //Supression des backslash potentiels lors de l'utilisation d'apostrophes
               $Newobjectif = str_replace("\\","",$objectif);
          
          //Sujet du mail que nous recevrons
               $subject = "Message d'un utilisateur";
          
          //Sujet du mail de confirmation pour l'utilisateur
               $subject2 = "Confirmation : Votre message a bien été envoyé"; 
          
          //Email que nous recevrons
               $message = "Prénom de l'utilisateur : " . $name . "\n"
               . "Adresse mail : " . $email . "\n"
               . "Message: " . "\n" . $Newobjectif;

          //Message de confirmation pour l'utilisateur
               $message2 = "Cher " . $name . ",\n"
               . "Merci de nous avoir contactés. Nous vous répondrons sous peu !" . "\n"
               . "Vous avez soumis le message suivant : " . "\n" . $Newobjectif . "\n";
          
          //Headers
                $headers = "From: " . $email; // Mail de l'utilisateur que nous recevrons
                $headers2 = "From: " . $to; // Mail que l'utilisateur recevra

          //fonction mail PHP
               wp_mail($to, $subject, $message, $headers); // Mail envoyé à notre l'adresse
               wp_mail($email, $subject2, $message2, $headers2); //Mail de confirmation envoyé au client

          //Vérification de l'envoie des mails
               if ($result1 && $result2) {
                    $succés = "Votre message a été soumis avec succès !";
               } else {
                    $echec = "Erreur : le message n'a pas été envoyé. Veuillez réessayer plus tard";
               }
          
          //Redirection vers le formulaire
               header("Location:http://wp-action-form.local/action-form/");

     }

?>