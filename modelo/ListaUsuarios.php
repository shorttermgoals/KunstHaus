<?php


class ListaUsuarios{

    private $lista;
    private $tabla;


    public function __construct(){

        $this->lista = array();
        $this->tabla = "usuarios";
    }

    public function obtenerElementos($txt = ""){

        $sqlBusca = "";
        if(strlen($txt)>0){
            $sqlBusca = " WHERE id LIKE '%".$txt."%' OR nombre LIKE '%".$txt."%' OR username LIKE '%".$txt."%' OR mail LIKE '%".$txt."%'";
        }

        $sql = "SELECT * FROM ".$this->tabla." ".$sqlBusca.";";

        $conexion = new ConexionBBDD();
        $res = $conexion->consulta($sql);

        while( list($id, $nombre, $username, $mail, $pass, $permiso) = mysqli_fetch_array($res) ){

            $fila = new Usuario($id, $nombre, $username, $mail, $pass, $permiso);
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
                <a><strong>Mail</strong></a>
            </div>
            <div class='elementoListaObj-titulo'>
                <a><strong>Username</strong></a>
            </div>
            <div class='elementoListaObj-titulo'>
                <a><strong>Permiso</strong></a>
            </div>
        </div>";
            for($i=0;$i<sizeof($this->lista);$i++){

                $html .= $this->lista[$i]->imprimeteEnTr();
            }
        $html .= "</div>";

            return $html;

    }




}