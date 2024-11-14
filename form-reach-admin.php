<?php

if ( !defined('ABSPATH') ) exit;

// Register Custom Post Type
function formreach_post_type() {
    $formreach_labels = array(
        'name'                  => _x('Form Reach', 'Post Type General Name', 'form-reach-domain'),
        'singular_name'         => _x('Form', 'Post Type Singular Name', 'form-reach-domain'),
        'menu_name'             => __('Form Reach', 'form-reach-domain'),
        'name_admin_bar'        => __('Form Reach', 'form-reach-domain'),
        'add_new'               => __('Create New Form', 'form-reach-domain'),
        'add_new_item'          => __('Form Creation', 'form-reach-domain'),
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

    $formreach_args = array(
        'labels'             => $formreach_labels,
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

    register_post_type('formreach_post_type', $formreach_args);
}

add_action('init', 'formreach_post_type');

// Customization of the admin table
function formreach_smashing_columns($formreach_columns) {
    $formreach_newColumns = array(
        'cb' => $formreach_columns['cb'],
        'type' => __('Type', 'form-reach-domain'),
        'title' => __('Title', 'form-reach-domain'),
        'shortcode' => __('Shortcode', 'form-reach-domain'),
        'author' => __('Author', 'form-reach-domain'),
        'date' => __('Date', 'form-reach-domain'),
    );
    return $formreach_newColumns;
}
add_filter('manage_formreach_post_type_posts_columns', 'formreach_smashing_columns');

// Adding the shortcode to the Administrator custom table
function formreach_shortcode_column($formreach_column, $formreach_post_id) {
    if ('shortcode' === $formreach_column) {
        echo '<input type="text" class="form-control" style="background-color: transparent; border: none;" readonly="readonly" onfocus="this.select()" value=\'[formreach_form id="' . esc_attr($formreach_post_id) . '"]\'>';
    }
}

// Handling display of custom column content
function formreach_custom_column_content($formreach_column, $formreach_post_id) {
    if ($formreach_column === 'type') {
        $formreach_formType = get_post_meta($formreach_post_id, 'formreach_whatsapp_switch', true); 

        switch ($formreach_formType) {
            case "0":
                echo '<i class="fa fa-envelope mx-2" style="color: #2271b1 ; font-size: 27px;"></i>';
                break;
            case "1":
                echo '<i class="fa fa-whatsapp mx-2" style="color: #25d366; font-size: 27px;"></i>';
                break;
            default:
                echo esc_html__('Not yet defined', 'form-reach-domain');
                break;
        }
    }
}

add_action('manage_formreach_post_type_posts_custom_column', 'formreach_custom_column_content', 10, 2);
add_action('manage_formreach_post_type_posts_custom_column', 'formreach_shortcode_column', 10, 2);

// Ajouter les styles personnalisés pour l'administration
function formreach_enqueue_admin_styles() {
    wp_enqueue_style(
        'formreach-admin-css',
        plugin_dir_url(__FILE__) . 'style/form-reach-admin.css', 
        array(), 
        '1.0'
    );
}

add_action('admin_enqueue_scripts', 'formreach_enqueue_admin_styles');

/**
 * Optimizes admin column widths and hides certain elements via CSS.
 */
function formreach_optimize_admin_columns() {
    $formreach_screen = get_current_screen();
    if ( $formreach_screen->id == 'edit-formreach_post_type' ) {
        wp_enqueue_style('form-reach-custom-style', plugin_dir_url(__FILE__) . 'style/form-reach.css', array(), '1.0.0');
		
		formreach_add_flyout_menu();
	}
}
add_action('admin_footer', 'formreach_optimize_admin_columns');

/**
 * Modifies the list row actions for posts.
 *
 * @param array $actions An array of row action links.
 * @param WP_Post $post The post object.
 * @return array The modified actions.post_type
 */
function formreach_modify_list_row_actions($actions, $formreach_post) {
    unset($actions['view']);
    return $actions;
}
add_filter('post_row_actions', 'formreach_modify_list_row_actions', 10, 2);

function formreach_remove_metaboxe() {
    remove_meta_box('slugdiv', 'formreach_post_type', 'normal'); // Removing the Slug metabox
}
add_action('admin_menu','formreach_remove_metaboxe');

// Customization of the edit page
function formreach_register_metabox_post_type( $formreach_post ) {
	$formreach_post_id = filter_input(INPUT_GET, 'post', FILTER_VALIDATE_INT, array('options' => array('default' => 0, 'min_range' => 1)));

	$formreach_post_id = absint( $formreach_post_id );

	$formreach_shortcode = esc_attr( '[formreach_form id="' . $formreach_post_id . '"]' );

	$formreach_copyInstruction = __('Copy this shortcode and paste it into your post, page, or text widget content: ', 'form-reach-domain');

	$formreach_finalShortcode = '<div class="alert alert-secondary align-items-center">';
	$formreach_finalShortcode .= '<label>';
	$formreach_finalShortcode .= htmlspecialchars($formreach_copyInstruction, ENT_QUOTES, 'UTF-8');
	$formreach_finalShortcode .= '<input type="text" readonly="readonly" onfocus="this.select()" value="' . $formreach_shortcode . '">';
	$formreach_finalShortcode .= '</label>';
	$formreach_finalShortcode .= '</div>';

	add_meta_box(
        'formreach_metabox',
        $formreach_finalShortcode, 
        'formreach_register_metabox_callback', 
        'formreach_post_type',
    );
}

add_action('add_meta_boxes','formreach_register_metabox_post_type');

function formreach_register_metabox_callback($formreach_post) {
	
	if ('formreach_post_type' !== $formreach_post->post_type || !current_user_can('edit_post', $formreach_post->ID)) {
        return;
    }

	$formreach_default_meta_values = [
		'formreach_email_admin_to' => get_option('admin_email'),
		'formreach_email_admin_from' => __("Form Reach", "form-reach-domain"),
		'formreach_email_admin_subject' => __("User Message", "form-reach-domain"),
		'formreach_email_user_to' => __("[email]", "form-reach-domain"),
		'formreach_email_user_from' => "Form Reach",
		'formreach_email_user_subject' => "Form Reach",
		'formreach_email_submit' => __("Send", "form-reach-domain"),
		'formreach_whatsapp_submit' => __("WhatsApp", "form-reach-domain"),
		'formreach_email_submit_color' => "#0d6efd",
		'formreach_whatsapp_submit_color' => "#198754",
		'formreach_email_text_color' => "#ffffff",
		'formreach_whatsapp_text_color' => "#ffffff",
		'formreach_email_admin_content' => __("Name: [name]\nEmail: [email]\nMessage: [message]", "form-reach-domain"),
		'formreach_email_user_content' => __("Thank you for reaching out to us.\n\nWe acknowledge receipt of your message and assure you that we will respond as soon as possible.", "form-reach-domain"),
		'formreach_email_success' => __("The form has been successfully submitted.", "form-reach-domain"),
		'formreach_email_error' => __("The form could not be submitted due to an error. Please try again.", "form-reach-domain"),
		'formreach_whatsapp_success' => __("The message has been successfully submitted. Click on the 'Continue to Conversation' button.", "form-reach-domain"),
		'formreach_whatsapp_error' => __("The message could not be submitted due to an error. Please try again.", "form-reach-domain"),
		'formreach_email_form_content' => '[formreach_input type="text" label="' . __("Name", "form-reach-domain") . '" name="name" required="required" placeholder="' . __("Enter your name", "form-reach-domain") . '"]' . "\n\n" . '[formreach_input type="email" label="' . __("Email address", "form-reach-domain") . '" name="email" required="required" placeholder="' . __("Enter your email", "form-reach-domain") . '"]' . "\n\n" . '[formreach_input type="textarea" rows="10" label="' . __("Message", "form-reach-domain") . '" name="message" required="required" placeholder="' . __("Enter your message", "form-reach-domain") . '"]',
		'formreach_whatsapp_form_content' => '[formreach_input type="text" label="' . __("Name", "form-reach-domain") . '" name="name" required="required" placeholder="' . __("Enter your name", "form-reach-domain") . '"]' . "\n\n" . '[formreach_input type="textarea" rows="10" label="' . __("Message", "form-reach-domain") . '" name="message" required="required" placeholder="' . __("Enter your message", "form-reach-domain") . '"]',
		'formreach_whatsapp_switch' => 0,
		'formreach_user_email_switch' => 0,
	];

    foreach ($formreach_default_meta_values as $formreach_meta_key => $formreach_meta_value) {
        if (!isset($formreach_stored_meta[$formreach_meta_key]) || empty($formreach_stored_meta[$formreach_meta_key])) {
            add_post_meta($formreach_post->ID, $formreach_meta_key, $formreach_meta_value, true);
        }
    }

    $formreach_stored_meta = get_post_meta( $formreach_post ->ID);

    include 'form-reach-modal.php';
}

// Organize metaboxes in the "normal" column for the custom post type 'formreach_post_type'
add_filter('get_user_option_meta-box-order_formreach_post_type', 'formreach_one_column_for_all', 10);
function formreach_one_column_for_all($option) {
    // Define the order of metaboxes in the 'normal' column
    return ['normal' => 'formreach_metabox,slugdiv,trackbacksdiv,tagsdiv-post_tag,categorydiv,postimagediv,postcustom,commentstatusdiv,authordiv'];
}

// Add 'submitdiv' at the bottom of the "normal" column
add_filter('get_user_option_meta-box-order_formreach_post_type', 'formreach_submitdiv_at_bottom', 999);
function formreach_submitdiv_at_bottom($formreach_result) {
    $formreach_result['normal'] .= ',submitdiv';
    return $formreach_result;
}

// Restrict screen options to a single column layout for 'formreach_post_type'
add_filter('screen_layout_columns', 'formreach_one_column_on_screen_options');
function formreach_one_column_on_screen_options($formreach_columns) {
    $formreach_columns['formreach_post_type'] = 1;
    return $formreach_columns;
}

// Force a single-column layout, overriding user preferences
add_filter('get_user_option_screen_layout_formreach_post_type', 'formreach_one_column_layout');
function formreach_one_column_layout() {
    return 1;
}

add_action('admin_enqueue_scripts', 'formreach_enqueue_bootstrap');

function formreach_enqueue_bootstrap($formreach_hook) {
  if ($formreach_hook == 'post_type=formreach_post_type') {
    wp_enqueue_style('bootstrap',  plugin_dir_url(__FILE__) . '/assets/bootstrap/bootstrap.min.css', array(), '5.2.2');
    wp_enqueue_script('bootstrap',  plugin_dir_url(__FILE__) . '/assets/bootstrap/bootstrap.min.js', array('jquery'), '5.2.2', true);
  }
}

// Tag generator for shortcodes - form
class formreach_id {
    public static function formreach_counter() {
        static $formreach_counter = 0;
        ++$formreach_counter;
        return $formreach_counter;
    }
}

function formreach_input_type($formreach_atts) {
	global $formreach_is_form_reach_context;
	
    if (!isset($formreach_is_form_reach_context) || !$formreach_is_form_reach_context) {
        return '';
    }
	
    $formreach_id_auto = formreach_id::formreach_counter();
    
    $formreach_atts = shortcode_atts(array(
        'type' => 'text',
        'name' => 'default',
        'id' => $formreach_id_auto,
        'placeholder' => '',
        'required' => false,
        'label' => '',
        'class' => '',
        'value' => '',
        'cols' => null,
        'rows' => null,
    ), $formreach_atts, 'input');

    $formreach_html = '<div class="mb-3 mt-3">';
    if (!empty($formreach_atts['label'])) {
        $formreach_html .= '<label class="form-label" for="' . esc_attr($formreach_atts['name']) . '_' . esc_attr($formreach_atts['id']) . '">' . esc_html($formreach_atts['label']) . '</label>';
    }
    
    if ($formreach_atts['type'] === "textarea") {
        $formreach_html .= '<textarea data-type="textarea" class="form-control ' . esc_attr($formreach_atts['class']) . '" id="' . esc_attr($formreach_atts['name']) . '_' . esc_attr($formreach_atts['id']) . '" name="' . esc_attr($formreach_atts['name']) . '" placeholder="' . esc_attr($formreach_atts['placeholder']) . '"' . ($formreach_atts['required'] ? ' required' : '') . ' cols="' . esc_attr($formreach_atts['cols']) . '" rows="' . esc_attr($formreach_atts['rows']) . '">' . esc_html($formreach_atts['value']) . '</textarea>';
    } elseif ($formreach_atts['type'] === "email") {
        $formreach_html .= '<input type="' . esc_attr($formreach_atts['type']) . '" data-type="email" class="form-control ' . esc_attr($formreach_atts['class']) . '" id="' . esc_attr($formreach_atts['name']) . '_' . esc_attr($formreach_atts['id']) . '" name="' . esc_attr($formreach_atts['name']) . '" placeholder="' . esc_attr($formreach_atts['placeholder']) . '"' . ($formreach_atts['required'] ? ' required' : '') . ' value="' . esc_attr($formreach_atts['value']) . '"/>';
        $formreach_html .= '<div class="invalid-feedback" id="emailFeedback" style="display: none;">' . esc_html__('Please enter a valid email address', 'form-reach-domain') . '</div>';
    } else {
        $formreach_html .= '<input type="' . esc_attr($formreach_atts['type']) . '" class="form-control ' . esc_attr($formreach_atts['class']) . '" id="' . esc_attr($formreach_atts['name']) . '_' . esc_attr($formreach_atts['id']) . '" name="' . esc_attr($formreach_atts['name']) . '" placeholder="' . esc_attr($formreach_atts['placeholder']) . '"' . ($formreach_atts['required'] ? ' required' : '') . ' value="' . esc_attr($formreach_atts['value']) . '"/>';
    }        
    
    $formreach_html .= '</div>';
    
    return $formreach_html;
}
add_shortcode('formreach_input', 'formreach_input_type');

function formreach_add_nonce_to_post() {
    global $post;

    if ('formreach_post_type' === $post->post_type) {
        wp_nonce_field('formreach_save_post_action', 'formreach_save_post_nonce');
    }
}
add_action('post_submitbox_misc_actions', 'formreach_add_nonce_to_post');

// Meta values db
function formreach_meta_save($formreach_post_id) {

    if (!isset($_POST['formreach_save_post_nonce'])) {
        return;
    }
    if ( ! isset( $_POST['formreach_save_post_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash ( $_POST['formreach_save_post_nonce'] ) ) , 'formreach_save_post_action' ) ){
        return;
    }
    if (!current_user_can('edit_post', $formreach_post_id)) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    $formreach_fields = [
        'formreach_email_admin_to' => 'email',
        'formreach_email_admin_from' => 'text',
        'formreach_email_admin_subject' => 'text',
        'formreach_email_admin_content' => 'textarea',
        'formreach_email_user_to' => 'text',
        'formreach_email_user_from' => 'text',
        'formreach_email_user_subject' => 'text',
        'formreach_email_user_content' => 'textarea',
        'formreach_email_submit' => 'text',
        'formreach_whatsapp_submit' => 'text',
        'formreach_email_submit_color' => 'text',
        'formreach_whatsapp_submit_color' => 'text',
        'formreach_email_text_color' => 'text',
        'formreach_whatsapp_text_color' => 'text',
        'formreach_email_success' => 'text',
        'formreach_email_error' => 'text',
        'formreach_whatsapp_success' => 'text',
        'formreach_whatsapp_error' => 'text',
        'formreach_email_form_content' => 'textarea',
        'formreach_whatsapp_form_content' => 'textarea',
        'formreach_whatsapp_tel' => 'tel',
        'formreach_whatsapp_flag' => 'text',
        'formreach_whatsapp_tel_international' => 'tel',
        'formreach_whatsapp_switch' => 'checkbox',
        'formreach_user_email_switch' => 'checkbox',
    ];
    

    foreach ($formreach_fields as $formreach_field => $formreach_sanitize) {
		if (isset($_POST[$formreach_field])) {
			$formreach_value = wp_kses_post(wp_unslash($_POST[$formreach_field]));

			switch ($formreach_sanitize) {
				case 'email':
					$formreach_value = sanitize_email($formreach_value);
					break;
				case 'tel':
					$formreach_value = preg_replace('/[^0-9+]/', '', $formreach_value);
					break;
				case 'textarea':
					$formreach_value = wp_kses_post($formreach_value);
					break;
				case 'checkbox':
					$formreach_value = "1";
					break;
				case 'text':
				default:
					$formreach_value = sanitize_text_field($formreach_value);
					break;
			}

			update_post_meta($formreach_post_id, $formreach_field, $formreach_value);
		} elseif ($formreach_sanitize === 'checkbox') {
			update_post_meta($formreach_post_id, $formreach_field, "0");
		}
	}    
}

add_action('save_post_formreach_post_type','formreach_meta_save');

function formreach_add_custom_submenu() {
	$formreach_page_hook_suffix = add_submenu_page(
		"edit.php?post_type=formreach_post_type",
		__("Form Submissions", "form-reach-domain"), 
		__("Form Submissions", "form-reach-domain"),
		"manage_options",
		"form-log",
		"formreach_form_log_callback"
	);

    add_action('admin_enqueue_scripts', function($formreach_hook) use ($formreach_page_hook_suffix) {
        if ($formreach_hook !== $formreach_page_hook_suffix) {
            return;
        }

		// DataTables Basic
		wp_enqueue_style('datatables-css', plugin_dir_url(__FILE__) . 'assets/DataTables/dataTables.bootstrap5.min.css', array(), '1.13.4');
		wp_enqueue_script('datatables-js', plugin_dir_url(__FILE__) . 'assets/DataTables/jquery.dataTables.min.js', array('jquery'), '1.13.4', true);
		wp_enqueue_script('datatables-bootstrap-js', plugin_dir_url(__FILE__) . 'assets/DataTables/dataTables.bootstrap5.min.js', array('jquery', 'datatables-js'), '1.13.4', true);

		// DataTables Responsive
		wp_enqueue_style('datatables-responsive-css', plugin_dir_url(__FILE__) . 'assets/DataTables/responsive.bootstrap5.min.css', array(), '2.2.9');
		wp_enqueue_script('datatables-responsive-js', plugin_dir_url(__FILE__) . 'assets/DataTables/dataTables.responsive.min.js', array('jquery', 'datatables-js'), '2.2.9', true);
		wp_enqueue_script('datatables-responsive-bootstrap-js', plugin_dir_url(__FILE__) . 'assets/DataTables/responsive.bootstrap5.min.js', array('jquery', 'datatables-js', 'datatables-responsive-js', 'bootstrap'), '2.2.9', true);

        wp_enqueue_script('form-reach-submission-script', plugin_dir_url(__FILE__) . 'js/form-reach-submissions.js', array(), '1.0.0', true);
        wp_enqueue_style('form-reach-custom-style', plugin_dir_url(__FILE__) . 'style/form-reach.css', array(), '1.0.0');
    });
}
add_action("admin_menu", "formreach_add_custom_submenu");


function formreach_form_log_callback() {
	if (!current_user_can('manage_options')) {
		wp_die(esc_html__('You do not have sufficient permissions to access this page.', 'form-reach-domain'));
	}

	 global $wpdb;
    $formreach_table = $wpdb->prefix . "formreach_form_history";

    if (isset($_POST['delete'])) {
        if (isset($_POST['_wpnonce']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['_wpnonce'])), 'delete_entry')) {
            $formreach_entry_id = intval($_POST['delete']);

            $deleted = $wpdb->delete($formreach_table, ['ID' => $formreach_entry_id]); // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching

            if ($deleted) {
                echo '<div class="notice notice-success is-dismissible"><p>Entry deleted successfully.</p></div>';
            } else {
                echo '<div class="notice notice-error is-dismissible"><p>Failed to delete the entry.</p></div>';
            }
        } else {
            echo '<div class="notice notice-error is-dismissible"><p>Invalid request. Please try again.</p></div>';
        }
    }

    $formreach_entries = $wpdb->get_results("SELECT * FROM $formreach_table ORDER BY created_at DESC"); // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching, WordPress.DB.PreparedSQL.InterpolatedNotPrepared

    ?>

    <div class="wrap">
        <h1>Form Submissions</h1>
        <?php if (empty($formreach_entries)): ?>
			<h5 class="text-center"><?php echo esc_html(__('No form has been sent yet !', 'form-reach-domain')); ?></h5>
        <?php else: ?>
            <form method="post">
                <?php wp_nonce_field('delete_entry'); ?>
				<div class="table-responsive">
                <table class="table wp-list-table widefat fixed striped table-view-list posts" id="formreach_form_history_table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col"><?php echo esc_html(__('Type', 'form-reach-domain')); ?></th>
                            <th scope="col"><?php echo esc_html(__('Content', 'form-reach-domain')); ?></th>
                            <th scope="col"><?php echo esc_html(__('Date', 'form-reach-domain')); ?></th>
                            <th scope="col"><?php echo esc_html(__('Delete', 'form-reach-domain')); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($formreach_entries as $formreach_entry): ?>
                            <tr>
                                <td><?php echo esc_html($formreach_entry->ID); ?></td>
                                <td><?php switch ($formreach_entry->Type) {
                                    case "Mail":
                                        echo '<i class="fa fa-envelope mx-2" style="color:#2271b1; font-size: 27px;"></i>';
                                        break;
                                    case "Whatsapp":
                                        echo '<i class="fa fa-whatsapp mx-2" style="color:#25d366; font-size: 27px;"></i>';
                                        break;
                                    default:
                                        echo 'Type undefined';
                                        break;} ?></td>
								<td><?php echo wp_kses_post($formreach_entry->Content); ?></td>
								<td data-order="<?php echo esc_attr(strtotime($formreach_entry->created_at)); ?>">
                                    <?php
                                    $formreach_local_date = get_date_from_gmt($formreach_entry->created_at);
									echo esc_html(date_i18n(get_option('date_format') . ' ' . get_option('time_format'), strtotime($formreach_local_date)));?>
                                </td>
                                <td>
                                    <button type="submit" name="delete" value="<?php echo esc_attr($formreach_entry->ID); ?>" class="button button-link-delete">Delete</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
				</div>
            </form>
        <?php endif; ?>
    </div>
	<?php
	formreach_add_flyout_menu();
}

function formreach_add_flyout_menu() {
	wp_enqueue_script('fontawesome', plugin_dir_url(__FILE__) . 'assets/fontawesome/85a869994b.js', array(), '1.0.0', true);
    wp_enqueue_script('formreach-flyout', plugin_dir_url(__FILE__) . 'js/form-reach-flyout.js', array(), '1.0.0', true);
		?>
			<!-- Flyout menu -->
			<button type="button" class="formreach_flyout-button"></button>

			<div class="formreach_flyout-menu" style="display:none;">
                <a style="transform: scale(0); opacity:0;" href="https://form-reach.com/suggestion" title="Suggestion" target="_blank"><i class="fa fa-lightbulb-o"  aria-hidden="true"></i></a>
                <a style="transform: scale(0); opacity:0;" href="https://form-reach.com/support" title="Support" target="_blank"><i class="fa fa-life-ring" aria-hidden="true"></i></a>
                <a style="transform: scale(0); opacity:0;" href="https://form-reach.com/documentation" title="Documentation" target="_blank"><i class="fa fa-book"  aria-hidden="true"></i></a>
			</div>
	<?php
}

// Add Anti-Spam Settings submenu
function formreach_add_custom_submenu_reCAPTCHA() {
    $formreach_page_hook_suffix = add_submenu_page(
        "edit.php?post_type=formreach_post_type",
        "Anti-Spam Settings",
        "Anti-Spam Settings",
        "manage_options",
        "anti-spam-settings",
        "formreach_recaptcha_options_page"
    );

    add_action('admin_enqueue_scripts', function($formreach_hook) use ($formreach_page_hook_suffix) {
        if ($formreach_hook !== $formreach_page_hook_suffix) {
            return;
        }
        wp_enqueue_style('form-reach-custom-style', plugin_dir_url(__FILE__) . 'style/form-reach.css', array(), '1.0.0');
        wp_enqueue_script('form-reach-custom-style', plugin_dir_url(__FILE__) . 'js/form-reach-spam-settings.js', array(), '1.0.0', true);
    });
}
add_action("admin_menu", "formreach_add_custom_submenu_reCAPTCHA");

function formreach_recaptcha_options_page() {
    ?>
    <div class="wrap">
        <h1>Google reCAPTCHA v3</h1>
        <form id="recaptcha-form" method="post"  action="options.php">
            <?php
            settings_fields('formreach_recaptcha_options_group');
            do_settings_sections('anti-spam-settings');
            ?>
            <div class="mb-3">
                <input type="checkbox" name="formreach_recaptcha_switch" id="formreach_recaptcha_switch" value="1" <?php checked(1, get_option('formreach_recaptcha_switch')); ?> />
                <label for="formreach_recaptcha_switch" class="form-label">Enable reCAPTCHA</label>
                <p class="text-secondary"><?php echo esc_html(__('Protection against spam and abuse.', 'form-reach-domain')); ?></p>
            </div>
            <div>
                <p><?php echo esc_html(__('reCAPTCHA protects you against spam and other types of automated abuse. With the Form Reach reCAPTCHA integration module, you can block abusive form submissions from spam bots.', 'form-reach-domain')); ?></p>
                <p><strong><a href="https://www.google.com/recaptcha/about/" target="_blank"><?php echo esc_html(__('Learn more about reCAPTCHA v3', 'form-reach-domain')); ?></a></strong></p>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row"><label for="formreach_key_site"><?php echo esc_html(__('Site key', 'form-reach-domain')); ?></label></th>
                        <td><input type="text" name="formreach_key_site" id="formreach_key_site" size="44" value="<?php echo esc_attr(get_option('formreach_key_site')); ?>" /></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><label for="formreach_key_secret"><?php echo esc_html(__('Secret key', 'form-reach-domain')); ?></label></th>
                        <td><input type="password" name="formreach_key_secret" id="formreach_key_secret" size="44" value="<?php echo esc_attr(get_option('formreach_key_secret')); ?>" /></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><label for="formreach_recaptcha_score"><?php echo esc_html(__('reCAPTCHA Score', 'form-reach-domain')); ?></label></th>
                        <td><input type="number" name="formreach_recaptcha_score" id="formreach_recaptcha_score" min="0" max="1" step="0.1" value="<?php echo esc_attr(get_option('formreach_recaptcha_score')); ?>" /></td>
                    </tr>
                </table>
                <?php submit_button(); ?>
            </div>
        </form>
    </div>
    <?php formreach_add_flyout_menu(); ?>
<?php
}

function formreach_register_recaptcha_settings() {
    register_setting('formreach_recaptcha_options_group', 'formreach_recaptcha_switch');
    register_setting('formreach_recaptcha_options_group', 'formreach_key_site');
    register_setting('formreach_recaptcha_options_group', 'formreach_key_secret');
    register_setting('formreach_recaptcha_options_group', 'formreach_recaptcha_score');
}
add_action('admin_init', 'formreach_register_recaptcha_settings');