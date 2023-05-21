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
            $sqlBusca = " WHERE nombre LIKE '%".$txt."%'";
        }

        $sql = "SELECT * FROM ".$this->tabla." ".$sqlBusca.";";

        $conexion = new ConexionBBDD();
        $res = $conexion->consulta($sql);

        while( list($id, $nombre, $username, $mail, $pass, $permiso) = mysqli_fetch_array($res) ){

            $fila = new Usuario($id, $nombre, $username, $mail, $permiso);
            array_push($this->lista,$fila);
            //$this->lista[] = $fila;

        }

    }


    public function imprimirFigurasEnBack(){

        $html = "<table>";
        $html .= "<tr><th>ID</th>
                        <th>Nombre</th>
                        <th>Username</th>
                        <th>Mail</th>
                        <th>Permiso</th>
                        <th colspan='3'></th></tr>";
            for($i=0;$i<sizeof($this->lista);$i++){

                $html .= $this->lista[$i]->imprimeteEnTr();
            }
        $html .= "</table>";

            return $html;

    }




}