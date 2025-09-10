<?php
include "./repository/query_pokemon.php";

echo "<table>";
foreach($traerListaPokemonsArrays as $pokemon){
    echo "<tr>";
    echo "<td>" . $pokemon["id"] . "</td>";
    echo "<td>" . $pokemon["name"] . "</td>";
    echo "<td>" . $pokemon["description"] . "</td>";
    echo "<td>" . $pokemon["type_id"] . "</td>";
    echo "<img src='$pokemon[image_path]'> </img>";
    echo "</tr>";
}
echo "</table>";
?>