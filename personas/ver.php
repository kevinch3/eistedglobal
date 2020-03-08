<?php 
$type = $_GET['type'];
require_once('../Connections/ServidorUB.php'); 
if ($type === "IND"){
	echo "<h2> Ver Personas </h2>";
	include_once('ind_ver.php');
} else if ($type === "GRU"){
	echo "<h2> Ver Grupos de Personas </h2>";
	include_once('gru_ver.php');
	} else {
		echo "Error: No se sabe que Ver";
	}
	?>
