<?php require('../../app/class/class_conexion.php'); ?>
<?php require('../../app/class/class_herramientas.php'); ?>
<?php require('../../app/class/class_votacion.php'); ?>
<?php require('../../app/class/class_localidad.php'); ?>
<?php require('../../app/class/class_candidato.php'); ?>
<?php

$localidad = new Localidad($conexion);
$candidato = new Candidato($conexion);
$votacion = new Votacion($conexion);

$candidatos = $candidato->getCandidatos();
$regiones = $localidad->getRegiones();

?>