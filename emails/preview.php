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

if (isset($_POST['p'])) {
 $p = $_POST['p'];
} else {
  echo "persona no definida";
}
//$sugYear = date("Y");
$sugYear = $_SESSION["a"];
$Email = $_POST['Email'];

$query_personas = "SELECT * FROM persona WHERE id_persona = '$p'";
$personas = mysqli_query($link, $query_personas) or die(mysqli_error());
$row_personas = mysqli_fetch_assoc($personas);

$query_obra = "SELECT * FROM `Obra` WHERE fk_particip = '$p'";
$obras = mysqli_query($link, $query_obra) or die(mysqli_error());
$row_obras = mysqli_fetch_assoc($obras);
$GETABX = NULL;
//DINAMIZAR CANTIDAD DE CATEGORIAS

for ($i = 1; $i <= 13; $i++) { //Se buscan todos los valores de las categorías
	if (isset($_POST['CAT'.$i])){ //se descartan los valores vacíos
   $GETABX = $GETABX."&CAT$i=".$_POST["CAT$i"];
   //echo $GETABX;
  }
}

$uri = "emails/prefuncion.php?eis=$eis&Email=$Email";
$url = $sitio.$uri.$GETABX;
$stream = fopen($url, 'r');
stream_set_timeout($stream, 20);
$page = stream_get_contents($stream);
fclose($stream);
?>

<?
$texto= "
<html>
<head>
<link href=\"//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css\" rel=\"stylesheet\">
<link href=\"//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css\" rel=\"stylesheet\">
<link href=\"http://fonts.googleapis.com/css?family=Muli:300,400\" rel=\"stylesheet\" type=\"text/css\">
<link href=\"".$sitio."diseno/diseno.css\" rel=\"stylesheet\" type=\"text/css\">
<style>
input[type=\"text\"], textarea {
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
a{
color: black;}
.sugerencias{background: #b8dbc1;font-weight: bolder;}
.sugcheck{
background: #bcc7e0;
padding: 3px;
display: inline-block;
margin: 2px;
}
.categoria{
font-weight: bold;
}
</style>
<script src=\"//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js\" ></script>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$charset\" />
</head>
<body style=\"height: 600px;\">
<div class=\"wrapper\">
<h4>".$_POST['asunto']."</h4>
<p>".htmlentities($_POST['mensaje'],ENT_QUOTES | ENT_IGNORE, $charset)."</p>
<img src=\"http://ils.unc.edu/daniel/gifs/lines/guitarlin.gif\" />
<p>".$page."</p>
<br>
<br>


<li class=\"categoria\">
</li>
</div>
<pre>
Este mensaje es para <b>".$_POST['nombre']."</b>. En caso de ser erroneo por favor desestime o <a href=\"unsuscribe.php\" style=\"color: black;\">denuncie este mensaje</a>.
Si no desea seguir recibiendo correo electronico por parte de la Asociaci&oacute;n, <a href=\"unsuscribe.php\" style=\"color: black;\"> haga clic aqu&iacute;</a>
<br>
No responda directamente este mensaje, en caso de ser necesario remitirse a: <a style=\"color: black;\" href=\"mailto:secretaria@eisteddfod.org.ar\">secretaria@eisteddfod.org.ar</a>
</br>
Asociacion del Eisteddfod del Chubut - ".$sugYear."<br>
".dameVERSION()."</pre>

</body>
</html>
";
echo $texto;
$_SESSION['texto-mail'] = $texto;
?>
<div style="position: fixed; width: 100%; bottom: 0; background: #4A64A8;">
	<div style="text-align:center">
    <a href="javascript:history.back(1)"><i class="fa fa-pencil-square-o"></i> Continuar editando</a> |
    <a href="send.php?send=ok&asunto=<?php echo $_POST['asunto']; ?>&Email=<?php echo $Email; ?>"><i class="fa fa-envelope-o"></i> Enviar</a></div>
</div>
