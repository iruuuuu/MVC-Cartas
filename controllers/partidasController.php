<?php

// Primero, miramos si el jugador ha iniciado sesión. Si no, no puede jugar.
if (!isset($_SESSION['user'])) {
    header('Location: /cartas/index.php');
    die();
}

// Si el jugador pulsa "Nueva Partida", borramos las cartas viejas y empezamos de cero.
if (isset($_GET['action']) && $_GET['action'] == 'newgame') {
    unset($_SESSION['cartas_usuario']);
    unset($_SESSION['cartas_maquina']);
    unset($_SESSION['ultima_jugada']);
    
    header('Location: /cartas/index.php');
    die();
}

// Si el jugador no ha elegido ninguna carta, no podemos hacer nada.
if (!isset($_GET['carta'])) {
    header('Location: /cartas/index.php');
    die();
}

// Aquí empieza la acción: cogemos la carta que ha jugado el usuario.
$cartaUsuario = $_GET['carta'];
$cartasUsuario = $_SESSION['cartas_usuario'];
$cartasMaquina = $_SESSION['cartas_maquina'];

// Nos aseguramos de que el jugador no haga trampas y juegue una carta que de verdad tiene.
if (in_array($cartaUsuario, $cartasUsuario)) {
    // La máquina, que es muy lista, elige su carta más fuerte.
    $cartaMaquina = PartidasRepository::eleccionMaquina($cartasMaquina);

    // Comparamos las dos cartas para ver quién gana.
    $resultado = PartidasRepository::comparar($cartaUsuario, $cartaMaquina);

    // Guardamos lo que ha pasado para poder enseñárselo al jugador.
    $_SESSION['ultima_jugada'] = [
        'carta_usuario' => $cartaUsuario,
        'carta_maquina' => $cartaMaquina,
        'resultado' => $resultado
    ];

    // Apuntamos si el jugador ha ganado, perdido o empatado.
    $user = $_SESSION['user'];
    $user->setPartidasJugadas($user->getPartidasJugadas() + 1);

    if ($resultado == 'GANADA') {
        $user->setPartidasGanadas($user->getPartidasGanadas() + 1);
    } elseif ($resultado == 'PERDIDA') {
        $user->setPartidasPerdidas($user->getPartidasPerdidas() + 1);
    }

    // Guardamos los resultados en la base de datos para que no se olviden.
    UsuariosRepository::actualizarEstadisticas($user);
}

// Después de la jugada, volvemos a la pantalla principal para ver qué ha pasado.
header('Location: /cartas/index.php');
die();