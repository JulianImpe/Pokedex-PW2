<?php
$config = parse_ini_file('../../db.ini');
$conexion = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
if ($conexion->connect_error) {
    die("Connection failed: " . $conexion->connect_error);
}
$traerListaPokemons = "SELECT * FROM pokemon";
$result = $conexion->query($traerListaPokemons);

$conexion->close();
?>