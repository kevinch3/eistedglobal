<?php 
require_once('../Connections/ServidorUB.php');
$age =$_GET['a'];

$startRow_competencias = $pageNum_competencias * $maxRows_competencias;
mysql_select_db($database_ServidorUB, $ServidorUB);
$query_competencias = "SELECT * FROM competencia WHERE fk_anio='$age' ORDER BY id_comp ASC";
$competencias = mysql_query($query_competencias, $ServidorUB) or die(mysql_error());
$row_competencias = mysql_fetch_assoc($competencias);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>Competencias a�o <?php echo $age ; ?></title>
</head>
<body>
    
        <?php 
		 do {
	$idcomp = $row_competencias['id_comp'];
		if (substr($idcomp, -2,-1)== 0){
			$competencia = substr($idcomp,-1);
		} else if (substr($idcomp, -3,-2)== 0){
			$competencia = substr($idcomp,-2);
		} else {
			$competencia = substr($idcomp,-3);
		}
		
	$cat = $row_competencias['categoria'];	
	$SQL3 = "SELECT * FROM categoria WHERE id_cat ='$cat'";
	$QUERY3 =  mysql_query ($SQL3);
	$categ = mysql_fetch_array($QUERY3);
	?> <ul>   
            <b><?php echo $competencia ; ?></b>
            <?php echo $categ[nombre]; ?>
            <?php
	// Limitador de caracteres
		// Inicializamos las variables
	$tamano = 70; // tama�o m�ximo
	$contador = 0;
	$descripcion = $row_competencias['descripcion'];
		// Cortamos la cadena por los espacios
	$arraydescripcion = split(' ',$descripcion);
	$descripcion = '';
		// Como quedar�a...
	while($tamano >= strlen($descripcion) + strlen($arraydescripcion[$contador])){
		$descripcion .= ' '.$arraydescripcion[$contador];
		$contador++;
	}
	$descriptor = explode("<ul>",$descripcion);
	echo $descriptor[0];
	// Fin de Limitador de caracteres
	
			$query_ganadores = "SELECT * FROM Obra WHERE competencia = ".$idcomp." ORDER BY puesto ASC" ;
			$ganadores = mysql_query($query_ganadores, $ServidorUB) or die(mysql_error());
			$row_ganadores = mysql_fetch_assoc($ganadores);
			$totalRows_ganadores = mysql_num_rows($ganadores);
			
			if ($totalRows_ganadores != 0){
		?><ul><?
			do {
			$query_persona = "SELECT id_persona, Nombre, Apellido, Residencia, Nacionalidad FROM persona WHERE id_persona = \"".$row_ganadores["fk_particip"]."\"";
			$persona = mysql_query($query_persona, $ServidorUB) or die(mysql_error());
			$row_persona = mysql_fetch_assoc($persona);
		?>
		<li><?
			echo "<b>".$row_ganadores["puesto"].") </b>";
			if ($row_persona["Residencia"] != NULL){
			echo $row_persona["Nombre"]." ".$row_persona["Apellido"]." (".$row_persona["Residencia"].", ".$row_persona["Nacionalidad"].")"; 
			} else {
			echo $row_persona["Nombre"]." ".$row_persona["Apellido"]." - ".$row_persona["Nacionalidad"]; }
		?></li>
		<?} while ($row_ganadores = mysql_fetch_assoc($ganadores));?></ul>
		<?}
		?>	
		</ul>
		<?} while ($row_competencias = mysql_fetch_assoc($competencias));
		?>
		
		

<!-- FIN Tabla nueva-->
   
</body>
</html>
<?php
mysql_free_result($anio);mysql_free_result($competencias);mysql_free_result($ganadores);
?>
