<?php
/**
 * Template Name: About Page
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
            <!-- Hero Split Compact -->
            <section class="hero-split compact">
                <div class="hero-text">
                    <p class="eyebrow on-dark">About Butler-Smith</p>
                    <h1>Prestige Property Development, Built on Craftsmanship</h1>
                    <p class="lede">Bespoke homes, exceptional by design, across Cheshire, Shropshire and Staffordshire. Having built our reputation through our own developments, we now focus on helping clients build theirs.</p>
                </div>
                <div class="split-media">
                    <div class="photo">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/about/hero.jpg'); ?>" alt="A Butler-Smith Developments new build home" loading="lazy">
                    </div>
                </div>
            </section>

            <!-- Our Story Split -->
            <section>
                <div class="split reveal">
                    <div class="split-media">
                        <div class="photo ph-4-3">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/about/team-portrait.jpg'); ?>" alt="Butler-Smith Developments founders / team portrait" loading="lazy">
                        </div>
                    </div>
                    <div>
                        <p class="eyebrow">Our Story</p>
                        <h2>From a Single Green Field to a Portfolio of Prestige Homes</h2>
                        <p class="lede">Butler-Smith Developments began with a single vision: bring exceptional homes to life. Since 2018, we've delivered a portfolio of 10 boutique developments and private self-builds across Cheshire, Shropshire and Staffordshire, each built to the same exacting standard.</p>
                        <p>We know exactly what a project like this takes, and we take the stress out of getting there &mdash; supporting you through design, planning and build. Every home is designed and built in-house, working with a trusted network of high-spec suppliers, architects, interior designers and craftsmen, and backed by our market-leading ten-year warranty.</p>
                    </div>
                </div>
            </section>

            <!-- What We Stand For -->
            <section class="section-alt">
                <div class="container">
                    <div class="section-head center reveal" style="margin-left:auto;margin-right:auto;">
                        <p class="eyebrow">What We Stand For</p>
                        <h2>The Butler-Smith Standard</h2>
                    </div>
                    <ul class="feature-list reveal">
                        <li><span class="mark">&#10003;</span><div><strong>Bespoke Design &amp; Craftsmanship</strong> &mdash; every home we build is unique, designed for the people who live in it.</div></li>
                        <li><span class="mark">&#10003;</span><div><strong>End-to-End Project Management</strong> &mdash; we take care of everything, from planning through to build and handover.</div></li>
                        <li><span class="mark">&#10003;</span><div><strong>Planning Expertise</strong> &mdash; we navigate the complexities of planning applications with ease.</div></li>
                        <li><span class="mark">&#10003;</span><div><strong>A Stress-Free Experience</strong> &mdash; a streamlined process designed to make building or renovating an enjoyable journey.</div></li>
                        <li><span class="mark">&#10003;</span><div><strong>Ten-Year Warranty</strong> &mdash; every Butler-Smith home comes backed by a market-leading structural warranty.</div></li>
                    </ul>
                </div>
            </section>

            <!-- Testimonial -->
            <section>
                <div class="container">
                    <div class="testimonial reveal">
                        <div class="stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
                        <blockquote>&ldquo;Wow, what can I say&hellip; we just love our new home! Brilliant company to deal with, nothing was ever too much trouble.&rdquo;</blockquote>
                        <cite>Martin &amp; Maria, Laurel</cite>
                    </div>
                </div>
            </section>

            <!-- CTA Band -->
            <section class="cta-band">
                <div class="container">
                    <p class="eyebrow on-dark">Let's Talk</p>
                    <h2>Discuss Bringing Your Dream Home to Life</h2>
                    <div class="btn-row">
                        <a class="btn btn-stone" href="<?php echo esc_url(home_url('/contact/')); ?>">Get In Touch</a>
                    </div>
                </div>
            </section>
            <?php
        endif;
    endwhile;
endif;

get_footer();
