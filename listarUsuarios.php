<?php
require "includes/protec.php";
require "modelo/ListaUsuarios.php";
require "modelo/Usuario.php";
require "modelo/ConexionBBDD.php";
require "modelo/funciones.php";

if($_SESSION['permiso']<2){
    header('location:index.php');
}


$lista = new ListaUsuarios();
if(isset($_GET['buscar']) && !empty($_GET['buscar'])){

    $lista->obtenerElementos(addslashes($_GET['buscar']));

}else {
    $lista->obtenerElementos();
}


?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listado usuarios</title>

    <?php
        include "includes/head.php";
    ?>
    <script src="js/scriptsUsuarios.js.js" type="text/javascript"></script>
</head>
<body>
<?php
include "includes/menu.php";
?>
<section>

    <h1>Lista de usuarios de la colección</h1>

    <form name="buscador" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
        <input name="buscar" type="text" placeholder="Buscador"><input type="submit" value="Buscar">
        <button type="submit">↻</button>
    </form>

    
    <div class="lista" id="lista">

        <?php

           echo  $lista->imprimirFigurasEnBack();

        ?>


    </div>
</section>
<?php

include "includes/footer.php";

?>


</body>
</html>
