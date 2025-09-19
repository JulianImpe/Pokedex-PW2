<?php
include "./repository/PokedexBD.php";
include "./repository/query_pokemon.php";
//include "header".php
echo "<link rel='stylesheet' href='styles/detallePokemon.css'>";
echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
echo "<body>";
$id = $_GET['id'];

echo "<div class='detalle-container'>";
$pokemon = traerPokemonPorId($conexion, $id);
echo "<div class='pokemon-card-detalle' id='pokemon-{$pokemon["numero_identificador"]}'>";
echo "<div class='pokemon-name-detalle'>{$pokemon["nombre"]}</div>";
echo "<img class='pokemon-image-detalle' src='{$pokemon["imagen_ruta"]}' alt='{$pokemon["nombre"]}'>";
echo "<div class='pokemon-type-detalle'>";
echo "<img class='type-icon-detalle' src='{$pokemon["imagen_ruta_tipo"]}' alt='Type Icon'>";
echo "</div>";
echo "<div class='pokemon-description-detalle'>{$pokemon["descripcion"]}</div>";
echo "</div>";
echo "<a href='/Pokedex/Pokedex-PW2/index.php' class='boton-volver'> << Volver</a>";
echo "</body>";
?>

