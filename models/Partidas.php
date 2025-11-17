<?php

class Partidas{
    private $id;
    private $usuario_id;
    private $estado;
    private $cartas_usuario;
    private $cartas_maquina;
    private $carta_elegida_usuario;
    private $carta_elegida_maquina;
    private $fecha_jugada;


    public function __construct($id,$usuario_id,$estado,$cartas_usuario,$cartas_maquina,$carta_elegida_usuario,$carta_elegida_maquina,$fecha_jugada){
        $this->id = $id;
        $this->usuario_id = $usuario_id;
        $this->estado = $estado;
        $this->cartas_usuario = $cartas_usuario;
        $this->cartas_maquina = $cartas_maquina;
        $this->carta_elegida_usuario = $carta_elegida_usuario;
        $this->carta_elegida_maquina = $carta_elegida_maquina;
        $this->fecha_jugada = $fecha_jugada;
    }

    public function getId(){
        return $this->id;
    }   

    public function getUsuarioId(){
        return $this->usuario_id;
    }

    public function getEstado(){
        return $this->estado;
    }

    public function getCartasUsuario(){
        return $this->cartas_usuario;
    }

    public function getCartasMaquina(){
        return $this->cartas_maquina;
    }

    public function getCartaElegidaUsuario(){
        return $this->carta_elegida_usuario;
    }

    public function getCartaElegidaMaquina(){
        return $this->carta_elegida_maquina;
    }

    public function getFechaJugada(){
        return $this->fecha_jugada;
    }
}
