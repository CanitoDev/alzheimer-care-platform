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

$archivo = 'recordatorios.json';

// LÓGICA PARA GUARDAR
if (isset($_POST['guardar'])) {
    $datos_actuales = file_exists($archivo) ? json_decode(file_get_contents($archivo), true) : [];
    
    $nuevo = [
        'id' => time(),
        'tipo' => $_POST['tipo'], // 'medicina' o 'medico'
        'titulo' => $_POST['titulo'],
        'hora' => $_POST['hora'],
        'fecha' => $_POST['fecha'] // Solo para citas médicas
    ];

    $datos_actuales[] = $nuevo;
    file_put_contents($archivo, json_encode($datos_actuales));
    header("Location: gestionar_recordatorios.php");
}

// LÓGICA PARA BORRAR
if (isset($_GET['borrar'])) {
    $datos = json_decode(file_get_contents($archivo), true);
    $datos = array_filter($datos, fn($item) => $item['id'] != $_GET['borrar']);
    file_put_contents($archivo, json_encode(array_values($datos)));
    header("Location: gestionar_recordatorios.php");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestionar Recordatorios</title>
    <style>
        :root { --primario: #2C7A7B; --fondo: #F7FAFC; }
        body { font-family: sans-serif; background: var(--fondo); padding: 20px; display: flex; flex-direction: column; align-items: center; }
        .formulario { background: white; padding: 25px; border-radius: 15px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); width: 100%; max-width: 450px; }
        input, select, button { width: 100%; padding: 12px; margin: 10px 0; border-radius: 8px; border: 1px solid #ccc; box-sizing: border-box; }
        button { background: var(--primario); color: white; border: none; font-weight: bold; cursor: pointer; }
        .lista { width: 100%; max-width: 450px; margin-top: 20px; }
        .item { background: white; padding: 15px; margin-bottom: 10px; border-radius: 10px; display: flex; justify-content: space-between; align-items: center; border-left: 5px solid var(--primario); }
        .rojo { color: #E53E3E; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>

<div class="formulario">
    <h2>Añadir Recordatorio</h2>
    <form method="POST">
        <select name="tipo" required>
            <option value="medicina">💊 Pastilla / Medicina</option>
            <option value="medico">👨‍⚕️ Cita con el Médico</option>
        </select>
        <input type="text" name="titulo" placeholder="Nombre (Ej: Ibuprofeno o Dr. García)" required>
        <input type="time" name="hora" required>
        <label style="font-size: 0.8rem; color: #666;">Fecha (solo si es cita médica):</label>
        <input type="date" name="fecha">
        <button type="submit" name="guardar">GUARDAR</button>
    </form>
</div>

<div class="lista">
    <h3>Pendientes:</h3>
    <?php
    if (file_exists($archivo)) {
        $datos = json_decode(file_get_contents($archivo), true);
        foreach ($datos as $item) {
            $icono = $item['tipo'] == 'medicina' ? '💊' : '📅';
            $fecha_cita = !empty($item['fecha']) ? " - " . $item['fecha'] : "";
            echo "<div class='item'>
                    <div><strong>$icono {$item['titulo']}</strong><br><small>{$item['hora']} $fecha_cita</small></div>
                    <a href='?borrar={$item['id']}' class='rojo'>Borrar</a>
                  </div>";
        }
    }
    ?>
    <a href="index.php" style="display:block; text-align:center; margin-top:20px;">← Volver</a>
</div>

</body>
</html>