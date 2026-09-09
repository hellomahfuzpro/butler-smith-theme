<?php
/**
 * Template Name: Self-Build Page
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
                    <p class="eyebrow on-dark">Self-Build Projects</p>
                    <h1>Build Your Dream Home With an Experienced Premium Developer</h1>
                    <p class="lede">From design support to project management in Cheshire and the surrounding area.</p>
                    <div class="hero-actions">
                        <a class="btn btn-stone" href="#portfolio">View Portfolio &rarr;</a>
                    </div>
                </div>
                <div class="split-media">
                    <div class="photo ph-21-9">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/developments/self-build/hero.jpg'); ?>" alt="Butley | Self Build | Butler Smith Developments" loading="lazy">
                    </div>
                </div>
            </section>

            <!-- Consultation Split -->
            <section>
                <div class="split reveal">
                    <div class="split-media">
                        <div class="photo ph-4-3">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/developments/self-build/consultation.jpg'); ?>" alt="Butler-Smith self-build client consultation" loading="lazy">
                        </div>
                    </div>
                    <div>
                        <p class="lede">Building your own home is an exciting opportunity to create a space that's truly yours, tailored to your lifestyle, tastes, and future plans. But navigating the process&mdash;from sourcing land to obtaining planning permission and managing construction&mdash;can feel overwhelming.</p>
                        <p>That's where Butler Smith Developments comes in. With years of experience in designing and delivering bespoke homes, we manage every stage of the build process, ensuring a seamless journey from concept to completion. Whether you already own a plot or need help finding the perfect location, we provide expert guidance and a stress-free experience, bringing your vision to life with exceptional craftsmanship.</p>
                        <a class="btn btn-primary" href="<?php echo esc_url(home_url('/contact/')); ?>">Discuss Bringing Your Dream Home to Life</a>
                    </div>
                </div>
            </section>

            <!-- 5 Steps Process -->
            <section class="section-alt">
                <div class="container">
                    <div class="section-head reveal">
                        <p class="eyebrow">Our Process</p>
                        <h2>Five Steps From Vision to Handover</h2>
                    </div>

                    <div class="step reveal">
                        <div class="step-num">01</div>
                        <div>
                            <h3>Initial Consultation</h3>
                            <p>Every successful project starts with a conversation. We take the time to understand your vision, design preferences, lifestyle needs, and budget. Whether you have a clear idea of what you want or need inspiration, we'll offer expert advice on what's possible based on location, planning regulations, and architectural styles.</p>
                            <ul class="checks">
                                <li>Your preferred home style &mdash; contemporary, traditional, or something in between</li>
                                <li>Key features &mdash; open-plan living, home office space and other sustainable design elements</li>
                                <li>Budget expectations and what's achievable within your investment</li>
                            </ul>
                        </div>
                    </div>

                    <div class="step reveal">
                        <div class="step-num">02</div>
                        <div>
                            <h3>Sourcing Land</h3>
                            <p>Already have a plot? Great &mdash; we can assess its suitability and begin planning your home straight away. If not, don't worry. With access to a network of trusted land agents and off-market opportunities, we assist in finding prime plots that align with your budget and vision, guiding you through due diligence before you commit.</p>
                        </div>
                    </div>

                    <div class="step reveal">
                        <div class="step-num">03</div>
                        <div>
                            <h3>Planning &amp; Design</h3>
                            <p>Once your location is secured, our design team works closely with you to create a home that maximises the potential of your plot while meeting your exact requirements.</p>
                            <ul class="checks">
                                <li>Architectural designs and drawings</li>
                                <li>Interior layouts and exterior aesthetics</li>
                                <li>Sustainable building options and energy-efficient features</li>
                            </ul>
                            <p style="margin-top:14px;">With your approval, we submit planning applications and all necessary documentation to the local authority, managing the entire process and keeping you informed every step of the way.</p>
                        </div>
                    </div>

                    <div class="step reveal">
                        <div class="step-num">04</div>
                        <div>
                            <h3>The Build Process</h3>
                            <p>This is where your vision starts taking shape. Our experienced construction team, alongside trusted tradespeople, ensures every element of your home is built to the highest standard.</p>
                            <ul class="checks">
                                <li>Site preparation and groundwork</li>
                                <li>Structural build, roofing, and glazing</li>
                                <li>Interior finishes, including kitchens, bathrooms, and flooring</li>
                            </ul>
                            <p style="margin-top:14px;">Throughout the build, we maintain clear communication, provide regular updates, and ensure timelines and budgets stay on track.</p>
                        </div>
                    </div>

                    <div class="step reveal">
                        <div class="step-num">05</div>
                        <div>
                            <h3>Handover &amp; Aftercare</h3>
                            <p>Once your home is complete, we carry out a full walkthrough to ensure everything meets your expectations.</p>
                            <ul class="checks">
                                <li>A detailed handover pack, including warranties and maintenance guides</li>
                                <li>A final quality check to ensure every detail is perfect</li>
                                <li>Ongoing aftercare support, so you can settle in with confidence</li>
                            </ul>
                            <p style="margin-top:14px;">At Butler Smith Developments, our relationship with clients doesn't end at handover &mdash; we're always available to assist with any support needed after you move in.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Why Butler-Smith -->
            <section>
                <div class="container">
                    <div class="section-head reveal">
                        <p class="eyebrow">Why Butler-Smith</p>
                        <h2>Why Choose Butler-Smith Developments?</h2>
                    </div>
                    <ul class="feature-list reveal">
                        <li><span class="mark">&#10003;</span><div><strong>End-to-End Project Management</strong> &mdash; we take care of everything, so you don't have to.</div></li>
                        <li><span class="mark">&#10003;</span><div><strong>Bespoke Design &amp; Craftsmanship</strong> &mdash; every home we build is unique, designed for the people who live in it.</div></li>
                        <li><span class="mark">&#10003;</span><div><strong>Planning Expertise</strong> &mdash; we navigate the complexities of planning applications with ease.</div></li>
                        <li><span class="mark">&#10003;</span><div><strong>A Stress-Free Experience</strong> &mdash; our streamlined process makes your self-build journey enjoyable.</div></li>
                    </ul>
                </div>
            </section>

            <!-- Portfolio Case Studies -->
            <section class="section-alt" id="portfolio">
                <div class="container">
                    <div class="section-head reveal">
                        <p class="eyebrow">Case Studies</p>
                        <h2>Private Self-Builds We've Delivered</h2>
                    </div>
                    <div class="dev-grid">
                        <a class="dev-card reveal" href="<?php echo esc_url(home_url('/developments/mulberry/')); ?>">
                            <div class="frame">
                                <div class="photo ph-4-3">
                                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/developments/mulberry/thumb.jpg'); ?>" alt="Mulberry, Barlaston" loading="lazy">
                                </div>
                            </div>
                            <div class="meta">
                                <div>
                                    <h3>Mulberry</h3>
                                    <p class="loc">Barlaston, Staffordshire</p>
                                </div>
                                <span class="arrow">&#8594;</span>
                            </div>
                            <p class="excerpt">A modern interpretation of the timeless Georgian dwelling, built entirely around one client's brief.</p>
                        </a>
                        <a class="dev-card reveal" href="<?php echo esc_url(home_url('/developments/butley/')); ?>">
                            <div class="frame">
                                <div class="photo ph-4-3">
                                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/developments/butley/thumb.jpg'); ?>" alt="Butley, Cheshire" loading="lazy">
                                </div>
                            </div>
                            <div class="meta">
                                <div>
                                    <h3>Butley</h3>
                                    <p class="loc">Cheshire</p>
                                </div>
                                <span class="arrow">&#8594;</span>
                            </div>
                            <p class="excerpt">A Mediterranean-inspired private build, blending sun-drenched charm with modern sophistication.</p>
                        </a>
                    </div>
                </div>
            </section>

            <!-- CTA Band -->
            <section class="cta-band">
                <div class="container">
                    <p class="eyebrow on-dark">Ready to Start Your Self-Build Journey?</p>
                    <h2>Let's Create Something Exceptional Together</h2>
                    <p class="lede" style="margin-left:auto;margin-right:auto;">Get in touch today to discuss your dream home.</p>
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
