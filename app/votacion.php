<?php require('../../app/class_conexion.php'); ?>
<?php require('../../app/class_votacion.php'); ?>
<?php require('../../app/class_localidad.php'); ?>
<?php

$localidad = new Localidad($conexion);
$votacion = new Votacion($conexion);

$regiones = $localidad->getRegiones();

?>