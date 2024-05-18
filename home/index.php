<!DOCTYPE html>
<html lang="en">

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
    <!-- Core theme CSS (includes Bootstrap)-->
    <!--Archivos CSS-->
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/theme.css">
    <link rel="stylesheet" href="css/realstyle.css">

</head>

<body>
    <nav class="navbar">
        <div id="logo">
            <img src="images/logo.svg">
        </div>
        <a class="navbar-brand" href="index.php">AXOCLOTHES</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            
            <ul class="menu">
                <li><a href="index.php">Inicio</a></li>
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

    <header>
        <div class="contenedorSlider">
            <input type="radio" id="1" name="slide" hidden/>
            <input type="radio" id="2" name="slide" hidden/>
            <input type="radio" id="3" name="slide" hidden/>

            <div class="slide">
                <!---->
                <div class="item-slide" id="s1" style="background-color: #ffaab6;">
                </div>
                <!---->

                <!---->
                <div class="item-slide" id="s2" style="background-color: #ffd659;">

                </div>
                <!---->

                <!---->
                <div class="item-slide" id="s3" style="background-color: #ff6378;">

                </div>
                <!---->
            </div>
            
            <div class="pagination">
                <label class="pagination-item" for="1"></label>
                <label class="pagination-item" for="2"></label>
                <label class="pagination-item" for="3"></label>
            </div>

        </div>
    </header>
    
    <!-- Section-->
    <section>
        <div class="interfaz-index">
            <div class="caja contenedor-index1"></div>
            <div class="caja contenedor-index2"></div>
            <div class="caja contenedor-index3"></div>
            <div class="caja contenedor-index2"></div>
            <div class="caja contenedor-index1"></div>
        </div>
       
    </section>
    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container">
            <a href="aboutus.html"><p class="m-0 text-center enlaces-footer">Acerca de</p></a> <p class="m-0 text-center text-white">•</p>
            <a href="policy.html"><p class="m-0 text-center enlaces-footer">Privacidad</p></a>    <p class="m-0 text-center text-white">•</p>
            <a href="terms.html"><p class="m-0 text-center enlaces-footer">Términos</p></a> <br>
            <p class="m-0 text-center text-white">Copyright &copy; AXOCLOTHES 2024</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>

    <!-- Instagram icon -->
    <a href="https://www.instagram.com/axo.clothes/" class="float">
        <img class="img-w" src="images/wasac.png">
    </a>
</body>

</html>