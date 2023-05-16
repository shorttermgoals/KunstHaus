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
    public function __construct($id="",$nombre="", $username="", $mail="", $permiso="",$pass=""){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->username = $username;
        $this->mail = $mail;
        $this->pass = $pass;
        $this->permiso = $permiso;
        $this->tabla = "usuarios";
    }

    public function llenar($id, $nombre, $username, $mail, $permiso, $pass)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->username = $username;
        $this->mail = $mail;
        $this->pass = $pass;
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



    public function login($mailOrUsername, $pass){

        $conexion = new ConexionBBDD();
        $sql = "SELECT id, nombre, permiso FROM ".$this->tabla.
               " WHERE mail='".$mailOrUsername."' OR username='".$mailOrUsername."' AND pass='".md5($pass)."';";
        $res = $conexion->consulta($sql);
        $conexion->numeroElementos();

        if($conexion->numeroElementos()>0){
            list($id, $nombre, $permiso) = mysqli_fetch_array($res);
            session_start();
            $_SESSION['id_usuario'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['nombre'] = $nombre;
            $_SESSION['permiso'] = $permiso;
            $_SESSION['mail'] = $mail;
            $respuesta = true;
        }else{
            $respuesta = false;
        }

       return $respuesta;
    }

    public function insertar($nombre, $username, $mail, $pass){

        if ($this->comprobarMail($mail)) {
            echo '<script>alert("El mail introducido ya está en uso");</script>';

            return false;
        }

        if ($this->comprobarUsername($username)) {
            echo '<script>alert("El nombre de usuario introducido ya está en uso");</script>';

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


    /**
     * Version larga
     * @param $id
     */
    public function obtenerPorId($id){

        $sql = "SELECT id, nombre, mail, pass, permiso FROM ".$this->tabla." WHERE id=".$id;

        $conexion = new ConexionBBDD();
        $res = $conexion->consulta($sql);
        list($id, $nombre, $mail, $permiso, $pass) = mysqli_fetch_array($res);
        /*
        $this->id = $id;
        $this->unidades = $unidades;
        ...
        */
        $this->llenar($id, $nombre, $mail, $permiso, $pass);


    }
}

    