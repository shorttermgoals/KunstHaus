<?php
//requires
require "modelo/Usuario.php";
require "modelo/ConexionBBDD.php";
require "modelo/funciones.php";

$usuario = new Usuario();

if(isset($_POST) && !empty($_POST)){

    $nombre = addslashes($_POST['nombre']);
    $username = addslashes($_POST['username']);
    $mail = addslashes($_POST['mail']); 
    $pass = addslashes($_POST['pass']); 
   
    // $usuario->insertarRegistro($nombre,$username,$mail,$pass);

    if($usuario->insertarRegistro($nombre,$username,$mail,$pass)){
        header('location:inicio.php');
    }
    //header("location:inicio.php");





}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>

    <?php 
        include "includes/head.php";
    ?>
</head>
<body>
    <div class="containerLogin">
        <form name="usuarios" action="<?php echo $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
            <ul>
                <li><input type="text" name="nombre" placeholder="Name" value="<?php echo $usuario->getNombre()?>" required></li>
                <li><input type="text" name="username" placeholder="Username" value="<?php echo $usuario->getUsername()?>" required></li>
                <li><input type="email" name="mail" placeholder="Email" value="<?php echo $usuario->getMail()?>" required></li>
                <li><input id="pass" type="password" name="pass" minlength="7" placeholder="Password" value="<?php echo $usuario->getPass()?>" required></li>
                <li><a id="comment" style="display: hidden;"></a></li>
                <li><div id="c1" class="c1"></div></li>
                <li><div id="c2" class="c2"></div></li>
                <li><div id="c3" class="c3"></div></li>
                <li><input type="submit" value="Guardar"></li>
            
            </ul>
        </form>
    </div>
    

    
    <script>
        let pass = document.getElementById("pass");
        let comment = document.getElementById("comment");
        let c1 = document.getElementById("c1");
        let c2 = document.getElementById("c2");
        let c3 = document.getElementById("c3");
        pass.addEventListener("input", function(){
            let pass = this.value;

            if (pass.length === 0){
                comment.textContent = ""
                comment.style.display = "hidden"
            } else if (pass.length === 1){
                comment.textContent = "The chosen password is not safe";
            } else if (pass.length === 7){
                comment.textContent = "The chosen password is still not safe";
            } else if (pass.length >= 13){
                comment.textContent = "The chosen password is safe";
            }
            c1.style.backgroundColor = pass.length > 0 ? "red" : "grey";
            c2.style.backgroundColor = pass.length < 7 ? "grey" : "yellow";
            c3.style.backgroundColor = pass.length < 13 ? "grey" : "green";
    });
    </script>
    
</body>
</html>