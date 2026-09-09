<?php
/**
 * Butler-Smith Developments — Programmatic Page Seeder (Modern Elementor Flexbox Containers)
 *
 * Seeds pages, sets up Elementor widgets with WordPress Media Library attachments,
 * registers developments with featured images, and configures menus.
 *
 * @package ButlerSmith
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * 7-character hexadecimal unique identifier for Elementor nodes
 */
function bsd_uid() {
    return substr(md5(uniqid((string)wp_rand(), true)), 0, 7);
}

/**
 * Assign unique _id to repeater rows
 */
function bsd_rep(array $rows) {
    return array_map(function($r) {
        $r['_id'] = bsd_uid();
        return $r;
    }, $rows);
}

/**
 * Construct modern flexbox Container element tree holding widgets
 */
function bsd_build_tree(array $widgets) {
    $tree = array();
    foreach ($widgets as $w) {
        $tree[] = array(
            'id'       => bsd_uid(),
            'elType'   => 'container',
            'settings' => array(
                'content_width' => 'full',
                'flex_gap'      => array('unit' => 'px', 'size' => 0, 'column' => '0', 'row' => '0'),
                'padding'       => array('unit' => 'px', 'top' => '0', 'right' => '0', 'bottom' => '0', 'left' => '0', 'isLinked' => true),
            ),
            'isInner'  => false,
            'elements' => array(
                array(
                    'id'         => bsd_uid(),
                    'elType'     => 'widget',
                    'widgetType' => $w['type'],
                    'settings'   => isset($w['settings']) ? $w['settings'] : array(),
                    'elements'   => array(),
                ),
            ),
        );
    }
    return $tree;
}

/**
 * Persist an Elementor tree to a page post
 */
function bsd_save_page($page_id, array $tree, $is_front = false) {
    update_option('elementor_experiment-container', 'active');
    update_post_meta($page_id, '_elementor_data', wp_slash(wp_json_encode($tree)));
    update_post_meta($page_id, '_elementor_edit_mode', 'builder');
    update_post_meta($page_id, '_elementor_template_type', 'wp-page');
    update_post_meta($page_id, '_wp_page_template', 'elementor_header_footer');

    if (defined('ELEMENTOR_VERSION')) {
        update_post_meta($page_id, '_elementor_version', ELEMENTOR_VERSION);
    }

    if ($is_front) {
        update_option('show_on_front', 'page');
        update_option('page_on_front', $page_id);
    }

    if (class_exists('\Elementor\Plugin')) {
        \Elementor\Plugin::$instance->files_manager->clear_cache();
    }
}

/**
 * Helper to get or create page
 */
function bsd_get_or_create_page($slug, $title, $template = '') {
    $page = get_page_by_path($slug);
    if ($page) {
        return $page->ID;
    }
    $page_id = wp_insert_post(array(
        'post_title'   => $title,
        'post_name'    => $slug,
        'post_status'  => 'publish',
        'post_type'    => 'page',
        'post_content' => '',
    ));
    if ($template && !is_wp_error($page_id)) {
        update_post_meta($page_id, '_wp_page_template', $template);
    }
    return $page_id;
}

/**
 * Seed all Butler-Smith Pages, Developments, and Menus with Media Library Attachments
 */
function bsd_seed_all_demo_content() {
    // 0. Import all theme images to WordPress Media Library first
    if (function_exists('bsd_import_all_theme_images')) {
        bsd_import_all_theme_images();
    }

    // 1. Home Page
    $home_id = get_option('page_on_front');
    if (!$home_id || !get_post($home_id)) {
        $home_id = bsd_get_or_create_page('home', 'Home — Prestige Property Development', 'front-page.php');
    }

    $home_tree = bsd_build_tree(array(
        array(
            'type' => 'bsd_hero_split',
            'settings' => array(
                'is_compact' => 'no',
                'eyebrow'    => 'Cheshire · Shropshire · Staffordshire',
                'title'      => 'Designing and Building Exceptional Bespoke Homes from Concept to Completion',
                'lede'       => 'Butler-Smith Developments creates considered, high-craft homes for private clients and our own boutique developments — from first sketch to final handover.',
                'image'      => bsd_get_theme_media('home/hero.jpg', 'Designing and Building Exceptional Bespoke Homes'),
                'btn1_text'  => 'Discuss Bringing Your Dream Home to Life',
                'btn1_link'  => array('url' => home_url('/contact/')),
                'btn2_text'  => 'View Our Developments',
                'btn2_link'  => array('url' => home_url('/new-homes/')),
            ),
        ),
        array(
            'type' => 'bsd_three_ways',
            'settings' => array(
                'eyebrow' => 'What We Do',
                'title'   => 'Three Ways We Build',
                'cards'   => bsd_rep(array(
                    array(
                        'num'       => '01',
                        'title'     => 'Self-Build Projects',
                        'desc'      => 'End-to-end guidance for private clients building a truly bespoke home, from sourcing land to final handover.',
                        'link_text' => 'Explore Self-Build →',
                        'link_url'  => array('url' => home_url('/self-build/')),
                    ),
                    array(
                        'num'       => '02',
                        'title'     => 'Renovations & Remodeling',
                        'desc'      => 'Transforming existing homes across the region — extensions, conversions and full renovations, built with care.',
                        'link_text' => 'Explore Renovations →',
                        'link_url'  => array('url' => home_url('/renovations/')),
                    ),
                    array(
                        'num'       => '03',
                        'title'     => 'New Build Homes',
                        'desc'      => 'Our own boutique developments — a curated collection of luxury new build homes across Cheshire & Shropshire.',
                        'link_text' => 'Explore New Homes →',
                        'link_url'  => array('url' => home_url('/new-homes/')),
                    ),
                )),
            ),
        ),
        array(
            'type' => 'bsd_testimonial',
            'settings' => array(
                'stars' => '★★★★★',
                'quote' => '“Wow, what can I say… we just love our new home! Thank you for all of your help and patience over the last couple of months. Brilliant company to deal with, nothing was ever too much trouble. Whenever we contacted Conor he always returned our calls or messages. Thank you so much.”',
                'cite'  => 'Martin & Maria, Laurel',
            ),
        ),
        array(
            'type' => 'bsd_split_content',
            'settings' => array(
                'image_position' => 'left',
                'image'          => bsd_get_theme_media('home/craft-detail.jpg', 'Ten-Year Warranty Craftsmanship'),
                'eyebrow'        => 'Our Promise',
                'title'          => 'A Market-Leading Ten-Year Warranty, On Every Build',
                'lede'           => 'We are proud to offer a market-leading ten-year warranty with every build, ensuring our clients enjoy unparalleled peace of mind knowing that our workmanship is of the highest quality.',
                'body'           => '<p>At Butler-Smith, customer satisfaction is paramount. While timber is a primary material in our constructions, it naturally undergoes slight shrinkage, particularly when exposed to heat. To minimise this, we meticulously control the warming process before completion.</p><p>Our dedication extends beyond the warranty period. Our after-sales customer service team stands ready to assist with any concerns during the first two years of ownership, and we remain committed to your homeownership experience long after.</p>',
            ),
        ),
        array(
            'type' => 'bsd_cta_band',
            'settings' => array(
                'eyebrow'   => 'Ready When You Are',
                'title'     => 'Discuss Bringing Your Dream Home to Life',
                'lede'      => "Whether you're starting a self-build, planning a renovation, or exploring our current developments, our team is ready to talk.",
                'btn1_text' => 'Get In Touch',
                'btn1_link' => array('url' => home_url('/contact/')),
                'btn2_text' => 'View Our Developments',
                'btn2_link' => array('url' => home_url('/new-homes/')),
            ),
        ),
    ));
    bsd_save_page($home_id, $home_tree, true);

    // 2. Self-Build Page
    $sb_id = bsd_get_or_create_page('self-build', 'Self-Build Projects', 'page-self-build.php');
    $sb_tree = bsd_build_tree(array(
        array(
            'type' => 'bsd_hero_split',
            'settings' => array(
                'is_compact' => 'yes',
                'eyebrow'    => 'Self-Build Projects',
                'title'      => 'Build Your Dream Home With an Experienced Premium Developer',
                'lede'       => 'From design support to project management in Cheshire and the surrounding area.',
                'image'      => bsd_get_theme_media('developments/self-build/hero.jpg', 'Build Your Dream Home'),
                'btn1_text'  => 'View Portfolio →',
                'btn1_link'  => array('url' => '#portfolio'),
            ),
        ),
        array(
            'type' => 'bsd_split_content',
            'settings' => array(
                'image_position' => 'left',
                'image'          => bsd_get_theme_media('developments/self-build/consultation.jpg', 'Self Build Guidance'),
                'lede'           => "Building your own home is an exciting opportunity to create a space that's truly yours, tailored to your lifestyle, tastes, and future plans. But navigating the process can feel overwhelming.",
                'body'           => "<p>That's where Butler Smith Developments comes in. With years of experience in designing and delivering bespoke homes, we manage every stage of the build process, ensuring a seamless journey from concept to completion.</p>",
                'btn_text'       => 'Discuss Bringing Your Dream Home to Life',
                'btn_link'       => array('url' => home_url('/contact/')),
            ),
        ),
        array(
            'type' => 'bsd_process_steps',
            'settings' => array(
                'eyebrow' => 'Our Process',
                'title'   => 'Five Steps From Vision to Handover',
            ),
        ),
        array(
            'type' => 'bsd_feature_checklist',
            'settings' => array(
                'eyebrow' => 'Why Butler-Smith',
                'title'   => 'Why Choose Butler-Smith Developments?',
            ),
        ),
        array(
            'type' => 'bsd_developments_grid',
            'settings' => array(
                'eyebrow' => 'Case Studies',
                'title'   => "Private Self-Builds We've Delivered",
                'is_alt'  => 'yes',
            ),
        ),
        array(
            'type' => 'bsd_cta_band',
            'settings' => array(
                'eyebrow'   => 'Ready to Start Your Self-Build Journey?',
                'title'     => "Let's Create Something Exceptional Together",
                'lede'      => 'Get in touch today to discuss your dream home.',
                'btn1_text' => 'Get In Touch',
                'btn1_link' => array('url' => home_url('/contact/')),
            ),
        ),
    ));
    bsd_save_page($sb_id, $sb_tree);

    // 3. Renovations Page
    $ren_id = bsd_get_or_create_page('renovations', 'Renovations & Remodeling', 'page-renovations.php');
    $ren_tree = bsd_build_tree(array(
        array(
            'type' => 'bsd_hero_split',
            'settings' => array(
                'is_compact' => 'yes',
                'eyebrow'    => 'Renovations & Remodeling',
                'title'      => 'Transform Your Property with Master Craftsmanship',
                'lede'       => 'From architectural redesigns to structural alterations, extensions, and high-end remodeling across Cheshire and Shropshire.',
                'image'      => bsd_get_theme_media('developments/renovations/hero.jpg', 'Transform Your Property'),
                'btn1_text'  => 'Explore Services →',
                'btn1_link'  => array('url' => '#services'),
            ),
        ),
        array(
            'type' => 'bsd_split_content',
            'settings' => array(
                'image_position' => 'left',
                'image'          => bsd_get_theme_media('developments/renovations/section.jpg', 'Uncompromising Craftsmanship'),
                'lede'           => "Whether you're looking to extend, reconfigure, or completely revitalize an existing residence, our renovation service brings the same uncompromising standards of craftsmanship.",
                'body'           => '<p>We work with discerning homeowners to modernize period properties, unlock hidden square footage, and create harmonious indoor-outdoor living spaces.</p>',
                'btn_text'       => 'Discuss Your Renovation Project',
                'btn_link'       => array('url' => home_url('/contact/')),
            ),
        ),
        array(
            'type' => 'bsd_service_cards',
            'settings' => array(
                'eyebrow'  => 'Our Renovation Scope',
                'title'    => 'Two Ways We Transform Existing Properties',
                'centered' => 'yes',
                'is_alt'   => 'yes',
                'cards'    => bsd_rep(array(
                    array(
                        'title' => 'Extensions & Space Remodeling',
                        'desc'  => 'Single and multi-storey extensions, open-plan kitchen and living reconfigurations, glass links, and structural alterations.',
                        'image' => bsd_get_theme_media('developments/renovations/garage-conversion.jpg', 'Extensions & Space Remodeling'),
                    ),
                    array(
                        'title' => 'Full Property Transformations',
                        'desc'  => 'Comprehensive back-to-brick renovations, historical restorations, mechanical and electrical overhauls, bespoke joinery, and turn-key luxury interior finishes.',
                        'image' => bsd_get_theme_media('developments/renovations/grounded.jpg', 'Full Property Transformations'),
                    ),
                )),
            ),
        ),
        array(
            'type' => 'bsd_process_steps',
            'settings' => array(
                'eyebrow' => 'Our Process',
                'title'   => 'Five Steps to Your Transformed Home',
            ),
        ),
        array(
            'type' => 'bsd_feature_checklist',
            'settings' => array(
                'eyebrow' => 'Why Butler-Smith',
                'title'   => 'Why Renovate With Butler-Smith Developments?',
                'is_alt'  => 'yes',
            ),
        ),
        array(
            'type' => 'bsd_cta_band',
            'settings' => array(
                'eyebrow'   => 'Ready to Transform Your Home?',
                'title'     => "Let's Discuss Your Renovation Ambitions",
                'lede'      => 'Get in touch today to schedule an on-site feasibility consultation.',
                'btn1_text' => 'Arrange a Consultation',
                'btn1_link' => array('url' => home_url('/contact/')),
            ),
        ),
    ));
    bsd_save_page($ren_id, $ren_tree);

    // 4. New Homes Page
    $nh_id = bsd_get_or_create_page('new-homes', 'New Build Homes', 'page-new-homes.php');
    $nh_tree = bsd_build_tree(array(
        array(
            'type' => 'bsd_hero_split',
            'settings' => array(
                'is_compact' => 'yes',
                'eyebrow'    => 'New Build Homes',
                'title'      => 'Designing & Building Exceptional Bespoke Homes',
                'lede'       => "Butler-Smith has delivered 4 public developments, comprising 7 luxury new build homes — each one designed and built to a standard that's simply not comparable to anything else on the market.",
                'image'      => bsd_get_theme_media('developments/new-homes/hero.jpg', 'Designing & Building Exceptional Bespoke Homes'),
                'btn1_text'  => 'View Portfolio →',
                'btn1_link'  => array('url' => '#portfolio'),
            ),
        ),
        array(
            'type' => 'bsd_split_content',
            'settings' => array(
                'image_position' => 'left',
                'image'          => bsd_get_theme_media('home/site-plan.jpg', 'Considered Design & Planning'),
                'lede'           => "Whether you're searching for your next home from one of our current developments, or dreaming of a private self-build tailored entirely to you, our property development service brings together considered design, meticulous planning, and exceptional craftsmanship.",
            ),
        ),
        array(
            'type' => 'bsd_service_cards',
            'settings' => array(
                'eyebrow'  => 'Two Routes In',
                'title'    => 'Two Ways to Secure a Butler-Smith Home',
                'centered' => 'yes',
                'is_alt'   => 'yes',
                'cards'    => bsd_rep(array(
                    array(
                        'title' => 'Our Developments',
                        'desc'  => 'Browse our curated collection of luxury new build developments across Cheshire and Shropshire.',
                        'image' => bsd_get_theme_media('home/own-developments.jpg', 'Our Developments'),
                    ),
                    array(
                        'title' => 'Private Self-Build',
                        'desc'  => 'Partner with Butler-Smith to build a bespoke luxury residence on your own plot of land.',
                        'image' => bsd_get_theme_media('home/private-self-build.jpg', 'Private Self-Build'),
                    ),
                )),
            ),
        ),
        array(
            'type' => 'bsd_feature_checklist',
            'settings' => array(
                'eyebrow' => 'What Sets Us Apart',
                'title'   => 'What Sets a Butler-Smith Home Apart',
            ),
        ),
        array(
            'type' => 'bsd_developments_grid',
            'settings' => array(
                'eyebrow' => 'Our Developments',
                'title'   => 'Explore Our Homes',
                'is_alt'  => 'yes',
            ),
        ),
        array(
            'type' => 'bsd_cta_band',
            'settings' => array(
                'eyebrow'   => 'Ready When You Are',
                'title'     => 'Discuss Bringing Your Dream Home to Life',
                'btn1_text' => 'Get In Touch',
                'btn1_link' => array('url' => home_url('/contact/')),
            ),
        ),
    ));
    bsd_save_page($nh_id, $nh_tree);

    // 5. About Page
    $abt_id = bsd_get_or_create_page('about', 'About Butler-Smith', 'page-about.php');
    $abt_tree = bsd_build_tree(array(
        array(
            'type' => 'bsd_hero_split',
            'settings' => array(
                'is_compact' => 'yes',
                'eyebrow'    => 'About Butler-Smith',
                'title'      => 'Prestige Property Development, Built on Craftsmanship',
                'lede'       => 'Bespoke homes, exceptional by design, across Cheshire, Shropshire and Staffordshire. Having built our reputation through our own developments, we now focus on helping clients build theirs.',
                'image'      => bsd_get_theme_media('about/hero.jpg', 'About Butler-Smith'),
            ),
        ),
        array(
            'type' => 'bsd_split_content',
            'settings' => array(
                'image_position' => 'left',
                'image'          => bsd_get_theme_media('about/team-portrait.jpg', 'Butler-Smith Team'),
                'eyebrow'        => 'Our Story',
                'title'          => 'From a Single Green Field to a Portfolio of Prestige Homes',
                'lede'           => "Butler-Smith Developments began with a single vision: bring exceptional homes to life. Since 2018, we've delivered a portfolio of boutique developments and private self-builds.",
                'body'           => '<p>Every home is designed and built in-house, working with a trusted network of high-spec suppliers, architects, interior designers and craftsmen, and backed by our market-leading ten-year warranty.</p>',
            ),
        ),
        array(
            'type' => 'bsd_feature_checklist',
            'settings' => array(
                'eyebrow' => 'What We Stand For',
                'title'   => 'The Butler-Smith Standard',
                'is_alt'  => 'yes',
            ),
        ),
        array(
            'type' => 'bsd_testimonial',
            'settings' => array(
                'quote' => '“Wow, what can I say… we just love our new home! Brilliant company to deal with, nothing was ever too much trouble.”',
                'cite'  => 'Martin & Maria, Laurel',
            ),
        ),
        array(
            'type' => 'bsd_cta_band',
            'settings' => array(
                'eyebrow'   => "Let's Talk",
                'title'     => 'Discuss Bringing Your Dream Home to Life',
                'btn1_text' => 'Get In Touch',
                'btn1_link' => array('url' => home_url('/contact/')),
            ),
        ),
    ));
    bsd_save_page($abt_id, $abt_tree);

    // 6. Contact Page
    $contact_id = bsd_get_or_create_page('contact', 'Get In Touch', 'page-contact.php');
    $contact_tree = bsd_build_tree(array(
        array(
            'type' => 'bsd_hero_split',
            'settings' => array(
                'is_compact' => 'yes',
                'eyebrow'    => 'Get In Touch',
                'title'      => 'Discuss Bringing Your Dream Home to Life',
                'lede'       => 'Tell us a little about your project and a member of the Butler-Smith team will be in touch to arrange a conversation.',
                'image'      => bsd_get_theme_media('developments/kingham/hero.jpg', 'Discuss Bringing Your Dream Home to Life'),
            ),
        ),
        array(
            'type' => 'bsd_contact',
            'settings' => array(),
        ),
    ));
    bsd_save_page($contact_id, $contact_tree);

    // 7. Privacy Policy Page
    bsd_get_or_create_page('privacy-policy', 'Privacy Policy', 'page-privacy-policy.php');

    // 8. Seed Developments CPT Posts with Media Library Thumbnails & Galleries
    $devs = array(
        array(
            'slug'         => 'ashwood',
            'title'        => 'Ashwood',
            'location'     => 'Ashley, Shropshire',
            'tag'          => 'New Build Home',
            'bedrooms'     => '5',
            'style'        => 'Contemporary, Natural Materials',
            'plot_size'    => '0.75 Acres',
            'living_space' => '4,500 sq ft',
            'thumb'        => 'developments/new-homes/hero.jpg',
            'gallery'      => array('home/hero.jpg', 'home/craft-detail.jpg', 'home/site-plan.jpg'),
            'content'      => '<p>A contemporary smart home set behind grand stonework, with a landscaped garden and a large private driveway.</p><p>A glass link carries you past the wine wall into the kitchen, where a double island wrapped in Taj Mahal stone sits against smoked oak units. It opens onto a day room with vaulted ceilings, floor-to-ceiling windows and a media wall &mdash; built for entertaining as much as relaxing.</p><p>One side of the first floor is given over entirely to the principal bedroom, with its own walk-in wardrobe and his-and-hers bathroom.</p><p>Designer lighting and premium finishes run throughout, with smart home technology controlling the house end to end &mdash; finished to the same standard as every Butler-Smith home.</p>',
            'excerpt'      => 'A contemporary smart home set behind grand stonework, with a landscaped garden and a large private driveway.',
        ),
        array(
            'slug'         => 'butley',
            'title'        => 'Butley',
            'location'     => 'Cheshire',
            'tag'          => 'Self Build',
            'bedrooms'     => '4',
            'style'        => 'Mediterranean-inspired, Modern Sophistication',
            'plot_size'    => '0.5 Acres',
            'living_space' => '3,800 sq ft',
            'thumb'        => 'developments/butley/thumb.jpg',
            'gallery'      => array('developments/butley/g1.jpg', 'developments/butley/g2.jpg', 'developments/butley/g3.jpg', 'developments/butley/g4.jpg', 'developments/butley/g5.jpg', 'developments/butley/g6.jpg'),
            'content'      => "<p>A Mediterranean-inspired private build, blending sun-drenched charm with modern sophistication.</p><p>Crafted to the highest standard with natural stone, bespoke timber finishes, and open living spaces seamlessly connecting to expansive landscaped grounds.</p>",
            'excerpt'      => 'A Mediterranean-inspired private build, blending sun-drenched charm with modern sophistication.',
        ),
        array(
            'slug'         => 'mulberry',
            'title'        => 'Mulberry',
            'location'     => 'Barlaston, Staffordshire',
            'tag'          => 'Self Build',
            'bedrooms'     => '5',
            'style'        => 'Modern Georgian',
            'plot_size'    => '0.6 Acres',
            'living_space' => '4,200 sq ft',
            'thumb'        => 'developments/mulberry/thumb.jpg',
            'gallery'      => array('developments/mulberry/cover.jpg', 'developments/mulberry/gnew1.jpg', 'developments/mulberry/gnew2.jpg', 'developments/mulberry/gnew3.jpg', 'developments/mulberry/gnew4.jpg', 'developments/mulberry/gnew5.jpg'),
            'content'      => "<p>A modern interpretation of the timeless Georgian dwelling, built entirely around one client's brief.</p><p>Features high ceilings, grand proportions, bespoke kitchen, and master suite wing.</p>",
            'excerpt'      => "A modern interpretation of the timeless Georgian dwelling, built entirely around one client's brief.",
        ),
        array(
            'slug'         => 'driftwood',
            'title'        => 'Driftwood',
            'location'     => 'Ashley, Shropshire',
            'tag'          => 'New Build Home',
            'bedrooms'     => '4',
            'style'        => 'Boutique Luxury',
            'plot_size'    => '0.75 Acres',
            'living_space' => '4,000 sq ft',
            'thumb'        => 'developments/driftwood/thumb.jpg',
            'gallery'      => array('developments/driftwood/g1.jpg', 'developments/driftwood/g2.jpg', 'developments/driftwood/g3.jpg', 'developments/driftwood/g4.jpg', 'developments/driftwood/g5.jpg', 'developments/driftwood/g6.jpg'),
            'content'      => '<p>Two exquisite 4-bedroom residences on a private gated 0.75-acre plot.</p><p>Combining traditional rural aesthetics with cutting-edge energy performance and smart home integration.</p>',
            'excerpt'      => 'Two exquisite 4-bedroom residences on a private gated 0.75-acre plot.',
        ),
        array(
            'slug'         => 'kingham',
            'title'        => 'Kingham',
            'location'     => 'Ashley, Shropshire',
            'tag'          => 'New Build Home',
            'bedrooms'     => '5',
            'style'        => 'Traditional Craftsmanship',
            'plot_size'    => '0.8 Acres',
            'living_space' => '4,800 sq ft',
            'thumb'        => 'developments/kingham/thumb.jpg',
            'gallery'      => array('developments/kingham/hero.jpg'),
            'content'      => '<p>A mastercrafted country residence combining traditional stone accents with cutting-edge bespoke interiors.</p>',
            'excerpt'      => 'A mastercrafted country residence combining traditional stone accents.',
        ),
        array(
            'slug'         => 'laurel',
            'title'        => 'Laurel',
            'location'     => 'Staffordshire',
            'tag'          => 'New Build Home',
            'bedrooms'     => '4',
            'style'        => 'Contemporary Luxury',
            'plot_size'    => '0.5 Acres',
            'living_space' => '3,600 sq ft',
            'thumb'        => 'developments/laurel/thumb.jpg',
            'gallery'      => array('developments/laurel/thumb.jpg'),
            'content'      => '<p>A stunning bespoke home offering seamless open-plan living, private grounds, and exemplary craftsmanship throughout.</p>',
            'excerpt'      => 'A stunning bespoke home offering seamless open-plan living.',
        ),
        array(
            'slug'         => 'rose',
            'title'        => 'Rose',
            'location'     => 'Cheshire',
            'tag'          => 'Renovation & Remodeling',
            'bedrooms'     => '5',
            'style'        => 'Historic Restoration',
            'plot_size'    => '1.2 Acres',
            'living_space' => '5,200 sq ft',
            'thumb'        => 'developments/rose/thumb.jpg',
            'gallery'      => array('developments/rose/hero.jpg', 'developments/rose/g5.jpg'),
            'content'      => '<p>A complete transformation of a heritage residence into a contemporary luxury haven.</p>',
            'excerpt'      => 'A complete transformation of a heritage residence into a contemporary luxury haven.',
        ),
        array(
            'slug'         => 'bay-tree',
            'title'        => 'Bay Tree',
            'location'     => 'Cheshire',
            'tag'          => 'Self Build',
            'bedrooms'     => '4',
            'style'        => 'Modern Minimalist',
            'plot_size'    => '0.45 Acres',
            'living_space' => '3,400 sq ft',
            'thumb'        => 'developments/bay-tree/thumb.jpg',
            'gallery'      => array('developments/bay-tree/thumb.jpg'),
            'content'      => '<p>A bespoke private self-build designed around light, space, and understated elegance.</p>',
            'excerpt'      => 'A bespoke private self-build designed around light, space, and understated elegance.',
        ),
        array(
            'slug'         => 'broadway',
            'title'        => 'Broadway',
            'location'     => 'Shropshire',
            'tag'          => 'New Build Home',
            'bedrooms'     => '4',
            'style'        => 'Architectural Statement',
            'plot_size'    => '0.6 Acres',
            'living_space' => '4,100 sq ft',
            'thumb'        => 'developments/broadway/thumb.jpg',
            'gallery'      => array('developments/broadway/thumb.jpg'),
            'content'      => '<p>Striking modern architecture nestled within serene rural surroundings.</p>',
            'excerpt'      => 'Striking modern architecture nestled within serene rural surroundings.',
        ),
    );

    foreach ($devs as $d) {
        $existing = get_page_by_path($d['slug'], OBJECT, 'development');
        $dev_id   = $existing ? $existing->ID : 0;
        if (!$dev_id) {
            $dev_id = wp_insert_post(array(
                'post_title'   => $d['title'],
                'post_name'    => $d['slug'],
                'post_type'    => 'development',
                'post_status'  => 'publish',
                'post_content' => $d['content'],
                'post_excerpt' => $d['excerpt'],
            ));
        }
        if ($dev_id && !is_wp_error($dev_id)) {
            update_post_meta($dev_id, '_bsd_location', $d['location']);
            update_post_meta($dev_id, '_bsd_tag', $d['tag']);
            update_post_meta($dev_id, '_bsd_bedrooms', $d['bedrooms']);
            update_post_meta($dev_id, '_bsd_style', $d['style']);
            update_post_meta($dev_id, '_bsd_plot_size', $d['plot_size']);
            update_post_meta($dev_id, '_bsd_living_space', $d['living_space']);

            // Featured Image from Media Library
            if (!empty($d['thumb'])) {
                $thumb_media = bsd_get_theme_media($d['thumb'], $d['title']);
                if (!empty($thumb_media['id'])) {
                    set_post_thumbnail($dev_id, (int)$thumb_media['id']);
                }
            }

            // Gallery Images from Media Library
            if (!empty($d['gallery'])) {
                $gallery_ids = array();
                foreach ($d['gallery'] as $g_path) {
                    $g_media = bsd_get_theme_media($g_path, $d['title']);
                    if (!empty($g_media['id'])) {
                        $gallery_ids[] = (int)$g_media['id'];
                    }
                }
                if (!empty($gallery_ids)) {
                    update_post_meta($dev_id, '_bsd_gallery', implode(',', $gallery_ids));
                }
            }
        }
    }

    // 9. Create and Assign Navigation Menus
    $primary_menu_name = 'Butler-Smith Primary Navigation';
    $primary_menu_id   = wp_create_nav_menu($primary_menu_name);
    if (!is_wp_error($primary_menu_id)) {
        wp_update_nav_menu_item($primary_menu_id, 0, array(
            'menu-item-title'  => 'Home',
            'menu-item-url'    => home_url('/'),
            'menu-item-status' => 'publish',
        ));
        wp_update_nav_menu_item($primary_menu_id, 0, array(
            'menu-item-title'  => 'Self-Build',
            'menu-item-url'    => home_url('/self-build/'),
            'menu-item-status' => 'publish',
        ));
        wp_update_nav_menu_item($primary_menu_id, 0, array(
            'menu-item-title'  => 'Renovations',
            'menu-item-url'    => home_url('/renovations/'),
            'menu-item-status' => 'publish',
        ));
        wp_update_nav_menu_item($primary_menu_id, 0, array(
            'menu-item-title'  => 'New Homes',
            'menu-item-url'    => home_url('/new-homes/'),
            'menu-item-status' => 'publish',
        ));
        wp_update_nav_menu_item($primary_menu_id, 0, array(
            'menu-item-title'  => 'About',
            'menu-item-url'    => home_url('/about/'),
            'menu-item-status' => 'publish',
        ));

        $locations = get_theme_mod('nav_menu_locations');
        if (!is_array($locations)) {
            $locations = array();
        }
        $locations['primary'] = $primary_menu_id;
        set_theme_mod('nav_menu_locations', $locations);
    }

    update_option('bsd_demo_imported', true);
}

/**
 * Admin Menu for Demo Import
 */
function bsd_add_demo_admin_menu() {
    add_theme_page(
        __('Butler-Smith Demo Import', 'butler-smith'),
        __('Demo Import', 'butler-smith'),
        'manage_options',
        'bsd-demo-import',
        'bsd_render_demo_admin_page'
    );
}
add_action('admin_menu', 'bsd_add_demo_admin_menu');

function bsd_render_demo_admin_page() {
    $imported = false;
    $media_imported_count = 0;

    if (isset($_POST['bsd_run_demo_import']) && check_admin_referer('bsd_demo_import_action', 'bsd_demo_import_nonce')) {
        bsd_seed_all_demo_content();
        $imported = true;
    }

    // Count how many media items have been imported into library
    global $wpdb;
    $media_imported_count = (int)$wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->postmeta} WHERE meta_key = '_bsd_source_relpath'");
    ?>
    <div class="wrap">
        <h1><?php _e('Butler-Smith Developments — 1-Click Demo Import & Media Importer', 'butler-smith'); ?></h1>
        <p><?php _e('This utility imports all 47 theme images into the WordPress Media Library, creates all pages (Home, Self-Build, Renovations, New Homes, About, Contact, Privacy Policy) as native Elementor Flexbox Containers linked to Media Library attachments, seeds all 9 developments with featured images, and configures primary navigation.', 'butler-smith'); ?></p>

        <div class="card" style="max-width: 680px; margin-top: 20px; padding: 18px 24px;">
            <h2><?php _e('Media Library Status', 'butler-smith'); ?></h2>
            <p>
                <strong><?php echo esc_html($media_imported_count); ?></strong> <?php _e('theme assets currently registered in the WordPress Media Library.', 'butler-smith'); ?>
                <?php if ($media_imported_count > 0) : ?>
                    <a href="<?php echo esc_url(admin_url('upload.php')); ?>" class="button button-secondary" style="margin-left: 12px;"><?php _e('View Media Library &rarr;', 'butler-smith'); ?></a>
                <?php endif; ?>
            </p>
        </div>

        <?php if ($imported || get_option('bsd_demo_imported')) : ?>
            <div class="notice notice-success inline" style="margin-top: 20px;">
                <p><strong><?php _e('Demo content & media have been imported successfully!', 'butler-smith'); ?></strong> <a href="<?php echo esc_url(home_url('/')); ?>" target="_blank"><?php _e('View Site &rarr;', 'butler-smith'); ?></a></p>
            </div>
        <?php endif; ?>

        <form method="post" action="" style="margin-top: 24px;">
            <?php wp_nonce_field('bsd_demo_import_action', 'bsd_demo_import_nonce'); ?>
            <input type="hidden" name="bsd_run_demo_import" value="1">
            <input type="submit" class="button button-primary button-hero" value="<?php esc_attr_e('Import All Media & Seed Pages', 'butler-smith'); ?>">
        </form>
    </div>
    <?php
}
