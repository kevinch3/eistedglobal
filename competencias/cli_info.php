<?php
require_once('../Connections/ServidorUB.php');
$noauth = TRUE;
require_once('../funciones.php');
//
/* verificar la conexi�n */
if (mysqli_connect_errno()) {
    printf("Conexi�n fallida: %s\n", mysqli_connect_error());
    exit();
}
///
if (isset($_GET['input'])){
  if ($_GET['input'] == "form"){
    if (strlen($_GET['id_comp']) < 3){
      $id_comp = "0".$_GET['id_comp'];
        if (strlen($id_comp) < 3){
        $id_comp = "0".$id_comp;
        if (strlen($id_comp) < 3){
        ?>
        <script language="javascript">
          self.location="cli_info.php#Error en competencia";
        </script>
        <?php
      }
    }
  }
    $c = $_GET['eis'].$_GET['a'].$id_comp ; ?>
    <script language="javascript">
      self.location="cli_info.php?c=<?php echo $c;?>";
    </script><?php
  exit();
  }
}

///
if (isset($_GET['c'])){
$c = $_GET['c'];
}

$eis 	= strtoupper(substr($c,0,2));
$a		= substr($c,2,4);
$idcomp	= substr($c,6,6);

mysqli_select_db($link, $database_ServidorUB);
$query  = "SELECT * FROM competencia INNER JOIN categoria WHERE competencia.categoria = categoria.id_cat AND competencia.id_comp = '$c' ";
$mquery = mysqli_query($link, $query) or die(mysql_error());
$row_q	= mysqli_fetch_assoc($mquery);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Muli:300,400" rel="stylesheet" type="text/css">
<link href="<?php echo $sitio; ?>diseno/diseno.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $charset; ?>" />
<style>
.wrapperInfo{
width: 600px;
height: 370px;
position: absolute;
margin: 0;
left: 0;
}
.wrapperInfo .InSUP{
width: 100%;
height: 100px;
position: relative;
padding: 10px 0;
background: #262c3f;
}
.wrapperInfo .InSUP .cuaizq{
text-align: center;
bottom: 25px;
left: 0;
width: 190px;
top: 43px;
}
.wrapperInfo .InSUP .cuaizq r{
color: white;
font-size: 100px;
}
.cerocero{
position: absolute;
top: 0;
height: 100px;
}

.wrapperInfo .InSUP .cuader{
background: #b8dbc1;
width: 390px;
padding: 10px;
right: 0;
}
.wrapperInfo .InSUP .cuareder{
width: 30px;
right: 0;
padding: 10px;
border-left: 2px #E4E4E4 solid;
text-align: center;
}
.wrapperInfo .InSUP .cuader h4{
font-size: 17.5px;
margin: 1px;
}
.wrapperInfo .InSUP .cuader p{
line-height: 0;
margin-top: 16px;
}
.wrapperInfo .InDOWN{
margin-top: 8px;
position: relative;
padding: 10px 0;
background: white;
border-top: 5px black solid;
overflow: overlay;
height: 175px;
}
.wrapperInfo .InDOWN p{
margin: 5px 15px;
font-weight: 700;
font-size: medium;
}
.wrapperInfo .foot{
width: 100%;
height: 30px;
margin-top: 2px;
position: relative;
padding: 5px 0;
background: #262c3f;
padding-top: 5px;
}
.wrapperInfo .foot .foot_menuizq{
font-size: x-large;
margin-left: 20px;
border-right: 2px #E4E4E4 solid;
}
.wrapperInfo .foot a{
margin-right: 15px;
position: relative;
top: 9px;
}

.espver i{
margin-top: 12px;
width: 50px;
}
.espver a{
position: relative;
left: -10px;
}
.espver a:hover{
background-color: #B8DBC1!important;
color: #262C3F;
}
.deshabilitado{
color: #E4E4E4;
}
.deshabilitado:hover{
color: white!important;
}
input[type="text"], textarea {
border-radius: 0;
}
select{padding: 0;}
</style>
<script language="javascript" type="text/javascript">
function limitText(limitField, limitCount, limitNum) {
	if (limitField.value.length > limitNum) {
		limitField.value = limitField.value.substring(0, limitNum);
	} else {
		limitCount.value = limitNum - limitField.value.length;
	}
}
</script>
<title>Información de Competencia</title>
</head>
<body style="height: 360px; width: 450px;overflow: hidden;">
<?php if (!isset($c)){ ?>
<form action="cli_info.php" method="GET" name="form1" id="form1" style="text-align: center;margin: 50px;">
<h3>Año</h3>
<div class="dato">
<input name="a" type="text" placeholder="<?php "Ej. ".date(Y); ?>" onKeyDown="limitText(this.form.a,this.form.countdown,4);" onKeyUp="limitText(this.form.a,this.form.countdown,4);" maxlength="15"></input>
</div>
</div>
<h3>Edici�n</h3>
<div class="dato">
	<select name="eis">
		<option selected value="CH">Eisteddfod del Chubut</option>
		<option value="JU">Eisteddfod de la Juventud</option>
	</select>
</div>
<h3>N�mero de Competencia</h3>
<div class="dato">
<input name="id_comp" type="text" placeholder="<?php echo "000"; ?>" onKeyDown="limitText(this.form.id_comp,this.form.countdown,3);" onKeyUp="limitText(this.form.id_comp,this.form.countdown,3);" maxlength="15"></input>
</div>
<div class="dato">
<input type="submit" class="boton-verde" value="Consultar" />
</div>
<input type="hidden" name="input" value="form"></input>
</form>
<?php exit(); } ?>
	<div class="wrapperInfo">
		<div class="InSUP cerocero">
			<div class="cuaizq cerocero">
			<r><?php echo acortameCOMP($c);?></r>
			</div>

			<div class="cuader cerocero">
			<h4>Año <?php echo $a ;?></h4>
			<h4><?php echo txtEIS($eis) ;?></h4>
			<p><?php echo $row_q['nombre']." / ".$row_q['nomcym']; ?></p>
			<p>Idioma: <?php echo $row_q['idioma']; ?></p>
			</div>
			<div class="cuareder cerocero">
				<div class="espver">
					<?php
					if (isset($row_q['grupind'])){
						if ($row_q['grupind'] == "IND"){ ?>
							<a href="#" title="Competencia individual"><i class="fa-user fa fa-2x"></i></a>
						<?php } else if ($row_q['grupind'] == "GRU") { ?>
							<a href="#" title="Competencia grupal"><i class="fa-users fa fa-2x"></i></a>
					<?php }
					} else { ?>
						<a href="#" class="deshabilitado" title="Competencia individual"><i class="fa-user fa fa-2x"></i></a>
					<?php }?>
				<br>
					<?php
					if ($row_q['rank'] == 1){ ?>
						<a href="#" title="Competencia principal"><i class="fa-certificate fa fa-2x"></i></a>
					<?php } ?>
				<br>
				</div>
			</div>
		</div>

		<div class="InDOWN">
			<p><?php echo $row_q['descripcion']; ?></p>
		</div>
		<div class="foot">

			<?php if ($row_q['xt_down'] != NULL){ ?>
				<div class="foot_menuizq cerocero">
				<a href="#" title="Descarga adjunta disponible"><i class="fa fa-cloud-download"></i></a>
				</div>
			<?php }
			if ($row_q['xt_texto'] != NULL){ ?>
				<div class="foot_menuizq cerocero">
				<a href="cli_info_txt.php?c=<?php echo $c; ?>" title="Texto adjunto disponible"><i class="fa fa-file-text-o"></i>
				</div>
			<?php } ?>

		</div>
	</div>
</body>
</html>
