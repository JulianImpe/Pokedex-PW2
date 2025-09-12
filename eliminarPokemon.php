<?php
include_once "./repository/PokedexBD.php";
include_once "./repository/query_pokemon.php";

// Configuración de la conexión
$config = parse_ini_file("./config/config.ini");
/*$conexion = new PokedexBD(
    $config['server'],
    $config['username'],
    $config['password'],
    $config['database'],
    3307
);*/

// Verificamos si llega el ID por GET
if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    eliminarPokemon($conexion, $id);
}

// Cerramos conexión
//$conexion->close();

// Redirigimos al index
header("Location: /Pokedex/Pokedex-PW2/index.php");
exit;
