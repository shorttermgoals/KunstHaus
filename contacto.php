<?php
require "includes/protec.php";

require "modelo/Contacto.php";
require "modelo/ConexionBBDD.php";
require "modelo/funciones.php";

$contacto = new Contacto();

if(isset($_POST) && !empty($_POST)){

    $nombre = addslashes($_POST['nombre']);
    $mail = addslashes($_POST['mail']); 
    $inquiry = addslashes($_POST['inquiry']); 
    $contents = addslashes($_POST['contents']); 
    
    
   
    $contacto->insertarContacto($nombre,$mail,$inquiry,$contents);
    //header("location:inicio.php");



}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>

    <?php
        include "includes/head.php";
    ?>
</head>
<body>
<?php
include "includes/menu.php";
?>
<section>

<h1>Contacto</h1>

<form name="contenido" action="<?php echo $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
        <ul>
            <li><label>Nombre: </label><input type="text" name="nombre" value="<?php echo $contacto->getNombre()?>" required></li>
            <li><label>Email: </label><input type="email" name="mail" value="<?php echo $contacto->getMail()?>" required></li>
            <li>
                <label for="cont">Motivo de contacto: </label>
                <select id="cont" name="inquiry" required>
                    <option value="">Motivo</option>
                    <option value="1" <?php echo ($contacto->getInquiry() === '1') ? 'selected' : ''?>>Consigna</option>
                    <option value="2" <?php echo ($contacto->getInquiry() === '2') ? 'selected' : ''?>>Consulta sobre ejemplar</option>
                    <option value="3" <?php echo ($contacto->getInquiry() === '3') ? 'selected' : ''?>>Venta privada</option>
                    <option value="4" <?php echo ($contacto->getInquiry() === '4') ? 'selected' : ''?>>Registro de contenido</option>
                    <option value="5" <?php echo ($contacto->getInquiry() === '5') ? 'selected' : ''?>>Planning de evento</option>
                    <option value="6" <?php echo ($contacto->getInquiry() === '6') ? 'selected' : ''?>>Otros (especificar)</option>
                </select>
            </li>
            <li><label>Contenidos: </label><input type="textarea" name="contents" value="<?php echo $contacto->getContents()?>" required></li>
            <li><input type="submit" value="Guardar"></li>
            
        </ul>
    </form>

</section>
<?php

include "includes/footer.php";

?>
</body>
</html>