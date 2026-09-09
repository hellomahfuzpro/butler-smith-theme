<?php
/**
 * Template Name: Privacy Policy Page
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
                    <p class="eyebrow on-dark"><?php _e('Legal', 'butler-smith'); ?></p>
                    <h1><?php the_title(); ?></h1>
                    <p class="lede"><?php _e('How we collect, use and protect your personal information, and how cookies are used on this site.', 'butler-smith'); ?></p>
                </div>
                <div class="split-media">
                    <div class="img-ph ph-21-9"><span><?php _e('Privacy Policy', 'butler-smith'); ?></span></div>
                </div>
            </section>

            <section>
                <div class="container">
                    <div class="prose reveal" style="max-width:820px;">
                        <?php if (get_the_content()) : ?>
                            <?php the_content(); ?>
                        <?php else : ?>
                            <h2>Who We Are</h2>
                            <p>Butler-Smith Developments ("we", "us", "our") designs and builds bespoke homes across Cheshire, Shropshire and Staffordshire. This policy explains what personal information we collect through this website, why we collect it, and what rights you have over it.</p>
                            
                            <h2>Information We Collect</h2>
                            <p>We collect information you give us directly, and a small amount of information automatically when you browse the site.</p>
                            <p><strong>Information you provide:</strong> when you submit an enquiry through our contact form, we collect your first name, last name, email address, phone number (if provided), the type of project you're enquiring about, and any details you include in your message.</p>
                            <p><strong>Information collected automatically:</strong> like most websites, our hosting and any analytics tools we use may automatically log standard technical information such as your IP address, browser type, device type, pages visited and time spent on the site.</p>

                            <h2>How We Use Your Information</h2>
                            <p>We use the information we collect to:</p>
                            <ul class="checks" style="margin:0 0 1.2em;">
                                <li>Respond to enquiries submitted through our contact form</li>
                                <li>Discuss and progress potential self-build, renovation or new-build projects</li>
                                <li>Understand how visitors use our website, so we can improve it</li>
                                <li>Meet our legal and regulatory obligations</li>
                            </ul>

                            <h2>Cookies</h2>
                            <p>Cookies are small text files placed on your device when you visit a website. We use two categories on this site:</p>
                            <ul class="checks" style="margin:0 0 1.2em;">
                                <li><strong>Necessary cookies</strong> — required for the website to function correctly (for example, remembering your cookie preference). These are always active and cannot be switched off.</li>
                                <li><strong>Optional / analytics cookies</strong> — help us understand how visitors use the site, so we can improve it. These are only set if you select "Accept All" in the cookie banner.</li>
                            </ul>
                            <p>You can change your preference at any time using the "Cookie Settings" link in the footer of this site.</p>

                            <h2>Your Rights</h2>
                            <p>Under UK data protection law, you have the right to request access to the personal data we hold about you, request corrections, or ask for deletion where applicable.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
            <?php
        endif;
    endwhile;
endif;

get_footer();
