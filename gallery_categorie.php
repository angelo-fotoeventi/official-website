<?php
include_once 'common/dbmanager.php';
if(empty($managerSql)){
    $managerSql = new dbManager();
}
?>
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
	<script type="text/javascript" src="common/script/script_Dropdown/dropdown.js"></script>
      
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

	</head>

	<body>
        
        <!--header-->
		<?php include("common/include/header/header.php");?>

		<!--content-->
        <div id="content">
        	<div id="gallery">
            
            	<!--barra gallery-->
            	<div style="padding:10px 0 10px 0;">
                	
                    <!--opzioni cliccabili-->
					<!--pulsante elenco-->		<img name="elenco" id="hideshow_elenco" src="gallery/theme/elenco_off.png" onmouseover="document.elenco.src='gallery/theme/elenco_on.png';" onmouseout="document.elenco.src='gallery/theme/elenco_off.png';" style="margin:0 0 0 15px;"  />
					<!--pulsante contatto-->	<a href="contatto.php">
                    								<img name="preventivo" src="gallery/theme/preventivo_off.png" onmouseover="document.preventivo.src='gallery/theme/preventivo_on.png';" onmouseout="document.preventivo.src='gallery/theme/preventivo_off.png';" style="position:absolute; margin-left:532px;"/>
                                               	</a>
					<!--pulsante info-->		<img name="info"  id="hideshow_infogallery" src="gallery/theme/info_off.png" onmouseover="document.info.src='gallery/theme/info_on.png';" onmouseout="document.info.src='gallery/theme/info_off.png';"  style="position:absolute; margin-left:749px;" />
					<!--pulsante accesso-->		<img name="accesso" id="hideshow_accessogallery" src="gallery/theme/accesso_off.png" onmouseover="document.accesso.src='gallery/theme/accesso_on.png';" onmouseout="document.accesso.src='gallery/theme/accesso_off.png';" style="position:absolute; margin-left:810px;"/>
                    
                    <!--contenuto pulsante elenco (lista categorie e album)-->
                    <div id="elenco_gallery" style="display: none;">
                    	<img src="gallery/theme/toppop.png" style="position:absolute; margin-top:-20px;" />
                        <ul>
                            <?php
                                $cats = $managerSql->lista_categorie();
                                foreach ($cats as $cat) {
                                    echo "<li><a href=\"gallery_album.php?id={$cat['id_categoria']}\">{$cat['nome']}</a>";
                                    $albs = $managerSql->lista_album_by_categoria($cat['id_categoria']);
                                    foreach ($albs as $alb) {
                                        echo "<lu><a href=\"gallery_foto.php?id={$alb['id_album']}\">{$alb['nome']}</a></lu>";
                                    }
                                    echo "</li>";
                                }
                            ?>
                        </ul>
                    </div>
                    
                    <!--contenuto pulsante info (informazioni sulla gallery)-->
                    <div id="info_gallery" style="display: none;">
                    	<img src="gallery/theme/toppop_info.png" style="position:absolute; margin:-20px 0 0 80px;" />
                        <p>
                        Benvenuto!<br />
						Seleziona cliccando su una categoria per accede agli album.
						Una volta entrato clicca sopra la copertina dell'album per entrarci ed accedi così a tutte le foto in esso contenuto.
						Selezionate le foto che desideri, manda una mail per chiedere le stampe.<br /><br />
						La copia ed il salvataggio delle foto sono punibili ai sensi di legge.
                        </p>
                    </div>
                    
                    <!--contenuto pulsante accesso (admin e password)-->
                    <div id="accesso_gallery" style="display: none;">
                    	<img src="gallery/theme/toppop_info.png" style="position:absolute; margin:-20px 0 0 0px;" />
                        <form method="post" action="administrator/index.php">
                            ACCESSO AREA MODIFICHE
                            <br /><br />
                            <font color="#FF0000">CODICE DI SICUREZZA</font>
                            <input type="password" name="password" id="password"
                            style="
                            padding:	3px 3px 3px 3px;
                            border-radius: 			5px; 
                            -moz-border-radius: 	5px; 
                            -webkit-border-radius: 	5px;
                            "/>
                            <br />
                            <input type="submit"  name="login" id="login"
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
                        </form>
                    </div>
                </div>
               
               
                <!--INIZIO CATEGORIE-->
                <!--<div style="text-align:left; padding:0 0 0 14px;">-->
                	
                    <!--box categorie-->
                <!--
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
                -->
                
                <div style="text-align:left; padding:0 0 0 12px;">
				
					<?php
            
                    $categorie = $managerSql->lista_categorie();
                    
                    foreach ($categorie as $categoria) {
						$img_path = 'gallery/theme/nocopertina.png';
						if(file_exists("gallery/copertine_categorie/{$categoria['id_categoria']}.png") ){
							$img_path = "gallery/copertine_categorie/{$categoria['id_categoria']}.png";
						}
                    
                    echo "	
						<div class=\"category\" onclick=\"top.location.href = 'gallery_album.php?id={$categoria['id_categoria']}';\">
							<div class=\"copertina\">
								<img src=\"gallery/theme/copia_vietata_e_punibile_in_tribunale.png\" style=\"background-image:url(common/thumb_generator_cat.php?file=../$img_path); height:138px; width:294px;\"  class=\"thumb_category\" />
								<div class=\"thumb_protect\"></div>
							</div>
							<img src=\"gallery/theme/line.png\" class=\"line\" />
							<p class=\"title_categorie\">
								{$categoria['nome']}
							</p>
						</div>";
                    }
                    ?>
                
				</div>
				<!--FINE CATEGORIE-->

            </div>
        </div>
        
		<img src="common/theme/img/wrap_bot.png" />
        
		<!--box scritta scorrevole finale-->
		<p id="scrollerp">
        	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CATEGORIE VELOCI  | 
            <span style="margin:-40px 0 !important; position:relative;">
                <marquee direction="right" style="width:800px;">
                    ~ MATRIMONI ~ STILL LIFE  ~  SPORT ~ MODA ~ REPORTAGE ~ FOTOEDITING ~ ARTE E FOTOGRAFIA ~ CERIMONIE ~ MODELs BOOOK~ MATRIMONI ~ STILL LIFE  ~  SPORT ~ MODA ~ REPORTAGE ~ FOTOEDITING ~ ARTE E FOTOGRAFIA ~ CERIMONIE ~ MODELs BOOOK ~ MATRIMONI ~ STILL LIFE  ~  SPORT ~ MODA ~ REPORTAGE ~ FOTOEDITING ~ ARTE E FOTOGRAFIA ~ CERIMONIE ~ MODELs BOOOK~ MATRIMONI ~ STILL LIFE  ~  SPORT ~ MODA ~ REPORTAGE ~ FOTOEDITING ~ ARTE E FOTOGRAFIA ~ CERIMONIE ~ MODELs BOOOK ~ MATRIMONI ~ STILL LIFE  ~  SPORT ~ MODA ~ REPORTAGE ~ FOTOEDITING ~ ARTE E FOTOGRAFIA ~ CERIMONIE ~ MODELs BOOOK~ MATRIMONI ~ STILL LIFE  ~  SPORT ~ MODA ~ REPORTAGE ~ FOTOEDITING ~ ARTE E FOTOGRAFIA ~ CERIMONIE ~ MODELs BOOOK
                </marquee>
            </span>
        </p>

		<!--Footer-->
		<?php include("common/include/footbar/footbar.php");?>

	</body>

</html>