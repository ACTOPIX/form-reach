<?php
if (!defined('ABSPATH')) exit;

function formreach_handle_contact_form() {
    check_ajax_referer('formreach_send_contact_action', 'formreach_send_contact_nonce');

    // reCAPTCHA validation if enabled
    if (get_option('formreach_recaptcha_switch') === '1') {
        $formreach_recaptcha_response = isset($_POST['recaptcha_response']) ? sanitize_text_field(wp_unslash($_POST['recaptcha_response'])) : '';
        $formreach_response = wp_remote_post('https://www.google.com/recaptcha/api/siteverify', [
            'body' => [
                'secret' => get_option('formreach_key_secret'),
                'response' => $formreach_recaptcha_response
            ]
        ]);

        $formreach_result = json_decode(wp_remote_retrieve_body($formreach_response), true);

        if (empty($formreach_result['success']) || $formreach_result['score'] < get_option('formreach_recaptcha_score')) {
            wp_send_json_error(['message' => 'reCAPTCHA validation failed.']);
            wp_die();
        }
    }

    // Process form data
    $formreach_postID = isset($_POST['formreach_container_post']) ? (int) $_POST['formreach_container_post'] : 0;
    $formreach_stored_meta_validation_mail = get_post_meta($formreach_postID);
    $formreach_email_form_content = get_post_meta($formreach_postID, 'formreach_email_form_content', true);
    include 'mailing.php';

    // Detection of the `name` and the `type`
    preg_match_all('/\[formreach_input[^\]]*type="([^"]+)"[^\]]*name="([^"]+)"[^\]]*\]/', $formreach_email_form_content, $formreach_matches);
    
    $formreach_field_types = $formreach_matches[1];
    $formreach_field_names = $formreach_matches[2];

    $formreach_contenuFormPost = '';
    $formreach_keyShortcode = [];
    $formreach_valShortcode = [];

    foreach ($formreach_field_names as $formreach_index => $formreach_field_name) {        
        if (isset($_POST[$formreach_field_name])) {
            $formreach_field_value = sanitize_textarea_field(wp_unslash($_POST[$formreach_field_name]));
            $formreach_field_value_filtered = '';

            // Sanitize based on input type
            switch ($formreach_field_types[$formreach_index]) {
                case 'email':
                    if (!filter_var($formreach_field_value, FILTER_VALIDATE_EMAIL)) {
                        wp_send_json_error(['emailValid' => false, 'success' => false]);
                        wp_die();
                    }
                    $formreach_field_value_filtered = sanitize_email($formreach_field_value);
                    break;
                case 'textarea':
                    $formreach_field_value_filtered = nl2br(sanitize_textarea_field($formreach_field_value));
                    break;
                case 'url':
                    $formreach_field_value_filtered = esc_url_raw($formreach_field_value);
                    break;
                case 'number':
                    $formreach_field_value_filtered = floatval($formreach_field_value); 
                    break;
                case 'file':
                    if (!empty($_FILES[$formreach_field_name]['name'])) {
                        $formreach_upload = wp_handle_upload($_FILES[$formreach_field_name], ['test_form' => false]);
                        if (isset($formreach_upload['url'])) {
                            $formreach_field_value_filtered = esc_url_raw($formreach_upload['url']);
                        } else {
                            wp_send_json_error(['upload' => false, 'success' => false]);
                            wp_die();
                        }
                    }
                    break;
                default:
                    $formreach_field_value_filtered = sanitize_text_field($formreach_field_value);
                    break;
            }

            // Build email content
            $formreach_contenuFormPost .= esc_attr($formreach_field_name) . ' : ' . $formreach_field_value_filtered . '<br/>';

            // Prepare shortcodes for replacement
            $formreach_keyShortcode[] = '[' . esc_attr(str_replace("\\", "", $formreach_field_name)) . ']';
            $formreach_valShortcode[] = str_replace("\\", "", $formreach_field_value_filtered);
        }
    }

    // Replace placeholders in email content
    $formreach_contenuReplace = str_replace($formreach_keyShortcode, $formreach_valShortcode, $formreach_contenuAdministrateur);
    $formreach_contenuReplaceUser = str_replace($formreach_keyShortcode, $formreach_valShortcode, $formreach_contenuUtilisateur);

    $formreach_subjectAdmin = str_replace($formreach_keyShortcode, $formreach_valShortcode, $formreach_stored_meta_validation_mail['formreach_email_admin_subject'][0]);
    $formreach_toUser = str_replace($formreach_keyShortcode, $formreach_valShortcode, $formreach_stored_meta_validation_mail['formreach_email_user_to'][0]);
    $formreach_toAdmin = $formreach_stored_meta_validation_mail['formreach_email_admin_to'][0];
    $GLOBALS['formreach_admin_from_name'] = str_replace("&#039;", "'", $formreach_stored_meta_validation_mail['formreach_email_admin_from'][0]);

    add_filter('wp_mail_from_name', function($formreach_name) {
        return $GLOBALS['formreach_mail'] ? $GLOBALS['formreach_admin_from_name'] : $formreach_name;
    });

    $formreach_headerAdmin = ['Content-Type: text/html; charset=UTF-8'];
    $formreach_toAdminSeveral = array_map('trim', explode(',', $formreach_toAdmin));
	
    // Send admin email
    $GLOBALS['formreach_mail'] = true;
    wp_mail($formreach_toAdminSeveral, $formreach_subjectAdmin, $formreach_contenuReplace, $formreach_headerAdmin);
    $GLOBALS['formreach_mail'] = false;

    // Send user email if enabled
    if ($formreach_stored_meta_validation_mail['formreach_user_email_switch'][0] == 1) {
        $formreach_subjectUser = str_replace("&#039;", "'", $formreach_stored_meta_validation_mail['formreach_email_user_subject'][0]);
        $formreach_headerUser = str_replace("&#039;", "'", $formreach_stored_meta_validation_mail['formreach_email_user_from'][0]);
        $GLOBALS['formreach_mail'] = true;
        wp_mail($formreach_toUser, $formreach_subjectUser, $formreach_contenuReplaceUser, $formreach_headerAdmin);
        $GLOBALS['formreach_mail'] = false;
    }
	
	$formreach_local_time = gmdate('Y-m-d H:i:s');
	global $wpdb;
	// phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
	$wpdb->insert(
		$wpdb->prefix . 'formreach_form_history',
		[
			'type' => 'Mail', 
			'content' => str_replace("\\", "", $formreach_contenuFormPost), 
			'created_at' => $formreach_local_time
		],
		['%s', '%s', '%s']
	);

    wp_send_json_success(['success' => true]);
    wp_die();
}

add_action('wp_ajax_submit_contact_form', 'formreach_handle_contact_form');
add_action('wp_ajax_nopriv_submit_contact_form', 'formreach_handle_contact_form');
?>