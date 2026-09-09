<?php
/**
 * CTA Band Widget
 *
 * @package ButlerSmith
 */

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Controls_Manager;

class BSD_Widget_Cta_Band extends BSD_Widget_Base {

    public function get_name() {
        return 'bsd_cta_band';
    }

    public function get_title() {
        return __('CTA Band', 'butler-smith');
    }

    public function get_icon() {
        return 'eicon-call-to-action';
    }

    protected function register_content_controls() {
        $this->start_controls_section(
            'section_content',
            array(
                'label' => __('Content', 'butler-smith'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'eyebrow',
            array(
                'label'   => __('Eyebrow', 'butler-smith'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Ready When You Are',
            )
        );

        $this->add_control(
            'title',
            array(
                'label'   => __('Headline', 'butler-smith'),
                'type'    => Controls_Manager::TEXTAREA,
                'rows'    => 2,
                'default' => 'Discuss Bringing Your Dream Home to Life',
            )
        );

        $this->add_control(
            'lede',
            array(
                'label'   => __('Lede Paragraph', 'butler-smith'),
                'type'    => Controls_Manager::TEXTAREA,
                'rows'    => 3,
                'default' => "Whether you're starting a self-build, planning a renovation, or exploring our current developments, our team is ready to talk.",
            )
        );

        $this->add_control(
            'btn1_text',
            array(
                'label'   => __('Primary Button Text', 'butler-smith'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Get In Touch',
            )
        );

        $this->add_control(
            'btn1_link',
            array(
                'label'   => __('Primary Button Link', 'butler-smith'),
                'type'    => Controls_Manager::URL,
                'default' => array('url' => '/contact/'),
            )
        );

        $this->add_control(
            'btn2_text',
            array(
                'label'   => __('Secondary Button Text (Optional)', 'butler-smith'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'View Our Developments',
            )
        );

        $this->add_control(
            'btn2_link',
            array(
                'label'   => __('Secondary Button Link', 'butler-smith'),
                'type'    => Controls_Manager::URL,
                'default' => array('url' => '/new-homes/'),
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="bsd-wrap">
            <section class="cta-band">
                <div class="container">
                    <?php if (!empty($settings['eyebrow'])) : ?>
                        <p class="eyebrow on-dark"><?php echo esc_html($settings['eyebrow']); ?></p>
                    <?php endif; ?>

                    <?php if (!empty($settings['title'])) : ?>
                        <h2><?php echo wp_kses_post($settings['title']); ?></h2>
                    <?php endif; ?>

                    <?php if (!empty($settings['lede'])) : ?>
                        <p class="lede" style="margin-left:auto;margin-right:auto;"><?php echo wp_kses_post($settings['lede']); ?></p>
                    <?php endif; ?>

                    <?php if (!empty($settings['btn1_text']) || !empty($settings['btn2_text'])) : ?>
                        <div class="btn-row">
                            <?php if (!empty($settings['btn1_text'])) : ?>
                                <a class="btn btn-stone" href="<?php echo esc_url($settings['btn1_link']['url']); ?>">
                                    <?php echo esc_html($settings['btn1_text']); ?>
                                </a>
                            <?php endif; ?>
                            <?php if (!empty($settings['btn2_text'])) : ?>
                                <a class="btn btn-on-dark" href="<?php echo esc_url($settings['btn2_link']['url']); ?>">
                                    <?php echo esc_html($settings['btn2_text']); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </section>
        </div>
        <?php
    }
}
