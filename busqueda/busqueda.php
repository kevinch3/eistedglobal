<?php include("../Connections/linkborra.php");?>
<?php

//Inicio la sesión 
session_start(); 
//COMPRUEBA QUE EL USUARIO ESTA AUTENTIFICADO 
if ($_SESSION["autentificado"] != "SI") { 
   	//si no existe, envio a la página de autentificacion 
   	header("Location: ../index.php"); 
   	//ademas salgo de este script 
   	exit(); 
}
	$host = $servidor;
	$user = $username;
	$pass = $password;
	$db = $database;
        
require('include/conexion.php');

require('include/pagination.class.php');

$items = 20;
$page = 1;

$tabla = "competencia";
$item = "descripcion";

include("motor.php");
?>