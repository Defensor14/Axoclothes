<?php

require '../config/config.php';
require '../config/database.php';
require 'clases/clienteFunciones.php';

$token_session = $_SESSION['token'];
$orden = $_GET['orden'] ?? null;
$token = $_GET['token'] ?? null;

if ($orden == null || $token == null || $token != $token_session) {
    header('location: compras.php');
    exit;
}

$db = new Database();
$con = $db->conectar();

$sqlCompra = $con->prepare('SELECT id, id_transaccion, fecha, total FROM compra WHERE id_transaccion = ? LIMIT 1');
$sqlCompra->execute([$orden]);
$rowCompra = $sqlCompra->fetch(PDO::FETCH_ASSOC);
$idCompra = $rowCompra['id'];

$fecha = new DateTime($rowCompra['fecha']);
$fecha = $fecha->format('d/m/Y H:i');

$sqlDetalle = $con->prepare('SELECT id, nombre, price, cantidad FROM detalle_compra WHERE id_compra = ?');
$sqlDetalle->execute([$idCompra]);

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
    <?php include 'menu.php'; ?>

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

    <!------------- Detalles --------------->
    <main>
        <div class="container">

            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="card mb-3">
                        <div class="card-header">
                            <strong>Detalle de la compra</strong>
                        </div>
                        <div class="card-body">
                            <p><strong>Fecha: </strong>
                                <?php echo $fecha; ?>
                            </p>
                            <p><strong>Orden: </strong>
                                <?php echo $rowCompra['id_transaccion']; ?>
                            </p>
                            <p><strong>Total: </strong>
                                <?php echo MONEDA . ' ' . number_format($rowCompra['total'], 2, '.', ','); ?>
                            </p>

                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-8">
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
                                <?php
                                while ($row = $sqlDetalle->fetch(PDO::FETCH_ASSOC)) {
                                    $precio = $row['price'];
                                    $cantidad = $row['cantidad'];
                                    $subtotal = $precio * $cantidad;
                                    ?>

                                    <tr>
                                        <td><?php echo $row['nombre']; ?></td>
                                        <td><?php echo MONEDA . ' ' . number_format($precio, 2, '.', ','); ?></td>
                                        <td><?php echo $cantidad ?></td>
                                        <td><?php echo MONEDA . ' ' . number_format($subtotal, 2, '.', ','); ?></td>
                                    </tr>

                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </main>


    <!-- Footer-->
    <?php include 'footer.php'; ?>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Instagram icon -->
    <a href="https://www.instagram.com/axo.clothes/" class="float">
        <img class="img-w" src="images/wasac.png">
    </a>

</body>



</html>