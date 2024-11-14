<?php
/*
Plugin Name: Form Reach
Plugin URI: https://form-reach.com/
Description: Custom Contact Form Builder to WhatsApp, Email, and more!
Version: 1.0
Author: ACTOPIX
Author URI: https://actopix.com/
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: form-reach
Requires at least: 6.1
Requires PHP: 7.4

@package FormReach
*/

if ( !defined('ABSPATH') ) exit;

// Adding a 'Settings' link to the list of metadata displayed below the plugin description.
function formreach_settings_link($formreach_links) {
    $formreach_settings_link = '<a href="edit.php?post_type=formreach_post_type">Settings</a>';
    array_unshift($formreach_links, $formreach_settings_link);
    return $formreach_links;
}
add_filter('plugin_action_links_'.plugin_basename(__FILE__), 'formreach_settings_link');

include 'form-reach-admin.php';

register_activation_hook(__FILE__, 'formreach_activate');

register_uninstall_hook(__FILE__, 'formreach_delete');

function formreach_activate() {
    formreach_init_db();
}

function formreach_delete() {
    formreach_delete_db();
}

// Initialization of the plugin table.
function formreach_init_db() {
    global $wpdb;
    $formreach_form_history = $wpdb->prefix . "formreach_form_history";

    $formreach_table_exists = wp_cache_get('formreach_form_history_exists', 'formreach_post_type');
    if (false === $formreach_table_exists) {
 		// phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
        $formreach_table_exists = ($wpdb->get_var($wpdb->prepare("SHOW TABLES LIKE %s", $wpdb->esc_like($formreach_form_history))) == $formreach_form_history);
        wp_cache_set('formreach_form_history_exists', $formreach_table_exists, 'formreach_post_type');
    }

    // Creation of the custom table if it does not exist.
    if (!$formreach_table_exists) {
        $formreach_sql = "CREATE TABLE `$formreach_form_history` (
                `ID` int(11) NOT NULL AUTO_INCREMENT,
                `Type` varchar(100) NOT NULL,
                `Content` varchar(10000) NOT NULL,
                `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`ID`)
                ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($formreach_sql);

        // Clear the cache to ensure it's checked again after table creation
        wp_cache_delete('formreach_form_history_exists', 'formreach_post_type');
    }

    // Check if there are any posts of the custom post type 'formreach_post_type'
    if (wp_cache_get('formreach_posts', 'formreach_post_type') === false) {
        $formreach_posts = get_posts(array('post_type' => 'formreach_post_type', 'numberposts' => -1));
        wp_cache_set('formreach_posts', $formreach_posts, 'formreach_post_type');
    } else {
        $formreach_posts = wp_cache_get('formreach_posts', 'formreach_post_type');
    }

    // Create a default post if none exist
    if (empty($formreach_posts)) {
        $formreach_post_arr = array(
            'post_title'   => 'Contact Form',
            'post_content' => '',
            'post_status'  => 'draft',
            'post_author'  => get_current_user_id(),
            'post_type'    => 'formreach_post_type'
        );
        $formreach_post_id = wp_insert_post($formreach_post_arr);

        // Update the cache with the new post
        $formreach_posts[] = $formreach_post_id;
        wp_cache_set('formreach_posts', $formreach_posts, 'formreach_post_type');
    }
}

// Delete the plugin table in the database.
function formreach_delete_db() {
    global $wpdb;
    $formreach_table_name = $wpdb->prefix . "formreach_form_history";

    $formreach_table_exists = wp_cache_get('formreach_form_history_exists', 'formreach_post_type');

    if ($formreach_table_exists === false) {
 		// phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
        $formreach_table_exists = $wpdb->get_var( $wpdb->prepare( "SHOW TABLES LIKE %s", $wpdb->esc_like( $formreach_table_name ) ) );
        wp_cache_set('formreach_form_history_exists', $formreach_table_exists, 'formreach_post_type');
    }

    if ($formreach_table_exists) {
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        $formreach_sql = "DROP TABLE IF EXISTS $formreach_table_name";
        dbDelta($formreach_sql);
        wp_cache_delete('formreach_form_history_exists', 'formreach_post_type');
    }
}


// Contains the entire form
function formreach_include($formreach_id) {
	// Allows to use the post ID and call database's metadatas
	$formreach_id = shortcode_atts(
		array(
			'id' => '',
		), $formreach_id, 'form-reach' );

	$formreach_stored_meta_front = get_post_meta($formreach_id['id']);

	// Instantiate in the cache
	ob_start();

	wp_enqueue_style('form-reach-bootstrap-css', plugins_url('style/style.css', __FILE__), array(), '1.0.0');
    
    wp_enqueue_script('font-awesome',  plugin_dir_url(__FILE__) . 'assets/fontawesome/85a869994b.js', array(), '1.0.0', true);

	wp_register_script('form-reach', plugin_dir_url(__FILE__) . 'js/form-reach.js', array('jquery'), '1.0', true);
    wp_localize_script('form-reach', 'formReach', array(
        'formreach_chemin' => plugin_dir_url(__FILE__),
		'formreach_ajax_url' => admin_url('admin-ajax.php'),
        'formreach_recaptcha_switch' => esc_attr(get_option('formreach_recaptcha_switch')),
        'formreach_key_site' => esc_attr(get_option('formreach_key_site')),
		
    ));
    wp_enqueue_script('form-reach');

	if (esc_attr(get_option('formreach_recaptcha_switch')) === '1') {
        wp_enqueue_script('form-reach-recaptcha-js', 'https://www.google.com/recaptcha/api.js?render=' . esc_attr(get_option('formreach_key_site')), array(), '1.0.0', true);
    } ?>
		
		<section>
			<div class="container">	
				<div class="row">	
					<form class="form-reach" <?php echo ($formreach_stored_meta_front['formreach_whatsapp_switch'][0] == 1) ? 'id="formreach_whatsapp"' : 'id="formreach_mail"'; ?>>
									
						<?php
						global $formreach_is_form_reach_context;
						$formreach_is_form_reach_context = true;
	
						if ($formreach_stored_meta_front['formreach_whatsapp_switch'][0] == 1) {
							echo do_shortcode(wp_kses_post($formreach_stored_meta_front["formreach_whatsapp_form_content"][0]));
						} else {
							echo do_shortcode(wp_kses_post($formreach_stored_meta_front["formreach_email_form_content"][0]));
						}
	
						$formreach_is_in_form_reach = false;

						// Determines whether the WhatsApp submit button should be displayed
						$formreach_displayWhatsAppSubmit = esc_attr($formreach_stored_meta_front['formreach_whatsapp_switch'][0]) == 1 ? '' : 'style="display:none"';
						// Determines whether the Email submit button should be displayed
						$formreach_displayMailSubmit = esc_attr($formreach_stored_meta_front['formreach_whatsapp_switch'][0]) == 1 ? 'style="display:none"' : '';

						wp_nonce_field('formreach_send_contact_action', 'formreach_send_contact_nonce');

						// Form display
						echo '<div id="formreach_mail_submit" ' . wp_kses_post($formreach_displayMailSubmit) . '>';
						echo '<button type="submit" name="formreach_mail_submit" class="btn mb-3 mt-3 " style="background-color: ' . esc_attr($formreach_stored_meta_front['formreach_email_submit_color'][0]) . ';">';
						echo '<div id="formreach_submitContent">';
						echo '<i class="fa fa-envelope" style="color: ' . esc_attr($formreach_stored_meta_front['formreach_email_text_color'][0]) . ';"></i> ';
						echo '<span style="color: ' . esc_attr($formreach_stored_meta_front['formreach_email_text_color'][0]) . ';">' . esc_html($formreach_stored_meta_front['formreach_email_submit'][0]) . '</span>';
						echo '</div>';
						echo '<div id="formreach_spinner" class="spinner-border spinner-border-sm text-white" style="display:none"></div>';
						echo '</button>';
						echo '</div>';

						echo '<div id="formreach_whatsapp_submit" ' . wp_kses_post($formreach_displayWhatsAppSubmit) . '>';
						echo '<button type="submit" name="formreach_whatsapp_submit" class="btn mb-3 mt-3 " style="background-color: ' . esc_attr($formreach_stored_meta_front['formreach_whatsapp_submit_color'][0]) . ';">';
						echo '<div id="formreach_submitContentWhatsapp">';
						echo '<i class="fa fa-whatsapp" style="color: ' . esc_attr($formreach_stored_meta_front['formreach_whatsapp_text_color'][0]) . ';"></i> ';
						echo '<span style="color: ' . esc_attr($formreach_stored_meta_front['formreach_whatsapp_text_color'][0]) . ';">' . esc_html($formreach_stored_meta_front['formreach_whatsapp_submit'][0]) . '</span>';
						echo '</div>';
						echo '<div id="formreach_spinnerWhatsapp" class="spinner-border spinner-border-sm text-white" style="display:none"></div>';
						echo '</button>';
						echo '</div>';
						?>
						<div style="display:none">
                            <input type="hidden" name="formreach_container_post" value="<?php echo esc_attr($formreach_id['id']); ?>">
                        </div>
					</form>

					<div id="formreach_success_message" class="alert alert-success" style="display:none">
						<i class="fas fa-check" style="color: #28a745; font-size: 16px;"></i>
						<?php 
						if ($formreach_stored_meta_front['formreach_whatsapp_switch'][0] == 1) {
							echo esc_html($formreach_stored_meta_front['formreach_whatsapp_success'][0]); 
						} else { 
							echo esc_html($formreach_stored_meta_front['formreach_email_success'][0]); 
						} 
						?>
					</div>

					<div id="formreach_error_message" class="alert alert-danger" style="display:none">
						<i class="fas fa-times" style="color: #dc3545; font-size: 16px;"></i>
						<?php 
						if ($formreach_stored_meta_front['formreach_whatsapp_switch'][0] == 1) {
							echo esc_html($formreach_stored_meta_front['formreach_whatsapp_error'][0]); 
						} else { 
							echo esc_html($formreach_stored_meta_front['formreach_email_error'][0]); 
						} 
						?>
					</div>
				</div>
			</div>
		</section>
	<?php

	return ob_get_clean();
}

add_shortcode( 'formreach_form', 'formreach_include' );

include 'process/validation.php';
include 'process/whatsapp.php';