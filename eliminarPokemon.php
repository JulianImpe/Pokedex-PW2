<?php
include "./repository/PokedexBD.php";
include "./repository/query_pokemon.php";

eliminarPokemon($conexion, $_POST['id']);
header("Location: /pokedex/index.php");
exit;
?>
