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

        // === ENVÍO DE CORREO ===
        require 'librerias/phpmailer/Exception.php';
        require 'librerias/phpmailer/PHPMailer.php';
        require 'librerias/phpmailer/SMTP.php';

        $mail = new PHPMailer\PHPMailer\PHPMailer(true);
        
        // Configuración
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = getenv('SMTP_USER'); // En lugar de 'equipo.estel4@gmail.com'
	$mail->Password   = getenv('SMTP_PASSWORD'); // En lugar de la clave directa
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;
        $mail->CharSet    = 'UTF-8'; // Para que se vean bien las tildes

        // Remitente y Destinatario
        $mail->setFrom('equipo.estel4@gmail.com', 'Proyecto Estel 2026');
        $mail->addAddress($email_cuidador, $nombre_cuidador);

        // Contenido
        $mail->isHTML(true);
        $mail->Subject = 'Bienvenido a Conexión y Memoria';
        $mail->Body    = "
            <div style='font-family: sans-serif; border: 2px solid #2C7A7B; padding: 20px; border-radius: 10px;'>
                <h1 style='color: #2C7A7B;'>¡Hola, $nombre_cuidador!</h1>
                <p>Te damos la bienvenida a nuestra plataforma de apoyo.</p>
                <p>Hemos registrado correctamente el perfil de <b>$nombre_paciente</b>.</p>
                <p>Ya puedes acceder para gestionar sus recuerdos y medicinas.</p>
                <hr>
                <small>Este es un mensaje automático de tu Proyecto Intermodular 2026.</small>
            </div>";

        $mail->send();

        // Redirigir a una página de éxito limpia
        echo "<script>
                alert('¡Registro completado! Revisa tu correo de bienvenida.');
                window.location.href = 'index.php';
              </script>";

    } catch (Exception $e) {
        if(isset($pdo)) $pdo->rollBack();
        echo "Error en el proceso: " . $mail->ErrorInfo;
    }
}
?>