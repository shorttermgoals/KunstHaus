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
    private $id_creador;
    private $usuario_creador;
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
     * @param $id_creador
     * @param $tabla
     * @param $carpetaFotos
     */

    public function __construct($id="", $nombre="", $color="", $material="", $categoria="", $coleccion="", $descripcion="", $fcreacion="", $foto="", $id_creador="", $usuario_creador="", $tabla="", $carpetaFotos=""){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->color = $color;
        $this->material = $material;
        $this->categoria = $categoria;
        $this->coleccion = $coleccion;
        $this->descripcion = $descripcion;
        $this->fcreacion = $fcreacion;
        $this->foto = $foto;
        $this->id_creador = $id_creador;
        $this->usuario_creador = $usuario_creador;
        $this->tabla = "objetokunst";
        $this->carpetaFotos = "fotos/";
    }

    public function llenar($id, $nombre, $color, $material, $categoria, $coleccion, $descripcion, $fcreacion, $foto, $id_creador)
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
        $this->id_creador = $id_creador;
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

     /**
     * @return string
     */
    public function getIdCreador()
    {
        return $this->id_creador;
    }

    /**
     * @param string $id_creador
     */
    public function setIdCreador($id_creador)
    {
        $this->id_creador = $id_creador;
    }

    public function insertar($datos,$foto){

        // if(!isset($datos['color'])){
        //     $datos['color'] = 0;
        // }

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

        $sql = "SELECT id, nombre, color, material, categoria, coleccion, descripcion, fcreacion, foto, id_creador FROM ".$this->tabla." WHERE id=".$id;

        $conexion = new ConexionBBDD();
        $res = $conexion->consulta($sql);
        list($id, $nombre, $color, $material, $categoria, $coleccion, $descripcion, $fcreacion, $foto, $id_creador) = mysqli_fetch_array($res);
        /*
        $this->id = $id;
        $this->unidades = $unidades;
        ...
        */
        $this->llenar($id, $nombre, $color, $material, $categoria, $coleccion, $descripcion, $fcreacion, $foto, $id_creador);


    }

    public function eliminarObjeto($id){
        $conexion = new ConexionBBDD();
        $sql = "DELETE FROM " .$this->tabla. " WHERE  id = ".$id;
        $res = $conexion->consulta($sql);

        if (!$res) {
            // Error al insertar, muestra una alerta
            alert("NO");
            return false;
        }

        return true;
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
                        <td><img src='".$this->carpetaFotos.$this->foto."' style='width: 200px;'></td>";

                     if($_SESSION['permiso']>1) {

                        $html.= "<td ><a href = 'ed_objeto.php?id=".$this->id."' > Editar</a > </td >
                        <td ><a href = '#popupEliminar?id=".$this->id."'>Borrar</a></td>
                        <div id='popupEliminar?id=".$this->id."' class='popupDialog'>
                            <div class='popupArea'>
                            <div class='contenedorPopup'>
                                <div class='tituloPopup'>
                                    <div class='vacio'></div>
                                    <a class='descPopup' style='font-size: 18px;'><strong>PRECAUCIÓN</strong></a>
                                    <a href='#cerrarPopup' class='cerrarPopup' id='cerrarPopup'><img src='./images/icons/icon-close.png' style='width: 15px;'></a>      
                                </div>
                                <div class='texto'>
                                   <a>Precaución, ".$this->nombre." será eliminado permanentemente, ¿Continuar?</a>
                                </div>
                                <div class='texto'>
                                    <div class='customMenuPopup'>
                                        <div class='cerrarPopup'>
                                            <a href='#cerrar' title='Cerrar' class='cerrar' style='text-decoration: none; color:black;' >NO</a>
                                        </div>
                                        <div class='cerrarPopup'>                                        
                                            <a href='llamadas/borrarObjeto.php?id=".$this->id."' style='text-decoration: none; color:black;'>SI</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

    
                        </div>
                        </div>
                        ";
                     }

                       $html .= "</tr>";

            return $html;

    }

    public function obtenerUsuarioCreadorDesdeBD() {
        // Realizar consulta a la base de datos para obtener la id del creador
        $conexion = new ConexionBBDD();
        $sql = "SELECT usuario_creador FROM ".$this->tabla." WHERE id=".$this->id;
        $res = $conexion->consulta($sql);
        list($usuario_creador) = mysqli_fetch_array($res);
        
        return $usuario_creador;
    }

    public function imprimeGaleria() {

        $usuarioCreador = $this->obtenerUsuarioCreadorDesdeBD();

        $html = "<div class='postObj'>
                    <div class='tituloPostObj'>
                        <a><strong>".$usuarioCreador."</strong></a>
                    </div>
                    <div class='fotoPostObj'>
                        <a href='#popupPublicacion?id=".$this->id."'>                        
                            <img src='".$this->carpetaFotos.$this->foto."'>
                        </a>
                    </div>
                    <div class='nombrePostObj'>
                        <a>".$this->nombre."</a>
                    </div>
                </div>
                <div id='popupPublicacion?id=".$this->id."' class='popupDialog'>
                        <div id='popupArea' class='popupArea-publicacion'>
                            <div class='contenedorPopup-publicacion'>
                                <div class='imagenPopup'>
                                    <img src='".$this->carpetaFotos.$this->foto."' style='height: 500px'>
                                </div>
                                <div class='descPublicacionPopup'>
                                    <div class='cerrarPublicacionPopup'>
                                        <a href='#cerrarPopup' class='cerrarPopup' id='cerrarPopup'>
                                            <img src='./images/icons/icon-close.png' style='width: 15px;'>
                                        </a>      
                                    </div>
                                    <div class='elementoContenidoPublicacionPopup'>
                                        <a>".$this->nombre." by ".$usuarioCreador."</a>
                                    </div>
                                    <div class='elementoContenidoPublicacionPopup'>
                                        <a>".$this->descripcion."</a>
                                    </div>
                                    <div class='elementoContenidoPublicacionPopup'>
                                        <a>".$this->categoria."</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>";
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
                        <td><img src='".$this->carpetaFotos.$this->foto."' style='width:200px'></td>
                        </tr></table>";

        return $html;

    }

    

}