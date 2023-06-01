<?php
require "modelo/ConexionBBDD.php";
require "modelo/funciones.php";
require "modelo/Usuario.php";
if(isset($_POST) && !empty($_POST)){
    
    $pass = addslashes($_POST['pass']);

    $usuario = new Usuario();

    if(empty($_POST['mail1'])){
        $nombre = addslashes($_POST['nombre']);
        $username = addslashes($_POST['username']);
        $mail = addslashes($_POST['mail2']); 
        if($usuario->insertarRegistro($nombre,$username,$mail,$pass)){
            header("location:inicio.php#cerrar");
            $errorMensajeRegistro = "";  
        }else{
            $errorMensajeRegistro = "Hubo un error en el registro de usuario, el usuario o mail introducido ya está en uso.";
        }
        
    }else if(empty($_POST['mail2'])){
        $mailOrUsername = addslashes($_POST['mail1']);
        if($usuario->login($mailOrUsername,$pass)){
            header("location:index.php");
            $errorMensajeLogin = "";
         }else{
            $errorMensajeLogin = "Hubo un error en el inicio de sesión, el usuario o contraseña introducido no es correcto.";          
         }
    }
    






}

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <?php 
        include "includes/head.php";
    ?>
</head>
<body>

    <div class="formDialog-login">
        <div class="formArea-login">
            <div class="contenedorForm-login">
                <div class="tituloForm-login">
                    <a class="descForm-login" style="font-size: 18px;"><strong>LOGIN</strong></a>
                </div>
                <?php if (isset($errorMensajeLogin)) : ?>
                            <div class="mensajeErrorForm">
                                <a style="color:white;" ><strong><?php echo $errorMensajeLogin; ?></strong></a>
                            </div>
                        <?php endif; ?>
                <form name="login" action="<?php  echo $_SERVER['PHP_SELF']?>" method="post">
                    <div class="datoForm-login">
                        <li><input type="text" name="mail1" placeholder="User" required></li>
                    </div>
                    <div class="datoForm-login">
                        <li><input type="password" name="pass" placeholder="Password" required></li>
                    </div>
                    <div class="botonPopupRegistroLogin">
                            <div class="botonPopupRegistroLogin-container">
                                    <a href="#popupRegistro" class="botonPopupRegistroLogin-container-dato-2" style="font-size: 13px;" >No tengo cuenta</a>                               
                            </div>
                    </div>
                    <div class="botonForm-login">
                        <li><input type="submit" value="Entrar"></li>
                    </div>
                    <div class="textoForm-login">
                        <div class="contenedorTextoForm">
                            <li><a style="opacity:0.6;">Al iniciar sesión aceptas nuestros </a><a href="terminos.php" class="datosHrefPoliticas">Términos de servicio</a><a style="opacity:0.6;"> y nuestra </a><a href="politica.php" class="datosHrefPoliticas">Política de privacidad</a></li>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

        <div id="popupRegistro" class="popupDialog">
            <div id="popupArea" class="popupArea">
                
                <div class="contenedorPopup">
                    <div class="tituloPopup">
                        <div class="vacio"></div>
                        <a class="descPopup" style="font-size: 18px;"><strong>REGISTRO</strong></a>
                        <a href="#cerrarPopup" class="cerrarPopup" id="cerrarPopup"><img src="./images/icons/icon-close.png" style="width: 15px;"></a>      
                    </div>
                    <?php if (isset($errorMensajeRegistro)) : ?>
                        <div class="texto-warning">
                            <a class="mensajeErrorRegistro-texto" style="color:white;"><strong><?php echo $errorMensajeRegistro; ?></strong></a>
                        </div>
                    <?php endif; ?>
                    <form  id="formularioRegistro" name="usuarios" method="post" enctype="multipart/form-data">
                        <div class="dato-input">                            
                            <li><input type="text" name="nombre" placeholder="Name"  required></li>
                        </div>
                        <div class="dato-input">
                            <li><input type="text" name="username" placeholder="Username"  required></li>
                        </div>
                        <div class="dato-input">
                            <li><input type="email" name="mail2" placeholder="E-mail"  required></li>
                        </div>
                        <div class="dato-input">
                            <li><input id="pass" type="password" name="pass" minlength="7" placeholder="Password" required></li>
                        </div>
                        <div class="coloresRegistro">
                            <div class="textoPasswordColores">
                                <a id="comment" style="display: hidden;"></a>
                            </div>
                            <div class="coloresPasswordColores">
                                    <div id="c1" class="bloqueColor"></div>
                                    <div id="c2" class="bloqueColor"></div>
                                    <div id="c3" class="bloqueColor"></div>
                            </div>
                        </div>
                        <div class="botonRegistro">
                            <input type="submit" id="botonRegistro" value="Guardar">
                        </div>
                    </form>
                </div>
            </div>

            <!-- <div class="popupFondo" id="popupFondo">
            
            </div> -->
            
        </div>
<script>
        let pass = document.getElementById("pass");
        let comment = document.getElementById("comment");
        let c1 = document.getElementById("c1");
        let c2 = document.getElementById("c2");
        let c3 = document.getElementById("c3");
        let popupBackground = document.getElementById("popupArea");
        let cerrarPopup = document.getElementById("cerrarPopup");
        let formularioRegistro = document.getElementById("formularioRegistro");
        let btnRegistro = document.getElementById("botonRegistro");
        

        // const eventoClic = new MouseEvent('click', {
        //     bubbles: true, 
        //     cancelable: true, 
        //     view: window 
        // });
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
            c1.style.backgroundColor = pass.length > 0 ? "rgb(200, 0, 0, 1)" : "rgba(0, 0, 0, 0.062)";
            c2.style.backgroundColor = pass.length < 7 ? "rgba(0, 0, 0, 0.062)" : "rgba(255, 199, 0, 1)";
            c3.style.backgroundColor = pass.length < 13 ? "rgba(0, 0, 0, 0.062)" : "green";
        });


        cerrarPopup.addEventListener('click', function() {
            vaciarCampos();
        });

        function vaciarCampos(){
            var campos = formularioRegistro.getElementsByTagName('input');

            c1.style.backgroundColor = "rgba(0, 0, 0, 0.062)";
            c2.style.backgroundColor = "rgba(0, 0, 0, 0.062)";
            c3.style.backgroundColor = "rgba(0, 0, 0, 0.062)";

            for (var i = 0; i < campos.length; i++) {
                campos[i].value = '';
                btnRegistro.value = 'Guardar';
            }
        }

       
        // popupBackground.addEventListener("click", function(){
        //     console.log("HOla");
        //     cerrarPopup.click();
        // });

    
    </script>

</body>
</html>
