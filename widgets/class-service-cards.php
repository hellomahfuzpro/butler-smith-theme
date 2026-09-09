<?php
/**
 * Service Cards (Two/Three Column Route Cards) Widget
 *
 * @package ButlerSmith
 */

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Controls_Manager;
use Elementor\Repeater;

class BSD_Widget_Service_Cards extends BSD_Widget_Base {

    public function get_name() {
        return 'bsd_service_cards';
    }

    public function get_title() {
        return __('Service Cards', 'butler-smith');
    }

    public function get_icon() {
        return 'eicon-image-box';
    }

    protected function register_content_controls() {
        $this->start_controls_section(
            'section_head',
            array(
                'label' => __('Section Header', 'butler-smith'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_heading_controls('Two Routes In', 'Two Ways to Secure a Butler-Smith Home', '');

        $this->add_control(
            'is_alt',
            array(
                'label'        => __('Alternate Background', 'butler-smith'),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'return_value' => 'yes',
            )
        );

        $this->add_control(
            'centered',
            array(
                'label'        => __('Center Header', 'butler-smith'),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'return_value' => 'yes',
            )
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_cards',
            array(
                'label' => __('Cards', 'butler-smith'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            )
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'image',
            array(
                'label'   => __('Card Image', 'butler-smith'),
                'type'    => Controls_Manager::MEDIA,
                'default' => array(
                    'url' => get_template_directory_uri() . '/assets/img/home/own-developments.jpg',
                ),
            )
        );

        $repeater->add_control(
            'title',
            array(
                'label'   => __('Card Title', 'butler-smith'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Butler-Smith Developments',
            )
        );

        $repeater->add_control(
            'desc',
            array(
                'label'   => __('Description', 'butler-smith'),
                'type'    => Controls_Manager::TEXTAREA,
                'rows'    => 4,
                'default' => 'Our own brand developments have brought a carefully selected collection of luxury new build homes to the market.',
            )
        );

        $repeater->add_control(
            'link_text',
            array(
                'label'   => __('Link Text (Optional)', 'butler-smith'),
                'type'    => Controls_Manager::TEXT,
                'default' => '',
            )
        );

        $repeater->add_control(
            'link_url',
            array(
                'label'   => __('Link URL', 'butler-smith'),
                'type'    => Controls_Manager::URL,
                'default' => array('url' => '/self-build/'),
            )
        );

        $this->add_control(
            'cards',
            array(
                'label'       => __('Cards List', 'butler-smith'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => array(
                    array(
                        'title'     => 'Butler-Smith Developments',
                        'desc'      => 'Our own brand developments have brought a carefully selected collection of luxury new build homes to the market in Nantwich, Faddiley & Woore in Cheshire and Ashley in Shropshire.',
                        'image'     => array('url' => get_template_directory_uri() . '/assets/img/home/own-developments.jpg'),
                        'link_text' => '',
                    ),
                    array(
                        'title'     => 'Private Self-Builds',
                        'desc'      => 'Already have a plot, or dreaming of building a home entirely around your own lifestyle? Our private client service manages your self-build from concept to completion.',
                        'image'     => array('url' => get_template_directory_uri() . '/assets/img/home/private-self-build.jpg'),
                        'link_text' => 'Learn More About Private Builds →',
                        'link_url'  => array('url' => '/self-build/'),
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
        $is_centered = ('yes' === $settings['centered']);
        $count = !empty($settings['cards']) ? count($settings['cards']) : 2;
        $grid_cls = ($count >= 3) ? 'grid-3' : 'grid-2';
        ?>
        <div class="bsd-wrap">
            <section<?php echo $bg_cls; ?>>
                <div class="container">
                    <?php $this->render_heading($settings['eyebrow'], $settings['title'], $settings['lede'], false, $is_centered); ?>

                    <?php if (!empty($settings['cards'])) : ?>
                        <div class="<?php echo esc_attr($grid_cls); ?>">
                            <?php foreach ($settings['cards'] as $card) : ?>
                                <div class="service-card reveal">
                                    <div class="photo ph-4-3">
                                        <?php $this->render_media($card['image'], $card['title']); ?>
                                    </div>
                                    <div class="body">
                                        <h3><?php echo esc_html($card['title']); ?></h3>
                                        <p><?php echo wp_kses_post($card['desc']); ?></p>
                                        <?php if (!empty($card['link_text'])) : ?>
                                            <div style="margin-top: 16px;">
                                                <a class="link" style="font-size:0.75rem;letter-spacing:0.14em;text-transform:uppercase;border-bottom:1px solid var(--bsd-ink);padding-bottom:2px;" href="<?php echo esc_url($card['link_url']['url']); ?>">
                                                    <?php echo esc_html($card['link_text']); ?>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </section>
        </div>
        <?php
    }
}
