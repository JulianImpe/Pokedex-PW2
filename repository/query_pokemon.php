<?php
include_once("./repository/PokedexBD.php");
$config = parse_ini_file("./config/config.ini");

$conexion = new PokedexBD(
    $config['server'],
    $config['username'],
    $config['password'],
    $config['database']
) or die("Problemas con la conexion");




$traerListaPokemons = "SELECT pokemon.id AS 'numero_identificador', 
pokemon.nombre AS 'nombre', 
pokemon.descripcion AS 'descripcion', 
pokemon.numero_identificador AS 'numero_identificador',
tipos.nombre AS 'tipo',
pokemon.imagen_ruta as 'imagen_ruta',
tipos.imagen_ruta_tipo as 'imagen_ruta_tipo'
FROM pokemon 
JOIN tipos ON pokemon.tipo_id = tipos.id";
$result = $conexion->query($traerListaPokemons);


$traerListaPokemonsArrays = $result;


$conexion->close();
