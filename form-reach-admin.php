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
        'add_new_item'          => __('Add Form', 'form-reach-domain'),
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
        'publicly_queryable' => false,
        'exclude_from_search' => true,
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
                echo '<svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 26 26" fill="none"><g clip-path="url(#clip0_660_96)"><path d="M24.9983 9.48608C25.1887 9.33472 25.4719 9.47632 25.4719 9.71558V19.7009C25.4719 20.9949 24.4221 22.0447 23.1282 22.0447H2.81567C1.52173 22.0447 0.471924 20.9949 0.471924 19.7009V9.72046C0.471924 9.47632 0.750244 9.3396 0.945557 9.49097C2.03931 10.3406 3.4895 11.4197 8.46997 15.0378C9.50024 15.7898 11.2385 17.3718 12.9719 17.3621C14.7151 17.3767 16.4875 15.7605 17.4788 15.0378C22.4592 11.4197 23.9045 10.3357 24.9983 9.48608ZM12.9719 15.7947C14.1047 15.8142 15.7356 14.3689 16.5559 13.7732C23.0354 9.07105 23.5286 8.66089 25.0227 7.48901C25.3059 7.26929 25.4719 6.92749 25.4719 6.56616V5.63843C25.4719 4.34448 24.4221 3.29468 23.1282 3.29468H2.81567C1.52173 3.29468 0.471924 4.34448 0.471924 5.63843V6.56616C0.471924 6.92749 0.637939 7.2644 0.921143 7.48901C2.41528 8.65601 2.90845 9.07105 9.38794 13.7732C10.2083 14.3689 11.8391 15.8142 12.9719 15.7947Z" fill="#2271b1"/></g><defs><clipPath id="clip0_660_96"><rect width="25" height="25" fill="white" transform="translate(0.471924 0.169678)"/></clipPath></defs>
                    </svg>';
                break;
            case "1":
                echo '<svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 27 27" fill="none"><path d="M21.774 5.12051C19.5645 2.90566 16.6219 1.6875 13.4947 1.6875C7.04004 1.6875 1.7877 6.93984 1.7877 13.3945C1.7877 15.4564 2.32559 17.4709 3.34863 19.248L1.6875 25.3125L7.89434 23.683C9.60293 24.6164 11.5277 25.1068 13.4895 25.1068H13.4947C19.9441 25.1068 25.3125 19.8545 25.3125 13.3998C25.3125 10.2727 23.9836 7.33535 21.774 5.12051ZM13.4947 23.1346C11.7439 23.1346 10.0301 22.6652 8.53769 21.7793L8.18437 21.5684L4.50352 22.5334L5.48438 18.9422L5.25234 18.573C4.27676 17.0227 3.76523 15.235 3.76523 13.3945C3.76523 8.03145 8.13164 3.66504 13.5 3.66504C16.0998 3.66504 18.5414 4.67754 20.3766 6.51797C22.2117 8.3584 23.3402 10.8 23.335 13.3998C23.335 18.7682 18.8578 23.1346 13.4947 23.1346ZM18.8314 15.8467C18.5414 15.699 17.1018 14.9924 16.8328 14.8975C16.5639 14.7973 16.3688 14.7498 16.1736 15.0451C15.9785 15.3404 15.4195 15.9943 15.2455 16.1947C15.0768 16.3898 14.9027 16.4162 14.6127 16.2686C12.8936 15.409 11.765 14.734 10.6313 12.7881C10.3307 12.2713 10.9318 12.3082 11.4908 11.1902C11.5857 10.9951 11.5383 10.8264 11.4645 10.6787C11.3906 10.5311 10.8053 9.09141 10.5627 8.50605C10.3254 7.93652 10.0828 8.01563 9.90352 8.00508C9.73477 7.99453 9.53965 7.99453 9.34453 7.99453C9.14941 7.99453 8.83301 8.06836 8.56406 8.3584C8.29512 8.65371 7.54102 9.36035 7.54102 10.8C7.54102 12.2396 8.59043 13.6318 8.73281 13.827C8.88047 14.0221 10.7947 16.9752 13.732 18.2461C15.5883 19.0477 16.316 19.1162 17.2441 18.9791C17.8084 18.8947 18.9738 18.2725 19.2164 17.5869C19.459 16.9014 19.459 16.316 19.3852 16.1947C19.3166 16.0629 19.1215 15.9891 18.8314 15.8467Z" fill="#25d366"/>
                    </svg>';
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
        plugin_dir_url(__FILE__) . 'assets/css/form-reach-admin.min.css', 
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
        wp_enqueue_style('form-reach-custom-style', plugin_dir_url(__FILE__) . 'assets/css/form-reach.css', array(), '1.0.0');
		
		formreach_add_flyout_menu();
	}
}
add_action('admin_footer', 'formreach_optimize_admin_columns');

function formreach_always_publish( $data, $postarr ) {
    if ( 'formreach_post_type' === $data['post_type'] && !in_array( $data['post_status'], array('auto-draft', 'trash') ) ) {
        $data['post_status'] = 'publish';
    }
    return $data;
}
add_filter( 'wp_insert_post_data', 'formreach_always_publish', 10, 2 );

function formreach_remove_quick_edit($actions, $post) {
    if (get_post_type($post) === 'formreach_post_type') {
        if (isset($actions['inline hide-if-no-js'])) {
            unset($actions['inline hide-if-no-js']);
        }
    }

    return $actions;
}
add_filter('post_row_actions', 'formreach_remove_quick_edit', 10, 2);

function formreach_remove_metaboxe() {
    remove_meta_box('slugdiv', 'form_reach_post_type', 'normal');
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
    
        wp_enqueue_style('datatables-css', plugin_dir_url(__FILE__) . 'assets/css/dataTables.bootstrap5.min.css', array(), '2.1.18');
        wp_enqueue_script('datatables-js', plugin_dir_url(__FILE__) . 'assets/js/bundle-datatables.min.js', array('jquery'), '2.1.18', true);

        wp_enqueue_style('form-reach-style', plugin_dir_url(__FILE__) . 'assets/css/form-reach.min.css', array(), '1.0.0');
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
                <table class="table wp-list-table widefat fixed striped table-view-list posts display nowrap" id="formreach_form_history_table">
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
                                        echo '<svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 26 26" fill="none"><g clip-path="url(#clip0_660_96)"><path d="M24.9983 9.48608C25.1887 9.33472 25.4719 9.47632 25.4719 9.71558V19.7009C25.4719 20.9949 24.4221 22.0447 23.1282 22.0447H2.81567C1.52173 22.0447 0.471924 20.9949 0.471924 19.7009V9.72046C0.471924 9.47632 0.750244 9.3396 0.945557 9.49097C2.03931 10.3406 3.4895 11.4197 8.46997 15.0378C9.50024 15.7898 11.2385 17.3718 12.9719 17.3621C14.7151 17.3767 16.4875 15.7605 17.4788 15.0378C22.4592 11.4197 23.9045 10.3357 24.9983 9.48608ZM12.9719 15.7947C14.1047 15.8142 15.7356 14.3689 16.5559 13.7732C23.0354 9.07105 23.5286 8.66089 25.0227 7.48901C25.3059 7.26929 25.4719 6.92749 25.4719 6.56616V5.63843C25.4719 4.34448 24.4221 3.29468 23.1282 3.29468H2.81567C1.52173 3.29468 0.471924 4.34448 0.471924 5.63843V6.56616C0.471924 6.92749 0.637939 7.2644 0.921143 7.48901C2.41528 8.65601 2.90845 9.07105 9.38794 13.7732C10.2083 14.3689 11.8391 15.8142 12.9719 15.7947Z" fill="#2271b1"/></g><defs><clipPath id="clip0_660_96"><rect width="25" height="25" fill="white" transform="translate(0.471924 0.169678)"/></clipPath></defs>
                                            </svg>';
                                        break;
                                    case "Whatsapp":
                                        echo '<svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 27 27" fill="none"><path d="M21.774 5.12051C19.5645 2.90566 16.6219 1.6875 13.4947 1.6875C7.04004 1.6875 1.7877 6.93984 1.7877 13.3945C1.7877 15.4564 2.32559 17.4709 3.34863 19.248L1.6875 25.3125L7.89434 23.683C9.60293 24.6164 11.5277 25.1068 13.4895 25.1068H13.4947C19.9441 25.1068 25.3125 19.8545 25.3125 13.3998C25.3125 10.2727 23.9836 7.33535 21.774 5.12051ZM13.4947 23.1346C11.7439 23.1346 10.0301 22.6652 8.53769 21.7793L8.18437 21.5684L4.50352 22.5334L5.48438 18.9422L5.25234 18.573C4.27676 17.0227 3.76523 15.235 3.76523 13.3945C3.76523 8.03145 8.13164 3.66504 13.5 3.66504C16.0998 3.66504 18.5414 4.67754 20.3766 6.51797C22.2117 8.3584 23.3402 10.8 23.335 13.3998C23.335 18.7682 18.8578 23.1346 13.4947 23.1346ZM18.8314 15.8467C18.5414 15.699 17.1018 14.9924 16.8328 14.8975C16.5639 14.7973 16.3688 14.7498 16.1736 15.0451C15.9785 15.3404 15.4195 15.9943 15.2455 16.1947C15.0768 16.3898 14.9027 16.4162 14.6127 16.2686C12.8936 15.409 11.765 14.734 10.6313 12.7881C10.3307 12.2713 10.9318 12.3082 11.4908 11.1902C11.5857 10.9951 11.5383 10.8264 11.4645 10.6787C11.3906 10.5311 10.8053 9.09141 10.5627 8.50605C10.3254 7.93652 10.0828 8.01563 9.90352 8.00508C9.73477 7.99453 9.53965 7.99453 9.34453 7.99453C9.14941 7.99453 8.83301 8.06836 8.56406 8.3584C8.29512 8.65371 7.54102 9.36035 7.54102 10.8C7.54102 12.2396 8.59043 13.6318 8.73281 13.827C8.88047 14.0221 10.7947 16.9752 13.732 18.2461C15.5883 19.0477 16.316 19.1162 17.2441 18.9791C17.8084 18.8947 18.9738 18.2725 19.2164 17.5869C19.459 16.9014 19.459 16.316 19.3852 16.1947C19.3166 16.0629 19.1215 15.9891 18.8314 15.8467Z" fill="#25d366"/>
                                            </svg>';
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
    wp_enqueue_script('formreach-flyout', plugin_dir_url(__FILE__) . 'js/form-reach-flyout.js', array(), '1.0.0', true);
		?>
			<!-- Flyout menu -->
			<button type="button" class="formreach_flyout-button"></button>

			<div class="formreach_flyout-menu" style="display:none;">
                <a style="transform: scale(0); opacity:0;" href="https://form-reach.com/suggestion" title="Suggestion" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 25 25" fill="none"><g clip-path="url(#clip0_661_88)"><path d="M8.59668 22.1851C8.59717 22.4922 8.68799 22.793 8.8584 23.0489L9.69287 24.3033C9.83542 24.5177 10.0288 24.6936 10.2557 24.8152C10.4827 24.9369 10.7362 25.0005 10.9937 25.0005H14.0068C14.2643 25.0005 14.5178 24.9369 14.7448 24.8152C14.9717 24.6936 15.1651 24.5177 15.3076 24.3033L16.1421 23.0489C16.3124 22.793 16.4035 22.4925 16.4038 22.1851L16.4058 20.3125H8.59424L8.59668 22.1851ZM3.90625 8.59379C3.90625 10.7603 4.70947 12.7369 6.0332 14.2471C6.83984 15.1675 8.10156 17.0904 8.58252 18.7124C8.58447 18.7251 8.58594 18.7378 8.58789 18.7505H16.4121C16.4141 18.7378 16.4155 18.7256 16.4175 18.7124C16.8984 17.0904 18.1602 15.1675 18.9668 14.2471C20.2905 12.7369 21.0938 10.7603 21.0938 8.59379C21.0938 3.83842 17.2319 -0.0146068 12.4731 4.16298e-05C7.49219 0.0151783 3.90625 4.05131 3.90625 8.59379ZM12.5 4.68754C10.3462 4.68754 8.59375 6.43998 8.59375 8.59379C8.59375 9.02543 8.24414 9.37504 7.8125 9.37504C7.38086 9.37504 7.03125 9.02543 7.03125 8.59379C7.03125 5.57817 9.48438 3.12504 12.5 3.12504C12.9316 3.12504 13.2812 3.47465 13.2812 3.90629C13.2812 4.33793 12.9316 4.68754 12.5 4.68754Z" fill="#c5b863"/></g><defs><clipPath id="clip0_661_88"><rect width="25" height="25" fill="white"/></clipPath></defs></svg></a>
                <a style="transform: scale(0); opacity:0;" href="https://form-reach.com/support" title="Support" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 26 26" fill="none"><g clip-path="url(#clip0_660_92)"><path d="M13 0.40625C19.9554 0.40625 25.5938 6.04464 25.5938 13C25.5938 19.9554 19.9554 25.5938 13 25.5938C6.04464 25.5938 0.40625 19.9554 0.40625 13C0.40625 6.04464 6.04464 0.40625 13 0.40625ZM4.1795 6.47761L7.39898 9.69709C7.95691 8.75464 8.75332 7.95773 9.69709 7.39898L6.4776 4.1795C5.60288 4.82853 4.82853 5.60288 4.1795 6.47761ZM13 17.875C15.6924 17.875 17.875 15.6924 17.875 13C17.875 10.3076 15.6924 8.125 13 8.125C10.3076 8.125 8.125 10.3076 8.125 13C8.125 15.6924 10.3076 17.875 13 17.875ZM19.5224 4.1795L16.3029 7.39898C17.2454 7.95691 18.0423 8.75332 18.601 9.69709L21.8205 6.47761C21.1715 5.60286 20.3971 4.82851 19.5224 4.1795ZM21.8205 19.5224L18.601 16.3029C18.0431 17.2454 17.2467 18.0423 16.3029 18.601L19.5224 21.8205C20.3971 21.1715 21.1715 20.3971 21.8205 19.5224ZM6.4776 21.8205L9.69709 18.601C8.75464 18.0431 7.95773 17.2467 7.39898 16.3029L4.1795 19.5224C4.82853 20.3971 5.60288 21.1715 6.4776 21.8205Z" fill="#c5b863"/></g><defs><clipPath id="clip0_660_92"><rect width="26" height="26" fill="white" transform="matrix(-1 0 0 1 26 0)"/></clipPath></defs></svg></a>
                <a style="transform: scale(0); opacity:0;" href="https://form-reach.com/documentation" title="Documentation" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 28 26" fill="none"><path d="M26.25 18.2812V1.21875C26.25 0.543359 25.6648 0 24.9375 0H7C4.10156 0 1.75 2.18359 1.75 4.875V21.125C1.75 23.8164 4.10156 26 7 26H24.9375C25.6648 26 26.25 25.4566 26.25 24.7812V23.9688C26.25 23.5879 26.0586 23.2426 25.7633 23.0191C25.5336 22.2371 25.5336 20.0078 25.7633 19.2258C26.0586 19.0074 26.25 18.6621 26.25 18.2812ZM8.75 6.80469C8.75 6.63711 8.89766 6.5 9.07812 6.5H20.6719C20.8523 6.5 21 6.63711 21 6.80469V7.82031C21 7.98789 20.8523 8.125 20.6719 8.125H9.07812C8.89766 8.125 8.75 7.98789 8.75 7.82031V6.80469ZM8.75 10.0547C8.75 9.88711 8.89766 9.75 9.07812 9.75H20.6719C20.8523 9.75 21 9.88711 21 10.0547V11.0703C21 11.2379 20.8523 11.375 20.6719 11.375H9.07812C8.89766 11.375 8.75 11.2379 8.75 11.0703V10.0547ZM22.6078 22.75H7C6.03203 22.75 5.25 22.0238 5.25 21.125C5.25 20.2312 6.0375 19.5 7 19.5H22.6078C22.5039 20.3684 22.5039 21.8816 22.6078 22.75Z" fill="#c5b863"/></svg></a>
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
        wp_enqueue_style('form-reach-custom-style', plugin_dir_url(__FILE__) . 'assets/css/form-reach.min.css', array(), '1.0.0');
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