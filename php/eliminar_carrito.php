<?php
// Coger la sesion ya iniciada anteriormente
session_start();

// Obtener la referencia del producto enviada por POST
$ref = $_POST['referencia'] ?? null;

// Si la referencia es válida y el producto está en el carrito, elimina el producto
if ($ref && isset($_SESSION['carrito'][$ref])) {
    // Eliminación del producto
    unset($_SESSION['carrito'][$ref]);
}

// Recargar de nuevo el carrito para actulizar los cambios
header("Location: carrito.php");
exit();

?>