<?php


class Contacto{

    private $id;
    private $nombre;
    private $mail;
    private $inquiry;
    private $contents;
    private $aceptaPP;
    private $tabla;

    /**
     * Usuario constructor.
     * @param $id
     * @param $nombre
     * @param $mail
     * @param $inquiry
     * @param $contents
     * @param $aceptaPP
     */
    public function __construct($id="",$nombre="", $mail="", $inquiry="",$contents="", $aceptaPP=""){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->mail = $mail;
        $this->inquiry = $inquiry;
        $this->contents = $contents;
        $this->aceptaPP = $aceptaPP;
        $this->tabla = "contenido";
    }

    public function llenar($id, $nombre, $mail, $inquiry, $contents, $aceptaPP)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->mail = $mail;
        $this->inquiry = $inquiry;
        $this->contents = $contents;
        $this->aceptaPP = $aceptaPP;
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
    public function getInquiry()
    {
        return $this->inquiry;
    }

    /**
     * @param string $inquiry
     */
    public function setInquiry($inquiry)
    {
        $this->inquiry = $inquiry;
    }

    /**
     * @return string
     */
    public function getContents()
    {
        return $this->contents;
    }

    /**
     * @param string $contents
     */
    public function setContents($contents)
    {
        $this->contents = $contents;
    }

    /**
     * @return string
     */
    public function getAceptaPP()
    {
        return $this->aceptaPP;
    }

    /**
     * @param string $aceptaPP
     */
    public function setAceptaPP($aceptaPP)
    {
        $this->aceptaPP = $aceptaPP;
    }

    public function insertarContacto($nombre, $mail, $inquiry, $contents, $aceptaPP){

        $conexion = new ConexionBBDD();
        $sql = "INSERT INTO " .$this->tabla. " (nombre, mail, inquiry, contents, acepta_pp) VALUES ('".$nombre."', '".$mail."', '".$inquiry."', '".$contents."', '".$aceptaPP."')";
        $res = $conexion->consulta($sql);

        if (!$res) {
            // Error al insertar, muestra una alerta
            alert("NO");
            return false;
        }

        return true;
    }

}