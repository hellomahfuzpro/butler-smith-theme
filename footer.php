</main><!-- #primary -->

<footer class="site-footer">
  <div class="container">
    <div class="footer-top">
      <div class="footer-brand">
        <a class="brand" href="<?php echo esc_url(home_url('/')); ?>">
          <?php
          $custom_logo_id = get_theme_mod('custom_logo');
          if ($custom_logo_id) {
              echo wp_get_attachment_image($custom_logo_id, 'thumbnail', false, array('alt' => get_bloginfo('name')));
          } else {
              echo '<img src="' . esc_url(get_template_directory_uri() . '/assets/img/logo/butler-smith-logo-transparent.png') . '" alt="' . esc_attr(get_bloginfo('name')) . ' logo">';
          }
          ?>
          <span class="brand-text">
            <span class="name">BUTLER&#8209;SMITH</span>
            <span class="tag">Prestige Property Development</span>
          </span>
        </a>
        <p><?php echo esc_html(get_theme_mod('bsd_footer_bio', 'Designing and building exceptional bespoke homes from concept to completion, across Cheshire, Shropshire & Staffordshire.')); ?></p>
      </div>

      <div class="footer-col">
        <h4><?php _e('Explore', 'butler-smith'); ?></h4>
        <?php
        if (has_nav_menu('footer_explore')) {
            wp_nav_menu(array('theme_location' => 'footer_explore', 'container' => false, 'depth' => 1));
        } else {
            ?>
            <ul>
              <li><a href="<?php echo esc_url(home_url('/self-build/')); ?>">Self-Build</a></li>
              <li><a href="<?php echo esc_url(home_url('/renovations/')); ?>">Renovations &amp; Remodeling</a></li>
              <li><a href="<?php echo esc_url(home_url('/new-homes/')); ?>">New Build Homes</a></li>
              <li><a href="<?php echo esc_url(home_url('/about/')); ?>">About Butler-Smith</a></li>
            </ul>
            <?php
        }
        ?>
      </div>

      <div class="footer-col">
        <h4><?php _e('Developments', 'butler-smith'); ?></h4>
        <?php
        if (has_nav_menu('footer_developments')) {
            wp_nav_menu(array('theme_location' => 'footer_developments', 'container' => false, 'depth' => 1));
        } else {
            ?>
            <ul>
              <li><a href="<?php echo esc_url(home_url('/developments/ashwood/')); ?>">Ashwood, Ashley</a></li>
              <li><a href="<?php echo esc_url(home_url('/developments/butley/')); ?>">Butley, Cheshire</a></li>
              <li><a href="<?php echo esc_url(home_url('/developments/mulberry/')); ?>">Mulberry, Barlaston</a></li>
              <li><a href="<?php echo esc_url(home_url('/developments/driftwood/')); ?>">Driftwood, Ashley</a></li>
            </ul>
            <?php
        }
        ?>
      </div>

      <div class="footer-col">
        <h4><?php _e('Get In Touch', 'butler-smith'); ?></h4>
        <ul>
          <li><a href="<?php echo esc_url(home_url('/contact/')); ?>"><?php _e('Make an Enquiry', 'butler-smith'); ?></a></li>
        </ul>
        <div class="footer-social">
          <?php
          $ig = get_theme_mod('bsd_instagram_url', 'https://www.instagram.com/butler_smithdevelopments/');
          $fb = get_theme_mod('bsd_facebook_url', 'https://www.facebook.com/ButlerSmithDevelopments/');
          if (!empty($ig)) : ?>
            <a href="<?php echo esc_url($ig); ?>" target="_blank" rel="noopener" aria-label="Butler-Smith Developments on Instagram">
              <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="2.5" y="2.5" width="19" height="19" rx="5"/><circle cx="12" cy="12" r="4.3"/><circle cx="17.4" cy="6.6" r="1.1" fill="currentColor" stroke="none"/></svg>
            </a>
          <?php endif; ?>
          <?php if (!empty($fb)) : ?>
            <a href="<?php echo esc_url($fb); ?>" target="_blank" rel="noopener" aria-label="Butler-Smith Developments on Facebook">
              <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M15.5 8.5h-2a1.5 1.5 0 0 0-1.5 1.5v2h3.3l-.4 3H12v7.5H9V15H6.5v-3H9v-2.3C9 7.3 10.6 5.5 13.3 5.5H15.5v3Z"/></svg>
            </a>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <div class="footer-bottom">
      <span><?php echo esc_html(get_theme_mod('bsd_footer_copyright', '© ' . date('Y') . ' Butler-Smith Developments. All rights reserved.')); ?></span>
      <span class="footer-legal">
        <a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>"><?php _e('Privacy Policy', 'butler-smith'); ?></a> &middot; 
        <button type="button" class="cookie-settings-link"><?php _e('Cookie Settings', 'butler-smith'); ?></button>
      </span>
      <span>butler&#8209;smithdevelopments.co.uk</span>
    </div>
  </div>
</footer>

<?php if (get_theme_mod('bsd_enable_cookie_banner', true)) : ?>
  <div class="cookie-banner" id="cookie-banner" role="dialog" aria-live="polite" aria-label="Cookie consent">
    <div class="cookie-banner-inner">
      <p><?php echo esc_html(get_theme_mod('bsd_cookie_text', "We use essential cookies to make this site work, and optional analytics cookies to help us understand how it's used.")); ?> See our <a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>">Privacy Policy</a> for details.</p>
      <div class="cookie-banner-actions">
        <button type="button" class="btn" id="cookie-necessary"><?php _e('Necessary Only', 'butler-smith'); ?></button>
        <button type="button" class="btn btn-stone" id="cookie-accept"><?php _e('Accept All', 'butler-smith'); ?></button>
      </div>
    </div>
  </div>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
