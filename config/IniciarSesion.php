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
$email = $_POST['email'];
$password = $_POST['password'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];

// Buscar usuario en la tabla
$sql = "SELECT * FROM user WHERE email='$email'";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // Usuario encontrado, verificar contraseña
    $row = $result->fetch_assoc();
    if ($password === $row["password"]) {
        // Contraseña correcta, inicio de sesión exitoso
        header("Location: ../home/index.html");
    } else {
        // Contraseña incorrecta
        echo "<h2>Error: Contraseña incorrecta. Verifica tu información.</h2>";
    }
} else {
    // Usuario no encontrado
    echo "<h2>Error: Usuario no encontrado. Verifica tu información.</h2>";
}


// Cierra la conexión
$conn->close();
?>