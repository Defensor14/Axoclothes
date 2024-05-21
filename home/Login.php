<?php
require '../config/database.php';
$db = new Database();
$con = $db->conectar();

$sql = $con->prepare("SELECT email, password, rol FROM user");
$sql->execute();
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

// Verificar si se ha enviado el formulario de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    // Obtener los datos del formulario de inicio de sesión
    $email = $_POST['email'];
    $pass = $_POST['password'];

    foreach ($resultado as $row) {
        if ($row['email'] == $email && password_verify($pass, $row['password'])) {
            // Iniciar sesión y redirigir al usuario a la página correspondiente
            session_start();
            $_SESSION['email'] = $email;
            $_SESSION['rol'] = $row['rol'];

            if ($_SESSION['rol'] === 'admin') {
                header("Location: inventario.php"); // Página de bienvenida para administradores
            } else {
                header("Location: index.html"); // Página de bienvenida para usuarios normales
            }
            exit(); // Importante para detener la ejecución después de la redirección
        }
    }
    echo "Usuario o contraseña incorrectos";
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
    <link href="css/realstyle.css" rel="stylesheet"/>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/theme.css" rel="stylesheet" />


    

</head>

<body>
    <!-- Navigation-->
    <nav class="navbar">
        <div id="logo">
            <img src="images/logo.svg">
        </div>
        <a class="navbar-brand" href="index.html">AXOCLOTHES</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            
            <ul class="menu">
                <li><a href="index.php">Inicio</a></li>
                <li><a href="inventario.php">Inventario</a></li>
                <li class="dropdown">
                    <a href="AllProducts.php"class="dropbtn">Comprar</a>
                    <div class="dropdown-content">
                        <a href="AllProducts.php">Todos los productos</a>
                        <a href="#vision">Tendencias</a>
                        <a href="#valores">Nuevo</a>
                    </div>
                </li>
                <li class="dropdown">
                    <a href="Login.php" class="dropbtn">Usuarios</a>
                    <div class="dropdown-content">
                        <a href="SignUp.php">Crear cuenta</a>
                        <a href="Login.php">Iniciar sesion</a>
                    </div>
                </li>
            </ul>
            
            <form class="d-flex">
            <a  href="chekout.php" class="btn-carrioto" type="submit">
                <i class="bi-cart-fill me-1"></i>
                Carrito
                <span id="num_cart" class="badge bg-secondary"></span>
            </a>
        </form>
    </nav>

    <!-- Header-->
    <header class="headercontenedor py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">¡Obtén más beneficios!</h1>
                <p class="lead fw-normal text-white-50 mb-0">Recibe descuentos y entérate de promociones al registrarte en Axoclothes</p>
            </div>
        </div>
    </header>

 <!------------- INICIAR SESIÓN --------------->
    <div class="register-container">
            <h2 class="titulos">Iniciar sesión</h2>
            <form id="register-form" action="../config/IniciarSesion.php" method="post">
                <label class="formulario" for="email">Email:</label>
                <input class="formulario-input" type="email" id="email" name="email" required>
                <label class="formulario" for="password">Contraseña:</label>
                <input class="formulario-input" type="password" id="password" name="password" required>

                <button class="btn_formulario" type="submit">Iniciar sesión</button>
                <p class="signup-link">¿Aún no tienes cuenta? <a href="SignUp.php">Regístrate aquí</a></p>
            </form>
            <p id="error-message"></p>
    </div>






    
    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container d-flex justify-content-between align-items-center">
            <ul class="footer-menu mb-0 d-flex">
                <li><a href="Index.php">INICIO</a></li>
                <li><a href="AllProducts.php">COMPRAR</a></li>
                <li><a href="chekout.php">CARRITO</a></li>
                <li><a href="aboutus.html">ACERCA DE</a></li>
                <li><a href="policy.html">PRIVACIDAD</a></li>
                <li><a href="terms.html">TERMINOS</a></li>
            </ul>
        </div>
        <div class="container mt-3">
            <p class="m-0 text-center text-white">© Copyright 2023 - 2024 Axoclothes Inc. Todos los derechos reservados.</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- CREAR CUENTA CON JAVASCRIPT
        script src="js/javaCrearCuenta.js"></script-->
    <!-- Core theme JS-->
    <!-- <script type="text/javascript" src="js/scripts.js"></script>
   <script type="text/javascript" src="js/bd_stock.js"></script> -->
    

    <!-- Instagram icon -->
    <a href="https://www.instagram.com/axo.clothes/" class="float">
        <img class="img-w" src="images/wasac.png">
    </a>

</body>



</html>
