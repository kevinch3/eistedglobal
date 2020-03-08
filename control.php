<html>
<head>
<title>Autentificación EisteddfodGlobal</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
<?php
$usr		=	$_POST["user"];
$pass		=	$_POST["pass"];
$edicion	=	$_POST["edicion"];
// $url = "url";
$url 		=	base64_decode($_GET['url']);

$db_usr		=	"eisteddfod";
$db_pass	=	"lacumbiadeleisteddfod";

echo "usr: ".$usr." vs ".md5($db_usr)."<br>";
echo "pass: ".$pass." vs ".md5($db_pass)."<br>";

if ($usr==md5($db_usr) && $pass==md5($db_pass)){
   	session_start();
  	$_SESSION["autentificado"]= "SI";
    $_SESSION["edicion"]= $edicion;
  	$_SESSION["a"]= date("Y");
  	$_SESSION["usr"]= $db_usr;
    //SE TRABA MEJORAR
    /* echo "<script language=\"javascript\">
          self.location=\" ".$url." \";
        </script>"; */
        echo "<script language=\"javascript\">
      			self.location=\"aplicacion.php?usr=". SID ."\";
      		</script>";
		exit();
	echo "Redirige común";
	echo "<script language=\"javascript\">
			self.location=\"aplicacion.php?usr=".$db_usr.SID."\";
		</script>";
	exit();
  } else {
	echo "Volver a la portada";
	echo "<script language=\"javascript\">
			self.location=\"index.php?errorusuario=si\";
		</script>";
  }
?>
</body>
</html>
