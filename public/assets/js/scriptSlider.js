cont = 0;

intervalo = setInterval(moveImage, 5000);
function moveImage() {
  if (cont == 3) {
    cont = 0;
  }
  document.querySelectorAll(".sliderImg").forEach((e) => {
    contador = e.height * cont;
    e.style.transform = "translateY(-" + contador + "px)";
  });
  cont++;
}

window.addEventListener("resize", changeScreen);
function changeScreen(e) {
  document.querySelectorAll(".sliderImg").forEach((e) => {
    contador = e.height * cont;
    e.style.transform = "translateY(-" + contador + "px)";
  });
  if (cont == 3) {
    cont = 0;
  }
}


