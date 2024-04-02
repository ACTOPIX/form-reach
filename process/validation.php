<?php
     // Calling wp-load
	$path = preg_replace('/wp-content.*$/','',__DIR__);
	require_once($path."wp-load.php");

     // Nonce verification
     if(isset($_POST['_wpnonce'])){

          if (!wp_verify_nonce( $_POST['_wpnonce'], 'nonce_verification' )){

               // The token verification failed
               exit;

          }else{
               // The token verification succeeded

               if(esc_attr(get_option('fr_recaptcha_switch')) === '1') {                     
               // reCAPTCHA V3 protection activated, verifying server response

                    $captchaSecretKey = esc_attr( get_option('fr_key_secret') );

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
                         
                         if(json_decode($serverResponse,true)['score'] <= 0.5) {
                         // The reCAPTCHA V3 verification failed
                              echo ("recaptchaValidation=false") ; exit;
                         }else{
                         // reCAPTCHA V3 verification succeeded, processing form data

                              // DÃ©finition des variables
                              $postID = sanitize_text_field($_POST['fr_container_post']);
                              $wp_stored_meta_validation_mail = get_post_meta($postID);
                              
                              //Admin Email build
                              include 'mailing.php';
          
                              //User Email build
                              $toUser = esc_attr ( $wp_stored_meta_validation_mail['fr_email_user_to'][0]);

                              // Fetching and filtering user data + defining content
                              $contenuFormPost ="";
                              foreach ($_POST as $key=>$val) {
                                if (!($key== "_wpnonce" || $key == "g-recaptcha-response" || $key == "_wp_http_referer" || $key == "fr_mail_submit" ||$key == "fr_whatsapp_submit" || $key == "fr_container_post")){
                                        $valFiltered = nl2br(str_replace("\\","",$val));
                                        $keyFiltered = str_replace("\\","",$key);

                                        $keyShortcode[] = "[$keyFiltered]";
                                        $valShortcode[] = $valFiltered;
                                        
                                        $contenuFormPost .= "$keyFiltered : $valFiltered <br/>";
                                   }
                              }
                            
                              if ($keyFiltered) {
                                   // Admin Content
                                   $contenuReplace = $contenuAdministrateur;
                                   foreach ($keyShortcode as $index => $shortcode) {
                                        $contenuReplace = str_replace($shortcode, $valShortcode[$index] . '<br/>', $contenuReplace);
                                   };

                                   // User To
                                   $toUserKey = str_replace($keyShortcode,$valShortcode, $toUser);
                              };

                              if ( ($wp_stored_meta_validation_mail['fr_user_email_switch'][0]) == 0 ){
                                   // Email adresses 
                                        $toAdmin = esc_attr ( $wp_stored_meta_validation_mail['fr_email_admin_to'][0]);

                                   // From
                                        $GLOBALS['admin_from_name'] = str_replace("&#039;","'",esc_attr ( $wp_stored_meta_validation_mail['fr_email_admin_from'][0] ));

                                        function custom_wp_mail_from_name($name) {
                                        if (!empty($GLOBALS['form_reach_mail'])) {
                                             if (!empty($GLOBALS['admin_from_name'])) {
                                                  return $GLOBALS['admin_from_name'];
                                             }
                                        }
                                        return $name;
                                        }

                                        add_filter('wp_mail_from_name', 'custom_wp_mail_from_name');
                                   
                                   // Subjects
                                        $subjectAdmin = str_replace("&#039;","'",esc_attr ( $wp_stored_meta_validation_mail['fr_email_admin_subject'][0] ));
                                   
                                   // Headers
                                   $headerAdmin = array(
                                             'Content-Type: text/html; charset=UTF-8',
                                             );
                                   
                                   // Mail sending
                                        $toAdminSeveral = explode(',', $toAdmin);
                                        $toAdminSeveral = array_map('trim', $toAdminSeveral);
                                        $GLOBALS['form_reach_mail'] = true;
                                        $mailAdmin = wp_mail($toAdminSeveral, $subjectAdmin, $contenuReplace, $headerAdmin);
                                        $GLOBALS['form_reach_mail'] = false;
                              }else {
                                   // Email adresses 
                                        $toAdmin = esc_attr ( $wp_stored_meta_validation_mail['fr_email_admin_to'][0]);

                                   // From
                                        $GLOBALS['admin_from_name'] = str_replace("&#039;","'",esc_attr ( $wp_stored_meta_validation_mail['fr_email_admin_from'][0] ));

                                        function custom_wp_mail_from_name($name) {
                                        if (!empty($GLOBALS['form_reach_mail'])) {
                                             if (!empty($GLOBALS['admin_from_name'])) {
                                                  return $GLOBALS['admin_from_name'];
                                             }
                                        }
                                        return $name;
                                        }

                                        add_filter('wp_mail_from_name', 'custom_wp_mail_from_name');

                                   // Subjects
                                        $subjectAdmin = str_replace("&#039;","'",esc_attr ( $wp_stored_meta_validation_mail['fr_email_admin_subject'][0] ));
                                        $subjectUser = str_replace("&#039;","'",esc_attr ( $wp_stored_meta_validation_mail['fr_email_user_subject'][0] ));

                                   // Headers
                                        $headerAdmin = array(
                                                       'Content-Type: text/html; charset=UTF-8',
                                                       );
                                        $headerUser = str_replace("&#039;","'",esc_attr ( $wp_stored_meta_validation_mail['fr_email_user_from'][0] ));
                                   
                                   // User Content
                                        $contentUser = str_replace("&#039;","'",esc_attr ( $wp_stored_meta_validation_mail['fr_email_user_content'][0] ));
                                   
                                   // Mail sending
                                        $toAdminSeveral = explode(',', $toAdmin);
                                        $toAdminSeveral = array_map('trim', $toAdminSeveral);
                                        $GLOBALS['form_reach_mail'] = true;
                                        $mailAdmin = wp_mail($toAdminSeveral, $subjectAdmin, $contenuReplace, $headerAdmin);
                                        $mailUser = wp_mail($toUserKey, $subjectUser, $contentUser, $headerUser);
                                        $GLOBALS['form_reach_mail'] = false;
                              };
                            
                              // Saving to the database
                              global $wpdp;
                              $table_name =  $wpdb->prefix . 'form_history';

                              $data= array(
                                    'type' => 'Mail',
                                    'content' => $contenuFormPost
                                   );

                              $result = $wpdb->insert($table_name, $data);        
                         }

                    }

               } else {
               // reCAPTCHA V3 protection disabled, processing form data without verification

                    // Definition of variables
                    $postID = sanitize_text_field($_POST['fr_container_post']);
                    $wp_stored_meta_validation_mail = get_post_meta($postID);

                    //Admin email build
                    include 'mailing.php';

                    // User email build
                    $toUser = esc_attr ( $wp_stored_meta_validation_mail['fr_email_user_to'][0]);

                    // Fetching and filtering user data + defining content
                    $contenuFormPost ="";
                    foreach ($_POST as $key=>$val) {
                        if (!($key== "_wpnonce" || $key == "_wp_http_referer" || $key == "fr_mail_submit" ||$key == "fr_whatsapp_submit" || $key == "fr_container_post")){
                                $valFiltered = nl2br(str_replace("\\","",$val));
                                $keyFiltered = str_replace("\\","",$key);

                                $keyShortcode[] = "[$keyFiltered]";
                                $valShortcode[] = $valFiltered;

                                $contenuFormPost .= "$keyFiltered : $valFiltered <br/>";
                        }
                    }
                    
                    if ($keyFiltered) {
                         // Admin Content
                         $contenuReplace = str_replace($keyShortcode,$valShortcode, $contenuAdministrateur);
                         // User To
                         $toUserKey = str_replace($keyShortcode,$valShortcode, $toUser);
                    };

                    if ( ($wp_stored_meta_validation_mail['fr_user_email_switch'][0]) == 0 ){
                         // Email adresses 
                              $toAdmin = esc_attr ( $wp_stored_meta_validation_mail['fr_email_admin_to'][0]);
                         
                         // Subjects
                              $subjectAdmin = str_replace("&#039;","'",esc_attr ( $wp_stored_meta_validation_mail['fr_email_admin_subject'][0] ));
                         
                         // Headers
                              $headerAdmin = array(
                                             'Content-Type: text/html; charset=UTF-8',
                                             );
                         
                         // Mail sending
                              $toAdminSeveral = explode(',', $toAdmin);
                              $toAdminSeveral = array_map('trim', $toAdminSeveral);

                              $mailAdmin = wp_mail($toAdminSeveral, $subjectAdmin, $contenuReplace, $headerAdmin);
                    }else {
                         // Email adresses 
                              $toAdmin = esc_attr ( $wp_stored_meta_validation_mail['fr_email_admin_to'][0]);
                         // Subjects
                              $subjectAdmin = str_replace("&#039;","'",esc_attr ( $wp_stored_meta_validation_mail['fr_email_admin_subject'][0] ));
                              $subjectUser = str_replace("&#039;","'",esc_attr ( $wp_stored_meta_validation_mail['fr_email_user_subject'][0] ));

                         // Headers
                              $headerAdmin = array(
                                             'Content-Type: text/html; charset=UTF-8',
                                             );
                              $headerUser = str_replace("&#039;","'",esc_attr ( $wp_stored_meta_validation_mail['fr_email_user_from'][0] ));

                         
                         // User Content
                              $contentUser = str_replace("&#039;","'",esc_attr ( $wp_stored_meta_validation_mail['fr_email_user_content'][0] ));

                         // Mail sending
                              $toAdminSeveral = explode(',', $toAdmin);
                              $toAdminSeveral = array_map('trim', $toAdminSeveral);

                              $mailAdmin = wp_mail($toAdminSeveral, $subjectAdmin, $contenuReplace, $headerAdmin);
                              $mailUser = wp_mail($toUserKey, $subjectUser, $contentUser, $headerUser);
                    };
                    
                    // Saving to the database
                    global $wpdp;
                    $table_name =  $wpdb->prefix . 'form_history';

                    $data= array(
                            'type' => 'Mail',
                            'content' => $contenuFormPost
                            );

                    $result = $wpdb->insert($table_name, $data);
               }
          }
     }                         
?>