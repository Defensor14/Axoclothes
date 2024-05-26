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

        if ($id > 0) {

            require 'clases/mailer.php';
            $mailer = new Mailer();
            $token = generarToken();
            $pass_hash = password_hash($password, PASSWORD_DEFAULT);

            $idUsuario = registraUsuario([$usuario, $pass_hash, $token, $id], $con);
            if ($idUsuario > 0) {

                $url = SITE_URL . '/activa_cliente.php?id=' . $idUsuario . '&token=' . $token;
                $asunto = "Activa tu cuenta de Axoclothes";
                $cuerpo = "¡Benvenido $nombres!: <br>Para verificar tu cuenta solo da click en el siguiente enlace. <a href='$url'>Activar cuenta</a>";

                if ($mailer->enviarEmail($email, $asunto, $cuerpo)) {
                    echo "Para terminar el proceso de registro, sigue las instrucciones enviadas a su correo electronico";
                    exit;
                }
            } else {
                $errors[] = 'Error al registrar usuario';
            }
        } else {
            $errors[] = 'Error al registrar cliente';
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

    <!------------- REGISTRO --------------->
    <div class="register-container">
        <h2 class="titulos">Crea tu cuenta</h2>

        <?php mostrarMensajes($errors); ?>

        <form id="register-form" action="SignUp.php" method="post" autocomplete="off">
            <label class="formulario" for="nombres"><span class="text-danger">*</span> Nombres:</label>
            <input class="formulario-input" type="text" id="nombres" name="nombres" requireda>

            <label class="formulario" for="apellidos"><span class="text-danger">*</span>Apellidos:</label>
            <input class="formulario-input" type="text" id="apellidos" name="apellidos" requireda>

            <label class="formulario" for="email"><span class="text-danger">*</span>Correo Electrónico:</label>
            <input class="formulario-input" type="email" id="email" name="email" requireda>
            <span id="validaEmail" style="color: red"></span>

            <label class="formulario" for="telefono"><span class="text-danger">*</span>Telefono:</label>
            <input class="formulario-input" type="tel" id="telefono" name="telefono" requireda>

            <label class="formulario" for="dni"><span class="text-danger">*</span>DNI:</label>
            <input class="formulario-input" type="text" id="dni" name="dni" requireda>

            <label class="formulario" for="usuario"><span class="text-danger">*</span>Usuario:</label>
            <input class="formulario-input" type="text" id="usuario" name="usuario" requireda>
            <span id="validaUsuario" style="color: red"></span>

            <label class="formulario" for="password"><span class="text-danger">*</span>Contraseña:</label>
            <input class="formulario-input" type="password" id="password" name="password" requireda>

            <label class="formulario" for="repassword"><span class="text-danger">*</span>Repetir contraseña:</label>
            <input class="formulario-input" type="password" id="repassword" name="repassword" requireda> <br>

            <i style="color: #fff"><b>Nota: </b> Los campos con asterisco ( * ) son obligatorios<br>
                El DNI se refiere a algun numero o clave de identificacion personal.</i>

            <button class="btn_formulario" type="submit">Crear Cuenta</button>
        </form>
        <p id="error-message"></p>
    </div>


    <!-- Footer-->
    <?php include 'footer.php'; ?>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        let txtUsuario = document.getElementById('usuario')
        txtUsuario.addEventListener("blur", function () {
            existeUsuario(txtUsuario.value)
        }, false)

        let txtEmail = document.getElementById('email')
        txtEmail.addEventListener("blur", function () {
            existeEmail(txtEmail.value)
        }, false)

        function existeUsuario(usuario) {
            let url = "clases/clienteAjax.php"
            let formData = new FormData()
            formData.append("action", "existeUsuario")
            formData.append("usuario", usuario)

            fetch(url, {
                method: 'POST',
                body: formData,
            }).then(response => response.json())
                .then(data => {

                    if (data.ok) {
                        document.getElementById('usuario').value = ''
                        document.getElementById('validaUsuario').innerHTML = 'Usuario en uso'
                    } else {
                        document.getElementById('validaUsuario').innerHTML = ''
                    }

                })
        }

        function existeEmail(email) {
            let url = "clases/clienteAjax.php"
            let formData = new FormData()
            formData.append("action", "existeEmail")
            formData.append("email", email)

            fetch(url, {
                method: 'POST',
                body: formData,
            }).then(response => response.json())
                .then(data => {

                    if (data.ok) {
                        document.getElementById('email').value = ''
                        document.getElementById('validaEmail').innerHTML = 'Email en uso'
                    } else {
                        document.getElementById('validaEmail').innerHTML = ''
                    }

                })
        }
    </script>

    <!-- Instagram icon -->
    <a href="https://www.instagram.com/axo.clothes/" class="float">
        <img class="img-w" src="images/wasac.png">
    </a>

</body>



</html>