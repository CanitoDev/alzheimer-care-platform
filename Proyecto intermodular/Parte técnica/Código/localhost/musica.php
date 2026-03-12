<?php
session_start();

// --- CERRADURA DE SEGURIDAD ---
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Música</title>
    <link rel="stylesheet" href="css/musica.css">
</head>
<body>
    <header>
        <h1>Mi Musica</h1>
    </header>

    <div class="reproductor">
        <?php
        $archivo = 'musica.txt';
        if (file_exists($archivo) && filesize($archivo) > 0) {
            echo file_get_contents($archivo);
        } else {
            echo "<h2>Todavía no hay música puesta.</h2>";
        }
        ?>
    </div>

    <a href="index.php" class="boton-volver">VOLVER</a>
</body>
</html>