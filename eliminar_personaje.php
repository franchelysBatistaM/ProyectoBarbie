<?php
include 'funciones.php';

$personajes = cargarDatos('data/personajes.json');
$id = $_GET['id'];
unset($personajes[$id]);
$personajes = array_values($personajes); 
guardarDatos('data/personajes.json', $personajes);
header('Location: personajes.php');
exit;
?>
