<?php

require '../config/config.php';
require '../config/database.php';
require 'clases/clienteFunciones.php';


$db = new Database();
$con = $db->conectar();

$errors = [];

if (!empty($_POST)) {

    $nombres = trim($_POST['nombres']);
    $apellidos = trim($_POST['apellidos']);
    $email = trim($_POST['email']);
    $telefono = trim($_POST['telefono']);
    $dni = trim($_POST['dni']);
    $usuario = trim($_POST['usuario']);
    $password = trim($_POST['password']);
    $repassword = trim($_POST['repassword']);

    if (esNulo([$nombres, $apellidos, $email, $telefono, $dni, $usuario, $password, $repassword])) {
        $errors[] = 'Debe llenar todos los campos';
    }

    if (!esEmail($email)) {
        $errors[] = 'La direccion de correo eletronico no es valida';
    }

    if (!validaPassword($password, $repassword)) {
        $errors[] = 'Las contraseñas no coinciden';
    }

    if (usuarioExiste($usuario, $con)) {
        $errors[] = "El nombre de usuario $usuario ya esta en uso";
    }

    if (emailExiste($email, $con)) {
        $errors[] = "El correo electronico $email ya esta en uso";
    }

    if (count($errors) == 0) {

        $id = registraCliente([$nombres, $apellidos, $email, $telefono, $dni], $con);

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