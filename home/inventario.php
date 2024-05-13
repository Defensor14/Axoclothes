<?php
$servername = "localhost";
$username = "tu_usuario"; // Cambia esto por tu nombre de usuario de la base de datos
$password = "tu_contraseña"; // Cambia esto por tu contraseña de la base de datos
$dbname = "nombre_de_tu_base_de_datos"; // Cambia esto por el nombre de tu base de datos

// Operación de Crear
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['crear'])) {
    $conn = new mysqli($servername, $username, $password, $dbname);

    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $talla = $_POST['talla'];
    $precio = $_POST['precio'];

    // Obtener la ruta de la imagen y subirla al servidor
    $imagen = $_FILES['imagen']['name'];
    $imagen_temp = $_FILES['imagen']['tmp_name'];
    $imagen_destino = "uploads/" . $imagen;
    move_uploaded_file($imagen_temp, $imagen_destino);

    $sql = "INSERT INTO inventario (nombre, descripcion, talla, precio, imagen) VALUES ('$nombre', '$descripcion', '$talla', '$precio', '$imagen_destino')";

    if ($conn->query($sql) === TRUE) {
        echo "Producto insertado correctamente";
    } else {
        echo "Error al insertar producto: " . $conn->error;
    }
}

// Operación de Leer
$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "SELECT * FROM inventario";
$result = $conn->query($sql);

// Operación de Editar
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editar'])) {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $talla = $_POST['talla'];
    $precio = $_POST['precio'];

    // Preparar la consulta SQL con parámetros
    $sql = "UPDATE inventario SET descripcion=?, talla=?, precio=? WHERE nombre=?";

    // Preparar la sentencia
    $stmt = $conn->prepare($sql);

    // Vincular los parámetros con los valores
    $stmt->bind_param("ssss", $descripcion, $talla, $precio, $nombre);

    // Ejecutar la sentencia
    if ($stmt->execute()) {
        echo "Producto editado correctamente";
    } else {
        echo "Error al editar producto: " . $stmt->error;
    }

    // Cerrar la sentencia
    $stmt->close();
}

// Verificar si se envió el formulario de eliminación
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eliminar'])) {
    // Obtener el nombre del producto a eliminar
    $nombre = $_POST['nombre'];

    // Consulta SQL para eliminar el producto de la base de datos
    $sql = "DELETE FROM inventario WHERE nombre='$nombre'";

    if ($conn->query($sql) === TRUE) {
        // Producto eliminado correctamente
        echo "Producto eliminado correctamente";
    } else {
        echo "Error al eliminar producto: " . $conn->error;
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

    <div class="crud-section">
    <h3>Crear Nuevo Producto</h3>
    <form method="post" action="" class="product-form" enctype="multipart/form-data">

        <div class="form-group">
            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" name="imagen" class="form-control">
        </div>  
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" class="form-control">
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <input type="text" id="descripcion" name="descripcion" class="form-control">
        </div>
        <div class="form-group">
            <label for="talla">Talla:</label>
            <input type="text" id="talla" name="talla" class="form-control">
        </div>
        <div class="form-group">
            <label for="precio">Precio:</label>
            <input type="text" id="precio" name="precio" class="form-control">
        </div>
        <button type="submit" name="crear" class="btn btn-primary">Crear</button>
    </form>
</div>

<!-- Mostrar Inventario -->
<div class="crud-section">
    <h3>Inventario de Productos</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Talla</th>
                <th>Precio</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>

    
    <?php
// Realizar una consulta a la base de datos para obtener los registros
$sql = "SELECT * FROM inventario";
$result = $conn->query($sql);

// Verificar si se encontraron resultados
if ($result->num_rows > 0) {
    // Iterar sobre cada fila de resultados
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        // Aquí agregamos la verificación de la imagen
        if ($row["imagen"] !== null) {
            echo "<td><img src='uploads/".$row["imagen"]."' alt='".$row["nombre"]."'></td>";
        } else {
            echo "<td>No hay imagen disponible</td>";
        }
        echo "<td>".$row["nombre"]."</td>";
        echo "<td>".$row["descripcion"]."</td>";
        echo "<td>".$row["talla"]."</td>";
        echo "<td>".$row["precio"]."</td>";
        echo "<td><a href='editar.php?nombre=".$row["nombre"]."'>Editar</a></td>";
        echo "<td>
                <form method='post' action=''>
                    <input type='hidden' name='nombre' value='".$row["nombre"]."'>
                    <input type='submit' name='eliminar' value='Eliminar'>
                </form>
              </td>";
        echo "</tr>";
    }
    
} else {
    // Si no se encontraron resultados, imprimir un mensaje
    echo "<tr><td colspan='7'>No hay productos en el inventario</td></tr>";
}
?>

</table>
</body>
</html>
