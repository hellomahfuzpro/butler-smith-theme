<?php
/**
 * Butler-Smith Developments Customizer Settings
 *
 * @package ButlerSmith
 */

if (!defined('ABSPATH')) {
    exit;
}

function bsd_customize_register($wp_customize) {
    // Panel: Butler-Smith Theme Settings
    $wp_customize->add_panel('bsd_theme_options', array(
        'title'       => __('Butler-Smith Theme Settings', 'butler-smith'),
        'priority'    => 20,
        'description' => __('Customize branding, header CTA, contact details, and footer.', 'butler-smith'),
    ));

    // Section: Header & Navigation
    $wp_customize->add_section('bsd_header_section', array(
        'title'    => __('Header & Navigation', 'butler-smith'),
        'panel'    => 'bsd_theme_options',
        'priority' => 10,
    ));

    $wp_customize->add_setting('bsd_header_cta_text', array(
        'default'           => 'Enquire',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('bsd_header_cta_text', array(
        'label'    => __('Header CTA Button Text', 'butler-smith'),
        'section'  => 'bsd_header_section',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('bsd_header_cta_url', array(
        'default'           => '/contact/',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('bsd_header_cta_url', array(
        'label'    => __('Header CTA Button URL', 'butler-smith'),
        'section'  => 'bsd_header_section',
        'type'     => 'url',
    ));

    // Section: Contact & Social
    $wp_customize->add_section('bsd_contact_section', array(
        'title'    => __('Contact & Social Links', 'butler-smith'),
        'panel'    => 'bsd_theme_options',
        'priority' => 20,
    ));

    $wp_customize->add_setting('bsd_contact_phone', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('bsd_contact_phone', array(
        'label'    => __('Contact Phone', 'butler-smith'),
        'section'  => 'bsd_contact_section',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('bsd_contact_email', array(
        'default'           => 'info@butler-smithdevelopments.co.uk',
        'sanitize_callback' => 'sanitize_email',
    ));
    $wp_customize->add_control('bsd_contact_email', array(
        'label'    => __('Enquiry Recipient Email', 'butler-smith'),
        'section'  => 'bsd_contact_section',
        'type'     => 'email',
    ));

    $wp_customize->add_setting('bsd_instagram_url', array(
        'default'           => 'https://www.instagram.com/butler_smithdevelopments/',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('bsd_instagram_url', array(
        'label'    => __('Instagram Profile URL', 'butler-smith'),
        'section'  => 'bsd_contact_section',
        'type'     => 'url',
    ));

    $wp_customize->add_setting('bsd_facebook_url', array(
        'default'           => 'https://www.facebook.com/ButlerSmithDevelopments/',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('bsd_facebook_url', array(
        'label'    => __('Facebook Page URL', 'butler-smith'),
        'section'  => 'bsd_contact_section',
        'type'     => 'url',
    ));

    // Section: Footer
    $wp_customize->add_section('bsd_footer_section', array(
        'title'    => __('Footer & Legal', 'butler-smith'),
        'panel'    => 'bsd_theme_options',
        'priority' => 30,
    ));

    $wp_customize->add_setting('bsd_footer_bio', array(
        'default'           => 'Designing and building exceptional bespoke homes from concept to completion, across Cheshire, Shropshire & Staffordshire.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('bsd_footer_bio', array(
        'label'    => __('Footer Brand Bio', 'butler-smith'),
        'section'  => 'bsd_footer_section',
        'type'     => 'textarea',
    ));

    $wp_customize->add_setting('bsd_footer_copyright', array(
        'default'           => '© ' . date('Y') . ' Butler-Smith Developments. All rights reserved.',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('bsd_footer_copyright', array(
        'label'    => __('Footer Copyright Line', 'butler-smith'),
        'section'  => 'bsd_footer_section',
        'type'     => 'text',
    ));

    // Section: Cookie Banner
    $wp_customize->add_section('bsd_cookie_section', array(
        'title'    => __('Cookie Banner', 'butler-smith'),
        'panel'    => 'bsd_theme_options',
        'priority' => 40,
    ));

    $wp_customize->add_setting('bsd_enable_cookie_banner', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ));
    $wp_customize->add_control('bsd_enable_cookie_banner', array(
        'label'    => __('Enable Cookie Consent Banner', 'butler-smith'),
        'section'  => 'bsd_cookie_section',
        'type'     => 'checkbox',
    ));

    $wp_customize->add_setting('bsd_cookie_text', array(
        'default'           => "We use essential cookies to make this site work, and optional analytics cookies to help us understand how it's used.",
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('bsd_cookie_text', array(
        'label'    => __('Cookie Banner Message', 'butler-smith'),
        'section'  => 'bsd_cookie_section',
        'type'     => 'textarea',
    ));
}
add_action('customize_register', 'bsd_customize_register');
