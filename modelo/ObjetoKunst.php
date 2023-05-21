<?php

class ObjetoKunst{

    private $id;
    private $nombre;
    private $color;
    private $material;
    private $categoria;
    private $coleccion;
    private $descripcion;
    private $fcreacion;
    private $foto;
    private $tabla;
    private $carpetaFotos;

    /**
     * Figura constructor.
     * @param $id
     * @param $nombre
     * @param $color
     * @param $material
     * @param $categoria
     * @param $coleccion
     * @param $descripcion
     * @param $fcreacion
     * @param $foto
     * @param $tabla
     * @param $carpetaFotos
     */

    public function __construct($id="", $nombre="", $color="", $material="", $categoria="", $coleccion="", $descripcion="", $fcreacion="", $foto="", $tabla="", $carpetaFotos=""){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->color = $color;
        $this->material = $material;
        $this->categoria = $categoria;
        $this->coleccion = $coleccion;
        $this->descripcion = $descripcion;
        $this->fcreacion = $fcreacion;
        $this->foto = $foto;
        $this->tabla = "objetokunst";
        $this->carpetaFotos = "fotos/";
    }

    public function llenar($id, $nombre, $color, $material, $categoria, $coleccion, $descripcion, $fcreacion, $foto)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->color = $color;
        $this->material = $material;
        $this->categoria = $categoria;
        $this->coleccion = $coleccion;
        $this->descripcion = $descripcion;
        $this->fcreacion = $fcreacion;
        $this->foto = $foto;
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
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param string $color
     */
    public function setColor($color)
    {
        $this->color = $color;
    }

    /**
     * @return string
     */
    public function getMaterial()
    {
        return $this->material;
    }

    /**
     * @param string $material
     */
    public function setMaterial($material)
    {
        $this->material = $material;
    }

    /**
     * @return string
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * @param string $categoria
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    }

    /**
     * @return string
     */
    public function getColeccion()
    {
        return $this->coleccion;
    }

    /**
     * @param string $categoria
     */
    public function setColeccion($coleccion)
    {
        $this->coleccion = $coleccion;
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

    /**
     * @return string
     */
    public function getFcreacion()
    {
        return $this->fcreacion;
    }

    /**
     * @param string $precio
     */
    public function setFcreacion($fcreacion)
    {
        $this->fcreacion = $fcreacion;
    }

    /**
     * @return string
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * @param string $foto
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;
    }

    public function insertar($datos,$foto){

        if(!isset($datos['color'])){
            $datos['color'] = 0;
        }

        $conexion = new ConexionBBDD();
        $conexion->insertarElemento($this->tabla,$datos,$this->carpetaFotos,$foto);
    }

    public function update($id, $datos, $foto){

            $conexion = new ConexionBBDD();
            $conexion->uppdateBD($id, $this->tabla, $datos, $foto, $this->carpetaFotos);
    }




    /**
     * Version larga
     * @param $id
     */
    public function obtenerPorId($id){

        $sql = "SELECT id, nombre, color, material, categoria, coleccion, descripcion, fcreacion, foto FROM ".$this->tabla." WHERE id=".$id;

        $conexion = new ConexionBBDD();
        $res = $conexion->consulta($sql);
        list($id, $nombre, $color, $material, $categoria, $coleccion, $descripcion, $fcreacion, $foto) = mysqli_fetch_array($res);
        /*
        $this->id = $id;
        $this->unidades = $unidades;
        ...
        */
        $this->llenar($id, $nombre, $color, $material, $categoria, $coleccion, $descripcion, $fcreacion, $foto);


    }

    public function borrarObjeto($id){

        $conexion = new ConexionBBDD();
        $conexion->borrarFoto($id, $this->tabla,"../".$this->carpetaFotos);
        $sql = "DELETE FROM ".$this->tabla ." WHERE id=".$id;
        $conexion->consulta($sql);

    }


    public function obtencionPorIdVersionCorta($id){

        $sql = "SELECT id, nombre, color, material, categoria, coleccion, descripcion, fcreacion, foto FROM ".$this->tabla." WHERE id=".$id;

        $conexion = new ConexionBBDD();
        $res = $conexion->consulta($sql);

    }


    /**
     * Método que retorna una fila para la insercion en una tabla de la clase lista.
     * @return string
     */
    public function imprimeteEnTr(){

            $html = "<tr><td>".$this->id."</td>
                        <td>".$this->nombre."</td>
                        <td>".$this->color."</td>
                        <td>".$this->material."</td>
                        <td>".$this->categoria."</td>
                        <td>".$this->coleccion."</td>
                        <td>".$this->descripcion."</td>
                        <td>".$this->fcreacion."</td>
                        <td><img src='".$this->carpetaFotos.$this->foto."'></td>
                        <td><a href='verObjeto.php?id=".$this->id."'>Ver</a> </td>";

                     if($_SESSION['permiso']>1) {

                        $html.= "<td ><a href = 'ed_objeto.php?id=".$this->id."' > Editar</a > </td >
                        <td ><a href = 'javascript:borrarObjeto(".$this->id.")' > Borrar</a > </td >";
                     }

                       $html .= "</tr>";

            return $html;

    }


    public function imprimirEnFicha() {

        $html = "<table border='1'>";

            $html .= "<tr><th>ID</th>
                        <th>Nombre</th>
                        <th>Color</th>
                        <th>Material</th>
                        <th>Categoria</th>
                        <th>Coleccion</th>
                        <th>Descripción</th>
                        <th>Fecha de creación</th>
                        <th>Foto</th>
                       </tr>";
            $html .="  <tr><td>".$this->id."</td>
                        <td>".$this->nombre."</td>
                        <td>".$this->color."</td>
                        <td>".$this->material."</td>
                        <td>".$this->categoria."</td>
                        <td>".$this->coleccion."</td>
                        <td>".$this->descripcion."></td>
                        <td>".$this->fcreacion."</td>
                        <td><img src='".$this->carpetaFotos.$this->foto."'></td>
                        </tr></table>";

        return $html;

    }

    

}