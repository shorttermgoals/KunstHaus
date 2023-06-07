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
$usuario = new Usuario();


if(isset($_GET['buscar']) && !empty($_GET['buscar'])){

    $lista->obtenerElementos(addslashes($_GET['buscar']));

}else {
    $lista->obtenerElementos();
}

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
<div class="formDialog-wide">
    <div class="formArea-wide">
        <div class="tituloForm-wide">
            <a class="descForm-wide">
                <strong>USUARIOS</strong>
            </a>
        </div>
        <div class="buscadorPostsObj">
            <form name="buscador" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
                <input name="buscar" type="text" placeholder="Buscador">
                <div class="botonesBuscadorPost">
                    <button type="submit"><a>Buscar</a></button>
                    <button type="submit"><a>↻</a></button>
                </div>
            </form>      
        </div>
            <?php
                echo  $lista->imprimirFigurasEnBack();
            ?>
        </div>
    </div>
</div>
</section>
<?php

include "includes/footer.php";

?>


</body>
</html>
