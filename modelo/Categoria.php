<?php


class Categoria
{

    private $id;
    private $nombre;
    private $icono;
    private $descripcion;

    /**
     * Categoria constructor.
     * @param $id
     * @param $nombre
     * @param $icono
     * @param $descripcion
     */
    public function __construct($id="", $nombre="", $icono="", $descripcion="")
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->icono = $icono;
        $this->descripcion = $descripcion;
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
    public function getIcono()
    {
        return $this->icono;
    }

    /**
     * @param string $icono
     */
    public function setIcono($icono)
    {
        $this->icono = $icono;
    }

    /**
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param string $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }


}