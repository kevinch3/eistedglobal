<!-- EMPIEZA CODIGO PHP CODIGOS -->
<!--link href="../jscss/css/custom-theme/jquery-ui-1.9.1.custom.css" rel="stylesheet"-->
	<script src="../jscss/js/jquery-1.8.2.js"></script>
	<script src="../jscss/js/jquery-ui-1.9.1.custom.js"></script>
	<script>
	$(function() {

		$(function() {
        var icons = {
            header: "ui-icon-circle-arrow-e",
            activeHeader: "ui-icon-circle-arrow-s"
        };
        $( "#accordion" ).accordion({
            icons: icons
        });
        $( "#toggle" ).button().click(function() {
            if ( $( "#accordion" ).accordion( "option", "icons" ) ) {
                $( "#accordion" ).accordion( "option", "icons", null );
            } else {
                $( "#accordion" ).accordion( "option", "icons", icons );
            }
        });
    });


		var availableTags = [
			"ActionScript",
			"AppleScript",
			"Asp",
			"BASIC",
			"C",
			"C++",
			"Clojure",
			"COBOL",
			"ColdFusion",
			"Erlang",
			"Fortran",
			"Groovy",
			"Haskell",
			"Java",
			"JavaScript",
			"Lisp",
			"Perl",
			"PHP",
			"Python",
			"Ruby",
			"Scala",
			"Scheme"
		];
		$( "#autocomplete" ).autocomplete({
			source: availableTags
		});



		$( "#button" ).button();
		$( "#radioset" ).buttonset();



		$( "#tabs" ).tabs();



		$( "#dialog" ).dialog({
			autoOpen: false,
			width: 400,
			buttons: [
				{
					text: "Ok",
					click: function() {
						$( this ).dialog( "close" );
					}
				},
				{
					text: "Cancel",
					click: function() {
						$( this ).dialog( "close" );
					}
				}
			]
		});

		// increase the default animation speed to exaggerate the effect
    $.fx.speeds._default = 1000;
    $(function() {
        $( "#dialog" ).dialog({
            autoOpen: false,
            show: "blind",
            hide: "explode"
        });

        $( "#opener" ).click(function() {
            $( "#dialog" ).dialog( "open" );
            return false;
        });
    });



		$( "#datepicker" ).datepicker({
			inline: true
		});



		$( "#slider" ).slider({
			range: true,
			values: [ 17, 67 ]
		});



		$( "#progressbar" ).progressbar({
			value: 20
		});


		// Hover states on the static widgets
		$( "#dialog-link, #icons li" ).hover(
			function() {
				$( this ).addClass( "ui-state-hover" );
			},
			function() {
				$( this ).removeClass( "ui-state-hover" );
			}
		);
	});
	</script>

	<style>

	.demoHeaders {
		margin-top: 2em;
	}
	#dialog-link {
		padding: .4em 1em .4em 20px;
		text-decoration: none;
		position: relative;
	}
	#dialog-link span.ui-icon {
		margin: 0 5px 0 0;
		position: absolute;
		left: .2em;
		top: 50%;
		margin-top: -8px;
	}
	#icons {
		margin: 0;
		padding: 0;
	}
	#icons li {
		margin: 2px;
		position: relative;
		padding: 4px 0;
		cursor: pointer;
		float: left;
		list-style: none;
	}
	#icons span.ui-icon {
		float: left;
		margin: 0 4px;
	}
	</style>


    <!-- CODIGO DE TABLA JQUERY DESPLEGABLE -->
    <style type="text/css">
        body {
		font-family:Tahoma, Geneva, sans-serif;
		font-size:0.9em;
		background-color:#FFF;
		}
		#header {
		}
		#header h1 {
  font-family: 'Tahoma', arial, helvetica, sans-serif;
  font-size: 2.1em;
  color: #1B7ABE;
  line-height: 0.8;
		}
		#header h2 {
		line-height: 0.2;}
        #report {
		border-collapse:collapse;						}
		#report kp {
		font-size: 0.8em;
		font-weight: bold;
		}
        #report h4 { margin:0px; padding:0px;}
        /*#report img { float:right;}*/
        #report ul { margin:10px 0 10px 40px; padding:0px;}
        #report th { background:#7CB8E2 url(header_bkg.png) repeat-x scroll center left; color:#fff; padding:7px 15px; text-align:left;}
        #report td {
		color:#000;
		padding:7px 15px;
		}
        #report tr.odd td {
		background: #DDEEFF;
		cursor:pointer;
		}
        #report div.arrow { background:transparent url(arrows.png) no-repeat scroll 0px -16px; width:16px; height:16px; display:block;}
        #report div.up { background-position:0px 0px;}
    </style>
	<script type="text/javascript">
        $(document).ready(function(){
            $("#report tr:odd").addClass("odd");
            $("#report tr:not(.odd)").hide();
            $("#report tr:first-child").show();

            $("#report tr.odd").click(function(){
                $(this).next("tr").toggle();
                $(this).find(".arrow").toggleClass("up");
            });
            //$("#report").jExpand();
        });
    </script>
    <!--Codigo para prevista TOOLTIP -->
    <style>
	#screenshot{
	position:absolute;
	border:1px solid #ccc;
	background:#333;
	padding:5px;
	display:none;
	color:#fff;
	}

	/*  */
	</style>
	<script>
    this.screenshotPreview = function(){
	/* CONFIG */

		xOffset = 10;
		yOffset = 30;

		// these 2 variable determine popup's distance from the cursor
		// you might want to adjust to get the right result

	/* END CONFIG */
	$("a.screenshot").hover(function(e){
		this.t = this.title;
		this.title = "";
		var c = (this.t != "") ? "<br/>" + this.t : "";
		$("body").append("<p id='screenshot'><img src='"+ this.id +"' alt='Video' />"+ c +"</p>");
		$("#screenshot")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px")
			.fadeIn("fast");
    },
	function(){
		this.title = this.t;
		$("#screenshot").remove();
    });
	$("a.screenshot").mousemove(function(e){
		$("#screenshot")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px");
	});
};


// starting the script on page load
$(document).ready(function(){
	screenshotPreview();
});
    </script>


    <!-- FIN CODIGO DE TABLA JQUERY DESPLEGABLE -->
   <!-- CSS DE Barra de navegación -->
   <style type="text/css">
<!--

#tnt_pagination {
	display:block;
	/*text-align:left;*/
	height:22px;
	line-height:21px;
	clear:both;
	padding-top:3px;
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
	font-weight:normal;
}

#tnt_pagination a:link, #tnt_pagination a:visited{
	padding:7px;
	padding-top:2px;
	padding-bottom:2px;
	border:1px solid #EBEBEB;
	margin-left:10px;
	text-decoration:none;
	background-color:#F5F5F5;
	color:#0072bc;
	width:22px;
	font-weight:normal;
}

#tnt_pagination a:hover {
	background-color:#DDEEFF;
	border:1px solid #BBDDFF;
	color:#0072BC;
}

#tnt_pagination .active_tnt_link {
	padding:7px;
	padding-top:2px;
	padding-bottom:2px;
	border:1px solid #BBDDFF;
	margin-left:10px;
	text-decoration:none;
	background-color:#DDEEFF;
	color:#0072BC;
	cursor:default;
}

#tnt_pagination .disabled_tnt_pagination {
	padding:7px;
	padding-top:2px;
	padding-bottom:2px;
	border:1px solid #EBEBEB;
	margin-left:10px;
	text-decoration:none;
	background-color:#F5F5F5;
	color:#D7D7D7;
	cursor:default;
}
-->
</style>
<!-- FIN BARRA DE NAVEG -->

<!-- TERMINA CODIGO PHP CODIGOS -->
