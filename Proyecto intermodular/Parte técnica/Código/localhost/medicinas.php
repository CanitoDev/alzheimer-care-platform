<?php
session_start(); // Iniciar la sesi�n

// --- CERRADURA DE SEGURIDAD ---
// Si NO existe la variable 'user_id' en la sesi�n, significa que no es un usuario real.
if (!isset($_SESSION['user_id'])) {
    // Lo mandamos a la portada
    header("Location: index.php");
    exit; // Detenemos el c�digo aqu� mismo
}
// -----------------------------
?><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Medicinas y Citas</title>
    <style>
        :root { --verde: #2C7A7B; --blanco: #FFFFFF; --fondo: #E6FFFA; }
        
        body { 
            margin: 0; background: var(--fondo); 
            height: 100vh; overflow: hidden; /* Prohibido el scroll */
            font-family: sans-serif; display: flex; flex-direction: column;
        }

        header { background: var(--verde); color: white; padding: 20px; text-align: center; flex-shrink: 0; }
        h1 { margin: 0; font-size: 2.5rem; }

        .contenedor {
            flex: 1;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px;
            overflow-y: auto; /* Si hay muchísimas, aquí sí permite bajar, pero intentamos que quepan */
        }

        .tarjeta {
            background: var(--blanco);
            border: 8px solid var(--verde);
            border-radius: 30px;
            padding: 30px;
            display: flex;
            align-items: center;
            gap: 30px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .icono { font-size: 6rem; }
        .info { display: flex; flex-direction: column; }
        .titulo { font-size: 3rem; font-weight: bold; color: #2D3748; }
        .hora { font-size: 4rem; color: var(--verde); font-weight: bold; }

        .boton-salir {
            background: #4A5568; color: white; padding: 20px;
            text-align: center; text-decoration: none; font-size: 2rem; font-weight: bold;
            flex-shrink: 0;
        }
    </style>
</head>
<body>

    <header>
        <h1>Recordatorios de hoy</h1>
    </header>

    <div class="contenedor">
        <?php
 	
        $archivo = 'recordatorios.json';
        if (file_exists($archivo)) {
            $datos = json_decode(file_get_contents($archivo), true);
            
            // Ordenar por hora
            usort($datos, fn($a, $b) => strcmp($a['hora'], $b['hora']));

            foreach ($datos as $item) {
                $icono = $item['tipo'] == 'medicina' ? '💊' : '👨‍⚕️';
                $extra = !empty($item['fecha']) ? "<div style='font-size:1.5rem;'>Fecha: {$item['fecha']}</div>" : "";
                
                echo "<div class='tarjeta'>
                        <div class='icono'>$icono</div>
                        <div class='info'>
                            <div class='hora'>{$item['hora']}</div>
                            <div class='titulo'>{$item['titulo']}</div>
                            $extra
                        </div>
                      </div>";
            }
        } else {
            echo "<h2 style='text-align:center; font-size:3rem; margin-top:50px;'>No hay tareas para hoy</h2>";
        }
        ?>
    </div>

    <a href="index.php" class="boton-salir">VOLVER</a>

</body>
</html>