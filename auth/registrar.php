

<?php
echo "<link rel='stylesheet' href='../styles/registrar.css'>";
echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
session_start();

//include('../views/layout/header.php');

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nombre = $_POST['nombre'];
    $contraseña = $_POST['contraseña'];
    $rol = $_POST['rol'];
    $repetirContraseña = $_POST['nuevaContraseña'];

    $usuarios = [];
    $rutaUsuarios = 'usuarios.json';

    if(file_exists($rutaUsuarios)){
        $usuarios = json_decode(file_get_contents($rutaUsuarios), true);
    }

    if($contraseña!== $repetirContraseña){
        $error = "Las contraseñas no coinciden";
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
<div class="div-registrar">


<?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>


<form method="post" action="">
    <h1>Registrarse</h1>
    <input type="text" name="nombre" placeholder="Nombre" required><br>
    <input type="password" name="contraseña" placeholder="Contraseña" required><br>
    <input type="password" name="nuevaContraseña" placeholder="NuevaContraseña"><br>


  <!--  <input type="radio" name="rol" value="admin" class="input-radio">Administrador
    <input type="radio" name="rol" value="usuario" class="input-radio" >Usuario<br>-->
    <div class="rol-container">
        <label>
            <input type="radio" name="rol" value="admin"> Administrador
        </label>
        <label>
            <input type="radio" name="rol" value="usuario"> Usuario
        </label>
    </div>

    <button>Registrarse</button>
    <br>
    <br>
    <p>¿Ya tienes cuenta? <a href="login.php">Iniciar Sesión</a></p>
</form>


</div>



<?php
include('../views/layout/footer.php');
echo "<link rel='stylesheet' href='../styles/footer.css'>"
?>


