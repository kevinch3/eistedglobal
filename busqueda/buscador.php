<?php include("../Connections/linkborra.php");
//Inicio la sesión 
session_start(); 
//COMPRUEBA QUE EL USUARIO ESTA AUTENTIFICADO 
if ($_SESSION["autentificado"] != "SI") { 
   	//si no existe, envio a la página de autentificacion 
   	header("Location: ../index.php"); 
   	//ademas salgo de este script 
   	exit(); 
}
	$host = $servidor;
	$user = $username;
	$pass = $password;
	$db = $database;
        
require('include/conexion.php');
require('include/funciones.php');
require('include/pagination.class.php');

$items = 20;
$page = 1;

$tabla = "competencia";
$item = "descripcion";


	
if(isset($_GET['page']) and is_numeric($_GET['page']) and $page = $_GET['page'])
		$limit = " LIMIT ".(($page-1)*$items).",$items";
	else
		$limit = " LIMIT $items";

if(isset($_GET['q']) ){
		$q = sql_quote($_GET['q']); //para ejecutar consulta
		$busqueda = htmlentities($q); //para mostrar en pantalla

		$sqlStr = "SELECT * FROM $tabla WHERE $item LIKE '%$q%'";
		$sqlStrAux = "SELECT count(*) as total FROM $tabla WHERE $item LIKE '%$q%'";
	}else{
		$sqlStr = "SELECT * FROM $tabla";
		$sqlStrAux = "SELECT count(*) as total FROM $tabla";
	}
$aux = Mysql_Fetch_Assoc(mysql_query($sqlStrAux,$link));
$query = mysql_query($sqlStr.$limit, $link);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Buscador en AJAX</title>
<script src="include/jquery.min.js"></script>
<script src="include/buscador.js" type="text/javascript" language="javascript"></script>
</head>

<body>
	<form onsubmit="return buscar()">
      <label>Buscar</label> <input type="text" id="q" name="q" value="<?php if(isset($q)) echo $busqueda;?>" onKeyUp="return buscar()">
      <input type="submit" value="Buscar" id="boton">
      <span id="loading"></span>
    </form>
    
<div id="resultados">
	<?php include("motor.php");?>
    </div>
<body>
</html>

