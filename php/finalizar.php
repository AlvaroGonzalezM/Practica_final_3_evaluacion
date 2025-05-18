<?php
// Simulación de compra

// Coger la sesion ya iniciada anteriormente
session_start();

// Elimina todos los productos del carrito
unset($_SESSION['carrito']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Compra realizada</title>
    <link rel="stylesheet" href="../styles/footer-header.css">
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>

    <header>
        <nav>
            <a href="index.php">Inicio</a>
            <a href="tienda.php">Tienda</a>
            <a href="carrito.php">Carrito</a>
            <a href="../php/cerrar_sesion.php">Cerrar Sesion</a>
        </nav>
    </header>

    <h2>¡Gracias por tu compra!</h2>
    <p>Tu pedido ha sido procesado con éxito.</p>
    <a href="index.php">Volver a la tienda</a>

    <footer>
        <div class="footer-links">
            <a href="index.php">Inicio</a>
            <a href="tienda.php">Tienda</a>
            <a href="carrito.php">Carrito</a>
            <a href="../html/login.html">Login</a>
            <a href="../html/signup.html">Sign Up</a>
        </div>
        <p class="copyright">© COPYRIGHT 2025</p>
    </footer>

</body>
</html>
