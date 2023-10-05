<?
//Custom Post type
function cw_post_type_news() {
	
	$labels = array(
	'name' => _x( 'Form Reach', 'plural'),
	'singular_name' => _x( 'singular_name', 'singular'),
	'menu_name' => _x( 'Form Reach', 'admin menu'),
	'name_admin_bar' => _x( 'Form Reach', 'admin bar'),
	'add_new' => _x('Create New', 'add new'),
	'add_new_item' => __('New Form'),
	'new_item' => __('new_item'),
	'edit_item' => ('Form Edition'),
	'view_item' => __('view_item'),
	'search_items' => __('Search'),
	'not_found' => __('The form you are looking for does not exist'),
	
	);
	$args = array(
	'labels' => $labels,
	'public' => false,
	'publicly_queryable' => true,
	'show_ui' => true,
	'exclude_from_search' => false,
	'show_in_nav_menus' => true,
	'has_archive' => false,
	'query_var' => true,
	'rewrite' => false,
	'has_archive' => true,
	'hierarchical' => false,
	'menu_icon' => 'dashicons-buddicons-pm',
	);

register_post_type('form_reach', $args);

}
add_action('init', 'cw_post_type_news');

// Customization of the admin table
function smashing_form_reach_columns( $columns ) {
	$columns = array(
		'cb' => $columns['cb'],
		'type' => __('Type'),
		'title' => __( 'Title' ),
		'shortcode' => __( 'Shortcode' ),
		'author' => __( 'Author'),
		'date' => __( 'Date' ),
    );
	return $columns;
}
add_filter( 'manage_form_reach_posts_columns', 'smashing_form_reach_columns' );

add_action( 'manage_form_reach_posts_custom_column', 'fr_shortcode_column', 10, 2);

add_action( 'manage_form_reach_posts_custom_column', 'fr_type_column', 10, 2);


// Adding the form type to the Administrator custom table
function fr_type_column( $column, $post_id ) {
  	if ( 'type' === $column ) {

	switch (get_post_meta($post_id)['fr_whatsapp_switch'][0]) {
		case "0":
			echo '<svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="currentColor" class="bi bi-envelope text-primary" viewBox="0 0 16 16"><path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/></svg>';
			break;
		case "1":
			echo '<svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="#25D366" class="bi bi-whatsapp" viewBox="0 0 16 16"><path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/></svg>';
			break;
		case "Telegram":
			echo '<svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="#0088cc" class="bi bi-telegram" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.287 5.906c-.778.324-2.334.994-4.666 2.01-.378.15-.577.298-.595.442-.03.243.275.339.69.47l.175.055c.408.133.958.288 1.243.294.26.006.549-.1.868-.32 2.179-1.471 3.304-2.214 3.374-2.23.05-.012.12-.026.166.016.047.041.042.12.037.141-.03.129-1.227 1.241-1.846 1.817-.193.18-.33.307-.358.336a8.154 8.154 0 0 1-.188.186c-.38.366-.664.64.015 1.088.327.216.589.393.85.571.284.194.568.387.936.629.093.06.183.125.27.187.331.236.63.448.997.414.214-.02.435-.22.547-.82.265-1.417.786-4.486.906-5.751a1.426 1.426 0 0 0-.013-.315.337.337 0 0 0-.114-.217.526.526 0 0 0-.31-.093c-.3.005-.763.166-2.984 1.09z"/></svg>';
			break;
		case "Signal":
			echo '<svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="#3A76F0" class="bi bi-signal" viewBox="0 0 16 16"><path d="m6.08.234.179.727a7.264 7.264 0 0 0-2.01.832l-.383-.643A7.9 7.9 0 0 1 6.079.234zm3.84 0L9.742.96a7.265 7.265 0 0 1 2.01.832l.388-.643A7.957 7.957 0 0 0 9.92.234zm-8.77 3.63a7.944 7.944 0 0 0-.916 2.215l.727.18a7.264 7.264 0 0 1 .832-2.01l-.643-.386zM.75 8a7.3 7.3 0 0 1 .081-1.086L.091 6.8a8 8 0 0 0 0 2.398l.74-.112A7.262 7.262 0 0 1 .75 8zm11.384 6.848-.384-.64a7.23 7.23 0 0 1-2.007.831l.18.728a7.965 7.965 0 0 0 2.211-.919zM15.251 8c0 .364-.028.727-.082 1.086l.74.112a7.966 7.966 0 0 0 0-2.398l-.74.114c.054.36.082.722.082 1.086zm.516 1.918-.728-.18a7.252 7.252 0 0 1-.832 2.012l.643.387a7.933 7.933 0 0 0 .917-2.219zm-6.68 5.25c-.72.11-1.453.11-2.173 0l-.112.742a7.99 7.99 0 0 0 2.396 0l-.112-.741zm4.75-2.868a7.229 7.229 0 0 1-1.537 1.534l.446.605a8.07 8.07 0 0 0 1.695-1.689l-.604-.45zM12.3 2.163c.587.432 1.105.95 1.537 1.537l.604-.45a8.06 8.06 0 0 0-1.69-1.691l-.45.604zM2.163 3.7A7.242 7.242 0 0 1 3.7 2.163l-.45-.604a8.06 8.06 0 0 0-1.691 1.69l.604.45zm12.688.163-.644.387c.377.623.658 1.3.832 2.007l.728-.18a7.931 7.931 0 0 0-.916-2.214zM6.913.831a7.254 7.254 0 0 1 2.172 0l.112-.74a7.985 7.985 0 0 0-2.396 0l.112.74zM2.547 14.64 1 15l.36-1.549-.729-.17-.361 1.548a.75.75 0 0 0 .9.902l1.548-.357-.17-.734zM.786 12.612l.732.168.25-1.073A7.187 7.187 0 0 1 .96 9.74l-.727.18a8 8 0 0 0 .736 1.902l-.184.79zm3.5 1.623-1.073.25.17.731.79-.184c.6.327 1.239.574 1.902.737l.18-.728a7.197 7.197 0 0 1-1.962-.811l-.007.005zM8 1.5a6.502 6.502 0 0 0-6.498 6.502 6.516 6.516 0 0 0 .998 3.455l-.625 2.668L4.54 13.5a6.502 6.502 0 0 0 6.93-11A6.516 6.516 0 0 0 8 1.5"/></svg>';
			break;
		case "Messenger":
			echo '<svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="#006AFF" class="bi bi-messenger" viewBox="0 0 16 16"><path d="M0 7.76C0 3.301 3.493 0 8 0s8 3.301 8 7.76-3.493 7.76-8 7.76c-.81 0-1.586-.107-2.316-.307a.639.639 0 0 0-.427.03l-1.588.702a.64.64 0 0 1-.898-.566l-.044-1.423a.639.639 0 0 0-.215-.456C.956 12.108 0 10.092 0 7.76zm5.546-1.459-2.35 3.728c-.225.358.214.761.551.506l2.525-1.916a.48.48 0 0 1 .578-.002l1.869 1.402a1.2 1.2 0 0 0 1.735-.32l2.35-3.728c.226-.358-.214-.761-.551-.506L9.728 7.381a.48.48 0 0 1-.578.002L7.281 5.98a1.2 1.2 0 0 0-1.735.32z"/></svg>';
			break;
		default:
			echo 'Type undefined';
			break;
	}
  }
}

add_action('admin_notices', 'fr_missing_email');

function move_plugin_to_top() {
    $plugins = get_plugins();

    if (isset($plugins['form-reach/form-reach.php'])) {
        $plugin = $plugins['form-reach/form-reach.php'];
        unset($plugins['form-reach/form-reach.php']);
        array_unshift($plugins, $plugin);
    }

    return $plugins;
}
add_filter('all_plugins', 'move_plugin_to_top');

function add_custom_menu_style() {
    ?>
    <style>
		#adminmenu #menu-posts-form_reach {
			background-color: #1D1D1D;
			margin-top: 0.3em;
			margin-bottom: 0.3em;
        }

        #adminmenu #menu-posts-form_reach .wp-menu-image:before {
            content: '';
			width: 20px;
    		height: 7px;
			display: inline-block;
            margin-top: 10%;
            background-image: url(<?php echo plugin_dir_url(__FILE__) . 'image/form-reach-logo.png'; ?>);
			border-radius: 50%;
			background-size: cover;
			background-position: center;
			background-size: 85%;
			border: 3px solid #c5b863;
        }

		.wp-has-submenu ::before {
			box-sizing: unset;
		}
    </style>
	<script>
		document.addEventListener('DOMContentLoaded', function() {
            var menuItems = document.querySelectorAll('.wp-menu-name');

            for (var i = 0; i < menuItems.length; i++) {
                if (menuItems[i].textContent === 'Form Reach') {
                    menuItems[i].style.fontWeight = '600';
                    break;
                }
            }
        });
	</script>
    <?php
}
add_action('admin_head', 'add_custom_menu_style');

function fr_missing_email() {
?>
	<script>

		function validateEmails(emails) {
			var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
			var emailList = emails.split(",");
			for (var i = 0; i < emailList.length; i++) {
			var email = emailList[i].trim();
			if (!emailPattern.test(email)) {
				return false;
			}
			}
			return true;
		};

		document.addEventListener("DOMContentLoaded", function() {
			var input = document.getElementById('fr_email_admin_to');
			var notice = document.getElementById('notification');
			if (input){
				var isValidEmails = validateEmails(input.value);

				if (input.value === "" || !isValidEmails) {
					if (!notice) {
						notice = document.createElement('div');
						notice.id = 'notification';
						notice.className = 'notice notice-error';
						notice.innerHTML = "<p>Please enter a valid email address in the 'Email' tab.</p>";
						document.body.appendChild(notice);
						input.placeholder = 'You must enter a valid email address';
						input.classList.add('placeholder-error');
					};
				} else {
					if (notice) {
						notice.remove();
						input.placeholder = '';
						input.classList.remove('placeholder-error');
					}
				};
			};
		});
	</script>

<?php
}

/* Decreases the columns width */
function my_admin_footer_function() {
    echo '<style> @media(min-width:783px){ #cb{width:3%;} .column-type{width:4%;} .column-title{width:30%;} .column-author{width:21%;} .column-shortcode{width:21%;} .column-date{width:21%;}} @media(max-width:782px){.column-type{display: none;} td.type.column-type svg {padding-left: 2.75em;} </style>';
}
add_action('admin_footer', 'my_admin_footer_function');



// Adding the final shortcode to the Administrator custom table
function fr_shortcode_column( $column, $post_id ) {
  if ( 'shortcode' === $column ) {
	?>
	<input type="text" class="form-control" style="background-color: transparent;border: none;" readonly="readonly" onfocus="this.select()" value='[form-reach id="<?echo $post_id?>"]'>
	<?
  }
}

// Customization of actions on hovering over forms.
function modify_list_row_actions( $actions, $post ) {

	unset( $actions['view'] );
	return $actions;
}
add_filter( 'post_row_actions', 'modify_list_row_actions', 10, 2 );

// Removing the WordPress content modifier
function hide_editor() {

	$post_type="form_reach";
	remove_post_type_support( $post_type, 'editor' );
	remove_post_type_support( $post_type, 'author' );
}
add_action( 'init', 'hide_editor' );

// Removing the Slug metabox
function my_add_meta_boxes() {
	
	remove_meta_box( 'slugdiv', 'form_reach', 'normal' );
}
add_action( 'add_meta_boxes', 'my_add_meta_boxes' );

// Customization of the edit page
function register_metabox_post_type( $post ) {
	$post_id = isset( $_GET['post'] ) ? $_GET['post'] : 0;

	$finalShortcode = sprintf(
		'<style>.handle-actions, #screen-options-link-wrap, .wpforms-edit-post-education-notice, #wpforms-notice-global-review_lite_request {display: none;} .ui-draggable-handle, .ui-sortable-handle {touch-action: unset;} </style>
		<div class=" alert alert-secondary align-items-center">
			<label>
				Copy this shortcode and paste it into your post, page, or text widget content:
				<input type="text" readonly="readonly" onfocus="this.select()" value=\'[form-reach id="%s"]\'>
			</label>
		</div>
		<script>
			jQuery(document).ready(function($) {
				$(\'h2\').on(\'hover\', function() {
					$(\'h2\').removeClass();
				});

				$(\'#metaboxwpadmin\').on(\'click\', function() {
					$(this).removeClass();
					$(this).addClass(\'postbox\');
				});

				function setupMetabox() {
					$(\'#metaboxwpadmin\').removeClass().addClass(\'postbox\');
					$(\'h2\').removeClass();
				}

				setupMetabox();

				if (performance.navigation.type === 1) {
					setupMetabox();
				}
			});
		</script>',
		$post_id
	);

	add_meta_box(
		'metaboxwpadmin',
		$finalShortcode,
		'register_metabox_callback',
		'form_reach'
	);
}
add_action('add_meta_boxes','register_metabox_post_type');

// Personnalisation du nombre de colonnes des metaboxes
function set_metabox_columns($columns) {
    $columns['form_reach'] = 0; // Définir le nombre de colonnes pour le type de contenu "form_reach"
    return $columns;
}
add_filter('screen_layout_columns', 'set_metabox_columns');

// Setting the default number of columns displayed
function save_user_preferences() {
  if (isset($_POST['preferences'])) {
    $user_id = get_current_user_id();
    update_user_meta($user_id, 'screen_layout', $_POST['preferences']['screen_layout']);
  }

  wp_die();
}
add_action('wp_ajax_save-user-preferences', 'save_user_preferences');
add_action('wp_ajax_nopriv_save-user-preferences', 'save_user_preferences');

// Removing the wordpress update metabox
function disable_submitdiv_metabox() {
    $current_screen = get_current_screen();
    if ($current_screen && $current_screen->id === 'form_reach') {
        remove_meta_box('submitdiv', 'form_reach', 'side');
    }
}
add_action('add_meta_boxes', 'disable_submitdiv_metabox');

// Removing the update notification message in the WordPress dashboard
function remove_post_updated_message() {
    global $post_updated_messages;

    if (isset($post_updated_messages['post'])) {
        unset($post_updated_messages['post'][1]);
    }
}

add_filter('post_updated_messages', 'remove_post_updated_message');

// Adding meta values
function register_metabox_callback($post){

	add_post_meta( get_the_ID(), 'fr_email_admin_to', get_option('admin_email'), true );
	add_post_meta( get_the_ID(), 'fr_email_admin_from', "Form Reach", true );
	add_post_meta( get_the_ID(), 'fr_email_admin_subject', "User Message", true );
	add_post_meta( get_the_ID(), 'fr_email_user_to', "[email]", true );
	add_post_meta( get_the_ID(), 'fr_email_user_from', "Form Reach", true );
	add_post_meta( get_the_ID(), 'fr_email_user_subject', "Form Reach", true );
	add_post_meta( get_the_ID(), 'fr_email_submit', "Send", true );
	add_post_meta( get_the_ID(), 'fr_whatsapp_submit', "WhatsApp", true );
	add_post_meta( get_the_ID(), 'fr_email_submit_color', "#0d6efd", true );
	add_post_meta( get_the_ID(), 'fr_whatsapp_submit_color', "#198754", true );
	add_post_meta( get_the_ID(), 'fr_email_text_color', "#ffffff", true );
	add_post_meta( get_the_ID(), 'fr_whatsapp_text_color', "#ffffff", true );
	add_post_meta( get_the_ID(), 'fr_email_admin_content', "Surname: [surname]\nName: [name]\nEmail: [email]\nMessage: [message]", true );
	add_post_meta( get_the_ID(), 'fr_email_user_content', "Thank you for reaching out to us.\n\nWe acknowledge receipt of your message and assure you that we will respond as soon as possible.", true );
	add_post_meta( get_the_ID(), 'fr_email_success', "The form has been successfully submitted.", true );
	add_post_meta( get_the_ID(), 'fr_email_error', "The form could not be submitted due to an error. Please try again.", true );
	add_post_meta( get_the_ID(), 'fr_whatsapp_success', "The message has been successfully submitted. Click on the 'Continue to Conversation' button.", true );
	add_post_meta( get_the_ID(), 'fr_whatsapp_error', "The message could not be submitted due to an error. Please try again.", true );
	add_post_meta( get_the_ID(), 'fr_email_form_content', "[input type='text' label='Surname' name='surname' required='required' placeholder='Enter your surname']\n\n[input type='text' label='Name' name='name' required='required' placeholder='Enter your name']\n\n[input type='email' label='Email adress' name='email' required='required' placeholder='Enter your email']\n\n[input type='textarea' rows='10' label='Message' name='message' required='required' placeholder='Enter your message']", true );
	add_post_meta( get_the_ID(), 'fr_whatsapp_form_content', "[input type='text' label='Surname' name='surname' required='required' placeholder='Enter your surname']\n\n[input type='text' label='Name' name='name' required='required' placeholder='Enter your name']\n\n[input type='textarea' rows='10' label='Message' name='message' required='required' placeholder='Enter your message']", true );
	add_post_meta( get_the_ID(), 'fr_whatsapp_switch', "", true );
	add_post_meta( get_the_ID(), 'fr_recaptcha_switch', "", true );
	add_post_meta( get_the_ID(), 'fr_whatsapp_tel', "", true );
	add_post_meta( get_the_ID(), 'fr_whatsapp_tel_international', "", true );
	add_post_meta( get_the_ID(), 'fr_whatsapp_flag', "", true );
	add_post_meta( get_the_ID(), 'fr_user_email_switch', "", true );
	add_post_meta( get_the_ID(), 'fr_email_form_default', "[input type='text' label='Surname' name='surname' required='required' placeholder='Enter your surname']\n\n[input type='text' label='Name' name='name' required='required' placeholder='Enter your name']\n\n[input type='email' label='Email adress' name='email' required='required' placeholder='Enter your email']\n\n[input type='textarea' rows='10' label='Message' name='message' required='required' placeholder='Enter your message']", true );
	add_post_meta( get_the_ID(), 'fr_whatsapp_form_default', "[input type='text' label='Surname' name='surname' required='required' placeholder='Enter your surname']\n\n[input type='text' label='Name' name='name' required='required' placeholder='Enter your name']\n\n[input type='textarea' rows='10' label='Message' name='message' required='required' placeholder='Enter your message']", true );
	add_post_meta( get_the_ID(), 'fr_email_success_default', "The form has been successfully submitted.", true );
	add_post_meta( get_the_ID(), 'fr_email_error_default', "The form could not be submitted due to an error. Please try again.", true );
	add_post_meta( get_the_ID(), 'fr_whatsapp_success_default', "The message has been successfully submitted. Click on the 'Continue to Conversation' button.", true );
	add_post_meta( get_the_ID(), 'fr_whatsapp_error_default', "The message could not be submitted due to an error. Please try again.", true );
	add_post_meta( get_the_ID(), 'fr_email_admin_to_default', get_option('admin_email'), true);
	add_post_meta( get_the_ID(), 'fr_email_admin_from_default', "Form Reach", true);
	add_post_meta( get_the_ID(), 'fr_email_admin_subject_default', "User Message", true);
	add_post_meta( get_the_ID(), 'fr_email_admin_content_default', "Surname: [surname]\nName: [name]\nEmail: [email]\nMessage: [message]", true);
	add_post_meta( get_the_ID(), 'fr_email_user_to_default', "[email]", true);
	add_post_meta( get_the_ID(), 'fr_email_user_from_default', "Form Reach", true);
	add_post_meta( get_the_ID(), 'fr_email_user_subject_default', "Form Reach", true);
	add_post_meta( get_the_ID(), 'fr_email_user_content_default', "Thank you for reaching out to us.\n\nWe acknowledge receipt of your message and assure you that we will respond as soon as possible.", true);
	add_post_meta( get_the_ID(), 'fr_email_submit_text_default', "Send", true);
	add_post_meta( get_the_ID(), 'fr_email_submit_text_color_default', "#ffffff", true);
	add_post_meta( get_the_ID(), 'fr_email_submit_color_default', "#0d6efd", true);
	add_post_meta( get_the_ID(), 'fr_whatsapp_submit_text_default', "WhatsApp", true);
	add_post_meta( get_the_ID(), 'fr_whatsapp_submit_text_color_default', "#ffffff", true);
	add_post_meta( get_the_ID(), 'fr_whatsapp_submit_color_default', "#198754", true);
	
	$wp_stored_meta = get_post_meta( $post ->ID);
	wp_nonce_field( basename(__FILE__), 'wp_formulaire_nonce');

	include 'form-reach-modal.php';
}

add_action('admin_enqueue_scripts', 'monplugin_enqueue_bootstrap');

function monplugin_enqueue_bootstrap($hook) {
  // Vérifier l'identifiant de la page
  if ($hook == 'post_type=form_reach') {
	
    // Charger les fichiers CSS de Bootstrap
    wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css');

    // Charger les fichiers JavaScript de Bootstrap
    wp_enqueue_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js', array('jquery'), '5.5.2', true);
  }
}

// Shortcode tag generator - form
class fr_Id {
    public static function counter() {
        static $counter = 0;
        $counter++;
        return $counter;
    }
}

function form_reach_input_type($atts){

	$id_auto=fr_Id::counter();
	
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
					<textarea class="form-control '.+( $atts['class']).'" id="'.($atts['name']).'_'.( $atts['id']).'" name="'. ( $atts['name'] ).'" placeholder="'.( $atts['placeholder']).'" required="'.( $atts['required']).'" cols="'.( $atts['cols']).'" rows="'.( $atts['rows']).'">'.($atts['value']).'</textarea>
				</div>';
	}else{

		return '<div class=" mb-3 mt-3">
					<label class ="form-label" for="'. ($atts['name']).'_'.( $atts['id']) .'">'.( $atts['label']).'</label>
					<input type="'. ( $atts['type'] ).'" class="form-control '.+( $atts['class']).'" id="'.($atts['name']).'_'.( $atts['id']).'" name="'. ( $atts['name'] ).'" placeholder="'.( $atts['placeholder']).'" required="'.( $atts['required']).'" value="'.($atts['value']).'"/>
				</div>';
	}
}
add_shortcode('input','form_reach_input_type');

// Meta values db
function wp_meta_save($post_id) {

	$is_autosave = wp_is_post_autosave( $post_id);
	$is_revision = wp_is_post_revision( $post_id);
	$is_valid_nonce = (isset($_POST['wp_formulaire_nonce'])&& wp_verify_nonce($_POST['wp_formulaire_nonce'], basename(__FILE__) ) )? 'true' : 'false';

	if ($is_autosave || $is_revision || !$is_valid_nonce){
		exit;
	}
	if ( isset($_POST['fr_email_admin_to'])){
		update_post_meta($post_id,'fr_email_admin_to',sanitize_text_field($_POST['fr_email_admin_to']));
	}
	if ( isset($_POST['fr_email_admin_from'])){
		update_post_meta($post_id,'fr_email_admin_from',sanitize_text_field($_POST['fr_email_admin_from']));
	}
	if ( isset($_POST['fr_email_admin_subject'])){
		update_post_meta($post_id,'fr_email_admin_subject',sanitize_text_field($_POST['fr_email_admin_subject']));
	}
	if ( isset($_POST['fr_email_admin_content'])){
		update_post_meta($post_id,'fr_email_admin_content',($_POST['fr_email_admin_content']));
	}
	if ( isset($_POST['fr_email_user_to'])){
		update_post_meta($post_id,'fr_email_user_to',sanitize_text_field($_POST['fr_email_user_to']));
	}
	if ( isset($_POST['fr_email_user_from'])){
		update_post_meta($post_id,'fr_email_user_from',sanitize_text_field($_POST['fr_email_user_from']));
	}
	if ( isset($_POST['fr_email_user_subject'])){
		update_post_meta($post_id,'fr_email_user_subject',sanitize_text_field($_POST['fr_email_user_subject']));
	}
	if ( isset($_POST['fr_email_user_content'])){
		update_post_meta($post_id,'fr_email_user_content',($_POST['fr_email_user_content']));
	}
	if ( isset($_POST['fr_email_submit'])){
		update_post_meta($post_id,'fr_email_submit',($_POST['fr_email_submit']));
	}
	if ( isset($_POST['fr_whatsapp_submit'])){
		update_post_meta($post_id,'fr_whatsapp_submit',($_POST['fr_whatsapp_submit']));
	}
	if ( isset($_POST['fr_email_submit_color'])){
		update_post_meta($post_id,'fr_email_submit_color',($_POST['fr_email_submit_color']));
	}
	if ( isset($_POST['fr_whatsapp_submit_color'])){
		update_post_meta($post_id,'fr_whatsapp_submit_color',($_POST['fr_whatsapp_submit_color']));
	}
	if ( isset($_POST['fr_email_text_color'])){
		update_post_meta($post_id,'fr_email_text_color',($_POST['fr_email_text_color']));
	}
	if ( isset($_POST['fr_whatsapp_text_color'])){
		update_post_meta($post_id,'fr_whatsapp_text_color',($_POST['fr_whatsapp_text_color']));
	}
	if ( isset($_POST['fr_email_success'])){
		update_post_meta($post_id,'fr_email_success',sanitize_text_field($_POST['fr_email_success']));
	}
	if ( isset($_POST['fr_email_error'])){
		update_post_meta($post_id,'fr_email_error',sanitize_text_field($_POST['fr_email_error']));
	}
	if ( isset($_POST['fr_whatsapp_success'])){
		update_post_meta($post_id,'fr_whatsapp_success',sanitize_text_field($_POST['fr_whatsapp_success']));
	}
	if ( isset($_POST['fr_whatsapp_error'])){
		update_post_meta($post_id,'fr_whatsapp_error',sanitize_text_field($_POST['fr_whatsapp_error']));
	}
	if ( isset($_POST['fr_email_form_content'])){
		update_post_meta($post_id,'fr_email_form_content',$_POST['fr_email_form_content']);
	}
	if ( isset($_POST['fr_whatsapp_form_content'])){
		update_post_meta($post_id,'fr_whatsapp_form_content',$_POST['fr_whatsapp_form_content']);
	}
	if ( isset($_POST['fr_whatsapp_tel'])){
		update_post_meta($post_id,'fr_whatsapp_tel',sanitize_text_field($_POST['fr_whatsapp_tel']));
	}
	if ( isset( $_POST['fr_whatsapp_flag'])){
		update_post_meta($post_id,'fr_whatsapp_flag',sanitize_text_field( $_POST['fr_whatsapp_flag']));
	}
	if ( isset( $_POST['fr_whatsapp_tel_international'])){
		update_post_meta($post_id,'fr_whatsapp_tel_international',sanitize_text_field( $_POST['fr_whatsapp_tel_international']));
	}
	if ( isset($_POST['fr_whatsapp_switch'])){
		update_post_meta($post_id,'fr_whatsapp_switch', "1" );
	}else{
		update_post_meta($post_id,'fr_whatsapp_switch', "0" );
	}
	if ( isset($_POST['fr_user_email_switch'])){
		update_post_meta($post_id,'fr_user_email_switch', "1" );
	}else{
		update_post_meta($post_id,'fr_user_email_switch', "0" );
	}
	if ( isset($_POST['fr_recaptcha_switch'])){
		update_post_meta($post_id,'fr_recaptcha_switch', "1" );
	}else{
		update_post_meta($post_id,'fr_recaptcha_switch', "0" );
	}

}
add_action('save_post','wp_meta_save');

// Adding the submenu Form Log
function wp_add_custom_submenu(){

    add_submenu_page(
					"edit.php?post_type=form_reach",
					"Form Log",
					"Form Log",
					"manage_options","form-log",
					"form_log"
				);
}
add_action("admin_menu","wp_add_custom_submenu");

function form_log(){
	?>	
		<head>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
			<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
			<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
			<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
			<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
			<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"></script>
			<link rel="stylesheet" href="<?php echo plugin_dir_url(__FILE__); ?>style/form-reach.css">
		</head>
		<section>
			<div class="container pt-5">
				<h4>Form Log</h4>

				<?
				global $wpdb;
				$table = $wpdb->prefix . "form_history";
				$row_count = $wpdb->get_var("SELECT COUNT(*) FROM $table");

				if ($row_count == 0){
					echo "<h5 class='text-center'>No message to display at the moment.</h5></br></br>
					<h6 class='text-center text-muted'>Messages sent by users will be displayed here.</h6>";
				}else{
				?>

				<div class="row pb-5 pt-3 fs-6">
					<form method="post">
						<div class="col">
							<table class="table table-responsive table-striped table-hover table-bordered align-middle text-center p-3" id="fr_form_history_table">
								<thead>
									<tr>
										<th scope="col" data-sortable="true" style="text-align: center;">
											ID
										</th>
										<th scope="col" data-sortable="false" style="text-align: center;">
											Type
										</th>
										<th scope="col" class="display-sm-none" data-sortable="false" style="text-align: center;">
											Content
										</th>
										<th scope="col" data-sortable="true" style="text-align: center;">
											Date
										</th>
										<th scope="col" data-sortable="false" style="text-align: center;">
											Delete
										</th>
									</tr>
								</thead>
								<tbody>
									<?
										// Récupération des données de la la database
											global $wpdb;
											$table = $wpdb->prefix . "form_history";

											
											if(isset($_POST['delete'])){
												$wpdb->delete($table,
																array(
																	'ID'=>$_POST['delete']
																)
																);
											};
											
											// Affichage des données dans le tableau admin
											$result =$wpdb->get_results("SELECT * FROM $table;");

											foreach ($result as $table) {
												$deleteId = ($table->ID);
									?>
										<tr>
											<td>
												<?echo ($table->ID)?>
											</td>
											<td><?php
												switch ($table->Type) {
												case "Mail":
													echo '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-envelope text-primary" viewBox="0 0 16 16"><path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/></svg>';
													break;
												case "Whatsapp":
													echo '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#25D366" class="bi bi-whatsapp" viewBox="0 0 16 16"><path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/></svg>';
													break;
												case "Telegram":
													echo '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#0088cc" class="bi bi-telegram" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.287 5.906c-.778.324-2.334.994-4.666 2.01-.378.15-.577.298-.595.442-.03.243.275.339.69.47l.175.055c.408.133.958.288 1.243.294.26.006.549-.1.868-.32 2.179-1.471 3.304-2.214 3.374-2.23.05-.012.12-.026.166.016.047.041.042.12.037.141-.03.129-1.227 1.241-1.846 1.817-.193.18-.33.307-.358.336a8.154 8.154 0 0 1-.188.186c-.38.366-.664.64.015 1.088.327.216.589.393.85.571.284.194.568.387.936.629.093.06.183.125.27.187.331.236.63.448.997.414.214-.02.435-.22.547-.82.265-1.417.786-4.486.906-5.751a1.426 1.426 0 0 0-.013-.315.337.337 0 0 0-.114-.217.526.526 0 0 0-.31-.093c-.3.005-.763.166-2.984 1.09z"/></svg>';
													break;
												case "Signal":
													echo '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#3A76F0" class="bi bi-signal" viewBox="0 0 16 16"><path d="m6.08.234.179.727a7.264 7.264 0 0 0-2.01.832l-.383-.643A7.9 7.9 0 0 1 6.079.234zm3.84 0L9.742.96a7.265 7.265 0 0 1 2.01.832l.388-.643A7.957 7.957 0 0 0 9.92.234zm-8.77 3.63a7.944 7.944 0 0 0-.916 2.215l.727.18a7.264 7.264 0 0 1 .832-2.01l-.643-.386zM.75 8a7.3 7.3 0 0 1 .081-1.086L.091 6.8a8 8 0 0 0 0 2.398l.74-.112A7.262 7.262 0 0 1 .75 8zm11.384 6.848-.384-.64a7.23 7.23 0 0 1-2.007.831l.18.728a7.965 7.965 0 0 0 2.211-.919zM15.251 8c0 .364-.028.727-.082 1.086l.74.112a7.966 7.966 0 0 0 0-2.398l-.74.114c.054.36.082.722.082 1.086zm.516 1.918-.728-.18a7.252 7.252 0 0 1-.832 2.012l.643.387a7.933 7.933 0 0 0 .917-2.219zm-6.68 5.25c-.72.11-1.453.11-2.173 0l-.112.742a7.99 7.99 0 0 0 2.396 0l-.112-.741zm4.75-2.868a7.229 7.229 0 0 1-1.537 1.534l.446.605a8.07 8.07 0 0 0 1.695-1.689l-.604-.45zM12.3 2.163c.587.432 1.105.95 1.537 1.537l.604-.45a8.06 8.06 0 0 0-1.69-1.691l-.45.604zM2.163 3.7A7.242 7.242 0 0 1 3.7 2.163l-.45-.604a8.06 8.06 0 0 0-1.691 1.69l.604.45zm12.688.163-.644.387c.377.623.658 1.3.832 2.007l.728-.18a7.931 7.931 0 0 0-.916-2.214zM6.913.831a7.254 7.254 0 0 1 2.172 0l.112-.74a7.985 7.985 0 0 0-2.396 0l.112.74zM2.547 14.64 1 15l.36-1.549-.729-.17-.361 1.548a.75.75 0 0 0 .9.902l1.548-.357-.17-.734zM.786 12.612l.732.168.25-1.073A7.187 7.187 0 0 1 .96 9.74l-.727.18a8 8 0 0 0 .736 1.902l-.184.79zm3.5 1.623-1.073.25.17.731.79-.184c.6.327 1.239.574 1.902.737l.18-.728a7.197 7.197 0 0 1-1.962-.811l-.007.005zM8 1.5a6.502 6.502 0 0 0-6.498 6.502 6.516 6.516 0 0 0 .998 3.455l-.625 2.668L4.54 13.5a6.502 6.502 0 0 0 6.93-11A6.516 6.516 0 0 0 8 1.5"/></svg>';
													break;
												case "Messenger":
													echo '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#006AFF" class="bi bi-messenger" viewBox="0 0 16 16"><path d="M0 7.76C0 3.301 3.493 0 8 0s8 3.301 8 7.76-3.493 7.76-8 7.76c-.81 0-1.586-.107-2.316-.307a.639.639 0 0 0-.427.03l-1.588.702a.64.64 0 0 1-.898-.566l-.044-1.423a.639.639 0 0 0-.215-.456C.956 12.108 0 10.092 0 7.76zm5.546-1.459-2.35 3.728c-.225.358.214.761.551.506l2.525-1.916a.48.48 0 0 1 .578-.002l1.869 1.402a1.2 1.2 0 0 0 1.735-.32l2.35-3.728c.226-.358-.214-.761-.551-.506L9.728 7.381a.48.48 0 0 1-.578.002L7.281 5.98a1.2 1.2 0 0 0-1.735.32z"/></svg>';
													break;
												default:
													echo 'Type undefined';
													break;
											}?>
											</td>
											<td>
												<?echo ($table->Content)?>
											</td>
											<td>
												<?echo ($table->created_at)?>
											</td>
											<td>
												<button class="remove btn btn-danger btn-sm" name="delete" value="<?php echo $deleteId ?>">Delete</button>
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
			<script>
				$(document).ready( function () {
					$('#fr_form_history_table').DataTable();
				} );
			</script>

			<!-- Flyout menu -->
			<script src="https://use.fontawesome.com/4630774b91.js"></script>

			<button type="button" class="flyout-button"></button>

			<div class="flyout-menu" style="display:none;">
			<a style="transform: scale(0); opacity:0;" href="https://form-reach.com/support" title="Support" target="_blank"><i class="fa fa-life-ring" aria-hidden="true"></i></a>
			<a style="transform: scale(0); opacity:0;" href="https://form-reach.com/documentation" title="Documentation" target="_blank"><i class="fa fa-book"  aria-hidden="true"></i></a>
			<a style="transform: scale(0); opacity:0;" href="https://form-reach.com/suggestion" title="Suggestion" target="_blank"><i class="fa fa-lightbulb-o"  aria-hidden="true"></i></a>
			</div>

			<script>
			let flyoutButton = document.querySelector(".flyout-button");
			let flyoutMenu = document.querySelector(".flyout-menu");
			let menuOpen = false;

			flyoutButton.addEventListener("click", () => {
				if (!menuOpen) {
					flyoutButton.style.pointerEvents = "none";
					flyoutMenu.style.display = "block";
					flyoutMenu.querySelectorAll("a").forEach((a, index) => {
						setTimeout(() => {
							a.style.transition = "transform .4s cubic-bezier(0.680, -0.550, 0.265, 1.550), opacity .4s cubic-bezier(0.680, -0.550, 0.265, 1.550)";
							a.style.transform = "scale(1)";
							a.style.opacity = "1";
						}, (2 - index) * 30);
					});
					setTimeout(() => {
						flyoutButton.style.pointerEvents = "auto";
					}, (2 + 1) * 30);
					menuOpen = true;
				} else {
					flyoutButton.style.pointerEvents = "none";
					flyoutMenu.querySelectorAll("a").forEach((a, index) => {
						setTimeout(() => {
							a.style.transition = "transform .4s cubic-bezier(0.680, -0.550, 0.265, 1.550), opacity .4s cubic-bezier(0.680, -0.550, 0.265, 1.550)";
							a.style.transform = "scale(0)";
							a.style.opacity = "0";
						}, index * 30);
					});
					setTimeout(() => {
						flyoutMenu.style.display = "none";
						flyoutButton.style.pointerEvents = "auto";
					}, (2 + 1) * 100);
					menuOpen = false;
				}
			});
			</script>

		</section>
	<?
}

// Adding the submenu Spam Protection
function wp_add_custom_submenu_reCAPTCHA(){

	add_submenu_page(
		"edit.php?post_type=form_reach",
		"Spam Protection",
		"Spam Protection",
		"manage_options",
		"Spam-Protection",
		"recaptcha_options_page"
	);
}

function recaptcha_options_page() {
	?>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo plugin_dir_url(__FILE__); ?>style/form-reach.css">
		<scrip src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"></script>
		<script src="<?php echo plugin_dir_url(__FILE__); ?>js/form-reach-admin.js"></script>

		<section>
			<div class="card">
				<h4 class="ms-1.7 mb-5">Google reCAPTCHA v3</h4>
				<form method="post" action="options.php">
					<?php settings_fields( 'recaptcha_options_group' ); ?>
					<?php do_settings_sections( 'recaptcha_options_page' ); ?>
					<div class="custom-button">
						<input type="checkbox" class="mb-5 slider-input" name="fr_recaptcha_switch" id="fr_recaptcha_switch" value="1" <?php checked( 1, get_option( 'fr_recaptcha_switch' ) ); ?>/><label id="fr_recaptcha_label" for="fr_recaptcha_switch" class="slider-label">Toggle</label>
						<p class="float-end text-secondary">Protection against unwanted content.</p>
					</div>
					<div>
						<p>
						reCAPTCHA protects you against unwanted and other types of automated abuses. With the Form Reach reCAPTCHA integration module, you can block abusive form submissions from spam bots.
						</p>
						<p><strong><a href="https://www.google.com/recaptcha/about/" target="_blank">reCAPTCHA (v3)</a></strong></p>
						<table class="form-table">
							<tbody>
								<tr valign="top">
									<th scope="row"><label for="fr_key_site">Site key</label></th>
									<td><input type="text" name="fr_key_site" id="fr_key_site" size="44" value="<?php echo esc_attr( get_option('fr_key_site') ); ?>"/></td>
								</tr>
								<tr valign="top">
									<th scope="row"><label for="fr_key_secret">Secret key</label></th>
									<td><input type="password" name="fr_key_secret" id="fr_key_secret" size="44" value="<?php echo esc_attr( get_option('fr_key_secret') ); ?>"/></td>
								</tr>
							</tbody>
						</table>
						<?php submit_button(); ?>
					</form>
				</div>
			</div>

			<!-- Flyout menu -->
			<script src="https://use.fontawesome.com/4630774b91.js"></script>

			<button type="button" class="flyout-button"></button>

			<div class="flyout-menu" style="display:none;">
			<a style="transform: scale(0); opacity:0;" href="https://form-reach.com/support" title="Support" target="_blank"><i class="fa fa-life-ring" aria-hidden="true"></i></a>
			<a style="transform: scale(0); opacity:0;" href="https://form-reach.com/documentation" title="Documentation" target="_blank"><i class="fa fa-book"  aria-hidden="true"></i></a>
			<a style="transform: scale(0); opacity:0;" href="https://form-reach.com/suggestion" title="Suggestion" target="_blank"><i class="fa fa-lightbulb-o"  aria-hidden="true"></i></a>
			</div>

			<script>
			let flyoutButton = document.querySelector(".flyout-button");
			let flyoutMenu = document.querySelector(".flyout-menu");
			let menuOpen = false;

			flyoutButton.addEventListener("click", () => {
				if (!menuOpen) {
					flyoutButton.style.pointerEvents = "none";
					flyoutMenu.style.display = "block";
					flyoutMenu.querySelectorAll("a").forEach((a, index) => {
						setTimeout(() => {
							a.style.transition = "transform .4s cubic-bezier(0.680, -0.550, 0.265, 1.550), opacity .4s cubic-bezier(0.680, -0.550, 0.265, 1.550)";
							a.style.transform = "scale(1)";
							a.style.opacity = "1";
						}, (2 - index) * 30);
					});
					setTimeout(() => {
						flyoutButton.style.pointerEvents = "auto";
					}, (2 + 1) * 30);
					menuOpen = true;
				} else {
					flyoutButton.style.pointerEvents = "none";
					flyoutMenu.querySelectorAll("a").forEach((a, index) => {
						setTimeout(() => {
							a.style.transition = "transform .4s cubic-bezier(0.680, -0.550, 0.265, 1.550), opacity .4s cubic-bezier(0.680, -0.550, 0.265, 1.550)";
							a.style.transform = "scale(0)";
							a.style.opacity = "0";
						}, index * 30);
					});
					setTimeout(() => {
						flyoutMenu.style.display = "none";
						flyoutButton.style.pointerEvents = "auto";
					}, (2 + 1) * 100);
					menuOpen = false;
				}
			});
			</script>
		</section>
	<?php
}

function register_recaptcha_settings() {
  register_setting( 'recaptcha_options_group', 'fr_recaptcha_switch' );
  register_setting( 'recaptcha_options_group', 'fr_key_site' );
  register_setting( 'recaptcha_options_group', 'fr_key_secret' );
}

add_action( 'admin_init', 'register_recaptcha_settings' );
add_action("admin_menu","wp_add_custom_submenu_reCAPTCHA");