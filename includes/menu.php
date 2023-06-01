<nav>
    <div class="contenedorNavFooter">
        <div class="contenidosNav">
            <div class="contenedorNavFooterMenu-izq">
                <div class="contenedorNavFooterMenu-elemento-img">
                    <li><a id="menu-home" href="index.php"><img src="./images/logos/LogoMini.png" style="width: 40px;"></a></li>
                </div>
                <?php
    
                    if($_SESSION['permiso']>1){
                    echo '<div class="contenedorNavFooterMenu-elemento">
                        <li><a id="menu-obj"class="nav-link" href="listarObjetos.php">Data objetos</a></li>
                    </div>';
                    echo '<div class="contenedorNavFooterMenu-elemento">
                    <li><a id="menu-usr" class="nav-link" href="listarUsuarios.php">Usuarios</a></li>
                    </div>';
                    }
    
                ?>
                <div class="contenedorNavFooterMenu-elemento">
                    <li><a id="menu-v-obj" class="nav-link" href="verObjetos.php">Ver Objetos</a></li>
                </div>
                <div class="contenedorNavFooterMenu-elemento">
                    <li><a id="menu-contacto" class="nav-link" href="contacto.php">Contacto</a></li>
                </div>
            </div>
            <div class="contenedorNavFooterMenu-dcha">
                <div class="contenedorNavFooterMenu-elemento">
                    <li><a id="menu-salir" class="nav-link" href="logout.php">Logout</a></li>
                </div>
                <div class="contenedorNavFooterMenu-elemento">
                    <li><?php  if(isset($_SESSION['id_usuario'])) echo "<a id='menu-saludo' href='perfil.php?id=".$_SESSION['id_usuario']."' ><strong>".$_SESSION['username']."</strong></a>" ?></li>
                </div>
                <div class="contenedorNavFooterMenu-elemento">
                    <li >
                        <a href="#popupMenu" id="menu-popup" style="display: none;" >
                            <img src="./images/icons/menu-icon.png" style="width:40px;" >
                        </a>
                    </li>
                </div>
            </div>
            <!-- <li class="nav-item">
                <li onclick="cambiarIdioma(1)"><a href="#">Español</a></li>
                <li onclick="cambiarIdioma(2)"><a href="#">English</a></li>
            </li> -->
        </div>
    </div>
    <div id="popupMenu" class="popupDialog-wide">
            <div id="popupArea" class="popupArea-wide">
                <div class="contenedorPopup-wide">
                    <div class="tituloPopup-wide">
                        <a href="#cerrarPopup" class="cerrarPopup" id="cerrarPopup"><img src="./images/icons/icon-close.png" style="width: 15px;"></a>      
                    </div>
                    <div class="textoPopup-wide">
                        <?php  if(isset($_SESSION['id_usuario'])) echo "<a href='perfil.php?id=".$_SESSION['id_usuario']."' >PERFIL</a>" ?>
                    </div>
                    <div class="textoPopup-wide">
                        <a href="verObjetos.php">GALERIA</a> 
                    </div>
                    <?php
                    if($_SESSION['permiso']>1){
                        echo '<div class="textoPopup-wide">
                            <a  href="listarObjetos.php">OBJETOS</a>
                        </div>';
                        echo '<div class="textoPopup-wide">
                            <a href="listarUsuarios.php">USUARIOS</a>
                        </div>';
                        } 
                    ?>
                    <div class="textoPopup-wide">
                        <a href="contacto.php">CONTACTO</a>
                    </div>
                    <div class="textoPopup-wide">
                        <a href="logout.php">LOGOUT</a>
                    </div>
                    
                </div>
            </div>

            <!-- <div class="popupFondo" id="popupFondo">
            
            </div> -->
            
        </div>
</nav>