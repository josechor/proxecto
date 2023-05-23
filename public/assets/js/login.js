let login = document.querySelector(".login")
let registrar = document.querySelector(".registrar")
let registrarForm = document.querySelector(".registrarse")
let loginForm = document.querySelector(".iniciarSesion")
console.log("hpña");
registrar.addEventListener("click", (e) => {
    loginForm.style.display = "none"
    registrarForm.style.display = "flex"
    registrar.style.color = "#16725e"
    login.style.color = "black"
    registrar.style.textDecoration = "underline"
    login.style.textDecoration = "none"


    
})
login.addEventListener("click", (e) => {
    registrarForm.style.display = "none"
    loginForm.style.display = "flex"
    login.style.color = "#16725e"
    registrar.style.color = "black"
    registrar.style.textDecoration = "none"
    login.style.textDecoration = "underline"


})

