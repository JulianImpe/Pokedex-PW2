<?php

$config = parse_ini_file("./config/config.ini");

$conexion = new PokedexBD(
    $config['server'],
    $config['username'],
    $config['password'],
    $config['database'],
    3307
) or die("Problemas con la conexion");




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

$conexion->close();
