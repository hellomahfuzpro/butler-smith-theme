<?php
/**
 * Testimonial Widget
 *
 * @package ButlerSmith
 */

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Controls_Manager;

class BSD_Widget_Testimonial extends BSD_Widget_Base {

    public function get_name() {
        return 'bsd_testimonial';
    }

    public function get_title() {
        return __('Testimonial', 'butler-smith');
    }

    public function get_icon() {
        return 'eicon-testimonial';
    }

    protected function register_content_controls() {
        $this->start_controls_section(
            'section_content',
            array(
                'label' => __('Testimonial', 'butler-smith'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'stars',
            array(
                'label'   => __('Rating Stars', 'butler-smith'),
                'type'    => Controls_Manager::TEXT,
                'default' => '★★★★★',
            )
        );

        $this->add_control(
            'quote',
            array(
                'label'   => __('Quote Text', 'butler-smith'),
                'type'    => Controls_Manager::TEXTAREA,
                'rows'    => 5,
                'default' => '“Wow, what can I say… we just love our new home! Thank you for all of your help and patience over the last couple of months. Brilliant company to deal with, nothing was ever too much trouble. Whenever we contacted Conor he always returned our calls or messages. Thank you so much.”',
            )
        );

        $this->add_control(
            'cite',
            array(
                'label'   => __('Citation / Author', 'butler-smith'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Martin & Maria, Laurel',
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="bsd-wrap">
            <section class="section-alt">
                <div class="container">
                    <div class="testimonial reveal">
                        <?php if (!empty($settings['stars'])) : ?>
                            <div class="stars"><?php echo esc_html($settings['stars']); ?></div>
                        <?php endif; ?>

                        <?php if (!empty($settings['quote'])) : ?>
                            <blockquote><?php echo wp_kses_post($settings['quote']); ?></blockquote>
                        <?php endif; ?>

                        <?php if (!empty($settings['cite'])) : ?>
                            <cite><?php echo esc_html($settings['cite']); ?></cite>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        </div>
        <?php
    }
}
