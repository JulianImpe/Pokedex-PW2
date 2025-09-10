<?php

class PokedexBD
{
    public $conexion;
    public function __construct($server, $username, $password, $database,$port = 3307)
    {
        $this->conexion = new mysqli($server, $username, $password, $database,$port);
    }

    public function close()
    {
        $this->conexion->close();
    }
    public function query($string)
    {
        $result = $this->conexion->query($string);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

}
