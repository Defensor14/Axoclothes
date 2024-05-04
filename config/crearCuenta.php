<?php
// Establece la conexión con la base de datos
    $hostname = "localhost:3307";
    $database = "axoclothes 1";
    $username = "root";
    $password = "";
    $charset = "utf8";

// Crea una conexión
$conn = new mysqli($hostname, $username, $password, $database);

// Verifica la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtiene los datos del formulario
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$password = $_POST['password'];
$pais = $_POST['pais'];
$address = $_POST['address'];
$telefono = $_POST['telefono'];
$rol= "cliente";

// Prepara la consulta SQL para insertar datos en la base de datos
$sql1 = "INSERT INTO user (nombre, apellido, email, password, rol) VALUES ('$nombre', '$apellido', '$email', '$password', '$rol')";

// Ejecuta la consulta SQL
if ($conn->query($sql1) === TRUE) {

    $user_id = $conn->insert_id;

    // Hacer la inserción en la tabla 'inter_cliente' utilizando el ID del usuario
    $sql2 = "INSERT INTO inter_cliente (id_cliente, address, pais, telefono) VALUES ('$user_id', '$address', '$pais', '$telefono')";

    if ($conn->query($sql2) === TRUE) {
        echo "Registro exitoso";
        header("Location: ../home/Login.php");
        exit;
    } else {
        echo "Error al insertar datos en la tabla 'inter_cliente': " . $conn->error;
    }
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cierra la conexión
$conn->close();
?>