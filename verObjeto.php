<?php
//requires
require "includes/protec.php";
require "modelo/ObjetoKunst.php";
require "modelo/ConexionBBDD.php";
require "modelo/funciones.php";

$id = intval($_GET['id']);

$objeto = new ObjetoKunst();
$objeto->obtenerPorId($id);


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
include "includes/header.php";
include "includes/menu.php";
?>
<section>
<div class="formulario">
    <h1>Objeto</h1>
    <?php

    echo $objeto->imprimirEnFicha();

    ?>
    </div>
</section>
<?php

include "includes/footer.php";

?>


</body>
</html>
