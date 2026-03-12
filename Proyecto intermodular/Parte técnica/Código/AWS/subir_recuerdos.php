<?php 
session_start(); 
// Es recomendable añadir aquí también la cerradura de seguridad si solo el cuidador debe subir fotos
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
    <title>Subir Recuerdos</title>
    <link rel="stylesheet" href="css/subir_recuerdos.css">
</head>
<body>

<div class="caja">
    <h2>Subir Nueva Foto</h2>
    <p>Selecciona una foto para que el paciente pueda verla.</p>

    <form action="" method="POST" enctype="multipart/form-data">
        <input type="file" name="imagen" accept="image/*" required>
        <button type="submit" name="subir" class="boton">GUARDAR FOTO</button>
    </form>

    <?php
    if (isset($_POST['subir'])) {
        $directorio = "fotos/";
        
        if (!is_dir($directorio)) {
            mkdir($directorio, 0755, true);
        }

        // Limpieza básica del nombre del archivo y prefijo de tiempo
        $nombre_archivo = time() . "_" . basename($_FILES["imagen"]["name"]);
        $ruta_final = $directorio . $nombre_archivo;

        // Validación básica de que es una imagen real
        $check = getimagesize($_FILES["imagen"]["tmp_name"]);
        if($check !== false) {
            if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta_final)) {
                echo "<p class='mensaje-exito'>¡Foto subida con éxito!</p>";
            } else {
                echo "<p class='mensaje-error'>Error al mover el archivo al servidor.</p>";
            }
        } else {
            echo "<p class='mensaje-error'>El archivo no es una imagen válida.</p>";
        }
    }
    ?>

    <a href="index.php" class="boton-volver">← Volver al inicio</a>
</div>

</body>
</html>