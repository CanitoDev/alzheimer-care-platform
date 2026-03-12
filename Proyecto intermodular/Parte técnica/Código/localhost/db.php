<?php
// db.php
header('Content-Type: text/html; charset=utf-8'); 

// Configuración para Localhost
$host = 'localhost';
$dbname = 'proyecto_alzheimer'; // Asegúrate de que este sea el nombre de tu BD en PHPMyAdmin
$username = 'root';            // El usuario por defecto en XAMPP/WAMP es 'root'
$password = '';                // En XAMPP la contraseña suele estar vacía por defecto

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Configuramos el modo de error para ver qué pasa si algo falla
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Si falla la conexión, nos dirá exactamente por qué
    die("Error de conexión local: " . $e->getMessage());
}
?>