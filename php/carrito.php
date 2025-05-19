<?php
session_start();
$carrito = $_SESSION['carrito'] ?? [];

// Verificar que haya iniciado sesión
if (!isset($_SESSION['usuario_'])) {
    header("Location: ../html/login.html?mensaje=inicio_sesion_requerido");
    exit;
}

$usuario_ = $_SESSION['usuario_'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito</title>
    <link rel="stylesheet" href="../styles/carrito.css">
    <link rel="stylesheet" href="../styles/footer-header.css">
    <link rel="stylesheet" href="../styles/update-footer.css"> <!-- Fichero css para las estructuras del html, body y main y no afectar al resto de ficheros con el header y footer-->
</head>
<body>

    
    <header>
        <nav>
            <a href="index.php">Inicio</a>
            <a href="tienda.php">Tienda</a>
            <a href="#" class="activo">Carrito</a>
            <a href="../php/cerrar_sesion.php">Cerrar Sesion</a>
        </nav>
    </header>

    <!-- Contenido del carrito -->
    <main class="carrito-container"> 
        <?php if (empty($carrito)): ?>
            <p>Tu carrito está vacío.</p>
        <?php else: ?>
            <?php foreach ($carrito as $ref => $item): ?>
                <?php
                    $numero = intval(substr($ref, 1));
                    $imagen = "../imagen_productos/producto$numero.jpg";
                ?>
                <div class="producto">
                    <img src="<?= $imagen ?>" alt="<?= htmlspecialchars($item['nombre']) ?>">
                    <div class="descripcion">
                        <p><?= htmlspecialchars($item['nombre']) ?></p>
                        <p><?= number_format($item['precio'], 2) ?> €</p>
                        <p>Cantidad: <?= number_format($item['cantidad']) ?></p>
                        <p>Subtotal: <?= number_format($item['precio'] * $item['cantidad'], 2) ?> €</p>
                        <form method="post" action="eliminar_carrito.php">
                            <input type="hidden" name="referencia" value="<?= $ref ?>">
                            <button type="submit" class="quitar">Quitar</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>

            <form method="post" action="finalizar.php" class="finalizar-form">
                <button type="submit" class="finalizar">Finalizar Compra</button>
            </form>
        <?php endif; ?>
    </main>


    
    <footer>
        <div class="footer-links">
            <a href="index.php">Inicio</a>
            <a href="tienda.php">Tienda</a>
            <a href="#" class="activo">Carrito</a>
            <a href="../html/login.html">Login</a>
            <a href="../html/signup.html">Sign Up</a>
        </div>
        <p class="copyright">© COPYRIGHT 2025</p>
    </footer>

</body>
</html>
