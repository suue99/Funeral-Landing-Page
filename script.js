// Debugging message
console.log("JavaScript is linked correctly.");

// Mobile Navigation Toggle
const btnNavEL = document.querySelector(".btn-mobile-nav");
const headerEl = document.querySelector("header");

btnNavEL.addEventListener("click", function () {
  headerEl.classList.toggle("nav-open");
});

// Smooth Scrolling for Anchor Links
const allLinks = document.querySelectorAll("a:link");

allLinks.forEach(function (link) {
  link.addEventListener("click", function (e) {
    e.preventDefault();
    const href = link.getAttribute("href");

    // Scroll back to top
    if (href === "#") {
      window.scrollTo({
        top: 0,
        behavior: "smooth",
      });
    }

    // Scroll to other sections
    if (href !== "#" && href.startsWith("#")) {
      const sectionEl = document.querySelector(href);
      sectionEl.scrollIntoView({ behavior: "smooth" });
    }

    // Close mobile navigation if the link is part of the navigation
    if (link.classList.contains("main-nav-link")) {
      headerEl.classList.remove("nav-open");
    }
  });
});

// Fixing flexbox gap property missing in some Safari versions
function checkFlexGap() {
  const flex = document.createElement("div");
  flex.style.display = "flex";
  flex.style.flexDirection = "column";
  flex.style.rowGap = "1px";

  flex.appendChild(document.createElement("div"));
  flex.appendChild(document.createElement("div"));

  document.body.appendChild(flex);
  const isSupported = flex.scrollHeight === 1;
  flex.parentNode.removeChild(flex);

  if (!isSupported) {
    document.body.classList.add("no-flexbox-gap");
  }
}
checkFlexGap();

// Dropdown Menu Toggle for Mobile
const dropdownTriggers = document.querySelectorAll(".dropdown > a");
dropdownTriggers.forEach(trigger => {
  trigger.addEventListener("click", function (e) {
    e.preventDefault();
    const dropdownMenu = this.nextElementSibling;
    dropdownMenu.classList.toggle("open");
  });
});
