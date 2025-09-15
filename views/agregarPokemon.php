<?php
include_once __DIR__ . "/../repository/PokedexBD.php"; // Conexión a la DB
include_once __DIR__ . "/../repository/query_pokemon.php";

// Incluir CSS
echo "<link rel='stylesheet' href='../styles/agregarPokemon.css'>";
echo "<body>";
?>

<div class="agregar-container">
    <h1 class="titulo-agregar">Agregar Nuevo Pokémon</h1>

    <form class="formulario-pokemon" method="POST" action="procesarArchivo.php" enctype="multipart/form-data">
        <div class="campo-formulario">
            <label for="id">ID del Pokémon:</label>
            <input type="number" id="id" name="id" min="1" required>
        </div>

        <div class="campo-formulario">
            <label for="nombre">Nombre del Pokémon:</label>
            <input type="text" id="nombre" name="nombre" required>
        </div>

        <div class="campo-formulario">
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" rows="4" required></textarea>
        </div>

        <div class="campo-formulario">
            <label for="tipo_id">Tipo:</label>
            <select id="tipo_id" name="tipo_id" required>
                <option value="">-- Elegí un tipo --</option>
                <option value="1">1 - Normal</option>
                <option value="2">2 - Fuego</option>
                <option value="3">3 - Agua</option>
                <option value="4">4 - Eléctrico</option>
                <option value="5">5 - Planta</option>
                <option value="6">6 - Hielo</option>
                <option value="7">7 - Lucha</option>
                <option value="8">8 - Veneno</option>
                <option value="9">9 - Tierra</option>
                <option value="10">10 - Volador</option>
                <option value="11">11 - Psíquico</option>
                <option value="12">12 - Bicho</option>
                <option value="13">13 - Roca</option>
                <option value="14">14 - Fantasma</option>
                <option value="15">15 - Dragón</option>
                <option value="18">18 - Hada</option>
            </select>
        </div>

        <div class="campo-formulario">
            <label for="imagen">Imagen del Pokémon:</label>
            <input type="file" id="imagen" name="imagen" accept="image/*" required>
        </div>

        <div class="botones-formulario">
            <a href="../index.php" class="boton-cancelar">Cancelar</a>
            <button type="submit" class="boton-agregar">Agregar Pokémon</button>
        </div>
    </form>
</div>

<?php
echo "</body>";
?>
