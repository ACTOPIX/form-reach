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

               if(esc_attr(get_option('wpaf_recaptcha_switch')) === '1') {                     
               // reCAPTCHA V3 protection activated, verifying server response

                    $captchaSecretKey = esc_attr( get_option('wpaf_key_secret') );

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
                         // The reCAPTCHA V3 verification has failed
                              echo ("recaptchaValidation=false") ; exit;
                         }else{
                         // The reCAPTCHA V3 verification has succeeded, processing the form data

                              // Retrieval and initialization of the concerned ID
                              $postID = sanitize_text_field($_POST['wpaf_container_post']);
                              $wp_stored_meta_whatsapp = get_post_meta($postID);

                              // Retrieval and filtering of user data
                              $content ="";
                              foreach ($_POST as $key=>$val) {
                                   if (!($key== "_wpnonce" || $key == "g-recaptcha-response" || $key == "_wp_http_referer" || $key == "wpaf_mail_submit" ||$key == "wpaf_whatsapp_submit" || $key == "wpaf_container_post")){
                                        $valFiltered = str_replace("\\","",$val);
                                        $keyFiltered = str_replace("\\","",$key);
                                        $content .= "$keyFiltered : $valFiltered <br/>";
                                   }
                              }

                              // Sending to the database
                              global $wpdp;
                              $table_name =  $wpdb->prefix . 'form_history';

                              $data= array(
                                        'type' => "Whatsapp",
                                        'content' => $content
                                        );

                              $result = $wpdb->insert($table_name, $data);

                              // Filtering for the link
                              $whatsappContent = str_replace("<br/>","",$content);
                              $filteredContent = urlencode(str_replace("<br/>", "\n", $content));

                              // WhatsApp Administrator account
                              $tel = esc_attr ( $wp_stored_meta_whatsapp['wpaf_whatsapp_tel_international'][0] );

                              // Message that will be sent
                              $link = "https://api.whatsapp.com/send/?phone=" . $tel . "&text=" . $filteredContent;
                              echo $link;
                         }

                    }

               } else {
               // reCAPTCHA V3 protection disabled, processing the form data without verification

                    // Retrieval and initialization of the concerned ID
                    $postID = sanitize_text_field($_POST['wpaf_container_post']);
                    $wp_stored_meta_whatsapp = get_post_meta($postID);

                    // Retrieval and filtering of user data
                    $content ="";
                    foreach ($_POST as $key=>$val) {
                         if (!($key== "_wpnonce" || $key == "g-recaptcha-response" || $key == "_wp_http_referer" || $key == "wpaf_mail_submit" ||$key == "wpaf_whatsapp_submit" || $key == "wpaf_container_post")){
                              $valFiltered = str_replace("\\","",$val);
                              $keyFiltered = str_replace("\\","",$key);
                              $content .= "$keyFiltered : $valFiltered <br/>";
                         }
                    }

                    // Sending to the database
                    global $wpdp;
                    $table_name =  $wpdb->prefix . 'form_history';

                    $data= array(
                              'type' => "Whatsapp",
                              'content' => $content
                              );

                    $result = $wpdb->insert($table_name, $data);

                    // Filtering for the link
                    $whatsappContent = str_replace("<br/>","",$content);
                    $filteredContent = encodeURIComponent(str_replace("<br/>", "\n", $content));

                    // WhatsApp Administrator account
                    $tel = encodeURIComponent(esc_attr ( $wp_stored_meta_whatsapp['wpaf_whatsapp_tel_international'][0] ));

                    // Message that will be sent
                    $link = "https://api.whatsapp.com/send/?phone=" . $tel . "&text=" . $filteredContent;
                    echo $link;
               }
          }
     }                         
?>