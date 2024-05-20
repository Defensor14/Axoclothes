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

// Operación de Crear
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['crear'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $price = $_POST['price'];
    $descuento = $_POST['descuento'];
    $stock = $_POST['stock'];
    $fecha_entrada = $_POST['fecha_entrada'];
    $id_proveedor = $_POST['id_proveedor'];
    $id_almacen = $_POST['id_almacen'];
    $activo = $_POST['activo'];

    $sql = "INSERT INTO producto (id, nombre, descripcion, price, descuento, stock, fecha_entrada, id_proveedor, id_almacen, activo) VALUES ('$id', '$nombre', '$descripcion', '$price', '$descuento', '$stock', '$fecha_entreda', '$id_proveedor', '$id_almacen', '$activo')";

    if ($conn->query($sql) === TRUE) {
        echo "Producto insertado correctamente";
    } else {
        echo "Error al insertar producto: " . $conn->error;
    }
}

// Operación de Leer
$sql = "SELECT * FROM producto";
$result = $conn->query($sql);

// Operación de Editar
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editar'])) {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $price = $_POST['price'];
    $descuento = $_POST['descuento'];
    $stock = $_POST['stock'];
    $fecha_entrada = $_POST['fecha_entrada'];
    $id_proveedor = $_POST['id_proveedor'];
    $id_almacen = $_POST['id_almacen'];
    $activo = $_POST['activo'];

    // Preparar la consulta SQL con parámetros
    $sql = "UPDATE producto SET descripcion=?, price=?, descuento=?, stock=?, fecha_entrada=?, id_proveedor=?, id_almacen=?, activo=? WHERE nombre=?";

    // Preparar la sentencia
    $stmt = $conn->prepare($sql);

    // Vincular los parámetros con los valores
    $stmt->bind_param("sssssssss", $descripcion, $price, $descuento, $stock, $fecha_entrada, $id_proveedor, $id_almacen, $activo, $nombre);

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
    $sql = "DELETE FROM producto WHERE nombre='$nombre'";

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

    <div class="crud-section">
        <h3>Crear Nuevo Producto</h3>
        <form method="post" action="" class="product-form">
            <div class="form-group">
                <label for="id">ID:</label>
                <input type="text" id="id" name="id" class="form-control">
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
                <label for="price">Precio:</label>
                <input type="text" id="price" name="price" class="form-control">
            </div>
            <div class="form-group">
                <label for="descuento">Descuento:</label>
                <input type="text" id="descuento" name="descuento" class="form-control">
            </div>
            <div class="form-group">
                <label for="stock">Stock:</label>
                <input type="text" id="stock" name="stock" class="form-control">
            </div>
            <div class="form-group">
                <label for="fecha_entrada">Fecha de Entrada:</label>
                <input type="text" id="fecha_entrada" name="fecha_entrada" class="form-control">
            </div>
            <div class="form-group">
                <label for="id_proveedor">ID Proveedor:</label>
                <input type="text" id="id_proveedor" name="id_proveedor" class="form-control">
            </div>
            <div class="form-group">
                <label for="id_almacen">ID Almacen:</label>
                <input type="text" id="id_almacen" name="id_almacen" class="form-control">
            </div>
            <div class="form-group">
                <label for="activo">Activo:</label>
                <input type="text" id="activo" name="activo" class="form-control">
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
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Descuento</th>
                    <th>Stock</th>
                    <th>Fecha de Entrada</th>
                    <th>ID Proveedor</th>
                    <th>ID Almacen</th>
                    <th>Activo</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>

            <?php
            // Verificar si se encontraron resultados
            if ($result->num_rows > 0) {
                // Iterar sobre cada fila de resultados
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row["id"]."</td>";
                    echo "<td>".$row["nombre"]."</td>";
                    echo "<td>".$row["descripcion"]."</td>";
                    echo "<td>".$row["price"]."</td>";
                    echo "<td>".$row["descuento"]."</td>";
                    echo "<td>".$row["stock"]."</td>";
                    echo "<td>".$row["fecha_entrada"]."</td>";
                    echo "<td>".$row["id_proveedor"]."</td>";
                    echo "<td>".$row["id_almacen"]."</td>";
                    echo "<td>".$row["activo"]."</td>";
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
                echo "<tr><td colspan='12'>No hay productos en el inventario</td></tr>";
            }
            ?>

            </tbody>
        </table>
    </div>
</body>
</html>