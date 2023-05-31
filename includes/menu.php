<nav>
    <div class="contenedorNavFooter">
        <div class="contenidosNav">
            <div class="contenedorNavMenu">
                <div class="contenedorNavMenu-elemento">
                    <li><a id="menu-home" class="nav-link active" href="index.php"><img src="./images/logos/LogoMini.png" style="width: 40px;"></a></li>
                </div>
                <?php
    
                    if($_SESSION['permiso']>1){
                    echo '<div class="contenedorNavMenu-elemento">
                        <li><a id="menu-obj"class="nav-link" href="listarObjetos.php">Gestionar Objetos</a></li>
                    </div>';
                    echo '<div class="contenedorNavMenu-elemento">
                    <li><a id="menu-usr" class="nav-link" href="listarUsuarios.php">Administrar usuarios</a></li>
                    </div>';
                    
                    }else{
                    echo '<div class="contenedorNavMenu-elemento">
                        <li><a id="menu-v-obj" class="nav-link" href="verObjetos.php">Ver Objetos</a></li>
                    </div>';
                    }
    
                ?>
                <div class="contenedorNavMenu-elemento">
                    <li><a id="menu-contacto" class="nav-link" href="contacto.php">Contacto</a></li>
                </div>
            </div>
            <div class="contenedorNavMenu">
                
            </div>
            <div class="contenedorNavMenu">
                <div class="contenedorNavMenu-elemento">
                    <li><a id="menu-salir" class="nav-link" href="logout.php">Cerrar sesión</a></li>
                </div>
                <div class="contenedorNavMenu-elemento">
                    <li><a><?php  if(isset($_SESSION['id_usuario'])) echo "Bienvenido ".$_SESSION['nombre'] ?></a></li>
                </div>
            </div>
            
    
            
    
            
    
            
            <!-- <li class="nav-item">
                <li onclick="cambiarIdioma(1)"><a href="#">Español</a></li>
                <li onclick="cambiarIdioma(2)"><a href="#">English</a></li>
            </li> -->
        </div>
    </div>
</nav>