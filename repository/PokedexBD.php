<?php

class PokedexBD
{
    public $conexion;
    public function __construct($server, $username, $password, $database,$port = 3306)
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
    // Si la query devolvió un resultset (ej: SELECT)
    if ($result instanceof mysqli_result) {
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    // Para INSERT, UPDATE, DELETE simplemente devolvemos true/false
    return $result;
}

}
