<?php require_once('funciones.php'); ?>
<meta charset="<?php echo $charset; ?>" />
<link href="<?php echo $sitio; ?>favicon.ico" rel="shortcut icon"/>
<link href="<?php echo $sitio; ?>diseno/bootstrap-combined.no-icons.min.css" rel="stylesheet">
<link href="<?php echo $sitio; ?>diseno/fontawesome4/css/font-awesome.min.css" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Muli:300,400" rel="stylesheet" type="text/css">
<link href="<?php echo $sitio; ?>diseno/diseno.css" rel="stylesheet" type="text/css">
<link href="<?php echo $sitio; ?>diseno/jquery.fancybox.css?v=2.1.5" type="text/css" rel="stylesheet" media="screen" />
<link href="<?php echo $sitio; ?>diseno/jquery-ui.min.css" type="text/css" rel="Stylesheet" />

<!-- jquery -->
<script src="<?php echo $sitio; ?>diseno/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo $sitio; ?>diseno/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?php echo $sitio; ?>diseno/jquery.ui.datepicker-es.js" type="text/javascript"></script>
<script src="<?php echo $sitio; ?>diseno/jquery.qtip.min.js" type="text/javascript"></script>
<!--script src="<?php echo $sitio; ?>diseno/jquery.fancybox.pack.js?v=2.1.5" type="text/javascript"></script-->
<script src="<?php echo $sitio; ?>scripts.js" type="text/javascript"></script>

<script type="text/javascript" src="<?php echo $sitio; ?>diseno/shadowbox.js"></script>
<style type="text/css" media="all">@import "<?php echo $sitio; ?>diseno/shadowbox.css";</style>
<script type="text/javascript"> Shadowbox.init({
    // language: 'en',
    // players:  ['img', 'html', 'iframe', 'qt', 'wmp', 'swf', 'flv'],
    onClose: function(){ window.location.reload(); }
}); </script>

<script type="text/javascript">
$(document).ready(function(){
  $("#toggle").click(function(){
    $("#hide").fadeToggle(300);
  });
});
</script>

<script type='text/javascript'>//<![CDATA[
$(window).load(function(){
  $(document).ready(function() {
    $("#dialog").dialog({
      autoOpen: false,
      modal: true
    });
  });

  $(".confirmLink").click(function(e) {
    e.preventDefault();
    var targetUrl = $(this).attr("href");

    $("#dialog").dialog({
      buttons : {
        "Confirm" : function() {
          window.location.href = targetUrl;
        },
        "Cancel" : function() {
          $(this).dialog("close");
        }
      }
    });

    $("#dialog").dialog("open");
  });
});//]]>
</script>
