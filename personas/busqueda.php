<?php
echo $link;
require('include/funciones.php');
require_once('../funciones.php');
require_once('../'.$conectar);
require('include/pagination.class.php');

$items = 20;
$page = 1;

$tabla = "persona";
$item = "Nombre";
$item1 = "Apellido";

include("motor.php");
?>