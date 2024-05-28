<?php

require '../config/config.php';
require '../config/database.php';
require 'clases/clienteFunciones.php';


$db = new Database();
$con = $db->conectar();

$proceso = isset($_GET['pago']) ? 'pago' : 'login';

$errors = [];

if (!empty($_POST)) {

    $usuario = trim($_POST['usuario']);
    $password = trim($_POST['password']);
    $proceso = $_POST['proceso'] ?? 'login';

    if (esNulo([$usuario, $password])) {
        $errors[] = 'Debe llenar todos los campos';
    }

    if (count($errors) == 0) {
        $errors[] = login($usuario, $password, $con, $proceso);
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

<body
    style="height: 100vh; background-image: url('https://static.vecteezy.com/system/resources/previews/010/839/386/non_2x/aesthetic-minimal-cute-pastel-pink-wallpaper-illustration-perfect-for-wallpaper-backdrop-postcard-background-banner-vector.jpg');
    background-size: cover;">
    <!-- Navigation-->
    <?php include 'menu_registro.php'; ?>
    <!-- Header-->


    <!------------- LOGIN --------------->
    <main>
        <div class="container-lg">
            <div class="register-container">
                <br>
                <br>
                <h2 class="titulos">Iniciar sesion</h2>

                <?php mostrarMensajes($errors); ?>

                <form id="register-form" action="Login.php" method="post" autocomplete="off">

                    <input type="hidden" name="proceso" value="<?php echo $proceso; ?>">

                    <div class="form-floating" style="margin: 15px;">
                        <input class="form-control" type="text" name="usuario" id="usuario" placeholder="Usuario">
                        <label for="usuario">Usuario</label>
                    </div>

                    <div class="form-floating" style="margin: 15px;">
                        <input class="form-control" type="password" name="password" id="password"
                            placeholder="Contraseña">
                        <label for="password">Contraseña</label>
                    </div>

                    <a href="recupera.php" style="color: #fff;">¿Olvidaste tu contraseña?</a><br>
                    <div class="d-grid gap-3 col-12">
                        <button type="submit" class="btn"
                            style="background-color: #FA8191; color: white;">Ingresar</button>
                    </div>
                    <hr>
                    <div class="col-12" style="color:#fff;">
                        ¿No tienes cuenta? <a style="color:#1F67F5;" href="SignUp.php">Crea una aquí</a>
                    </div>

                </form>
            </div>
        </div>
    </main>

    <!-- Footer-->
    <?php include 'footer_registro.php'; ?>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Instagram icon -->
    <a href="https://www.instagram.com/axo.clothes/" class="float">
        <img class="img-w" src="images/wasac.png">
    </a>

</body>



</html>