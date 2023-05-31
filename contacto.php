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
            <div class="formDialog-wide">
                <div class="formArea-wide">
                    <div class="contenedorForm-wide">
                        <div class="tituloForm-wide">
                            <a class="descForm-wide"><strong>CONTACTO</strong></a>
                        </div>
                        <form name="contenido" action="<?php echo $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
                            <div class="datoForm-wide">
                                <li><input type="text" name="nombre" placeholder="Nombre" value="<?php echo $contacto->getNombre()?>" required></li>
                            </div>
                            <div class="datoForm-wide">
                                <li><input type="text" name="mail" placeholder="Mail" value="<?php echo $contacto->getMail()?>" required></li>
                            </div>
                            <div class="datoForm-wide">
                                <li><select name="inquiry" required>
                                        <option value="">Motivo</option>
                                        <option value="Consigna" <?php echo ($contacto->getInquiry() === 'Consigna') ? 'selected' : ''?>>- Consigna</option>
                                        <option value="Consulta sobre ejemplar" <?php echo ($contacto->getInquiry() === 'Consulta sobre ejemplar') ? 'selected' : ''?>>- Consulta sobre ejemplar</option>
                                        <option value="Venta privada" <?php echo ($contacto->getInquiry() === 'Venta privada') ? 'selected' : ''?>>- Venta privada</option>
                                        <option value="Registro de contenido" <?php echo ($contacto->getInquiry() === 'Registro de contenido') ? 'selected' : ''?>>- Registro de contenido</option>
                                        <option value="Planning de evento" <?php echo ($contacto->getInquiry() === 'Planning de evento') ? 'selected' : ''?>>- Planning de evento</option>
                                        <option value="Otros (especificar)" <?php echo ($contacto->getInquiry() === 'Otros (especificar)') ? 'selected' : ''?>>- Otros (especificar)</option>
                                    </select>
                                </li>
                            </div>
                            <div class="datoForm-wide-textArea">
                                <li><textarea placeholder="Comentarios" name="contents" maxlength="254" value="<?php echo $contacto->getContents()?>" required></textarea></li>
                            </div>
                            <div class="botonForm-wide">
                                <li><input id="enviarMail" type="submit" value="Guardar"></li>
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