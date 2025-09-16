<?php
$id = $_GET['id'];
include "./repository/PokedexBD.php";
include "./repository/query_pokemon.php";
    eliminarPokemon($conexion, $id);
    header("Location: /Pokedex/Pokedex-PW2/index.php");
    exit();


//Importante para no ir a eliminarPokemon.php?id=1 y quedarse ahi, 
//sino que redirige a index.php

?>