<?php
include "./repository/query_pokemon.php";
echo "<link rel='stylesheet' href='style.css'>";

echo "<table>";
foreach($traerListaPokemonsArrays as $pokemon){
    echo "<tr>";
    echo "<td>" . $pokemon["numero_identificador"] . "</td>";
    echo "<td>" . $pokemon["nombre"] . "</td>";
    echo "<td>" . $pokemon["descripcion"] . "</td>";
    echo "<td><img src='{$pokemon['imagen_ruta']}' /></td>";
    echo "<td><img src='{$pokemon['imagen_ruta_tipo']}' /></td>";


    echo "</tr>";
}
echo "</table>";
?>