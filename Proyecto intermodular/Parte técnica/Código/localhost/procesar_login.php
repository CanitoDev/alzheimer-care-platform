<?php
require 'db.php';
session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Usamos el email para buscar al usuario
    $email_input = trim($_POST['usuario_login']); 
    $password_input = trim($_POST['password_login']);

    // 1. Buscamos al cuidador por su EMAIL
    $sql = "SELECT * FROM cuidadores WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':email' => $email_input]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // 2. Comprobamos contraseña
    if ($usuario && password_verify($password_input, $usuario['password_hash'])) {
        
        // Guardamos datos del cuidador
        $_SESSION['user_id'] = $usuario['id'];
        $_SESSION['user_nombre'] = $usuario['nombre']; 

        // 3. BUSCAMOS EL NOMBRE DEL PACIENTE ASOCIADO
        $sql_paciente = "SELECT nombre FROM pacientes WHERE cuidador_id = :id LIMIT 1";
        $stmt_p = $pdo->prepare($sql_paciente);
        $stmt_p->execute([':id' => $usuario['id']]);
        $paciente = $stmt_p->fetch(PDO::FETCH_ASSOC);

        // Guardamos el nombre del paciente en la sesión
        if ($paciente) {
            $_SESSION['paciente_nombre'] = $paciente['nombre'];
        } else {
            $_SESSION['paciente_nombre'] = "Paciente"; // Nombre por defecto si no hay uno
        }

        header("Location: index.php");
        exit;
    } else {
        echo "<script>
            alert('❌ Error: El correo o la contraseña no son correctos.');
            window.location.href = 'registro.html';
        </script>";
        exit;
    }
}
?>