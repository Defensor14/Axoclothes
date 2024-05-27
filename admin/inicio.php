<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verificar si el usuario ha iniciado sesión
session_start();

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
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $price = $_POST['price'];
    $descuento = $_POST['descuento'];
    $stock = $_POST['stock'];
    $fecha_entrada = $_POST['fecha_entrada'];
    $id_proveedor = $_POST['id_proveedor'];
    $id_almacen = $_POST['id_almacen'];
    $activo = $_POST['activo'];

    $sql = "INSERT INTO producto (nombre, descripcion, price, descuento, stock, fecha_entrada, id_proveedor, id_almacen, activo) VALUES ('$nombre', '$descripcion', '$price', '$descuento', '$stock', NOW(), '$id_proveedor', '$id_almacen', '$activo')";

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

<?php include 'header.php'; ?>

<body>
    <main>
        <div class="container crud-section">
            <h3>Crear Nuevo Producto</h3>
            <form method="post" action="" class="product-form">
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
                    <span>del 1 al 100</span>
                </div>
                <div class="form-group">
                    <label for="stock">Stock:</label>
                    <input type="text" id="stock" name="stock" class="form-control">
                </div>
                <div class="form-group">
                    <label for="id_proveedor">ID Proveedor:</label>
                    <input type="text" id="id_proveedor" name="id_proveedor" class="form-control">
                    <span>del 1 al 3</span>
                </div>
                <div class="form-group">
                    <label for="id_almacen">ID Almacen:</label>
                    <input type="text" id="id_almacen" name="id_almacen" class="form-control">
                    <span>del 1 al 2</span>
                </div>
                <div class="form-group">
                    <label for="activo">Activo:</label>
                    <input type="text" id="activo" name="activo" class="form-control">
                    <span>1=Si, 0=No</span>
                </div>
                <button type="submit" name="crear" class="btn btn-lg btn-primary m-2">Crear</button>
            </form>
        </div>

        <!-- Mostrar Inventario -->
        <div class="container crud-section">
            <h3>Inventario de Productos</h3>
            <table class="table table-bordered table-primary">
                <thead>
                    <tr>
                        <th class="table-danger">Nombre</th>
                        <th class="table-danger">Descripción</th>
                        <th class="table-danger">Precio</th>
                        <th class="table-danger">Descuento</th>
                        <th class="table-danger">Stock</th>
                        <th class="table-danger">Fecha de Entrada</th>
                        <th class="table-danger">ID Proveedor</th>
                        <th class="table-danger">ID Almacen</th>
                        <th class="table-danger">Activo</th>
                        <th class="table-danger">Editar</th>
                        <th class="table-danger">Eliminar</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    // Verificar si se encontraron resultados
                    if ($result->num_rows > 0) {
                        // Iterar sobre cada fila de resultados
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["nombre"] . "</td>";
                            echo "<td>" . $row["descripcion"] . "</td>";
                            echo "<td>" . $row["price"] . "</td>";
                            echo "<td>" . $row["descuento"] . "</td>";
                            echo "<td>" . $row["stock"] . "</td>";
                            echo "<td>" . $row["fecha_entrada"] . "</td>";
                            echo "<td>" . $row["id_proveedor"] . "</td>";
                            echo "<td>" . $row["id_almacen"] . "</td>";
                            echo "<td>" . $row["activo"] . "</td>";
                            echo "<td><a href='editar.php?nombre=" . $row["nombre"] . "'>Editar</a></td>";
                            echo "<td>
                            <form method='post' action=''>
                                <input type='hidden' name='nombre' value='" . $row["nombre"] . "'>
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
</main>

<?php include 'footer.php'; ?>