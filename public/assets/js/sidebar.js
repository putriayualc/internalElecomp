document.addEventListener("DOMContentLoaded", function () {
  const dropdown = document.getElementById("adminDropdown");
  const arrow = document.getElementById("dropdownArrow");

  dropdown.addEventListener("show.bs.collapse", function () {
    arrow.classList.add("rotate");
  });

  dropdown.addEventListener("hide.bs.collapse", function () {
    arrow.classList.remove("rotate");
  });
});
