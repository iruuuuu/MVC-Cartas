<?php
// Esta es la plantilla para crear un objeto "Jugador".
class User
{
    private $id;
    private $nombre_usuario;
    private $avatar;
    private $es_administrador;
    private $partidas_jugadas;
    private $partidas_ganadas;
    private $partidas_perdidas;
    private $ultimo_acceso;

    // Cuando creamos un nuevo jugador, le damos un número, un nombre y una foto.
    public function __construct($id, $nombre_usuario, $avatar)
    {
        $this->id = $id;
        $this->nombre_usuario = $nombre_usuario;
        $this->avatar = $avatar;
        $this->partidas_jugadas = 0;
        $this->partidas_ganadas = 0;
        $this->partidas_perdidas = 0;
        $this->ultimo_acceso = null;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNombreUsuario()
    {
        return $this->nombre_usuario;
    }

    public function setNombreUsuario($nombre_usuario)
    {
        $this->nombre_usuario = $nombre_usuario;
    }

    public function getAvatar()
    {
        return $this->avatar;
    }

    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }

    public function setEsAdministrador($es_administrador)
    {
        $this->es_administrador = $es_administrador;
    }

    public function getPartidasJugadas()
    {
        return $this->partidas_jugadas;
    }

    public function setPartidasJugadas($partidas_jugadas)
    {
        $this->partidas_jugadas = $partidas_jugadas;
    }

    public function getPartidasGanadas()
    {
        return $this->partidas_ganadas;
    }

    public function setPartidasGanadas($partidas_ganadas)
    {
        $this->partidas_ganadas = $partidas_ganadas;
    }

    public function getPartidasPerdidas()
    {
        return $this->partidas_perdidas;
    }

    public function setPartidasPerdidas($partidas_perdidas)
    {
        $this->partidas_perdidas = $partidas_perdidas;
    }

    public function getUltimoAcceso()
    {
        return $this->ultimo_acceso;
    }

    public function setUltimoAcceso($ultimo_acceso)
    {
        $this->ultimo_acceso = $ultimo_acceso;
    }

    /**
     * Si intentamos usar el jugador como texto, simplemente mostramos su nombre.
     */
    public function __toString()
    {
        return $this->getNombreUsuario();
    }
}
