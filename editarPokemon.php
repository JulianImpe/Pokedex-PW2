<?php
include "./repository/PokedexBD.php";
include "./repository/query_pokemon.php";
//include "header".php
echo "<link rel='stylesheet' href='styles/editarPokemon.css'>";
echo "<body>";
$id = $_GET['id'];
$tipos = traerTipos($conexion);

echo "<div class='detalle-container'>";
$pokemon = traerPokemonPorId($conexion, $id);
echo "<form class='detalle-formulario' method='POST' action='procesarEdicionPokemon.php' enctype='multipart/form-data'>";
echo "<input type='hidden' name='id' value='{$pokemon["id"]}'>";

//editar nombre pokemon

echo "<div class='editar-nombre'>";
echo "<label for='nombre'>Nombre del Pokémon:</label>";
echo "<input type='text' id='nombre' name='nombre' value='{$pokemon["nombre"]}' required>";
echo "</div>";

    //cambiar imagen pokemon
echo "<img class='pokemon-image-detalle' src='{$pokemon["imagen_ruta"]}' alt='{$pokemon["nombre"]}'>";
echo "<div class='editar-imagen'>";
echo "<label for='imagen'>Imagen del Pokémon:</label>";
echo "<input id= 'input-img' type='file' id='imagen' name='imagen' accept='image/*'>";
echo "</div>";

// cambiar tipo pokemon
echo "<div class='pokemon-type-detalle'>";
echo "<img class='type-icon-detalle' src='{$pokemon["imagen_ruta_tipo"]}' alt='Type Icon'>";
echo "</div>";
echo "<div class='editar-tipo'>";
echo "<label for='tipo_id'>Tipo:</label>";
echo "<select id='tipo_id' name='tipo_id' required>";
echo "<option value=''>-- Cambiá el tipo --</option>";


foreach ($tipos as $tipo) {
    $selected = ($tipo['id'] == $pokemon['tipo_id']) ? 'selected' : '';
    echo "<option value='" . $tipo['id'] . "' $selected>" . $tipo['id'] . " - " . $tipo['nombre'] . "</option>";
}
echo "</select>";


echo "</div>";
echo "<div class='editar-descripcion'>";
echo "<label for='descripcion'> Ingresá la nueva descripción </label>";
echo "<textarea class=' pokemon-description-detalle' id='descripcion' name='descripcion' rows='4' required placeholder='Ingresá la nueva descripción'>{$pokemon["descripcion"]}</textarea>";
echo "</div>";
// enviar formulario
echo "<button type='submit' class='boton-guardar'>Guardar Cambios</button>";
echo "<a href='/pokedex/index.php' class='boton-volver'> << Volver</a>";
echo "</body>";
echo "</form>";

echo "</div>";

//cambiar descripcion pokemon

?>

<?php





//editarPokemon($conexion, $id, $pokemon["nombre"], $pokemon["descripcion"], $pokemon["numero_identificador"], $pokemon["tipo_id"], $pokemon["imagen_ruta"]);

?>