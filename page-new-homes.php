<?php
/**
 * Template Name: New Homes Page
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
                    <p class="eyebrow on-dark">New Build Homes</p>
                    <h1>Designing &amp; Building Exceptional Bespoke Homes</h1>
                    <p class="lede">Butler-Smith has delivered 4 public developments, comprising 7 luxury new build homes &mdash; each one designed and built to a standard that's simply not comparable to anything else on the market.</p>
                    <div class="hero-actions">
                        <a class="btn btn-stone" href="#portfolio">View Portfolio &rarr;</a>
                    </div>
                </div>
                <div class="split-media">
                    <div class="photo ph-21-9">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/developments/new-homes/hero.jpg'); ?>" alt="Ashwood | Kitchen Design | Butler Smith Developments" loading="lazy">
                    </div>
                </div>
            </section>

            <!-- Site Plan Split -->
            <section>
                <div class="split reveal">
                    <div class="split-media">
                        <div class="photo ph-4-3">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/home/site-plan.jpg'); ?>" alt="Aerial view of a Butler-Smith development plot" loading="lazy">
                        </div>
                    </div>
                    <div>
                        <p class="lede">Whether you're searching for your next home from one of our current developments, or dreaming of a private self-build tailored entirely to you, our property development service brings together considered design, meticulous planning, and exceptional craftsmanship from first sketch to final handover.</p>
                    </div>
                </div>
            </section>

            <!-- Two Routes In -->
            <section class="section-alt">
                <div class="container">
                    <div class="section-head center reveal" style="margin-left:auto;margin-right:auto;">
                        <p class="eyebrow">Two Routes In</p>
                        <h2>Two Ways to Secure a Butler-Smith Home</h2>
                    </div>
                    <div class="grid-2">
                        <div class="service-card reveal">
                            <div class="photo ph-4-3">
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/home/own-developments.jpg'); ?>" alt="A Butler-Smith Developments new build home" loading="lazy">
                            </div>
                            <div class="body">
                                <h3>Butler-Smith Developments</h3>
                                <p>Our own brand developments have brought a carefully selected collection of luxury new build homes to the market in Nantwich, Faddiley &amp; Woore in Cheshire and Ashley in Shropshire. Keep an eye on our socials for any upcoming developments for the market.</p>
                            </div>
                        </div>
                        <div class="service-card reveal">
                            <div class="photo ph-4-3">
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/home/private-self-build.jpg'); ?>" alt="A private Butler-Smith self-build project" loading="lazy">
                            </div>
                            <div class="body">
                                <h3>Private Self-Builds</h3>
                                <p>Already have a plot, or dreaming of building a home entirely around your own lifestyle? Our private client service manages your self-build from concept to completion &mdash; sourcing land, securing planning permission, and delivering a genuinely bespoke home built to your exact specification.</p>
                                <div style="margin-top: 16px;">
                                    <a class="link" style="font-size:0.75rem;letter-spacing:0.14em;text-transform:uppercase;border-bottom:1px solid var(--bsd-ink);padding-bottom:2px;" href="<?php echo esc_url(home_url('/self-build/')); ?>">Learn More About Private Builds &rarr;</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- What Sets Us Apart -->
            <section>
                <div class="container">
                    <div class="section-head reveal">
                        <p class="eyebrow">What Sets Us Apart</p>
                        <h2>What Sets a Butler-Smith Home Apart</h2>
                    </div>
                    <ul class="feature-list reveal">
                        <li><span class="mark">&#10003;</span><div><strong>Bespoke Design &amp; Craftsmanship</strong> &mdash; every home we build is unique, designed for the people who live in it, not pulled from a catalogue of standard house types.</div></li>
                        <li><span class="mark">&#10003;</span><div><strong>End-to-End Project Management</strong> &mdash; we take care of everything, from planning through to build and handover, so you don't have to.</div></li>
                        <li><span class="mark">&#10003;</span><div><strong>Planning Expertise</strong> &mdash; we navigate the complexities of planning applications with ease, drawing on years of experience across Cheshire and Staffordshire.</div></li>
                        <li><span class="mark">&#10003;</span><div><strong>A Stress-Free Experience</strong> &mdash; our streamlined process is designed to make building or buying a new home an enjoyable journey, not an overwhelming one.</div></li>
                        <li><span class="mark">&#10003;</span><div><strong>Ten-Year Warranty</strong> &mdash; every Butler-Smith home comes backed by a market-leading structural warranty, for complete peace of mind.</div></li>
                    </ul>
                </div>
            </section>

            <!-- Our Developments Portfolio -->
            <section class="section-alt" id="portfolio">
                <div class="container">
                    <div class="section-head reveal">
                        <p class="eyebrow">Our Developments</p>
                        <h2>Explore Our Homes</h2>
                    </div>
                    <div class="dev-grid">
                        <a class="dev-card reveal" href="<?php echo esc_url(home_url('/developments/driftwood/')); ?>">
                            <div class="frame">
                                <div class="photo ph-4-3">
                                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/developments/driftwood/thumb.jpg'); ?>" alt="Driftwood" loading="lazy">
                                </div>
                            </div>
                            <div class="meta">
                                <div>
                                    <h3>Driftwood</h3>
                                    <p class="loc">Ashley, Shropshire</p>
                                </div>
                                <span class="arrow">&#8594;</span>
                            </div>
                            <p class="excerpt">Two exquisite 4-bedroom residences on a private gated 0.75-acre plot.</p>
                        </a>
                        <a class="dev-card reveal" href="<?php echo esc_url(home_url('/developments/ashwood/')); ?>">
                            <div class="frame">
                                <div class="photo ph-4-3">
                                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/developments/ashwood/thumb.jpg'); ?>" alt="Ashwood" loading="lazy">
                                </div>
                            </div>
                            <div class="meta">
                                <div>
                                    <h3>Ashwood</h3>
                                    <p class="loc">Ashley, Shropshire</p>
                                </div>
                                <span class="arrow">&#8594;</span>
                            </div>
                            <p class="excerpt">A contemporary smart home set behind grand stonework, with a landscaped garden.</p>
                        </a>
                    </div>
                </div>
            </section>

            <!-- CTA Band -->
            <section class="cta-band">
                <div class="container">
                    <p class="eyebrow on-dark">Ready When You Are</p>
                    <h2>Discuss Bringing Your Dream Home to Life</h2>
                    <p class="lede" style="margin-left:auto;margin-right:auto;">Whether you're starting a self-build, planning a renovation, or exploring our current developments, our team is ready to talk.</p>
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
