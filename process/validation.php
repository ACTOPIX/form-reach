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

                              // Définition des variables
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
                                        $valFiltered = str_replace("\\","",$val);
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
                                   
                                   // Subjects
                                        $subjectAdmin = str_replace("&#039;","'",esc_attr ( $wp_stored_meta_validation_mail['fr_email_admin_subject'][0] ));
                                   
                                   // Headers
                                   $headerAdmin = array(
                                             'Content-Type: text/html; charset=UTF-8',
                                             );
                                   
                                   // Mail sending
                                        $mailAdmin = wp_mail($toAdmin, $subjectAdmin, $contenuReplace, $headerAdmin);
                              }else {
                                   // Email adresses 
                                        $toAdmin = esc_attr ( $wp_stored_meta_validation_mail['fr_email_admin_to'][0]);
                                   // Subjects
                                        $subjectAdmin = str_replace("&#039;","'",esc_attr ( $wp_stored_meta_validation_mail['fr_email_admin_subject'][0] ));
                                        $subjectUser = str_replace("&#039;","'",esc_attr ( $wp_stored_meta_validation_mail['fr_email_user_subject'][0] ));

                                   // Headers
                                        $headerAdmin = str_replace("&#039;","'",esc_attr ( $wp_stored_meta_validation_mail['fr_email_admin_from'][0] ));
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

               } else {
               // reCAPTCHA V3 protection disabled, processing form data without verification

                    // Definition of variables
                    $postID = sanitize_text_field($_POST['fr_container_post']);
                    $wp_stored_meta_validation_mail = get_post_meta($postID);

                    //Admin email build
                    $contenuAdministrateur = `
                              <!DOCTYPE html>
                                   <html xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office" lang="en">

                                   <head>
                                        <title></title>
                                        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                                        <meta name="viewport" content="width=device-width, initial-scale=1.0"><!--[if mso]><xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch><o:AllowPNG/></o:OfficeDocumentSettings></xml><![endif]--><!--[if !mso]><!-->
                                        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css"><!--<![endif]-->
                                        <style>
                                             * {
                                                  box-sizing: border-box;
                                             }

                                             body {
                                                  margin: 0;
                                                  padding: 0;
                                             }

                                             a[x-apple-data-detectors] {
                                                  color: inherit !important;
                                                  text-decoration: inherit !important;
                                             }

                                             #MessageViewBody a {
                                                  color: inherit;
                                                  text-decoration: none;
                                             }

                                             p {
                                                  line-height: inherit
                                             }

                                             .desktop_hide,
                                             .desktop_hide table {
                                                  mso-hide: all;
                                                  display: none;
                                                  max-height: 0px;
                                                  overflow: hidden;
                                             }

                                             .image_block img+div {
                                                  display: none;
                                             }

                                             .menu_block.desktop_hide .menu-links span {
                                                  mso-hide: all;
                                             }

                                             @media (max-width:700px) {
                                                  .desktop_hide table.icons-inner {
                                                       display: inline-block !important;
                                                  }

                                                  .icons-inner {
                                                       text-align: center;
                                                  }

                                                  .icons-inner td {
                                                       margin: 0 auto;
                                                  }

                                                  .row-content {
                                                       width: 100% !important;
                                                  }

                                                  .menu-checkbox[type=checkbox]~.menu-links {
                                                       display: none !important;
                                                       padding: 5px 0;
                                                  }

                                                  .menu-checkbox[type=checkbox]:checked~.menu-trigger .menu-open {
                                                       display: none !important;
                                                  }

                                                  .menu-checkbox[type=checkbox]:checked~.menu-links,
                                                  .menu-checkbox[type=checkbox]~.menu-trigger {
                                                       display: block !important;
                                                       max-width: none !important;
                                                       max-height: none !important;
                                                       font-size: inherit !important;
                                                  }

                                                  .menu-checkbox[type=checkbox]~.menu-links>a,
                                                  .menu-checkbox[type=checkbox]~.menu-links>span.label {
                                                       display: block !important;
                                                       text-align: center;
                                                  }

                                                  .menu-checkbox[type=checkbox]:checked~.menu-trigger .menu-close {
                                                       display: block !important;
                                                  }

                                                  .mobile_hide {
                                                       display: none;
                                                  }

                                                  .stack .column {
                                                       width: 100%;
                                                       display: block;
                                                  }

                                                  .mobile_hide {
                                                       min-height: 0;
                                                       max-height: 0;
                                                       max-width: 0;
                                                       overflow: hidden;
                                                       font-size: 0px;
                                                  }

                                                  .desktop_hide,
                                                  .desktop_hide table {
                                                       display: table !important;
                                                       max-height: none !important;
                                                  }
                                             }

                                             #memu-r4c0m0:checked~.menu-links {
                                                  background-color: #ffffff !important;
                                             }

                                             #memu-r4c0m0:checked~.menu-links a,
                                             #memu-r4c0m0:checked~.menu-links span {
                                                  color: #000 !important;
                                             }
                                        </style>
                                   </head>

                                   <body style="margin: 7rem auto; background-color: #f5f5f5; padding: 0; -webkit-text-size-adjust: none; text-size-adjust: none;">
                                        <table class="nl-container" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f5f5f5; background-image: none; background-position: top left; background-size: auto; background-repeat: no-repeat;">
                                             <tbody>
                                                  <tr>
                                                       <td>
                                                            <table class="row row-1" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f5f5f5;">
                                                                 <tbody>
                                                                      <tr>
                                                                           <td>
                                                                                <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff; color: #000000; width: 680.00px; box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.1)" width="680.00">
                                                                                     <tbody>
                                                                                          <tr>
                                                                                               <td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                                                                    <div class="spacer_block block-1" style="height:65px;line-height:65px;font-size:1px;">&#8202;</div>
                                                                                                    <table class="heading_block block-2" width="100%" border="0" cellpadding="10" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                                         <tr>
                                                                                                              <td class="pad">
                                                                                                                   <h1 style="margin: 0; color: #171719; direction: ltr; font-family: Lato, Tahoma, Verdana, Segoe, sans-serif; font-size: 38px; font-weight: 700; letter-spacing: 1px; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0;"><span class="tinyMce-placeholder">Form Reach</span></h1>
                                                                                                              </td>
                                                                                                         </tr>
                                                                                                    </table>
                                                                                               </td>
                                                                                          </tr>
                                                                                     </tbody>
                                                                                </table>
                                                                           </td>
                                                                      </tr>
                                                                 </tbody>
                                                            </table>
                                                            <table class="row row-2" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f5f5f5;">
                                                                 <tbody>
                                                                      <tr>
                                                                           <td>
                                                                                <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-radius: 0; color: #000000; background-color: #ffffff; width: 680.00px; box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.1)" width="680.00">
                                                                                     <tbody>
                                                                                          <tr>
                                                                                               <td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                                                                    <div class="spacer_block block-1" style="height:55px;line-height:55px;font-size:1px;">&#8202;</div>
                                                                                               </td>
                                                                                          </tr>
                                                                                     </tbody>
                                                                                </table>
                                                                           </td>
                                                                      </tr>
                                                                 </tbody>
                                                            </table>
                                                            <table class="row row-3" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f5f5f5; background-position: center top;">
                                                                 <tbody>
                                                                      <tr>
                                                                           <td>
                                                                                <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-radius: 0; color: #000000; background-color: #ffffff; border-bottom: 0 solid #000000; border-left: 0 solid #000000; border-right: 0px solid #000000; border-top: 0 solid #000000; width: 680.00px; box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.1)" width="680.00">
                                                                                     <tbody>
                                                                                          <tr>
                                                                                               <td class="column column-1" width="16.666666666666668%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; background-color: #ffffff; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                                                                    <div class="spacer_block block-1" style="height:50px;line-height:50px;font-size:1px;">&#8202;</div>
                                                                                                    <div class="spacer_block block-2" style="height:31px;line-height:31px;font-size:1px;">&#8202;</div>
                                                                                                    <div class="spacer_block block-3" style="height:31px;line-height:31px;font-size:1px;">&#8202;</div>
                                                                                                    <div class="spacer_block block-4" style="height:31px;line-height:31px;font-size:1px;">&#8202;</div>
                                                                                                    <div class="spacer_block block-5" style="height:31px;line-height:31px;font-size:1px;">&#8202;</div>
                                                                                                    <div class="spacer_block block-6" style="height:31px;line-height:31px;font-size:1px;">&#8202;</div>
                                                                                                    <div class="spacer_block block-7" style="height:31px;line-height:31px;font-size:1px;">&#8202;</div>
                                                                                                    <div class="spacer_block block-8" style="height:31px;line-height:31px;font-size:1px;">&#8202;</div>
                                                                                               </td>
                                                                                               <td class="column column-2" width="66.66666666666667%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; border-top: 1px solid #000000; padding-bottom: 15px; padding-left: 15px; padding-right: 15px; padding-top: 15px; vertical-align: top;">
                                                                                                    <table class="text_block block-1" width="100%" border="0" cellpadding="15" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                                                         <tr>
                                                                                                              <td class="pad">
                                                                                                                   <div style="font-family: sans-serif">
                                                                                                                        <div class style="font-size: 14px; font-family: Lato, Tahoma, Verdana, Segoe, sans-serif; mso-line-height-alt: 21px; color: #000; line-height: 1.5;">
                                                                                                                             <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 25.5px; letter-spacing: 6px;"><span style="font-size:17px;"><strong>User Message</strong></span></p>
                                                                                                                        </div>
                                                                                                                   </div>
                                                                                                              </td>
                                                                                                         </tr>
                                                                                                    </table>
                                                                                                    <table class="text_block block-2" width="100%" border="0" cellpadding="10" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                                                         <tr>
                                                                                                              <td class="pad">
                                                                                                                   <div style="font-family: sans-serif">
                                                                                                                        <div class style="font-size: 14px; font-family: Lato, Tahoma, Verdana, Segoe, sans-serif; mso-line-height-alt: 21px; color: #000; line-height: 1.5;">
                                                                                                                             <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 21px; letter-spacing: 1px;"> `. str_replace("&#039;","'",esc_attr ( $wp_stored_meta_validation_mail['fr_email_admin_content'][0] )) .`</p>
                                                                                                                        </div>
                                                                                                                   </div>
                                                                                                              </td>
                                                                                                         </tr>
                                                                                                    </table>
                                                                                               </td>
                                                                                               <td class="column column-3" width="16.666666666666668%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                                                                    <div class="spacer_block block-1" style="height:31px;line-height:31px;font-size:1px;">&#8202;</div>
                                                                                               </td>
                                                                                          </tr>
                                                                                     </tbody>
                                                                                </table>
                                                                           </td>
                                                                      </tr>
                                                                 </tbody>
                                                            </table>
                                                            <table class="row row-4" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f5f5f5;">
                                                                 <tbody>
                                                                      <tr>
                                                                           <td>
                                                                                <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff; color: #000000; width: 680.00px; box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.1)" width="680.00">
                                                                                     <tbody>
                                                                                          <tr>
                                                                                               <td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                                                                    <div class="spacer_block block-1" style="height:135px;line-height:135px;font-size:1px;">&#8202;</div>
                                                                                               </td>
                                                                                          </tr>
                                                                                     </tbody>
                                                                                </table>
                                                                           </td>
                                                                      </tr>
                                                                 </tbody>
                                                            </table>
                                                            <table class="row row-5" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f5f5f5;">
                                                                 <tbody>
                                                                      <tr>
                                                                           <td>
                                                                                <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff; color: #000000; width: 680.00px; box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.1)" width="680.00">
                                                                                     <tbody>
                                                                                          <tr>
                                                                                               <td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                                                                    <table class="menu_block block-1" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                                         <tr>
                                                                                                              <td class="pad" style="color:#000;font-family:inherit;font-size:14px;letter-spacing:1px;text-align:center;">
                                                                                                                   <table width="100%" cellpadding="0" cellspacing="0" border="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                                                        <tr>
                                                                                                                             <td class="alignment" style="text-align:center;font-size:0px;"><!--[if !mso]><!--><input class="menu-checkbox" id="memu-r4c0m0" type="checkbox" style="display:none !important;max-height:0;visibility:hidden;"><!--<![endif]-->
                                                                                                                                  <div class="menu-trigger" style="display:none;max-height:0px;max-width:0px;font-size:0px;overflow:hidden;"><label class="menu-label" for="memu-r4c0m0" style="height: 36px; width: 36px; display: inline-block; cursor: pointer; mso-hide: all; user-select: none; align: center; text-align: center; color: #000; text-decoration: none; background-color: #ffffff; border-radius: 0;"><span class="menu-open" style="mso-hide:all;font-size:26px;line-height:31.5px;">☰</span><span class="menu-close" style="display:none;mso-hide:all;font-size:26px;line-height:36px;">✕</span></label></div>
                                                                                                                                  <div class="menu-links"><!--[if mso]><table role="presentation" border="0" cellpadding="0" cellspacing="0" align="center" style=""><tr style="text-align:center;"><![endif]--><!--[if mso]><td style="padding-top:15px;padding-right:15px;padding-bottom:25px;padding-left:15px"><![endif]--><a href="https://www.form-reach.com/doc" target="_self" style="mso-hide:false;padding-top:15px;padding-bottom:25px;padding-left:15px;padding-right:15px;display:inline-block;color:#000;font-family:Lato, Tahoma, Verdana, Segoe, sans-serif;font-size:14px;text-decoration:none;letter-spacing:1px;">Documentation</a><!--[if mso]></td><![endif]--><!--[if mso]><td style="padding-top:15px;padding-right:15px;padding-bottom:25px;padding-left:15px"><![endif]--><a href="https://www.form-reach.com/support" target="_self" style="mso-hide:false;padding-top:15px;padding-bottom:25px;padding-left:15px;padding-right:15px;display:inline-block;color:#000;font-family:Lato, Tahoma, Verdana, Segoe, sans-serif;font-size:14px;text-decoration:none;letter-spacing:1px;">Support</a><!--[if mso]></td><![endif]--><!--[if mso]><td style="padding-top:15px;padding-right:15px;padding-bottom:25px;padding-left:15px"><![endif]--><a href="https://www.form-reach.com/suggestion" target="_self" style="mso-hide:false;padding-top:15px;padding-bottom:25px;padding-left:15px;padding-right:15px;display:inline-block;color:#000;font-family:Lato, Tahoma, Verdana, Segoe, sans-serif;font-size:14px;text-decoration:none;letter-spacing:1px;">Suggestion</a><!--[if mso]></td><![endif]--><!--[if mso]></tr></table><![endif]--></div>
                                                                                                                             </td>
                                                                                                                        </tr>
                                                                                                                   </table>
                                                                                                              </td>
                                                                                                         </tr>
                                                                                                    </table>
                                                                                                    <table class="button_block block-2" width="100%" border="0" cellpadding="25" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                                         <tr>
                                                                                                              <td class="pad">
                                                                                                                   <div class="alignment" align="center"><!--[if mso]><v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="www.example.com" style="height:44px;width:115px;v-text-anchor:middle;" arcsize="10%" strokeweight="0.75pt" strokecolor="#171719" fill="false"><w:anchorlock/><v:textbox inset="0px,0px,0px,0px"><center style="color:#000; font-family:Tahoma, Verdana, sans-serif; font-size:16px"><![endif]--><a href="www.example.com" target="_blank" style="text-decoration:none;display:inline-block;color:#000;background-color:transparent;border-radius:4px;width:auto;border-top:1px solid #171719;font-weight:400;border-right:1px solid #171719;border-bottom:1px solid #171719;border-left:1px solid #171719;padding-top:5px;padding-bottom:5px;font-family:Lato, Tahoma, Verdana, Segoe, sans-serif;font-size:16px;text-align:center;mso-border-alt:none;word-break:keep-all;"><span style="padding-left:30px;padding-right:30px;font-size:16px;display:inline-block;letter-spacing:normal;"><span style="word-break: break-word; line-height: 32px;">Rate us</span></span></a><!--[if mso]></center></v:textbox></v:roundrect><![endif]--></div>
                                                                                                              </td>
                                                                                                         </tr>
                                                                                                    </table>
                                                                                                    <div class="spacer_block block-3" style="height:65px;line-height:65px;font-size:1px;">&#8202;</div>
                                                                                               </td>
                                                                                          </tr>
                                                                                     </tbody>
                                                                                </table>
                                                                           </td>
                                                                      </tr>
                                                                 </tbody>
                                                            </table>
                                                            <table class="row row-6" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                 <tbody>
                                                                      <tr>
                                                                           <td>
                                                                                <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff; color: #000000; width: 680.00px; box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.1)" width="680.00">
                                                                                     <tbody>
                                                                                          <tr>
                                                                                               <td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                                                                    <table class="icons_block block-1" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                                         <tr>
                                                                                                              <td class="pad" style="vertical-align: middle; color: #9d9d9d; font-family: inherit; font-size: 15px; padding-bottom: 5px; padding-top: 5px; text-align: center;">
                                                                                                                   <table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                                                        <tr>
                                                                                                                             <td class="alignment" style="vertical-align: middle; text-align: center;"><!--[if vml]><table align="left" cellpadding="0" cellspacing="0" role="presentation" style="display:inline-block;padding-left:0px;padding-right:0px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;"><![endif]-->
                                                                                                                                  <!--[if !vml]><!-->
                                                                                                                                  <table class="icons-inner" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; display: inline-block; margin-right: -4px; padding-left: 0px; padding-right: 0px;" cellpadding="0" cellspacing="0" role="presentation"><!--<![endif]-->
                                                                                                                                  </table>
                                                                                                                             </td>
                                                                                                                        </tr>
                                                                                                                   </table>
                                                                                                              </td>
                                                                                                         </tr>
                                                                                                    </table>
                                                                                               </td>
                                                                                          </tr>
                                                                                     </tbody>
                                                                                </table>
                                                                           </td>
                                                                      </tr>
                                                                 </tbody>
                                                            </table>
                                                       </td>
                                                  </tr>
                                             </tbody>
                                        </table><!-- End -->
                                   </body>
                              </html>
                              `;

                    // User email build
                    $toUser = esc_attr ( $wp_stored_meta_validation_mail['fr_email_user_to'][0]);

                    // Fetching and filtering user data + defining content
                    $contenuFormPost ="";
                    foreach ($_POST as $key=>$val) {
                        if (!($key== "_wpnonce" || $key == "g-recaptcha-response" || $key == "_wp_http_referer" || $key == "fr_mail_submit" ||$key == "fr_whatsapp_submit" || $key == "fr_container_post")){
                                $valFiltered = str_replace("\\","",$val);
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
                                             'From: ' . str_replace("&#039;","'",esc_attr ( $wp_stored_meta_validation_mail['fr_email_admin_from'][0] )),
                                             );
                         
                         // Mail sending
                              $mailAdmin = wp_mail($toAdmin, $subjectAdmin, $contenuReplace, $headerAdmin);
                    }else {
                         // Email adresses 
                              $toAdmin = esc_attr ( $wp_stored_meta_validation_mail['fr_email_admin_to'][0]);
                         // Subjects
                              $subjectAdmin = str_replace("&#039;","'",esc_attr ( $wp_stored_meta_validation_mail['fr_email_admin_subject'][0] ));
                              $subjectUser = str_replace("&#039;","'",esc_attr ( $wp_stored_meta_validation_mail['fr_email_user_subject'][0] ));

                         // Headers
                              $headerAdmin = array(
                                             'Content-Type: text/html; charset=UTF-8',
                                             'From: ' . str_replace("&#039;","'",esc_attr ( $wp_stored_meta_validation_mail['fr_email_admin_from'][0] )),
                                             );
                              $headerUser = array(
                                             'Content-Type: text/html; charset=UTF-8',
                                             'From: ' . str_replace("&#039;","'",esc_attr ( $wp_stored_meta_validation_mail['fr_email_user_from'][0] )),
                                             );
                         
                         // User Content
                              $contentUser = str_replace("&#039;","'",esc_attr ( $wp_stored_meta_validation_mail['fr_email_user_content'][0] ));

                         // Mail sending
                              $toAdminSeveral = explode(',', $toAdmin);
                              $toAdminSeveral = array_map('trim', $toAdminSeveral);

                              $mailAdmin = wp_mail($toAdminSeveral, $subjectAdmin, $contenuReplace, $headerAdmin);
                              $mailUser = wp_mail($toUserKey, $subjectUser, $contentUser, $headerUser);
                    };
                    
                    // Sending to the database
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