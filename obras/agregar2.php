<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="ISO-8859-1">
</head>
<?php
require_once('../Connections/ServidorUB.php');
require_once('../funciones.php');
//
/* verificar la conexión */
if (mysqli_connect_errno()) {
    printf("Conexión fallida: %s\n", mysqli_connect_error());
    exit();
}
$eis = strtoupper(substr($_SESSION["edicion"],0,2));
?>
<body style="height: 275px!important; text-align: center;">
<?php
$a 				= $_GET['a'];
$exito 			= $_GET['exito'];
$nombre 		= htmlentities($_GET['nombre']);
$apellido 		= htmlentities($_GET['apellido']);
$participante	= $_GET['participante'];
$mod_particip	= htmlentities($_GET['mod_particip']);
$puesto 		= $_GET['puesto'];
$c				= $_GET['competencia'];
$nomobra		= htmlentities($_GET['nomobra']);
$fecha 			= date('Y-m-d H:i:s');


//redirigir si no tiene "#"
if (!eregi('#', $participante)) { ?>
	 <div class="mini">
	<h3> Vamos a agregar a "<?echo $participante;?>"</h3>
	<ul>
	<li><a href="../personas/agrega.php?redir=../obras/agregar.php&type=IND&a=<?php echo $a;?>&participante=<?php echo $participante; ?>"><i class="icon-user"></i>  Individuo </a></li>
	<li><a href="../personas/agrega.php?redir=../obras/agregar.php&type=GRU&a=<?php echo $a;?>&participante=<?php echo $participante; ?>"><i class="icon-group"></i>  Conjunto </a></li>
	</ul>
	</div>
<?php } else { ?>
	<p>Participante: <?php echo $participante; ?></p>
	<p>Puesto: <?php echo $puesto; ?></p>
	<p>Competencia: <?php echo $c ;?></p>
	<p>Nombre de obra:	<?php echo $nomobra ; ?></p>
	<p>mod_particip: <?php echo $mod_particip ; ?></p>
<?
//Separar el id_participante//
$idpart = strstr($participante, '#', true);
$ridpart = strstr($participante, ' ', FALSE);
//armar ID OBRA // id_obra //
mysql_select_db($database_ServidorUB, $ServidorUB);
$result = mysql_query("SELECT id_obra FROM `Obra` ORDER BY id_obra DESC LIMIT 1"); //En un solo paso hacemos y asignamos el recultado de la consulta a $result.
$resultado = mysql_result ($result, 0); //Extraemos el valor que nos interesa.
$id_obra = $resultado +1 ;
//
echo $id_obra;

//Si existe $idpart en el identificador de personas, completar con los datos y seguir, sino, que genere un alta de persona primero.
mysql_select_db($database_ServidorUB, $ServidorUB);

$consulta_persona="select * from persona where id_persona=".$idpart;
$result_persona=mysql_query($consulta_persona) or die (mysql_error());
if (mysql_num_rows($result_persona)>0)
{
mysql_select_db($database_ServidorUB, $ServidorUB);
$insert = "INSERT INTO `Obra` (`id_obra`, `fk_particip`, `mod_particip`, `puesto`, `competencia`, `nomobra`, `fecha`) VALUES ('$id_obra', '$idpart', '$mod_particip' , '$puesto', '$c', '$nomobra' ,'$fecha')";
mysql_query ($insert, $ServidorUB );
echo "<script type=\"text/javascript\"> window.location=\"agregar.php?a=$a&eis=$eis&exito=si&participante=$ridpart&id_part=$idpart&id_obra=$id_obra\"; </script>";
} else {
 echo "No Existen registros";}
 }
?>
</body>
</html>
