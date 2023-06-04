<?php


class ListaObjetos{

    private $lista;
    private $tabla;


    public function __construct(){

        $this->lista = array();
        $this->tabla = "objetokunst";
    }

    public function obtenerElementos($txt = ""){

        $sqlBusca = "";
        if(strlen($txt)>0){
            $sqlBusca = " WHERE nombre LIKE '%".$txt."%' OR color LIKE '%".$txt."%' OR material LIKE '%".$txt."%' OR categoria LIKE '%".$txt."%' OR coleccion LIKE '%".$txt."%'";
        }

        $sql = "SELECT * FROM ".$this->tabla." ".$sqlBusca.";";

        $conexion = new ConexionBBDD();
        $res = $conexion->consulta($sql);

        while( list($id, $nombre, $color, $material, $categoria, $coleccion, $descripcion, $fcreacion, $foto) = mysqli_fetch_array($res) ){

            $fila = new ObjetoKunst($id, $nombre, $color, $material, $categoria, $coleccion, $descripcion, $fcreacion, $foto);
            array_push($this->lista,$fila);
            //$this->lista[] = $fila;

        }

    }


    public function imprimirFigurasEnBack(){

        $html = "<table>";
        $html .= "<tr><th>ID</th>
                        <th>Nombre</th>
                        <th>Color</th>
                        <th>Material</th>
                        <th>Categoria</th>
                        <th>Colección</th>
                        <th>Descripción</th>
                        <th>Fecha de creación</th>
                        <th>Foto</th>
                        <th colspan='3'></th></tr>";
            for($i=0;$i<sizeof($this->lista);$i++){

                $html .= $this->lista[$i]->imprimeteEnTr();
            }
        $html .= "</table>";

            return $html;

    }

    public function imprimirFigurasParaGaleria(){

            $html="";

            for($i=0;$i<sizeof($this->lista);$i++){

                $html .= $this->lista[$i]->imprimeGaleria();
            }
        
            return $html;

    }




}