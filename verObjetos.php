<?php


require "includes/protec.php";
require "modelo/ListaObjetos.php";
require "modelo/ObjetoKunst.php";
require "modelo/ConexionBBDD.php";
require "modelo/funciones.php";


$lista = new ListaObjetos();
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
    <title>Document</title>

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
        <div class="tituloForm-wide">
            <a class="descForm-wide">
                <strong>GALERÍA</strong>
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
            <div class="contenedorPostsObj" id="contenedorDePostsGaleria">
                <?php
                    echo $lista->imprimirFigurasParaGaleria();
                ?>
                <div class="postVacio"></div>
                <div class="postVacio"></div>
            </div>
        </div>
    </div>
</section>
<?php

include "includes/footer.php";

?>
</body>
</html>
