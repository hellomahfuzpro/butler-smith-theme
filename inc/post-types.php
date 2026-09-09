<?php
/**
 * Register Developments Custom Post Type & Meta
 *
 * @package ButlerSmith
 */

if (!defined('ABSPATH')) {
    exit;
}

function bsd_register_post_types() {
    $labels = array(
        'name'               => __('Developments', 'butler-smith'),
        'singular_name'      => __('Development', 'butler-smith'),
        'menu_name'          => __('Developments', 'butler-smith'),
        'name_admin_bar'     => __('Development', 'butler-smith'),
        'add_new'            => __('Add New', 'butler-smith'),
        'add_new_item'       => __('Add New Development', 'butler-smith'),
        'new_item'           => __('New Development', 'butler-smith'),
        'edit_item'          => __('Edit Development', 'butler-smith'),
        'view_item'          => __('View Development', 'butler-smith'),
        'all_items'          => __('All Developments', 'butler-smith'),
        'search_items'       => __('Search Developments', 'butler-smith'),
        'not_found'          => __('No developments found.', 'butler-smith'),
        'not_found_in_trash' => __('No developments found in Trash.', 'butler-smith'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'developments', 'with_front' => false),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 20,
        'menu_icon'          => 'dashicons-admin-multisite',
        'show_in_rest'       => true,
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
    );

    register_post_type('development', $args);
}
add_action('init', 'bsd_register_post_types');

/**
 * Add Meta Box for Development Specifications
 */
function bsd_add_development_meta_boxes() {
    add_meta_box(
        'bsd_dev_specs',
        __('Development Specifications', 'butler-smith'),
        'bsd_render_development_meta_box',
        'development',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'bsd_add_development_meta_boxes');

function bsd_render_development_meta_box($post) {
    wp_nonce_field('bsd_save_development_specs', 'bsd_dev_specs_nonce');

    $location     = get_post_meta($post->ID, '_bsd_location', true);
    $tag          = get_post_meta($post->ID, '_bsd_tag', true);
    $bedrooms     = get_post_meta($post->ID, '_bsd_bedrooms', true);
    $style        = get_post_meta($post->ID, '_bsd_style', true);
    $plot_size    = get_post_meta($post->ID, '_bsd_plot_size', true);
    $living_space = get_post_meta($post->ID, '_bsd_living_space', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="bsd_location"><?php _e('Location', 'butler-smith'); ?></label></th>
            <td>
                <input type="text" id="bsd_location" name="bsd_location" value="<?php echo esc_attr($location); ?>" class="regular-text" placeholder="e.g. Ashley, Shropshire">
            </td>
        </tr>
        <tr>
            <th><label for="bsd_tag"><?php _e('Category Tag', 'butler-smith'); ?></label></th>
            <td>
                <input type="text" id="bsd_tag" name="bsd_tag" value="<?php echo esc_attr($tag); ?>" class="regular-text" placeholder="e.g. New Build Home or Self-Build">
            </td>
        </tr>
        <tr>
            <th><label for="bsd_bedrooms"><?php _e('Bedrooms', 'butler-smith'); ?></label></th>
            <td>
                <input type="text" id="bsd_bedrooms" name="bsd_bedrooms" value="<?php echo esc_attr($bedrooms); ?>" class="regular-text" placeholder="e.g. 5">
            </td>
        </tr>
        <tr>
            <th><label for="bsd_style"><?php _e('Architectural Style', 'butler-smith'); ?></label></th>
            <td>
                <input type="text" id="bsd_style" name="bsd_style" value="<?php echo esc_attr($style); ?>" class="regular-text" placeholder="e.g. Contemporary, Natural Materials">
            </td>
        </tr>
        <tr>
            <th><label for="bsd_plot_size"><?php _e('Plot Size', 'butler-smith'); ?></label></th>
            <td>
                <input type="text" id="bsd_plot_size" name="bsd_plot_size" value="<?php echo esc_attr($plot_size); ?>" class="regular-text" placeholder="e.g. 0.75 Acres">
            </td>
        </tr>
        <tr>
            <th><label for="bsd_living_space"><?php _e('Living Space', 'butler-smith'); ?></label></th>
            <td>
                <input type="text" id="bsd_living_space" name="bsd_living_space" value="<?php echo esc_attr($living_space); ?>" class="regular-text" placeholder="e.g. 4,500 sq ft">
            </td>
        </tr>
    </table>
    <?php
}

function bsd_save_development_specs($post_id) {
    if (!isset($_POST['bsd_dev_specs_nonce']) || !wp_verify_nonce($_POST['bsd_dev_specs_nonce'], 'bsd_save_development_specs')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = array('bsd_location', 'bsd_tag', 'bsd_bedrooms', 'bsd_style', 'bsd_plot_size', 'bsd_living_space');
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
        }
    }
}
add_action('save_post_development', 'bsd_save_development_specs');
