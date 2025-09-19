<?php
echo "<link rel='stylesheet' href='../styles/login.css'>";
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

<h1>Iniciar Sesión</h1>
<br>

<?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

<form method="post" action="">
    <input type="text" name="nombre" placeholder="Nombre" required><br>
    <input type="password" name="contraseña" placeholder="Contraseña" required><br>
    <button>Ingresar</button>
</form>

<p>¿No tienes cuenta? <a href="registrar.php">Registrarse</a></p>
