<?php
include "query_pokedex.php";
echo "<table>";
foreach($traerListaPokemons as $pokemon){
    echo "<tr>";
    echo "<td>" . $pokemon["id"] . "</td>";
    echo "<td>" . $pokemon["name"] . "</td>";
    echo "<td>" . $pokemon["type"] . "</td>";
    echo "</tr>";
}
echo "</table>";
?>