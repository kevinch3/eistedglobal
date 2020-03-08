<?php $host = $_SERVER['HTTP_HOST'];
 if($host == "www.eisteddfod.org.ar" or $host == "eisteddfod.org.ar") {
    $servidor = "localhost";
	$database = "ag000673_eistedglobal";
	$username = "ag000673_root";
	$password = "Privix02031992";
	echo "<!--conexion servidor DATATTEC-->";
 } else {
	$servidor = "db";
	$database = "eistedglobal";
	$username = "admin";
	$password = "3cJC8t^e";

  error_reporting(E_ALL);
  ini_set('display_errors', TRUE);
  ini_set('display_startup_errors', TRUE);


	echo "<!--conexion servidor PRUEBAS-->";
 }
$database_ServidorUB = $database;
//$ServidorUB = mysql_connect($servidor, $username, $password) or trigger_error(mysql_error(),E_USER_ERROR);
//$link = mysqli_query($servidor,$username,$password,$database);
//$sitio está declarado en dominio.php
$link = mysqli_connect($servidor,$username,$password,$database) or die("Error " . mysqli_error($link));
mysqli_set_charset($link,"utf8");
?>
