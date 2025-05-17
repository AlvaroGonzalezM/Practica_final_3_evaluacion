<?php
// Coger la sesion ya iniciada anteriormente
session_start();

// Recoger datos del formulario de la tienda
$ref = $_POST['referencia'];
$nombre = $_POST['nombre'];
$precio = $_POST['precio'];

// Crear el carrito si no existe
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Si ya existe el producto en el carrito, aumentar cantidad
if (isset($_SESSION['carrito'][$ref])) {
    $_SESSION['carrito'][$ref]['cantidad'] += 1;
} else {
    $_SESSION['carrito'][$ref] = [
        'nombre' => $nombre,
        'precio' => $precio,
        'cantidad' => 1
    ];
}

// Volver a la tienda
header("Location: tienda.php");
exit();

?>