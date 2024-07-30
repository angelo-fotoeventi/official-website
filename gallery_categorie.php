<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>

	<!--SEO BASED-->

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Language" content="it-IT">

	<meta name="owner" 			content="Angelo Soccio"					/>
	<meta name="author" 		content="Pixo Agency"				 	/>
   	<meta name="design" 		content="Alberto Marà"				 	/>

	<meta name="robots" 		content="all"							/>
	<meta name="robots" 		content="index, follow" 				/>
	<meta name="revisit-after" 	content="3 days"						/>

	<title>
    	ANGELFOTOEVENTI | GALLERY | CATEGORIE
	</title>

	<meta name="description" lang="it"
     content="
     DESCRIZIONE
     " />

	<!--SITETHUMB--><link rel="image_src" 	href="common/template/thumbsite.png" />
	<!--FAVICON--><link rel="icon" href="favicon.ico" type="image/x-icon"/>
	<!--CSSPAGE-->
   		<!--[if lte IE 7]>
			<script type="text/javascript">
                /* <![CDATA[ */
                window.top.location = '../common/error/no_browser/mod_errorbrowser.html';
                /* ]]> */
			</script>
		<![endif]-->

		<!--[if !IE]>--> 	<link rel="stylesheet" type="text/css" href="common/theme/css/no_ie_stylesheet.css" /> 	<!--<![endif]-->
		<!--[if IE]> 		<link rel="stylesheet" type="text/css" href="common/theme/css/ie_stylesheet.css" />		<![endif]-->

    <!--CSS GALLERY-->
	<link href="gallery/theme/stylesheet_gallery.css" rel="stylesheet" type="text/css" media="screen" />


	<!--WEBFONT-->
    <style type="text/css">
		/*TRAJAN*/
		@font-face {
			font-family: 'TrajanProRegular';
			src: url('common/theme/webfont/trajanpro-regular-webfont.eot');
			src: url('common/theme/webfont/trajanpro-regular-webfont.eot?#iefix') format('embedded-opentype'),
				 url('common/theme/webfont/trajanpro-regular-webfont.woff') format('woff'),
				 url('common/theme/webfont/trajanpro-regular-webfont.ttf') format('truetype'),
				 url('common/theme/webfont/trajanpro-regular-webfont.svg#TrajanProRegular') format('svg');
			font-weight: normal;
			font-style: normal;
		}
		@font-face {
			font-family: 'TrajanProBold';
			src: url('common/theme/webfont/trajanpro-bold-webfont.eot');
			src: url('common/theme/webfont/trajanpro-bold-webfont.eot?#iefix') format('embedded-opentype'),
				 url('common/theme/webfont/trajanpro-bold-webfont.woff') format('woff'),
				 url('common/theme/webfont/trajanpro-bold-webfont.ttf') format('truetype'),
				 url('common/theme/webfont/trajanpro-bold-webfont.svg#TrajanProBold') format('svg');
			font-weight: normal;
			font-style: normal;
		}
	</style>

	<!--SCRIPT-->				
	<!--jQuery library-->
	<script type="text/javascript" src="common/script/jquery.min.1.4.3.js"></script>

	<!--slidefade-->
	<link href="common/theme/css/css_slider/Slidecss.css" rel="stylesheet" type="text/css" media="screen" />
	<script type="text/javascript" src="common/script/script_slide/packed.js"></script>
	<script type="text/javascript" src="common/script/script_slide/tinyfader.js"></script>
	
	<!--Dropdowndiv-->
	<script type="text/javascript">
		$(document).ready(function(){
				$('#hideshow_elenco').toggle(function(){
					$('#elenco_gallery').slideDown();
				}, function(){
					$('#elenco_gallery').slideUp();
				});
			});
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
				$('#hideshow_infogallery').toggle(function(){
					$('#info_gallery').slideDown();
				}, function(){
					$('#info_gallery').slideUp();
				});
			});
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
				$('#hideshow_accessogallery').toggle(function(){
					$('#accesso_gallery').slideDown();
				}, function(){
					$('#accesso_gallery').slideUp();
				});
			});
	</script>
        
	<!--NoDrag-->
	<script type="text/javascript">
      window.onload = init; 
			function init() {
			  disableDraggingFor(document.getElementById("NoDrag"));
			}
			 
			function disableDraggingFor(element) {
			  // this works for FireFox and WebKit in future according to http://help.dottoro.com/lhqsqbtn.php
			  element.draggable = false;
			  // this works for older web layout engines
			  element.onmousedown = function(event) {
							event.preventDefault();
							return false;
						  };
			}
	</script>
        
	<!--NoDxMouse-->
	<script language="JavaScript1.2">
		function blocca_tasto_dx()
			{
			   return(false);
			}
		document.oncontextmenu = blocca_tasto_dx;
	</script>
        
	<!--fadeover-->
	<script type='text/javascript'>
		$(document).ready(function(){
			$("div.category").hover(
				function() {
					$(this).find("div.thumb_protect").stop().animate({"opacity": "1"}, "fast");
				},
				function() {
					$(this).find("div.thumb_protect").stop().animate({"opacity": "0"}, "slow");
				});
		});
	</script>

	<!--/SCRIPT-->				

	</head>

	<body id="NoDrag">
        
        <!--header-->
		<?php include("common/include/header/header.php");?>

		<!--content-->
        <div id="content">
        	<div id="gallery">
            
            	<!--barra gallery-->
            	<div style="padding:10px 0 10px 0;">
					<img
					style="margin:0 0 0 15px;" id="hideshow_elenco"
					name="elenco" src="gallery/theme/elenco_off.png" 
					onmouseover="document.elenco.src='gallery/theme/elenco_on.png';"
					onmouseout="document.elenco.src='gallery/theme/elenco_off.png';" 
					/>
					<a href="contatto.php">
						<img 
                    	style="position:absolute; margin-left:532px;" 
						name="preventivo" src="gallery/theme/preventivo_off.png" 
						onmouseover="document.preventivo.src='gallery/theme/preventivo_on.png';"
						onmouseout="document.preventivo.src='gallery/theme/preventivo_off.png';" 
                        />
                    </a>
					<img 
                    style="position:absolute; margin-left:749px;"  id="hideshow_infogallery"
					name="info" src="gallery/theme/info_off.png" 
					onmouseover="document.info.src='gallery/theme/info_on.png';"
					onmouseout="document.info.src='gallery/theme/info_off.png';" 
					/>
					<img
                    style="position:absolute; margin-left:810px;"  id="hideshow_accessogallery"
					name="accesso" src="gallery/theme/accesso_off.png" 
					onmouseover="document.accesso.src='gallery/theme/accesso_on.png';"
					onmouseout="document.accesso.src='gallery/theme/accesso_off.png';" 
					/>
                    
                    <div id="elenco_gallery" style="display: none;">
                    	<img src="gallery/theme/toppop.png" style="position:absolute; margin-top:-20px;" />
                        <ul>
                        	<li>
                            	Nessuna categoria inserita
								<lu>
								Nessun Album presente
								</lu>
                            </li>
                        </ul>
                    </div>
                    
                    <div id="info_gallery" style="display: none;">
                    	<img src="gallery/theme/toppop_info.png" style="position:absolute; margin:-20px 0 0 80px;" />
                        <p>
                        PROVA INFO GALLERY
                        </p>
                    </div>
                    
                    <div id="accesso_gallery" style="display: none;">
                    	<img src="gallery/theme/toppop_info.png" style="position:absolute; margin:-20px 0 0 0px;" />
                        <form>
                            ACCESSO AREA MODIFICHE
                            <br /><br />
                            <font color="#FF0000">CODICE DI SICUREZZA</font>
                            <input type="password"
                            style="
                            padding:	3px 3px 3px 3px;
                            border-radius: 			5px; 
                            -moz-border-radius: 	5px; 
                            -webkit-border-radius: 	5px;
                            color:					#000;
                            "/>
                            <br />
                            <input type="submit" 
                            style="
                            background:	#CCC; 
                            border:		0; 
                            color:		#900;
                            margin-top:	7px; 
                            padding:	3px 3px 3px 3px;
                            border-radius: 			5px; 
                            -moz-border-radius: 	5px; 
                            -webkit-border-radius: 	5px;
						" />
                            <br /><br />
                            <a href="#"><font color="#999999">recupero password</font></a>
                        </form>
                    </div>
                </div>
               
               
                <!--INIZIO CATEGORIE-->
                <div style="text-align:left; padding:0 0 0 14px;">
                	
                    <!--box categorie-->
                    <div class="category" onclick="top.location.href = 'gallery_album.php';">
                    	<div class="copertina" >
	                        <img src="gallery/theme/copia_vietata_e_punibile_in_tribunale.png"
                            style="background-image:url(gallery/theme/outofservice.png); height:146px; width:302px;" 
                            class="thumb_category" />
                            <div class="thumb_protect" ></div>
                        </div>
                        <img src="gallery/theme/line.png" class="line" />
                        <p class="title_categorie">
                        	SENZA TITOLO - GALLERIA VUOTA - OUT OF SERVICE
                        </p>
                    </div>
                    
                    
                    
                    
                </div>                         	
				<!--FINE CATEGORIE-->

            </div>
        </div>
		<img src="common/theme/img/wrap_bot.png" />

		<p id="scrollerp">
        	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CATEGORIE VELOCI  | <span style="margin:-40px 0 !important; position:relative;">
            <marquee direction="right" style="width:800px;">
            	~ MATRIMONI ~ STILL LIFE  ~  SPORT ~ MODA ~ REPORTAGE ~ FOTOEDITING ~ ARTE E FOTOGRAFIA ~ CERIMONIE ~ MODELs BOOOK~ MATRIMONI ~ STILL LIFE  ~  SPORT ~ MODA ~ REPORTAGE ~ FOTOEDITING ~ ARTE E FOTOGRAFIA ~ CERIMONIE ~ MODELs BOOOK ~ MATRIMONI ~ STILL LIFE  ~  SPORT ~ MODA ~ REPORTAGE ~ FOTOEDITING ~ ARTE E FOTOGRAFIA ~ CERIMONIE ~ MODELs BOOOK~ MATRIMONI ~ STILL LIFE  ~  SPORT ~ MODA ~ REPORTAGE ~ FOTOEDITING ~ ARTE E FOTOGRAFIA ~ CERIMONIE ~ MODELs BOOOK ~ MATRIMONI ~ STILL LIFE  ~  SPORT ~ MODA ~ REPORTAGE ~ FOTOEDITING ~ ARTE E FOTOGRAFIA ~ CERIMONIE ~ MODELs BOOOK~ MATRIMONI ~ STILL LIFE  ~  SPORT ~ MODA ~ REPORTAGE ~ FOTOEDITING ~ ARTE E FOTOGRAFIA ~ CERIMONIE ~ MODELs BOOOK
            </marquee>
            </span>
        </p>

		<!--Footer-->
		<?php include("common/include/footbar/footbar.php");?>
		<a href="galleryadmin_home.php"><font color="#FFFFFF">GO TO: "HOME" CREA E SELEZIONA CATEGORIE</font></a>

	</body>

</html>