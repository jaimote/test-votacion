<?php require('../../app/localidad.php'); ?>
<?php

if($_SERVER['REQUEST_METHOD'] == 'GET'){   
    $region = $_GET['region'];
    
    $localidad->getComunas($region);
}else{
    echo json_encode(array(
        "error" => true,
        "mensaje" => 'Only Request GET'
    ));
}

?>