<?php
session_start();
session_destroy(); // Destruye la sesión (olvida quién eres)
header("Location: index.php"); // Te devuelve a la portada como desconocido
exit;
?>