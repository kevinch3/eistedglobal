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

mysqli_select_db($link, $database_ServidorUB);
$query_personas = "SELECT * FROM persona WHERE id_persona = '$p'";
$personas = mysqli_query($link, $query_personas) or die(mysql_error());
$row_personas = mysqli_fetch_assoc($personas);

mysqli_select_db($link, $database_ServidorUB);
$query_obra = "SELECT * FROM `Obra` WHERE fk_particip = '$p'";
$obras = mysqli_query($link, $query_obra) or die(mysql_error());
$row_obras = mysqli_fetch_assoc($obras);
$contar_obras = count($row_obras);
?>
<html>
<head>

<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Muli:300,400" rel="stylesheet" type="text/css">
<link href="<?php echo $sitio; ?>diseno/diseno.css" rel="stylesheet" type="text/css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" ></script>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $charset; ?>" />

</head>
<body style="height: 350px;">
<h2><?php echo htmlentities($row_personas['Nombre'],ENT_QUOTES | ENT_IGNORE, "$charset")." ".htmlentities($row_personas['Apellido'],ENT_QUOTES | ENT_IGNORE, "$charset"); ?> </h2>
<?php
if ($contar_obras == 0){
echo "Actualmente no ha participado, es buen momento para recordarle que existimos con un email <i class=\"fa fa-smile-o\"></i>.";
} else {?>
<ul>
<?php do { ?>
		<li style="background: #bcc7e0;">
		<p>
      <a href="../obras/comp_test.php?a=<?php echo anioCOMP($row_obras['competencia']).'#'.acortameCOMP($row_obras['competencia']);?>" target="_parent">
        Comp. <?php echo acortameCOMP($row_obras['competencia']); ?>
      </a>
      <?php echo '['.dameCATEGORIA(dameCOMPETENCIA($row_obras['competencia'],$link,'categoria'),$link,"nombre").'] Año: '.anioCOMP($row_obras['competencia']).' Puesto: '.$row_obras['puesto'];?>
    </p>
		<p></p>
		</li>
<?php } while ($row_obras = mysqli_fetch_assoc($obras));
}?>
</ul>
</body>
</html>
