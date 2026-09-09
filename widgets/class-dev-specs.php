<?php
/**
 * Development Specs Widget
 *
 * @package ButlerSmith
 */

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Controls_Manager;

class BSD_Widget_Dev_Specs extends BSD_Widget_Base {

    public function get_name() {
        return 'bsd_dev_specs';
    }

    public function get_title() {
        return __('Development Specs Meta', 'butler-smith');
    }

    public function get_icon() {
        return 'eicon-table';
    }

    protected function register_content_controls() {
        $this->start_controls_section(
            'section_specs',
            array(
                'label' => __('Specifications', 'butler-smith'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'bedrooms',
            array(
                'label'   => __('Bedrooms', 'butler-smith'),
                'type'    => Controls_Manager::TEXT,
                'default' => '5',
            )
        );

        $this->add_control(
            'style',
            array(
                'label'   => __('Style', 'butler-smith'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Contemporary, Natural Materials',
            )
        );

        $this->add_control(
            'plot_size',
            array(
                'label'   => __('Plot Size', 'butler-smith'),
                'type'    => Controls_Manager::TEXT,
                'default' => '0.75 Acres',
            )
        );

        $this->add_control(
            'living_space',
            array(
                'label'   => __('Living Space', 'butler-smith'),
                'type'    => Controls_Manager::TEXT,
                'default' => '4,500 sq ft',
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        // Check if on single development and post meta exists
        $post_id = get_the_ID();
        $bedrooms     = get_post_meta($post_id, '_bsd_bedrooms', true) ?: $settings['bedrooms'];
        $style        = get_post_meta($post_id, '_bsd_style', true) ?: $settings['style'];
        $plot_size    = get_post_meta($post_id, '_bsd_plot_size', true) ?: $settings['plot_size'];
        $living_space = get_post_meta($post_id, '_bsd_living_space', true) ?: $settings['living_space'];
        ?>
        <div class="bsd-wrap">
            <div class="dev-hero-meta">
                <?php if (!empty($bedrooms)) : ?>
                    <div>
                        <p class="label"><?php _e('Bedrooms', 'butler-smith'); ?></p>
                        <p class="val"><?php echo esc_html($bedrooms); ?></p>
                    </div>
                <?php endif; ?>

                <?php if (!empty($style)) : ?>
                    <div>
                        <p class="label"><?php _e('Style', 'butler-smith'); ?></p>
                        <p class="val"><?php echo esc_html($style); ?></p>
                    </div>
                <?php endif; ?>

                <?php if (!empty($plot_size)) : ?>
                    <div>
                        <p class="label"><?php _e('Plot Size', 'butler-smith'); ?></p>
                        <p class="val"><?php echo esc_html($plot_size); ?></p>
                    </div>
                <?php endif; ?>

                <?php if (!empty($living_space)) : ?>
                    <div>
                        <p class="label"><?php _e('Living Space', 'butler-smith'); ?></p>
                        <p class="val"><?php echo esc_html($living_space); ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }
}
