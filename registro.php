<?php
//requires
require "modelo/Usuario.php";
require "modelo/ConexionBBDD.php";
require "modelo/funciones.php";

$usuario = new Usuario();

if(isset($_POST) && !empty($_POST)){

    $nombre = addslashes($_POST['nombre']);
    $username = addslashes($_POST['username']);
    $mail = addslashes($_POST['mail']); 
    $pass = addslashes($_POST['pass']); 
    
   
    $usuario->insertar($nombre,$username,$mail,$pass);
    //header("location:inicio.php");





}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>

    <?php 
        include "includes/head.php";
    ?>
</head>
<body>
    <form name="usuarios" action="<?php echo $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
        <ul>
            <li><label>Nombre: </label><input type="text" name="nombre" value="<?php echo $usuario->getNombre()?>" required></li>
            <li><label>Username: </label><input type="text" name="username" value="<?php echo $usuario->getUsername()?>" required></li>
            <li><label>Email: </label><input type="email" name="mail" value="<?php echo $usuario->getMail()?>" required></li>
            <li><label>Password: </label><input type="password" name="pass" value="<?php echo $usuario->getPass()?>" required></li>
            <li><input type="submit" value="Guardar"></li>
            
        </ul>
    </form>
</body>
</html>