<?php require('../../app/localidad.php'); ?>
<?php

$region = $_GET['region'];

$localidad->getComunas($region);

?>