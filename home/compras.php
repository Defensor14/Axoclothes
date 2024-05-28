<?php

require '../config/config.php';
require '../config/database.php';
require 'clases/clienteFunciones.php';


$db = new Database();
$con = $db->conectar();

$token = generarToken();
$_SESSION['token'] = $token;

$idCliente = $_SESSION['user_cliente'];

$sql = $con->prepare("SELECT id_transaccion, fecha, status, total FROM compra WHERE id_cliente = ? ORDER BY DATE(fecha) DESC");
$sql->execute([$idCliente]);

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

    <!------------- Hisorial de compras --------------->
    
        <div class="container-compras">

            <h4>Mis compras</h4>
            <hr>

            <?php while ($row = $sql->fetch(PDO::FETCH_ASSOC)) { ?>

            <div class="card border-primary mb-3">
                <div class="card-header">
                    <?php echo $row['fecha']; ?>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Folio: <?php echo $row['id_transaccion']; ?></h5>
                    <p class="card-text">Total: <?php echo $row['total']; ?> </p>
                    <a href="compra_detalle.php?orden=<?php echo $row['id_transaccion'];?>&token=<?php echo $token; ?>" class="btn btn-primary">Ver detalles</a>
                </div>
            </div>
            
            <?php } ?>

        </div>
   


    <!-- Footer-->
     <?php include 'footer.php';?>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Instagram icon -->
    <a href="https://www.instagram.com/axo.clothes/" class="float">
        <img class="img-w" src="images/wasac.png">
    </a>

</body>
</html>
