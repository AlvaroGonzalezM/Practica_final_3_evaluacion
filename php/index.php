<?php 
session_start();

// Recojer de la sesión el nombre del usuario
$usuario_ = $_SESSION['usuario'] ?? null;

if (!isset($_SESSION['usuario_'])) {
            header("Location: ../html/login.html");
            exit;
        }

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
            <a href="#" class="activo">Inicio</a>
            <a href="tienda.php">Tienda</a>
            <a href="carrito.php">Carrito</a>
            <a href="../php/cerrar_sesion.php">Cerrar Sesion</a>
        </nav>
    </header>

    
    <section class="bienvenida">
        <div class="overlay">
            <p>Bienvenido <strong><?= htmlspecialchars($usuario_) ?> </strong> a la <br> Tienda Virtual de Tecnología</p>
            <p>¡Donde la tecnología se encuentra con el estilo!</p>
            <p>Descubre nuestra amplia selección de accesorios tecnológicos diseñados para hacer tu vida más fácil, conectada y con mucho más estilo. <br> 
            Calidad, innovación y buenos precios, todo en un solo lugar. <br>
            Explora, elige y lleva tu experiencia digital al siguiente nivel
            </p>
        </div>
    </section>


    
    
            
            
            
    <section class="productos">
    <h2>Primeros 5 Productos disponibles</h2>
    <div class="tienda-container">
        <?php 
        $i = 1;
        while (($fila = $resultado->fetch_assoc()) && $i <= 5): 
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



            

        

    <section>
        <p>Produtos seleccionados, envío rápido y atención personalizada. <br>
        Conéctate con lo mejor de la tecnología.
    </p>
    </section>

    <button><a href="tienda.php" style="text-decoration: none; color: black;">Toda la tienda</a></button>

</section>

    
    <footer>
        <div class="footer-links">
            <a href="#" class="activo">Inicio</a>
            <a href="tienda.php">Tienda</a>
            <a href="carrito.php">Carrito</a>
            <a href="../html/login.html">Login</a>
            <a href="../html/signup.html">Sign Up</a>
        </div>
        <p class="copyright">© COPYRIGHT 2025</p>
    </footer>

</body>
</html>
