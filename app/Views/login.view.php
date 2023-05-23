<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="assets/css/login.css">
</head>

<body>
  <div class="login-page">
    <div class="form">
      <div class="loginRegister">
        <span class="login">Iniciar sesión</span>
        <span class="registrar">Registrarse</span>
      </div>
      <p class="error"><?php echo isset($registro['error']) && $registro['error'] == true ? "Hubo un error en el regristro" : ''?></p>

      <div class="iniciarSesion">

        <form action="login" method="post">
          <input type="text" name="nombre" id="nombre" placeholder="Nombre">
          <p class="error"></p>
          <input type="password" name="contraseña" id="contraseña" placeholder="contraseña">
          <p class="error"></p>
          <input type="submit" value="Iniciar sesión">
        </form>
      </div>
      <div class="registrarse">
        <form action="registrar" method="post">
          <input type="text" name="nombre" id="nombre" placeholder="Nombre">
          <input type="email" name="correo" id="correo" placeholder="correo">
          <p class="error"><?php echo isset($registro['error']) && $registro['lugarError'] == "registrarCorreo" ? $registro['errorMensaje'] : ''?></p>
          <input type="password" name="contraseña" id="contraseña" placeholder="contraseña">
          <p class="error"><?php echo isset($registro['error']) && $registro['lugarError'] == "registrarContraseña" ? $registro['errorMensaje'] : ''?></p>
          <input type="submit" value="Registrarse">
        </form>
      </div>
      <a href="/inicio" class="volver">Volver al inicio</a>
    </div>
  </div>
  <script src="assets/js/login.js"></script>
</body>

</html>