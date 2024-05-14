<?php
$servername = "localhost";
$username = "tu_usuario"; // Cambia esto por tu nombre de usuario de la base de datos
$password = "tu_contraseña"; // Cambia esto por tu contraseña de la base de datos
$dbname = "nombre_de_tu_base_de_datos"; // Cambia esto por el nombre de tu base de datos

// Crear una conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si la conexión es exitosa
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener el nombre de la planta de la URL
if(isset($_GET['nombre'])) {
    $nombre = $_GET['nombre'];

    // Realizar una consulta para obtener los detalles de la planta a editar
    $sql = "SELECT * FROM inventario WHERE nombre='$nombre'";
    $result = $conn->query($sql);

    // Verificar si se encontró la planta
    if ($result->num_rows > 0) {
        // Mostrar el formulario de edición con los detalles de la planta
        $row = $result->fetch_assoc();
        $imagen = $row['imagen']; // Obtener la ruta de la imagen
    } else {
        echo "Planta no encontrada";
    }
} else {
    echo "Faltan parámetros en la URL";
}

// Cerrar la conexión a la base de datos
$conn->close();
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
    <link rel="stylesheet" href="css/inventario.css">


</head>

<body>
    <nav class="navbar">
        <div id="logo">
            <img src="../images/logo.svg" style="width: 30px; margin: 5px;">
        </div>
        <a class="navbar-marca" href="index.html">AXOCLOTHES</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            
            <ul class="menu">
                <li><a href="#">Inicio</a></li>
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

    <!-- Formulario para Editar -->
    <form method="post" action="editar_proceso.php" class="edit-form" enctype="multipart/form-data">
        <div class="form-group">
            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" name="imagen" class="form-control">
            <?php if (!empty($imagen)) : ?>
                <img src="<?php echo $imagen; ?>" alt="Imagen del producto" style="max-width: 200px;">
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $row['nombre']; ?>" class="form-control">
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <input type="text" id="descripcion" name="descripcion" value="<?php echo $row['descripcion']; ?>" class="form-control">
        </div>
        <div class="form-group">
            <label for="talla">Talla:</label>
            <input type="text" id="talla" name="talla" value="<?php echo $row['talla']; ?>" class="form-control">
        </div>
        <div class="form-group">
            <label for="precio">Precio:</label>
            <input type="text" id="precio" name="precio" value="<?php echo $row['precio']; ?>" class="form-control">
        </div>
        <button type="submit" name="editar" class="btn btn-primary">Editar</button>
    </form>
</body>
</html>
