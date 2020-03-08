<?php require_once('../Connections/ServidorUB.php');
   $anio = date("Y");
   $in=$_GET['in'];
   mysqli_query($link, "UPDATE inscriptos SET baja = '1' WHERE id_inscripto = $in ");
   header("Location: ver.php?a=$anio");
?>
