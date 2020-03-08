<?php
require_once('../Connections/ServidorUB.php');
require_once('../funciones.php');
/* verificar la conexión */
if (mysqli_connect_errno()) {
    printf("Conexión fallida: %s\n", mysqli_connect_error());
    exit();
}
$eis = strtoupper(substr($_SESSION["edicion"],0,2));
$a = $_SESSION["a"];
$query_anio = "SELECT * FROM anio WHERE Id_anio='$a'";
$anio = mysqli_query($link, $query_anio) or die(mysqli_error());
$row_anio = mysqli_fetch_assoc($anio);
$totalRows_anio = mysqli_num_rows($anio); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
<link rel="stylesheet" href="../diseno/bgslider/jquery.maximage.min.css" type="text/css" media="screen" title="CSS" charset="<?php echo $charset; ?>" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $charset; ?>" />
<script src="../diseno/bgslider/jquery.cycle.lite.js" type="text/javascript"></script>
<script src="../diseno/bgslider/jquery.maximage.min.js" type="text/javascript"></script>
<script type="text/javascript" charset="<?php echo $charset; ?>">
$(function(){
    $('#maximage').maximage({
        cycleOptions: {
            fx:'scrollHorz',
            speed: 800,
            timeout: 4000,
            prev: '#arrow_left',
            next: '#arrow_right'
        },
        onFirstImageLoaded: function(){
            jQuery('#cycle-loader').hide();
            jQuery('#maximage').fadeIn('fast');
        }
    });
});
</script>
<style>
body{min-height: 500px;}
.texto{
position: fixed;
color: white;
bottom: 15px;
background: #5bae4a;
width: 100%;
}
.texto ul li{
list-style: none;
}
#arrow_right{
position: fixed;
right: 10px;
bottom: 300px;
color: white;
cursor: pointer;
}
#arrow_right:hover{
color: #5BAE4A;
}
.downpanel{
position: fixed;
bottom: 0;
background: #262C3F;
width: 100%;
}
.downpanel a{
color: white;
}
</style>
<title>Presentadores</title>
  <body>
    <center>
    <?php $imagenes = explode(",", $row_anio['presentadoresimg']); ?>
      <div id="maximage">
          <?php foreach ($imagenes as $imagen){
            echo '<img src="'.$imagen.'">';
          } ?>
      </div>
      <div id="arrow_right"><i class="fa fa-arrow-circle-right fa-2x"></i></div>
      <div class="texto">
        <p><?php echo $row_anio['presentadores']; ?></p>
      </div>
      <div class="downpanel">
        <a href="presentadoresmodificar.php?a=<?php echo $a ; ?>"><i class="fa fa-pencil-square-o"></i> Modificar</a>
      </div>
    </center>
  </body>
</html>
