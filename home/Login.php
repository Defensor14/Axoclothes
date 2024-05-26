<?php

require '../config/config.php';
require '../config/database.php';
require 'clases/clienteFunciones.php';


$db = new Database();
$con = $db->conectar();

$errors = [];

if (!empty($_POST)) {

    $usuario = trim($_POST['usuario']);
    $password = trim($_POST['password']);

    if (esNulo([$usuario, $password])) {
        $errors[] = 'Debe llenar todos los campos';
    }

    if (count($errors) == 0) {
        $errors[] = login($usuario, $password, $con);
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>AXOCLOTHES</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />

    <!--Archivos CSS-->
    <link href="css/realstyle.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/theme.css" rel="stylesheet" />

</head>

<body>
    <!-- Navigation-->
    <nav class="navbar">
        <div id="logo">
            <img src="images/logo.svg">
        </div>
        <a class="navbar-brand" href="index.php">AXOCLOTHES</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
                class="navbar-toggler-icon"></span></button>

        <ul class="menu">
            <a href="Login.php">Iniciar sesion</a>
    </nav>

    <!-- Header-->
    <header class="headercontenedor py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">¡Obtén más beneficios!</h1>
                <p class="lead fw-normal text-white-50 mb-0">Recibe descuentos y entérate de promociones al registrarte
                    en Axoclothes</p>
            </div>
        </div>
    </header>

    <!------------- LOGIN --------------->
    <div class="register-container">
        <h2 class="titulos">Iniciar sesion</h2>

        <?php mostrarMensajes($errors); ?>

        <form id="register-form" action="Login.php" method="post" autocomplete="off">

            <div class="form-floating" style="margin: 15px;">
                <input class="form-control" type="text" name="usuario" id="usuario" placeholder="Usuario">
                <label for="usuario">Usuario</label>
            </div>

            <div class="form-floating" style="margin: 15px;">
                <input class="form-control" type="password" name="password" id="password" placeholder="Contraseña">
                <label for="password">Contraseña</label>
            </div>

            <a href="recupera.php" style="color: #fff;">¿Olvidaste tu contraseña?</a><br>
            <div class="d-grid gap-3 col-12">
                <button type="submit" class="btn btn-primary">Ingresar</button>
            </div>
            <hr>
            <div class="col-12" style="color:#fff;">
                ¿No tienes cuenta? <a style="color:#1F67F5;" href="SignUp.php">Crea una aquí</a>
            </div>

        </form>
    </div>

    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container">
            <a href="aboutus.html">
                <p class="m-0 text-center enlaces-footer">Acerca de</p>
            </a>
            <p class="m-0 text-center text-white">•</p>
            <a href="policy.html">
                <p class="m-0 text-center enlaces-footer">Privacidad</p>
            </a>
            <p class="m-0 text-center text-white">•</p>
            <a href="terms.html">
                <p class="m-0 text-center enlaces-footer">Términos</p>
            </a> <br>
            <p class="m-0 text-center text-white">Copyright &copy; AXOCLOTHES 2024</p>
        </div>
    </footer>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Instagram icon -->
    <a href="https://www.instagram.com/axo.clothes/" class="float">
        <img class="img-w" src="images/wasac.png">
    </a>

</body>



</html>