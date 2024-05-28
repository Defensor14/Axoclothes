<?php

require '../config/config.php';
require '../config/database.php';
$db = new Database();
$con = $db->conectar();

$sql = $con->prepare("SELECT id, nombre, price FROM producto WHERE activo=1");
$sql->execute();
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
$id = isset($_GET['id']) ? $_GET['id'] : '';

$token_tmp = hash_hmac('sha1', $id, KEY_TOKEN);

//session_destroy();

//print_r($_SESSION);


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
    <!-- Navigationsolo-->
    <?php include 'menu.php'; ?>

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
    <section id="general-section">
        <div id="general-container">
            <div class="cotenedor-interno" id="contenedor_tarjetas">
                <!-- CARD-->
                <?php foreach ($resultado as $row) { ?>
                    <div class="tarjeta" id="tarjeta-base">
                        <div class="card h-100">
                            <?php

                            $id = $row['id'];
                            $imagen = "images/$id/product.jpg";
                            if (!file_exists($imagen)) {
                                $imagen = "images/no-photo.jpg";
                            }
                            ?>
                            <!-- Product image-->
                            <!-- Descuento-->
                            <div class="badge bg-dark text-white position-absolute top-0 end-0 mt-1 me-1"></div>
                            <img class="card-img-top img-cards-size" src="<?php echo $imagen; ?>" alt="..." />
                            </figure>
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder" id="titulo"><?php echo $row['nombre']; ?></h5>
                                    <p id="tipo">----</p>
                                    <!-- Product price-->
                                    <span id="precio"><?php echo number_format($row['price'], 2, '.', ','); ?></span>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <a class="btn btn-outline-dark mt-auto"
                                        href="detalles.php?id=<?php echo $row['id']; ?>&token=<?php echo hash_hmac('sha1', $row['id'], KEY_TOKEN); ?>">Ver
                                        más</a>
                                    <button class="btn-outline-success" type="buttom"
                                        onclick="addProducto(<?php echo $row['id']; ?>, '<?php echo hash_hmac('sha1', $row['id'], KEY_TOKEN); ?>')">Agregar
                                        al carrito</button>
                                </div>
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
    <?php include 'footer.php';?>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <!-- <script type="text/javascript" src="js/scripts.js"></script>
   <script type="text/javascript" src="js/bd_stock.js"></script> -->
    <script src="js/zoom.js"></script>

    <script>
        function addProducto(id, token) {
            let url = 'clases/carrito.php'
            let formData = new FormData()
            formData.append('id', id)
            formData.append('token', token)

            fetch(url, {
                method: 'POST',
                body: formData,
                mode: 'cors'
            }).then(response => response.json())
                .then(data => {
                    console.log(data);
                    if (data.ok) {
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