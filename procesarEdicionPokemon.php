<?php

include_once "./repository/PokedexBD.php";
include_once "./repository/query_pokemon.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $tipo_id = $_POST['tipo_id'];

    // Manejo de la imagen
    $imagenRuta = null;
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $nombreArchivo = basename($_FILES['imagen']['name']);
        $destino = "public/img/" . $nombreArchivo;

        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $destino)) {
            $imagenRuta = $destino; // lo que vas a guardar en la DB
        }
    }

    // Si no se subió nueva imagen, mantenemos la anterior
    if (!$imagenRuta) {
        $pokemon = traerPokemonPorId($conexion, $id);
        $imagenRuta = $pokemon['imagen_ruta'];
    }

    editarPokemon($conexion, $id, $nombre, $descripcion, $tipo_id, $imagenRuta);

    header("Location: /pokedex/index.php");
    exit;
}

?>