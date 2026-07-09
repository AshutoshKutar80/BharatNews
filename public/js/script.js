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

  // Mobile sidebar toggle (replaces old mobile menu)
  var hamburger = document.getElementById('hamburger');
  var sidebar = document.getElementById('mobileSidebar');
  var overlay = document.getElementById('navOverlay');
  var closeBtn = document.getElementById('sidebarClose');

  function openSidebar() {
    if (sidebar) {
      sidebar.classList.add('open');
    }
    if (overlay) {
      overlay.classList.add('active');
    }
    if (hamburger) {
      hamburger.classList.add('active');
    }
    document.body.style.overflow = 'hidden';
  }

  function closeSidebar() {
    if (sidebar) {
      sidebar.classList.remove('open');
    }
    if (overlay) {
      overlay.classList.remove('active');
    }
    if (hamburger) {
      hamburger.classList.remove('active');
    }
    document.body.style.overflow = '';
  }

  if (hamburger && sidebar) {
    hamburger.addEventListener('click', function (e) {
      e.stopPropagation();
      if (sidebar.classList.contains('open')) {
        closeSidebar();
      } else {
        openSidebar();
      }
    });

    // Close sidebar when clicking overlay
    if (overlay) {
      overlay.addEventListener('click', closeSidebar);
    }

    // Close sidebar with close button
    if (closeBtn) {
      closeBtn.addEventListener('click', closeSidebar);
    }

    // Close sidebar when clicking a link
    sidebar.querySelectorAll('a').forEach(function (a) {
      a.addEventListener('click', closeSidebar);
    });

    // Close sidebar on Escape key
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && sidebar.classList.contains('open')) {
        closeSidebar();
      }
    });
  }

  // Auth Dropdown Toggle (Desktop)
  var dropdownToggles = document.querySelectorAll('.nav-dropdown-toggle');
  dropdownToggles.forEach(function (toggle) {
    toggle.addEventListener('click', function (e) {
      e.preventDefault();
      e.stopPropagation();
      var menu = this.nextElementSibling;
      if (menu && menu.classList.contains('nav-dropdown-menu')) {
        var isOpen = menu.style.display === 'block';
        // Close all other dropdowns
        document.querySelectorAll('.nav-dropdown-menu').forEach(function (m) {
          m.style.display = 'none';
        });
        menu.style.display = isOpen ? 'none' : 'block';
      }
    });
  });

  // Close dropdowns when clicking outside
  document.addEventListener('click', function (e) {
    var dropdowns = document.querySelectorAll('.nav-dropdown');
    dropdowns.forEach(function (dropdown) {
      if (!dropdown.contains(e.target)) {
        var menu = dropdown.querySelector('.nav-dropdown-menu');
        if (menu) {
          menu.style.display = 'none';
        }
      }
    });
  });

  // Close dropdown on Escape key
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
      document.querySelectorAll('.nav-dropdown-menu').forEach(function (menu) {
        menu.style.display = 'none';
      });
    }
  });

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

  // Handle window resize - close sidebar on desktop
  var resizeTimer;
  window.addEventListener('resize', function () {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(function () {
      if (window.innerWidth >= 992 && sidebar && sidebar.classList.contains('open')) {
        closeSidebar();
      }
    }, 250);
  });
});