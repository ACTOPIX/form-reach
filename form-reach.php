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

						$formreach_whatsapp_switch = isset($formreach_stored_meta_front['formreach_whatsapp_switch'][0]) 
							? (int) $formreach_stored_meta_front['formreach_whatsapp_switch'][0] 
							: 0;

						wp_nonce_field( 'formreach_send_contact_action', 'formreach_send_contact_nonce' );

						if ( $formreach_whatsapp_switch === 0 ) : ?>
							<div id="formreach_mail_submit">
								<button 
									type="submit" 
									name="formreach_mail_submit" 
									class="btn formreach_submit_button mb-3 mt-3"
									style="background-color: <?php echo esc_attr($formreach_stored_meta_front['formreach_email_submit_color'][0]); ?>;"
								>
									<div 
										id="formreach_submitContent_<?php echo esc_attr($formreach_id['id']); ?>" 
										class="formreach_submit_button_content align-items-center"
										style="display:flex;"
									>
										<!-- Icône mail -->
										<svg 
											xmlns="http://www.w3.org/2000/svg" 
											width="16" 
											height="16" 
											viewBox="0 0 26 26" 
											fill="none" 
											style="margin-right: 0.4em;"
										>
											<g clip-path="url(#clip0_660_96)">
												<path 
													d="M24.9983 9.48608C25.1887 9.33472 25.4719 9.47632 25.4719 9.71558V19.7009C25.4719 20.9949 24.4221 22.0447 23.1282 22.0447H2.81567C1.52173 22.0447 0.471924 20.9949 0.471924 19.7009V9.72046C0.471924 9.47632 0.750244 9.3396 0.945557 9.49097C2.03931 10.3406 3.4895 11.4197 8.46997 15.0378C9.50024 15.7898 11.2385 17.3718 12.9719 17.3621C14.7151 17.3767 16.4875 15.7605 17.4788 15.0378C22.4592 11.4197 23.9045 10.3357 24.9983 9.48608ZM12.9719 15.7947C14.1047 15.8142 15.7356 14.3689 16.5559 13.7732C23.0354 9.07105 23.5286 8.66089 25.0227 7.48901C25.3059 7.26929 25.4719 6.92749 25.4719 6.56616V5.63843C25.4719 4.34448 24.4221 3.29468 23.1282 3.29468H2.81567C1.52173 3.29468 0.471924 4.34448 0.471924 5.63843V6.56616C0.471924 6.92749 0.637939 7.2644 0.921143 7.48901C2.41528 8.65601 2.90845 9.07105 9.38794 13.7732C10.2083 14.3689 11.8391 15.8142 12.9719 15.7947Z" 
													fill="<?php echo esc_attr($formreach_stored_meta_front['formreach_email_text_color'][0]); ?>"
												/>
											</g>
											<defs>
												<clipPath id="clip0_660_96">
													<rect 
														width="25" 
														height="25" 
														fill="white" 
														transform="translate(0.471924 0.169678)"
													/>
												</clipPath>
											</defs>
										</svg>
										<!-- Texte mail -->
										<span style="color: <?php echo esc_attr($formreach_stored_meta_front['formreach_email_text_color'][0]); ?>;">
											<?php echo esc_html($formreach_stored_meta_front['formreach_email_submit'][0]); ?>
										</span>
									</div>
									<div 
										id="formreach_spinner_<?php echo esc_attr($formreach_id['id']); ?>" 
										class="spinner-border spinner-border-sm text-white" 
										style="display:none"
									></div>
								</button>
							</div>
						<?php endif; ?>

						<?php
						if ( $formreach_whatsapp_switch === 1 ) : ?>
							<div id="formreach_whatsapp_submit">
								<button 
									type="submit" 
									name="formreach_whatsapp_submit" 
									class="btn formreach_submit_button mb-3 mt-3"
									style="background-color: <?php echo esc_attr($formreach_stored_meta_front['formreach_whatsapp_submit_color'][0]); ?>;"
								>
									<div 
										id="formreach_submitContentWhatsapp_<?php echo esc_attr($formreach_id['id']); ?>" 
										class="formreach_submit_button_content align-items-center"
										style="display:flex;"
									>
										<svg 
											xmlns="http://www.w3.org/2000/svg" 
											width="16" 
											height="16" 
											viewBox="0 0 27 27" 
											fill="none" 
											style="margin-right: 0.4em;"
										>
											<path 
												d="M21.774 5.12051C19.5645 2.90566 16.6219 1.6875 13.4947 1.6875C7.04004 1.6875 1.7877 6.93984 1.7877 13.3945C1.7877 15.4564 2.32559 17.4709 3.34863 19.248L1.6875 25.3125L7.89434 23.683C9.60293 24.6164 11.5277 25.1068 13.4895 25.1068H13.4947C19.9441 25.1068 25.3125 19.8545 25.3125 13.3998C25.3125 10.2727 23.9836 7.33535 21.774 5.12051ZM13.4947 23.1346C11.7439 23.1346 10.0301 22.6652 8.53769 21.7793L8.18437 21.5684L4.50352 22.5334L5.48438 18.9422L5.25234 18.573C4.27676 17.0227 3.76523 15.235 3.76523 13.3945C3.76523 8.03145 8.13164 3.66504 13.5 3.66504C16.0998 3.66504 18.5414 4.67754 20.3766 6.51797C22.2117 8.3584 23.3402 10.8 23.335 13.3998C23.335 18.7682 18.8578 23.1346 13.4947 23.1346ZM18.8314 15.8467C18.5414 15.699 17.1018 14.9924 16.8328 14.8975C16.5639 14.7973 16.3688 14.7498 16.1736 15.0451C15.9785 15.3404 15.4195 15.9943 15.2455 16.1947C15.0768 16.3898 14.9027 16.4162 14.6127 16.2686C12.8936 15.409 11.765 14.734 10.6313 12.7881C10.3307 12.2713 10.9318 12.3082 11.4908 11.1902C11.5857 10.9951 11.5383 10.8264 11.4645 10.6787C11.3906 10.5311 10.8053 9.09141 10.5627 8.50605C10.3254 7.93652 10.0828 8.01563 9.90352 8.00508C9.73477 7.99453 9.53965 7.99453 9.34453 7.99453C9.14941 7.99453 8.83301 8.06836 8.56406 8.3584C8.29512 8.65371 7.54102 9.36035 7.54102 10.8C7.54102 12.2396 8.59043 13.6318 8.73281 13.827C8.88047 14.0221 10.7947 16.9752 13.732 18.2461C15.5883 19.0477 16.316 19.1162 17.2441 18.9791C17.8084 18.8947 18.9738 18.2725 19.2164 17.5869C19.459 16.9014 19.459 16.316 19.3852 16.1947C19.3166 16.0629 19.1215 15.9891 18.8314 15.8467Z" 
												fill="<?php echo esc_attr($formreach_stored_meta_front['formreach_whatsapp_text_color'][0]); ?>"
											/>
										</svg>
										<span style="color: <?php echo esc_attr($formreach_stored_meta_front['formreach_whatsapp_text_color'][0]); ?>;">
											<?php echo esc_html($formreach_stored_meta_front['formreach_whatsapp_submit'][0]); ?>
										</span>
									</div>
									<div 
										id="formreach_spinnerWhatsapp_<?php echo esc_attr($formreach_id['id']); ?>" 
										class="spinner-border spinner-border-sm text-white" 
										style="display:none"
									></div>
								</button>
							</div>
						<?php endif; ?>

                        <input type="hidden" name="formreach_container_post" value="<?php echo esc_attr($formreach_id['id']); ?>">
					</form>

					<div id="formreach_success_message_<?php echo esc_attr($formreach_id['id']); ?>" class="alert alert-success" style="display:none">
						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 35 35" fill="none"><path d="M8.4911 21.4554L0.366101 13.3304C-0.122034 12.8422 -0.122034 12.0508 0.366101 11.5626L2.13383 9.79481C2.62196 9.30663 3.41346 9.30663 3.9016 9.79481L9.37499 15.2682L21.0984 3.54481C21.5865 3.05668 22.378 3.05668 22.8662 3.54481L24.6339 5.31259C25.122 5.80072 25.122 6.59218 24.6339 7.08036L10.2589 21.4554C9.77069 21.9435 8.97924 21.9435 8.4911 21.4554Z" fill="#0f5132"/>
						</svg>
						<?php 
						if ($formreach_stored_meta_front['formreach_whatsapp_switch'][0] == 1) {
							echo esc_html($formreach_stored_meta_front['formreach_whatsapp_success'][0]); 
						} else { 
							echo esc_html($formreach_stored_meta_front['formreach_email_success'][0]); 
						} 
						?>
					</div>

					<div id="formreach_error_message_<?php echo esc_attr($formreach_id['id']); ?>" class="alert alert-danger" style="display:none">
						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 384 512" style="margin-right:2px"><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" fill="#842029"/>
						</svg>
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