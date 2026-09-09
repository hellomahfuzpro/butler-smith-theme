<?php
/**
 * Process Steps Widget
 *
 * @package ButlerSmith
 */

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Controls_Manager;
use Elementor\Repeater;

class BSD_Widget_Process_Steps extends BSD_Widget_Base {

    public function get_name() {
        return 'bsd_process_steps';
    }

    public function get_title() {
        return __('Process Steps', 'butler-smith');
    }

    public function get_icon() {
        return 'eicon-editor-list-ol';
    }

    protected function register_content_controls() {
        $this->start_controls_section(
            'section_head',
            array(
                'label' => __('Section Header', 'butler-smith'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_heading_controls('Our Process', 'Five Steps From Vision to Handover', '');

        $this->end_controls_section();

        $this->start_controls_section(
            'section_steps',
            array(
                'label' => __('Steps', 'butler-smith'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            )
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'num',
            array(
                'label'   => __('Step Number', 'butler-smith'),
                'type'    => Controls_Manager::TEXT,
                'default' => '01',
            )
        );

        $repeater->add_control(
            'title',
            array(
                'label'   => __('Step Title', 'butler-smith'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Initial Consultation',
            )
        );

        $repeater->add_control(
            'desc',
            array(
                'label'   => __('Description', 'butler-smith'),
                'type'    => Controls_Manager::TEXTAREA,
                'rows'    => 3,
                'default' => 'Every successful project starts with a conversation. We take the time to understand your vision, design preferences, lifestyle needs, and budget.',
            )
        );

        $repeater->add_control(
            'checks',
            array(
                'label'       => __('Checklist Items (One per line)', 'butler-smith'),
                'type'        => Controls_Manager::TEXTAREA,
                'rows'        => 3,
                'default'     => "Your preferred home style — contemporary, traditional, or something in between\nKey features — open-plan living, home office space and other sustainable elements\nBudget expectations and what's achievable within your investment",
            )
        );

        $repeater->add_control(
            'note',
            array(
                'label'   => __('Bottom Note (Optional)', 'butler-smith'),
                'type'    => Controls_Manager::TEXTAREA,
                'rows'    => 2,
                'default' => '',
            )
        );

        $this->add_control(
            'steps',
            array(
                'label'       => __('Steps List', 'butler-smith'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => array(
                    array(
                        'num'    => '01',
                        'title'  => 'Initial Consultation',
                        'desc'   => 'Every successful project starts with a conversation. We take the time to understand your vision, design preferences, lifestyle needs, and budget.',
                        'checks' => "Your preferred home style — contemporary, traditional, or something in between\nKey features — open-plan living, home office space and other sustainable elements\nBudget expectations and what's achievable within your investment",
                        'note'   => '',
                    ),
                    array(
                        'num'    => '02',
                        'title'  => 'Sourcing Land',
                        'desc'   => "Already have a plot? Great — we can assess its suitability and begin planning your home straight away. If not, we assist in finding prime plots.",
                        'checks' => '',
                        'note'   => '',
                    ),
                    array(
                        'num'    => '03',
                        'title'  => 'Planning & Design',
                        'desc'   => 'Once your location is secured, our design team works closely with you to create a home that maximises the potential of your plot.',
                        'checks' => "Architectural designs and drawings\nInterior layouts and exterior aesthetics\nSustainable building options and energy-efficient features",
                        'note'   => 'With your approval, we submit planning applications and all necessary documentation to the local authority, managing the entire process.',
                    ),
                    array(
                        'num'    => '04',
                        'title'  => 'The Build Process',
                        'desc'   => 'This is where your vision starts taking shape. Our experienced construction team ensures every element of your home is built to the highest standard.',
                        'checks' => "Site preparation and groundwork\nStructural build, roofing, and glazing\nInterior finishes, including kitchens, bathrooms, and flooring",
                        'note'   => 'Throughout the build, we maintain clear communication, provide regular updates, and ensure timelines and budgets stay on track.',
                    ),
                    array(
                        'num'    => '05',
                        'title'  => 'Handover & Aftercare',
                        'desc'   => 'Once your home is complete, we carry out a full walkthrough to ensure everything meets your expectations.',
                        'checks' => "A detailed handover pack, including warranties and maintenance guides\nA final quality check to ensure every detail is perfect\nOngoing aftercare support, so you can settle in with confidence",
                        'note'   => "At Butler Smith Developments, our relationship with clients doesn't end at handover — we're always available to assist after you move in.",
                    ),
                ),
                'title_field' => '{{{ num }}} - {{{ title }}}',
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
                    <?php $this->render_heading($settings['eyebrow'], $settings['title'], $settings['lede']); ?>

                    <?php if (!empty($settings['steps'])) : ?>
                        <?php foreach ($settings['steps'] as $step) : ?>
                            <div class="step reveal">
                                <div class="step-num"><?php echo esc_html($step['num']); ?></div>
                                <div>
                                    <h3><?php echo esc_html($step['title']); ?></h3>
                                    <?php if (!empty($step['desc'])) : ?>
                                        <p><?php echo wp_kses_post($step['desc']); ?></p>
                                    <?php endif; ?>

                                    <?php if (!empty($step['checks'])) : 
                                        $lines = array_filter(array_map('trim', explode("\n", $step['checks'])));
                                        if (!empty($lines)) : ?>
                                            <ul class="checks">
                                                <?php foreach ($lines as $line) : ?>
                                                    <li><?php echo esc_html($line); ?></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <?php if (!empty($step['note'])) : ?>
                                        <p style="margin-top:14px;"><?php echo wp_kses_post($step['note']); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </section>
        </div>
        <?php
    }
}
