<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Juego de Memoria</title>
    <link rel="stylesheet" href="css/juego.css">
</head>
<body>

    <h1>Busca las parejas</h1>

    <div class="contenedor-juego">
        <div class="tablero" id="juego"></div>
    </div>

    <div class="controles">
        <button class="boton" onclick="location.reload()">REINICIAR</button>
        <a href="index.php" class="boton" style="border-color:#666; color:#666;">SALIR</a>
    </div>

    <div id="victoria">
        <h2 style="font-size: 3rem; margin: 0;">MUY BIEN!</h2>
        <button class="boton" style="margin-top: 20px;" onclick="location.reload()">OTRA VEZ</button>
    </div>

    <script>
        const iconos = ['🍎', '🐶', '🚗', '🌕'];
        let cartas = [...iconos, ...iconos].sort(() => Math.random() - 0.5);
        let seleccionadas = [];
        let aciertos = 0;

        const contenedor = document.getElementById('juego');
        
        cartas.forEach((dibujo) => {
            const div = document.createElement('div');
            div.className = 'carta tapada';
            div.dataset.valor = dibujo;
            div.onclick = () => voltear(div);
            contenedor.appendChild(div);
        });

        function voltear(carta) {
            if (seleccionadas.length === 2 || !carta.classList.contains('tapada')) return;

            carta.classList.remove('tapada');
            carta.textContent = carta.dataset.valor;
            seleccionadas.push(carta);

            if (seleccionadas.length === 2) {
                const [c1, c2] = seleccionadas;
                if (c1.dataset.valor === c2.dataset.valor) {
                    c1.classList.add('lograda');
                    c2.classList.add('lograda');
                    aciertos++;
                    seleccionadas = [];
                    if (aciertos === iconos.length) {
                        setTimeout(() => document.getElementById('victoria').style.display = 'block', 500);
                    }
                } else {
                    setTimeout(() => {
                        c1.classList.add('tapada');
                        c2.classList.add('tapada');
                        c1.textContent = '';
                        c2.textContent = '';
                        seleccionadas = [];
                    }, 1000);
                }
            }
        }
    </script>
</body>
</html>