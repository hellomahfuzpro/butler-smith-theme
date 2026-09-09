<?php
/**
 * Template Name: Renovations Page
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
                    <p class="eyebrow on-dark">Renovations &amp; Remodeling</p>
                    <h1>Transform Your Property with Master Craftsmanship</h1>
                    <p class="lede">From architectural redesigns to structural alterations, extensions, and high-end remodeling across Cheshire and Shropshire.</p>
                    <div class="hero-actions">
                        <a class="btn btn-stone" href="#services">Explore Services &rarr;</a>
                    </div>
                </div>
                <div class="split-media">
                    <div class="photo">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/developments/renovations/hero.jpg'); ?>" alt="Butler-Smith renovations and remodeling" loading="lazy">
                    </div>
                </div>
            </section>

            <!-- Craftsmanship Split -->
            <section>
                <div class="split reveal">
                    <div class="split-media">
                        <div class="photo ph-4-3">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/developments/renovations/craft.jpg'); ?>" alt="High-end renovation detail" loading="lazy">
                        </div>
                    </div>
                    <div>
                        <p class="lede">Whether you're looking to extend, reconfigure, or completely revitalize an existing residence, our renovation service brings the same uncompromising standards of craftsmanship and project management that define our new build developments.</p>
                        <p>We work with discerning homeowners to modernize period properties, unlock hidden square footage, and create harmonious indoor-outdoor living spaces tailored to contemporary life.</p>
                        <a class="btn btn-primary" href="<?php echo esc_url(home_url('/contact/')); ?>">Discuss Your Renovation Project</a>
                    </div>
                </div>
            </section>

            <!-- Two Ways We Transform -->
            <section class="section-alt" id="services">
                <div class="container">
                    <div class="section-head center reveal" style="margin-left:auto;margin-right:auto;">
                        <p class="eyebrow">Our Renovation Scope</p>
                        <h2>Two Ways We Transform Existing Properties</h2>
                    </div>
                    <div class="grid-2">
                        <div class="service-card reveal">
                            <div class="photo ph-4-3">
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/developments/renovations/kitchen.jpg'); ?>" alt="Kitchen extension and remodeling" loading="lazy">
                            </div>
                            <div class="body">
                                <h3>Extensions &amp; Space Remodeling</h3>
                                <p>Single and multi-storey extensions, open-plan kitchen and living reconfigurations, glass links, and structural wall removals that redefine how your home flows and functions.</p>
                            </div>
                        </div>
                        <div class="service-card reveal">
                            <div class="photo ph-4-3">
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/developments/renovations/bathroom.jpg'); ?>" alt="Full home luxury renovation" loading="lazy">
                            </div>
                            <div class="body">
                                <h3>Full Property Transformations</h3>
                                <p>Comprehensive back-to-brick renovations, historical restorations, mechanical and electrical overhauls, bespoke joinery, and turn-key luxury interior finishes.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- 5 Steps Process -->
            <section>
                <div class="container">
                    <div class="section-head reveal">
                        <p class="eyebrow">Our Process</p>
                        <h2>Five Steps to Your Transformed Home</h2>
                    </div>

                    <div class="step reveal">
                        <div class="step-num">01</div>
                        <div>
                            <h3>Site Survey &amp; Feasibility</h3>
                            <p>We review your existing home, examine the structural integrity, discuss your objectives and lifestyle requirements, and identify architectural possibilities and planning constraints.</p>
                        </div>
                    </div>

                    <div class="step reveal">
                        <div class="step-num">02</div>
                        <div>
                            <h3>Architectural Design &amp; Approvals</h3>
                            <p>Our team develops structural drawings, 3D visualizations, and material specifications, securing all necessary planning permissions and building control approvals.</p>
                        </div>
                    </div>

                    <div class="step reveal">
                        <div class="step-num">03</div>
                        <div>
                            <h3>Fixed-Price Costing &amp; Schedule</h3>
                            <p>We provide a fully itemised, transparent quotation and agreed schedule of works before construction starts, ensuring no surprises along the way.</p>
                        </div>
                    </div>

                    <div class="step reveal">
                        <div class="step-num">04</div>
                        <div>
                            <h3>Precision Build &amp; Craftsmanship</h3>
                            <p>Our master tradespeople execute the works with meticulous attention to detail, maintaining a clean, secure site and regular milestone reviews with you.</p>
                        </div>
                    </div>

                    <div class="step reveal">
                        <div class="step-num">05</div>
                        <div>
                            <h3>Handover &amp; Snag-Free Guarantee</h3>
                            <p>We perform exhaustive quality inspections, provide full warranties for all materials and installations, and offer dedicated post-completion care.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Why Renovate with Butler-Smith -->
            <section class="section-alt">
                <div class="container">
                    <div class="section-head reveal">
                        <p class="eyebrow">Why Butler-Smith</p>
                        <h2>Why Renovate With Butler-Smith Developments?</h2>
                    </div>
                    <ul class="feature-list reveal">
                        <li><span class="mark">&#10003;</span><div><strong>Full Turnkey Management</strong> &mdash; from initial planning drawings to plumbing, electrics, joinery and decorating.</div></li>
                        <li><span class="mark">&#10003;</span><div><strong>Respect for Your Home</strong> &mdash; we maintain clean, secure, and respectful worksites throughout every phase.</div></li>
                        <li><span class="mark">&#10003;</span><div><strong>Structural Precision</strong> &mdash; decades of combined engineering and building expertise across Cheshire and Shropshire.</div></li>
                        <li><span class="mark">&#10003;</span><div><strong>Comprehensive Warranty</strong> &mdash; backing our structural alterations and premium installations with full peace of mind.</div></li>
                    </ul>
                </div>
            </section>

            <!-- CTA Band -->
            <section class="cta-band">
                <div class="container">
                    <p class="eyebrow on-dark">Ready to Transform Your Home?</p>
                    <h2>Let's Discuss Your Renovation Ambitions</h2>
                    <p class="lede" style="margin-left:auto;margin-right:auto;">Get in touch today to schedule an on-site feasibility consultation.</p>
                    <div class="btn-row">
                        <a class="btn btn-stone" href="<?php echo esc_url(home_url('/contact/')); ?>">Arrange a Consultation</a>
                    </div>
                </div>
            </section>
            <?php
        endif;
    endwhile;
endif;

get_footer();
