<?php
require_once('../Connections/ServidorUB.php');
require_once('../funciones.php');
//
/* verificar la conexión */
if (mysqli_connect_errno()) {
    printf("Conexión fallida: %s\n", mysqli_connect_error());
    exit();
}
//$sugYear = date("Y");
$texto = $_SESSION['texto-mail'];
unset($_SESSION['texto-mail']);
//echo $texto;
?>
<h1>Ok. Código de envío comentado.</h1>
<h2>Nov 18</h2>
<?
// if ($_GET[send] == "ok"){
// $texto = base64_encode(urldecode($_GET[texto]));
// echo base64_decode($texto);
// $asunto = $_GET[asunto];
// $Email = $_GET[Email];
// $reply	= "secretaria@eisteddfod.org.ar";
// $copia	= "webmaster@eisteddfod.org.ar";
// 	//Envío en formato HTML
// 	$headers = "MIME-Version: 1.0\r\n";
// 	$headers .= "Content-type: text/html; charset=ISO-8859-1\r\n";
// 	$headers .= "Content-Transfer-Encoding: base64\r\n";
// 	//Dirección del remitente
// 	$headers .= "From: Asoc. Eisteddfod del Chubut <no-responder@eisteddfod.org.ar>\r\n";
// 	$headers .= "Reply-To: ".$reply."\r\n";
// 	//Ruta del mensaje desde origen a destino
// 	$headers .= "Return-path: ".$reply."\r\n";
// 	//direcciones que recibián copia
// 	$headers .= "Cc: ".$copia."\r\n";
// 	mail($Email,$asunto,$texto,$headers);
// 	echo "<div style=\"position: fixed; padding: 15px; font-weight: bolder; top: 0; background: #b8dbc1; width: 100%;\"><i class=\"fa fa-check-square-o\"></i> Email enviado a $Email.</div>";
// }
