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
    <title>Mis Recuerdos</title>
    <link rel="stylesheet" href="css/recuerdos.css">
</head>
<body>

    <div class="visor" id="galeria">
        <?php
        $directorio = "fotos/";
        // Buscamos archivos de imagen
        $fotos = glob($directorio . "*.{jpg,jpeg,png,gif,webp}", GLOB_BRACE);

        if (count($fotos) > 0) {
            foreach ($fotos as $indice => $foto) {
                // La primera foto tiene la clase 'activa' por defecto
                $clase = ($indice === 0) ? 'foto activa' : 'foto';
                echo '<img src="' . $foto . '" class="' . $clase . '" alt="Recuerdo">';
            }
        } else {
            echo '<h2 style="color: white; text-align: center;">Todavía no hay fotos guardadas.</h2>';
        }
        ?>
    </div>

    <a href="index.php" class="boton-salir">SALIR</a>

    <script>
        const fotos = document.querySelectorAll('.foto');
        let indiceActual = 0;

        function cambiarFoto() {
            if (fotos.length <= 1) return;

            // Quitamos la visibilidad a la foto actual
            fotos[indiceActual].classList.remove('activa');

            // Pasamos a la siguiente (vuelve al inicio si llega al final)
            indiceActual = (indiceActual + 1) % fotos.length;

            // Mostramos la nueva
            fotos[indiceActual].classList.add('activa');
        }

        // Cambia de foto cada 5 segundos
        setInterval(cambiarFoto, 5000);
    </script>

</body>
</html>