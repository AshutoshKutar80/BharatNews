document.addEventListener('DOMContentLoaded', function () {

  /* ---------------------------------------------------------
     Sidebar toggle (mobile)
  --------------------------------------------------------- */
  var burger = document.getElementById('adminBurger');
  var sidebar = document.getElementById('adminSidebar');
  var overlay = document.getElementById('sidebarOverlay');

  function closeSidebar() {
    sidebar && sidebar.classList.remove('open');
    overlay && overlay.classList.remove('open');
  }

  if (burger) {
    burger.addEventListener('click', function () {
      sidebar.classList.toggle('open');
      overlay.classList.toggle('open');
    });
  }
  if (overlay) overlay.addEventListener('click', closeSidebar);

  /* ---------------------------------------------------------
     Auto-dismiss alerts
  --------------------------------------------------------- */
  document.querySelectorAll('.alert').forEach(function (el) {
    setTimeout(function () {
      el.style.transition = 'opacity .4s ease';
      el.style.opacity = '0';
      setTimeout(function () { el.remove(); }, 400);
    }, 4000);
  });

  /* ---------------------------------------------------------
     Confirm before destructive / state-changing actions
     (approve / reject / block / unblock / delete)
  --------------------------------------------------------- */
  document.querySelectorAll('form[data-confirm]').forEach(function (form) {
    form.addEventListener('submit', function (e) {
      var msg = form.getAttribute('data-confirm') || 'Are you sure?';
      if (!window.confirm(msg)) {
        e.preventDefault();
      }
    });
  });

  /* ---------------------------------------------------------
     Reject / Block reason prompt (optional remark field)
  --------------------------------------------------------- */
  document.querySelectorAll('form[data-remark-prompt]').forEach(function (form) {
    form.addEventListener('submit', function (e) {
      var already = form.querySelector('input[name="remark"]');
      if (already && already.value) return; // already filled via a modal etc.

      e.preventDefault();
      var label = form.getAttribute('data-remark-prompt');
      var remark = window.prompt(label, '');
      if (remark === null) return; // cancelled

      var input = document.createElement('input');
      input.type = 'hidden';
      input.name = 'remark';
      input.value = remark;
      form.appendChild(input);
      form.submit();
    });
  });

  /* ---------------------------------------------------------
     Purchased product approval modal
  --------------------------------------------------------- */
  var modal = document.getElementById('approveProductModal');
  if (modal) {
    var form = document.getElementById('approveProductForm');
    var summaryBox = document.getElementById('approveProductSummary');
    var trackingInput = document.getElementById('trackingIdInput');
    var remarkInput = document.getElementById('remarkInput');

    document.querySelectorAll('.js-open-approve-modal').forEach(function (btn) {
      btn.addEventListener('click', function () {
        var id = btn.getAttribute('data-id');
        var user = btn.getAttribute('data-user');
        var product = btn.getAttribute('data-product');
        var amount = btn.getAttribute('data-amount');
        var ref = btn.getAttribute('data-ref');

        form.action = btn.getAttribute('data-action-url');
        trackingInput.value = '';
        remarkInput.value = '';

        summaryBox.innerHTML =
          '<span><strong>User:</strong> ' + user + '</span>' +
          '<span><strong>Product:</strong> ' + product + '</span>' +
          '<span><strong>Amount:</strong> ₹' + amount + '</span>' +
          '<span><strong>Txn Ref:</strong> ' + ref + '</span>';

        modal.classList.add('open');
        trackingInput.focus();
      });
    });

    document.querySelectorAll('[data-close-modal]').forEach(function (el) {
      el.addEventListener('click', function () { modal.classList.remove('open'); });
    });

    modal.addEventListener('click', function (e) {
      if (e.target === modal) modal.classList.remove('open');
    });

    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') modal.classList.remove('open');
    });
  }
});
