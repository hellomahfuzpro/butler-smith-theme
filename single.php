<?php
/**
 * Single Post Template
 *
 * @package ButlerSmith
 */

get_header();

if (have_posts()) :
    while (have_posts()) : the_post();
        ?>
        <section class="hero-split compact">
            <div class="hero-text">
                <p class="breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Home', 'butler-smith'); ?></a> &nbsp;/&nbsp; <?php the_title(); ?></p>
                <p class="eyebrow on-dark" style="margin-top:18px;"><?php echo get_the_date(); ?></p>
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
    endwhile;
endif;

get_footer();
