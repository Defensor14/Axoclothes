<?php

require '../config/config.php';
require '../config/database.php';
$db = new Database();
$con = $db->conectar();

$productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] :null;

 print_r($_SESSION);

 $lista_carrito = array();

 if($productos != null){
    foreach($productos as $clave => $cantidad){

        $sql = $con->prepare("SELECT id, nombre, price, descuento, $cantidad AS cantidad FROM producto WHERE id=? AND activo=1");
        $sql->execute([$clave]);
        $lista_carrito[] = $sql->fetch(PDO::FETCH_ASSOC);
 }
}

    //session_destroy();

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
    <!-- Navigationsolo es una prueba-->
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

                <li class="dropdown">
                    <a href="#" class="dropbtn">Usuarios</a>
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
                <span id="num_cart" class="badge bg-secondary"><?php echo $num_cart; ?></span>
            </a>
        </form>
    </nav>

    <!-- Header-->

    <!-- Section-->
    <section id="general-section">
        <div id="general-container">
            
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($lista_carrito == null){
                            echo '<tr><td colspan=5 class="text-center"><b>Lista vacia</b></td></tr>';
                        }else{
                            $total = 0;
                            foreach($lista_carrito as $producto){
                                $_id = $producto['id'];
                                $nombre = $producto['nombre'];
                                $precio = $producto['price'];
                                $descuento = $producto['descuento'];
                                $cantidad = $producto['cantidad'];
                                $precio_desc = $precio - (($precio * $descuento) / 100);
                                $subtotal = $cantidad * $precio_desc;
                                $total += $subtotal;
                             ?>

                        <tr>
                            <td><?php echo $nombre?></td>
                            <td><?php echo MONEDA . number_format($precio_desc, 2, '.',',');?></td>
                            <td>
                                <input type="number" min="1" max="10" step="1" value="<?php echo $cantidad ?>" size="5" id="cantidad_<?php echo $id;?>" onchange="">
                            </td>
                            <td>
                                <div id="subtotal_<?php echo $_id;?>" name="subtotal[]"><?php echo MONEDA . number_format($subtotal, 2, '.',',');?></div>
                            </td>
                            <td><a href="#" id="eliminar" class=" btn btn-warning btn-sm" data-bs-id="<?php echo $_id; ?>" data-bs-toggle="modal" data-bs-target="eliminaModal">Eliminar</a></td>
                        </tr>
                        <?php } ?>

                        <tr>
                            <td colspan="3"></td>
                            <td colspan="2">
                                <p class="h3" id="total"><?php echo MONEDA . number_format($total, 2, '.', ','); ?></p>
                            </td>
                        </tr>

                    </tbody>
                    <?php } ?>
                </table>
            </div>

            <div class="row">
                <div class="col-md-5 offset-md-7 d-grid gap-2">
                    <button class="btn btn-primary btn-lg">Realizar pago</button>
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
    <script src="js/zoom.js"></script>

    <script>
        function addProducto(id, token){
             let url = 'clases/carrito.php'
             let formData = new FormData()
             formData.append('id', id)
             formData.append('token', token)

             fetch(url,{
                method: 'POST',
                body: formData,
                mode: 'cors'
             }).then(response => response.json())
             .then(data => {
                console.log(data);
                if(data.ok){
                    let elemento = document.getElementById("num_cart")
                    elemento.innerHTML = data.numero
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