<?php

require '../config/config.php';
require '../config/database.php';
$db = new Database();
$con = $db->conectar();

$id = isset($_GET['id']) ? $_GET['id'] : '';
$token = isset($_GET['token']) ? $_GET['token'] : '';

if($id == '' || $token == ''){
    echo 'Error al procesar la petición';
    exit;
} else {

    $token_tmp = hash_hmac('sha1', $id, KEY_TOKEN);
    if($token == $token_tmp){

        $sql = $con->prepare("SELECT count(id) FROM producto WHERE id=? AND activo=1");
        $sql->execute([$id]);
        if($sql -> fetchColumn() > 0 ){

            $sql = $con->prepare("SELECT nombre, descripcion, price, descuento FROM producto WHERE id=? AND activo=1 LIMIT 1");
            $sql->execute([$id]);
            $row = $sql-> fetch(PDO::FETCH_ASSOC);
            $nombre = $row['nombre'];
            $descripcion = $row['descripcion'];
            $precio = $row['price'];
            $descuento = $row['descuento'];
            $precio_desc = $precio - (($precio * $descuento)/100);
            $dir_images = 'images/'.$id.'/product.jpg';

            // $rutaImg = $dir_images . 'principal.jpg';

            // if(!file_exists($rutaImg)){
            //     $rutaImg = 'images/no-photo.jpg';
            // }

            // $imagenes = array();
            // $dir = dir($dir_images);

            // while(($archivo = $dir->read()) != false){
            //     if($archivo != 'principal.jpg' && (strpos($archivo, 'jpg') || strpos($archivo, 'jpeg'))){
            //         $imagenes[] = $dir_images . $archivo;
            //     }
            // }
            // $dir->close();
        }
        
    }else {
        echo 'Error al procesar la petición';
        exit;
    }
}


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
                
            <li class="dropdown">
                    <a href="#" class="dropbtn">Usuario</a>
                    <div class="dropdown-content">
                        <a href="Login.php">Inicia sesion</a>
                        <a href="SignUp.php">Crear cuenta</a>
                    </div>
                </li>

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
       <div class="row">
        <div class="col-md-6 order-md-1">
            <img src="<?php echo $dir_images ?>">
        </div>
        <div class="col-md-6 order-md-2">
            <h2><?php echo $nombre?></h2>

            <?php if($descuento > 0){ ?>
            <p><del><?php echo MONEDA . number_format($precio, 2, '.', ',');?></del></p>
            <h2>
                <?php echo MONEDA . number_format($precio_desc, 2, '.', ',');?>
                <small clas="text-success"><?php echo $descuento; ?>% descuento</small>
            </h2>

            <?php } else { ?>


            <h2><?php echo MONEDA . number_format($precio, 2, '.', ',');?></h2>

            <?php } ?>

            <p class="Info">
                <?php echo $descripcion ?>
            </p>

            <div class="Cont-btn"> 
                <button class="btn-primary" type="buttom">Comprar Ahora</button>
                <button class="btn-outline-primary" type="buttom">Agregar al carrito</button>
            </div>
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