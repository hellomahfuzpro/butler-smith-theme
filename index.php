<?php
/**
 * Main Index Template
 *
 * @package ButlerSmith
 */

get_header();
?>
<section class="hero-split compact">
    <div class="hero-text">
        <p class="eyebrow on-dark"><?php echo esc_html(get_bloginfo('name')); ?></p>
        <h1><?php _e('Latest Updates', 'butler-smith'); ?></h1>
    </div>
    <div class="split-media">
        <div class="photo ph-21-9"><img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/home/hero.jpg'); ?>" alt="Butler-Smith Developments"></div>
    </div>
</section>

<section>
    <div class="container">
        <div class="grid-3">
            <?php
            if (have_posts()) :
                while (have_posts()) : the_post();
                    ?>
                    <article class="market-card reveal">
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <p><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                        <a class="link" href="<?php the_permalink(); ?>"><?php _e('Read Article &rarr;', 'butler-smith'); ?></a>
                    </article>
                    <?php
                endwhile;
            endif;
            ?>
        </div>
    </div>
</section>
<?php
get_footer();
