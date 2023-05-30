<nav>

        
        <li class="nav-item">
            <a id="menu-home" class="nav-link active" href="index.php"></a>
            <img src="./images/logos/LogoMini.png" style="width: 40px;">
        </li>

        <?php

        if($_SESSION['permiso']>1){
        echo '<li class="nav-item">
            <a id="menu-obj"class="nav-link" href="listarObjetos.php">Gestionar Objetos</a>
        </li>';
        echo '<li class="nav-item">
            <a id="menu-usr" class="nav-link" href="listarUsuarios.php">Administrar usuarios</a>
        </li>';
        }else{
        echo '<li class="nav-item">
            <a id="menu-v-obj" class="nav-link" href="verObjetos.php">Ver Objetos</a>
        </li>';
        }

        ?>

        <li class="nav-item">
            <a id="menu-contacto" class="nav-link" href="contacto.php">Contacto</a>
        </li>

        <li class="nav-item">
            <a id="menu-salir" class="nav-link" href="logout.php">Cerrar sesión</a>
        </li>

        <li class="nav-item">
            <li onclick="cambiarIdioma(1)"><a href="#">Español</a></li>
            <li onclick="cambiarIdioma(2)"><a href="#">English</a></li>
        </li>

        <li class="nav-item">
            <a><?php  if(isset($_SESSION['id_usuario'])) echo "Bienvenido ".$_SESSION['nombre'] ?></a>
        </li>
</nav>