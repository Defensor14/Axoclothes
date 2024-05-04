<?php

require '../config/database.php';
$db = new Database();
$con = $db->conectar();

$sql = $con->prepare("SELECT id, nombre, price FROM producto WHERE activo=1");
$sql->execute();
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

?>

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

    <!--Archivos CSS-->
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/theme.css">
    <link rel="stylesheet" href="css/realstyle.css">
</head>

<body>
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

    <!-- Section-->
    <section id="general-section">
        <div id="general-container">
            <div class="cotenedor-interno"
                id="contenedor_tarjetas">
                <!-- CARD-->
                <?php  foreach($resultado as $row) { ?>
                <div class="tarjeta" id="tarjeta-base">
                    <a class="linkitems" href="../item/index.html">
                        <div class="card h-100">
                        <?php 

                        $id = $row['id'];
                        $imagen = "images/$id/product.jpg";
                        if(!file_exists($imagen)){
                            $imagen = "images/no-photo.jpg";
                        }
                        ?>
                            <!-- Product image-->
                                <!-- Descuento-->
                                <div class="badge bg-dark text-white position-absolute top-0 end-0 mt-1 me-1"></div>
                                <img class="card-img-top zoom" src="<?php echo $imagen;?>" alt="..." />
                            </figure>
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder" id="titulo"><?php echo $row['nombre'];?></h5>
                                    <p id="tipo">----</p>
                                    <!-- Product price-->
                                    <span id="precio"><?php echo number_format($row['price'],2,'.',',');?></span>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto"
                                        href="stock/Blue_Dreams.html">Ver más</a></div>
                            </div>
                        </div>
                    </a>
                </div>
                <?php } ?>
                <!-- End CARD-->

            </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; AXOCLOTHES 2023</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <!-- <script type="text/javascript" src="js/scripts.js"></script>
   <script type="text/javascript" src="js/bd_stock.js"></script> -->
    <script src="js/zoom.js"></script>

    <!-- Instagram icon -->
    <a href="https://www.instagram.com/axo.clothes/" class="float">
        <img class="img-w" src="images/wasac.png">
    </a>

</body>

</html>