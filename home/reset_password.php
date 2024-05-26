<?php

require '../config/config.php';
require '../config/database.php';
require 'clases/clienteFunciones.php';

$user_id = $_GET['id'] ?? $_POST['user_id'] ?? '';
$token = $_GET['token'] ?? $_POST['token'] ?? '';

if ($user_id == '' || $token == '') {
    header('Location: index.php');
    exit;
}

$db = new Database();
$con = $db->conectar();

$errors = [];

if (!verificaTokenRequest($user_id, $token, $con)) {
    echo "No se pudo verificar la informacion";
    exit;
}

if (!empty($_POST)) {

    $password = trim($_POST['password']);
    $repassword = trim($_POST['repassword']);

    if (esNulo([$user_id, $token, $password, $repassword])) {
        $errors[] = 'Debe llenar todos los campos';
    }

  
    if (!validaPassword($password, $repassword)) {
        $errors[] = 'Las contraseñas no coinciden';
    }

    if(count($errors) == 0) {
        $pass_hash = password_hash($password, PASSWORD_DEFAULT);
        if(actualizaPassword($user_id, $pass_hash, $con)){
            echo "Contraseña actualizada.<br><a href='Login.php'>Iniciar sesion</a>";
            exit;
        } else {
            $errors[] = "Error al modificar contraseña. Intentalo nuevamente.";
        }
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

    <!------------- Cambio contraseña --------------->
    <div class="register-container">
        <h3>Cambiar contraseña</h3>

        <?php mostrarMensajes($errors); ?> 

        <form action="reset_password.php" method="post" autocomplete="off">

            <input type="hidden" name="user_id" id="user_id" value="<?= $user_id ?>">
            <input type="hidden" name="token" id="token" value="<?= $token ?>">

            <div class="form-floating" style="margin: 15px;">
                <input class="form-control" type="password" name="password" id="password" placeholder="Nueva contraseña"
                    require>
                <label for="password">Nueva contraseña</label>
            </div>

            <div class="form-floating" style="margin: 15px;">
                <input class="form-control" type="password" name="repassword" id="repassword" placeholder="Repetir contraseña"
                    require>
                <label for="repassword">Repetir contraseña</label>
            </div>

            <div class="d-grid gap-3 col-12">
                <button type="submit" class="btn btn-primary">Continuar</button>
            </div>
            <hr>
            <div class="col-12" style="color:#fff;">
                <a style="color:#1F67F5;" href="Login.php">Iniciar sesión</a>
            </div>

        </form>
    </div>


    <!-- Footer-->
    <?php include 'footer.php';?>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Instagram icon -->
    <a href="https://www.instagram.com/axo.clothes/" class="float">
        <img class="img-w" src="images/wasac.png">
    </a>

</body>



</html>