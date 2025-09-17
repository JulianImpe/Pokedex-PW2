<?php
session_start();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nombre = $_POST['nombre'];
    $contraseña = $_POST['contraseña'];
    $rol = $_POST['rol'];

    $usuarios = [];
    $rutaUsuarios = 'usuarios.json';

    if(file_exists($rutaUsuarios)){
        $usuarios = json_decode(file_get_contents($rutaUsuarios), true);
    }


    foreach ($usuarios as $usuario) {
        if($usuario['nombre'] == $nombre){
            $error = "El nombre de usuario ya existe";
            break;
        }
    }

    if(!isset($error)){

        $usuarios[] = [
                'nombre' => $nombre,
                'contraseña' => $contraseña,
                'rol' => $rol
        ];
        file_put_contents($rutaUsuarios, json_encode($usuarios, JSON_PRETTY_PRINT));


        header("Location: login.php");
        exit;
    }
}
?>

<h1>Registrarse</h1>

<?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

<form method="post" action="">
    <input type="text" name="nombre" placeholder="Nombre" required><br>
    <input type="password" name="contraseña" placeholder="Contraseña" required><br>

    <input type="radio" name="rol" value="admin" >Administrador
    <input type="radio" name="rol" value="usuario" >Usuario<br>

    <button>Registrarse</button>
</form>
