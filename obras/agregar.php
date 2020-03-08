<?php
require_once('../Connections/ServidorUB.php');
require_once('../funciones.php');
//
/* verificar la conexi�n */
if (mysqli_connect_errno()) {
    printf("Conexi�n fallida: %s\n", mysqli_connect_error());
    exit();
}
$eis = strtoupper(substr($_SESSION["edicion"],0,2));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Alta de Obra de competencia</title>
<?

$sql = "select * from persona order by Nombre";
$res = mysqli_query($link,$sql);
$arreglo_php = array();
if(mysqli_num_rows($res)==0)
   array_push($arreglo_php, "No hay datos");
else{
  while($palabras = mysqli_fetch_array($res)){
    array_push($arreglo_php, $palabras["id_persona"]."# ".$palabras["Nombre"]." ". $palabras["Apellido"]);
 }
}
?>
<?php include("scripts.php") ;?>
<script>
  $(function(){
	var identificador = new Array();
    var autocompletar = new Array();
    <?php //Esto es un poco de php para obtener lo que necesitamos
     for($p = 0;$p < count($arreglo_php); $p++){ //usamos count para saber cuantos elementos hay ?>
       autocompletar.push('<?php echo htmlentities($arreglo_php[$p],ENT_QUOTES | ENT_IGNORE, "UTF-8"); ?>');
     <?php } ?>
     $("#buscar").autocomplete({ //Usamos el ID de la caja de texto donde lo queremos
       source: autocompletar //Le decimos que nuestra fuente es el arreglo
     });
	});
</script>
<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
</head>
<body style="background: white!important; min-height:100px;">

<!-- <p>Agregando obra durante el evento en el a&ntilde;o <?php // echo $a ; ?></p> -->
<div id="exito" style="text-align: center;">
    <code>
	<?
  if(isset($exito)){
    if ($exito == "si") {
 	  echo "<div class=\"status\" id=\"exito\">�Se a�adi� con �xito a <b>".$_GET["participante"]."</b>! (<a href=\"borra.php?obra=".$_GET['id_obra']."&url=".dameURL()." \" style=\"color:#5BAE4A;\"><i class=\"icon-trash\"></i> Deshacer</a>)</div>" ;
 	  }
 	  if ($exito == "no") {
 	  echo "<div id=\"error\">Hubo un problema con el dato ingresado...</div>";
 	  }
  }
	 ?>
	</code>
</div> <!--Termina exito-->
<div id="menu-lineal">
    <form action="agregar2.php?>" method="get">
        <div class="menu-azul">
		<i style="color: white;">Obra: </i><input type="text" name="nomobra" style="width: 200px;"/><br>
		<i style="color: white;">Seudonimo: </i><input type="text" name="mod_particip" style="width: 200px;"/><br>
        <input type="text" name="participante" style="width: 200px;" id="buscar"/>
        <select name="competencia">

    <?
		$sqlc = "select * from competencia WHERE id_comp LIKE '".$eis.$age."%%%' order by id_comp ";
		$resc = mysqli_query($link,$sqlc);
		$arreglo_phpc = array();
		$row_competencias = mysqli_fetch_array($resc);
		do {
		$idcomp = $row_competencias['id_comp'];
                if (substr($idcomp, -2,-1)== 0){
                        $competencia = substr($idcomp,-1);
                } else if (substr($idcomp, -3,-2)== 0){
                        $competencia = substr($idcomp,-2);
                } else {
                        $competencia = substr($idcomp,-3);
                }
                echo $competencia ; 	?>
        <option value="<?php echo $row_competencias['id_comp']?>"><?php echo $competencia.") ".substr($row_competencias['descripcion'], 0, 30);?></option>
        <?
      } while ($row_competencias = mysqli_fetch_assoc($resc));
          $rows = mysqli_num_rows($resc);
          if($rows > 0) {
            mysqli_data_seek($resc, 0);
        	  $row_competencias = mysqli_fetch_assoc($resc);
          } ?>
            </select>
        <select name="puesto" id="puesto">
          <option value="1">1º (Primero)</option>
          <option value="2">2º (Segundo)</option>
          <option value="3">3º (Tercero)</option>
          <option value="mencion">Mencion</option>
          <option selected="selected">Seleccione</option>
        </select>

		<input type="submit" class="boton-verde" value="Enviar"/>
		<input type="hidden" name="a" value="<?php echo $a; ?>"  />
		<input type="hidden" name="eis" value="<?php echo $eis; ?>"  />
        </div>

    </form>
</div>
</body>
</html>
