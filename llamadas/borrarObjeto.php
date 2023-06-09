<?php

require "../modelo/ConexionBBDD.php";
require "../modelo/ObjetoKunst.php";

$objeto = new ObjetoKunst();

if(isset($_GET['id']) && !empty($_GET['id'])){

    $id = intval($_GET['id']);
    // $objeto->obtenerPorId($id);
    // echo $id;
    if($objeto->eliminarObjeto($id)){
        header('location: ../perfil.php');
        exit();
    }

}
