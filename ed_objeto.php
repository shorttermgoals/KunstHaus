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
        header('location:listarObjetos.php');
    }else {
        // Insertar
        $objeto->insertar($_POST, $_FILES['foto']);
        header('location:listarObjetos.php');
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
include "includes/menu.php";
?>
<section>
<div class="mainPage">
    <div class="formDialog">
        <div class="formArea-wide">
            <div class="contenedorForm-wide">
                <div class="tituloForm-wide">
                    <a class="descForm-wide"><strong>CAMBIAR DEPENDIENDO DEL NOMBRE DEL DOMINIO</strong></a>
                </div>
                <form name="objetokunst" action="<?php echo $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
                
                        <input type="hidden" name="id" value="<?php echo $objeto->getId() ?>">
                        <div class="datoForm-wide">
                            <li><input type="text" placerholder="Nombre" name="nombre" value="<?php echo $objeto->getNombre() ?>" required > </li>
                        </div>
                        <div class="datoForm-wide">
                            <li><input type="date" placeholder="Fecha de creación" name="fcreacion" value="<?php echo $objeto->getFcreacion() ?>" min="1973-05-30" max="<?php echo date('Y-m-d'); ?>" required> </li>
                        </div>
                        <div class="datoForm-wide">
                            <li>
                                <select id="cat" name="categoria" required>
                                    <option value="">Categoría</option>
                                    <option value="Escultura" <?php echo ($objeto->getCategoria() === 'Escultura') ? 'selected' : ''?>>- Escultura</option>
                                    <option value="Litografía" <?php echo ($objeto->getCategoria() === 'Litografía') ? 'selected' : ''?>>- Litografía</option>
                                    <option value="Fotografía" <?php echo ($objeto->getCategoria() === 'Fotografía') ? 'selected' : ''?>>- Fotografía</option>
                                    <option value="Cuadro" <?php echo ($objeto->getCategoria() === 'Cuadro') ? 'selected' : ''?>>- Cuadro</option>
                                </select>
                            </li>
                        </div>
                        <div id="inputColor" class="datoForm-wide">
                                        <li>
                                            <select id="colorInput" name="color">
                                                <option value="">Color</option>
                                                <option value="Negro" <?php echo ($objeto->getColor() === 'Negro') ? 'selected' : ''?>>- Negro</option>
                                                <option value="Marrón" <?php echo ($objeto->getColor() === 'Marrón') ? 'selected' : ''?>>- Marrón</option>
                                                <option value="Gris" <?php echo ($objeto->getColor() === 'Gris') ? 'selected' : ''?>>- Gris</option>
                                                <option value="Beige" <?php echo ($objeto->getColor() === 'Beige') ? 'selected' : ''?>>- Beige</option>
                                                <option value="Fucsia" <?php echo ($objeto->getColor() === 'Fucsia') ? 'selected' : ''?>>- Fucsia</option>
                                                <option value="Morado" <?php echo ($objeto->getColor() === 'Morado') ? 'selected' : ''?>>- Morado</option>
                                                <option value="Rojo" <?php echo ($objeto->getColor() === 'Rojo') ? 'selected' : ''?>>- Rojo</option>
                                                <option value="Amarillo" <?php echo ($objeto->getColor() === 'Amarillo') ? 'selected' : ''?>>- Amarillo></option>
                                                <option value="Azul" <?php echo ($objeto->getColor() === 'Azul') ? 'selected' : ''?>>- Azul</option>
                                                <option value="Verde" <?php echo ($objeto->getColor() === 'Verde') ? 'selected' : ''?>>- Verde</option>
                                                <option value="Naranja" <?php echo ($objeto->getColor() === 'Naranja') ? 'selected' : ''?>>- Naranja</option>
                                                <option value="Blanco" <?php echo ($objeto->getColor() === 'Blanco') ? 'selected' : ''?>>- Blanco</option>
                                                <option value="Plateado" <?php echo ($objeto->getColor() === 'Plateado') ? 'selected' : ''?>>- Plateado</option>
                                                <option value="Dorado" <?php echo ($objeto->getColor() === 'Dorado') ? 'selected' : ''?>>- Dorado</option>
                                                <option value="Crema" <?php echo ($objeto->getColor() === 'Crema') ? 'selected' : ''?>>- Crema</option>
                                                <option value="Burdeos" <?php echo ($objeto->getColor() === 'Burdeos') ? 'selected' : ''?>>- Burdeos</option>
                                                <option value="Rosa" <?php echo ($objeto->getColor() === 'Rosa') ? 'selected' : ''?>>- Rosa</option>
                                                <option value="Lila" <?php echo ($objeto->getColor() === 'Lila') ? 'selected' : ''?>>- Lila</option>
                                                <option value="Varios" <?php echo ($objeto->getColor() === 'Varios') ? 'selected' : ''?>>- Varios</option>
                
                                            </select>
                                        </li>
                        </div>
                        <div id="inputMaterial" class="datoForm-wide">
                
                                        <li>
                                            <select id="materialInput" name="material">
                                                <option value="">Material</option>
                                                <option value="Plástico" <?php echo ($objeto->getMaterial() === 'Plástico') ? 'selected' : ''?>>- Plástico</option>
                                                <option value="Barro" <?php echo ($objeto->getMaterial() === 'Barro') ? 'selected' : ''?>>- Barro</option>
                                                <option value="Piedra" <?php echo ($objeto->getMaterial() === 'Piedra') ? 'selected' : ''?>>- Piedra</option>
                                                <option value="Metal" <?php echo ($objeto->getMaterial() === 'Metal') ? 'selected' : ''?>>- Metal</option>
                                                <option value="Madera" <?php echo ($objeto->getMaterial() === 'Madera') ? 'selected' : ''?>>- Madera</option>
                                                <option value="Hormigón" <?php echo ($objeto->getMaterial() === 'Hormigón') ? 'selected' : ''?>>- Hormigón</option>
                                                <option value="Cemento" <?php echo ($objeto->getMaterial() === 'Cemento') ? 'selected' : ''?>>- Cemento</option>
                                                
                                            </select>
                                        </li>
                        </div>
                        <div class="datoForm-wide">
                            <li><input type="text" placeholder="Colección" name="coleccion" value="<?php echo $objeto->getColeccion() ?>" required> </li>
                        </div>
                        <div class="datoForm-wide">
                            <li><input type="file" placeholder="Foto" name="foto"> </li>
                        </div>
                        <div class="datoForm-wide-textArea">
                            <li><textarea placeholder="Descripción" name="descripcion" required><?php echo $objeto->getDescripcion() ?></textarea></li>
                        </div>
                        <div class="botonForm-wide">
                            <li><input type="submit" value="Guardar"></li>
                        </div>
                
                </form>
            </div>
        </div>
    </div>
</div>


</div>
</section>
<?php

include "includes/footer.php";

?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
  var categoriaSelect = $("#cat");
  var colorInput = $("#colorInput");
  var materialInput = $("#materialInput");
  var divColor = $("#inputColor");
  var divMaterial = $("#inputMaterial");

  
  categoriaSelect.change(function() {
    if (categoriaSelect.val() === "Escultura") {
      colorInput.prop("disabled", false);
      materialInput.prop("disabled", false);
      divColor.show();
      divMaterial.show();
    } else {
      colorInput.prop("disabled", true);
      materialInput.prop("disabled", true);
      divColor.hide();
      divMaterial.hide();

    }
  });
  
  // Desencadenar el evento "change" al cargar la página para comprobar el estado inicial
  categoriaSelect.trigger("change");
});
</script>

</body>
</html>
