 
 <?php include("../Connections/linkborra.php"); 
   $link=Conectarse(); ?>

  <?php 
 
 //This is the directory where images will be saved 
 $target = "archivos/"; 
 $target = $target . basename( $_FILES['archivo']['name']); 
 
 //This gets all the other information from the form 
 $data=$_POST['data']; 
 $a=$_POST['a']; 
 $pic=($_FILES['archivo']['name']); 
 
 // Connects to your Database 
 //mysql_connect("localhost", "root", "privix02031992") or die(mysql_error()) ; 
 //mysql_select_db("eistedglobal") or die(mysql_error()) ; 
 
 //Writes the information to the database 
 mysql_query("INSERT INTO subidas (archivo, descripcion, id_anio) VALUES ('$pic','$data','$a')") ; 
 
 //Writes the archivo to the server 
 if(move_uploaded_file($_FILES['archivo']['tmp_name'], $target)) 
 { 
 
 //Tells you if its all ok 
 echo "El archivo ". basename( $_FILES['uploadedfile']['name']). " se subió correctamente!"; 
 header ("Location: relacionados.php?a=$a");
 } 
 else { 
 
 //Gives and error if its not 
 echo "Nuestros monos tienen piojos, disculpe, fue un error."; 
 } 
 ?> 
