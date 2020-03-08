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
// Create the tooltips only when document ready
 $(document).ready(function()
 {
     // MAKE SURE YOUR SELECTOR MATCHES SOMETHING IN YOUR HTML!!!
     $('.icon-info-sign').qtip({
         // Your config here
     });
 });
 //FANCYBOX
  // $(document).ready(function() {
  // 	$(".fancybox").fancybox({ });
  // });
