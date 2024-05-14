<?php
$servername = "localhost";
$username = "tu_usuario"; 
$password = "tu_contraseña"; 
$dbname = "axoclothes"; 

// Crear una conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si la conexión es exitosa
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verificar si se enviaron los datos del formulario de edición
if(isset($_POST['editar'])) {
    // Obtener los datos del formulario
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

    // Actualizar la entrada correspondiente en la base de datos
    $sql = "UPDATE producto SET descripcion='$descripcion', price='$price', descuento='$descuento', stock='$stock', fecha_entrada='$fecha_entrada', id_proveedor='$id_proveedor', id_almacen='$id_almacen', activo='$activo' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Producto actualizado correctamente";
        header("refresh:2; url=crud_productos.php");
        exit(); 
    } else {
        echo "Error al actualizar producto: " . $conn->error;
    }
} else {
    echo "No se recibieron datos del formulario";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
