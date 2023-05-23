const menu = document.querySelector(".menu");
const nav = document.querySelector(".navClick");
menu.addEventListener("click", () => {
  if (nav.style.display == "flex") {
    nav.style.transform = "translateY(-500px)";
    setTimeout(animarDesaparecer,300)
    function animarDesaparecer(){
        nav.style.display = "none";
    }
  } else {
    nav.style.display = "flex";
    setTimeout(animarAparecer, 100);
    function animarAparecer() {
      nav.style.transform = "translateY(0)";
    }
  }
});

window.addEventListener("resize", changeScreen);
function changeScreen(e) {
  if (window.innerWidth >= 1000) {
    nav.style.display = "none";
    nav.style.transform = "translateY(-500px)";
  }
}
