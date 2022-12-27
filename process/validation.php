<?php


  //Appel de wp-load
	$path = preg_replace('/wp-content.*$/','',__DIR__);
	require_once($path."wp-load.php");

          $postID = get_queried_object_id();
          $wp_stored_meta_validation = get_post_meta( $postID);

  // Vérification nonce
     if(isset($_POST['_wpnonce'])){

          //Validation nonce
       if (!wp_verify_nonce( $_POST['_wpnonce'], 'nonce_verification' )){

          //  echo('La vérification du token a échouée.');
           exit;

          }else{
               
          //  echo('La vérification du token a réussie.');

                    $captchaSecretKey = "6LcYu_gaAAAAABimzPHTm0YalpPykqaShey0KstW";
                    //reCAPTCHA validation
                    if (isset($_POST['g-recaptcha-response'])) {

                         $postData = array(
                              'secret' => $captchaSecretKey,
                              'response' => $_POST['g-recaptcha-response']
                              
                         );

                    $url = "https://www.google.com/recaptcha/api/siteverify";

                         $curl = curl_init();
                         curl_setopt($curl, CURLOPT_URL, $url);
                         curl_setopt($curl, CURLOPT_POST, true);
                         curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($postData));
                         curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                         curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                         $serverResponse = curl_exec($curl);
                         
                         if(json_decode($serverResponse,true)['score'] <= 0.5)
                         {
                              echo ("recaptchaValidation=false") ; exit;
                         }else{
                              echo ("recaptchaValidation=true");

                              //Envoi des données vers la database

                                   global $wpdp;
                                   $data= array(
                                             'name' => sanitize_text_field($_POST['name']),
                                             'email' => sanitize_text_field($_POST['email']),
                                             'objectif' => sanitize_textarea_field($_POST['objectif']),
                                             );

                                   $table_name =  $wpdb->prefix . 'formulaire';

                                   $result = $wpdb->insert($table_name, $data);

                                   if ($result===0) {
                                        echo "<script>alert('Impossible d'enregistrer les données.');</script>";
                                        exit;
                                   }else{
                                        echo "<script>alert('Données enregistrées.');</script>";
                                   }

                              //Adresse mail de réception
                                   // $to = esc_attr ( $wp_stored_meta_validation['wpaf_pour'][0]);
                                   $to = "axel.barel@gmail.com";

                                        
                              //Obtention et filtre des données de l'utilisateur
                                   $name = sanitize_text_field($_POST['name']); 
                                   $email = sanitize_text_field($_POST['email']);
                                   $objectif = sanitize_textarea_field($_POST['objectif']);
                                   // $fichier = ($_POST['file']);
                                   
                              //Supression des backslash potentiels lors de l'utilisation d'apostrophes
                                   $Newobjectif = str_replace("\\","",$objectif);
                                   
                              //Sujet du mail que nous recevrons
                                   $subject = esc_attr ( $wp_stored_meta_validation['wpaf_objet'][0] );
                                   
                              //Sujet du mail de confirmation pour l'utilisateur
                                   $subject2 = "Confirmation";
                                   
                              //Email que nous recevrons
                                   // $message = "Prénom de l'utilisateur : " . $name . "\n\n"
                                   // . "Adresse mail : " . $email . "\n\n"
                                   // . "Message soumis par l'utilisateur : " . "\n" . $Newobjectif . "\n\n";
                                   // . "Fichier envoyé : ". $fichier;
                                   $message = esc_attr ( $wp_stored_meta_validation['wpaf_contenu'][0] );
                              //Message de confirmation pour l'utilisateur
                                   $message2 = "";
                              //Headers
                                   $headers = esc_attr ( $wp_stored_meta_validation['wpaf_de'][0] ); // Mail de l'utilisateur que nous recevrons
                                   $headers2 = "From: Wordpress@wp-action-form.actopix.com";// Mail que l'utilisateur recevra

                              //fonction mail PHP
                                   $result1 = wp_mail($to, $subject, $message, $headers); // Mail envoyé à l'adresse de l'admin
                                   $result2 = wp_mail($email, $subject2, $message2, $headers2); //Mail de confirmation envoyé au client
                                   

                              //Redirection vers le formulaire et réinitialisation de ce dernier
                                   // header("Location:https://wp-action-form.actopix.com/wp-action-form/");
                         }

                         // Si le bouton WhatsApp est cliqué, envoi du message
                         if(isset($_POST['wpaf_whatsapp_submit'])) {
                              //Compte WhatsApp visé
                                   $tel = esc_attr ( $wp_stored_meta_validation['wpaf_whatsapp_tel'][0] );;
                                   
                              //Obtention et filtre des données de l'utilisateur
                                   $name = sanitize_text_field($_POST['name']); 
                                   $email = sanitize_email($_POST['email']);
                                   // $fichier = ($_POST['file']);
                                   $objectif = sanitize_textarea_field($_POST['objectif']);
                              
                              //Supression des backslash potentiels lors de l'utilisation d'apostrophes + espaces au format du lien WhatsApp
                                   $Newobjectif = str_replace(
                                        array("\\"," ",$objectif),
                                        array("","%20"),
                                        $objectif
                                   );

                              //Message qui sera envoyé
                                   $link = "https://wa.me/" . $tel . "?text=" . $Newobjectif;


                              //Redirection vers le formulaire
                                   header("Location:". $link);
                                   (die);

                         }
     
                         // //reCaptcha Ajax CURL
                         // $curlData = array(
                         //      'secret'	=> '6LcYu_gaAAAAABimzPHTm0YalpPykqaShey0KstW',
                         //      'response'	=> $token
                         // );

                         // $ch = curl_init();
                         // curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
                         // curl_setopt($ch, CURLOPT_POST, 1);
                         // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($curlData));
                         // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                         // $curlResponse = curl_exec($ch);

                         // $captchaResponse = json_decode($curlResponse, true);

                         // if($captchaResponse['success'] == '1' 
                         //      && $captchaResponse['action'] == $action 
                         //      && $captchaResponse['score'] >= 0.5 
                         //      && $captchaResponse['hostname'] ==  $_SERVER['SERVER_NAME'])
                         // {
                         //      echo 'Form Submitted Successfully';
                         // }
                         // else{
                         //      echo 'You are not a human';
                         // }

     }}}