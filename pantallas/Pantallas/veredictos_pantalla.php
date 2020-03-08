<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
$age = date('Y'); ?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<link href='http://fonts.googleapis.com/css?family=Muli:300,400' rel='stylesheet' type='text/css'>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" ></script>
<style>
*{margin: 0;font-family: 'Muli', sans-serif;font-weight: 300;}
html{
     height:100%;
     overflow: hidden;
	 background: #F85653;
}
body{height:100%;}
#divLeft{
    float:left;
    width:230px;
    height:100%;
    background:#F85653;
}
#divLeft .leftwrap{
    padding: 20px;
}
#divRight{
   margin-left:230px;
    height:100%;
    background:#F85653;
    color:#fff;
}
#divTop{
     background: #171717;
     text-align:center;
     color: #ffffff;
     font-size: 28px;
     height: 50px;
}
#divTop .top{
    text-align: center;
    display: inline-block;
     position: relative;
}
#divTop .top img{
    position: relative;
    margin-right: 15px;
    vertical-align:middle
}
#divTop .top .txt{
    position: relative;
    top: 5px;
}
#divTop #reloj{
    position: relative;
    float: right;
    top: 7px;
    right: 15px;
}
#divCenter{
      background:#F85653;
      height: 100%;
}
/* CUADRO */
#divCenter .container{

}
#divCenter .container .competencia{
    width: 90%;
    height: 90px;
    float: right;
    margin-top: 5px;
}
#c1{
    background: #007eff;
}
#c2{
    background: #0040f9;
}
#c3{
    background: #009a8d;
}
#c4{
    background: #079a00;
}
#c5{
    background: #9a3402;
}
#c6{
    background: #9a6302;
}
#c7{
    background: #9a3b02;
}
#c8{
    background: #9a0d02;
}
#c9{
    background: #9a0d02;
}
#c10{
    background: #e0dd03;
}
#c11{
    background: #03e0d3;
}
#c12{
    background: #00709a;
}
#divCenter .container .competencia .numero{
    font-size: 80px;
    float: left;
    display: inline-block;
    position: absolute;
    top: -40;
	font-weight: bold;
}
#divCenter .container .competencia .descr{
    float: right;
    position: relative;
    top: 15px;
    width: 500px;
    margin-right: 35px;
    text-align: right;
    font-size: 25px;
    font-weight: 400;
}
#divCenter .container #resultados{
    position: relative;
    float: right;
    text-align: right;
    width: 650px;
}
#resultados .rank{
    margin-top: 3px;
    padding: 1px;
    display: table;
    font-size: 22px;
    position: relative;
    float: right;
}
.rank .numero{
    background: #4e0000;
    font-weight: bold;
    padding: 5px;
}
.rank .persona{
    display: inline-block;
    width: 550px;
    background: #7c2f29;
    padding: 5px;
	font-weight: bold;
}
.bienvenido{
    position: relative;
    display: block;
    padding: 15%;
}
bienvenido{
    font-size: 130px;
    text-align: center;
}
</style>
<script>
function startTime()
{
var today=new Date();
var h=today.getHours();
var m=today.getMinutes();
var s=today.getSeconds();
// add a zero in front of numbers<10
m=checkTime(m);
s=checkTime(s);
document.getElementById('reloj').innerHTML=h+":"+m+":"+s;
t=setTimeout(function(){startTime()},500);
}

function checkTime(i)
{
if (i<10)
  {
  i="0" + i;
  }
return i;
}
</script>
<script type="text/javascript">
var auto_refresh = setInterval(
function ()
{
$('#divCenter').load('../comp_test.php?a=<?php echo $age;?>').fadeIn("slow");
}, 1000); // refresh every 10000 milliseconds
</script>
</head>
<body onload="startTime()">
    <div id="divTop"><div class="top"><img src="narciso.jpg" height="50px"/><span class="txt">Últimos Veredictos</span></div><div id="reloj"></div></div>
<div id="divLeft"><div class="leftwrap"><img src="trelewlogo.jpg" width="180" /><br><br><img src="side.jpg" width="180" /></div></div>
<div id="divRight">
<div id="divCenter"> Cargando...</div>
</div>
</body>
</html>
