<?php
header('Content-Type: text/html; charset=UTF-8');
$has_session = session_status() == PHP_SESSION_ACTIVE;
if (!$has_session) {
  session_start();
  if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    die();
  }
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Gestor de datos de eventos</title>
  <!-- Estilos -->
  <link href="../style/style.css" rel="stylesheet" />
  <link href="../style/navResponsive.css" rel="stylesheet" />
  <!-- bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark p-4">
    <div class="container-fluid">
      <a href="https://grupoz.cl/" class="d-flex align-items-center mb-2 mb-lg-0 text-decoration-none">
        <img src="../img/logo_top.png" alt="logo Grupo Z" width="181" height="46" />
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul id="list" class="nav ps-2 justify-content-end w-100">
          <li class="nav-item">
            <a class="nav-link text-white" aria-current="page" href="/vistas/home.php">Excel a JSON</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="/vistas/main.php">Extraer Datos BD</a>
          </li>
          <li id="item-user" class="nav-item text-white p-2">
            Usuario: <?php if (isset($_SESSION['user'])) {
                        echo $_SESSION['user'];
                      }  ?>
          </li>
          <li class="nav-item">
            <a href="../includes/logout.php"><button type="button" class="btn btn-warning">Cerrar Sesión</button></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container-sm my-3">
    <h2 class="text-center">Generador Excel a Json</h2>
  </div>
  <div class="flex-container">
    <div class="flex-items-0">
      <div class="container">
        <p class="fs-5 mb-1">Descarga la plantilla Excel Aquí</p>
        <button class="btn btn-primary" type="button" id="btnGetFile">
          Descargar
        </button>
      </div>
      <div class="container">
        <p class="fs-5 mb-1">Seleccione el archivo Excel</p>
        <!--<input id="cargararchivo" name="cargararchivo" type="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />  -->
        <input class="form-control" type="file" id="inputFile" accept=".xls,.xlsx" />
      </div>
    </div>
    <div class="flex-items-1">
      <p class="fs-5">Salida:</p>
      <pre id="jsonData"></pre>
      <button class="btn btn-primary" id="btnDownload">Descargar</button>
    </div>
  </div>
  <!-- Footer -->
  <footer class="text-center text-lg-start bg-dark text-muted">
    <div class="text-center text-light p-4">
      © 2021 Copyright:
      <a class="text-reset fw-bold" href="https://grupoz.cl/">Grupo Z - Streaming Better, Faster & Stronger
      </a>
    </div>
  </footer>
  <!--Librería Sheet JS y archivo de configuracion app.js -->
  <script lang="javascript" src="../js/xlsx.full.min.js"></script>
  <script lang="javascript" src="../js/scriptExcelToJson.js"></script>
  <!--Librería File Saver JS -->
  <script lang="javascript" src="../js/file-saver.js"></script>
  <!--Librería Sweet Alert 2-->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>