<?php

// require "../modelo/ListaObjetos.php";
// require "../modelo/ObjetoKunst.php";
// require "../modelo/ConexionBBDD.php";


// $id = intval($_GET['id']);

// //borro el elemento de la BD y su foto
// $objeto = new ObjetoKunst();
// $objeto->borrarFigura($id);


// //Pido de nuevo la lista de elementos y la envio a AJAX

// $lista = new ListaObjetos();
// $lista->obtenerElementos();


// echo $lista->imprimirFigurasEnBack();

require "../modelo/ConexionBBDD.php";
require "../modelo/ObjetoKunst.php";

$objeto = new ObjetoKunst();

if(isset($_GET['id']) && !empty($_GET['id'])){

    $id = intval($_GET['id']);
    // $objeto->obtenerPorId($id);
    // echo $id;
    if($objeto->eliminarObjeto($id)){
        header('location: ../listarObjetos.php');
        exit();
    }

}
