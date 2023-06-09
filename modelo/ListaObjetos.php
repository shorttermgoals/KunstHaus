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
            $sqlBusca = " WHERE id LIKE '%".$txt."%' OR nombre LIKE '%".$txt."%' OR color LIKE '%".$txt."%' OR material LIKE '%".$txt."%' OR categoria LIKE '%".$txt."%' OR coleccion LIKE '%".$txt."%' OR usuario_creador LIKE '%".$txt."%'";
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

    public function obtenerElementosParaPerfil($txt){

        $sqlBusca = "";
        if(strlen($txt)>0){
            $sqlBusca = " WHERE id_creador LIKE '%".$txt."%'";
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

        $html = "<div class='listaObj'>
                    <div class='filaListaObj'>
                        <div class='elementoListaObj-titulo'>
                            <a><strong>ID</strong></a>
                        </div>
                        <div class='elementoListaObj-titulo'>
                            <a><strong>Nombre</strong></a>
                        </div>
                        <div class='elementoListaObj-titulo'>
                            <a><strong>Descripción</strong></a>
                        </div>
                        <div class='elementoListaObj-titulo'>
                            <a><strong>F. Creación</strong></a>
                        </div>
                        <div class='elementoListaObj-titulo'>
                            <a><strong>Creador</strong></a>
                        </div>
                    </div>
                ";
            for($i=0;$i<sizeof($this->lista);$i++){

                $html .= $this->lista[$i]->imprimeteEnTr();
            }
        $html .= "</div>";

            return $html;

    }

    public function imprimirFigurasParaGaleria(){

            $html="";

            for($i=0;$i<sizeof($this->lista);$i++){

                $html .= $this->lista[$i]->imprimeGaleria();
            }
        
            return $html;

    }

    public function imprimirFigurasParaPerfil(){

        $html="";

        for($i=0;$i<sizeof($this->lista);$i++){

            $html .= $this->lista[$i]->imprimePerfil();
        }
    
        return $html;

}




}