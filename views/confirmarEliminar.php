<?php
if (!isset($_POST['id']) || !isset($_POST['nombre'])) {
    header("Location: /pokedex/index.php");
    exit();
}

$pokemon_id = $_POST['id'];
$nombre = $_POST['nombre'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Confirmar eliminación</title>
    <style>
        form { display: inline; margin-right: 10px; }
        button { padding: 5px 10px; cursor: pointer; }
    </style>
</head>
<body>
<h3> Confirmar eliminación</h3>
<p>¿Estás seguro que querés eliminar a <strong><?= $nombre ?></strong>?</p>
<p>Esta acción no se puede deshacer.</p>

<form method="POST" action="/pokedex/eliminarPokemon.php">
    <input type="hidden" name="id" value="<?= $pokemon_id ?>">
    <button type="submit" name="confirmar_eliminar"> Sí, eliminar</button>
</form>

<form method="GET" action="/pokedex/index.php">
    <button type="submit"> X Cancelar</button>
</form>

</body>
</html>
