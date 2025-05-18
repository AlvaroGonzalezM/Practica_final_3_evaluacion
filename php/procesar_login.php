<?php
// Iniciamos sesión para guardar el dato del nombre del usuario
session_start();



// Variables para la conexión
$host = "localhost";
$usuario = "root";
$contrasena = "";
$base_de_datos = "tienda_bbdd";

// Conexión a MySQL
$conn = new mysqli($host, $usuario, $contrasena, $base_de_datos);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Guardar usuario en la sesión
$_SESSION['usuario_'] = $_POST['usuario'];

// Recoger datos del formulario del login
$usuario_input = $_POST['usuario'];
$clave_input = $_POST['contraseña'];

// Buscar al usuario
$stmt = $conn->prepare("SELECT contraseña FROM usuarios WHERE usuario = ?");
$stmt->bind_param("s", $usuario_input);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) {
    $fila = $resultado->fetch_assoc();
    $hash_en_bd = $fila['contraseña'];

    if (password_verify($clave_input, $hash_en_bd)) {
        header("Location: ../php/index.php");
        exit();
    } else {
        echo "Contraseña incorrecta. <a href='../html/login.html'>Volver al Inicio de Sesion</a>";
    }
} else {
    echo "Usuario no encontrado. <a href='../html/login.html'>Volver al Inicio de Sesion</a>";
}

$stmt->close();
$conn->close();
?>
