<?php
session_start();         // Inicia la sesión
session_unset();         // Elimina todas las variables de sesión
session_destroy();       // Destruye la sesión

// Redirigir al usuario al login u otra página
header("Location: ../html/login.html?mensaje=sesion_cerrada");
exit();
