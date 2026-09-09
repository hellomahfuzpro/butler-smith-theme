<?php
/**
 * Single Development Case Study Template
 *
 * @package ButlerSmith
 */

get_header();

if (have_posts()) :
    while (have_posts()) : the_post();
        $location     = get_post_meta(get_the_ID(), '_bsd_location', true) ?: 'Cheshire';
        $tag          = get_post_meta(get_the_ID(), '_bsd_tag', true) ?: 'Bespoke Development';
        $bedrooms     = get_post_meta(get_the_ID(), '_bsd_bedrooms', true);
        $style        = get_post_meta(get_the_ID(), '_bsd_style', true);
        $plot_size    = get_post_meta(get_the_ID(), '_bsd_plot_size', true);
        $living_space = get_post_meta(get_the_ID(), '_bsd_living_space', true);
        ?>
        <!-- Hero Split Compact -->
        <section class="hero-split compact">
            <div class="hero-text">
                <p class="breadcrumb"><a href="<?php echo esc_url(home_url('/new-homes/')); ?>">New Homes</a> &nbsp;/&nbsp; <?php the_title(); ?></p>
                <p class="eyebrow on-dark" style="margin-top:18px;"><?php echo esc_html($tag); ?> &middot; <?php echo esc_html($location); ?></p>
                <h1><?php the_title(); ?></h1>

                <?php if ($bedrooms || $style || $plot_size || $living_space) : ?>
                    <div class="dev-hero-meta">
                        <?php if ($bedrooms) : ?>
                            <div><p class="label"><?php _e('Bedrooms', 'butler-smith'); ?></p><p class="val"><?php echo esc_html($bedrooms); ?></p></div>
                        <?php endif; ?>
                        <?php if ($style) : ?>
                            <div><p class="label"><?php _e('Style', 'butler-smith'); ?></p><p class="val"><?php echo esc_html($style); ?></p></div>
                        <?php endif; ?>
                        <?php if ($plot_size) : ?>
                            <div><p class="label"><?php _e('Plot Size', 'butler-smith'); ?></p><p class="val"><?php echo esc_html($plot_size); ?></p></div>
                        <?php endif; ?>
                        <?php if ($living_space) : ?>
                            <div><p class="label"><?php _e('Living Space', 'butler-smith'); ?></p><p class="val"><?php echo esc_html($living_space); ?></p></div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="split-media">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="photo ph-21-9"><?php the_post_thumbnail('full'); ?></div>
                <?php else : ?>
                    <div class="img-ph ph-21-9"><span><?php the_title(); ?> — photography</span></div>
                <?php endif; ?>
            </div>
        </section>

        <!-- Prose Story -->
        <section>
            <div class="container">
                <div class="prose reveal">
                    <?php the_content(); ?>
                </div>
            </div>
        </section>

        <!-- Gallery Strip -->
        <section class="section-alt">
            <div class="container">
                <div class="section-head reveal">
                    <p class="eyebrow"><?php _e('Gallery', 'butler-smith'); ?></p>
                    <h2><?php the_title(); ?>, <?php _e('In Detail', 'butler-smith'); ?></h2>
                </div>
                <div class="gallery-strip reveal">
                    <div class="img-ph ph-4-3"><span><?php _e('Photos coming soon', 'butler-smith'); ?></span></div>
                    <div class="img-ph ph-4-3"><span><?php _e('Photos coming soon', 'butler-smith'); ?></span></div>
                    <div class="img-ph ph-4-3"><span><?php _e('Photos coming soon', 'butler-smith'); ?></span></div>
                </div>
            </div>
        </section>

        <!-- CTA Band -->
        <section class="cta-band">
            <div class="container">
                <p class="eyebrow on-dark"><?php _e('Interested in a Home Like This?', 'butler-smith'); ?></p>
                <h2><?php _e("Let's Talk About Your Project", 'butler-smith'); ?></h2>
                <div class="btn-row">
                    <a class="btn btn-stone" href="<?php echo esc_url(home_url('/contact/')); ?>"><?php _e('Get In Touch', 'butler-smith'); ?></a>
                </div>
            </div>
        </section>
        <?php
    endwhile;
endif;

get_footer();
