<?
//Custom Post type
function cw_post_type_news() {
	$labels = array(
	'name' => _x( 'Formulaires', 'plural'),
	'singular_name' => _x( 'Formulaire', 'singular'),
	'menu_name' => _x( 'Formulaires de Contact', 'admin menu'),
	'name_admin_bar' => _x( 'Formulaire', 'admin bar'),
	'add_new' => _x('Ajouter', 'ajouter'),
	'add_new_item' => __('Action Form'),
	'new_item' => __('Nouveau Wp Admin'),
	'edit_item' => __('Paramètres des Formulaires'),
	'view_item' => __('Voir Wp Admin'),
	// 'all_items' => __(''),
	'search_items' => __('Search Wp Admin'),
	'not_found' => __('No Wp Admin found.'),
	
	);
	$args = array(
	'labels' => $labels,
	'public' => false,
	'publicly_queryable'=>true,
	'show_ui'=>true,
	'exclude_from_search' => true,
	'show_in_nav_menus' => false,
	'has_archive' => false,
	'query_var' => true,
	'rewrite' => false,
	'has_archive' => true,
	'hierarchical' => false,
	'menu_icon' => 'dashicons-media-text',
	);
	register_post_type('wp_action_form', $args);
}
add_action('init', 'cw_post_type_news');

// Customisation du tableau admin
function smashing_wp_action_form_columns( $columns ) {
	$columns = array(
		'cb' => $columns['cb'],
		'title' => __( 'Title' ),
		'shortcode' => __( 'Shortcode' ),
		'author' => __( 'Author'),
		'date' => __( 'Date' ),
    );
	return $columns;
}
add_filter( 'manage_wp_action_form_posts_columns', 'smashing_wp_action_form_columns' );

add_action( 'manage_wp_action_form_posts_custom_column', 'wp_action_form_column', 10, 2);

// Ajoue du shortcode final dans le tableau Administrateur
function wp_action_form_column( $column, $post_id ) {
  if ( 'shortcode' === $column ) {
	?>
	<input type="text" readonly="readonly" onfocus="this.select()" value='[wp-action-form id="<?echo $post_id?>"]'>
	<?
  }
}

// Customisation des actions au survol des formulaires
function modify_list_row_actions( $actions, $post ) {

	unset( $actions['view'] );
	return $actions;
}
add_filter( 'post_row_actions', 'modify_list_row_actions', 10, 2 );

// Supression du modificateur de contenu wordpress
function hide_editor() {

	$post_type="wp_action_form";
	remove_post_type_support( $post_type, 'editor' );
	remove_post_type_support( $post_type, 'author' );
}
add_action( 'init', 'hide_editor' );

// Supression de la metabox Slug
function my_add_meta_boxes() {
	
	remove_meta_box( 'slugdiv', 'wp_action_form', 'normal' );
}
add_action( 'add_meta_boxes', 'my_add_meta_boxes' );

// Customisation page de modification
function register_metabox_post_type(){

	add_meta_box(
		'metaboxwpadmin',
		'Formulaire Wp Admin',
		'register_metabox_callback',
		'wp_action_form'
	);
}
add_action('add_meta_boxes','register_metabox_post_type');

function register_metabox_callback($post){

// Ajoue des meta values
	add_post_meta( get_the_ID(), 'wpaf_pour', get_option('admin_email'), true );
	add_post_meta( get_the_ID(), 'wpaf_de', "Action Form", true );
	add_post_meta( get_the_ID(), 'wpaf_objet', "Message d'un utilisateur", true );
	add_post_meta( get_the_ID(), 'wpaf_contenu', "", true );
	add_post_meta( get_the_ID(), 'wpaf_succes', "Le formulaire a été envoyé avec succès.", true );
	add_post_meta( get_the_ID(), 'wpaf_erreur', "Le formulaire n\'a pas pu être envoyé suite à une erreur. Veuillez réessayer.", true );

	add_post_meta( get_the_ID(), 'wpaf_contenu_formulaire_mail', "[input type='text' label='Nom' name='nom' required='required' placeholder='Veuillez saisir votre nom']

[input type='text' label='Prénom' name='prenom' required='required' placeholder='Veuillez saisir votre prénom']

[input type='email' label='Adresse mail' name='mail' required='required' placeholder='Veuillez saisir votre e-mail']

[input type='textarea' rows='10' cols='0' label='Message' name='message' required='required' placeholder='Veuillez saisir le contenu de votre message']", true );

	add_post_meta( get_the_ID(), 'wpaf_contenu_formulaire_whatsapp', "[input type='text' label='Nom' name='nom' required='required' placeholder='Veuillez saisir votre nom']

[input type='text' label='Prénom' name='prenom' required='required' placeholder='Veuillez saisir votre prénom']

[input type='textarea' rows='10' cols='0' label='Message' name='message' required='required' placeholder='Veuillez saisir le contenu de votre message']", true );

	add_post_meta( get_the_ID(), 'wpaf_whatsapp_switch', "", true );
	add_post_meta( get_the_ID(), 'wpaf_recaptcha_switch', "", true );
	add_post_meta( get_the_ID(), 'wpaf_whatsapp_tel', "", true );
	add_post_meta( get_the_ID(), 'wpaf_whatsapp_tel_international', "", true );
	add_post_meta( get_the_ID(), 'wpaf_whatsapp_flag', "", true );
	add_post_meta( get_the_ID(), 'wpaf_default_mail', "", true );
	add_post_meta( get_the_ID(), 'wpaf_default_whatsapp', "", true );
	add_post_meta( get_the_ID(), 'wpaf_key_site', "", true );
	add_post_meta( get_the_ID(), 'wpaf_key_secret', "", true );




	$wp_stored_meta = get_post_meta( $post ->ID);
	wp_nonce_field( basename(__FILE__), 'wp_formulaire_nonce');

	include 'modal-action-form.php';
}


// Shortcode générateur de balise - formulaire

class Wpaf_Id {
    public static function counter() {
        static $counter = 0;
        $counter++;
        return $counter;
    }
}

function action_form_input_type($atts){


	$id_auto=Wpaf_Id::counter();
	
	$atts = shortcode_atts(
							array(
								'type' => 'text',
								'name' => 'default',
								'id' => $id_auto,
								'placeholder' => null,
								'required' => null,
								'label' => null,
								'class' => null,
								'value'=>null,
								'cols'=>null,
								'rows'=>null,
							), $atts, 'input'
						);
	

	if(strpos(( $atts['type'] ), "textarea") !== false){

		return '<div class=" mb-3 mt-3">
					<label class ="form-label" for="'. ($atts['name']).'_'.( $atts['id']) .'">'.( $atts['label']).'</label>
					<textarea type="'. ( $atts['type'] ).'" class="form-control '.+( $atts['class']).'" id="'.($atts['name']).'_'.( $atts['id']).'" name="'. ( $atts['name'] ).'" placeholder="'.( $atts['placeholder']).'" required="'.( $atts['required']).'" value="'.($atts['value']).'"  cols="'.( $atts['cols']).'" rows="'.( $atts['rows']).'"></textarea>
				</div>';
	}else{

		return '<div class=" mb-3 mt-3">
					<label class ="form-label" for="'. ($atts['name']).'_'.( $atts['id']) .'">'.( $atts['label']).'</label>
					<input type="'. ( $atts['type'] ).'" class="form-control '.+( $atts['class']).'" id="'.($atts['name']).'_'.( $atts['id']).'" name="'. ( $atts['name'] ).'" placeholder="'.( $atts['placeholder']).'" required="'.( $atts['required']).'" value="'.($atts['value']).'"/>
				</div>';
	}
}
add_shortcode('input','action_form_input_type');

// Meta values bdd
function wp_meta_save($post_id) {

	$is_autosave = wp_is_post_autosave( $post_id);
	$is_revision = wp_is_post_revision( $post_id);
	$is_valid_nonce = (isset($_POST['wp_formulaire_nonce'])&& wp_verify_nonce($_POST['wp_formulaire_nonce'], basename(__FILE__) ) )? 'true' : 'false';

	if ($is_autosave || $is_revision || !$is_valid_nonce){
		exit;
	}
	if ( isset($_POST['wpaf_pour'])){
	update_post_meta($post_id,'wpaf_pour',sanitize_text_field($_POST['wpaf_pour']) );
	}
	if ( isset($_POST['wpaf_de'])){
	update_post_meta($post_id,'wpaf_de',sanitize_text_field($_POST['wpaf_de']) );
	}
	if ( isset($_POST['wpaf_objet'])){
	update_post_meta($post_id,'wpaf_objet',sanitize_text_field($_POST['wpaf_objet']) );
	}
	if ( isset($_POST['wpaf_contenu'])){
	update_post_meta($post_id,'wpaf_contenu',sanitize_text_field($_POST['wpaf_contenu']) );
	}
	if ( isset($_POST['wpaf_succes'])){
		update_post_meta($post_id,'wpaf_succes',sanitize_text_field($_POST['wpaf_succes']) );
	}
	if ( isset($_POST['wpaf_erreur'])){
		update_post_meta($post_id,'wpaf_erreur',sanitize_text_field($_POST['wpaf_erreur']) );
	}
	if ( isset($_POST['wpaf_contenu_formulaire_mail'])){
		update_post_meta($post_id,'wpaf_contenu_formulaire_mail',$_POST['wpaf_contenu_formulaire_mail']);
	}
	if ( isset($_POST['wpaf_contenu_formulaire_whatsapp'])){
		update_post_meta($post_id,'wpaf_contenu_formulaire_whatsapp',$_POST['wpaf_contenu_formulaire_whatsapp']);
	}
	if ( isset($_POST['wpaf_whatsapp_tel'])){
		update_post_meta($post_id,'wpaf_whatsapp_tel',sanitize_text_field($_POST['wpaf_whatsapp_tel']) );
	}
	if ( isset( $_POST['wpaf_whatsapp_flag'])){
		update_post_meta( $post_id, 'wpaf_whatsapp_flag', sanitize_text_field( $_POST['wpaf_whatsapp_flag']) );
	}
	if ( isset( $_POST['wpaf_whatsapp_tel_international'])){
		update_post_meta( $post_id, 'wpaf_whatsapp_tel_international', sanitize_text_field( $_POST['wpaf_whatsapp_tel_international']) );
	}
	if ( isset( $_POST['wpaf_key_site'])){
		update_post_meta( $post_id, 'wpaf_key_site', sanitize_text_field( $_POST['wpaf_key_site']) );
	}
	if ( isset( $_POST['wpaf_key_secret'])){
		update_post_meta( $post_id, 'wpaf_key_secret', sanitize_text_field( $_POST['wpaf_key_secret']) );
	}
	if ( isset($_POST['wpaf_whatsapp_switch'])){
		update_post_meta($post_id,'wpaf_whatsapp_switch', "1" );
	}else{
		update_post_meta($post_id,'wpaf_whatsapp_switch', "0" );
	}
	if ( isset($_POST['wpaf_recaptcha_switch'])){
		update_post_meta($post_id,'wpaf_recaptcha_switch', "1" );
	}else{
		update_post_meta($post_id,'wpaf_recaptcha_switch', "0" );
	}

}
add_action('save_post','wp_meta_save');

function wp_add_custom_submenu(){

    add_submenu_page(
					"edit.php?post_type=wp_action_form",
					"Entrées de Formulaire",
					"Entrées de Formulaire",
					"manage_options","entrees-formulaire",
					"entrees_formulaire"
				);
}
add_action("admin_menu","wp_add_custom_submenu");

function entrees_formulaire(){
	?>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"></script>
		<div class="container pt-5">
			<h1 class="pb-5">Entrées des Formulaires de Contact</h1>

			<?
			global $wpdb;
			$table = $wpdb->prefix . "formulaire";
			$row_count = $wpdb->get_var("SELECT COUNT(*) FROM $table");

			if ($row_count == 0){
				echo "<h5 class='text-center'>Aucun message à afficher pour le moment.</h5></br></br>
				<h6 class='text-center text-muted'>Ici s'afficheront les messages envoyés par les utilisateurs.</h6>";
			}else{
			?>

			<div class="row justify-content-between">
				<div class="col-md-3 col-9">
					<div class="input-group">
						<select class="form-select" name="action">
							<option selected>Action groupées</option>
							<option value="2">Duppliquer</option>
							<option value="3">Supprimer</option>
						</select>
						<button class="btn btn-outline-secondary" type="button">Appliquer</button>
					</div>
				</div>

				<div class="col-md-3 col-12">
					<form>
						<div class="input-group mb-3">
							<input type="search" style="width=200px" name="search" class="form-control" placeholder="Rechercher">
							<button type="submit" name="search_submit" class="btn btn-primary mx-auto">
								<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
									<path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
								</svg>
							</button>
						</div>
					</form>
				</div>
			</div>

			<div class="row pb-5 pt-3 fs-6">
				<form method="post">
					<div class="col">
						<table class="table table-responsive table-striped table-hover table-bordered align-middle text-center p-3">
							<thead>
								<tr>
									<th scope="col">
										<input type="checkbox" id="checkbox" value="">
									</th>
									<th scope="col">
										ID
									</th>
									<th scope="col">
										Type
									</th>
									<th scope="col" class="display-sm-none">
										Contenu du formulaire
									</th>
									<th scope="col">
										Date
									</th>
									<th scope="col">
										Supprimer
									</th>
								</tr>
							</thead>
							<tbody>
								<?
									// Récupération des données de la la database
										global $wpdb;
										$table = $wpdb->prefix . "formulaire";

										
										if(isset($_POST['supprimer'])){
											$wpdb->delete($table,
															array(
																'ID'=>$_POST['supprimer']
															)
															);
										};
										
										// Affichage des données dans le tableau admin
										$result =$wpdb->get_results("SELECT * FROM $table;");

										foreach ($result as $table) {
											$supprimerId = ($table->ID);
								?>
									<tr>
										<th scope="row">
											<input type="checkbox" id="checkbox" value="">
										</th>
										<td>
											<?echo ($table->ID)?></td>
										</td>
										<td>
											<?echo ($table->Type)?></td>
										</td>
										<td>
											<?echo ($table->Contenu)?>
										</td>
										<td>
											<?echo ($table->created_at)?>
										</td>
										<td>
											<button class="remove btn btn-danger btn-sm" name="supprimer" value="<?php echo $supprimerId ?>">Supprimer</button>
										</td>
									</tr>
									<?
										}
										}
									?>
							</body>
						</table>
					</div>
				</form>	
			</div>
		</div>
	<?
}

function wp_add_custom_submenu_reCAPTCHA(){

	add_submenu_page(
					"edit.php?post_type=wp_action_form",
					"reCAPTCHA Google v3",
					"reCAPTCHA Google v3",
					"manage_options",
					"wp-reCAPTCHAGooglev3",
					"recaptcha"
				);
}
add_action("admin_menu","wp_add_custom_submenu_reCAPTCHA");


function recaptcha($post){

	$wp_stored_meta = get_post_meta( $post ->ID);

	error_log( $wp_stored_meta );

	$key_site = get_option('wpaf_key_site');
	$key_secret = get_option('wpaf_key_secret');

	?>
		<head>
			<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
			<scrip src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"></script>
			<script src="<?php echo plugin_dir_url(__FILE__); ?>js/action-form-admin.js"></script>
		</head>

		<div class="card" id="recaptcha">
			<h4 class="ms-1.7 mb-5">Google reCAPTCHA V3</h4>
			<div>
			<input type="checkbox" class="mb-5" name="wpaf_recaptcha_switch" id="wpaf_recaptcha_switch" onclick="switchRecaptcha()"/><label id="wpaf_recaptcha_label"for="wpaf_recaptcha_switch">Toggle</label>
			<p class="float-end text-secondary">Protection contre le contenu indésirable</p>
			</div>
			<div>
				<p>reCAPTCHA vous protège contre les indésirables et autres types d’abus automatisés. 
					Avec le module d’intégration reCAPTCHA d'Action Form, vous pouvez bloquer les envois abusifs de formulaires par des robots spammeurs.</p>
				<p><strong><a href="https://www.google.com/recaptcha/about/">reCAPTCHA (v3)</a></strong></p>
				<form method="post">
					<table class="form-table">
						<tbody>
							<tr>
								<th scope="row"><label for="wpaf_key_site">Clé du site</label></th>
								<td><input type="text" id="wpaf_key_site" name="wpaf_key_site" class="regular-text code" aria-required="true" value="<?php if (!empty($wp_stored_meta['wpaf_key_site'])) echo esc_attr(get_post_meta($post->ID, $wp_stored_meta['wpaf_key_site'][0], true)); ?>"></td>
							</tr>
							<tr>
								<th scope="row"><label for="wpaf_key_secret">Clé secrète</label></th>
								<td><input type="text" id="wpaf_key_secret" name="wpaf_key_secret" class="regular-text code" aria-required="true" value="<?php if (!empty($wp_stored_meta['wpaf_key_secret'])) echo esc_attr($wp_stored_meta['wpaf_key_secret'][0]); ?>"></td>
							</tr>
						</tbody>
					</table>
					<p class="submit"><input type="submit" name="wpaf_recaptcha_submit" id="wpaf_recaptcha_submit" class="button button-primary" value="Enregistrer les changements"></p>
				</form>
			</div>
		</div>

		<!-- style du bouton reCAPTCHA -->
		<style>
			#wpaf_recaptcha_switch{
				height: 0;
				width: 0;
				visibility: hidden;
				user-select: none;
			}
			#wpaf_recaptcha_label {
				cursor: pointer;
				text-indent: -9999px;
				width: 50px;
				height: 25.5px;
				background: grey;
				display: block;
				border-radius: 100px;
				position: relative;
				user-select: none;
				float:left;
			}
			#wpaf_recaptcha_label:after {
				content: '';
				position: absolute;
				top: 2.562px;
				left: 2.5px;
				width: 20px;
				height: 20px;
				background: #fff;
				border-radius: 90px;
				transition: 0.3s;
			}
			#wpaf_recaptcha_switch:checked + #wpaf_recaptcha_label {
				background: #2271b1;
			}
			#wpaf_recaptcha_switch:checked + #wpaf_recaptcha_label:after {
				left: calc(100% - 2.5px);
				transform: translateX(-100%);
			}
			#wpaf_recaptcha_label:active:after {
				width: 32.5px;
			}
		</style>
	<?php
}