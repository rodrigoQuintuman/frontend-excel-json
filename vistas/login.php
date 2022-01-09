<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestor de datos de eventos</title>
    <link href="../style/style.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
</head>

<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container justify-content-center">
            <a class="navbar-brand" href="https://grupoz.cl/">
                <img src="../img/logo_top.png" alt="logo Grupo Z" width="181" height="46" />
            </a>
        </div>
    </nav>
    <div class="container-sm my-3">
        <h2 class="text-center">Gestor de datos de eventos</h2>
    </div>
    <div class="flex-container">
        <div class="flex-items-0">
            <div class="container">

            </div>
            <form action="/index.php" method="POST">
                <?php
                if (isset($errorLogin)) {
                    echo "<label class='text-danger'>". $errorLogin."</label>";
                }
                ?>
                <h1 class="h3 mb-3 fw-normal">Iniciar sesión</h1>

                <div class="form-floating">
                    <input type="email" class="form-control" name="correo" placeholder="name@example.com">
                    <label for="floatingInput">Correo</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" name="password" placeholder="Password">
                    <label for="floatingPassword">Password</label>
                </div>
                <button class="w-100 mt-5 btn btn-lg btn-primary" type="submit">Iniciar Sesión</button>
            </form>
        </div>
    </div>
    <footer class="text-center text-lg-start bg-dark text-muted">
        <div class="text-center text-light p-4">
            © 2021 Copyright:
            <a class="text-reset fw-bold" href="https://grupoz.cl/">Grupo Z - Streaming Better, Faster & Stronger
            </a>
        </div>
    </footer>
</body>

</html>