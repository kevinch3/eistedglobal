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
$p = $_GET['p'];
$sugYear = date("Y");

mysqli_select_db($link, $database_ServidorUB);

$query_personas = "SELECT * FROM persona WHERE id_persona = '$p'";
$personas = mysqli_query($link, $query_personas) or die(mysql_error());
$row_personas = mysqli_fetch_assoc($personas);

$query_obra = "SELECT * FROM Obra WHERE fk_particip = '$p'";
$obras = mysqli_query($link, $query_obra) or die(mysql_error());
$row_obras = mysqli_fetch_assoc($obras);
?>
<html>
<head>
<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Muli:300,400" rel="stylesheet" type="text/css">
<link href="<?php echo $sitio; ?>diseno/diseno.css" rel="stylesheet" type="text/css">
<style>
input[type="text"], textarea {
min-height: 30px;
border-radius: 0;
padding: 15px;
width: 400px;
}
.izquierda{
float: left;
}
.derecha{
float: right;
width: 350px;
}
.sugerencias{background: #b8dbc1;font-weight: bolder;}
.sugcheck{
background: #bcc7e0;
padding: 3px;
display: inline-block;
margin: 2px;
}
</style>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" ></script>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $charset; ?>" />
</head>
<body style="height: 350px;">
<h3> <i class="fa fa-stack-exchange"></i> <?php echo $row_personas['Nombre']." ".$row_personas['Apellido'] ?> </h3>
<form method="POST" action="preview.php">
<div class="izquierda">
	Asunto:<br />
	<input type="text" name="asunto" size="20" ></input><br />
	Tu mensaje:<br />
	<textarea cols="40" rows="5" name="mensaje"> </textarea><br />

<input style="float: right;" class="boton-verde" type="submit" value="Enviar" />
</div>
<div class="derecha">
<h4>Sugerir competencias <?php echo $sugYear ; ?></h4>
<?

$query_cat = "SELECT nombre, id_cat FROM categoria";
$result_cat = mysqli_query($link, $query_cat);
while($row_cat = $result_cat->fetch_array()){$rows[] = $row_cat;}
 	$conjcomp = array();
  $competir = count($row_obras);
  do {
	array_push($conjcomp, dameCOMPETENCIA($row_obras['competencia'],$link,"categoria"));
  } while ($row_obras = mysqli_fetch_assoc($obras));
foreach($rows as $row_cat){
?>

<div class="sugcheck">
<?
if ($competir < 1){
} else if ($row_cat['id_cat'] == valorFRECUENTE($conjcomp)){ ?>
<div class="sugerencias">
<?php } else { ?>
<div>
<?php }?>
<input type="checkbox" name="CAT<?php echo $row_cat['id_cat']; ?>" value="<?php echo $row_cat['id_cat']; ?>"><?php echo $row_cat['nombre']; ?>
<br>
</div>
</div>
<?php }?>
<input type="hidden" name="nombre" size="20" value="<?php echo $row_personas['Nombre']." ".$row_personas['Apellido']; ?> "></input>
<input type="hidden" name="Email" size="20" value="<?php echo $row_personas['Email']; ?>"></input>
<input type="hidden" name="p" size="20" value="<?php echo $p; ?>"></input>
</form>
<br>
</div>
</h4>
</ul>
</body>
</html>
