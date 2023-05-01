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

                              //Récupération et initialisation de l'ID concerné
                                   $postID = sanitize_text_field($_POST['wpaf_container_post']);
                                   $wp_stored_meta_whatsapp = get_post_meta($postID);

                              //Obtention et filtrage des données de l'utilisateur
                              $contenu ="";
                              foreach ($_POST as $key=>$val) {
                                   if (!($key== "_wpnonce" || $key == "g-recaptcha-response" || $key == "_wp_http_referer" || $key == "wpaf_mail_submit" ||$key == "wpaf_whatsapp_submit" || $key == "wpaf_container_post")){
                                        $valFiltered = str_replace("\\","",$val);
                                        $keyFiltered = str_replace("\\","",$key);
                                        $contenu .= "$keyFiltered : $valFiltered <br/>";
                                   }
                              }

                              //Envoi dans la base de données
                              global $wpdp;
                              $table_name =  $wpdb->prefix . 'formulaire';

                              $data= array(
                                        'type' => 'WhatsApp',
                                        'Contenu' => $contenu
                                        );

                              $result = $wpdb->insert($table_name, $data);

                              //Filtrage pour le lien
                              $whatsappContenu = str_replace("<br/>","",$contenu);
                              $contenuFiltered = urlencode(str_replace("<br/>", "\n", $contenu));
                              // $contenuFilteredSpace = str_replace("%20","+",$contenuFiltered);

                              //Compte WhatsApp Administrateur
                                   $tel = esc_attr ( $wp_stored_meta_whatsapp['wpaf_whatsapp_tel_international'][0] );

                              //Message qui sera envoyé
                                   $link = "https://api.whatsapp.com/send/?phone=" . $tel . "&text=" . $contenuFiltered;
                                   echo $link;
                              }

                         }
                     }             
                }        
     
?>