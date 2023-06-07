const obtenerUrl = window.location.href;

const url = new URL(obtenerUrl);

const params = new URLSearchParams(url.search);

const values = {};

for (const [key, value] of params.entries()) {
  values[key] = value;
}
document.getElementById("page").addEventListener("change", (e) => {
  values.page = document.getElementById("page").value;
  cadena = "verReservasTenis?";
  Object.entries(values).forEach(([key, value]) => {
    cadena += `${key}=${value}&`;
  });

  window.location.href=cadena;
});
console.log("tenis")