<?php
/**
 * Contact Form & Info Widget
 *
 * @package ButlerSmith
 */

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Controls_Manager;
use Elementor\Repeater;

class BSD_Widget_Contact extends BSD_Widget_Base {

    public function get_name() {
        return 'bsd_contact';
    }

    public function get_title() {
        return __('Contact Section & Form', 'butler-smith');
    }

    public function get_icon() {
        return 'eicon-form-horizontal';
    }

    protected function register_content_controls() {
        $this->start_controls_section(
            'section_info',
            array(
                'label' => __('Contact Information (Right Column)', 'butler-smith'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'eyebrow',
            array(
                'label'   => __('Eyebrow', 'butler-smith'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Why Get In Touch',
            )
        );

        $this->add_control(
            'title',
            array(
                'label'   => __('Headline', 'butler-smith'),
                'type'    => Controls_Manager::TEXT,
                'default' => "Let's Talk About Your Project",
            )
        );

        $this->add_control(
            'lede',
            array(
                'label'   => __('Lede Text', 'butler-smith'),
                'type'    => Controls_Manager::TEXTAREA,
                'rows'    => 3,
                'default' => "Whether you're exploring a self-build, planning a renovation, or interested in one of our current developments, we'd love to hear from you.",
            )
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'title',
            array(
                'label'   => __('Bold Title', 'butler-smith'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'No-obligation initial conversation',
            )
        );

        $repeater->add_control(
            'desc',
            array(
                'label'   => __('Description', 'butler-smith'),
                'type'    => Controls_Manager::TEXTAREA,
                'rows'    => 2,
                'default' => 'to understand your vision and what\'s possible.',
            )
        );

        $this->add_control(
            'checks',
            array(
                'label'       => __('Checklist Items', 'butler-smith'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => array(
                    array(
                        'title' => 'No-obligation initial conversation',
                        'desc'  => 'to understand your vision and what\'s possible.',
                    ),
                    array(
                        'title' => 'Honest, expert guidance',
                        'desc'  => 'on budget, planning and timelines from the outset.',
                    ),
                    array(
                        'title' => 'A dedicated point of contact',
                        'desc'  => 'throughout your project, from first enquiry to handover.',
                    ),
                ),
                'title_field' => '{{{ title }}}',
            )
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_form',
            array(
                'label' => __('Form Options', 'butler-smith'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'btn_text',
            array(
                'label'   => __('Submit Button Text', 'butler-smith'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Send Enquiry',
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="bsd-wrap">
            <section>
                <div class="container">
                    <div class="split reveal">
                        <div>
                            <form class="enquiry-form" method="post" action="<?php echo esc_url(admin_url('admin-ajax.php')); ?>">
                                <?php wp_nonce_field('bsd_contact_nonce', 'nonce'); ?>
                                <input type="hidden" name="action" value="bsd_submit_enquiry">

                                <div class="form-row">
                                    <div class="field">
                                        <label for="first-name"><?php _e('First Name', 'butler-smith'); ?></label>
                                        <input id="first-name" name="first-name" type="text" required>
                                    </div>
                                    <div class="field">
                                        <label for="last-name"><?php _e('Last Name', 'butler-smith'); ?></label>
                                        <input id="last-name" name="last-name" type="text" required>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="field">
                                        <label for="email"><?php _e('Email', 'butler-smith'); ?></label>
                                        <input id="email" name="email" type="email" required>
                                    </div>
                                    <div class="field">
                                        <label for="phone"><?php _e('Phone', 'butler-smith'); ?></label>
                                        <input id="phone" name="phone" type="tel">
                                    </div>
                                </div>

                                <div class="field">
                                    <label for="enquiry-type"><?php _e("I'm Interested In", 'butler-smith'); ?></label>
                                    <select id="enquiry-type" name="enquiry-type">
                                        <option value="Self-Build Project"><?php _e('Self-Build Project', 'butler-smith'); ?></option>
                                        <option value="Renovation & Remodeling"><?php _e('Renovation & Remodeling', 'butler-smith'); ?></option>
                                        <option value="Current Development / New Build Home"><?php _e('Current Development / New Build Home', 'butler-smith'); ?></option>
                                        <option value="General Enquiry"><?php _e('General Enquiry', 'butler-smith'); ?></option>
                                    </select>
                                </div>

                                <div class="field">
                                    <label for="message"><?php _e('Tell Us About Your Project', 'butler-smith'); ?></label>
                                    <textarea id="message" name="message" required></textarea>
                                </div>

                                <button class="btn btn-primary" type="submit"><?php echo esc_html($settings['btn_text']); ?></button>
                                <div class="form-feedback"></div>
                            </form>
                        </div>

                        <div>
                            <?php if (!empty($settings['eyebrow'])) : ?>
                                <p class="eyebrow"><?php echo esc_html($settings['eyebrow']); ?></p>
                            <?php endif; ?>

                            <?php if (!empty($settings['title'])) : ?>
                                <h2><?php echo esc_html($settings['title']); ?></h2>
                            <?php endif; ?>

                            <?php if (!empty($settings['lede'])) : ?>
                                <p class="lede"><?php echo esc_html($settings['lede']); ?></p>
                            <?php endif; ?>

                            <?php if (!empty($settings['checks'])) : ?>
                                <ul class="feature-list">
                                    <?php foreach ($settings['checks'] as $check) : ?>
                                        <li>
                                            <span class="mark">&#10003;</span>
                                            <div>
                                                <strong><?php echo esc_html($check['title']); ?></strong>
                                                <?php if (!empty($check['desc'])) : ?>
                                                    &mdash; <?php echo esc_html($check['desc']); ?>
                                                <?php endif; ?>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php
    }
}
