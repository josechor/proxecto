<!DOCTYPE html>
<html lang="en">

<head>
  <base href="/">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Proyecto</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <!-- Select 2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="assets/css/header.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed <?php echo isset($_COOKIE['dark']) ? 'dark-mode' : ''; ?>">
  <header>
    <img src="assets/img/logo.png" alt="">
    <nav class="navEstirado">
      <a href="/inicio">Inicio</a>
      <a href="/reservarPista">Reservar pistas</a>
      <a href="/inscripciones">Inscribirse gimnasio/piscina</a>
      <a href="/tarifas">Tarifas</a>
      <?php echo isset($_SESSION['usuario']) && $_SESSION['usuario']['rol']==1 ? "<a href='/admin'>Admin</a>" : ''?>
    </nav>
    <div class="headerRedes">
      <a href="<?php echo isset($_SESSION['usuario']) && !empty($_SESSION['usuario']) ? "/logout" : "/login"?>"><?php echo isset($_SESSION['usuario']) && !empty($_SESSION['usuario']) ? "Salir" : "Iniciar sesion"?></a>
      <div class="redes">
        <i class="fab fa-facebook-f"></i>
        <i class="fab fa-twitter"></i>
        <i class="fab fa-instagram"></i>
      </div>
      <a href="#"><?php echo isset($_SESSION['usuario']) && !empty($_SESSION['usuario']) ? $_SESSION['usuario']['nombre'] : "Sin usuario"?></a>
    </div>
    <span class="menu"><i class="fas fa-bars"></i></span>
  </header>
  <nav class="navClick">
  <a href="/inicio">Inicio</a>
  <a href="/reservarPista">Reservar pistas</a>
  <a href="/inscripciones">Inscribirse gimnasio/piscina</a>
  <a href="/tarifas">Tarifas</a>
  <?php echo isset($_SESSION['usuario']) && $_SESSION['usuario']['rol']==1 ? "<a href='/admin'>Admin</a>" : ''?>
  </nav>

  <script src="assets/js/header.js"></script>
  <section class="content">