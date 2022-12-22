<?
//Custom Post type start
function cw_post_type_news() {
	$labels = array(
	'name' => _x( 'Formulaires', 'plural'),
	'singular_name' => _x( 'Formulaire', 'singular'),
	'menu_name' => _x( 'Formulaires de Contact', 'admin menu'),
	'name_admin_bar' => _x( 'Formulaire', 'admin bar'),
	'add_new' => _x('Ajouter', 'ajouter'),
	'add_new_item' => __('Formulaire de Contact'),
	'new_item' => __('Nouveau Wp Admin'),
	'edit_item' => __('Paramètres des Formulaires'),
	'view_item' => __('V0ir Wp Admin'),
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
//Custom Post type end

add_action('init', 'cw_post_type_news');


// Customisation du tableau admin

add_filter( 'manage_wp_action_form_posts_columns', 'smashing_wp_action_form_columns' );
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

// add_action( 'manage_wp_action_form_posts_custom_column', 'smashing_wp_action_form_column', 10, 2);
// function smashing_wp_action_form_column( $column, $post_id ) {
//   // Image column
//   if ( 'shortcode' === $column ) {
//     echo get_the_post_thumbnail( $post_id, array(80, 80) );
//   }
// }

//Customisation du tableau admin


//Customisation des actions au survol des formulaires

add_filter( 'post_row_actions', 'modify_list_row_actions', 10, 2 );

function modify_list_row_actions( $actions, $post ) {

	unset( $actions['view'] );

	return $actions;
}
//Customisation des actions au survol des formulaires


//Supression du modificateur de contenu wordpress
add_action( 'init', 'hide_editor' );

function hide_editor() {

	$post_type="wp_action_form";
	remove_post_type_support( $post_type, 'editor' );
	remove_post_type_support( $post_type, 'author' );

}
//Supression du modificateur de contenu wordpress


//Supression de la metabox Slug
add_action( 'add_meta_boxes', 'my_add_meta_boxes' );

function my_add_meta_boxes() {

    remove_meta_box( 'slugdiv', 'wp_action_form', 'normal' );
}
//Supression de la metabox Slug


//Customisation page de modification
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

//Ajoue des meta values
	add_post_meta( get_the_ID(), 'wpaf_pour', get_option('admin_email'), true );
	add_post_meta( get_the_ID(), 'wpaf_de', "Action Form", true );
	add_post_meta( get_the_ID(), 'wpaf_objet', "Confirmation", true );
	add_post_meta( get_the_ID(), 'wpaf_contenu', "Merci de nous avoir contactés, nous avons bien reçu votre message. Nous vous répondrons sous peu !", true );
	add_post_meta( get_the_ID(), 'wpaf_succes', "Votre message a été envoyé avec succès.", true );
	add_post_meta( get_the_ID(), 'wpaf_erreur', "Une erreur s'est produite. Votre message n'a pas pu être envoyé.", true );
	add_post_meta( get_the_ID(), 'wpaf_contenu_formulaire', "", true );
	add_post_meta( get_the_ID(), 'wpaf_whatsapp_switch', "", true );

//Ajoue des meta values

	$wp_stored_meta = get_post_meta( $post ->ID);
	wp_nonce_field( basename(__FILE__), 'wp_formulaire_nonce');


include 'modal-action-form.php';
		
}


//shortcode générateur de balise - formulaire
function action_form_input_type($atts){

	$atts = shortcode_atts(
		array(
			'type' => 'text',
			'name' => 'default',
			'id' => 'default',
			'placeholder' => null,
			'required' => null,
			'label' => null,
			'class' => null,
			'value'=>null,
		), $atts, 'input' );

	return '<div class="form-floating mb-3 mt-3">
				<label for="'. ( $atts['id']) .'">'.( $atts['label']).'</label>
				<input type="'. ( $atts['type'] ).'" class="form-control '.+( $atts['class']).'" id="'.( $atts['id']).'" name="'. ( $atts['name'] ).'" placeholder="'.( $atts['placeholder']).'" required="'.( $atts['required']).'" value="'.($atts['value']).'"/>
			</div>';
}
add_shortcode('input','action_form_input_type');



//meta values bdd
function wp_meta_save($post_id) {

	$is_autosave = wp_is_post_autosave( $post_id);
	$is_revision = wp_is_post_revision( $post_id);
	$is_valid_nonce = (isset($_POST['wp_formulaire_nonce'])&& wp_verify_nonce($_POST['wp_formulaire_nonce'], basename(__FILE__) ) )? 'true' : 'false';

	if ($is_autosave || $is_revision || !$is_valid_nonce){
		return;
		
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

	if ( isset($_POST['wpaf_contenu_formulaire'])){
		update_post_meta($post_id,'wpaf_contenu_formulaire',sanitize_text_field($_POST['wpaf_contenu_formulaire']) );
	}

	if ( isset($_POST['wpaf_whatsapp_switch'])){
		update_post_meta($post_id,'wpaf_whatsapp_switch', "1" );
	}else{
		update_post_meta($post_id,'wpaf_whatsapp_switch', "0" );
	}
}
add_action('save_post','wp_meta_save');



function wp_add_custom_submenu(){

    add_submenu_page("edit.php?post_type=wp_action_form", "Entrées de Formulaire","Entrées de Formulaire","manage_options","entrées-formulaire","entrees_formulaire");

}

add_action("admin_menu","wp_add_custom_submenu");


function entrees_formulaire(){
						?>
						<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
						<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"></script>
						<div class="container pt-5">
							<h1 class="pb-5">Entrées des Formulaires de Contact</h1>

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
													Titre
												</th>
												<th scope="col">
													Code court
												</th>
												<th scope="col" class="display-sm-none">
													Auteur
												</th>
												<th scope="col">
													Date
												</th>
												<th scope="col">
													Modifier
												</th>
												<th scope="col">
													Supprimer
							     				</th>
											</tr>
										</thead>
										<tbody>
												<?
													//Récupération des données de la la database
													global $wpdb;
													$table="wp39_posts";

													//Affichage des données dans le tableau admin
													$result =$wpdb->get_results("SELECT * FROM `wp39_posts` WHERE `post_type` = 'wp_action_form';");

													foreach ($result as $table) {
												?>
												<script>
													// Supprimer la ligne du tableau
													function delete (){

														<?
														global $wpdb;
														//  $wpdb::delete("DELETE FROM `wp39_posts` WHERE `id` = 'this.$table->ID';");
														?>

													}
												</script>
											<tr>
													<th scope="row">
														<input type="checkbox" id="checkbox" value="">
													</th>
													<td>
														<?echo ($table->ID)?></td>
													</td>
													<td>
														<a class="text-decoration-none" href="<?echo ($table->guid)?>"><?echo ($table->post_title)?>
													</td>
													<td>
														<?echo ($table->post_content)?></td>
													<td class="display-sm-none">
														<?echo (get_the_author_meta( 'display_name' , $table->post_author ))?>
													</td>
													<td>
														<?echo ($table->post_date)?>
													</td>
													<td>
														<a>✏️
													</td>
													<td>
														<span onclick="delete" style="cursor:pointer">❌</span>
													</td>
											</tr>
												<?
													}
												?>

										</body>
									</table>
								</div>
							</div>
						</div>
					<?
				}
