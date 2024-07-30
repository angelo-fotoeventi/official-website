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
    	GALLERY ADMIN | CATEGORIE E CREAZIONI ALBUM
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



    <!--GALLERY--><link href="gallery/theme/stylesheet_gallery.css" rel="stylesheet" type="text/css" media="screen" />


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
        
        
	<!--fadeover-->
	<script type='text/javascript'>
		$(document).ready(function(){
					$("div.mod_copertina").hover(
						function() {
							$(this).find("div.change").stop().animate({"opacity": "1"}, "fast");
						},
						function() {
						$(this).find("div.change").stop().animate({"opacity": "0"}, "slow");
					});
				});
	</script>
	<script type='text/javascript'>
		$(document).ready(function(){
					$("div.album").hover(
						function() {
							$(this).find("div.thumb_protect").stop().animate({"opacity": "1"}, "fast");
						},
						function() {
						$(this).find("div.thumb_protect").stop().animate({"opacity": "0"}, "slow");
					});
				});
	</script>
	<script type='text/javascript'>
		$(document).ready(function(){
					$("div.album").hover(
						function() {
							$(this).find("div.option_boxalbum").stop().animate({"opacity": "1"}, "fast");
						},
						function() {
						$(this).find("div.option_boxalbum").stop().animate({"opacity": "0"}, "slow");
					});
				});
	</script>
	<script type='text/javascript'>
		$(document).ready(function(){
					$("div.album").hover(
						function() {
							$(this).find("div.optionbox_album").stop().animate({"opacity": "1"}, "fast");
						},
						function() {
						$(this).find("div.optionbox_album").stop().animate({"opacity": "0"}, "slow");
					});
				});
	</script>
            
    <!--/SCRIPT-->				


	</head>

	<body>
        
        <!--header-->
		<?php include("common/include/header/header.php");?>

		<!--content-->
        <div id="content">
        	<div id="gallery">
            
            	<!--barra gallery-->
            	<div style="padding:10px 0 10px 0;">
                	<img 
                	style="margin:0 0 0 15px;"
                	src="gallery/theme/elenco_out.png"
                	/>
                	<img
                    style="position:absolute; margin-left:5px; margin-top:-1px;" 
                	name="preventivo" src="gallery/theme/pannellodicontrollo.png"
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
                        ESCI E TORNA UTENTE
                        <br />
                        <input type="button" value="ESCI ORA" 
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
                        <br />
                        </form>
                    </div>
                </div>
               
                <!--MODIFICA LA CATEGORIA-->
                <img src="gallery/theme/categoriaselezionata.png" style="margin-left:15px;" />
                <div id="mod_categoria">
                	<div class="mod_copertina">
                    	<img src="gallery/theme/nocopertina.png" 
                        style="
                        position:absolute;
                        margin:10px 0 0 12px;
                        "/>
                        <div class="change" ></div>
                        <img src="gallery/theme/line.png" class="line" style="margin-left:12px;" />
                        <p class="title_categorie" style="width:200px; height:20px; overflow:hidden; margin-left:5px; margin-top:162px;">
                        	NESSUN TITOLO ...
                        </p>
                    </div>
                    <div class="option">
                    	<img src="gallery/theme/head_moddaticategoria.png" style="position:absolute; margin-top:-2px;" />
                        <form>
                        <input type="text" maxlength="60" value="TITOLOESEMPIO"
                        style="
                        position:absolute;
                        margin:36px 0;
                        border:none;
                        width:587px;
                        background:	url(gallery/theme/cambiatitolo.png) top no-repeat;
                        padding:30px 10px 10px 30px;
                        color:#FFF;
                        " />
                        <input type="button" value="&nbsp;"
                        style="
                        width:347px;
                        height:73px;
                        position:absolute;
                        margin:80px 0 0 0;
                        border:none;
                        background:url(gallery/theme/download.png) no-repeat;
                        "/>
                        <input type="button" value="&nbsp;"
                        style="
                        width:347px;
                        height:73px;
                        position:absolute;
                        margin:80px 0 0 292px;
                        border:none;
                        background:url(gallery/theme/elimina.png) no-repeat;
                        "/>
                        <input type="submit" value="&nbsp;"
                        style="
                        width:347px;
                        height:73px;
                        position:absolute;
                        margin:126px 0 0 0;
                        border:none;
                        background:url(gallery/theme/annulla.png) no-repeat;
                        "/>
                        <input type="reset" value="&nbsp;"
                        style="
                        width:347px;
                        height:73px;
                        position:absolute;
                        margin:126px 0 0 292px;
                        border:none;
                        background:url(gallery/theme/invia.png) no-repeat;
                        "/>
                        </form>
                    </div>
                </div>
                <br />
               
                <!--INIZIO ALBUM-->
                <div style="text-align:left; padding:0 0 0 14px;">
                			
                            <!--option-->
                            <!--NUOVO ALBUM-->
                            <div class="pannello_nuovoalbum" style="visibility:hidden;">
                            	<img src="gallery/theme/head_nuovacategoria.png" />
                                <div style="
                                width:436px;
                                height:162px;
                                background:url(gallery/theme/bkg_elimina.png) no-repeat top;
                                text-align:center;
                                ">
                                <form>
                                	<input type="text" maxlength="60" value="Inserisci un titolo"
                                    style="
                                    background:#333333;
                                    width:340px;
                                    height:20px;
                                    margin-top:-15px;
                                    margin-bottom:-5px;
                                    padding:5px 5px 5px 5px;
                                    border:3px solid #666;
                                  	border-radius: 			5px; 
                                    -moz-border-radius: 	5px; 
                                    -webkit-border-radius: 	5px;
                                    
                                    font-family:Tahoma, Geneva, sans-serif;
                                    color:#FFFFFF;
                                    " />
                                    <input type="submit" value="&nbsp;"
                                    style="
                                    background:url(gallery/theme/creatitolocategoria.png) no-repeat;
                                    height:75px;
                                    width:386px;
                                    border:none;
                                    " />
                                	<img class="okclose" src="gallery/theme/Noesci.png" style="margin-top:-25px;" />
                                </form>
                                
                                </div>
                            </div>
                            
                            <!--ELIMINA ALBUM-->
                            <div class="pannello_elimina" style="visibility:hidden;">
                            	<img src="gallery/theme/head_elimina.png" />
                                <div style="
                                width:436px;
                                height:162px;
                                background:url(gallery/theme/bkg_elimina.png) no-repeat top;
                                text-align:center;
                                ">
                                <img src="gallery/theme/okelimina.png" style="margin-bottom:-20px;" />
                                <img class="okclose" src="gallery/theme/Noesci.png" />
                                </div>
                            </div>
                            <!--/option-->
                	
                    <!--box crea album-->
                    <img src="gallery/theme/title_creasottocategoria.png" /><br />
                    <div class="album">
                    	<div class="copertina" >
	                        <img src="gallery/theme/copia_vietata_e_punibile_in_tribunale.png"
                            style="background:url(gallery/theme/add_categoryealbum.png) no-repeat; height:146px; width:302px; margin:0 0 -2px 0;" 
                            class="thumb_category" />
                            <div class="thumb_protect" ></div>
                        </div>
                        <img src="gallery/theme/line.png" class="line" />
                        <p class="title_categorie">
                        	CREA ADESSO UN NUOVO ALBUM
                        </p>
                    </div>
                        
                    <!--box categoria esistente (esempio)-->
                    <div class="album">
                    	<div class="copertina" >
	                        <img src="gallery/theme/copia_vietata_e_punibile_in_tribunale.png"
                            style="background:url(gallery/theme/add_categoryealbumesempio.png) no-repeat; height:146px; width:302px; margin:0 0 -2px 0;" 
                            class="thumb_category" />
                            <div class="thumb_protect" ></div>
                        </div>
                        
                        <img src="gallery/theme/line.png" class="line" />
                        <p class="title_album">
                        	ALBUM TITOLO ESEMPIO
                        </p>
                        <div class="optionbox_album">
                       		<a href="galleryadmin_album.php">
                            	<img src="gallery/theme/entreemodifica_categoria.png" />
                            </a>
                            <img src="gallery/theme/elimina_categoria.png"  style="margin:-8px 0 -10px 0;"/>
                            <img src="gallery/theme/trascina_categoria.png" />
                        </div>
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

	</body>

</html>