<?php
include_once 'common/dbmanager.php';
if(empty($managerSql)){
    $managerSql = new dbManager();
}

include 'administrator/verifica_admin.php';

if( empty ($_GET['id']) ){
    header('Location: error.php?code=1');
    exit();
}

$categoria = $managerSql->get_categoria($_GET['id']);
if( !$categoria ){
    header('Location: error.php?code=4');
    exit();
}

$lista_album = $managerSql->lista_album_by_categoria($categoria['id_categoria']);
$first = array();
$first['indice_ordinamento'] = '1';

if(count($lista_album)){
    $first = $lista_album[0];
}



$error=array();
$salvataggio_completato=0;

if(array_key_exists('modifica', $_POST)){
    if( empty($_POST['nome']) ){ $error[] = 'nome'; }else{ $categoria['nome']=$_POST['nome']; }
    
    if( !count($error) ){
        if ( !$managerSql->modifica_categoria($categoria) ){
            header('Location: error.php?code=5');
            exit();
        }  else {
            $salvataggio_completato=1;
        }
    }
}

if(array_key_exists('modifica_copertina', $_POST)){
    if( !array_key_exists('immagine', $_FILES) || ($_FILES['immagine']['size']==0) ){
        header('Location: error.php?code=5');
        exit();
    }
    include 'common/carica_img.php';
    if ( load_image("gallery/copertine_categorie/", $_FILES['immagine'], $categoria['id_categoria'] ) ){
        $salvataggio_completato = 1;
    }
}


if(array_key_exists('crop_copertina', $_POST)){
    $img_r = imagecreatefrompng($_POST['path']);
    $dst_r = ImageCreateTrueColor( $_POST['w'], $_POST['h'] );
    imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],$_POST['w'],$_POST['h'],$_POST['w'],$_POST['h']);
    imagepng($dst_r, $_POST['path']);
    header('Location: galleryadmin_categorie.php?id='.$categoria['id_categoria']);
    exit();
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
    	GALLERY ADMIN | HOME
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
		#lista_album{
			margin-left:-5px;
		}
		#lista_album li{
			display:inline-block !important;
			list-style:none;
		}
		#lista_categorie  li {
			list-style-type: none;
			float: left;
		}
	</style>

	<!--SCRIPT-->				
	<!--jQuery library-->
	<script type="text/javascript" src="common/script/jquery.min.1.4.3.js"></script>
    <script type="text/javascript" src="common/js/jquery-ui-1.8.6.custom.min.js"></script>
    <!-- <script type="text/javascript" src="../common/js/jquery-1.6.2.min.js"></script> -->

	<!--slidefade-->
	<link href="common/theme/css/css_slider/Slidecss.css" rel="stylesheet" type="text/css" media="screen" />
	<script type="text/javascript" src="common/script/script_slide/packed.js"></script>
	<script type="text/javascript" src="common/script/script_slide/tinyfader.js"></script>
	
	<!--Dropdowndiv-->
	<script type="text/javascript" src="common/script/script_Dropdown/dropdown.js"></script>
        
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

		$(document).ready(function(){
					$("div.album").hover(
						function() {
							$(this).find("div.thumb_protect").stop().animate({"opacity": "1"}, "fast");
						},
						function() {
						$(this).find("div.thumb_protect").stop().animate({"opacity": "0"}, "slow");
					});
				});

		$(document).ready(function(){
					$("div.album").hover(
						function() {
							$(this).find("div.option_boxalbum").stop().animate({"opacity": "1"}, "fast");
						},
						function() {
						$(this).find("div.option_boxalbum").stop().animate({"opacity": "0"}, "slow");
					});
				});

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

    <!-- Script per ordinare con drag & drop le categorie -->
    <script type="text/javascript">
		$(document).ready(function(){
                $('#lista_album').sortable({
                    update: function(event, ui) {salva_ordininamento(); }
                });
            });

            function  visualizza_ordinamento(){
                var ordine = $('#lista_album').sortable("serialize");
                alert(ordine);
            }

            function salva_ordininamento(){
                var indice_inizio_ordinamento = "<?php echo $first['indice_ordinamento'] ?>";
                var array_ordine = $('#lista_album').sortable("serialize");
                dati = "inizio="+indice_inizio_ordinamento + "&" +array_ordine+ "&richiesta=salva_ordine_album";
                $.post('ajax_query.php', dati);
            }
            
            
            //variabile che contiente l'id della categoria da cancellare
            var toDelete = 0;

            function elimina_album(){
                location.href = 'administrator/del_album.php?id='+toDelete;
            }
	</script>

	<!--Jcrop-->
	<link rel="stylesheet" href="common/jcrop/css/jquery.Jcrop.css" type="text/css" />
	<script src="common/jcrop/js/jquery.Jcrop.min.js" type="text/javascript"></script>
	<script type="text/javascript">
		//Jcrop
		$(function($) {
                $('#copertina').Jcrop({
                        onChange: showCoords,
                        onSelect: showCoords,
						minSize: [295,139],
						aspectRatio: 295/139,
						boxWidth: 800
                });
            });
            function showCoords(c){
                $('#x').val(c.x);
                $('#y').val(c.y);
                $('#x2').val(c.x2);
                $('#y2').val(c.y2);
                $('#w').val(c.w);
                $('#h').val(c.h);
            };
    </script>
    
	<script type="text/javascript">
		$(function(){
                if( <?php echo $salvataggio_completato ?> ){
                    alert('Salvataggio dati completato');
                }
            })
	</script>

	</head>

    <body onload="javascript: $('#div_modifica_copertina').toggle(100, null);">
        
        <!--header-->
		<?php include("common/include/header/header.php");?>

		<!--content-->
        <div id="content">
        	<div id="gallery">
            
            	<!--barra gallery-->
            	<div style="padding:10px 0 10px 0;">
            
                    <!--opzioni cliccabili-->
					<!--Elenco 			(solo grafica) -->	<img style="margin:0 0 0 15px;" src="gallery/theme/elenco_out.png" />
					<!--Nome pannello 	(solo grafica) -->	<img style="position:absolute; margin-left:5px; margin-top:-1px;" name="preventivo" src="gallery/theme/pannellodicontrollo.png" />
					<!--pulsante info-->					<img style="position:absolute; margin-left:749px;"  id="hideshow_infogallery" name="info" src="gallery/theme/info_off.png" onmouseover="document.info.src='gallery/theme/info_on.png';" onmouseout="document.info.src='gallery/theme/info_off.png';" />
					<!--pulsante LogOut-->					<img style="position:absolute; margin-left:810px;"  id="hideshow_accessogallery" name="accesso" src="gallery/theme/accesso_off.png" onmouseover="document.accesso.src='gallery/theme/accesso_on.png';" onmouseout="document.accesso.src='gallery/theme/accesso_off.png';" />
                    
                    
                    <!--contenuto pulsante info (informazioni sulla gallery)-->
                    <div id="info_gallery" style="display: none;">
                    	<img src="gallery/theme/toppop_info.png" style="position:absolute; margin:-20px 0 0 80px;" />
                        <p>
                            Sei sul pannello di controllo della galleria.<br />
                            <br />
                            Puoi postare i box trascinandoli con il mouse. Rilascia il mouse per posizionarli.<br />
                            Puoi Gestire i parametri della categoria tramite il primo pannello.<br />
                            Puoi Creare nuovi album tramite il box "+1"
                        </p>
                    </div>                    
                    
                    <!---pannello logout-->
                    <div id="accesso_gallery" style="display: none;">
                    	<img src="gallery/theme/toppop_info.png" style="position:absolute; margin:-20px 0 0 0px;" />
                        <!--<form> -->
                        ESCI E TORNA UTENTE
                        <br />
                        <input type="button" value="ESCI ORA" 
                        style=" background:	#CCC; border: 0; color: #900; margin-top: 7px; padding:	3px 3px 3px 3px; border-radius: 5px; -moz-border-radius: 5px; -webkit-border-radius: 5px;" onclick="location.href='administrator/logout.php' "/>
                        <br />
                        <!-- </form> -->
                    </div>
                
                </div>

                <!--INIZIO PANNELLO CATEGORIA E CREA ALBUM-->
                <div style="text-align:left;">


                    <!--pannello modifiche categoria-->
						<img src="gallery/theme/categoriaselezionata.png" style="margin-left:15px;" />
						<div id="mod_categoria">
							
                            <!--modifica copertina-->
                            <div class="mod_copertina" >
                                <?php
									$img_path = 'gallery/theme/nocopertina.png';
										if(file_exists("gallery/copertine_categorie/{$categoria['id_categoria']}.png") ){
											$img_path = "gallery/copertine_categorie/{$categoria['id_categoria']}.png";
										}
								?>
								<img src="<?php echo $img_path; ?>" style=" position:absolute; margin:10px 0 0 12px;" height="139"  width="295"/>
								<div class="change" onclick="javascript: $('#div_modifica_copertina').toggle(500, null);"></div>
								<img src="gallery/theme/line.png" class="line" style="margin-left:12px;" />
								<p class="title_categorie" style="width:200px; height:20px; overflow:hidden; margin-left:5px; margin-top:162px;">
									<?php echo $categoria['nome']; ?>
								</p>
							</div>
                            
                            <!--opzioni della categoria-->
                            <div class="option">
                                <img src="gallery/theme/head_moddaticategoria.png" style="position:absolute; margin-top:-2px;" />
                                <form id="form_categoria_attivita" method="post" action="" >
                                    <input type="text" name="nome" maxlength="60" value="<?php echo $categoria['nome']; ?>"
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
                                width:647px;
                                height:73px;
                                position:absolute;
                                margin:80px 0 0 0;
                                border:none;
                                background:url(gallery/theme/home.png) no-repeat;"
                                onclick="javascript: location.href='galleryadmin_home.php';"
                                />
                                <a href="http://www.bordermaker.nl/en/download/" target="_blank"
                                style="
                                width:347px;
                                height:73px;
                                position:absolute;
                                margin:126px 0 0 0;
                                border:none;
                                background:url(gallery/theme/annulla.png) no-repeat;
                                "></a>
                                <input type="submit" name="modifica" value="&nbsp;"
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


					<!--Pannelli (hide/show)-->
                    <div style="text-align:left; padding:0 0 0 14px;">
                			
                        <!--box crea album-->
                        <div class="pannello_nuovoalbum" style="display: none;">
                            <img src="gallery/theme/head_nuovoalbum.png" />
                            <div style=" width:436px; height:162px; background:url(gallery/theme/bkg_elimina.png) no-repeat top; text-align:center; ">
                                <form id="form_album" method="post" action="administrator/add_album.php?id_categoria=<?php echo $categoria['id_categoria']; ?>" >
                                    <input type="text" name="nome" id="nome" maxlength="60" value="Inserisci un titolo"
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
                                    <input type="submit" name="aggiungi" id="aggiungi" value="&nbsp;"
                                    style="
                                        background:url(gallery/theme/creatitolocategoria.png) no-repeat;
                                        height:75px;
                                        width:386px;
                                        border:none;
                                    " />
                                    <img class="okclose" src="gallery/theme/Noesci.png" style="margin-top:-25px;" onclick="javascript: $('.pannello_nuovoalbum').fadeOut(500, null); $('#nome').val('Inserisci un titolo');"/>
                                </form>
                            </div>
                        </div>
                                
                        <!--elimina album-->
                        <div class="pannello_elimina" style="display: none;">
                            <img src="gallery/theme/head_elimina.png" />
                            <div style=" width:436px; height:162px; background:url(gallery/theme/bkg_elimina.png) no-repeat top; text-align:center; ">
                                <img src="gallery/theme/okelimina.png" style="margin-bottom:-20px;" onclick="javascript: elimina_album();"/>
                                <img class="okclose" src="gallery/theme/Noesci.png" onclick="javscript: $('.pannello_elimina').fadeOut(0, null);"/>
                            </div>
                        </div>
                        
                        <!--modifica copertina (jcrop)-->
                        <div id="wrap_div_modifica_copertina">
                            <div id="div_modifica_copertina">
                                <p style="font-family:Arial, Helvetica, sans-serif; color:#CCCCCC; font-size:16px; float:right;" onclick="javscript: $('#div_modifica_copertina').fadeOut(0, null);">CHIUDI IL BOX ED ESCI</p> 
                                <p style="font-family:Arial, Helvetica, sans-serif; color:#CCCCCC; font-size:16px;">Cambia Copertina</p>

								<?php
                                    $img_path = 'gallery/theme/nocopertina.png';
                                    if(file_exists("gallery/copertine_categorie/{$categoria['id_categoria']}.png") ){
                                        $img_path = "gallery/copertine_categorie/{$categoria['id_categoria']}.png";
                                    }
                                ?>
                                <img id="copertina" src="<?php echo $img_path; ?>" />
                                <form name="frm_crop" id="frm_crop" action="" method="post">
                                    <!--<label>X1--> <input size="4" id="x" name="x" type="hidden"> <!--</label>-->
                                    <!--<label>Y1--> <input size="4" id="y" name="y" type="hidden"> <!--</label>-->
                                    <!--<label>X2--> <input size="4" id="x2" name="x2" type="hidden"> <!--</label>-->
                                    <!--<label>Y2--> <input size="4" id="y2" name="y2" type="hidden"> <!--</label>-->
                                    <!--<label>W-->	<input size="4" id="w" name="w" type="hidden"> 	<!--</label>-->
                                    <!--<label>H-->	<input size="4" id="h" name="h" type="hidden"> 	<!--</label>-->
                                    <input type="hidden" name="path" value="<?php echo $img_path; ?>" />
                                    <?php
                                        if(file_exists("gallery/copertine_categorie/{$categoria['id_categoria']}.png") ){
                                            echo "<input class=\"tagliaora\" type=\"submit\" name=\"crop_copertina\" value=\"Taglia Immagine\" />";
                                        }
                                    ?>                                
                                </form>
                                
                                
                                <form name="form_copertina" action="" method="post" enctype="multipart/form-data" id="form_copertina">
                                    <p style="font-family:Arial, Helvetica, sans-serif; color:#CCCCCC; font-size:16px;">CARICA UNA NUOVA COPERTINA</p>
                                    <input type="file" name="immagine" id="immagine" />
                                    <input type="submit" name="modifica_copertina" id="modifica_copertina" value="Carica copertina" />
                                </form>                                
                            </div>
                        </div>
  
                    </div>
					<!--/Pannelli (hide/show)-->

					<!--sezione degli album-->
                    <div style="text-align:left; padding:0 0 0 14px;">
                        <img src="gallery/theme/title_creasottocategoria.png" /><br />                       
                            <ul id="lista_album">
    
                                <!--box crea album-->
                                <li>
                                    <div class="album">
                                        <div class="copertina" onclick="javascript: $('.pannello_nuovoalbum').toggle(500, null);" >
                                            <img src="gallery/theme/copia_vietata_e_punibile_in_tribunale.png" style="background:url(gallery/theme/add_categoryealbum.png) no-repeat; height:146px; width:302px; margin:0 0 -2px 0;" class="thumb_category" />
                                            <div class="thumb_protect" ></div>
                                        </div>
                                        <img src="gallery/theme/line.png" class="line" />
                                        <p class="title_categorie">
                                            CREA ADESSO UN NUOVO ALBUM
                                        </p>
                                    </div>
                                </li>
    
    
                                <!--box già esistenti-->
                                <?php
    
                                foreach ($lista_album as $album) {
                                    $img_path = 'gallery/theme/nocopertina.png';
                                    if(file_exists("gallery/copertine_album/{$album['id_album']}.png") ){
                                        $img_path = "gallery/copertine_album/{$album['id_album']}.png";
                                    }
                                    /*
                                    echo "<li id=\"lista_album_{$album['id_album']}\">
                                            <img src=\"$img_path\" width=\"100\" /><br/>
                                            <!-- {$album['id_album']} -->
                                            {$album['nome']}<br/>
                                            <a href=\"edit_album.php?id={$album['id_album']}\">Modifica</a><br/>
                                            <a href=\"del_album.php?id={$album['id_album']}\" onclick=\"javascript: return confirm('Sei sicuro di voler eliminare l\'album?');\">Elimina</a><br/>
                                          </li>";
                                     * 
                                     */
                                    echo "<li id=\"lista_album_{$album['id_album']}\">
                                                <div class=\"album\">
                                                    <div class=\"copertina\" >
                                                        <img src=\"gallery/theme/copia_vietata_e_punibile_in_tribunale.png\" style=\"background:url(common/thumb_generator_cat.php?file=../$img_path) no-repeat;height:138px; width:294px;\" class=\"thumb_category\" />
                                                        <div class=\"thumb_protect\" ></div>
                                                    </div>
                                                    
                                                    <img src=\"gallery/theme/line.png\" class=\"line\" />
                                                    <p class=\"title_album\">
                                                        {$album['nome']}
                                                    </p>
                                                    
                                                    <div class=\"optionbox_album\">
                                                        <a href=\"galleryadmin_album.php?id={$album['id_album']}\">
                                                            <img src=\"gallery/theme/entreemodifica_categoria.png\" />
                                                        </a>
                                                        <!-- <a href=\"administrator/del_album.php?id={$album['id_album']}\"> -->
                                                            <img src=\"gallery/theme/elimina_categoria.png\"  style=\"margin:-8px 0 -10px 0;\" onclick=\"javascript: $('.pannello_elimina').fadeIn(0,null); toDelete={$album['id_album']}; \" />
                                                        <!-- </a> -->
                                                    </div>
                                                </div>
                                          </li>";
                                }
                                ?>
                                
                                <!-- <li><a href="add_album.php?id_categoria=<?php echo $categoria['id_categoria']; ?>">Nuovo Album</a></li> -->
                            </ul>
                            
                            <!-- 
                            <input type="button" name="visual" onclick="javascript: visualizza_ordinamento();" value="visualizza" />
                            <input type="button" name="salva" onclick="javascript: salva_ordininamento();" value="salva" />
                            -->
                    
                    	</div>
				</div>
			</div>
            <p style="clear: both"> &nbsp </p>                     	
			<!--FINE PANNELLO CATEGORIA E CREA ALBUM-->

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