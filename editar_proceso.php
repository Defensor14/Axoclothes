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

// Verificar si se enviaron los datos del formulario de edición
if(isset($_POST['editar'])) {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $talla = $_POST['talla'];
    $precio = $_POST['precio'];

    // Verificar si se cargó una nueva imagen
    if(isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $imagen = $_FILES['imagen']['name'];
        $imagen_temp = $_FILES['imagen']['tmp_name'];
        $imagen_destino = "uploads/" . $imagen;
        move_uploaded_file($imagen_temp, $imagen_destino);

        // Actualizar la entrada correspondiente en la base de datos, incluyendo la nueva imagen
        $sql = "UPDATE inventario SET descripcion='$descripcion', talla='$talla', precio='$precio', imagen='$imagen_destino' WHERE nombre='$nombre'";
    } else {
        // Actualizar la entrada correspondiente en la base de datos sin cambiar la imagen
        $sql = "UPDATE inventario SET descripcion='$descripcion', talla='$talla', precio='$precio' WHERE nombre='$nombre'";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Producto actualizado correctamente";
        header("refresh:2; url=crud_productos.php");
        exit(); // Salir del script para evitar cualquier otra salida
    } else {
        echo "Error al actualizar producto: " . $conn->error;
    }
} else {
    echo "No se recibieron datos del formulario";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
