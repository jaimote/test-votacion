<?php

class Candidato {
    private $conn;

    public function __construct($conn){
        $this->conn = $conn;    
    }

    public function getCandidatos(){
        $sql = 'SELECT id, nombre, apellidos FROM candidato ORDER BY apellidos ASC, nombre ASC';
        $resultado = $this->conn->get($sql);

        return $resultado;
    }
}
?>