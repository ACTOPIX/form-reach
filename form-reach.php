<?php
/*
Plugin Name: Form Reach
Description: Custom Contact Form Builder to WhatsApp, Email, and more!
Version: beta
Author: Form Reach
Author URI: https://form-reach.com/
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html
Text Domain: form-reach-domain

@package FormReach
*/

// Adding a 'Settings' link to the list of metadata displayed below the plugin description.
function form_reach_settings_link($links) {
    $settings_link = '<a href="edit.php?post_type=form_reach">Settings</a>';
    array_unshift($links, $settings_link);
    return $links;
}
add_filter('plugin_action_links_'.plugin_basename(__FILE__), 'form_reach_settings_link');

// This line of code checks if the constant ABSPATH is defined and, if not, it exits the script to prevent unauthorized access to sensitive files.
if ( !defined('ABSPATH') ) exit;

// Acts on plugin activation.
register_activation_hook(__FILE__, 'activate_myplugin');

// Acts on plugin deactivation.
register_deactivation_hook(__FILE__, 'deactivate_myplugin');

// Acts on plugin removal.
register_uninstall_hook(__FILE__, 'delete_myplugin');

// Plugin activation function.
function activate_myplugin() {
    init_db_form_reach();
}

// Plugin deactivation function.
function deactivate_myplugin() {
    // This function can include actions to perform on deactivation.
}

// Plugin removal function.
function delete_myplugin() {
    delete_db_form_reach();
}

// Initialization of the plugin table.
function init_db_form_reach() {
    global $wpdb;
    
    $form_history = $wpdb->prefix . "form_history";

    // Creation of the custom table if it does not exist.
    if($wpdb->get_var("SHOW TABLES LIKE '$form_history'") != $form_history) {
        $sql = "CREATE TABLE `$form_history` (
                `ID` int(11) NOT NULL AUTO_INCREMENT,
                `Type` varchar(100) NOT NULL,
                `Content` varchar(10000) NOT NULL,
                `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`ID`)
                ) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;";
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }   
}

// Remove the plugin's table in the database.
function delete_db_form_reach() {
    global $wpdb;
    $form_history = $wpdb->prefix . "form_history";

    $wpdb->query("DROP TABLE IF EXISTS $form_history");
}

// Registers and enqueues scripts.
function bbx_enqueue_scripts() {
    wp_register_script('form-reach', plugin_dir_url(__FILE__) . 'js/form-reach.js', array('jquery'), '1.0', true);
    wp_enqueue_script('form-reach');
}
add_action('wp_enqueue_scripts', 'bbx_enqueue_scripts');

include 'form-reach-admin.php';

// Contains the entire form
function form_reach_include($id) {
	// Allows to use the post ID and call database's metadatas
	$id = shortcode_atts(
		array(
			'id' => '',
		), $id, 'form-reach' );

	$wp_stored_meta_front = get_post_meta($id['id']);

	// Instantiate in the cache
	ob_start();

	// Enqueue les styles existants
    wp_enqueue_style('form-reach-bootstrap-css', plugins_url('style/style.css', __FILE__));
    
    // Enqueue FontAwesome
    wp_enqueue_script('font-awesome', 'https://kit.fontawesome.com/85a869994b.js');

	if (esc_attr(get_option('fr_recaptcha_switch')) === '1') {
        wp_enqueue_script('form-reach-recaptcha-js', 'https://www.google.com/recaptcha/api.js?render=' . esc_attr(get_option('fr_key_site')), array(), null, true);
    } ?>
		
		<section>
			<div class="container">	
				<div class="row">	
					<form class="form-reach" <?php echo ($wp_stored_meta_front['fr_whatsapp_switch'][0] == 1) ? 'id="form_reach_whatsapp"' : 'id="form_reach_mail"'; ?> accept-charset="UTF-8" method="post" action="javascript:void(0)">
									
						<?php echo wp_nonce_field('nonce_verification');
		
						if ($wp_stored_meta_front['fr_whatsapp_switch'][0] == 1) {
							echo do_shortcode(wp_kses_post($wp_stored_meta_front["fr_whatsapp_form_content"][0]));
						} else {
							echo do_shortcode(wp_kses_post($wp_stored_meta_front["fr_email_form_content"][0]));
						}

						// Détermine si le bouton de soumission WhatsApp doit être affiché
						$displayWhatsAppSubmit = $wp_stored_meta_front['fr_whatsapp_switch'][0] == 1 ? '' : 'style="display:none"';
						// Détermine si le bouton de soumission Email doit être affiché
						$displayMailSubmit = $wp_stored_meta_front['fr_whatsapp_switch'][0] == 1 ? 'style="display:none"' : '';

						// Vérifie si reCAPTCHA est activé
						$recaptchaClass = esc_attr(get_option('fr_recaptcha_switch')) === '1' ? 'g-recaptcha' : '';

						// Soumission du formulaire
						echo '<div id="fr_mail_submit" ' . $displayMailSubmit . '>';
						echo '<button type="submit" name="fr_mail_submit" class="btn mb-3 mt-3 ' . $recaptchaClass . '" style="background-color: ' . esc_attr($wp_stored_meta_front['fr_email_submit_color'][0]) . ';">';
						echo '<div id="submitContent">';
						echo '<i class="fa fa-envelope" style="color: ' . esc_attr($wp_stored_meta_front['fr_email_text_color'][0]) . ';"></i> ';
						echo '<span style="color: ' . esc_attr($wp_stored_meta_front['fr_email_text_color'][0]) . ';">' . esc_html($wp_stored_meta_front['fr_email_submit'][0]) . '</span>';
						echo '</div>';
						echo '<div id="spinner" class="spinner-border spinner-border-sm text-white" style="display:none"></div>';
						echo '</button>';
						echo '</div>';

						echo '<div id="fr_whatsapp_submit" ' . $displayWhatsAppSubmit . '>';
						echo '<button type="submit" name="fr_whatsapp_submit" class="btn mb-3 mt-3 ' . $recaptchaClass . '" style="background-color: ' . esc_attr($wp_stored_meta_front['fr_whatsapp_submit_color'][0]) . ';">';
						echo '<div id="submitContent">';
						echo '<i class="fa fa-whatsapp" style="color: ' . esc_attr($wp_stored_meta_front['fr_whatsapp_text_color'][0]) . ';"></i> ';
						echo '<span style="color: ' . esc_attr($wp_stored_meta_front['fr_whatsapp_text_color'][0]) . ';">' . esc_html($wp_stored_meta_front['fr_whatsapp_submit'][0]) . '</span>';
						echo '</div>';
						echo '<div id="spinner" class="spinner-border spinner-border-sm text-white" style="display:none"></div>';
						echo '</button>';
						echo '</div>';

						?>

						<div style="display:none">
							<input type="hidden" name="fr_container_post" value="<?php echo esc_attr($id['id']); ?>">
							<input type="hidden" id="fr_key_site" value="<?php echo esc_attr(get_option('fr_key_site')); ?>">
							<?php if (esc_attr(get_option('fr_recaptcha_switch')) === '1'): ?>
								<input type="hidden" name="g-recaptcha-response" value="" id="g-recaptcha-response">
								<input type="hidden" id="fr_recaptcha_switch" value="1">
							<?php endif; ?>
						</div>
					</form>
					<div id="success_message" class="alert alert-success" style="display:none">
						<i class="fas fa-check" style="color: #28a745; font-size: 16px;"></i>
						<?php 
						if ($wp_stored_meta_front['fr_whatsapp_switch'][0] == 1) {
							echo esc_html($wp_stored_meta_front['fr_whatsapp_success'][0]); 
						} else { 
							echo esc_html($wp_stored_meta_front['fr_email_success'][0]); 
						} 
						?>
					</div>

					<div id="error_message" class="alert alert-danger" style="display:none">
						<i class="fas fa-times" style="color: #dc3545; font-size: 16px;"></i>
						<?php 
						if ($wp_stored_meta_front['fr_whatsapp_switch'][0] == 1) {
							echo esc_html($wp_stored_meta_front['fr_whatsapp_error'][0]); 
						} else { 
							echo esc_html($wp_stored_meta_front['fr_email_error'][0]); 
						} 
						?>
					</div>
				</div>
			</div>
		</section>
	<?php

	return ob_get_clean();
}

add_shortcode( 'form-reach', 'form_reach_include' );
