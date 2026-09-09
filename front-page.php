<?php
/**
 * Template Name: Front Page
 *
 * @package ButlerSmith
 */

get_header();

if (have_posts()) :
    while (have_posts()) : the_post();
        // Check if page is built with Elementor
        if (defined('ELEMENTOR_VERSION') && \Elementor\Plugin::$instance->documents->get(get_the_ID())->is_built_with_elementor()) :
            the_content();
        else :
            ?>
            <!-- Hero Split -->
            <section class="hero-split">
                <div class="hero-text">
                    <p class="eyebrow on-dark">Cheshire &middot; Shropshire &middot; Staffordshire</p>
                    <h1>Designing and Building Exceptional Bespoke Homes from Concept to Completion</h1>
                    <p class="lede">Butler-Smith Developments creates considered, high-craft homes for private clients and our own boutique developments — from first sketch to final handover.</p>
                    <div class="hero-actions">
                        <a class="btn btn-stone" href="<?php echo esc_url(home_url('/contact/')); ?>">Discuss Bringing Your Dream Home to Life</a>
                        <a class="btn btn-on-dark" href="<?php echo esc_url(home_url('/new-homes/')); ?>">View Our Developments</a>
                    </div>
                </div>
                <div class="split-media">
                    <div class="photo">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/home/hero.jpg'); ?>" alt="Butler-Smith Developments | Driftwood | Self Build" loading="lazy">
                    </div>
                </div>
            </section>

            <!-- Three Ways We Build -->
            <section>
                <div class="container">
                    <div class="section-head reveal">
                        <p class="eyebrow">What We Do</p>
                        <h2>Three Ways We Build</h2>
                    </div>
                    <div class="grid-3">
                        <div class="market-card reveal">
                            <p class="num">01</p>
                            <h3>Self-Build Projects</h3>
                            <p>End-to-end guidance for private clients building a truly bespoke home, from sourcing land to final handover.</p>
                            <a class="link" href="<?php echo esc_url(home_url('/self-build/')); ?>">Explore Self-Build &rarr;</a>
                        </div>
                        <div class="market-card reveal">
                            <p class="num">02</p>
                            <h3>Renovations &amp; Remodeling</h3>
                            <p>Transforming existing homes across the region — extensions, conversions and full renovations, built with care.</p>
                            <a class="link" href="<?php echo esc_url(home_url('/renovations/')); ?>">Explore Renovations &rarr;</a>
                        </div>
                        <div class="market-card reveal">
                            <p class="num">03</p>
                            <h3>New Build Homes</h3>
                            <p>Our own boutique developments — a curated collection of luxury new build homes across Cheshire &amp; Shropshire.</p>
                            <a class="link" href="<?php echo esc_url(home_url('/new-homes/')); ?>">Explore New Homes &rarr;</a>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Testimonial -->
            <section class="section-alt">
                <div class="container">
                    <div class="testimonial reveal">
                        <div class="stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
                        <blockquote>&ldquo;Wow, what can I say&hellip; we just love our new home! Thank you for all of your help and patience over the last couple of months. Brilliant company to deal with, nothing was ever too much trouble. Whenever we contacted Conor he always returned our calls or messages. Thank you so much.&rdquo;</blockquote>
                        <cite>Martin &amp; Maria, Laurel</cite>
                    </div>
                </div>
            </section>

            <!-- Our Promise Split -->
            <section>
                <div class="split reveal">
                    <div class="split-media">
                        <div class="photo ph-4-3">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/home/craft-detail.jpg'); ?>" alt="Butler-Smith Developments craftsmanship detail" loading="lazy">
                        </div>
                    </div>
                    <div>
                        <p class="eyebrow">Our Promise</p>
                        <h2>A Market-Leading Ten-Year Warranty, On Every Build</h2>
                        <p class="lede">We are proud to offer a market-leading ten-year warranty with every build, ensuring our clients enjoy unparalleled peace of mind knowing that our workmanship is of the highest quality. Our warranties are widely accepted by nearly all mortgage lenders, underscoring our commitment to excellence.</p>
                        <p>At Butler-Smith, customer satisfaction is paramount. While timber is a primary material in our constructions, it naturally undergoes slight shrinkage, particularly when exposed to heat. To minimise this, we meticulously control the warming process before completion. Despite our best efforts, some minor cracking may occur within the initial two years as the timber settles — once this period elapses and the timber stabilises, we conduct a comprehensive inspection to address any resulting cracks, ensuring your home maintains its pristine condition.</p>
                        <p>Our dedication extends beyond the warranty period. Our after-sales customer service team stands ready to assist with any concerns during the first two years of ownership, and we remain committed to your homeownership experience long after.</p>
                    </div>
                </div>
            </section>

            <!-- Closing CTA Band -->
            <section class="cta-band">
                <div class="container">
                    <p class="eyebrow on-dark">Ready When You Are</p>
                    <h2>Discuss Bringing Your Dream Home to Life</h2>
                    <p class="lede" style="margin-left:auto;margin-right:auto;">Whether you're starting a self-build, planning a renovation, or exploring our current developments, our team is ready to talk.</p>
                    <div class="btn-row">
                        <a class="btn btn-stone" href="<?php echo esc_url(home_url('/contact/')); ?>">Get In Touch</a>
                        <a class="btn btn-on-dark" href="<?php echo esc_url(home_url('/new-homes/')); ?>">View Our Developments</a>
                    </div>
                </div>
            </section>
            <?php
        endif;
    endwhile;
endif;

get_footer();
