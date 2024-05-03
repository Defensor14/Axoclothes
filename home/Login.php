<?php

require '../config/database.php';
$db = new Database();
$con = $db->conectar();

$sql = $con->prepare("SELECT nombre, apellido, email, password FROM user");
$sql->execute();
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

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

<body onload="formulario()">
    <!-- Navigation-->
    <nav class="navbar">
        <div id="logo">
            <img src="images/logo.svg" style="width: 30px; margin: 5px;">
        </div>
        <a class="navbar-marca" href="index.html">AXOCLOTHES</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            
            <ul class="menu">
                <li><a href="index.html">Inicio</a></li>
                <li class="dropdown">
                    <a href="#" class="dropbtn">Comprar</a>
                    <div class="dropdown-content">
                        <a href="AllProducts.php">Todos los productos</a>
                        <a href="#vision">Tendencias</a>
                        <a href="#valores">Nuevo</a>
                    </div>
                </li>
                <li><a href="#contacto">Sobre nosotros</a></li>
            </ul>
        <form class="d-flex">
            <button class="btn-carrioto" type="submit">
                <i class="bi-cart-fill me-1"></i>
                Carrito
                <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
            </button>
        </form>
    </nav>

    <!-- Header-->
    <header class="headercontenedor py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Explora nuestro catálogo</h1>
                <p class="lead fw-normal text-white-50 mb-0">Encuentra todo lo que necesitas, y lo que no también.</p>
            </div>
        </div>
    </header>

 <!------------- REGISTRO --------------->
    <div class="register-container">
            <h2 class="titulos">Crea tu cuenta</h2>
            <form id="register-form" action="../config/crearCuenta.php" method="post">
                <label  class="formulario" for="firstName">Nombre:</label>
                <input class="formulario-input" type="text" id="firstName" name="nombre" required> 
                <label class="formulario" for="lastName">Apellido:</label>
                <input class="formulario-input" type="text" id="lastName" name="apellido" required> 
                <label class="formulario" for="email">Correo Electrónico:</label>
                <input class="formulario-input" type="email" id="email" name="email" required> 
                <label class="formulario" for="password">Contraseña:</label>
                <input class="formulario-input" type="password" id="password" name="password" required> <br>

                <select name="pais" id="pais" required>
                    <option value="">Selecciona tu país</option> 
                    <option value="Mexico">México</option>
                    <option value="Colombia">Colombia</option>
                    <option value="Argentina">Argentina</option>
                    <option value="Brasil">Brasil</option>
                    <option value="Chile">Chile</option>
                </select>

                <label class="formulario" for="address">Dirección:</label>
                <input class="formulario-input" type="text" id="address" name="address" required> 
                <label class="formulario" for="telefono">Teléfono:</label>
                <input class="formulario-input" type="text" id="telefono" name="telefono" required>
                <button class="btn_formulario" type="submit">Crear Cuenta</button>
            </form>
            <p id="error-message"></p>
    </div>






    
    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; AXOCLOTHES 2023</p>
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