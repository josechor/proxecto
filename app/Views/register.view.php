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
    <p class="errorMain"><?php echo isset($error['registro']) && count($error['registro']) > 0 ? "Hubo un error en el regristro" : '' ?></p>

    <div class="form">
      <div class="loginRegister">
        <a href="/login"><span class="login">Iniciar sesión</span></a>
        <span class="actual">Registrarse</span>
      </div>
      <div class="registrarse">
        <form action="registrar" method="post">
          <input type="text" name="nombre" id="nombre" placeholder="Nombre" value="<?php echo isset($inputs['nombre']) && !empty($inputs['nombre']) ? $inputs['nombre']  : ''?>">
          <p class="error"><?php echo isset($error['registro']['nombre'])  ? $error['registro']['nombre'] : '' ?></p>
          <input type="email" name="correo" id="correo" placeholder="correo" value="<?php echo isset($inputs['correo']) && !empty($inputs['correo']) ? $inputs['correo']  : ''?>">
          <p class="error"><?php echo isset($error['registro']['correo'])  ? $error['registro']['correo'] : '' ?></p>
          <input type="password" name="contraseña" id="contraseña" placeholder="contraseña">
          <p class="error"><?php echo isset($error['registro']['contraseña'])  ? $error['registro']['contraseña'] : '' ?></p>
          <input type="submit" value="Registrarse">
        </form>

      </div>
      <a href="/inicio" class="volver">Volver al inicio</a>

    </div>
</body>

</html>