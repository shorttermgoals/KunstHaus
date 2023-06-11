<?php


class Usuario{

    private $id;
    private $nombre;
    private $username;
    private $mail;
    private $pass;
    private $permiso;
    private $tabla;

    /**
     * Usuario constructor.
     * @param $id
     * @param $nombre
     * @param $username
     * @param $mail
     * @param $pass
     * @param $permiso
     */
    public function __construct($id="",$nombre="", $username="", $mail="", $pass="", $permiso=""){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->username = $username;
        $this->mail = $mail;
        $this->pass = $pass;
        $this->permiso = $permiso;
        $this->tabla = "usuarios";
    }

    public function llenar($id, $nombre, $mail, $username, $pass, $permiso)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->mail = $mail;
        $this->username = $username;
        $this->pass = $pass;
        $this->permiso = $permiso;
    }


    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param string $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

 /**
     * @return string
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * @param string $pass
     */
    public function setPass($pass)
    {
        $this->pass = $pass;
    }

    /**
     * @return string
     */
    public function getPermiso()
    {
        return $this->permiso;
    }

    /**
     * @param string $permiso
     */
    public function setPermiso($permiso)
    {
        $this->permiso = $permiso;
    }

    public function insertar($dato){

        $conexion = new ConexionBBDD();
        $conexion->insertarElementoSinFotos($this->tabla,$datos);
    }

    public function update($id, $datos){

            $conexion = new ConexionBBDD();
            $conexion->updateBDsinFoto($id, $this->tabla, $datos);
    }



    public function login($mailOrUsername, $pass){

        $conexion = new ConexionBBDD();
        $sql = "SELECT id, nombre, permiso FROM ".$this->tabla.
               " WHERE username='".$mailOrUsername."' AND pass='".md5($pass)."';";
        $res = $conexion->consulta($sql);
        $conexion->numeroElementos();

        if($conexion->numeroElementos()>0){
            list($id, $username,$permiso, $nombre) = mysqli_fetch_array($res);
            session_start();
            $_SESSION['id_usuario'] = $id;
            $_SESSION['username'] = $mailOrUsername;
            $_SESSION['nombre'] = $nombre;
            $_SESSION['permiso'] = $permiso;
            $_SESSION['mail'] = $mail;
            $respuesta = true;
        }else{
            $respuesta = false;
        }

       return $respuesta;
    }

    public function insertarRegistro($nombre, $username, $mail, $pass){

    
        if ($this->comprobarMail($mail)) {

            return false;
        }

        if ($this->comprobarUsername($username)) {

            return false;
        }



        $conexion = new ConexionBBDD();
        $sql = "INSERT INTO " .$this->tabla. " (nombre, username, mail, pass, permiso) VALUES ('".$nombre."', '".$username."', '".$mail."', '".md5($pass)."', 0)";
        $res = $conexion->consulta($sql);

        if (!$res) {
            // Error al insertar, muestra una alerta
            alert("NO");
            return false;
        }

        return true;
    }

    public function eliminarPosts($id){
        $conexion = new ConexionBBDD();
        $sql = "DELETE FROM objetokunst WHERE  id_creador = ".$id;
        $res = $conexion->consulta($sql);
        return true;
    }

    public function eliminarUsuario($id){
        $conexion = new ConexionBBDD();
        $sql = "DELETE FROM " .$this->tabla. " WHERE  id = ".$id;
        $res = $conexion->consulta($sql);

        if (!$res) {
            // Error al insertar, muestra una alerta
            alert("NO");
            return false;
        }
        
        $this->eliminarPosts($id);
        return true;
    }

    public function comprobarMail($mail){
        $conexion = new ConexionBBDD();
        $sql = "SELECT COUNT(*) AS total FROM " . $this->tabla . " WHERE mail = '".$mail."'";
        $res = $conexion->consulta($sql);
        $fila = mysqli_fetch_assoc($res);
        $total = $fila['total'];
        return $total > 0;
    }

    public function comprobarUsername($username){
        $conexion = new ConexionBBDD();
        $sql = "SELECT COUNT(*) AS total FROM " . $this->tabla . " WHERE username = '".$username."'";
        $res = $conexion->consulta($sql);
        $fila = mysqli_fetch_assoc($res);
        $total = $fila['total'];
        return $total > 0;
    }

    // public function comprobarContrasenia($pass){
    //     $passSecurity = "/(?=.*[A-Z])(?=.*\d).{8,}/";

    //     if(!preg_match($passSecurity, $pass)) {
    //         return false;
    //     } else{
    //         return true;
    //     }

    // }


    /**
     * Version larga
     * @param $id
     */
    public function obtenerPorId($id){

        $sql = "SELECT id, nombre, mail, username, pass, permiso FROM ".$this->tabla." WHERE id=".$id;

        $conexion = new ConexionBBDD();
        $res = $conexion->consulta($sql);
        list($id, $nombre, $mail, $username, $pass, $permiso) = mysqli_fetch_array($res);
        /*
        $this->id = $id;
        $this->unidades = $unidades;
        ...
        */
        $this->llenar($id, $nombre, $mail, $username, $pass, $permiso);


    }

    public function obtenerIDCreadorDesdeBD() {
        // Realizar consulta a la base de datos para obtener la id del creador
        $conexion = new ConexionBBDD();
        $sql = "SELECT id FROM ".$this->tabla." WHERE id=".$this->id;
        $res = $conexion->consulta($sql);
        list($id) = mysqli_fetch_array($res);
        
        return $id;
    }

    /**
     * Método que retorna una fila para la insercion en una tabla de la clase lista.
     * @return string
     */
    public function imprimeteEnTr(){

        $idUsuario = $this->obtenerIDCreadorDesdeBD();
        $permisoTexto = "";

        if($this->permiso > 0){
            $permisoTexto = "Admin";
        }else{
            $permisoTexto = "N/A";
        }

        $html = "<div class='filaListaObj'>
                    <div class='elementoListaObj'>
                        <a>".$this->id."</a>
                    </div>
                    <div class='elementoListaObj'>
                        <a>".$this->mail."</a>
                    </div>
                    <div class='elementoListaObj'>
                        <a>".$this->username."</a>
                    </div>
                    <div class='elementoListaObj'>
                        <a>".$permisoTexto."</a>
                    </div>";

                 if($_SESSION['permiso']>1) {

                    $selector = "";
                    if($this->permiso > 0){
                        $selector = "<select name='permiso' required>
                        <option value='' hidden>Permiso</option>
                        <option value='0'>N/A</option>
                        <option value='7' selected>Admin</option>
                        </select>";
                    }else{
                        $selector = "<select name='permiso' required>
                        <option value='' hidden>Permiso</option>
                        <option value='0' selected>N/A</option>
                        <option value='7'>Admin</option>
                        </select>";
                    }

                    $html.= "<a class='elementoListaObj-btnEd' href='#popupEditar?id=".$this->id."'>
                                Editar
                            </a>
                            <a class='elementoListaObj-btnEl' href='#popupEliminar?id=".$this->id."'>
                                Borrar
                            </a>
                            <div id='popupEditar?id=".$this->id."' class='popupDialog'>
                                <div id='popupArea' class='popupArea'>
                                    <div class='contenedorPopup'>
                                        <div class='tituloPopup'>
                                            <div class='vacio'></div>
                                            <a class='descPopup' style='font-size: 18px;'><strong>EDITAR ".$this->username."</strong></a>
                                            <a href='#cerrarPopup' class='cerrarPopup' id='cerrarPopup'><img src='./images/icons/icon-close.png' style='width: 15px;'></a>      
                                        </div>
                                        <form name='usuarios' action='".$_SERVER['PHP_SELF']."' method='post' enctype='multipart/form-data'>
                                            <input type='hidden' name='id' value='".$idUsuario."'>
                                            <div class='dato-input'>
                                                <li>
                                                    ".$selector."
                                                </li>
                                            </div>
                                            <div class='botonRegistro'>
                                                <input type='submit' value='Guardar'>
                                            </div>
                                        </form>
                                    </div>
                                </div>                            
                            </div>
                            <div id='popupEliminar?id=".$this->id."' class='popupDialog'>
                                <div class='popupArea'>
                                    <div class='contenedorPopup'>
                                        <div class='tituloPopup'>
                                            <div class='vacio'></div>
                                            <a class='descPopup' style='font-size: 18px;'><strong>PRECAUCIÓN</strong></a>
                                            <a href='#cerrarPopup' class='cerrarPopup' id='cerrarPopup'><img src='./images/icons/icon-close.png' style='width: 15px;'></a>      
                                        </div>
                                        <div class='texto'>
                                            <a>Precaución, ".$this->username." será eliminado permanentemente, ¿Continuar?</a>
                                        </div>
                                        <div class='texto'>
                                            <div class='customMenuPopup'>
                                                <div class='cerrarPopup'>
                                                    <a href='#cerrar' title='Cerrar' class='cerrar' style='text-decoration: none; color:black;' >NO</a>
                                                </div>
                                                <div class='cerrarPopup'>                                        
                                                    <a href='llamadas/borrarUsuario.php?id=".$this->id."' style='text-decoration: none; color:black;'>SI</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                ";}

                   $html .= "</div>";

        return $html;

}

public function imprimirPopupEditarUsuario(){

    $html = "   <div id='popupEditar?id=".$this->id."' class='popupDialog'>
                    <div id='popupArea' class='popupArea'>
                        <div class='contenedorPopup'>
                            <div class='tituloPopup'>
                                <div class='vacio'></div>
                                <a class='descPopup' style='font-size: 18px;'><strong>EDITAR USUARIO</strong></a>
                                <a href='#cerrarPopup' class='cerrarPopup' id='cerrarPopup'><img src='./images/icons/icon-close.png' style='width: 15px;'></a>      
                            </div>
                            <form name='usuarios' action='".$_SERVER['PHP_SELF']."' method='post' enctype='multipart/form-data'>
                                <input type='hidden' name='id' value=''>
                                <div class='dato-input'>
                                    <li>
                                        
                                    </li>
                                </div>
                                <div class='botonRegistro'>
                                    <input type='submit' value='Guardar'>
                                </div>
                            </form>
                        </div>
                    </div>                            
                </div>";

             

               

    return $html;

}


public function imprimirEnFicha() {

    $html = "<table border='1'>";

        $html .= "<tr><th>ID</th>
                    <th>Nombre</th>
                    <th>Username</th>
                    <th>Mail</th>
                    <th>Permiso</th>
                   </tr>";
        $html .="  <tr><td>".$this->id."</td>
                    <td>".$this->nombre."</td>
                    <td>".$this->username."</td>
                    <td>".$this->mail."</td>
                    <td>".$this->permiso."</td>
                    </tr></table>";

    return $html;

}

}

    