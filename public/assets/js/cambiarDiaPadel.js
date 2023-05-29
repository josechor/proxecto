let selecDia = document.querySelector(".selecDia");

selecDia.addEventListener("change", (e) => {
    console.log(selecDia.value)
    window.location.href = "reservarPistaPadel?fechaVer="+selecDia.value
})

