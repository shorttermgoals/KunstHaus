<nav>
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link active" href="index.php">Home</a>
        </li>

        <?php

        if($_SESSION['permiso']>1){
        echo '<li class="nav-item">
            <a class="nav-link" href="listarObjetos.php">Gestionar Objetos</a>
        </li>';
        echo '<li class="nav-item">
            <a class="nav-link" href="ed_usuarios.php">Administrar usuarios</a>
        </li>';
        }else{
            echo '<li class="nav-item">
            <a class="nav-link" href="verObjetos.php">Ver Objetos</a>
        </li>';
        }

        ?>

        

        <li class="nav-item">
            <a class="nav-link" href="logout.php">Salir</a>
        </li>
    </ul>
</nav>