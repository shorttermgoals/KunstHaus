<?php
//requires
require "includes/protec.php";

require "modelo/ObjetoKunst.php";
require "modelo/ConexionBBDD.php";
require "modelo/funciones.php";

if($_SESSION['permiso']<2){
    header('location:index.php');
}

$objeto = new ObjetoKunst();

if(isset($_GET['id']) && !empty($_GET['id'])){

    $id = intval($_GET['id']);
    $objeto->obtenerPorId($id);

}

if(isset($_POST) && !empty($_POST)){

    if(!empty($_POST['id'])){
       //Actualizar
        $id = intval($_POST['id']);
        $objeto->update($id,$_POST, $_FILES['foto']);
    }else {
        // Insertar
        $objeto->insertar($_POST, $_FILES['foto']);
    }
   // header('location:listarFiguras.php');



}






?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CRUD</title>

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
    <h1>Formulario de Objeto</h1>

    <form name="objetokunst" action="<?php echo $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">

        <ul>
            <input type="hidden" name="id" value="<?php echo $objeto->getId() ?>">
            <li><label>Nombre: </label><input type="text" name="nombre" value="<?php echo $objeto->getNombre() ?>" required > </li>
            <li><label>Pintada: </label><input type="checkbox" name="pintada" value="1" required <?php echo $check ?>> </li>

            <?php
                $check = "";
                if($objeto->getPintada() == 1){
                    $check = "checked";
                }
            ?>

            <li><label>Fecha de creación: </label><input type="date" name="fcreacion" value="<?php echo $objeto->getFcreacion() ?>" required> </li>
            <li><label>Coleccion: </label><input type="text" name="coleccion" value="<?php echo $objeto->getCategoria() ?>" required> </li>
            <li><label>Foto: </label><input type="file" name="foto"> </li>
            <?php
                if(strlen($objeto->getFoto())>0){
                    echo "<li><img src='".$objeto->getFoto()."' width='55px'> </li>";
                }

            ?>

            <li><label>Descripción</label><textarea name="descripcion" required><?php echo $objeto->getDescripcion() ?></textarea></li>
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
