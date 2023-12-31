<?php

class Localidad {
    private $conn;

    public function __construct($conn){
        $this->conn = $conn;    
    }

    public function getRegiones(){
        $sql = 'SELECT id, nombre FROM region ORDER BY nombre ASC';
        $resultado = $this->conn->get($sql);

        return $resultado;
    }

    public function getComunas($region){
        $sql = 'SELECT id, nombre FROM comuna WHERE region_id = '.$region.' ORDER BY nombre ASC';
        $resultado = $this->conn->get($sql);

        echo json_encode($resultado);
    }
}
?>