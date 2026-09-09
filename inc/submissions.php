<?php
/**
 * Contact Form Submissions Handler & Admin Viewer
 *
 * @package ButlerSmith
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Create Database Table on Theme Switch
 */
function bsd_create_submissions_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'bsd_submissions';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id bigint(20) NOT NULL AUTO_KEY AUTO_INCREMENT,
        first_name varchar(100) NOT NULL,
        last_name varchar(100) NOT NULL,
        email varchar(150) NOT NULL,
        phone varchar(50) DEFAULT '',
        enquiry_type varchar(100) DEFAULT '',
        message text NOT NULL,
        submitted_at datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
add_action('after_switch_theme', 'bsd_create_submissions_table');

/**
 * Handle AJAX Enquiry Submission
 */
function bsd_handle_enquiry_submission() {
    // Nonce check if present
    if (isset($_POST['nonce']) && !wp_verify_nonce($_POST['nonce'], 'bsd_contact_nonce')) {
        wp_send_json_error(array('message' => __('Security verification failed. Please refresh the page.', 'butler-smith')));
    }

    $first_name   = isset($_POST['first-name']) ? sanitize_text_field($_POST['first-name']) : '';
    $last_name    = isset($_POST['last-name']) ? sanitize_text_field($_POST['last-name']) : '';
    $email        = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $phone        = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';
    $enquiry_type = isset($_POST['enquiry-type']) ? sanitize_text_field($_POST['enquiry-type']) : '';
    $message      = isset($_POST['message']) ? sanitize_textarea_field($_POST['message']) : '';

    if (empty($first_name) || empty($last_name) || empty($email) || empty($message)) {
        wp_send_json_error(array('message' => __('Please fill in all required fields.', 'butler-smith')));
    }

    global $wpdb;
    $table_name = $wpdb->prefix . 'bsd_submissions';

    // Insert into database
    $inserted = $wpdb->insert(
        $table_name,
        array(
            'first_name'   => $first_name,
            'last_name'    => $last_name,
            'email'        => $email,
            'phone'        => $phone,
            'enquiry_type' => $enquiry_type,
            'message'      => $message,
            'submitted_at' => current_time('mysql'),
        ),
        array('%s', '%s', '%s', '%s', '%s', '%s', '%s')
    );

    // Send email alert to admin
    $admin_email = get_theme_mod('bsd_contact_email', get_option('admin_email'));
    $subject = sprintf(__('[Butler-Smith Enquiry] %s from %s %s', 'butler-smith'), $enquiry_type, $first_name, $last_name);
    $body  = "You have received a new enquiry via the Butler-Smith website:\n\n";
    $body .= "Name: $first_name $last_name\n";
    $body .= "Email: $email\n";
    $body .= "Phone: $phone\n";
    $body .= "Interest: $enquiry_type\n\n";
    $body .= "Message:\n$message\n\n";
    $body .= "--\nButler-Smith Developments";

    $headers = array('Content-Type: text/plain; charset=UTF-8', "Reply-To: $first_name $last_name <$email>");
    wp_mail($admin_email, $subject, $body, $headers);

    wp_send_json_success(array('message' => __('Thank you! Your enquiry has been received. A member of our team will be in touch shortly.', 'butler-smith')));
}
add_action('wp_ajax_bsd_submit_enquiry', 'bsd_handle_enquiry_submission');
add_action('wp_ajax_nopriv_bsd_submit_enquiry', 'bsd_handle_enquiry_submission');

/**
 * Add Admin Enquiries Submenu
 */
function bsd_add_submissions_admin_menu() {
    add_submenu_page(
        'edit.php?post_type=development',
        __('Client Enquiries', 'butler-smith'),
        __('Enquiries', 'butler-smith'),
        'manage_options',
        'bsd-enquiries',
        'bsd_render_enquiries_admin_page'
    );
}
add_action('admin_menu', 'bsd_add_submissions_admin_menu');

function bsd_render_enquiries_admin_page() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'bsd_submissions';

    // Check if table exists
    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
        bsd_create_submissions_table();
    }

    $submissions = $wpdb->get_results("SELECT * FROM $table_name ORDER BY submitted_at DESC LIMIT 100");
    ?>
    <div class="wrap">
        <h1><?php _e('Butler-Smith Client Enquiries', 'butler-smith'); ?></h1>
        <p><?php _e('Submissions received from the contact and consultation forms on the website.', 'butler-smith'); ?></p>

        <table class="wp-list-table widefat fixed striped posts">
            <thead>
                <tr>
                    <th scope="col" style="width: 140px;"><?php _e('Date', 'butler-smith'); ?></th>
                    <th scope="col" style="width: 160px;"><?php _e('Name', 'butler-smith'); ?></th>
                    <th scope="col" style="width: 180px;"><?php _e('Email', 'butler-smith'); ?></th>
                    <th scope="col" style="width: 130px;"><?php _e('Phone', 'butler-smith'); ?></th>
                    <th scope="col" style="width: 160px;"><?php _e('Interest', 'butler-smith'); ?></th>
                    <th scope="col"><?php _e('Message', 'butler-smith'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($submissions)) : ?>
                    <?php foreach ($submissions as $sub) : ?>
                        <tr>
                            <td><?php echo esc_html(date_i18n(get_option('date_format') . ' ' . get_option('time_format'), strtotime($sub->submitted_at))); ?></td>
                            <td><strong><?php echo esc_html($sub->first_name . ' ' . $sub->last_name); ?></strong></td>
                            <td><a href="mailto:<?php echo esc_attr($sub->email); ?>"><?php echo esc_html($sub->email); ?></a></td>
                            <td><?php echo esc_html($sub->phone ? $sub->phone : '—'); ?></td>
                            <td><span class="badge"><?php echo esc_html($sub->enquiry_type); ?></span></td>
                            <td><?php echo nl2br(esc_html($sub->message)); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="6"><?php _e('No enquiries received yet.', 'butler-smith'); ?></td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php
}
