<?php

$config = parse_ini_file(__DIR__ . "/../config/config.ini");

$conexion= new PokedexBD(
    $config['server'],
    $config['username'],
    $config['password'],
    $config['database'],
    3307
) or die("Problemas con la conexion");


function traerPokemonPorId($conexion, $id)
{
    $sql = "SELECT pokemon.id AS 'id', 
            pokemon.nombre AS 'nombre', 
            pokemon.descripcion AS 'descripcion', 
            pokemon.numero_identificador AS 'numero_identificador',
            tipos.nombre AS 'tipo',
            pokemon.imagen_ruta as 'imagen_ruta',
            tipos.imagen_ruta_tipo as 'imagen_ruta_tipo'
            FROM pokemon 
            JOIN tipos ON pokemon.tipo_id = tipos.id
            WHERE pokemon.id = $id";

    $result = $conexion->query($sql);

    return $result[0] ?? null;
    $conexion->close();
}

function traerTodosLosPokemons($conexion) {
    $sql = "
        SELECT
            pokemon.numero_identificador,
            pokemon.nombre,
            pokemon.descripcion,
            pokemon.imagen_ruta,
            tipos.imagen_ruta_tipo
        FROM pokemon
        JOIN tipos ON pokemon.tipo_id = tipos.id
        ORDER BY pokemon.numero_identificador
    ";
    return $conexion->query($sql);
}

function buscarPokemonPorNombreONumero($conexion, $busqueda) {

    $mysqli = $conexion->conexion;
    $busqueda_esc = $mysqli->real_escape_string(trim($busqueda));

    if ($busqueda_esc === '') {
        return [];
    }

    if (is_numeric($busqueda_esc)) {

        $sql = "
            SELECT
                pokemon.numero_identificador,
                pokemon.nombre,
                pokemon.descripcion,
                pokemon.imagen_ruta,
                tipos.imagen_ruta_tipo
            FROM pokemon
            JOIN tipos ON pokemon.tipo_id = tipos.id
            WHERE pokemon.numero_identificador = '$busqueda_esc'
        ";
    } else {

        $sql = "
            SELECT
                pokemon.numero_identificador,
                pokemon.nombre,
                pokemon.descripcion,
                pokemon.imagen_ruta,
                tipos.imagen_ruta_tipo
            FROM pokemon
            JOIN tipos ON pokemon.tipo_id = tipos.id
            WHERE pokemon.nombre LIKE '%$busqueda_esc%'
        ";
    }

    return $conexion->query($sql);
}

function agregarPokemon($conexion, $nombre, $descripcion, $numero_identificador, $tipo_id, $imagen_ruta)
{
    $sql = "INSERT INTO pokemon (nombre, descripcion, numero_identificador, tipo_id, imagen_ruta) 
            VALUES ('$nombre', '$descripcion', '$numero_identificador', '$tipo_id', '$imagen_ruta')";
    $conexion->query($sql);
    $conexion->close();
}
function eliminarPokemon($conexion, $id)
{
    $sql = "DELETE FROM pokemon WHERE id = $id";
    $conexion->query($sql);
    $conexion->close();
}
function editarPokemon($conexion, $id, $nombre, $descripcion, $tipo_id, $imagen_ruta)
{
    $sql = "UPDATE pokemon 
            SET nombre = '$nombre', descripcion = '$descripcion', tipo_id = '$tipo_id', imagen_ruta = '$imagen_ruta' 
            WHERE id = $id";
    $conexion->query($sql);
    $conexion->close();
}
function traerTipos($conexion) {
    $sql = "SELECT id, nombre FROM tipos ORDER BY id";
    return $conexion->query($sql);
}