<?php
include_once 'common/dbmanager.php';
if(empty($managerSql)){
    $managerSql = new dbManager();
}

if( empty($_GET['id']) && empty($_GET['tag']) ){
    header('Location: error.php?code=1');
    exit();
}
$id = false;
if(!empty($_GET['id'])){
    $id = $_GET['id'];
}
$album = $managerSql->get_album($id);
if( !$album && empty($_GET['tag']) ){
    header('Location: index.php');
    exit();
}

$pagina_attuale = 0;
$inizio = 0;
$elementi_per_pagina = 125;
if( array_key_exists('pagina', $_GET) ){
    $pagina_attuale = $_GET['pagina'];
    $inizio = $elementi_per_pagina * $pagina_attuale;
}

$tag = NULL;
if(array_key_exists('tag', $_GET)){
    $tag = $_GET['tag'];
}

if( empty($tag) ){
    $lista_foto = $managerSql->lista_foto_by_album($album['id_album']);
}else{
    $lista_foto = $managerSql->lista_foto_by_tag($tag);
}
$num_foto = count($lista_foto);
if( ($num_foto>0) && ($inizio>=$num_foto) ){
    header('Location: gallery_foto.php?id='.$album['id_album']."&tag=".$tag);
    exit("accesso ad area non consentito... numero pagina non valido");
}
if( empty ($tag) ){
    $lista_foto = $managerSql->lista_foto_by_album($album['id_album'], $inizio, $elementi_per_pagina);
}else{
    $lista_foto = $managerSql->lista_foto_by_tag( $tag, $inizio, $elementi_per_pagina);
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
    	ANGELFOTOEVENTI | GALLERY
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
					$("div.wrap_photo").hover(
						function() {
							$(this).find("div.thumb_protect_photo").stop().animate({"opacity": "1"}, "fast");
						},
						function() {
						$(this).find("div.thumb_protect_photo").stop().animate({"opacity": "0"}, "slow");
					});
				});
	</script>
            
	<!--lightbox-->
	<link rel="stylesheet" type="text/css" href="gallery/lightbox/css/jquery.lightbox-0.5.css" media="screen" />
	<script type="text/javascript" src="gallery/lightbox/js/jquery.lightbox-0.5.js"></script>
	<script type="text/javascript">
			$(function() {
				$('#listafoto a').lightBox();
			});
	</script>

    <!--cambia pagina-->
    <script type="text/javascript">
		function cambia_pagina(){
				tag_cerca = "<?php echo $tag; ?>";
                if(tag_cerca!=""){
                    tag_cerca = "&tag="+tag_cerca;
                }
                elemReg = document.getElementById('pagine');
                pagina = elemReg[elemReg.selectedIndex].value;
                window.location.href = "gallery_foto.php?id=<?php echo $album['id_album']; ?>&pagina=" + pagina + tag_cerca;
            }
	</script>


	</head>

	<body >
        
        <!--header-->
		<?php include("common/include/header/header.php");?>

		<!--content-->
        <div id="content">
        	<div id="gallery">
            
            	<!--barra gallery-->
            	<div style="padding:10px 0 10px 0;">
                	
                    <!--opzioni cliccabili-->
					<!--pulsante elenco-->		<img name="elenco" id="hideshow_elenco" src="gallery/theme/elenco_off.png" onmouseover="document.elenco.src='gallery/theme/elenco_on.png';" onmouseout="document.elenco.src='gallery/theme/elenco_off.png';" style="margin:0 0 0 15px;"  />
                    <!--ricerca per tag-->		<div id="carca_tag" >
													<form name="frm_cerca" id="frm_cerca" action="" method="GET" onsubmit="javascript: if( $('#tag').val()=='' ) return false;">
														<input type="text" name="tag" id="tag" value="Es. Mario Rossi"
														style="
														width:	112px;
														background:	none; 
														border:		0; 
														color:		#900;"    />
														<input type="submit" style="display:none;" />
													</form>
												</div>
                    
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
                        Sei in un Album. Qui sono contenute tutte le foto...
						Clicca sopra una copertina per visualizzare la foto che hai scelto.
						Salvati i nomi delle foto che desideri e manda una mail per chiedere le stampe.<br /><br />
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
                        </form>
                    </div>
                </div>
               
               
                <!--INIZIO FOTO-->
                <div id="listafoto" style="text-align:left; padding:0 0 0 14px;">

                    <!--box foto-->
                    <?php
                    foreach ($lista_foto as $foto) {
                        echo "
							<div class=\"wrap_photo\">
								<div class=\"copertina_photo\">
									<a href=\"gallery/foto/{$foto['id_foto']}.jpg\">
										<img src=\"gallery/theme/copia_vietata_e_punibile_in_tribunale.png\" style=\"background:url('common/thumb_generator.php?file=../gallery/foto/{$foto['id_foto']}.jpg') no-repeat; height:142px; width:174px;\" class=\"thumb_photo\" />
										<div class=\"thumb_protect_photo\" ></div>
									</a>
								</div>
									<img src=\"gallery/theme/line_photo.png\" class=\"line_photo\" />
									<p class=\"title_photo\">
										{$foto['nome']}
									</p>
									<p class=\"tag_photo\">
										<font color=\"#CC0000\">TAG:</font>
										<span class=\"tagname\">{$foto['tag']}</span>
									</p>
								</div>";
                    }
                    ?>
                    
                </div>   
                
                <!--Selezione pagine-->
                <div id="optionbar">
                    &nbsp;
                    <?php
                    if($pagina_attuale>0){
                        $p = $pagina_attuale-1;
                        echo "<a href=\"{$_SERVER['PHP_SELF']}?id={$album['id_album']}&pagina=$p&tag=$tag\"><img src=\"gallery/theme/number_left.png\" class=\"number_left\" /></a>";
                    }else{
                        echo "<img src=\"gallery/theme/number_left.png\" class=\"number_left\" />";
                    }

                    //verifico che sia necessario visualizzare il menù delle pagine
                    $pagina=0;
                    if ( $num_foto>0 && $num_foto>$elementi_per_pagina ){
                        echo '<select name="pagine" id="pagine" onchange="javascript: cambia_pagina();" >';
                        while($num_foto>0){ //ciclo per creare una 'option' per ogni pagina
                            echo "<option value=\"$pagina\"";
                            if( $pagina_attuale==$pagina){
                                echo 'selected="selected"'; //verrà selezionata la pagina attuale
                            }
                            echo " >$pagina</option>";
                            $num_foto -= $elementi_per_pagina;
                            $pagina++;
                        }
                        echo '</select>';
                    }
                    
                    if($pagina_attuale<--$pagina){
                        $p = $pagina_attuale+1;
                        echo "<a href=\"{$_SERVER['PHP_SELF']}?id={$album['id_album']}&pagina=$p&tag=$tag\"><img src=\"gallery/theme/number_right.png\" class=\"number_right\" /></a>";
                    }else{
                        echo "<img src=\"gallery/theme/number_right.png\" class=\"number_right\" />";
                    }
                    
                    ?>
                    
                </div>

                <p style="clear: both">&nbsp;</p>
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