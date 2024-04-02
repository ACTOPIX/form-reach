<?php
// Register Custom Post Type
function cw_post_type_news() {
    $labels = array(
        'name'                  => _x('Form Reach', 'Post Type General Name', 'form-reach-domain'),
        'singular_name'         => _x('Form', 'Post Type Singular Name', 'form-reach-domain'),
        'menu_name'             => __('Form Reach', 'form-reach-domain'),
        'name_admin_bar'        => __('Form Reach', 'form-reach-domain'),
        'add_new'               => __('Create New', 'form-reach-domain'),
        'add_new_item'          => __('Create New Form', 'form-reach-domain'),
        'new_item'              => __('New Form', 'form-reach-domain'),
        'edit_item'             => __('Edit Form', 'form-reach-domain'),
        'all_items'             => __('All Forms', 'form-reach-domain'),
        'search_items'          => __('Search Forms', 'form-reach-domain'),
        'not_found'             => __('No forms found.', 'form-reach-domain'),
        'not_found_in_trash'    => __('No forms found in Trash.', 'form-reach-domain'),
        'featured_image'        => __('Form Image', 'form-reach-domain'),
        'set_featured_image'    => __('Set form image', 'form-reach-domain'),
        'remove_featured_image' => __('Remove form image', 'form-reach-domain'),
        'use_featured_image'    => __('Use as form image', 'form-reach-domain'),
        'insert_into_item'      => __('Insert into form', 'form-reach-domain'),
        'uploaded_to_this_item' => __('Uploaded to this form', 'form-reach-domain'),
        'items_list'            => __('Forms list', 'form-reach-domain'),
        'items_list_navigation' => __('Forms list navigation', 'form-reach-domain'),
        'filter_items_list'     => __('Filter forms list', 'form-reach-domain'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => false,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => false,
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => null,
        'menu_icon'          => 'dashicons-buddicons-pm',
        'supports'           => array('title'), // Added support for common features
    );

    register_post_type('form_reach', $args);
}

add_action('init', 'cw_post_type_news');

// Customization of the admin table
function smashing_form_reach_columns($columns) {
    $newColumns = array(
        'cb' => $columns['cb'], // Keep the checkbox column
        'type' => __('Type', 'form-reach-domain'),
        'title' => __('Title', 'form-reach-domain'),
        'shortcode' => __('Shortcode', 'form-reach-domain'),
        'author' => __('Author', 'form-reach-domain'),
        'date' => __('Date', 'form-reach-domain'),
    );
    return $newColumns;
}
add_filter('manage_form_reach_posts_columns', 'smashing_form_reach_columns');

// Adding the shortcode to the Administrator custom table
function fr_shortcode_column($column, $post_id) {
    if ('shortcode' === $column) {
        echo '<input type="text" class="form-control" style="background-color: transparent; border: none;" readonly="readonly" onfocus="this.select()" value=\'[form-reach id="' . esc_attr($post_id) . '"]\'>';
    }
}

// Handling display of custom column content
function fr_custom_column_content($column, $post_id) {
    if ($column === 'type') {
        $formType = get_post_meta($post_id, 'fr_whatsapp_switch', true); // Assuming 'fr_whatsapp_switch' is stored as post meta

        switch ($formType) {
            case "0":
                echo '<span class="dashicons dashicons-email"></span>';
                break;
            case "1":
                echo '<span class="dashicons dashicons-whatsapp" style="color: #25D366;"></span>';
                break;
            default:
                echo __('Type undefined', 'form-reach-domain');
                break;
        }
    }
}

// Add actions for managing custom columns
add_action('manage_form_reach_posts_custom_column', 'fr_custom_column_content', 10, 2);
add_action('manage_form_reach_posts_custom_column', 'fr_shortcode_column', 10, 2);

add_action('admin_head', 'add_custom_menu_style');

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

add_action('admin_notices', 'fr_missing_email');

function fr_missing_email() {
    ?>
    <script>
        function validateEmails(emails) {
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emails.split(",").every(email => emailPattern.test(email.trim()));
        }

        document.addEventListener("DOMContentLoaded", function() {
            const input = document.getElementById('fr_email_admin_to');
            const noticeId = 'notification';
            let notice = document.getElementById(noticeId);

            if (input && !validateEmails(input.value)) {
                if (!notice) {
                    notice = document.createElement('div');
                    notice.id = noticeId;
                    notice.className = 'notice notice-error';
                    notice.innerHTML = "<p>Please enter a valid email address in the 'Email' tab.</p>";
                    document.body.insertBefore(notice, document.body.firstChild);
                    input.placeholder = 'You must enter a valid email address';
                    input.classList.add('placeholder-error');
                }
            } else if (notice) {
                notice.remove();
                input.placeholder = '';
                input.classList.remove('placeholder-error');
            }
        });
    </script>
    <?php
}

/**
 * Optimizes admin column widths and hides certain elements via CSS.
 */
function wp_optimize_admin_columns() {
	// Vérifiez si nous sommes sur la page spécifique
    $screen = get_current_screen();
    if ( $screen->id == 'edit-form_reach' ) {
		// Minified and slightly optimized CSS for admin footer.
		?><style>@media(min-width:783px){#cb{width:3%;}.column-type{width:4%;}.column-title{width:30%;}.column-author,.column-shortcode,.column-date{width:21%;}}@media(max-width:782px){.column-type{display:none;}td.type.column-type svg{padding-left:2.75em;}}</style>
			<?php
		// Enqueue les styles personnalisés pour la page
        wp_enqueue_style('form-reach-custom-style', plugin_dir_url(__FILE__) . 'style/form-reach.css');
		
		add_flyout_menu();
	}
}
add_action('admin_footer', 'wp_optimize_admin_columns');

/**
 * Modifies the list row actions for posts.
 *
 * @param array $actions An array of row action links.
 * @param WP_Post $post The post object.
 * @return array The modified actions.
 */
function wp_modify_list_row_actions($actions, $post) {
    unset($actions['view']);
    return $actions;
}
add_filter('post_row_actions', 'wp_modify_list_row_actions', 10, 2);

// Removing the Slug metabox
function wp_custom_remove_slug_metabox() {
    remove_meta_box('slugdiv', 'form_reach', 'normal');
}
add_action('add_meta_boxes', 'wp_custom_remove_slug_metabox');

// Customization of the edit page
function register_metabox_post_type( $post ) {
	$post_id = isset( $_GET['post'] ) ? $_GET['post'] : 0;

	// Assurez-vous que $post_id est une variable sécurisée (par exemple, un entier)
	$post_id = absint( $post_id ); // Conversion en entier positif pour la sécurité

	$shortcode = esc_attr( '[form-reach id="' . $post_id . '"]' );

	// Préparation de la chaîne traduisible
	$copyInstruction = __('Copy this shortcode and paste it into your post, page, or text widget content:', 'form-reach-domain');

	// HTML sécurisé pour affichage
	$finalShortcode = <<<HTML
	<div class="alert alert-secondary align-items-center">
		<label>
			$copyInstruction
			<input type="text" readonly="readonly" onfocus="this.select()" value="{$shortcode}">
		</label>
	</div>
	HTML;

	add_meta_box(
		'metaboxwpadmin',
		$finalShortcode,
		'register_metabox_callback',
		'form_reach'
	);
}
add_action('add_meta_boxes','register_metabox_post_type');

function register_metabox_callback($post) {
	
	if ('form_reach' !== $post->post_type || !current_user_can('edit_post', $post->ID)) {
        return;
    }

    $default_meta_values = [
        'fr_email_admin_to' => get_option('admin_email'),
        'fr_email_admin_from' => "Form Reach",
        'fr_email_admin_subject' => "User Message",
        'fr_email_user_to' => "[email]",
        'fr_email_user_from' => "Form Reach",
        'fr_email_user_subject' => "Form Reach",
        'fr_email_submit' => "Send",
        'fr_whatsapp_submit' => "WhatsApp",
        'fr_email_submit_color' => "#0d6efd",
        'fr_whatsapp_submit_color' => "#198754",
        'fr_email_text_color' => "#ffffff",
        'fr_whatsapp_text_color' => "#ffffff",
        'fr_email_admin_content' => "Surname: [surname]\nName: [name]\nEmail: [email]\nMessage: [message]",
        'fr_email_user_content' => "Thank you for reaching out to us.\n\nWe acknowledge receipt of your message and assure you that we will respond as soon as possible.",
        'fr_email_success' => "The form has been successfully submitted.",
        'fr_email_error' => "The form could not be submitted due to an error. Please try again.",
        'fr_whatsapp_success' => "The message has been successfully submitted. Click on the 'Continue to Conversation' button.",
        'fr_whatsapp_error' => "The message could not be submitted due to an error. Please try again.",
        'fr_email_form_content' => "[input type='text' label='Surname' name='surname' required='required' placeholder='Enter your surname']\n\n[input type='text' label='Name' name='name' required='required' placeholder='Enter your name']\n\n[input type='email' label='Email adress' name='email' required='required' placeholder='Enter your email']\n\n[input type='textarea' rows='10' label='Message' name='message' required='required' placeholder='Enter your message']",
        'fr_whatsapp_form_default' => "[input type='text' label='Surname' name='surname' required='required' placeholder='Enter your surname']\n\n[input type='text' label='Name' name='name' required='required' placeholder='Enter your name']\n\n[input type='textarea' rows='10' label='Message' name='message' required='required' placeholder='Enter your message']",
        'fr_email_success_default' => "The form has been successfully submitted.",
        'fr_email_error_default' => "The form could not be submitted due to an error. Please try again.",
        'fr_whatsapp_success_default' => "The message has been successfully submitted. Click on the 'Continue to Conversation' button.",
        'fr_whatsapp_error_default' => "The message could not be submitted due to an error. Please try again.",
        'fr_email_admin_to_default' => get_option('admin_email'),
        'fr_email_admin_from_default' => "Form Reach",
        'fr_email_admin_subject_default' => "User Message",
        'fr_email_admin_content_default' => "Surname: [surname]\nName: [name]\nEmail: [email]\nMessage: [message]",
        'fr_email_user_to_default' => "[email]",
        'fr_email_user_from_default' => "Form Reach",
        'fr_email_user_subject_default' => "Form Reach",
        'fr_email_user_content_default' => "Thank you for reaching out to us.\n\nWe acknowledge receipt of your message and assure you that we will respond as soon as possible.",
        'fr_email_submit_text_default' => "Send",
        'fr_email_submit_text_color_default' => "#ffffff",
        'fr_email_submit_color_default' => "#0d6efd",
        'fr_whatsapp_submit_text_default' => "WhatsApp",
        'fr_whatsapp_submit_text_color_default' => "#ffffff",
        'fr_whatsapp_submit_color_default', "#198754",
    ];

    foreach ($default_meta_values as $meta_key => $meta_value) {
        // Vérifiez si la métadonnée n'existe pas déjà avant de l'ajouter
        if (!metadata_exists('post', $post->ID, $meta_key)) {
            add_post_meta($post->ID, $meta_key, $meta_value, true);
        }
    }
	
	$wp_stored_meta = get_post_meta( $post ->ID);

    // Inclure un fichier externe si nécessaire
    include 'form-reach-modal.php';
}

// Définition du nombre de colonnes des metaboxes
function wp_custom_set_metabox_columns($columns) {
    $columns['form_reach'] = 1; // Définissez le nombre souhaité de colonnes
    return $columns;
}
add_filter('screen_layout_columns', 'wp_custom_set_metabox_columns');

// Enregistrement des préférences utilisateur
function wp_custom_save_user_preferences() {
    if (isset($_POST['preferences']) && is_user_logged_in()) {
        $user_id = get_current_user_id();
        // Valider et nettoyer $_POST['preferences'] ici
        update_user_meta($user_id, 'screen_layout_form_reach', $_POST['preferences']['screen_layout_form_reach']);
    }

    wp_die();
}
add_action('wp_ajax_save_user_preferences', 'wp_custom_save_user_preferences');

// Suppression du message de notification de mise à jour dans le tableau de bord WordPress lors du click sur whatsapp switch
function wp_custom_remove_post_updated_message($messages) {
    unset($messages['post'][1]); // Ajustez l'index si nécessaire
    return $messages;
}
add_filter('post_updated_messages', 'wp_custom_remove_post_updated_message');

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

// Générateur de tags pour les shortcodes - formulaire
class fr_Id {
    public static function counter() {
        static $counter = 0;
        ++$counter;
        return $counter;
    }
}

function form_reach_input_type($atts) {
    $id_auto = fr_Id::counter();
    
    $atts = shortcode_atts(array(
        'type' => 'text',
        'name' => 'default',
        'id' => $id_auto,
        'placeholder' => '',
        'required' => false, // Modifié pour être un booléen
        'label' => '',
        'class' => '',
        'value' => '',
        'cols' => null, // Gardé comme null si non défini
        'rows' => null, // Gardé comme null si non défini
    ), $atts, 'input');

    $html = '<div class="mb-3 mt-3">';
    if (!empty($atts['label'])) {
        $html .= '<label class="form-label" for="' . esc_attr($atts['name']) . '_' . esc_attr($atts['id']) . '">' . esc_html($atts['label']) . '</label>';
    }
    
    if ($atts['type'] === "textarea") {
        $html .= '<textarea class="form-control ' . esc_attr($atts['class']) . '" id="' . esc_attr($atts['name']) . '_' . esc_attr($atts['id']) . '" name="' . esc_attr($atts['name']) . '" placeholder="' . esc_attr($atts['placeholder']) . '"' . ($atts['required'] ? ' required' : '') . ' cols="' . esc_attr($atts['cols']) . '" rows="' . esc_attr($atts['rows']) . '">' . esc_html($atts['value']) . '</textarea>';
    } elseif ($atts['type'] === "email") {
        $html .= '<input type="' . esc_attr($atts['type']) . '" class="form-control ' . esc_attr($atts['class']) . '" id="' . esc_attr($atts['name']) . '_' . esc_attr($atts['id']) . '" name="' . esc_attr($atts['name']) . '" placeholder="' . esc_attr($atts['placeholder']) . '"' . ($atts['required'] ? ' required' : '') . ' value="' . esc_attr($atts['value']) . '"/>';
		$html .= '<div class="invalid-feedback" id="emailFeedback" style="display: none;">' . esc_html__('Please enter a valid email address', 'form-reach-domain') . '</div>';
    } else {
        $html .= '<input type="' . esc_attr($atts['type']) . '" class="form-control ' . esc_attr($atts['class']) . '" id="' . esc_attr($atts['name']) . '_' . esc_attr($atts['id']) . '" name="' . esc_attr($atts['name']) . '" placeholder="' . esc_attr($atts['placeholder']) . '"' . ($atts['required'] ? ' required' : '') . ' value="' . esc_attr($atts['value']) . '"/>';
    }
    
    $html .= '</div>';
    
    return $html;
}
add_shortcode('input', 'form_reach_input_type');

function form_reach_add_nonce_to_post() {
    global $post;

    if ('form_reach' === $post->post_type) {
        wp_nonce_field('form_reach_save_post_action', 'form_reach_save_post_nonce');
    }
}
add_action('post_submitbox_misc_actions', 'form_reach_add_nonce_to_post');

// Meta values db
function wp_meta_save($post_id) {

    if (!isset($_POST['form_reach_save_post_nonce'])) {
        return;
    }
    if (!wp_verify_nonce($_POST['form_reach_save_post_nonce'], 'form_reach_save_post_action')) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

	// Liste des champs à sauvegarder, avec indication si la valeur doit être nettoyée
    $fields = [
        'fr_email_admin_to' => true,
        'fr_email_admin_from' => true,
        'fr_email_admin_subject' => true,
        'fr_email_admin_content' => false,
        'fr_email_user_to' => true,
        'fr_email_user_from' => true,
        'fr_email_user_subject' => true,
        'fr_email_user_content' => false,
        'fr_email_submit' => false,
        'fr_whatsapp_submit' => false,
        'fr_email_submit_color' => false,
        'fr_whatsapp_submit_color' => false,
        'fr_email_text_color' => false,
        'fr_whatsapp_text_color' => false,
        'fr_email_success' => true,
        'fr_email_error' => true,
        'fr_whatsapp_success' => true,
        'fr_whatsapp_error' => true,
        'fr_email_form_content' => false,
        'fr_whatsapp_form_content' => false,
        'fr_whatsapp_tel' => true,
        'fr_whatsapp_flag' => true,
        'fr_whatsapp_tel_international' => true,
        'fr_whatsapp_switch' => 'checkbox',
        'fr_user_email_switch' => 'checkbox',
    ];

    foreach ($fields as $field => $sanitize) {
        if (isset($_POST[$field])) {
            $value = $_POST[$field];
            if ($sanitize === true) {
                $value = sanitize_text_field($value);
            } elseif ($sanitize === 'checkbox') {
                $value = "1"; // Checkbox présente et cochée
            }
            update_post_meta($post_id, $field, $value);
        } elseif ($sanitize === 'checkbox') {
            update_post_meta($post_id, $field, "0"); // Checkbox non présente ou non cochée
        }
    }
}

// Ajout de l'action à WordPress
add_action('save_post_form_reach','wp_meta_save');

function wp_add_custom_submenu() {
    // Ajoute le sous-menu et garde l'identifiant de la page retourné
    $page_hook_suffix = add_submenu_page(
        "edit.php?post_type=form_reach",
        "Form Log",
        "Form Log",
        "manage_options",
        "form-log",
        "form_log_callback"
    );

    // Utilise l'identifiant de la page pour charger les scripts et styles seulement sur cette page
    add_action('admin_enqueue_scripts', function($hook) use ($page_hook_suffix) {
        if ($hook !== $page_hook_suffix) {
            return;
        }

		// DataTables Basic
		wp_enqueue_style('datatables-css', 'https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css');
		wp_enqueue_script('datatables-js', 'https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js', array('jquery'), null, true);
		wp_enqueue_script('datatables-bootstrap-js', 'https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js', array('jquery', 'datatables-js'), null, true);

		// DataTables Responsive
		wp_enqueue_style('datatables-responsive-css', 'https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css');
		wp_enqueue_script('datatables-responsive-js', 'https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js', array('jquery', 'datatables-js'), null, true);
		wp_enqueue_script('datatables-responsive-bootstrap-js', 'https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.min.js', array('jquery', 'datatables-js', 'datatables-responsive-js'), null, true);

        // Enqueue les styles personnalisés pour la page
        wp_enqueue_style('form-reach-custom-style', plugin_dir_url(__FILE__) . 'style/form-reach.css');
    });
}
add_action("admin_menu", "wp_add_custom_submenu");


// Callback pour afficher le contenu de la page Form Log
function form_log_callback() {
    // Vérifie si l'utilisateur a la capacité de gérer les options
    if (!current_user_can('manage_options')) {
        wp_die(__('Vous n’avez pas les permissions suffisantes pour accéder à cette page.'));
    }

    global $wpdb;
    $table = $wpdb->prefix . "form_history";

    // Traitement de la suppression
    if (isset($_POST['delete'], $_POST['_wpnonce']) && wp_verify_nonce($_POST['_wpnonce'], 'delete_entry')) {
        $entry_id = intval($_POST['delete']);
        $wpdb->delete($table, ['ID' => $entry_id]);
        echo '<div class="notice notice-success is-dismissible"><p>Entry deleted successfully.</p></div>';
    }

    $entries = $wpdb->get_results("SELECT * FROM $table ORDER BY created_at DESC");

    ?>

    <div class="wrap">
        <h1>Form Log</h1>
        <?php if (empty($entries)): ?>
            <h5 class="text-center">No message to display at the moment.</h5>
        <?php else: ?>
            <form method="post">
                <?php wp_nonce_field('delete_entry'); ?>
				<div class="table-responsive">
                <table class="table wp-list-table widefat fixed striped table-view-list posts" id="fr_form_history_table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Type</th>
                            <th scope="col">Content</th>
                            <th scope="col">Date</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($entries as $entry): ?>
                            <tr>
                                <td><?php echo esc_html($entry->ID); ?></td>
                                <td><?php switch ($entry->Type) {
												case "Mail":
													echo '<span class="dashicons dashicons-email"></span>';
													break;
												case "Whatsapp":
													echo '<span class="dashicons dashicons-whatsapp" style="color: #25D366;"></span>';
													break;
												default:
													echo 'Type undefined';
													break;} ?></td>
                                <td><?php echo esc_html($entry->Content); ?></td>
                                <td><?php echo esc_html($entry->created_at); ?></td>
                                <td>
                                    <button type="submit" name="delete" value="<?php echo esc_attr($entry->ID); ?>" class="button button-link-delete">Delete</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
				</div>
            </form>
        <?php endif; ?>
    </div>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
    if (window.innerWidth >= 768) {
        // Initialisation de DataTables avec des options spécifiques pour les écrans larges
        $('#fr_form_history_table').DataTable({
            responsive: true,
            order: [[3, "desc"]],
            columnDefs: [
                { width: "14px", targets: 0 }, // Pour ID
                { width: "30px", targets: 1 }, // Pour Type
                { width: "105px", targets: 3 }, // Pour Date
                { width: "40px", targets: 4 }, // Pour Delete
            ]
        });
    } else {
			$('#fr_form_history_table').DataTable({
				responsive: true,
				order: [[3, "desc"]],
				columnDefs: [
					{ responsivePriority: 1, targets: 3 }, // Donne la priorité à la colonne 'Date'
					{ responsivePriority: 2, targets: 4 }, // Puis à la colonne 'Delete'
					// Vous pouvez ajuster les priorités comme nécessaire
				]
			});
	}
		});
    </script>
	<?php
	add_flyout_menu();
}

function add_flyout_menu() {
	wp_enqueue_script('fontawesome', 'https://kit.fontawesome.com/85a869994b.js', array(), null, true);
		?>
			<!-- Flyout menu -->
			<button type="button" class="flyout-button"></button>

			<div class="flyout-menu" style="display:none;">
				<a style="transform: scale(0); opacity:0;" href="https://form-reach.com/suggestion" title="Suggestion" target="_blank"><i class="fa fa-lightbulb-o"  aria-hidden="true"></i></a>
			<a style="transform: scale(0); opacity:0;" href="https://form-reach.com/support" title="Support" target="_blank"><i class="fa fa-life-ring" aria-hidden="true"></i></a>
			<a style="transform: scale(0); opacity:0;" href="https://form-reach.com/documentation" title="Documentation" target="_blank"><i class="fa fa-book"  aria-hidden="true"></i></a>
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
	<?php
}

// Ajout du sous-menu Spam Protection
function wp_add_custom_submenu_reCAPTCHA() {
    $page_hook_suffix = add_submenu_page(
        "edit.php?post_type=form_reach",
        "Spam Protection",
        "Spam Protection",
        "manage_options",
        "spam-protection",
        "recaptcha_options_page"
    );

    // Utilise le hook de la page pour charger les scripts et styles seulement sur cette page
    add_action('admin_enqueue_scripts', function($hook) use ($page_hook_suffix) {
        if ($hook !== $page_hook_suffix) {
            return;
        }
        // Enqueue les styles personnalisés pour la page
        wp_enqueue_style('form-reach-custom-style', plugin_dir_url(__FILE__) . 'style/form-reach.css');
    });
}
add_action("admin_menu", "wp_add_custom_submenu_reCAPTCHA");

// Callback pour afficher le contenu de la page des options reCAPTCHA
function recaptcha_options_page() {
    ?>
    <div class="wrap">
        <h1>Google reCAPTCHA v3</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('recaptcha_options_group');
            do_settings_sections('spam-protection');
            ?>
            <div class="mb-3">
                <input type="checkbox" name="fr_recaptcha_switch" id="fr_recaptcha_switch" value="1" <?php checked(1, get_option('fr_recaptcha_switch')); ?> />
                <label for="fr_recaptcha_switch" class="form-label">Enable reCAPTCHA</label>
                <p class="text-secondary">Protection against spam and abuse.</p>
            </div>
            <div>
                <p>reCAPTCHA protects you against spam and other types of automated abuse. With the Form Reach reCAPTCHA integration module, you can block abusive form submissions from spam bots.</p>
                <p><strong><a href="https://www.google.com/recaptcha/about/" target="_blank">Learn more about reCAPTCHA v3</a></strong></p>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row"><label for="fr_key_site">Site key</label></th>
                        <td><input type="text" name="fr_key_site" id="fr_key_site" size="44" value="<?php echo esc_attr(get_option('fr_key_site')); ?>" /></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><label for="fr_key_secret">Secret key</label></th>
                        <td><input type="password" name="fr_key_secret" id="fr_key_secret" size="44" value="<?php echo esc_attr(get_option('fr_key_secret')); ?>" /></td>
                    </tr>
                </table>
                <?php submit_button(); ?>
            </div>
        </form>
    </div>
    <?php
}

// Enregistre les paramètres de reCAPTCHA
function register_recaptcha_settings() {
    register_setting('recaptcha_options_group', 'fr_recaptcha_switch');
    register_setting('recaptcha_options_group', 'fr_key_site');
    register_setting('recaptcha_options_group', 'fr_key_secret');
}
add_action('admin_init', 'register_recaptcha_settings');