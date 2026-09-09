<?php
/**
 * Feature Checklist Widget
 *
 * @package ButlerSmith
 */

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Controls_Manager;
use Elementor\Repeater;

class BSD_Widget_Feature_Checklist extends BSD_Widget_Base {

    public function get_name() {
        return 'bsd_feature_checklist';
    }

    public function get_title() {
        return __('Feature Checklist', 'butler-smith');
    }

    public function get_icon() {
        return 'eicon-bullet-list';
    }

    protected function register_content_controls() {
        $this->start_controls_section(
            'section_head',
            array(
                'label' => __('Section Header', 'butler-smith'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_heading_controls('Why Butler-Smith', 'Why Choose Butler-Smith Developments?', '');

        $this->add_control(
            'is_alt',
            array(
                'label'        => __('Alternate Cream Background', 'butler-smith'),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'no',
                'return_value' => 'yes',
            )
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_features',
            array(
                'label' => __('Checklist Items', 'butler-smith'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            )
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'title',
            array(
                'label'   => __('Title (Bold)', 'butler-smith'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'End-to-End Project Management',
            )
        );

        $repeater->add_control(
            'desc',
            array(
                'label'   => __('Description', 'butler-smith'),
                'type'    => Controls_Manager::TEXTAREA,
                'rows'    => 2,
                'default' => 'we take care of everything, so you don\'t have to.',
            )
        );

        $this->add_control(
            'items',
            array(
                'label'       => __('Features List', 'butler-smith'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => array(
                    array(
                        'title' => 'End-to-End Project Management',
                        'desc'  => 'we take care of everything, so you don\'t have to.',
                    ),
                    array(
                        'title' => 'Bespoke Design & Craftsmanship',
                        'desc'  => 'every home we build is unique, designed for the people who live in it.',
                    ),
                    array(
                        'title' => 'Planning Expertise',
                        'desc'  => 'we navigate the complexities of planning applications with ease.',
                    ),
                    array(
                        'title' => 'A Stress-Free Experience',
                        'desc'  => 'our streamlined process makes your self-build journey enjoyable.',
                    ),
                ),
                'title_field' => '{{{ title }}}',
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $bg_cls = ('yes' === $settings['is_alt']) ? ' class="section-alt"' : '';
        ?>
        <div class="bsd-wrap">
            <section<?php echo $bg_cls; ?>>
                <div class="container">
                    <?php $this->render_heading($settings['eyebrow'], $settings['title'], $settings['lede']); ?>

                    <?php if (!empty($settings['items'])) : ?>
                        <ul class="feature-list reveal">
                            <?php foreach ($settings['items'] as $item) : ?>
                                <li>
                                    <span class="mark">&#10003;</span>
                                    <div>
                                        <strong><?php echo esc_html($item['title']); ?></strong>
                                        <?php if (!empty($item['desc'])) : ?>
                                            &mdash; <?php echo wp_kses_post($item['desc']); ?>
                                        <?php endif; ?>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </section>
        </div>
        <?php
    }
}
