<?php
@session_start();
if(!isset($_SESSION['id_usuario'])){
header("location:inicio.php");
}
