<?php 

// Primero, traemos todas las herramientas que necesitamos para que el juego funcione.
require_once __DIR__ . '/../models/Usuarios.php';
require_once __DIR__ . '/../models/UsuariosRepository.php';
require_once __DIR__ . '/../models/Partidas.php';
require_once __DIR__ . '/../models/PartidasRepository.php';

// Empezamos la sesión para poder recordar quién es el jugador.
session_start();

// Si la dirección web pide algo especial (como 'usuarios' o 'partidas'),
// llamamos al controlador que se encarga de eso y terminamos.
if (isset($_GET['c'])) {
    // Usamos __DIR__ para asegurar que la ruta es relativa a la carpeta de controladores
    require_once(__DIR__ . '/' . $_GET['c'] . 'Controller.php');
    // Una vez que el controlador específico ha manejado la petición, detenemos la ejecución.
    die();
}

// Si el jugador no ha iniciado sesión, le mostramos la pantalla para que entre.
if (!isset($_SESSION['user'])) {
    require_once __DIR__ . '/../views/loginView.phtml';
    die();
}

// Si no hay cartas repartidas, repartimos unas nuevas para empezar a jugar.
if (!isset($_SESSION['cartas_usuario'])) {
    $cartas = PartidasRepository::repartirCartas();
    $_SESSION['cartas_usuario'] = $cartas['usuario'];
    $_SESSION['cartas_maquina'] = $cartas['maquina'];
}

// Finalmente, mostramos la pantalla principal del juego.
require_once __DIR__ . '/../views/mainView.phtml';