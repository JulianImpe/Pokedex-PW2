<?php
session_start();
$nombre =$_POST['nombre'];
$contraseña = $_POST['contraseña'];
$rol = $_POST['rol'];

echo"$nombre";
echo"$contraseña";
echo"$rol";

$_SESSION['nombre'] = $nombre;
$_SESSION['rol'] = $rol;

header("Location: ../index.php");
exit;


?>