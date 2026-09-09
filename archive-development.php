<?php
/**
 * Developments Archive Template
 *
 * @package ButlerSmith
 */

get_header();
?>
<section class="hero-split compact">
    <div class="hero-text">
        <p class="eyebrow on-dark"><?php _e('Portfolio', 'butler-smith'); ?></p>
        <h1><?php _e('Our Developments', 'butler-smith'); ?></h1>
        <p class="lede"><?php _e('Explore our portfolio of prestige new build homes and private self-build residences.', 'butler-smith'); ?></p>
    </div>
    <div class="split-media">
        <div class="photo ph-21-9">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/developments/new-homes/hero.jpg'); ?>" alt="Butler-Smith Developments portfolio" loading="lazy">
        </div>
    </div>
</section>

<section class="section-alt">
    <div class="container">
        <div class="dev-grid">
            <?php
            if (have_posts()) :
                while (have_posts()) : the_post();
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
                    <?php
                endwhile;
            endif;
            ?>
        </div>
    </div>
</section>

<section class="cta-band">
    <div class="container">
        <p class="eyebrow on-dark"><?php _e('Ready When You Are', 'butler-smith'); ?></p>
        <h2><?php _e('Discuss Bringing Your Dream Home to Life', 'butler-smith'); ?></h2>
        <div class="btn-row">
            <a class="btn btn-stone" href="<?php echo esc_url(home_url('/contact/')); ?>"><?php _e('Get In Touch', 'butler-smith'); ?></a>
        </div>
    </div>
</section>
<?php
get_footer();
