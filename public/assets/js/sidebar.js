document.addEventListener("DOMContentLoaded", function () {
  const toggle = document.getElementById("toggleProspek");
  const dropdown = document.getElementById("adminDropdown");
  const arrow = document.getElementById("dropdownArrow");

  // Toggle saat diklik
  toggle.addEventListener("click", function (e) {
    e.preventDefault(); // Hindari scroll ke atas karena href="#"
    const isShown = dropdown.classList.contains("show");

    const bsCollapse = new bootstrap.Collapse(dropdown, {
      toggle: true,
    });

    if (isShown) {
      bsCollapse.hide();
    } else {
      bsCollapse.show();
    }
  });

  // Atur rotasi panah saat buka/tutup
  dropdown.addEventListener("show.bs.collapse", function () {
    arrow.classList.add("rotate");
  });
  dropdown.addEventListener("hide.bs.collapse", function () {
    arrow.classList.remove("rotate");
  });
});