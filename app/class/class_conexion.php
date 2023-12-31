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
            $this->conector = 'Error de conexión';
            $error = $e->getMessage();
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

    public function execute($sql){
        try{
            if ($res = mysqli_query($this->conector, $sql)) {
                return array(
                    "mensaje" => "Se ejecuto correctamente",
                    "error" => false,
                );
            } else {
                throw new Exception($this->conector->error);
            }
        }catch(Exception $e){
            return array(
                "mensaje" => $e->getMessage(),
                "error" => $e->getMessage(),
            );
        }
    }


    public function __destroy(){
        mysqli_close($this->conector);
    }
}

$conexion = new Conexion();
?>