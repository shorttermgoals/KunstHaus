<?php


require "includes/protec.php";
require "modelo/ObjetoKunst.php";
require "modelo/Usuario.php";
require "modelo/ListaObjetos.php";
require "modelo/ConexionBBDD.php";
require "modelo/funciones.php";

$usuario = new Usuario();
$objeto = new ObjetoKunst();
$lista = new ListaObjetos();

$lista->obtenerElementosParaPerfil($_SESSION['id_usuario']);

if(isset($_GET['id']) && !empty($_GET['id'])){

    $id = intval($_GET['id']);
    $objeto->obtenerPorId($id);

}

if(isset($_POST) && !empty($_POST)){


    if(!empty($_POST['id'])){
       //Actualizar
        $id = intval($_POST['id']);
        $_POST['id_creador'] = $_SESSION['id_usuario'];
        $_POST['usuario_creador'] = $_SESSION['username'];
        $objeto->update($id,$_POST, $_FILES['foto']);
        header("location:perfil.php");
    }else{
        $_POST['id_creador'] = $_SESSION['id_usuario'];
        $_POST['usuario_creador'] = $_SESSION['username'];
        $objeto->insertar($_POST, $_FILES['foto']);
        header('location:verObjetos.php');
    }
   // header('location:listarFiguras.php');



}

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/classic.min.css"/> <!-- 'classic' theme -->
    <title><?php echo $_SESSION['username']?></title>

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
                    <strong>PERFIL</strong>
                </a>
            </div>
            <div class="cabeceraUsuarioPerfil" id="cabeceraPerfil">
                <div class="datosUsuarioPerfil">
                    <a><?php echo $_SESSION['username'] ?></a>
                    <?php
                        echo    "<a href='#popupUsuario?id=".$_SESSION['id_usuario']."'>
                                    <img src='./images/icons/options.png'>
                                </a>"
                    ?>
                </div>
                <div class="botonEliminarUsuarioPerfil">
                        <?php
                            echo    "
                                    <a class='areaBtnEliminarPerfil' href='#popupEliminar?id=".$_SESSION['id_usuario']."'>
                                        
                                            ELIMINAR USUARIO
                                        
                                    </a>"
                        ?>
                </div>
            </div>
            <div class="tituloForm-wide">
                <a class="descForm-wide">
                    <?php   $contador = $objeto->contadorDePublicacionesDelUsuario($_SESSION['id_usuario']);
                            $texto = "";
                            if ($contador == 1){
                                $texto = "Publicación";
                            }else{
                                $texto = "Publicaciones";
                            }
                            echo $contador . ' ' . $texto; 
                    ?>
                </a>
            </div>
            <div class="contenedorPostsObj" id="contenedorDePostsPerfil">
                <?php 
                    echo $lista->imprimirFigurasParaPerfil();
                ?>
                <a class="postAnadirObj" href="#popupAnadirPublicacion">
                        <img src="./images/icons/anadir-publicacion.png" style="width: 200px">
                </a>
                <div class="postVacio"></div>
                <div class="postVacio"></div>
            </div>
        </div>
    </div>
    <?php 
        echo "  <div id='popupUsuario?id=".$_SESSION['id_usuario']."' class='popupDialog'>
                    <div id='popupArea' class='popupArea'>
                        <div class='contenedorPopup'>
                            <div class='tituloPopup'>
                                <div class='vacio'></div>
                                <a class='descPopup' style='font-size: 18px;'><strong>EDITAR PERFIL</strong></a>
                                <a href='#cerrarPopup' class='cerrarPopup' id='cerrarPopup'><img src='./images/icons/icon-close.png' style='width: 15px;'></a>      
                            </div>
                            <form name='usuarios' method='post' enctype='multipart/form-data'>
                                <div class='dato-input'>
                                    <div class='color-picker' id='color-picker'></div>
                                </div>
                                <div class='dato-input'>
                                    <a>Escoge el color del perfil</a>
                                </div>
                            </form>
                        </div>
                    </div>                            
                </div>
                <div id='popupEliminar?id=".$_SESSION['id_usuario']."' class='popupDialog'>
                                <div class='popupArea'>
                                    <div class='contenedorPopup'>
                                        <div class='tituloPopup'>
                                            <div class='vacio'></div>
                                            <a class='descPopup' style='font-size: 18px;'><strong>PRECAUCIÓN</strong></a>
                                            <a href='#cerrarPopup' class='cerrarPopup' id='cerrarPopup'><img src='./images/icons/icon-close.png' style='width: 15px;'></a>      
                                        </div>
                                        <div class='texto'>
                                            <a>Precaución, el usuario será eliminado permanentemente, ¿Continuar?</a>
                                        </div>
                                        <div class='texto'>
                                            <div class='customMenuPopup'>
                                                <div class='cerrarPopup'>
                                                    <a href='#cerrar' title='Cerrar' class='cerrar' style='text-decoration: none; color:black;' >NO</a>
                                                </div>
                                                <div class='cerrarPopup'>                                        
                                                    <a href='llamadas/borrarUsuarioPerfil.php?id=".$_SESSION['id_usuario']."' style='text-decoration: none; color:black;'>SI</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>"
    ?>
    <?php 
        echo "  <div id='popupAnadirPublicacion' class='popupDialog'>
                    <div id='popupArea' class='popupArea'>
                        <div class='contenedorPopup'>
                            <div class='tituloPopup'>
                                <div class='vacio'></div>
                                <a class='descPopup' style='font-size: 18px;'><strong>CREAR POST</strong></a>
                                <a href='#cerrarPopup' class='cerrarPopup' id='cerrarPopup'><img src='./images/icons/icon-close.png' style='width: 15px;'></a>      
                            </div>
                            <form name='usuarios' action='".$_SERVER['PHP_SELF']."' method='post' enctype='multipart/form-data'>
                                <input type='hidden' name='id' value=''>
                                <div class='dato-input'>
                                    <li><input type='text' placeholder='Nombre' name='nombre' maxlength='35' required > </li>
                                </div>
                                <div class='dato-input'>
                                    <li><input type='date' placeholder='Fecha de creación' name='fcreacion' required> </li>
                                </div>
                                <div class='dato-input'>
                                    <li>
                                        <select name='categoria' required>
                                            <option value=''>Categoría</option>
                                            <option value='Escultura'>- Escultura</option>
                                            <option value='Litografía'>- Litografía</option>
                                            <option value='Fotografía'>- Fotografía</option>
                                            <option value='Cuadro'>- Cuadro</option>
                                        </select>
                                    </li>
                                </div>
                                <div class='dato-input'>
                                    <li>
                                        <select name='color'>
                                            <option value=''>Color</option>
                                            <option value='Negro'>- Negro</option>
                                            <option value='Marrón'>- Marrón</option>
                                            <option value='Gris'>- Gris</option>
                                            <option value='Beige'>- Beige</option>
                                            <option value='Fucsia'>- Fucsia</option>
                                            <option value='Morado'>- Morado</option>
                                            <option value='Rojo'>- Rojo</option>
                                            <option value='Amarillo'>- Amarillo></option>
                                            <option value='Azul'>- Azul</option>
                                            <option value='Verde'>- Verde</option>
                                            <option value='Naranja'>- Naranja</option>
                                            <option value='Blanco'>- Blanco</option>
                                            <option value='Plateado'>- Plateado</option>
                                            <option value='Dorado'>- Dorado</option>
                                            <option value='Crema'>- Crema</option>
                                            <option value='Burdeos'>- Burdeos</option>
                                            <option value='Rosa'>- Rosa</option>
                                            <option value='Lila'>- Lila</option>
                                            <option value='Varios'>- Varios</option>
            
                                        </select>
                                    </li>
                                </div>
                                <div class='dato-input'>
                                    <li>
                                        <select name='material'>
                                            <option value=''>Material</option>
                                            <option value='Plástico'>- Plástico</option>
                                            <option value='Barro'>- Barro</option>
                                            <option value='Piedra'>- Piedra</option>
                                            <option value='Metal'>- Metal</option>
                                            <option value='Madera'>- Madera</option>
                                            <option value='Hormigón'>- Hormigón</option>
                                            <option value='Cemento'>- Cemento</option>
                                            
                                        </select>
                                    </li>
                                </div>
                                <div class='dato-input'>
                                    <li><input type='text' placeholder='Colección' maxlength='50' name='coleccion' required> </li>
                                </div>
                                <div class='dato-input'>
                                    <li>
                                        <input type='file' id='fileInput' name='foto'>
                                    </li>
                                </div>
                                <div class='dato-input-textArea'>
                                    <li><textarea placeholder='Descripción' maxlength='254' name='descripcion' required></textarea></li>
                                </div>
                                <div class='botonRegistro'>
                                    <input type='submit' value='Guardar'>
                                </div>
                            </form>
                        </div>
                    </div>                            
                </div>"
    ?>
    
</section>
<?php

include "includes/footer.php";

?>

<script src="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/pickr.min.js"></script>
<script>


    const pickr = Pickr.create({
        el: '.color-picker',
        theme: 'classic', // or 'monolith', or 'nano'

        components: {

            // Main components
            preview: true,
            opacity: true,
            hue: true,

            // Input / output Options
            interaction: {
                input: true,
                save: true
            }
        }
    });

    let fondo = document.getElementById('cabeceraPerfil');
    let bloqueColor = document.getElementById('color-picker');
    pickr.on('save', (color) => {
        let colorSeleccionado = color.toHEXA().toString();
        console.log(colorSeleccionado);
        fondo.style.backgroundColor = colorSeleccionado;
    });

</script>
</body>
</html>
