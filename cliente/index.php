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

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="<?php echo $sitio; ?>favicon.ico" />
<script src="<?php echo $sitio; ?>diseno/jquery.min.js" ></script>
<script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="style.css ">
<title>Consultas - <?php echo txtEIS($eis)." ".$age ; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
  <h3>Año</h3>
  <div class="dato">
  <input name="a" type="text" id="datepicker" placeholder="<?php echo "Ej. ".date(Y); ?>" onKeyDown="limitText(this.form.a,this.form.countdown,4);" onKeyUp="limitText(this.form.a,this.form.countdown,4);" maxlength="15"></input>
  </div>
  </div>
  <h3>Edición</h3>
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
				<h3><?php echo txtEIS($eis) ;?></h3>
				<h3>Edición <?php echo $a ;?></h3>
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
  $cat_actual = $row_cat['id_cat']; ?>
  <div id="tit_categoria">
  <h4><?php echo $row_cat['nombre']." / ".$row_cat['nomcym'] ;?></h4>
	</div>
	<?

	// ESTA LINEA FILTRA LOS RESULTADOS
	$query_ob = "SELECT id_obra, competencia, categoria FROM Obra INNER JOIN competencia WHERE competencia.id_comp = Obra.competencia AND competencia LIKE '$eis$a%' AND categoria = '$cat_actual' ORDER BY competencia";
	//$query_ob = "SELECT id_comp, categoria FROM competencia WHERE categoria = '$cat_actual' ORDER BY id_comp";

	$mquery_ob = mysqli_query($link, $query_ob);
	$mequery_ob = mysqli_fetch_assoc($mquery_ob);
	$norepetidas = array();

  //DO norepetidas
	do{
		array_push($norepetidas, $mequery_ob['competencia']);
		} while ($mequery_ob = mysqli_fetch_assoc($mquery_ob));
		$norepetidas = array_unique($norepetidas);
  //

  //FOREACH norepetidas
	foreach($norepetidas as $comp_norep){
  	$query  = "SELECT * FROM competencia INNER JOIN categoria WHERE competencia.categoria = categoria.id_cat AND competencia.id_comp = '$comp_norep' ";
  	$mquery = mysqli_query($link, $query);
  	$mequery_row = mysqli_fetch_assoc($mquery);
  }
   do{
    	$query_obra = "SELECT fk_particip, puesto, mod_particip, Nombre, Apellido, tipo, PHOTOURLS, VIDEOURLS FROM Obra INNER JOIN persona WHERE Obra.fk_particip = persona.id_persona AND competencia = '".$mequery_row['id_comp']."' ORDER BY puesto";
    	$mquery_obra = mysqli_query($link, $query_obra);
    	$mequery_obra = mysqli_fetch_assoc($mquery_obra);
    	$obras_p = array();

      do{
    		array_push($obras_p, $mequery_obra);
    	} while ($mequery_obra = mysqli_fetch_assoc($mquery_obra));

    	if (empty($obras_p[0])){
    		echo "<h4><i class=\" fa-ban fa \"></i> No existen registros.</h4>";
    		break;
    	}

	    ?>
		  <div class="dos_columnas" id="<?php echo acortameCOMP($mequery_row['id_comp']);?>">
  			<div class="comp_art <?php if ($mequery_row['rank'] == 1){ echo "destacada"; } ?>">
  				<div class="header">
  					<a href="cli_info.php?c=<?php echo $mequery_row['id_comp'];?>"><?php echo acortameCOMP($mequery_row['id_comp']).". ".acortameDESCRcustom($mequery_row['descripcion'], 40); ?></a>
  				</div>
  				<?php  foreach($obras_p as $obras_){
      					if (isset($obras_['VIDEOURLS'])){ ?>
      						<div class="video">
      						<iframe width="500" height="287" src="//www.youtube.com/embed/<?php echo $obras_['VIDEOURLS'] ;?>?rel=0&showinfo=0" frameborder="0" allowfullscreen></iframe>
      						 <img src="http://i1.ytimg.com/vi/<?php echo $obras_['VIDEOURLS'] ;?>/0.jpg" width="500" height="287" />
      						</div>
      		<?php 	break;
                }
  				   } //end FOREACH   ?>
        </div>
				<div class="ganadores">
					<div class="trofeo">
						<div class="fb-like" data-href="<?php echo $sitio."competencias/resumen.php?eis=".$eis."&a=".$a."#".acortameCOMP($mequery_row['id_comp']); ?>" data-width="30" data-layout="box_count" data-action="like" data-show-faces="false" data-share="false"></div>
					</div>
  				<div class="persona">
  					<?php   foreach($obras_p as $obras_){
                  if ($obras_['tipo'] == "GRU"){
                    $tipo = "gru";
                  } else {
                    $tipo = "ind";
                  }
                  ?>
  							  <a href="../personas/cli_info.php?p=<?php echo $obras_['fk_particip'] ?>" class="<?php echo $tipo ?>"><?php echo $obras_['puesto'].") ". $obras_['Nombre']." ".$obras_['Apellido'];?></a>
               <?	 }
            //  if (recursive_array_search("mencion",$obras_p)){?>
  						    <?// echo "<a href=\"#\" class=\"mostrarmas\" title=\"".
                //   foreach($obras_p as $obras_){
                    //  echo $obras_['puesto'].") ".$obras_['Nombre']." ".$obras_['Apellido'];
                //    }
                  //  ."\>"?>
                      Mostrar todos </a>
                  <?php // } ?>
          </div>
        </div>
    </div>
    <?
}  while ($mequery_row = mysqli_fetch_assoc($mquery));?>
  </div>
    <?php } ?>
  <div class="copyright">
      <p>Este contenido es perteneciente a la Asociación del Eisteddfod del Chubut.</p>
      <p><?php echo dameVERSION(); ?></p>
  </div>
</div>
</body>
</html>
