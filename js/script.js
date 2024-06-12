// Toggle class active Hamburger Menu
const navbarNav = document.querySelector(".navbar-nav");

// Toggle class active Search Form
const searchFrom = document.querySelector(".search-form");
const searchBox = document.querySelector("#search-box");

document.querySelector("#search-button").onclick = (e) => {
  searchFrom.classList.toggle("active");
  searchBox.focus();
  e.preventDefault();
};

// klik diluar Elemen
const hm = document.querySelector("#hamburger-menu");
const sb = document.querySelector("#search-button");

document.addEventListener("click", function (e) {
  if (!hm.contains(e.target) && !navbarNav.contains(e.target)) {
    navbarNav.classList.remove("active");
  }
  if (!sb.contains(e.target) && !searchFrom.contains(e.target)) {
    searchFrom.classList.remove("active");
  }
});

// Hal Admin
