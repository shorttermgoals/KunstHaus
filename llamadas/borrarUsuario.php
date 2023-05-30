<?php



require "../modelo/ConexionBBDD.php";
require "../modelo/Usuario.php";

$usuario = new Usuario();

if(isset($_GET['id']) && !empty($_GET['id'])){

    $id = intval($_GET['id']);
    if($usuario->eliminarUsuario($id)){
        header('location: ../listarUsuarios.php');
        exit();
    }

}