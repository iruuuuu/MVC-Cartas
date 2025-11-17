<?php

class PartidasRepository
{
    /**
     * Esto crea una baraja de cartas españolas, con oros, copas, espadas y bastos.
     */
    public static function obtenerBarajaCompleta()
    {
        $palos = ['O', 'C', 'E', 'B']; // Oros, Copas, Espadas, Bastos
        $numeros = [1, 2, 3, 4, 5, 6, 7, 10, 11, 12];
        $baraja = [];

        foreach ($palos as $palo) {
            foreach ($numeros as $numero) {
                $baraja[] = $palo . $numero;
            }
        }

        return $baraja;
    }

    /**
     * Esto mezcla la baraja y le da 3 cartas al jugador y 3 a la máquina.
     */
    public static function repartirCartas()
    {
        $baraja = self::obtenerBarajaCompleta();
        
        // Baraja las cartas aleatoriamente
        shuffle($baraja);

        // Selecciona las primeras 6 cartas
        $cartasRepartidas = array_slice($baraja, 0, 6);

        // Asigna 3 al usuario y 3 a la máquina
        return [
            'usuario' => array_slice($cartasRepartidas, 0, 3),
            'maquina' => array_slice($cartasRepartidas, 3, 3)
        ];
    }

    /**
     * Esto hace que la máquina piense y elija la carta más alta que tiene.
     */
    public static function eleccionMaquina($cartasMaquina)
    {
        $cartaMasAlta = null;
        $valorMasAlto = 0;

        foreach ($cartasMaquina as $carta) {
            $valorActual = self::obtenerValor($carta);
            if ($valorActual > $valorMasAlto) {
                $valorMasAlto = $valorActual;
                $cartaMasAlta = $carta;
            }
        }

        return $cartaMasAlta;
    }

    /**
     * Esto mira una carta y nos dice qué número tiene. Por ejemplo, 'E12' vale 12.
     */
    public static function obtenerValor($carta)
    {
        return (int) substr($carta, 1);
    }

    /**
     * Esto compara la carta del jugador y la de la máquina para ver quién tiene el número más alto.
     */
    public static function comparar($cartaUsuario, $cartaMaquina)
    {
        $valorUsuario = self::obtenerValor($cartaUsuario);
        $valorMaquina = self::obtenerValor($cartaMaquina);

        if ($valorUsuario > $valorMaquina) {
            return 'GANADA';
        } elseif ($valorUsuario < $valorMaquina) {
            return 'PERDIDA';
        } else {
            return 'EMPATE';
        }
    }
}

?>