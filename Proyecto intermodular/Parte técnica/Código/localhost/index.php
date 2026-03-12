<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conexión y Memoria - Panel de Control</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>

<div id="vista-inicio">
    <section class="portada centrar-todo">
        <?php if(isset($_SESSION['user_nombre'])): ?>
            <h1 style="color:white; font-size: 3.5rem;">Hola, <?= htmlspecialchars($_SESSION['user_nombre']); ?></h1>
            <div style="display:flex; gap:20px; flex-wrap: wrap; justify-content: center; margin-top: 30px;">
                <button class="boton boton-primario boton-gigante" onclick="cambiarVista('vista-paciente')">
                    MODO PACIENTE
                </button>
                <button class="boton boton-cuidador boton-gigante" onclick="cambiarVista('vista-cuidador')">
                    PANEL CUIDADOR
                </button>
            </div>
            <a href="logout.php" class="boton boton-peligro" style="margin-top: 30px;">Cerrar Sesión</a>
        <?php else: ?>
            <h1 style="font-size: 4rem; color:white; text-shadow: 2px 2px 10px rgba(0,0,0,0.5);">Conexión y Memoria</h1>
            <p style="font-size: 1.5rem; color:white; margin-bottom: 40px;">Apoyo integral para familias con Alzheimer.</p>
            <div style="display:flex; gap:25px; justify-content: center;">
                <button class="boton boton-primario boton-gigante" onclick="alert('Por favor, inicia sesión primero como cuidador')">Modo Paciente</button>
                <a href="registro.html" class="boton boton-secundario boton-gigante">Soy Cuidador (Registro)</a>
            </div>
        <?php endif; ?>
    </section>

    <section class="caracteristicas">
        <div class="rejilla-imagenes">
            <div class="tarjeta-img centrar-todo">
                <img src="https://images.unsplash.com/photo-1576765608535-5f04d1e3f289?q=80&w=1920&auto=format&fit=crop">
                <h3>Acompañamiento</h3>
            </div>
            <div class="tarjeta-img centrar-todo">
                <img src="https://images.unsplash.com/photo-1559757175-5700dde675bc?q=80&w=600">
                <h3>Estimulación</h3>
            </div>
            <div class="tarjeta-img centrar-todo">
                <img src="https://images.unsplash.com/photo-1573497620053-ea5300f94f21?q=80&w=600">
                <h3>Seguridad</h3>
            </div>
        </div>
    </section>
</div>

<div id="vista-cuidador" class="contenedor-panel centrar-todo" style="background: #edf2f7;">
    <h1 style="color: var(--color-cuidador); margin-bottom: 5px;">Panel de Gestión</h1>
    <div class="rejilla-botones">
        <div class="tarjeta-accion centrar-todo" onclick="location.href='gestionar_recordatorios.php'" style="border-color: var(--color-cuidador);">
            <span class="material-icons-round" style="font-size: 4rem; color: var(--color-cuidador);">edit_calendar</span>
            Gestionar Citas y Medicinas
        </div>
        <div class="tarjeta-accion centrar-todo" onclick="location.href='subir_recuerdos.php'" style="border-color: var(--color-cuidador);">
            <span class="material-icons-round" style="font-size: 4rem; color: var(--color-cuidador);">cloud_upload</span>
            Subir Nuevas Fotos
        </div>
        <div class="tarjeta-accion centrar-todo" onclick="location.href='gestionar_musica.php'" style="border-color: var(--color-cuidador);">
            <span class="material-icons-round" style="font-size: 4rem; color: var(--color-cuidador);">library_music</span>
            Configurar Música
        </div>
    </div>
    <button class="boton boton-secundario" style="margin-top: 40px;" onclick="location.reload()">Volver</button>
</div>

<div id="vista-paciente" class="contenedor-panel centrar-todo" style="background: var(--color-fondo-suave);">
    <h1 style="font-size: 3rem; margin-bottom: 30px;">Hola, <?= htmlspecialchars($_SESSION['paciente_nombre'] ?? 'Paciente'); ?></h1>
    <p id="fecha-actual" style="font-size: 1.5rem; margin-bottom: 30px;"></p>
    <div class="rejilla-botones">
        <div class="tarjeta-accion centrar-todo" onclick="location.href='juego.php'">
            <span class="material-icons-round" style="font-size: 5rem; color: var(--color-principal);">psychology</span>
            JUGAR
        </div>
        <div class="tarjeta-accion centrar-todo" onclick="location.href='medicinas.php'">
            <span class="material-icons-round" style="font-size: 5rem; color: var(--color-principal);">medication</span>
            MEDICINAS
        </div>
        <div class="tarjeta-accion centrar-todo" onclick="location.href='recuerdos.php'">
            <span class="material-icons-round" style="font-size: 5rem; color: var(--color-principal);">photo_library</span>
            FOTOS
        </div>
        <div class="tarjeta-accion centrar-todo" onclick="location.href='musica.php'">
            <span class="material-icons-round" style="font-size: 5rem; color: var(--color-principal);">music_note</span>
            MUSICA
        </div>
        <div class="tarjeta-accion ayuda-emergencia centrar-todo" onclick="location.href='tel:112'">
            <span class="material-icons-round" style="font-size: 5rem;">phone_in_talk</span>
            AYUDA
        </div>
    </div>
    <button class="boton boton-secundario" style="margin-top: 40px;" onclick="location.reload()">SALIR</button>
</div>

<footer>
    <p>&copy; 2025 Proyecto Conexion y Memoria</p>
    <p style="font-size: 0.9rem; margin-top: 10px;">
        <a href="politica.php" style="color: #A0AEC0; text-decoration: none;">Politica de Privacidad</a> | 
        <a href="#" style="color: #A0AEC0; text-decoration: none;">Aviso Legal</a>
    </p>
</footer>

<script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>

<df-messenger
  intent="WELCOME"
  chat-title="Estelita"
  agent-id="735ca373-035a-442c-885f-f533154cc392" 
  language-code="es"
></df-messenger>

<script>
    window.addEventListener('dfMessengerLoaded', function (event) {
        const dfMessenger = document.querySelector('df-messenger');
        dfMessenger.addEventListener('df-response-received', function (event) {
            if (event.detail.response.queryResult) {
                const loQueDijoElUsuario = event.detail.response.queryResult.queryText.toLowerCase();
                const intentName = event.detail.response.queryResult.intent.displayName.toLowerCase();
                const textoTotal = loQueDijoElUsuario + " " + intentName;

                if (textoTotal.includes('música') || textoTotal.includes('musica') || textoTotal.includes('cancion')) {
                    window.location.href = 'musica.php';
                } 
                else if (textoTotal.includes('foto') || textoTotal.includes('recuerdo') || textoTotal.includes('álbum')) {
                    window.location.href = 'recuerdos.php';
                }
                else if (textoTotal.includes('jugar') || textoTotal.includes('juego') || textoTotal.includes('memoria')) {
                    window.location.href = 'juego.php';
                }
                else if (textoTotal.includes('medicina') || textoTotal.includes('pastilla') || textoTotal.includes('cita')) {
                    window.location.href = 'medicinas.php';
                }
                else if (textoTotal.includes('paciente') || textoTotal.includes('modo')) {
                    if (typeof cambiarVista === "function") {
                        cambiarVista('vista-paciente');
                    }
                }
            }
        });
    });

    function alternarChat() {
        const ventana = document.getElementById('ventana-chat-estelita');
        const icono = document.getElementById('icono-bot');
        if (ventana.style.display === 'none' || ventana.style.display === '') {
            ventana.style.display = 'block';
            icono.textContent = 'close';
        } else {
            ventana.style.display = 'none';
            icono.textContent = 'smart_toy';
        }
    }

    function cambiarVista(idVista) {
        document.getElementById('vista-inicio').style.display = 'none';
        document.getElementById('vista-cuidador').style.display = 'none';
        document.getElementById('vista-paciente').style.display = 'none';
        document.getElementById(idVista).style.display = 'flex';
        if(idVista === 'vista-paciente') {
            const opciones = { weekday: 'long', day: 'numeric', month: 'long' };
            document.getElementById('fecha-actual').textContent = "Hoy es " + new Date().toLocaleDateString('es-ES', opciones);
        }
        window.scrollTo(0, 0);
    }
</script>
</body>
</html>