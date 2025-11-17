<?php 

class UsuariosRepository
{
    /**
     * Esto guarda la foto nueva de un jugador en la base de datos.
     */
    public static function actualizarAvatar($avatar, $user)
    {
        $db = Connection::connect();
        $q = "UPDATE usuarios SET avatar = '" . $avatar . "' WHERE id = " . $user->getId();
        $db->query($q);
        return $db->affected_rows;
    }

    /**
     * Esto crea un nuevo jugador en la base de datos con su nombre y contraseña.
     */
    public static function registrar($user, $contrasena)
    {
        $db = Connection::connect();
        $q = "INSERT INTO usuarios (nombre_usuario, contrasena) VALUES ('" . $user->getNombreUsuario() . "', md5('" . $contrasena . "'))";
        $db->query($q);
        return $db->insert_id;
    }

    /**
     * Esto busca a un jugador en la base de datos usando su número de identificación.
     */
    public static function obtenerPorId($id)
    {
        $db = Connection::connect();
        $q = "SELECT * FROM usuarios WHERE id=" . $id;
        $result = $db->query($q);

        if ($row = $result->fetch_assoc()) {
            return new User($row['id'], $row['nombre_usuario'], $row['avatar']);
        }
        return null;
    }

    /**
     * Esto comprueba si el nombre y la contraseña que nos dan son correctos.
     */
    public static function iniciarSesion($nombre_usuario, $contrasena)
    {
        $db = Connection::connect();
        $contrasena_md5 = md5($contrasena);
        $q = "SELECT * FROM usuarios WHERE nombre_usuario = '" . $nombre_usuario . "' AND contrasena = '" . $contrasena_md5 . "'";
        $result = $db->query($q);
        
        if ($userRow = $result->fetch_assoc()) {
            return new User($userRow['id'], $userRow['nombre_usuario'], $userRow['avatar']);
        }

        return null;
    }

    /**
     * Esto guarda en la base de datos cuántas partidas ha jugado, ganado y perdido un jugador.
     */
    public static function actualizarEstadisticas($user)
    {
        $db = Connection::connect();
        $q = "UPDATE usuarios SET " .
             "partidas_jugadas = " . $user->getPartidasJugadas() . ", " .
             "partidas_ganadas = " . $user->getPartidasGanadas() . ", " .
             "partidas_perdidas = " . $user->getPartidasPerdidas() . " " .
             "WHERE id = " . $user->getId();
        $db->query($q);
        return $db->affected_rows;
    }

    /**
     * Esto apunta en la base de datos la última vez que un jugador entró al juego.
     */
    public static function actualizarUltimoAcceso($userId)
    {
        $db = Connection::connect();
        $q = "UPDATE usuarios SET ultimo_acceso = NOW() WHERE id = " . $userId;
        $db->query($q);
        return $db->affected_rows;
    }
}