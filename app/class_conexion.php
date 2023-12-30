<?php

class Conexion {
    private $usuario="root";
    private $clave="";
    private $bd="votacion";
    private $puerto="3306";
    private $servidor="localhost";
    public $sql;
    public $res;
    public $conector;

    public function __construct(){
        try{
            $this->conector = new mysqli($this->servidor, $this->usuario, $this->clave, $this->bd, $this->puerto);
        }catch(Exception $e){
            $error = $e->getMessage();
            die($error);
        }
    }

    public function get($sql){
        try{
            $res = mysqli_query($this->conector, $sql);
    
            if(mysqli_num_rows($res) > 0){
                $data = [];
                while($r = mysqli_fetch_array($res, MYSQLI_ASSOC)){
                    $data[] = $r;
                }
                return $data;
            }else{
                return [];
            }
        }catch(Exception $e){
            return $e->getMessage();
        }
    }
}

$conexion = new Conexion();
?>