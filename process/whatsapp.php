<?php

if (!defined('ABSPATH')) exit;

function formreach_handle_whatsapp_form() {
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
    $formreach_wp_stored_meta_whatsapp = get_post_meta($formreach_postID);
    $formreach_whatsapp_form_content = get_post_meta($formreach_postID, 'formreach_whatsapp_form_content', true);
    
    // Detection of the name and the type
    preg_match_all('/\[formreach_input[^\]]*type="([^"]+)"[^\]]*name="([^"]+)"[^\]]*\]/', $formreach_whatsapp_form_content, $formreach_matches);
    
    $formreach_field_types = $formreach_matches[1];
    $formreach_field_names = $formreach_matches[2];

    $formreach_content = '';
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
            $formreach_content .= esc_attr($formreach_field_name) . ' : ' . $formreach_field_value_filtered . '<br/>';
        }
    }

    // Generate WhatsApp link
    $formreach_filteredContent = str_replace(
        ["\\", "<br />", "<br/>"],
        ["", "", "\n"],
        $formreach_content
    );
    $formreach_tel = urlencode($formreach_wp_stored_meta_whatsapp['formreach_whatsapp_tel_international'][0]);
    $formreach_link = "https://api.whatsapp.com/send/?phone=$formreach_tel&text=" . urlencode($formreach_filteredContent);

	$formreach_local_time = gmdate('Y-m-d H:i:s');
	global $wpdb;
	// phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
	$wpdb->insert(
		$wpdb->prefix . 'formreach_form_history',
		[
			'type' => 'Whatsapp',
			'content' => str_replace("\\", "", $formreach_content),
			'created_at' => $formreach_local_time
		],
		['%s','%s','%s']
	);

    wp_send_json(['success' => true, 'whatsapp_link' => $formreach_link]);
    wp_die();
}

add_action('wp_ajax_submit_whatsapp_form', 'formreach_handle_whatsapp_form');
add_action('wp_ajax_nopriv_submit_whatsapp_form', 'formreach_handle_whatsapp_form');
?>