<?php
require_once('../Connections/ServidorUB.php');
$age ='CH'.$_GET['a'];
$part = 6; //muestra la cantidad de participantes NO FUNCIONA DEL TODO
// mysqli_select_db($database_ServidorUB, $ServidorUB);
$query_ganadores = ' SELECT competencia FROM Obra WHERE competencia LIKE "'.$age.'%" ORDER BY fecha DESC LIMIT 0 , 4';
$ganadores = mysqli_query($link, $query_ganadores) or die(mysqli_error());
$ganadores_count = mysqli_num_rows($ganadores);

$results = array();
while($line = mysqli_fetch_assoc($ganadores)){
    $results[] = $line;
}
$query_competencias = ' SELECT * FROM competencia WHERE id_comp="'.$results[0]['competencia'].'" OR  id_comp="'.$results[1]['competencia'].'" OR  id_comp="'.$results[2]['competencia'].'" OR  id_comp="'.$results[3]['competencia'].'" ';
//echo $query_competencias;
$competencias = mysqli_query($link, $query_competencias);
if ($ganadores_count < 2) {
	header('Location: bienvenido.php');
	exit();
    die('Consulta no valida: ' . mysqli_error());
}
$row_competencias = mysqli_fetch_array($competencias);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Competencias año <?php echo $age ; ?></title>
</head>
<body>
<!-- safasfasfas -->
        <?php do { ?>
           <div class="container">
               <?php
        $obra_pre = 'SELECT * FROM Obra WHERE competencia LIKE "'.$age.'%" ORDER BY fecha DESC LIMIT 0 , 5';
        $ganadores_pre = mysqli_query($link, $obra_pre) or die(mysqli_error());
        $row_ganadores = mysqli_fetch_array($ganadores_pre);

        $idcomp = $row_competencias['id_comp'];
	if (substr($idcomp, -2,-1)== 0){
		$competencia = substr($idcomp,-1);
	} else if (substr($idcomp, -3,-2)== 0){
		$competencia = substr($idcomp,-2);
	} else {
		$competencia = substr($idcomp,-3);
	}
	?>
       <div class="competencia" id="c<?php echo $row_competencias['categoria']; ?>">
            <span class="numero">COMP <?php echo $competencia ; ?>)</span>
            <?php
	// Limitador de caracteres
		// Inicializamos las variables
	$tamano = 70; // tama�o m�ximo
	$contador = 0;
	$descripcion = $row_competencias['descripcion'];
		// Cortamos la cadena por los espacios
	$arraydescripcion = explode(' ',$descripcion);
	$descripcion = '';
		// Como quedar�a...
	// while($tamano >= strlen($descripcion) + strlen($arraydescripcion[$contador])){
	// 	$descripcion .= ' '.$arraydescripcion[$contador];
	// 	$contador++;
	// }
	$descriptor = explode("<ul>",$descripcion);
	//echo $descriptor[0]."<br>";
	// Fin de Limitador de caracteres
        ?>
        <span class="descr"><?php echo $descriptor[0]; ?></span>
        </div>
          <?php $query_ganadores= 'SELECT * FROM Obra WHERE competencia = "'.$idcomp.'" ORDER BY puesto ASC';
          //echo $query_ganadores;
	$ganadores = mysqli_query($link, $query_ganadores) or die(mysqli_error());
	$row_ganadores = mysqli_fetch_assoc($ganadores);
	$totalRows_ganadores = mysqli_num_rows($ganadores);
        ?>
        <div id="resultados">
         <?php if ($totalRows_ganadores == 0){ ?>
                <span class="persona">Desierto</span>
			<?php } else if ($totalRows_ganadores != 0) {
                            do {
		$query_persona = 'SELECT id_persona, Nombre, Apellido, Residencia, Nacionalidad FROM persona WHERE id_persona = " '.$row_ganadores["fk_particip"].'" ';
		$persona = mysqli_query($link, $query_persona) or die(mysqli_error());
		$row_persona = mysqli_fetch_assoc($persona);
                ?>
                <div class="rank">
                <span class="numero"><?php echo $row_ganadores["puesto"]; ?></span>
                <?php
	 if ($row_persona["Residencia"] != NULL){ ?>
	 <span class="persona"><?php echo $row_persona["Nombre"]." ".$row_persona["Apellido"]." (".$row_persona["Residencia"].", ".$row_persona["Nacionalidad"].")"; ?></span>
	 <?php } else { ?>
         <span class="persona"><?php echo $row_persona["Nombre"]." ".$row_persona["Apellido"]." - ".$row_persona["Nacionalidad"]."</span>";}?>
	 </div>
 <?php } while ($row_ganadores = mysqli_fetch_assoc($ganadores)); } ?>

            </div>
</div>
<?php } while ($row_competencias = mysqli_fetch_assoc($competencias));?>

<!-- FIN Tabla nueva-->

</body>
</html>
<?php
// mysql_free_result($anio);mysql_free_result($competencias);mysql_free_result($ganadores);
?>
