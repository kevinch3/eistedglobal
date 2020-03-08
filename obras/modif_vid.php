<?php
session_start();
if ($_SESSION["autentificado"] != "SI") {
   	header("Location: ".$sitio."index.php");
   	exit();
}
require_once('../Connections/ServidorUB.php');
$obra = $_GET['obra'];
$sql = "SELECT * FROM Obra WHERE id_obra =$obra";
$aux = mysqli_query($link, $sql) or die(mysqli_error());
$aux_r = mysqli_fetch_assoc($aux);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">

<html>
	<head>
	<style>
	body{background: #FF1D5C;font-family: Century Gothic;}
	* a{color: white!important;text-decoration: none;}
	.competencia{
	background: #c11744;
	padding: 10px;
	}
	.competencia .titulo{
	background: white;
	padding: 5px;
	font-weight: bold;
	}
	li:nth-child(odd){
	background: #d8d8d8;
	}
	li:nth-child(even){
	background: #efefef;
	}
	.opc{
	float: right;
	background: black;
	padding: 3px 10px;
	margin-left: 1px;
	}
	.opc:hover{
	background: #C11744;
	}

	</style>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.8.23/themes/redmond/jquery-ui.css">
	<title> Editor de videos </title>
	<script>
	$('#elementId').click(function(){
        $('#FullName').prop('disabled', true\false);
	});
	</script>
	</head>
	<body onLoad="ini();">
  	<center>


  	<?php
    //cambio exitoso
    if(isset($_GET['cambio'])){
      if ($_GET['cambio'] == 'si'){
        //header( 'Location: modif_vid.php?obra='.$obra ) ;
        $vidid = $_GET['vidid'];
      	$meter= "UPDATE Obra SET VIDEOURLS = '$vidid' WHERE id_obra ='$obra' " ;
      	mysqli_query ($link,$meter) or die(mysqli_error());
    	  ?>
    	  <span style="background: lightgreen; padding: 1px 10px;">Se ha cambiado con exito el video!</span>
    	  <?php }
      } else {
        if($aux_r['VIDEOURLS']){
          $vidid = $aux_r['VIDEOURLS'];
        } else {
          $vidid = 'no video';
        }

      }?>
  	<form method="GET" action="modif_vid.php">
  		<span>http://www.youtube.com/watch?v=</span>
  		<span><input name="vidid" value="<?php echo $vidid ?>"></input>
  		<input type="hidden" name="obra" value="<?php echo $obra; ?>">
      <input type="hidden" name="cambio" value="si">
  		<input type="submit" value="Cambiar">
  		</span>
  	</form>

  	<img src="http://i1.ytimg.com/vi/<?php echo $vidid  ?>/1.jpg" width="85px"/>
  	<img src="http://i1.ytimg.com/vi/<?php echo $vidid  ?>/2.jpg" width="85px"/>
  	<img src="http://i1.ytimg.com/vi/<?php echo $vidid  ?>/3.jpg" width="85px"/>
  	</center>
  </body>
</html>
