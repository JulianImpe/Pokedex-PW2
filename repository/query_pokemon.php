<?php
include_once("./repository/PokedexBD.php");
$config = parse_ini_file("./config/config.ini");

$conexion = new PokedexBD(
    $config['server'], 
    $config['username'], 
    $config['password'], 
    $config['database']) or die("Problemas con la conexion");




$traerListaPokemons = "SELECT * FROM pokemon";
$result = $conexion->query($traerListaPokemons);


$traerListaPokemonsArrays = $result;


$conexion->close();
?>