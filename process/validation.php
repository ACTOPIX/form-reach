<?php

  //Appel de wp-load
	$path = preg_replace('/wp-content.*$/','',__DIR__);
	require_once($path."wp-load.php");

  //Vérification nonce
     if(isset($_POST['_wpnonce'])){

          if (!wp_verify_nonce( $_POST['_wpnonce'], 'nonce_verification' )){

            //La vérification du token a échouée
           exit;

          }else{
               
               //La vérification du token a réussie.

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

                              //Récupération et initialisation de l'ID concerné
                                   $postID = sanitize_text_field($_POST['wpaf_container_post']);
                                   $wp_stored_meta_validation_mail = get_post_meta($postID);


                              //Définition des variables
                                   //Adresses mails 
                                        $toAdministrateur = esc_attr ( $wp_stored_meta_validation_mail['wpaf_pour'][0]);
                                        // $toUtilisateur =

                                   //Sujets
                                        $sujetAdministrateur = str_replace("&#039;","'",esc_attr ( $wp_stored_meta_validation_mail['wpaf_objet'][0] ));
                                        // $sujetUtilisateur = "Confirmation";

                                   //Contenus
                                        $contenuAdministrateur = str_replace("&#039;","'",esc_attr ( $wp_stored_meta_validation_mail['wpaf_contenu'][0] ));
                                             // $contenuUtilisateur = "Nous avons bien reçu votre message. Nous reviendrons vers vous au plus vite.";
                                             
                                   //En-têtes
                                        $titreAdministrateur = str_replace("&#039;","'",esc_attr ( $wp_stored_meta_validation_mail['wpaf_de'][0] ));
                                        // $titreUtilisateur = "From: Wordpress@wp-action-form.actopix.com";

                                   //Envoi des mails
                                        $mailAdministrateur = wp_mail($toAdministrateur, $sujetAdministrateur, $contenuAdministrateur, $titreAdministrateur);
                                        // $mailUtilisateur = wp_mail($toUtilisateur, $sujetUtilisateur, $contenuUtilisateur, $titreUtilisateur);

                              //Obtention et filtrage des données de l'utilisateur
                                   function wpaf_mail_construct_input_generator($valFiltered,$keyFiltered){
                                   $postID = sanitize_text_field($_POST['wpaf_container_post']);
                                   $wp_stored_meta_validation_mail = get_post_meta($postID);

                                   $contenuAdministrateur = str_replace("&#039;","'",esc_attr ( $wp_stored_meta_validation_mail['wpaf_contenu'][0] ));

                                   if (str_contains('['.$keyFiltered.']', $contenuAdministrateur)) { 
                                        return $valFiltered;
                                   };
                              }
                                        
                              foreach ($_POST as $key=>$val) {
                                   if (!($key== "_wpnonce" || $key == "g-recaptcha-response" || $key == "_wp_http_referer" || $key == "wpaf_mail_submit" ||$key == "wpaf_whatsapp_submit" || $key == "wpaf_container_post")){
                                        $valFiltered = str_replace("\\","",$val);
                                        $keyFiltered = str_replace("\\","",$key);

                                             
                                        wpaf_mail_construct_input_generator($valFiltered,$keyFiltered);
                                                  
                                   }
                              }

                              //Envoi des données vers la database
                                   // global $wpdp;
                                   // $data= array(
                                   //           "name' => sanitize_text_field($_POST['name']),
                                   //           'email' => sanitize_text_field($_POST['email']),
                                   //           'objectif' => sanitize_textarea_field($_POST['objectif']),
                                   //           );
                                   // $table_name =  $wpdb->prefix . 'formulaire';
                                   // $result = $wpdb->insert($table_name, $data);

                         }
                    }             
               }        
     }
?>