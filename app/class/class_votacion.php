<?php

class Votacion extends Herramientas{
    private $conn;
    public function __construct($conn){
        $this->conn = $conn;    
    }

    public function validaVotacion($post){
        extract($post);
        
        $data = array();
        if(!isset($nombre)){
            $valida = array(
                "campo" => "nombre",
                "mensaje" => "El campo no existe"
            );
            $data[] = $valida;
        }else{
            if(strlen(trim($nombre)) == 0){
                $valida = array(
                    "campo" => "nombre",
                    "mensaje" => "Complete el campo"
                );
                $data[] = $valida;
            }
        }
        if(!isset($alias)){
            $valida = array(
                "campo" => "alias",
                "mensaje" => "El campo no existe"
            );
            $data[] = $valida;
        }else{
            if(strlen(trim($alias)) < 5){
                $valida = array(
                    "campo" => "alias",
                    "mensaje" => "El campo debe de ser al menos de 5 caracteres"
                );
                $data[] = $valida;
            }
        }
        if(!isset($rut)){
            $valida = array(
                "campo" => "rut",
                "mensaje" => "El campo no existe"
            );
            $data[] = $valida;
        }else{
            if(strlen(trim($rut)) < 1){
                $valida = array(
                    "campo" => "rut",
                    "mensaje" => "Ingrese un rut"
                );
                $data[] = $valida;
            }else{
                $valida = parent::validarRut($rut);
                if($valida["error"]){
                    $valida = array(
                        "campo" => "rut",
                        "mensaje" => $valida["msj"]
                    );
                    $data[] = $valida;
                }
            }
        }
        if(!isset($email)){
            $valida = array(
                "campo" => "email",
                "mensaje" => "El campo no existe"
            );
            $data[] = $valida;
        }else{
            if(strlen(trim($email)) == 0){
                $valida = array(
                    "campo" => "email",
                    "mensaje" => "Complete el campo"
                );
                $data[] = $valida;
            }else{
                $valida = parent::validarEmail($email); 
                if(!$valida){
                    $valida = array(
                        "campo" => "email",
                        "mensaje" => "El email no escorrecto"
                    );
                    $data[] = $valida;
                }
            }
        }
        if(!isset($region)){
            $valida = array(
                "campo" => "region",
                "mensaje" => "El campo no existe"
            );
            $data[] = $valida;
        }else{
            if(strlen(trim($region)) == 0){
                $valida = array(
                    "campo" => "region",
                    "mensaje" => "Complete el campo"
                );
                $data[] = $valida;
            }
        }
        if(!isset($comuna)){
            $valida = array(
                "campo" => "comuna",
                "mensaje" => "El campo no existe"
            );
            $data[] = $valida;
        }else{
            if(strlen(trim($comuna)) == 0){
                $valida = array(
                    "campo" => "comuna",
                    "mensaje" => "Complete el campo"
                );
                $data[] = $valida;
            }
        }
        if(!isset($candidato)){
            $valida = array(
                "campo" => "candidato",
                "mensaje" => "El campo no existe"
            );
            $data[] = $valida;
        }else{
            if(strlen(trim($candidato)) == 0){
                $valida = array(
                    "campo" => "candidato",
                    "mensaje" => "Complete el campo"
                );
                $data[] = $valida;
            }
        }
        if(!isset($nosotros)){
            $valida = array(
                "campo" => "nosotros",
                "mensaje" => "El campo no existe"
            );
            $data[] = $valida;
        }else{
            if(strlen(trim($nosotros)) == 0){
                $valida = array(
                    "campo" => "nosotros",
                    "mensaje" => "Complete el campo"
                );
                $data[] = $valida;
            }
        }
        if(empty($data)){
            $salida = array(
                "error" => false,
                "mensaje" => 'No se encontraron Errores',
                "resultado" => $data
            );
        }else{
            $salida = array(
                "error" => true,
                "mensaje" => 'Errores encontrados',
                "resultado" => $data
            );
        }
        return $salida;
    }

    public function existeVotacion($rut){
        $sql = 'SELECT id FROM votacion WHERE rut = "'.$rut.'"';
        $resultado = $this->conn->get($sql);

        return $resultado;
    }
    
    public function save($votacion){
        $sql = "INSERT INTO votacion (
            nombre, 
            alias, 
            rut, 
            email, 
            region_id, 
            comuna_id, 
            candidato_id, 
            nosotros) 
        VALUES (
            '".$votacion['nombre']."', 
            '".$votacion['alias']."', 
            '".$votacion['rut']."', 
            '".$votacion['email']."', 
            '".$votacion['region']."', 
            '".$votacion['comuna']."', 
            '".$votacion['candidato']."', 
            '".$votacion['nosotros']."')";
        $res = $this->conn->execute($sql);
        $salida = array();
        if(!$res["error"]){
            $salida = array(
                "mensaje" => "Se registro correctamente la votación"
            );
        }else{
            $salida = array(
                "mensaje" => "Existe un error en la votación, contacta al administrador"
            );
        }
        return $salida;
    }
}
?>