<?php
if (!isset($_POST['id']) || !isset($_POST['nombre'])) {
    header("Location: /pokedex/index.php");
    exit();
}

$pokemon_id = $_POST['id'];
$nombre = $_POST['nombre'];
echo "<link rel='stylesheet' href='../styles/confirmarEliminar.css'>";

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Confirmar eliminación</title>


</head>
<body>
<div class="container">
    <h3> Confirmar eliminación</h3>
    <p>¿Estás seguro que querés eliminar a <strong><?= $nombre ?></strong>?</p>
    <p class="warning">Esta acción no se puede deshacer.</p>

    <div class="buttons">
        <form method="POST" action="/pokedex/eliminarPokemon.php">
            <input type="hidden" name="id" value="<?= $pokemon_id ?>">
            <button type="submit" name="confirmar_eliminar" class="btn btn-danger">Sí, eliminar</button>
        </form>

        <form method="GET" action="/pokedex/index.php">
            <button type="submit" class="btn btn-cancel">X Cancelar</button>
        </form>
    </div>
</div>

</body>
</html>
