<?php
/**
 * Butler-Smith Developments — Elementor Category & Glob Autoloader
 *
 * @package ButlerSmith
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register Elementor Category
 */
function bsd_elementor_category($elements_manager) {
    $elements_manager->add_category('butler-smith', array(
        'title' => __('Butler-Smith Developments', 'butler-smith'),
        'icon'  => 'fa fa-home',
    ));
}
add_action('elementor/elements/categories_registered', 'bsd_elementor_category');

/**
 * Glob Autoloader for widgets/class-*.php
 */
function bsd_register_widgets($widgets_manager) {
    $dir = get_template_directory() . '/widgets/';
    if (!is_dir($dir)) {
        return;
    }

    // 1. Always load base widget first
    if (file_exists($dir . 'class-base-widget.php')) {
        require_once $dir . 'class-base-widget.php';
    }

    // 2. Require all other widget class files
    foreach (glob($dir . 'class-*.php') as $file) {
        if (false !== strpos($file, 'class-base-widget.php')) {
            continue;
        }
        require_once $file;
    }

    // 3. Register each class
    foreach (glob($dir . 'class-*.php') as $file) {
        $base = basename($file, '.php');
        if ('class-base-widget' === $base) {
            continue;
        }
        $slug  = substr($base, strlen('class-')); // e.g. hero-split
        $class = 'BSD_Widget_' . str_replace(' ', '_', ucwords(str_replace('-', ' ', $slug)));
        if (class_exists($class)) {
            $widgets_manager->register(new $class());
        }
    }
}
add_action('elementor/widgets/register', 'bsd_register_widgets');

/**
 * Preview Styles Isolation
 * Enqueue theme CSS into preview iframe
 */
function bsd_elementor_preview_styles() {
    wp_enqueue_style('bsd-google-fonts', 'https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,600;0,700;0,900;1,400;1,500&display=swap', array(), null);
    wp_enqueue_style('bsd-tokens', get_template_directory_uri() . '/assets/css/tokens.css', array(), '1.0.0');
    wp_enqueue_style('bsd-widgets', get_template_directory_uri() . '/assets/css/widgets.css', array('bsd-tokens'), '1.0.0');
}
add_action('elementor/preview/enqueue_styles', 'bsd_elementor_preview_styles');
