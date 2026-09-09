<?php
/**
 * Three Ways / Card Grid Widget
 *
 * @package ButlerSmith
 */

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Controls_Manager;
use Elementor\Repeater;

class BSD_Widget_Three_Ways extends BSD_Widget_Base {

    public function get_name() {
        return 'bsd_three_ways';
    }

    public function get_title() {
        return __('Three Ways Cards', 'butler-smith');
    }

    public function get_icon() {
        return 'eicon-gallery-grid';
    }

    protected function register_content_controls() {
        $this->start_controls_section(
            'section_head',
            array(
                'label' => __('Section Header', 'butler-smith'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_heading_controls('What We Do', 'Three Ways We Build', '');

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
                'label'   => __('Title', 'butler-smith'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Self-Build Projects',
            )
        );

        $repeater->add_control(
            'desc',
            array(
                'label'   => __('Description', 'butler-smith'),
                'type'    => Controls_Manager::TEXTAREA,
                'rows'    => 3,
                'default' => 'End-to-end guidance for private clients building a truly bespoke home, from sourcing land to final handover.',
            )
        );

        $repeater->add_control(
            'link_text',
            array(
                'label'   => __('Link Text', 'butler-smith'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Explore Self-Build →',
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
                        'num'       => '01',
                        'title'     => 'Self-Build Projects',
                        'desc'      => 'End-to-end guidance for private clients building a truly bespoke home, from sourcing land to final handover.',
                        'link_text' => 'Explore Self-Build →',
                        'link_url'  => array('url' => '/self-build/'),
                    ),
                    array(
                        'num'       => '02',
                        'title'     => 'Renovations & Remodeling',
                        'desc'      => 'Transforming existing homes across the region — extensions, conversions and full renovations, built with care.',
                        'link_text' => 'Explore Renovations →',
                        'link_url'  => array('url' => '/renovations/'),
                    ),
                    array(
                        'num'       => '03',
                        'title'     => 'New Build Homes',
                        'desc'      => 'Our own boutique developments — a curated collection of luxury new build homes across Cheshire & Shropshire.',
                        'link_text' => 'Explore New Homes →',
                        'link_url'  => array('url' => '/new-homes/'),
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
            <section>
                <div class="container">
                    <?php $this->render_heading($settings['eyebrow'], $settings['title'], $settings['lede']); ?>

                    <?php if (!empty($settings['cards'])) : ?>
                        <div class="grid-3">
                            <?php foreach ($settings['cards'] as $card) : ?>
                                <div class="market-card reveal">
                                    <p class="num"><?php echo esc_html($card['num']); ?></p>
                                    <h3><?php echo esc_html($card['title']); ?></h3>
                                    <p><?php echo esc_html($card['desc']); ?></p>
                                    <?php if (!empty($card['link_text'])) : ?>
                                        <a class="link" href="<?php echo esc_url($card['link_url']['url']); ?>">
                                            <?php echo esc_html($card['link_text']); ?>
                                        </a>
                                    <?php endif; ?>
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
