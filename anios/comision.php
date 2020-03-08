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
// $c = $_GET['c'];
// $eisCcompare = substr($c,0,2);
$a = $_SESSION["a"];

// mysql_select_db($database_ServidorUB, $ServidorUB);
$query_anio = "SELECT * FROM anio WHERE Id_anio='$a'";
$anio = mysqli_query($link, $query_anio) or die(mysql_error());
$row_anio = mysqli_fetch_assoc($anio);
$totalRows_anio = mysqli_num_rows($anio); ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="../style.css" rel="stylesheet" type="text/css">
<link href="../style2.css" rel="stylesheet" type="text/css">
<link href="../boton.css" rel="stylesheet" type="text/css">
<style type="text/css" media="all">@import "../../shadowbox/shadowbox.css";</style>


<style type="text/css">
option {font-family: verdana; color: black}
option.Poesia {background-color: #eaeaf4;  color: #000;}
option.Prosa {background-color: #fefefe}
option.Recitacion {background-color: #eaeaf4}
option.dos {background-color: #fefefe}
SELECT.css{ font-family: verdana; color: white; background-color:#666;}
</style>
<style type="text/css">
div.selectBox {
   position: relative;
   width: 230px;
   height: 22px;
   border: 1px solid #036;
   background: url(http://www.cmacias.com/wp-content/uploads/2009/button.png) 210px center no-repeat;
}
   div.selectBox div.box {
      position: absolute;
      left: 3px;
      top: 3px;
      width: 200px;
      height: 16px;
      line-height: 16px;
      font-family: arial;
      font-size: 11px;
      color: #036;
      overflow: hidden;
   }
   div.selectBox select {
	position: absolute;
	left: -1px;
	top: -1px;
	width: 220px;
	height: 24px;
	border: 1px solid #036;
	opacity: 0;
	filter: alpha(Opacity=0);
	-moz-opacity: 0;
	cursor: pointer;
	z-index:100;
   }
      div.selectBox select option{
         padding: 4px;
         font-size: 11px;
         color: #036;
         border-bottom: 1px solid #eee;
         cursor: pointer;
      }
      div.selectBox select option.ultimo{
         border-bottom: 0px none;
      }
</style>


<body>
<center>
<h1><?php echo $a;?></h1>
<p><img src="../<?php echo $row_anio['comisionimg'] ; ?>" width="320" /> <br>
  <?php echo $row_anio['comision']; ?></p>
<div class="oce-first" align="center"><a href="comisionmodificar.php?a=<?php echo $a ; ?>" rel="shadowbox"><p>Modificar</p></a>
</div>
</center>

<p>&nbsp;</p>
</body>
</html>
<?php
mysqli_free_result($anio);
?>
