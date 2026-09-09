<?php
/**
 * Generic Page Template
 *
 * @package ButlerSmith
 */

get_header();

if (have_posts()) :
    while (have_posts()) : the_post();
        if (defined('ELEMENTOR_VERSION') && \Elementor\Plugin::$instance->documents->get(get_the_ID())->is_built_with_elementor()) :
            the_content();
        else :
            ?>
            <section class="hero-split compact">
                <div class="hero-text">
                    <p class="eyebrow on-dark"><?php echo esc_html(get_bloginfo('name')); ?></p>
                    <h1><?php the_title(); ?></h1>
                </div>
                <div class="split-media">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="photo ph-21-9"><?php the_post_thumbnail('full'); ?></div>
                    <?php else : ?>
                        <div class="photo ph-21-9"><img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/home/hero.jpg'); ?>" alt="<?php the_title_attribute(); ?>"></div>
                    <?php endif; ?>
                </div>
            </section>

            <section>
                <div class="container">
                    <div class="prose reveal">
                        <?php the_content(); ?>
                    </div>
                </div>
            </section>
            <?php
        endif;
    endwhile;
endif;

get_footer();
