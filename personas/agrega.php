<?php
require_once('../dominio.php');
$type 	= 	$_GET['type'];
$redir 	= 	$_GET['redir'];
// $a 		=	$_GET['a'];

if(isset($_GET['exito'])){
	$exito = $_GET['exito'];
} else {
	$exito = NULL;
}


if(isset($_GET['participante'])){
	$participante = $_GET['participante'];
} else {
	$participante = NULL;
}

require_once('../Connections/ServidorUB.php');
if ($type === "IND"){
		if (isset($exito)){
			include_once('ind_agrega.php?exito=$exito');
		} else {
			include_once('ind_agrega.php');
		}
} else if ($type === "GRU"){
		if (isset($exito)){
			include_once('gru_agrega.php?exito=$exito');
		} else {
			include_once('gru_agrega.php');
		}
	} else {
		echo "Error: No se sabe que agregar";
	}
?>
