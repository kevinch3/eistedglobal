<?
require_once('../Connections/ServidorUB.php');
//$sugYear = date("Y");
//$sugYear = $_SESSION['a'];
$sugYear = 2013;
$eis = $_GET['eis'];
$noauth = TRUE;
require_once('../funciones.php');

///

	for ($j = 1; $j <= 13; $j++) { //Se buscan todos los valores de las categorías
		if (isset($_GET["CAT$j"])){ //se descartan los valores vacíos
			$abxHAY[$j] = array();
			array_push($abxHAY[$j], ($_GET["CAT$j"]));
			if (isset($abxHAY)){
				echo "<h4>Te sugerimos / Wgrymwn y cofrestru: </h4>";
				break;
			}
		}
	}

	$abxFULL = array();
	$cats = array();
	$abx03 = array();
	$abx04 = array();

	for ($i = 1; $i <= 13; $i++) { //Se buscan todos los valores de las categorías
		if (isset($_GET["CAT$i"])){ //se descartan los valores vacíos

		$abx01 = dameCATEGORIA(($_GET["CAT$i"]),$link,"nombre")." / ".dameCATEGORIA(($_GET["CAT$i"]),$link,"nomcym");
		?>
		<h5><?php echo $abx01 ;?></h5>
		<?php $query_competencias = "SELECT * FROM competencia WHERE `id_comp` LIKE  '$eis$sugYear%' AND categoria = '".$_GET["CAT$i"]."' ORDER BY `id_comp` " or die("Error in the consult.." . mysqli_error($link));
		$competencias = mysqli_query($link, $query_competencias);
		$row_competencias = mysqli_fetch_assoc($competencias);
			do {
				if ($row_competencias['id_comp'] != ""){
					$abx02 = "<li><a href=\"".$sitio."competencias/cli_info.php?c=".$row_competencias['id_comp']."\" target=\"_blank\" >Comp. ".acortameCOMP($row_competencias['id_comp'])." || ".acortameDESCR($row_competencias['descripcion'])."</a></li>";
				echo $abx02;
				}
			} while ($row_competencias = mysqli_fetch_assoc($competencias));
		}
	}
?>
