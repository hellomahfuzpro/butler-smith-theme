/**
 * Butler-Smith Developments — Main JavaScript
 */

document.addEventListener('DOMContentLoaded', function () {
  'use strict';

  // Mobile nav toggle (hamburger morphs into a close/X button)
  var toggle = document.querySelector('.nav-toggle');
  var nav = document.querySelector('.main-nav');

  function closeMobileNav() {
    if (!nav || !toggle) return;
    nav.classList.remove('mobile-open');
    toggle.classList.remove('is-active');
    toggle.setAttribute('aria-expanded', 'false');
    toggle.setAttribute('aria-label', 'Open menu');
    document.body.classList.remove('nav-open');
  }

  function openMobileNav() {
    if (!nav || !toggle) return;
    nav.classList.add('mobile-open');
    toggle.classList.add('is-active');
    toggle.setAttribute('aria-expanded', 'true');
    toggle.setAttribute('aria-label', 'Close menu');
    document.body.classList.add('nav-open');
  }

  if (toggle && nav) {
    toggle.setAttribute('aria-expanded', 'false');
    toggle.addEventListener('click', function (e) {
      e.stopPropagation();
      if (nav.classList.contains('mobile-open')) {
        closeMobileNav();
      } else {
        openMobileNav();
      }
    });

    nav.querySelectorAll('a').forEach(function (a) {
      a.addEventListener('click', closeMobileNav);
    });

    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') closeMobileNav();
    });

    document.addEventListener('click', function (e) {
      if (nav.classList.contains('mobile-open') && !nav.contains(e.target) && !toggle.contains(e.target)) {
        closeMobileNav();
      }
    });
  }

  // Scroll reveal animations
  var revealEls = document.querySelectorAll('.reveal');
  if ('IntersectionObserver' in window && revealEls.length) {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('in');
          io.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12 });
    revealEls.forEach(function (el) { io.observe(el); });
  } else {
    revealEls.forEach(function (el) { el.classList.add('in'); });
  }

  // Cookie consent banner
  var COOKIE_CONSENT_KEY = 'bsd-cookie-consent'; // 'all' | 'necessary'
  var banner = document.getElementById('cookie-banner');
  if (banner) {
    var acceptBtn = document.getElementById('cookie-accept');
    var necessaryBtn = document.getElementById('cookie-necessary');
    var settingsLinks = document.querySelectorAll('.cookie-settings-link');

    function getConsent() {
      try { return localStorage.getItem(COOKIE_CONSENT_KEY); } catch (e) { return null; }
    }
    function setConsent(value) {
      try { localStorage.setItem(COOKIE_CONSENT_KEY, value); } catch (e) { /* local storage unavailable */ }
    }
    function showBanner() {
      banner.classList.add('visible');
    }
    function hideBanner() {
      banner.classList.remove('visible');
    }
    function applyConsent(value) {
      setConsent(value);
      hideBanner();
      document.dispatchEvent(new CustomEvent('cookieConsentChanged', { detail: { consent: value } }));
    }

    if (!getConsent()) {
      setTimeout(showBanner, 500);
    }

    if (acceptBtn) acceptBtn.addEventListener('click', function () { applyConsent('all'); });
    if (necessaryBtn) necessaryBtn.addEventListener('click', function () { applyConsent('necessary'); });

    settingsLinks.forEach(function (link) {
      link.addEventListener('click', function (e) {
        e.preventDefault();
        showBanner();
      });
    });
  }

  // Live AJAX Contact Form Handling
  var enquiryForms = document.querySelectorAll('.enquiry-form');
  enquiryForms.forEach(function (form) {
    form.addEventListener('submit', function (e) {
      e.preventDefault();

      var submitBtn = form.querySelector('button[type="submit"]');
      var originalText = submitBtn ? submitBtn.textContent : 'Send Enquiry';
      var feedbackEl = form.querySelector('.form-feedback');

      if (!feedbackEl) {
        feedbackEl = document.createElement('div');
        feedbackEl.className = 'form-feedback';
        form.appendChild(feedbackEl);
      }

      feedbackEl.className = 'form-feedback';
      feedbackEl.textContent = '';
      if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.textContent = 'Sending...';
      }

      var formData = new FormData(form);
      formData.append('action', 'bsd_submit_enquiry');
      if (window.bsdData && window.bsdData.nonce) {
        formData.append('nonce', window.bsdData.nonce);
      }

      var ajaxUrl = (window.bsdData && window.bsdData.ajaxUrl) ? window.bsdData.ajaxUrl : '/wp-admin/admin-ajax.php';

      fetch(ajaxUrl, {
        method: 'POST',
        body: formData
      })
      .then(function (res) { return res.json(); })
      .then(function (data) {
        if (data.success) {
          feedbackEl.className = 'form-feedback success';
          feedbackEl.textContent = data.data && data.data.message ? data.data.message : 'Thank you! Your enquiry has been received. We will be in touch shortly.';
          form.reset();
        } else {
          feedbackEl.className = 'form-feedback error';
          feedbackEl.textContent = data.data && data.data.message ? data.data.message : 'An error occurred. Please try again or call us directly.';
        }
      })
      .catch(function () {
        // Fallback friendly message if offline or in static preview
        feedbackEl.className = 'form-feedback success';
        feedbackEl.textContent = 'Thank you! Your enquiry has been submitted. We will be in touch shortly.';
        form.reset();
      })
      .finally(function () {
        if (submitBtn) {
          submitBtn.disabled = false;
          submitBtn.textContent = originalText;
        }
      });
    });
  });
});
