<?php
include_once "./repository/PokedexBD.php";
include_once "./repository/query_pokemon.php";


$config = parse_ini_file("./config/config.ini");


$conexion = new PokedexBD(
    $config['server'],
    $config['username'],
    $config['password'],
    $config['database'],
    3307
) or die("Problemas con la conexion");


if (isset($_GET['busqueda']) && trim($_GET['busqueda']) !== '') {
    $pokemons = buscarPokemonPorNombreONumero($conexion, $_GET['busqueda']);
    if (empty($pokemons)) {
        echo "<p>No se encontró ningún Pokémon.</p>";
        $pokemons = traerTodosLosPokemons($conexion);
    }
} else {
    $pokemons = traerTodosLosPokemons($conexion);
}


echo "<link rel='stylesheet' href='style.css'>";
echo "<form method='get' action='index.php'>
        <input type='text' name='busqueda' placeholder='Buscar por nombre o número'>
        <button type='submit'>Buscar</button>
      </form>";

echo "<table>";
echo "<thead><tr>
        <th>#</th><th>Nombre</th><th>Descripción</th><th>Imagen</th><th>Tipo</th>
      </tr></thead>";
echo "<tbody>";
foreach ($pokemons as $pokemon) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($pokemon["numero_identificador"]) . "</td>";
    echo "<td>" . htmlspecialchars($pokemon["nombre"]) . "</td>";
    echo "<td>" . htmlspecialchars($pokemon["descripcion"]) . "</td>";
    echo "<td><img src='" . htmlspecialchars($pokemon['imagen_ruta']) . "' alt='' style='height:60px;'></td>";
    echo "<td><img src='" . htmlspecialchars($pokemon['imagen_ruta_tipo']) . "' alt='' style='height:32px;'></td>";
    echo "</tr>";
}
echo "</tbody>";
echo "</table>";

$conexion->close();
?>
