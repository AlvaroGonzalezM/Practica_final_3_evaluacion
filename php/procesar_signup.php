<?php
// Variables para la conexión
$host = "localhost";
$usuario = "root";
$contrasena = "";
$base_de_datos = "tienda_bbdd";

// Activar excepciones de MySQLi
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // Conexión a MySQL
    $conn = new mysqli($host, $usuario, $contrasena, $base_de_datos);
    $conn->set_charset("utf8");

    // Recibir datos del formulario del signup
    $usuario_input = $_POST['usuario'];
    $clave_plana = $_POST['contraseña'];
    $clave_hash = password_hash($clave_plana, PASSWORD_DEFAULT);

    // Creacion de nuevo usuario, con contraseña cifrada
    $consulta1 = $conn->prepare("INSERT INTO usuarios (usuario, contraseña) VALUES (?, ?)");
    $consulta1->bind_param("ss", $usuario_input, $clave_hash);
    $consulta1->execute();

    // Recibir los datos restantes del formulario del sigup
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $correo = $_POST['correo'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $genero = $_POST['genero'];

    // Creación de nuevo cliente
    $consulta2 = $conn->prepare("INSERT INTO clientes (nombre, apellidos, correo, fecha_nacimiento, genero) VALUES (?, ?, ?, ?, ?)");
    $consulta2->bind_param("sssss", $nombre, $apellidos, $correo, $fecha_nacimiento, $genero);
    $consulta2->execute();

    // Redirigir si sea creado correctamente
    header("Location: ../html/login.html");
    exit();

} catch (mysqli_sql_exception $e) {

    $conn->rollback();

    // Manejar error de usuario duplicado
    if ($e->getCode() == 1062) {
        header("Location: ../html/signup.html?error=usuario_existente");
        exit();

    } else {
        echo "Error inesperado: " . $e->getMessage();
    }
}

if (isset($stmt)) $stmt->close();
if (isset($conn)) $conn->close();
?>
