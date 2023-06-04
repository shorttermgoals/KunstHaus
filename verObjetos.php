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
    <script src="js/scritptsObjetos.js" type="text/javascript"></script>
</head>
<body>
<?php
include "includes/menu.php";
?>
<section>
    <div class="formDialog-wide">
        <div class="formArea-wide">         
            <div class="contenedorPostsObj">
                <div class="postObj">
                    <div class="tituloPostObj">
                        <a><strong>asd</strong></a>
                    </div>
                    <div class="fotoPostObj">
                        <a href="#popupPublicacion">
                            <img src="./fotos/gt3_backview.jpg"></img>
                        </a>
                    </div>
                    <div class="nombrePostObj">
                        <a>asd</a>
                    </div>
                    <div id="popupPublicacion" class="popupDialog">
                        <div id="popupArea" class="popupArea-publicacion">
                            <div class="contenedorPopup-publicacion">
                                <div class="imagenPopup">
                                    <img src="./fotos/mercedes_sideview.jpg" style="height: 500px">
                                </div>
                                <div class="descPublicacionPopup">
                                    <div class="cerrarPublicacionPopup">
                                        <a href='#cerrarPopup' class='cerrarPopup' id='cerrarPopup'><img src='./images/icons/icon-close.png' style='width: 15px;'></a>      
                                    </div>
                                    <div class="elementoContenidoPublicacionPopup">
                                        <a>Porsche 911 (997.2) GT3 by shorttermhector</a>
                                    </div>
                                    <div class="elementoContenidoPublicacionPopup">
                                        <a></a>
                                    </div>
                                    <div class="elementoContenidoPublicacionPopup">
                                        <a>Fotografía</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    echo $lista->imprimirFigurasParaGaleria();
                ?>
            </div>
        </div>
    </div>

    <!-- <h1>Lista de objetos en mi colleción</h1>

    <form name="buscador" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
        <input name="buscar" type="text" placeholder="Buscador"><input type="submit" value="Buscar">
        <button type="submit">↻</button>
    </form> -->


    <div class="lista" id="lista">

        <!-- <?php

           echo  $lista->imprimirFigurasEnBack();

        ?> -->


    </div>
</section>
<?php

include "includes/footer.php";

?>


</body>
</html>
