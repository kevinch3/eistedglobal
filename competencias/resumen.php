<!-- RESUMEN APP EISTEDGLOBAL // STARTED: 08/01/14 LAST MODIF: <?php echo date("F d Y H:i:s.", filectime("resumen.php")); ?> -->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <?php require_once('../funciones.php'); ?>
  <meta charset="<?php echo $charset; ?>" />
  <link href="<?php echo $sitio; ?>favicon.ico" rel="shortcut icon"/>
  <link href="<?php echo $sitio; ?>diseno/bootstrap-combined.no-icons.min.css" rel="stylesheet">
  <link href="<?php echo $sitio; ?>diseno/fontawesome4/css/font-awesome.min.css" rel="stylesheet">
  <link href="http://fonts.googleapis.com/css?family=Muli:300,400" rel="stylesheet" type="text/css">
  <link href="<?php echo $sitio; ?>diseno/jquery.fancybox.css?v=2.1.5" type="text/css" rel="stylesheet" media="screen" />
  <link href="<?php echo $sitio; ?>diseno/jqueryui/css/redmond/jquery-ui-1.8.20.custom.css" type="text/css" rel="Stylesheet" />

  <!-- jquery -->
  <script src="<?php echo $sitio; ?>diseno/jquery.min.js" type="text/javascript"></script>
  <script src="<?php echo $sitio; ?>diseno/jqueryui/js/jquery-ui-1.8.20.custom.min.js" type="text/javascript"></script>
  <script src="<?php echo $sitio; ?>diseno/jqueryui/js/jquery.ui.datepicker-es.js" type="text/javascript"></script>
  <script src="<?php echo $sitio; ?>diseno/jquery.qtip.min.js" type="text/javascript"></script>
  <script src="<?php echo $sitio; ?>diseno/jquery.fancybox.pack.js?v=2.1.5" type="text/javascript"></script>
  <script src="<?php echo $sitio; ?>scripts.js" type="text/javascript"></script>

  <script type="text/javascript" src="<?php echo $sitio; ?>diseno/shadowbox/shadowbox.js"></script>
  <style type="text/css" media="all">@import "<?php echo $sitio; ?>diseno/shadowbox/shadowbox.css";</style>
  <script type="text/javascript"> Shadowbox.init({
      language: 'en',
      players:  ['img', 'html', 'iframe', 'qt', 'wmp', 'swf', 'flv'],
      onClose: function(){ window.location.reload(); }
  }); </script>

  <script type="text/javascript">
  $(document).ready(function(){
    $("#toggle").click(function(){
      $("#hide").fadeToggle(300);
    });
  });
  </script>

  <script type='text/javascript'>//<![CDATA[
  $(window).load(function(){
    $(document).ready(function() {
      $("#dialog").dialog({
        autoOpen: false,
        modal: true
      });
    });

    $(".confirmLink").click(function(e) {
      e.preventDefault();
      var targetUrl = $(this).attr("href");

      $("#dialog").dialog({
        buttons : {
          "Confirm" : function() {
            window.location.href = targetUrl;
          },
          "Cancel" : function() {
            $(this).dialog("close");
          }
        }
      });

      $("#dialog").dialog("open");
    });
  });//]]>
  </script>
  <?
  $noauth = TRUE;

  /* verificar la conexión */
  if (mysqli_connect_errno()) {
      printf("Conexión fallida: %s\n", mysqli_connect_error());
      exit();
  }

  $eis 	= strtoupper($_GET['eis']);
  $a		= $_GET['a'];
  $age  = $a;

  if (empty($eis) or empty($a)){
  echo "<h3> Hubo un error con la consulta. </h3><br><h4>No se puede continuar</h4>";
  exit();
  }

  ?>
<style>
body {
    overflow: hidden;
}
/* Preloader */
#preloader {
    position:fixed;
    top:0;
    left:0;
    right:0;
    bottom:0;
    background-color:#fff; /* change if the mask should have another color then white */
    z-index:99; /* makes sure it stays on top */
}

#status {
    height:200px;
	width: 100%;
    position:absolute;
    margin: 0 auto;
	text-align: center;
	top: 45%;
}

html,body,div,span,applet,object,iframe,h1,h2,h3,h4,h5,h6,p,blockquote,pre,a,abbr,acronym,address,big,cite,code,del,dfn,em,img,ins,kbd,q,s,samp,small,strike,strong,sub,sup,tt,var,b,u,i,center,dl,dt,dd,ol,ul,li,fieldset,form,label,legend,table,caption,tbody,tfoot,thead,tr,th,td,article,aside,canvas,details,embed,figure,figcaption,footer,header,hgroup,menu,nav,output,ruby,section,summary,time,mark,audio,video{border:0;font-size:100%;font:inherit;vertical-align:baseline;margin:0;padding:0}article,aside,details,figcaption,figure,footer,header,hgroup,menu,nav,section{display:block}body{line-height:1}ol,ul{list-style:none}blockquote,q{quotes:none}blockquote:before,blockquote:after,q:before,q:after{content:none}table{border-collapse:collapse;border-spacing:0}
body{
font-family: Century Gothic;
}
* a{color: white;text-decoration: none;}
* a:hover{text-decoration: underline;}
.wrapper{
width: 1024px;
margin: 0 auto;
min-height: 300px;
margin-top: 20px;
}
.wrapper .header .titulares{
float: left;
top: 5em;
position: absolute;
margin-left: 35px;
font-weight: 700;
font-size: 2em;
}
h3{
color: white;
text-shadow: 0 0 3px rgba(0,0,0,0.8);
line-height: 43px;
}
h4{
font-size: 1.3em;
font-weight: 600;
background: #e4e4e4;
display: inline-block;
padding: 0 10px;
}
#tit_categoria{
background-image: url('cli_img/bg_cat.png');
background-repeat: repeat-x;
margin: 30px 0;
}
.contenido{
margin: 0 auto;
position: relative;
border-bottom: #f85653 4px solid;
}

.marg-bottom{ margin-bottom: 10px;}

.dos_columnas{
display: inline-block;
vertical-align: top;
margin-bottom: 25px;
}
.dos_columnas .comp_art{
width: 500px;
margin: 0!important;
}
.dos_columnas .comp_art .header{
padding: 10px;
color: white;
font-weight: 600;
font-size: 1.2em;
}
.dos_columnas .comp_art .rank{
position: absolute;
margin-top: 17px;
color: white;
margin-left: 440px;
}
.dos_columnas .comp_art .video iframe{
width: 500px;
border-bottom: #f85653 4px solid;
}

.dos_columnas .comp_art .ganadores{
background: #1d1d1d;
min-height: 85px;
text-align: right;
padding-bottom: 5px;
}
	.ganadores .trofeo{
	position: relative;
	color: #434343;
	top: 10px;
	margin-left: 40px;
	float: left;
	}
	.ganadores .persona{
	color: white;
	}
	.ganadores .persona a{
	background: #f85653;
	padding: 8px;
	margin: 2px 2px 0 0px;
	display: inline-block;
	font-weight: 700;
	}

	.ganadores .contador{
	color: white;
	position: relative;
	bottom: 0;
	right: 0;
	margin: 10px;
	font-size: smaller;
	}

	/* RIBBON */
	.ribbon {
    height: 30px;
    width: 30px;
    position: relative;
    text-align: center;
    color: white;
    line-height: 27px;
    border: 0;
	}

	.ribbon:after {
	content: "";
	border: solid 15px #4982A9;
	border-bottom-color: transparent;
	}
	/* RIBBON */
  .copyright{
  margin: 0 auto;
  padding: 15px;
  }
  #status{
  font-size: 3em;
  }
	.izq{float: left;}
	.der{float: right;}
	.anio{
	width: 100%;
	height: 330px;
	margin-top: 20px;
	border: gray 1px solid;
	}
	.anio .texto{
	width: 350px;
	padding-right: 50px;
	background-image: url('cli_img/triangulo_rosa.gif');
	background-position: right;
	background-repeat: no-repeat;
	}
	.anio .texto li {
	margin: 50px 20px;
	text-align: right;
	}
	.anio .texto li a{
	color: black;
	}

	.anio .frame{
	width: 609px;
	height: 100%;
	border-left: 15px #f85653 solid;
	display: inline-block;
	overflow: hidden;
	}

	.backframe img{
	width: 100%;
	height: 100%;
	}
	.descr{
	position: absolute;
	}

#pre-load-web {width:100%;position:absolute;background:#92def8;left:0px;top:0px;z-index:100000}
/*aqui centramos la imagen si coloco margin left -30 es por que la imagen mide 60 */
#pre-load-web #imagen-load{margin:0 auto;position:absolute}
</style>
  <script>
   function cargar(div, desde) {
                  $(div).load(desde);
              }
  </script>
  <div id="fb-root"></div>
  <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1&appId=120652006330";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
  <title>Resumen <?php echo txtEIS($eis)." ".$age ; ?></title>
  <script type="text/javascript">
          $(window).load(function() { // makes sure the whole site is loaded
              $('#status').fadeOut(); // will first fade out the loading animation
              $('#preloader').delay(350).fadeOut('fast'); // will fade out the white DIV that covers the website.
              $('body').delay(350).css({'overflow':'visible'});
          })
  </script>
</head>
<body style="background: #e4e4e4;">
<div id="preloader">
    <div id="status"><i class="fa fa-refresh fa-spin"></i> Cargando...</div>
</div>
	<div class="wrapper">
		<div class="header">
			<img src="bg_resumen.jpg"/>
			<div class="titulares">
				<h3><?php echo txtEIS($eis) ;?></h3>
				<h3>Edición <?php echo $a ;?></h3>
			</div>
		</div>
	<div class="anio">
		<div class="texto izq">
			<ul>
				<li><a href="#" onclick="cargar('#frame', '../anios/cli_data.php?consulta=presentadores&a=<?php echo $a ;?>&eis=<?php echo $eis ;?>')" >Presentadores</a></li>
				<li><a href="#" onclick="cargar('#frame', '../anios/cli_data.php?consulta=coordinadores&a=<?php echo $a ;?>&eis=<?php echo $eis ;?>')" >Coordinadores</a></li>
				<li><a href="#" onclick="cargar('#frame', '../anios/cli_data.php?consulta=jurados&a=<?php echo $a ;?>&eis=<?php echo $eis ;?>')" >Jurados</a></li>
				<li><a href="#" onclick="cargar('#frame', '../anios/cli_data.php?consulta=comision&a=<?php echo $a ;?>&eis=<?php echo $eis ;?>')" >Comisión Directiva</a></li>
			</ul>
		</div>
		<div class="frame" id="frame">
			<div style="position: relative; text-align: center; margin: 0;">
				<p style="font-size: 1.2em;font-weight: bold;color: #999999;margin-top: 150px;">Seleccione</p>
			</div>
		</div>
	</div>
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
	$query_ob = "SELECT id_obra, competencia, categoria FROM Obra INNER JOIN competencia WHERE competencia.id_comp = Obra.competencia AND competencia LIKE '$eis$a%' AND categoria = '$cat_actual' ORDER BY competencia";
  $mquery_ob = mysqli_query($link, $query_ob);
	$mequery_ob = mysqli_fetch_assoc($mquery_ob);
	$norepetidas = array();
	do{
		array_push($norepetidas, $mequery_ob['competencia']);
	} while ($mequery_ob = mysqli_fetch_assoc($mquery_ob));
	$norepetidas = array_unique($norepetidas);
	$norepetidas = array_values($norepetidas);

	foreach($norepetidas as $comp_norep){
	$query  = "SELECT * FROM competencia INNER JOIN categoria WHERE competencia.categoria = categoria.id_cat AND competencia.id_comp = '$comp_norep' ";
	$mquery = mysqli_query($link, $query);
	$mequery_row = mysqli_fetch_assoc($mquery);
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
			<div class="comp_art">
				<div class="header"style="background: #4982A9;">
					<a href="cli_info.php?c=<?php echo $mequery_row['id_comp'];?>" rel="shadowbox;height=370;width=600"><?php echo acortameCOMP($mequery_row['id_comp']).". ".acortameDESCRcustom($mequery_row['descripcion'], 40); ?></a>
				</div>
				<?php if ($mequery_row['rank'] == 1){ ?>
					<div class="ribbon rank">
					<a href="#" title="Competencia principal"><i class="fa-certificate fa" style="position: absolute;margin-left: 8px;top: -5px;"></i></a>
					</div>
				<?php } ?>
				<?php foreach($obras_p as $obras_){
				if (isset($obras_['VIDEOURLS'])){ ?>
				<div class="video marg-bottom">
					<iframe width="500" height="287" src="//www.youtube.com/embed/<?php echo $obras_['VIDEOURLS'] ;?>?rel=0&showinfo=0" frameborder="0" allowfullscreen></iframe>
					<?php /* <img src="http://i1.ytimg.com/vi/<?php echo $obras_['VIDEOURLS'] ;?>/0.jpg" width="500" height="287" /> */ ?>
				</div>
				<?
				break;
					}
				} ?>

				<div class="ganadores">
					<div class="trofeo">
						<!--<i class="fa-trophy fa-4x fa"></i>-->
						<div class="fb-like" data-href="<?php echo $sitio."competencias/resumen.php?eis=".$eis."&a=".$a."#".acortameCOMP($mequery_row['id_comp']); ?>" data-width="30" data-layout="box_count" data-action="like" data-show-faces="false" data-share="false"></div>
					</div>
					<div class="persona">
					<?php foreach($obras_p as $obras_){
						if ($obras_['puesto'] != "mencion"){
							if  ($obras_['tipo'] == "GRU"){ ?>
							<a href="../personas/cli_info.php?p=<?php echo $obras_['fk_particip']; ?>" rel="shadowbox;height=370;width=600" title="Es una competencia GRUPAL"><?php echo $obras_['puesto'].") ".$obras_['Nombre']." ".$obras_['Apellido'] ;?></a>
					<?php } else { ?>
							<a href="../personas/cli_info.php?p=<?php echo $obras_['fk_particip']; ?>" rel="shadowbox;height=370;width=600" title="Es una competencia INDIVIDUAL"><?php echo $obras_['puesto'].") ".$obras_['Nombre']." ".$obras_['Apellido'] ;?></a>
					<?		}
						}
					} ?>
					</div>
					<div class="contador">
						<a href="#" title="<?php foreach($obras_p as $obras_){ echo $obras_['puesto'].") ".$obras_['Nombre']." ".$obras_['Apellido']." "; } ?>" ><i class="fa-plus-square-o fa"></i> TOTAL: <?php echo count($obras_p); ?> </a>
					</div>
				</div>
			</div>
		</div>
<?
} while ($mequery_row = mysqli_fetch_assoc($mquery));}} ?>
		</div>
		<div class="copyright">
			<p>Este contenido es perteneciente a la Asociación del Eisteddfod del Chubut.</p>
			<p><?php echo dameVERSION() ?></p>
		</div>
	</div>
</body>
</html>
