<?php
/**
 * Gallery Strip Widget
 *
 * @package ButlerSmith
 */

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Controls_Manager;
use Elementor\Repeater;

class BSD_Widget_Gallery_Strip extends BSD_Widget_Base {

    public function get_name() {
        return 'bsd_gallery_strip';
    }

    public function get_title() {
        return __('Gallery Strip', 'butler-smith');
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

        $this->add_heading_controls('Gallery', 'Development, In Detail', '');

        $this->add_control(
            'is_alt',
            array(
                'label'        => __('Alternate Background', 'butler-smith'),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'return_value' => 'yes',
            )
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_images',
            array(
                'label' => __('Gallery Images', 'butler-smith'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            )
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'image',
            array(
                'label'   => __('Image', 'butler-smith'),
                'type'    => Controls_Manager::MEDIA,
                'default' => array('url' => ''),
            )
        );

        $repeater->add_control(
            'caption',
            array(
                'label'   => __('Placeholder / Caption Text', 'butler-smith'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Photos coming soon',
            )
        );

        $this->add_control(
            'items',
            array(
                'label'       => __('Image List', 'butler-smith'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => array(
                    array('caption' => 'Photos coming soon'),
                    array('caption' => 'Photos coming soon'),
                    array('caption' => 'Photos coming soon'),
                ),
                'title_field' => '{{{ caption }}}',
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
                        <div class="gallery-strip reveal">
                            <?php foreach ($settings['items'] as $item) : ?>
                                <div class="photo ph-4-3">
                                    <?php if (!empty($item['image']['url'])) : ?>
                                        <?php $this->render_media($item['image'], $item['caption']); ?>
                                    <?php else : ?>
                                        <div class="img-ph ph-4-3">
                                            <span><?php echo esc_html(!empty($item['caption']) ? $item['caption'] : 'Photos coming soon'); ?></span>
                                        </div>
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
