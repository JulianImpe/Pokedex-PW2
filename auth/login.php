<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="../styles/login.css">
    <link rel="stylesheet" href="../styles/footer.css">
</head>

<?php
//echo "<link rel='stylesheet' href='../styles/login.css'>";
echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
session_start();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nombre = $_POST['nombre'];
    $contraseña = $_POST['contraseña'];

    $usuarios = [];
    $rutaUsuarios = 'usuarios.json';
    if(file_exists($rutaUsuarios)){
        $usuarios = json_decode(file_get_contents($rutaUsuarios), true);
    }

    $usuarioValido = false;

    foreach($usuarios as $usuario){
        if($usuario['nombre'] === $nombre && $usuario['contraseña'] === $contraseña){
            $_SESSION['nombre'] = $usuario['nombre'];
            $_SESSION['rol'] = $usuario['rol'];
            //$_SESSION['contraseña'] = $usuario['contraseña'];
            $usuarioValido = true;
            break;
        }
    }

    if($usuarioValido){

        if($_SESSION['rol'] === 'admin'){
            header("Location: ../index.php");
        } else {
            header("Location: ../vistaUsuario.php");
        }
        exit;
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }
}
?>

<div class="div-iniciar-sesion">





<?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

<form method="post" action="" class="form-class">
    <h1>Iniciar Sesión</h1>
    <br>
    <input type="text" name="nombre" placeholder="Nombre" required><br>
    <input type="password" name="contraseña" placeholder="Contraseña" required><br>
    <button>Ingresar</button>
    <br>
    <br>
    <p>¿No tienes cuenta? <a href="registrar.php"> Registrarse</a></p>
</form>



</div>
<?php
include('../views/layout/footer.php');
echo "<link rel='stylesheet' href='../styles/footer.css'>"
?>