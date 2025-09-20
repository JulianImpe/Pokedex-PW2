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

echo "Hola " . $_SESSION['nombre'] . " ";

if (!isset($_SESSION['usuario'])) {
    header("Location: /pokedex/auth/login.php");
    exit();
}
if(isset($_SESSION['rol']) && $_SESSION['rol'] == 'usuario' && $_SESSION['rol'] != 'admin'){
    header("Location: /pokedex/vistaUsuario.php");
    exit;
}

echo "<h1 class='title'>Pokédex</h1>";
echo '<div class="buscador-container">';
echo '<button class="agregar-pokemon" onclick="window.location.href=\'views/agregarPokemon.php\'">Agregar Pokémon</button>';echo '</div>';
echo "<form method='get' action='index.php'>
        <input class='buscador' type='text' name='busqueda' placeholder='Buscar por nombre o número'>
        <button class='boton-buscar' type='submit'>Buscar</button>
    </form>";

echo '</div>';
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
            <th>Acciones</th>
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
    echo "<td>";
    echo "<div alt='Ver Detalle' class='ver-detalle' id='pokemon-" . $pokemon["numero_identificador"] . "' onclick='window.location.href=\"/pokedex/detallePokemon.php?id=" . $pokemon["numero_identificador"] . "\"'>
          <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 48 48'>
          <g fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='4'>
          <path d='M39 4H11a2 2 0 0 0-2 2v36a2 2 0 0 0 2 2h28a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2M17 30h14m-14 6h7'/>
          <path d='M17 12h14v10H17z'/>
          </g>
          </svg></div>";

    echo "<button alt='Editar' class='editar-pokemon' onclick='window.location.href=\"/pokedex/editarPokemon.php?id=" . $pokemon["numero_identificador"] . "\"'>
        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'>
        <g class='edit-outline'><g fill='currentColor' fill-rule='evenodd' class='Vector' clip-rule='evenodd'>
        <path d='M2 6.857A4.857 4.857 0 0 1 6.857 2H12a1 1 0 1 1 0 2H6.857A2.857 2.857 0 0 0 4 6.857v10.286A2.857 2.857 0 0 0 6.857 20h10.286A2.857 2.857 0 0 0 20 17.143V12a1 1 0 1 1 2 0v5.143A4.857 4.857 0 0 1 17.143 22H6.857A4.857 4.857 0 0 1 2 17.143z'/>
        <path d='m15.137 13.219l-2.205 1.33l-1.033-1.713l2.205-1.33l.003-.002a1.2 1.2 0 0 0 .232-.182l5.01-5.036a3 3 0 0 0 .145-.157c.331-.386.821-1.15.228-1.746c-.501-.504-1.219-.028-1.684.381a6 6 0 0 0-.36.345l-.034.034l-4.94 4.965a1.2 1.2 0 0 0-.27.41l-.824 2.073a.2.2 0 0 0 .29.245l1.032 1.713c-1.805 1.088-3.96-.74-3.18-2.698l.825-2.072a3.2 3.2 0 0 1 .71-1.081l4.939-4.966l.029-.029c.147-.15.641-.656 1.24-1.02c.327-.197.849-.458 1.494-.508c.74-.059 1.53.174 2.15.797a2.9 2.9 0 0 1 .845 1.75a3.15 3.15 0 0 1-.23 1.517c-.29.717-.774 1.244-.987 1.457l-5.01 5.036q-.28.281-.62.487m4.453-7.126s-.004.003-.013.006z'/>
        </g></g>
        </svg></button>";

    echo "<button alt='Eliminar' class='eliminar-pokemon' onclick='window.location.href=\"/pokedex/eliminarPokemon.php?id=" . $pokemon["numero_identificador"] . "\"'>
          <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'>
          <path fill='currentColor' d='M7 21q-.825 0-1.412-.587T5 19V6q-.425 0-.712-.288T4 5t.288-.712T5 4h4q0-.425.288-.712T10 3h4q.425 0 .713.288T15 4h4q.425 0 .713.288T20 5t-.288.713T19 6v13q0 .825-.587 1.413T17 21zM17 6H7v13h10zm-7 11q.425 0 .713-.288T11 16V9q0-.425-.288-.712T10 8t-.712.288T9 9v7q0 .425.288.713T10 17m4 0q.425 0 .713-.288T15 16V9q0-.425-.288-.712T14 8t-.712.288T13 9v7q0 .425.288.713T14 17M7 6v13z'/>
          </svg></button>";



    echo "</td>";
    echo "</tr>";
}

echo "</tbody>";
echo "</table>";

$conexion->close();
echo "</div>"; // Cerramos grid-container
echo '<div style="margin-top:20px;">';

echo "</body>";

include 'views/layout/footer.php';

echo "</html>";
