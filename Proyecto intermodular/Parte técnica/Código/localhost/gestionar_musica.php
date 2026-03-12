<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$archivo = 'musica.txt';

if (isset($_POST['guardar'])) {
    file_put_contents($archivo, $_POST['enlace_spotify']);
    $mensaje = "¡Música actualizada correctamente!";
}

$enlace_actual = file_exists($archivo) ? file_get_contents($archivo) : "";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configurar Música</title>
    <link rel="stylesheet" href="css/musica_config.css">
</head>
<body>
    <div class="caja">
        <h2 style="color: var(--verde);">Configurar Música</h2>
        
        <div class="instrucciones">
            <strong>Instrucciones:</strong> En Spotify, ve a la Playlist -> Compartir -> Insertar playlist -> Copia el código y pégalo aquí.
        </div>
        
        <form method="POST">
            <textarea name="enlace_spotify" placeholder="Pega aquí el código <iframe> de Spotify"><?php echo htmlspecialchars($enlace_actual); ?></textarea>
            <button type="submit" name="guardar" class="boton">GUARDAR PLAYLIST</button>
        </form>

        <?php if(isset($mensaje)) echo "<p style='color:green;'>$mensaje</p>"; ?>
        
        <a href="index.php" class="link-volver">Volver</a>
    </div>
</body>
</html>