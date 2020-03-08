<?php 
if ($_GET['a'] == NULL) {
$a = date("Y");
} else {
$a = $_GET['a']; 
}
?>
<?php include ("../header.php");?> 
<div onLoad="UpdateTimer();" class="wrapper">
   <div class="app-menu">
       <div class="menualto">
           <i class="icon-bookmark"></i> Evento <?php echo $a ;?>
       </div>
       <div class="item-list">
           <div class="menu-sma">
						<?function createForm(){ ?>
<form name="login" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return validateForm()"  method="post">
        <div id="sender">
          <h4 style="color: white;margin: 8px 3px;padding: 10px;background: #F85653;text-align: center;width: 30%;"><i class="icon-user"></i> NOMBRE </h4>
          <input type="text" name="name" />  <button type="submit" name="submitBtn" value="Login">Entrar</button>
        </div>
      </form>
<?php
}

if (isset($_GET['u'])){
   unset($_SESSION['nickname']);
}
// Process login info
if (isset($_POST['submitBtn'])){
      $name    = isset($_POST['name']) ? $_POST['name'] : "Unnamed";
      $_SESSION['nickname'] = $name;
}   	

$nickname = isset($_SESSION['nickname']) ? $_SESSION['nickname'] : "Hidden";
?>

    <script language="javascript" type="text/javascript">
    <!--
      var httpObject = null;
      var link = "";
      var timerID = 0;
      var nickName = "<?php echo $nickname; ?>";

      // Get the HTTP Object
      function getHTTPObject(){
         if (window.ActiveXObject) return new ActiveXObject("Microsoft.XMLHTTP");
         else if (window.XMLHttpRequest) return new XMLHttpRequest();
         else {
            alert("Your browser does not support AJAX.");
            return null;
         }
      }   

      // Change the value of the outputText field
      function setOutput(){
         if(httpObject.readyState == 4){
            var response = httpObject.responseText;
            var objDiv = document.getElementById("result");
            objDiv.innerHTML += response;
            objDiv.scrollTop = objDiv.scrollHeight;
            var inpObj = document.getElementById("msg");
            inpObj.value = "";
            inpObj.focus();
         }
      }

      // Change the value of the outputText field
      function setAll(){
         if(httpObject.readyState == 4){
            var response = httpObject.responseText;
            var objDiv = document.getElementById("result");
            objDiv.innerHTML = response;
            objDiv.scrollTop = objDiv.scrollHeight;
         }
      }

      // Implement business logic    
      function doWork(){    
         httpObject = getHTTPObject();
         if (httpObject != null) {
            link = "message.php?nick="+nickName+"&msg="+document.getElementById('msg').value;
            httpObject.open("GET", link , true);
            httpObject.onreadystatechange = setOutput;
            httpObject.send(null);
         }
      }

      // Implement business logic    
      function doReload(){    
         httpObject = getHTTPObject();
         var randomnumber=Math.floor(Math.random()*10000);
         if (httpObject != null) {
            link = "message.php?all=1&rnd="+randomnumber;
            httpObject.open("GET", link , true);
            httpObject.onreadystatechange = setAll;
            httpObject.send(null);
         }
      }

      function UpdateTimer() {
         doReload();   
         timerID = setTimeout("UpdateTimer()", 5000);
      }
    
    
      function keypressed(e){
         if(e.keyCode=='13'){
            doWork();
         }
      }
    //-->
    </script>   
	<style>
	#main {
    margin: auto;
	width: 100%;
    min-height:150px;
    font-weight:bold;
    font-size : 12px;
}

#sender {
	width: 403px;
	height: auto;
	font-weight:bold;
	font-size : 12px;
	padding:5px;
	color: black;
	display: inline-block;
	margin: 0px 15px;
	text-align: center;
}
#sender button{
background: #dd4d4b;
color: #000;
padding: 10px 15px;
border: 0;
}
#sender button:hover{
background: #ff706d;
}
#sender input{
padding: 20px;
border: 0;
border-radius: 0;
margin: 0;
width: 280px;
margin-right: 5px;
}
td {
   padding:4px;
}
#result {
    margin-top:20px;
	background: white;
    text-align:left;
    font-weight:bold;
    font-size : 12px;
    padding:2px;
    height:400px;
    overflow:auto;
	margin: 15px;
}

.error {
    font-weight:normal;
    font-size : 10px;
    color:#dd1111;
    padding:5px;
}
.text {
	border: 1px solid #cccccc;
}

#caption{
    font-weight:bold;
    margin:10px;
    font-size : 14px;
    color:#C64934;
}
#icon{
    width:60px;
    height:100px;
    padding:0px;
    margin:0px;
    border:0px;
    float:left;
    background-image:url(icon.gif);
    background-repeat: no-repeat;
    background-position:center center;
}

p{
    margin:0px;
    padding:0px;
}

.name{
    font-weight:bold;
    color:#000;
}
.txt{
	font-weight:light;
	color: #3d3d3d;
}

#mchat{
    border:0px;
    width:100%;
}
</style>
    <div id="main">
<?php 

if (!isset($_SESSION['nickname']) ){ 
    createForm();
} else  { 
      $name    = isset($_POST['name']) ? $_POST['name'] : "Anónimo";
      $_SESSION['nickname'] = $name;
    ?>
      
     <div id="result">
<?php 
        $data = file("../../eisteddfod/2013/wp-content/themes/2k13RES/msg.html");
        foreach ($data as $line) {
        	echo $line;
        }
     ?>
      </div>
      <div id="sender" onKeyUp="keypressed(event);" >
         <input type="text" name="msg" id="msg" /><button onClick="doWork();">Enviar</button>
      </div>   
	  <a href="?u=<?php echo rand(10e16, 10e20); ?>" style="margin-left: 10px; margin-top: 10px;" onClick="resetForm()"><span><i class="icon-signout"></i> Salir</span></a>

<?php } ?>
		</div>
           </div>
       </div>
       <div class="menubajo">
           <div id="izq1"><a href="index.php?a=<?php echo date("Y"); ?>"><i class="icon-chevron-sign-left"></i> Volver</a></div>
           <div id="der1"><a class="icon-info-sign" href="#" title="<?php include("../version.php"); ?>"></a><a href="salir.php"><i class="icon-signout"></i> Salir </a><div id="reloj"></div></div>
       </div>
    </div>
</div>
</body>
</html>