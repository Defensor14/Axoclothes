<?php
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "axoclothes";

// Crear una conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si la conexión es exitosa
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener el nombre del producto de la URL
if(isset($_GET['nombre'])) {
    $nombre = $_GET['nombre'];

    // Realizar una consulta para obtener los detalles del producto a editar
    $sql = "SELECT * FROM producto WHERE nombre='$nombre'";
    $result = $conn->query($sql);

    // Verificar si se encontró el producto
    if ($result->num_rows > 0) {
        // Mostrar el formulario de edición con los detalles del producto
        $row = $result->fetch_assoc();
    } else {
        echo "Producto no encontrado";
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
    <link rel="stylesheet" href="css/editar.css">
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
            <button class="btn-carrioto" type="submit">
                <i class="bi-cart-fill me-1"></i>
                Carrito
                <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
            </button>
        </form>
    </nav>

    <!-- Formulario para Editar -->
    <div class="crud-section">
        <h3>Editar Producto</h3>
        <form method="post" action="editar_proceso.php" class="edit-form">
            <div class="form-group">
                <label for="id">ID:</label>
                <input type="text" id="id" name="id" value="<?php echo $row['id']; ?>" class="form-control" readonly>
            </div>
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo $row['nombre']; ?>" class="form-control" readonly>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <input type="text" id="descripcion" name="descripcion" value="<?php echo $row['descripcion']; ?>" class="form-control">
            </div>
            <div class="form-group">
                <label for="price">Precio:</label>
                <input type="text" id="price" name="price" value="<?php echo $row['price']; ?>" class="form-control">
            </div>
            <div class="form-group">
                <label for="descuento">Descuento:</label>
                <input type="text" id="descuento" name="descuento" value="<?php echo $row['descuento']; ?>" class="form-control">
            </div>
            <div class="form-group">
                <label for="stock">Stock:</label>
                <input type="text" id="stock" name="stock" value="<?php echo $row['stock']; ?>" class="form-control">
            </div>
            <div class="form-group">
                <label for="fecha_entrada">Fecha de Entrada:</label>
                <input type="text" id="fecha_entrada" name="fecha_entrada" value="<?php echo $row['fecha_entrada']; ?>" class="form-control">
            </div>
            <div class="form-group">
                <label for="id_proveedor">ID Proveedor:</label>
                <input type="text" id="id_proveedor" name="id_proveedor" value="<?php echo $row['id_proveedor']; ?>" class="form-control">
            </div>
            <div class="form-group">
                <label for="id_almacen">ID Almacen:</label>
                <input type="text" id="id_almacen" name="id_almacen" value="<?php echo $row['id_almacen']; ?>" class="form-control">
            </div>
            <div class="form-group">
                <label for="activo">Activo:</label>
                <input type="text" id="activo" name="activo" value="<?php echo $row['activo']; ?>" class="form-control">
            </div>
            <button type="submit" name="editar" class="btn btn-primary">Editar</button>
        </form>
    </div>
</body>
</html>
