<?php
include_once "./repository/PokedexBD.php";
include_once "./repository/query_pokemon.php";
session_start();

$config = parse_ini_file("./config/config.ini");

$conexion = new PokedexBD(
    $config['server'],
    $config['username'],
    $config['password'],
    $config['database'],
    3306
) or die("Problemas con la conexión");

// Manejo de búsqueda
if (isset($_GET['busqueda']) && trim($_GET['busqueda']) !== '') {
    $pokemons = buscarPokemonPorNombreONumero($conexion, $_GET['busqueda']);
    if (empty($pokemons)) {
        echo "<p>No se encontró ningún Pokémon.</p>";
        $pokemons = traerTodosLosPokemons($conexion);
    }
} else {
    $pokemons = traerTodosLosPokemons($conexion);
}

// HTML
echo "<!DOCTYPE html>";
echo "<html lang='es'>";
echo "<head>";
echo "<meta charset='UTF-8'>";
echo "<title>Pokédex</title>";
echo "<link rel='stylesheet' href='styles/styles.css'>";
echo "</head>";
echo "<body>";

include "views/layout/header.php";

echo "Hola " . $_SESSION['usuario'] . " ";



echo "<h1 class='title'>Pokédex</h1>";

echo "<form method='get' action='vistaUsuario.php'>
<input class='buscador' type='text' name='busqueda' placeholder='Buscar por nombre o número'>
        <button class='boton-buscar' type='submit'>Buscar</button>
    </form>";

// Grid container
echo "<div class='grid-container'>";

// Tabla de Pokémon
echo "<table class='pokemon-table'>";
echo "<thead>
        <tr>
            <th>Imagen</th>
            <th>Tipo</th>
            <th>Número</th>
            <th>Nombre</th>
        
        </tr>
    </thead>";
echo "<tbody>";

foreach ($pokemons as $pokemon) {
    echo "<tr>";
    // Imagen
    echo "<td><img src='" . htmlspecialchars($pokemon['imagen_ruta']) . "' alt='' style='height:60px;'></td>";
    // Tipo
    echo "<td><img src='" . htmlspecialchars($pokemon['imagen_ruta_tipo']) . "' alt='' style='height:32px;'></td>";
    // Número
    echo "<td>" . htmlspecialchars($pokemon["numero_identificador"]) . "</td>";
    // Nombre
    echo "<td>" . htmlspecialchars($pokemon["nombre"]) . "</td>";
    // Acciones








    echo "</td>";
    echo "</tr>";
}

echo "</tbody>";
echo "</table>";

$conexion->close();


include 'views/layout/footer.php';

echo "</html>";
