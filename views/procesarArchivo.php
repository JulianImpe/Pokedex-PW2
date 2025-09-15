<?php
include_once __DIR__ . "/../repository/PokedexBD.php";
include_once __DIR__ . "/../repository/query_pokemon.php";

$imagenOk = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = $_POST['id'] ?? null;
    $nombre = $_POST['nombre'] ?? null;
    $descripcion = $_POST['descripcion'] ?? null;
    $tipo_id = $_POST['tipo_id'] ?? null;

    // Validamos campos
    if (!$id || !$nombre || !$descripcion || !$tipo_id) {
        die("Todos los campos son obligatorios.");
    }

    // Validamos y subimos la imagen
    if (isset($_FILES["imagen"])
        && $_FILES["imagen"]["error"] === UPLOAD_ERR_OK
        && $_FILES["imagen"]["size"] > 0) {

        $archivoTmp = $_FILES["imagen"]["tmp_name"];
        $nombreArchivo = random_int(0, 1000000) . basename($_FILES["imagen"]["name"]);

        $carpetaDestinoServidor = "../public/img/"; // Carpeta para PHP
        $rutaFinalServidor = $carpetaDestinoServidor . $nombreArchivo;

        $rutaFinalWeb = "public/img/" . $nombreArchivo;
        if (move_uploaded_file($archivoTmp, $rutaFinalServidor)) {
            $imagenOk = true;
        } else {
            die("Error al subir la imagen.");
        }

    } else {
        die("Debes seleccionar una imagen válida.");
    }

    $result = $conexion->query("SELECT COUNT(*) AS total FROM pokemon WHERE id = $id");
    if ($result[0]['total'] > 0) {
        die("El ID $id ya existe. Elegí otro ID.");
    }
    $sql = "INSERT INTO pokemon (id, nombre, descripcion, numero_identificador, tipo_id, imagen_ruta)
            VALUES ($id, '$nombre', '$descripcion', $id, $tipo_id, '$rutaFinalWeb')";
    $conexion->query($sql);
//llamar del query_pokemon
    header("Location: ../index.php");
    exit();
}
?>
