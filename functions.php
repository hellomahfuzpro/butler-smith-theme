<?php
/**
 * Butler-Smith Developments Theme Functions
 *
 * @package ButlerSmith
 */

if (!defined('ABSPATH')) {
    exit;
}

define('BSD_VERSION', '1.0.3');
define('BSD_DIR', get_template_directory());
define('BSD_URI', get_template_directory_uri());

/**
 * Theme Setup
 */
function bsd_theme_setup() {
    load_theme_textdomain('butler-smith', BSD_DIR . '/languages');

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', array(
        'height'      => 120,
        'width'       => 120,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));
    add_theme_support('align-wide');
    add_theme_support('responsive-embeds');

    register_nav_menus(array(
        'primary'             => __('Primary Navigation', 'butler-smith'),
        'footer_explore'      => __('Footer Explore Menu', 'butler-smith'),
        'footer_developments' => __('Footer Developments Menu', 'butler-smith'),
    ));
}
add_action('after_setup_theme', 'bsd_theme_setup');

/**
 * Enqueue Scripts & Styles
 */
function bsd_enqueue_scripts() {
    // Google Font: Roboto
    wp_enqueue_style(
        'bsd-google-fonts',
        'https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,600;0,700;0,900;1,400;1,500&display=swap',
        array(),
        null
    );

    // Design Tokens & Widgets CSS
    wp_enqueue_style('bsd-tokens', BSD_URI . '/assets/css/tokens.css', array(), BSD_VERSION);
    wp_enqueue_style('bsd-widgets', BSD_URI . '/assets/css/widgets.css', array('bsd-tokens'), BSD_VERSION);
    wp_enqueue_style('bsd-theme-style', get_stylesheet_uri(), array('bsd-widgets'), BSD_VERSION);

    // Theme JS
    wp_enqueue_script('bsd-main', BSD_URI . '/assets/js/main.js', array(), BSD_VERSION, true);

    wp_localize_script('bsd-main', 'bsdData', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('bsd_contact_nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'bsd_enqueue_scripts');

/**
 * Preconnect for Google Fonts
 */
function bsd_resource_hints($urls, $relation_type) {
    if ('preconnect' === $relation_type) {
        $urls[] = array(
            'href' => 'https://fonts.googleapis.com',
        );
        $urls[] = array(
            'href'        => 'https://fonts.gstatic.com',
            'crossorigin' => 'use-credentials',
        );
    }
    return $urls;
}
add_filter('wp_resource_hints', 'bsd_resource_hints', 10, 2);

/**
 * Include Subsystems
 */
require_once BSD_DIR . '/inc/customizer.php';
require_once BSD_DIR . '/inc/post-types.php';
require_once BSD_DIR . '/inc/submissions.php';
require_once BSD_DIR . '/inc/elementor.php';
require_once BSD_DIR . '/inc/media.php';
require_once BSD_DIR . '/inc/demo-import.php';

/**
 * Optional: Plugin Update Checker Integration
 */
function bsd_bootstrap_updater() {
    $lib = BSD_DIR . '/lib/plugin-update-checker/plugin-update-checker.php';
    if (!file_exists($lib)) {
        return;
    }
    require_once $lib;

    if (class_exists('\YahnisElsts\PluginUpdateChecker\v5\PucFactory')) {
        $bsd_update_checker = \YahnisElsts\PluginUpdateChecker\v5\PucFactory::buildUpdateChecker(
            'https://github.com/hellomahfuzpro/butler-smith-theme/',
            BSD_DIR . '/style.css',
            get_template()
        );
        if ($bsd_update_checker && method_exists($bsd_update_checker->getVcsApi(), 'enableReleaseAssets')) {
            $bsd_update_checker->getVcsApi()->enableReleaseAssets();
        }
    }
}
add_action('after_setup_theme', 'bsd_bootstrap_updater');

