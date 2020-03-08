<?php
$p = $_GET['p'];
require_once('../Connections/ServidorUB.php');

mysqli_select_db($link, $database_ServidorUB);
$query_personas = "SELECT * FROM persona WHERE id_persona = '$p'";
$personas = mysqli_query($link, $query_personas) or die(mysql_error());
$row_personas = mysqli_fetch_assoc($personas);

?>
<div id="contactcard">
	<h4><i class="fa fa-info-circle"></i>  <?php echo $row_personas['Nombre']." ".$row_personas['Apellido']; ?></h4>
	<ul>
		<?php if (isset($row_personas['FechaNac'])){echo "<li>Nacimiento: ".date("d/m/Y", strtotime($row_personas['FechaNac']))."</li>";} ?>
		<?php if (isset($row_personas['Residencia'])){	echo "<li>Origen: ".$row_personas['Nacionalidad'].", ".$row_personas['Residencia']."</li>";
										   } else if (isset($row_personas['Nacionalidad']))
										   { echo "<li>Origen: ".$row_personas['Nacionalidad']."</li>"; }?>
		<?php if (isset($row_personas['direccion'])){echo "<li><i class=\"fa fa-map-marker\"></i> Direccion: ".$row_personas['Direccion']."</li>";} ?>

		<?php if (isset($row_personas['Email'])){echo "<li>Email: ".$row_personas['Email']."</li>";} ?>
		<?php if (isset($row_personas['Telefono'])){echo "<li>Teléfono: ".$row_personas['Telefono']."</li>";} ?>
	</ul>
	<ul>
		<li style="float: right; padding: 3px;"><a href="modificar.php?p=<?php echo $p;?>" class="fancybox fancybox.iframe" title="Editar a <?php echo $row_personas['Nombre']." ".$row_personas['Apellido'] ?>"><i class="fa fa-pencil-square-o fa-lg"></i> </a></li>
		<li style="float: right; margin-right: 10px; padding: 3px;"><a href="premiacion.php?p=<?php echo $p;?>" class="fancybox fancybox.iframe" title="Premios de <?php echo $row_personas['Nombre']." ".$row_personas['Apellido'] ?>"><i class="fa fa-trophy"></i></a></li>

		<?php if ($row_personas['Email'] != NULL){ ?>
		<li style=""><a href="../emails/simple.php?p=<?php echo $p ;?>" class="fancybox fancybox.iframe" title="Enviar email a <?php echo $row_personas['Nombre']." ".$row_personas['Apellido']; ?>"><i class="fa fa-stack-exchange"></i></a></li>
		<?php } ?>
	</ul>
</div>
