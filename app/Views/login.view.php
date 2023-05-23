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
  <p class="errorMain"><?php echo isset($error) && !empty($error)? $error : ''?></p>
  <p class="confirmar"><?php echo isset($confirmar) && !empty($confirmar) ? $confirmar : ''?></p>
    <div class="form">
      <div class="loginRegister">
        <span class="actual">Iniciar sesión</span>
        <a href="/registrar"><span class="registrar">Registrarse</span></a>
      </div>

      <div class="iniciarSesion">

        <form action="login" method="post">
          <input type="text" name="nombre" id="nombre" placeholder="Nombre">
          <input type="password" name="contraseña" id="contraseña" placeholder="contraseña">
          <input type="submit" value="Iniciar sesión">
        </form>
      </div>
    <a href="/inicio" class="volver">Volver al inicio</a>

  </div>
</body>

</html>