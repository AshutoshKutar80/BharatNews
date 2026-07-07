document.addEventListener('DOMContentLoaded', function () {

  // Sticky header shrink on scroll
  var header = document.getElementById('siteHeader');
  if (header) {
    window.addEventListener('scroll', function () {
      if (window.scrollY > 40) {
        header.classList.add('shrink');
      } else {
        header.classList.remove('shrink');
      }
    });
  }

  // Mobile menu toggle
  var hamburger = document.getElementById('hamburger');
  var navLinks = document.getElementById('navLinks');
  var overlay = document.getElementById('navOverlay');

  function closeMenu() {
    navLinks.classList.remove('open');
    overlay.classList.remove('show');
    hamburger.classList.remove('active');
  }

  if (hamburger && navLinks) {
    hamburger.addEventListener('click', function () {
      navLinks.classList.toggle('open');
      overlay.classList.toggle('show');
      hamburger.classList.toggle('active');
    });
    overlay.addEventListener('click', closeMenu);
    navLinks.querySelectorAll('a').forEach(function (a) {
      a.addEventListener('click', closeMenu);
    });
  }

  // Live date in top bar (Hindi locale)
  var dateEl = document.getElementById('topDate');
  if (dateEl) {
    var today = new Date();
    var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    try {
      dateEl.textContent = today.toLocaleDateString('hi-IN', options);
    } catch (e) {
      dateEl.textContent = today.toDateString();
    }
  }

  // Animated stat counters (triggers when in view)
  var counters = document.querySelectorAll('.num[data-count]');
  if (counters.length) {
    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          animateCount(entry.target);
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.4 });
    counters.forEach(function (c) { observer.observe(c); });
  }

  function animateCount(el) {
    var target = parseInt(el.getAttribute('data-count'), 10) || 0;
    var suffix = el.getAttribute('data-suffix') || '';
    var current = 0;
    var duration = 1400;
    var startTime = null;

    function step(ts) {
      if (!startTime) startTime = ts;
      var progress = Math.min((ts - startTime) / duration, 1);
      current = Math.floor(progress * target);
      el.textContent = current + suffix;
      if (progress < 1) requestAnimationFrame(step);
      else el.textContent = target + suffix;
    }
    requestAnimationFrame(step);
  }

  // Reveal-on-scroll for cards/sections
  var revealEls = document.querySelectorAll('.reveal');
  if (revealEls.length) {
    var revealObserver = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('in-view');
          revealObserver.unobserve(entry.target);
        }
      });
    }, { threshold: 0.15 });
    revealEls.forEach(function (el) { revealObserver.observe(el); });
  }
});
