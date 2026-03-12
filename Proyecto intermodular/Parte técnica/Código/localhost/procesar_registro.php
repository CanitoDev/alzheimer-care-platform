<?php
require 'db.php'; // Asegúrate de que en db.php usas la variable $pdo

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_cuidador = trim($_POST['nombre_cuidador']);
    $email_cuidador = trim($_POST['email_cuidador']);
    $password_segura = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $nombre_paciente = trim($_POST['nombre_paciente']);
    $fase_alzheimer = $_POST['fase_alzheimer'];

    try {
        $pdo->beginTransaction();

        $sql_c = "INSERT INTO cuidadores (nombre, email, password_hash) VALUES (:nom, :email, :pass)";
        $stmt = $pdo->prepare($sql_c);
        $stmt->execute([':nom' => $nombre_cuidador, ':email' => $email_cuidador, ':pass' => $password_segura]);

        $cuidador_id = $pdo->lastInsertId();

        $sql_p = "INSERT INTO pacientes (cuidador_id, nombre, fase_alzheimer) VALUES (:id, :nom, :fase)";
        $stmt = $pdo->prepare($sql_p);
        $stmt->execute([':id' => $cuidador_id, ':nom' => $nombre_paciente, ':fase' => $fase_alzheimer]);

        $pdo->commit();


       
        // Redirigir a una página de éxito limpia
        echo "<script>
                alert('¡Registro completado! Revisa tu correo de bienvenida.');
                window.location.href = 'index.php';
              </script>";

    } catch (Exception $e) {
        if(isset($pdo)) $pdo->rollBack();
        echo "Error en el proceso: ";
    }
}
?>