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
    $usuario->obtenerPorId($id);

}

if(isset($_POST) && !empty($_POST)){

    if(!empty($_POST['id'])){
       //Actualizar
        $id = intval($_POST['id']);
        $usuario->update($id,$_POST);
        header('location:listarUsuarios.php');
    }else {
        // Insertar
        $usuario->insertar($_POST);
        header('location:listarUsuarios.php');
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
include "includes/menu.php";
?>
<section>
<div class="formDialog-wide">
    <div class="formArea-wide">
        <div class="contenedorForm-wide">
            <div class="tituloForm-wide">
                <a class="descForm-wide"><strong>DATOS DE USUARIO</strong></a>
            </div>
            <form name="usuarios" action="<?php echo $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $usuario->getId() ?>">
                    <div class="datoForm-wide">
                        <li><input type="text" placeholder="nombre" name="nombre" value="<?php echo $usuario->getNombre() ?>" required > </li>
                    </div>
                    <div class="datoForm-wide">
                        <li><input type="text" placeholder="username" name="username" value="<?php echo $usuario->getUsername() ?>" required > </li>
                    </div>
                    <div class="datoForm-wide">
                        <li>
                            <select id="per" name="permiso" required>
                                <option value="">Permiso</option>
                                <option value="0" <?php echo ($usuario->getPermiso() === 'N/A') ? 'selected' : ''?>>N/A</option>
                                <option value="7" <?php echo ($usuario->getPermiso() === 'Admin') ? 'selected' : ''?>>Admin</option>
                            </select>
                        </li>
                    </div>
                    <div class="botonForm-wide">
                        <li><input type="submit" value="Guardar"></li>
                    </div>
            </form>
        </div>
    </div>

</div>
</section>
<?php

include "includes/footer.php";

?>
</body>
</html>