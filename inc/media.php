<?php
/**
 * Butler-Smith Developments — Media Library Importer & Asset Manager
 *
 * Imports theme assets into the WordPress Media Library as native attachment posts
 * and links them to Elementor widgets and CPT posts.
 *
 * @package ButlerSmith
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Import a single theme asset into the WordPress Media Library if not already present.
 *
 * @param string $rel_path Path relative to assets/img/, e.g. 'home/hero.jpg'
 * @param string $title Optional title/alt for the attachment
 * @return array array('id' => int, 'url' => string)
 */
function bsd_import_image_to_media($rel_path, $title = '') {
    $rel_path = ltrim(str_replace('\\', '/', $rel_path), '/');
    $file_path = BSD_DIR . '/assets/img/' . $rel_path;

    if (!file_exists($file_path)) {
        return array(
            'id'  => 0,
            'url' => BSD_URI . '/assets/img/' . $rel_path,
        );
    }

    // 1. Check if already imported by _bsd_source_relpath meta
    global $wpdb;
    $attachment_id = $wpdb->get_var($wpdb->prepare(
        "SELECT post_id FROM {$wpdb->postmeta} WHERE meta_key = '_bsd_source_relpath' AND meta_value = %s LIMIT 1",
        $rel_path
    ));

    if ($attachment_id && get_post($attachment_id)) {
        $url = wp_get_attachment_url($attachment_id);
        if ($url) {
            return array(
                'id'  => (int)$attachment_id,
                'url' => $url,
            );
        }
    }

    // 2. Load required WordPress media admin APIs
    if (!function_exists('wp_generate_attachment_metadata')) {
        require_once ABSPATH . 'wp-admin/includes/image.php';
    }
    if (!function_exists('wp_handle_sideload')) {
        require_once ABSPATH . 'wp-admin/includes/file.php';
    }
    if (!function_exists('media_handle_sideload')) {
        require_once ABSPATH . 'wp-admin/includes/media.php';
    }

    // 3. Upload file into WordPress uploads directory
    $filename = basename($file_path);
    $file_contents = file_get_contents($file_path);
    if ($file_contents === false) {
        return array(
            'id'  => 0,
            'url' => BSD_URI . '/assets/img/' . $rel_path,
        );
    }

    $upload = wp_upload_bits($filename, null, $file_contents);
    if (!empty($upload['error'])) {
        return array(
            'id'  => 0,
            'url' => BSD_URI . '/assets/img/' . $rel_path,
        );
    }

    $wp_filetype = wp_check_filetype($filename, null);
    $clean_title = !empty($title) ? $title : sanitize_text_field(ucwords(str_replace(array('-', '_'), ' ', pathinfo($filename, PATHINFO_FILENAME))));

    $attachment = array(
        'post_mime_type' => $wp_filetype['type'],
        'post_title'     => $clean_title,
        'post_content'   => '',
        'post_status'    => 'inherit',
    );

    $attach_id = wp_insert_attachment($attachment, $upload['file']);
    if (is_wp_error($attach_id) || !$attach_id) {
        return array(
            'id'  => 0,
            'url' => $upload['url'],
        );
    }

    $attach_data = wp_generate_attachment_metadata($attach_id, $upload['file']);
    if (!empty($attach_data)) {
        wp_update_attachment_metadata($attach_id, $attach_data);
    }

    update_post_meta($attach_id, '_bsd_source_relpath', $rel_path);
    update_post_meta($attach_id, '_wp_attachment_image_alt', $clean_title);

    return array(
        'id'  => (int)$attach_id,
        'url' => wp_get_attachment_url($attach_id),
    );
}

/**
 * Retrieve a media library image structure by relative path, importing if needed.
 *
 * @param string $rel_path
 * @param string $fallback_title
 * @return array array('id' => int, 'url' => string)
 */
function bsd_get_theme_media($rel_path, $fallback_title = '') {
    return bsd_import_image_to_media($rel_path, $fallback_title);
}

/**
 * Scan all theme images under assets/img/ and import into Media Library.
 *
 * @return array Map of rel_path => array('id' => int, 'url' => string)
 */
function bsd_import_all_theme_images() {
    $img_root = BSD_DIR . '/assets/img';
    if (!is_dir($img_root)) {
        return array();
    }

    $results = array();
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($img_root, RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST
    );

    $allowed_exts = array('jpg', 'jpeg', 'png', 'webp', 'svg', 'gif');

    foreach ($iterator as $file) {
        if ($file->isFile()) {
            $ext = strtolower(pathinfo($file->getFilename(), PATHINFO_EXTENSION));
            if (in_array($ext, $allowed_exts, true)) {
                $full_path = str_replace('\\', '/', $file->getPathname());
                $rel_path  = ltrim(str_replace(str_replace('\\', '/', $img_root), '', $full_path), '/');
                $title     = sanitize_text_field(ucwords(str_replace(array('-', '_'), ' ', pathinfo($file->getFilename(), PATHINFO_FILENAME))));

                $results[$rel_path] = bsd_import_image_to_media($rel_path, $title);
            }
        }
    }

    // Assign default logo to custom_logo & bsd_footer_logo if not already set
    if (isset($results['logo/butler-smith-logo-transparent.png']) && !empty($results['logo/butler-smith-logo-transparent.png']['id'])) {
        $logo_id = $results['logo/butler-smith-logo-transparent.png']['id'];
        if (!get_theme_mod('custom_logo')) {
            set_theme_mod('custom_logo', $logo_id);
        }
        if (!get_theme_mod('bsd_footer_logo')) {
            set_theme_mod('bsd_footer_logo', $logo_id);
        }
    }

    update_option('bsd_media_imported', true);
    return $results;
}

/**
 * Auto-import theme media on theme activation if not yet imported.
 */
function bsd_auto_import_media_on_switch() {
    if (!get_option('bsd_media_imported')) {
        bsd_import_all_theme_images();
    }
}
add_action('after_switch_theme', 'bsd_auto_import_media_on_switch');
