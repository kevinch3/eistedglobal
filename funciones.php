<?php
session_start();

	// if ($_SESSION["autentificado"] != "SI") {
	// 			header("Location: ".$sitio."index.php?url=".dameurl());
	// 		exit();
	// }

// $age	=	$_SESSION['a'];

//sacado de control.php
if(isset($_GET['a'])){
  $a = $_GET['a'];
} else if(isset($_SESSION['a'])){
  $a = $_SESSION['a'];
} else {
	//LE DOY VALOR POR DEFECTO ESTE AÑO
	$a = date("Y");
}

if(!(isset($_SESSION["edicion"]))){
	//LE DOY VALOR POR DEFECTO CHUBUT
	$eis = "CH";
} else {
	$eis = strtoupper(substr($_SESSION["edicion"],0,2));
}

$charset = "UTF-8";
require_once('dominio.php');
$sitioURL = urlencode($sitio);
$conectar = "Connections/ServidorUB.php";
require_once($conectar);


/*
[MAN]
Listado de funciones--------------------
[UTILIDADES]
$link 										= mysqli_query();
dameURL() 								= Devuelve la url actual
acortameCOMP($comp) 					= Se ingresan 3 d�gitos y en caso de encontrar CEROS adelante los borra hasta dejar limpio el n�mero.
anioCOMP($comp)							= Devuelve el a�o de la competencia
acortameDESCR($descripcion)				= Se ingresa una cadena de texto y se limita en la cantidad de caracteres(y espacio), al final se agrega un "..."
dameVERSION()							= Devuelve la versi�n de trabajo actual.
txtEIS($edicion)						= Devuelve la descripcion de $edicion
dameCOMPETENCIA($comp,$link,$artilugio)	= Competencia en formato completo, $link, y lo que se pida de la base de datos **PRUEBA**
dameCATEGORIA($idcat,$link,$artilugio)	= Identificador de cat, $link, y lo que se pida de la tabla en la base..
dameOBRAPART($part,$link,$artilugio)	= Deprecable: Se env�a un participante y se devuelven las obras.

[CONSULTAS]
???

Listado de declaraciones----------------
[TO DEPRECATE INTO FUNCTION]
$sitio						= Devuelve siempre la ra�z actual del programa, dependiendo el servidor instalado.
$conectar 					= Devuelve la p�gina de conexi�n.
$age						= Devuelve A�o
$txtE%						= Devuelve edici�n en texto
*/
//DECLARACIONES


//FUNCIONES
function dameURL(){
	$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	return base64_encode($url);
}
//DAR STRING DE CLASIFICACION DE EISTEDDFOD + DATA
function txtEIS($edicion){
	switch ($edicion){
		case "chubut":
			return "Eisteddfod del Chubut";
			break;
		case "juventud":
			return "Eisteddfod de la Juventud";
			break;
		case "CH":
			return "Eisteddfod del Chubut";
			break;
		case "JU":
			return "Eisteddfod de la Juventud";
			break;
	}
}



function acortameCOMP($comp){
		$comp = substr($comp,-3);

			if ( substr($comp, -2,-1) == 0 AND substr($comp, -3,-2) == 0){
					return substr($comp,-1);
				} else if (substr($comp, -3,-2)== 0){
					return substr($comp,-2);
				} else {
					return $comp;
				}
}
function anioCOMP($comp){
			return substr($comp, 2, 4);
}


function acortameDESCR($descripcion){
			$contador = 0;
			$tamano = 20;
			$arraydescripcion = explode(' ',$descripcion);
			/*while($tamano >= strlen($descripcion) + strlen($arraydescripcion[$contador])){
				$descripcion .= ' '.$arraydescripcion[$contador];
				$contador++;*/

			$descriptor = explode("<br>",$descripcion);
			$descriptor[0] = explode("<ul>",$descriptor[0]);
			if ((strlen($descripcion))<$tamano){
				return $descriptor[0][0]."...";
				} else {
				return $descriptor[0][0];
				}
}
/*
function acortameDESCR($descripcion){
		strip_tags($descripcion);
		$descripcionOut=substr($descripcion, 0, 80);
		return($descripcionOut);
}
		/* $contador = 0;
			$arraydescripcion = split(' ',$descripcion);
			$descripcion = '';
			while(15 >= strlen($descripcion) + strlen($arraydescripcion[$contador])){
				$descripcion .= ' '.$arraydescripcion[$contador];
				$contador++;}
			$descriptor = explode("<br>",$descripcion);
			$descriptor[0] = explode("<ul>",$descriptor[0]);
			if ((strlen($descripcion))<15){
				return $descriptor[0][0]."...";
				} else {
				return $descriptor[0][0];
		}*/

// function acortameDESCRcustom($descripcion,$tamano){
// 			$contador = 0;
// 			$arraydescripcion = split(' ',$descripcion);
// 			$descripcion = '';
// 			while($tamano >= strlen($descripcion) + strlen($arraydescripcion[$contador])){
// 				$descripcion .= ' '.$arraydescripcion[$contador];
// 				$contador++;}
// 			$descriptor = explode("<br>",$descripcion);
// 			$descriptor[0] = explode("<ul>",$descriptor[0]);
// 			if ((strlen($descripcion))<$tamano){
// 				return $descriptor[0][0]."...";
// 				} else {
// 				return $descriptor[0][0];
// 				}
// }
function acortameDESCRcustom($input, $length, $ellipses = true, $strip_html = true) {
    //strip tags, if desired
    if ($strip_html) {
        $input = strip_tags($input);
    }

    //no need to trim, already shorter than trim length
    if (strlen($input) <= $length) {
        return $input;
    }

    //find last space within length
    $last_space = strrpos(substr($input, 0, $length), ' ');
    $trimmed_text = substr($input, 0, $last_space);

    //add ellipses (...)
    if ($ellipses) {
        $trimmed_text .= '...';
    }

    return $trimmed_text;
}

function dameCOMPETENCIA($comp,$link,$artilugio){
	$query_competencias = "SELECT * FROM competencia WHERE id_comp = '$comp' " or die("Error in the consult.." . mysqli_error($link));
	$competencias = mysqli_query($link, $query_competencias);
	$row_competencias = mysqli_fetch_assoc($competencias);
	return $row_competencias[$artilugio];
	}
function dameCATEGORIA($cat,$link,$artilugio){
	$query_cat = "SELECT * FROM categoria WHERE id_cat ='$cat'";
	$categoria = mysqli_query($link, $query_cat) or die(mysql_error());
	$row_categoria = mysqli_fetch_assoc($categoria);
	return $row_categoria[$artilugio];
}
function dameOBRAPART($part,$link,$artilugio){
	$query_obra = "SELECT * FROM `Obra` WHERE fk_particip = '$part'";
	$obras = mysqli_query($link, $query_obra) or die(mysql_error());
	$row_obras = mysqli_fetch_assoc($obras);
	return $row_obras[$artilugio];
}
function damePERSONA($idpersona,$link){
	$query = "SELECT * FROM `persona` WHERE id_persona = '$idpersona'";
	$sqli = mysqli_query($link, $query) or die(mysql_error());
	$row = mysqli_fetch_assoc($sqli);
	return $row[Nombre]." ".$row[Apellido];
}

function valorFRECUENTE($artilugio){
	$count=array_count_values($artilugio);
	arsort($count);
	$keys=array_keys($count);
	return "$keys[0]";
}

//
function dameVERSION(){
	return "Estocolmo (19/11/18)";
	//"Build 1.0.3.1 <b>Experimental</b> (11/08/18)";
	//"Build 1.0.3 <b>PRE-BETA</b> (05/03/14)  - <b>Versi&oacute;n 'Re-Maquinado'</b>";
	//"Build 1.0.1 <b>PRE-BETA</b> (08/01/14)  - <b>Versi&oacute;n 'Maquinado'</b>";
	//"Build 0.96.6 (01/01/14)  - <b>Versi�n 'New-Age'</b>";
	//"Build 0.96.6.1 (29/12/13)  - <b>Versi�n 'Notermin-a'</b>";
	//"Build 0.95.5 (24/11/13)  - <b>Versi�n \"Funcion-a\"</b>";
	//"Build 0.92A (30/10/13)  - <b>Versi�n 'La V�spera'</b>";
	//"Build 0.9A (1/09/13)  - <b>Versi�n 'Refuerzos'</b>";|
	}


///
//CONSULTAS
?>
