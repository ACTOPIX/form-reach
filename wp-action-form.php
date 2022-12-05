<?php
/**
 * Plugin Name: wp-action-form
 * Description: Formulaire WordPress
 * Version: 1.0
 */

 
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
	add_post_meta( get_the_ID(), 'pour', get_option('admin_email'), true );
	add_post_meta( get_the_ID(), 'de', "Action Form", true );
	add_post_meta( get_the_ID(), 'objet', "Confirmation", true );
	add_post_meta( get_the_ID(), 'contenu', "Merci de nous avoir contactés, nous avons bien reçu votre message. Nous vous répondrons sous peu !", true );
	add_post_meta( get_the_ID(), 'succes', "Votre message a été envoyé avec succès.", true );
	add_post_meta( get_the_ID(), 'erreur', "Une erreur s'est produite. Votre message n'a pas pu être envoyé.", true );
	add_post_meta( get_the_ID(), 'button_text', "Texte", true );
	add_post_meta( get_the_ID(), 'button_e-mail', "E-mail", true );
	add_post_meta( get_the_ID(), 'button_tel', "Tél", true );
	add_post_meta( get_the_ID(), 'button_menu_deroulant', "Menu déroulant", true );
	add_post_meta( get_the_ID(), 'button_cases_a_cocher', "Cases à cocher", true );
	add_post_meta( get_the_ID(), 'button_boutons_radio', "Boutons radio", true );
	add_post_meta( get_the_ID(), 'button_zone_de_text', "Zone de text", true );
	add_post_meta( get_the_ID(), 'button_date', "Date", true );
	add_post_meta( get_the_ID(), 'button_fichier', "Fichier", true );
	add_post_meta( get_the_ID(), 'button_confirmation', "Confirmation", true );
	add_post_meta( get_the_ID(), 'button_envoyer', "Envoyer", true );
	add_post_meta( get_the_ID(), 'contenu_formulaire', "", true );
//Ajoue des meta values

	$wp_stored_meta = get_post_meta( $post ->ID);
	wp_nonce_field( basename(__FILE__), 'wp_formulaire_nonce');

?>
   <!doctype html>
<html lang="en">
<head>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"></script>
</head>
<body>
 



<div id="tabs">

<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#formulaire" type="button" role="tab" aria-controls="home" aria-selected="true">formulaire</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#email" type="button" role="tab" aria-controls="profile" aria-selected="false">email</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#message" type="button" role="tab" aria-controls="contact" aria-selected="false">message</button>
  </li>
</ul>

<div class="tab-content" id="myTabContent">

  <div id="formulaire" class="tab-pane fade show active" role="tabpanel">

  	<button type="button" name="button_text" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modalTexte"> Texte </button>

  		<div class="modal fade" id="modalTexte" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Générateur de balise de formulaire : Texte</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="table-responsive">
							<table class="table table-borderless">
								<tbody>
									<tr>
										<th class="text-end"scope="row">Type : </th>
										<td>
											<fieldset>
											<legend class="screen-reader-text">Type de champ</legend>
											<label><input type="checkbox" name="required"> Champ obligatoire</label>
											</fieldset>
										</td>
									</tr>

									<tr>
										<th class="text-end" scope="row"><label for="generator-text-name">Nom :</label></th>
										<td ><input type="text" name="name" class="tg-name oneline" id="generator-text-name"></td>
									</tr>

									<tr>
										<th class="text-end" scope="row"><label for="generator-text-values">Valeur :</label></th>
										<td><input type="text" name="values" class="oneline" id="generator-text-values"></td>
									</tr>

									<tr>
										<td></td>
										<td class="pt-n3"><input type="checkbox" name="placeholder" class="option"> Utilisez ce texte comme texte indicatif du champ.</td>
									</tr>

									<tr>
										<th class="text-end" scope="row"><label for="generator-text-id">ID :</label></th>
										<td><input type="text" name="id" class="idvalue oneline option" id="generator-text-id"></td>
									</tr>

									<tr>
										<th class="text-end" scope="row"><label for="generator-text-class">Class :</label></th>
										<td><input type="text" name="class" class="classvalue oneline option" id="generator-text-class"></td>
									</tr>

								</tbody>
							</table>
						</div>
					</div>

					<div class="modal-footer position-relative">
						<div class="position-absolute start-0 ms-3">
							<input type="text" name="text" readonly="readonly" style="width:275px">
						</div>
						<div>
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
							<button type="button" class="btn btn-primary">Appliquer</button>
						</div>
					</div>
				</div>
			</div>
		</div>

	<button type="button" name="button_e-mail" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modalEmail"> E-mail </button>

  		<div class="modal fade" id="modalEmail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Générateur de balise de formulaire : Texte</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="table-responsive">
							<table class="table table-borderless">
								<tbody>
									<tr>
										<th class="text-end"scope="row">Type : </th>
										<td>
											<fieldset>
											<legend class="screen-reader-text">Type de champ</legend>
											<label><input type="checkbox" name="required"> Champ obligatoire</label>
											</fieldset>
										</td>
									</tr>

									<tr>
										<th class="text-end" scope="row"><label for="generator-text-name">Nom :</label></th>
										<td ><input type="text" name="name" class="tg-name oneline" id="generator-text-name"></td>
									</tr>

									<tr>
										<th class="text-end" scope="row"><label for="generator-text-values">Valeur :</label></th>
										<td><input type="text" name="values" class="oneline" id="generator-text-values"></td>
									</tr>

									<tr>
										<td></td>
										<td class="pt-n3"><input type="checkbox" name="placeholder" class="option"> Utilisez ce texte comme texte indicatif du champ.</td>
									</tr>

									<tr>
										<th class="text-end" scope="row"><label for="generator-text-id">ID :</label></th>
										<td><input type="text" name="id" class="idvalue oneline option" id="generator-text-id"></td>
									</tr>

									<tr>
										<th class="text-end" scope="row"><label for="generator-text-class">Class :</label></th>
										<td><input type="text" name="class" class="classvalue oneline option" id="generator-text-class"></td>
									</tr>

								</tbody>
							</table>
						</div>
					</div>

					<div class="modal-footer position-relative">
						<div class="position-absolute start-0 ms-3">
							<input type="text" name="text" readonly="readonly" style="width:275px">
						</div>
						<div>
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
							<button type="button" class="btn btn-primary">Appliquer</button>
						</div>
					</div>
				</div>
			</div>
		</div>

	<button type="button" name="button_tel" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modalTel"> Tel </button>

  		<div class="modal fade" id="modalTel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Générateur de balise de formulaire : Texte</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="table-responsive">
							<table class="table table-borderless">
								<tbody>
									<tr>
										<th class="text-end"scope="row">Type : </th>
										<td>
											<fieldset>
											<legend class="screen-reader-text">Type de champ</legend>
											<label><input type="checkbox" name="required"> Champ obligatoire</label>
											</fieldset>
										</td>
									</tr>

									<tr>
										<th class="text-end" scope="row"><label for="generator-text-name">Nom :</label></th>
										<td ><input type="text" name="name" class="tg-name oneline" id="generator-text-name"></td>
									</tr>

									<tr>
										<th class="text-end" scope="row"><label for="generator-text-values">Valeur :</label></th>
										<td><input type="text" name="values" class="oneline" id="generator-text-values"></td>
									</tr>

									<tr>
										<td></td>
										<td class="pt-n3"><input type="checkbox" name="placeholder" class="option"> Utilisez ce texte comme texte indicatif du champ.</td>
									</tr>

									<tr>
										<th class="text-end" scope="row"><label for="generator-text-id">ID :</label></th>
										<td><input type="text" name="id" class="idvalue oneline option" id="generator-text-id"></td>
									</tr>

									<tr>
										<th class="text-end" scope="row"><label for="generator-text-class">Class :</label></th>
										<td><input type="text" name="class" class="classvalue oneline option" id="generator-text-class"></td>
									</tr>

								</tbody>
							</table>
						</div>
					</div>

					<div class="modal-footer position-relative">
						<div class="position-absolute start-0 ms-3">
							<input type="text" name="text" readonly="readonly" style="width:275px">
						</div>
						<div>
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
							<button type="button" class="btn btn-primary">Appliquer</button>
						</div>
					</div>
				</div>
			</div>
		</div>

	<button type="button" name="button_menu_deroulant" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modalMenu"> Menu Déroulant </button>

  		<div class="modal fade" id="modalMenu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Générateur de balise de formulaire : Texte</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="table-responsive">
							<table class="table table-borderless">
								<tbody>
									<tr>
										<th class="text-end"scope="row">Type : </th>
										<td>
											<fieldset>
											<legend class="screen-reader-text">Type de champ</legend>
											<label><input type="checkbox" name="required"> Champ obligatoire</label>
											</fieldset>
										</td>
									</tr>

									<tr>
										<th class="text-end" scope="row"><label for="generator-text-name">Nom :</label></th>
										<td ><input type="text" name="name" class="tg-name oneline" id="generator-text-name"></td>
									</tr>

									<tr>
										<th class="text-end" scope="row"><label for="generator-text-values">Valeur :</label></th>
										<td><input type="text" name="values" class="oneline" id="generator-text-values"></td>
									</tr>

									<tr>
										<td></td>
										<td class="pt-n3"><input type="checkbox" name="placeholder" class="option"> Utilisez ce texte comme texte indicatif du champ.</td>
									</tr>

									<tr>
										<th class="text-end" scope="row"><label for="generator-text-id">ID :</label></th>
										<td><input type="text" name="id" class="idvalue oneline option" id="generator-text-id"></td>
									</tr>

									<tr>
										<th class="text-end" scope="row"><label for="generator-text-class">Class :</label></th>
										<td><input type="text" name="class" class="classvalue oneline option" id="generator-text-class"></td>
									</tr>

								</tbody>
							</table>
						</div>
					</div>

					<div class="modal-footer position-relative">
						<div class="position-absolute start-0 ms-3">
							<input type="text" name="text" readonly="readonly" style="width:275px">
						</div>
						<div>
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
							<button type="button" class="btn btn-primary">Appliquer</button>
						</div>
					</div>
				</div>
			</div>
		</div>

	<button type="button" name="button_cases_a_cocher"class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modalCase"> Case à cocher </button>

  		<div class="modal fade" id="modalCase" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Générateur de balise de formulaire : Texte</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="table-responsive">
							<table class="table table-borderless">
								<tbody>
									<tr>
										<th class="text-end"scope="row">Type : </th>
										<td>
											<fieldset>
											<legend class="screen-reader-text">Type de champ</legend>
											<label><input type="checkbox" name="required"> Champ obligatoire</label>
											</fieldset>
										</td>
									</tr>

									<tr>
										<th class="text-end" scope="row"><label for="generator-text-name">Nom :</label></th>
										<td ><input type="text" name="name" class="tg-name oneline" id="generator-text-name"></td>
									</tr>

									<tr>
										<th class="text-end" scope="row"><label for="generator-text-values">Valeur :</label></th>
										<td><input type="text" name="values" class="oneline" id="generator-text-values"></td>
									</tr>

									<tr>
										<td></td>
										<td class="pt-n3"><input type="checkbox" name="placeholder" class="option"> Utilisez ce texte comme texte indicatif du champ.</td>
									</tr>

									<tr>
										<th class="text-end" scope="row"><label for="generator-text-id">ID :</label></th>
										<td><input type="text" name="id" class="idvalue oneline option" id="generator-text-id"></td>
									</tr>

									<tr>
										<th class="text-end" scope="row"><label for="generator-text-class">Class :</label></th>
										<td><input type="text" name="class" class="classvalue oneline option" id="generator-text-class"></td>
									</tr>

								</tbody>
							</table>
						</div>
					</div>

					<div class="modal-footer position-relative">
						<div class="position-absolute start-0 ms-3">
							<input type="text" name="text" readonly="readonly" style="width:275px">
						</div>
						<div>
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
							<button type="button" class="btn btn-primary">Appliquer</button>
						</div>
					</div>
				</div>
			</div>
		</div>

	<button type="button" name="button_boutons_radio" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modalRadio"> Bouton Radio </button>

  		<div class="modal fade" id="modalRadio" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Générateur de balise de formulaire : Texte</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="table-responsive">
							<table class="table table-borderless">
								<tbody>
									<tr>
										<th class="text-end"scope="row">Type : </th>
										<td>
											<fieldset>
											<legend class="screen-reader-text">Type de champ</legend>
											<label><input type="checkbox" name="required"> Champ obligatoire</label>
											</fieldset>
										</td>
									</tr>

									<tr>
										<th class="text-end" scope="row"><label for="generator-text-name">Nom :</label></th>
										<td ><input type="text" name="name" class="tg-name oneline" id="generator-text-name"></td>
									</tr>

									<tr>
										<th class="text-end" scope="row"><label for="generator-text-values">Valeur :</label></th>
										<td><input type="text" name="values" class="oneline" id="generator-text-values"></td>
									</tr>

									<tr>
										<td></td>
										<td class="pt-n3"><input type="checkbox" name="placeholder" class="option"> Utilisez ce texte comme texte indicatif du champ.</td>
									</tr>

									<tr>
										<th class="text-end" scope="row"><label for="generator-text-id">ID :</label></th>
										<td><input type="text" name="id" class="idvalue oneline option" id="generator-text-id"></td>
									</tr>

									<tr>
										<th class="text-end" scope="row"><label for="generator-text-class">Class :</label></th>
										<td><input type="text" name="class" class="classvalue oneline option" id="generator-text-class"></td>
									</tr>

								</tbody>
							</table>
						</div>
					</div>

					<div class="modal-footer position-relative">
						<div class="position-absolute start-0 ms-3">
							<input type="text" name="text" readonly="readonly" style="width:275px">
						</div>
						<div>
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
							<button type="button" class="btn btn-primary">Appliquer</button>
						</div>
					</div>
				</div>
			</div>
		</div>

	<button type="button" name="button_zone_de_text" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modalZone"> Zone de texte </button>

  		<div class="modal fade" id="modalZone" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Générateur de balise de formulaire : Texte</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="table-responsive">
							<table class="table table-borderless">
								<tbody>
									<tr>
										<th class="text-end"scope="row">Type : </th>
										<td>
											<fieldset>
											<legend class="screen-reader-text">Type de champ</legend>
											<label><input type="checkbox" name="required"> Champ obligatoire</label>
											</fieldset>
										</td>
									</tr>

									<tr>
										<th class="text-end" scope="row"><label for="generator-text-name">Nom :</label></th>
										<td ><input type="text" name="name" class="tg-name oneline" id="generator-text-name"></td>
									</tr>

									<tr>
										<th class="text-end" scope="row"><label for="generator-text-values">Valeur :</label></th>
										<td><input type="text" name="values" class="oneline" id="generator-text-values"></td>
									</tr>

									<tr>
										<td></td>
										<td class="pt-n3"><input type="checkbox" name="placeholder" class="option"> Utilisez ce texte comme texte indicatif du champ.</td>
									</tr>

									<tr>
										<th class="text-end" scope="row"><label for="generator-text-id">ID :</label></th>
										<td><input type="text" name="id" class="idvalue oneline option" id="generator-text-id"></td>
									</tr>

									<tr>
										<th class="text-end" scope="row"><label for="generator-text-class">Class :</label></th>
										<td><input type="text" name="class" class="classvalue oneline option" id="generator-text-class"></td>
									</tr>

								</tbody>
							</table>
						</div>
					</div>

					<div class="modal-footer position-relative">
						<div class="position-absolute start-0 ms-3">
							<input type="text" name="text" readonly="readonly" style="width:275px">
						</div>
						<div>
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
							<button type="button" class="btn btn-primary">Appliquer</button>
						</div>
					</div>
				</div>
			</div>
		</div>

	<button type="button" name="button_date" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modalDate"> Date </button>

  		<div class="modal fade" id="modalDate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Générateur de balise de formulaire : Texte</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="table-responsive">
							<table class="table table-borderless">
								<tbody>
									<tr>
										<th class="text-end"scope="row">Type : </th>
										<td>
											<fieldset>
											<legend class="screen-reader-text">Type de champ</legend>
											<label><input type="checkbox" name="required"> Champ obligatoire</label>
											</fieldset>
										</td>
									</tr>

									<tr>
										<th class="text-end" scope="row"><label for="generator-text-name">Nom :</label></th>
										<td ><input type="text" name="name" class="tg-name oneline" id="generator-text-name"></td>
									</tr>

									<tr>
										<th class="text-end" scope="row"><label for="generator-text-values">Valeur :</label></th>
										<td><input type="text" name="values" class="oneline" id="generator-text-values"></td>
									</tr>

									<tr>
										<td></td>
										<td class="pt-n3"><input type="checkbox" name="placeholder" class="option"> Utilisez ce texte comme texte indicatif du champ.</td>
									</tr>

									<tr>
										<th class="text-end" scope="row"><label for="generator-text-id">ID :</label></th>
										<td><input type="text" name="id" class="idvalue oneline option" id="generator-text-id"></td>
									</tr>

									<tr>
										<th class="text-end" scope="row"><label for="generator-text-class">Class :</label></th>
										<td><input type="text" name="class" class="classvalue oneline option" id="generator-text-class"></td>
									</tr>

								</tbody>
							</table>
						</div>
					</div>

					<div class="modal-footer position-relative">
						<div class="position-absolute start-0 ms-3">
							<input type="text" name="text" readonly="readonly" style="width:275px">
						</div>
						<div>
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
							<button type="button" class="btn btn-primary">Appliquer</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	<button type="button" name="button_fichier" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modalFichier"> Fichier </button>

  		<div class="modal fade" id="modalFichier" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Générateur de balise de formulaire : Texte</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="table-responsive">
							<table class="table table-borderless">
								<tbody>
									<tr>
										<th class="text-end"scope="row">Type : </th>
										<td>
											<fieldset>
											<legend class="screen-reader-text">Type de champ</legend>
											<label><input type="checkbox" name="required"> Champ obligatoire</label>
											</fieldset>
										</td>
									</tr>

									<tr>
										<th class="text-end" scope="row"><label for="generator-text-name">Nom :</label></th>
										<td ><input type="text" name="name" class="tg-name oneline" id="generator-text-name"></td>
									</tr>

									<tr>
										<th class="text-end" scope="row"><label for="generator-text-values">Valeur :</label></th>
										<td><input type="text" name="values" class="oneline" id="generator-text-values"></td>
									</tr>

									<tr>
										<td></td>
										<td class="pt-n3"><input type="checkbox" name="placeholder" class="option"> Utilisez ce texte comme texte indicatif du champ.</td>
									</tr>

									<tr>
										<th class="text-end" scope="row"><label for="generator-text-id">ID :</label></th>
										<td><input type="text" name="id" class="idvalue oneline option" id="generator-text-id"></td>
									</tr>

									<tr>
										<th class="text-end" scope="row"><label for="generator-text-class">Class :</label></th>
										<td><input type="text" name="class" class="classvalue oneline option" id="generator-text-class"></td>
									</tr>

								</tbody>
							</table>
						</div>
					</div>

					<div class="modal-footer position-relative">
						<div class="position-absolute start-0 ms-3">
							<input type="text" name="text" readonly="readonly" style="width:275px">
						</div>
						<div>
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
							<button type="button" class="btn btn-primary">Appliquer</button>
						</div>
					</div>
				</div>
			</div>
		</div>

		<br>
		<br>
		<textarea style="width:100%" name="contenu_formulaire" rows="24" class="large-tet code"> <?php if (! empty ($wp_stored_meta['contenu_formulaire'])) echo esc_attr ( $wp_stored_meta['contenu_formulaire'][0] ); ?> </textarea>
  </div>
</div>

  <div id="email" class="tab-pane fade" role="tabpanel">
	<form> 
		<table>
			<tbody>
				<tr>
					<th scope="row" style="text-align:right;">
						<label for="pour">Pour :</label>
					</th>
					<td>
						<input type="text" name="pour" id="pour" class="large-text code" size"70" value="<?php if (! empty ($wp_stored_meta['pour'])) echo esc_attr ( $wp_stored_meta['pour'][0] ); ?> "/>
					</td>
				</tr>
				<tr>
					<th scope="row" style="text-align:right;">
						<label for="de">De :</label>
					</th>
					<td>
						<input type="text" name="de" id="de" class="large-text code" size"70" value="<?php if (! empty ($wp_stored_meta['de'])) echo esc_attr ( $wp_stored_meta['de'][0] ); ?> "/>
					</td>
				</tr>
				<tr>
					<th scope="row" style="text-align:right;">
						<label for="objet" >Objet :</label>
					</th>
					<td>
						<input type="text" name="objet" id="objet" class="large-text code" size"70" value="<?php if (! empty ($wp_stored_meta['objet'])) echo esc_attr ( $wp_stored_meta['objet'][0] ); ?> "/>
					</td>
				</tr>
				<tr>
					<th scope="row" style="text-align:right;">
						<label for="contenu">Contenu du message :</label>
					</th>
					<td>
						<textarea cols="100" rows="18" name="contenu" id="contenu" class="large-text code" size"70"> <?php if (! empty ($wp_stored_meta['contenu'])) echo esc_attr ( $wp_stored_meta['contenu'][0] ); ?></textarea>
					</td>
				</tr>
		</tbody>
		</table>
	</form> 
	</div>
	
  <div id="message" class="tab-pane fade" role="tabpanel">
	<label for="succes">
	"Le message de l'expéditeur a été envoyé."
	<input type="text" name="succes" id="succes" class="large-text" size="70" value="<?php if (! empty ($wp_stored_meta['succes'])) echo esc_attr ( $wp_stored_meta['succes'][0] ); ?> "/>   
	</label>
	<label for="erreur">
	"Le message de l'expéditeur n'a pas pu être envoyé."
	<input type="text" name="erreur" id="erreur" class="large-text" size="70" value="<?php if (! empty ($wp_stored_meta['erreur'])) echo esc_attr ( $wp_stored_meta['erreur'][0] ); ?> "/> 
	</label>

  </div>
</div>
 

</body>
</html>
		
		<?php
	}

function wp_meta_save($post_id){

	$is_autosave = wp_is_post_autosave( $post_id);
	$is_revision = wp_is_post_revision( $post_id);
	$is_valid_nonce = (isset($_POST['wp_formulaire_nonce'])&& wp_verify_nonce($_POST['wp_formulaire_nonce'], basename(__FILE__) ) )? 'true' : 'false';

	if ($is_autosave || $is_revision || !$is_valid_nonce){
		return;
		
	}

	if ( isset($_POST['pour'])){
	update_post_meta($post_id,'pour',sanitize_text_field($_POST['pour']) );
	}

	if ( isset($_POST['de'])){
	update_post_meta($post_id,'de',sanitize_text_field($_POST['de']) );
	}

	if ( isset($_POST['objet'])){
	update_post_meta($post_id,'objet',sanitize_text_field($_POST['objet']) );
	}

	if ( isset($_POST['contenu'])){
	update_post_meta($post_id,'contenu',sanitize_text_field($_POST['contenu']) );
	}

	if ( isset($_POST['succes'])){
		update_post_meta($post_id,'succes',sanitize_text_field($_POST['succes']) );
	}

	if ( isset($_POST['erreur'])){
		update_post_meta($post_id,'erreur',sanitize_text_field($_POST['erreur']) );
	}

	if ( isset($_POST['button_text'])){
		update_post_meta($post_id,'button_text',sanitize_text_field($_POST['button_text']) );
	}

	if ( isset($_POST['button_e-mail'])){
		update_post_meta($post_id,'button_e-mail',sanitize_text_field($_POST['button_e-mail']) );
	}

	if ( isset($_POST['button_tel'])){
		update_post_meta($post_id,'button_tel',sanitize_text_field($_POST['button_tel']) );
	}

	if ( isset($_POST['button_menu_deroulant'])){
		update_post_meta($post_id,'button_menu_deroulant',sanitize_text_field($_POST['button_menu_deroulant']) );
	}

	if ( isset($_POST['button_cases_a_cocher'])){
		update_post_meta($post_id,'button_cases_a_cocher',sanitize_text_field($_POST['button_cases_a_cocher']) );
	}

	if ( isset($_POST['button_boutons_radio'])){
		update_post_meta($post_id,'button_boutons_radio',sanitize_text_field($_POST['button_boutons_radio']) );
	}

	if ( isset($_POST['button_zone_de_text'])){
		update_post_meta($post_id,'button_zone_de_text',sanitize_text_field($_POST['button_zone_de_text']) );
	}

	if ( isset($_POST['button_date'])){
		update_post_meta($post_id,'button_date',sanitize_text_field($_POST['button_date']) );
	}

	if ( isset($_POST['button_fichier'])){
		update_post_meta($post_id,'button_fichier',sanitize_text_field($_POST['button_fichier']) );
	}

	if ( isset($_POST['button_confirmation'])){
		update_post_meta($post_id,'button_confirmation',sanitize_text_field($_POST['button_confirmation']) );
	}

	if ( isset($_POST['button_envoyer'])){
		update_post_meta($post_id,'button_envoyer',sanitize_text_field($_POST['button_envoyer']) );
	}

	if ( isset($_POST['contenu_formulaire'])){
		update_post_meta($post_id,'contenu_formulaire',sanitize_text_field($_POST['contenu_formulaire']) );
	}
}
add_action('save_post','wp_meta_save');



function admin (){
	
	add_menu_page( 'WP Action Form - Admin', 'WP Admin', 'manage_options', 'wp-admin', 'admin_page' );
}

add_action( "admin_menu", "admin" );

function admin_page(){
						?>
						<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
						<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"></script>
						<div class="container pt-5">
							<h1 class="pb-5">Formulaire de contact</h1>

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

function wp_action_form_include() {


	//Déclaration de la variable en 'string' pour contenir l'HTML
	$content = '';
	
	$content .= '
						<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
						<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"></script>
						<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
                        <script src="'.plugin_dir_url(__FILE__).'js/wp-action-form.js"></script>
						<script src="https://www.google.com/recaptcha/api.js?render=6LcYu_gaAAAAANJVIQPE35j97DxUCXXozlLiXhpK"></script>

						<form id="action_form" accept-charset="UTF-8" name="action_form" method="post" action="javascript:void(0)">
						
							<div class="form-floating mb-3 mt-3">
							'.wp_nonce_field('nonce_verification').'
								<input type="text" class="form-control" id="name" name="name" placeholder="Prénom" required/>
								<label for="name">Prénom</label>
							</div>
								
							<div class="form-floating mb-3 mt-3">
								<input type="email" class="form-control" id="email" name="email" placeholder="Adresse mail" required/>
								<label for="email">Adresse mail</label>
							</div>
								
							<div class="form-floating mb-3 mt-3">
								<textarea class="form-control" style="height: 100px" id="objectif" name="objectif" placeholder="Quel est votre objectif ?" required></textarea>
								<label for="floatingTextarea2">Quel est votre objectif ?</label>
							</div>

        					<input type="hidden" name="g-recaptcha-response" value="" id="g-recaptcha-response">

							<button type="submit" id="submit" name="wp_action_form_submit" class="btn btn-primary mb-3 mt-3 g-recaptcha">
								<div id="submitContent">
									<svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
										<path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/>
									</svg> Envoyer
								</div>
								<div id="spinner" class="spinner-border spinner-border-sm" style="display:none"></div>
							</button>
							
							</form>
							
							<div id="success_message" class="alert alert-success position-absolute start-50 translate-middle" style="display:none">
								<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
									<path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
								</svg>
								Le formulaire a été envoyé avec succès.
							</div>

							<div id="error_message" class="alert alert-danger position-absolute start-50 translate-middle" style="display:none">
								<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
									<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
								</svg>
								Le formulaire n\'a pas pu être envoyé suite à une erreur. Veuillez réessayer.
							</div>';
								
	return $content;
						

	//Pour ajouter un input file, rajouter ces lignes dans le content
			// 	<div class="mb-3">
			// 	<label for="formFileMultiple" class="form-label"></label>
			// 	<input class="form-control" type="file" name="file" accept=".jpg, .jpeg, .png" multiple>
			// </div>
}

add_shortcode( 'wp-action-form', 'wp_action_form_include' );
							
function wp_action_form_whatsapp_include() {
	
	//Déclaration de la variable en 'string' pour contenir l'HTML
	$content = '';
	
	$content .= '
						<meta charset="UTF-8">
						<meta http-equiv="X-UA-Compatible" content="IE=edge">
						<meta name="viewport" content="width=device-width, initial-scale=1.0">
						<title>Document</title>
						<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
						<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"></script>
						<script src="https://www.google.com/recaptcha/api.js"></script>
					
						<form id="2" accept-charset="UTF-8" name="contact_form" method="post" action="'.plugin_dir_url(__FILE__).'process/validation.php">
							<div class="form-floating mb-3 mt-3">
								<input type="text" class="form-control" id="prenom" name="name" placeholder="Prénom" required/>
								<label for="name">Prénom</label>
							</div>
								
							<div class="form-floating mb-3 mt-3">
								<input type="email" class="form-control" id="mail" name="email" placeholder="Adresse mail" required/>
								<label for="email">Adresse mail</label>
							</div>
								
							<div class="form-floating mb-3 mt-3">
								<textarea class="form-control" style="height: 100px" name="objectif" placeholder="Quel est votre objectif ?" required></textarea>
								<label for="floatingTextarea2">Quel est votre objectif ?</label>
							</div>

							<button type="submit" id ="whatsapp" name="whatsapp" class="btn btn-success">
								<svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
									<path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
								</svg> WhatsApp
							</button>
						</form>';
				
	return $content;
    
	//Pour ajouter un input file, rajouter ces lignes dans le content
		// 	<div class="mb-3">
		// 	<label for="formFileMultiple" class="form-label"></label>
		// 	<input class="form-control" type="file" name="file" accept=".jpg, .jpeg, .png" multiple>
		// </div>
}
add_shortcode( 'wp-action-form-whatsapp', 'wp_action_form_whatsapp_include' );