<?php

require '../config/config.php';
require '../config/database.php';
$db = new Database();
$con = $db->conectar();

/*$sql = $con->prepare("SELECT id, nombre, price FROM producto WHERE activo=1");
$sql->execute();
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);*/


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
    <!-- Core theme CSS (includes Bootstrap)-->
    <!--Archivos CSS-->
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/theme.css">
    <link rel="stylesheet" href="css/realstyle.css">

</head>

<body>
    
    <?php include 'menu.php';?>

    <!-- Header-->
    <header>
        <div class="contenedorSlider">
            <input type="radio" id="1" name="slide" hidden />
            <input type="radio" id="2" name="slide" hidden />
            <input type="radio" id="3" name="slide" hidden />

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
        <div class="info-section">
            <div class="info-item">
                <img src="images/Icon_entrega.png" alt="Envío gratis">
                <div>
                    <p class="info-Titulo">Envío gratis</p>
                    <p class="info-Subtitulo">A todo México</p>
                </div>
            </div>
            <div class="info-item">
                <img src="images/Icon_promocion.png" alt="Cupones y promociones">
                <div>
                    <p class="info-Titulo">Cupones y promociones</p>
                    <p class="info-Subtitulo">Para todos los clientes</p>
                </div>
            </div>
            <div class="info-item">
                <img src="images/Icon_compra.png" alt="Compatibilidad y confiabilidad">
                <div>
                    <p class="info-Titulo">Compatibilidad y confiabilidad</p>
                    <p class="info-Subtitulo">Compra cuando quieras</p>
                </div>
            </div>
        </div>

        <div class="interfaz-index">
            <div class="contenedor-index1">
                <img src="images/IS_small_01.png">
            </div>

            <div class="contenedor-index1">
                <img src="images/IS_small_02.png">
            </div>

            <div class="contenedor-index1">
                <img src="images/IS_small_03.png">
            </div>

            <div class="contenedor-index1">
                <img src="images/IS_small_04.png">
            </div>

            <div class="contenedor-index1">
                <img src="images/IS_small_05.png">
            </div>

            <div class="contenedor-index1">
                <img src="images/IS_small_06.png">
            </div>
        </div>

        <div class="info-section2">
            <div class="info-centro">
                <img src="images/Icono_tienda.png" alt="Compatibilidad y confiabilidad">
                <div>
                    <p class="info-Titulo">Compra todo lo que quieras</p>
                    <p class="info-Subtitulo">Sin salir de casa</p>
                </div>
            </div>
        </div>

        <div class="interfaz-index">
            <div class="contenedor-index2">
                <img src="images/IS_large_02.jpg">
            </div>

            <div class="contenedor-index2">
                <img src="images/IS_large_01.jpg">
            </div>

            <div class="contenedor-index2">
                <img src="images/IS_large_03.jpg">
            </div>
        </div>

    </section>
    <!------ Footer ------>
    <?php include 'footer.php';?>
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