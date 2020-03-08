<?php include("../Connections/linkborra.php");?>
<?php
session_start(); 
if ($_SESSION["autentificado"] != "SI") { 
   	header("Location: ../index.php"); 
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