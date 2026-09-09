<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="icon" href="<?php echo esc_url(get_template_directory_uri() . '/assets/img/logo/butler-smith-logo-transparent.png'); ?>">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
  <div class="nav-wrap">
    <a class="brand" href="<?php echo esc_url(home_url('/')); ?>">
      <?php
      $custom_logo_id = get_theme_mod('custom_logo');
      if ($custom_logo_id) {
          echo wp_get_attachment_image($custom_logo_id, 'medium', false, array('alt' => get_bloginfo('name')));
      } else {
          echo '<img src="' . esc_url(get_template_directory_uri() . '/assets/img/logo/butler-smith-logo-transparent.png') . '" alt="' . esc_attr(get_bloginfo('name')) . ' logo">';
      }
      ?>
      <span class="brand-text">
        <span class="name">BUTLER&#8209;SMITH</span>
        <span class="tag">Prestige Property Development</span>
      </span>
    </a>

    <nav class="main-nav">
      <?php
      if (has_nav_menu('primary')) {
          wp_nav_menu(array(
              'theme_location' => 'primary',
              'container'      => false,
              'items_wrap'     => '<ul>%3$s</ul>',
              'depth'          => 1,
              'fallback_cb'    => false,
          ));
      } else {
          ?>
          <ul>
            <li><a href="<?php echo esc_url(home_url('/')); ?>" <?php echo is_front_page() ? 'class="active"' : ''; ?>>Home</a></li>
            <li><a href="<?php echo esc_url(home_url('/self-build/')); ?>">Self-Build</a></li>
            <li><a href="<?php echo esc_url(home_url('/renovations/')); ?>">Renovations</a></li>
            <li><a href="<?php echo esc_url(home_url('/new-homes/')); ?>">New Homes</a></li>
            <li><a href="<?php echo esc_url(home_url('/about/')); ?>">About</a></li>
          </ul>
          <?php
      }
      $cta_text = get_theme_mod('bsd_header_cta_text', 'Enquire');
      $cta_url  = get_theme_mod('bsd_header_cta_url', home_url('/contact/'));
      if (!empty($cta_text)) :
      ?>
        <a class="nav-cta" href="<?php echo esc_url($cta_url); ?>"><?php echo esc_html($cta_text); ?> <span class="arrow">&rarr;</span></a>
      <?php endif; ?>
    </nav>

    <button class="nav-toggle" aria-label="Toggle menu">
      <span></span><span></span><span></span>
    </button>
  </div>
</header>
<main id="primary" class="site-main">
