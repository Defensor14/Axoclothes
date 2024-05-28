<?php

require '../config/config.php';
require '../config/database.php';
require 'clases/clienteFunciones.php';


$db = new Database();
$con = $db->conectar();

$errors = [];

if (!empty($_POST)) {

    $email = trim($_POST['email']);

    if (esNulo([$email])) {
        $errors[] = 'Debe llenar todos los campos';
    }

    if (!esEmail($email)) {
        $errors[] = 'La direccion de correo eletronico no es valida';
    }

    if (count($errors) == 0) {
        if (emailExiste($email, $con)) {
            $sql = $con->prepare("SELECT usuarios.id, clientes.nombres FROM usuarios INNER JOIN  clientes ON usuarios.id_cliente=clientes.id WHERE clientes.email LIKE ? LIMIT 1");
            $sql->execute([$email]);
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            $user_id = $row["id"];
            $nombres = $row["nombres"];

            $token = solicitaPassword($user_id, $con);
            if ($token !== null){
                require 'clases/mailer.php';
                $mailer = new Mailer();

                $url = SITE_URL . '/reset_password.php?id=' . $user_id . '&token=' . $token;
                $asunto = "Recuperar contraseña - Axoclothes";
                $cuerpo = "No te quedes fuera $nombres: <br>Para realizar el cambio de tu contraseña da click en el siguiente enlace. <a href='$url'>$url</a>";
                $cuerpo.= "<br>Si no fuiste tu quien realizo esta solicitud solo ignora este correo.";

                if ($mailer->enviarEmail($email, $asunto, $cuerpo)) {
                    echo "<p><b>Correo enviado</b></p>";
                    echo "<p>Hemos enviado un correo electronico a la direccion $email para reestablecer la contraseña<br>Si no lo encuentras en tu bandeja principal revisa la bandeja de Span</p>";
                    exit;
                }
            }
        } else {
            $errors[] = "No existe una cuenta asocidada a este correo";
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

<body style="background-color: #9c9c9c;">
    <!-- Navigation-->
    <?php include 'menu_registro.php';?>

    <!-- Header-->

    <!------------- Recupera --------------->
    <div class="register-container">
        <h3 style="color: #FFFFFF;">Recuperar Contraseña</h3>

        <?php mostrarMensajes($errors); ?>

        <form action="recupera.php" method="post" autocomplete="off">

            <div class="form-floating" style="margin: 15px;">
                <input class="form-control" type="email" name="email" id="email" placeholder="Correo electronico"
                    require>
                <label for="email">Correo Electrónico</label>
            </div>

            <div class="d-grid gap-3 col-12">
                <button type="submit" class="btn btn-primary" style="background-color: #FA8191; color: white; width: 50%; margin: 0 auto;">Recuperar</button>
            </div>
            <hr>
            <div class="col-12" style="color:#fff;">
                ¿No tienes cuenta? <a style="color:#1F67F5;" href="SignUp.php">Crea una aquí</a>
            </div>

        </form>
    </div>


    <!-- Footer-->
    <?php include 'footer_registro.php';?>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Instagram icon -->
    <a href="https://www.instagram.com/axo.clothes/" class="float">
        <img class="img-w" src="images/wasac.png">
    </a>

</body>
</html>
