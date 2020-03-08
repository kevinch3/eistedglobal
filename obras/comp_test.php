<?php
require_once('../funciones.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<style>
html,body,div,span,applet,object,iframe,h1,h2,h3,h4,h5,h6,p,blockquote,pre,a,abbr,acronym,address,big,cite,code,del,dfn,em,img,ins,kbd,q,s,samp,small,strike,strong,sub,sup,tt,var,b,u,i,center,dl,dt,dd,ol,ul,li,fieldset,form,label,legend,table,caption,tbody,tfoot,thead,tr,th,td,article,aside,canvas,details,embed,figure,figcaption,footer,header,hgroup,menu,nav,output,ruby,section,summary,time,mark,audio,video{border:0;font-size:100%;font:inherit;vertical-align:baseline;margin:0;padding:0}article,aside,details,figcaption,figure,footer,header,hgroup,menu,nav,section{display:block}body{line-height:1}ol,ul{list-style:none}blockquote,q{quotes:none}blockquote:before,blockquote:after,q:before,q:after{content:none}table{border-collapse:collapse;border-spacing:0}
body{
}
* a{color: white;text-decoration: none;}
.competencia{
padding: 10px;
}
.competencia .titulo{
background: #9e1235;
padding: 12px 5px;
color: white;
font-weight: bolder;
}
li{
height: 45px;
padding: 3px;
}
li{
display: inline;
height: 35px;
padding: 15px 0;
position: relative;
}
li .nombre{
color: black;
width: 86%;
display: inline-block;
float: right;
text-align: center;
font-size: 20px;
font-weight: 600;
height: 50px;
position: relative;
}
li .nombre span{
top: 8px;
position: relative;
margin: initial;
}
li .puesto{
background: #720d27;
display: inline-block;
padding: 17px 0px;
margin-right: 1px;
width: 13%;
}
li .puesto span{
color: white;
margin-left: 6px;
font-weight: 700;
}
.botones{
display: inline-block;
float: right;
margin-right: 1%;
}
.masdata{
  background: black;
  padding: 5px;
  color: white;
}
.masdata span{
}
.descripcion{
}
.descripcion:hover{
text-decoration: underline;
}
.opc{
float: right;
background: black;
padding: 19px 10px;
margin-left: 1px;
top: -37px;
position: relative;
display: none;
}
.opc:hover{
background: #C11744;
}
mini{
color: #efefef;
font-size: 12px;
top: -10px;
position: relative;
}
</style>

<?php require_once('../embed.php'); ?>

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
        "Si, borrar" : function() {
          window.location.href = targetUrl;
        },
        "No"  : function() {
          $(this).dialog("close");
        }
      }
    });

    $("#dialog").dialog("open");
  });
});//]]>

</script>
<title>Competencias año <?php echo $a ; ?></title>
<div id="dialog" title="Desea borrar?">
  Esta seguro?
</div>
</head>
<body>
<?php
$query_competencias = "SELECT * FROM competencia WHERE id_comp  LIKE '".$eis.$a."%%%' ORDER BY id_comp ASC" or die("Error in the consult.." . mysqli_error($link));
$competencias = mysqli_query($link, $query_competencias);
$row_competencias = mysqli_fetch_assoc($competencias);
if(mysqli_num_rows($competencias)>1){
  do {
    $idcomp = $row_competencias['id_comp'];
    $cat = $row_competencias['categoria'];
    //
    $SQL3 = "SELECT * FROM categoria WHERE id_cat ='$cat'" or die("Error in the consult.." . mysqli_error($link));
    $QUERY3 =  mysqli_query ($link,$SQL3);
    $categ = mysqli_fetch_assoc($QUERY3);
    ?>
    <ul>
    	<div class="competencia">
    		<div class="titulo" id="<?php echo acortameCOMP($idcomp) ; ?>">
    			<b><?php echo acortameCOMP($idcomp) ; ?></b>
          [<?php echo $categ['nombre']; ?>]
        	<a href="../competencias/expandir.php?c=<?php echo $row_competencias['id_comp']; ?>" rel="shadowbox;height=200;width=350" class="descripcion">
        	   <?php echo acortameDESCR($row_competencias['descripcion']); ?>
        	</a>
      	</div>
  		<?php
  		$query_ganadores = "SELECT * FROM Obra WHERE competencia = '".$idcomp."' ORDER BY puesto ASC" or die("Error in the consult.." . mysqli_error($link)) ;
  		$ganadores = mysqli_query($link,$query_ganadores);
  		$row_ganadores = mysqli_fetch_assoc($ganadores);
  		$totalRows_ganadores = mysqli_num_rows($ganadores);
  		if ($totalRows_ganadores != 0){
  		?>
      <ul>
      <?php
  		do {
      	$query_persona = "SELECT id_persona, Nombre, Apellido, Residencia, Nacionalidad FROM persona WHERE id_persona = \"".$row_ganadores["fk_particip"]."\"" or die("Error in the consult.." . mysqli_error($link));
      	$persona = mysqli_query($link, $query_persona);
      	$row_persona = mysqli_fetch_assoc($persona);
    		?>
    		<li>
    		<?php if ($row_ganadores['VIDEOURLS'] != ""){ ?>
    			<div style="position: absolute;height: 50px;background-image: url('http://i1.ytimg.com/vi/<?php echo $row_ganadores['VIDEOURLS'] ;?>/0.jpg');opacity: 0.4;width: 84.7%;background-position-y: -160px;margin-left: 13.8%;"></div>
        <?php } ?>
  		    <div>
    				 <div class="puesto">
               <span>Puesto <?php echo $row_ganadores["puesto"];?></span>
             </div>
            <div class="nombre">
              <span><?php echo $row_persona["Nombre"]." ".$row_persona["Apellido"]; ?></span>
            </div>
    			</div>
      		<div class="masdata">
      			<span><?php
      				if ($row_persona["Residencia"] != NULL){
      				      echo "(".$row_persona["Residencia"].", ".$row_persona["Nacionalidad"].") |";
      				} else {
        				echo $row_persona["Nacionalidad"]." | "; }
        				if (isset($row_ganadores["mod_particip"])){echo "Seudónimo: ".$row_ganadores["mod_particip"]." | ";}
        				if (isset($row_ganadores["nomobra"])){echo "Obra: ".$row_ganadores["nomobra"]." | ";}
      				?>
      				<div class="botones">
        				<a href="modif_vid.php?obra=<?php echo $row_ganadores["id_obra"] ;?>" rel="shadowbox;height=200;width=350"><i class="fa fa-youtube-play "></i></a>
        				<a href="borra.php?obra=<?php echo $row_ganadores["id_obra"] ;?>&url=<?php echo urlencode(dameURL()) ;?>" target="_blank" class="confirmLink"><i class="fa fa-trash-o"></i></a>
      				</div>
      			</span>
      		</div>
      		<span class="opc"><a href="borra.php?obra=<?php echo $row_ganadores["id_obra"] ;?>&url=<?php echo urlencode(dameURL()) ;?>" target="_blank" class="confirmLink"><i class="fa fa-trash-o"></i></a></span>
      		<?php if ($row_ganadores['VIDEOURLS'] != ""){ ?>
      			<span class="opc" style="background: green;"><a href="modif_vid.php?obra=<?php echo $row_ganadores["id_obra"] ;?>&url=<?php echo urlencode(dameURL()) ;?>" rel="shadowbox;height=200;width=350"><i class="fa fa-youtube-play "></i></a></span></li>
      			<?php } else { ?>
      			     <span class="opc"><a href="modif_vid.php?obra=<?php echo $row_ganadores["id_obra"] ;?>&url=<?php echo urlencode(dameURL()) ;?>" rel="shadowbox;height=200;width=350"><i class="fa fa-youtube-play "></i></a></span></li>
            <?php } ?>
          <?php } while ($row_ganadores = mysqli_fetch_assoc($ganadores));?></ul>
    		<?php } ?>
    		</div>
  		</ul>
  		<?php } while ($row_competencias = mysqli_fetch_assoc($competencias));
}
 ?>
		<ul>
      <div class="competencia"><div class="agrega">
        <a href="../competencias/agrega.php?a=<?php echo $a;?>" rel="shadowbox;height=500;width=650" >
          Agregar competencia
        </a>
      </div>
    </div>
  </ul>
  <!-- FIN Tabla nueva-->
   <?php echo dameVERSION(); ?>
</body>
</html>
