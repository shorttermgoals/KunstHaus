<?php
require "includes/protec.php";
require "modelo/ListaObjetos.php";
require "modelo/ObjetoKunst.php";
require "modelo/ConexionBBDD.php";
require "modelo/funciones.php";

if($_SESSION['permiso']<2){
    header('location:error404.php');
}


$lista = new ListaObjetos();
$objeto = new ObjetoKunst();
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
    <title>Listado objetos</title>

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
        <div class="tituloForm-wide">
            <a class="descForm-wide">
                <strong>PUBLICACIONES</strong>
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
                echo $lista->imprimirFigurasEnBack();
            ?>
        </div>
    </div>
</div>

</section>
<?php

include "includes/footer.php";

?>

<script>
    var ejecutado = false; // Variable de bandera


window.addEventListener('load',function(){
    var anchoPagina = window.innerWidth;
    if (anchoPagina <= 1024 && !ejecutado){
        ejecutado = true;
        cambiarMenu();
    } else if(anchoPagina >1024 && ejecutado){
        ejecutado = false;
        descambiarMenu();
    }
});

window.addEventListener('resize', function() {
    var anchoPagina = window.innerWidth;
    if (anchoPagina <= 1024 && !ejecutado){
        ejecutado = true;
        cambiarMenu();
    } else if(anchoPagina >1024 && ejecutado){
        ejecutado = false;
        descambiarMenu();
    }
});
  
function cambiarPantalla() {
    var  = document.getElementById('menu-obj');
    menu_saludo.style.display = 'none';

}

function descambiarPantalla() {
    var menu_objetos = document.getElementById('menu-obj');
    menu_popup.style.display = 'block';
}

</script>
</body>
</html>
