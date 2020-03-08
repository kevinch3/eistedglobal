<?
require_once('../Connections/ServidorUB.php');
$noauth = TRUE;
require_once('../funciones.php');
$age=$_GET[a];
$eis= strtoupper(substr($_GET[eis],0,2));

if (empty($eis) or empty($a)){
echo "<h3> Hubo un error con la consulta. </h3><br><h4>No se puede continuar</h4>";
exit();
}

$eisteddfod_date = "2013-03-03";

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_competencias = 20;
$pageNum_competencias = 0;
if (isset($_GET['pageNum_competencias'])) {
  $pageNum_competencias = $_GET['pageNum_competencias'];
}
$startRow_competencias = $pageNum_competencias * $maxRows_competencias;

mysql_select_db($database_ServidorUB, $ServidorUB);
$query_competencias = "SELECT * FROM competencia WHERE id_comp  LIKE '".$eis.$age."%%%' ORDER BY id_comp ASC";
$query_limit_competencias = sprintf("%s LIMIT %d, %d", $query_competencias, $startRow_competencias, $maxRows_competencias);
$competencias = mysql_query($query_limit_competencias, $ServidorUB) or die(mysql_error());
$row_competencias = mysql_fetch_assoc($competencias);

if (isset($_GET['totalRows_competencias'])) {
  $totalRows_competencias = $_GET['totalRows_competencias'];
} else {
  $all_competencias = mysql_query($query_competencias);
  $totalRows_competencias = mysql_num_rows($all_competencias);
}
$totalPages_competencias = ceil($totalRows_competencias/$maxRows_competencias)-1;


$queryString_competencias = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_competencias") == false && 
        stristr($param, "totalRows_competencias") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_competencias = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_competencias = sprintf("&totalRows_competencias=%d%s", $totalRows_competencias, $queryString_competencias);


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style>
.copyright{
margin: 0 auto;
padding: 15px;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<?php include("scripts.php") ;?>
<title>Competencias a�o <?php echo $age ; ?></title>
</head>
<body>

<!-- Tabla nueva-->

<div id="header" align="center">
<div align="center" style="background-color:#F1F6FA; width:100% float:left; clear:both;clear:left;"> 
<h1>Listado de Competencias </h1>
<h2><?php echo txtEIS($eis)." ".$age ; ?></h2>
</div>
<div id="page-wrap">
<table id="report">
        <tr>
            <th>#</th>
            <th>Categor&iacute;a</th>
            <th>Descripci&oacute;n</th>
			<th>+ Info</th>
            <th>Idioma</th>
            <th></th>
        </tr>
        <?php 
		 do {
$idcomp = $row_competencias['id_comp'];
$competencia = acortameCOMP($idcomp);

$cat = $row_competencias['categoria'];	
$SQL3 = "SELECT * FROM categoria WHERE id_cat ='$cat'";
$QUERY3 =  mysql_query ($SQL3);
$categ = mysql_fetch_array($QUERY3);
?>
        <tr>
            <td><b><?php echo $competencia ; ?></b></td>
            <td><?php echo $categ[nombre]; ?></td>
			<td><kp><?php
	echo strip_tags(acortameDESCR($row_competencias['descripcion']));
	?></kp></td>
	<td><a href="../competencias/cli_info.php?c=<?php echo $row_competencias['id_comp'];?>" rel="shadowbox;height=370;width=600"> <img src="https://cdn0.iconfinder.com/data/icons/feather/96/magnifying-glass-256.png" width="20px"/></a></td>
            <td><?php if ($row_competencias['idioma'] == "Cymraeg"){?>
            <img src="flag/wales.gif" title="Cymraeg / Gal�s"/>
                <?
                } else if ($row_competencias['idioma'] == "Castellano"){ ?>	
            <img src="flag/ar.gif" title="Sbaeneg / Spanish / Espa�ol"/>
                <?php } else {
					echo " ";
				}?>	</td>
            <td><div class="arrow"></div></td>
        </tr>
		<tr></tr>
<?php /*
if (strtotime($eisteddfod_date) > strtotime('now') ) { ?>
    <tr>
        <td colspan="5">
					<?php if ($row_competencias['cont'] != NULL){
	  echo "<li><p><b>Contenido: </b>".$row_competencias['cont']."</p></li>";
	  }?>      
	  <?php if ($row_competencias['extra'] != NULL){
	  echo "<li><p><b>Descarga: </b><a href=\"".$row_competencias['extra']."\"><img src=\"../iconos/pdf.png\" /> Contenido adicional. </a></p></li>"; 
				  }?>
      
                    <?
    $query_ganadores = "SELECT * FROM Obra WHERE competencia = '$idcomp' ORDER BY puesto ASC" ;
	
	$ganadores = mysql_query($query_ganadores, $ServidorUB) or die(mysql_error());
	
	$row_ganadores = mysql_fetch_assoc($ganadores);
	$totalRows_ganadores = mysql_num_rows($ganadores);
		?>
        <?php if ($totalRows_ganadores == 0){
			echo "Desierto";
			} else if ($totalRows_ganadores != 0) {
				if ($totalRows_ganadores == 1){
					echo "<h4>".$totalRows_ganadores." Ganador</h4>";
				} else {
					echo "<h4>".$totalRows_ganadores." Ganadores</h4>";}
			do {
			
		$query_persona = "SELECT id_persona, Nombre, Apellido, Residencia, Nacionalidad FROM persona WHERE id_persona = \"".$row_ganadores["fk_particip"]."\"";
		$persona = mysql_query($query_persona, $ServidorUB) or die(mysql_error());
		$row_persona = mysql_fetch_assoc($persona);
	
	
	$vid = $row_ganadores["VIDEOURLS"];
	$videourl = explode(',', $vid);
	$img = $row_ganadores["PHOTOURLS"];
	$imgurl = explode(',', $img);?>
    
     
     <?php 
	 echo "<b>".$row_ganadores["puesto"].") </b>";
	 if ($row_persona["Residencia"] != NULL){
	 echo $row_persona["Nombre"]." ".$row_persona["Apellido"]." (".$row_persona["Residencia"].", ".$row_persona["Nacionalidad"].")"; 
	 } else {
		 echo $row_persona["Nombre"]." ".$row_persona["Apellido"]." - ".$row_persona["Nacionalidad"]; }?>
     <?
	 if ($vid != NULL){
	 	for($j=0;$j<count($videourl);$j++){
	 echo "|| <a href=\"http://www.youtube.com/v/".$videourl[$j]."\"  class=\"screenshot\" id=\"http://i.ytimg.com/vi/".$videourl[$j]."/default.jpg\" rel=\"shadowbox;width=640;height=480\"><img src=\"icon_popup.gif\"></a>";
		}
		}?>
       
	<?php echo "<br />";
	} while ($row_ganadores = mysql_fetch_assoc($ganadores));
	}
	?> 
		</td>
    </tr>
	
		<?php } else { ?>
	<tr>
		<td colspan="5">
			<p>No data: Edicion Futura</p>
		</td>
	</tr>
		<?php } */?>
	
        <?php } while ($row_competencias = mysql_fetch_assoc($competencias));?>
    </table>
    </div>
    </div>
<!-- FIN Tabla nueva-->
   <div align="center" style="background-color:#F1F6FA; width:100%; 
   position:fixed ; bottom:0 ; right:0 ; left:0 ; overflow:auto ; text-align:center ;
	border:1px solid #000000;"> 
<div id="tnt_pagination"><?php if ($pageNum_competencias > 0) { // Show if not first page ?>
      <a href="<?php printf("%s?pageNum_competencias=%d%s", $currentPage, 0, $queryString_competencias); ?>">Primero</a>
      <?php } else { ?> <span class="disabled_tnt_pagination">Anterior</span> <?php ;}// MUESTRA SI ES PRIMERA PAG ?>
	  
	  <?php if ($pageNum_competencias > 0) { // Show if not first page ?>
      <a href="<?php printf("%s?pageNum_competencias=%d%s", $currentPage, max(0, $pageNum_competencias - 1), $queryString_competencias); ?>">Anterior</a>
      <?php } // Show if not first page ?>
      
      <?php if ($pageNum_competencias < $totalPages_competencias) { // Show if not last page ?>
      <a href="<?php printf("%s?pageNum_competencias=%d%s", $currentPage, min($totalPages_competencias, $pageNum_competencias + 1), $queryString_competencias); ?>">Siguiente</a>
      <?php } // Show if not last page ?>
     
      <?php if ($pageNum_competencias < $totalPages_competencias) { // Show if not last page ?>
      <a href="<?php printf("%s?pageNum_competencias=%d%s", $currentPage, $totalPages_competencias, $queryString_competencias); ?>">&Uacute;ltimo</a>
      <?php } else { ?><span class="disabled_tnt_pagination">Siguiente</span> <?php ;} // Show if not last page ?>
</div>

</div>
<div align="center">
			<p>Este contenido es perteneciente a la Asociaci&oacuten del Eisteddfod del Chubut.</p>
			<p><?php echo dameVERSION() ?></p>
</div>
</body>
</html>
<?php
mysql_free_result($anio);

mysql_free_result($competencias);

mysql_free_result($ganadores);
?>
