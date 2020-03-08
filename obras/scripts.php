<!-- EMPIEZA CODIGO PHP CODIGOS -->
<link href="../jscss/css/custom-theme/jquery-ui-1.9.1.custom.css" rel="stylesheet">
<link href="../diseno/diseno.css" rel="stylesheet" type="text/css">
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
	body{
	}
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
<!-- Codigo para prevista de imagenes -->
<script type="text/javascript">

	// Load this script once the document is ready
	$(document).ready(function () {

		// Get all the thumbnail
		$('div.thumbnail-item').mouseenter(function(e) {

			// Calculate the position of the image tooltip
			x = e.pageX - $(this).offset().left;
			y = e.pageY - $(this).offset().top;

			// Set the z-index of the current item,
			// make sure it's greater than the rest of thumbnail items
			// Set the position and display the image tooltip
			$(this).css('z-index','15')
			.children("div.tooltip")
			.css({'top': y + 10,'left': x + 20,'display':'block'});

		}).mousemove(function(e) {

			// Calculate the position of the image tooltip
			x = e.pageX - $(this).offset().left;
			y = e.pageY - $(this).offset().top;

			// This line causes the tooltip will follow the mouse pointer
			$(this).children("div.tooltip").css({'top': y + 10,'left': x + 20});

		}).mouseleave(function() {

			// Reset the z-index and hide the image tooltip
			$(this).css('z-index','1')
			.children("div.tooltip")
			.animate({"opacity": "hide"}, "fast");
		});

	});


	</script>
    <style>

.thumbnail-item {
	/* position relative so that we can use position absolute for the tooltip */
	position: relative;
	/*float: left;  */
	margin: 0px 5px;
}

.thumbnail-item a {
	/*display: block*/;
}

.thumbnail-item img.thumbnail {
	border:3px solid #ccc;
}

.tooltip {
	/* by default, hide it */
	display: none;
	/* allow us to move the tooltip */
	position: absolute;
	/* align the image properly */
	padding: -80px 0 0 8px;
}

	.tooltip span.overlay {
		/* the png image, need ie6 hack though */
		background: url(images/overlay.png) no-repeat;
		/* put this overlay on the top of the tooltip image */
		position: absolute;
		top: 0px;
		left: 0px;
		display: block;
		width: 200px;
		height: 140px;
	}
	</style>

<!-- TERMINA CODIGO PHP CODIGOS -->
