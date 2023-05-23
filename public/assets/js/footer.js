const hrFooter = document.querySelectorAll(".footerHr");
let footerMenu;
footerMenu = document.querySelector(".footerMenu").offsetHeight;
if (window.innerWidth >= 840) {
  hrFooter.forEach((el) => {
    el.style.height = footerMenu + "px";
  });
} else {
  hrFooter.forEach((el) => {
    el.style.height = "3px";
  });
}

window.addEventListener("resize", changeScreen);
function changeScreen(e) {
  if (window.innerWidth >= 840) {
    hrFooter.forEach((el) => {
      el.style.height = footerMenu + "px";
    });
  } else {
    hrFooter.forEach((el) => {
      el.style.height = "3px";
    });
  }
}
