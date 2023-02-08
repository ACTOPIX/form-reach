<?php
/**
 * Plugin Name: wp-action-form
 * Description: Formulaire WordPress
 * Version: 1.0
 */


if ( !defined( 'ABSPATH' ) ) exit;

// Agie sur l'activation du plugin
register_activation_hook( __FILE__, "activate_myplugin" );

// Agie sur la désactivation du plugin
register_deactivation_hook( __FILE__, "deactivate_myplugin" );

// Agie sur la suppression du plugin
register_uninstall_hook( __FILE__, "delete_myplugin" );

// Activation Plugin
function activate_myplugin() {

	init_db_action_form() ;
}

//Désactivation Plugin
function deactivate_myplugin(){

	delete_db_action_form();
}

//Supression Plugin
function delete_myplugin(){

	delete_db_action_form();
}

// Initialisation de la table du plugin
function init_db_action_form() {

	global $wpdb;
	
	$formulaire = $wpdb->prefix . "formulaire";

		// Création de la table personnalisée si elle n'existe pas
		if( $wpdb->get_var( "show tables like '$formulaire'" ) != $formulaire) {
			$sql = "CREATE TABLE `$formulaire` (";
			$sql .= " `ID` int(11) NOT NULL auto_increment, ";
			$sql .= " `Type` varchar(100) NOT NULL, ";
			$sql .= " `Contenu` varchar(10000) NOT NULL, ";
			$sql .= "`created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,";
			$sql .= " PRIMARY KEY `customer_id` (`id`) ";
			$sql .= ") ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;";
			// Inclue le scripte upgrade
			require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
		
			dbDelta( $sql );
		}	
}

function delete_db_action_form(){

	global $wpdb;
	$formulaire = $wpdb->prefix . "formulaire";

	$wpdb->query( "DROP table IF exists $formulaire");
	
}

include 'action-form-admin.php';


function wp_action_form_include($id) {

	$id = shortcode_atts(
		array(
			'id' => '',
		), $id, 'wp-action-form' );

	$wp_stored_meta_front = get_post_meta($id['id']);

	ob_start();

	?>

		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script src="<? echo plugin_dir_url(__FILE__)?>js/wp-action-form.js"></script>
		<script src="https://www.google.com/recaptcha/api.js?render=6LcYu_gaAAAAANJVIQPE35j97DxUCXXozlLiXhpK"></script>

		<form <?php if ($wp_stored_meta_front['wpaf_whatsapp_switch'][0] == 1){?>id="action_form_whatsapp"<?php }else{ ?> id="action_form_mail" <?php } ?> accept-charset="UTF-8" name="action_form_mail" method="post" action="javascript:void(0)">
						
			<? echo wp_nonce_field('nonce_verification')?>

			<?echo $wp_stored_meta_front["wpaf_contenu_formulaire"][0]?>

			<div id="wpaf_mail_submit" <?php if ($wp_stored_meta_front['wpaf_whatsapp_switch'][0] == 1){?>style="display:none"<?php }else{ ?> style="display:block" <?php } ?>>
				<button type="submit" id="submit" name="wpaf_mail_submit" class="btn btn-primary mb-3 mt-3 g-recaptcha">
					<div id="submitContent">
						<svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
							<path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/>
						</svg> Envoyer
					</div>
					<div id="spinner" class="spinner-border spinner-border-sm" style="display:none"></div>
				</button>
			</div>

			<div id="wpaf_whatsapp_submit" <?php if ($wp_stored_meta_front['wpaf_whatsapp_switch'][0] == 1){?>style="display:block"<?php }else{ ?> style="display:none" <?php } ?>>
				<button type="submit" id ="whatsapp" name="wpaf_whatsapp_submit" class="btn btn-success mb-3 mt-3 g-recaptcha">
					<div id="submitContentWhatsapp">
						<svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
							<path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
						</svg> WhatsApp
					</div>
					<div id="spinnerWhatsapp" class="spinner-border spinner-border-sm" style="display:none"></div>
				</button>
			</div>

			<div style="display:none">
				<input type="hidden" name="wpaf_container_post" value="<?echo $id['id'];?>">
				<input type="hidden" name="g-recaptcha-response" value="" id="g-recaptcha-response">
			</div>

			</form>
							
			<div id="success_message" class="alert alert-success position-absolute start-50 translate-middle" style="display:none">
				<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
					<path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
				</svg>
				<?echo $wp_stored_meta_front['wpaf_succes'][0]?>
			</div>

			<div id="error_message" class="alert alert-danger position-absolute start-50 translate-middle" style="display:none">
				<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
					<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
				</svg>
				<?echo $wp_stored_meta_front['wpaf_erreur'][0]?>
			</div>
	<?

	return ob_get_clean();
}

add_shortcode( 'wp-action-form', 'wp_action_form_include' );