<?php /* Año + Edición
	Personas
		Listado

	Competencias
		Listado
		Inscripción
		Obra
			Listado
*/
?>
<!-- RESUMEN APP EISTEDGLOBAL // STARTED: 24/04/14 LAST MODIF: <?php echo date("F d Y H:i:s.", filectime("index.php")); ?> -->
<?
$time_start = microtime(true);

require_once('../Connections/ServidorUB.php');
$noauth = TRUE;
require_once('../funciones.php');
//
/* verificar la conexión */
if (mysqli_connect_errno()) {
    printf("Conexión fallida: %s\n", mysqli_connect_error());
    exit();
}

$eis 	= strtoupper($_GET['eis']);
$a		= $_GET['a'];


function recursive_array_search($needle,$haystack) {
    foreach($haystack as $key=>$value) {
        $current_key=$key;
        if($needle===$value OR (is_array($value) && recursive_array_search($needle,$value) !== false)) {
            return $current_key;
        }
    }
    return false;
}


mysqli_select_db($link, $database_ServidorUB);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="<?php echo $sitio; ?>favicon.ico" />
<script src="<?php echo $sitio; ?>diseno/jquery.min.js" ></script>
<script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
<link href="<?php echo $sitio; ?>cliente/style.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css">
<title>Consultas - <?php echo txtEIS($eis)." ".$age ; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $charset; ?>" />
<script>
  $(function() {
        $('#datepicker').datepicker({
                changeYear: true,
                showButtonPanel: true,
                dateFormat: 'yy',
				yearRange: '1900:<?php echo date(Y); ?>',
                onClose: function(dateText, inst) {
                    var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                    $(this).datepicker('setDate', new Date(year, 1));
                }
            });
        $("#datepicker").focus(function () {
                $(".ui-datepicker-calendar").hide();
				$(".ui-datepicker-month").hide();
				$(".ui-datepicker-prev").hide();
				$(".ui-datepicker-next").hide();
				$(".ui-priority-secondary").hide();
            });
        });
</script>
</head>
<body>
<!-- FORMULARIO EDICIÓN Y AÑO -->
<?php if (empty($eis) or empty($a)){ ?>
<form action="index.php" method="GET" name="form1" id="form1" style="text-align: center;margin: 50px;">
<h3>Ano</h3>
<div class="dato">
<input name="a" type="text" id="datepicker" placeholder="<?php echo "Ej. ".date(Y); ?>" onKeyDown="limitText(this.form.a,this.form.countdown,4);" onKeyUp="limitText(this.form.a,this.form.countdown,4);" maxlength="15"></input>
</div>
</div>
<h3>Edicion</h3>
<div class="dato">
	<select name="eis">
		<option selected value="CH">Eisteddfod del Chubut</option>
		<option value="JU">Eisteddfod de la Juventud</option>
	</select>
</div>
<div class="dato">
<input type="submit" class="boton-verde" value="Consultar" />
</div>
<input type="hidden" name="input" value="form"></input>
</form>
<?php exit(); } ?>

<!-- EDICION ACLARADA + AÑO -->

	<div class="wrapper">
		<div class="header">
			<div class="titulares">
				<h2><?php echo txtEIS($eis)." ".$a ;?></h2>
			</div>
		</div>
<?php /* if ($_GET[sel] == "competencia"){

	}	*/?>
	<div class="contenido">
	<?
$query_cat  = "SELECT * FROM categoria";
$mquery_cat = mysqli_query($link, $query_cat);
while($row_cat = $mquery_cat->fetch_array()){$rows_cat[] = $row_cat;}
foreach($rows_cat as $row_cat){
	$cat_actual = $row_cat[id_cat]; ?>
	<div id="cat<?php echo $cat_actual; ?>" class="categoria">
		<h4 id="tit_categoria"><?php echo $row_cat[nombre]." / ".$row_cat[nomcym] ;?></h4>
		<?
		$q_comp_cat = "SELECT * FROM competencia WHERE categoria = '$cat_actual' AND id_comp LIKE '$eis$a%' ORDER BY id_comp";

		if ($mq_comp_cat = mysqli_query($link, $q_comp_cat)) {

		/* obtener array asociativo */
		while ($mq_comp_cat_row = mysqli_fetch_assoc($mq_comp_cat)) { ?>
			<div class="comp">
			<?
			echo "<div class=\"titular\"><b>".acortameCOMP($mq_comp_cat_row["id_comp"])."</b> ".$mq_comp_cat_row["descripcion"]."</div>";
			$q_obra_comp = "SELECT * FROM Obra WHERE competencia = '".$mq_comp_cat_row[id_comp]."'";
			if ($mq_obra_comp = mysqli_query($link, $q_obra_comp)) {
				while ($mq_obra_comp_row = mysqli_fetch_assoc($mq_obra_comp)) {
					echo "<li class=\"PUESTO".$mq_obra_comp_row["puesto"]."\">".damePERSONA($mq_obra_comp_row["fk_particip"],$link)."</li>";
				}
				mysqli_free_result($mq_obra_comp);
			} ?>
			</div>
		<?php }
		/* liberar el conjunto de resultados */
		mysqli_free_result($mq_comp_cat);
		}
		?>
	</div>
		<?php } while ($mequery_row = mysqli_fetch_assoc($mquery)); ?>
		</div>
		<?
		$time_end = microtime(true);
		$time = number_format(($time_end - $time_start), 2);

		echo 'Consulta hecha en ', $time, ' segundos';
		?>
		<div class="copyright">
			<p>Este contenido es perteneciente a la Asociaci&oacuten del Eisteddfod del Chubut.</p>
			<p><?php echo dameVERSION() ?></p>
		</div>
	</div>
</body>
</html>
