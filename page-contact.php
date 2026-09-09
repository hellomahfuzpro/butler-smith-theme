<?php
/**
 * Template Name: Contact Page
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
                    <p class="eyebrow on-dark">Get In Touch</p>
                    <h1>Discuss Bringing Your Dream Home to Life</h1>
                    <p class="lede">Tell us a little about your project and a member of the Butler-Smith team will be in touch to arrange a conversation.</p>
                </div>
                <div class="split-media">
                    <div class="photo ph-21-9">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/developments/kingham/hero.jpg'); ?>" alt="Kingham — Butler-Smith craftsmanship" loading="lazy">
                    </div>
                </div>
            </section>

            <!-- Contact Form & Info Split -->
            <section>
                <div class="container">
                    <div class="split reveal">
                        <div>
                            <form class="enquiry-form" method="post" action="<?php echo esc_url(admin_url('admin-ajax.php')); ?>">
                                <?php wp_nonce_field('bsd_contact_nonce', 'nonce'); ?>
                                <input type="hidden" name="action" value="bsd_submit_enquiry">

                                <div class="form-row">
                                    <div class="field">
                                        <label for="first-name"><?php _e('First Name', 'butler-smith'); ?></label>
                                        <input id="first-name" name="first-name" type="text" required>
                                    </div>
                                    <div class="field">
                                        <label for="last-name"><?php _e('Last Name', 'butler-smith'); ?></label>
                                        <input id="last-name" name="last-name" type="text" required>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="field">
                                        <label for="email"><?php _e('Email', 'butler-smith'); ?></label>
                                        <input id="email" name="email" type="email" required>
                                    </div>
                                    <div class="field">
                                        <label for="phone"><?php _e('Phone', 'butler-smith'); ?></label>
                                        <input id="phone" name="phone" type="tel">
                                    </div>
                                </div>

                                <div class="field">
                                    <label for="enquiry-type"><?php _e("I'm Interested In", 'butler-smith'); ?></label>
                                    <select id="enquiry-type" name="enquiry-type">
                                        <option value="Self-Build Project"><?php _e('Self-Build Project', 'butler-smith'); ?></option>
                                        <option value="Renovation & Remodeling"><?php _e('Renovation & Remodeling', 'butler-smith'); ?></option>
                                        <option value="Current Development / New Build Home"><?php _e('Current Development / New Build Home', 'butler-smith'); ?></option>
                                        <option value="General Enquiry"><?php _e('General Enquiry', 'butler-smith'); ?></option>
                                    </select>
                                </div>

                                <div class="field">
                                    <label for="message"><?php _e('Tell Us About Your Project', 'butler-smith'); ?></label>
                                    <textarea id="message" name="message" required></textarea>
                                </div>

                                <button class="btn btn-primary" type="submit"><?php _e('Send Enquiry', 'butler-smith'); ?></button>
                                <div class="form-feedback"></div>
                            </form>
                        </div>

                        <div>
                            <p class="eyebrow"><?php _e('Why Get In Touch', 'butler-smith'); ?></p>
                            <h2><?php _e("Let's Talk About Your Project", 'butler-smith'); ?></h2>
                            <p class="lede"><?php _e("Whether you're exploring a self-build, planning a renovation, or interested in one of our current developments, we'd love to hear from you.", 'butler-smith'); ?></p>
                            <ul class="feature-list">
                                <li>
                                    <span class="mark">&#10003;</span>
                                    <div><strong><?php _e('No-obligation initial conversation', 'butler-smith'); ?></strong> &mdash; <?php _e("to understand your vision and what's possible.", 'butler-smith'); ?></div>
                                </li>
                                <li>
                                    <span class="mark">&#10003;</span>
                                    <div><strong><?php _e('Honest, expert guidance', 'butler-smith'); ?></strong> &mdash; <?php _e('on budget, planning and timelines from the outset.', 'butler-smith'); ?></div>
                                </li>
                                <li>
                                    <span class="mark">&#10003;</span>
                                    <div><strong><?php _e('A dedicated point of contact', 'butler-smith'); ?></strong> &mdash; <?php _e('throughout your project, from first enquiry to handover.', 'butler-smith'); ?></div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
            <?php
        endif;
    endwhile;
endif;

get_footer();
