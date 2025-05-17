<?php 
session_start();

$host = "localhost";
$usuario = "root";
$contrasena = "";
$base_de_datos = "tienda_bbdd";

$conn = new mysqli($host, $usuario, $contrasena, $base_de_datos);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$resultado = $conn->query("SELECT * FROM productos");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tienda</title>
    <link rel="stylesheet" href="../styles/footer-header.css">
    <link rel="stylesheet" href="../styles/styles.css">
    <link rel="stylesheet" href="../styles/tienda.css">
</head>
<body>

    
    <header>
        <div class="logo">LOGO</div>
        <nav>
            <a href="index.php">Inicio</a>
            <a href="#" class="activo">Tienda</a>
            <a href="carrito.php">Carrito</a>
            <a href="../html/login.html">Login</a>
            <a href="../html/signup.html">Sign Up</a>

        </nav>
    </header>

    
    <section class="bienvenida">
        <p><strong>Explora nuestra tienda</strong></p>
        <p>Todo lo que necesitas, en un solo lugar. <br>
        En esta sección encontrarás una cuidada selección de accesorios tecnológicos pensados para tí.
    </p>
        
    </section>

    
<section class="productos">
    <h2>Productos disponibles</h2>
    <div class="tienda-container">
        <?php 
        $i = 1; 
        while ($fila = $resultado->fetch_assoc()): 
            $imagen = "../imagen_productos/producto$i.jpg";
        ?>
            <div class="producto-tienda">
                <img src="<?= $imagen ?>" alt="<?= htmlspecialchars($fila['nombre']) ?>">
                <div class="descripcion-tienda">
                    <p><?= htmlspecialchars($fila['nombre']) ?></p>
                    <p class="precio"><?= number_format($fila['precio'], 2) ?> €</p>
                    <form method="post" action="agregar_carrito.php">
                        <input type="hidden" name="referencia" value="<?= $fila['referencia'] ?>">
                        <input type="hidden" name="nombre" value="<?= htmlspecialchars($fila['nombre']) ?>">
                        <input type="hidden" name="precio" value="<?= $fila['precio'] ?>">
                        <button type="submit" class="añadir">Añadir a la cesta</button>
                    </form>
                </div>
            </div>
        <?php 
        $i++;
        endwhile; 
        ?>
    </div>
</section>



    
    <footer>
        <div class="footer-links">
            <a href="index.php">Inicio</a>
            <a href="#" class="activo">Tienda</a>
            <a href="carrito.php">Carrito</a>
            <a href="../html/login.html">Login</a>
            <a href="../html/signup.html">Sign Up</a>
        </div>
        <p class="copyright">© COPYRIGHT 2025</p>
    </footer>

</body>
</html>
