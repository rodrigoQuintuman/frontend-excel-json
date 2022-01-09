<?php
header('Content-Type: text/html; charset=UTF-8');
$has_session = session_status() == PHP_SESSION_ACTIVE;
if (!$has_session) {
    session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: login.php'); //Aqui lo redireccionas al lugar que quieras.
        die();
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de datos de eventos</title>
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
        <h2 class="text-center">Generador Excel con usuraios de BD</h2>
    </div>
    <div class="flex-container">
        <div class="flex-items-0">
            <div class="container">
                <form action="/libphp/PhpOffice/createExcel.php" method="POST">
                    <p class="fs-5 mb-1">Selecciona datos para descargar Excel Aquí</p>
                    <label class="form-label">Selecciona evento</label>
                    <select class="form-select" name="nombre_evento" required>
                        <option value="">Seleccionar</option>
                        <?php
                        include '../includes/db.php';
                        $db = new DB();
                        $opciones = $db->connect()->query("SELECT DISTINCT nombre_evento FROM `user_event`");
                        ?>
                        <?php foreach ($opciones as $item) : ?>
                            <option value="<?php echo $item['nombre_evento'] ?>"><?php echo $item['nombre_evento'] ?></option>
                        <?php endforeach ?>
                    </select>
                    <label class="form-label">Selecciona datos a traer</label>
                    <select class="form-select" name="datos" required>
                        <option value="">Seleccionar</option>
                        <option value="1">Correo y Password</option>
                        <option value="2">Rut y Password</option>
                        <option value="correo">Solo Correo</option>
                        <option value="rut">Solo Rut</option>
                    </select>
                    <button class="mt-3 btn btn-primary" type="submit"> Descargar </button>
                </form>
            </div>
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
</body>

</html>