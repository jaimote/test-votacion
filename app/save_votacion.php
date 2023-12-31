<?php require('class/class_conexion.php'); ?>
<?php require('class/class_herramientas.php'); ?>
<?php require('class/class_votacion.php'); ?>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $response = array();

    $votacion = new Votacion($conexion);
    $valida = $votacion->validaVotacion($_POST);
    if(!$valida["error"]){

        $rut = $_POST["rut"];
        $existe = $votacion->existeVotacion($rut);
        
        if(COUNT($existe) == 0){
            $res = $votacion->save($_POST);
            $response = array(
                "mensaje" => $res['mensaje'],
                "error" => false
            );
        }else{
            $response = array(
                "mensaje" => 'El registro asociado al rut '.$rut.', ya existe',
                "error" => true
            );
        }
    }else{
        $response = $valida;
    }
    echo json_encode($response);
}else{
    echo json_encode(array(
        "error" => true,
        "mensaje" => 'Only Request POST'
    ));
}
?>