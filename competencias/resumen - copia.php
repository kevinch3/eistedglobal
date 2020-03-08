<!-- RESUMEN APP EISTEDGLOBAL // STARTED: 08/01/14 LAST MODIF: <?php echo date("F d Y H:i:s.", filectime("resumen.php")); ?> -->
<?
/*
bucle
	- Obtener categoría[0]
	- Escrir título de categoría
	bucle
		- Obtener todas las competencias de esa categoría
		bucle
			- Obtener todas las obras de esa competencia
			bucle
				- Obtener personas de esa obra
			/bucle
		/bucle
	/bucle
/bucle
*/
?>
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



?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<style>
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
background: white;
display: inline-block;
padding: 0 10px;
}
#tit_categoria{
background-image: url('cli_img/bg_cat.png');
background-repeat: repeat-x;
margin: 30px 0;
}
.marg-bottom{ margin-bottom: 10px;}


.dos_columnas{
display: inline-block;
vertical-align: top;
margin-bottom: 25px;
}
.dos_columnas .comp_art{
width: 510px;
margin: 0!important;
}
.dos_columnas .comp_art .header{
padding: 10px;
color: white;
font-weight: 600;
font-size: 1.2em;
}
.dos_columnas .comp_art .video iframe{
width: 510px;
border-bottom: #f85653 4px solid;
}

.dos_columnas .comp_art .ganadores{
background: #1d1d1d;
min-height: 85px;
text-align: right;
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

</style>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $charset; ?>" />
<script src="<?php echo $sitio; ?>diseno/jquery.min.js" ></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.8.23/themes/redmond/jquery-ui.css">
<script type="text/javascript" src="../../shadowbox/shadowbox.js"></script>
<style type="text/css" media="all">@import "../../shadowbox/shadowbox.css";</style>
<script type="text/javascript"> Shadowbox.init({
    language: 'en',
    players:  ['img', 'html', 'iframe', 'qt', 'wmp', 'swf', 'flv'], 
    onClose: function(){ window.location.reload(); }
}); 
</script>
<title>Competencias año <?php echo $age ; ?></title>

</head>
<body>
	<div class="wrapper">
		<div class="header">
			<div class="titulares">
				<h3>Eisteddfod del Chubut</h3>
				<h3>Edicion 2013</h3>
			</div>
			<img src="bg_resumen.jpg"/>
			
		</div>
		<div id="tit_categoria">
			<h4>Prosa / Barddoniaeth </h4>
		</div>
		<div class="dos_columnas">
			<div class="comp_art">
				<div class="header"style="background: #007eff;">
					<a href="cli_info.php?c=<?php echo "CH2013001";?>" rel="shadowbox;height=360;width=650"><?php echo acortameDESCRcustom("1. CADAIR YR EISTEDDFOD: Cerdd neu gyfres o gerddi ar testun: 'Yr Afon'.", 45); ?></a>
				</div>
				
				<div class="video marg-bottom">
					<iframe width="510" height="287" src="//www.youtube.com/embed/<?php echo "0oBigB5KFGU" ;?>?rel=0" frameborder="0" allowfullscreen></iframe>
				</div>
				
				<div class="ganadores">
					<div class="trofeo">
						<i class="fa-trophy fa-4x fa"></i>
					</div>
					
					<div class="persona">
						<a href="..personas/cli_info.php?p=<?php echo "..."; ?>">1) Mary Green</a>
					</div>
					<div class="contador">
						<a href="#"><i class="fa-plus-square-o fa"></i> TOTAL: 7 </a>
					</div>
				</div>
			</div>
		</div>
		
		<div class="dos_columnas">
			<div class="comp_art">
				<div class="header"style="background: #007eff;">
					<a href="cli_info.php?c=<?php echo "CH2013001";?>" rel="shadowbox;height=360;width=650"><?php echo acortameDESCRcustom("2.  Telyneg: 'Blodau'", 45); ?></a>
				</div>
								
				<div class="ganadores">
					<div class="trofeo">
						<i class="fa-trophy fa-4x fa"></i>
					</div>
					
					<div class="persona">
						<a href="..personas/cli_info.php?p=<?php echo "..."; ?>">1) Mary Green</a>
					</div>
					<div class="contador">
						<a href="#"><i class="fa-plus-square-o fa"></i> TOTAL: 7 </a>
					</div>
				</div>
			</div>
		</div>
		<div class="dos_columnas">
			<div class="comp_art">
				<div class="header"style="background: #007eff;">
					<a href="cli_info.php?c=<?php echo "CH2013001";?>" rel="shadowbox;height=360;width=650"><?php echo acortameDESCRcustom("3.  Llinell Goll: 'Trwm yw'r plwm, a thrwm yw'r cerrig, Trom yw calon pob", 45); ?></a>
				</div>
								
				<div class="ganadores">
					<div class="trofeo">
						<i class="fa-trophy fa-4x fa"></i>
					</div>
					
					<div class="persona">
						<a href="..personas/cli_info.php?p=<?php echo "..."; ?>">1) Gweneira Davies de Quevedo</a>
						<a href="..personas/cli_info.php?p=<?php echo "..."; ?>">2) Yo</a>
					</div>
	
					<div class="contador">
						<a href="#"><i class="fa-plus-square-o fa"></i> TOTAL: 7 </a>
					</div>
				</div>
			</div>
		</div>
		<div id="tit_categoria">
			<h4>Prosa / Barddoniaeth </h4>
		</div>
	</div>
</body>
</html>