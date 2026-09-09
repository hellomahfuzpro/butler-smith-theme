<?php
/**
 * Split Content (Image + Text Feature) Widget
 *
 * @package ButlerSmith
 */

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Controls_Manager;

class BSD_Widget_Split_Content extends BSD_Widget_Base {

    public function get_name() {
        return 'bsd_split_content';
    }

    public function get_title() {
        return __('Split Content Feature', 'butler-smith');
    }

    public function get_icon() {
        return 'eicon-columns';
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
            'image_position',
            array(
                'label'   => __('Image Position', 'butler-smith'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'left',
                'options' => array(
                    'left'  => __('Left', 'butler-smith'),
                    'right' => __('Right', 'butler-smith'),
                ),
            )
        );

        $this->add_control(
            'image',
            array(
                'label'   => __('Feature Image', 'butler-smith'),
                'type'    => Controls_Manager::MEDIA,
                'default' => array(
                    'url' => get_template_directory_uri() . '/assets/img/home/craft-detail.jpg',
                ),
            )
        );

        $this->add_control(
            'eyebrow',
            array(
                'label'   => __('Eyebrow', 'butler-smith'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Our Promise',
            )
        );

        $this->add_control(
            'title',
            array(
                'label'   => __('Headline', 'butler-smith'),
                'type'    => Controls_Manager::TEXTAREA,
                'rows'    => 2,
                'default' => 'A Market-Leading Ten-Year Warranty, On Every Build',
            )
        );

        $this->add_control(
            'lede',
            array(
                'label'   => __('Lede / Highlight Paragraph', 'butler-smith'),
                'type'    => Controls_Manager::TEXTAREA,
                'rows'    => 3,
                'default' => 'We are proud to offer a market-leading ten-year warranty with every build, ensuring our clients enjoy unparalleled peace of mind knowing that our workmanship is of the highest quality.',
            )
        );

        $this->add_control(
            'body',
            array(
                'label'   => __('Detailed Narrative', 'butler-smith'),
                'type'    => Controls_Manager::WYSIWYG,
                'default' => '<p>At Butler-Smith, customer satisfaction is paramount. While timber is a primary material in our constructions, it naturally undergoes slight shrinkage, particularly when exposed to heat. To minimise this, we meticulously control the warming process before completion.</p><p>Our dedication extends beyond the warranty period. Our after-sales customer service team stands ready to assist with any concerns during the first two years of ownership, and we remain committed to your homeownership experience long after.</p>',
            )
        );

        $this->add_control(
            'btn_text',
            array(
                'label'   => __('Button Text (Optional)', 'butler-smith'),
                'type'    => Controls_Manager::TEXT,
                'default' => '',
            )
        );

        $this->add_control(
            'btn_link',
            array(
                'label'   => __('Button URL', 'butler-smith'),
                'type'    => Controls_Manager::URL,
                'default' => array('url' => '/contact/'),
                'condition' => array('btn_text!' => ''),
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $is_right = ('right' === $settings['image_position']);
        ?>
        <div class="bsd-wrap">
            <section>
                <div class="split reveal<?php echo $is_right ? ' reverse' : ''; ?>">
                    <?php if (!$is_right) : ?>
                        <div class="split-media">
                            <div class="photo ph-4-3">
                                <?php $this->render_media($settings['image'], !empty($settings['title']) ? strip_tags($settings['title']) : 'Feature detail'); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div>
                        <?php if (!empty($settings['eyebrow'])) : ?>
                            <p class="eyebrow"><?php echo esc_html($settings['eyebrow']); ?></p>
                        <?php endif; ?>

                        <?php if (!empty($settings['title'])) : ?>
                            <h2><?php echo wp_kses_post($settings['title']); ?></h2>
                        <?php endif; ?>

                        <?php if (!empty($settings['lede'])) : ?>
                            <p class="lede"><?php echo wp_kses_post($settings['lede']); ?></p>
                        <?php endif; ?>

                        <?php if (!empty($settings['body'])) : ?>
                            <?php echo wp_kses_post($settings['body']); ?>
                        <?php endif; ?>

                        <?php if (!empty($settings['btn_text'])) : ?>
                            <div style="margin-top: 24px;">
                                <a class="btn btn-primary" href="<?php echo esc_url($settings['btn_link']['url']); ?>">
                                    <?php echo esc_html($settings['btn_text']); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php if ($is_right) : ?>
                        <div class="split-media">
                            <div class="photo ph-4-3">
                                <?php $this->render_media($settings['image'], !empty($settings['title']) ? strip_tags($settings['title']) : 'Feature detail'); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </section>
        </div>
        <?php
    }
}
