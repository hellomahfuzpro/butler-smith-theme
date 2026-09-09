<?php
/**
 * Butler-Smith Developments — Base Widget Class
 *
 * @package ButlerSmith
 */

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

abstract class BSD_Widget_Base extends Widget_Base {

    /**
     * Category
     */
    public function get_categories() {
        return array('butler-smith');
    }

    /**
     * Controls registration workflow
     */
    protected function register_controls() {
        $this->register_content_controls();
        $this->add_base_style_controls();
    }

    /**
     * Child classes implement this for their Content tab
     */
    abstract protected function register_content_controls();

    /**
     * Inject shared Style tab
     */
    protected function add_base_style_controls() {
        $this->start_controls_section(
            'section_base_style',
            array(
                'label' => __('Section & Layout Style', 'butler-smith'),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
                'name'     => 'section_background',
                'label'    => __('Background', 'butler-smith'),
                'types'    => array('classic', 'gradient'),
                'selector' => '{{WRAPPER}} .bsd-wrap, {{WRAPPER}} section',
            )
        );

        $this->add_responsive_control(
            'section_padding',
            array(
                'label'      => __('Padding', 'butler-smith'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', 'em', '%'),
                'selectors'  => array(
                    '{{WRAPPER}} .bsd-wrap, {{WRAPPER}} section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'section_margin',
            array(
                'label'      => __('Margin', 'butler-smith'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', 'em', '%'),
                'selectors'  => array(
                    '{{WRAPPER}} .bsd-wrap, {{WRAPPER}} section' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name'     => 'section_border',
                'selector' => '{{WRAPPER}} .bsd-wrap, {{WRAPPER}} section',
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name'     => 'section_box_shadow',
                'selector' => '{{WRAPPER}} .bsd-wrap, {{WRAPPER}} section',
            )
        );

        $this->end_controls_section();

        // Typography Overrides
        $this->start_controls_section(
            'section_base_typography',
            array(
                'label' => __('Typography Overrides', 'butler-smith'),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
            'headline_color',
            array(
                'label'     => __('Headline Color', 'butler-smith'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} h1, {{WRAPPER}} h2, {{WRAPPER}} h3' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'headline_typography',
                'label'    => __('Headline Typography', 'butler-smith'),
                'selector' => '{{WRAPPER}} h1, {{WRAPPER}} h2, {{WRAPPER}} h3',
            )
        );

        $this->add_control(
            'body_color',
            array(
                'label'     => __('Body Text Color', 'butler-smith'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} p, {{WRAPPER}} .lede' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'body_typography',
                'label'    => __('Body Typography', 'butler-smith'),
                'selector' => '{{WRAPPER}} p, {{WRAPPER}} .lede',
            )
        );

        $this->end_controls_section();
    }

    /**
     * Helper: Render Media
     */
    protected function render_media($image, $alt = '', $class = '') {
        $url = '';
        if (!empty($image['id'])) {
            $url = wp_get_attachment_image_url((int)$image['id'], 'full');
        } elseif (!empty($image['url'])) {
            $url = $image['url'];
        }

        if ($url) {
            printf(
                '<img src="%1$s" alt="%2$s" loading="lazy" class="%3$s">',
                esc_url($url),
                esc_attr($alt),
                esc_attr($class)
            );
            return;
        }

        if ($alt) {
            printf('<div class="img-ph ph-4-3 %1$s"><span>%2$s</span></div>', esc_attr($class), esc_html($alt));
        }
    }

    /**
     * Helper: Render Button
     */
    protected function render_button($text, $link, $style = 'btn-stone', $arrow = true) {
        if (empty($text)) {
            return;
        }
        $url      = !empty($link['url']) ? $link['url'] : '#';
        $target   = !empty($link['is_external']) ? ' target="_blank"' : '';
        $nofollow = !empty($link['nofollow']) ? ' rel="nofollow"' : '';
        $arrow_html = $arrow ? ' &rarr;' : '';

        printf(
            '<a href="%1$s"%2$s%3$s class="btn %4$s">%5$s%6$s</a>',
            esc_url($url),
            $target,
            $nofollow,
            esc_attr($style),
            esc_html($text),
            $arrow_html
        );
    }

    /**
     * Helper: Render Section Heading Block
     */
    protected function render_heading($eyebrow = '', $title = '', $lede = '', $on_dark = false, $centered = false) {
        $center_cls = $centered ? ' center' : '';
        $eyebrow_cls = $on_dark ? 'eyebrow on-dark' : 'eyebrow';

        echo '<div class="section-head reveal' . esc_attr($center_cls) . '">';
        if (!empty($eyebrow)) {
            printf('<p class="%1$s">%2$s</p>', esc_attr($eyebrow_cls), esc_html($eyebrow));
        }
        if (!empty($title)) {
            printf('<h2>%s</h2>', wp_kses_post($title));
        }
        if (!empty($lede)) {
            printf('<p class="lede">%s</p>', wp_kses_post($lede));
        }
        echo '</div>';
    }

    /**
     * Helper: Add Standard Heading Controls
     */
    protected function add_heading_controls($default_eyebrow = '', $default_title = '', $default_lede = '') {
        $this->add_control(
            'eyebrow',
            array(
                'label'   => __('Eyebrow Text', 'butler-smith'),
                'type'    => Controls_Manager::TEXT,
                'default' => $default_eyebrow,
            )
        );
        $this->add_control(
            'title',
            array(
                'label'   => __('Headline', 'butler-smith'),
                'type'    => Controls_Manager::TEXTAREA,
                'rows'    => 2,
                'default' => $default_title,
            )
        );
        $this->add_control(
            'lede',
            array(
                'label'   => __('Lede / Description', 'butler-smith'),
                'type'    => Controls_Manager::TEXTAREA,
                'rows'    => 3,
                'default' => $default_lede,
            )
        );
    }
}
