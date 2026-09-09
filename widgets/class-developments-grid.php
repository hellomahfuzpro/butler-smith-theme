<?php
/**
 * Developments Grid / Portfolio Widget
 *
 * @package ButlerSmith
 */

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Controls_Manager;
use Elementor\Repeater;

class BSD_Widget_Developments_Grid extends BSD_Widget_Base {

    public function get_name() {
        return 'bsd_developments_grid';
    }

    public function get_title() {
        return __('Developments Grid', 'butler-smith');
    }

    public function get_icon() {
        return 'eicon-posts-grid';
    }

    protected function register_content_controls() {
        $this->start_controls_section(
            'section_head',
            array(
                'label' => __('Section Header', 'butler-smith'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_heading_controls('Case Studies', "Private Self-Builds We've Delivered", '');

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
            'section_items',
            array(
                'label' => __('Developments Cards', 'butler-smith'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'query_type',
            array(
                'label'   => __('Source', 'butler-smith'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'manual',
                'options' => array(
                    'manual'  => __('Manual Cards (Below)', 'butler-smith'),
                    'dynamic' => __('Dynamic Developments CPT', 'butler-smith'),
                ),
            )
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'title',
            array(
                'label'   => __('Title', 'butler-smith'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Mulberry',
            )
        );

        $repeater->add_control(
            'location',
            array(
                'label'   => __('Location', 'butler-smith'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Barlaston, Staffordshire',
            )
        );

        $repeater->add_control(
            'excerpt',
            array(
                'label'   => __('Excerpt', 'butler-smith'),
                'type'    => Controls_Manager::TEXTAREA,
                'rows'    => 2,
                'default' => "A modern interpretation of the timeless Georgian dwelling, built entirely around one client's brief.",
            )
        );

        $repeater->add_control(
            'image',
            array(
                'label'   => __('Thumbnail Image', 'butler-smith'),
                'type'    => Controls_Manager::MEDIA,
                'default' => array(
                    'url' => get_template_directory_uri() . '/assets/img/developments/mulberry/thumb.jpg',
                ),
            )
        );

        $repeater->add_control(
            'link',
            array(
                'label'   => __('Page Link', 'butler-smith'),
                'type'    => Controls_Manager::URL,
                'default' => array('url' => '/developments/mulberry/'),
            )
        );

        $this->add_control(
            'cards',
            array(
                'label'       => __('Developments List', 'butler-smith'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => array(
                    array(
                        'title'    => 'Mulberry',
                        'location' => 'Barlaston, Staffordshire',
                        'excerpt'  => "A modern interpretation of the timeless Georgian dwelling, built entirely around one client's brief.",
                        'image'    => array('url' => get_template_directory_uri() . '/assets/img/developments/mulberry/thumb.jpg'),
                        'link'     => array('url' => '/developments/mulberry/'),
                    ),
                    array(
                        'title'    => 'Butley',
                        'location' => 'Cheshire',
                        'excerpt'  => 'A Mediterranean-inspired private build, blending sun-drenched charm with modern sophistication.',
                        'image'    => array('url' => get_template_directory_uri() . '/assets/img/developments/butley/thumb.jpg'),
                        'link'     => array('url' => '/developments/butley/'),
                    ),
                ),
                'title_field' => '{{{ title }}} ({{{ location }}})',
                'condition'   => array('query_type' => 'manual'),
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $bg_cls = ('yes' === $settings['is_alt']) ? ' class="section-alt"' : '';
        ?>
        <div class="bsd-wrap">
            <section<?php echo $bg_cls; ?> id="portfolio">
                <div class="container">
                    <?php $this->render_heading($settings['eyebrow'], $settings['title'], $settings['lede']); ?>

                    <div class="dev-grid">
                        <?php if ('dynamic' === $settings['query_type']) : 
                            $query = new \WP_Query(array(
                                'post_type'      => 'development',
                                'posts_per_page' => 12,
                            ));
                            if ($query->have_posts()) :
                                while ($query->have_posts()) : $query->the_post();
                                    $loc = get_post_meta(get_the_ID(), '_bsd_location', true);
                                    ?>
                                    <a class="dev-card reveal" href="<?php the_permalink(); ?>">
                                        <div class="frame">
                                            <div class="photo ph-4-3">
                                                <?php if (has_post_thumbnail()) : ?>
                                                    <?php the_post_thumbnail('large'); ?>
                                                <?php else : ?>
                                                    <div class="img-ph ph-4-3"><span><?php the_title(); ?></span></div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="meta">
                                            <div>
                                                <h3><?php the_title(); ?></h3>
                                                <?php if (!empty($loc)) : ?>
                                                    <p class="loc"><?php echo esc_html($loc); ?></p>
                                                <?php endif; ?>
                                            </div>
                                            <span class="arrow">&#8594;</span>
                                        </div>
                                        <p class="excerpt"><?php echo wp_trim_words(get_the_excerpt(), 24); ?></p>
                                    </a>
                                <?php endwhile;
                                wp_reset_postdata();
                            endif;
                        else :
                            if (!empty($settings['cards'])) :
                                foreach ($settings['cards'] as $card) : ?>
                                    <a class="dev-card reveal" href="<?php echo esc_url($card['link']['url']); ?>">
                                        <div class="frame">
                                            <div class="photo ph-4-3">
                                                <?php $this->render_media($card['image'], $card['title']); ?>
                                            </div>
                                        </div>
                                        <div class="meta">
                                            <div>
                                                <h3><?php echo esc_html($card['title']); ?></h3>
                                                <p class="loc"><?php echo esc_html($card['location']); ?></p>
                                            </div>
                                            <span class="arrow">&#8594;</span>
                                        </div>
                                        <p class="excerpt"><?php echo esc_html($card['excerpt']); ?></p>
                                    </a>
                                <?php endforeach;
                            endif;
                        endif; ?>
                    </div>
                </div>
            </section>
        </div>
        <?php
    }
}
