<?php
// db.php
header('Content-Type: text/html; charset=utf-8'); // Soluciona los rombos raros 

// Usamos $_SERVER que es más fiable en Apache
$host = $_SERVER['DB_HOST'] ?? 'localhost';
$dbname = $_SERVER['DB_NAME'] ?? 'proyecto_alzheimer';
$username = $_SERVER['DB_USER'] ?? 'cuidador_admin';
$password = $_SERVER['DB_PASSWORD'];

if (empty($password)) {
    die("Error crítico: La variable de entorno DB_PASSWORD no se ha cargado.");
}

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // MODO DEBUG (Solo para arreglarlo ahora). 
    // Cuando funcione, borra la línea de abajo y descomenta la del "error_log"
    die("Error detallado MySQL: " . $e->getMessage());
    
    // error_log($e->getMessage());
    // die("¡Error de conexión! Por favor inténtelo más tarde.");
}
?>