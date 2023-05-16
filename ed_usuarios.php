<?php
//requires
require "includes/protec.php";

require "modelo/Usuario.php";
require "modelo/ConexionBBDD.php";
require "modelo/funciones.php";

if($_SESSION['permiso']<2){
    header('location:index.php');
}

$usuario = new Usuario();

if(isset($_GET['id']) && !empty($_GET['id'])){

    $id = intval($_GET['id']);
    $objeto->obtenerPorId($id);

}

if(isset($_POST) && !empty($_POST)){

    if(!empty($_POST['id'])){
       //Actualizar
        $id = intval($_POST['id']);
    }else {
        // Insertar
    }
   // header('location:listarFiguras.php');



}






?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar usuarios</title>

    <?php 
        include "includes/head.php";
    ?>
</head>
<body>
<?php
include "includes/header.php";
include "includes/menu.php";
?>
<section>
<div class="formulario">
    <h1>Formulario de Usuario</h1>

    <form name="usuarios" action="<?php echo $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">

        <ul>
            <input type="hidden" name="id" value="<?php echo $usuario->getId() ?>">
            <li><label>Nombre: </label><input type="text" name="nombre" value="<?php echo $usuario->getNombre() ?>" required > </li>
            <li><label>Username: </label><input type="text" name="username" value="<?php echo $usuario->getUsername() ?>" required > </li>
            <li><label>Permiso: </label><input type="int" name="permiso" value="<?php echo $usuario->getPermiso() ?>" required > </li>
            <li><input type="submit" value="Guardar"></li>
        </ul>

    </form>

</div>
</section>
<?php

include "includes/footer.php";

?>
</body>
</html>