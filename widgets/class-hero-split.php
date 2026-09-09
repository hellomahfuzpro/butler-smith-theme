<?php
/**
 * Hero Split Widget
 *
 * @package ButlerSmith
 */

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Controls_Manager;
use Elementor\Utils;

class BSD_Widget_Hero_Split extends BSD_Widget_Base {

    public function get_name() {
        return 'bsd_hero_split';
    }

    public function get_title() {
        return __('Hero Split', 'butler-smith');
    }

    public function get_icon() {
        return 'eicon-banner';
    }

    protected function register_content_controls() {
        $this->start_controls_section(
            'section_content',
            array(
                'label' => __('Hero Content', 'butler-smith'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'is_compact',
            array(
                'label'        => __('Compact Mode (Subpages)', 'butler-smith'),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'no',
                'return_value' => 'yes',
            )
        );

        $this->add_control(
            'breadcrumb',
            array(
                'label'       => __('Breadcrumb (Optional)', 'butler-smith'),
                'type'        => Controls_Manager::TEXT,
                'default'     => '',
                'placeholder' => 'New Homes / Ashwood',
                'condition'   => array('is_compact' => 'yes'),
            )
        );

        $this->add_control(
            'eyebrow',
            array(
                'label'   => __('Eyebrow', 'butler-smith'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Cheshire · Shropshire · Staffordshire',
            )
        );

        $this->add_control(
            'title',
            array(
                'label'   => __('Headline', 'butler-smith'),
                'type'    => Controls_Manager::TEXTAREA,
                'rows'    => 3,
                'default' => 'Designing and Building Exceptional Bespoke Homes from Concept to Completion',
            )
        );

        $this->add_control(
            'lede',
            array(
                'label'   => __('Lede / Subtitle', 'butler-smith'),
                'type'    => Controls_Manager::TEXTAREA,
                'rows'    => 3,
                'default' => 'Butler-Smith Developments creates considered, high-craft homes for private clients and our own boutique developments — from first sketch to final handover.',
            )
        );

        $this->add_control(
            'image',
            array(
                'label'   => __('Hero Image', 'butler-smith'),
                'type'    => Controls_Manager::MEDIA,
                'default' => array(
                    'url' => get_template_directory_uri() . '/assets/img/home/hero.jpg',
                ),
            )
        );

        $this->add_control(
            'btn1_text',
            array(
                'label'   => __('Primary Button Text', 'butler-smith'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Discuss Bringing Your Dream Home to Life',
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
                'label'   => __('Secondary Button Text', 'butler-smith'),
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
        $settings   = $this->get_settings_for_display();
        $is_compact = ('yes' === $settings['is_compact']);
        $compact_cls = $is_compact ? ' compact' : '';
        ?>
        <div class="bsd-wrap">
            <section class="hero-split<?php echo esc_attr($compact_cls); ?>">
                <div class="hero-text">
                    <?php if (!empty($settings['breadcrumb'])) : ?>
                        <p class="breadcrumb"><?php echo wp_kses_post($settings['breadcrumb']); ?></p>
                    <?php endif; ?>

                    <?php if (!empty($settings['eyebrow'])) : ?>
                        <p class="eyebrow on-dark"><?php echo esc_html($settings['eyebrow']); ?></p>
                    <?php endif; ?>

                    <?php if (!empty($settings['title'])) : ?>
                        <h1><?php echo wp_kses_post($settings['title']); ?></h1>
                    <?php endif; ?>

                    <?php if (!empty($settings['lede'])) : ?>
                        <p class="lede"><?php echo wp_kses_post($settings['lede']); ?></p>
                    <?php endif; ?>

                    <?php if (!empty($settings['btn1_text']) || !empty($settings['btn2_text'])) : ?>
                        <div class="hero-actions">
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
                <div class="split-media">
                    <div class="photo ph-21-9">
                        <?php $this->render_media($settings['image'], !empty($settings['title']) ? strip_tags($settings['title']) : 'Hero Image'); ?>
                    </div>
                </div>
            </section>
        </div>
        <?php
    }
}
